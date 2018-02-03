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
 
$pass2new = $loaddata[5];

    $pass2_old_query = "SELECT pass2 FROM MEMB_INFO WHERE memb___id='$taikhoan'";
    $pass2_old_result = $db->Execute($pass2_old_query);
        check_queryerror($pass2_old_query, $pass2_old_result);
    $pass2_old_fetch = $pass2_old_result->FetchRow();
    $pass2_old = $pass2_old_fetch[0];
    
    //Ghi vào Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$taikhoan'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$taikhoan";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "$taikhoan Đổi Mật khẩu Cấp 2 từ $pass2_old sang $pass2new qua SMS";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log
    
$update_pass = $db->Execute("Update MEMB_INFO SET pass2='$pass2new' WHERE memb___id='$taikhoan'");
 	//Delete Data
		$del_data = $db->Execute("DELETE FROM SMS WHERE Code='$code'");
 	$content = "Mat khau Web cap 2 da doi thanh : $pass2new";
?>