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
 
include_once("security.php");
include_once ('config.php');
include_once ('function.php');

$action = $_POST['action'];
$login = $_POST['login'];
$tran_id = $_POST['tran_id'];
$ketqua = $_POST['ketqua'];
$slgdudoan = $_POST['slgdudoan'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {
	$string_login = $_POST['string_login'];
	checklogin($login,$string_login);
	
	$check_vpoint_query = "SELECT vpoint FROM MEMB_INFO WHERE memb___id='$login' AND vpoint<1000";
	$check_vpoint_result = $db->Execute($check_vpoint_query);
	$check_vpoint = $check_vpoint_result->numrows();
	if($check_vpoint > 0) {
		echo "Bạn cần có ít nhất 1.000 Vpoint để tham gia dự đoán."; exit();
	} else {
		$update_vpoint_query = "UPDATE MEMB_INFO SET vpoint=vpoint-1000 WHERE memb___id='$login'";
		$update_vpoint_result = $db->Execute($update_vpoint_query);
		
		$insert_dudoan_query = "INSERT INTO bongda_dudoankq (acc,tran_id,dudoan_kq,dudoan_slg,time) VALUES ('$login','$tran_id','$ketqua','$slgdudoan','$timestamp')";
		$insert_dudoan_result = $db->Execute($insert_dudoan_query);
		echo "OK";
	}
}
$db->Close();
?>