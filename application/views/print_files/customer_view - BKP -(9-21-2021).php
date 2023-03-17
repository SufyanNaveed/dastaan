<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customer Slip #<?php echo $nap['reference_id'];  ?></title>
    <style>
        body {
            color: #2B2000;
            font-family: 'Helvetica';
        }

        .invoice-box {
            width: 500mm;
            height: 200mm;
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
<table style="margin-left: 15px; margin-right: 15px;">
    <tr>
        <td colspan="3" class="c_center"><h2>DASTAAN</h2></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right;">Date : <?php date_default_timezone_set("Asia/Karachi"); echo date("d/m/Y h:i"); ?></td>
    </tr>
    <tr>
        <td class="myw">
            <table class="top_sum">
                <tr>
                    <td><strong>Name</strong></td>
                    <td><?php echo $nap['name']; ?></td>
                </tr>
                <tr>
                    <td><strong>Mobile #</strong></td>
                    <td><?php echo $nap['phone']; ?></td>
                </tr>

            </table>
        </td>
        <td>

        </td>
        <td class="myw">

            <table class="top_sum order-info">
                <tr>
                    <td width="130px"><strong>REF NO:</strong></td>
                    <td><?php echo $nap['reference_id']; ?></td>
                </tr>
                <tr>
                    <td width="130px"><strong>Booking Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['booking_date'])); ?></td>
                </tr>
                 <tr>
                    <td width="130px"><strong>Trial Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['trial_date'])); ?></td>
                </tr>
                <tr>
                    <td width="130px"><strong>Delivery Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['d_date'])); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div class="invoice-box">
    <table class="party plist" cellpadding="0" cellspacing="0">
        <thead>
        <tr class="heading">
            <td style="width: 12rem; text-align: center;"><strong>COAT / WAIST COAT</strong></td>
            <td style="width: 12rem;text-align: center;"><strong>PANT</strong></td>
            <td style="width: 12rem;text-align: center;"><strong>SHIRT / KAMIZ</strong></td>
            <td style=" text-align: center;"><strong>INSTRUCATIONS</strong></td>
        </tr>
        </thead>
        <tbody>
        <tr class="item" >
            <td>
                <table class="order_detail">
                    <tr>
                        <td><strong>Length / لمبائی</strong></td>
                        <td><?php echo $nap['coat_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sleeves / بازو</strong></td>
                        <td><?php echo $nap['coat_sleeves']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Shoulder / تیر ہ</strong></td>
                        <td><?php echo $nap['coat_shoulder']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Half Back / نصف کمر</strong></td>
                        <td><?php echo $nap['coat_half_back']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Cross Back/ کراس کمر </strong></td>
                        <td><?php echo $nap['coat_cross_back']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Length / لمبائی</strong></td>
                        <td><?php echo $nap['coat_sec_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Neck / گردن </strong></td>
                        <td><?php echo $nap['coat_neck']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Chest / چھاتی</strong></td>
                        <td><?php echo $nap['coat_chest']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Belly Waist / کمر </strong></td>
                        <td><?php echo $nap['coat_waist']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Hip / ہپ </strong></td>
                        <td><?php echo $nap['coat_hip']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bicep / ڈولہ</strong></td>
                        <td><?php echo $nap['coat_bicep']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Forearm / کونی</strong></td>
                        <td><?php echo $nap['coat_forearm']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Items</strong></td>
                        <td><?php echo ($nap['is_coat'])?"Coat<br>":'';?>
                         <?php echo ($nap['is_waist_coat'])?"Waist Coat":'';?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="order_detail">
                    <tr>
                        <td><strong>Length / لمبائی</strong></td>
                        <td><?php echo $nap['pant_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Inseam / اندرونی لمبائی</strong></td>
                        <td><?php echo $nap['pant_inside_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Waist / کمر </strong></td>
                        <td><?php echo $nap['pant_waist']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Hip / ہپ </strong></td>
                        <td><?php echo $nap['pant_hip']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Thigh /گھیر </strong></td>
                        <td><?php echo $nap['pant_thigh']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bottom / پا ئنچہ</strong></td>
                        <td><?php echo $nap['pant_bottom']; ?></td>
                    </tr><tr>
                        <td><strong>Knee / گھٹنے</strong></td>
                        <td><?php echo $nap['pant_knee']; ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="order_detail">
                    <tr>
                        <td><strong>Length / لمبائی</strong></td>
                        <td><?php echo $nap['kmz_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Sleeves / بازو</strong></td>
                        <td><?php echo $nap['kmz_sleeves']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Shoulder / کندھا</strong></td>
                        <td><?php echo $nap['kmz_shoulder']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Neck / کالر </strong></td>
                        <td><?php echo $nap['kmz_neck']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Chest / چھاتی</strong></td>
                        <td><?php echo $nap['kmz_chest']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Belly Waist / کمر </strong></td>
                        <td><?php echo $nap['kmz_waist']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Guaira / گھیرہ</strong></td>
                        <td><?php echo $nap['kmz_guaira']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Hip / ہپ </strong></td>
                        <td><?php echo $nap['kmz_hip']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bicep / ڈولہ</strong></td>
                        <td><?php echo $nap['kmz_bicep']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Forearm / کونی</strong></td>
                        <td><?php echo $nap['kmz_forearm']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Items</strong></td>
                        <td><?php echo ($nap['is_kmz'])?"Kamiz <br>":'';?>
                         <?php echo ($nap['is_shirt'])?"Shirt":'';?></td>
                    </tr>
                    <tr class="shl heading">
                        <td colspan="2" style="text-align: center;"><strong>SHALWAR</strong></td>
                    </tr>
                    <tr>
                        <td style="padding-top: 10px;"><strong>Length / شلوارلمبائی</strong></td>
                        <td style="padding-top: 10px;"><?php echo $nap['shl_length']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bottom / پا ئنچہ</strong></td>
                        <td><?php echo $nap['shl_bottom']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Asan Tyar / آسن تیار</strong></td>
                        <td><?php echo $nap['shl_AsanTyar']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Shalwar Guaira Tyar / شلوار گھیر تیار</strong></td>
                        <td><?php echo $nap['shl_GairaTyar']; ?></td>
                    </tr>
                </table>
            </td>
            <td>
                <?php echo $nap['instrucations']; ?>
            </td>
        </tr>
        <tr  class="amount-details heading">
            <td></td>
            <td></td>
            <td></td>
            <td>
                <table class="amount">
                    <tr>
                        <td><strong>Total Amount: </strong></td>
                        <td><?php echo $nap['total']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Advance: </strong></td>
                        <td><?php echo $nap['pamnt']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Blance: </strong></td>
                        <td><?php echo rev_amountExchange_s($nap['total'] - $nap['pamnt']); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>