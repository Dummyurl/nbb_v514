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
$vpoint=$_POST["vpoint"];
$pass2 = $_POST['pass2'];

settype($vpoint, 'integer');

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);

$vpoint_query = "select vpoint from MEMB_INFO WHERE memb___id='$login'";
$vpoint_result = $db->Execute( $vpoint_query ) or die("Loi query: $vpoint_query");
$vpoint_fetch= $vpoint_result->fetchrow();

$vpoint_change = $vpoint_fetch[0] - $vpoint;

if( $vpoint_change < 0 ){
echo "Bạn đang có $vpoint_fetch[0] Vpoint. Bạn không thể đổi $vpoint Vpoint sang Cash."; exit(); }

$cash_query = "select credits from MEMB_CREDITS WHERE memb___id='$login'";
$cash_result = $db->Execute( $cash_query ) or die("Loi query: $cash_query");

$cash_exits = $cash_result->NumRows();
if($cash_exits == 0) {
    $cash_add_query = "Insert Into MEMB_CREDITS(memb___id,credits) values('$login','0')";
    $cash_add_result = $db->Execute($cash_add_query);
        check_queryerror($cash_add_query, $cash_add_result);
}

$cash_fetch= $cash_result->fetchrow();

$cash_add = $vpoint/100;
$cash_change = $cash_fetch[0] + $cash_add;

$vpoint_update_query = "UPDATE MEMB_INFO SET vpoint = '$vpoint_change' WHERE memb___id='$login'";
$vpoint_update_result = $db->Execute($vpoint_update_query) or die("Loi query: $vpoint_update_query");

$cash_update_query = "UPDATE MEMB_CREDITS SET credits = '$cash_change' WHERE memb___id='$login'";
$cash_update_result = $db->Execute($cash_update_query) or die("Loi query: $cash_update_query");

// Begin Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $info_cash_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_cash_result = $db->Execute($info_cash_query);
            check_queryerror($info_cash_query, $info_cash_result);
        $cash_log = $info_cash_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $vpoint Vpoint";
        $log_Des = "Đổi $vpoint Vpoint sang $cash_add Cash. Cash trước : $cash_fetch[0] Cash, sai khi đổi : $cash_log[0] Cash";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "OK<nbb>Bạn đã đổi $vpoint Vpoint sang $cash_add Cash thành công.";
}

?>