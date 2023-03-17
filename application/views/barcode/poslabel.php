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
    <br>
<table cellpadding="10" style="width: 100%;">
    <tr>
        <td style="bordfont font-size:20px;"><strong><?= $lab['product_name'] ?></strong>&nbsp;&nbsp;&nbsp;DASTAAN<br><?= $lab['product_code'] ?>

            <barcode code="<?= $lab['barcode'] ?>" text="1" class="barcode" size="2" height=".4"/>
            </barcode>
            
            <h3>&nbsp;<?= amountExchange($lab['product_price'], 0, $this->aauth->get_user()->loc) ?> 
            <?php if($lab['pcat'] == 2){ echo '/ meter'; } 
            ?> </h3>
        </td>
    </tr>
</table>
</body>
</html>