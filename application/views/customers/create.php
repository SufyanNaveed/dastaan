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
                                      id="ref_no" readonly="" value="<?php echo $ref_no?>">
                           </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Booking Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom" name="booking_date"
                                      id="bDate">
                           </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Trial Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input" name="t_date"
                                      id="tDate">
                           </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Delivery Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input" name="d_date"
                                      id="dDate">
                           </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Customer Name</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input" name="customer_name"
                                      id="customer_name">
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
                                      id="mobile">
                           </div>
                        </div>
                        <div class="form-group row  mt-1">
                            <label class="col-sm-4 col-form-label" for="name">Select Product:</label>
                            <div class="col-md-7 select_product">
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_suiting" id="suiting" value="suiting">
                                        <label class="custom-control-label" for="suiting">Suiting</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_shirts" id="shirts" value="shirts">
                                        <label class="custom-control-label" for="shirts">Shirt</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="is_shalwarqameez" id="shalwarqameez" value="shalwarqameez">
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
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>TOTAL</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input cal_blanc" name="total"
                                      id="total" onfocusout="cal_blace()">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>ADVANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text" class="form-control required margin-bottom b_input cal_blanc" name="advance" id="adv" onfocusout="cal_blace()">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label" for="name"><strong>BALANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="BLANCE"
                                      id="blance" readonly="">
                           </div>
                       </div>
                    </div> 
                  </div>
                    <div class="col-md-3 pl-0 coat_waistCoat" style="display:none;">

                        <h5 class="title text-center">COAT / WAIST COAT</h5>
                        <div class="cus-bor cus-height" style="height: 1300px;">
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Neck</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cNeck" id="cNeck">
                                </div>
                            </div>
                           
                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Chest</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cChest" id="cChest">
                              </div>
                            </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Belly Waist</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cWaist" id="cWaist">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Hip</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cHips" id="cHips">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Shoulder</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input " name="cShoulder" id="cShoulder">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Sleeves Length</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control margin-bottom b_input" name="cSleeves" id="cSleev">
                              </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Bicep</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cBicep" id="cBicep">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Forearm</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cForearm" id="cForearm">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Half Back</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input " name="cHalfBack" id="cHalfBack">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Cross Back</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input " name="cCrossBack" id="cCrossBack">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-4 col-form-label" for="name">Coat length</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="cLength" id="cLength">
                               </div>
                           </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">3p waistcoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="3p_waistcoat_length" id="Sec_cLength">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Waistcoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="waistcoat_length" id="Sec_cLength">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Princecoat Length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="princecoat_length" id="Sec_cLength">
                               </div>
                            </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Sherwani Length</label>
                               <div class="col-sm-4">
                                    <input type="text" class="form-control margin-bottom b_input" name="sherwani_length" id="Sec_cLength">
                               </div>
                            </div>
                            
                            <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Long coat length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="longcoat_length" id="Sec_cLength">
                                </div>
                            </div>
                            
                             <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Chester length</label>
                                <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="chester_length" id="Sec_cLength">
                               </div>
                            </div>
                            
                             <div class="form-group row mt-1">
                                <label class="col-sm-4 col-form-label" for="name">Armhole</label>
                               <div class="col-sm-4">
                                   <input type="text" class="form-control margin-bottom b_input" name="armhole" id="Sec_cLength">
                               </div>
                            </div>                            
                           
                        </div>   
                    </div>
                    <div class="col-md-3 pl-0 pant"  style="display:none;">
                        <h5 class="title text-center">PANT</h5>
                        <div class="cus-bor cus-height">
                           
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Waist</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pWaist"
                                          id="pWaist">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Hip</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pHip"
                                          id="pHip">
                               </div>
                           </div>
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Thigh</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pThigh"
                                          id="pThigh">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Knee</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pKnee"
                                          id="pKnee">
                               </div>
                           </div>

                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Inseam / Inside Length</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pInLength"
                                          id="pInLength">
                               </div>
                           </div> 


                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Length</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pLength"
                                          id="pLength">
                               </div>
                           </div>                                                     
                           
                           <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Bottom</label>

                               <div class="col-sm-4">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pBottom"
                                          id="pBottom">
                               </div>
                           </div>                           
                        </div>
                    </div>
                    <div class="col-md-2 pl-0 pant"  style="display:none;">
                        <h5 class="title text-center">Checks</h5>
                        <div class="cus-bor cus-height" style="height: 870px;">
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_breasted" id="breasted">
                                            <label class="custom-control-label" for="breasted">Single breasted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_double_breasted" id="double_breasted">
                                            <label class="custom-control-label" for="double_breasted">Double breasted</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button_suit" id="button_suit">
                                            <label class="custom-control-label" for="button_suit">One button suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_two_button_suit" id="two_button_suit">
                                            <label class="custom-control-label" for="two_button_suit">2 button suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_lapel" id="lapel">
                                            <label class="custom-control-label" for="lapel">Notch lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_peak_lapel" id="peak_lapel">
                                            <label class="custom-control-label" for="peak_lapel">Peak lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_shawl_lapel" id="shawl_lapel">
                                            <label class="custom-control-label" for="shawl_lapel">Shawl lapel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_wear" id="wear">
                                            <label class="custom-control-label" for="wear">Formal suit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_casual_wear" id="casual_wear">
                                            <label class="custom-control-label" for="casual_wear"> Casual wear </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_groom_wear" id="groom_wear">
                                            <label class="custom-control-label" for="groom_wear">Grooms wear  </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_vent" id="vent">
                                            <label class="custom-control-label" for="vent">Single vent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_double_vent" id="double_vent">
                                            <label class="custom-control-label" for="double_vent">Double vents</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_no_vent" id="no_vent">
                                            <label class="custom-control-label" for="no_vent">No vent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_lined" id="lined">
                                            <label class="custom-control-label" for="lined">Fully lined </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_half_lined" id="half_lined">
                                            <label class="custom-control-label" for="half_lined">Half lined</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_ticket" id="ticket">
                                            <label class="custom-control-label" for="ticket">Ticket pocket </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_slant" id="slant">
                                            <label class="custom-control-label" for="slant">Slant pocket </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_regular" id="regular">
                                            <label class="custom-control-label" for="regular">Regular pockets</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button" id="button">
                                            <label class="custom-control-label" for="button">Plain buttons</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_metalic_button" id="metalic_button">
                                            <label class="custom-control-label" for="metalic_button">Metallic buttons </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 shirt_qameez"  style="display:none;">
                        <h5 class="title text-center shalwar">KAMIZ / KURTA</h5>
                        <h5 class="title text-center only_shirt">SHIRT</h5>
                        <div class="cus-bor">
                            <div class="only_shirt">
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Shirt Length</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control margin-bottom b_input " name="shirtLength" id="kmzLength">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label class="col-sm-5 col-form-label" for="name">Shoulder</label>

                                    <div class="col-sm-6">
                                       <input type="text" class="form-control margin-bottom b_input " name="shirtShoulder" id="kmzShoulder">
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Sleeves Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtSleeves"
                                              id="kmzSleeves">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Neck</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtNeck"
                                              id="kmzNeck">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Chest</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtChest"
                                              id="kmzChest">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Waist</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtWaist"
                                              id="kmzWaist">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Hip</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="shirtHips"
                                              id="kmzHips">
                                   </div>
                               </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Bicep</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtBicep"
                                              id="kmzBicep">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Forearm</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtForearm"
                                              id="kmzForearm">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Armhole</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtarmhole"
                                              id="kmzForearm">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Cuff</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="shirtcuff"
                                              id="kmzForearm">
                                   </div>
                                </div>
                            </div>
                            <div class="shalwar">
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Kameez Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzLength"
                                              id="kmzLength">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Kurta Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kurtaLength"
                                              id="kmzLength">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Shoulder</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzShoulder"
                                              id="kmzShoulder">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Sleeves Length</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzSleeves"
                                              id="kmzSleeves">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Neck</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzNeck"
                                              id="kmzNeck">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Chest</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzChest"
                                              id="kmzChest">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Waist</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzWaist"
                                              id="kmzWaist">
                                   </div>
                               </div>
                               <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Hip</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input " name="kmzHips"
                                              id="kmzHips">
                                   </div>
                               </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Bicep</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzBicep"
                                              id="kmzBicep">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Forearm</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzForearm"
                                              id="kmzForearm">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Armhole</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzarmhole"
                                              id="kmzForearm">
                                   </div>
                                </div>
                                <div class="form-group row mt-1">
                                  <label class="col-sm-5 col-form-label"
                                    for="name">Cuff</label>

                                   <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control margin-bottom b_input" name="kmzcuff"
                                              id="kmzForearm">
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 only_shirt"  style="display:none;">
                        <h5 class="title text-center">Checks</h5>
                        <div class="cus-bor">
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_darts" id="darts">
                                            <label class="custom-control-label" for="darts">Darts</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="sleeve_placket">
                                            <label class="custom-control-label" for="sleeve_placket">Sleeve placket button</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_front_placket" id="front_placket">
                                            <label class="custom-control-label" for="front_placket">Front placket</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_plane_placket" id="plane_placket">
                                            <label class="custom-control-label" for="plane_placket"> Plane Front</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="button_cuff">
                                            <label class="custom-control-label" for="button_cuff">Button Cuff </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_plain_cuff" id="plain_cuff">
                                            <label class="custom-control-label" for="plain_cuff"> Plain Cuff</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="french_cuff">
                                            <label class="custom-control-label" for="french_cuff">French Cuff</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_double_cuff" id="double_cuff">
                                            <label class="custom-control-label" for="double_cuff">Double Cuff</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 pl-0 shalwar"  style="display:none;">                    
                        <h5 class="title text-center">SHALWAR / PAJAMA</h5>
                        <div class="cus-bor">
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Length</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlLength"
                                          id="shlLength">
                               </div>
                            </div>
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Bottom</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlBottom"
                                          id="shlBottom">
                               </div>
                            </div>
                         
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Asan Tyar</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlAsanTyar"
                                          id="shlAsanTyar">
                               </div>
                            </div>
                          
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Shalwar Gaira Tyar</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="shlGairaTyar"
                                          id="shlGairaTyar">
                               </div>
                            </div>

                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Pajama Length</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pjamaLength"
                                          id="shlLength">
                               </div>
                            </div>
                            <div class="form-group row mt-1">
                              <label class="col-sm-5 col-form-label"
                                for="name">Pajama Bottom</label>

                               <div class="col-sm-6">
                                   <input type="text"
                                          class="form-control margin-bottom b_input " name="pjamaBottom"
                                          id="shlBottom">
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 pl-0 shalwar"  style="display:none;">                    
                        <h5 class="title text-center">Checks</h5>
                        <div class="cus-bor">
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_collar" id="collar">
                                            <label class="custom-control-label" for="collar">Collar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_moon_neck" id="moon_neck">
                                            <label class="custom-control-label" for="moon_neck">Moon Neck</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_straight_front" id="straight_front">
                                            <label class="custom-control-label" for="straight_front">Straight Front</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_1side_pocket" id="1side_pocket">
                                            <label class="custom-control-label" for="1side_pocket">1 side pocket</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_2side_pocket" id="2side_pocket">
                                            <label class="custom-control-label" for="2side_pocket">2 side pocket</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_fancy_button" id="fancy_button">
                                            <label class="custom-control-label" for="fancy_button">Fancy Button</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_french_cuff" id="is_french_cuff">
                                            <label class="custom-control-label" for="is_french_cuff">French Cuff</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-1 pl-0 shalwar"  style="display:none;">                    
                        <h5 class="title text-center">Checks</h5>
                        <div class="cus-bor">
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_band" id="is_band">
                                            <label class="custom-control-label" for="is_band">Band</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_round_front" id="is_round_front">
                                            <label class="custom-control-label" for="is_round_front">Round Front</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_front_pocket" id="is_front_pocket">
                                            <label class="custom-control-label" for="is_front_pocket">Front Pocket</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_shalwar_pocket" id="is_shalwar_pocket">
                                            <label class="custom-control-label" for="is_shalwar_pocket">Shalwar Pocket</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_sleeve_placket" id="is_sleeve_placket">
                                            <label class="custom-control-label" for="is_sleeve_placket">Sleeve Placket Button</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_covered_fly" id="is_covered_fly">
                                            <label class="custom-control-label" for="is_covered_fly">Covered Fly</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_plain_button" id="is_plain_button">
                                            <label class="custom-control-label" for="is_plain_button">Plain Button</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_button_cuff" id="is_button_cuff">
                                            <label class="custom-control-label" for="is_button_cuff">Button Cuff</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row  mt-1">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="is_open_sleeves" id="is_open_sleeves">
                                            <label class="custom-control-label" for="is_open_sleeves">Open Sleeves</label>
                                        </div>
                                    </div>
                                </div>
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
                      <textarea class="form-control" name="inst" rows="7" id="comment"></textarea>
                    </div>
                  </div>
                </div> 
                
                <div class="row mt-1 only_shirt" style="display: none;">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email" class="col-form-label">Shirts Instructions:</label>
                      <textarea class="form-control" name="shirt_inst" rows="7" id="comment"></textarea>
                    </div>
                  </div>
                </div> 
                
                <div class="row mt-1 shalwar" style="display: none;">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email" class="col-form-label">Shalwar Kameez Instructions:</label>
                      <textarea class="form-control" name="shalwar_inst" rows="7" id="comment"></textarea>
                    </div>
                  </div>
                </div> 
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

<script type="text/javascript">
    function cal_blace(){
      var total = $("#total").val();
      var adv = $("#adv").val();

      $("#blance").val(total - adv);
    }

    
    $("#bDate").datepicker();
    $( "#tDate" ).datepicker();
    $( "#dDate" ).datepicker();

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
                $(".shalwar").hide(); 
            }else if($(this).is(":checked") && $(this).val() == 'shalwarqameez'){
                
                $('#shirts').prop('checked', false);
                $('#suiting').prop('checked', false);

                $(".coat_waistCoat").hide();
                $(".pant").hide();
                $(".only_shirt").hide();
                $(".shirt_qameez").show();  
                $(".shalwar").show();
            }

            if($(this).is(":checked") && $(this).val() == 'english'){
                $('#urdu').prop('checked', false);
            }else if($(this).is(":checked") && $(this).val() == 'urdu'){
                $('#english').prop('checked', false);
            }
        }); 
    });

    
</script>

