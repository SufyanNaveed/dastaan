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

class Reports_model extends CI_Model
{

    public function index()
    {


        $query = $this->db->query("SELECT pid,product_name,product_price FROM geopos_products WHERE UPPER(product_name) LIKE '" . strtoupper($name) . "%'");

        $result = $query->result_array();

        return $result;
    }

    public function viewstatement($pay_acc, $trans_type, $sdate, $edate, $ttype)
    {

        if ($trans_type == 'All') {
            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') ";
        } else {
            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
        }
        $this->db->select('*');
        $this->db->from('geopos_transactions');
        $this->db->where($where);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function get_statements($pay_acc, $trans_type, $sdate, $edate)
    {

        if ($trans_type == 'All') {
            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') ";
        } else {
            $where = "acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
        }
        $this->db->select('geopos_transactions.*,gi.tax, gi.pmethod');
        $this->db->from('geopos_transactions');
        $this->db->join('geopos_invoices as gi','gi.id = geopos_transactions.tid','left');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        //  $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    //transaction account statement

    var $table = 'geopos_transactions';
    var $column_order = array(null, 'account', 'type', 'cat', 'amount', 'stat');
    var $column_search = array('id', 'account');
    var $order = array('id' => 'asc');
    var $opt = '';


    //income statement


    public function incomestatement()
    {


        $this->db->select_sum('lastbal');
        $this->db->from('geopos_accounts');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $query = $this->db->get();
        $result = $query->row_array();

        $lastbal = $result['lastbal'];

        $this->db->select_sum('credit');
        $this->db->from('geopos_transactions');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $this->db->where('type', 'Income');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(date) >=', "$month-01");
        $this->db->where('DATE(date) <=', $today);

        $query = $this->db->get();
        $result = $query->row_array();

        $motnhbal = $result['credit'];
        return array('lastbal' => $lastbal, 'monthinc' => $motnhbal);

    }

    public function customincomestatement($acid, $sdate, $edate)
    {


        $this->db->select_sum('credit');
        $this->db->from('geopos_transactions');
        if ($acid > 0) {
            $this->db->where('acid', $acid);
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $this->db->where('type', 'Income');
        $this->db->where('DATE(date) >=', $sdate);
        $this->db->where('DATE(date) <=', $edate);
        // $this->db->where("DATE(date) BETWEEN '$sdate' AND '$edate'");
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

    //expense statement


    public function expensestatement()
    {


        $this->db->select_sum('debit');
        $this->db->from('geopos_transactions');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $this->db->where('type', 'Expense');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(date) >=', "$month-01");
        $this->db->where('DATE(date) <=', $today);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $query = $this->db->get();
        $result = $query->row_array();

        $motnhbal = $result['debit'];
        return array('monthinc' => $motnhbal);

    }

    public function customexpensestatement($acid, $sdate, $edate)
    {


        $this->db->select_sum('debit');
        $this->db->from('geopos_transactions');
        if ($acid > 0) {
            $this->db->where('acid', $acid);
        }
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        $this->db->where('type', 'Expense');
        $this->db->where('DATE(date) >=', $sdate);
        $this->db->where('DATE(date) <=', $edate);
        // $this->db->where("DATE(date) BETWEEN '$sdate' AND '$edate'");
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

    public function statistics($limit = false)
    {
        $this->db->from('geopos_reports');
        // if($limit) $this->db->limit(12);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_customer_statements($pay_acc, $trans_type, $sdate, $edate)
    {

        if ($trans_type == 'All') {
            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND ext=0";
        } else {
            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type' AND ext=0";
        }
        $this->db->select('*');
        $this->db->from('geopos_transactions');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        //  $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function get_supplier_statements($pay_acc, $trans_type, $sdate, $edate)
    {

        if ($trans_type == 'All') {
            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND ext=1";
        } else {
            $where = "payerid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type' AND ext=1";
        }
        $this->db->select('*');
        $this->db->from('geopos_transactions');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
            $this->db->or_where('loc', 0);
        }
        //  $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    //
    //income statement


    public function profitstatement()
    {


    }

    public function customprofitstatement($lid, $sdate, $edate)
    {


        $this->db->select_sum('geopos_metadata.col1');
        $this->db->from('geopos_metadata');
        $this->db->where('geopos_metadata.type', 9);
        $this->db->where('DATE(geopos_metadata.d_date) >=', $sdate);
        $this->db->where('DATE(geopos_metadata.d_date) <=', $edate);
        if ($lid > 0) {
            $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_metadata.rid', 'left');
            $this->db->where('geopos_invoices.loc', $lid);
        }

        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

        public function customcommission($lid, $sdate, $edate)
    {

        $this->db->select('c_rate');
        $this->db->from('geopos_employees');
        $this->db->where('id', $lid);
        $query = $this->db->get();
        $result_e = $query->row_array();
        $this->db->select_sum('total');
        $this->db->from('geopos_invoices');
        $this->db->where('eid', $lid);
        $this->db->where('status !=', 'canceled');
        $this->db->where('DATE(geopos_invoices.invoicedate) >=', $sdate);
        $this->db->where('DATE(geopos_invoices.invoiceduedate) <=', $edate);
       $query = $this->db->get();
        $result = $query->row_array();
      if($result_e['c_rate']>0 AND  $result['total']>0) {
          $amount = $result_e['c_rate'] / $result['total'];
          $amount = $amount * 100;
          return amountExchange_s($amount, 0, $this->aauth->get_user()->loc);
      }
      else {
          return 0;
      }
    }

    //sales statement


    public function salesstatement()
    {

    }

    public function customsalesstatement($lid, $sdate, $edate)
    {
        $this->db->select_sum('total');
        $this->db->from('geopos_invoices');
        $this->db->where('DATE(invoicedate) >=', $sdate);
        $this->db->where('DATE(invoicedate) <=', $edate);
        if ($lid > 0) {
            $this->db->where('loc', $lid);
        }
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    //products statement


    public function productsstatement()
    {
        $this->db->select_sum('qty');
        $this->db->select_sum('subtotal');
        $this->db->from('geopos_invoice_items');
        $query = $this->db->get();
        $result = $query->row_array();
        $qty = $result['qty'];
        $subtotal = $result['subtotal'];

        $this->db->select_sum('geopos_invoice_items.qty');
        $this->db->select_sum('geopos_invoice_items.subtotal');
        $this->db->from('geopos_invoice_items');
        $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_invoice_items.tid', 'left');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $this->db->where('DATE(geopos_invoices.invoicedate) >=', "$month-01");
        $this->db->where('DATE(geopos_invoices.invoicedate) <=', $today);
        $query = $this->db->get();
        $result = $query->row_array();
        $qty_m = $result['qty'];
        $subtotal_m = $result['subtotal'];
        return array('qty' => $qty, 'qty_m' => $qty_m, 'subtotal' => $subtotal, 'subtotal_m' => $subtotal_m);
    }

    public function customproductsstatement($lid, $sdate, $edate)
    {

        $this->db->select_sum('geopos_invoice_items.qty');
        $this->db->select_sum('geopos_invoice_items.subtotal');
        $this->db->from('geopos_invoice_items');
        $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_invoice_items.tid', 'left');
        $this->db->where('DATE(geopos_invoices.invoicedate) >=', $sdate);
        $this->db->where('DATE(geopos_invoices.invoicedate) <=', $edate);
        if ($lid > 0) {
            $this->db->where('geopos_invoices.loc', $lid);
        }
        $query = $this->db->get();
        $result = $query->row_array();

        return $result;
    }

    public function customproductsstatement_cat($lid, $sdate, $edate)
    {

        $this->db->select_sum('geopos_invoice_items.qty');
        $this->db->select_sum('geopos_invoice_items.subtotal');
        $this->db->from('geopos_invoice_items');
        $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_invoice_items.tid', 'left');
        $this->db->join('geopos_products', 'geopos_products.pid = geopos_invoice_items.pid', 'left');
        $this->db->where('DATE(geopos_invoices.invoicedate) >=', $sdate);
        $this->db->where('DATE(geopos_invoices.invoicedate) <=', $edate);
        if ($lid > 0) {
            $this->db->where('geopos_products.pid', $lid);
        }
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    //fetch data

    public function fetchdata($page)
    {

        switch ($page) {
            case 'products' :

                $this->db->select_sum('geopos_invoice_items.qty');
                $this->db->select_sum('geopos_invoice_items.subtotal');
                $this->db->from('geopos_invoice_items');
                $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_invoice_items.tid', 'left');
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('geopos_invoices.loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('geopos_invoices.loc', 0);
                }
                $query = $this->db->get();
                $result = $query->row_array();
                $qty = $result['qty'];
                $subtotal = $result['subtotal'];
                $this->db->select_sum('geopos_invoice_items.qty');
                $this->db->select_sum('geopos_invoice_items.subtotal');
                $this->db->from('geopos_invoice_items');
                $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_invoice_items.tid', 'left');
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('geopos_invoices.loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('geopos_invoices.loc', 0);
                }
                $month = date('Y-m');
                $today = date('Y-m-d');
                $this->db->where('DATE(geopos_invoices.invoicedate) >=', "$month-01");
                $this->db->where('DATE(geopos_invoices.invoicedate) <=', $today);
                $query = $this->db->get();
                $result = $query->row_array();
                $qty_m = $result['qty'];
                $subtotal_m = $result['subtotal'];
                return array('p1' => $qty, 'p2' => $qty_m, 'p3' => amountFormat($subtotal), 'p4' => amountFormat($subtotal_m));
                break;

            case 'sales' :
                $this->db->select_sum('total');
                $this->db->from('geopos_invoices');
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('loc', 0);
                }
                $query = $this->db->get();
                $result = $query->row_array();
                $lastbal = $result['total'];
                $this->db->select_sum('total');
                $this->db->from('geopos_invoices');
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('loc', 0);
                }
                $month = date('Y-m');
                $today = date('Y-m-d');
                $this->db->where('DATE(invoicedate) >=', "$month-01");
                $this->db->where('DATE(invoicedate) <=', $today);
                $query = $this->db->get();
                $result = $query->row_array();
                $motnhbal = $result['total'];
                return array('p1' => amountFormat($lastbal), 'p2' => amountFormat($motnhbal), 'p3' => 0, 'p4' => 0);

                break;

            case 'profit':

                $this->db->select_sum('geopos_metadata.col1');
                $this->db->from('geopos_metadata');
                $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_metadata.rid', 'left');
                $this->db->where('geopos_metadata.type', 9);
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('geopos_invoices.loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('geopos_invoices.loc', 0);
                }
                $query = $this->db->get();
                $result = $query->row_array();

                $lastbal = $result['col1'];

                $this->db->select_sum('geopos_metadata.col1');
                $this->db->from('geopos_metadata');
                $this->db->where('geopos_metadata.type', 9);
                $this->db->join('geopos_invoices', 'geopos_invoices.id = geopos_metadata.rid', 'left');
                if ($this->aauth->get_user()->loc) {
                    $this->db->where('geopos_invoices.loc', $this->aauth->get_user()->loc);
                    $this->db->or_where('geopos_invoices.loc', 0);
                }
                $month = date('Y-m');
                $today = date('Y-m-d');
                $this->db->where('DATE(geopos_metadata.d_date) >=', "$month-01");
                $this->db->where('DATE(geopos_metadata.d_date) <=', $today);
                $query = $this->db->get();
                $result = $query->row_array();
                $motnhbal = $result['col1'];
                return array('p1' => amountFormat($lastbal), 'p2' => amountFormat($motnhbal), 'p3' => 0, 'p4' => 0);
        }

    }


}

