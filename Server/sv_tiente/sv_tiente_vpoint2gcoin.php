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
$vpoint=$_POST["vpoint"];       $vpoint = abs(intval($vpoint));
$pass2 = $_POST['pass2'];

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);

$query = "select gcoin,vpoint from MEMB_INFO WHERE memb___id='$login'";
$result = $db->Execute( $query ) or die("Loi query: $query");
$row = $result->fetchrow();


$vpoint_tru = floor($vpoint/10)*10;
$gcoin_cong = $vpoint_tru * 0.8;

$gcoin_change = $row[0] + $gcoin_cong;
$vpoint_change = $row[1] - $vpoint_tru;

if( $vpoint_change < 0 ){
echo "Bạn đang có $row[1] Vpoint. Bạn không thể đổi $vpoint_tru Vpoint sang Gcoin."; exit(); }

$general = "UPDATE MEMB_INFO SET gcoin='$gcoin_change', vpoint = '$vpoint_change' WHERE memb___id='$login'";
$msgeneral = $db->Execute($general) or die("Loi query: $general");

// Begin Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "+ $gcoin_cong Gcoin, - $vpoint_tru Vpoint";
        $log_Des = "Đổi $vpoint_tru Vpoint sang $gcoin_cong Gcoin";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "
    <info>OK</info>
    <messenge>Bạn đã đổi $vpoint_tru Vpoint sang $gcoin_cong Gcoin thành công!</messenge>
    <gcoin>$gcoin_change</gcoin>
    <vpoint>$vpoint_change</vpoint>
    ";
}

?>