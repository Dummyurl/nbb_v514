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
 

/**
 * @author NetBanBe
 * @copyright 2011
 */
 include_once("security.php");
include('../config.php');
	$title = "Kiểm tra Log";
session_start();
if ($_POST[submit]) {
	$pass_admin = md5($_POST[useradmin]);
	if ($pass_admin == $passadmin) $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='admin'>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
function antiinject_query($value) {
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function check_queryerror($query,$result) {
    if ($result === false) die("Query Error : $query");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<?php require('linktop.php'); ?>
<?php
if($_POST['dellog']) {
    $dellog_query = "DELETE FROM Log_TienTe WHERE Des not like '%Bảo vệ Item%' AND Des not like '%Nạp thẻ%'";
    $monthdel = abs(intval($_POST['dellog']));
    $lognotice = "";
    if($monthdel > 0) {
        $timedel = $timestamp - ($monthdel * 24*60*60);
        $dellog_query .= " AND time<$timedel";
        $lognotice = "Chỉ để lại Log trong vòng $monthdel ngày gần đây.";
    }
    $dellog_result = $db->Execute($dellog_query);
        check_queryerror($dellog_query, $dellog_result);
    echo "<center><b><font color=red>Xóa Log thành công. $lognotice</font></b></center>";
}
?>
<div align='right'>
<form action="" method="POST">
Xóa Log
<select name="dellog">
    <option value="all"> - Xóa tất cả Log - </option>
    
    <option value="1"> - Chỉ để lại Log trong vòng 1 ngày gần đây - </option>
    
    <option value="7"> - Chỉ để lại Log trong vòng 1 tuần gần đây - </option>
    <option value="14"> - Chỉ để lại Log trong vòng 2 tuần gần đây - </option>
    
    <option value="30"> - Chỉ để lại Log trong vòng 1 tháng gần đây - </option>
    <option value="60"> - Chỉ để lại Log trong vòng 2 tháng gần đây - </option>
    <option value="90"> - Chỉ để lại Log trong vòng 3 tháng gần đây - </option>
</select>
<input type="submit" value="Xóa Log" />
</form>
</div>
<center>
<form name="checklog" method="GET" action="">
    Tài khoản cần kiểm tra : <input name="character" value="<?php echo $_GET['character']; ?>" /> 
    <select name="log_type">
        <option value="all">- ALL -</option>
        <option value="27" <?php if($_GET['log_type'] == 27) echo "selected='selected'"; ?> >Nạp Thẻ</option>
        <option value="31" <?php if($_GET['log_type'] == 31) echo "selected='selected'"; ?> >Lô</option>
        <option value="32" <?php if($_GET['log_type'] == 32) echo "selected='selected'"; ?> >Đề</option>
        <option value="1" <?php if($_GET['log_type'] == 1) echo "selected='selected'"; ?> >WebShop</option>
        <option value="13" <?php if($_GET['log_type'] == 13) echo "selected='selected'"; ?> >Đổi Vpoint sang Gcoin</option>
        <option value="14" <?php if($_GET['log_type'] == 14) echo "selected='selected'"; ?> >Đổi Gcoin sang Vpoint</option>
        <option value="18" <?php if($_GET['log_type'] == 18) echo "selected='selected'"; ?> >Đổi Gcoin sang Wcoin</option>
        <option value="19" <?php if($_GET['log_type'] == 19) echo "selected='selected'"; ?> >Đổi Gcoin sang WCoinP</option>
        <option value="20" <?php if($_GET['log_type'] == 20) echo "selected='selected'"; ?> >Đổi Gcoin sang Goblin Coin</option>
        	<option value="21" <?php if($_GET['log_type'] == 21) echo "selected='selected'"; ?> >Đổi Gcoin sang VipMoney</option>
        <option value="15" <?php if($_GET['log_type'] == 15) echo "selected='selected'"; ?> >Mua Item Vpoint</option>
        <option value="16" <?php if($_GET['log_type'] == 16) echo "selected='selected'"; ?> >Đổi Item Vpoint ra Vpoint</option>
        <option value="2" <?php if($_GET['log_type'] == 2) echo "selected='selected'"; ?> >Reset VIP</option>
        <option value="22" <?php if($_GET['log_type'] == 22) echo "selected='selected'"; ?> >Reset Ủy Thác</option>
        <option value="3" <?php if($_GET['log_type'] == 3) echo "selected='selected'"; ?> >Reset Ủy Thác VIP</option>
        <option value="28" <?php if($_GET['log_type'] == 28) echo "selected='selected'"; ?> >ReLife</option>
        <option value="23" <?php if($_GET['log_type'] == 23) echo "selected='selected'"; ?> >Ủy Thác</option>
        <option value="4" <?php if($_GET['log_type'] == 4) echo "selected='selected'"; ?> >Đổi Giới Tính</option>
        <option value="30" <?php if($_GET['log_type'] == 30) echo "selected='selected'"; ?> >Tẩy Tủy</option>
        <option value="24" <?php if($_GET['log_type'] == 24) echo "selected='selected'"; ?> >Đổi Tên Nhân Vật</option>
        <option value="25" <?php if($_GET['log_type'] == 25) echo "selected='selected'"; ?> >Chuyển nhân vật sang tài khoản khác</option>
        <option value="" disabled="disabled">--------------------</option>
        <option value="29" <?php if($_GET['log_type'] == 29) echo "selected='selected'"; ?> >Bảo vệ Item</option>
        <option value="5" <?php if($_GET['log_type'] == 5) echo "selected='selected'"; ?> >Máy Quay Chao</option>
        <option value="6" <?php if($_GET['log_type'] == 6) echo "selected='selected'"; ?> >Máy Quay Chao lên 10</option>
        <option value="7" <?php if($_GET['log_type'] == 7) echo "selected='selected'"; ?> >Máy Quay Chao lên 11</option>
        <option value="8" <?php if($_GET['log_type'] == 8) echo "selected='selected'"; ?> >Máy Quay Chao lên 12</option>
        <option value="9" <?php if($_GET['log_type'] == 9) echo "selected='selected'"; ?> >Máy Quay Chao lên 13</option>
        <option value="10" <?php if($_GET['log_type'] == 10) echo "selected='selected'"; ?> >Máy Quay Chao lên 14</option>
        <option value="11" <?php if($_GET['log_type'] == 11) echo "selected='selected'"; ?> >Máy Quay Chao lên 15</option>
        <option value="" disabled="disabled">--------------------</option>
        <option value="12" <?php if($_GET['log_type'] == 12) echo "selected='selected'"; ?> >Hack Reset</option>
        <option value="17" <?php if($_GET['log_type'] == 17) echo "selected='selected'"; ?> >Dupe</option>
        <option value="26" <?php if($_GET['log_type'] == 26) echo "selected='selected'"; ?> >Dupe Vpoint</option>
    </select>
    <input type="submit" value="Kiểm tra Log" />
</form>
</center>

<?php
$name = $_GET['character'];    $name = antiinject_query(trim($name));
$log_type = $_GET['log_type'];    $log_type = antiinject_query(trim($log_type));
if($log_type)
{
$page = $_GET['page'];  $page = abs(intval($page));
if($page == 0) $page = 1;
$row_per_page = 15;
$row_start = ($page-1)*$row_per_page;
$query = "SELECT gcoin, gcoin_km, vpoint, price, Des, time, acc FROM Log_TienTe";
$query_count = "SELECT count(*) FROM Log_TienTe";
switch($log_type) {
    case '1':
        $query_extra = " WHERE Des like '%Mua%'";
        break;
    case 2:
        $query_extra = " WHERE Des like '%Reset VIP%'";
        break;
    case 3:
        $query_extra = " WHERE Des like '%Reset Ủy Thác VIP%'";
        break;
    case 4:
        $query_extra = " WHERE Des like '%Đổi Giới tính%'";
        break;
    case 5:
        $query_extra = " WHERE Des like '%UP Item%'";
        break;
    case 6:
        $query_extra = " WHERE Des like '%UP Item%10%'";
        break;
    case 7:
        $query_extra = " WHERE Des like '%UP Item%11%'";
        break;
    case 8:
        $query_extra = " WHERE Des like '%UP Item%12%'";
        break;
    case 9:
        $query_extra = " WHERE Des like '%UP Item%13%'";
        break;
    case 10:
        $query_extra = " WHERE Des like '%UP Item%14%'";
        break;
    case 11:
        $query_extra = " WHERE Des like '%UP Item%15%'";
        break;
    case 12:
        $query_extra = " WHERE Des like '%quá nhanh%'";
        break;
    case 13:
        $query_extra = " WHERE Des like '%Vpoint sang%Gcoin%'";
        break;
    case 14:
        $query_extra = " WHERE Des like '%Gcoin sang%Vpoint%'";
        break;
    case 15:
        $query_extra = " WHERE Des like '%Mua%Item%'";
        break;
    case 16:
        $query_extra = " WHERE Des like '%Đổi%Gold%Zen%'";
        break;
    case 17:
        $query_extra = " WHERE Des like '%Dup%'";
        break;
    case 18:
        $query_extra = " WHERE Des like '%Gcoin%WCoin%'";
        break;
    case 19:
        $query_extra = " WHERE Des like '%Gcoin%WCoinP%'";
        break;
    case 20:
        $query_extra = " WHERE Des like '%Gcoin%GoblinCoin%'";
        break;
    case 21:
        $query_extra = " WHERE Des like '%Gcoin%VipMoney%'";
        break;
    case 22:
        $query_extra = " WHERE Des like '%Reset Ủy Thác lần thứ%'";
        break;
    case 23:
        $query_extra = " WHERE Des like '%Ủy Thác%'";
        break;
    case 24:
        $query_extra = " WHERE Des like '%Đổi tên sang%'";
        break;
    case 25:
        $query_extra = " WHERE Des like '%Chuyển sang Tài khoản%'";
        break;
    case 26:
        $query_extra = " WHERE Des like '%Item Vpoint Dupe%'";
        break;
    case 27:
        $query_extra = " WHERE Des like '%Nạp thẻ%'";
        break;
    case 28:
        $query_extra = " WHERE Des like '%Relife lần thứ%'";
        break;
    case 29:
        $query_extra = " WHERE Des like '%Bảo vệ Item%'";
        break;
    case 30:
        $query_extra = " WHERE Des like '%Tẩy tủy%'";
        break;
    case 31:
        $query_extra = " WHERE Des like '%ánh%ô%'";
        break;
    case 32:
        $query_extra = " WHERE Des like '%ánh%đề%'";
        break;
    default: $query_extra = "";
}

$query .= $query_extra;
$query_count .= $query_extra;

if($name) {
    if($log_type != 'all') $query_name = " AND acc='$name'";
    else $query_name = " WHERE acc='$name'";
    
    $query .= $query_name;
    $query_count .= $query_name;
}

$query .= " ORDER BY time DESC";
$total_row_result = $db->execute($query_count);
    check_queryerror($query_count, $total_row_result);
$total_row_fetch = $total_row_result->FetchRow();
$total_row = $total_row_fetch[0];
    
if($total_row == 0) echo "<center>Không tồn tại tài LOG</center>";
else
{
$total_page = ceil($total_row/$row_per_page);
$result = $db->SelectLimit($query, $row_per_page, $row_start);
?>
<table align="center" border="1" style="border-collapse: collapse;" cellpadding="3" cellspacing="3" >
<tr>
	<th width="150">Thời gian</th>
	<th>Gcoin</th>
	<th>Gcoin KM</th>
	<th>Vpoint</th>
	<th>+/-</th>
	<th>Mô tả</th>
</tr>
<?php

while($row = $result->fetchrow())
{
    $time = date('d/m H:i:s',$row[5]);
    echo "<tr>";
        echo "<td align='center'>$time</td>";
        echo "<td align='center'>". number_format($row[0], 0, ',', '.') ."</td>";
        echo "<td align='center'>". number_format($row[1], 0, ',', '.') ."</td>";
        echo "<td align='center'>". number_format($row[2], 0, ',', '.') ."</td>";
        echo "<td align='center'>$row[3]</td>";
        echo "<td align='center'><strong>$row[6]</strong> : $row[4]</td>";
    echo "</tr>";
}
echo "</table>";

    if ($total_page > 1) {
		echo "<center>Trang: [".$total_page."] ";
        $page_check = 1;
    	while($page_check <= $total_page && $page_check<=50){
    		if($page_check == $page){
    			echo " [$page] ";
    		} else {
    			echo "<a href=\"?character=$name&log_type=$log_type&page=$page_check\">[$page_check]</a> ";
    		} 
    		$page_check++; 
    	} 

		echo "</center>";
	}
echo "</center>";
}
}
$db->Close();
?>
</body>
</html>