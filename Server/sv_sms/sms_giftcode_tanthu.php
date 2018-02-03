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
 
//Kiểm tra tài khoản đã nhận giftcode chưa
$check_use_giftcode_query = "SELECT status, gift_code FROM GiftCode WHERE acc='$taikhoan' AND type=9";
$check_use_giftcode_result = $db->Execute($check_use_giftcode_query);
$check_use_giftcode = $check_use_giftcode_result->numrows();
if($check_use_giftcode > 0)
{
    $gift_status = $check_use_giftcode_result->FetchRow();
    if($gift_status[0] == 1) {
        $content = "Tai khoan $taikhoan da nhan GiftCode voi ma : " . $gift_status[1];
    } else {
        $content = "Tai khoan $taikhoan da su dung GiftCode, khong the nhan them.";
    }
}
else {
	//Config
	$characters = 'abcdefghijklmnpqrstuvwxyz123456789';
	$random_string_length = 10;
	
    // Create GiftCode
    $gift_created = 0;
    while($gift_created == 0) {
        $giftcode = ''; 
     	for ($i = 0; $i < $random_string_length; $i++) { 
    		$giftcode .= $characters[rand(0, strlen($characters) - 1)]; 
     	}
        $giftcode = strtoupper($giftcode);
        
        $giftcode_exits_query = "SELECT * FROM GiftCode WHERE acc='$taikhoan' AND gift_code='$giftcode' AND type=9 AND (status=0 OR status=1)";
        $giftcode_exits_result = $db->Execute($giftcode_exits_query);
        $giftcode_exits = $giftcode_exits_result->NumRows();
        if($giftcode_exits == 0) $gift_created = 1;
    }

    $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode', '$taikhoan', 9, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
    $giftcode_insert_result = $db->Execute($giftcode_insert_query);
    $content = "Ma GiftCode Tan Thu cua tai khoan $taikhoan : $giftcode";
}
?>