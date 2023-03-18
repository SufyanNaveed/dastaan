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

class Customers extends CI_Controller {

    public function __construct() {
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

    public function index() {
        $due = $this->input->get('due');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Customers';
        $data['sum_due'] = '';
        if (isset($due) && $due == true) {
            $data['sum_due'] = $this->customers->get_sum_due();
        }
        // echo '<pre>'; print_r($data);exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/clist', $data);
        $this->load->view('fixed/footer');
    }

    public function new_articles_append() {
        $data['count'] = $this->input->post('count');
        $this->load->view('customers/new_articles_append', $data);
    }

    public function create() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $data['customergrouplist'] = $this->customers->group_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['custom_fields'] = $this->custom->add_fields(1);
        $data['ref_no'] = $this->customers->last_record() + 1;
        $head['title'] = 'Create Customer';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/create', $data);
        $this->load->view('fixed/footer');
    }

    public function view() {
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
        if ($data['details']['id'])
            $this->load->view('customers/view', $data);
        $this->load->view('fixed/footer');
    }

    public function tailor() {
        $cid = $this->input->get('id');
        $tid = $this->input->get('id');
        $vPDF = $this->input->get('ignore_pdf') == NULL ? true : false;

        $data['id'] = $tid;

        //$data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);

        $data['nap'] = $this->customers->details($cid);
//           echo '<pre>'; print_r($data['nap']);exit;

        $pref = prefix(7);

        $data['general'] = array('title' => "Cutomer View", 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);

        ini_set('memory_limit', '64M');


        if ($vPDF) {
            $html = $this->load->view('print_files/tailor', $data, true);
            //echo $html;
            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_split(array('margin_top' => 2));
            $pdf->WriteHTML($html);
            if ($this->input->get('d')) {
                $pdf->Output('Invoice_pos' . $data['nap'][0]['reference_id'] . '.pdf', 'D');
            } else {
                $pdf->Output('Invoice_pos' . $data['nap'][0]['reference_id'] . '.pdf', 'I');
            }
        } else {
            echo $this->load->view('print_files/tailor', $data, true);
        }
    }

    public function preview() {
        $aPreviewData = [];
        $vIndex = $this->input->post('index') != NULL ? $this->input->post('index') : 0;
        $cur_counter = $this->input->post('cur_counter') != NULL ? $this->input->post('cur_counter') : 0;
        $vShirtCount = $this->input->post('is_shirts') != NULL ? count($this->input->post('is_shirts')) : 0;
        $vSuitingCount = $this->input->post('is_suiting') != NULL ? count($this->input->post('is_suiting')) : 0;
        $vShalwarKamezCount = $this->input->post('is_shalwarqameez') != NULL ? count($this->input->post('is_shalwarqameez')) : 0;
        $vTotalCOunt = $vShirtCount + $vSuitingCount + $vShalwarKamezCount;
        $vSuitingCountIndex = 0;
        $vShirtCountIndex = 0;
        $vKmzCountIndex = 0;
        $cSleeve = [];
        $aShirtLength = [];
        $akmzLength = [];
        for ($i = 0; $i < $vTotalCOunt; $i++) {


            $is_suiting = false;
            $is_shirts = false;
            $is_shalwarqameez = false;

            if ($vSuitingCount) {
                $is_suiting = true;
            } else if ($vShirtCount) {
                $is_shirts = true;
            } else if ($vShalwarKamezCount) {
                $is_shalwarqameez = true;
            }
            if (empty($cSleeve))
                $cSleeve = $this->input->post('cSleeve');
            if (empty($aShirtLength))
                $aShirtLength = $this->input->post('shirtLength');
            if (empty($akmzLength))
                $akmzLength = $this->input->post('kmzLength');


            $instrucation = "";
            $shirt_inst = "";
            $shalwar_inst = "";
            //echo $i. '<br>'; 
            $cSleeves = '';
            $cShoulder = '';
            $cHalfBack = '';
            $cCrossBack = '';
            $cChest = '';
            $cWaist = '';
            $cHips = '';
            $cBicep = '';
            $cForearm = '';
            $cNeck = '';
            $cLength = '';
            $p3_waistcoat_length = '';
            $waistcoat_length = '';
            $princecoat_length = '';
            $sherwani_length = '';
            $longcoat_length = '';
            $chester_length = '';
            $armhole = '';

            /* Get pant length */
            $pLength = '';
            $pInLength = '';
            $pWaist = '';
            $pHip = '';
            $pThigh = '';
            $pBottom = '';
            $pKnee = '';

            /* Get Suiting Checks */
            $is_breasted = 0;
            $is_double_breasted = 0;
            $is_button_suit = 0;
            $is_two_button_suit = 0;
            $is_lapel = 0;
            $is_peak_lapel = 0;
            $is_shawl_lapel = 0;
            $is_wear = 0;
            $is_casual_wear = 0;
            $is_groom_wear = 0;
            $is_vent = 0;
            $is_double_vent = 0;
            $is_no_vent = 0;
            $is_lined = 0;
            $is_half_lined = 0;
            $is_ticket = 0;
            $is_slant = 0;
            $is_regular = 0;
            $is_button = 0;
            $is_metalic_button = 0;

            $shirtLength = '';
            $shirtShoulder = '';
            $shirtSleeves = '';
            $shirtNeck = '';
            $shirtChest = '';
            $shirtWaist = '';
            $shirtHips = '';
            $shirtBicep = '';
            $shirtForearm = '';
            $shirtarmhole = '';
            $shirtcuff = '';

            $is_darts = 0;
            $is_sleeve_placket = 0;
            $is_front_placket = 0;
            $is_plane_placket = 0;
            $is_shirt_cuff = 0;
            $is_plain_cuff = 0;
            $is_french_cuff = 0;
            $is_double_cuff = 0;
            $is_shirt_collar = 0;
            $is_shirt_collar_type = 0;

            $kmzLength = '';
            $kurtaLength = '';
            $kmzSleeves = '';
            $kmzShoulder = '';
            $kmzNeck = '';
            $kmzChest = '';
            $kmzWaist = '';
            $kmzGuaira = '';
            $kmzHips = '';
            $kmzBicep = '';
            $kmzForearm = '';
            $kmzarmhole = '';
            $kmzcuff = '';

            /* Shwalr size */
            $shlLength = '';
            $shlBottom = '';
            $shlAsanTyar = '';
            $shlGairaTyar = '';
            $pjamaLength = '';
            $pjamaBottom = '';

            $is_collar = 0;
            $is_straight_front = 0;
            $is_1side_pocket = 0;
            $is_front_pocket = 0;
            $is_shalwar_pocket = 0;
            $is_sleeve_placket = 0;
            $is_plain_button = 0;
            $is_button_cuff = 0;
            $is_design = 0;
            $is_kanta = 0;
            $is_stitch = 0;
            $is_thread = 0;
            $is_bookrum = 0;
            $is_moon_neck = 0;
            $is_2side_pocket = 0;
            $is_fancy_button = 0;
            $is_band = 0;
            $is_round_front = 0;
            $is_covered_fly = 0;
            $is_open_sleeves = 0;
            $shirt_collar_ins = '';
            $collar_ins = '';
            $front_pocket_ins = '';
            $shalwar_pocket_ins = ''; 
            $vAllowed = false;
            if ($is_suiting) { 
                /* Get  coat/waist coat size */
                foreach ($cSleeve as $thisIndex => $thisItem)
                    if ($thisItem) {
                        $vSuitingCountIndex = $thisIndex;
                        break;
                    }
                    $vSuitingCountIndex = $cur_counter;
                    if($this->input->post("aa_name[" . $vSuitingCountIndex . "]")==$vIndex)
                           $vAllowed = true; 
                    $cSleeves = $this->input->post("cSleeve[" . $vSuitingCountIndex . "]");
                    $cShoulder = $this->input->post("cShoulder[" . $vSuitingCountIndex . "]");
                    $cHalfBack = $this->input->post("cHalfBack[" . $vSuitingCountIndex . "]");
                    $cCrossBack = $this->input->post("cCrossBack[" . $vSuitingCountIndex . "]");
                    $cChest = $this->input->post("cChest[" . $vSuitingCountIndex . "]");
                    $cWaist = $this->input->post("cWaist[" . $vSuitingCountIndex . "]");
                    $cHips = $this->input->post("cHips[" . $vSuitingCountIndex . "]");
                    $cBicep = $this->input->post("cBicep[" . $vSuitingCountIndex . "]");
                    $cForearm = $this->input->post("cForearm[" . $vSuitingCountIndex . "]");
                    $cNeck = $this->input->post("cNeck[" . $vSuitingCountIndex . "]");
                    $cLength = $this->input->post("cLength[" . $vSuitingCountIndex . "]");
                    $p3_waistcoat_length = $this->input->post("3p_waistcoat_length[" . $vSuitingCountIndex . "]");
                    $waistcoat_length = $this->input->post("waistcoat_length[" . $vSuitingCountIndex . "]");
                    $princecoat_length = $this->input->post("princecoat_length[" . $vSuitingCountIndex . "]");
                    $sherwani_length = $this->input->post("sherwani_length[" . $vSuitingCountIndex . "]");
                    $longcoat_length = $this->input->post("longcoat_length[" . $vSuitingCountIndex . "]");
                    $chester_length = $this->input->post("chester_length[" . $vSuitingCountIndex . "]");
                    $armhole = $this->input->post("armhole[" . $vSuitingCountIndex . "]");

                    /* Get pant length */
                    $pLength = $this->input->post("pLength[" . $vSuitingCountIndex . "]");
                    $pInLength = $this->input->post("pInLength[" . $vSuitingCountIndex . "]");
                    $pWaist = $this->input->post("pWaist[" . $vSuitingCountIndex . "]");
                    $pHip = $this->input->post("pHip[" . $vSuitingCountIndex . "]");
                    $pThigh = $this->input->post("pThigh[" . $vSuitingCountIndex . "]");
                    $pBottom = $this->input->post("pBottom[" . $vSuitingCountIndex . "]");
                    $pKnee = $this->input->post("pKnee[" . $vSuitingCountIndex . "]");

                    if (isset($_POST["is_breasted"][$vSuitingCountIndex]) && !empty($_POST["is_breasted"][$vSuitingCountIndex])) {
                        $is_breasted = $_POST["is_breasted"][$vSuitingCountIndex];
                    } else {
                        $is_breasted = isset($_POST["is_breasted"][0]) ? $_POST["is_breasted"][0] : 0;
                    }

                    if (isset($_POST["is_button_suit"][$vSuitingCountIndex]) && !empty($_POST['is_button_suit'][$vSuitingCountIndex])) {
                        $is_button_suit = $_POST["is_button_suit"][$vSuitingCountIndex];
                    } else {
                        $is_button_suit = isset($_POST["is_button_suit"][0]) ? $_POST["is_button_suit"][0] : 0;
                    }

                    if (isset($_POST["is_lapel"][$vSuitingCountIndex]) && !empty($_POST['is_lapel'][$vSuitingCountIndex])) {
                        $is_lapel = $_POST["is_lapel"][$vSuitingCountIndex];
                    } else {
                        $is_lapel = isset($_POST["is_lapel"][0]) ? $_POST["is_lapel"][0] : 0;
                    }

                    if (isset($_POST["is_vent"][$vSuitingCountIndex]) && !empty($_POST['is_vent'][$vSuitingCountIndex])) {
                        $is_vent = $_POST['is_vent'][$vSuitingCountIndex];
                    } else {
                        $is_vent = isset($_POST["is_vent"][0]) ? $_POST["is_vent"][0] : 0;
                    }

                    if (isset($_POST["is_wear"][$vSuitingCountIndex]) && !empty($_POST['is_wear'][$vSuitingCountIndex])) {
                        $is_wear = $_POST['is_wear'][$vSuitingCountIndex];
                    } else {
                        $is_wear = isset($_POST["is_wear"][0]) ? $_POST["is_wear"][0] : 0;
                    }

                    if (isset($_POST["is_lined"][$vSuitingCountIndex]) && !empty($_POST['is_lined'][$vSuitingCountIndex])) {
                        $is_lined = $_POST['is_lined'][$vSuitingCountIndex];
                    } else {
                        $is_lined = isset($_POST["is_lined"][0]) ? $_POST["is_lined"][0] : 0;
                    }

                    if (isset($_POST["is_ticket"][$vSuitingCountIndex]) && !empty($_POST['is_ticket'][$vSuitingCountIndex])) {
                        $is_ticket = $_POST['is_ticket'][$vSuitingCountIndex];
                    } else {
                        $is_ticket = isset($_POST["is_ticket"][0]) ? $_POST["is_ticket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_pocket"][$vSuitingCountIndex]) && !empty($_POST['is_suit_pocket'][$vSuitingCountIndex])) {
                        $is_regular = $_POST['is_suit_pocket'][$vSuitingCountIndex];
                    } else {
                        $is_regular = isset($_POST["is_suit_pocket"][0]) ? $_POST["is_suit_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_button"][$vSuitingCountIndex]) && !empty($_POST['is_suit_button'][$vSuitingCountIndex])) {
                        $is_button = $_POST['is_suit_button'][$vSuitingCountIndex];
                    } else {
                        $is_button = isset($_POST["is_suit_button"][0]) ? $_POST["is_suit_button"][0] : 0;
                    }
                    $instrucation = $this->input->post("inst[" . $vSuitingCountIndex . "]");
                    $cSleeve[$vSuitingCountIndex] = 0;
                    $vSuitingCount--;
                }

                if ($is_shirts) { 
                    
                    foreach ($aShirtLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vShirtCountIndex = $thisIndex;
                            break;
                        }
                        $vShirtCountIndex = $cur_counter; 
                        if($this->input->post("aa_name[" . $vShirtCountIndex . "]")==$vIndex)
                            $vAllowed = true; 
                    $shirtLength = $this->input->post("shirtLength[" . $vShirtCountIndex . "]");
                    $shirtShoulder = $this->input->post("shirtShoulder[" . $vShirtCountIndex . "]");
                    $shirtSleeves = $this->input->post("shirtSleeves[" . $vShirtCountIndex . "]");
                    $shirtNeck = $this->input->post("shirtNeck[" . $vShirtCountIndex . "]");
                    $shirtChest = $this->input->post("shirtChest[" . $vShirtCountIndex . "]");
                    $shirtWaist = $this->input->post("shirtWaist[" . $vShirtCountIndex . "]");
                    $shirtHips = $this->input->post("shirtHips[" . $vShirtCountIndex . "]");
                    $shirtBicep = $this->input->post("shirtBicep[" . $vShirtCountIndex . "]");
                    $shirtForearm = $this->input->post("shirtForearm[" . $vShirtCountIndex . "]");
                    $shirtarmhole = $this->input->post("shirtarmhole[" . $vShirtCountIndex . "]");
                    $shirtcuff = $this->input->post("shirtcuff[" . $vShirtCountIndex . "]");

                    if (isset($_POST["is_placket"][$vShirtCountIndex]) && !empty($_POST['is_placket'][$vShirtCountIndex])) {
                        $is_placket = $_POST['is_placket'][$vShirtCountIndex];
                        if ($is_placket == 1)
                            $is_front_placket = 1;
                        else if ($is_placket == 2)
                            $is_plane_placket = 1;
                    } else {
                        $is_front_placket = isset($_POST["is_placket"][0]) ? $_POST["is_placket"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_cuff"][$vShirtCountIndex]) && !empty($_POST['is_shirt_cuff'][$vShirtCountIndex])) {
                        $is_shirt_cuff = $_POST['is_shirt_cuff'][$vShirtCountIndex];
                    } else {
                        $is_shirt_cuff = isset($_POST["is_shirt_cuff"][0]) ? $_POST["is_shirt_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar'][$vShirtCountIndex])) {
                        $is_shirt_collar = $_POST['is_shirt_collar'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar = isset($_POST["is_shirt_collar"][0]) ? $_POST["is_shirt_collar"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar_type"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar_type'][$vShirtCountIndex])) {
                        $is_shirt_collar_type = $_POST['is_shirt_collar_type'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar_type = isset($_POST["is_shirt_collar_type"][0]) ? $_POST["is_shirt_collar_type"][0] : 0;
                    }
                    $shirt_collar_ins = $this->input->post("shirt_collar_ins[" . $vShirtCountIndex . "]");
                    $shirt_inst = $this->input->post("shirt_inst[" . $vShirtCountIndex . "]");
                    $aShirtLength[$vShirtCountIndex] = 0;
                    $vShirtCount--;
                }
                if ($is_shalwarqameez) {
    
                    if (array_search($vIndex, $this->input->post("kmzLength_form")) >= 0 && $this->input->post("kmzLength[" . array_search($vIndex, $this->input->post("kmzLength_form")) . "]"))
                        $vAllowed = true;;
                    /* Get kamiz size */
                    foreach ($akmzLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vKmzCountIndex = $thisIndex;
                            break;
                        }

                        $vKmzCountIndex = $cur_counter; 
                    
                        if($this->input->post("aa_name[" . $vKmzCountIndex . "]")==$vIndex)
                                $vAllowed = true; 

                        $kmzLength = $this->input->post("kmzLength[" . $vKmzCountIndex . "]");
                        $kurtaLength = $this->input->post("kurtaLength[" . $vKmzCountIndex . "]");
                        $kmzSleeves = $this->input->post("kmzSleeves[" . $vKmzCountIndex . "]");
                        $kmzShoulder = $this->input->post("kmzShoulder[" . $vKmzCountIndex . "]");
                        $kmzNeck = $this->input->post("kmzNeck[" . $vKmzCountIndex . "]");
                        $kmzChest = $this->input->post("kmzChest[" . $vKmzCountIndex . "]");
                        $kmzWaist = $this->input->post("kmzWaist[" . $vKmzCountIndex . "]");
                        $kmzGuaira = $this->input->post("kmzGuaira[" . $vKmzCountIndex . "]");
                        $kmzHips = $this->input->post("kmzHips[" . $vKmzCountIndex . "]");
                        $kmzBicep = $this->input->post("kmzBicep[" . $vKmzCountIndex . "]");
                        $kmzForearm = $this->input->post("kmzForearm[" . $vKmzCountIndex . "]");
                        $kmzarmhole = $this->input->post("kmzarmhole[" . $vKmzCountIndex . "]");
                        $kmzcuff = $this->input->post("kmzcuff[" . $vKmzCountIndex . "]");

                        /* Shwalr size */
                        $shlLength = $this->input->post("shlLength[" . $vKmzCountIndex . "]");
                        $shlBottom = $this->input->post("shlBottom[" . $vKmzCountIndex . "]");
                        $shlAsanTyar = $this->input->post("shlAsanTyar[" . $vKmzCountIndex . "]");
                        $shlGairaTyar = $this->input->post("shlGairaTyar[" . $vKmzCountIndex . "]");
                        $pjamaLength = $this->input->post("pjamaLength[" . $vKmzCountIndex . "]");
                        $pjamaBottom = $this->input->post("pjamaBottom[" . $vKmzCountIndex . "]");

                        if (isset($_POST["is_collar"][$vKmzCountIndex]) && !empty($_POST['is_collar'][$vKmzCountIndex])) {
                            $is_collar = $_POST['is_collar'][$vKmzCountIndex];
                        } else {
                            $is_collar = isset($_POST["is_collar"][0]) ? $_POST["is_collar"][0] : 0;
                        }
                        $collar_ins = $this->input->post("collar_ins[" . $vKmzCountIndex . "]");

                        if (isset($_POST["is_front"][$vKmzCountIndex]) && !empty($_POST['is_front'][$vKmzCountIndex])) {
                            $is_straight_front = $_POST['is_front'][$vKmzCountIndex];
                        } else {
                            $is_straight_front = isset($_POST["is_front"][0]) ? $_POST["is_front"][0] : 0;
                        }

                        if (isset($_POST["is_front_pocket"][$vKmzCountIndex]) && !empty($_POST['is_front_pocket'][$vKmzCountIndex])) {
                            $is_front_pocket = $_POST['is_front_pocket'][$vKmzCountIndex];
                        } else {
                            $is_front_pocket = isset($_POST["is_front_pocket"][0]) ? $_POST["is_front_pocket"][0] : 0;
                        }
                        $front_pocket_ins = $this->input->post("front_pocket_ins[" . $vKmzCountIndex . "]");

                        if (isset($_POST["is_shalwar_pocket"][$vKmzCountIndex]) && !empty($_POST['is_shalwar_pocket'][$vKmzCountIndex])) {
                            $is_shalwar_pocket = $_POST['is_shalwar_pocket'][$vKmzCountIndex];
                        } else {
                            $is_shalwar_pocket = isset($_POST["is_shalwar_pocket"][0]) ? $_POST["is_shalwar_pocket"][0] : 0;
                        }
                        $shalwar_pocket_ins = $this->input->post("shalwar_pocket_ins[" . $vKmzCountIndex . "]");

                        if (isset($_POST["is_pocket"][$vKmzCountIndex]) && !empty($_POST['is_pocket'][$vKmzCountIndex])) {
                            $is_1side_pocket = $_POST['is_pocket'][$vKmzCountIndex];
                        } else {
                            $is_1side_pocket = isset($_POST["is_pocket"][0]) ? $_POST["is_pocket"][0] : 0;
                        }

                        if (isset($_POST["is_sleeve_placket"][$vKmzCountIndex]) && !empty($_POST['is_sleeve_placket'][$vKmzCountIndex])) {
                            $is_sleeve_placket = $_POST['is_sleeve_placket'][$vKmzCountIndex];
                        } else {
                            $is_sleeve_placket = isset($_POST["is_sleeve_placket"][0]) ? $_POST["is_sleeve_placket"][0] : 0;
                        }

                        if (isset($_POST["is_button"][$vKmzCountIndex]) && !empty($_POST['is_button'][$vKmzCountIndex])) {
                            $is_plain_button = $_POST['is_button'][$vKmzCountIndex];
                        } else {
                            $is_plain_button = isset($_POST["is_button"][0]) ? $_POST["is_button"][0] : 0;
                        }

                        if (isset($_POST["is_cuff"][$vKmzCountIndex]) && !empty($_POST['is_cuff'][$vKmzCountIndex])) {
                            $is_button_cuff = $_POST['is_cuff'][$vKmzCountIndex];
                        } else {
                            $is_button_cuff = isset($_POST["is_cuff"][0]) ? $_POST["is_cuff"][0] : 0;
                        }

                        if (isset($_POST["is_design"][$vKmzCountIndex]) && !empty($_POST['is_design'][$vKmzCountIndex])) {
                            $is_design = $_POST['is_design'][$vKmzCountIndex];
                        } else {
                            $is_design = isset($_POST["is_design"][0]) ? $_POST["is_design"][0] : 0;
                        }

                        if (isset($_POST["is_kanta"][$vKmzCountIndex]) && !empty($_POST['is_kanta'][$vKmzCountIndex])) {
                            $is_kanta = $_POST['is_kanta'][$vKmzCountIndex];
                        } else {
                            $is_kanta = isset($_POST["is_kanta"][0]) ? $_POST["is_kanta"][0] : 0;
                        }

                        if (isset($_POST["is_stitch"][$vKmzCountIndex]) && !empty($_POST['is_stitch'][$vKmzCountIndex])) {
                            $is_stitch = $_POST['is_stitch'][$vKmzCountIndex];
                        } else {
                            $is_stitch = isset($_POST["is_stitch"][0]) ? $_POST["is_stitch"][0] : 0;
                        }

                        if (isset($_POST["is_thread"][$vKmzCountIndex]) && !empty($_POST['is_thread'][$vKmzCountIndex])) {
                            $is_thread = $_POST['is_thread'][$vKmzCountIndex];
                        } else {
                            $is_thread = isset($_POST["is_thread"][0]) ? $_POST["is_thread"][0] : 0;
                        }

                        if (isset($_POST["is_bookrum"][$vKmzCountIndex]) && !empty($_POST['is_bookrum'][$vKmzCountIndex])) {
                            $is_bookrum = $_POST['is_bookrum'][$vKmzCountIndex];
                        } else {
                            $is_bookrum = isset($_POST["is_bookrum"][0]) ? $_POST["is_bookrum"][0] : 0;
                        }

                        $shalwar_inst = $this->input->post("shalwar_inst[" . $vKmzCountIndex . "]");
                        $akmzLength[$vKmzCountIndex] = 0;
                        $vShalwarKamezCount--;
                    
                }



            $nap['is_design'] = $is_design;
            $nap['is_kanta'] = $is_kanta;
            $nap['is_stitch'] = $is_stitch;
            $nap['is_thread'] = $is_thread;
            $nap['is_bookrum'] = $is_bookrum;
            $nap['reference_id'] = $this->input->post('or_ref_no');
            $nap['booking_date'] = $this->input->post('booking_date');
            $nap['trial_date'] = $this->input->post('t_date');
            $nap['customer_name'] = $this->input->post('customer_name');
            $nap['d_date'] = $this->input->post('d_date');
            $nap['cutter_name'] = $this->input->post('cutter_name');
            $nap['karigar_name'] = $this->input->post('karigar_name');
            $nap['quantity'] = $this->input->post('quantity');
            $nap['is_suiting'] = $is_suiting;
            $nap['is_shirts'] = $is_shirts;
            $nap['is_shalwarqameez'] = $is_shalwarqameez;
            $nap['coat_neck'] = $cNeck;
            $nap['is_english'] = $this->input->post('is_english');
            $nap['coat_neck'] = $cNeck;
            $nap['coat_chest'] = $cChest;
            $nap['coat_waist'] = $cWaist;
            $nap['coat_hip'] = $cHips;
            $nap['coat_shoulder'] = $cShoulder;
            $nap['coat_sleeves'] = $cSleeves;
            $nap['coat_bicep'] = $cBicep;
            $nap['coat_forearm'] = $cForearm;
            $nap['coat_half_back'] = $cHalfBack;
            $nap['coat_cross_back'] = $cCrossBack;
            $nap['coat_length'] = $cLength;
            $nap['p3_waistcoat_length'] = $p3_waistcoat_length;
            $nap['waistcoat_length'] = $waistcoat_length;
            $nap['princecoat_length'] = $princecoat_length;

            $nap['sherwani_length'] = $sherwani_length;
            $nap['longcoat_length'] = $longcoat_length;
            $nap['chester_length'] = $chester_length;
            $nap['armhole'] = $armhole;
            $nap['pant_waist'] = $pWaist;
            $nap['pant_hip'] = $pHip;
            $nap['pant_thigh'] = $pThigh;
            $nap['pant_knee'] = $pKnee;
            $nap['pant_inside_length'] = $pInLength;
            $nap['pant_length'] = $pLength;
            $nap['pant_bottom'] = $pBottom;
            $nap['is_breasted'] = $is_breasted;
            $nap['is_double_breasted'] = $is_double_breasted;
            $nap['is_button_suit'] = $is_button_suit;
            $nap['is_two_button_suit'] = $is_two_button_suit;
            $nap['is_lapel'] = $is_lapel;
            $nap['is_peak_lapel'] = $is_peak_lapel;
            $nap['is_shawl_lapel'] = $is_shawl_lapel;
            $nap['is_wear'] = $is_wear;
            $nap['is_casual_wear'] = $is_casual_wear;
            $nap['is_groom_wear'] = $is_groom_wear;
            $nap['is_vent'] = $is_vent;
            $nap['is_double_vent'] = $is_double_vent;

            $nap['is_no_vent'] = $is_no_vent;
            $nap['is_lined'] = $is_lined;
            $nap['is_half_lined'] = $is_half_lined;
            $nap['is_ticket'] = $is_ticket;
            $nap['is_slant'] = $is_slant;
            $nap['is_regular'] = $is_regular;
            $nap['is_button'] = $is_button;
            $nap['is_metalic_button'] = $is_metalic_button;
            $nap['shirtLength'] = $shirtLength;
            $nap['shirtShoulder'] = $shirtShoulder;
            $nap['shirtSleeves'] = $shirtSleeves;
            $nap['shirtNeck'] = $shirtNeck;
            $nap['shirtChest'] = $shirtChest;
            $nap['shirtWaist'] = $shirtWaist;
            $nap['shirtHips'] = $shirtHips;
            $nap['shirtBicep'] = $shirtBicep;
            $nap['shirtForearm'] = $shirtForearm;
            $nap['shirtarmhole'] = $shirtarmhole;
            $nap['shirtcuff'] = $shirtcuff;
            $nap['kmz_length'] = $kmzLength;
            $nap['kurtaLength'] = $kurtaLength;
            $nap['kmz_shoulder'] = $kmzShoulder;
            $nap['kmz_sleeves'] = $kmzSleeves;

            $nap['kmz_neck'] = $kmzNeck;
            $nap['kmz_chest'] = $kmzChest;
            $nap['kmz_waist'] = $kmzWaist;
            $nap['kmz_hip'] = $kmzHips;
            $nap['kmz_bicep'] = $kmzBicep;
            $nap['kmz_forearm'] = $kmzForearm;
            $nap['kmzarmhole'] = $kmzarmhole;
            $nap['kmzcuff'] = $kmzcuff;
            $nap['shl_length'] = $shlLength;
            $nap['shl_bottom'] = $shlBottom;
            $nap['shl_AsanTyar'] = $shlAsanTyar;
            $nap['shl_GairaTyar'] = $shlGairaTyar;
            $nap['pjamaLength'] = $pjamaLength;
            $nap['pjamaBottom'] = $pjamaBottom;
            $nap['is_darts'] = $is_darts;
            $nap['is_sleeve_placket'] = $is_sleeve_placket;
            $nap['is_front_placket'] = $is_front_placket;
            $nap['is_plane_placket'] = $is_plane_placket;
            $nap['is_button_cuff'] = $is_button_cuff;
            $nap['is_plain_cuff'] = $is_plain_cuff;
            $nap['is_french_cuff'] = $is_french_cuff;
            $nap['is_double_cuff'] = $is_double_cuff;
            $nap['is_collar'] = $is_collar;
            $nap['is_moon_neck'] = $is_moon_neck;
            $nap['is_straight_front'] = $is_straight_front;
            $nap['is_1side_pocket'] = $is_1side_pocket;
            $nap['is_2side_pocket'] = $is_2side_pocket;
            $nap['is_fancy_button'] = $is_fancy_button;
            $nap['is_french_cuff'] = $is_french_cuff;
            $nap['is_band'] = $is_band;
            $nap['is_round_front'] = $is_round_front;
            $nap['is_front_pocket'] = $is_front_pocket;
            $nap['is_shalwar_pocket'] = $is_shalwar_pocket;
            $nap['is_covered_fly'] = $is_covered_fly;
            $nap['is_plain_button'] = $is_plain_button;
            $nap['is_button_cuff'] = $is_button_cuff;
            $nap['is_open_sleeves'] = $is_open_sleeves;
            $nap['instrucations'] = $instrucation;
            $nap['shirt_inst'] = $shirt_inst;
            $nap['shalwar_inst'] = $shalwar_inst;
            $nap['is_shirt_cuff'] = $is_shirt_cuff;
            $nap['shirt_collar_ins'] = $shirt_collar_ins;
            $nap['is_shirt_collar'] = $is_shirt_collar;
            $nap['is_shirt_collar_type'] = $is_shirt_collar_type;
            $nap['collar_ins'] = $collar_ins;
            $nap['front_pocket_ins'] = $front_pocket_ins;
            $nap['shalwar_pocket_ins'] = $shalwar_pocket_ins;
            if($vAllowed && empty($aPreviewData))
            $aPreviewData[] = $nap;
        }



        // print_r(json_encode($nap));exit;
        $vPDF = $this->input->post('ignore_pdf') == NULL ? true : false;

        $data['nap'] = $aPreviewData;

        $pref = prefix(7);

        $data['general'] = array('title' => "Cutomer View", 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);

        ini_set('memory_limit', '64M');


        if ($vPDF) {
            $html = $this->load->view('print_files/tailor', $data, true);
            //PDF Rendering
            $this->load->library('pdf');

            // $header = $this->load->view('print_files/tailor-header', $data, true);

            $pdf = $this->pdf->load_split(array('margin_top' => 2));

            $pdf->WriteHTML($html);
            if ($this->input->post('d')) {
                $pdf->Output('Invoice_pos' . $data['nap']['reference_id'] . '.pdf', 'D');
            } else {
                $pdf->Output('Invoice_pos' . $data['nap']['reference_id'] . '.pdf', 'I');
            }
        } else {
            echo $this->load->view('print_files/tailor_preview', $data, true);
        }
    }

    public function CustomerView() {

        $cid = $this->input->get('id');

        $tid = $this->input->get('id');
        $vPDF = $this->input->get('ignore_pdf') == NULL ? true : false;
        $data['id'] = $tid;

        //        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);

        $data['nap'] = $this->customers->details($cid);

        $pref = prefix(7);

        $data['general'] = array('title' => "Cutomer View", 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);

        ini_set('memory_limit', '64M');


        if ($vPDF) {
            $html = $this->load->view('print_files/customer_view', $data, true);
            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_split(array('margin_top' => 2));
            $pdf->WriteHTML($html);
            if ($this->input->get('d')) {
                $pdf->Output('Invoice_pos' . $data['nap'][0]['reference_id'] . '.pdf', 'D');
            } else {
                $pdf->Output('Invoice_pos' . $data['nap'][0]['reference_id'] . '.pdf', 'I');
            }
        } else {
            echo $this->load->view('print_files/tailor', $data, true);
        }
    }

    public function load_list() {
        ini_set('max_execution_time', 0);
        $no = $this->input->post('start');

        $list = $this->customers->get_datatables();
        $data = array();
        if ($this->input->post('due')) {
            foreach ($list as $customers) {

                $this->db->select('customer_basic_info.*');
                $this->db->from('customer_basic_info');
                $this->db->where('customer_basic_info.cus_id', $customers->id);
                $customer_basic_info = $this->db->get()->row_array();


                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $customer_basic_info['reference_id'];
                $row[] = '<a href="customers/CustomerView?id=' . $customers->id . '">' . $customers->name . '</a>';
                $row[] = amountExchange($customers->total - $customers->pamnt, 0, $this->aauth->get_user()->loc);
                $row[] = $customer_basic_info['booking_date'];
                $row[] = $customer_basic_info['d_date'];
                $row[] = $customers->phone;
                // $row[] = '<a href="customers/tailor?id='.$customers->id .'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Tailor View</a> <a href="customers/CustomerView?id='.$customers->id.'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Customer View</a> <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>Add New</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                // $btns = '<a href="customers/tailor?id=' . $customers->id . '" class="btn btn-secondary btn-sm"><span class="fa fa-eye"></span>  ' . 'Tailor View</a> <a href="customers/CustomerView?id=' . $customers->id . '" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' . 'Customer View</a>';
                $btns = '';
                if ($this->aauth->premission(10)) {
                    $btns .= '&nbsp;&nbsp; <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>&nbsp;Edit</a>';
                }else{
                    $btns .= '&nbsp;&nbsp; <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>&nbsp;Open</a>';

                }
                if ($this->aauth->premission(11)) {
                    $btns .= '&nbsp;&nbsp; <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                }
                $row[] = $btns;
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
                // $row[] = '<a href="customers/tailor?id='.$customers->id .'" class="btn btn-secondary btn-sm"><span class="fa fa-cut"></span>  ' .'Tailor View</a> <a href="customers/CustomerView?id='.$customers->id.'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' .'Customer View</a> <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>Add New</a> <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                //$btns = '<a href="customers/tailor?id=' . $customers->id . '" class="btn btn-secondary btn-sm"><span class="fa fa-eye"></span>  ' . 'Tailor View</a> <a href="customers/CustomerView?id=' . $customers->id . '" class="btn btn-info btn-sm"><span class="fa fa-eye"></span>  ' . 'Customer View</a>';
                $btns = '';
                if ($this->aauth->premission(10)) {
                    $btns .= '&nbsp;&nbsp; <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span>&nbsp;Edit</a>';
                }else{
                    $btns .= '&nbsp;&nbsp; <a href="customers/addNewCustomer?id=' . $customers->id . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>&nbsp;Open</a>';

                }
                if ($this->aauth->premission(11)) {
                    $btns .= '&nbsp;&nbsp; <a href="#" data-object-id="' . $customers->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
                }
                $row[] = $btns;
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
    public function edit() {
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

    public function addNewCustomer() {

        $cid = $this->input->get('id');
        $head['title'] = 'Edit Customer';
        $data['customer'] = $this->customers->details($cid);
        //echo '<pre>'; print_r($data);exit;

        if(empty($data['customer'][0]['coat_basic_id']) && empty($data['customer'][0]['kmz_basic_id'])){
            $data['customer'] = $this->customers->details_old_cus($cid);
            // echo '<pre>'; print_r($data);exit;

        }
        $data['id'] = $cid;
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/addNew', $data);
        $this->load->view('fixed/footer');
    }

    public function editStView() {
        $tid = $this->input->get('id');
        $head['title'] = 'Edit Stitching Invoice';

        $data['customer'] = $this->customers->stDetails($tid);

        if (is_null($data['customer']['reference_id'])) {
            $data['customer']['reference_id'] = $this->customers->last_record() + 1;
        }
        $data['id'] = $tid;
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/editStInvoice', $data);
        $this->load->view('fixed/footer');
    }

    public function editStInvoice() {

        $id = $this->input->post('id');

        $ref_no = $this->input->post('or_ref_no', true);

        $book_date = $this->input->post('booking_date');
        $book_date = date('Y-m-d', strtotime($book_date));

        $t_date = $this->input->post('t_date');
        $t_date = date('Y-m-d', strtotime($t_date));

        $d_date = $this->input->post('d_date');
        $d_date = date('Y-m-d', strtotime($d_date));

        $name = $this->input->post('customer_name', true);
        $mobile = $this->input->post('mobile', true);


        /* Get  coat/waist coat size */
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

        if (!empty($_POST["is_coat"])) {
            $is_coat = true;
        }

        if (!empty($_POST['is_wCoat'])) {
            $is_wCoat = true;
        }

        /* Get pant length */
        $pLength = $this->input->post("pLength");
        $pInLength = $this->input->post("pInLength");
        $pWaist = $this->input->post("pWaist");
        $pHip = $this->input->post("pHip");
        $pThigh = $this->input->post("pThigh");
        $pBottom = $this->input->post("pBottom");
        $pKnee = $this->input->post("pKnee");

        /* Get kamiz and shalwar size */
        $kmzLength = $this->input->post("kmzLength");
        $kmzSleeves = $this->input->post("kmzSleeves");
        $kmzShoulder = $this->input->post("kmzShoulder");
        $kmzNeck = $this->input->post("kmzNeck");
        $kmzChest = $this->input->post("kmzChest");
        $kmzWaist = $this->input->post("kmzWaist");
        $kmzGuaira = $this->input->post("kmzGuaira");

        $is_kmz = false;
        $is_shirt = false;

        if (!empty($_POST["is_kamz"])) {
            $is_kmz = true;
        }

        if (!empty($_POST['is_shirt'])) {
            $is_shirt = true;
        }

        /* Shwalr size */
        $shlLength = $this->input->post("shlLength");
        $shlBottom = $this->input->post("shlBottom");
        $shlAsanTyar = $this->input->post("shlAsanTyar");
        $shlGairaTyar = $this->input->post("shlGairaTyar");

        /* instrucations */
        $instrucation = $this->input->post("inst");

        $csd = $this->input->post("csd");

        $ptype = "Cash";
        $coupon = "";
        $notes = "ss";
        $coupon_amount = 0;
        $coupon_n = '';
        $invocieno = $this->invocies->lastinvoice() + 1;
        $invoicedate = $book_date;
        $invocieduedate = $d_date;
        $tax = "";
        $total_tax = 0;
        $subtotal = rev_amountExchange_s($this->input->post('total'));

        $total = rev_amountExchange_s($this->input->post('total'));
        $p_amount = rev_amountExchange_s($this->input->post('advance'));

        $c_amt = $p_amount - $total;
        if ($c_amt == 0.00) {
            $status = 'Paid';
            $pamnt = $total;
        } elseif ($c_amt < 0.00) {
            $status = 'Partial';
            if ($p_amount == 0.00)
                $status = 'Due';
            $pamnt = $p_amount;
            $c_amt = 0;
        } else {
            $status = 'Paid';
            $pamnt = $total;
        }

        $this->customers->editNap($id, $ref_no, $book_date, $t_date, $d_date, $name, $mobile, $cLength, $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $is_coat, $is_wCoat, $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee, $kmzLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $is_kmz, $is_shirt, $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $instrucation, $ptype, $coupon, $notes,
                $coupon_amount, $coupon_n, $invocieno, $invoicedate, $invocieduedate, $tax, $total_tax, $status, $pamnt, $total, $p_amount, $csd);
    }

    public function addNew() {

        $id = $this->input->post('id');

        $ref_no = $this->input->post('or_ref_no', true);

        $book_date = strtr($this->input->post('booking_date'), '/', '-');
        $book_date = date('Y-m-d', strtotime($book_date));

        $d_date = strtr($this->input->post('d_date'), '/', '-');
        $d_date = date('Y-m-d', strtotime($d_date));

        $t_date = strtr($this->input->post('t_date'), '/', '-');
        $t_date = date('Y-m-d', strtotime($t_date));

        $name = $this->input->post('customer_name', true);
        $cutter_name = $this->input->post('cutter_name', true);
        $karigar_name = $this->input->post('karigar_name', true);
        $quantity = $this->input->post('quantity', true);
        $mobile = $this->input->post('mobile', true);

        $is_suiting = false;
        $is_shirts = false;
        $is_shalwarqameez = false;
        if (!empty($_POST["is_suiting"])) {
            $is_suiting = true;
        }
        if (!empty($_POST["is_shirts"])) {
            $is_shirts = true;
        }
        if (!empty($_POST["is_shalwarqameez"])) {
            $is_shalwarqameez = true;
        }

        $is_english = false;
        $is_urdu = false;
        if (!empty($_POST["is_english"])) {
            $is_english = true;
        }
        if (!empty($_POST["is_urdu"])) {
            $is_urdu = true;
        }

        $cSleeves = $this->input->post("cSleeves");
        $cShoulder = $this->input->post("cShoulder");
        $cHalfBack = $this->input->post("cHalfBack");
        $cCrossBack = $this->input->post("cCrossBack");
        $cChest = $this->input->post("cChest");
        $cWaist = $this->input->post("cWaist");
        $cHips = $this->input->post("cHips");
        $cBicep = $this->input->post("cBicep");
        $cForearm = $this->input->post("cForearm");
        $cNeck = $this->input->post("cNeck");
        $cLength = $this->input->post("cLength");
        $p3_waistcoat_length = $this->input->post("3p_waistcoat_length");
        $waistcoat_length = $this->input->post("waistcoat_length");
        $princecoat_length = $this->input->post("princecoat_length");
        $sherwani_length = $this->input->post("sherwani_length");
        $longcoat_length = $this->input->post("longcoat_length");
        $chester_length = $this->input->post("chester_length");
        $armhole = $this->input->post("armhole");

        /* Get pant length */
        $pLength = $this->input->post("pLength");
        $pInLength = $this->input->post("pInLength");
        $pWaist = $this->input->post("pWaist");
        $pHip = $this->input->post("pHip");
        $pThigh = $this->input->post("pThigh");
        $pBottom = $this->input->post("pBottom");
        $pKnee = $this->input->post("pKnee");

        /* Get Suiting Checks */
        $is_breasted = false;
        $is_double_breasted = false;
        $is_button_suit = false;
        $is_two_button_suit = false;
        $is_lapel = false;
        $is_peak_lapel = false;
        $is_shawl_lapel = false;
        $is_wear = false;
        $is_casual_wear = false;
        $is_groom_wear = false;
        $is_vent = false;
        $is_double_vent = false;
        $is_no_vent = false;
        $is_lined = false;
        $is_half_lined = false;
        $is_ticket = false;
        $is_slant = false;
        $is_regular = false;
        $is_button = false;
        $is_metalic_button = false;

        if (!empty($_POST["is_breasted"])) {
            $is_breasted = true;
        }if (!empty($_POST["is_double_breasted"])) {
            $is_double_breasted = true;
        }
        if (!empty($_POST['is_button_suit'])) {
            $is_button_suit = true;
        }
        if (!empty($_POST['is_two_button_suit'])) {
            $is_two_button_suit = true;
        }
        if (!empty($_POST["is_lapel"])) {
            $is_lapel = true;
        }

        if (!empty($_POST["is_peak_lapel"])) {
            $is_peak_lapel = true;
        }

        if (!empty($_POST["is_shawl_lapel"])) {
            $is_shawl_lapel = true;
        }

        if (!empty($_POST['is_wear'])) {
            $is_wear = true;
        }
        if (!empty($_POST['is_casual_wear'])) {
            $is_casual_wear = true;
        }
        if (!empty($_POST['is_groom_wear'])) {
            $is_groom_wear = true;
        }
        if (!empty($_POST["is_vent"])) {
            $is_vent = true;
        }

        if (!empty($_POST["is_double_vent"])) {
            $is_double_vent = true;
        }

        if (!empty($_POST["is_no_vent"])) {
            $is_no_vent = true;
        }

        if (!empty($_POST['is_lined'])) {
            $is_lined = true;
        }
        if (!empty($_POST['is_half_lined'])) {
            $is_half_lined = true;
        }
        if (!empty($_POST['is_ticket'])) {
            $is_ticket = true;
        }
        if (!empty($_POST['is_slant'])) {
            $is_slant = true;
        }
        if (!empty($_POST['is_regular'])) {
            $is_regular = true;
        }
        if (!empty($_POST['is_button'])) {
            $is_button = true;
        }
        if (!empty($_POST['is_metalic_button'])) {
            $is_metalic_button = true;
        }

        /* Get kamiz and shalwar size */
        $shirtLength = $this->input->post("shirtLength");
        $shirtShoulder = $this->input->post("shirtShoulder");
        $shirtSleeves = $this->input->post("shirtSleeves");
        $shirtNeck = $this->input->post("shirtNeck");
        $shirtChest = $this->input->post("shirtChest");
        $shirtWaist = $this->input->post("shirtWaist");
        $shirtHips = $this->input->post("shirtHips");
        $shirtBicep = $this->input->post("shirtBicep");
        $shirtForearm = $this->input->post("shirtForearm");
        $shirtarmhole = $this->input->post("shirtarmhole");
        $shirtcuff = $this->input->post("shirtcuff");
        $kmzLength = $this->input->post("kmzLength");
        $kurtaLength = $this->input->post("kurtaLength");
        $kmzSleeves = $this->input->post("kmzSleeves");
        $kmzShoulder = $this->input->post("kmzShoulder");
        $kmzNeck = $this->input->post("kmzNeck");
        $kmzChest = $this->input->post("kmzChest");
        $kmzWaist = $this->input->post("kmzWaist");
        $kmzGuaira = $this->input->post("kmzGuaira");
        $kmzHips = $this->input->post("kmzHips");
        $kmzBicep = $this->input->post("kmzBicep");
        $kmzForearm = $this->input->post("kmzForearm");
        $kmzarmhole = $this->input->post("kmzarmhole");
        $kmzcuff = $this->input->post("kmzcuff");

        $is_darts = false;
        $is_sleeve_placket = false;
        $is_front_placket = false;
        $is_plane_placket = false;
        $is_button_cuff = false;
        $is_plain_cuff = false;
        $is_french_cuff = false;
        $is_double_cuff = false;

        if (!empty($_POST["is_darts"])) {
            $is_darts = true;
        }

        if (!empty($_POST['is_sleeve_placket'])) {
            $is_sleeve_placket = true;
        }
        if (!empty($_POST['is_front_placket'])) {
            $is_front_placket = true;
        }
        if (!empty($_POST['is_plane_placket'])) {
            $is_plane_placket = true;
        }
        if (!empty($_POST['is_button_cuff'])) {
            $is_button_cuff = true;
        }
        if (!empty($_POST['is_plain_cuff'])) {
            $is_plain_cuff = true;
        }
        if (!empty($_POST['is_french_cuff'])) {
            $is_french_cuff = true;
        }
        if (!empty($_POST['is_double_cuff'])) {
            $is_double_cuff = true;
        }

        /* Shwalr size */
        $shlLength = $this->input->post("shlLength");
        $shlBottom = $this->input->post("shlBottom");
        $shlAsanTyar = $this->input->post("shlAsanTyar");
        $shlGairaTyar = $this->input->post("shlGairaTyar");
        $pjamaLength = $this->input->post("pjamaLength");
        $pjamaBottom = $this->input->post("pjamaBottom");

        $is_collar = false;
        $is_moon_neck = false;
        $is_straight_front = false;
        $is_1side_pocket = false;
        $is_2side_pocket = false;
        $is_fancy_button = false;
        //$is_french_cuff = false;
        $is_band = false;
        $is_round_front = false;
        $is_front_pocket = false;
        $is_shalwar_pocket = false;
        //$is_sleeve_placket = false;
        $is_covered_fly = false;
        $is_plain_button = false;
        //$is_button_cuff = false;
        $is_open_sleeves = false;

        if (!empty($_POST["is_collar"])) {
            $is_collar = true;
        }
        if (!empty($_POST["is_moon_neck"])) {
            $is_moon_neck = true;
        }
        if (!empty($_POST["is_straight_front"])) {
            $is_straight_front = true;
        }
        if (!empty($_POST["is_1side_pocket"])) {
            $is_1side_pocket = true;
        }
        if (!empty($_POST["is_2side_pocket"])) {
            $is_2side_pocket = true;
        }
        if (!empty($_POST["is_fancy_button"])) {
            $is_fancy_button = true;
        }
        if (!empty($_POST["is_band"])) {
            $is_band = true;
        }
        if (!empty($_POST["is_round_front"])) {
            $is_round_front = true;
        }
        if (!empty($_POST["is_front_pocket"])) {
            $is_front_pocket = true;
        }
        if (!empty($_POST["is_shalwar_pocket"])) {
            $is_shalwar_pocket = true;
        }
        if (!empty($_POST["is_covered_fly"])) {
            $is_covered_fly = true;
        }
        if (!empty($_POST["is_plain_button"])) {
            $is_plain_button = true;
        }
        if (!empty($_POST["is_open_sleeves"])) {
            $is_open_sleeves = true;
        }

        /* instrucations */
        $instrucation = $this->input->post("inst");
        $shirt_inst = $this->input->post("shirt_inst");
        $shalwar_inst = $this->input->post("shalwar_inst");

        $ptype = "Cash";
        $coupon = "";
        $notes = "ss";
        $coupon_amount = 0;
        $coupon_n = '';
        $invocieno = $this->invocies->lastinvoice() + 1;
        $invoicedate = $book_date;
        $invocieduedate = $d_date;
        $tax = "";
        $total_tax = 0;
        $subtotal = rev_amountExchange_s($this->input->post('total'));

        $total = rev_amountExchange_s($this->input->post('total'));
        $p_amount = rev_amountExchange_s($this->input->post('advance'));

        $c_amt = $p_amount - $total;
        if ($c_amt == 0.00) {
            $status = 'Paid';
            $pamnt = $total;
        } elseif ($c_amt < 0.00) {
            $status = 'Partial';
            if ($p_amount == 0.00)
                $status = 'Due';
            $pamnt = $p_amount;
            $c_amt = 0;
        } else {
            $status = 'Paid';
            $pamnt = $total;
        }

        echo '<pre>'; print_r($_POST); exit;
        $this->customers->addNew($id, $ref_no, $book_date, $t_date, $d_date, $name, $cutter_name, $karigar_name, $quantity, $mobile, $is_suiting, $is_shirts, $is_shalwarqameez,
                $is_english, $is_urdu, $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $cBicep, $cForearm, $cNeck, $cLength,
                $p3_waistcoat_length, $waistcoat_length, $princecoat_length, $sherwani_length, $longcoat_length, $chester_length,
                $armhole,
                $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee,
                $is_breasted, $is_double_breasted, $is_button_suit, $is_two_button_suit, $is_lapel, $is_peak_lapel, $is_shawl_lapel, $is_wear, $is_casual_wear, $is_groom_wear, $is_vent, $is_double_vent, $is_no_vent, $is_lined, $is_half_lined, $is_ticket, $is_slant, $is_regular, $is_button, $is_metalic_button,
                $shirtLength, $shirtShoulder, $shirtSleeves, $shirtNeck, $shirtChest, $shirtWaist, $shirtHips,
                $shirtBicep, $shirtForearm, $shirtarmhole, $shirtcuff, $kmzLength, $kurtaLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $kmzHips, $kmzBicep, $kmzForearm, $kmzarmhole, $kmzcuff,
                $is_darts, $is_sleeve_placket, $is_front_placket, $is_plane_placket, $is_button_cuff, $is_plain_cuff, $is_french_cuff, $is_double_cuff,
                $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $pjamaLength, $pjamaBottom,
                $is_collar, $is_moon_neck, $is_straight_front, $is_1side_pocket, $is_2side_pocket, $is_fancy_button,
                $is_band, $is_round_front, $is_front_pocket, $is_shalwar_pocket, $is_covered_fly,
                $is_plain_button, $is_open_sleeves, $instrucation, $shirt_inst, $shalwar_inst, $ptype, $coupon, $notes,
                $coupon_amount, $coupon_n, $invocieno, $invoicedate, $invocieduedate, $tax, $total_tax, $status, $pamnt, $total, $p_amount);
    }

    public function addcustomer() {
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

    public function colthingCustomer_old() {

        $ref_no = $this->input->post('or_ref_no', true);

        $book_date = $this->input->post('booking_date');
        $book_date = date('Y-m-d', strtotime($book_date));

        $d_date = $this->input->post('d_date');
        $d_date = date('Y-m-d', strtotime($d_date));

        $t_date = $this->input->post('t_date');
        $t_date = date('Y-m-d', strtotime($t_date));

        $name = $this->input->post('customer_name', true);
        $mobile = $this->input->post('mobile', true);

        $is_english = false;
        $is_urdu = false;
        if (!empty($_POST["is_english"])) {
            $is_english = true;
        }
        if (!empty($_POST["is_urdu"])) {
            $is_urdu = true;
        }

        $counter = count($this->input->post("cSleeve"));
        $vCustomerID = $this->customers->fAddCustomer($name, $mobile);
        if ($vCustomerID) {
            for ($i = 0; $i < 3; $i++) {

                $is_suiting = false;
                $is_shirts = false;
                $is_shalwarqameez = false;
                if ($i == 0) { //!empty($_POST["is_suiting"])){
                    $is_suiting = true;
                }
                if ($i == 1) { //if(!empty($_POST["is_shirts"])){
                    $is_shirts = true;
                }
                if ($i == 2) { //if(!empty($_POST["is_shalwarqameez"])){
                    $is_shalwarqameez = true;
                }
//                echo $i. '<br>'; 
                $cSleeves = '';
                $cShoulder = '';
                $cHalfBack = '';
                $cCrossBack = '';
                $cChest = '';
                $cWaist = '';
                $cHips = '';
                $cBicep = '';
                $cForearm = '';
                $cNeck = '';
                $cLength = '';
                $p3_waistcoat_length = '';
                $waistcoat_length = '';
                $princecoat_length = '';
                $sherwani_length = '';
                $longcoat_length = '';
                $chester_length = '';
                $armhole = '';

                /* Get pant length */
                $pLength = '';
                $pInLength = '';
                $pWaist = '';
                $pHip = '';
                $pThigh = '';
                $pBottom = '';
                $pKnee = '';

                /* Get Suiting Checks */
                $is_breasted = 0;
                $is_double_breasted = 0;
                $is_button_suit = 0;
                $is_two_button_suit = 0;
                $is_lapel = 0;
                $is_peak_lapel = 0;
                $is_shawl_lapel = 0;
                $is_wear = 0;
                $is_casual_wear = 0;
                $is_groom_wear = 0;
                $is_vent = 0;
                $is_double_vent = 0;
                $is_no_vent = 0;
                $is_lined = 0;
                $is_half_lined = 0;
                $is_ticket = 0;
                $is_slant = 0;
                $is_regular = 0;
                $is_button = 0;
                $is_metalic_button = 0;

                $shirtLength = '';
                $shirtShoulder = '';
                $shirtSleeves = '';
                $shirtNeck = '';
                $shirtChest = '';
                $shirtWaist = '';
                $shirtHips = '';
                $shirtBicep = '';
                $shirtForearm = '';
                $shirtarmhole = '';
                $shirtcuff = '';

                $is_darts = 0;
                $is_sleeve_placket = 0;
                $is_front_placket = 0;
                $is_plane_placket = 0;
                $is_shirt_cuff = 0;
                $is_plain_cuff = 0;
                $is_french_cuff = 0;
                $is_double_cuff = 0;
                $is_shirt_collar = 0;
                $is_shirt_collar_type = 0;

                $kmzLength = '';
                $kurtaLength = '';
                $kmzSleeves = '';
                $kmzShoulder = '';
                $kmzNeck = '';
                $kmzChest = '';
                $kmzWaist = '';
                $kmzGuaira = '';
                $kmzHips = '';
                $kmzBicep = '';
                $kmzForearm = '';
                $kmzarmhole = '';
                $kmzcuff = '';

                /* Shwalr size */
                $shlLength = '';
                $shlBottom = '';
                $shlAsanTyar = '';
                $shlGairaTyar = '';
                $pjamaLength = '';
                $pjamaBottom = '';

                $is_collar = 0;
                $is_straight_front = 0;
                $is_1side_pocket = 0;
                $is_front_pocket = 0;
                $is_shalwar_pocket = 0;
                $is_sleeve_placket = 0;
                $is_plain_button = 0;
                $is_button_cuff = 0;
                $is_design = 0;
                $is_kanta = 0;
                $is_stitch = 0;
                $is_thread = 0;
                $is_bookrum = 0;
                $is_moon_neck = 0;
                $is_2side_pocket = 0;
                $is_fancy_button = 0;
                $is_band = 0;
                $is_round_front = 0;
                $is_covered_fly = 0;
                $is_open_sleeves = 0;
                $shirt_collar_ins = '';
                $collar_ins = '';
                $front_pocket_ins = '';
                $shalwar_pocket_ins = '';

                if ($i == 0) {
                    /* Get  coat/waist coat size */
                    $cSleeves = $this->input->post("cSleeve[" . $i . "]");
                    $cShoulder = $this->input->post("cShoulder[" . $i . "]");
                    $cHalfBack = $this->input->post("cHalfBack[" . $i . "]");
                    $cCrossBack = $this->input->post("cCrossBack[" . $i . "]");
                    $cChest = $this->input->post("cChest[" . $i . "]");
                    $cWaist = $this->input->post("cWaist[" . $i . "]");
                    $cHips = $this->input->post("cHips[" . $i . "]");
                    $cBicep = $this->input->post("cBicep[" . $i . "]");
                    $cForearm = $this->input->post("cForearm[" . $i . "]");
                    $cNeck = $this->input->post("cNeck[" . $i . "]");
                    $cLength = $this->input->post("cLength[" . $i . "]");
                    $p3_waistcoat_length = $this->input->post("3p_waistcoat_length[" . $i . "]");
                    $waistcoat_length = $this->input->post("waistcoat_length[" . $i . "]");
                    $princecoat_length = $this->input->post("princecoat_length[" . $i . "]");
                    $sherwani_length = $this->input->post("sherwani_length[" . $i . "]");
                    $longcoat_length = $this->input->post("longcoat_length[" . $i . "]");
                    $chester_length = $this->input->post("chester_length[" . $i . "]");
                    $armhole = $this->input->post("armhole[" . $i . "]");

                    /* Get pant length */
                    $pLength = $this->input->post("pLength[" . $i . "]");
                    $pInLength = $this->input->post("pInLength[" . $i . "]");
                    $pWaist = $this->input->post("pWaist[" . $i . "]");
                    $pHip = $this->input->post("pHip[" . $i . "]");
                    $pThigh = $this->input->post("pThigh[" . $i . "]");
                    $pBottom = $this->input->post("pBottom[" . $i . "]");
                    $pKnee = $this->input->post("pKnee[" . $i . "]");

                    if (isset($_POST["is_breasted"][$i]) && !empty($_POST["is_breasted"][$i])) {
                        $is_breasted = $_POST["is_breasted"][$i];
                    } else {
                        $is_breasted = isset($_POST["is_breasted"][0]) ? $_POST["is_breasted"][0] : 0;
                    }

                    if (isset($_POST["is_button_suit"][$i]) && !empty($_POST['is_button_suit'][$i])) {
                        $is_button_suit = $_POST["is_button_suit"][$i];
                    } else {
                        $is_button_suit = isset($_POST["is_button_suit"][0]) ? $_POST["is_button_suit"][0] : 0;
                    }

                    if (isset($_POST["is_lapel"][$i]) && !empty($_POST['is_lapel'][$i])) {
                        $is_lapel = $_POST["is_lapel"][$i];
                    } else {
                        $is_lapel = isset($_POST["is_lapel"][0]) ? $_POST["is_lapel"][0] : 0;
                    }

                    if (isset($_POST["is_vent"][$i]) && !empty($_POST['is_vent'][$i])) {
                        $is_vent = $_POST['is_vent'][$i];
                    } else {
                        $is_vent = isset($_POST["is_vent"][0]) ? $_POST["is_vent"][0] : 0;
                    }

                    if (isset($_POST["is_wear"][$i]) && !empty($_POST['is_wear'][$i])) {
                        $is_wear = $_POST['is_wear'][$i];
                    } else {
                        $is_wear = isset($_POST["is_wear"][0]) ? $_POST["is_wear"][0] : 0;
                    }

                    if (isset($_POST["is_lined"][$i]) && !empty($_POST['is_lined'][$i])) {
                        $is_lined = $_POST['is_lined'][$i];
                    } else {
                        $is_lined = isset($_POST["is_lined"][0]) ? $_POST["is_lined"][0] : 0;
                    }

                    if (isset($_POST["is_ticket"][$i]) && !empty($_POST['is_ticket'][$i])) {
                        $is_ticket = $_POST['is_ticket'][$i];
                    } else {
                        $is_ticket = isset($_POST["is_ticket"][0]) ? $_POST["is_ticket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_pocket"][$i]) && !empty($_POST['is_suit_pocket'][$i])) {
                        $is_regular = $_POST['is_suit_pocket'][$i];
                    } else {
                        $is_regular = isset($_POST["is_suit_pocket"][0]) ? $_POST["is_suit_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_button"][$i]) && !empty($_POST['is_suit_button'][$i])) {
                        $is_button = $_POST['is_suit_button'][$i];
                    } else {
                        $is_button = isset($_POST["is_suit_button"][0]) ? $_POST["is_suit_button"][0] : 0;
                    }
                }

                if ($i == 1) {
                    /* Get Shirt size */
                    $shirtLength = $this->input->post("shirtLength[" . $i . "]");
                    $shirtShoulder = $this->input->post("shirtShoulder[" . $i . "]");
                    $shirtSleeves = $this->input->post("shirtSleeves[" . $i . "]");
                    $shirtNeck = $this->input->post("shirtNeck[" . $i . "]");
                    $shirtChest = $this->input->post("shirtChest[" . $i . "]");
                    $shirtWaist = $this->input->post("shirtWaist[" . $i . "]");
                    $shirtHips = $this->input->post("shirtHips[" . $i . "]");
                    $shirtBicep = $this->input->post("shirtBicep[" . $i . "]");
                    $shirtForearm = $this->input->post("shirtForearm[" . $i . "]");
                    $shirtarmhole = $this->input->post("shirtarmhole[" . $i . "]");
                    $shirtcuff = $this->input->post("shirtcuff[" . $i . "]");

                    if (isset($_POST["is_placket"][$i]) && !empty($_POST['is_placket'][$i])) {
                        $is_front_placket = $_POST['is_placket'][$i];
                    } else {
                        $is_front_placket = isset($_POST["is_placket"][0]) ? $_POST["is_placket"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_cuff"][$i]) && !empty($_POST['is_shirt_cuff'][$i])) {
                        $is_shirt_cuff = $_POST['is_shirt_cuff'][$i];
                    } else {
                        $is_shirt_cuff = isset($_POST["is_shirt_cuff"][0]) ? $_POST["is_shirt_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar"][$i]) && !empty($_POST['is_shirt_collar'][$i])) {
                        $is_shirt_collar = $_POST['is_shirt_collar'][$i];
                    } else {
                        $is_shirt_collar = isset($_POST["is_shirt_collar"][0]) ? $_POST["is_shirt_collar"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar_type"][$i]) && !empty($_POST['is_shirt_collar_type'][$i])) {
                        $is_shirt_collar_type = $_POST['is_shirt_collar_type'][$i];
                    } else {
                        $is_shirt_collar_type = isset($_POST["is_shirt_collar_type"][0]) ? $_POST["is_shirt_collar_type"][0] : 0;
                    }
                    $shirt_collar_ins = $this->input->post("shirt_collar_ins[" . $i . "]");
                }
                if ($i == 2) {
                    /* Get kamiz size */
                    $kmzLength = $this->input->post("kmzLength[" . $i . "]");
                    $kurtaLength = $this->input->post("kurtaLength[" . $i . "]");
                    $kmzSleeves = $this->input->post("kmzSleeves[" . $i . "]");
                    $kmzShoulder = $this->input->post("kmzShoulder[" . $i . "]");
                    $kmzNeck = $this->input->post("kmzNeck[" . $i . "]");
                    $kmzChest = $this->input->post("kmzChest[" . $i . "]");
                    $kmzWaist = $this->input->post("kmzWaist[" . $i . "]");
                    $kmzGuaira = $this->input->post("kmzGuaira[" . $i . "]");
                    $kmzHips = $this->input->post("kmzHips[" . $i . "]");
                    $kmzBicep = $this->input->post("kmzBicep[" . $i . "]");
                    $kmzForearm = $this->input->post("kmzForearm[" . $i . "]");
                    $kmzarmhole = $this->input->post("kmzarmhole[" . $i . "]");
                    $kmzcuff = $this->input->post("kmzcuff[" . $i . "]");

                    /* Shwalr size */
                    $shlLength = $this->input->post("shlLength[" . $i . "]");
                    $shlBottom = $this->input->post("shlBottom[" . $i . "]");
                    $shlAsanTyar = $this->input->post("shlAsanTyar[" . $i . "]");
                    $shlGairaTyar = $this->input->post("shlGairaTyar[" . $i . "]");
                    $pjamaLength = $this->input->post("pjamaLength[" . $i . "]");
                    $pjamaBottom = $this->input->post("pjamaBottom[" . $i . "]");

                    if (isset($_POST["is_collar"][$i]) && !empty($_POST['is_collar'][$i])) {
                        $is_collar = $_POST['is_collar'][$i];
                    } else {
                        $is_collar = isset($_POST["is_collar"][0]) ? $_POST["is_collar"][0] : 0;
                    }
                    $collar_ins = $this->input->post("collar_ins[" . $i . "]");

                    if (isset($_POST["is_front"][$i]) && !empty($_POST['is_front'][$i])) {
                        $is_straight_front = $_POST['is_front'][$i];
                    } else {
                        $is_straight_front = isset($_POST["is_front"][0]) ? $_POST["is_front"][0] : 0;
                    }

                    if (isset($_POST["is_front_pocket"][$i]) && !empty($_POST['is_front_pocket'][$i])) {
                        $is_front_pocket = $_POST['is_front_pocket'][$i];
                    } else {
                        $is_front_pocket = isset($_POST["is_front_pocket"][0]) ? $_POST["is_front_pocket"][0] : 0;
                    }
                    $front_pocket_ins = $this->input->post("front_pocket_ins[" . $i . "]");

                    if (isset($_POST["is_shalwar_pocket"][$i]) && !empty($_POST['is_shalwar_pocket'][$i])) {
                        $is_shalwar_pocket = $_POST['is_shalwar_pocket'][$i];
                    } else {
                        $is_shalwar_pocket = isset($_POST["is_shalwar_pocket"][0]) ? $_POST["is_shalwar_pocket"][0] : 0;
                    }
                    $shalwar_pocket_ins = $this->input->post("shalwar_pocket_ins[" . $i . "]");

                    if (isset($_POST["is_pocket"][$i]) && !empty($_POST['is_pocket'][$i])) {
                        $is_1side_pocket = $_POST['is_pocket'][$i];
                    } else {
                        $is_1side_pocket = isset($_POST["is_pocket"][0]) ? $_POST["is_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_sleeve_placket"][$i]) && !empty($_POST['is_sleeve_placket'][$i])) {
                        $is_sleeve_placket = $_POST['is_sleeve_placket'][$i];
                    } else {
                        $is_sleeve_placket = isset($_POST["is_sleeve_placket"][0]) ? $_POST["is_sleeve_placket"][0] : 0;
                    }

                    if (isset($_POST["is_button"][$i]) && !empty($_POST['is_button'][$i])) {
                        $is_plain_button = $_POST['is_button'][$i];
                    } else {
                        $is_plain_button = isset($_POST["is_button"][0]) ? $_POST["is_button"][0] : 0;
                    }

                    if (isset($_POST["is_cuff"][$i]) && !empty($_POST['is_cuff'][$i])) {
                        $is_button_cuff = $_POST['is_cuff'][$i];
                    } else {
                        $is_button_cuff = isset($_POST["is_cuff"][0]) ? $_POST["is_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_design"][$i]) && !empty($_POST['is_design'][$i])) {
                        $is_design = $_POST['is_design'][$i];
                    } else {
                        $is_design = isset($_POST["is_design"][0]) ? $_POST["is_design"][0] : 0;
                    }

                    if (isset($_POST["is_kanta"][$i]) && !empty($_POST['is_kanta'][$i])) {
                        $is_kanta = $_POST['is_kanta'][$i];
                    } else {
                        $is_kanta = isset($_POST["is_kanta"][0]) ? $_POST["is_kanta"][0] : 0;
                    }

                    if (isset($_POST["is_stitch"][$i]) && !empty($_POST['is_stitch'][$i])) {
                        $is_stitch = $_POST['is_stitch'][$i];
                    } else {
                        $is_stitch = isset($_POST["is_stitch"][0]) ? $_POST["is_stitch"][0] : 0;
                    }

                    if (isset($_POST["is_thread"][$i]) && !empty($_POST['is_thread'][$i])) {
                        $is_thread = $_POST['is_thread'][$i];
                    } else {
                        $is_thread = isset($_POST["is_thread"][0]) ? $_POST["is_thread"][0] : 0;
                    }

                    if (isset($_POST["is_bookrum"][$i]) && !empty($_POST['is_bookrum'][$i])) {
                        $is_bookrum = $_POST['is_bookrum'][$i];
                    } else {
                        $is_bookrum = isset($_POST["is_bookrum"][0]) ? $_POST["is_bookrum"][0] : 0;
                    }
                }

                /* instrucations */
                $instrucation = $this->input->post("inst[" . $i . "]");
                $shirt_inst = $this->input->post("shirt_inst[" . $i . "]");
                $shalwar_inst = $this->input->post("shalwar_inst[" . $i . "]");

                //add into invoice table
                $ptype = "Cash";
                $coupon = "";
                $notes = "ss";
                $coupon_amount = 0;
                $coupon_n = '';
                $invocieno = $this->invocies->lastinvoice() + 1;
                $invoicedate = $book_date;
                $invocieduedate = $d_date;
                $tax = "";
                $total_tax = 0;
                $subtotal = rev_amountExchange_s(0);

                $total = rev_amountExchange_s(0);
                $p_amount = rev_amountExchange_s(0);

                $c_amt = $p_amount - $total;
                if ($c_amt == 0.00) {
                    $status = 'Paid';
                    $pamnt = $total;
                } elseif ($c_amt < 0.00) {
                    $status = 'Partial';
                    if ($p_amount == 0.00)
                        $status = 'Due';
                    $pamnt = $p_amount;
                    $c_amt = 0;
                } else {
                    $status = 'Paid';
                    $pamnt = $total;
                }


                $this->customers->tailoringCustomerAdd($vCustomerID, $ref_no, 0,$book_date, $t_date, $d_date, $is_suiting, $is_shirts, $is_shalwarqameez, $is_english, $is_urdu,
                        $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $cBicep, $cForearm, $cNeck, $cLength, $p3_waistcoat_length, $waistcoat_length,
                        $princecoat_length, $sherwani_length, $longcoat_length, $chester_length, $armhole,
                        $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee,
                        $is_breasted, $is_double_breasted, $is_button_suit, $is_two_button_suit, $is_lapel, $is_peak_lapel, $is_shawl_lapel, $is_wear, $is_casual_wear, $is_groom_wear, $is_vent, $is_double_vent, $is_no_vent, $is_lined, $is_half_lined, $is_ticket, $is_slant, $is_regular, $is_button, $is_metalic_button,
                        $shirtLength, $shirtShoulder, $shirtSleeves, $shirtNeck, $shirtChest, $shirtWaist, $shirtHips,
                        $shirtBicep, $shirtForearm, $shirtarmhole, $shirtcuff,
                        $kmzLength, $kurtaLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $kmzHips, $kmzBicep, $kmzForearm, $kmzarmhole, $kmzcuff,
                        $is_darts, $is_sleeve_placket, $is_front_placket, $is_plane_placket, $is_shirt_cuff, $is_plain_cuff, $is_french_cuff,
                        $is_double_cuff, $is_shirt_collar, $is_shirt_collar_type, $shirt_collar_ins,
                        $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $pjamaLength, $pjamaBottom,
                        $is_collar, $is_moon_neck, $is_straight_front, $is_1side_pocket, $is_2side_pocket, $is_fancy_button,
                        $is_band, $is_round_front, $is_front_pocket, $is_shalwar_pocket, $is_covered_fly,
                        $is_plain_button, $is_open_sleeves, $is_button_cuff, $is_design, $is_kanta, $is_stitch, $is_thread, $is_bookrum,
                        $collar_ins, $front_pocket_ins, $shalwar_pocket_ins, $instrucation, $shirt_inst, $shalwar_inst, $ptype, $coupon, $notes,
                        $coupon_amount, $coupon_n, $invocieno, $invoicedate, $invocieduedate, $tax, $total_tax, $status, $pamnt, $total, $p_amount, 0);
            }
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp;<a href="' . base_url('/customers') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $vCustomerID));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function colthingCustomer() {
        $vShirtCount = $this->input->post('is_shirts') != NULL ? count($this->input->post('is_shirts')) : 0;
        $vSuitingCount = $this->input->post('is_suiting') != NULL ? count($this->input->post('is_suiting')) : 0;
        $vShalwarKamezCount = $this->input->post('is_shalwarqameez') != NULL ? count($this->input->post('is_shalwarqameez')) : 0;
        $vTotalCOunt = $vShirtCount + $vSuitingCount + $vShalwarKamezCount;
        $vSuitingCountIndex = 0;
        $vShirtCountIndex = 0;
        $vKmzCountIndex = 0;
        $cSleeve = [];
        $aShirtLength = [];
        $akmzLength = [];
//        print_r(json_encode($this->input->post()));exit;
        $ref_no = $this->input->post('or_ref_no', true);

        $book_date = $this->input->post('booking_date');
        $book_date = date('Y-m-d', strtotime($book_date));

        $d_date = $this->input->post('d_date');
        $d_date = date('Y-m-d', strtotime($d_date));

        $t_date = $this->input->post('t_date');
        $t_date = date('Y-m-d', strtotime($t_date));

        $name = $this->input->post('customer_name', true);
        $cutter_name = $this->input->post('cutter_name', true);
        $karigar_name = $this->input->post('karigar_name', true);
        $quantity = $this->input->post('quantity', true);
        $mobile = $this->input->post('mobile', true);

        $is_english = false;
        $is_urdu = false;
        if (!empty($_POST["is_english"])) {
            $is_english = true;
        }
        if (!empty($_POST["is_urdu"])) {
            $is_urdu = true;
        }
        $vCustomerID = $this->customers->fAddCustomer($name, $mobile);
        if ($vCustomerID) {
            for ($i = 0; $i < $vTotalCOunt; $i++) {

                $is_suiting = false;
                $is_shirts = false;
                $is_shalwarqameez = false;

                if ($vSuitingCount) {
                    $is_suiting = true;
                } else if ($vShirtCount) {
                    $is_shirts = true;
                } else if ($vShalwarKamezCount) {
                    $is_shalwarqameez = true;
                }
                if (empty($cSleeve))
                    $cSleeve = $this->input->post('cSleeve');
                if (empty($aShirtLength))
                    $aShirtLength = $this->input->post('shirtLength');
                if (empty($akmzLength))
                    $akmzLength = $this->input->post('kmzLength');


                $instrucation = "";
                $shirt_inst = "";
                $shalwar_inst = "";
//                echo $i. '<br>'; 
                $cSleeves = '';
                $cShoulder = '';
                $cHalfBack = '';
                $cCrossBack = '';
                $cChest = '';
                $cWaist = '';
                $cHips = '';
                $cBicep = '';
                $cForearm = '';
                $cNeck = '';
                $cLength = '';
                $p3_waistcoat_length = '';
                $waistcoat_length = '';
                $princecoat_length = '';
                $sherwani_length = '';
                $longcoat_length = '';
                $chester_length = '';
                $armhole = '';

                /* Get pant length */
                $pLength = '';
                $pInLength = '';
                $pWaist = '';
                $pHip = '';
                $pThigh = '';
                $pBottom = '';
                $pKnee = '';

                /* Get Suiting Checks */
                $is_breasted = 0;
                $is_double_breasted = 0;
                $is_button_suit = 0;
                $is_two_button_suit = 0;
                $is_lapel = 0;
                $is_peak_lapel = 0;
                $is_shawl_lapel = 0;
                $is_wear = 0;
                $is_casual_wear = 0;
                $is_groom_wear = 0;
                $is_vent = 0;
                $is_double_vent = 0;
                $is_no_vent = 0;
                $is_lined = 0;
                $is_half_lined = 0;
                $is_ticket = 0;
                $is_slant = 0;
                $is_regular = 0;
                $is_button = 0;
                $is_metalic_button = 0;

                $shirtLength = '';
                $shirtShoulder = '';
                $shirtSleeves = '';
                $shirtNeck = '';
                $shirtChest = '';
                $shirtWaist = '';
                $shirtHips = '';
                $shirtBicep = '';
                $shirtForearm = '';
                $shirtarmhole = '';
                $shirtcuff = '';

                $is_darts = 0;
                $is_sleeve_placket = 0;
                $is_front_placket = 0;
                $is_plane_placket = 0;
                $is_shirt_cuff = 0;
                $is_plain_cuff = 0;
                $is_french_cuff = 0;
                $is_double_cuff = 0;
                $is_shirt_collar = 0;
                $is_shirt_collar_type = 0;

                $kmzLength = '';
                $kurtaLength = '';
                $kmzSleeves = '';
                $kmzShoulder = '';
                $kmzNeck = '';
                $kmzChest = '';
                $kmzWaist = '';
                $kmzGuaira = '';
                $kmzHips = '';
                $kmzBicep = '';
                $kmzForearm = '';
                $kmzarmhole = '';
                $kmzcuff = '';

                /* Shwalr size */
                $shlLength = '';
                $shlBottom = '';
                $shlAsanTyar = '';
                $shlGairaTyar = '';
                $pjamaLength = '';
                $pjamaBottom = '';

                $is_collar = 0;
                $is_straight_front = 0;
                $is_1side_pocket = 0;
                $is_front_pocket = 0;
                $is_shalwar_pocket = 0;
                $is_sleeve_placket = 0;
                $is_plain_button = 0;
                $is_button_cuff = 0;
                $is_design = 0;
                $is_kanta = 0;
                $is_stitch = 0;
                $is_thread = 0;
                $is_bookrum = 0;
                $is_moon_neck = 0;
                $is_2side_pocket = 0;
                $is_fancy_button = 0;
                $is_band = 0;
                $is_round_front = 0;
                $is_covered_fly = 0;
                $is_open_sleeves = 0;
                $shirt_collar_ins = '';
                $collar_ins = '';
                $front_pocket_ins = '';
                $shalwar_pocket_ins = '';
                if ($is_suiting) {
                    /* Get  coat/waist coat size */

                    foreach ($cSleeve as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vSuitingCountIndex = $thisIndex;
                            break;
                        }

                    $cSleeves = $this->input->post("cSleeve[" . $vSuitingCountIndex . "]");
                    $cShoulder = $this->input->post("cShoulder[" . $vSuitingCountIndex . "]");
                    $cHalfBack = $this->input->post("cHalfBack[" . $vSuitingCountIndex . "]");
                    $cCrossBack = $this->input->post("cCrossBack[" . $vSuitingCountIndex . "]");
                    $cChest = $this->input->post("cChest[" . $vSuitingCountIndex . "]");
                    $cWaist = $this->input->post("cWaist[" . $vSuitingCountIndex . "]");
                    $cHips = $this->input->post("cHips[" . $vSuitingCountIndex . "]");
                    $cBicep = $this->input->post("cBicep[" . $vSuitingCountIndex . "]");
                    $cForearm = $this->input->post("cForearm[" . $vSuitingCountIndex . "]");
                    $cNeck = $this->input->post("cNeck[" . $vSuitingCountIndex . "]");
                    $cLength = $this->input->post("cLength[" . $vSuitingCountIndex . "]");
                    $p3_waistcoat_length = $this->input->post("3p_waistcoat_length[" . $vSuitingCountIndex . "]");
                    $waistcoat_length = $this->input->post("waistcoat_length[" . $vSuitingCountIndex . "]");
                    $princecoat_length = $this->input->post("princecoat_length[" . $vSuitingCountIndex . "]");
                    $sherwani_length = $this->input->post("sherwani_length[" . $vSuitingCountIndex . "]");
                    $longcoat_length = $this->input->post("longcoat_length[" . $vSuitingCountIndex . "]");
                    $chester_length = $this->input->post("chester_length[" . $vSuitingCountIndex . "]");
                    $armhole = $this->input->post("armhole[" . $vSuitingCountIndex . "]");

                    /* Get pant length */
                    $pLength = $this->input->post("pLength[" . $vSuitingCountIndex . "]");
                    $pInLength = $this->input->post("pInLength[" . $vSuitingCountIndex . "]");
                    $pWaist = $this->input->post("pWaist[" . $vSuitingCountIndex . "]");
                    $pHip = $this->input->post("pHip[" . $vSuitingCountIndex . "]");
                    $pThigh = $this->input->post("pThigh[" . $vSuitingCountIndex . "]");
                    $pBottom = $this->input->post("pBottom[" . $vSuitingCountIndex . "]");
                    $pKnee = $this->input->post("pKnee[" . $vSuitingCountIndex . "]");

                    if (isset($_POST["is_breasted"][$vSuitingCountIndex]) && !empty($_POST["is_breasted"][$vSuitingCountIndex])) {
                        $is_breasted = $_POST["is_breasted"][$vSuitingCountIndex];
                    } else {
                        $is_breasted = isset($_POST["is_breasted"][0]) ? $_POST["is_breasted"][0] : 0;
                    }

                    if (isset($_POST["is_button_suit"][$vSuitingCountIndex]) && !empty($_POST['is_button_suit'][$vSuitingCountIndex])) {
                        $is_button_suit = $_POST["is_button_suit"][$vSuitingCountIndex];
                    } else {
                        $is_button_suit = isset($_POST["is_button_suit"][0]) ? $_POST["is_button_suit"][0] : 0;
                    }

                    if (isset($_POST["is_lapel"][$vSuitingCountIndex]) && !empty($_POST['is_lapel'][$vSuitingCountIndex])) {
                        $is_lapel = $_POST["is_lapel"][$vSuitingCountIndex];
                    } else {
                        $is_lapel = isset($_POST["is_lapel"][0]) ? $_POST["is_lapel"][0] : 0;
                    }

                    if (isset($_POST["is_vent"][$vSuitingCountIndex]) && !empty($_POST['is_vent'][$vSuitingCountIndex])) {
                        $is_vent = $_POST['is_vent'][$vSuitingCountIndex];
                    } else {
                        $is_vent = isset($_POST["is_vent"][0]) ? $_POST["is_vent"][0] : 0;
                    }

                    if (isset($_POST["is_wear"][$vSuitingCountIndex]) && !empty($_POST['is_wear'][$vSuitingCountIndex])) {
                        $is_wear = $_POST['is_wear'][$vSuitingCountIndex];
                    } else {
                        $is_wear = isset($_POST["is_wear"][0]) ? $_POST["is_wear"][0] : 0;
                    }

                    if (isset($_POST["is_lined"][$vSuitingCountIndex]) && !empty($_POST['is_lined'][$vSuitingCountIndex])) {
                        $is_lined = $_POST['is_lined'][$vSuitingCountIndex];
                    } else {
                        $is_lined = isset($_POST["is_lined"][0]) ? $_POST["is_lined"][0] : 0;
                    }

                    if (isset($_POST["is_ticket"][$vSuitingCountIndex]) && !empty($_POST['is_ticket'][$vSuitingCountIndex])) {
                        $is_ticket = $_POST['is_ticket'][$vSuitingCountIndex];
                    } else {
                        $is_ticket = isset($_POST["is_ticket"][0]) ? $_POST["is_ticket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_pocket"][$vSuitingCountIndex]) && !empty($_POST['is_suit_pocket'][$vSuitingCountIndex])) {
                        $is_regular = $_POST['is_suit_pocket'][$vSuitingCountIndex];
                    } else {
                        $is_regular = isset($_POST["is_suit_pocket"][0]) ? $_POST["is_suit_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_button"][$vSuitingCountIndex]) && !empty($_POST['is_suit_button'][$vSuitingCountIndex])) {
                        $is_button = $_POST['is_suit_button'][$vSuitingCountIndex];
                    } else {
                        $is_button = isset($_POST["is_suit_button"][0]) ? $_POST["is_suit_button"][0] : 0;
                    }
                    $instrucation = $this->input->post("inst[" . $vKmzCountIndex . "]");
                    $cSleeve[$vSuitingCountIndex] = 0;
                    $vSuitingCount--;
                }

                if ($is_shirts) {
                    /* Get Shirt size */

                    foreach ($aShirtLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vShirtCountIndex = $thisIndex;
                            break;
                        }

                    $shirtLength = $this->input->post("shirtLength[" . $vShirtCountIndex . "]");
                    $shirtShoulder = $this->input->post("shirtShoulder[" . $vShirtCountIndex . "]");
                    $shirtSleeves = $this->input->post("shirtSleeves[" . $vShirtCountIndex . "]");
                    $shirtNeck = $this->input->post("shirtNeck[" . $vShirtCountIndex . "]");
                    $shirtChest = $this->input->post("shirtChest[" . $vShirtCountIndex . "]");
                    $shirtWaist = $this->input->post("shirtWaist[" . $vShirtCountIndex . "]");
                    $shirtHips = $this->input->post("shirtHips[" . $vShirtCountIndex . "]");
                    $shirtBicep = $this->input->post("shirtBicep[" . $vShirtCountIndex . "]");
                    $shirtForearm = $this->input->post("shirtForearm[" . $vShirtCountIndex . "]");
                    $shirtarmhole = $this->input->post("shirtarmhole[" . $vShirtCountIndex . "]");
                    $shirtcuff = $this->input->post("shirtcuff[" . $vShirtCountIndex . "]");

                    if (isset($_POST["is_placket"][$vShirtCountIndex]) && !empty($_POST['is_placket'][$vShirtCountIndex])) {
                        $is_front_placket = $_POST['is_placket'][$vShirtCountIndex];
                    } else {
                        $is_front_placket = isset($_POST["is_placket"][0]) ? $_POST["is_placket"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_cuff"][$vShirtCountIndex]) && !empty($_POST['is_shirt_cuff'][$vShirtCountIndex])) {
                        $is_shirt_cuff = $_POST['is_shirt_cuff'][$vShirtCountIndex];
                    } else {
                        $is_shirt_cuff = isset($_POST["is_shirt_cuff"][0]) ? $_POST["is_shirt_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar'][$vShirtCountIndex])) {
                        $is_shirt_collar = $_POST['is_shirt_collar'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar = isset($_POST["is_shirt_collar"][0]) ? $_POST["is_shirt_collar"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar_type"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar_type'][$vShirtCountIndex])) {
                        $is_shirt_collar_type = $_POST['is_shirt_collar_type'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar_type = isset($_POST["is_shirt_collar_type"][0]) ? $_POST["is_shirt_collar_type"][0] : 0;
                    }
                    $shirt_collar_ins = $this->input->post("shirt_collar_ins[" . $vShirtCountIndex . "]");
                    $shirt_inst = $this->input->post("shirt_inst[" . $vShirtCountIndex . "]");
                    $aShirtLength[$vShirtCountIndex] = 0;
                    $vShirtCount--;
                }
                if ($is_shalwarqameez) {
                    /* Get kamiz size */
                    foreach ($akmzLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vKmzCountIndex = $thisIndex;
                            break;
                        }
                    $kmzLength = $this->input->post("kmzLength[" . $vKmzCountIndex . "]");
                    $kurtaLength = $this->input->post("kurtaLength[" . $vKmzCountIndex . "]");
                    $kmzSleeves = $this->input->post("kmzSleeves[" . $vKmzCountIndex . "]");
                    $kmzShoulder = $this->input->post("kmzShoulder[" . $vKmzCountIndex . "]");
                    $kmzNeck = $this->input->post("kmzNeck[" . $vKmzCountIndex . "]");
                    $kmzChest = $this->input->post("kmzChest[" . $vKmzCountIndex . "]");
                    $kmzWaist = $this->input->post("kmzWaist[" . $vKmzCountIndex . "]");
                    $kmzGuaira = $this->input->post("kmzGuaira[" . $vKmzCountIndex . "]");
                    $kmzHips = $this->input->post("kmzHips[" . $vKmzCountIndex . "]");
                    $kmzBicep = $this->input->post("kmzBicep[" . $vKmzCountIndex . "]");
                    $kmzForearm = $this->input->post("kmzForearm[" . $vKmzCountIndex . "]");
                    $kmzarmhole = $this->input->post("kmzarmhole[" . $vKmzCountIndex . "]");
                    $kmzcuff = $this->input->post("kmzcuff[" . $vKmzCountIndex . "]");

                    /* Shwalr size */
                    $shlLength = $this->input->post("shlLength[" . $vKmzCountIndex . "]");
                    $shlBottom = $this->input->post("shlBottom[" . $vKmzCountIndex . "]");
                    $shlAsanTyar = $this->input->post("shlAsanTyar[" . $vKmzCountIndex . "]");
                    $shlGairaTyar = $this->input->post("shlGairaTyar[" . $vKmzCountIndex . "]");
                    $pjamaLength = $this->input->post("pjamaLength[" . $vKmzCountIndex . "]");
                    $pjamaBottom = $this->input->post("pjamaBottom[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_collar"][$vKmzCountIndex]) && !empty($_POST['is_collar'][$vKmzCountIndex])) {
                        $is_collar = $_POST['is_collar'][$vKmzCountIndex];
                    } else {
                        $is_collar = isset($_POST["is_collar"][0]) ? $_POST["is_collar"][0] : 0;
                    }
                    $collar_ins = $this->input->post("collar_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_front"][$vKmzCountIndex]) && !empty($_POST['is_front'][$vKmzCountIndex])) {
                        $is_straight_front = $_POST['is_front'][$vKmzCountIndex];
                    } else {
                        $is_straight_front = isset($_POST["is_front"][0]) ? $_POST["is_front"][0] : 0;
                    }

                    if (isset($_POST["is_front_pocket"][$vKmzCountIndex]) && !empty($_POST['is_front_pocket'][$vKmzCountIndex])) {
                        $is_front_pocket = $_POST['is_front_pocket'][$vKmzCountIndex];
                    } else {
                        $is_front_pocket = isset($_POST["is_front_pocket"][0]) ? $_POST["is_front_pocket"][0] : 0;
                    }
                    $front_pocket_ins = $this->input->post("front_pocket_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_shalwar_pocket"][$vKmzCountIndex]) && !empty($_POST['is_shalwar_pocket'][$vKmzCountIndex])) {
                        $is_shalwar_pocket = $_POST['is_shalwar_pocket'][$vKmzCountIndex];
                    } else {
                        $is_shalwar_pocket = isset($_POST["is_shalwar_pocket"][0]) ? $_POST["is_shalwar_pocket"][0] : 0;
                    }
                    $shalwar_pocket_ins = $this->input->post("shalwar_pocket_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_pocket"][$vKmzCountIndex]) && !empty($_POST['is_pocket'][$vKmzCountIndex])) {
                        $is_1side_pocket = $_POST['is_pocket'][$vKmzCountIndex];
                    } else {
                        $is_1side_pocket = isset($_POST["is_pocket"][0]) ? $_POST["is_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_sleeve_placket"][$vKmzCountIndex]) && !empty($_POST['is_sleeve_placket'][$vKmzCountIndex])) {
                        $is_sleeve_placket = $_POST['is_sleeve_placket'][$vKmzCountIndex];
                    } else {
                        $is_sleeve_placket = isset($_POST["is_sleeve_placket"][0]) ? $_POST["is_sleeve_placket"][0] : 0;
                    }

                    if (isset($_POST["is_button"][$vKmzCountIndex]) && !empty($_POST['is_button'][$vKmzCountIndex])) {
                        $is_plain_button = $_POST['is_button'][$vKmzCountIndex];
                    } else {
                        $is_plain_button = isset($_POST["is_button"][0]) ? $_POST["is_button"][0] : 0;
                    }

                    if (isset($_POST["is_cuff"][$vKmzCountIndex]) && !empty($_POST['is_cuff'][$vKmzCountIndex])) {
                        $is_button_cuff = $_POST['is_cuff'][$vKmzCountIndex];
                    } else {
                        $is_button_cuff = isset($_POST["is_cuff"][0]) ? $_POST["is_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_design"][$vKmzCountIndex]) && !empty($_POST['is_design'][$vKmzCountIndex])) {
                        $is_design = $_POST['is_design'][$vKmzCountIndex];
                    } else {
                        $is_design = isset($_POST["is_design"][0]) ? $_POST["is_design"][0] : 0;
                    }

                    if (isset($_POST["is_kanta"][$vKmzCountIndex]) && !empty($_POST['is_kanta'][$vKmzCountIndex])) {
                        $is_kanta = $_POST['is_kanta'][$vKmzCountIndex];
                    } else {
                        $is_kanta = isset($_POST["is_kanta"][0]) ? $_POST["is_kanta"][0] : 0;
                    }

                    if (isset($_POST["is_stitch"][$vKmzCountIndex]) && !empty($_POST['is_stitch'][$vKmzCountIndex])) {
                        $is_stitch = $_POST['is_stitch'][$vKmzCountIndex];
                    } else {
                        $is_stitch = isset($_POST["is_stitch"][0]) ? $_POST["is_stitch"][0] : 0;
                    }

                    if (isset($_POST["is_thread"][$vKmzCountIndex]) && !empty($_POST['is_thread'][$vKmzCountIndex])) {
                        $is_thread = $_POST['is_thread'][$vKmzCountIndex];
                    } else {
                        $is_thread = isset($_POST["is_thread"][0]) ? $_POST["is_thread"][0] : 0;
                    }

                    if (isset($_POST["is_bookrum"][$vKmzCountIndex]) && !empty($_POST['is_bookrum'][$vKmzCountIndex])) {
                        $is_bookrum = $_POST['is_bookrum'][$vKmzCountIndex];
                    } else {
                        $is_bookrum = isset($_POST["is_bookrum"][0]) ? $_POST["is_bookrum"][0] : 0;
                    }

                    $shalwar_inst = $this->input->post("shalwar_inst[" . $vKmzCountIndex . "]");
                    $akmzLength[$vKmzCountIndex] = 0;
                    $vShalwarKamezCount--;
                }

                //add into invoice table
                $ptype = "Cash";
                $coupon = "";
                $notes = "ss";
                $coupon_amount = 0;
                $coupon_n = '';
                $invocieno = $this->invocies->lastinvoice() + 1;
                $invoicedate = $book_date;
                $invocieduedate = $d_date;
                $tax = "";
                $total_tax = 0;
                $subtotal = rev_amountExchange_s(0);

                $total = rev_amountExchange_s(0);
                $p_amount = rev_amountExchange_s(0);

                $c_amt = $p_amount - $total;
                if ($c_amt == 0.00) {
                    $status = 'Paid';
                    $pamnt = $total;
                } elseif ($c_amt < 0.00) {
                    $status = 'Partial';
                    if ($p_amount == 0.00)
                        $status = 'Due';
                    $pamnt = $p_amount;
                    $c_amt = 0;
                } else {
                    $status = 'Paid';
                    $pamnt = $total;
                }

                //echo '<pre>'; print_r($_POST); exit;
                $this->customers->tailoringCustomerAdd($vCustomerID, $ref_no, 0,$book_date, $t_date, $d_date, $cutter_name, $karigar_name, $quantity, $is_suiting, $is_shirts, $is_shalwarqameez, $is_english, $is_urdu,
                        $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $cBicep, $cForearm, $cNeck, $cLength, $p3_waistcoat_length, $waistcoat_length,
                        $princecoat_length, $sherwani_length, $longcoat_length, $chester_length, $armhole,
                        $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee,
                        $is_breasted, $is_double_breasted, $is_button_suit, $is_two_button_suit, $is_lapel, $is_peak_lapel, $is_shawl_lapel, $is_wear, $is_casual_wear, $is_groom_wear, $is_vent, $is_double_vent, $is_no_vent, $is_lined, $is_half_lined, $is_ticket, $is_slant, $is_regular, $is_button, $is_metalic_button,
                        $shirtLength, $shirtShoulder, $shirtSleeves, $shirtNeck, $shirtChest, $shirtWaist, $shirtHips,
                        $shirtBicep, $shirtForearm, $shirtarmhole, $shirtcuff,
                        $kmzLength, $kurtaLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $kmzHips, $kmzBicep, $kmzForearm, $kmzarmhole, $kmzcuff,
                        $is_darts, $is_sleeve_placket, $is_front_placket, $is_plane_placket, $is_shirt_cuff, $is_plain_cuff, $is_french_cuff,
                        $is_double_cuff, $is_shirt_collar, $is_shirt_collar_type, $shirt_collar_ins,
                        $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $pjamaLength, $pjamaBottom,
                        $is_collar, $is_moon_neck, $is_straight_front, $is_1side_pocket, $is_2side_pocket, $is_fancy_button,
                        $is_band, $is_round_front, $is_front_pocket, $is_shalwar_pocket, $is_covered_fly,
                        $is_plain_button, $is_open_sleeves, $is_button_cuff, $is_design, $is_kanta, $is_stitch, $is_thread, $is_bookrum,
                        $collar_ins, $front_pocket_ins, $shalwar_pocket_ins, $instrucation, $shirt_inst, $shalwar_inst, $ptype, $coupon, $notes,
                        $coupon_amount, $coupon_n, $invocieno, $invoicedate, $invocieduedate, $tax, $total_tax, $status, $pamnt, $total, $p_amount,0);
            }

            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp;<a href="' . base_url('/customers') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $vCustomerID));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function updatecolthingCustomer() {

        // print_r(json_encode($this->input->post('cChest')));exit;
        //delete old data
        $this->customers->delete($this->input->post('customer_id'));

        $vShirtCount = $this->input->post('is_shirts') != NULL ? count($this->input->post('is_shirts')) : 0;
        $vSuitingCount = $this->input->post('is_suiting') != NULL ? count($this->input->post('is_suiting')) : 0;
        $vShalwarKamezCount = $this->input->post('is_shalwarqameez') != NULL ? count($this->input->post('is_shalwarqameez')) : 0;
        $vTotalCOunt = $vShirtCount + $vSuitingCount + $vShalwarKamezCount;
        $vSuitingCountIndex = 0;
        $vShirtCountIndex = 0;
        $vKmzCountIndex = 0;
        $cSleeve = [];
        $aShirtLength = [];
        $akmzLength = [];

        $basic_info_id = $this->input->post('basic_info_id', true);
        $old_customer_id = $this->input->post('customer_id', true);
        $ref_no = $this->input->post('or_ref_no', true);

        $book_date = $this->input->post('booking_date');
        $book_date = date('Y-m-d', strtotime($book_date));

        $d_date = $this->input->post('d_date');
        $d_date = date('Y-m-d', strtotime($d_date));

        $t_date = $this->input->post('t_date');
        $t_date = date('Y-m-d', strtotime($t_date));

        $name = $this->input->post('customer_name', true);
        $cutter_name = $this->input->post('cutter_name', true);
        $karigar_name = $this->input->post('karigar_name', true);
        $quantity = $this->input->post('quantity', true); 
        
        $mobile = $this->input->post('mobile', true);

        $is_english = false;
        $is_urdu = false;
        if (!empty($_POST["is_english"])) {
            $is_english = true;
        }
        if (!empty($_POST["is_urdu"])) {
            $is_urdu = true;
        }
        $vCustomerID = $this->customers->fAddCustomer($name, $mobile);
        if ($vCustomerID) {
            for ($i = 0; $i < $vTotalCOunt; $i++) {

                $is_suiting = false;
                $is_shirts = false;
                $is_shalwarqameez = false;

                if ($vSuitingCount) {
                    $is_suiting = true;
                } else if ($vShirtCount) {
                    $is_shirts = true;
                } else if ($vShalwarKamezCount) {
                    $is_shalwarqameez = true;
                }
                if (empty($cSleeve))
                    $cSleeve = $this->input->post('cSleeve');
                if (empty($aShirtLength))
                    $aShirtLength = $this->input->post('shirtLength');
                if (empty($akmzLength))
                    $akmzLength = $this->input->post('kmzLength');


                $instrucation = "";
                $shirt_inst = "";
                $shalwar_inst = "";
                //echo $i. '<br>'; 
                $cSleeves = '';
                $cShoulder = '';
                $cHalfBack = '';
                $cCrossBack = '';
                $cChest = '';
                $cWaist = '';
                $cHips = '';
                $cBicep = '';
                $cForearm = '';
                $cNeck = '';
                $cLength = '';
                $p3_waistcoat_length = '';
                $waistcoat_length = '';
                $princecoat_length = '';
                $sherwani_length = '';
                $longcoat_length = '';
                $chester_length = '';
                $armhole = '';

                /* Get pant length */
                $pLength = '';
                $pInLength = '';
                $pWaist = '';
                $pHip = '';
                $pThigh = '';
                $pBottom = '';
                $pKnee = '';

                /* Get Suiting Checks */
                $is_breasted = 0;
                $is_double_breasted = 0;
                $is_button_suit = 0;
                $is_two_button_suit = 0;
                $is_lapel = 0;
                $is_peak_lapel = 0;
                $is_shawl_lapel = 0;
                $is_wear = 0;
                $is_casual_wear = 0;
                $is_groom_wear = 0;
                $is_vent = 0;
                $is_double_vent = 0;
                $is_no_vent = 0;
                $is_lined = 0;
                $is_half_lined = 0;
                $is_ticket = 0;
                $is_slant = 0;
                $is_regular = 0;
                $is_button = 0;
                $is_metalic_button = 0;

                $shirtLength = '';
                $shirtShoulder = '';
                $shirtSleeves = '';
                $shirtNeck = '';
                $shirtChest = '';
                $shirtWaist = '';
                $shirtHips = '';
                $shirtBicep = '';
                $shirtForearm = '';
                $shirtarmhole = '';
                $shirtcuff = '';

                $is_darts = 0;
                $is_sleeve_placket = 0;
                $is_front_placket = 0;
                $is_plane_placket = 0;
                $is_shirt_cuff = 0;
                $is_plain_cuff = 0;
                $is_french_cuff = 0;
                $is_double_cuff = 0;
                $is_shirt_collar = 0;
                $is_shirt_collar_type = 0;

                $kmzLength = '';
                $kurtaLength = '';
                $kmzSleeves = '';
                $kmzShoulder = '';
                $kmzNeck = '';
                $kmzChest = '';
                $kmzWaist = '';
                $kmzGuaira = '';
                $kmzHips = '';
                $kmzBicep = '';
                $kmzForearm = '';
                $kmzarmhole = '';
                $kmzcuff = '';

                /* Shwalr size */
                $shlLength = '';
                $shlBottom = '';
                $shlAsanTyar = '';
                $shlGairaTyar = '';
                $pjamaLength = '';
                $pjamaBottom = '';

                $is_collar = 0;
                $is_straight_front = 0;
                $is_1side_pocket = 0;
                $is_front_pocket = 0;
                $is_shalwar_pocket = 0;
                $is_sleeve_placket = 0;
                $is_plain_button = 0;
                $is_button_cuff = 0;
                $is_design = 0;
                $is_kanta = 0;
                $is_stitch = 0;
                $is_thread = 0;
                $is_bookrum = 0;
                $is_moon_neck = 0;
                $is_2side_pocket = 0;
                $is_fancy_button = 0;
                $is_band = 0;
                $is_round_front = 0;
                $is_covered_fly = 0;
                $is_open_sleeves = 0;
                $shirt_collar_ins = '';
                $collar_ins = '';
                $front_pocket_ins = '';
                $shalwar_pocket_ins = '';

                //if ($is_suiting) {
                    /* Get  coat/waist coat size */

                    foreach ($cSleeve as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vSuitingCountIndex = $thisIndex;
                            break;
                        }

                    $cSleeves = $this->input->post("cSleeve[" . $vSuitingCountIndex . "]");
                    $cShoulder = $this->input->post("cShoulder[" . $vSuitingCountIndex . "]");
                    $cHalfBack = $this->input->post("cHalfBack[" . $vSuitingCountIndex . "]");
                    $cCrossBack = $this->input->post("cCrossBack[" . $vSuitingCountIndex . "]");
                    $cChest = $this->input->post("cChest[" . $vSuitingCountIndex . "]");
                    $cWaist = $this->input->post("cWaist[" . $vSuitingCountIndex . "]");
                    $cHips = $this->input->post("cHips[" . $vSuitingCountIndex . "]");
                    $cBicep = $this->input->post("cBicep[" . $vSuitingCountIndex . "]");
                    $cForearm = $this->input->post("cForearm[" . $vSuitingCountIndex . "]");
                    $cNeck = $this->input->post("cNeck[" . $vSuitingCountIndex . "]");
                    $cLength = $this->input->post("cLength[" . $vSuitingCountIndex . "]");
                    $p3_waistcoat_length = $this->input->post("3p_waistcoat_length[" . $vSuitingCountIndex . "]");
                    $waistcoat_length = $this->input->post("waistcoat_length[" . $vSuitingCountIndex . "]");
                    $princecoat_length = $this->input->post("princecoat_length[" . $vSuitingCountIndex . "]");
                    $sherwani_length = $this->input->post("sherwani_length[" . $vSuitingCountIndex . "]");
                    $longcoat_length = $this->input->post("longcoat_length[" . $vSuitingCountIndex . "]");
                    $chester_length = $this->input->post("chester_length[" . $vSuitingCountIndex . "]");
                    $armhole = $this->input->post("armhole[" . $vSuitingCountIndex . "]");

                    /* Get pant length */
                    $pLength = $this->input->post("pLength[" . $vSuitingCountIndex . "]");
                    $pInLength = $this->input->post("pInLength[" . $vSuitingCountIndex . "]");
                    $pWaist = $this->input->post("pWaist[" . $vSuitingCountIndex . "]");
                    $pHip = $this->input->post("pHip[" . $vSuitingCountIndex . "]");
                    $pThigh = $this->input->post("pThigh[" . $vSuitingCountIndex . "]");
                    $pBottom = $this->input->post("pBottom[" . $vSuitingCountIndex . "]");
                    $pKnee = $this->input->post("pKnee[" . $vSuitingCountIndex . "]");

                    if (isset($_POST["is_breasted"][$vSuitingCountIndex]) && !empty($_POST["is_breasted"][$vSuitingCountIndex])) {
                        $is_breasted = $_POST["is_breasted"][$vSuitingCountIndex];
                    } else {
                        $is_breasted = isset($_POST["is_breasted"][0]) ? $_POST["is_breasted"][0] : 0;
                    }

                    if (isset($_POST["is_button_suit"][$vSuitingCountIndex]) && !empty($_POST['is_button_suit'][$vSuitingCountIndex])) {
                        $is_button_suit = $_POST["is_button_suit"][$vSuitingCountIndex];
                    } else {
                        $is_button_suit = isset($_POST["is_button_suit"][0]) ? $_POST["is_button_suit"][0] : 0;
                    }

                    if (isset($_POST["is_lapel"][$vSuitingCountIndex]) && !empty($_POST['is_lapel'][$vSuitingCountIndex])) {
                        $is_lapel = $_POST["is_lapel"][$vSuitingCountIndex];
                    } else {
                        $is_lapel = isset($_POST["is_lapel"][0]) ? $_POST["is_lapel"][0] : 0;
                    }

                    if (isset($_POST["is_vent"][$vSuitingCountIndex]) && !empty($_POST['is_vent'][$vSuitingCountIndex])) {
                        $is_vent = $_POST['is_vent'][$vSuitingCountIndex];
                    } else {
                        $is_vent = isset($_POST["is_vent"][0]) ? $_POST["is_vent"][0] : 0;
                    }

                    if (isset($_POST["is_wear"][$vSuitingCountIndex]) && !empty($_POST['is_wear'][$vSuitingCountIndex])) {
                        $is_wear = $_POST['is_wear'][$vSuitingCountIndex];
                    } else {
                        $is_wear = isset($_POST["is_wear"][0]) ? $_POST["is_wear"][0] : 0;
                    }

                    if (isset($_POST["is_lined"][$vSuitingCountIndex]) && !empty($_POST['is_lined'][$vSuitingCountIndex])) {
                        $is_lined = $_POST['is_lined'][$vSuitingCountIndex];
                    } else {
                        $is_lined = isset($_POST["is_lined"][0]) ? $_POST["is_lined"][0] : 0;
                    }

                    if (isset($_POST["is_ticket"][$vSuitingCountIndex]) && !empty($_POST['is_ticket'][$vSuitingCountIndex])) {
                        $is_ticket = $_POST['is_ticket'][$vSuitingCountIndex];
                    } else {
                        $is_ticket = isset($_POST["is_ticket"][0]) ? $_POST["is_ticket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_pocket"][$vSuitingCountIndex]) && !empty($_POST['is_suit_pocket'][$vSuitingCountIndex])) {
                        $is_regular = $_POST['is_suit_pocket'][$vSuitingCountIndex];
                    } else {
                        $is_regular = isset($_POST["is_suit_pocket"][0]) ? $_POST["is_suit_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_suit_button"][$vSuitingCountIndex]) && !empty($_POST['is_suit_button'][$vSuitingCountIndex])) {
                        $is_button = $_POST['is_suit_button'][$vSuitingCountIndex];
                    } else {
                        $is_button = isset($_POST["is_suit_button"][0]) ? $_POST["is_suit_button"][0] : 0;
                    }
                    $instrucation = $this->input->post("inst[" . $vSuitingCountIndex . "]");
                    $cSleeve[$vSuitingCountIndex] = 0;
                    $vSuitingCount--;
                //}

                //if ($is_shirts) {
                    /* Get Shirt size */

                    foreach ($aShirtLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vShirtCountIndex = $thisIndex;
                            break;
                        }

                    $shirtLength = $this->input->post("shirtLength[" . $vShirtCountIndex . "]");
                    $shirtShoulder = $this->input->post("shirtShoulder[" . $vShirtCountIndex . "]");
                    $shirtSleeves = $this->input->post("shirtSleeves[" . $vShirtCountIndex . "]");
                    $shirtNeck = $this->input->post("shirtNeck[" . $vShirtCountIndex . "]");
                    $shirtChest = $this->input->post("shirtChest[" . $vShirtCountIndex . "]");
                    $shirtWaist = $this->input->post("shirtWaist[" . $vShirtCountIndex . "]");
                    $shirtHips = $this->input->post("shirtHips[" . $vShirtCountIndex . "]");
                    $shirtBicep = $this->input->post("shirtBicep[" . $vShirtCountIndex . "]");
                    $shirtForearm = $this->input->post("shirtForearm[" . $vShirtCountIndex . "]");
                    $shirtarmhole = $this->input->post("shirtarmhole[" . $vShirtCountIndex . "]");
                    $shirtcuff = $this->input->post("shirtcuff[" . $vShirtCountIndex . "]");

                    if (isset($_POST["is_placket"][$vShirtCountIndex]) && !empty($_POST['is_placket'][$vShirtCountIndex])) {
                        $is_placket = $_POST['is_placket'][$vShirtCountIndex];
                        if ($is_placket == 1)
                            $is_front_placket = 1;
                        else if ($is_placket == 2)
                            $is_plane_placket = 1;
                    } else {
                        $is_front_placket = isset($_POST["is_placket"][0]) ? $_POST["is_placket"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_cuff"][$vShirtCountIndex]) && !empty($_POST['is_shirt_cuff'][$vShirtCountIndex])) {
                        $is_shirt_cuff = $_POST['is_shirt_cuff'][$vShirtCountIndex];
                    } else {
                        $is_shirt_cuff = isset($_POST["is_shirt_cuff"][0]) ? $_POST["is_shirt_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar'][$vShirtCountIndex])) {
                        $is_shirt_collar = $_POST['is_shirt_collar'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar = isset($_POST["is_shirt_collar"][0]) ? $_POST["is_shirt_collar"][0] : 0;
                    }

                    if (isset($_POST["is_shirt_collar_type"][$vShirtCountIndex]) && !empty($_POST['is_shirt_collar_type'][$vShirtCountIndex])) {
                        $is_shirt_collar_type = $_POST['is_shirt_collar_type'][$vShirtCountIndex];
                    } else {
                        $is_shirt_collar_type = isset($_POST["is_shirt_collar_type"][0]) ? $_POST["is_shirt_collar_type"][0] : 0;
                    }
                    $shirt_collar_ins = $this->input->post("shirt_collar_ins[" . $vShirtCountIndex . "]");
                    $shirt_inst = $this->input->post("shirt_inst[" . $vShirtCountIndex . "]");
                    $aShirtLength[$vShirtCountIndex] = 0;
                    $vShirtCount--;
                //}
                //if ($is_shalwarqameez) {
                    /* Get kamiz size */
                    foreach ($akmzLength as $thisIndex => $thisItem)
                        if ($thisItem) {
                            $vKmzCountIndex = $thisIndex;
                            break;
                        }
                    $kmzLength = $this->input->post("kmzLength[" . $vKmzCountIndex . "]");
                    $kurtaLength = $this->input->post("kurtaLength[" . $vKmzCountIndex . "]");
                    $kmzSleeves = $this->input->post("kmzSleeves[" . $vKmzCountIndex . "]");
                    $kmzShoulder = $this->input->post("kmzShoulder[" . $vKmzCountIndex . "]");
                    $kmzNeck = $this->input->post("kmzNeck[" . $vKmzCountIndex . "]");
                    $kmzChest = $this->input->post("kmzChest[" . $vKmzCountIndex . "]");
                    $kmzWaist = $this->input->post("kmzWaist[" . $vKmzCountIndex . "]");
                    $kmzGuaira = $this->input->post("kmzGuaira[" . $vKmzCountIndex . "]");
                    $kmzHips = $this->input->post("kmzHips[" . $vKmzCountIndex . "]");
                    $kmzBicep = $this->input->post("kmzBicep[" . $vKmzCountIndex . "]");
                    $kmzForearm = $this->input->post("kmzForearm[" . $vKmzCountIndex . "]");
                    $kmzarmhole = $this->input->post("kmzarmhole[" . $vKmzCountIndex . "]");
                    $kmzcuff = $this->input->post("kmzcuff[" . $vKmzCountIndex . "]");

                    /* Shwalr size */
                    $shlLength = $this->input->post("shlLength[" . $vKmzCountIndex . "]");
                    $shlBottom = $this->input->post("shlBottom[" . $vKmzCountIndex . "]");
                    $shlAsanTyar = $this->input->post("shlAsanTyar[" . $vKmzCountIndex . "]");
                    $shlGairaTyar = $this->input->post("shlGairaTyar[" . $vKmzCountIndex . "]");
                    $pjamaLength = $this->input->post("pjamaLength[" . $vKmzCountIndex . "]");
                    $pjamaBottom = $this->input->post("pjamaBottom[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_collar"][$vKmzCountIndex]) && !empty($_POST['is_collar'][$vKmzCountIndex])) {
                        $is_collar = $_POST['is_collar'][$vKmzCountIndex];
                    } else {
                        $is_collar = isset($_POST["is_collar"][0]) ? $_POST["is_collar"][0] : 0;
                    }
                    $collar_ins = $this->input->post("collar_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_front"][$vKmzCountIndex]) && !empty($_POST['is_front'][$vKmzCountIndex])) {
                        $is_straight_front = $_POST['is_front'][$vKmzCountIndex];
                    } else {
                        $is_straight_front = isset($_POST["is_front"][0]) ? $_POST["is_front"][0] : 0;
                    }

                    if (isset($_POST["is_front_pocket"][$vKmzCountIndex]) && !empty($_POST['is_front_pocket'][$vKmzCountIndex])) {
                        $is_front_pocket = $_POST['is_front_pocket'][$vKmzCountIndex];
                    } else {
                        $is_front_pocket = isset($_POST["is_front_pocket"][0]) ? $_POST["is_front_pocket"][0] : 0;
                    }
                    $front_pocket_ins = $this->input->post("front_pocket_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_shalwar_pocket"][$vKmzCountIndex]) && !empty($_POST['is_shalwar_pocket'][$vKmzCountIndex])) {
                        $is_shalwar_pocket = $_POST['is_shalwar_pocket'][$vKmzCountIndex];
                    } else {
                        $is_shalwar_pocket = isset($_POST["is_shalwar_pocket"][0]) ? $_POST["is_shalwar_pocket"][0] : 0;
                    }
                    $shalwar_pocket_ins = $this->input->post("shalwar_pocket_ins[" . $vKmzCountIndex . "]");

                    if (isset($_POST["is_pocket"][$vKmzCountIndex]) && !empty($_POST['is_pocket'][$vKmzCountIndex])) {
                        $is_1side_pocket = $_POST['is_pocket'][$vKmzCountIndex];
                    } else {
                        $is_1side_pocket = isset($_POST["is_pocket"][0]) ? $_POST["is_pocket"][0] : 0;
                    }

                    if (isset($_POST["is_sleeve_placket"][$vKmzCountIndex]) && !empty($_POST['is_sleeve_placket'][$vKmzCountIndex])) {
                        $is_sleeve_placket = $_POST['is_sleeve_placket'][$vKmzCountIndex];
                    } else {
                        $is_sleeve_placket = isset($_POST["is_sleeve_placket"][0]) ? $_POST["is_sleeve_placket"][0] : 0;
                    }

                    if (isset($_POST["is_button"][$vKmzCountIndex]) && !empty($_POST['is_button'][$vKmzCountIndex])) {
                        $is_plain_button = $_POST['is_button'][$vKmzCountIndex];
                    } else {
                        $is_plain_button = isset($_POST["is_button"][0]) ? $_POST["is_button"][0] : 0;
                    }
                    
                    

                    if (isset($_POST["is_cuff"][$vKmzCountIndex]) && !empty($_POST['is_cuff'][$vKmzCountIndex])) {
                        $is_button_cuff = $_POST['is_cuff'][$vKmzCountIndex];
                    } else {
                        $is_button_cuff = isset($_POST["is_cuff"][0]) ? $_POST["is_cuff"][0] : 0;
                    }

                    if (isset($_POST["is_design"][$vKmzCountIndex]) && !empty($_POST['is_design'][$vKmzCountIndex])) {
                        $is_design = $_POST['is_design'][$vKmzCountIndex];
                    } else {
                        $is_design = isset($_POST["is_design"][0]) ? $_POST["is_design"][0] : 0;
                    }

                    if (isset($_POST["is_kanta"][$vKmzCountIndex]) && !empty($_POST['is_kanta'][$vKmzCountIndex])) {
                        $is_kanta = $_POST['is_kanta'][$vKmzCountIndex];
                    } else {
                        $is_kanta = isset($_POST["is_kanta"][0]) ? $_POST["is_kanta"][0] : 0;
                    }

                    if (isset($_POST["is_stitch"][$vKmzCountIndex]) && !empty($_POST['is_stitch'][$vKmzCountIndex])) {
                        $is_stitch = $_POST['is_stitch'][$vKmzCountIndex];
                    } else {
                        $is_stitch = isset($_POST["is_stitch"][0]) ? $_POST["is_stitch"][0] : 0;
                    }

                    if (isset($_POST["is_thread"][$vKmzCountIndex]) && !empty($_POST['is_thread'][$vKmzCountIndex])) {
                        $is_thread = $_POST['is_thread'][$vKmzCountIndex];
                    } else {
                        $is_thread = isset($_POST["is_thread"][0]) ? $_POST["is_thread"][0] : 0;
                    }

                    if (isset($_POST["is_bookrum"][$vKmzCountIndex]) && !empty($_POST['is_bookrum'][$vKmzCountIndex])) {
                        $is_bookrum = $_POST['is_bookrum'][$vKmzCountIndex];
                    } else {
                        $is_bookrum = isset($_POST["is_bookrum"][0]) ? $_POST["is_bookrum"][0] : 0;
                    }

                    $shalwar_inst = $this->input->post("shalwar_inst[" . $vKmzCountIndex . "]");
                    $akmzLength[$vKmzCountIndex] = 0;
                    $vShalwarKamezCount--;
               // }

                //add into invoice table
                $ptype = "Cash";
                $coupon = "";
                $notes = "ss";
                $coupon_amount = 0;
                $coupon_n = '';
                $invocieno = $this->invocies->lastinvoice() + 1;
                $invoicedate = $book_date;
                $invocieduedate = $d_date;
                $tax = "";
                $total_tax = 0;
                $subtotal = rev_amountExchange_s(0);

                $total = rev_amountExchange_s(0);
                $p_amount = rev_amountExchange_s(0);

                $c_amt = $p_amount - $total;
                if ($c_amt == 0.00) {
                    $status = 'Paid';
                    $pamnt = $total;
                } elseif ($c_amt < 0.00) {
                    $status = 'Partial';
                    if ($p_amount == 0.00)
                        $status = 'Due';
                    $pamnt = $p_amount;
                    $c_amt = 0;
                } else {
                    $status = 'Paid';
                    $pamnt = $total;
                }


                $this->customers->tailoringCustomerAdd($vCustomerID, $ref_no, $basic_info_id, $book_date, $t_date, $d_date,$cutter_name, $karigar_name, $quantity,  $is_suiting, $is_shirts, $is_shalwarqameez, $is_english, $is_urdu,
                        $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $cBicep, $cForearm, $cNeck, $cLength, $p3_waistcoat_length, $waistcoat_length,
                        $princecoat_length, $sherwani_length, $longcoat_length, $chester_length, $armhole,
                        $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee,
                        $is_breasted, $is_double_breasted, $is_button_suit, $is_two_button_suit, $is_lapel, $is_peak_lapel, $is_shawl_lapel, $is_wear, $is_casual_wear, $is_groom_wear, $is_vent, $is_double_vent, $is_no_vent, $is_lined, $is_half_lined, $is_ticket, $is_slant, $is_regular, $is_button, $is_metalic_button,
                        $shirtLength, $shirtShoulder, $shirtSleeves, $shirtNeck, $shirtChest, $shirtWaist, $shirtHips,
                        $shirtBicep, $shirtForearm, $shirtarmhole, $shirtcuff,
                        $kmzLength, $kurtaLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $kmzHips, $kmzBicep, $kmzForearm, $kmzarmhole, $kmzcuff,
                        $is_darts, $is_sleeve_placket, $is_front_placket, $is_plane_placket, $is_shirt_cuff, $is_plain_cuff, $is_french_cuff,
                        $is_double_cuff, $is_shirt_collar, $is_shirt_collar_type, $shirt_collar_ins,
                        $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $pjamaLength, $pjamaBottom,
                        $is_collar, $is_moon_neck, $is_straight_front, $is_1side_pocket, $is_2side_pocket, $is_fancy_button,
                        $is_band, $is_round_front, $is_front_pocket, $is_shalwar_pocket, $is_covered_fly,
                        $is_plain_button, $is_open_sleeves, $is_button_cuff, $is_design, $is_kanta, $is_stitch, $is_thread, $is_bookrum,
                        $collar_ins, $front_pocket_ins, $shalwar_pocket_ins, $instrucation, $shirt_inst, $shalwar_inst, $ptype, $coupon, $notes,
                        $coupon_amount, $coupon_n, $invocieno, $invoicedate, $invocieduedate, $tax, $total_tax, $status, $pamnt, $total, $p_amount, $old_customer_id);
            }

            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . '&nbsp;<a href="' . base_url('/customers') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span>' . $this->lang->line('View') . '</a>', 'cid' => $vCustomerID));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function oCus() {

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


            /* Get  coat/waist coat size */
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

            if ($c->sItem_Coat == "COAT") {
                $is_coat = true;
            }

            if ($c->sItem_WaistCoat == "WAIST COAT") {
                $is_wCoat = true;
            }

            /* Get pant length */
            $pLength = $c->nPant_Length;
            $pInLength = $c->nPant_InsideLength;
            $pWaist = $c->nPant_Waist;
            $pHip = $c->nPant_Hip;
            $pThigh = $c->nPant_Thigh;
            $pBottom = $c->nPant_Bottom;
            $pKnee = $c->nPant_Knee;

            /* Get kamiz and shalwar size */
            $kmzLength = $c->nKamiz_Length;
            $kmzSleeves = $c->nKamiz_Sleeves;
            $kmzShoulder = $c->nKamiz_Shoulder;
            $kmzNeck = $c->nKamiz_Neck;
            $kmzChest = $c->nKamiz_Chest;
            $kmzWaist = $c->nKamiz_Waist;
            $kmzGuaira = $c->nKamiz_Guaira;

            $is_kmz = false;
            $is_shirt = false;

            if ($c->sItem_Kamiz == "KAMIZ") {
                $is_kmz = true;
            }

            if ($c->sItem_Shirt == "SHIRT") {
                $is_shirt = true;
            }

            /* Shwalr size */
            $shlLength = $c->nShalwar_Length;
            $shlBottom = $c->nShalwar_Bottom;
            $shlAsanTyar = $c->nShalwar_AsanTyar;
            $shlGairaTyar = $c->nShalwar_GairaTyar;



            /* instrucations */
            $instrucation = $c->sInstructions;

            $this->customers->oldData($ref_no, $book_date, $t_date, $d_date, $name, $mobile, $cLength, $cSleeves, $cShoulder, $cHalfBack, $cCrossBack, $cChest, $cWaist, $cHips, $is_coat, $is_wCoat, $pLength, $pInLength, $pWaist, $pHip, $pThigh, $pBottom, $pKnee, $kmzLength, $kmzSleeves, $kmzShoulder, $kmzNeck, $kmzChest, $kmzWaist, $kmzGuaira, $is_kmz, $is_shirt, $shlLength, $shlBottom, $shlAsanTyar, $shlGairaTyar, $instrucation);
        }
    }

    public function editcustomer() {
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

    public function changepassword() {
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

    public function delete_i() {
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

    public function displaypic() {
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $this->input->get('id');
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/customers/'
        ));
        $img = (string) $this->uploadhandler->filenaam();
        if ($img != '') {
            $this->customers->editpicture($id, $img);
        }
    }

    public function translist() {
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

    public function inv_list() {
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

    public function transactions() {
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

    public function invoices() {
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

    public function quotes() {
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

    public function qto_list() {
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

    public function balance() {
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

    public function projects() {
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

    public function prj_list() {
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

    public function notes() {
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

    public function notes_load_list() {
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

    public function editnote() {
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

    public function addnote() {
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

    public function delete_note() {
        $id = $this->input->post('deleteid');
        $cid = $this->session->userdata('cid');
        if ($this->customers->deletenote($id, $cid)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    function statement() {

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

    public function documents() {
        $data['id'] = $this->input->get('id');
        $data['details'] = $this->customers->details($data['id']);
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->session->set_userdata("cid", $data['id']);
        $head['title'] = 'Documents';
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/documents', $data);
        $this->load->view('fixed/footer');
    }

    public function document_load_list() {
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

    public function adddocument() {
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

    public function delete_document() {
        $id = $this->input->post('deleteid');
        $cid = $this->session->userdata('cid');

        if ($this->customers->deletedocument($id, $cid)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

}
