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
 

include_once("config/config_chucnang.php");

if($Use_IPBonus2Vpoint != 1) {
    echo "Chức năng không được sử dụng"; exit();
}

$login=$_POST["login"];
$ipbonuspoint=$_POST["ipbonuspoint"];
$pass2 = $_POST['pass2'];

settype($gcoin, 'integer');

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);
kiemtra_online($login);

$ipbonuspoint_query = "SELECT IPBonusPoint, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
$ipbonuspoint_result = $db->Execute($ipbonuspoint_query);
    check_queryerror($ipbonuspoint_query, $ipbonuspoint_result);
$ipbonuspoint_fetch = $ipbonuspoint_result->FetchRow();
$ipbonuspoint_before = $ipbonuspoint_fetch[0];
$vpoint_before = $ipbonuspoint_fetch[1];

if($ipbonuspoint_before < $ipbonuspoint) {
    echo "IP Bonus Point hiện có $ipbonuspoint_before . Số IP Bonus Point bạn yêu cầu $ipbonuspoint, nhiều hơn IP Bonus Point hiện có. Giao dịch thất bại.";
    exit();
}


$ipbonuspoint_change = $ipbonuspoint_before - $ipbonuspoint;
$vpoint_change = $vpoint_before + $ipbonuspoint;

$ipbonuspoint_update_query = "UPDATE MEMB_INFO SET IPBonusPoint=$ipbonuspoint_change, vpoint=$vpoint_change WHERE memb___id='$login'";
$ipbonuspoint_update_result = $db->Execute($ipbonuspoint_update_query);
    check_queryerror($ipbonuspoint_update_query, $ipbonuspoint_update_result);
    
// Begin Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "Đổi $ipbonuspoint IP Bonus Point sang $ipbonuspoint Vpoint. Trước : $ipbonuspoint_before IP Bonus Point, $vpoint_before Vpoint. Sau : $ipbonuspoint_change IP Bonus Point, $vpoint_change Vpoint";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "OK<nbb>Bạn đã đổi $ipbonuspoint IP Bonus Point sang PC Point vào nhân vật $name thành công.";
}

?>