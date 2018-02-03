<?php

/**
 * @author NetBanBe
 * @copyright 2012
 */

include_once ("security.php");
include ('../config.php');
include ('function.php');

$bid_id = $_GET['bidid'];   $bid_id = abs(intval($bid_id));


?>
<table border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="3" width="300" align="center">
    <tr>
        <td align="center"><strong>Giá đấu</strong></td>
        <td align="center"><strong>Số lượng</strong></td>
    </tr>
    <?php 
        $bid_view_query = "SELECT bid_vpoint, count(bid_vpoint) as count FROM DauGiaNguoc_Bid WHERE bid_id=". $bid_id ." GROUP BY bid_vpoint ORDER BY count";
        $bid_view_result = $db->Execute($bid_view_query);
            check_queryerror($bid_view_query, $bid_view_result);
        while($bid_view_fetch = $bid_view_result->FetchRow()) {
    ?>
    <tr>
        <td align="center"><?php echo number_format($bid_view_fetch[0], 0, ',', '.'); ?> </td>
        <td align="center"><?php echo $bid_view_fetch[1]; ?></td>
    </tr>
    <?php } ?>
</table>