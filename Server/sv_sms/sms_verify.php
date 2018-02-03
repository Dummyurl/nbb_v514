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
 
//Kiểm tra xem có phải tài khoản mới đăng kí
$acc_new_query = "SELECT * FROM MEMB_INFO WHERE checksms_status='0' AND memb___id='$taikhoan'";
$acc_new_result = $db->Execute($acc_new_query);
$acc_new = $acc_new_result->numrows();
//Là acc mới
if($acc_new > 0)
{
	$time_checksms_add = 25*24*60*60;
	$update_checksms_query = "UPDATE MEMB_INFO SET checksms_status='1', time_checksms=time_checksms+$time_checksms_add WHERE memb___id='$taikhoan'";
	$update_checksms_result = $db->Execute($update_checksms_query);
}
//Không phải là acc mới
else {
	//Kiểm tra xem có đang bị Block
	$check_block_query = "SELECT * FROM MEMB_INFO WHERE bloc_code='1' AND memb___id='$taikhoan' AND admin_block='0'";
	$check_block_result = $db->Execute($check_block_query);
	$check_block = $check_block_result->numrows();
	//Nếu đang bị block
	if($check_block > 0)
	{
		$update_checksms_query = "UPDATE MEMB_INFO SET time_checksms='$timestamp',bloc_code='0' WHERE memb___id='$taikhoan'";
		$update_checksms_result = $db->Execute($update_checksms_query);
	}
	//Nếu không bị Block
	else {
		$time_checksms_add = 30*24*60*60;
		$update_checksms_query = "UPDATE MEMB_INFO SET checksms_status='1', time_checksms=time_checksms+$time_checksms_add WHERE memb___id='$taikhoan'";
		$update_checksms_result = $db->Execute($update_checksms_query);
	}
}
$content = "Xac minh tai khoan $taikhoan thanh cong. Vui long thoat tai khoan Web va dang nhap lai de cap nhap thong tin";
?>