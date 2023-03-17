<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<style>
    .modal-body{
        max-height: 100vh;
        overflow-y: auto;
    }
    
</style>
<div class="content-body">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Customer</h4>

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>

            <button class="btn btn-primary add_new_rows" style="float:right;" data-count="<?php echo count($customer); ?>">Add Multiple Products &nbsp;&nbsp;<i class="fa fa-plus"></i></button>
        </div>

        <div class="card-body">
            <form method="post" id="data_form" class="form-horizontal">
                <?php
                foreach ($customer as $thisIndex => $thiscustomer) {
                    $counter = $thisIndex;
                    $vToken = rand(10, 1000);
                    ?>
                    <div class="card">
                        <input type="hidden" value="<?php echo $vToken; ?>" name="aa_name[<?php echo $counter; ?>]">
                        <div class="card-body">
                            <div class="default_row">
                                <?php if ($thisIndex) { ?>
                                    <div class="append_row_article append_row_for_article_<?php echo $counter; ?>" data-appendNewSize="<?php echo $counter; ?>"><hr> 
                                        <button type="button"  class="btn btn-primary" onclick="previewModal(<?php echo $vToken; ?>,<?php echo $counter; ?>)">Preview &nbsp;&nbsp;<i class="fa fa-eye"></i></button>
                                        &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger remove_new_rows" style="float:right;" data-count="<?php echo $counter; ?>">Remove Multiple &nbsp;&nbsp;<i class="fa fa-times"></i></button><br><br>
                                    <?php }if ($thisIndex == 0) { ?> 
                                        <button type="button" class="btn btn-primary" onclick="previewModal(<?php echo $vToken; ?>,<?php echo $counter; ?>)">Preview &nbsp;&nbsp;<i class="fa fa-eye"></i></button>

                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="title text-center">Customer Info</h5>
                                            <div class="cus-bor cus-height">
                                                <?php if ($thisIndex == 0) { ?>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label" for="name">ORDER/REF NO</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control margin-bottom b_input" name="or_ref_no" id="ref_no" readonly="" value="<?php echo $thiscustomer['reference_id'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label" for="name">Booking Date</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" autocomplete="off" class="form-control required margin-bottom" name="booking_date" value="<?php echo $thiscustomer['booking_date'] ?>" id="bDate">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label" for="name">Trial Date</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" autocomplete="off"  class="form-control required margin-bottom b_input" name="t_date" value="<?php echo $thiscustomer['trial_date'] ?>" id="tDate">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label" for="name">Delivery Date</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" autocomplete="off" class="form-control required margin-bottom b_input" name="d_date" value="<?php echo $thiscustomer['d_date'] ?>" id="dDate">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label" for="name">Customer Name</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control required margin-bottom b_input" name="customer_name" value="<?php echo $thiscustomer['name'] ?>" id="customer_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-4 col-form-label"
                                                               for="name">Mobile</label>

                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control required margin-bottom b_input" name="mobile" value="<?php echo $thiscustomer['phone'] ?>" id="mobile">
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="form-group row  mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Select Product:</label>
                                                    <div class="col-md-7 select_product">
                                                        <div class="input-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-counter="' . $thisIndex . '"'; ?>  name="is_suiting[<?php echo $thisIndex; ?>]" id="suiting<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="suiting" <?php echo ($thiscustomer['is_suiting']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="suiting<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Suiting</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-counter="' . $thisIndex . '"'; ?> name="is_shirts[<?php echo $thisIndex; ?>]" id="shirts<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="shirts" <?php echo ($thiscustomer['is_shirts']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="shirts<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Shirt</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-counter="' . $thisIndex . '"'; ?> name="is_shalwarqameez[<?php echo $thisIndex; ?>]" id="shalwarqameez<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="shalwarqameez" <?php echo ($thiscustomer['is_shalwarqameez']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="shalwarqameez<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>"> Shalwar Kamiz</label>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Cutter Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control required margin-bottom b_input" name="cutter_name" id="cutter_name" value="<?php echo $thiscustomer['cutter_name'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Karigar Name</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control required margin-bottom b_input" name="karigar_name" id="karigar_name" value="<?php echo $thiscustomer['karigar_name'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Quantity</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" class="form-control required margin-bottom b_input" name="quantity" id="quantity" value="<?php echo $thiscustomer['quantity'] ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row  mt-1">
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
                                        <div class="col-md-4 pl-0 coat_waistCoat" <?php echo ($thiscustomer['is_suiting'] == 1) ? '' : 'style="display:none;"' ?> >
                                            <h5 class="title text-center">COAT / WAIST COAT</h5>
                                            <div class="cus-bor cus-height" style="height: 1130px;">
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Neck</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="cNeck[<?php echo $thisIndex; ?>]" id="cNeck<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_neck'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Chest</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cChest[<?php echo $thisIndex; ?>]" id="cChest<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_chest'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Belly Waist</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cWaist[<?php echo $thisIndex; ?>]" id="cWaist<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_waist'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Hip</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cHips[<?php echo $thisIndex; ?>]" id="cHips<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_hip'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Shoulder</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cShoulder[<?php echo $thisIndex; ?>]" id="cShoulder<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_shoulder'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Sleeves Length</label>
                                                    <div class="col-sm-4">

                                                        <input type="hidden" name ="cSleeve_form[<?php echo $thisIndex; ?>]" value="<?php echo $vToken; ?>">
                                                        <input type="text" class="form-control margin-bottom b_input" name="cSleeve[<?php echo $thisIndex; ?>]" id="cSleev<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Bicep</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="cBicep[<?php echo $thisIndex; ?>]" id="cBicep<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_bicep'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Forearm</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="cForearm[<?php echo $thisIndex; ?>]" id="cForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_forearm'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Half Back</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cHalfBack[<?php echo $thisIndex; ?>]" id="cHalfBack<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_half_back'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Cross Back</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="cCrossBack[<?php echo $thisIndex; ?>]" id="cCrossBack<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_cross_back'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Coat length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="cLength[<?php echo $thisIndex; ?>]" id="cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['coat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">3p waistcoat Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="3p_waistcoat_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['p3_waistcoat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Waistcoat Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="waistcoat_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['waistcoat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Princecoat Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="princecoat_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['princecoat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Sherwani Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="sherwani_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['sherwani_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Long coat length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="longcoat_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['longcoat_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Chester length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="chester_length[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['chester_length'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-4 col-form-label" for="name">Armhole</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input" name="armhole[<?php echo $thisIndex; ?>]" id="Sec_cLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['armhole'] ?>">
                                                    </div>
                                                </div>                            

                                            </div>   
                                        </div>
                                        <div class="col-md-4 pl-0 pant"  <?php echo ($thiscustomer['is_suiting'] == 1) ? '' : 'style="display:none;"' ?>>
                                            <h5 class="title text-center">PANT</h5>
                                            <div class="cus-bor cus-height" style="height: 455px;">

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Waist</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pWaist[<?php echo $thisIndex; ?>]" id="pWaist<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_waist'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pHip[<?php echo $thisIndex; ?>]" id="pHip<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_hip'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Thigh</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pThigh[<?php echo $thisIndex; ?>]" id="pThigh<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_thigh'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Knee</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pKnee[<?php echo $thisIndex; ?>]" id="pKnee<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_knee'] ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Inseam / Inside Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pInLength[<?php echo $thisIndex; ?>]" id="pInLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_inside_length'] ?>">
                                                    </div>
                                                </div> 


                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Length</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pLength[<?php echo $thisIndex; ?>]" id="pLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_length'] ?>">
                                                    </div>
                                                </div>                                                     

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Bottom</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pBottom[<?php echo $thisIndex; ?>]" id="pBottom<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pant_bottom'] ?>">
                                                    </div>
                                                </div>                           
                                            </div>

                                            <div class="pant"  <?php echo ($thiscustomer['is_suiting'] == 1) ? '' : 'style="display:none;"' ?>>
                                                <h5 class="title text-center">Checks</h5>
                                                <div class="cus-bor cus-height" style="height: 400px;">
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $thisIndex; ?>]" id="breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_breasted'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Single breasted</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $thisIndex; ?>]" id="double_breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_breasted'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="double_breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Double breasted</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_breasted[<?php echo $thisIndex; ?>]" id="none_is_breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_breasted'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_breasted<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $thisIndex; ?>]" id="button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1"  <?php echo ($thiscustomer['is_button_suit'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">One button</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $thisIndex; ?>]" id="two_button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2"  <?php echo ($thiscustomer['is_button_suit'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="two_button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Two button</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button_suit[<?php echo $thisIndex; ?>]" id="none_is_button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_button_suit'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_button_suit<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $thisIndex; ?>]" id="lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_lapel'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Notch lapel</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $thisIndex; ?>]" id="peak_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_lapel'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="peak_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Peak lapel</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $thisIndex; ?>]" id="shawl_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_lapel'] == 3) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="shawl_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Shawl lapel</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lapel[<?php echo $thisIndex; ?>]" id="none_is_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_lapel'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_lapel<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $thisIndex; ?>]" id="vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_vent'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Single vent</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $thisIndex; ?>]" id="double_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_vent'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="double_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Double vents</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $thisIndex; ?>]" id="no_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_vent'] == 3) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="no_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">No vent</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_vent[<?php echo $thisIndex; ?>]" id="none_is_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_vent'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_vent<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $thisIndex; ?>]" id="wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_wear'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Formal suit</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $thisIndex; ?>]" id="casual_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_wear'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="casual_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>"> Casual suit </label>
                                                                </div> &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $thisIndex; ?>]" id="groom_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_wear'] == 3) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="groom_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Grooms wear </label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_wear[<?php echo $thisIndex; ?>]" id="none_is_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_wear'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_wear<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $thisIndex; ?>]" id="lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_lined'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Fully lined </label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $thisIndex; ?>]" id="half_lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_lined'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="half_lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Half lined</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_lined[<?php echo $thisIndex; ?>]" id="none_is_lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_lined'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_lined<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_ticket[<?php echo $thisIndex; ?>]" id="ticket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_breasted']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="ticket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Ticket pocket </label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_ticket[<?php echo $thisIndex; ?>]" id="none_is_ticket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_breasted'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_ticket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $thisIndex; ?>]" id="regular<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_regular'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="regular<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Regular pockets</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $thisIndex; ?>]" id="slant<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_regular'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="slant<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Slant pocket </label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_pocket[<?php echo $thisIndex; ?>]" id="none_is_suit_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_regular'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_suit_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $thisIndex; ?>]" id="metalic_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_button'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="metalic_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Metallic buttons </label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $thisIndex; ?>]" id="button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_button'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Plain buttons</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_suit_button[<?php echo $thisIndex; ?>]" id="none_is_suit_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_button'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_suit_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-0 shirt_qameez" <?php echo ($thiscustomer['is_shirts'] == 1 || $thiscustomer['is_shalwarqameez']) ? '' : 'style="display:none;"' ?>>
                                            <h5 class="title text-center shalwar">KAMIZ / KURTA</h5>
                                            <h5 class="title text-center only_shirt">SHIRT</h5>
                                            <div class="cus-bor">
                                                <div class="only_shirt" <?php echo ($thiscustomer['is_shirts'] == 1) ? '' : 'style="display:none;"' ?>>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Shirt Length</label>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" name ="shirtLength_form[<?php echo $thisIndex; ?>]" value="<?php echo $vToken; ?>">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtLength[<?php echo $thisIndex; ?>]" id="kmzLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtLength'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder[<?php echo $thisIndex; ?>]" id="kmzShoulder<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtShoulder'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtSleeves[<?php echo $thisIndex; ?>]" id="kmzSleeves<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtSleeves'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtNeck[<?php echo $thisIndex; ?>]" id="kmzNeck<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtNeck'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtChest[<?php echo $thisIndex; ?>]" id="kmzChest<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtChest'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtWaist[<?php echo $thisIndex; ?>]" id="kmzWaist<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtChest'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="shirtHips[<?php echo $thisIndex; ?>]" id="kmzHips<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtHips'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="shirtBicep[<?php echo $thisIndex; ?>]" id="kmzBicep<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtBicep'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Forearm</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="shirtForearm[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtForearm'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="shirtarmhole[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtarmhole'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="shirtcuff[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['shirtcuff'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="shalwar" <?php echo ($thiscustomer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"' ?>>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Kameez Length</label>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" name ="kmzLength_form[<?php echo $thisIndex; ?>]" value="<?php echo $vToken; ?>">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzLength[<?php echo $thisIndex; ?>]" id="kmzLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_length'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Kurta Length</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kurtaLength[<?php echo $thisIndex; ?>]" id="kmzLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kurtaLength'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzShoulder[<?php echo $thisIndex; ?>]" id="kmzShoulder<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_shoulder'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Sleeves Length</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzSleeves[<?php echo $thisIndex; ?>]" id="kmzSleeves<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_sleeves'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Neck</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzNeck[<?php echo $thisIndex; ?>]" id="kmzNeck<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_neck'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Chest</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzChest[<?php echo $thisIndex; ?>]" id="kmzChest<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_chest'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Waist</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzWaist[<?php echo $thisIndex; ?>]" id="kmzWaist<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_waist'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Hip</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input " name="kmzHips[<?php echo $thisIndex; ?>]" id="kmzHips<?php echo $thisIndex; ?>"  value="<?php echo $thiscustomer['kmz_hip'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Bicep</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="kmzBicep[<?php echo $thisIndex; ?>]" id="kmzBicep<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_bicep'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label"  for="name">Forearm</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="kmzForearm[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmz_forearm'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Armhole</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="kmzarmhole[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmzarmhole'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-1">
                                                        <label class="col-sm-5 col-form-label" for="name">Cuff</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control margin-bottom b_input" name="kmzcuff[<?php echo $thisIndex; ?>]" id="kmzForearm<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['kmzcuff'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-0 shalwar" <?php echo ($thiscustomer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"' ?>>                    
                                            <h5 class="title text-center">SHALWAR / PAJAMA</h5>
                                            <div class="cus-bor">
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label"
                                                           for="name">Shalwar Length</label>

                                                    <div class="col-sm-6">
                                                        <input type="text"
                                                               class="form-control margin-bottom b_input " name="shlLength[<?php echo $thisIndex; ?>]" value="<?php echo $thiscustomer['shl_length'] ?>"
                                                               id="shlLength<?php echo $thisIndex; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label"
                                                           for="name">Shalwar Bottom</label>

                                                    <div class="col-sm-6">
                                                        <input type="text"
                                                               class="form-control margin-bottom b_input " name="shlBottom[<?php echo $thisIndex; ?>]" value="<?php echo $thiscustomer['shl_bottom'] ?>"
                                                               id="shlBottom<?php echo $thisIndex; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label"
                                                           for="name">Asan Tyar</label>

                                                    <div class="col-sm-6">
                                                        <input type="text"
                                                               class="form-control margin-bottom b_input " name="shlAsanTyar[<?php echo $thisIndex; ?>]" value="<?php echo $thiscustomer['shl_AsanTyar'] ?>"
                                                               id="shlAsanTyar<?php echo $thisIndex; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label"
                                                           for="name">Shalwar Gaira Tyar</label>

                                                    <div class="col-sm-6">
                                                        <input type="text"
                                                               class="form-control margin-bottom b_input " name="shlGairaTyar[<?php echo $thisIndex; ?>]" value="<?php echo $thiscustomer['shl_GairaTyar'] ?>"
                                                               id="shlGairaTyar<?php echo $thisIndex; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Pajama Length</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pjamaLength[<?php echo $thisIndex; ?>]" id="shlLength<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pjamaLength'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-1">
                                                    <label class="col-sm-5 col-form-label" for="name">Pajama Bottom</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control margin-bottom b_input " name="pjamaBottom[<?php echo $thisIndex; ?>]" id="shlBottom<?php echo $thisIndex; ?>" value="<?php echo $thiscustomer['pjamaBottom'] ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="shalwar"  <?php echo ($thiscustomer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"' ?>>                    
                                                <h5 class="title text-center">Checks</h5>
                                                <div class="cus-bor">
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio form-check-inline">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_collar[<?php echo $thisIndex; ?>]" id="is_kamiz_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_collar'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_kamiz_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Collar</label>
                                                                </div> &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio form-check-inline">
                                                                    <input type="radio" class="custom-control-input"<?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?>  name="is_collar[<?php echo $thisIndex; ?>]" id="is_half_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_collar'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_half_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Half Band</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio form-check-inline">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_collar[<?php echo $thisIndex; ?>]" id="is_full_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_collar'] == 3) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_full_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Full Band</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio form-check-inline">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_collar[<?php echo $thisIndex; ?>]" id="moon_neck<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="4" <?php echo ($thiscustomer['is_collar'] == 4) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="moon_neck<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Moon Neck</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_collar[<?php echo $thisIndex; ?>]" id="none_is_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_collar'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                                <div class="input-group collar_text">
                                                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="collar_ins[<?php echo $thisIndex; ?>]" id="collar_ins<?php echo $thisIndex; ?>"
                                                                           alue="4" value=" <?php echo $thiscustomer['collar_ins']; ?>"
                                                                           placeholder="Write instructions..."> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $thisIndex; ?>]" id="is_round_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" <?php echo ($thiscustomer['is_straight_front'] == 1) ? "checked" : ''; ?> value="1">
                                                                    <label class="custom-control-label" for="is_round_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Round Front</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $thisIndex; ?>]" id="straight_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" <?php echo ($thiscustomer['is_straight_front'] == 2) ? "checked" : ''; ?>  value="2">
                                                                    <label class="custom-control-label" for="straight_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Straight Front</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_front[<?php echo $thisIndex; ?>]" id="none_is_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_straight_front'] == 0 && $thiscustomer['is_round_front'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_front<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_front_pocket[<?php echo $thisIndex; ?>]" id="is_front_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_front_pocket']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_front_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Front Pocket</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_front_pocket[<?php echo $thisIndex; ?>]" id="none_is_front_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo ($thiscustomer['is_front_pocket'] == 0) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_front_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                                <div class="input-group front_pocket_text" >
                                                                    <input type="text" class="form-control" style="margin-right:20px; margin-top:5px;" name="front_pocket_ins[<?php echo $thisIndex; ?>]" id="front_pocket_ins<?php echo $thisIndex; ?>"
                                                                           value="<?php echo $thiscustomer['front_pocket_ins']; ?>"
                                                                           placeholder="Write instructions..."> 
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"<?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?>  name="is_shalwar_pocket[<?php echo $thisIndex; ?>]" id="is_shalwar_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_shalwar_pocket']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_shalwar_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Shalwar Pocket</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_shalwar_pocket[<?php echo $thisIndex; ?>]" id="none_is_shalwar_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_shalwar_pocket']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_shalwar_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                                <div class="input-group shalwar_pocket_text">
                                                                    <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;"  name="shalwar_pocket_ins[<?php echo $thisIndex; ?>]" id="shalwar_pocket_ins<?php echo $thisIndex; ?>"
                                                                           value="<?php echo $thiscustomer['shalwar_pocket_ins']; ?>"
                                                                           placeholder="Write instructions..."> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_pocket[<?php echo $thisIndex; ?>]" id="1side_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_1side_pocket']) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="1side_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">1 side pocket</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_pocket[<?php echo $thisIndex; ?>]" id="2side_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_1side_pocket']) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="2side_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">2 side pocket</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_pocket[<?php echo $thisIndex; ?>]" id="none_is_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_1side_pocket'] && !$thiscustomer['is_2side_pocket']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_pocket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_sleeve_placket[<?php echo $thisIndex; ?>]" id="is_sleeve_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_sleeve_placket']) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="is_sleeve_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Sleeve Placket Button</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_sleeve_placket[<?php echo $thisIndex; ?>]" id="none_is_sleeve_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_sleeve_placket']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_sleeve_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $thisIndex; ?>]" id="is_plain_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_plain_button'] == 1) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="is_plain_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Plain Button</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $thisIndex; ?>]" id="fancy_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_plain_button'] == 2) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="fancy_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Fancy Button</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_button[<?php echo $thisIndex; ?>]" id="loop_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_plain_button'] == 3) ? "checked" : ''; ?> >
                                                                    <label class="custom-control-label" for="loop_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Loop Button</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_button[<?php echo $thisIndex; ?>]" id="none_is_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_plain_button']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_button<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $thisIndex; ?>]" id="is_button_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_button_cuff'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_button_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Button Cuff</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $thisIndex; ?>]" id="is_french_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_button_cuff'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_french_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">French Cuff</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_cuff[<?php echo $thisIndex; ?>]" id="is_open_sleeves<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_button_cuff'] == 3) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_open_sleeves<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Open Sleeves</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_cuff[<?php echo $thisIndex; ?>]" id="none_is_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_button_cuff']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_design[<?php echo $thisIndex; ?>]" id="is_half_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_design'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_half_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Half design</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_design[<?php echo $thisIndex; ?>]" id="is_full_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_design'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_full_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Full design</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_design[<?php echo $thisIndex; ?>]" id="none_is_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_design']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_design<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_kanta[<?php echo $thisIndex; ?>]" id="is__kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_kanta'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is__kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Kanta</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_kanta[<?php echo $thisIndex; ?>]" id="is_jali_kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_kanta'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_jali_kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Jali Kanta</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_kanta[<?php echo $thisIndex; ?>]" id="none_is_kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_kanta']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_kanta<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_stitch[<?php echo $thisIndex; ?>]" id="is_single_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_stitch'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_single_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Single stitch</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_stitch[<?php echo $thisIndex; ?>]" id="is_double_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_stitch'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_double_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Full double stitch</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_stitch[<?php echo $thisIndex; ?>]" id="none_is_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_stitch']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_stitch<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_thread[<?php echo $thisIndex; ?>]" id="is_shin_thread<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_thread'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_shin_thread<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Shining thread</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_thread[<?php echo $thisIndex; ?>]" id="none_is_thread<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_thread']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_thread<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mt-1">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_bookrum[<?php echo $thisIndex; ?>]" id="is_hard_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_bookrum'] == 1) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_hard_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Hard bookrum</label>
                                                                </div>&nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" name="is_bookrum[<?php echo $thisIndex; ?>]" id="is_soft_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_bookrum'] == 2) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="is_soft_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Soft bookrum</label>
                                                                </div>
                                                                &nbsp;&nbsp;
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input"  name="is_bookrum[<?php echo $thisIndex; ?>]" id="none_is_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_bookrum']) ? "checked" : ''; ?>>
                                                                    <label class="custom-control-label" for="none_is_bookrum<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4 pl-0 only_shirt" <?php echo ($thiscustomer['is_shirts'] == 1) ? '' : 'style="display:none;"' ?>>
                                            <h5 class="title text-center">Checks</h5>
                                            <div class="cus-bor">
                                                <div class="form-group row  mt-1">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-control custom-radio form-check-inline">
                                                                <input type="radio" class="custom-control-input" name="is_placket[<?php echo $thisIndex; ?>]" id="front_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>]" value="1" <?php echo ($thiscustomer['is_front_placket'] == 1) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="front_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>]">Front placket</label>
                                                            </div> &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio form-check-inline">
                                                                <input type="radio" class="custom-control-input" name="is_placket[<?php echo $thisIndex; ?>]" id="plane_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>]" value="2" <?php echo ($thiscustomer['is_plane_placket'] == 1) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="plane_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>]"> Plain Front</label>
                                                            </div>
                                                            &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"  name="is_placket[<?php echo $thisIndex; ?>]" id="none_is_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_plane_placket'] && !$thiscustomer['is_front_placket']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="none_is_placket<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row  mt-1">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[<?php echo $thisIndex; ?>]" id="is_shirt_button_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_shirt_cuff'] == 1) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="is_shirt_button_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Button Cuff </label>
                                                            </div> &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="is_shirt_cuff[<?php echo $thisIndex; ?>]" id="is_shirt_double_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_shirt_cuff'] == 2) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="is_shirt_double_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Double Cuff</label>
                                                            </div>
                                                            &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"  name="is_shirt_cuff[<?php echo $thisIndex; ?>]" id="none_is_shirt_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_shirt_cuff']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="none_is_shirt_cuff<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row  mt-1">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <div class="custom-control custom-radio form-check-inline">
                                                                <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?>  name="is_shirt_collar[<?php echo $thisIndex; ?>]" id="is__shirt_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_shirt_collar'] == 1) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="is__shirt_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Collar</label>
                                                            </div> &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio form-check-inline">
                                                                <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?>  name="is_shirt_collar[<?php echo $thisIndex; ?>]" id="is_shirt_half_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_shirt_collar'] == 2) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="is_shirt_half_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Half Band</label>
                                                            </div>&nbsp;&nbsp;
                                                            <div class="custom-control custom-radio form-check-inline">
                                                                <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_shirt_collar[<?php echo $thisIndex; ?>]" id="is_shirt_full_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_shirt_collar'] == 3) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="is_shirt_full_band<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Full Band</label>
                                                            </div>
                                                            &nbsp;&nbsp;
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" <?php echo $thisIndex == 0 ? '' : 'data-count="' . $thisIndex . '"'; ?> name="is_shirt_collar[<?php echo $thisIndex; ?>]" id="none_is_shirt_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_shirt_collar']) ? "checked" : ''; ?>>
                                                                <label class="custom-control-label" for="none_is_shirt_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                            </div>
                                                            <br><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 shirt_collar_text"  <?php echo!empty($thiscustomer['is_shirt_collar']) ? '' : 'style="display:none;"' ?>>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="tie_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="1" <?php echo ($thiscustomer['is_shirt_collar_type'] == 1) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="tie_collar<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Tie Collar</label>
                                                        </div><br>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="button_down<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="2" <?php echo ($thiscustomer['is_shirt_collar_type'] == 2) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="button_down<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Button Down</label>
                                                        </div><br>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="vintage_clud<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="3" <?php echo ($thiscustomer['is_shirt_collar_type'] == 3) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="vintage_clud<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Vintage club</label>
                                                        </div><br>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="half_french<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="4" <?php echo ($thiscustomer['is_shirt_collar_type'] == 4) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="half_french<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Half French</label>
                                                        </div><br>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="full_french<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="5" <?php echo ($thiscustomer['is_shirt_collar_type'] == 5) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="full_french<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Full French</label>
                                                        </div><br>
                                                        <div class="custom-control custom-radio form-check-inline">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="tuxedo<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="6" <?php echo ($thiscustomer['is_shirt_collar_type'] == 6) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="tuxedo<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">Tuxedo</label>
                                                        </div>   
                                                        <br>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" name="is_shirt_collar_type[<?php echo $thisIndex; ?>]" id="none_is_shirt_collar_type<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>" value="0" <?php echo (!$thiscustomer['is_shirt_collar_type']) ? "checked" : ''; ?>>
                                                            <label class="custom-control-label" for="none_is_shirt_collar_type<?php echo $thisIndex == 0 ? '' : '_' . $thisIndex; ?>">None</label>
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" style="margin-right:20px;margin-top:5px;" name="shirt_collar_ins[<?php echo $thisIndex; ?>]" id="shirt_collar_ins<?php echo $thisIndex; ?>"
                                                                   value="<?php echo ($thiscustomer['shirt_collar_ins']); ?>"
                                                                   placeholder="Write instructions..."> 
                                                        </div>
                                                    </div>
                                                </div>                         
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-1 coat_waistCoat" <?php echo!empty($thiscustomer['is_suiting']) ? '' : 'style="display:none;"' ?>>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inst" class="col-form-label">Suiting Instructions:</label>
                                                <textarea class="form-control" name="inst[<?php echo $thisIndex; ?>]" rows="7" id="inst"><?php echo ($thiscustomer['instrucations']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'inst[<?php echo $thisIndex; ?>]' );
                                                </script>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row mt-1 only_shirt" <?php echo!empty($thiscustomer['is_shirts']) ? '' : 'style="display:none;"' ?> >
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">Shirts Instructions:</label>
                                                <textarea class="form-control" name="shirt_inst[<?php echo $thisIndex; ?>]" rows="7"  id="shirt_inst"><?php echo ($thiscustomer['shirt_inst']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'shirt_inst[<?php echo $thisIndex; ?>]' );
                                                </script>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row mt-1 shalwar" <?php echo!empty($thiscustomer['is_shalwarqameez']) ? '' : 'style="display:none;"' ?>>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                                                <textarea class="form-control" name="shalwar_inst[<?php echo $thisIndex; ?>]" rows="7" id="shalwar_inst"><?php echo ($thiscustomer['shalwar_inst']); ?></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'shalwar_inst[<?php echo $thisIndex; ?>]' );
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($thisIndex) { ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <input type="hidden" value="<?php echo $thiscustomer["id"]; ?>" name="customer_id">
                            <input type="hidden" value="<?php echo $thiscustomer["basic_info_id"]; ?>" name="basic_info_id">
                        </div></div>
                    <script>$(document).ready(function () {
                            $("input[name='is_collar[<?php echo $thisIndex; ?>]']").change(function () {
                                $(".default_row .collar_text").show();
                            });

                            $("input[name='is_front_pocket[<?php echo $thisIndex; ?>]']").change(function () {
                                $(".default_row .front_pocket_text").show();
                            });

                            $("input[name='is_shalwar_pocket[<?php echo $thisIndex; ?>]']").change(function () {
                                $(".default_row .shalwar_pocket_text").show();
                            });

                            $("input[name='is_shirt_collar[<?php echo $thisIndex; ?>]']").change(function () {
                                $(".default_row .shirt_collar_text").show();
                            });

                            $(document).on('click', 'input[name="is_shirt_collar[<?php echo $thisIndex; ?>]"]', function () {
                                var count = $(this).attr('data-count');
                                $(".append_row_for_article_" + count + " .shirt_collar_text_" + count).show();
                            });

                            $(document).on('click', 'input[name="is_shalwar_pocket[<?php echo $thisIndex; ?>]"]', function () {
                                var count = $(this).attr('data-count');
                                $(".append_row_for_article_" + count + " .shalwar_pocket_text_" + count).show();
                            });

                            $(document).on('click', 'input[name="is_front_pocket[<?php echo $thisIndex; ?>]"]', function () {
                                var count = $(this).attr('data-count');
                                $(".append_row_for_article_" + count + " .front_pocket_text_" + count).show();
                            });

                            $(document).on('click', 'input[name="is_collar[<?php echo $thisIndex; ?>]"]', function () {
                                var count = $(this).attr('data-count');
                                $(".append_row_for_article_" + count + " .collar_text_" + count).show();
                            });
                        });
                    </script>
                <?php } ?>
                <div class="append_new_size_article"></div>
                <input type="hidden" value="customers/updatecolthingCustomer" id="action-url">
                <?php if ($this->aauth->premission(10)) { ?>
                    <div id="mybutton" class="mt-1">
                        <input type="submit" id="submit-data"
                            class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                            value="Update Customer"
                            data-loading-text="Saving...">
                    </div>
                <?php } ?>
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


    $("#bDate").datepicker({format:'yyyy-mm-dd'});
    $("#tDate").datepicker({format:'yyyy-mm-dd'});
    $("#dDate").datepicker({format:'yyyy-mm-dd'});

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
            } else if ($(this).is(":checked") && $(this).val() == 'shirts') {

                $('.default_row #suiting').prop('checked', false);
                $('.default_row #shalwarqameez').prop('checked', false);

                $(".default_row .coat_waistCoat").hide();
                $(".default_row .pant").hide();
                $(".default_row .shirt_qameez").show();
                $(".default_row .only_shirt").show();
                $(".default_row .shalwar").hide();
            } else if ($(this).is(":checked") && $(this).val() == 'shalwarqameez') {

                $('.default_row #shirts').prop('checked', false);
                $('.default_row #suiting').prop('checked', false);

                $(".default_row .coat_waistCoat").hide();
                $(".default_row .pant").hide();
                $(".default_row .only_shirt").hide();
                $(".default_row .shirt_qameez").show();
                $(".default_row .shalwar").show();
            }
            if ($(this).is(":checked") && $(this).val() == 'english') {
                $('#urdu').prop('checked', false);
            } else if ($(this).is(":checked") && $(this).val() == 'urdu') {
                $('#english').prop('checked', false);
            }

            $('.add_new_rows').show();

        });


//        $('body').delegate('.add_new_rows','click',function() {
        $('.add_new_rows').click(function () {
            var count = $(this).attr('data-count');
            count = count == 0 ? 1 : count;

            $(this).attr('data-count', parseInt(count) + 1);
            var form = $("#data_form");
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
            } else if ($(this).is(":checked") && $(this).val() == 'shirts') {
                $('.append_row_for_article_' + counter + ' #suiting_' + counter).prop('checked', false);
                $('.append_row_for_article_' + counter + ' #shalwarqameez_' + counter).prop('checked', false);

                $(".append_row_for_article_" + counter + " .coat_waistCoat").hide();
                $(".append_row_for_article_" + counter + " .pant").hide();
                $(".append_row_for_article_" + counter + " .shirt_qameez").show();
                $(".append_row_for_article_" + counter + " .only_shirt").show();
                $(".append_row_for_article_" + counter + " .shalwar").hide();
            } else if ($(this).is(":checked") && $(this).val() == 'shalwarqameez') {

                $('.append_row_for_article_' + counter + ' #shirts_' + counter).prop('checked', false);
                $('.append_row_for_article_' + counter + ' #suiting_' + counter).prop('checked', false);

                $(".append_row_for_article_" + counter + " .coat_waistCoat").hide();
                $(".append_row_for_article_" + counter + " .pant").hide();
                $(".append_row_for_article_" + counter + " .only_shirt").hide();
                $(".append_row_for_article_" + counter + " .shirt_qameez").show();
                $(".append_row_for_article_" + counter + " .shalwar").show();
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

