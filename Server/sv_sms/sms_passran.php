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
 
//Kiểm tra tài khoản có sử dụng chế độ Pass Random không
$check_use_passran_query = "SELECT * FROM MEMB_INFO WHERE memb___id='$taikhoan' AND passran='1'";
$check_use_passran_result = $db->Execute($check_use_passran_query);
$check_use_passran = $check_use_passran_result->numrows();
if($check_use_passran == 0)
{
	$content = "Tai khoan : $taikhoan Chua bat chuc nang bao ve tai khoan.";
}
else {
	//Config
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$random_string_length = 6;
	$slg_passran = floor(160/($random_string_length+1));
	$content = '';
	
	//Delete Data Pass Random Acc
	$passran_delete = $db->Execute("DELETE FROM PassRan WHERE acc='$taikhoan'");
	
	//Create List Pass Random
	for($loop=0;$loop<$slg_passran;$loop++)
	{
		$pass = ''; 
	 	for ($i = 0; $i < $random_string_length; $i++) { 
			$pass .= $characters[rand(0, strlen($characters) - 1)]; 
	 	}
	 	$pass_md5 = md5($pass);
	 	$insert_passran = $db->Execute("INSERT INTO PassRan (acc,pass,pass_md5) VALUES ('$taikhoan','$pass','$pass_md5')");
	 	
	 	$content .= $pass.' ';
	}
}
?>