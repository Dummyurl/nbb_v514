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
	$title = "Log Thuê Item";
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
<center>
<form name="checklog" method="GET" action="">
    Tài khoản cần kiểm tra Thuê Item : <input name="acc" value="<?php echo $_GET['acc']; ?>" /> 
    <input type="submit" value="Kiểm tra Log Thuê Item" />
</form>
</center>

<?php
$acc = $_GET['acc'];    $acc = antiinject_query(trim($acc));
$page = $_GET['page'];  $page = abs(intval($page));
if($page == 0) $page = 1;
$row_per_page = 15;
$row_start = ($page-1)*$row_per_page;
$query = "SELECT AccountID, Name, item_info, item_img, Serial, Time_Created, Time_Used, Status, Days FROM NBB_ThueItem";
$query_count = "SELECT count(*) FROM NBB_ThueItem";

if($acc) {
    $query_acc = " WHERE AccountID='$acc'";
    
    $query .= $query_acc;
    $query_count .= $query_acc;
}

$query .= " ORDER BY Time_Created DESC";
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
	<th width="100">Tài khoản</th>
	<th>Nhân Vật</th>
	<th>Thời gian Thuê</th>
	<th>Thông Tin Item</th>
	<th>Hình Ảnh</th>
	<th>Tình Trạng</th>
</tr>
<?php

while($row = $result->fetchrow())
{
    $AccountID = $row[0];
    $Name = $row[1];
    $item_info = $row[2];
    $item_img = $row[3];
    $Serial = strtoupper(dechex($row[4]));
        $Serial_len_less = 8 - strlen($Serial);
        for($i=0; $i<$Serial_len_less; $i++) {
            $Serial = '0'. $Serial;
        }
        $Serial_info = "<font color='cyan'>Serial : ". $Serial ."</font>";
    $Time_Created = "Thuê Lúc : ". date('d/m H:i:s', strtotime($row[5]));
    $Time_Used = $row[6];
    $Status = $row[7];
        if($Status == 1) {
            $status_info = "Đã Sử dụng";
            $Time_Used = "<br /><strong>Sử dụng Lúc</strong> : ". date('d/m H:i:s', strtotime($row[6]));
        } else {
            $status_info = "Chưa Sử dụng";
            $Time_Used = '';
        }
    
    $Day = "<br />Thời gian Thuê : <strong><font color='red'>". $row[8] ." Ngày</font></strong>";
    echo "<tr>";
        echo "<td align='center'>$AccountID</td>";
        echo "<td align='center'>$Name</td>";
        echo "<td align='center'>". $Time_Created . $Time_Used . $Day ."</td>";
        echo "<td align='center' bgcolor='#333'>". $item_info ."</td>";
        echo "<td align='center' bgcolor='#333'><img src='../items/" . $item_img . ".gif' border=0 /><br />$Serial_info</td>";
        echo "<td align='center'>$status_info</td>";
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
    			echo "<a href=\"?character=$acc&log_type=$log_type&page=$page_check\">[$page_check]</a> ";
    		} 
    		$page_check++; 
    	} 

		echo "</center>";
	}
echo "</center>";
}

$db->Close();
?>
</body>
</html>