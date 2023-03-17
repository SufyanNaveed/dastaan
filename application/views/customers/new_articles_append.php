<?php
$vToken = rand(10, 1000);

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
$mobile = $this->input->post('mobile', true);

$is_english = false;
$is_urdu = false;

$instrucation = "";
$shirt_inst = "";
$shalwar_inst = "";
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
}

//print_r($shirtLength);
//exit;
?>            
<div class="append_row_article append_row_for_article_<?php echo $count; ?>" data-appendNewSize="<?php echo $count; ?>"><hr>
    <button type="button"  class="btn btn-primary" data-count="<?php echo $count; ?>" onclick="previewModal(<?php echo $vToken; ?>,<?php echo $count; ?> )">Preview &nbsp;&nbsp;<i class="fa fa-eye"></i></button>
    &nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-danger remove_new_rows" style="float:right;" data-count="<?php echo $count; ?>">Remove Multiple &nbsp;&nbsp;<i class="fa fa-times"></i></button><br><br>
    <input type="hidden" value="<?php echo $vToken; ?>" name="aa_name[<?php echo $count; ?>]">
    <div class="row ">
        <div class="col-md-4">
            <h5 class="title text-center">Customer Info</h5>
            <div class="cus-bor cus-height">
                <div class="form-group row  mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Select Product:</label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input Spro" name="is_suiting[<?php echo $count; ?>]" id="suiting_<?php echo $count; ?>" value="suiting" data-counter="<?php echo $count; ?>">
                                <label class="custom-control-label" for="suiting_<?php echo $count; ?>">Suiting</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input Spro" name="is_shirts[<?php echo $count; ?>]" id="shirts_<?php echo $count; ?>" value="shirts" data-counter="<?php echo $count; ?>">
                                <label class="custom-control-label" for="shirts_<?php echo $count; ?>">Shirt</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input Spro" name="is_shalwarqameez[<?php echo $count; ?>]" id="shalwarqameez_<?php echo $count; ?>" value="shalwarqameez" data-counter="<?php echo $count; ?>">
                                <label class="custom-control-label" for="shalwarqameez_<?php echo $count; ?>"> Shalwar Kamiz</label>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-4 pl-0 coat_waistCoat" style="display:none;">

            <h5 class="title text-center">COAT / WAIST COAT</h5>
            <div class="cus-bor cus-height" style="height: 1130px;">
                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Neck</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="cNeck[<?php echo $count; ?>]" id="cNeck" value="<?php echo $cNeck ? $cNeck : "" ?>" >
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Chest</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cChest[<?php echo $count; ?>]" id="cChest" value="<?php echo $cChest ? $cChest : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Belly Waist</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cWaist[<?php echo $count; ?>]" id="cWaist" value="<?php echo $cWaist ? $cWaist : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Hip</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cHips[<?php echo $count; ?>]" id="cHips" value="<?php echo $cHips ? $cHips : "" ?>" >
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Shoulder</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cShoulder[<?php echo $count; ?>]" id="cShoulder" value="<?php echo $cShoulder ? $cShoulder : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Sleeves Length</label>
                    <div class="col-sm-4">
                        <input type="hidden" name ="cSleeve_form[<?php echo $count; ?>]" value="<?php echo $vToken; ?>">
                        <input type="text" class="form-control margin-bottom b_input" name="cSleeve[<?php echo $count; ?>]" id="cSleev" value="<?php echo $cSleeves ? $cSleeves : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Bicep</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="cBicep[<?php echo $count; ?>]" id="cBicep" value="<?php echo $cBicep ? $cBicep : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Forearm</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="cForearm[<?php echo $count; ?>]" id="cForearm" value="<?php echo $cForearm ? $cForearm : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Half Back</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cHalfBack[<?php echo $count; ?>]" id="cHalfBack" value="<?php echo $cHalfBack ? $cHalfBack : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Cross Back</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="cCrossBack[<?php echo $count; ?>]" id="cCrossBack" value="<?php echo $cCrossBack ? $cCrossBack : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Coat length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="cLength[<?php echo $count; ?>]" id="cLength" value="<?php echo $cLength ? $cLength : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">3p waistcoat Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="3p_waistcoat_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $p3_waistcoat_length ? $p3_waistcoat_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Waistcoat Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="waistcoat_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $waistcoat_length ? $waistcoat_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Princecoat Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="princecoat_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $princecoat_length ? $princecoat_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Sherwani Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="sherwani_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $sherwani_length ? $sherwani_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Long coat length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="longcoat_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $longcoat_length ? $longcoat_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Chester length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="chester_length[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $chester_length ? $chester_length : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-4 col-form-label" for="name">Armhole</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input" name="armhole[<?php echo $count; ?>]" id="Sec_cLength" value="<?php echo $armhole ? $armhole : "" ?>">
                    </div>
                </div>                            

            </div>   
        </div>
        <div class="col-md-4 pl-0 pant"  style="display:none;">
            <h5 class="title text-center">PANT</h5>
            <div class="cus-bor cus-height" style="height: 455px;">

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Waist</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pWaist[<?php echo $count; ?>]" id="pWaist" value="<?php echo $pWaist ? $pWaist : "" ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Hip</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pHip[<?php echo $count; ?>]" id="pHip" value="<?php echo $pHip ? $pHip : "" ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Thigh</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pThigh[<?php echo $count; ?>]" id="pThigh" value="<?php echo $pThigh ? $pThigh : "" ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Knee</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pKnee[<?php echo $count; ?>]" id="pKnee" value="<?php echo $pKnee ? $pKnee : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Inseam / Inside Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pInLength[<?php echo $count; ?>]" id="pInLength" value="<?php echo $pInLength ? $pInLength : "" ?>">
                    </div>
                </div> 


                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Length</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pLength[<?php echo $count; ?>]" id="pLength" value="<?php echo $pLength ? $pLength : "" ?>">
                    </div>
                </div>                                                     

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label" for="name">Bottom</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control margin-bottom b_input " name="pBottom[<?php echo $count; ?>]" id="pBottom" value="<?php echo $pBottom ? $pBottom : "" ?>">
                    </div>
                </div>                           
            </div>

            <div class="pant"  style="display:none;">
                <h5 class="title text-center">Checks</h5>
                <div class="cus-bor cus-height" style="height: 400px;">
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $count; ?>]" id="breasted_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="breasted_<?php echo $count; ?>">Single breasted</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $count; ?>]" id="double_breasted_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="double_breasted_<?php echo $count; ?>">Double breasted</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $count; ?>]" id="none_double_is_breasted_<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_double_is_breasted_<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $count; ?>]" id="button_suit_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="button_suit_<?php echo $count; ?>">One button</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $count; ?>]" id="two_button_suit_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="two_button_suit_<?php echo $count; ?>">Two button</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $count; ?>]" id="none_is_button_suit<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_button_suit<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $count; ?>]" id="lapel_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="lapel_<?php echo $count; ?>">Notch lapel</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $count; ?>]" id="peak_lapel_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="peak_lapel_<?php echo $count; ?>">Peak lapel</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $count; ?>]" id="shawl_lapel_<?php echo $count; ?>" value="3">
                                    <label class="custom-control-label" for="shawl_lapel_<?php echo $count; ?>">Shawl lapel</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $count; ?>]" id="none_is_lapel<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_lapel<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $count; ?>]" id="vent_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="vent_<?php echo $count; ?>">Single vent</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $count; ?>]" id="double_vent_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="double_vent_<?php echo $count; ?>">Double vents</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $count; ?>]" id="no_vent_<?php echo $count; ?>" value="3">
                                    <label class="custom-control-label" for="no_vent_<?php echo $count; ?>">No vent</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $count; ?>]" id="none_is_vent<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_vent<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $count; ?>]" id="wear_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="wear_<?php echo $count; ?>">Formal suit</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $count; ?>]" id="casual_wear_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="casual_wear_<?php echo $count; ?>"> Casual suit </label>
                                </div> &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $count; ?>]" id="groom_wear_<?php echo $count; ?>" value="3">
                                    <label class="custom-control-label" for="groom_wear_<?php echo $count; ?>">Grooms wear </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $count; ?>]" id="none_is_wear<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_wear<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $count; ?>]" id="lined_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="lined_<?php echo $count; ?>">Fully lined </label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $count; ?>]" id="half_lined_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="half_lined_<?php echo $count; ?>">Half lined</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $count; ?>]" id="none_is_lined<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_lined<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_ticket[<?php echo $count; ?>]" id="ticket_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="ticket_<?php echo $count; ?>">Ticket pocket </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_ticket[<?php echo $count; ?>]" id="none_is_ticket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_ticket<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $count; ?>]" id="regular_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="regular_<?php echo $count; ?>">Regular pockets</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $count; ?>]" id="slant_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="slant_<?php echo $count; ?>">Slant pocket </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $count; ?>]" id="none_is_suit_pocket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_suit_pocket<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $count; ?>]" id="metalic_button_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="metalic_button_<?php echo $count; ?>">Metallic buttons </label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $count; ?>]" id="button_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="button_<?php echo $count; ?>">Plain buttons</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $count; ?>]" id="none_is_suit_button<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_suit_button<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 pl-0 shirt_qameez"  style="display:none;">
            <h5 class="title text-center shalwar">KAMIZ / KURTA</h5>
            <h5 class="title text-center only_shirt">SHIRT</h5>
            <div class="cus-bor">
                <div class="only_shirt">
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Shirt Length</label>
                        <div class="col-sm-6">
                            <input type="hidden" name ="shirtLength_form[<?php echo $count; ?>]" value="<?php echo $vToken; ?>">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtLength[<?php echo $count; ?>]" id="kmzLength" value="<?php echo $shirtLength ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder[<?php echo $count; ?>]" id="kmzShoulder" value="<?php echo $shirtShoulder ? $shirtShoulder : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtSleeves[<?php echo $count; ?>]" id="kmzSleeves" value="<?php echo $shirtSleeves ? $shirtSleeves : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtNeck[<?php echo $count; ?>]" id="kmzNeck" value="<?php echo $shirtNeck ? $shirtNeck : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtChest[<?php echo $count; ?>]" id="kmzChest" value="<?php echo $shirtChest ? $shirtChest : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtWaist[<?php echo $count; ?>]" id="kmzWaist" value="<?php echo $shirtWaist ? $shirtWaist : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="shirtHips[<?php echo $count; ?>]" id="kmzHips" value="<?php echo $shirtHips ? $shirtHips : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="shirtBicep[<?php echo $count; ?>]" id="kmzBicep" value="<?php echo $shirtBicep ? $shirtBicep : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Forearm</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="shirtForearm[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $shirtForearm ? $shirtForearm : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="shirtarmhole[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $shirtarmhole ? $shirtarmhole : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="shirtcuff[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $shirtcuff ? $shirtcuff : "" ?>">
                        </div>
                    </div>
                </div>
                <div class="shalwar">
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Kameez Length</label>
                        <div class="col-sm-6">
                            <input type="hidden" name ="kmzLength_form[<?php echo $count; ?>]" value="<?php echo $vToken; ?>">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzLength[<?php echo $count; ?>]" id="kmzLength" value="<?php echo $kmzLength ? $kmzLength : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Kurta Length</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kurtaLength[<?php echo $count; ?>]" id="kmzLength" value="<?php echo $kurtaLength ? $kurtaLength : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzShoulder[<?php echo $count; ?>]" id="kmzShoulder" value="<?php echo $kmzShoulder ? $kmzShoulder : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzSleeves[<?php echo $count; ?>]" id="kmzSleeves" value="<?php echo $kmzSleeves ? $kmzSleeves : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzNeck[<?php echo $count; ?>]" id="kmzNeck" value="<?php echo $kmzNeck ? $kmzNeck : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzChest[<?php echo $count; ?>]" id="kmzChest" value="<?php echo $kmzChest ? $kmzChest : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzWaist[<?php echo $count; ?>]" id="kmzWaist" value="<?php echo $kmzWaist ? $kmzWaist : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input " name="kmzHips[<?php echo $count; ?>]" id="kmzHips" value="<?php echo $kmzHips ? $kmzHips : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="kmzBicep[<?php echo $count; ?>]" id="kmzBicep" value="<?php echo $kmzBicep ? $kmzBicep : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label"  for="name">Forearm</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="kmzForearm[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $kmzForearm ? $kmzForearm : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="kmzarmhole[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $kmzarmhole ? $kmzarmhole : "" ?>">
                        </div>
                    </div>
                    <div class="form-group row mt-1">
                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control margin-bottom b_input" name="kmzcuff[<?php echo $count; ?>]" id="kmzForearm" value="<?php echo $kmzcuff ? $kmzcuff : "" ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 pl-0 shalwar"  style="display:none;">                    
            <h5 class="title text-center">SHALWAR / PAJAMA</h5>
            <div class="cus-bor">
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Shalwar Length</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="shlLength[<?php echo $count; ?>]"
                               id="shlLength" value="<?php echo $shlLength ? $shlLength : "" ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Shalwar Bottom</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="shlBottom[<?php echo $count; ?>]"
                               id="shlBottom" value="<?php echo $shlBottom ? $shlBottom : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Asan Tyar</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="shlAsanTyar[<?php echo $count; ?>]"
                               id="shlAsanTyar" value="<?php echo $shlAsanTyar ? $shlAsanTyar : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Shalwar Gaira Tyar</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="shlGairaTyar[<?php echo $count; ?>]"
                               id="shlGairaTyar" value="<?php echo $shlGairaTyar ? $shlGairaTyar : "" ?>">
                    </div>
                </div>

                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Pajama Length</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="pjamaLength[<?php echo $count; ?>]"
                               id="shlLength" value="<?php echo $pjamaLength ? $pjamaLength : "" ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label class="col-sm-5 col-form-label"
                           for="name">Pajama Bottom</label>

                    <div class="col-sm-6">
                        <input type="text"
                               class="form-control margin-bottom b_input " name="pjamaBottom[<?php echo $count; ?>]"
                               id="shlBottom" value="<?php echo $pjamaBottom ? $pjamaBottom : "" ?>">
                    </div>
                </div>
            </div>

            <div class="shalwar"  style="display:none;">                    
                <h5 class="title text-center">Checks</h5>
                <div class="cus-bor">
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio form-check-inline">
                                    <input type="radio" class="custom-control-input" name="is_collar[<?php echo $count; ?>]" id="is_kamiz_collar_<?php echo $count; ?>" value="1" data-count="<?php echo $count; ?>">
                                    <label class="custom-control-label" for="is_kamiz_collar_<?php echo $count; ?>">Collar</label>
                                </div> &nbsp;&nbsp;
                                <div class="custom-control custom-radio form-check-inline">
                                    <input type="radio" class="custom-control-input" name="is_collar[<?php echo $count; ?>]" id="is_half_band_<?php echo $count; ?>" value="2" data-count="<?php echo $count; ?>">
                                    <label class="custom-control-label" for="is_half_band_<?php echo $count; ?>">Half Band</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio form-check-inline">
                                    <input type="radio" class="custom-control-input" name="is_collar[<?php echo $count; ?>]" id="is_full_band_<?php echo $count; ?>" value="3" data-count="<?php echo $count; ?>">
                                    <label class="custom-control-label" for="is_full_band_<?php echo $count; ?>">Full Band</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio form-check-inline">
                                    <input type="radio" class="custom-control-input" name="is_collar[<?php echo $count; ?>]" id="moon_neck_<?php echo $count; ?>" value="4" data-count="<?php echo $count; ?>">
                                    <label class="custom-control-label" for="moon_neck_<?php echo $count; ?>">Moon Neck</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_collar[<?php echo $count; ?>]" id="none_is_collar<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_collar<?php echo $count; ?>">None</label>
                                </div>
                                <div class="input-group collar_text_<?php echo $count; ?>" style="display:none;">
                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="collar_ins[<?php echo $count; ?>]" id="collar_ins_<?php echo $count; ?>" placeholder="Write instructions..."> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $count; ?>]" id="is_round_front_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_round_front_<?php echo $count; ?>">Round Front</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $count; ?>]" id="straight_front_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="straight_front_<?php echo $count; ?>">Straight Front</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $count; ?>]" id="none_is_front<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_front<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_front_pocket[<?php echo $count; ?>]" id="is_front_pocket_<?php echo $count; ?>" value="1" data-count="<?php echo $count; ?>">
                                    <label class="custom-control-label" for="is_front_pocket_<?php echo $count; ?>">Front Pocket</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_front_pocket[<?php echo $count; ?>]" id="none_is_front_pocket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_front_pocket<?php echo $count; ?>">None</label>
                                </div>
                                <div class="input-group front_pocket_text_<?php echo $count; ?>" style="display:none;">
                                    <input type="text" class="form-control" style="margin-right:20px; margin-top:5px;" name="front_pocket_ins[<?php echo $count; ?>]" id="front_pocket_ins_<?php echo $count; ?>" placeholder="Write instructions..."> 
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_shalwar_pocket[<?php echo $count; ?>]" id="is_shalwar_pocket_<?php echo $count; ?>" data-count="<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_shalwar_pocket_<?php echo $count; ?>">Shalwar Pocket</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_shalwar_pocket[<?php echo $count; ?>]" id="none_is_shalwar_pocket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_shalwar_pocket<?php echo $count; ?>">None</label>
                                </div>
                                <div class="input-group shalwar_pocket_text_<?php echo $count; ?>" style="display:none;">
                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="shalwar_pocket_ins[<?php echo $count; ?>]" id="shalwar_pocket_ins_<?php echo $count; ?>" placeholder="Write instructions..."> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_pocket[<?php echo $count; ?>]" id="1side_pocket_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="1side_pocket_<?php echo $count; ?>">1 side pocket</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_pocket[<?php echo $count; ?>]" id="2side_pocket_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="2side_pocket_<?php echo $count; ?>">2 side pocket</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_pocket[<?php echo $count; ?>]" id="none_is_pocket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_pocket<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_sleeve_placket[<?php echo $count; ?>]" id="is_sleeve_placket_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_sleeve_placket_<?php echo $count; ?>">Sleeve Placket Button</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_sleeve_placket[<?php echo $count; ?>]" id="none_is_sleeve_placket<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_sleeve_placket<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $count; ?>]" id="is_plain_button_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_plain_button_<?php echo $count; ?>">Plain Button</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $count; ?>]" id="fancy_button_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="fancy_button_<?php echo $count; ?>">Fancy Button</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $count; ?>]" id="loop_button_<?php echo $count; ?>" value="3">
                                    <label class="custom-control-label" for="loop_button_<?php echo $count; ?>">Loop Button</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $count; ?>]" id="none_is_button<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_button<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $count; ?>]" id="is_button_cuff_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_button_cuff_<?php echo $count; ?>">Button Cuff</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $count; ?>]" id="is_french_cuff_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="is_french_cuff_<?php echo $count; ?>">French Cuff</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $count; ?>]" id="is_open_sleeves_<?php echo $count; ?>" value="3">
                                    <label class="custom-control-label" for="is_open_sleeves_<?php echo $count; ?>">Open Sleeves</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $count; ?>]" id="none_is_cuff<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_cuff<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_design[<?php echo $count; ?>]" id="is_half_design_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_half_design_<?php echo $count; ?>">Half design</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_design[<?php echo $count; ?>]" id="is_full_design_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="is_full_design_<?php echo $count; ?>">Full design</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_design[<?php echo $count; ?>]" id="none_is_design<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_design<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_kanta[<?php echo $count; ?>]" id="is__kanta_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is__kanta_<?php echo $count; ?>">Kanta</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_kanta[<?php echo $count; ?>]" id="is_jali_kanta_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="is_jali_kanta_<?php echo $count; ?>">Jali Kanta</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_kanta[<?php echo $count; ?>]" id="none_is_kanta<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_kanta<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_stitch[<?php echo $count; ?>]" id="is_single_stitch_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_single_stitch_<?php echo $count; ?>">Single stitch</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_stitch[<?php echo $count; ?>]" id="is_double_stitch_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="is_double_stitch_<?php echo $count; ?>">Full double stitch</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_stitch[<?php echo $count; ?>]" id="none_is_stitch<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_stitch<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_thread[<?php echo $count; ?>]" id="is_shin_thread_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_shin_thread_<?php echo $count; ?>">Shining thread</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_thread[<?php echo $count; ?>]" id="none_is_thread<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_thread<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row  mt-1">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_bookrum[<?php echo $count; ?>]" id="is_hard_bookrum_<?php echo $count; ?>" value="1">
                                    <label class="custom-control-label" for="is_hard_bookrum_<?php echo $count; ?>">Hard bookrum</label>
                                </div>&nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_bookrum[<?php echo $count; ?>]" id="is_soft_bookrum_<?php echo $count; ?>" value="2">
                                    <label class="custom-control-label" for="is_soft_bookrum_<?php echo $count; ?>">Soft bookrum</label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_bookrum[<?php echo $count; ?>]" id="none_is_bookrum<?php echo $count; ?>" value="0">
                                    <label class="custom-control-label" for="none_is_bookrum<?php echo $count; ?>">None</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 pl-0 only_shirt"  style="display:none;">
            <h5 class="title text-center">Checks</h5>
            <div class="cus-bor">
                <div class="form-group row  mt-1">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="custom-control custom-radio form-check-inline">
                                <input type="radio" class="custom-control-input" name="is_placket[<?php echo $count; ?>]" id="front_placket_<?php echo $count; ?>" value="1">
                                <label class="custom-control-label" for="front_placket_<?php echo $count; ?>">Front placket</label>
                            </div> &nbsp;&nbsp;
                            <div class="custom-control custom-radio form-check-inline">
                                <input type="radio" class="custom-control-input" name="is_placket[<?php echo $count; ?>]" id="plane_placket_<?php echo $count; ?>" value="2">
                                <label class="custom-control-label" for="plane_placket_<?php echo $count; ?>"> Plain Front</label>
                            </div>
                            &nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="is_placket[<?php echo $count; ?>]" id="none_is_placket<?php echo $count; ?>" value="0">
                                <label class="custom-control-label" for="none_is_placket<?php echo $count; ?>">None</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row  mt-1">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[<?php echo $count; ?>]" id="is_shirt_button_cuff_<?php echo $count; ?>" value="1">
                                <label class="custom-control-label" for="is_shirt_button_cuff_<?php echo $count; ?>">Button Cuff </label>
                            </div> &nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[<?php echo $count; ?>]" id="is_shirt_double_cuff_<?php echo $count; ?>" value="2">
                                <label class="custom-control-label" for="is_shirt_double_cuff_<?php echo $count; ?>">Double Cuff</label>
                            </div>
                            &nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[<?php echo $count; ?>]" id="none_is_shirt_cuff<?php echo $count; ?>" value="0">
                                <label class="custom-control-label" for="none_is_shirt_cuff<?php echo $count; ?>">None</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row  mt-1">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="custom-control custom-radio form-check-inline">
                                <input type="radio" class="custom-control-input" name="is_shirt_collar[<?php echo $count; ?>]" id="is__shirt_collar_<?php echo $count; ?>" data-count="<?php echo $count; ?>" value="1">
                                <label class="custom-control-label" for="is__shirt_collar_<?php echo $count; ?>">Collar</label>
                            </div> &nbsp;&nbsp;
                            <div class="custom-control custom-radio form-check-inline">
                                <input type="radio" class="custom-control-input" name="is_shirt_collar[<?php echo $count; ?>]" id="is_shirt_half_band_<?php echo $count; ?>" data-count="<?php echo $count; ?>" value="2">
                                <label class="custom-control-label" for="is_shirt_half_band_<?php echo $count; ?>">Half Band</label>
                            </div>&nbsp;&nbsp;
                            <div class="custom-control custom-radio form-check-inline">
                                <input type="radio" class="custom-control-input" name="is_shirt_collar[<?php echo $count; ?>]" id="is_shirt_full_band_<?php echo $count; ?>" data-count="<?php echo $count; ?>" value="3">
                                <label class="custom-control-label" for="is_shirt_full_band_<?php echo $count; ?>">Full Band</label>
                            </div>
                            &nbsp;&nbsp;
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="is_shirt_collar[<?php echo $count; ?>]" id="none_is_shirt_collar<?php echo $count; ?>" value="0">
                                <label class="custom-control-label" for="none_is_shirt_collar<?php echo $count; ?>">None</label>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="col-md-12 shirt_collar_text_<?php echo $count; ?>" style="display:none;">
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="tie_collar_<?php echo $count; ?>" value="1">
                            <label class="custom-control-label" for="tie_collar_<?php echo $count; ?>">Tie Collar</label>
                        </div><br>
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="button_down_<?php echo $count; ?>" value="2">
                            <label class="custom-control-label" for="button_down_<?php echo $count; ?>">Button Down</label>
                        </div><br>
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="vintage_clud_<?php echo $count; ?>" value="3">
                            <label class="custom-control-label" for="vintage_clud_<?php echo $count; ?>">Vintage club</label>
                        </div><br>
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="half_french_<?php echo $count; ?>" value="4">
                            <label class="custom-control-label" for="half_french_<?php echo $count; ?>">Half French</label>
                        </div><br>
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="full_french_<?php echo $count; ?>" value="5">
                            <label class="custom-control-label" for="full_french_<?php echo $count; ?>">Full French</label>
                        </div><br>
                        <div class="custom-control custom-radio form-check-inline">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="tuxedo_<?php echo $count; ?>" value="6">
                            <label class="custom-control-label" for="tuxedo_<?php echo $count; ?>">Tuxedo</label>
                        </div> 
                        <br>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $count; ?>]" id="none_is_shirt_collar_type<?php echo $count; ?>" value="0">
                            <label class="custom-control-label" for="none_is_shirt_collar_type<?php echo $count; ?>">None</label>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="shirt_collar_ins[<?php echo $count; ?>]" id="shirt_collar_ins_<?php echo $count; ?>" placeholder="Write instructions..."> 
                        </div>
                    </div>
                </div>                         
            </div>
        </div>
    </div> 
    <div class="row mt-1 coat_waistCoat" style="display: none;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="email" class="col-form-label">Suiting Instructions:</label>
                <textarea class="form-control" name="inst[<?php echo $count; ?>]" rows="7" id="inst"><?php echo $instrucation?></textarea>
                <script>
                    CKEDITOR.replace( 'inst[<?php echo $count; ?>]' );
                </script>
            </div>
        </div>
    </div> 

    <div class="row mt-1 only_shirt" style="display: none;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="email" class="col-form-label">Shirts Instructions:</label>
                <textarea class="form-control" name="shirt_inst[<?php echo $count; ?>]" rows="7" id="shirt_inst"><?php echo $shirt_inst?></textarea>
                <script>
                    CKEDITOR.replace( 'shirt_inst[<?php echo $count; ?>]' );
                </script>
            </div>
        </div>
    </div> 

    <div class="row mt-1 shalwar" style="display: none;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                <textarea class="form-control" name="shalwar_inst[<?php echo $count; ?>]" rows="7" id="shalwar_inst"><?php echo $shalwar_inst?></textarea>
                <script>
                    CKEDITOR.replace( 'shalwar_inst[<?php echo $count; ?>]' );
                </script>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name ="alag1"  value="MYBAD">

<script>
    $(document).ready(function () {
        $("input[name='is_collar[<?php echo $count; ?>]']").change(function () {
            $(".default_row .collar_text").show();
        });

        $("input[name='is_front_pocket[<?php echo $count; ?>]']").change(function () {
            $(".default_row .front_pocket_text").show();
        });

        $("input[name='is_shalwar_pocket[<?php echo $count; ?>]']").change(function () {
            $(".default_row .shalwar_pocket_text").show();
        });

        $("input[name='is_shirt_collar[<?php echo $count; ?>]']").change(function () {
            $(".default_row .shirt_collar_text").show();
        });

        $(document).on('click', 'input[name="is_shirt_collar[<?php echo $count; ?>]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .shirt_collar_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_shalwar_pocket[<?php echo $count; ?>]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .shalwar_pocket_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_front_pocket[<?php echo $count; ?>]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .front_pocket_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_collar[<?php echo $count; ?>]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .collar_text_" + count).show();
        });
    });
</script>
