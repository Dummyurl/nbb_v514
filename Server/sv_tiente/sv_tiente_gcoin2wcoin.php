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
 

$login=$_POST["login"];
$gcoin=$_POST["gcoin"];     $gcoin = abs(intval($gcoin));
$pass2 = $_POST['pass2'];

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);
kiemtra_online($login);

if($server_wz == 0 || $server_wz == 1) {
    $money_q = "SELECT gcoin,WCoin from MEMB_INFO WHERE memb___id='$login'";
    $money_r = $db->Execute( $money_q );
        check_queryerror($money_q, $money_r);
    $money_f = $money_r->fetchrow();
    
    $gcoin_change = $money_f[0] - $gcoin;
    $WCoin_change = $money_f[1] + $gcoin;
    
    if( $gcoin_change < 0 ){
    echo "Bạn đang có ". $money_f[0] ." Gcoin. Bạn không thể đổi $gcoin Gcoin sang WCoin."; exit(); }
    
    $money_u_q = "UPDATE MEMB_INFO SET gcoin='$gcoin_change', WCoin = '$WCoin_change' WHERE memb___id='$login'";
    $money_u_r = $db->Execute($money_u_q);
        check_queryerror($money_u_q, $money_u_r);
} elseif($server_wz == 2) {
    $gcoin_q = "SELECT gcoin from MEMB_INFO WHERE memb___id='$login'";
    $gcoin_r = $db->Execute( $gcoin_q );
        check_queryerror($gcoin_q, $gcoin_r);
    $gcoin_f = $gcoin_r->fetchrow();
    
    $gcoin_change = $gcoin_f[0] - $gcoin;
    
    
    $wcoin_q = "SELECT WCoinC from GameShopPoint WHERE AccountID='$login'";
    $wcoin_r = $db->Execute( $wcoin_q );
        check_queryerror($wcoin_q, $wcoin_r);
    $wcoin_f = $wcoin_r->fetchrow();
    
    $WCoin_change = $wcoin_f[0] + $gcoin;
    
    if( $gcoin_change < 0 ){
    echo "Bạn đang có ". $gcoin_f[0] ." Gcoin. Bạn không thể đổi $gcoin Gcoin sang WCoin."; exit(); }
    
    $gcoin_u_q = "UPDATE MEMB_INFO SET gcoin='$gcoin_change', WCoin = '$WCoin_change' WHERE memb___id='$login'";
    $gcoin_u_r = $db->Execute($gcoin_u_q);
        check_queryerror($gcoin_u_q, $gcoin_u_r);
        
    $wcoin_u_q = "UPDATE GameShopPoint SET WCoinC = '$WCoin_change' WHERE AccountID='$login'";
    $wcoin_u_r = $db->Execute($wcoin_u_q);
        check_queryerror($wcoin_u_q, $wcoin_u_r);
}

// Begin Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $gcoin Gcoin, + $gcoin WCoin";
        $log_Des = "Đổi $gcoin Gcoin sang $gcoin WCoin";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "OK<nbb>Bạn đã đổi $gcoin Gcoin sang $gcoin WCoin thành công.";
}

?>