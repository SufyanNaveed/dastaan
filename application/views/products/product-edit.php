<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Edit Product') ?></h5>
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
                <form method="post" id="data_form" class="form-horizontal">


                    <input type="hidden" name="pid" value="<?php echo $product['pid'] ?>">

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_cat"><?php echo $this->lang->line('Clothing') ?>*</label>

                        <div class="col-sm-6">
                            <select name="product_type" class="form-control" id="select_type" onchange="updateCatogery()">
                                <?php
                                echo '<option value="' . $cat_ware['cid'] . '">' . $cat_ware['catt'] . '</option>';
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
                               for="product_cat"><?php echo $this->lang->line('Party Name') ?>*</label>

                        <div class="col-sm-6">
                            <select name="party_name" class="form-control">
                                <?php
                                echo '<option value="' . $pro_sup->id . '">' . $pro_sup->name . ' (S)</option>';
                                    foreach ($suppliers as $row) {
                                        $cid = $row['id'];
                                        $title = $row['name'];
                                        echo "<option value='$cid'>$title</option>";
                                        }
                                    ?>
                            </select>


                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_name"><?php echo $this->lang->line('Product Name') ?>*</label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Name"
                                   class="form-control margin-bottom  required" name="product_name"
                                   value="<?php echo $product['product_name'] ?>">
                        </div>
                    </div>
                    
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"
                               for="product_cat"><?php echo $this->lang->line('Warehouse') ?>*</label>

                        <div class="col-sm-6">
                            <select name="product_warehouse" class="form-control">
                                <?php
                                echo '<option value="' . $cat_ware['wid'] . '">' . $cat_ware['watt'] . ' (S)</option>';
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
                               for="product_code"><?php echo $this->lang->line('Product Code') ?></label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Code"
                                   class="form-control" name="product_code"
                                   value="<?php echo $product['product_code'] ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"
                               for="product_code"><?php echo $this->lang->line('Color') ?></label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Code"
                                   class="form-control" name="color"
                                   value="<?php echo $product['color'] ?>">
                        </div>
                    </div>

                    <div class="form-group row" id="mea_unit">

                        <label class="col-sm-2 col-form-label"
                               for="product_cat"><?php echo $this->lang->line('Measurement Unit') ?>*</label>

                       <div class="col-sm-4">
                            <select name="unit" class="form-control">
                                <?php
                                echo "<option value='" . $pro_unit->code . "'>" .$pro_unit->name." (S)</option>";
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
                               for="product_code" id="than_quantity"><?php echo $this->lang->line('Thans') ?></label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Code"
                                   class="form-control" name="than" id="than"
                                   value="<?php echo $product['pro_than_qty'] ?>" suit-qty = "<?php echo $product['qty'] ?>">
                        </div>
                    </div>
                     <div class="form-group row" id="product_length">
                        <label class="col-sm-2 col-form-label"
                               for="product_code"><?php echo $this->lang->line('Length') ?></label>

                        <div class="col-sm-6">
                            <input type="text" placeholder="Product Code"
                                   class="form-control" name="length" id="length"
                                   value="<?php echo $product['pro_than_len'] ?>">
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
                                       onkeypress="return isNumber(event)"
                                       value="<?php echo $product['fproduct_price'] ?>">
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
                                       onkeypress="return isNumber(event)"
                                       value="<?php echo $product['product_price'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Alert Quantity') ?></label>

                        <div class="col-sm-4">
                            <input type="number" placeholder="Low Stock Alert Quantity"
                                   class="form-control margin-bottom" name="product_qty_alert"
                                   value="<?php echo $product['alert'] ?>"
                                   onkeypress="return isNumber(event)">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('BarCode') ?></label>
                        <div class="col-sm-2">
                            <select class="form-control" name="code_type">
                                <?php echo $product['barcode'] ?>
                                <option value="  <?php echo $product['code_type'] ?>">  <?php echo $product['code_type'] ?>
                                    *
                                </option>
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
                                   value="<?php echo $product['barcode'] ?>"
                                   onkeypress="return isNumber(event)">

                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="image" id="image" value="<?php echo $product['image'] ?>">
                        <label class="col-sm-2 col-form-label"></label>

                        <div class="col-sm-4">
                            <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                                   value="<?php echo $this->lang->line('Update') ?>"
                                   data-loading-text="Updating...">
                            <input type="hidden" value="products/editproduct" id="action-url">
                        </div>
                    </div>


                </form>
            </div>
        </div>

        <script src="<?php echo assets_url('assets/myjs/jquery.ui.widget.js');
        $invoice['tid'] = 0; ?>"></script>
        <script src="<?php echo assets_url('assets/myjs/jquery.fileupload.js') ?>"></script>
        <script>
            /*jslint unparam: true */
            /*global window, $ */
            $(function () {
                'use strict';
                // Change this to the location of your server-side upload handler:
                var url = '<?php echo base_url() ?>products/file_handling?id=<?php echo $invoice['tid'] ?>';
                $('#fileupload').fileupload({
                    url: url,
                    dataType: 'json',
                    formData: {'<?=$this->security->get_csrf_token_name()?>': crsf_hash},
                    done: function (e, data) {
                        var img = 'default.png';
                        $.each(data.result.files, function (index, file) {
                            $('#files').html('<tr><td><a data-url="<?php echo base_url() ?>products/file_handling?op=delete&name=' + file.name + '&invoice=<?php echo $invoice['tid'] ?>" class="aj_delete"><i class="btn-danger btn-sm icon-trash-a"></i> ' + file.name + ' </a><img style="max-height:200px;" src="<?php echo base_url() ?>userfiles/product/' + file.name + '"></td></tr>');
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

            updateCatogery();

    /*to update than or quantity*/
    function updateCatogery(){
        $select_type = $('#select_type').find(":selected").text();
        if($select_type == 'Than' || $select_type == 'than'){
            $('#than_quantity').html('<?php echo $this->lang->line('Thans')?>');
            $('#than').attr("placeholder", "Thans");
            $('#product_length').show();
            $('#mea_unit').show();
        }else{
            $('#than_quantity').html('<?php echo $this->lang->line('Quantity')?>');
            $('#than').attr("placeholder", "Enter Quantity");
            $('#than').val($('#than').attr('suit-qty'));
            $('#product_length').hide();
            $('#mea_unit').hide();
        }
    }
        </script>
