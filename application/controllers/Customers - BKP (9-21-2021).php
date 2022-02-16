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

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
         $this->load->model('pos_invoices_model', 'invocies');
        $this->load->model('customers_model', 'customers');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(3)) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
        $this->load->library("Custom");
    }

    public function index()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Customers';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/clist');
        $this->load->view('fixed/footer');
    }

    public function create()
    {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $data['customergrouplist'] = $this->customers->group_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['custom_fields'] = $this->custom->add_fields(1);
        $data['ref_no'] = $this->customers->last_record()  + 1;
        $head['title'] = 'Create Customer';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/create', $data);
        $this->load->view('fixed/footer');
    }

    public function view()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['customergroup'] = $this->customers->group_info($data['details']['gid']);
        $data['money'] = $this->customers->money_details($custid);
        $data['due'] = $this->customers->due_details($custid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['activity'] = $this->customers->activity($custid);
        $data['custom_fields'] = $this->custom->view_fields_data($custid, 1);
        $data['lastinvoice'] = $this->invocies->lastinvoice();
        $head['title'] = 'View Customer';
        $this->load->view('fixed/header', $head);
        if ($data['details']['id']) $this->load->view('customers/view', $data);
        $this->load->view('fixed/footer');
    }
    public function tailor(){
        $cid = $this->input->get('id');
        $tid = $this->input->get('id');

        $data['id'] = $tid;
        
        //$data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        
        $data['nap'] = $this->customers->details($cid);
        
        $pref = prefix(7);

        $data['general'] = array('title' => "Cutomer View", 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);

        ini_set('memory_limit', '64M');

        $html = $this->load->view('print_files/tailor', $data, true);
        //PDF Rendering
        $this->load->library('pdf');
        
        // $header = $this->load->view('print_files/tailor-header', $data, true);

        $pdf = $this->pdf->load_split(array('margin_top' => 2));

        // $pdf->SetHTMLHeader($header);

        // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['nap']['reference_id'] . '</div>');
        $pdf->WriteHTML($html);
        //echo $html;exit;
        if ($this->input->get('d')) {
            $pdf->Output('Invoice_pos' .$data['nap']['reference_id']. '.pdf', 'D');
        } else {
            $pdf->Output('Invoice_pos' .$data['nap']['reference_id']. '.pdf', 'I');
        }

    }

    public function CustomerView(){
        
        $cid = $this->input->get('id');

        $tid = $this->input->get('id');
        $data['id'] = $tid;
        
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        
        $data['nap'] = $this->customers->details($cid);
        
        $pref = prefix(7);

        $data['general'] = array('title' => "Cutomer View", 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);

        ini_set('memory_limit', '64M');

        $html =  $this->load->view('print_files/customer_view', $data, true); 

        // echo $html; exit;


        //PDF Rendering
        $this->load->library('pdf');
        
        // $header = $this->load->view('print_files/pCV-header', $data, true);
        $pdf = $this->pdf->load_split(array('margin_top' => 2));
        // $pdf->SetHTMLHeader($header);
        // $pdf->SetDisplayMode(100);

        $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
        $pdf->WriteHTML($html);
        $pdf->SetDisplayMode('fullwidth');
        if ($this->input->get('d')) {
            $pdf->Output('Invoice_pos' . $data['invoice']['tid'] . '.pdf', 'D');
        } else {
            $pdf->Output('Invoice_pos' . $data['invoice']['tid'] . '.pdf', 'I');
        }
    }

    public function load_list()
    {
      ini_set('max_execution_time', 0);
        $no = $this->input->post('start');

        $list = $this->customers->get_datatables();
        $data = array();
        if ($this->input->post('due')) {
            foreach ($list as $customers) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $customers->reference_id;
                $row[] = '<a href="customers/CustomerView?id=' . $customers->id . '">' . $customers->name . '</a>';
                $row[] = amountExchange($customers->total - $customers->pamnt, 0, $this->aauth->get_user()->loc);
                $row[] = $customers->booking_date;
                $row[] = $customers->d_date;
                $row[] = $customers->phone;
                //$row[] = '<a href="customers/view?id=' . $customers->id . '" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="customers/edit?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>  ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                $row[] = '<a href="customers/tailor?id='.$customers->id .'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Tailor View</a> <a href="customers/CustomerView?id='.$customers->id.'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Customer View</a> <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>Add New</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                $data[] = $row;
            }
        } else {
            foreach ($list as $customers) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $customers->reference_id;
                $row[] = '<a href="customers/CustomerView?id=' . $customers->id . '">' . $customers->name . '</a>';
                $row[] = $customers->booking_date;
                $row[] = $customers->d_date;
                $row[] = $customers->phone;
                //$row[] = '<a href="customers/view_customer?id=' . $customers->id . '" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Customer View</a> <a href="customers/edit?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>  ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                $row[] = '<a href="customers/tailor?id='.$customers->id .'" class="btn btn-secondary btn-sm"><span class="fa fa-cut"></span>  ' .'Tailor View</a> <a href="customers/CustomerView?id='.$customers->id.'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Customer View</a> <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>Add New</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';

                $data[] = $row;
            }
        }


        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->count_all(),
            "recordsFiltered" => $this->customers->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    //edit section
    public function edit()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->load->library("Common");
        $pid = $this->input->get('id');
        $data['customer'] = $this->customers->details($pid);
        $data['customergroup'] = $this->customers->group_info($data['customer']['gid']);
        $data['customergrouplist'] = $this->customers->group_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['custom_fields'] = $this->custom->view_edit_fields($pid, 1);
        $head['title'] = 'Edit Customer';
        $data['langs'] = $this->common->languages();
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/edit', $data);
        $this->load->view('fixed/footer');
    }

    public function addNewCustomer(){

        $cid = $this->input->get('id');
        $head['title'] = 'Edit Customer';
        $data['customer'] = $this->customers->details($cid);
        if(is_null($data['customer']['reference_id'])){
           $data['customer']['reference_id'] = $this->customers->last_record()  + 1;
        }
        // echo '<pre>'; print_r($data);exit;
        $data['id'] = $cid;
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/addNew', $data);
        $this->load->view('fixed/footer');
    }
    public function editStView(){
        $tid = $this->input->get('id');
        $head['title'] = 'Edit Stitching Invoice';

        $data['customer'] = $this->customers->stDetails($tid);

        if(is_null($data['customer']['reference_id'])){
           $data['customer']['reference_id'] = $this->customers->last_record()  + 1;
        }
        $data['id'] = $tid;
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/editStInvoice', $data);
        $this->load->view('fixed/footer');
    }

    public function editStInvoice(){

        $id = $this->input->post('id');

        $ref_no = $this->input->post('or_ref_no',true);

        $book_date = $this->input->post('booking_date');
        $book_date = date('Y-m-d', strtotime($book_date));

        $t_date = $this->input->post('t_date');
        $t_date = date('Y-m-d', strtotime($t_date));

       $d_date = $this->input->post('d_date');
       $d_date = date('Y-m-d', strtotime($d_date));

       $name = $this->input->post('customer_name',true);
       $mobile = $this->input->post('mobile',true);


       /*Get  coat/waist coat size*/
       $cLength = $this->input->post("cLength");
       $cSleeves = $this->input->post("cSleeves");
       $cShoulder = $this->input->post("cShoulder");
       $cHalfBack = $this->input->post("cHalfBack");
       $cCrossBack = $this->input->post("cCrossBack");
       $cChest = $this->input->post("cChest");
       $cWaist = $this->input->post("cWaist");
       $cHips = $this->input->post("cHips");

       $is_coat = false;
       $is_wCoat = false;

       if(!empty($_POST["is_coat"])){
            $is_coat = true;
       }

       if(!empty($_POST['is_wCoat'])){
            $is_wCoat = true;
       }

       /*Get pant length*/
       $pLength = $this->input->post("pLength");
       $pInLength = $this->input->post("pInLength");
       $pWaist = $this->input->post("pWaist");
       $pHip = $this->input->post("pHip");
       $pThigh = $this->input->post("pThigh");
       $pBottom = $this->input->post("pBottom");
       $pKnee = $this->input->post("pKnee");

       /*Get kamiz and shalwar size*/
       $kmzLength = $this->input->post("kmzLength");
       $kmzSleeves = $this->input->post("kmzSleeves");
       $kmzShoulder = $this->input->post("kmzShoulder");
       $kmzNeck = $this->input->post("kmzNeck");
       $kmzChest = $this->input->post("kmzChest");
       $kmzWaist = $this->input->post("kmzWaist");
       $kmzGuaira = $this->input->post("kmzGuaira");

       $is_kmz = false;
       $is_shirt = false;
       
        if(!empty($_POST["is_kamz"])){
            $is_kmz = true;
       }

       if(!empty($_POST['is_shirt'])){
            $is_shirt = true;
       }

       /*Shwalr size*/
       $shlLength = $this->input->post("shlLength");
       $shlBottom = $this->input->post("shlBottom");
       $shlAsanTyar = $this->input->post("shlAsanTyar");
       $shlGairaTyar = $this->input->post("shlGairaTyar");

       /*instrucations*/
       $instrucation = $this->input->post("inst");

       $csd = $this->input->post("csd");

       $ptype = "Cash";
        $coupon = "";
        $notes = "ss";
        $coupon_amount = 0;
        $coupon_n = '';
        $invocieno =  $this->invocies->lastinvoice() + 1;
        $invoicedate = $book_date;
        $invocieduedate = $d_date;
        $tax = "";
        $total_tax = 0;
        $subtotal = rev_amountExchange_s($this->input->post('total'));

        $total = rev_amountExchange_s($this->input->post('total'));
        $p_amount =  rev_amountExchange_s($this->input->post('advance'));

        $c_amt = $p_amount - $total;
        if ($c_amt == 0.00) {
            $status = 'Paid';
            $pamnt = $total;
        } elseif ($c_amt < 0.00) {
            $status = 'Partial';
            if ($p_amount == 0.00) $status = 'Due';
            $pamnt = $p_amount;
            $c_amt = 0;
        } else {
            $status = 'Paid';
            $pamnt = $total;
        }

       $this->customers->editNap($id,$ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation,$ptype,$coupon,$notes,
        $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount,$csd);

    }

    public function addNew(){
        
        $id = $this->input->post('id');

        $ref_no = $this->input->post('or_ref_no',true);

        $book_date = strtr($this->input->post('booking_date'), '/', '-');
        $book_date = date('Y-m-d', strtotime($book_date));

       $d_date = strtr($this->input->post('d_date'), '/', '-');
       $d_date = date('Y-m-d', strtotime($d_date));

        $t_date = strtr($this->input->post('t_date'), '/', '-');
        $t_date = date('Y-m-d', strtotime($t_date));

       $name = $this->input->post('customer_name',true);
       $mobile = $this->input->post('mobile',true);


       /*Get  coat/waist coat size*/
       $cLength = $this->input->post("cLength");
       $cSleeves = $this->input->post("cSleeves");
       $cShoulder = $this->input->post("cShoulder");
       $cHalfBack = $this->input->post("cHalfBack");
       $cCrossBack = $this->input->post("cCrossBack");
       $cChest = $this->input->post("cChest");
       $cWaist = $this->input->post("cWaist");
       $cHips = $this->input->post("cHips");
       $Sec_cLength = $this->input->post("Sec_cLength");
       $cBicep = $this->input->post("cBicep");
       $cForearm = $this->input->post("cForearm");
       $cNeck = $this->input->post("cNeck");

       $is_coat = false;
       $is_wCoat = false;

       if(!empty($_POST["is_coat"])){
            $is_coat = true;
       }

       if(!empty($_POST['is_wCoat'])){
            $is_wCoat = true;
       }

       /*Get pant length*/
       $pLength = $this->input->post("pLength");
       $pInLength = $this->input->post("pInLength");
       $pWaist = $this->input->post("pWaist");
       $pHip = $this->input->post("pHip");
       $pThigh = $this->input->post("pThigh");
       $pBottom = $this->input->post("pBottom");
       $pKnee = $this->input->post("pKnee");

       /*Get kamiz and shalwar size*/
       $kmzLength = $this->input->post("kmzLength");
       $kmzSleeves = $this->input->post("kmzSleeves");
       $kmzShoulder = $this->input->post("kmzShoulder");
       $kmzNeck = $this->input->post("kmzNeck");
       $kmzChest = $this->input->post("kmzChest");
       $kmzWaist = $this->input->post("kmzWaist");
       $kmzGuaira = $this->input->post("kmzGuaira");
       $kmzHips = $this->input->post("kmzHips");
       $kmzBicep = $this->input->post("kmzBicep");
       $kmzForearm = $this->input->post("kmzForearm");

       $is_kmz = false;
       $is_shirt = false;
       
        if(!empty($_POST["is_kamz"])){
            $is_kmz = true;
       }

       if(!empty($_POST['is_shirt'])){
            $is_shirt = true;
       }

       /*Shwalr size*/
       $shlLength = $this->input->post("shlLength");
       $shlBottom = $this->input->post("shlBottom");
       $shlAsanTyar = $this->input->post("shlAsanTyar");
       $shlGairaTyar = $this->input->post("shlGairaTyar");

       /*instrucations*/
       $instrucation = $this->input->post("inst");

       

       $ptype = "Cash";
        $coupon = "";
        $notes = "ss";
        $coupon_amount = 0;
        $coupon_n = '';
        $invocieno =  $this->invocies->lastinvoice() + 1;
        $invoicedate = $book_date;
        $invocieduedate = $d_date;
        $tax = "";
        $total_tax = 0;
        $subtotal = rev_amountExchange_s($this->input->post('total'));

        $total = rev_amountExchange_s($this->input->post('total'));
        $p_amount =  rev_amountExchange_s($this->input->post('advance'));

        $c_amt = $p_amount - $total;
        if ($c_amt == 0.00) {
            $status = 'Paid';
            $pamnt = $total;
        } elseif ($c_amt < 0.00) {
            $status = 'Partial';
            if ($p_amount == 0.00) $status = 'Due';
            $pamnt = $p_amount;
            $c_amt = 0;
        } else {
            $status = 'Paid';
            $pamnt = $total;
        }

       $this->customers->addNew($id,$ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$Sec_cLength,$cBicep,$cForearm,$cNeck,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$kmzHips,$kmzBicep,$kmzForearm,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation,$ptype,$coupon,$notes,
        $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount);
    }

    public function addcustomer()
    {
        $name = $this->input->post('name', true);
        $company = $this->input->post('company', true);
        $phone = $this->input->post('phone', true);
        $email = $this->input->post('email', true);
        $address = $this->input->post('address', true);
        $city = $this->input->post('city', true);
        $region = $this->input->post('region', true);
        $country = $this->input->post('country', true);
        $postbox = $this->input->post('postbox', true);
        $taxid = $this->input->post('taxid', true);
        $customergroup = $this->input->post('customergroup');
        $name_s = $this->input->post('name_s', true);
        $phone_s = $this->input->post('phone_s', true);
        $email_s = $this->input->post('email_s', true);
        $address_s = $this->input->post('address_s', true);
        $city_s = $this->input->post('city_s', true);
        $region_s = $this->input->post('region_s', true);
        $country_s = $this->input->post('country_s', true);
        $postbox_s = $this->input->post('postbox_s', true);
        $language = $this->input->post('language', true);
        $create_login = $this->input->post('c_login', true);
        $password = $this->input->post('password_c', true);
        $docid = $this->input->post('docid', true);
        $custom = $this->input->post('c_field', true);
        $discount = $this->input->post('discount', true);
        $this->customers->add($name, $company, $phone, $email, $address, $city, $region, $country, $postbox, $customergroup, $taxid, $name_s, $phone_s, $email_s, $address_s, $city_s, $region_s, $country_s, $postbox_s, $language, $create_login, $password, $docid, $custom, $discount);
    }

    public function colthingCustomer(){

       $ref_no = $this->input->post('or_ref_no',true);

       $book_date = strtr($this->input->post('booking_date'), '/', '-');
       $book_date = date('Y-m-d', strtotime($book_date));

       $d_date = $this->input->post('d_date'); 
       // $d_date = strtr($this->input->post('d_date'), '/', '-');
       $d_date = date('Y-m-d', strtotime($d_date)); 
      
       $t_date = strtr($this->input->post('t_date'), '/', '-');
       $t_date = date('Y-m-d', strtotime($t_date));

       $name = $this->input->post('customer_name',true);
       $mobile = $this->input->post('mobile',true);


       /*Get  coat/waist coat size*/
       $cLength = $this->input->post("cLength");
       $cSleeves = $this->input->post("cSleeves");
       $cShoulder = $this->input->post("cShoulder");
       $cHalfBack = $this->input->post("cHalfBack");
       $cCrossBack = $this->input->post("cCrossBack");
       $cChest = $this->input->post("cChest");
       $cWaist = $this->input->post("cWaist");
       $cHips = $this->input->post("cHips");
       $Sec_cLength = $this->input->post("Sec_cLength");
       $cBicep = $this->input->post("cBicep");
       $cForearm = $this->input->post("cForearm");
       $cNeck = $this->input->post("cNeck");

       $is_coat = false;
       $is_wCoat = false;

       if(!empty($_POST["is_coat"])){
            $is_coat = true;
       }

       if(!empty($_POST['is_wCoat'])){
            $is_wCoat = true;
       }

       /*Get pant length*/
       $pLength = $this->input->post("pLength");
       $pInLength = $this->input->post("pInLength");
       $pWaist = $this->input->post("pWaist");
       $pHip = $this->input->post("pHip");
       $pThigh = $this->input->post("pThigh");
       $pBottom = $this->input->post("pBottom");
       $pKnee = $this->input->post("pKnee");

       /*Get kamiz and shalwar size*/
       $kmzLength = $this->input->post("kmzLength");
       $kmzSleeves = $this->input->post("kmzSleeves");
       $kmzShoulder = $this->input->post("kmzShoulder");
       $kmzNeck = $this->input->post("kmzNeck");
       $kmzChest = $this->input->post("kmzChest");
       $kmzWaist = $this->input->post("kmzWaist");
       $kmzGuaira = $this->input->post("kmzGuaira");
       $kmzHips = $this->input->post("kmzHips");
       $kmzBicep = $this->input->post("kmzBicep");
       $kmzForearm = $this->input->post("kmzForearm");

       $is_kmz = false;
       $is_shirt = false;
       
        if(!empty($_POST["is_kamz"])){
            $is_kmz = true;
       }

       if(!empty($_POST['is_shirt'])){
            $is_shirt = true;
       }

       /*Shwalr size*/
       $shlLength = $this->input->post("shlLength");
       $shlBottom = $this->input->post("shlBottom");
       $shlAsanTyar = $this->input->post("shlAsanTyar");
       $shlGairaTyar = $this->input->post("shlGairaTyar");

       /*instrucations*/
       $instrucation = $this->input->post("inst");

       //add into invoice table

        $ptype = "Cash";
        $coupon = "";
        $notes = "ss";
        $coupon_amount = 0;
        $coupon_n = '';
        $invocieno =  $this->invocies->lastinvoice() + 1;
        $invoicedate = $book_date;
        $invocieduedate = $d_date;
        $tax = "";
        $total_tax = 0;
        $subtotal = rev_amountExchange_s($this->input->post('total'));

        $total = rev_amountExchange_s($this->input->post('total'));
        $p_amount =  rev_amountExchange_s($this->input->post('advance'));

         $c_amt = $p_amount - $total;
            if ($c_amt == 0.00) {
                $status = 'Paid';
                $pamnt = $total;
            } elseif ($c_amt < 0.00) {
                $status = 'Partial';
                if ($p_amount == 0.00) $status = 'Due';
                $pamnt = $p_amount;
                $c_amt = 0;
            } else {
                $status = 'Paid';
                $pamnt = $total;
            }

       $this->customers->tailoringCustomerAdd($ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$Sec_cLength,$cBicep,$cForearm,$cNeck,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$kmzHips,$kmzBicep,$kmzForearm,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation,$ptype,$coupon,$notes,
        $coupon_amount,$coupon_n,$invocieno,$invoicedate,$invocieduedate,$tax,$total_tax,$status,$pamnt,$total,$p_amount);

    }

    public function oCus(){

      ini_set('max_execution_time', 0);
      $this->db->select('*');
      $this->db->from('garmentcustomer');

      $query = $this->db->get();

      $customers = $query->result();

      foreach ($customers as $key => $c) {
        
      $ref_no = $c->nOrderNo;

       $book_date = strtr($c->dBooking_Date, '/', '-');
       $book_date = date('Y-m-d', strtotime($book_date));

        $d_date = $c->dDelivery_Date;
        $d_date = date('Y-m-d', strtotime($d_date));

       $t_date = $c->dTrial_Date;
       $t_date = date('Y-m-d', strtotime($t_date));

       $name = $c->sCustomer_Name;
       $mobile = $c->sCustomer_Mob_No;


       /*Get  coat/waist coat size*/
       $cLength = $c->nCoat_Length;
       $cSleeves = $c->nCoat_Sleeves;
       $cShoulder = $c->nCoat_Shoulder;
       $cHalfBack = $c->nCoat_HalfBack;
       $cCrossBack = $c->nCoat_CrossBack;
       $cChest = $c->nCoat_Chest;
       $cWaist = $c->nCoat_Waist;
       $cHips = $c->nCoat_Hip;

       $is_coat = false;
       $is_wCoat = false;

       if($c->sItem_Coat == "COAT"){
            $is_coat = true;
       }

       if($c->sItem_WaistCoat == "WAIST COAT"){
            $is_wCoat = true;
       }

       /*Get pant length*/
       $pLength = $c->nPant_Length;
       $pInLength = $c->nPant_InsideLength;
       $pWaist = $c->nPant_Waist;
       $pHip = $c->nPant_Hip;
       $pThigh = $c->nPant_Thigh;
       $pBottom = $c->nPant_Bottom;
       $pKnee = $c->nPant_Knee;

       /*Get kamiz and shalwar size*/
       $kmzLength = $c->nKamiz_Length;
       $kmzSleeves = $c->nKamiz_Sleeves;
       $kmzShoulder = $c->nKamiz_Shoulder;
       $kmzNeck = $c->nKamiz_Neck;
       $kmzChest = $c->nKamiz_Chest;
       $kmzWaist =$c->nKamiz_Waist;
       $kmzGuaira = $c->nKamiz_Guaira;

       $is_kmz = false;
       $is_shirt = false;
       
        if($c->sItem_Kamiz == "KAMIZ"){
            $is_kmz = true;
       }

       if($c->sItem_Shirt == "SHIRT"){
            $is_shirt = true;
       }

       /*Shwalr size*/
       $shlLength = $c->nShalwar_Length;
       $shlBottom = $c->nShalwar_Bottom;
       $shlAsanTyar = $c->nShalwar_AsanTyar;
       $shlGairaTyar= $c->nShalwar_GairaTyar;
       


       /*instrucations*/
       $instrucation = $c->sInstructions;

       $this->customers->oldData($ref_no,$book_date,$t_date,$d_date,$name,$mobile,$cLength,$cSleeves,$cShoulder,$cHalfBack,$cCrossBack,$cChest,$cWaist,$cHips,$is_coat,$is_wCoat,$pLength,$pInLength,$pWaist,$pHip,$pThigh,$pBottom,$pKnee,$kmzLength,$kmzSleeves,$kmzShoulder,$kmzNeck,$kmzChest,$kmzWaist,$kmzGuaira,$is_kmz,$is_shirt,$shlLength,$shlBottom,$shlAsanTyar,$shlGairaTyar,$instrucation);
      }
    }


    public function editcustomer()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name', true);
        $company = $this->input->post('company', true);
        $phone = $this->input->post('phone', true);
        $email = $this->input->post('email', true);
        $address = $this->input->post('address', true);
        $city = $this->input->post('city', true);
        $region = $this->input->post('region', true);
        $country = $this->input->post('country', true);
        $postbox = $this->input->post('postbox', true);
        $customergroup = $this->input->post('customergroup', true);
        $taxid = $this->input->post('taxid', true);
        $name_s = $this->input->post('name_s', true);
        $phone_s = $this->input->post('phone_s', true);
        $email_s = $this->input->post('email_s', true);
        $address_s = $this->input->post('address_s', true);
        $city_s = $this->input->post('city_s', true);
        $region_s = $this->input->post('region_s', true);
        $country_s = $this->input->post('country_s', true);
        $postbox_s = $this->input->post('postbox_s', true);
        $docid = $this->input->post('docid', true);
        $custom = $this->input->post('c_field', true);
        $language = $this->input->post('language', true);
        $discount = $this->input->post('discount', true);
        if ($id) {
            $this->customers->edit($id, $name, $company, $phone, $email, $address, $city, $region, $country, $postbox, $customergroup, $taxid, $name_s, $phone_s, $email_s, $address_s, $city_s, $region_s, $country_s, $postbox_s, $docid, $custom, $language, $discount);
        }
    }

    public function changepassword()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($id = $this->input->post()) {
            $id = $this->input->post('id');
            $password = $this->input->post('password', true);
            if ($id) {
                $this->customers->changepassword($id, $password);
            }
        } else {
            $pid = $this->input->get('id');
            $data['customer'] = $this->customers->details($pid);
            $data['customergroup'] = $this->customers->group_info($pid);
            $data['customergrouplist'] = $this->customers->group_list();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Customer';
            $this->load->view('fixed/header', $head);
            $this->load->view('customers/edit_password', $data);
            $this->load->view('fixed/footer');
        }
    }


    public function delete_i()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->aauth->get_user()->roleid < 3) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $this->input->post('deleteid');
        if ($id >= 1) {
            if ($this->customers->delete($id)) {
                echo json_encode(array('status' => 'Success', 'message' => 'Customer details deleted Successfully!'));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
            }
        }
    }

    public function displaypic()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $this->input->get('id');
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/customers/'
        ));
        $img = (string)$this->uploadhandler->filenaam();
        if ($img != '') {
            $this->customers->editpicture($id, $img);
        }
    }


    public function translist()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $cid = $this->input->post('cid');
        $list = $this->customers->trans_table($cid);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            $row[] = $prd->date;
            $row[] = amountFormat($prd->debit);
            $row[] = amountFormat($prd->credit);
            $row[] = $prd->account;

            $row[] = $this->lang->line($prd->method);
            $row[] = '<a href="' . base_url() . 'transactions/view?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs delete-object"><span class="fa fa-trash"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->trans_count_all($cid),
            "recordsFiltered" => $this->customers->trans_count_filtered($cid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function inv_list()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $cid = $this->input->post('cid');
        $tid = $this->input->post('tyd');

        $list = $this->customers->inv_datatables($cid, $tid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $invoices->tid;
            $row[] = $invoices->invoicedate;
            $row[] = amountFormat($invoices->total);
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs" title="View Invoice"><i class="fa fa-file-text"></i> </a> <a href="' . base_url("invoices/printinvoice?id=$invoices->id") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="fa fa-download"></span></a> <a href="#" data-object-id="' . $invoices->id . '" class="btn btn-danger btn-xs delete-object" title="Delete"><span class="fa fa-trash"></span></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->inv_count_all($cid),
            "recordsFiltered" => $this->customers->inv_count_filtered($cid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function transactions()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['money'] = $this->customers->money_details($custid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Customer Transactions';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/transactions', $data);
        $this->load->view('fixed/footer');
    }

    public function invoices()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['money'] = $this->customers->money_details($custid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Customer Invoices';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/invoices', $data);
        $this->load->view('fixed/footer');
    }

    public function quotes()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['money'] = $this->customers->money_details($custid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Customer Quotes';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/quotes', $data);
        $this->load->view('fixed/footer');
    }

    public function qto_list()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $cid = $this->input->post('cid');
        $tid = $this->input->post('tyd');
        $list = $this->customers->qto_datatables($cid, $tid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $invoices) {
            $no++;
            $row = array();

            $row[] = $invoices->tid;

            $row[] = $invoices->invoicedate;
            $row[] = amountFormat($invoices->total);
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            $row[] = '<a href="' . base_url("quote/view?id=$invoices->id") . '" class="btn btn-success btn-xs" title="View Invoice"><i class="fa fa-file-text"></i> </a> <a href="' . base_url("quote/printquote?id=$invoices->id") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="fa fa-download"></span></a> <a href="#" data-object-id="' . $invoices->id . '" class="btn btn-danger btn-xs delete-object" title="Delete"><span class="fa fa-trash"></span></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->qto_count_all($cid),
            "recordsFiltered" => $this->customers->qto_count_filtered($cid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function balance()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $amount = $this->input->post('amount', true);
            if ($this->customers->recharge($id, $amount)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Balance Added')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
            }
        } else {
            $custid = $this->input->get('id');
            $data['details'] = $this->customers->details($custid);
            $data['customergroup'] = $this->customers->group_info($data['details']['gid']);
            $data['money'] = $this->customers->money_details($custid);
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['activity'] = $this->customers->activity($custid);
            $head['title'] = 'View Customer';
            $this->load->view('fixed/header', $head);
            $this->load->view('customers/recharge', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function projects()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $data['details'] = $this->customers->details($custid);
        $data['money'] = $this->customers->money_details($custid);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Customer Invoices';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/projects', $data);
        $this->load->view('fixed/footer');
    }

    public function prj_list()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $cid = $this->input->post('cid');


        $list = $this->customers->project_datatables($cid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $project) {
            $no++;
            $name = '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '">' . $project->name . '</a>';

            $row = array();
            $row[] = $no;
            $row[] = $name;
            $row[] = dateformat($project->sdate);
            $row[] = $project->customer;
            $row[] = '<span class="project_' . $project->status . '">' . $this->lang->line($project->status) . '</span>';

            $row[] = '<a href="' . base_url() . 'projects/explore?id=' . $project->id . '" class="btn btn-primary btn-sm rounded" data-id="' . $project->id . '" data-stat="0"> ' . $this->lang->line('View') . ' </a> <a class="btn btn-info btn-sm" href="' . base_url() . 'projects/edit?id=' . $project->id . '" data-object-id="' . $project->id . '"> <i class="fa fa-pencil"></i> </a>&nbsp;<a class="btn btn-danger btn-sm delete-object" href="#" data-object-id="' . $project->id . '"> <i class="fa fa-trash"></i> </a>';


            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->project_count_all($cid),
            "recordsFiltered" => $this->customers->project_count_filtered($cid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function notes()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $custid = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['details'] = $this->customers->details($custid);
        $this->session->set_userdata("cid", $custid);
        $head['title'] = 'Notes';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/notes', $data);
        $this->load->view('fixed/footer');
    }

    public function notes_load_list()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $cid = $this->input->post('cid');
        $list = $this->customers->notes_datatables($cid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $note) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $note->title;
            $row[] = dateformat($note->cdate);

            $row[] = '<a href="editnote?id=' . $note->id . '&cid=' . $note->fid . '" class="btn btn-info btn-sm"><span class="fa fa-eye"></span> ' . $this->lang->line('View') . '</a> <a class="btn btn-danger btn-sm delete-object" href="#" data-object-id="' . $note->id . '"> <i class="fa fa-trash"></i> </a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->notes_count_all($cid),
            "recordsFiltered" => $this->customers->notes_count_filtered($cid),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function editnote()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $title = $this->input->post('title', true);
            $content = $this->input->post('content');
            $cid = $this->input->post('cid');
            if ($this->customers->editnote($id, $title, $content, $cid)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED') . " <a href='notes?id=$cid' class='btn btn-indigo btn-lg'><span class='icon-user' aria-hidden='true'></span>  </a> <a href='editnote?id=$id&cid=$cid' class='btn btn-indigo btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $id = $this->input->get('id');
            $cid = $this->input->get('cid');
            $data['note'] = $this->customers->note_v($id, $cid);
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit';
            $this->load->view('fixed/header', $head);
            $this->load->view('customers/editnote', $data);
            $this->load->view('fixed/footer');
        }

    }

    public function addnote()
    {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        if ($this->input->post('title')) {

            $title = $this->input->post('title', true);
            $cid = $this->input->post('id');
            $content = $this->input->post('content');

            if ($this->customers->addnote($title, $content, $cid)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='addnote?id=" . $cid . "' class='btn btn-indigo btn-lg'><span class='icon-plus-circle' aria-hidden='true'></span>  </a> <a href='notes?id=" . $cid . "' class='btn btn-grey btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['id'] = $this->input->get('id');
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Add Note';
            $this->load->view('fixed/header', $head);
            $this->load->view('customers/addnote', $data);
            $this->load->view('fixed/footer');
        }

    }

    public function delete_note()
    {
        $id = $this->input->post('deleteid');
        $cid = $this->session->userdata('cid');
        if ($this->customers->deletenote($id, $cid)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    function statement()
    {

        if ($this->input->post()) {

            $this->load->model('reports_model');


            $customer = $this->input->post('customer');
            $trans_type = $this->input->post('trans_type');
            $sdate = datefordatabase($this->input->post('sdate'));
            $edate = datefordatabase($this->input->post('edate'));
            $data['customer'] = $this->customers->details($customer);


            $data['list'] = $this->reports_model->get_customer_statements($customer, $trans_type, $sdate, $edate);


            $html = $this->load->view('customers/statementpdf', $data, true);


            ini_set('memory_limit', '64M');


            $this->load->library('pdf');

            $pdf = $this->pdf->load();


            $pdf->WriteHTML($html);


            $pdf->Output('Statement' . $customer . '.pdf', 'I');
        } else {
            $data['id'] = $this->input->get('id');
            $this->load->model('transactions_model');

            $data['details'] = $this->customers->details($data['id']);
            $head['title'] = "Account Statement";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('customers/statement', $data);
            $this->load->view('fixed/footer');
        }

    }


    public function documents()
    {
        $data['id'] = $this->input->get('id');
        $data['details'] = $this->customers->details($data['id']);
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->session->set_userdata("cid", $data['id']);
        $head['title'] = 'Documents';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/documents', $data);
        $this->load->view('fixed/footer');


    }

    public function document_load_list()
    {
        $cid = $this->input->post('cid');
        $list = $this->customers->document_datatables($cid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $document) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $document->title;
            $row[] = dateformat($document->cdate);

            $row[] = '<a href="' . base_url('userfiles/documents/' . $document->filename) . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a> <a class="btn btn-danger btn-xs delete-object" href="#" data-object-id="' . $document->id . '"> <i class="fa fa-trash"></i> </a>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->document_count_all($cid),
            "recordsFiltered" => $this->customers->document_count_filtered($cid),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function adddocument()
    {
        $data['id'] = $this->input->get('id');
        $this->load->helper(array('form'));
        $data['response'] = 3;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Document';

        $this->load->view('fixed/header', $head);

        if ($this->input->post('title')) {
            $title = $this->input->post('title', true);
            $cid = $this->input->post('id');
            $config['upload_path'] = './userfiles/documents';
            $config['allowed_types'] = 'docx|docs|txt|pdf|xls';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 3000;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $data['response'] = 0;
                $data['responsetext'] = 'File Upload Error';

            } else {
                $data['response'] = 1;
                $data['responsetext'] = 'Document Uploaded Successfully. <a href="documents?id=' . $cid . '"
                                       class="btn btn-indigo btn-md"><i
                                                class="icon-folder"></i>
                                    </a>';
                $filename = $this->upload->data()['file_name'];
                $this->customers->adddocument($title, $filename, $cid);
            }

            $this->load->view('customers/adddocument', $data);
        } else {


            $this->load->view('customers/adddocument', $data);


        }
        $this->load->view('fixed/footer');


    }


    public function delete_document()
    {
        $id = $this->input->post('deleteid');
        $cid = $this->session->userdata('cid');

        if ($this->customers->deletedocument($id, $cid)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

}