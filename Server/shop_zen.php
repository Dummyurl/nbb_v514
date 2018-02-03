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
 
	include_once("security.php");
include_once ('config.php');
include_once('config/shop_zen.php');
include_once ('function.php');

$login = $_POST['login'];
$slg = intval($_POST['slg']);
$pass2 = $_POST['pass2'];

settype($slg, 'integer');

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);

$sql_money_check = $db->Execute("SELECT bank, vpoint FROM MEMB_INFO WHERE memb___id = '$login'");
$money_check = $sql_money_check->fetchrow();


$zen_duoc = $zen_mua*$slg;
$ktzenbank = $money_check[0] + $zen_duoc;
$vpoint_mat = $vpoint_chiphi*$slg;
$ktvpoint = $money_check[1] - $vpoint_mat;

if ($ktvpoint < 0){ 
 echo "Không đủ V.Point để mua Zen."; exit();
}

if ($ktzenbank > 50000000000){ 
 echo "Ngân hàng chỉ được gửi tối đa 50 tỷ Zen."; exit();
}

$msquery = $db->Execute("Update MEMB_INFO SET [vpoint]='$ktvpoint',[bank]='$ktzenbank' WHERE memb___id = '$login'");

_use_money($login, 0, 0, $vpoint_mat);

//Ghi vào Log nhung nhan vat mua Zen
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $vpoint_mat Vpoint";
        $log_Des = "Mua: $zen_mua Zen";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat mua Zen


echo "OK<nbb>$zen_duoc<nbb>$vpoint_mat<nbb>Mua $zen_duoc Zen thành công, chi phí $vpoint_mat Vpoint. Zen đã được gửi vào Ngân hàng.";
}
$db->Close();
?>