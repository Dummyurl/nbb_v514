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

if($Use_IPBonus2PCPoint != 1) {
    echo "Chức năng không được sử dụng"; exit();
}

$login=$_POST["login"];
$name=$_POST["name"];
$ipbonuspoint=$_POST["ipbonuspoint"];
$pass2 = $_POST['pass2'];

settype($gcoin, 'integer');

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_online($login);

$pcpoint_query = "SELECT SCFPCPoints FROM Character WHERE AccountID='$login' AND Name='$name'";
$pcpoint_result = $db->Execute($pcpoint_query);
    check_queryerror($pcpoint_query, $pcpoint_result);
$charinacc_exits = $pcpoint_result->NumRows();
if($charinacc_exits == 0) {
    echo "Nhân vật $name không thuộc tài khoản $login. Vui lòng kiểm tra kỹ thông tin.";
    exit();
}
$pcpoint_fetch = $pcpoint_result->FetchRow();
$pcpoint_before = $pcpoint_fetch[0];

$ipbonuspoint_query = "SELECT IPBonusPoint FROM MEMB_INFO WHERE memb___id='$login'";
$ipbonuspoint_result = $db->Execute($ipbonuspoint_query);
    check_queryerror($ipbonuspoint_query, $ipbonuspoint_result);
$ipbonuspoint_fetch = $ipbonuspoint_result->FetchRow();
$ipbonuspoint_before = $ipbonuspoint_fetch[0];

if($ipbonuspoint_before < $ipbonuspoint) {
    echo "IP Bonus Point hiện có $ipbonuspoint_before . Số IP Bonus Point bạn yêu cầu $ipbonuspoint, nhiều hơn IP Bonus Point hiện có. Giao dịch thất bại.";
    exit();
}


$ipbonuspoint_change = $ipbonuspoint_before - $ipbonuspoint;
$pcpoint_change = $pcpoint_before + $ipbonuspoint;

$ipbonuspoint_update_query = "UPDATE MEMB_INFO SET IPBonusPoint=$ipbonuspoint_change WHERE memb___id='$login'";
$ipbonuspoint_update_result = $db->Execute($ipbonuspoint_update_query);
    check_queryerror($ipbonuspoint_update_query, $ipbonuspoint_update_result);
    
$pcpoint_update_query = "UPDATE Character SET SCFPCPoints=$pcpoint_change WHERE AccountID='$login' AND Name='$name'";
$pcpoint_update_result = $db->Execute($pcpoint_update_query);
    check_queryerror($pcpoint_update_query, $pcpoint_update_result);

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
        $log_Des = "Đổi $ipbonuspoint IP Bonus Point sang $ipbonuspoint PC Point vào nhân vật $name. Trước : $ipbonuspoint_before IP Bonus Point, $pcpoint_before PC Point. Sau : $ipbonuspoint_change IP Bonus Point, $pcpoint_change PC Point";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "OK<nbb>Bạn đã đổi $ipbonuspoint IP Bonus Point sang PC Point vào nhân vật $name thành công.";
}

?>