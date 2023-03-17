<style>
    .modal-content{
        height:1330px;
    }
</style>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Customer</h4>

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
            <button class="btn btn-primary add_new_rows" style="float:right; display:none;" data-count="1">Add Multiple Products &nbsp;&nbsp;<i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
            <form method="post" id="data_form" class="form-horizontal">
                <div class="default_row">
                    <?php
                    $vToken = rand(10, 1000);
                    ?>
                    <input type="hidden" value="<?php echo $vToken; ?>" name="aa_name[0]">
                    <button type="button" id="preview1" class="btn btn-primary" style="display:none;" onclick="previewModal(<?php echo $vToken; ?>, 0)">Preview &nbsp;&nbsp;<i class="fa fa-eye"></i></button>
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="title text-center">Customer Info</h5>
                            <div class="cus-bor cus-height">
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">ORDER/REF NO</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control margin-bottom b_input" name="or_ref_no" id="ref_no" readonly="" value="<?php echo $ref_no ?>">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Booking Date</label>
                                    <div class="col-sm-7">
                                        <input type="text" autocomplete="off" class="form-control required margin-bottom" name="booking_date" id="bDate">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Trial Date</label>
                                    <div class="col-sm-7">
                                        <input type="text" autocomplete="off" class="form-control required margin-bottom b_input" name="t_date" id="tDate">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Delivery Date</label>
                                    <div class="col-sm-7">
                                        <input type="text" autocomplete="off" class="form-control required margin-bottom b_input" name="d_date" id="dDate">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Customer Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control required margin-bottom b_input" name="customer_name" id="customer_name">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label"
                                           for="name">Mobile</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control required margin-bottom b_input" name="mobile" id="mobile">
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Select Product:</label>
                                    <div class="col-md-7 select_product">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_suiting[0]" id="suiting" value="suiting">
                                                <label class="custom-control-label" for="suiting">Suiting</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_shirts[0]" id="shirts" value="shirts">
                                                <label class="custom-control-label" for="shirts">Shirt</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_shalwarqameez[0]" id="shalwarqameez" value="shalwarqameez">
                                                <label class="custom-control-label" for="shalwarqameez"> Shalwar Kamiz</label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Select Language:</label>
                                    <div class="col-md-7 select_product">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_english" id="english" value="english">
                                                <label class="custom-control-label" for="english">English</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_urdu" id="urdu" value="urdu">
                                                <label class="custom-control-label" for="urdu">Urdu</label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Cutter Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control required margin-bottom b_input" name="cutter_name" id="cutter_name">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Karigar Name</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control required margin-bottom b_input" name="karigar_name" id="karigar_name">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Quantity</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control required margin-bottom b_input" name="quantity" id="quantity">
                                    </div>
                                </div>
                                <!-- <div class="form-group row mt-1">
                                   <label class="col-sm-4 col-form-label" for="name"><strong>TOTAL</strong></label>
                                   <div class="col-sm-7">
                                       <input type="text" class="form-control required margin-bottom b_input cal_blanc" name="total" id="total" onfocusout="cal_blace()">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                   <label class="col-sm-4 col-form-label"for="name"><strong>ADVANCE</strong></label>
                                   <div class="col-sm-7">
                                       <input type="text" class="form-control required margin-bottom b_input cal_blanc" name="advance" id="adv" onfocusout="cal_blace()">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                   <label class="col-sm-4 col-form-label" for="name"><strong>BALANCE</strong></label>
                                   <div class="col-sm-7">
                                       <input type="text" class="form-control margin-bottom b_input" name="BLANCE" id="blance" readonly="">
                                   </div>
                               </div> -->
                            </div> 
                        </div>
                        <div class="col-md-4 pl-0 coat_waistCoat" style="display:none;">
                            <h5 class="title text-center">COAT / WAIST COAT</h5>
                            <div class="cus-bor cus-height" style="height: 1130px;">
                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Neck</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="cNeck[0]" id="cNeck">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Chest</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cChest[0]" id="cChest">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Belly Waist</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cWaist[0]" id="cWaist">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Hip</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cHips[0]" id="cHips">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Shoulder</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cShoulder[0]" id="cShoulder">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Sleeves Length</label>
                                    <div class="col-sm-4">
                                        <input type="hidden" name ="cSleeve_form[0]" value="<?php echo $vToken; ?>">
                                        <input type="text" class="form-control margin-bottom b_input" name="cSleeve[0]" id="cSleev">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Bicep</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="cBicep[0]" id="cBicep">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Forearm</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="cForearm[0]" id="cForearm">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Half Back</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cHalfBack[0]" id="cHalfBack">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Cross Back</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="cCrossBack[0]" id="cCrossBack">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Coat length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="cLength[0]" id="cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">3p waistcoat Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="3p_waistcoat_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Waistcoat Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="waistcoat_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Princecoat Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="princecoat_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Sherwani Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="sherwani_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Long coat length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="longcoat_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Chester length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="chester_length[0]" id="Sec_cLength">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-4 col-form-label" for="name">Armhole</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input" name="armhole[0]" id="Sec_cLength">
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
                                        <input type="text" class="form-control margin-bottom b_input " name="pWaist[0]" id="pWaist">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pHip[0]" id="pHip">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Thigh</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pThigh[0]" id="pThigh">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Knee</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pKnee[0]" id="pKnee">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Inseam / Inside Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pInLength[0]" id="pInLength">
                                    </div>
                                </div> 


                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Length</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pLength[0]" id="pLength">
                                    </div>
                                </div>                                                     

                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Bottom</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control margin-bottom b_input " name="pBottom[0]" id="pBottom">
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
                                                    <input type="radio" class="custom-control-input" name="is_breasted[0]" id="breasted" value="1">
                                                    <label class="custom-control-label" for="breasted">Single breasted</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_breasted[0]" id="double_breasted" value="2">
                                                    <label class="custom-control-label" for="double_breasted">Double breasted</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_breasted[0]" id="none_breasted" value="0">
                                                    <label class="custom-control-label" for="none_breasted">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button_suit[0]" id="button_suit" value="1">
                                                    <label class="custom-control-label" for="button_suit">One button</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button_suit[0]" id="two_button_suit" value="2">
                                                    <label class="custom-control-label" for="two_button_suit">Two button</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button_suit[0]" id="none_button_suit" value="0">
                                                    <label class="custom-control-label" for="none_button_suit">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lapel[0]" id="lapel" value="1">
                                                    <label class="custom-control-label" for="lapel">Notch lapel</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lapel[0]" id="peak_lapel" value="2">
                                                    <label class="custom-control-label" for="peak_lapel">Peak lapel</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lapel[0]" id="shawl_lapel" value="3">
                                                    <label class="custom-control-label" for="shawl_lapel">Shawl lapel</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lapel[0]" id="none_lapel" value="0">
                                                    <label class="custom-control-label" for="none_lapel">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_vent[0]" id="vent" value="1">
                                                    <label class="custom-control-label" for="vent">Single vent</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_vent[0]" id="double_vent" value="2">
                                                    <label class="custom-control-label" for="double_vent">Double vents</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_vent[0]" id="no_vent" value="3">
                                                    <label class="custom-control-label" for="no_vent">No vent</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_vent[0]" id="none_vent" value="0">
                                                    <label class="custom-control-label" for="none_vent">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_wear[0]" id="wear" value="1">
                                                    <label class="custom-control-label" for="wear">Formal suit</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_wear[0]" id="casual_wear" value="2">
                                                    <label class="custom-control-label" for="casual_wear"> Casual suit </label>
                                                </div> &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_wear[0]" id="groom_wear" value="3">
                                                    <label class="custom-control-label" for="groom_wear">Grooms wear </label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_wear[0]" id="none_groom_wear" value="0">
                                                    <label class="custom-control-label" for="none_groom_wear">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lined[0]" id="lined" value="1">
                                                    <label class="custom-control-label" for="lined">Fully lined </label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lined[0]" id="half_lined" value="2">
                                                    <label class="custom-control-label" for="half_lined">Half lined</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_lined[0]" id="none_lined" value="0">
                                                    <label class="custom-control-label" for="none_lined">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_ticket[0]" id="ticket" value="1">
                                                    <label class="custom-control-label" for="ticket">Ticket pocket </label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_ticket[0]" id="none_ticket" value="0">
                                                    <label class="custom-control-label" for="none_ticket">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[0]" id="regular" value="1">
                                                    <label class="custom-control-label" for="regular">Regular pockets</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[0]" id="slant" value="2">
                                                    <label class="custom-control-label" for="slant">Slant pocket </label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[0]" id="none_slant" value="0">
                                                    <label class="custom-control-label" for="none_slant">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_button[0]" id="metalic_button" value="1">
                                                    <label class="custom-control-label" for="metalic_button">Metallic buttons </label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_button[0]" id="button" value="2">
                                                    <label class="custom-control-label" for="button">Plain buttons</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_suit_button[0]" id="none_slant" value="0">
                                                    <label class="custom-control-label" for="none_slant">None</label>
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
                                            <input type="hidden" name ="shirtLength_form[0]" value="<?php echo $vToken; ?>">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtLength[0]" id="kmzLength">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder[0]" id="kmzShoulder">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtSleeves[0]" id="kmzSleeves">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtNeck[0]" id="kmzNeck">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtChest[0]" id="kmzChest">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtWaist[0]" id="kmzWaist">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="shirtHips[0]" id="kmzHips">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="shirtBicep[0]" id="kmzBicep">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Forearm</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="shirtForearm[0]" id="kmzForearm">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="shirtarmhole[0]" id="kmzForearm">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="shirtcuff[0]" id="kmzForearm">
                                        </div>
                                    </div>
                                </div>
                                <div class="shalwar">
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Kameez Length</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name ="kmzLength_form[0]" value="<?php echo $vToken; ?>">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzLength[0]" id="kmzLength">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Kurta Length</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kurtaLength[0]" id="kmzLength">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzShoulder[0]" id="kmzShoulder">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzSleeves[0]" id="kmzSleeves">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzNeck[0]" id="kmzNeck">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzChest[0]" id="kmzChest">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzWaist[0]" id="kmzWaist">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input " name="kmzHips[0]" id="kmzHips">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="kmzBicep[0]" id="kmzBicep">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label"  for="name">Forearm</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="kmzForearm[0]" id="kmzForearm">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="kmzarmhole[0]" id="kmzForearm">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control margin-bottom b_input" name="kmzcuff[0]" id="kmzForearm">
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
                                               class="form-control margin-bottom b_input " name="shlLength[0]"
                                               id="shlLength">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label"
                                           for="name">Shalwar Bottom</label>

                                    <div class="col-sm-6">
                                        <input type="text"
                                               class="form-control margin-bottom b_input " name="shlBottom[0]"
                                               id="shlBottom">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label"
                                           for="name">Asan Tyar</label>

                                    <div class="col-sm-6">
                                        <input type="text"
                                               class="form-control margin-bottom b_input " name="shlAsanTyar[0]"
                                               id="shlAsanTyar">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label"
                                           for="name">Shalwar Gaira Tyar</label>

                                    <div class="col-sm-6">
                                        <input type="text"
                                               class="form-control margin-bottom b_input " name="shlGairaTyar[0]"
                                               id="shlGairaTyar">
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Pajama Length</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-bottom b_input " name="pjamaLength[0]" id="shlLength">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Pajama Bottom</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control margin-bottom b_input " name="pjamaBottom[0]" id="shlBottom">
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
                                                    <input type="radio" class="custom-control-input" name="is_collar[0]" id="is_kamiz_collar" value="1">
                                                    <label class="custom-control-label" for="is_kamiz_collar">Collar</label>
                                                </div> &nbsp;&nbsp;
                                                <div class="custom-control custom-radio form-check-inline">
                                                    <input type="radio" class="custom-control-input" name="is_collar[0]" id="is_half_band" value="2">
                                                    <label class="custom-control-label" for="is_half_band">Half Band</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio form-check-inline">
                                                    <input type="radio" class="custom-control-input" name="is_collar[0]" id="is_full_band" value="3">
                                                    <label class="custom-control-label" for="is_full_band">Full Band</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio form-check-inline">
                                                    <input type="radio" class="custom-control-input" name="is_collar[0]" id="moon_neck" value="4">
                                                    <label class="custom-control-label" for="moon_neck">Moon Neck</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_collar[0]" id="none_neck" value="0">
                                                    <label class="custom-control-label" for="none_neck">None</label>
                                                </div>
                                                <div class="input-group collar_text" style="display:none;">
                                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="collar_ins[0]" id="collar_ins" placeholder="Write instructions..."> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_front[0]" id="is_round_front" value="1">
                                                    <label class="custom-control-label" for="is_round_front">Round Front</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_front[0]" id="straight_front" value="2">
                                                    <label class="custom-control-label" for="straight_front">Straight Front</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_front[0]" id="none_front" value="0">
                                                    <label class="custom-control-label" for="none_front">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_front_pocket[0]" id="is_front_pocket" value="1">
                                                    <label class="custom-control-label" for="is_front_pocket">Front Pocket</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_front_pocket[0]" id="none_front_pocket" value="0">
                                                    <label class="custom-control-label" for="none_front_pocket">None</label>
                                                </div>
                                                <div class="input-group front_pocket_text" style="display:none;">
                                                    <input type="text" class="form-control" style="margin-right:20px; margin-top:5px;" name="front_pocket_ins[0]" id="front_pocket_ins" placeholder="Write instructions..."> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_shalwar_pocket[0]" id="is_shalwar_pocket" value="1">
                                                    <label class="custom-control-label" for="is_shalwar_pocket">Shalwar Pocket</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_shalwar_pocket[0]" id="none_shalwar_pocket" value="0">
                                                    <label class="custom-control-label" for="none_shalwar_pocket">None</label>
                                                </div>
                                                <div class="input-group shalwar_pocket_text" style="display:none;">
                                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="shalwar_pocket_ins[0]" id="shalwar_pocket_ins" placeholder="Write instructions..."> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_pocket[0]" id="1side_pocket" value="1">
                                                    <label class="custom-control-label" for="1side_pocket">1 side pocket</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_pocket[0]" id="2side_pocket" value="2">
                                                    <label class="custom-control-label" for="2side_pocket">2 side pocket</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_pocket[0]" id="none_side_pocket" value="0">
                                                    <label class="custom-control-label" for="none_side_pocket">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_sleeve_placket[0]" id="is_sleeve_placket" value="1">
                                                    <label class="custom-control-label" for="is_sleeve_placket">Sleeve Placket Button</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_sleeve_placket[0]" id="none_sleeve_placket" value="0">
                                                    <label class="custom-control-label" for="none_sleeve_placket">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button[0]" id="is_plain_button" value="1">
                                                    <label class="custom-control-label" for="is_plain_button">Plain Button</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button[0]" id="fancy_button" value="2">
                                                    <label class="custom-control-label" for="fancy_button">Fancy Button</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button[0]" id="loop_button" value="3">
                                                    <label class="custom-control-label" for="loop_button">Loop Button</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_button[0]" id="none_loop_button" value="0">
                                                    <label class="custom-control-label" for="none_loop_button">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_cuff[0]" id="is_button_cuff" value="1">
                                                    <label class="custom-control-label" for="is_button_cuff">Button Cuff</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_cuff[0]" id="is_french_cuff" value="2">
                                                    <label class="custom-control-label" for="is_french_cuff">French Cuff</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_cuff[0]" id="is_open_sleeves" value="3">
                                                    <label class="custom-control-label" for="is_open_sleeves">Open Sleeves</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_cuff[0]" id="none_open_sleeves" value="0">
                                                    <label class="custom-control-label" for="none_open_sleeves">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_design[0]" id="is_half_design" value="1">
                                                    <label class="custom-control-label" for="is_half_design">Half design</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_design[0]" id="is_full_design" value="2">
                                                    <label class="custom-control-label" for="is_full_design">Full design</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_design[0]" id="none_is_design" value="0">
                                                    <label class="custom-control-label" for="none_is_design">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_kanta[0]" id="is__kanta" value="1">
                                                    <label class="custom-control-label" for="is__kanta">Kanta</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_kanta[0]" id="is_jali_kanta" value="2">
                                                    <label class="custom-control-label" for="is_jali_kanta">Jali Kanta</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_kanta[0]" id="none_is_kanta" value="0">
                                                    <label class="custom-control-label" for="none_is_kanta">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_stitch[0]" id="is_single_stitch" value="1">
                                                    <label class="custom-control-label" for="is_single_stitch">Single stitch</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_stitch[0]" id="is_double_stitch" value="2">
                                                    <label class="custom-control-label" for="is_double_stitch">Full double stitch</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_stitch[0]" id="none_is_stitch" value="0">
                                                    <label class="custom-control-label" for="none_is_stitch">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_thread[0]" id="is_shin_thread" value="1">
                                                    <label class="custom-control-label" for="is_shin_thread">Shining thread</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_thread[0]" id="none_is_thread" value="0">
                                                    <label class="custom-control-label" for="none_is_thread">None</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row  mt-1">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_bookrum[0]" id="is_hard_bookrum" value="1">
                                                    <label class="custom-control-label" for="is_hard_bookrum">Hard bookrum</label>
                                                </div>&nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_bookrum[0]" id="is_soft_bookrum" value="2">
                                                    <label class="custom-control-label" for="is_soft_bookrum">Soft bookrum</label>
                                                </div>
                                                &nbsp;&nbsp;
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="is_bookrum[0]" id="none_is_bookrum" value="0">
                                                    <label class="custom-control-label" for="none_is_bookrum">None</label>
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
                                                <input type="radio" class="custom-control-input" name="is_placket[0]" id="front_placket" value="1">
                                                <label class="custom-control-label" for="front_placket">Front placket</label>
                                            </div> &nbsp;&nbsp;
                                            <div class="custom-control custom-radio form-check-inline">
                                                <input type="radio" class="custom-control-input" name="is_placket[0]" id="plane_placket" value="2">
                                                <label class="custom-control-label" for="plane_placket"> Plain Front</label>
                                            </div>
                                            &nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="is_placket[0]" id="none_is_placket" value="0">
                                                <label class="custom-control-label" for="none_is_placket">None</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[0]" id="is_shirt_button_cuff" value="1">
                                                <label class="custom-control-label" for="is_shirt_button_cuff">Button Cuff </label>
                                            </div> &nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[0]" id="is_shirt_double_cuff" value="2">
                                                <label class="custom-control-label" for="is_shirt_double_cuff">Double Cuff</label>
                                            </div>
                                            &nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[0]" id="none_is_shirt_cuff" value="0">
                                                <label class="custom-control-label" for="none_is_shirt_cuff">None</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-radio form-check-inline">
                                                <input type="radio" class="custom-control-input" name="is_shirt_collar[0]" id="is__shirt_collar" value="1">
                                                <label class="custom-control-label" for="is__shirt_collar">Collar</label>
                                            </div> &nbsp;&nbsp;
                                            <div class="custom-control custom-radio form-check-inline">
                                                <input type="radio" class="custom-control-input" name="is_shirt_collar[0]" id="is_shirt_half_band" value="2">
                                                <label class="custom-control-label" for="is_shirt_half_band">Half Band</label>
                                            </div>&nbsp;&nbsp;
                                            <div class="custom-control custom-radio form-check-inline">
                                                <input type="radio" class="custom-control-input" name="is_shirt_collar[0]" id="is_shirt_full_band" value="3">
                                                <label class="custom-control-label" for="is_shirt_full_band">Full Band</label>
                                            </div>
                                            &nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="is_shirt_collar[0]" id="none_is_shirt_collar" value="0">
                                                <label class="custom-control-label" for="none_is_shirt_collar">None</label>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-12 shirt_collar_text" style="display:none;">
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="tie_collar" value="1">
                                            <label class="custom-control-label" for="tie_collar">Tie Collar</label>
                                        </div><br>
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="button_down" value="2">
                                            <label class="custom-control-label" for="button_down">Button Down</label>
                                        </div><br>
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="vintage_clud" value="3">
                                            <label class="custom-control-label" for="vintage_clud">Vintage club</label>
                                        </div><br>
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="half_french" value="4">
                                            <label class="custom-control-label" for="half_french">Half French</label>
                                        </div><br>
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="full_french" value="5">
                                            <label class="custom-control-label" for="full_french">Full French</label>
                                        </div><br>
                                        <div class="custom-control custom-radio form-check-inline">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="tuxedo" value="6">
                                            <label class="custom-control-label" for="tuxedo">Tuxedo</label>
                                        </div>  
                                        <br>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[0]" id="none_is_shirt_collar_type" value="0">
                                            <label class="custom-control-label" for="none_is_shirt_collar_type">None</label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="shirt_collar_ins[0]" id="shirt_collar_ins" placeholder="Write instructions..."> 
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
                                <textarea class="form-control" name="inst[0]" rows="7" id="inst"></textarea>
                                <script>
                                    CKEDITOR.replace( 'inst[0]' );
                                </script>
                            </div>
                        </div>
                    </div> 

                    <div class="row mt-1 only_shirt" style="display: none;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Shirts Instructions:</label>
                                <textarea class="form-control" name="shirt_inst[0]" rows="7" id="shirt_inst"></textarea>
                                <script>
                                    CKEDITOR.replace( 'shirt_inst[0]' );
                                </script>
                            </div>
                        </div>
                    </div> 

                    <div class="row mt-1 shalwar" style="display: none;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                                <textarea class="form-control" name="shalwar_inst[0]" rows="7" id="shalwar_inst"></textarea>
                                <script>
                                    CKEDITOR.replace( 'shalwar_inst[0]' );
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" id="product_stack" name="product_stack">
                <input type="hidden" value="" id="product_stack_list" name="product_stack_list">
                <div class="append_new_size_article"></div>
                <div id="mybutton" class="mt-1">
                    <input type="submit" id="submit-data"
                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                           value="<?php echo $this->lang->line('Add customer') ?>"
                           data-loading-text="Adding...">
                </div>
                <input type="hidden" value="customers/colthingCustomer" id="action-url">
            </form>
        </div>
    </div>
</div>

<div id="pre_preview_model" class="modal fade ">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Preview</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <center><form>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" value="0" onclick="changeLamguage()" name="is_english" id="customRadio1" checked>
                            <label class="form-check-label" for="customRadio1">Urdu</label>
                        </div>
                        <div class="form-check form-check-inline ms-4">
                            <input type="radio" class="form-check-input" value="1" onclick="changeLamguage()" name="is_english" id="customRadio2">
                            <label class="form-check-label" for="customRadio2">English</label>
                        </div>
                    </form></center>
                <hr>
                <div id="preview_body"></div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="lang_index" value="">
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // function cal_blace(){
    //   var total = $("#total").val();
    //   var adv = $("#adv").val();

    //   $("#blance").val(total - adv);
    // }


    $("#bDate").datepicker();
    $("#tDate").datepicker();
    $("#dDate").datepicker();

    $(document).ready(function () {
        $('input[type="checkbox"]').click(function () {
            if ($(this).is(":checked") && $(this).val() == 'suiting') {
                $('.default_row #shirts').prop('checked', false);
                $('.default_row #shalwarqameez').prop('checked', false);

                $(".default_row .coat_waistCoat").show();
                $(".default_row .pant").show();
                $(".default_row .shirt_qameez").hide();
                $(".default_row .shalwar").hide();
                $(".default_row .only_shirt").hide();
                $("#product_stack").val(1);
                $("#product_stack_list").val(function () {
                    return this.value + '1';
                });
            } else if ($(this).is(":checked") && $(this).val() == 'shirts') {

                $('.default_row #suiting').prop('checked', false);
                $('.default_row #shalwarqameez').prop('checked', false);

                $(".default_row .coat_waistCoat").hide();
                $(".default_row .pant").hide();
                $(".default_row .shirt_qameez").show();
                $(".default_row .only_shirt").show();
                $(".default_row .shalwar").hide();
                $("#product_stack").val(2);
                $("#product_stack_list").val(function () {
                    return this.value + '2';
                });
            } else if ($(this).is(":checked") && $(this).val() == 'shalwarqameez') {

                $('.default_row #shirts').prop('checked', false);
                $('.default_row #suiting').prop('checked', false);

                $(".default_row .coat_waistCoat").hide();
                $(".default_row .pant").hide();
                $(".default_row .only_shirt").hide();
                $(".default_row .shirt_qameez").show();
                $(".default_row .shalwar").show();
                $("#product_stack").val(3);
                $("#product_stack_list").val(function () {
                    return this.value + '3';
                });
            }
            if ($(this).is(":checked") && $(this).val() == 'english') {
                $('#urdu').prop('checked', false);
            } else if ($(this).is(":checked") && $(this).val() == 'urdu') {
                $('#english').prop('checked', false);
            }

            $('.add_new_rows').show();
            $('#preview1').show();

        });

        $("input[name='is_collar[0]']").change(function () {
            $(".default_row .collar_text").show();
        });

        $("input[name='is_front_pocket[0]']").change(function () {
            $(".default_row .front_pocket_text").show();
        });

        $("input[name='is_shalwar_pocket[0]']").change(function () {
            $(".default_row .shalwar_pocket_text").show();
        });

        $("input[name='is_shirt_collar[0]']").change(function () {
            $(".default_row .shirt_collar_text").show();
        });

        $(document).on('click', 'input[name="is_shirt_collar[0]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .shirt_collar_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_shalwar_pocket[0]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .shalwar_pocket_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_front_pocket[0]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .front_pocket_text_" + count).show();
        });

        $(document).on('click', 'input[name="is_collar[0]"]', function () {
            var count = $(this).attr('data-count');
            $(".append_row_for_article_" + count + " .collar_text_" + count).show();
        });

        $('.add_new_rows').click(function () {
            var count = $(this).attr('data-count');
            count = count == 0 ? 1 : count;
            var form = $("#data_form");
            $(this).attr('data-count', parseInt(count) + 1);
            $.ajax({
                url: "<?php echo base_url('customers/new_articles_append') ?>",
                type: "POST",
                data: form.serialize() + '&count=' + count + '&' + crsf_token + '=' + crsf_hash,
                dataType: "html",
                success: function (data) {
                    $(".append_new_size_article").append(data);
                }
            });
        });

        $(document).on('click', '.remove_new_rows', function () {
            var count = $(this).attr('data-count');
            count = count == 0 ? 1 : count;
            $('.append_row_for_article_' + count).remove();
            $('.add_new_rows').attr('data-count', parseInt(count) - 1);
        });

        $(document).on('click', '.Spro', function () {
            var val = $(this).val();
            var counter = $(this).attr('data-counter');
            if ($(this).is(":checked") && $(this).val() == 'suiting') {
                $('.append_row_for_article_' + counter + ' #shirts_' + counter).prop('checked', false);
                $('.append_row_for_article_' + counter + ' #shalwarqameez_' + counter).prop('checked', false);

                $(".append_row_for_article_" + counter + " .coat_waistCoat").show();
                $(".append_row_for_article_" + counter + " .pant").show();
                $(".append_row_for_article_" + counter + " .shirt_qameez").hide();
                $(".append_row_for_article_" + counter + " .shalwar").hide();
                $(".append_row_for_article_" + counter + " .only_shirt").hide();
                $("#product_stack").val(1);
                $("#product_stack_list").val(function () {
                    return this.value + '1';
                });
            } else if ($(this).is(":checked") && $(this).val() == 'shirts') {

                $('.append_row_for_article_' + counter + ' #suiting_' + counter).prop('checked', false);
                $('.append_row_for_article_' + counter + ' #shalwarqameez_' + counter).prop('checked', false);

                $(".append_row_for_article_" + counter + " .coat_waistCoat").hide();
                $(".append_row_for_article_" + counter + " .pant").hide();
                $(".append_row_for_article_" + counter + " .shirt_qameez").show();
                $(".append_row_for_article_" + counter + " .only_shirt").show();
                $(".append_row_for_article_" + counter + " .shalwar").hide();
                $("#product_stack").val(2);
                $("#product_stack_list").val(function () {
                    return this.value + '2';
                });
            } else if ($(this).is(":checked") && $(this).val() == 'shalwarqameez') {

                $('.append_row_for_article_' + counter + ' #shirts_' + counter).prop('checked', false);
                $('.append_row_for_article_' + counter + ' #suiting_' + counter).prop('checked', false);

                $(".append_row_for_article_" + counter + " .coat_waistCoat").hide();
                $(".append_row_for_article_" + counter + " .pant").hide();
                $(".append_row_for_article_" + counter + " .only_shirt").hide();
                $(".append_row_for_article_" + counter + " .shirt_qameez").show();
                $(".append_row_for_article_" + counter + " .shalwar").show();
                $("#product_stack").val(3);
                $("#product_stack_list").val(function () {
                    return this.value + '3';
                });
            }
        });






    });

    function  changeLamguage() {
        var is_english = $('input[name="is_english"]:checked').val();
        var index = $('#lang_index').val();
        var form = $("#data_form");
        console.log(form.serialize());
        $.ajax({
            url: "<?php echo base_url('customers/preview') ?>",
            type: "POST",
            data: form.serialize() + '&' + crsf_token + '=' + crsf_hash + '&ignore_pdf=1&is_english=' + is_english + '&index=' + index,
            dataType: "html",
            success: function (data) {
                $('#preview_body').empty().html(data)
            }
        });
    }
    function previewModal(index, cur_counter) {
        $("#lang_index").val(index);
        CKEDITOR.instances.inst.updateElement();
        CKEDITOR.instances.shirt_inst.updateElement();
        CKEDITOR.instances.shalwar_inst.updateElement();
        var form = $("#data_form");
        console.log(form.serialize());
        $.ajax({
            url: "<?php echo base_url('customers/preview') ?>",
            type: "POST",
            data: form.serialize() + '&' + crsf_token + '=' + crsf_hash + '&ignore_pdf=1&index=' + index + '&cur_counter=' + cur_counter,
            dataType: "html",
            success: function (data) {
                $('#preview_body').empty().html(data)
                $('#pre_preview_model').modal('show');

            }
        });
    }


</script>

