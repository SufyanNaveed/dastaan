<table class="fTb">
    <tr>
        <td colspan="3" class="c_center"><h2>FAIR PRICE SHOP</h2><br><br></td>
    </tr>
    <tr>
        <td class="myw">
            <table class="top_sum">
                <tr>
                    <td width="130px"><strong>REF NO:</strong></td>
                    <td><?php echo $nap['reference_id']; ?></td>
                </tr>
                <tr>
                    <td width="130px"><strong>Booking Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['booking_date'])); ?></td>
                </tr>
                <tr>
                    <td width="130px"><strong>Delivery Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['d_date'])); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>