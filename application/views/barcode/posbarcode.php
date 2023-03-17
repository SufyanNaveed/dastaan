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
<table cellpadding="20">

    <tr>
        <td style="font-size:20px;">
            <strong><?= $name ?><br><?= $product_code ?><br> </strong>
            <barcode type="<?= $ctype ?>" code="<?= $code ?>" text="1" class="barcode" size="2" height=".4"/>
            </barcode><br></td>


    </tr>
</table>
</body>
</html>