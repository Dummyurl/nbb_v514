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
 

include_once('config/config_dongbo.php');
include_once('config/config_resetpoint.php');
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

kiemtra_pass2($login,$pass2);
kiemtra_char($login,$name);
kiemtra_doinv($login,$name);
kiemtra_online($login);

$vpoint_check = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
$vpoint = $vpoint_check->fetchrow();

	$ktvpoint= $vpoint[0]-$resetpoint_vpoint;

if ($ktvpoint < 0){ 
 echo "Bạn có $vpoint[0] V.Point. Bạn cần $resetpoint_vpoint V.Point để Reset Point."; exit();
}

$char_info_query = "SELECT LevelUpPoint, Strength, Dexterity, Vitality, Energy, pointdutru, Class FROM Character WHERE Name='$name'";
$char_info_result = $db->Execute($char_info_query);
    check_queryerror($char_info_query, $char_info_result);
$char_info_fetch = $char_info_result->FetchRow();
$LevelUpPoint = $char_info_fetch[0];
$Strength = $char_info_fetch[1];
$Dexterity = $char_info_fetch[2];
$Vitality = $char_info_fetch[3];
$Energy = $char_info_fetch[4];
    if ($Strength < 0) { $Strength = $Strength+65536; }
	if ($Dexterity < 0) { $Dexterity = $Dexterity+65536; }
	if ($Vitality < 0) { $Vitality = $Vitality+65536; }
	if ($Energy < 0) { $Energy = $Energy+65536; }

$pointdutru = $char_info_fetch[5];
$ClassType =  $char_info_fetch[6];
    switch ($ClassType){ 
    	case 0:
        case 1:
        case 2:
        case 3:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=0";
    	break;
    
    	case 16:
        case 17:
        case 18:
        case 19:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=16";
    	break;
    
    	case 32:
        case 33:
        case 34:
        case 35:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=32";
    	break;
        
        case 48:
        case 49:
        case 50:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=48";
    	break;
        
        case 64:
        case 65:
        case 66:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=64";
    	break;
        
        case 80:
        case 81:
        case 82:
        case 83:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=80";
    	break;
        
        case 96:
        case 97:
        case 98:
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=96";
    	break;
    
    	default :
            $point_default_query = "SELECT Strength, Dexterity, Vitality, Energy FROM DefaultClassType WHERE Class=0";
    }
    
    $point_default_result = $db->execute($point_default_query);
        check_queryerror($point_default_query, $point_default_result);
    $point_default = $point_default_result->fetchrow();
    $Strength_Default = $point_default[0];
    $Dexterity_Default = $point_default[1];
    $Vitality_Default = $point_default[2];
    $Energy_Default = $point_default[3];
    
    $LevelUpPoint = $LevelUpPoint + ($Strength + $Dexterity + $Vitality + $Energy) - ($Strength_Default + $Dexterity_Default + $Vitality_Default + $Energy_Default);
    $Strength = $Strength_Default;
    $Dexterity = $Dexterity_Default;
    $Vitality = $Vitality_Default;
    $Energy = $Energy_Default;
    

if($LevelUpPoint < 0) {
    echo "Point đã cộng vào các chỉ số quá ít không đủ để Reset Point"; exit();
}

if($LevelUpPoint > 65000) {
    $pointup = 65000;
    $pointdutru = $pointdutru + ($LevelUpPoint - 65000);
} else {
    $pointup = $LevelUpPoint;
}

kiemtra_doinv($login,$name);
kiemtra_online($login);

$char_update_query = "UPDATE Character SET LevelUpPoint = '$pointup', Strength = '$Strength', Dexterity = '$Dexterity', Vitality = '$Vitality', Energy = '$Energy', pointdutru='$pointdutru' WHERE Name='$name'";
$char_update_result = $db->Execute($char_update_query);
    check_queryerror($char_update_query, $char_update_result);

$msquery1 = "UPDATE MEMB_INFO SET [vpoint] = '$ktvpoint' WHERE memb___id = '$login'";
$msresults1= $db->Execute($msquery1) or die("Lỗi Query: $msquery1");

//Ghi vào Log nhung nhan vat Reset Point
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $resetpoint_vpoint Vpoint";
        $log_Des = "$name Reset Point. Trước: $char_info_fetch[0] điểm chưa cộng, $char_info_fetch[1] Sức mạnh, $char_info_fetch[2] Nhanh nhẹn, $char_info_fetch[3] Sinh lực, $char_info_fetch[4] Năng lượng, $char_info_fetch[5] điểm dự trữ. Sau: $pointup điểm chưa cộng, $Strength Sức mạnh, $Dexterity Nhanh nhẹn, $Vitality Sinh lực, $Energy Năng lượng, $pointdutru điểm dự trữ";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat tay tuy


	echo "<info>OK</info><point>$LevelUpPoint</point><pointdutru>$pointdutru</pointdutru>";
}

?>