<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
include('config.php');
include('function.php');

$acc_nguon = $_REQUEST['acc_nguon'];
$nv_nguon = $_REQUEST['nv_nguon'];
$acc_dich = $_REQUEST['acc_dich'];
$nv_dich = $_REQUEST['nv_dich'];
	
$sql_online_check_query = "SELECT * FROM MEMB_STAT WHERE memb___id='$acc_nguon' AND ConnectStat='1'";
$sql_online_check = $db->Execute($sql_online_check_query);
    check_queryerror($sql_online_check_query, $sql_online_check);
	$online_check = $sql_online_check->numrows();
	
	if ($online_check > 0) {
   		echo "Nhân vật chưa thoát Game. Hãy thoát Game trước khi thực hiện chức năng này."; exit();
	} else if(check_nv($acc_nguon, $nv_nguon) == 0) {
	   echo "Nhân vật <b>{$nv_nguon}</b> không nằm trong tài khoản <b>{$acc_nguon}</b>. Vui lòng kiểm tra lại."; exit();
    } else {
		$query_xuly = "UPDATE Character SET CtlCode='99', ErrorSubBlock='99' WHERE Name='$nv_nguon'";
		$sql_xulychuyen = $db->Execute($query_xuly) OR DIE("Lỗi Query : $query_xuly"); 
	
		$query_log = "INSERT INTO Log_chuyensv (acc, [char], accnew, charnew ) VALUES ('$acc_nguon', '$nv_nguon', '$acc_dich', '$nv_dich' )";
		$sql_log = $db->Execute($query_log) OR DIE("Lỗi Query : $query_log");
		echo "<info>OK</info>";
	}
?>