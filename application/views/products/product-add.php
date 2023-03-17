<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Add New Product') ?></h5>
            <hr>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">
                <form method="post" id="data_form" >
                    <input type="hidden" name="act" value="add_product">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"
                               for="party_name"><?php echo $this->lang->line('Clothing') ?>*</label>
                        <div class="col-sm-6">
                            <select name="product_type" class="form-control" onchange="updateCatogery()" id="select_type" >
                                <?php
                                foreach ($cat as $row) {
                                    $cid = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="party_name"><?php echo $this->lang->line('Party Name') ?>*</label>

                        <div class="col-sm-6">
                            <select name="party_name" class="form-control">
                                <?php
                                    foreach ($suppliers as $row) {
                                        $cid = $row['id'];
                                        $title = $row['name'];
                                        echo "<option value='$cid'>$title</option>";
                                        }
                                ?>
                            </select>
                        </div>
                    </div>
<!--                    <div class="form-group row">-->
<!---->
<!--                        <label class="col-sm-2 col-form-label"-->
<!--                               for="company_name">--><?php //echo $this->lang->line('Company Name') ?><!--*</label>-->
<!---->
<!--                        <div class="col-sm-6">-->
<!--                            <input type="text" placeholder="Company Name"-->
<!--                                   class="form-control margin-bottom required" name="company_name">-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Product Name') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Name"
                                   class="form-control margin-bottom required" name="product_name">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_cat"><?php echo $this->lang->line('Warehouse') ?>*</label>

                        <div class="col-sm-6">
                            <select name="product_warehouse" class="form-control">
                                <?php
                                foreach ($warehouse as $row) {
                                    $cid = $row['id'];
                                    $title = $row['title'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>


                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_code"><?php echo $this->lang->line('Product Code') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Code"
                                   class="form-control" name="product_code">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="color"><?php echo $this->lang->line('Color') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Color"
                                   class="form-control" name="color">
                        </div>
                    </div>

                    <div class="form-group row" id="mea_unit">
                        <label class="col-sm-2 col-form-label"
                               for="product_cat"><?php echo $this->lang->line('Measurement Unit') ?>*</label>
                        <div class="col-sm-6">
                            <select name="unit" class="form-control" id="measurement" onchange="myFocusFunction()">
                                <?php
                                foreach ($units as $row) {
                                    $cid = $row['code'];
                                    $title = $row['name'];
                                    echo "<option value='$cid'>$title</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"
                               for="than" id="than_quantity"><?php echo $this->lang->line('Thans') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Thans"
                                   class="form-control" name="than" id="than" onkeypress="return isNumber(event)">
                        </div>
                    </div>
                    <div class="form-group row" id="product_length">

                        <label class="col-sm-2 col-form-label"
                               for="length"><?php echo $this->lang->line('Length') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Length"
                                   class="form-control" name="length" id="length" onkeypress="return isNumber(event)">
                        </div>
                        <div class="col-sm-4" id="tlength">


                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label"
                               for="product_price"><?php echo $this->lang->line('Price') ?>*</label>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                                <input type="text" name="product_price" class="form-control required"
                                       placeholder="0.00" aria-describedby="sizing-addon"
                                       onkeypress="return isNumber(event)">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Sale Price') ?></label>

                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                                <input type="text" name="sale_price" class="form-control"
                                       placeholder="0.00" aria-describedby="sizing-addon1"
                                       onkeypress="return isNumber(event)">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('BarCode') ?></label>
                        <div class="col-sm-2">
                            <select class="form-control" name="code_type">
                                <option value="EAN13">EAN13 - Default</option>
                                <option value="UPCA">UPC</option>
                                <option value="EAN8">EAN8</option>
                                <option value="ISSN">ISSN</option>
                                <option value="ISBN">ISBN</option>
                                <option value="C128A">C128A</option>
                                <option value="C39">C39</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" placeholder="BarCode Numeric Digit 123112345671"
                                   class="form-control margin-bottom" name="barcode"
                                   onkeypress="return isNumber(event)">
                            <small>Leave blank if you want auto generated in EAN13.</small>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"></label>

                        <div class="col-sm-4">
                            <input type="submit" id="submit-data" class="btn btn-lg btn-blue margin-bottom"
                                   value="<?php echo $this->lang->line('Add product') ?>" data-loading-text="Adding...">
                            <input type="hidden" value="products/addproduct" id="action-url">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/myjs/jquery.ui.widget.js'); ?>"></script>
<script src="<?php echo base_url('assets/myjs/jquery.fileupload.js') ?>"></script>
<script>
    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = '<?php echo base_url() ?>products/file_handling';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            formData: {'<?=$this->security->get_csrf_token_name()?>': crsf_hash},
            done: function (e, data) {
                var img = 'default.png';
                $.each(data.result.files, function (index, file) {
                    $('#files').html('<tr><td><a data-url="<?php echo base_url() ?>products/file_handling?op=delete&name=' + file.name + '" class="aj_delete"><i class="btn-danger btn-sm icon-trash-a"></i> ' + file.name + ' </a><img style="max-height:200px;" src="<?php echo base_url() ?>userfiles/product/' + file.name + '"></td></tr>');
                    img = file.name;
                });

                $('#image').val(img);
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

    $(document).on('click', ".aj_delete", function (e) {
        e.preventDefault();

        var aurl = $(this).attr('data-url');
        var obj = $(this);

        jQuery.ajax({

            url: aurl,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                obj.closest('tr').remove();
                obj.remove();
            }
        });

    });


    $(document).on('click', ".tr_clone_add", function (e) {
        e.preventDefault();
        var n_row = $('#v_var').find('tbody').find("tr:last").clone();

        $('#v_var').find('tbody').find("tr:last").after(n_row);

    });

    $(document).on('click', ".tr_delete", function (e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });

    var y = document.getElementById("than");
    y.addEventListener("blur", myFocusFunction, true);

    var x = document.getElementById("length");
    x.addEventListener("blur", myFocusFunction, true);

    function myFocusFunction() {
        if($('#length').val()){
            $no_than = $('#than').val();
            $length = $('#length').val();
            $mea = $('#measurement').find(":selected").text();
            $('#tlength').html('<strong><label class="col-form-label" for="length"> <?php echo $this->lang->line('Total').' '.$this->lang->line('Length').': '  ?>'+$no_than * $length+ ' '+$mea+'</label></strong>');
        }
        else{
            $('#tlength').html('');
        }
    }
    updateCatogery();

    /*to update than or quantity*/
    function updateCatogery(){
        $select_type = $('#select_type').find(":selected").text();
        if($select_type == 'Than' || $select_type == 'than'){
            $('#than_quantity').html('<?php echo $this->lang->line('Thans')?>');
            $('#than').attr("placeholder", "Thans");
            $('#product_length').show();
            $('#mea_unit').show();
            $('#length').val('');
        }else{
            $('#than_quantity').html('<?php echo $this->lang->line('Quantity')?>');
            $('#than').attr("placeholder", "Enter Quantity");
            $('#product_length').hide();
            $('#mea_unit').hide();
            $('#length').val(1);
        } 
    }
</script>

