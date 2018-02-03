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
 
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
$random_string_length = 6;
$pass = ''; 
 	for ($i = 0; $i < $random_string_length; $i++) { 
		$pass .= $characters[rand(0, strlen($characters) - 1)]; 
 	}
 	$pass_md5 = md5($pass);
 	
 	$update_pass = $db->Execute("Update MEMB_INFO SET memb__pwd2='$pass', memb__pwdmd5='$pass_md5' WHERE memb___id='$taikhoan'");
 	//Delete Data
		$del_data = $db->Execute("DELETE FROM SMS WHERE Code='$code'");
 	$content = "Mat khau Web cap 1 moi : $pass";
?>