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
 
$passgamenew = $loaddata[5];

$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$taikhoan' AND ConnectStat='1'");
$online_check = $sql_online_check->numrows();
if ($online_check > 0){ 
		$content = "Nhan vat chua thoat Game. Hay thoat Game truoc khi thuc hien chuc nang nay.";
}
else {
    
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
        $log_Des = "$taikhoan Đổi Pass Game sang $passgamenew qua SMS";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log
    
	if ( $server_md5 == 1 ) {
		$update_passgame = "Update MEMB_INFO SET [memb__pwd] = [dbo].[fn_md5]('$passgamenew','$taikhoan') WHERE memb___id = '$taikhoan'";
	} else {
		$update_passgame = "Update MEMB_INFO SET [memb__pwd] = '$passgamenew' WHERE memb___id = '$taikhoan'";
	}
		$rs_update_passgame = $db->Execute($update_passgame);
		//Delete Data
			$del_data = $db->Execute("DELETE FROM SMS WHERE Code='$code'");
		
	 	$content = "Mat khau Game da doi thanh : $passgamenew";
}
?>