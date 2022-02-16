<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tailor Slip #<?php echo $nap['reference_id'];  ?></title>
    <style>
        body {
            color: #2B2000;
            font-family: 'Helvetica';
            height: 100%;
        }

        .invoice-box {
            width: 500mm;
            height: 130mm;
            /*margin: auto;*/
            /*padding: 1mm;*/
            border: 0;
            font-size: 12pt;
            line-height: 14pt;
            color: #000;
        }



        table {
            width: 100%;
            line-height: 16pt;
            text-align: left;
            border-collapse: collapse;
        }

        .plist tr td {
            line-height: 12pt;
        }

        .subtotal tr td {
            line-height: 10pt;
            padding: 6pt;
        }

        .subtotal tr td {
            border: 1px solid #ddd;
        }

        .sign {
            text-align: right;
            font-size: 10pt;
            margin-right: 110pt;
        }

        .sign1 {
            text-align: right;
            font-size: 10pt;
            margin-right: 90pt;
        }

        .sign2 {
            text-align: right;
            font-size: 10pt;
            margin-right: 115pt;
        }

        .sign3 {
            text-align: right;
            font-size: 10pt;
            margin-right: 115pt;
        }

        .terms {
            font-size: 9pt;
            line-height: 16pt;
            margin-right: 20pt;
        }

        .invoice-box table td {
            padding: 10pt 4pt 8pt 4pt;
            vertical-align: top;

        }

        .invoice-box table.top_sum td {
            padding: 0;
            font-size: 12pt;
        }

        .party tr td:nth-child(3) {
            text-align: center;
        }

        .order-info tr td:nth-child(2){
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20pt;

        }

        table tr.top table td.title {
            font-size: 45pt;
            line-height: 45pt;
            color: #555;
        }

        table tr.information table td {
            padding-bottom: 20pt;
        }

        table tr.heading td {
            background: #515151;
            color: #FFF;
            padding: 6pt;

        }

        table tr.details td {
            padding-bottom: 20pt;
        }

        .invoice-box table tr.item td {
            border: 1px solid #ddd;
        }

        table tr.b_class td {
            border-bottom: 1px solid #ddd;
        }

        table tr.b_class.last td {
            border-bottom: none;
        }

        table tr.total td:nth-child(4) {
            border-top: 2px solid #fff;
            font-weight: bold;
        }

        .myco {
            width: 400pt;
        }

        .myco2 {
            width: 200pt;
        }

        .myw {
            width: 150pt;
            font-size: 14pt;
            line-height: 14pt;
        }

        .mfill {
            background-color: #eee;
        }

        .descr {
            font-size: 10pt;
            color: #515151;
        }

        .tax {
            font-size: 10px;
            color: #515151;
        }

        .t_center {
            text-align: right;
        }

        .c_center{
            text-align: center;
        }

        .party {
            border: #ccc 1px solid;
        }

        .top_logo {
            max-height: 180px;
            max-width: 250px;


        }

        .fTb{
            margin-left: 12px;
            padding-left: 12px;
        }
        .first-item{

            display: inline-block;
            margin-right: 20px;
        }

        .second-item{
            margin-left: 15px;
            padding-left: 15px;
        }

        
        .invoice-box table.order_detail td {
            padding: 0;
            padding-bottom: 6px;
            
        }

         .invoice-box table.order_detail tr{
            border: none;
         }

         .invoice-box table.order_detail td{
            border: none;
         }

        table tr .shl td {
            background: #515151;
            color: #FFF;
            padding: 6pt;

        }

        .amount-details{
            border:  #ccc 1px solid;

        }
         .invoice-box table.amount td {
            padding: 0;
            padding-bottom: 2px;
        }
    </style>
</head>

<body>
<table class="fTb">
    <tr>
        <td colspan="3" class="c_center"><h2>DASTAAN</h2></td>
    </tr>
    <tr>
        <td class="myw">
            <table class="top_sum">
                <tr>
                    <td width="130px">Booking Date:</td>
                    <td><?php echo date("d/m/Y", strtotime($nap['booking_date'])); ?></td>
                </tr>
            </table>
        </td>
        <td class="myw">
            <table class="top_sum">
                 <tr>
                    <td width="130px"><strong>REF NO:</strong></td>
                    <td><h3><?php echo $nap['reference_id']; ?></h3></td>
                </tr>
            </table>
        </td>
        <td class="myw">
            <table class="top_sum">
                 <tr>
                    <td width="130px">Trail Date:</td>
                    <td><?php echo date("d/m/Y", strtotime($nap['trial_date'])); ?></td>
                </tr>
                <tr>
                    <td width="130px">Delivery Date:</td>
                    <td><?php echo date("d/m/Y", strtotime($nap['d_date'])); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div class="invoice-box">


    <br>
    <table class="party plist" cellpadding="0" cellspacing="0">
        <thead>
        <tr class="heading">
            <?php if($nap['is_suiting'] == 1){ ?>
                <td style="width: 12rem; text-align: center;"><strong>COAT / WAIST COAT</strong></td>
                <td style="width: 12rem;text-align: center;"><strong>PANT</strong></td>
            <?php } if($nap['is_shirts'] == 1 ){ ?>
                <td style="width: 12rem;text-align: center;"><strong>SHIRT</strong></td>
            <?php } if($nap['is_shalwarqameez'] == 1){ ?>
                <td style="width: 12rem;text-align: center;"><strong> KAMIZ / KURTA</strong></td>
                <td style="width: 12rem;text-align: center;"><strong> SHALWAR / PAJAMA</strong></td>
            <?php } ?>
            <td style="width: 12rem;text-align: center;"><strong>CHECKS</strong></td>
            <td style=" text-align: center;"><strong>INSTRUCATIONS</strong></td>
        </tr>
        </thead>
        <tbody>
            <tr class="item" >
                <?php if($nap['is_suiting'] == 1){ ?>
                    <td>
                        <table class="order_detail">
                            <?php if($nap['coat_neck']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Neck' :'گردن ' ?></strong></td>
                                    <td><?php echo $nap['coat_neck']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_chest']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Chest': 'چھاتی ' ?></strong></td>
                                    <td><?php echo $nap['coat_chest']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_waist']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Belly Waist': 'کمر ' ?></strong></td>
                                    <td><?php echo $nap['coat_waist']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_hip']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Hip ' : ' ہپ  '?></strong></td>
                                    <td><?php echo $nap['coat_hip']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_shoulder']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Shoulder ' : ' تیر ہ'?></strong></td>
                                    <td><?php echo $nap['coat_shoulder']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_sleeves']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Sleeves ' : ' بازو'?></strong></td>
                                    <td><?php echo $nap['coat_sleeves']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_bicep']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Bicep ' : ' ڈولہ'?></strong></td>
                                    <td><?php echo $nap['coat_bicep']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_forearm']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Forearm ' : ' کونی'?></strong></td>
                                    <td><?php echo $nap['coat_forearm']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_half_back']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Half Back ' : ' نصف کمر'?></strong></td>
                                    <td><?php echo $nap['coat_half_back']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_cross_back']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Cross Back' : ' کراس کمر '?></strong></td>
                                    <td><?php echo $nap['coat_cross_back']; ?></td>
                                </tr>
                            <?php }  if($nap['coat_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Coat Length ' : 'کوٹ لمبائی   '?></strong></td>
                                    <td><?php echo $nap['coat_length']; ?></td>
                                </tr>
                            <?php }  if($nap['p3_waistcoat_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? '3p waistcoat Length ' : ' تھری پیس واسکٹ لمبائی ' ?></strong></td>
                                    <td><?php echo $nap['p3_waistcoat_length']; ?></td>
                                </tr>
                            <?php }  if($nap['waistcoat_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Waistcoat Length ' : 'واسکٹ لمبائی '?></strong></td>
                                    <td><?php echo $nap['waistcoat_length']; ?></td>
                                </tr>
                            <?php }  if($nap['princecoat_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Princecoat Length ' : 'پرنس کوٹ لمبائی'?></strong></td>
                                    <td><?php echo $nap['princecoat_length']; ?></td>
                                </tr>
                            <?php }  if($nap['sherwani_length']){ ?>                            
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Sherwani Length ' : 'شیروانی  لمبائی'?></strong></td>
                                    <td><?php echo $nap['sherwani_length']; ?></td>
                                </tr>
                            <?php }  if($nap['longcoat_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Longcoat Length ' : 'لمبا کوٹ لمبائی'?></strong></td>
                                    <td><?php echo $nap['longcoat_length']; ?></td>
                                </tr>
                            <?php }  if($nap['chester_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Chester Length ' : 'چیسٹر لمبائی'?></strong></td>
                                    <td><?php echo $nap['chester_length']; ?></td>
                                </tr>
                            <?php }  if($nap['armhole']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Armhole' : 'آرم ہول' ?></strong></td>
                                    <td><?php echo $nap['armhole']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td>
                        <table class="order_detail">
                            <?php if($nap['pant_waist']){ ?>                        
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Waist ' : ' کمر '?></strong></td>
                                    <td><?php echo $nap['pant_waist']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_hip']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Hip ' : ' ہپ '?></strong></td>
                                    <td><?php echo $nap['pant_hip']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_thigh']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Thigh ' : 'گھیر '?></strong></td>
                                    <td><?php echo $nap['pant_thigh']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_knee']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Knee ' : ' گھٹنے'?></strong></td>
                                    <td><?php echo $nap['pant_knee']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_inside_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Inseam ' : ' اندرونی لمبائی'?></strong></td>
                                    <td><?php echo $nap['pant_inside_length']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_length']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Length ' : ' لمبائی'?></strong></td>
                                    <td><?php echo $nap['pant_length']; ?></td>
                                </tr>
                            <?php }  if($nap['pant_bottom']){ ?>
                                <tr>
                                    <td><strong><?= $nap['is_english'] == 1 ? 'Bottom ' : ' پا ئنچہ'?></strong></td>
                                    <td><?php echo $nap['pant_bottom']; ?></td>
                                </tr> 
                            <?php } ?>
                        </table>
                    </td>
                    <td>
                        <table class="order_detail">
                            <?php if($nap['is_breasted'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Single breasted' : 'سنگل بریسٹڈ '?></td>
                                </tr>
                            <?php } if($nap['is_double_breasted'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Double breasted' : 'ڈبل بریسٹڈ ' ?></td>
                                </tr>
                            <?php } if($nap['is_button_suit'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'One button suit' : 'ایک بٹن ' ?> </td>
                                </tr>
                            <?php } if($nap['is_two_button_suit'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? '2 button suit' : 'دو بٹن ' ?></td>
                                </tr>
                            <?php } if($nap['is_lapel'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Notch lapel' : 'نوچ لیپل ' ?></td>
                                </tr>
                            <?php }  if($nap['is_peak_lapel'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Peak lapel' : 'پیک لیپل ' ?></td>
                                </tr>
                            <?php } if($nap['is_shawl_lapel'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Shawl lapel' : 'شال لیپل ' ?></td>
                                </tr>
                            <?php } if($nap['is_wear'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Formal suit' : 'فارمل سوٹ ' ?></td>
                                </tr>
                            <?php } if($nap['is_casual_wear'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Casual wear' : 'کییول سوٹ ' ?>r</td>
                                </tr>
                            <?php } if($nap['is_groom_wear'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Grooms wear' : 'گروم سوٹ ' ?></td>
                                </tr>
                            <?php }  if($nap['is_vent'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Single vent' : 'سنگل کٹ ' ?></td>
                                </tr>
                            <?php } if($nap['is_double_vent'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Double vents' : 'ڈبل کٹ ' ?></td>
                                </tr>
                            <?php } if($nap['is_no_vent'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'No vent' : 'سادہ بیک ' ?></td>
                                </tr>
                            <?php } if($nap['is_lined'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Fully lined' : 'فل استر ' ?></td>
                                </tr>
                            <?php }  if($nap['is_half_lined'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Half lined' : 'ھاف استر ' ?></td>
                                </tr>
                            <?php }  if($nap['is_ticket'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Ticket pocket' : 'ٹکٹ پاکٹ ' ?></td>
                                </tr>
                            <?php }  if($nap['is_slant'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Slant pocket' : 'سلانٹ پاکٹ ' ?></td>
                                </tr>
                            <?php }   if($nap['is_regular'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Regular pockets' : 'ریگولر پاکٹ ' ?></td>
                                </tr>
                            <?php }  if($nap['is_button'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Plain button' : ' سادہ بٹن  '  ?></td>
                                </tr>
                            <?php } if($nap['is_metalic_button'] == 1){ ?>
                                <tr>
                                    <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Metallic buttons' : 'مٹیلک بٹن ' ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                <?php } else { ?>
                    <td>
                        <table class="order_detail">
                            <?php if($nap['is_shirts'] == 1){ ?>
                                <?php if($nap['shirtLength']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Shirt Length ' : 'شرٹ  لمبائی'?></strong></td>
                                        <td><?php echo $nap['shirtLength']; ?></td>
                                    </tr>
                                <?php }  if($nap['shirtShoulder']){ ?> 
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Shoulder ' : ' کندھا'?></strong></td>
                                        <td><?php echo $nap['shirtShoulder']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtSleeves']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Sleeves ' : ' بازو'?></strong></td>
                                        <td><?php echo $nap['shirtSleeves']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtNeck']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Neck ' : ' کالر '?></strong></td>
                                        <td><?php echo $nap['shirtNeck']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtChest']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Chest ' : ' چھاتی'?></strong></td>
                                        <td><?php echo $nap['shirtChest']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtWaist']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Belly Waist ' : ' کمر '?></strong></td>
                                        <td><?php echo $nap['shirtWaist']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtHips']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Hip ' : ' ہپ '?></strong></td>
                                        <td><?php echo $nap['shirtHips']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtBicep']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Bicep ' : ' ڈولہ'?></strong></td>
                                        <td><?php echo $nap['shirtBicep']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtForearm']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Forearm ' : ' کونی'?></strong></td>
                                        <td><?php echo $nap['shirtForearm']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtarmhole']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Armhole' : 'آرم ہول'  ?></strong></td>
                                        <td><?php echo $nap['shirtarmhole']; ?></td>
                                    </tr>
                                <?php } if($nap['shirtcuff']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Cuff' : 'کف  '?></strong></td>
                                        <td><?php echo $nap['shirtcuff']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php }  else { ?>
                                <?php if($nap['kmz_length']){ ?>                            
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Kameez Length ' : 'قمیض  لمبائی'?></strong></td>
                                        <td><?php echo $nap['kmz_length']; ?></td>
                                    </tr>
                                <?php } if($nap['kurtaLength']){ ?> 
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Kurta Length ' : 'کرتہ  لمبائی'?></strong></td>
                                        <td><?php echo $nap['kurtaLength']; ?></td>
                                    </tr>
                                <?php }  ?>                         
                                <?php if($nap['kmz_shoulder']){ ?> 
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Shoulder ' : ' کندھا'?></strong></td>
                                        <td><?php echo $nap['kmz_shoulder']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_sleeves']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Sleeves ' : ' بازو'?></strong></td>
                                        <td><?php echo $nap['kmz_sleeves']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_neck']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Neck ' : ' کالر '?></strong></td>
                                        <td><?php echo $nap['kmz_neck']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_chest']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Chest ' : ' چھاتی'?></strong></td>
                                        <td><?php echo $nap['kmz_chest']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_waist']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Belly Waist ' : ' کمر '?></strong></td>
                                        <td><?php echo $nap['kmz_waist']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_hip']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Hip ' : ' ہپ '?></strong></td>
                                        <td><?php echo $nap['kmz_hip']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_bicep']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Bicep ' : ' ڈولہ'?></strong></td>
                                        <td><?php echo $nap['kmz_bicep']; ?></td>
                                    </tr>
                                <?php } if($nap['kmz_forearm']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Forearm ' : ' کونی'?></strong></td>
                                        <td><?php echo $nap['kmz_forearm']; ?></td>
                                    </tr>
                                <?php } if($nap['kmzarmhole']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Armhole' : 'آرم ہول'  ?></strong></td>
                                        <td><?php echo $nap['kmzarmhole']; ?></td>
                                    </tr>
                                <?php } if($nap['kmzcuff']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Cuff' : 'کف  '?></strong></td>
                                        <td><?php echo $nap['kmzcuff']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </table>
                    </td>
                    <?php if($nap['is_shalwarqameez'] == 1){ ?>
                        <td>
                            <table class="order_detail">                        
                                <?php if($nap['shl_length']){ ?>
                                    <tr>
                                        <td style="padding-top: 10px;"><strong><?= $nap['is_english'] == 1 ? 'Shalwar Length ' : ' شلوارلمبائی'?></strong></td>
                                        <td style="padding-top: 10px;"><?php echo $nap['shl_length']; ?></td>
                                    </tr>
                                <?php } if($nap['shl_bottom']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Shalwar Bottom ' : 'شلوار  پا ئنچہ'?></strong></td>
                                        <td><?php echo $nap['shl_bottom']; ?></td>
                                    </tr>
                                <?php } if($nap['shl_AsanTyar']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Asan Tyar ' : ' آسن تیار'?></strong></td>
                                        <td><?php echo $nap['shl_AsanTyar']; ?></td>
                                    </tr>
                                <?php } if($nap['shl_GairaTyar']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Shalwar Guaira Tyar ' : ' شلوار گھیر تیار'?></strong></td>
                                        <td><?php echo $nap['shl_GairaTyar']; ?></td>
                                    </tr>
                                <?php } if($nap['pjamaLength']){ ?>
                                    <tr>
                                        <td style="padding-top: 10px;"><strong><?= $nap['is_english'] == 1 ? 'Pajama Length ' : 'پاجامہ لمبائی'?></strong></td>
                                        <td style="padding-top: 10px;"><?php echo $nap['pjamaLength']; ?></td>
                                    </tr>
                                <?php } if($nap['pjamaBottom']){ ?>
                                    <tr>
                                        <td><strong><?= $nap['is_english'] == 1 ? 'Pajama Bottom ' : ' پاجامہ پا ئنچہ'?></strong></td>
                                        <td><?php echo $nap['pjamaBottom']; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    <?php  } ?>
                    <td>
                        <table class="order_detail">
                            <?php if($nap['is_shirts'] == 1){?>
                                <?php if($nap['is_darts'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Darts' : 'ڈارٹس ' ?></td>
                                    </tr>
                                <?php } if($nap['is_sleeve_placket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Sleeve placket button' : 'چاک پٹی بٹن ' ?></td>
                                    </tr>
                                <?php } if($nap['is_front_placket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Front placket' : 'بکرم پٹی ' ?></td>
                                    </tr>
                                <?php } if($nap['is_plane_placket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Plane front' : 'سادہ پٹی ' ?></td>
                                    </tr>
                                <?php } if($nap['is_button_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Button Cuff' : 'بٹن کف ' ?></td>
                                    </tr>
                                <?php } if($nap['is_plain_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Plain Cuff' : 'سادہ کف ' ?></td>
                                    </tr>
                                <?php } if($nap['is_french_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'French Cuff' : ' ڈبل کف  ' ?></td>
                                    </tr>
                                <?php } if($nap['is_double_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Double Cuff' : 'ڈبل کف ' ?></td>
                                    </tr>
                                <?php } ?>                            
                            <?php } else { ?> 
                                <?php if($nap['is_collar'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Collar' : 'کالر ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_moon_neck'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Moon neck' : 'گول گلہ ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_straight_front'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Straight front' : 'سیدھا دامن ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_1side_pocket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? '1 side pocket' : '1 سائیڈ پاکٹ ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_2side_pocket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? '2 side pocket' : '2 سائیڈ پاکٹ ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_fancy_button'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Fancy button' : 'فینسی بٹن ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_french_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'French Cuff' : ' ڈبل کف  ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_band'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Band' : 'بینڈ ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_round_front'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Round Front' : 'گول دامن ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_front_pocket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Front pocket' : ' فرنٹ جیب  '  ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_shalwar_pocket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Shalwar pocket' : 'شلوارجیب ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_sleeve_placket'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Sleeve placket button' : 'چاک پٹی بٹن ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_covered_fly'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Covered Fly' : 'گم پٹی ' ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_plain_button'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Plain button' : ' سادہ بٹن  '  ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_button_cuff'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Button Cuff' : 'بٹن کف '  ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if($nap['is_open_sleeves'] == 1){ ?>
                                    <tr>
                                        <td>&bull;&nbsp;<?= $nap['is_english'] == 1 ? 'Open Sleeves' : ' گول بازو  ' ?></td>
                                    </tr>
                                <?php } ?>                             
                            <?php } ?>
                        </table> 
                    </td>
                <?php } ?>

                <?php if($nap['is_suiting'] == 1){?>
                    <td>
                        <?php echo $nap['instrucations']; ?>
                    </td>
                <?php } else if($nap['is_shirts'] == 1){?>
                    <td>
                        <?php echo $nap['shirt_inst']; ?>
                    </td>
                <?php } else if($nap['is_shalwarqameez'] == 1){?>
                    <td>
                        <?php echo $nap['shalwar_inst']; ?>
                    </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
    <br/>
</div>
</body>
</html>