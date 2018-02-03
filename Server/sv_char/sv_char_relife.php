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
 

include_once('config/config_reset.php');
include_once('config/config_relife.php');

$login = $_POST['login'];
$name = $_POST['name'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

fixrs($name);

kiemtra_doinv($login,$name);
kiemtra_online($login);

$sql_PkLevel_check = $db->Execute("SELECT PkLevel FROM Character WHERE PkLevel > 3 and Name='$name'");
$PkLevel_check = $sql_PkLevel_check->numrows();

$sql_char_back_reged_check = $db->Execute("SELECT Name FROM Character_back WHERE Name='$name' and AccountID = '$login'"); 
$char_back_reged_check = $sql_char_back_reged_check->numrows();

$result = $db->Execute("Select Clevel,Resets,Class,Relifes From Character where Name='$name'");
$row = $result->fetchrow();

if ($PkLevel_check > 0){ 
	 echo "Bạn đang là Sát thủ. Phải rửa tội trước khi ReLife."; exit();
}

if ($row[0] < 400){ 
	echo "Bạn chưa đủ Level để ReLife. Bạn cần phải đạt Level 400 mới có thể ReLife."; exit();
}

$relife_old = $row[3];  $relife_old = abs(intval($relife_old));


switch ($relife_old) {
	case 0:
		$rl_reset_relifes = $rl_reset_relife1;
		$rl_point_relifes = $rl_point_relife1;
		$rl_ml_relifes = $rl_ml_relife1;
		$relife = 1;
		break;
	case 1:
		$rl_reset_relifes = $rl_reset_relife2;
		$rl_point_relifes = $rl_point_relife2;
		$rl_ml_relifes = $rl_ml_relife2;
		$relife = 2;
		break;
	case 2:
		$rl_reset_relifes = $rl_reset_relife3;
		$rl_point_relifes = $rl_point_relife3;
		$rl_ml_relifes = $rl_ml_relife3;
		$relife = 3;
		break;
	case 3:
		$rl_reset_relifes = $rl_reset_relife4;
		$rl_point_relifes = $rl_point_relife4;
		$rl_ml_relifes = $rl_ml_relife4;
		$relife = 4;
		break;
	case 4:
		$rl_reset_relifes = $rl_reset_relife5;
		$rl_point_relifes = $rl_point_relife5;
		$rl_ml_relifes = $rl_ml_relife5;
		$relife = 5;
		break;
	case 5:
		$rl_reset_relifes = $rl_reset_relife6;
		$rl_point_relifes = $rl_point_relife6;
		$rl_ml_relifes = $rl_ml_relife6;
		$relife = 6;
		break;
	case 6:
		$rl_reset_relifes = $rl_reset_relife7;
		$rl_point_relifes = $rl_point_relife7;
		$rl_ml_relifes = $rl_ml_relife7;
		$relife = 7;
		break;
	case 7:
		$rl_reset_relifes = $rl_reset_relife7;
		$rl_point_relifes = $rl_point_relife7;
		$rl_ml_relifes = $rl_ml_relife7;
		$relife = 8;
		break;
	case 8:
		$rl_reset_relifes = $rl_reset_relife8;
		$rl_point_relifes = $rl_point_relife8;
		$rl_ml_relifes = $rl_ml_relife8;
		$relife = 9;
		break;
	case 9:
		$rl_reset_relifes = $rl_reset_relife9;
		$rl_point_relifes = $rl_point_relife9;
		$rl_ml_relifes = $rl_ml_relife9;
		$relife = 10;
		break;
	case 10:
		$rl_reset_relifes = $rl_reset_relife10;
		$rl_point_relifes = $rl_point_relife10;
		$rl_ml_relifes = $rl_ml_relife10;
		$relife = 11;
		break;
	default:
		$rl_reset_relifes = 99999;
		$rl_point_relifes = 0;
		$rl_ml_relifes = 0;
		$relife = 0;
		break;
}

if ($row[1] < $rl_reset_relifes) {
	echo "$name cần $rl_reset_relifes Reset để ReLife";exit();
}

$ClassType =  $row[2];
    switch ($ClassType){ 
    	case 0:
        case 1:
        case 2:
        case 3:
            $Class_Default = 0;
    	break;
    
    	case 16:
        case 17:
        case 18:
        case 19:
            $Class_Default = 16;
    	break;
    
    	case 32:
        case 33:
        case 34:
        case 35:
            $Class_Default = 32;
    	break;
        
        case 48:
        case 49:
        case 50:
            $Class_Default = 48;
    	break;
        
        case 64:
        case 65:
        case 66:
            $Class_Default = 64;
    	break;
        
        case 80:
        case 81:
        case 82:
        case 83:
            $Class_Default = 80;
    	break;
        
        case 96:
        case 97:
        case 98:
            $Class_Default = 96;
    	break;
    
    	default :
            $Class_Default = 0;
    }
    $default_query = "SELECT Strength, Dexterity, Vitality, Energy, Life, MaxLife, Mana, MaxMana, MapNumber, MapPosX, MapPosY FROM DefaultClassType WHERE Class=" . $Class_Default;
    $default_result = $db->execute($default_query);
        check_queryerror($default_query, $default_result);
    $point_default = $default_result->fetchrow();
    $Strength_Default = $point_default[0];
    $Dexterity_Default = $point_default[1];
    $Vitality_Default = $point_default[2];
    $Energy_Default = $point_default[3];
    $Life_Default = $point_default[4];
    $MaxLife_Default = $point_default[5];
    $Mana_Default = $point_default[6];
    $MaxMana_Default = $point_default[7];
    $MapNumber_Default = abs(intval($point_default[8]));
    $MapPosX_Default = abs(intval($point_default[9]));
    $MapPosY_Default = abs(intval($point_default[10]));
    
    
	$Strength = $Strength_Default;
    $Dexterity = $Dexterity_Default;
    $Vitality = $Vitality_Default;
    $Energy = $Energy_Default;
    $Life = $Life_Default;
    $MaxLife = $MaxLife_Default;
    $Mana = $Mana_Default;
    $MaxMana = $MaxMana_Default;
    $MapNumber = $MapNumber_Default;
    $MapPosX = $MapPosX_Default;
    $MapPosY = $MapPosY_Default;
    $Mapdir=0;

    $Point_Default_total = $Strength + $Dexterity + $Vitality + $Energy;

//Tat ca cac Quest
$all_quest="Update character set Quest=0xaaeaffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff where name='$name'";

$point_event_qr = $db->Execute("SELECT point_event FROM Character WHERE Name='$name'");
$point_event = $point_event_qr->fetchrow();
	$rl_point_relifes = $rl_point_relifes + $point_event[0];

if( $rl_point_relifes > 65000) {
    $pointup = 65000;
    $pointdutru = $rl_point_relifes - 65000;
} else {
    $pointup = $rl_point_relifes;
    $pointdutru = 0;
}

kiemtra_doinv($login,$name);
kiemtra_online($login);

//Nhan vat la Dark Lord
if ( $row[2] == $class_dl_1 OR $row[2] == $class_dl_2 )
	{
		$sql_relife_script="Update character set [clevel]='6',[experience]='0',[LevelUpPoint]='$pointup',[pointdutru]='$pointdutru',[Relifes]='$relife',[Leadership]='$rl_ml_relifes',[resets]='0', ResetNBB='0',[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='$Mapdir',[isThuePoint]='0',[ResetVIP]='0',[PointThue]='0' where name='$name'";
		$sql_relife_exec = $db->Execute($sql_relife_script);
	 }
//Nhan vat khong phai DarkLord
else
	{
		$sql_relife_script="Update character set [clevel]='6',[experience]='0',[LevelUpPoint]='$pointup',[pointdutru]='$pointdutru',[Relifes]='$relife',[resets]='0', ResetNBB='0',[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='$Mapdir',[ResetVIP]='0',[PointThue]='0' where name='$name'";
		$sql_relife_exec = $db->Execute($sql_relife_script);
	}

//All Quest For Class 3
/*
if ($row[2] == $class_dw_3 OR $row[2] == $class_dk_3 OR $row[2] == $class_elf_3) {
		$sql_all_quest = $db->Execute($all_quest);
}
*/

//Reset Point Master Skill
//include_once('MasterLV.php');

//Begin Luu data tai sinh
	if ($char_back_reged_check > 0) {
		$msquery = "Update Character_back set [Resets]='0',[LevelUpPoint]='$rl_point_relifes',[Class]='$row[2]',[Relifes]='$relife' where name='$name'";
		$msresults= $db->Execute($msquery);
	}
//End Luu data tai sinh


if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    if($Use_SendMess_Relife == 1) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. ']Chúc mừng '. $name .' Relife lần thứ '. $relife;
        
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_sendmess.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'mess_send'    =>  $mess_send
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
        $info = read_TagName($reponse, 'info');
        if ($info == "OK") {
            $mess_receive = read_TagName($reponse, 'mess_receive', 0);
            $mess_total = $mess_receive[0];
            
            for($i=1; $i<=$mess_total; $i++) {
                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                if ($x = socket_connect($socket, '127.0.0.1', $joinserver_port))
                {
                    socket_write($socket, $mess_receive[$i]);
                } else {
                    socket_close($socket);
                    break;
                }
                socket_close($socket);
            }
        }
    }
}

//Ghi vào Log nhung nhan vàt ReLife tren 0 lan
if ($row[1] >= 0)
{
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = " - ";
        $log_Des = "<b>$name</b> Relife lần thứ <b>$relife</b> thành công";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
}
//End Ghi vào Log nhung nhan vat ReLife tren 0 lan

echo "OK<nbb>$rl_point_relifes<netbanbe>$name ReLife lần thứ $relife thành công! Sau khi ReLife hãy vào phần <b>Rút Point</b> để lấy Point sử dụng";
}

?>