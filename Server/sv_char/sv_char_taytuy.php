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
 

include_once('config/config_taytuy.php');
include_once('config/config_event.php');

$login = $_POST['login'];
$name = $_POST['name'];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

fixrs($name);

kiemtra_pass2($login,$pass2);
kiemtra_char($login,$name);
kiemtra_doinv($login,$name);
kiemtra_online($login);

$sql_char_check = $db->Execute("SELECT Resets,Resets_Time FROM Character WHERE Name='$name' and AccountID = '$login'"); 
$char_check = $sql_char_check->fetchrow();
$reset = $char_check[0];

$vpoint_check = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
$vpoint = $vpoint_check->fetchrow();

if ( $reset < 1 ) {
	echo "Nhân vật $name phải Reset ít nhất 1 lần mới có thể tẩy tủy."; exit();
}

	$ktvpoint= $vpoint[0]-$taytuy_vpoint;

if ($ktvpoint < 0){ 
 echo "Bạn có $vpoint[0] V.Point. Bạn cần $taytuy_vpoint V.Point để tẩy tủy."; exit();
}

kiemtra_doinv($login,$name);
kiemtra_online($login);

$msquery = "UPDATE Character SET Resets=Resets-1, ResetNBB=ResetNBB-1,NoResetInDay=NoResetInDay-1, Clevel='400', Resets_Time=Resets_Time-180 WHERE Name = '$name'";
$msresults= $db->Execute($msquery) or die("Lỗi Query: $msquery");

$msquery1 = "UPDATE MEMB_INFO SET [vpoint] = '$ktvpoint' WHERE memb___id = '$login'";
$msresults1= $db->Execute($msquery1) or die("Lỗi Query: $msquery1");

_use_money($login, 0, 0, $taytuy_vpoint);

if( ($event_toprs_on == 1) && (strtotime($event_toprs_begin) < $timestamp) && (strtotime($event_toprs_end) > $timestamp) )
{
	$selectrs_eventtop_query = "SELECT resets FROM Event_TOP_RS WHERE name='$name'";
	$selectrs_eventtop_result = $db->Execute($selectrs_eventtop_query) OR DIE("Lỗi Query: $selectrs_eventtop_query");
	$selectrs_eventtop = $selectrs_eventtop_result->fetchrow();
	
	if($selectrs_eventtop[0] > 0)
	{
		$update_data_query = "UPDATE Event_TOP_RS SET resets=resets-1 WHERE name='$name'";
		$update_data_result = $db->Execute($update_data_query) OR DIE("Lỗi Query: $update_data_query");
	}
}

//Ghi vào Log nhung nhan vat tay tuy
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $taytuy_vpoint Vpoint";
        $log_Des = "$name Tẩy tủy";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat tay tuy

    _topreset_sub($name, 1, 1800);
	echo "OK<nbb>$name đã tẩy tủy thành công. Bạn bị xóa toàn bộ điểm Danh Vọng trong ngày.";
}

?>