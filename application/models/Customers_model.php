<?php
/**
 * Geo POS -  Accounting,  Invoicing  and CRM Application
 * Copyright (c) Rajesh Dukiya. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@ultimatekode.com
 *  Website: https://www.ultimatekode.com
 *
 *  ************************************************************************
 *  * This software is furnished under a license and may be used and copied
 *  * only  in  accordance  with  the  terms  of such  license and with the
 *  * inclusion of the above copyright notice.
 *  * If you Purchased from Codecanyon, Please read the full License from
 *  * here- http://codecanyon.net/licenses/standard/
 * ***********************************************************************
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model
{

    var $table = 'geopos_customers';
    var $column_order = array(null, 'geopos_customers.name', 'geopos_customers.address', 'geopos_customers.email', 'geopos_customers.phone', null);
    var $column_search = array('geopos_customers.name','customer_basic_info.reference_id' ,'geopos_customers.phone', 'geopos_customers.address', 'geopos_customers.city', 'geopos_customers.email', 'geopos_customers.docid');

    var $column_due_search = array('geopos_customers.name','geopos_customers.phone', 'geopos_customers.address', 'geopos_customers.city', 'geopos_customers.email', 'geopos_customers.docid');
    var $trans_column_order = array('date', 'debit', 'credit', 'account', null);
    var $trans_column_search = array('id', 'date');
    var $inv_column_order = array(null, 'tid', 'name', 'invoicedate', 'total', 'status', null);
    var $inv_column_search = array('tid', 'name', 'invoicedate', 'total');
    var $order = array('id' => 'desc');
    var $inv_order = array('geopos_invoices.tid' => 'desc');
    var $qto_order = array('geopos_quotes.tid' => 'desc');
    var $notecolumn_order = array(null, 'title', 'cdate', null);
    var $notecolumn_search = array('id', 'title', 'cdate');
    var $pcolumn_order = array('geopos_projects.status', 'geopos_projects.name', 'geopos_projects.edate', 'geopos_projects.worth', null);
    var $pcolumn_search = array('geopos_projects.name', 'geopos_projects.edate', 'geopos_projects.status');
    var $ptcolumn_order = array('status', 'name', 'duedate', 'start', null, null);
    var $ptcolumn_search = array('name', 'edate', 'status');
    var $porder = array('id' => 'desc');


    private function _get_datatables_query($id = '')
    {
        $due = $this->input->post('due');
        if ($due) {

            // $this->db->select('geopos_customers.*,customer_basic_info.*,customer_coat_size.*,customer_pant_size.*,customer_kmz_shl.*,SUM(geopos_invoices.total) AS total,SUM(geopos_invoices.pamnt) AS pamnt');
            $this->db->select('geopos_customers.*, SUM(geopos_invoices.total) AS total,SUM(geopos_invoices.pamnt) AS pamnt');
            $this->db->from('geopos_invoices');
            $this->db->where('geopos_invoices.status!=', 'paid');
            $this->db->join('geopos_customers', 'geopos_customers.id = geopos_invoices.csd', 'left');
            //$this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
            // $this->db->join('customer_coat_size','geopos_customers.id = customer_coat_size.cus_id','left');
            // $this->db->join('customer_pant_size','geopos_customers.id = customer_pant_size.cus_id','left');
            // $this->db->join('customer_kmz_shl','geopos_customers.id = customer_kmz_shl.cus_id','left');
            // $this->db->where('customer_basic_info.reference_id is NOT NULL', NULL, FALSE);
            
            // if ($this->aauth->get_user()->loc) {
            //     $this->db->where('geopos_customers.loc', $this->aauth->get_user()->loc);
            // } elseif (!BDATA) {
            //     $this->db->where('geopos_customers.loc', 0);
            // } 

            if ($id != '') {
                $this->db->where('geopos_customers.gid', $id);
            }
            $this->db->group_by('geopos_invoices.csd');
            $this->db->order_by('total', 'desc');

        } else {
            $this->db->from($this->table);
            $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id');
		    $this->db->group_by('customer_basic_info.reference_id', 'desc');
            
            // if ($this->aauth->get_user()->loc) {
            //     $this->db->where('loc', $this->aauth->get_user()->loc);
            // } elseif (!BDATA) {
            //     $this->db->where('loc', 0);
            // }

            if ($id != '') {
                $this->db->where('gid', $id);
            }

        }
        $i = 0;
        if($due){
            foreach ($this->column_due_search as $item) // loop column
            {
                $search = $this->input->post('search');
                $value = $search['value'];
                if ($value) // if datatable send POST for search
                {

                    if ($i === 0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $value);
                    } else {
                        $this->db->or_like($item, $value);
                    }

                    if (count($this->column_due_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
        }else{
            foreach ($this->column_search as $item) // loop column
            {
                $search = $this->input->post('search');
                $value = $search['value'];
                if ($value) // if datatable send POST for search
                {

                    if ($i === 0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $value);
                    } else {
                        $this->db->or_like($item, $value);
                    }

                    if (count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
        }
        // $search = $this->input->post('order');
        // if ($search) // here order processing
        // {
        //     $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        // } else if (isset($this->order)) {
        //     $order = $this->order;
        //     $this->db->order_by(key($order), $order[key($order)]);
        // }
        $this->db->order_by('geopos_customers.id','desc');
    }

    function get_sum_due()
    {
        $this->db->select('SUM(geopos_invoices.total) AS total,SUM(geopos_invoices.pamnt) AS pamnt');
        $this->db->from('geopos_invoices');
        $this->db->where('geopos_invoices.status !=', 'paid');
        $this->db->join('geopos_customers', 'geopos_customers.id = geopos_invoices.csd', 'left');
        $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
        $this->db->where('customer_basic_info.reference_id is NOT NULL', NULL, FALSE);
        $query = $this->db->get()->row_array();
        //echo '<pre>'; print_r($this->db->last_query()); exit; 
        return $query;
    }

    function get_datatables($id = '')
    {
        $this->_get_datatables_query($id);
        // if ($this->aauth->get_user()->loc) {
        //     $this->db->where('loc', $this->aauth->get_user()->loc);
        // }
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        //echo '<pre>'; print_r($this->db->last_query()); exit;
        return $query->result();
    }

    function count_filtered($id = '')
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        if ($id != '') {
            $this->db->where('gid', $id);
        }
        // if ($this->aauth->get_user()->loc) {
        //     $this->db->where('loc', $this->aauth->get_user()->loc);
        // }
        return $query->num_rows($id = '');
    }

    public function count_all($id = '')
    {
        $this->_get_datatables_query();
        // if ($this->aauth->get_user()->loc) {
        //     $this->db->where('loc', $this->aauth->get_user()->loc);
        // }
        if ($id != '') {
            $this->db->where('gid', $id);
        }
        $query = $this->db->get();
        return $query->num_rows($id = '');
    }

    public function details_old($custid)
    {
        $this->db->from($this->table);
        //$this->db->join('users', 'users.cid=geopos_customers.id', 'left');
        $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
        $this->db->join('customer_coat_size','customer_basic_info.basic_info_id = customer_coat_size.cus_id','left');
        $this->db->join('customer_pant_size','customer_basic_info.basic_info_id = customer_pant_size.cus_id','left');
        $this->db->join('customer_kmz_shl','customer_basic_info.basic_info_id = customer_kmz_shl.cus_id','left');
        $this->db->join('geopos_invoices', 'geopos_customers.id = geopos_invoices.csd', 'left');
        $this->db->group_by('geopos_invoices.csd');
        $this->db->order_by('geopos_invoices.id', 'desc');
        $this->db->where('geopos_customers.id', $custid);

        // if ($this->aauth->get_user()->loc) {
        //     $this->db->where('geopos_customers.loc', $this->aauth->get_user()->loc);
        // } elseif (!BDATA) {
        //     $this->db->where('geopos_customers.loc', 0);
        // }
        
        
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->row_array();
    }
    
    public function details($custid)
    {
        $this->db->select('geopos_customers.*, customer_basic_info.*, customer_coat_size.*, customer_pant_size.*, customer_kmz_shl.*, customer_coat_size.cus_basic_id as coat_basic_id, customer_kmz_shl.cus_basic_id as kmz_basic_id');
        $this->db->from($this->table);
        $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
        $this->db->join('customer_coat_size','customer_basic_info.basic_info_id = customer_coat_size.cus_basic_id','left');
        $this->db->join('customer_pant_size','customer_basic_info.basic_info_id = customer_pant_size.cus_basic_id','left');
        $this->db->join('customer_kmz_shl','customer_basic_info.basic_info_id = customer_kmz_shl.cus_basic_id','left');
        $this->db->where('geopos_customers.id', $custid);
        $query = $this->db->get();
        //print_r($this->db->last_query());exit;
        return $query->result_array();
    }

    public function details_old_cus($custid)
    {
        $this->db->select('geopos_customers.*, customer_basic_info.*, customer_coat_size.*, customer_pant_size.*, customer_kmz_shl.*, customer_coat_size.cus_basic_id as coat_basic_id, customer_kmz_shl.cus_basic_id as kmz_basic_id');
        $this->db->from($this->table);
        $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
        $this->db->join('customer_coat_size','customer_basic_info.cus_id = customer_coat_size.cus_id','left');
        $this->db->join('customer_pant_size','customer_basic_info.cus_id = customer_pant_size.cus_id','left');
        $this->db->join('customer_kmz_shl','customer_basic_info.cus_id = customer_kmz_shl.cus_id','left');
        $this->db->where('geopos_customers.id', $custid);
        $query = $this->db->get();
        //print_r($this->db->last_query());exit;
        return $query->result_array();
    }

    public function stDetails($tid)
    {
        $this->db->from($this->table);
        //$this->db->join('users', 'users.cid=geopos_customers.id', 'left');
        $this->db->join('customer_basic_info','geopos_customers.id = customer_basic_info.cus_id','left');
        $this->db->join('customer_coat_size','geopos_customers.id = customer_coat_size.cus_id','left');
        $this->db->join('customer_pant_size','geopos_customers.id = customer_pant_size.cus_id','left');
        $this->db->join('customer_kmz_shl','geopos_customers.id = customer_kmz_shl.cus_id','left');
        $this->db->join('geopos_invoices', 'geopos_customers.id = geopos_invoices.csd', 'left');
        $this->db->where('geopos_invoices.id', $tid);

        if ($this->aauth->get_user()->loc) {
            $this->db->where('geopos_customers.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('geopos_customers.loc', 0);
        }
        $query = $this->db->get();
        return $query->row_array();
    }

    public function money_details($custid)
    {

        $this->db->select('SUM(debit) AS debit,SUM(credit) AS credit');
        $this->db->from('geopos_transactions');
        $this->db->where('payerid', $custid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function due_details($custid)
    {

        $this->db->select('SUM(total) AS total,SUM(pamnt) AS pamnt,SUM(discount) AS discount,');
        $this->db->from('geopos_invoices');
        $this->db->where('csd', $custid);
        $query = $this->db->get();
        return $query->row_array();
    }

    /*last Record*/
    public function last_record(){
        $last_row= $this->db->select('reference_id')->from('customer_basic_info')->order_by('reference_id',"desc")->limit(1)->get();
        
        if ($last_row->num_rows() == 0) {
            return $last_row->reference_id = 0;
        }
        $last_row = $last_row->row();
        return $last_row->reference_id;
    }


    public function add($name, $company, $phone, $email, $address, $city, $region, $country, $postbox, $customergroup, $taxid, $name_s, $phone_s, $email_s, $address_s, $city_s, $region_s, $country_s, $postbox_s, $language = '', $create_login = true, $password = '', $docid = '', $custom = '', $discount = 0)
    {
        $this->db->select('email');
        $this->db->from('geopos_customers');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $valid = $query->row_array();
        if (!$valid['email']) {


            if (!$discount) {
                $this->db->select('disc_rate');
                $this->db->from('geopos_cust_group');
                $this->db->where('id', $customergroup);
                $query = $this->db->get();
                $result = $query->row_array();
                $discount = $result['disc_rate'];
            }


            $data = array(
                'name' => $name,
                'company' => $company,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'region' => $region,
                'country' => $country,
                'postbox' => $postbox,
                'gid' => $customergroup,
                'taxid' => $taxid,
                'name_s' => $name_s,
                'phone_s' => $phone_s,
                'email_s' => $email_s,
                'address_s' => $address_s,
                'city_s' => $city_s,
                'region_s' => $region_s,
                'country_s' => $country_s,
                'postbox_s' => $postbox_s,
                'docid' => $docid,
                'custom1' => $custom,
                'discount_c' => $discount
            );


            if ($this->aauth->get_user()->loc) {
                $data['loc'] = $this->aauth->get_user()->loc;
            }

            if ($this->db->insert('geopos_customers', $data)) {
                $cid = $this->db->insert_id();
                $p_string = '';
                $temp_password = '';
                if ($create_login) {

                    if ($password) {
                        $temp_password = $password;
                    } else {
                        $temp_password = rand(200000, 999999);
                    }

                    $pass = password_hash($temp_password, PASSWORD_DEFAULT);
                    $data = array(
                        'user_id' => 1,
                        'status' => 'active',
                        'is_deleted' => 0,
                        'name' => $name,
                        'password' => $pass,
                        'email' => $email,
                        'user_type' => 'Member',
                        'cid' => $cid,
                        'lang' => $language
                    );

                    $this->db->insert('users', $data);
                    $p_string = ' Temporary Password is ' . $temp_password . ' ';
                }
                $this->aauth->applog("[Client Added] $name ID " . $cid, $this->aauth->get_user()->username);
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . $p_string . '&nbsp;<a href="' . base_url('customers/view?id=' . $cid) . '" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $cid, 'pass' => $temp_password));

                $this->custom->save_fields_data($cid, 1);

                $this->db->select('other');
                $this->db->from('univarsal_api');
                $this->db->where('id', 64);
                $query = $this->db->get();
                $othe = $query->row_array();

                if ($othe['other']) {
                    $auto_mail = $this->send_mail_auto($email, $name, $temp_password);
                    $this->load->model('communication_model');
                    $attachmenttrue = false;
                    $attachment = '';
                    $this->communication_model->send_corn_email($email, $name, $auto_mail['subject'], $auto_mail['message'], $attachmenttrue, $attachment);
                }

            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                'Duplicate Email'));
        }

    }

    public function oldData($ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation){
        
        $data = array(
            'name' => $name,
            'gid' => 3,
            'phone'=>$mobile
        );

         if ($this->db->insert('geopos_customers', $data)) {

                $cid = $this->db->insert_id();

                /*add customer basic info*/
                $data = array(
                    'cus_id'=>$cid,
                    'reference_id'=>$ref_no,
                    'booking_date' => $book_date,
                    'trial_date'=>$t_date,
                    'd_date' => $d_date,
                    'instrucations' => $instrucation
                );

                $this->db->insert('customer_basic_info',$data);

                /*Add pant size*/
                $data = array(
                    'cus_id' => $cid,
                    'coat_length' => $cLength,
                    'coat_sleeves' => $cSleeves,
                    'coat_shoulder' => $cShoulder,
                    'coat_half_back' => $cHalfBack,
                    'coat_cross_back' => $cCrossBack,
                    'coat_chest' => $cChest,
                    'coat_waist' => $cWaist,
                    'is_coat' => $is_coat,
                    'is_waist_coat' => $is_wCoat

                );

                $this->db->insert('customer_coat_size',$data);

                /*add pant size*/
                $data = array(
                    'cus_id' => $cid,
                    'pant_length' => $pLength,
                    'pant_inside_length' => $pInLength,
                    'pant_waist' => $pWaist,
                    'pant_hip' => $pHip,
                    'pant_thigh' => $pThigh,
                    'pant_bottom' => $pBottom,
                    'pant_knee' => $pKnee

                );

                $this->db->insert('customer_pant_size',$data);

                /*Add kamiz shalwar size*/
                 /*add pant size*/
                $data = array(
                    'cus_id' => $cid,
                    'kmz_length' => $kmzLength,
                    'kmz_sleeves' => $kmzSleeves,
                    'kmz_shoulder' => $kmzShoulder,
                    'kmz_neck' => $kmzNeck,
                    'kmz_chest' => $kmzChest,
                    'kmz_waist' => $kmzWaist,
                    'kmz_guaira' => $kmzGuaira,
                    'is_kmz' => $is_kmz,
                    'is_shirt' => $is_shirt,
                    'shl_length' => $shlLength,
                    'shl_bottom' => $shlBottom,
                    'shl_asantyar' =>$shlAsanTyar,
                    'shl_gairatyar' =>$shlGairaTyar


                );

                $this->db->insert('customer_kmz_shl',$data);
        }
    }
    /**
     * To Add Customer Data
     * @param String $vName
     * @param String $vMobile
     * @return int
     */
    public function fAddCustomer($vName="Default Customer",$vMobile=NULL){
        $vCustData = array(
            'name' => $vName,
            'gid' => 3,
            'phone'=>$vMobile
        );
        $this->db->insert('geopos_customers', $vCustData);
        if ($this->db->insert_id()) 
               return $this->db->insert_id();
         else
               return 0;
    }
    public function tailoringCustomerAdd($vCustomerID,$ref_no, $basic_info_id, $book_date,$t_date,$d_date,$is_suiting,$is_shirts,$is_shalwarqameez,$is_english,$is_urdu,
    $cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$cBicep,$cForearm,$cNeck,$cLength,$p3_waistcoat_length,$waistcoat_length,
    $princecoat_length,$sherwani_length,$longcoat_length,$chester_length, $armhole,            
    $pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,                
    $is_breasted,$is_double_breasted,$is_button_suit,$is_two_button_suit,$is_lapel,$is_peak_lapel,$is_shawl_lapel,$is_wear,$is_casual_wear,$is_groom_wear,$is_vent,$is_double_vent,$is_no_vent,$is_lined,$is_half_lined,$is_ticket,$is_slant,$is_regular,$is_button,$is_metalic_button,

    $shirtLength,$shirtShoulder,$shirtSleeves,$shirtNeck,$shirtChest,$shirtWaist,$shirtHips,
    $shirtBicep,$shirtForearm,$shirtarmhole,$shirtcuff,

    $kmzLength,$kurtaLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$kmzHips,$kmzBicep,$kmzForearm,$kmzarmhole,$kmzcuff,
    
    $is_darts,$is_sleeve_placket,$is_front_placket,$is_plane_placket,$is_shirt_cuff,$is_plain_cuff,$is_french_cuff,
    $is_double_cuff,$is_shirt_collar,$is_shirt_collar_type,$shirt_collar_ins,
    
    $shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$pjamaLength,$pjamaBottom,
    $is_collar,$is_moon_neck,$is_straight_front,$is_1side_pocket,$is_2side_pocket,$is_fancy_button,
    $is_band,$is_round_front,$is_front_pocket,$is_shalwar_pocket,$is_covered_fly,
    $is_plain_button,$is_open_sleeves,$is_button_cuff,$is_design,$is_kanta,$is_stitch,$is_thread,$is_bookrum,
    $collar_ins, $front_pocket_ins,$shalwar_pocket_ins,$instrucation,$shirt_inst,$shalwar_inst,$ptype,$coupon,$notes,

    $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount,$old_customer_id ){

                /*add customer basic info*/
                $data = array(
                    'cus_id'=>$vCustomerID,
                    'reference_id'=>$ref_no,
                    'booking_date' => $book_date,
                    'trial_date'=>$t_date,
                    'd_date' => $d_date,
                    'instrucations' => $instrucation,
                    'shirt_inst' => $shirt_inst,
                    'shalwar_inst' => $shalwar_inst,
                    'is_suiting' => $is_suiting,
                    'is_shirts' => $is_shirts,
                    'is_shalwarqameez' => $is_shalwarqameez, 
                    'is_english' => $is_english,
                    'is_urdu' => $is_urdu
                );
                $this->db->insert('customer_basic_info',$data);
                $BasicID=$this->db->insert_id();
                
                /*Add pant size*/
                $data = array(
                    'cus_id' => $vCustomerID,
                    'cus_basic_id' => $BasicID,
                    'coat_sleeves' => $cSleeves,
                    'coat_shoulder' => $cShoulder,
                    'coat_half_back' => $cHalfBack,
                    'coat_cross_back' => $cCrossBack,
                    'coat_chest' => $cChest,
                    'coat_waist' => $cWaist,
                    'coat_hip' => $cHips,
                    'coat_bicep' => $cBicep,
                    'coat_forearm' => $cForearm,
                    'coat_neck' => $cNeck,
                    'coat_length' => $cLength,
                    'p3_waistcoat_length' => $p3_waistcoat_length,
                    'waistcoat_length' => $waistcoat_length,
                    'princecoat_length' => $princecoat_length,
                    'sherwani_length' => $sherwani_length,
                    'longcoat_length' => $longcoat_length,
                    'chester_length' => $chester_length,
                    'armhole' => $armhole,
                    'is_breasted' => $is_breasted,
                    'is_double_breasted' => $is_double_breasted,
                    'is_button_suit' => $is_button_suit,
                    'is_two_button_suit' => $is_two_button_suit,
                    'is_lapel' => $is_lapel,
                    'is_peak_lapel' => $is_peak_lapel,
                    'is_shawl_lapel' => $is_shawl_lapel,
                    'is_wear' => $is_wear,
                    'is_casual_wear' => $is_casual_wear,
                    'is_groom_wear' => $is_groom_wear,
                    'is_vent' => $is_vent,
                    'is_double_vent' => $is_double_vent,
                    'is_no_vent' => $is_no_vent,
                    'is_lined' => $is_lined,
                    'is_half_lined' => $is_half_lined,
                    'is_ticket' => $is_ticket,
                    'is_slant' => $is_slant,
                    'is_regular' => $is_regular,
                    'is_button' => $is_button,                   
                    'is_metalic_button' => $is_metalic_button                    
                ); 
                if($is_suiting)
                $this->db->insert('customer_coat_size',$data);
                       
                    

                /*add pant size*/
                $data = array(
                    'cus_id' => $vCustomerID,
                    'cus_basic_id' => $BasicID,
                    'pant_length' => $pLength,
                    'pant_inside_length' => $pInLength,
                    'pant_waist' => $pWaist,
                    'pant_hip' => $pHip,
                    'pant_thigh' => $pThigh,
                    'pant_bottom' => $pBottom,
                    'pant_knee' => $pKnee
                );
                if($is_suiting)
                $this->db->insert('customer_pant_size',$data);
                        



                /*Add kamiz shalwar size*/
                 /*add pant size*/
                $data = array(
                    'cus_id' => $vCustomerID,
                    'cus_basic_id' => $BasicID,
                    'shirtLength' => $shirtLength,
                    'shirtShoulder' => $shirtShoulder,
                    'shirtSleeves' => $shirtSleeves,
                    'shirtNeck' => $shirtNeck,
                    'shirtChest' => $shirtChest,
                    'shirtWaist' => $shirtWaist,
                    'shirtHips' => $shirtHips,
                    'shirtBicep' => $shirtBicep,
                    'shirtForearm' => $shirtForearm,
                    'shirtarmhole' => $shirtarmhole,
                    'shirtcuff' => $shirtcuff,
                    'kmz_length' => $kmzLength,
                    'kurtaLength' => $kurtaLength,
                    'kmz_sleeves' => $kmzSleeves,
                    'kmz_shoulder' => $kmzShoulder,
                    'kmz_neck' => $kmzNeck,
                    'kmz_chest' => $kmzChest,
                    'kmz_waist' => $kmzWaist, 
                    'kmz_hip' => $kmzHips,
                    'kmz_bicep' => $kmzBicep,
                    'kmz_forearm' => $kmzForearm,
                    'kmzarmhole' => $kmzarmhole,
                    'kmzcuff' => $kmzcuff,
                    'is_darts' => $is_darts,
                    'is_sleeve_placket' => $is_sleeve_placket,
                    'is_front_placket' => $is_front_placket,
                    'is_plane_placket' => $is_plane_placket,
                    'is_button_cuff' => $is_button_cuff,
                    'is_plain_cuff' => $is_plain_cuff,
                    'is_french_cuff' => $is_french_cuff,
                    'is_double_cuff' => $is_double_cuff,
                    'shl_length' => $shlLength,
                    'shl_bottom' => $shlBottom,
                    'shl_asantyar'=>$shlAsanTyar,
                    'shl_gairatyar' =>$shlGairaTyar,
                    'pjamaLength' =>$pjamaLength,
                    'pjamaBottom' =>$pjamaBottom,
                    'is_collar' => $is_collar,
                    'is_moon_neck' => $is_moon_neck,
                    'is_straight_front' => $is_straight_front,
                    'is_1side_pocket' => $is_1side_pocket,
                    'is_2side_pocket' => $is_2side_pocket,
                    'is_fancy_button' => $is_fancy_button,
                    'is_band' => $is_band,
                    'is_round_front' => $is_round_front,
                    'is_front_pocket' => $is_front_pocket,
                    'is_shalwar_pocket' => $is_shalwar_pocket,
                    'is_covered_fly' => $is_covered_fly,
                    'is_plain_button' => $is_plain_button,
                    'is_open_sleeves' => $is_open_sleeves,
                    'is_shirt_cuff' => $is_shirt_cuff,
                    'is_shirt_collar' => $is_shirt_collar,
                    'is_shirt_collar_type' => $is_shirt_collar_type,
                    'shirt_collar_ins' => $shirt_collar_ins,
                    'is_design' => $is_design,
                    'is_kanta' => $is_kanta,
                    'is_stitch' => $is_stitch,
                    'is_thread' => $is_thread,
                    'is_bookrum' => $is_bookrum,
                    'collar_ins' => $collar_ins,
                    'front_pocket_ins' => $front_pocket_ins,
                    'shalwar_pocket_ins' => $shalwar_pocket_ins
                );
                 if($is_shalwarqameez || $is_shirts)
                $this->db->insert('customer_kmz_shl',$data);

                
                if($basic_info_id == 0 && $old_customer_id == 0){
                    $data = array('tid' => $invocieno, 'invoicedate' => $invoicedate,
                        'invoiceduedate' => $invocieduedate, 'subtotal' => $total, 
                        'shipping' => "", 'ship_tax' => "", 'ship_tax_type' => "", 
                        'discount_rate' => "",'total' => $total, 'pmethod' => "Cash", 
                        'notes' => $notes, 'status' => $status, 'csd' => $vCustomerID,
                        'cus_basic_id' => $BasicID, 
                        'eid' => $this->aauth->get_user()->id, 'pamnt' => $pamnt, 
                        'taxstatus' =>"", 'discstatus' => "", 'format_discount' => "", 
                        'refer' => "", 'term' => "", 'multi' => "", 'i_class' => 1, 'loc' => $this->aauth->get_user()->loc);

                    $this->db->insert('geopos_invoices', $data);

                    $invoiceno = $this->db->insert_id();
                }else{
                    $this->db->select('id');
                    $this->db->where('csd', $old_customer_id);
                    $this->db->order_by('id', 'desc');
                    $invoice_result = $this->db->get('geopos_invoices')->row_array(); 
                    
                    $data = array('csd' => $vCustomerID);
                    $invoiceno = $invoice_result['id'];
                    $this->db->set($data);
                    $this->db->where('csd', $old_customer_id);
                    $this->db->update('geopos_invoices');
                }

                if($is_suiting){
                    $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id' => $vCustomerID,
                        'cus_basic_id' => $BasicID, 
                        'product' => "Suiting",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Coat Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }
                if($is_shalwarqameez){
                    $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id' => $vCustomerID,
                        'cus_basic_id' => $BasicID,
                        'product' => "kameez shalwar",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'kameez shalwar Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }
                if($is_shirts){
                     $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id' => $vCustomerID,
                        'cus_basic_id' => $BasicID,
                        'product' => "Shirt",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Shirt Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }

                return true;
   }
   
    public function addNew($id,$ref_no,$book_date,$t_date,$d_date,$name,$mobile,$is_suiting,$is_shirts,$is_shalwarqameez, 
            $is_english,$is_urdu,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$cBicep,$cForearm,$cNeck,$cLength,
            $p3_waistcoat_length,$waistcoat_length,$princecoat_length,$sherwani_length,$longcoat_length,$chester_length,
            $armhole,            
            $pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,
            $is_breasted,$is_double_breasted,$is_button_suit,$is_two_button_suit,$is_lapel,$is_peak_lapel,$is_shawl_lapel,$is_wear,$is_casual_wear,$is_groom_wear,$is_vent,$is_double_vent,$is_no_vent,$is_lined,$is_half_lined,$is_ticket,$is_slant,$is_regular,$is_button,$is_metalic_button,
            $shirtLength,$shirtShoulder,$shirtSleeves,$shirtNeck,$shirtChest,$shirtWaist,$shirtHips,
            $shirtBicep,$shirtForearm,$shirtarmhole,$shirtcuff,$kmzLength,$kurtaLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$kmzHips,$kmzBicep,$kmzForearm,$kmzarmhole,$kmzcuff,
            $is_darts,$is_sleeve_placket,$is_front_placket,$is_plane_placket,$is_button_cuff,$is_plain_cuff,$is_french_cuff,$is_double_cuff,
            $shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$pjamaLength,$pjamaBottom,
            $is_collar,$is_moon_neck,$is_straight_front,$is_1side_pocket,$is_2side_pocket,$is_fancy_button,
            $is_band,$is_round_front,$is_front_pocket,$is_shalwar_pocket,$is_covered_fly,
            $is_plain_button,$is_open_sleeves,$instrucation,$shirt_inst,$shalwar_inst,$ptype,$coupon,$notes,
        $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount){
        $data = array(
            'name' => $name,
            'gid' => 3,
            'phone'=>$mobile
        );

        $this->db->set($data);
        $this->db->where('id', $id);

         if ($this->db->update('geopos_customers')) {

                $cid = $this->db->insert_id();

                /*add customer basic info*/
                $data = array(
                    'reference_id'=>$ref_no,
                    'booking_date' => $book_date,
                    'trial_date'=>$t_date,
                    'd_date' => $d_date,
                    'instrucations' => $instrucation,
                    'shirt_inst' => $shirt_inst,
                    'shalwar_inst' => $shalwar_inst,
                    'is_suiting' => $is_suiting,
                    'is_shirts' => $is_shirts,
                    'is_shalwarqameez' => $is_shalwarqameez,
                    'is_english' => $is_english,
                    'is_urdu' => $is_urdu
                );

                $this->db->set($data);
                $this->db->where('cus_id', $id);
                $this->db->update('customer_basic_info');

                /*Add pant size*/
                $data = array(
                    'coat_sleeves' => $cSleeves,
                    'coat_shoulder' => $cShoulder,
                    'coat_half_back' => $cHalfBack,
                    'coat_cross_back' => $cCrossBack,
                    'coat_chest' => $cChest,
                    'coat_waist' => $cWaist,
                    'coat_hip' => $cHips,
                    'coat_bicep' => $cBicep,
                    'coat_forearm' => $cForearm,
                    'coat_neck' => $cNeck,
                    'coat_length' => $cLength,
                    'p3_waistcoat_length' => $p3_waistcoat_length,
                    'waistcoat_length' => $waistcoat_length,
                    'princecoat_length' => $princecoat_length,
                    'sherwani_length' => $sherwani_length,
                    'longcoat_length' => $longcoat_length,
                    'chester_length' => $chester_length,
                    'armhole' => $armhole,
                    'is_breasted' => $is_breasted,
                    'is_double_breasted' => $is_double_breasted,
                    'is_button_suit' => $is_button_suit,
                    'is_two_button_suit' => $is_two_button_suit,
                    'is_lapel' => $is_lapel,
                    'is_peak_lapel' => $is_peak_lapel,
                    'is_shawl_lapel' => $is_shawl_lapel,
                    'is_wear' => $is_wear,
                    'is_casual_wear' => $is_casual_wear,
                    'is_groom_wear' => $is_groom_wear,
                    'is_vent' => $is_vent,
                    'is_double_vent' => $is_double_vent,
                    'is_no_vent' => $is_no_vent,
                    'is_lined' => $is_lined,
                    'is_half_lined' => $is_half_lined,
                    'is_ticket' => $is_ticket,
                    'is_slant' => $is_slant,
                    'is_regular' => $is_regular,
                    'is_button' => $is_button,                   
                    'is_metalic_button' => $is_metalic_button 
                );

                
                $this->db->set($data);
                $this->db->where('cus_id', $id);
                $this->db->update('customer_coat_size');

                /*add pant size*/
                $data = array(
                    'pant_length' => $pLength,
                    'pant_inside_length' => $pInLength,
                    'pant_waist' => $pWaist,
                    'pant_hip' => $pHip,
                    'pant_thigh' => $pThigh,
                    'pant_bottom' => $pBottom,
                    'pant_knee' => $pKnee

                );

                $this->db->set($data);
                $this->db->where('cus_id', $id);
                $this->db->update('customer_pant_size');


                /*Add kamiz shalwar size*/
                 /*add pant size*/
                $data = array(
                    'shirtLength' => $shirtLength,
                    'shirtShoulder' => $shirtShoulder,
                    'shirtSleeves' => $shirtSleeves,
                    'shirtNeck' => $shirtNeck,
                    'shirtChest' => $shirtChest,
                    'shirtWaist' => $shirtWaist,
                    'shirtHips' => $shirtHips,
                    'shirtBicep' => $shirtBicep,
                    'shirtForearm' => $shirtForearm,
                    'shirtarmhole' => $shirtarmhole,
                    'shirtcuff' => $shirtcuff,
                    'kmz_length' => $kmzLength,
                    'kurtaLength' => $kurtaLength,
                    'kmz_sleeves' => $kmzSleeves,
                    'kmz_shoulder' => $kmzShoulder,
                    'kmz_neck' => $kmzNeck,
                    'kmz_chest' => $kmzChest,
                    'kmz_waist' => $kmzWaist, 
                    'kmz_hip' => $kmzHips,
                    'kmz_bicep' => $kmzBicep,
                    'kmz_forearm' => $kmzForearm,
                    'kmzarmhole' => $kmzarmhole,
                    'kmzcuff' => $kmzcuff,
                    'is_darts' => $is_darts,
                    'is_sleeve_placket' => $is_sleeve_placket,
                    'is_front_placket' => $is_front_placket,
                    'is_plane_placket' => $is_plane_placket,
                    'is_button_cuff' => $is_button_cuff,
                    'is_plain_cuff' => $is_plain_cuff,
                    'is_french_cuff' => $is_french_cuff,
                    'is_double_cuff' => $is_double_cuff,
                    'shl_length' => $shlLength,
                    'shl_bottom' => $shlBottom,
                    'shl_asantyar'=>$shlAsanTyar,
                    'shl_gairatyar' =>$shlGairaTyar,
                    'pjamaLength' =>$pjamaLength,
                    'pjamaBottom' =>$pjamaBottom,
                    'is_collar' => $is_collar,
                    'is_moon_neck' => $is_moon_neck,
                    'is_straight_front' => $is_straight_front,
                    'is_1side_pocket' => $is_1side_pocket,
                    'is_2side_pocket' => $is_2side_pocket,
                    'is_fancy_button' => $is_fancy_button,
                    'is_band' => $is_band,
                    'is_round_front' => $is_round_front,
                    'is_front_pocket' => $is_front_pocket,
                    'is_shalwar_pocket' => $is_shalwar_pocket,
                    'is_covered_fly' => $is_covered_fly,
                    'is_plain_button' => $is_plain_button,
                    'is_open_sleeves' => $is_open_sleeves

                );

                $this->db->set($data);
                $this->db->where('cus_id', $id);
                $this->db->update('customer_kmz_shl');

                $data = array('tid' => $invocieno, 'invoicedate' => $invoicedate, 'invoiceduedate' => $invocieduedate, 'subtotal' => $total, 'shipping' => "", 'ship_tax' => "", 'ship_tax_type' => "", 'discount_rate' => "",'total' => $total, 'pmethod' => "Cash", 'notes' => $notes, 'status' => $status, 'csd' => $id, 'eid' => $this->aauth->get_user()->id, 'pamnt' => $pamnt, 'taxstatus' =>"", 'discstatus' => "", 'format_discount' => "", 'refer' => "", 'term' => "", 'multi' => "", 'i_class' => 1, 'loc' => $this->aauth->get_user()->loc);

                $this->db->insert('geopos_invoices', $data);

                $invoiceno = $this->db->insert_id();


                if($is_suiting){
                    $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id'=> $id,
                        'product' => "Suiting",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Coat Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }
                if($is_shalwarqameez){
                    $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id'=> $id,
                        'product' => "kameez shalwar",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'kameez shalwar Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }
                if($is_shirts){
                     $data = array(
                        'invoice_id' => $invoiceno,
                        'cus_id'=> $id,
                        'product' => "Shirt",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Shirt Stitching'

                    );

                    $this->db->insert('geopos_stiching_items',$data);
                }
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED'). '&nbsp;<a href="' . base_url('/customers') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $cid));
         }
         else{
             echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
         }

    }


    public function editNap($id,$ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation,$ptype,$coupon,$notes,
        $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount,$csd){

        $data = array(
            'name' => $name,
            'gid' => 3,
            'phone'=>$mobile
        );

        $this->db->set($data);
        $this->db->where('id', $csd);

         if ($this->db->update('geopos_customers')) {

                $cid = $csd;

                /*add customer basic info*/
                $data = array(
                    'reference_id'=>$ref_no,
                    'booking_date' => $book_date,
                    'trial_date'=>$t_date,
                    'd_date' => $d_date,
                    'instrucations' => $instrucation
                );

                $this->db->set($data);
                $this->db->where('cus_id', $csd);
                $this->db->update('customer_basic_info');

                /*Add pant size*/
                $data = array(
                    'coat_length' => $cLength,
                    'coat_sleeves' => $cSleeves,
                    'coat_shoulder' => $cShoulder,
                    'coat_half_back' => $cHalfBack,
                    'coat_cross_back' => $cCrossBack,
                    'coat_chest' => $cChest,
                    'coat_waist' => $cWaist,
                    'coat_hip' => $cHips,
                    'is_coat' => $is_coat,
                    'is_waist_coat' => $is_wCoat

                );

                $this->db->set($data);
                $this->db->where('cus_id', $csd);
                $this->db->update('customer_coat_size');

                /*add pant size*/
                $data = array(
                    'pant_length' => $pLength,
                    'pant_inside_length' => $pInLength,
                    'pant_waist' => $pWaist,
                    'pant_hip' => $pHip,
                    'pant_thigh' => $pThigh,
                    'pant_bottom' => $pBottom,
                    'pant_knee' => $pKnee

                );

                $this->db->set($data);
                $this->db->where('cus_id', $csd);
                $this->db->update('customer_pant_size');


                /*Add kamiz shalwar size*/
                 /*update pant size*/
                $data = array(
                    'kmz_length' => $kmzLength,
                    'kmz_sleeves' => $kmzSleeves,
                    'kmz_shoulder' => $kmzShoulder,
                    'kmz_neck' => $kmzNeck,
                    'kmz_chest' => $kmzChest,
                    'kmz_waist' => $kmzWaist,
                    'kmz_guaira' => $kmzGuaira,
                    'is_kmz' => $is_kmz,
                    'is_shirt' => $is_shirt,
                    'shl_length' => $shlLength,
                    'shl_bottom' => $shlBottom,
                    'shl_asantyar' => $shlAsanTyar,
                    'shl_gairatyar' =>$shlGairaTyar

                );
                $this->db->set($data);
                $this->db->where('cus_id', $csd);
                $this->db->update('customer_kmz_shl');


                if($is_coat){
                    $data = array(
                        'invoice_id' => $id,
                        'product' => "Coat",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Coat Stitching'

                    );

                    $this->db->set($data);
                    $this->db->where('invoice_id', $id);
                    $this->db->update('geopos_stiching_items');
                }
                if($is_wCoat){
                    $data = array(
                        'invoice_id' => $id,
                        'product' => "Waist Coat",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Waist Coat Stitching'

                    );

                    $this->db->set($data);
                    $this->db->where('invoice_id', $id);
                    $this->db->update('geopos_stiching_items');
                }
                if($is_kmz){
                    $data = array(
                        'invoice_id' => $id,
                        'product' => "kameez shalwar",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'kameez shalwar Stitching'

                    );

                    $this->db->set($data);
                    $this->db->where('invoice_id', $id);
                    $this->db->update('geopos_stiching_items');
                }
                if($is_shirt){
                     $data = array(
                        'invoice_id' => $id,
                        'product' => "Shirt",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Shirt Stitching'

                    );

                    $this->db->set($data);
                    $this->db->where('invoice_id', $csd);
                    $this->db->update('geopos_stiching_items');
                }
                
                if($this->input->post('pLength')){
                    $data = array(
                        'invoice_id' => $id,
                        'product' => "Pant",
                        'quantity' => 1,
                        'stiching_price' => $total,
                        'stiching_sub_total' => $total,
                        'product_descr' => 'Pant Stitching'

                    );

                    $this->db->set($data);
                    $this->db->where('invoice_id', $id);
                    $this->db->update('geopos_stiching_items');
                }

                $data = array('invoicedate' => $invoicedate, 'invoiceduedate' => $invocieduedate, 'subtotal' => $total, 'shipping' => "", 'ship_tax' => "", 'ship_tax_type' => "", 'discount_rate' => "",'total' => $total, 'pmethod' => "Cash", 'notes' => $notes, 'status' => $status, 'csd' => $cid, 'eid' => $this->aauth->get_user()->id, 'pamnt' => $pamnt, 'taxstatus' =>"", 'discstatus' => "", 'format_discount' => "", 'refer' => "", 'term' => "", 'multi' => "", 'i_class' => 1, 'loc' => $this->aauth->get_user()->loc);

                
                $this->db->set($data);
                $this->db->where('id', $id);
                $this->db->update('geopos_invoices');

                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED'). '&nbsp;<a href="' . base_url('/customers').'" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $cid));
         }
         else{
             echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('ERROR')));
         }
    }

    public function edit($id, $name, $company, $phone, $email, $address, $city, $region, $country, $postbox, $customergroup, $taxid, $name_s, $phone_s, $email_s, $address_s, $city_s, $region_s, $country_s, $postbox_s, $docid = '', $custom = '', $language = '', $discount = 0)
    {
        $data = array(
            'name' => $name,
            'company' => $company,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'gid' => $customergroup,
            'taxid' => $taxid,
            'name_s' => $name_s,
            'phone_s' => $phone_s,
            'email_s' => $email_s,
            'address_s' => $address_s,
            'city_s' => $city_s,
            'region_s' => $region_s,
            'country_s' => $country_s,
            'postbox_s' => $postbox_s,
            'docid' => $docid,
            'custom1' => $custom,
            'discount_c' => $discount
        );


        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }

        if ($this->db->update('geopos_customers')) {
            $data = array(
                'name' => $name,
                'email' => $email,
                'lang' => $language
            );
            $this->db->set($data);
            $this->db->where('cid', $id);
            $this->db->update('users');
            $this->aauth->applog("[Client Updated] $name ID " . $id, $this->aauth->get_user()->username);
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));

            $this->custom->edit_save_fields_data($id, 1);
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function changepassword($id, $password)
    {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'password' => $pass
        );


        $this->db->set($data);
        $this->db->where('cid', $id);

        if ($this->db->update('users')) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function editpicture($id, $pic)
    {
        $this->db->select('picture');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->row_array();


        $data = array(
            'picture' => $pic
        );


        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        if ($this->db->update('geopos_customers') AND $result['picture'] != 'example.png') {

            unlink(FCPATH . 'userfiles/customers/' . $result['picture']);
            unlink(FCPATH . 'userfiles/customers/thumbnail/' . $result['picture']);
        }


    }

    public function group_list()
    {
        $whr="";
            if ($this->aauth->get_user()->loc) {
           $whr="WHERE (geopos_customers.loc=" . $this->aauth->get_user()->loc . " ) ";
           if(BDATA) $whr="WHERE (geopos_customers.loc=" . $this->aauth->get_user()->loc . " OR geopos_customers.loc=0 ) ";
        } elseif (!BDATA) {
           $whr="WHERE  geopos_customers.loc=0  ";
        }

        $query = $this->db->query("SELECT c.*,p.pc FROM geopos_cust_group AS c LEFT JOIN ( SELECT gid,COUNT(gid) AS pc FROM geopos_customers $whr GROUP BY gid) AS p ON p.gid=c.id");
        return $query->result_array();
    }

    public function delete($id)
    {
        //$this->aauth->applog("[Client Deleted]  ID " . $id, $this->aauth->get_user()->username);
        //$this->db->delete('users', array('cid' => $id));
        //$this->custom->del_fields($id, 1);
        $query = $this->db->query("SELECT basic_info_id  from customer_basic_info where cus_id=".$id);
        $aResult=$query->result_array();
        foreach($aResult as $thisBasicID){
        $this->db->delete('customer_basic_info',array('basic_info_id' => $thisBasicID['basic_info_id']));
        $this->db->delete('customer_coat_size',array('cus_basic_id' => $thisBasicID['basic_info_id']));
        $this->db->delete('customer_kmz_shl',array('cus_basic_id' => $thisBasicID['basic_info_id']));
        $this->db->delete('customer_pant_size',array('cus_basic_id' => $thisBasicID['basic_info_id']));
        // $this->db->delete('geopos_invoices', array('cus_basic_id' => $thisBasicID['basic_info_id']));
        $this->db->delete('geopos_stiching_items', array('cus_basic_id' => $thisBasicID['basic_info_id']));
        }

        return $this->db->delete('geopos_customers', array('id' => $id, 'loc' => $this->aauth->get_user()->loc));
        if ($this->aauth->get_user()->loc) {
           
        } elseif (!BDATA) {
            return $this->db->delete('geopos_customers', array('id' => $id, 'loc' => 0));
        }
   

    }


    //transtables

    function trans_table($id)
    {
        $this->_get_trans_table_query($id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    private function _get_trans_table_query($id)
    {

        $this->db->from('geopos_transactions');
        $this->db->where('payerid', $id);
        $this->db->where('ext', 0);
               if ($this->aauth->get_user()->loc) {
                $this->db->where('loc', $this->aauth->get_user()->loc);
            } elseif (!BDATA) {
                $this->db->where('loc', 0);
            }
        $i = 0;
        foreach ($this->trans_column_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->trans_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) // here order processing
        {
            $this->db->order_by($this->trans_column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function trans_count_filtered($id = '')
    {
        $this->_get_trans_table_query($id);
        $query = $this->db->get();
        if ($id != '') {
            $this->db->where('payerid', $id);
        }
        return $query->num_rows($id = '');
    }

    public function trans_count_all($id = '')
    {
        $this->_get_trans_table_query($id);
        $query = $this->db->get();
        if ($id != '') {
            $this->db->where('payerid', $id);
        }
    }

    private function _inv_datatables_query($id, $tyd = 0)
    {
        $this->db->select('geopos_invoices.*');
        $this->db->from('geopos_invoices');
        $this->db->where('geopos_invoices.csd', $id);
                if ($this->aauth->get_user()->loc) {
            $this->db->where('geopos_invoices.loc', $this->aauth->get_user()->loc);
        }elseif(!BDATA){
               $this->db->where('geopos_invoices.loc', 0);
        }

        if ($tyd) $this->db->where('geopos_invoices.i_class>', 1);
        $this->db->join('geopos_customers', 'geopos_invoices.csd=geopos_customers.id', 'left');

        $i = 0;

        foreach ($this->inv_column_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->inv_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->inv_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->inv_order)) {
            $order = $this->inv_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function inv_datatables($id, $tyd = 0)
    {
        $this->_inv_datatables_query($id, $tyd);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function inv_count_filtered($id)
    {
        $this->_inv_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function inv_count_all($id)
    {
        $this->db->from('geopos_invoices');
        $this->db->where('csd', $id);
        return $this->db->count_all_results();
    }


    private function _qto_datatables_query($id, $tyd = 0)
    {
        $this->db->select('geopos_quotes.*');
        $this->db->from('geopos_quotes');
        $this->db->where('geopos_quotes.csd', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('geopos_quotes.loc', $this->aauth->get_user()->loc);
        }elseif(!BDATA){
               $this->db->where('geopos_quotes.loc', 0);
        }
        $this->db->join('geopos_customers', 'geopos_quotes.csd=geopos_customers.id', 'left');

        $i = 0;

        foreach ($this->inv_column_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->inv_column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->qto_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->qto_order)) {
            $order = $this->qto_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function qto_datatables($id, $tyd = 0)
    {
        $this->_qto_datatables_query($id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function qto_count_filtered($id)
    {
        $this->_qto_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function qto_count_all($id)
    {
        $this->db->from('geopos_quotes');
        $this->db->where('csd', $id);
        return $this->db->count_all_results();
    }

    public function group_info($id)
    {

        $this->db->from('geopos_cust_group');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function activity($id)
    {
        $this->db->select('*');
        $this->db->from('geopos_metadata');
        $this->db->where('type', 21);
        $this->db->where('rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function recharge($id, $amount)
    {

        $this->db->set('balance', "balance+$amount", FALSE);
        $this->db->where('id', $id);

        $this->db->update('geopos_customers');

        $data = array(
            'type' => 21,
            'rid' => $id,
            'col1' => $amount,
            'col2' => date('Y-m-d H:i:s') . ' Account Recharge by ' . $this->aauth->get_user()->username
        );


        if ($this->db->insert('geopos_metadata', $data)) {
            $this->aauth->applog("[Client Wallet Recharge] Amt-$amount ID " . $id, $this->aauth->get_user()->username);
            return true;
        } else {
            return false;
        }

    }

    private function _project_datatables_query($cday = '')
    {
        $this->db->select("geopos_projects.*,geopos_customers.name AS customer");
        $this->db->from('geopos_projects');
        $this->db->join('geopos_customers', 'geopos_projects.cid = geopos_customers.id', 'left');


        $this->db->where('geopos_projects.cid=', $cday);


        $i = 0;

        foreach ($this->pcolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->pcolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->porder)) {
            $order = $this->porder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function project_datatables($cday = '')
    {


        $this->_project_datatables_query($cday);

        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function project_count_filtered($cday = '')
    {
        $this->_project_datatables_query($cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function project_count_all($cday = '')
    {
        $this->_project_datatables_query($cday);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //notes

    private function _notes_datatables_query($id)
    {

        $this->db->from('geopos_notes');
        $this->db->where('fid', $id);
        $this->db->where('ntype', 1);
        $i = 0;

        foreach ($this->notecolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->notecolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function notes_datatables($id)
    {
        $this->_notes_datatables_query($id);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function notes_count_filtered($id)
    {
        $this->_notes_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function notes_count_all($id)
    {
        $this->_notes_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function editnote($id, $title, $content, $cid)
    {

        $data = array('title' => $title, 'content' => $content, 'last_edit' => date('Y-m-d H:i:s'));


        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->where('fid', $cid);


        if ($this->db->update('geopos_notes')) {
            $this->aauth->applog("[Client Note Edited]  NoteId $id CID " . $cid, $this->aauth->get_user()->username);
            return true;
        } else {
            return false;
        }

    }

    public function note_v($id, $cid)
    {
        $this->db->select('*');
        $this->db->from('geopos_notes');
        $this->db->where('id', $id);
        $this->db->where('fid', $cid);
        $query = $this->db->get();
        return $query->row_array();
    }

    function addnote($title, $content, $cid)
    {
        $this->aauth->applog("[Client Note Added]  NoteId $title CID " . $cid, $this->aauth->get_user()->username);
        $data = array('title' => $title, 'content' => $content, 'cdate' => date('Y-m-d'), 'last_edit' => date('Y-m-d H:i:s'), 'cid' => $this->aauth->get_user()->id, 'fid' => $cid, 'rid' => 1, 'ntype' => 1);
        return $this->db->insert('geopos_notes', $data);

    }

    function deletenote($id, $cid)
    {
        $this->aauth->applog("[Client Note Deleted]  NoteId $id CID " . $cid, $this->aauth->get_user()->username);
        return $this->db->delete('geopos_notes', array('id' => $id, 'fid' => $cid, 'rid' => 1));

    }

    //documents list

    var $doccolumn_order = array(null, 'title', 'cdate', null);
    var $doccolumn_search = array('title', 'cdate');

    public function documentlist($cid)
    {
        $this->db->select('*');
        $this->db->from('geopos_documents');
        $this->db->where('fid', $cid);
        $this->db->where('rid', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function adddocument($title, $filename, $cid)
    {
        $this->aauth->applog("[Client Doc Added]  DocId $title CID " . $cid, $this->aauth->get_user()->username);
        $data = array('title' => $title, 'filename' => $filename, 'cdate' => date('Y-m-d'), 'cid' => $this->aauth->get_user()->id, 'fid' => $cid, 'rid' => 1);
        return $this->db->insert('geopos_documents', $data);

    }

    function deletedocument($id, $cid)
    {
        $this->db->select('filename');
        $this->db->from('geopos_documents');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        if ($this->db->delete('geopos_documents', array('id' => $id, 'fid' => $cid, 'rid' => 1))) {

            unlink(FCPATH . 'userfiles/documents/' . $result['filename']);
            $this->aauth->applog("[Client Doc Deleted]  DocId $id CID " . $cid, $this->aauth->get_user()->username);
            return true;
        } else {
            return false;
        }

    }


    function document_datatables($cid)
    {
        $this->document_datatables_query($cid);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    private function document_datatables_query($cid)
    {

        $this->db->from('geopos_documents');
        $this->db->where('fid', $cid);
        $this->db->where('rid', 1);
        $i = 0;

        foreach ($this->doccolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->doccolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->doccolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function document_count_filtered($cid)
    {
        $this->document_datatables_query($cid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function document_count_all($cid)
    {
        $this->document_datatables_query($cid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function send_mail_auto($email, $name, $password)
    {
        $this->load->library('parser');
        $this->load->model('templates_model', 'templates');
        $template = $this->templates->template_info(16);

        $data = array(
            'Company' => $this->config->item('ctitle'),
            'NAME' => $name
        );
        $subject = $this->parser->parse_string($template['key1'], $data, TRUE);

        $data = array(
            'Company' => $this->config->item('ctitle'),
            'NAME' => $name,
            'EMAIL' => $email,
            'URL' => base_url() . 'crm',
            'PASSWORD' => $password,
            'CompanyDetails' => '<h6><strong>' . $this->config->item('ctitle') . ',</strong></h6>
<address>' . $this->config->item('address') . '<br>' . $this->config->item('address2') . '</address>
             ' . $this->lang->line('Phone') . ' : ' . $this->config->item('phone') . '<br>  ' . $this->lang->line('Email') . ' : ' . $this->config->item('email'),


        );
        $message = $this->parser->parse_string($template['other'], $data, TRUE);


        return array('subject' => $subject, 'message' => $message);
    }


}