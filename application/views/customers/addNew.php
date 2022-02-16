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
        </div>
        <div class="card-body">
            <form method="post" id="data_form" class="form-horizontal">
               <div class="row">
                  <div class="col-md-4">
                    <h5 class="title text-center">Customer Info</h5>
                    <div class="cus-bor cus-height">
                      <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">ORDER/REF NO</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="or_ref_no"
                                      id="ref_no" readonly="" value="<?php echo $customer['reference_id']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Booking Date</label>

                           <div class="col-sm-7">
                               <input type="date"
                                      class="form-control margin-bottom b_input" name="booking_date"
                                      id="bDate"  value="<?php echo $customer['booking_date']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Delivery Date</label>

                           <div class="col-sm-7">
                               <input type="date"
                                      class="form-control margin-bottom b_input" name="d_date"
                                      id="d_date"   value="<?php echo $customer['d_date']?>">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Trial Date</label>

                           <div class="col-sm-7">
                               <input type="date"
                                      class="form-control margin-bottom b_input" name="t_date"
                                      id="t_date"  value="<?php echo $customer['trial_date']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Customer Name</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input" name="customer_name"
                                      id="customer_name" value="<?php echo $customer['name']?>">
                           </div>
                       </div>
                       <!-- <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Ph #</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input required" name=""
                                      id="mcustomer_name">
                           </div>
                       </div> -->
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Mobile</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input" name="mobile"
                                      id="mobile" value="<?php echo $customer['phone']?>">
                           </div>
                       </div>
                       <div class="form-group row  mt-1">
                            <label class="col-sm-4 col-form-label" for="name">Select Product:</label>
                            <div class="col-md-7 select_product">
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_suiting" id="suiting" value="suiting" <?php echo ($customer['is_suiting'])?"checked":'';?>>
                                        <label class="custom-control-label" for="suiting">Suiting</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_shirts" id="shirts" value="shirts" <?php echo ($customer['is_shirts'])?"checked":'';?>>
                                        <label class="custom-control-label" for="shirts">Shirt</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_shalwarqameez" id="shalwarqameez" value="shalwarqameez" <?php echo ($customer['is_shalwarqameez'])?"checked":'';?>>
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
                                        <input type="checkbox" class="custom-control-input" name="is_english" id="english" value="english" <?php echo ($customer['is_english'])?"checked":'';?>>
                                        <label class="custom-control-label" for="english">English</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_urdu" id="urdu" value="urdu" <?php echo ($customer['is_urdu'])?"checked":''; ?>>
                                        <label class="custom-control-label" for="urdu">Urdu</label>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>TOTAL</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input cal_blanc" name="total"
                                      id="total" onfocusout="cal_blace()" >
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>ADVANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text" class="form-control margin-bottom b_input cal_blanc" name="advance" id="adv" onfocusout="cal_blace()">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label" for="name"><strong>BLANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="BLANCE"
                                      id="blance" readonly="">
                           </div>
                       </div>
                    </div>
                  </div>
                  <?php //echo '<pre>'; print_r($customer);exit; ?>
                    <div class="col-md-3 pl-0 coat_waistCoat" <?php echo ($customer['is_suiting'] == 1) ? '' :'style="display:none;"'?>  >

                        <h5 class="title text-center">COAT / WAIST COAT</h5>
                        <div class="cus-bor cus-height" style="height: 1300px;">
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Neck</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cNeck" id="cNeck" value="<?php echo $customer['coat_neck']?>">
                                </div>
                            </div>
                           
                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Chest</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cChest" id="cChest" value="<?php echo $customer['coat_chest']?>">
                              </div>
                            </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Belly Waist</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cWaist" id="cWaist" value="<?php echo $customer['coat_waist']?>">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Hip</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cHips" id="cHips"  value="<?php echo $customer['coat_hip']?>">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Shoulder</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cShoulder" id="cShoulder"  value="<?php echo $customer['coat_shoulder']?>">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Sleeves Length</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input" name="cSleeves" id="cSleev"  value="<?php echo $customer['coat_length']?>">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Bicep</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cBicep" id="cBicep" value="<?php echo $customer['coat_bicep']?>">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Forearm</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cForearm" id="cForearm"value="<?php echo $customer['coat_forearm']?>">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Half Back</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input " name="cHalfBack" id="cHalfBack" value="<?php echo $customer['coat_half_back']?>">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Cross Back</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input " name="cCrossBack" id="cCrossBack" value="<?php echo $customer['coat_cross_back']?>">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Coat length</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cLength" id="cLength" value="<?php echo $customer['coat_length']?>">
                               </div>
                           </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">3p waistcoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="3p_waistcoat_length" id="Sec_cLength" value="<?php echo $customer['p3_waistcoat_length']?>">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Waistcoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="waistcoat_length" id="Sec_cLength" value="<?php echo $customer['waistcoat_length']?>">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Princecoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="princecoat_length" id="Sec_cLength" value="<?php echo $customer['princecoat_length']?>">
                               </div>
                            </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Sherwani Length</label>
                               <div class="col-sm-4">
                                    <input type="text" class="form-control margin-bottom b_input" name="sherwani_length" id="Sec_cLength" value="<?php echo $customer['sherwani_length']?>">
                               </div>
                            </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Long coat length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="longcoat_length" id="Sec_cLength" value="<?php echo $customer['longcoat_length']?>">
                                </div>
                            </div>
                            
                             <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Chester length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="chester_length" id="Sec_cLength" value="<?php echo $customer['chester_length']?>">
                               </div>
                            </div>
                            
                             <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Armhole</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="armhole" id="Sec_cLength" value="<?php echo $customer['armhole']?>">
                               </div>
                            </div>                            
                           
                        </div>   
                    </div>
                    <div class="col-md-3 pl-0 pant"  <?php echo ($customer['is_suiting'] == 1) ? '' : 'style="display:none;"'?>>
                        <h5 class="title text-center">PANT</h5>
                        <div class="cus-bor cus-height">
                           
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Waist</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pWaist"
                                          id="pWaist" value="<?php echo $customer['pant_waist']?>">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Hip</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pHip"
                                          id="pHip" value="<?php echo $customer['pant_hip']?>">
                               </div>
                           </div>
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Thigh</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pThigh"
                                          id="pThigh" value="<?php echo $customer['pant_thigh']?>">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Knee</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pKnee"
                                          id="pKnee" value="<?php echo $customer['pant_knee']?>">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Inseam / Inside Length</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pInLength"
                                          id="pInLength" value="<?php echo $customer['pant_inside_length']?>">
                               </div>
                           </div> 


                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Length</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pLength"
                                          id="pLength" value="<?php echo $customer['pant_length']?>">
                               </div>
                           </div>                                                     
                           
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Bottom</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pBottom"
                                          id="pBottom" value="<?php echo $customer['pant_bottom']?>">
                               </div>
                           </div>                           
                        </div>
                    </div>
                    <div class="col-md-2 pl-0 pant"  <?php echo ($customer['is_suiting'] == 1) ? '' :'style="display:none;"'?>>
                        <h5 class="title text-center">Checks</h5>
                        <div class="cus-bor cus-height" style="height: 870px;">
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_breasted" id="breasted" <?php echo ($customer['is_breasted'])?"checked":'';?>>
                                            <label class="custom-control-label" for="breasted">Single breasted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_double_breasted" id="double_breasted" <?php echo ($customer['is_double_breasted'])?"checked":'';?>>
                                            <label class="custom-control-label" for="double_breasted">Double breasted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button_suit" id="button_suit" <?php echo ($customer['is_button_suit'])?"checked":'';?>>
                                            <label class="custom-control-label" for="button_suit">One button suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_two_button_suit" id="two_button_suit" <?php echo ($customer['is_two_button_suit'])?"checked":'';?>>
                                            <label class="custom-control-label" for="two_button_suit">2 button suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_lapel" id="lapel" <?php echo ($customer['is_lapel'])?"checked":'';?>>
                                            <label class="custom-control-label" for="lapel">Notch lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_peak_lapel" id="peak_lapel" <?php echo ($customer['is_peak_lapel'])?"checked":'';?>>
                                            <label class="custom-control-label" for="peak_lapel">Peak lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_shawl_lapel" id="shawl_lapel" <?php echo ($customer['is_shawl_lapel'])?"checked":'';?>>
                                            <label class="custom-control-label" for="shawl_lapel">Shawl lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_wear" id="wear" <?php echo ($customer['is_wear'])?"checked":'';?>>
                                            <label class="custom-control-label" for="wear">Formal suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_casual_wear" id="casual_wear" <?php echo ($customer['is_casual_wear'])?"checked":'';?>>
                                            <label class="custom-control-label" for="casual_wear"> Casual wear </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_groom_wear" id="groom_wear" <?php echo ($customer['is_groom_wear'])?"checked":'';?>>
                                            <label class="custom-control-label" for="groom_wear">Grooms wear  </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_vent" id="vent" <?php echo ($customer['is_vent'])?"checked":'';?>>
                                            <label class="custom-control-label" for="vent">Single vent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_double_vent" id="double_vent" <?php echo ($customer['is_double_vent'])?"checked":'';?>>
                                            <label class="custom-control-label" for="double_vent">Double vents</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_no_vent" id="no_vent" <?php echo ($customer['is_no_vent'])?"checked":'';?>>
                                            <label class="custom-control-label" for="no_vent">No vent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_lined" id="lined" <?php echo ($customer['is_lined'])?"checked":'';?>>
                                            <label class="custom-control-label" for="lined">Fully lined </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_half_lined" id="half_lined" <?php echo ($customer['is_half_lined'])?"checked":'';?>>
                                            <label class="custom-control-label" for="half_lined">Half lined</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_ticket" id="ticket" <?php echo ($customer['is_breasted'])?"checked":'';?>>
                                            <label class="custom-control-label" for="ticket">Ticket pocket </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_slant" id="slant" <?php echo ($customer['is_slant'])?"checked":'';?>>
                                            <label class="custom-control-label" for="slant">Slant pocket </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_regular" id="regular" <?php echo ($customer['is_regular'])?"checked":'';?>>
                                            <label class="custom-control-label" for="regular">Regular pockets</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button" id="button" <?php echo ($customer['is_button'])?"checked":'';?>>
                                            <label class="custom-control-label" for="button">Plain buttons</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_metalic_button" id="metalic_button" <?php echo ($customer['is_metalic_button'])?"checked":'';?>>
                                            <label class="custom-control-label" for="metalic_button">Metallic buttons </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 shirt_qameez"  <?php echo ($customer['is_shirts'] == 1 || $customer['is_shalwarqameez']) ? '' : 'style="display:none;"'?>>
                        <?php if($customer['is_shirts'] == 1){ ?>
                            <h5 class="title text-center only_shirt" >SHIRT</h5>
                        <?php } else if($customer['is_shalwarqameez'] == 1) {?>
                            <h5 class="title text-center shalwar">KAMIZ / KURTA</h5>
                        <?php }?>
                        <h5 class="title text-center only_shirt1" style="display:none;">SHIRT</h5>
                        <h5 class="title text-center shalwar1" style="display:none;">KAMIZ / KURTA</h5>

                        <div class="cus-bor">
                            <?php if($customer['is_shirts'] == 1){ ?>
                                <div class="only_shirt">
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Shirt Length</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtLength"
                                                  id="kmzLength" value="<?php echo $customer['shirtLength']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                        <label class="col-sm-5 col-form-label" for="name">Shoulder</label>

                                        <div class="col-sm-6">
                                           <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder" id="kmzShoulder" value="<?php echo $customer['shirtShoulder']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Sleeves Length</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtSleeves"
                                                  id="kmzSleeves" value="<?php echo $customer['shirtSleeves']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Neck</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtNeck"
                                                  id="kmzNeck" value="<?php echo $customer['shirtNeck']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Chest</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtChest"
                                                  id="kmzChest" value="<?php echo $customer['shirtChest']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Waist</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtWaist"
                                                  id="kmzWaist" value="<?php echo $customer['shirtWaist']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Hip</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="shirtHips"
                                                  id="kmzHips" value="<?php echo $customer['shirtHips']?>">
                                       </div>
                                   </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Bicep</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="shirtBicep"
                                                  id="kmzBicep" value="<?php echo $customer['shirtBicep']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Forearm</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="shirtForearm"
                                                  id="kmzForearm" value="<?php echo $customer['shirtForearm']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Armhole</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="shirtarmhole"
                                                  id="kmzForearm" value="<?php echo $customer['shirtarmhole']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Cuff</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="shirtcuff"
                                                  id="kmzForearm" value="<?php echo $customer['shirtcuff']?>">
                                       </div>
                                    </div>
                                </div>
                            <?php } else if($customer['is_shalwarqameez'] == 1) {?>
                               <div class="shalwar">
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Kameez Length</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzLength"
                                                  id="kmzLength" value="<?php echo $customer['kmz_length']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Kurta Length</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kurtaLength"
                                                  id="kmzLength" value="<?php echo $customer['kurtaLength']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Shoulder</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzShoulder"
                                                  id="kmzShoulder" value="<?php echo $customer['kmz_shoulder']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Sleeves Length</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzSleeves"
                                                  id="kmzSleeves" value="<?php echo $customer['kmz_sleeves']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Neck</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzNeck"
                                                  id="kmzNeck" value="<?php echo $customer['kmz_neck']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Chest</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzChest"
                                                  id="kmzChest" value="<?php echo $customer['kmz_chest']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Waist</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzWaist"
                                                  id="kmzWaist" value="<?php echo $customer['kmz_waist']?>">
                                       </div>
                                   </div>
                                   <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Hip</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input " name="kmzHips"
                                                  id="kmzHips" value="<?php echo $customer['kmz_hip']?>">
                                       </div>
                                   </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Bicep</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="kmzBicep"
                                                  id="kmzBicep" value="<?php echo $customer['kmz_bicep']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Forearm</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="kmzForearm"
                                                  id="kmzForearm" value="<?php echo $customer['kmz_forearm']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Armhole</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="kmzarmhole"
                                                  id="kmzForearm" value="<?php echo $customer['kmzarmhole']?>">
                                       </div>
                                    </div>
                                    <div class="form-group row mt-1">
                                      <label class="col-sm-5 col-form-label"
                                        for="name">Cuff</label>

                                       <div class="col-sm-6">
                                           <input type="text"
                                                  class="form-control margin-bottom b_input" name="kmzcuff"
                                                  id="kmzForearm" value="<?php echo $customer['kmzcuff']?>">
                                       </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="only_shirt1" style="display: none;">
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Shirt Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtLength"
                                              id="kmzLength" value="<?php echo $customer['shirtLength']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Shoulder</label>

                                    <div class="col-sm-6">
                                       <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder" id="kmzShoulder" value="<?php echo $customer['shirtShoulder']?>">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Sleeves Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtSleeves"
                                              id="kmzSleeves" value="<?php echo $customer['shirtSleeves']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Neck</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtNeck"
                                              id="kmzNeck" value="<?php echo $customer['shirtNeck']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Chest</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtChest"
                                              id="kmzChest" value="<?php echo $customer['shirtChest']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Waist</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtWaist"
                                              id="kmzWaist" value="<?php echo $customer['shirtWaist']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Hip</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtHips"
                                              id="kmzHips" value="<?php echo $customer['shirtHips']?>">
                                   </div>
                               </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Bicep</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtBicep"
                                              id="kmzBicep" value="<?php echo $customer['shirtBicep']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Forearm</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtForearm"
                                              id="kmzForearm" value="<?php echo $customer['shirtForearm']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Armhole</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtarmhole"
                                              id="kmzForearm" value="<?php echo $customer['shirtarmhole']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Cuff</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtcuff"
                                              id="kmzForearm" value="<?php echo $customer['shirtcuff']?>">
                                   </div>
                                </div>
                            </div> 
                            <div class="shalwar1"  style="display: none;">
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Kameez Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzLength"
                                              id="kmzLength" value="<?php echo $customer['kmz_length']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Kurta Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kurtaLength"
                                              id="kmzLength" value="<?php echo $customer['kurtaLength']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Shoulder</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzShoulder"
                                              id="kmzShoulder" value="<?php echo $customer['kmz_shoulder']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Sleeves Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzSleeves"
                                              id="kmzSleeves" value="<?php echo $customer['kmz_sleeves']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Neck</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzNeck"
                                              id="kmzNeck" value="<?php echo $customer['kmz_neck']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Chest</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzChest"
                                              id="kmzChest" value="<?php echo $customer['kmz_chest']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Waist</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzWaist"
                                              id="kmzWaist" value="<?php echo $customer['kmz_waist']?>">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Hip</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzHips"
                                              id="kmzHips" value="<?php echo $customer['kmz_hip']?>">
                                   </div>
                               </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Bicep</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzBicep"
                                              id="kmzBicep" value="<?php echo $customer['kmz_bicep']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Forearm</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzForearm"
                                              id="kmzForearm" value="<?php echo $customer['kmz_forearm']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Armhole</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzarmhole"
                                              id="kmzForearm" value="<?php echo $customer['kmzarmhole']?>">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Cuff</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzcuff"
                                              id="kmzForearm" value="<?php echo $customer['kmzcuff']?>">
                                   </div>
                                </div>
                            </div> 
                           
                        </div>
                    </div>
                    <?php if($customer['is_shirts'] == 1) { ?>
                        <div class="col-md-3 pl-0 only_shirt"  <?php echo ($customer['is_shirts'] == 1) ? '' :'style="display:none;"'?>>
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_darts" id="darts" <?php echo ($customer['is_darts'])?"checked":'';?>>
                                                <label class="custom-control-label" for="darts">Darts</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="sleeve_placket" <?php echo ($customer['is_sleeve_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="sleeve_placket">Sleeve placket button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_front_placket" id="front_placket" <?php echo ($customer['is_front_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="front_placket">Front placket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plane_placket" id="plane_placket" <?php echo ($customer['is_plane_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="plane_placket">Plane Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="button_cuff" <?php echo ($customer['is_button_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="button_cuff">Button Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plain_cuff" id="plain_cuff" <?php echo ($customer['is_plain_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="plain_cuff">Plain Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="french_cuff" <?php echo ($customer['is_french_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="french_cuff">French Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_double_cuff" id="double_cuff" <?php echo ($customer['is_double_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="double_cuff">Double Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 pl-0 only_shirt"  <?php echo ($customer['is_shirts'] == 1) ? '' :'style="display:none;"'?>>
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_darts" id="darts" <?php echo ($customer['is_darts'])?"checked":'';?>>
                                                <label class="custom-control-label" for="darts">Darts</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="sleeve_placket" <?php echo ($customer['is_sleeve_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="sleeve_placket">Sleeve placket button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_front_placket" id="front_placket" <?php echo ($customer['is_front_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="front_placket">Front placket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plane_placket" id="plane_placket" <?php echo ($customer['is_plane_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="plane_placket">Plane Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="button_cuff" <?php echo ($customer['is_button_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="button_cuff">Button Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plain_cuff" id="plain_cuff" <?php echo ($customer['is_plain_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="plain_cuff">Plain Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="french_cuff" <?php echo ($customer['is_french_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="french_cuff">French Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_double_cuff" id="double_cuff" <?php echo ($customer['is_double_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="double_cuff">Double Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-3 pl-0 shalwar"  <?php echo ($customer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"'?>>                    
                        <h5 class="title text-center">SHALWAR / PAJAMA</h5>
                        <div class="cus-bor">
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Length</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlLength"
                                          id="shlLength" value="<?php echo $customer['shl_length']?>">
                               </div>
                            </div>
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Bottom</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlBottom"
                                          id="shlBottom" value="<?php echo $customer['shl_bottom']?>">
                               </div>
                            </div>
                         
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Asan Tyar</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlAsanTyar"
                                          id="shlAsanTyar" value="<?php echo $customer['shl_AsanTyar']?>">
                               </div>
                            </div>
                          
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Gaira Tyar</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlGairaTyar"
                                          id="shlGairaTyar" value="<?php echo $customer['shl_GairaTyar']?>">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Pajama Length</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pjamaLength"
                                          id="shlLength" value="<?php echo $customer['pjamaLength']?>">
                               </div>
                            </div>
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Pajama Bottom</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pjamaBottom"
                                          id="shlBottom" value="<?php echo $customer['pjamaBottom']?>">
                               </div>
                            </div>
                        </div>
                    </div>
                    <?php if($customer['is_shalwarqameez'] == 1) { ?>
                        <div class="col-md-1 pl-0 shalwar"  <?php echo ($customer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"' ?>>                    
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_collar" id="collar" <?php echo ($customer['is_collar'])?"checked":'';?>>
                                                <label class="custom-control-label" for="collar">Collar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_moon_neck" id="moon_neck" <?php echo ($customer['is_moon_neck'])?"checked":'';?>>
                                                <label class="custom-control-label" for="moon_neck">Moon Neck</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_straight_front" id="straight_front" <?php echo ($customer['is_straight_front'])?"checked":'';?>>
                                                <label class="custom-control-label" for="straight_front">Straight Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_1side_pocket" id="1side_pocket" <?php echo ($customer['is_1side_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="1side_pocket">1 side pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_2side_pocket" id="2side_pocket" <?php echo ($customer['is_2side_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="2side_pocket">2 side pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_fancy_button" id="fancy_button" <?php echo ($customer['is_fancy_button'])?"checked":'';?>>
                                                <label class="custom-control-label" for="fancy_button">Fancy Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="is_french_cuff" <?php echo ($customer['is_french_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_french_cuff">French Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-1 pl-0 shalwar"  <?php echo ($customer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"'?>>                    
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_band" id="is_band"  <?php echo ($customer['is_band'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_band">Band</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_round_front" id="is_round_front" <?php echo ($customer['is_round_front'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_round_front">Round Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_front_pocket" id="is_front_pocket" <?php echo ($customer['is_front_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_front_pocket">Front Pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_shalwar_pocket" id="is_shalwar_pocket" <?php echo ($customer['is_shalwar_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_shalwar_pocket">Shalwar Pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="is_sleeve_placket" <?php echo ($customer['is_sleeve_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_sleeve_placket">Sleeve Placket Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_covered_fly" id="is_covered_fly" <?php echo ($customer['is_covered_fly'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_covered_fly">Covered Fly</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plain_button" id="is_plain_button" <?php echo ($customer['is_plain_button'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_plain_button">Plain Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="is_button_cuff" <?php echo ($customer['is_button_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_button_cuff">Button Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_open_sleeves" id="is_open_sleeves" <?php echo ($customer['is_open_sleeves'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_open_sleeves">Open Sleeves</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-1 pl-0 shalwar"  <?php echo ($customer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"' ?>>                    
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_collar" id="collar" <?php echo ($customer['is_collar'])?"checked":'';?>>
                                                <label class="custom-control-label" for="collar">Collar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_moon_neck" id="moon_neck" <?php echo ($customer['is_moon_neck'])?"checked":'';?>>
                                                <label class="custom-control-label" for="moon_neck">Moon Neck</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_straight_front" id="straight_front" <?php echo ($customer['is_straight_front'])?"checked":'';?>>
                                                <label class="custom-control-label" for="straight_front">Straight Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_1side_pocket" id="1side_pocket" <?php echo ($customer['is_1side_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="1side_pocket">1 side pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_2side_pocket" id="2side_pocket" <?php echo ($customer['is_2side_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="2side_pocket">2 side pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_fancy_button" id="fancy_button" <?php echo ($customer['is_fancy_button'])?"checked":'';?>>
                                                <label class="custom-control-label" for="fancy_button">Fancy Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="is_french_cuff" <?php echo ($customer['is_french_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_french_cuff">French Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-1 pl-0 shalwar"  <?php echo ($customer['is_shalwarqameez'] == 1) ? '' : 'style="display:none;"'?>>                    
                            <h5 class="title text-center">Checks</h5>
                            <div class="cus-bor">
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_band" id="is_band"  <?php echo ($customer['is_band'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_band">Band</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_round_front" id="is_round_front" <?php echo ($customer['is_round_front'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_round_front">Round Front</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_front_pocket" id="is_front_pocket" <?php echo ($customer['is_front_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_front_pocket">Front Pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_shalwar_pocket" id="is_shalwar_pocket" <?php echo ($customer['is_shalwar_pocket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_shalwar_pocket">Shalwar Pocket</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="is_sleeve_placket" <?php echo ($customer['is_sleeve_placket'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_sleeve_placket">Sleeve Placket Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_covered_fly" id="is_covered_fly" <?php echo ($customer['is_covered_fly'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_covered_fly">Covered Fly</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_plain_button" id="is_plain_button" <?php echo ($customer['is_plain_button'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_plain_button">Plain Button</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="is_button_cuff" <?php echo ($customer['is_button_cuff'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_button_cuff">Button Cuff</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row  mt-1">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_open_sleeves" id="is_open_sleeves" <?php echo ($customer['is_open_sleeves'])?"checked":'';?>>
                                                <label class="custom-control-label" for="is_open_sleeves">Open Sleeves</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    <?php  } ?>
                </div>
               </div>
               </div>
                <?php if($customer['is_suiting'] == 1){?>
                    <div class="row mt-1 coat_waistCoat">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Instrucations:</label>
                          <textarea class="form-control" name="inst" rows="7" id="comment"><?php echo $customer['instrucations']?></textarea>
                        </div>
                      </div>
                    </div>
                <?php  } else { ?>
                    <div class="row mt-1 coat_waistCoat" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Suiting Instrucations:</label>
                          <textarea class="form-control" name="inst" rows="7" id="comment"><?php echo $customer['instrucations']?></textarea>
                        </div>
                      </div>
                    </div>
                <?php  } ?>

                <?php if($customer['is_shirts'] == 1){?>
                    <div class="row mt-1 only_shirt">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Shirts Instructions:</label>
                          <textarea class="form-control" name="shirt_inst" rows="7" id="comment"><?php echo $customer['shirt_inst']?></textarea>
                        </div>
                      </div>
                    </div> 
                <?php  } else { ?>
                    <div class="row mt-1 only_shirt" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Shirts Instructions:</label>
                          <textarea class="form-control" name="shirt_inst" rows="7" id="comment"><?php echo $customer['shirt_inst']?></textarea>
                        </div>
                      </div>
                    </div> 
                <?php  } ?>
                
                <?php if($customer['is_shalwarqameez'] == 1){?>
                    <div class="row mt-1 shalwar">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                          <textarea class="form-control" name="shalwar_inst" rows="7" id="comment"><?php echo $customer['shalwar_inst']?></textarea>
                        </div>
                      </div>
                    </div>
                <?php  } else { ?>
                    <div class="row mt-1 shalwar" style="display: none;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                          <textarea class="form-control" name="shalwar_inst" rows="7" id="comment"><?php echo $customer['shalwar_inst']?></textarea>
                        </div>
                      </div>
                    </div>
                <?php  } ?>
                <div id="mybutton" class="mt-1">
                    <input type="submit" id="submit-data"
                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                           value="Add New"
                           data-loading-text="Adding...">
                </div>
               <input type="hidden" name="id" value="<?php echo $id?>">
               <input type="hidden" value="customers/addNew" id="action-url">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function cal_blace(){
      var total = $("#total").val();
      var adv = $("#adv").val();

      $("#blance").val(total - adv);
    }

    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).is(":checked") && $(this).val() == 'suiting'){
                
                $('#shirts').prop('checked', false);
                $('#shalwarqameez').prop('checked', false);

                $(".coat_waistCoat").show();
                $(".pant").show();
                $(".shirt_qameez").hide();  
                $(".shalwar").hide();
                $(".only_shirt").hide();
            }else if($(this).is(":checked") && $(this).val() == 'shirts'){
                
                $('#suiting').prop('checked', false);
                $('#shalwarqameez').prop('checked', false);

                $(".coat_waistCoat").hide();
                $(".pant").hide();
                $(".shirt_qameez").show(); 
                $(".only_shirt").show();
                var cus = "<?php echo $customer['is_shirts'] ?>";
                if(cus == 1){ 
                    $(".only_shirt1").hide();
                }else{
                    $(".only_shirt1").show();
                }
                $(".shalwar").hide(); 
                $(".shalwar1").hide(); 
            }else if($(this).is(":checked") && $(this).val() == 'shalwarqameez'){
                
                $('#shirts').prop('checked', false);
                $('#suiting').prop('checked', false);

                $(".coat_waistCoat").hide();
                $(".pant").hide();
                $(".only_shirt").hide();
                $(".only_shirt1").hide();
                $(".shirt_qameez").show();  
                $(".shalwar").show();
                var cus = "<?php echo $customer['is_shalwarqameez'] ?>";
                if(cus == 1){ 
                    $(".shalwar1").hide();
                }else{
                    $(".shalwar1").show();
                } 
            }

            if($(this).is(":checked") && $(this).val() == 'english'){
                $('#urdu').prop('checked', false);
            }else if($(this).is(":checked") && $(this).val() == 'urdu'){
                $('#english').prop('checked', false);
            }
        });
    });
</script>

