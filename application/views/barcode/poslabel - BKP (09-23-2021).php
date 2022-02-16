<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print BarCode</title>
    <style>  @page {
            margin: 0 auto;
            sheet-size: 200px 50mm;
        }
    </style>
</head>
<body>
<table cellpadding="10" style="width: 100%">

    <tr>
        <td style="bordfont"><strong><?= $lab['product_name'] ?></strong>&nbsp;&nbsp;&nbsp; <span style = "font-size:11px;">DASTAAN</span><br><?= $lab['product_code'] ?>
             
            <barcode code="<?= $lab['barcode'] ?>" text="1" class="barcode" height=".5"/ style="margin-bottom: 10px; margin-top: 10px;">
            </barcode><br>
            <h3>&nbsp;<?= amountExchange($lab['product_price'], 0, $this->aauth->get_user()->loc) ?></h3>
        </td>
    </tr>
</table>
</body>
</html>