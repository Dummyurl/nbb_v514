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
 

include_once('config/config_pk.php');

$name = $_POST['name'];
$login = $_POST['login'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_char($login,$name);
kiemtra_doinv($login,$name);

$sql_PkLevel_check = $db->Execute("SELECT PkLevel,PkCount,Money FROM Character WHERE PkCount>0 and Name='$name'");
$PkLevel_check = $sql_PkLevel_check->numrows();
$row = $sql_PkLevel_check->fetchrow();

$vpoint_check = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
$vpoint = $vpoint_check->fetchrow();


if ( $row[1] <= $pk_zen_vpoint ) {
	$tien= $row[1]*$pk_zen;
	$kttien= $row[2] - $tien;
	$vpointpk = 0;
}
else {
	$vpointpk = $row[1]*$pk_vpoint;
	$ktvpoint= $vpoint[0]-$vpointpk;
}

if ($PkLevel_check <= 0){ 
 echo "Bạn không phải là sát thủ."; exit();
}

if ($kttien < 0){ 
 echo "Bạn giết $row[1] người. Bạn có $row[2] Zen. Bạn cần $tien Zen để rửa tội."; exit();
}

if ($ktvpoint < 0){ 
 echo "Bạn giết $row[1] người. Bạn có $row1[0] V.Point. Bạn cần $vpointpk V.Point để rửa tội."; exit();
}

kiemtra_doinv($login,$name);

if ( $row[1] <= $pk_zen_vpoint) {
	$msquery = "UPDATE Character SET [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0',[Money] = '$kttien' WHERE AccountID = '$login' AND Name = '$name'";
	$msresults= $db->Execute($msquery);
	}

else {
	$msquery = "UPDATE Character SET [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0' WHERE AccountID = '$login' AND Name = '$name'";
	$msresults= $db->Execute($msquery);

	$msquery1 = "UPDATE MEMB_INFO SET [vpoint] = '$ktvpoint' WHERE memb___id = '$login'";
	$msresults1= $db->Execute($msquery1);
}
// Begin Log
if ( $vpointpk > 0 ) {
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $vpointpk Vpoint";
        $log_Des = "$name rửa tội";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
}
// End Log

	echo "OK<nbb>$vpointpk<nbb>$name đã rửa tội thành công.";
}

?>