<table style="margin-left: 15px; margin-right: 15px;">
    <tr>
        <td colspan="3" class="c_center"><h2>FAIR PRICE SHOP</h2></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right;">Date : <?php echo date("d/m/Y"); ?></td>
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
                    <td width="130px"><strong>Delivery Date:</strong></td>
                    <td><?php echo date("d/m/Y", strtotime($nap['d_date'])); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>