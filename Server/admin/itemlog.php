<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * @Version		v5.12.0722
 * @Release		22/07/2012
 
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
	include("security.php");
include_once('../config.php');
include_once('function.php');

$title = "Item Log";
SESSION_start();
if ($_POST[submit]) {
	$pass_online = md5($_POST[online]);
	if ($pass_online == "$passcode") $_SESSION['online'] = "$passcode";
}
if (!$_SESSION['online'] || $_SESSION['online'] != "$passcode") {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='online'>
	Code: <input type=password name=online> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
?>

<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.21.custom.css">
</head>
<body bgcolor="#F9E7CF">
<?php require('linktop.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#itemlog_date').datepicker({dateFormat: 'yy-mm-dd'});
})
</script>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="9" align="center">
		<form name="itemlog_search" method="POST" action="">
        Tài khoản : <input name="itemlog_acc" value="<?php echo $_POST['itemlog_acc']; ?>" /> 
        Ngày : <input name="itemlog_date" id="itemlog_date" value="<?php echo $_POST['itemlog_date']; ?>" /> 
        <input type="submit" name="itemlog_search" value="Tìm Log Item" />
        </form>
	</td>
</tr>
<?php

if($_POST['itemlog_acc']) {    

?>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Tài khoản</td>
	<td align="center">Thời gian ghi Log</td>
	<td align="center">Hòm Đồ</td>
	<td align="center">Nhân vật 1</td>
	<td align="center">Nhân vật 2</td>
    <td align="center">Nhân vật 3</td>
    <td align="center">Nhân vật 4</td>
    <td align="center">Nhân vật 5</td>
</tr>



	
<?php    
    $itemlog_acc = $_POST['itemlog_acc'];
    $itemlog_date = $_POST['itemlog_date'];
    $logdate_begin = $itemlog_date;
    $logdate_end = $itemlog_date ." 23:59:59";
    
    $stt = 0;
    $inventory_log_query = "SELECT DISTINCT log_time FROM NBB_Log_Inventory WHERE acc='$itemlog_acc' AND log_time >= '$logdate_begin' AND log_time <= '$logdate_end' ORDER BY log_time";
    $inventory_log_result = $db->Execute($inventory_log_query);
        check_queryerror($inventory_log_query, $inventory_log_result);
    $inventory_log_check = $inventory_log_result->NumRows();
    if($inventory_log_check == 0) {
        echo "<tr bgcolor='#F9E7CF'><td colspan='9' align='center'>Không có Log</td></tr>";
    } else {
        while($inventory_log_fetch = $inventory_log_result->FetchRow()) {
            $logtime = $inventory_log_fetch[0];
            
            ++$stt;
            echo "<tr bgcolor='#F9E7CF' >
        		<td align='center'>$stt</td>
        		<td align='center'><strong>$itemlog_acc</strong></td>
        		<td align='center'>$logtime</td>";
                
                // Hom do
                $warehouse_query = "SELECT log_time FROM NBB_Log_WareHouse WHERE acc='$itemlog_acc' AND log_time >= '$logtime' AND log_time < (DATEADD(mi,30,'$logtime'))";
                $warehouse_result = $db->Execute($warehouse_query);
                    check_queryerror($warehouse_query, $warehouse_result);
                $warehouse_check = $warehouse_result->NumRows();
                if($warehouse_check == 0) {
                    echo "<td align='center'>Chưa mở hòm đồ</td>";
                } else {
                    $warehouse_fetch = $warehouse_result->FetchRow();
                    $warehouse_timelog = strtotime($warehouse_fetch[0]);
                    echo "<td align='center'><a href='itemlog_listitem.php?acc=$itemlog_acc&type=warehouse&logtime=$warehouse_timelog' target='_blank'>Hòm đồ</a></td>";
                }
        		
        		// Inventory
                $nv_slg = 0;
                $inventory_query = "SELECT log_time, name FROM NBB_Log_Inventory WHERE acc='$itemlog_acc' AND log_time >= '$logtime' AND log_time < (DATEADD(mi,30,'$logtime')) ORDER BY name";
                $inventory_result = $db->Execute($inventory_query);
                    check_queryerror($inventory_query, $inventory_result);
                $inventory_check = $inventory_result->NumRows();
                if($inventory_check == 0) {
                    echo "<td align='center'>Chưa có nhân vật</td>";
                    echo "<td align='center'>Chưa có nhân vật</td>";
                    echo "<td align='center'>Chưa có nhân vật</td>";
                    echo "<td align='center'>Chưa có nhân vật</td>";
                    echo "<td align='center'>Chưa có nhân vật</td>";
                } else {
                    while($inventory_fetch = $inventory_result->FetchRow()) {
                        ++$nv_slg;
                        $inventory_timelog = strtotime($inventory_fetch[0]);
                        $itemlog_char = $inventory_fetch[1];
                        echo "<td align='center'><a href='itemlog_listitem.php?acc=$itemlog_acc&type=inventory&name=$itemlog_char&logtime=$warehouse_timelog' target='_blank'>$itemlog_char</a></td>";
                    }
                    if($nv_slg < 5) {
                        for($i=0; $i<5-$nv_slg; $i++) {
                            echo "<td align='center'>Chưa có nhân vật</td>";
                        }
                    }
                }
                
                //<td align='center'>Nhan vat 1</td>
        		//<td align='center'>Nhan vat 2</td>
                //<td align='center'>Nhan vat 3</td>
                //<td align='center'>Nhan vat 4</td>
                //<td align='center'>Nhan vat 5</td>
        	echo "</tr>";
        }
    }
}

?>
												
</table>
<br>
<center>
<?php
$db->Close();
?>
</center>

</body>
</html>