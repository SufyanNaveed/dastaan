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

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(2)) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
        $this->load->model('products_model', 'products');
        $this->load->model('categories_model');
        $this->load->model('supplier_model');
        $this->load->library("Custom");

    }

    public function index()
    {
        $head['title'] = "Products";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/products');
        $this->load->view('fixed/footer');

    }

    public function cat()
    {
        $head['title'] = "Product Categories";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/cat_productlist');
        $this->load->view('fixed/footer');

    }


    public function add()
    {
        $data['cat'] = $this->categories_model->category_list();
        $data['units'] = $this->products->units();
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $data['suppliers'] = $this->supplier_model->supplier_list();
        $data['custom_fields'] = $this->custom->add_fields(4);
        $this->load->model('units_model', 'units');
        $data['variables'] = $this->units->variables_list();
        $head['title'] = "Add Product";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/product-add', $data);
        $this->load->view('fixed/footer');
    }


    public function product_list()
    {
        $catid = $this->input->get('id');

        if ($catid > 0) {
            $list = $this->products->get_datatables($catid);
        } else {
            $list = $this->products->get_datatables();
        }
        $data = array();
        $no = $this->input->post('start');
        $totalSuits = 0;
        $tThansMerter = 0;
        $tThans = 0;
        foreach ($list as $prd) {
            if($prd->title == 'Suits'||$prd->title == 'Suit'){
                $qty = $prd->qty;
                $totalSuits += $prd->qty;
            }else{
                $length = $prd->pro_than_len > 0 ? $prd->qty / $prd->pro_than_len : 0;
                $length = (int)$length;
                $meters = $prd->pro_than_len > 0 ? $prd->qty % $prd->pro_than_len : 0;
                $qty = $length .' Thans ';
                $tThans += $length;
                if($meters != 0){
                    $qty = $qty.$meters.' Metres';
                    $tThansMerter += $meters;
                }
            }
            $no++;
            $row = array();
            $row[] = $no;
            $pid = $prd->pid;
            $row[] = $prd->product_name;
            $row[] = $prd->product_code;
            $row[] = $this->get_qty($pid);
            $row[] = $prd->title;
            $row[] = amountFormat($prd->product_price);
            $btns = '<a href="#" data-object-id="' . $pid . '" class="btn btn-success  btn-sm  view-object"><span class="fa fa-eye"></span> ' . $this->lang->line('View') . '</a> 
                            <div class="btn-group">
                                    <button type="button" class="btn btn-indigo dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>  ' . $this->lang->line('Print') . '                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . base_url() . 'products/barcode?id=' . $pid . '" target="_blank"> ' . $this->lang->line('BarCode') . '</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/posbarcode?id=' . $pid . '" target="_blank"> ' . $this->lang->line('BarCode') . ' - Compact</a>
                                          <div class="dropdown-divider"></div>
                                             <a class="dropdown-item" href="' . base_url() . 'products/label?id=' . $pid . '" target="_blank"> ' . $this->lang->line('Product') . ' Label</a>

                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/poslabel?id=' . $pid . '" target="_blank"> Label - Compact</a>

                                    </div>
                                </div>   <a class="btn btn-pink  btn-sm" href="' . base_url() . 'products/report_product?id=' . $pid . '" target="_blank"> <span class="fa fa-pie-chart"></span> ' . $this->lang->line('Sales') . '</a>';
                        
                                if($this->aauth->premission(10) || $this->aauth->premission(11) ){
                                    $btns .='&nbsp;&nbsp;<div class="btn-group">
                                    <button type="button" class="btn btn btn-primary dropdown-toggle   btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cog"></i>  </button>
                                    <div class="dropdown-menu">';
                                    if($this->aauth->premission(10)){
                                        $btns .= '&nbsp;<a href="' . base_url() . 'products/edit?id=' . $pid . '"  class="btn btn-purple btn-sm"><span class="fa fa-edit"></span>' . $this->lang->line('Edit') . '</a>';
                                    }
                                    if($this->aauth->premission(11)){                                    
                                        $btns .= '<div class="dropdown-divider"></div>
                                        &nbsp;<a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm  delete-object"><span class="fa fa-trash"></span>' . $this->lang->line('Delete') . '</a>';
                                    }
                                
                                $btns .=' </div>
                                </div> ';
                                }
                                                
                                 
            $row[] =  $btns;               
                                 
                                  
           
            // $data['tSuit'] = $totalSuits;
            // $data['thans'] = $tThans;
            // $data['tThanM'] = $tThansMerter;
             $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->products->count_all($catid),
            "recordsFiltered" => $this->products->count_filtered($catid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_qty($pid){
        $totalSuits = 0;
        $tThansMerter = 0;
        $tThans = 0;
        $data = $this->products->quantity($pid);

        if($data->title == 'Suits'||$data->title == 'Suit'){
            $qty = $data->total_qty;
        }else if($data->title == 'Than'||$data->title == 'than'){
            $length = $data->pro_than_len > 0 ? $data->total_qty / $data->pro_than_len : 0;
            $length = (int)$length;
            $meters = fmod($data->total_qty, $data->pro_than_len);
            $qty = $length .' Thans ';
            $tThans += $length;
            if($meters != 0){
                if($length > 0){
                    $qty = $qty.$meters.' Metres';
                }else{
                    $qty = $meters.' Metres';
                }
                $tThansMerter += $meters;
            }
        } else {
            $qty = $data->total_qty;
        } 
        return $qty;
    }
    public function addproduct()
    {

        $party_name = $this->input->post('party_name');
        $product_name = $this->input->post('product_name');
        $warehouse = $this->input->post('product_warehouse');
        $product_code = $this->input->post('product_code');
        $color = $this->input->post('color');
        $product_qty = $quantity = $this->input->post('than') * $this->input->post('length');
        $pro_than_qty = $this->input->post('than');
        $unit = $this->input->post('unit');
        $pro_than_len = $this->input->post('length');
        $factoryprice = $this->input->post('product_price');
        $product_price = $this->input->post('sale_price');
        $code_type = $this->input->post('code_type');
        $barcode = $this->input->post('barcode');
        $catid = $this->input->post('product_type');



        $taxrate = 0;
        $disrate = 0;
        $product_qty_alert =5;
        $product_desc = '';
        $image = '';
        $v_type = '';
        $v_stock = '';
        $v_alert = '';
        $wdate = datefordatabase($this->input->post('wdate'));


        if ($party_name) {
            $this->products->addnew($party_name, $product_name, $warehouse, $product_code, $color, $product_qty,$pro_than_qty, $unit, $pro_than_len, $factoryprice, $product_price, $code_type, $barcode, $taxrate, $disrate, $product_qty_alert, $product_desc, $image, $v_type, $v_stock, $v_alert, $wdate, $catid);
        }

    }

    public function delete_i()
    {
        $id = $this->input->post('deleteid');
        if ($id) {
            $this->db->delete('geopos_products', array('pid' => $id));
            $this->db->delete('geopos_movers', array('d_type' => 1, 'rid1' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function edit()
    {
        $pid = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('geopos_products');
        $this->db->where('pid', $pid);
        $query = $this->db->get();
        $data['product'] = $query->row_array();

        $data['suppliers'] = $this->supplier_model->supplier_list();
        $data['pro_sup'] = $this->supplier_model->sup_pro($pid);
        $data['pro_unit'] = $this->products->pro_uni($pid);

        $data['units'] = $this->products->units();
        $data['cat_ware'] = $this->categories_model->cat_ware($pid);
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $data['cat'] = $this->categories_model->category_list();
        $data['custom_fields'] = $this->custom->view_edit_fields($pid, 4);
        $head['title'] = "Edit Product";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/product-edit', $data);
        $this->load->view('fixed/footer');

    }

    public function editproduct()
    {
        $pid = $this->input->post('pid');
        $party_name = $this->input->post('party_name');
        $product_name = $this->input->post('product_name');
        $warehouse = $this->input->post('product_warehouse');
        $product_code = $this->input->post('product_code');
        $color = $this->input->post('color');
        $product_qty = $quantity = $this->input->post('than') * $this->input->post('length');
        $pro_than_qty = $this->input->post('than');
        $unit = $this->input->post('unit');
        $pro_than_len = $this->input->post('length');
        $factoryprice = $this->input->post('product_price');
        $product_price = $this->input->post('sale_price');
        $code_type = $this->input->post('code_type');
        $barcode = $this->input->post('barcode');
        $catid = $this->input->post('product_type');



        $taxrate = 0;
        $disrate = 0;
        $product_qty_alert =5;
        $product_desc = '';
        $image = '';
        $v_type = '';
        $v_stock = '';
        $v_alert = '';
        $wdate = datefordatabase($this->input->post('wdate'));
        if ($pid) {
            $this->products->edit($pid, $party_name, $product_name, $warehouse, $product_code, $color, $product_qty,$pro_than_qty, $unit, $pro_than_len, $factoryprice, $product_price, $code_type, $barcode, $taxrate, $disrate, $product_qty_alert, $product_desc, $image, $v_type, $v_stock, $v_alert, $wdate, $catid);
        }


    }


    public function warehouseproduct_list()
    {
        $catid = $this->input->get('id');


        $list = $this->products->get_datatables($catid, true);

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $pid = $prd->pid;
            $row[] = $prd->product_name;
            $row[] = +$prd->qty;
            $row[] = $prd->product_code;
            $row[] = $prd->title;
            $row[] = amountFormat($prd->product_price);
            $row[] = '<a href="#" data-object-id="' . $pid . '" class="btn btn-success btn-xs  view-object"><span class="fa fa-eye"></span> ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'products/edit?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="fa fa-pencil"></span> ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs  delete-object"><span class="fa fa-trash"></span> ' . $this->lang->line('Delete') . '</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->products->count_all($catid, true),
            "recordsFiltered" => $this->products->count_filtered($catid, true),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function prd_stats()
    {

        $this->products->prd_stats();


    }

    public function stock_transfer_products()
    {
        $wid = $this->input->get('wid');
        $customer = $this->input->post('product');
        $terms = @$customer['term'];
        $result = $this->products->products_list($wid, $terms);
        echo json_encode($result);


    }

    public function stock_transfer()
    {
        if ($this->input->post()) {

            $products_l = $this->input->post('products_l');
            $from_warehouse = $this->input->post('from_warehouse');
            $to_warehouse = $this->input->post('to_warehouse');
            $qty = $this->input->post('products_qty');


            $this->products->transfer($from_warehouse, $products_l, $to_warehouse, $qty);

        } else {

            $data['cat'] = $this->categories_model->category_list();
            $data['warehouse'] = $this->categories_model->warehouse_list();
            $head['title'] = "Stock Transfer";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/stock_transfer', $data);
            $this->load->view('fixed/footer');
        }


    }


    public function file_handling()
    {
        if ($this->input->get('op')) {
            $name = $this->input->get('name');
            if ($this->products->meta_delete($name)) {
                echo json_encode(array('status' => 'Success'));
            }
        } else {
            $id = $this->input->get('id');
            $this->load->library("Uploadhandler_generic", array(
                'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/product/', 'upload_url' => base_url() . 'userfile/product/'
            ));


        }


    }

    public function barcode()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,barcode,code_type');
            $this->db->from('geopos_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            $data['name'] = $resultz['product_name'];
            $data['code'] = $resultz['barcode'];
            $data['ctype'] = $resultz['code_type'];
            $html = $this->load->view('barcode/view', $data, true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($data['name'] . '_barcode.pdf', 'I');

        }
    }

    public function posbarcode()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,barcode,code_type,product_code');
            $this->db->from('geopos_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            $data['name'] = $resultz['product_name'];
            $data['code'] = $resultz['barcode'];
            $data['ctype'] = $resultz['code_type'];
            $data['product_code'] = $resultz['product_code'];
            $html = $this->load->view('barcode/posbarcode', $data, true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_thermal();
            $pdf->WriteHTML($html);
            $pdf->Output($data['name'] . '_barcode.pdf', 'I');

        }
    }

    public function view_over()
    {
        $pid = $this->input->post('id');
        $this->db->select('geopos_products.*,geopos_warehouse.title');
        $this->db->from('geopos_products');
        $this->db->where('geopos_products.pid', $pid);
        $this->db->join('geopos_warehouse', 'geopos_warehouse.id = geopos_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('geopos_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('geopos_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('geopos_warehouse.loc', 0);
        }

        $query = $this->db->get();
        $data['product'] = $query->row_array();

        $this->db->select('geopos_products.*,geopos_warehouse.title');
        $this->db->from('geopos_products');
        $this->db->join('geopos_warehouse', 'geopos_warehouse.id = geopos_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('geopos_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('geopos_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('geopos_warehouse.loc', 0);
        }
        $this->db->where('geopos_products.merge', 1);
        $this->db->where('geopos_products.sub', $pid);
        $query = $this->db->get();
        $data['product_variations'] = $query->result_array();

        $this->db->select('geopos_products.*,geopos_warehouse.title');
        $this->db->from('geopos_products');
        $this->db->join('geopos_warehouse', 'geopos_warehouse.id = geopos_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('geopos_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('geopos_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('geopos_warehouse.loc', 0);
        }
        $this->db->where('geopos_products.sub', $pid);
        $this->db->where('geopos_products.merge', 2);
        $query = $this->db->get();
        $data['product_warehouse'] = $query->result_array();


        $this->load->view('products/view-over', $data);


    }


    public function label()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,product_price,product_code,barcode,expiry,code_type,pcat');
            $this->db->from('geopos_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();

            $html = $this->load->view('barcode/label', array('lab' => $resultz), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');

        }
    }


    public function poslabel()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,product_price,product_code,barcode,expiry,code_type,pcat');
            $this->db->from('geopos_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            // print_r($resultz);
            //$this->load->view('barcode/label', array('lab'=>$resultz));
            $html = $this->load->view('barcode/poslabel', array('lab' => $resultz), true);
            // echo $html;exit;
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_thermal();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');

        }
    }

    public function report_product()
    {
        $pid = intval($this->input->post('id'));

        $r_type = intval($this->input->post('r_type'));
        $s_date = datefordatabase($this->input->post('s_date'));
        $e_date = datefordatabase($this->input->post('e_date'));

        if ($pid && $r_type) {


            switch ($r_type) {
                case 1 :
                    $query = $this->db->query("SELECT geopos_invoices.tid,geopos_invoice_items.qty,geopos_invoice_items.price,geopos_invoices.invoicedate,geopos_customers.name,customer_basic_info.reference_id
                    FROM geopos_invoice_items 
                    LEFT JOIN geopos_invoices ON geopos_invoices.id=geopos_invoice_items.tid 
                    LEFT JOIN geopos_customers ON geopos_customers.id = geopos_invoices.csd
                    LEFT JOIN customer_basic_info ON geopos_customers.id = customer_basic_info.cus_id
                    WHERE geopos_invoice_items.pid='$pid' AND geopos_invoices.status!='canceled' 
                    AND (DATE(geopos_invoices.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;

                case 2 :
                    $query = $this->db->query("SELECT geopos_purchase.tid,geopos_purchase_items.qty,geopos_purchase_items.price,geopos_purchase.invoicedate 
                    FROM geopos_purchase_items 
                    LEFT JOIN geopos_purchase ON geopos_purchase.id=geopos_purchase_items.tid 
                    WHERE geopos_purchase_items.pid='$pid' AND geopos_purchase.status!='canceled' 
                    AND (DATE(geopos_purchase.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;

                case 3 :
                    $query = $this->db->query("SELECT rid2 AS qty, DATE(d_time) AS  invoicedate,note FROM geopos_movers  WHERE geopos_movers.d_type='1' AND rid1='$pid'  AND (DATE(d_time) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;
            }

            $this->db->select('*');
            $this->db->from('geopos_products');
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $cat_ware = $this->categories_model->cat_ware($pid, $this->aauth->get_user()->loc);

//if(!$cat_ware) exit();
            $html = $this->load->view('products/statementpdf-ltr', array('report' => $result, 'product' => $product, 'cat_ware' => $cat_ware, 'r_type' => $r_type), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pid . 'report.pdf', 'I');
        } else {
            $pid = intval($this->input->get('id'));
            $this->db->select('*');
            $this->db->from('geopos_products');
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $product = $query->row_array();


            $head['title'] = "Product Sales";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/statement', array('id' => $pid, 'product' => $product));
            $this->load->view('fixed/footer');
        }
    }


}