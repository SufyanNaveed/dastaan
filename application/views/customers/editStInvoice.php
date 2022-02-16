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
                                      class="form-control margin-bottom b_input required" name="or_ref_no"
                                      id="ref_no" readonly="" value="<?php echo $customer['reference_id']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Booking Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input required" name="booking_date"
                                      id="bDate" value="<?php echo date("Y,m,d", strtotime($customer['booking_date'])); ?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Trial Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input required" name="t_date"
                                      id="tDate" value="<?php echo date("Y,m,d", strtotime($customer['trial_date'])); ?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Delivery Date</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input required" name="d_date"
                                      id="dDate" value="<?php echo date("Y,m,d", strtotime($customer['d_date'])); ?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Customer Name</label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control required margin-bottom b_input " name="customer_name"
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
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>TOTAL</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input cal_blanc required" name="total"
                                      id="total" onfocusout="cal_blace()" value="<?php echo $customer['total']?>">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name"><strong>ADVANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text" class="form-control margin-bottom b_input cal_blanc required" name="advance" id="adv" onfocusout="cal_blace()" value="<?php echo $customer['pamnt']?>">
                           </div>
                       </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label" for="name"><strong>BLANCE</strong></label>

                           <div class="col-sm-7">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="BLANCE"
                                      id="blance" readonly="" value="<?php echo $customer['total'] - $customer['pamnt'] ?>">
                           </div>
                       </div>
                    </div> 
                  </div>
                  <div class="col-md-3 pl-0">

                    <h5 class="title text-center">COAT / WAIST COAT</h5>
                    <div class="cus-bor cus-height">
                      <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Length</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="cLength"
                                      id="cLength" value="<?php echo $customer['coat_length']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Sleeves</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input" name="cSleeves"
                                      id="cSleev" value="<?php echo $customer['coat_sleeves']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Shoulder</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cShoulder"
                                      id="cShoulder" value="<?php echo $customer['coat_shoulder']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Half Back</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cHalfBack"
                                      id="cHalfBack" value="<?php echo $customer['coat_half_back']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Cross Back</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cCrossBack"
                                      id="cCrossBack" value="<?php echo $customer['coat_cross_back']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Chest</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cChest"
                                      id="cChest" value="<?php echo $customer['coat_chest']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Waist</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cWaist"
                                      id="cWaist" value="<?php echo $customer['coat_waist']?>">
                           </div>
                       </div>
                       <!-- <div class="form-group row mt-1">
                          <label class="col-sm-4 col-form-label"
                            for="name">Hip</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="cHips"
                                      id="cHips">
                           </div>
                       </div> -->
                       <div class="form-group row  mt-1">
                          <div class="col-md-12">
                              <div class="input-group">
                               <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="is_coat" id="coat" <?php echo ($customer['is_coat'])?"checked":'';?> >
                                   <label class="custom-control-label"
                                          for="coat">COAT</label>
                               </div>
                             </div>
                          </div>
                       </div>
                       <div class="form-group row  mt-1">
                          <div class="col-md-12">
                            <div class="input-group">
                               <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="is_wCoat" id="wCoat" <?php echo ($customer['is_waist_coat'])?"checked":'';?>>
                                   <label class="custom-control-label"
                                          for="wCoat">WAIST COAT</label>
                               </div>
                             </div>
                          </div>
                       </div>
                    </div>   
                  </div>
                  <div class="col-md-3 pl-0">
                    <h5 class="title text-center">PANT</h5>
                    <div class="cus-bor cus-height">
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
                            for="name">Inside Length</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="pInLength"
                                      id="pInLength" value="<?php echo $customer['pant_inside_length']?>">
                           </div>
                       </div>
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
                            for="name">Bottom</label>

                           <div class="col-sm-4">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="pBottom"
                                      id="pBottom" value="<?php echo $customer['pant_bottom']?>">
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
                    </div>
                  </div>
                  <div class="col-md-2 pl-0">
                    <h5 class="title text-center">KAMIZ / SHIRT</h5>
                    <div class="cus-bor">
                      <div class="form-group row mt-1">
                          <label class="col-sm-5 col-form-label"
                            for="name">Length</label>

                           <div class="col-sm-6">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="kmzLength"
                                      id="kmzLength" value="<?php echo $customer['kmz_length']?>">
                           </div>
                       </div>
                       <div class="form-group row mt-1">
                          <label class="col-sm-5 col-form-label"
                            for="name">Sleeves</label>

                           <div class="col-sm-6">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="kmzSleeves"
                                      id="kmzSleeves" value="<?php echo $customer['kmz_sleeves']?>">
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
                            for="name">Guaira</label>

                           <div class="col-sm-6">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="kmzGuaira"
                                      id="kmzGuaira" value="<?php echo $customer['kmz_guaira']?>">
                           </div>
                       </div>
                        <div class="form-group row  mt-1">
                          <div class="col-md-12">
                             <div class="input-group">
                               <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="is_kamz" id="kmz" <?php echo ($customer['is_kmz'])?"checked":'';?>>
                                   <label class="custom-control-label"
                                          for="kmz">KAMIZ</label>
                               </div>
                             </div>
                          </div>
                       </div>
                       <div class="form-group row  mt-1">
                          <div class="col-md-12">
                             <div class="input-group">
                               <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" name="is_shirt" id="shirt" <?php echo ($customer['is_shirt'])?"checked":'';?>>
                                   <label class="custom-control-label"
                                          for="shirt">SHIRT</label>
                               </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <h5 class="title text-center mt-1">SHALWAR</h5>
                      <div class="cus-bor">
                        <div class="form-group row mt-1">
                          <label class="col-sm-5 col-form-label"
                            for="name">Length</label>

                           <div class="col-sm-6">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="shlLength"
                                      id="shlLength" value="<?php echo $customer['shl_length']?>">
                           </div>
                        </div>
                        <div class="form-group row mt-1">
                          <label class="col-sm-5 col-form-label"
                            for="name">Bottom</label>

                           <div class="col-sm-6">
                               <input type="text"
                                      class="form-control margin-bottom b_input " name="shlBottom"
                                      id="shlBottom" value="<?php echo $customer['shl_bottom']?>">
                           </div>
                        </div>
                      </div>
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="email" class="col-form-label">Instrucations:</label>
                      <textarea class="form-control" name="inst" rows="7" id="comment"><?php echo $customer['instrucations']?></textarea>
                    </div>
                  </div>
                </div>
                <div id="mybutton" class="mt-1">
                    <input type="submit" id="submit-data"
                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                           value="Edit Customer"
                           data-loading-text="Adding...">
                </div>
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="hidden" name="csd" value="<?php echo  $customer['cus_id']?>">
               <input type="hidden" value="customers/editStInvoice" id="action-url">

               
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
    
    $( "#bDate" ).datepicker("setDate", new Date($('#bDate').val()));

    $( "#tDate" ).datepicker("setDate", new Date($('#tDate').val()));

    $( "#dDate" ).datepicker("setDate", new Date($('#dDate').val()));

</script>

