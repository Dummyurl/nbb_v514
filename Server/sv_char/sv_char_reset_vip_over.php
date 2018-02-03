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
include_once('config/config_resetvip.php');
include_once('config/config_gioihanrs.php');
include_once('config/config_relife.php');
include_once('config/config_event.php');
include_once('config/config_resetvip_over.php');
include_once('config/config_chucnang.php');
include_once('config/config_point_rsday.php');
include_once('config/config_guild_balance.php');

$login = $_POST['login'];
$name = $_POST['name'];
$tiente = $_POST['tiente'];

$resetnow = $_POST['resetnow'];  $resetnow = abs(intval($resetnow));

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);
if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
$thehe_result = $db->Execute($thehe_query);
    check_queryerror($thehe_query, $thehe_result);
$thehe_fetch = $thehe_result->fetchrow();
$thehe = $thehe_fetch[0];
if($use_gioihanrs[$thehe] == 0) {
    echo "Phải bật chức năng <strong>Giới hạn Reset</strong> mới sử dụng được chức năng Reset OVER<strong></strong>. Hiện chức năng <strong>Giới hạn Reset</strong> chưa bật."; exit();
}

fixrs($name);
kiemtra_doinv($login,$name);
kiemtra_online($login);
_guild_xh();

$spl_PkLevel_query = "SELECT PkLevel FROM Character WHERE PkLevel > 3 and AccountID = '$login' AND Name='$name'";
$sql_PkLevel_check = $db->Execute($spl_PkLevel_query);
    check_queryerror($spl_PkLevel_query,$sql_PkLevel_check);
$PkLevel_check = $sql_PkLevel_check->numrows();

$sql_char_back_reged_query = "SELECT Name FROM Character_back WHERE Name='$name' and AccountID = '$login'";
$sql_char_back_reged_check = $db->Execute($sql_char_back_reged_query); 
    check_queryerror($sql_char_back_reged_query,$sql_char_back_reged_check);
$char_back_reged_check = $sql_char_back_reged_check->numrows();

$query = "Select Clevel,Resets,Money,LevelUpPoint,Class,Relifes,NoResetInDay,Resets_Time, Top50 From Character where AccountID = '$login' AND Name='$name'";
$result = $db->Execute($query);
    check_queryerror($query,$result);
$row = $result->fetchrow();
$clevel_before = $row[0];
$char_in_top = $row[8];
$char_rsday = $row[6];

if($resetnow >0 && abs(intval($row[1])) == 0) {
    echo "Hệ thống Reset bị gián đoạn. Vui lòng Reset lại";
    exit();
}

$gcoin_query = "Select gcoin, gcoin_km, vpoint From MEMB_INFO where memb___id='$login'";
$gcoin_result = $db->Execute($gcoin_query);
    check_queryerror($gcoin_query, $gcoin_result);
$gcoin = $gcoin_result->fetchrow();

if ($PkLevel_check > 0){ 
	 echo "Bạn đang là Sát thủ. Phải rửa tội trước khi Reset."; exit();
}

$ResetDay = _get_reset_day($name,$timestamp);
if($char_rsday == 0 && $ResetDay > 0) {
    _topreset_erase_month($name, $month);
    $ResetDay = 0;
}
$CountNoResetInDay=$ResetDay+1;

$gcoin_extra = 0;
//Begin Giới hạn Reset trong ngày

    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_gioihanrs2.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'char_in_top'    =>  $char_in_top,
        'gioihanrs_top1'    =>  $gioihanrs_top1[$thehe],
        'gioihanrs_top2'    =>  $gioihanrs_top2[$thehe],
        'gioihanrs_top3'    =>  $gioihanrs_top3[$thehe],
        'gioihanrs_top4'    =>  $gioihanrs_top4[$thehe],
        'gioihanrs_top10'    =>  $gioihanrs_top10[$thehe],
        'gioihanrs_top20'    =>  $gioihanrs_top20[$thehe],
        'gioihanrs_top30'    =>  $gioihanrs_top30[$thehe],
        'gioihanrs_top40'    =>  $gioihanrs_top40[$thehe],
        'gioihanrs_top50'    =>  $gioihanrs_top50[$thehe],
        'gioihanrs_other'    =>  $gioihanrs_other[$thehe],
        'overrs_sat_extra'    =>  $overrs_sat_extra[$thehe],
        'overrs_sun_extra'    =>  $overrs_sun_extra[$thehe],
        'dayofweek'         =>  date('w', $timestamp)
    ); 

$reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

if ( empty($reponse) ) {
    $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
    echo $notice;
    exit();
}
else {
    $info = read_TagName($reponse, 'info');
    if($info == "Error") {
        $message = read_TagName($reponse, 'message');
        echo $message;
        exit();
    } elseif($info == "OK") {
        $gioihanrs = read_TagName($reponse, 'gioihanrs');
        if(strlen($gioihanrs) == 0) {
            echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
            $arr_view = "\nDataSend:\n";
            foreach($getcontent_data as $k => $v) {
                $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
            }
            writelog("log_api.txt", $arr_view . $reponse);
            exit();
        }
    } else {
        echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
        writelog("log_api.txt", $reponse);
        exit();
    }
}

if($use_overrs[$thehe] == 0) {
    $overrs_rs[$thehe] = 0;
}
if( isset($gioihanrs) && $ResetDay < ($gioihanrs + $overrs_rs[$thehe])) {
	echo "Bạn chưa Reset đủ số lần Reset trong ngày và Reset vượt mức."; exit();
}
//End Giới hạn Reset trong ngày

if ( ($row[1] >= $reset_cap_0) AND ($row[1] < $reset_cap_1) )
{
	$level = $level_cap_1_vip;
	$gcoin_reset_vip = $gcoin_cap_1_vip;
	$time_reset_next = $time_reset_next_1;
    $uythacpoint_min = $uythacpoint_cap1_min;
    $uythacpoint_max = $uythacpoint_cap1_max;
}
elseif ( ($row[1] >= $reset_cap_1) AND ($row[1] < $reset_cap_2) )
{
	$level = $level_cap_2_vip;
	$gcoin_reset_vip = $gcoin_cap_2_vip;
	$time_reset_next = $time_reset_next_2;
    $uythacpoint_min = $uythacpoint_cap2_min;
    $uythacpoint_max = $uythacpoint_cap2_max;
}
elseif ( ($row[1] >= $reset_cap_2) AND ($row[1] < $reset_cap_3) )
{
	$level = $level_cap_3_vip;
	$gcoin_reset_vip = $gcoin_cap_3_vip;
	$time_reset_next = $time_reset_next_3;
    $uythacpoint_min = $uythacpoint_cap3_min;
    $uythacpoint_max = $uythacpoint_cap3_max;
}
elseif ( ($row[1] >= $reset_cap_3) AND ($row[1] < $reset_cap_4) )
{
	$level = $level_cap_4_vip;
	$gcoin_reset_vip = $gcoin_cap_4_vip;
	$time_reset_next = $time_reset_next_4;
    $uythacpoint_min = $uythacpoint_cap4_min;
    $uythacpoint_max = $uythacpoint_cap4_max;
}
elseif ( ($row[1] >= $reset_cap_4) AND ($row[1] < $reset_cap_5) )
{
	$level = $level_cap_5_vip;
	$gcoin_reset_vip = $gcoin_cap_5_vip;
	$time_reset_next = $time_reset_next_5;
    $uythacpoint_min = $uythacpoint_cap5_min;
    $uythacpoint_max = $uythacpoint_cap5_max;
}
elseif ( ($row[1] >= $reset_cap_5) AND ($row[1] < $reset_cap_6) )
{
	$level = $level_cap_6_vip;
	$gcoin_reset_vip = $gcoin_cap_6_vip;
	$time_reset_next = $time_reset_next_6;
    $uythacpoint_min = $uythacpoint_cap6_min;
    $uythacpoint_max = $uythacpoint_cap6_max;
}
elseif ( ($row[1] >= $reset_cap_6) AND ($row[1] < $reset_cap_7) )
{
	$level = $level_cap_7_vip;
	$gcoin_reset_vip = $gcoin_cap_7_vip;
	$time_reset_next = $time_reset_next_7;
    $uythacpoint_min = $uythacpoint_cap7_min;
    $uythacpoint_max = $uythacpoint_cap7_max;
}
elseif ( ($row[1] >= $reset_cap_7) AND ($row[1] < $reset_cap_8) )
{
	$level = $level_cap_8_vip;
	$gcoin_reset_vip = $gcoin_cap_8_vip;
	$time_reset_next = $time_reset_next_8;
    $uythacpoint_min = $uythacpoint_cap8_min;
    $uythacpoint_max = $uythacpoint_cap8_max;
}
elseif ( ($row[1] >= $reset_cap_8) AND ($row[1] < $reset_cap_9) )
{
	$level = $level_cap_9_vip;
	$gcoin_reset_vip = $gcoin_cap_9_vip;
	$time_reset_next = $time_reset_next_9;
    $uythacpoint_min = $uythacpoint_cap9_min;
    $uythacpoint_max = $uythacpoint_cap9_max;
}
elseif ( ($row[1] >= $reset_cap_9) AND ($row[1] < $reset_cap_10) )
{
	$level = $level_cap_10_vip;
	$gcoin_reset_vip = $gcoin_cap_10_vip;
	$time_reset_next = $time_reset_next_10;
    $uythacpoint_min = $uythacpoint_cap10_min;
    $uythacpoint_max = $uythacpoint_cap10_max;
}
elseif ( ($row[1] >= $reset_cap_10) AND ($row[1] < $reset_cap_11) )
{
	$level = $level_cap_11_vip;
	$gcoin_reset_vip = $gcoin_cap_11_vip;
	$time_reset_next = $time_reset_next_11;
    $uythacpoint_min = $uythacpoint_cap11_min;
    $uythacpoint_max = $uythacpoint_cap11_max;
}
elseif ( ($row[1] >= $reset_cap_11) AND ($row[1] < $reset_cap_12) )
{
	$level = $level_cap_12_vip;
	$gcoin_reset_vip = $gcoin_cap_12_vip;
	$time_reset_next = $time_reset_next_12;
    $uythacpoint_min = $uythacpoint_cap12_min;
    $uythacpoint_max = $uythacpoint_cap12_max;
}
elseif ( ($row[1] >= $reset_cap_12) AND ($row[1] < $reset_cap_13) )
{
	$level = $level_cap_13_vip;
	$gcoin_reset_vip = $gcoin_cap_13_vip;
	$time_reset_next = $time_reset_next_13;
    $uythacpoint_min = $uythacpoint_cap13_min;
    $uythacpoint_max = $uythacpoint_cap13_max;
}
elseif ( ($row[1] >= $reset_cap_13) AND ($row[1] < $reset_cap_14) )
{
	$level = $level_cap_14_vip;
	$gcoin_reset_vip = $gcoin_cap_14_vip;
	$time_reset_next = $time_reset_next_14;
    $uythacpoint_min = $uythacpoint_cap14_min;
    $uythacpoint_max = $uythacpoint_cap14_max;
}
elseif ( ($row[1] >= $reset_cap_14) AND ($row[1] < $reset_cap_15) )
{
	$level = $level_cap_15_vip;
	$gcoin_reset_vip = $gcoin_cap_15_vip;
	$time_reset_next = $time_reset_next_15;
    $uythacpoint_min = $uythacpoint_cap15_min;
    $uythacpoint_max = $uythacpoint_cap15_max;
}
elseif ( ($row[1] >= $reset_cap_15) AND ($row[1] < $reset_cap_16) )
{
	$level = $level_cap_16_vip;
	$gcoin_reset_vip = $gcoin_cap_16_vip;
	$time_reset_next = $time_reset_next_16;
    $uythacpoint_min = $uythacpoint_cap16_min;
    $uythacpoint_max = $uythacpoint_cap16_max;
}
elseif ( ($row[1] >= $reset_cap_16) AND ($row[1] < $reset_cap_17) )
{
	$level = $level_cap_17_vip;
	$gcoin_reset_vip = $gcoin_cap_17_vip;
	$time_reset_next = $time_reset_next_17;
    $uythacpoint_min = $uythacpoint_cap17_min;
    $uythacpoint_max = $uythacpoint_cap17_max;
}
elseif ( ($row[1] >= $reset_cap_17) AND ($row[1] < $reset_cap_18) )
{
	$level = $level_cap_18_vip;
	$gcoin_reset_vip = $gcoin_cap_18_vip;
	$time_reset_next = $time_reset_next_18;
    $uythacpoint_min = $uythacpoint_cap18_min;
    $uythacpoint_max = $uythacpoint_cap18_max;
}
elseif ( ($row[1] >= $reset_cap_18) AND ($row[1] < $reset_cap_19) )
{
	$level = $level_cap_19_vip;
	$gcoin_reset_vip = $gcoin_cap_19_vip;
	$time_reset_next = $time_reset_next_19;
    $uythacpoint_min = $uythacpoint_cap19_min;
    $uythacpoint_max = $uythacpoint_cap19_max;
}
elseif ( ($row[1] >= $reset_cap_19) AND ($row[1] < $reset_cap_20) )
{
	$level = $level_cap_20_vip;
	$gcoin_reset_vip = $gcoin_cap_20_vip;
	$time_reset_next = $time_reset_next_20;
    $uythacpoint_min = $uythacpoint_cap20_min;
    $uythacpoint_max = $uythacpoint_cap20_max;
}
$uythacpoint = rand($uythacpoint_min, $uythacpoint_max);

$gcoin_before = $gcoin[0];
$gcoin_km_before = $gcoin[1];
$vpoint_before = $gcoin[2];
$vpointnew = $gcoin[2];
$gcoinnew = $gcoin[0];
$gcoin_km = $gcoin[1];
$gcoin_total = $gcoinnew + $gcoin_km;
if ($tiente == 'gcoin') {
    $gcoin_rs = $gcoin_reset_vip+$gcoin_extra;
    
    // Reduce Gcoin For Union Castle Begin
    include('config/config_castleown_gcoin_reduce.php');
    if($castleown_gcoin_reduce_enable == 1) {
         $castle_onwer = _castleown($name, $castleown_gcoin_reduce_day);
        if($castle_onwer == 1) {
            $gcoin_rs_castle_owner_before = $gcoin_rs;
            $gcoin_rs = floor($gcoin_rs*(100-$castleown_gcoin_reduce_percent)/100);
            $gcoin_rs_notice = $gcoin_rs_castle_owner_before - $gcoin_rs;
            $castle_onwer_notice = "Chi phí : $gcoin_rs_castle_owner_before Gcoin.<br /> Bạn thuộc Liên Minh giữ thành. Được giảm <strong>". $castleown_gcoin_reduce_percent ."%</strong> chi phí. Chỉ mất : $gcoin_rs Gcoin.<br />Tiết kiệm :<strong> $gcoin_rs_notice Gcoin</strong>";
        } else if($castle_onwer == 2) {
            $castle_onwer_notice = "Bạn thuộc Liên Minh giữ thành nhưng cách trận CTC trước quá 7 ngày. Vì vậy không được giảm Gcoin.";
        } else if($castle_onwer == 4) {
            $castle_onwer_notice = "Bang hội của bạn giữ thành nhưng không có Liên Minh. Vì vậy không được giảm Gcoin.";
        }
    }
    // Reduce Gcoin For Union Castle End
    
	if ( $gcoin_total < $gcoin_rs ) 
	{
		echo "Không có đủ gcoin yêu cầu Reset. Bạn đang Reset $row[1] lần. Bạn cần có $gcoin_rs gcoin chi phí Reset VIP"; exit();
	}
	else {
	   
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_resetvip.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'tiente'    =>  $tiente,
            'gcoinnew'    =>  $gcoinnew,
            'gcoin_km'    =>  $gcoin_km,
            'gcoin_rs'    =>  $gcoin_rs
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
            echo $notice;
            exit();
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $message = read_TagName($reponse, 'message');
                echo $message;
                exit();
            } elseif ($info == "OK") {
                $gcoinnew = read_TagName($reponse, 'gcoinnew');
                $gcoin_km = read_TagName($reponse, 'gcoin_km');
                if(strlen($gcoinnew) == 0 || strlen($gcoin_km) == 0) {
                    echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                    $arr_view = "\nDataSend:\n";
                    foreach($getcontent_data as $k => $v) {
                        $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                    }
                    writelog("log_api.txt", $arr_view . $reponse);
                    exit();
                }
            } else {
                echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                writelog("log_api.txt", $reponse);
                exit();
            }
        }
	}
} elseif ($tiente == 'vpoint') {
	include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_resetvip.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'tiente'    =>  $tiente,
        'gcoin_reset_vip'    =>  $gcoin_reset_vip,
        'vpoint_extra'    =>  $vpoint_extra,
        'vpointnew'    =>  $vpointnew
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
        echo $notice;
        exit();
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $message = read_TagName($reponse, 'message');
            echo $message;
            exit();
        } elseif ($info == "OK") {
            $vpointnew = read_TagName($reponse, 'vpointnew');
            if(strlen($vpointnew) == 0) {
                echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                $arr_view = "\nDataSend:\n";
                foreach($getcontent_data as $k => $v) {
                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                }
                writelog("log_api.txt", $arr_view . $reponse);
                exit();
            }
        } else {
            echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
            writelog("log_api.txt", $reponse);
            exit();
        }
    }
} else { echo "Sai loại tiền tệ"; exit(); }

$relife = $row[5];
$resetold = $row[1];        $resetold = abs(intval($resetold));
$resetup = $resetold;

if ($row[0] < $level) {echo "$name cần $level level để Reset lần $resetup."; exit();}

if($row[7] > $timestamp) $row[7] = 0;
$time_reset_next = $row[7]+$time_reset_next*60;
if ($time_reset_next > $timestamp) {
	$time_free = $time_reset_next - $timestamp;
	echo "$name cần $time_free giây nữa để Reset lần tiếp theo."; exit();
}

switch ($row[5]) {
	case 0:
		$reset_relifes = $rl_reset_relife1;
		$point_relifes = 0;
		$ml_relifes = 0;
		break;
	case 1:
		$reset_relifes = $rl_reset_relife2;
		$point_relifes = $rl_point_relife1;
		$ml_relifes = $rl_ml_relife1;
		break;
	case 2:
		$reset_relifes = $rl_reset_relife3;
		$point_relifes = $rl_point_relife2;
		$ml_relifes = $rl_ml_relife2;
		break;
	case 3:
		$reset_relifes = $rl_reset_relife4;
		$point_relifes = $rl_point_relife3;
		$ml_relifes = $rl_ml_relife3;
		break;
	case 4:
		$reset_relifes = $rl_reset_relife5;
		$point_relifes = $rl_point_relife4;
		$ml_relifes = $rl_ml_relife4;
		break;
	case 5:
		$reset_relifes = $rl_reset_relife6;
		$point_relifes = $rl_point_relife5;
		$ml_relifes = $rl_ml_relife5;
		break;
	case 6:
		$reset_relifes = $rl_reset_relife7;
		$point_relifes = $rl_point_relife6;
		$ml_relifes = $rl_ml_relife6;
		break;
	case 7;
		$reset_relifes = $rl_reset_relife8;
		$point_relifes = $rl_point_relife7;
		$ml_relifes = $rl_ml_relife7;
		break;
	case 8:
		$reset_relifes = $rl_reset_relife9;
		$point_relifes = $rl_point_relife8;
		$ml_relifes = $rl_ml_relife8;
		break;
	case 9:
		$reset_relifes = $rl_reset_relife10;
		$point_relifes = $rl_point_relife9;
		$ml_relifes = $rl_ml_relife9;
		break;
	case 10:
		$reset_relifes = $rl_reset_relife11;
		$point_relifes = $rl_point_relife10;
		$ml_relifes = $rl_ml_relife10;
		break;
}

if ( $row[1] >= $reset_relifes ) { 
	 echo "$name đang ReLife: $row[5] - Reset: $row[1]. Để Reset tiếp bạn cần phải ReLife."; exit();
}

//Reset lần 1
if ($row[1] == $reset_cap_0)
	{
		$resetpoint=$point_relifes+$point_cap_1_vip;
		$leadership = $ml_relifes+$ml_cap_1_vip;
	}
//Reset cấp 1
elseif ($row[1] < $reset_cap_1)
	{
		$resetpoint=$point_relifes+$point_cap_1_vip+$row[1]*$point_cap_1_vip;
		$leadership = $ml_relifes+$ml_relifes+$ml_cap_1_vip+$row[1]*$ml_cap_1_vip;
	}
//Reset cấp 1 -> 2
elseif ($row[1] >= $reset_cap_1 AND $row[1] < $reset_cap_2)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($row[1]-($reset_cap_1-1))*$point_cap_2_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($row[1]-($reset_cap_1-1))*$ml_cap_2_vip;
	}
//Reset cấp 2 -> 3
elseif ($row[1] >= $reset_cap_2 AND $row[1] < $reset_cap_3)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($row[1]-($reset_cap_2-1))*$point_cap_3_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($row[1]-($reset_cap_2-1))*$ml_cap_3_vip;
	}
//Reset cấp 3 -> 4
elseif ($row[1] >= $reset_cap_3 AND $row[1] < $reset_cap_4)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($row[1]-($reset_cap_3-1))*$point_cap_4_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($row[1]-($reset_cap_3-1))*$ml_cap_4_vip;
	}
//Reset cấp 4 -> 5
elseif ($row[1] >= $reset_cap_4 AND $row[1] < $reset_cap_5)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($row[1]-($reset_cap_4-1))*$point_cap_5_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($row[1]-($reset_cap_4-1))*$ml_cap_5_vip;
	}
//Reset cấp 5 -> 6
elseif ($row[1] >= $reset_cap_5 AND $row[1] < $reset_cap_6)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($row[1]-($reset_cap_5-1))*$point_cap_6_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($row[1]-($reset_cap_5-1))*$ml_cap_6_vip;
	}
//Reset cấp 6 -> 7
elseif ($row[1] >= $reset_cap_6 AND $row[1] < $reset_cap_7)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($row[1]-($reset_cap_6-1))*$point_cap_7_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($row[1]-($reset_cap_6-1))*$ml_cap_7_vip;
	}
//Reset cấp 7 -> 8
elseif ($row[1] >= $reset_cap_7 AND $row[1] < $reset_cap_8)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($row[1]-($reset_cap_7-1))*$point_cap_8_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($row[1]-($reset_cap_7-1))*$ml_cap_8_vip;
	}
//Reset cấp 8 -> 9
elseif ($row[1] >= $reset_cap_8 AND $row[1] < $reset_cap_9)
	 {
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($row[1]-($reset_cap_8-1))*$point_cap_9_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($row[1]-($reset_cap_8-1))*$ml_cap_9_vip;
	}
//Reset cấp 9 -> 10
elseif ($row[1] >= $reset_cap_9 AND $row[1] < $reset_cap_10)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($row[1]-($reset_cap_9-1))*$point_cap_10_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($row[1]-($reset_cap_9-1))*$ml_cap_10_vip;
	 }
//Reset cấp 10 -> 11
elseif ($row[1] >= $reset_cap_10 AND $row[1] < $reset_cap_11)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($row[1]-($reset_cap_10-1))*$point_cap_11_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($row[1]-($reset_cap_10-1))*$ml_cap_11_vip;
	}
//Reset cấp 11 -> 12
elseif ($row[1] >= $reset_cap_11 AND $row[1] < $reset_cap_12)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($row[1]-($reset_cap_11-1))*$point_cap_12_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($row[1]-($reset_cap_11-1))*$ml_cap_12_vip;
	 }
//Reset cấp 12 -> 13
elseif ($row[1] >= $reset_cap_12 AND $row[1] < $reset_cap_13)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($row[1]-($reset_cap_12-1))*$point_cap_13_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($row[1]-($reset_cap_12-1))*$ml_cap_13_vip;
	}
//Reset cấp 13 -> 14
elseif ($row[1] >= $reset_cap_13 AND $row[1] < $reset_cap_14)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($row[1]-($reset_cap_13-1))*$point_cap_14_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($row[1]-($reset_cap_13-1))*$ml_cap_14_vip;
	}
//Reset cấp 14 -> 15
elseif ($row[1] >= $reset_cap_14 AND $row[1] < $reset_cap_15)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($row[1]-($reset_cap_14-1))*$point_cap_15_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($row[1]-($reset_cap_14-1))*$ml_cap_15_vip;
	}
//Reset cấp 15 -> 16
elseif ($row[1] >= $reset_cap_15 AND $row[1] < $reset_cap_16)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($point_cap_15_vip*($reset_cap_15-$reset_cap_14))+($row[1]-($reset_cap_15-1))*$point_cap_16_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($ml_cap_15_vip*($reset_cap_15-$reset_cap_14))+($row[1]-($reset_cap_15-1))*$ml_cap_16_vip;
	}
//Reset cấp 16 -> 17
elseif ($row[1] >= $reset_cap_16 AND $row[1] < $reset_cap_17)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($point_cap_15_vip*($reset_cap_15-$reset_cap_14))+($point_cap_16_vip*($reset_cap_16-$reset_cap_15))+($row[1]-($reset_cap_16-1))*$point_cap_17_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($ml_cap_15_vip*($reset_cap_15-$reset_cap_14))+($ml_cap_16_vip*($reset_cap_16-$reset_cap_15))+($row[1]-($reset_cap_16-1))*$ml_cap_17_vip;
	}
//Reset cấp 17 -> 18
elseif ($row[1] >= $reset_cap_17 AND $row[1] < $reset_cap_18)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($point_cap_15_vip*($reset_cap_15-$reset_cap_14))+($point_cap_16_vip*($reset_cap_16-$reset_cap_15))+($point_cap_17_vip*($reset_cap_17-$reset_cap_16))+($row[1]-($reset_cap_17-1))*$point_cap_18_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($ml_cap_15_vip*($reset_cap_15-$reset_cap_14))+($ml_cap_16_vip*($reset_cap_16-$reset_cap_15))+($ml_cap_17_vip*($reset_cap_17-$reset_cap_16))+($row[1]-($reset_cap_17-1))*$ml_cap_18_vip;
	}
//Reset cấp 18 -> 19
elseif ($row[1] >= $reset_cap_18 AND $row[1] < $reset_cap_19)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($point_cap_15_vip*($reset_cap_15-$reset_cap_14))+($point_cap_16_vip*($reset_cap_16-$reset_cap_15))+($point_cap_17_vip*($reset_cap_17-$reset_cap_16))+($point_cap_18_vip*($reset_cap_18-$reset_cap_17))+($row[1]-($reset_cap_18-1))*$point_cap_19_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($ml_cap_15_vip*($reset_cap_15-$reset_cap_14))+($ml_cap_16_vip*($reset_cap_16-$reset_cap_15))+($ml_cap_17_vip*($reset_cap_17-$reset_cap_16))+($ml_cap_18_vip*($reset_cap_18-$reset_cap_17))+($row[1]-($reset_cap_18-1))*$ml_cap_19_vip;
	}
//Reset cấp 19 -> 20
elseif ($row[1] >= $reset_cap_19 AND $row[1] < $reset_cap_20)
	{
		$resetpoint=$point_relifes+($point_cap_1_vip*$reset_cap_1)+($point_cap_2_vip*($reset_cap_2-$reset_cap_1))+($point_cap_3_vip*($reset_cap_3-$reset_cap_2))+($point_cap_4_vip*($reset_cap_4-$reset_cap_3))+($point_cap_5_vip*($reset_cap_5-$reset_cap_4))+($point_cap_6_vip*($reset_cap_6-$reset_cap_5))+($point_cap_7_vip*($reset_cap_7-$reset_cap_6))+($point_cap_8_vip*($reset_cap_8-$reset_cap_7))+($point_cap_9_vip*($reset_cap_9-$reset_cap_8))+($point_cap_10_vip*($reset_cap_10-$reset_cap_9))+($point_cap_11_vip*($reset_cap_11-$reset_cap_10))+($point_cap_12_vip*($reset_cap_12-$reset_cap_11))+($point_cap_13_vip*($reset_cap_13-$reset_cap_12))+($point_cap_14_vip*($reset_cap_14-$reset_cap_13))+($point_cap_15_vip*($reset_cap_15-$reset_cap_14))+($point_cap_16_vip*($reset_cap_16-$reset_cap_15))+($point_cap_17_vip*($reset_cap_17-$reset_cap_16))+($point_cap_18_vip*($reset_cap_18-$reset_cap_17))+($point_cap_19_vip*($reset_cap_19-$reset_cap_18))+($row[1]-($reset_cap_19-1))*$point_cap_20_vip;
		$leadership=$ml_relifes+($ml_cap_1_vip*$reset_cap_1)+($ml_cap_2_vip*($reset_cap_2-$reset_cap_1))+($ml_cap_3_vip*($reset_cap_3-$reset_cap_2))+($ml_cap_4_vip*($reset_cap_4-$reset_cap_3))+($ml_cap_5_vip*($reset_cap_5-$reset_cap_4))+($ml_cap_6_vip*($reset_cap_6-$reset_cap_5))+($ml_cap_7_vip*($reset_cap_7-$reset_cap_6))+($ml_cap_8_vip*($reset_cap_8-$reset_cap_7))+($ml_cap_9_vip*($reset_cap_9-$reset_cap_8))+($ml_cap_10_vip*($reset_cap_10-$reset_cap_9))+($ml_cap_11_vip*($reset_cap_11-$reset_cap_10))+($ml_cap_12_vip*($reset_cap_12-$reset_cap_11))+($ml_cap_13_vip*($reset_cap_13-$reset_cap_12))+($ml_cap_14_vip*($reset_cap_14-$reset_cap_13))+($ml_cap_15_vip*($reset_cap_15-$reset_cap_14))+($ml_cap_16_vip*($reset_cap_16-$reset_cap_15))+($ml_cap_17_vip*($reset_cap_17-$reset_cap_16))+($ml_cap_18_vip*($reset_cap_18-$reset_cap_17))+($ml_cap_19_vip*($reset_cap_19-$reset_cap_18))+($row[1]-($reset_cap_19-1))*$ml_cap_20_vip;
	}
//Fix Menh lenh DarkLord > 32k
	if ( $leadership>32000 ) $leadership=32000;

	
$ClassType =  $row[4];
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
    $Life_Default = abs(intval($point_default[4]));
    $MaxLife_Default = abs(intval($point_default[5]));
    $Mana_Default = abs(intval($point_default[6]));
    $MaxMana_Default = abs(intval($point_default[7]));
    $MapNumber_Default = abs(intval($point_default[8]));
    $MapPosX_Default = abs(intval($point_default[9]));
    $MapPosY_Default = abs(intval($point_default[10]));
    
$point_tl = _point_tuluyen($name);
	$Strength = $Strength_Default + $point_tl['str'];
    $Dexterity = $Dexterity_Default + $point_tl['agi'];
    $Vitality = $Vitality_Default + $point_tl['vit'];
    $Energy = $Energy_Default + $point_tl['ene'];
    $Life = $Life_Default;
    $MaxLife = $MaxLife_Default;
    $Mana = $Mana_Default;
    $MaxMana = $MaxMana_Default;
    $MapNumber = $MapNumber_Default;
    $MapPosX = $MapPosX_Default;
    $MapPosY = $MapPosY_Default;
    $Mapdir=0;

    $Point_Default_total = $Strength + $Dexterity + $Vitality + $Energy;
//End Cong thuc Reset

//Tat ca cac Quest
$all_quest="Update character set Quest=0xaaeaffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff where AccountID = '$login' AND name='$name'";
if( intval($level_after_reset) > 6 ) $clevel = $level_after_reset;
else $clevel = 6;

// Point Reset Day
    $point_rsday = 0;
    $rsday_yesterday = _get_reset_day($name, $timestamp - 24*60*60);
    $point_rsday_percent = floor($rsday_yesterday/$cfg_point_rsday_rs) * $cfg_point_rsday_percent;
    $point_rsday = floor($resetpoint * $point_rsday_percent / 100);
// Point Reset Day End

$point_event_query = "SELECT point_event FROM Character WHERE AccountID = '$login' AND Name='$name'";
$point_event_qr = $db->Execute($point_event_query);
    check_queryerror($point_event_query, $point_event_qr);
$point_event_f = $point_event_qr->fetchrow();
$point_event = $point_event_f[0];

	$point_total = $resetpoint + $point_event + $point_rsday;

$point_songtu_msg = "";
$point_songtu = 0;
if($Use_SongTu == 1) {
    include_once('config/config_songtu.php');
    $songtu_q = "SELECT SCFMarried, nbbsongtu_lv FROM Character WHERE Name='$name'";
    $songtu_r = $db->Execute($songtu_q);
        check_queryerror($songtu_q, $songtu_r);
    $songtu_f = $songtu_r->FetchRow();
    $married = $songtu_f[0];
    $songtulv = $songtu_f[1];
    if($married != 1) {
        $point_songtu_msg = "<br />Bạn chưa Kết hôn, không nhận được thêm điểm thưởng do kết hôn.";
    } else {
        $point_songtu_percent = $songtu_pointpercent * (1 + $songtulv);
        $point_songtu = floor($point_songtu_percent * $resetpoint / 100);
        $point_total += $point_songtu;
        $point_songtu_msg = "<br />Cấp độ Song Tu : $songtulv cấp. Nhận thêm $point_songtu_percent % = <strong>$point_songtu Point</strong>.";
    }
}



$point_msg = "Point theo Reset : <strong>$resetpoint Point</strong>.";
$point_msg .= "<br />Point Event Huy chương : <strong>$point_event Point</strong>";
$point_msg .= "<br />Ngày hôm qua Reset $rsday_yesterday lần, thưởng $point_rsday_percent % : <strong>$point_rsday Point</strong> ($cfg_point_rsday_rs RS / $cfg_point_rsday_percent % Point)";
$point_msg .= $point_songtu_msg;
$point_msg .= "<br /><strong>Tổng Point nhận được : <strong>$point_total Point</strong></strong>";

// Save TOP Point
$datetime_now = date('Y-m-d H:i:s', $timestamp);
$point_tuluyen = $point_tl['str'] + $point_tl['agi'] + $point_tl['vit'] + $point_tl['ene'];
$toppoint_check_q = "SELECT count(acc) FROM nbb_toppoint WHERE acc='$login' AND name='$name'";
$toppoint_check_r = $db->Execute($toppoint_check_q);
    check_queryerror($toppoint_check_q, $toppoint_check_r);
$toppoint_check_f = $toppoint_check_r->FetchRow();
$toppoint_check = $toppoint_check_f[0];
if($toppoint_check == 0) {  // Chua co du lieu, khoi tao moi
    $toppoint_q = "INSERT INTO nbb_toppoint (acc, name, point_total, point_rs, point_rsday, point_event, point_songtu, point_tuluyen, time_begin) VALUES ('$login', '$name', $point_total, $resetpoint, $point_rsday, $point_event, $point_songtu, $point_tuluyen, '$datetime_now')";
} else {
    $toppoint_q = "UPDATE nbb_toppoint SET point_total = $point_total, point_rs = $resetpoint, point_rsday = $point_rsday, point_event = $point_event, point_songtu = $point_songtu, point_tuluyen = $point_tuluyen, time_update = '$datetime_now' WHERE acc='$login' AND name='$name'";
}
$toppoint_r = $db->Execute($toppoint_q);
    check_queryerror($toppoint_q, $toppoint_r);
// Save TOP Point End

// Extra Point From Guild
$point_msg .= "<hr /><strong>Chính sách cân bằng thế lực :</strong>";
$guild_extra_point = _guild_extra_point($name);
if($guild_extra_point != 'none') {
    // Guild nhieu hon so thanh vien cho phep
    if($guild_extra_point['G_SlgMem'] > $guild_maxmem) {
        $point_overmem_redure = floor($guild_maxmem_redurepoint * $resetpoint / 100);
        $point_total -= $point_overmem_redure;
        $point_overmem_msg = "<br />Guild bạn có <strong>". $guild_extra_point['G_SlgMem'] ." thành viên</strong>. Nhiều hơn mức cho phép $guild_maxmem thành viên. <strong>Bị trừ $guild_maxmem_redurepoint % = - <strong>$point_overmem_redure Point</strong></strong>.";
    }
    $point_msg .= $point_overmem_msg;
    
    // Guild TOP 1 Lien Minh Guild TOP 2
    if($guild_extra_point['G_TopPoint'] == 1 || $guild_extra_point['G_TopPoint'] == 2) {
        $g_union_q = "SELECT G_Union FROM GUILD JOIN GuildMember ON GUILD.G_Name collate DATABASE_DEFAULT = GuildMember.G_Name collate DATABASE_DEFAULT AND Name='$name'";
        $g_union_r = $db->Execute($g_union_q);
            check_queryerror($g_union_q, $g_union_r);
        $g_union_f = $g_union_r->FetchRow();
        $g_union = $g_union_f[0];
        
        if($g_union > 0) {
        	if($guild_extra_point['G_TopPoint'] == 1) {
	            $toplm = 2;
	        } else {
	            $toplm = 1;
	        }
	        $g_union_top12chk_q = "SELECT count(*) FROM GUILD WHERE G_Union=$g_union AND G_TopPoint = $toplm";
	        $g_union_top12chk_r = $db->Execute($g_union_top12chk_q);
	            check_queryerror($g_union_top12chk_q, $g_union_top12chk_r);
	        $g_union_top12chk_f = $g_union_top12chk_r->FetchRow();
	        
	        if($g_union_top12chk_f[0] >= 1) {
	            $point_union12_redure = floor($guild_top12lm_redurepoint * $resetpoint / 100);
	            $point_total -= $point_union12_redure;
	            $point_union12_msg = "<br />Guild bạn <strong>TOP Point ". $guild_extra_point['G_TopPoint'] ."</strong> Liên Minh với Guild <strong>TOP Point $toplm</strong> . Bị trừ $guild_top12lm_redurepoint % = <strong>- $point_union12_redure Point</strong>.";
	        }
        }
    }
    $point_msg .= $point_union12_msg;
    
    
    // Ho tro Point Guild Yeu
    if($guild_extra_point['G_TopPoint'] == 1) {
        $point_gtop_msg = "<br />Guild bạn TOP 1 Guild Point nên không được hỗ trợ Point khi Reset.";
    } else {
        $point_gyeu_flag = true;
        if($guild_extra_point['G_SlgMem'] < $guild_addpoint_require_mem) {
            $point_gtop_msg .= "<br />Guild bạn chỉ có <strong>". $guild_extra_point['G_SlgMem'] ." thành viên</strong>. Không đủ điều kiện $guild_addpoint_require_mem thành viên để nhận Point hỗ trợ.";
            $point_gyeu_flag = false;
        }
        if($guild_extra_point['G_Created_day'] < $guild_addpoint_require_day) {
            $point_gtop_msg .= "<br />Guild bạn mới <strong>thành lập ". $guild_extra_point['G_Created_day'] ." ngày</strong>. Không đủ điều kiện Guild thành lập trên $guild_addpoint_require_day ngày để nhận Point hỗ trợ.";
            $point_gyeu_flag = false;
        }
        if($guild_extra_point['G_RSYesterday'] < $guild_addpoint_require_rs) {
            $point_gtop_msg .= "<br />Guild bạn <strong>hôm qua thực hiện ". $guild_extra_point['G_RSYesterday'] ." lần Reset</strong>. Không đủ điều kiện tổng số lần thực hiện Reset trong ngày hôm qua là $guild_addpoint_require_rs để nhận Point hỗ trợ.";
            $point_gyeu_flag = false;
        }
        
        if($point_gyeu_flag == true) {
            switch ($guild_extra_point['G_TopPoint']){ 
            	case 2:
                    
                    $point_gtop_extra = floor($guild_top2addpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>TOP ". $guild_extra_point['G_TopPoint'] ." Guild Point</strong>. Nhận thêm hỗ trợ $guild_top2addpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            	break;
            
            	case 3:
                    $point_gtop_extra = floor($guild_top3addpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>TOP ". $guild_extra_point['G_TopPoint'] ." Guild Point</strong>. Nhận thêm hỗ trợ $guild_top3addpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            	break;
                
                case 4:
                    $point_gtop_extra = floor($guild_top4addpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>TOP ". $guild_extra_point['G_TopPoint'] ." Guild Point</strong>. Nhận thêm hỗ trợ $guild_top4addpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            	break;
                
                case 5:
                    $point_gtop_extra = floor($guild_top5addpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>TOP ". $guild_extra_point['G_TopPoint'] ." Guild Point</strong>. Nhận thêm hỗ trợ $guild_top5addpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            	break;
                
                case 6:
                case 7:
                case 8:
                case 9:
                case 10:
                    $point_gtop_extra = floor($guild_top6overaddpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>TOP ". $guild_extra_point['G_TopPoint'] ." Guild Point</strong>. Nhận thêm hỗ trợ $guild_top6overaddpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            	break;
                
            	default :
                    $point_gtop_extra = floor($guild_top10overaddpoint * $resetpoint / 100);
                    $point_total += $point_gtop_extra;
                    $point_gtop_msg = "<br />Guild bạn <strong>không nằm trong TOP 10 Guild Point</strong>. Nhận thêm hỗ trợ $guild_top10overaddpoint % = <strong>+ $point_gtop_extra Point</strong>.";
            }
        }
    }
            
    $point_msg .= $point_gtop_msg;
    $point_msg .= "<br /><strong>Tổng Point cuối cùng nhận được : $point_total Point</strong>";
} else {
    $point_msg .= "<br />Bạn chưa vào Guild. Không nhận được hỗ trợ khi Reset.";
}
// Extra Point From Guild End

kiemtra_doinv($login,$name);
kiemtra_online($login);

// Ghi log nhung nhan vat Reset qua nhanh
if($timestamp < $row[7] + 300) {
    $time_chenh = $timestamp - $row[7];
    $phut_chenh = floor($time_chenh/60);
    $giay_chenh = $time_chenh%60;
    $log_Des = "$name Reset VIP lần thứ $resetup quá nhanh. Cách lần Reset trước $phut_chenh phút $giay_chenh giây";
    if($timestamp < $row[7] + 60) {
        $log_Des .= ". Khóa nhân vật.";
        //Block Char
        $block_query = "UPDATE Character SET ctlcode='99',ErrorSubBlock=99 WHERE AccountID = '$login' AND name='$name'";
        $block_result = $db->Execute($block_query);
            check_queryerror($block_query, $block_result);
        
        // Tru 1 lan Reset
        $resetup = $resetup - 1;
    }
    //Ghi vào Log Reset nhanh
        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = " - ";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log Reset nhanh
}
// End Ghi log nhung nhan vat Reset qua nhanh

if( $point_total > 65000) {
    $LevelUpPoint = 65000;
    $point_dutru = $point_total - 65000;
} else {
    $LevelUpPoint = $point_total;
    $point_dutru = 0;
}

// Reset nhan vat la Darklord
if ($row[4] == 64 OR $row[4] == 65 OR $row[4] == 66)
  {
	$sql_reset_script="Update dbo.character set [clevel]='$clevel',[experience]='0',[LevelUpPoint]='$LevelUpPoint',[pointdutru]='$point_dutru',[resets]=$resetup, ResetNBB=$resetup,[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='0',[Leadership]='$leadership',[isThuePoint]='0',[NoResetInDay]=$CountNoResetInDay,[Resets_Time]='$timestamp',[ResetVIP]='1',[PointThue]='0', PointUyThac=PointUyThac+$uythacpoint, [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0' where AccountID = '$login' AND name='$name'";
	$sql_reset_exec = $db->Execute($sql_reset_script);
        check_queryerror($sql_reset_script, $sql_reset_exec);

//Nhan vat dang ki tai sinh
	if ($char_back_reged_check > 0) {
	$msquery = "Update Character_back set [Resets]=$resetup,[LevelUpPoint]='$point_total',[Class]='$row[4]',[Leadership]='$leadership',[Relifes]='$row[5]' where AccountID = '$login' AND name='$name'";
	$msresults= $db->Execute($msquery);
        check_queryerror($msquery,$msresults);
	}
}

//Reset nhan vat khong phai la DarkLord
else
 {
	$sql_reset_script="Update Character set [clevel]='$clevel',[experience]='0',[LevelUpPoint]='$LevelUpPoint',[pointdutru]='$point_dutru',[resets]=$resetup, ResetNBB=$resetup,[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='$Mapdir',[Leadership]='0',[isThuePoint]='0',[NoResetInDay]=$CountNoResetInDay,[Resets_Time]='$timestamp',[ResetVIP]='1',[PointThue]='0', PointUyThac=PointUyThac+$uythacpoint, [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0' where AccountID = '$login' AND name='$name'";
	$sql_reset_exec = $db->Execute($sql_reset_script);
        check_queryerror($sql_reset_script, $sql_reset_exec);

//All Quest For Class 3
//if ($row[4] == $class_dw_3 OR $row[4] == $class_dk_3 OR $row[4] == $class_elf_3 OR $row[4] == $class_mg_2 OR $row[4] == $class_dl_2 OR $row[4] == $class_sum_3) {
//		$sql_all_quest = $db->Execute($all_quest);
//            check_queryerror($all_quest,$sql_all_quest);
//	}
    
	if ($char_back_reged_check > 0) {
		$msquery = "Update Character_back set [Resets]=$resetup,[LevelUpPoint]='$point_total',[Class]='$row[4]',[Relifes]='$row[5]' where AccountID = '$login' AND name='$name'";
		$msresults= $db->Execute($msquery);
            check_queryerror($msquery, $msquery);
	}
}

//Reset Point Master Skill
//include_once('MasterLV.php');


$tru_gcoin_query = "UPDATE MEMB_INFO SET [gcoin]=$gcoinnew, gcoin_km=$gcoin_km, [vpoint]=$vpointnew WHERE memb___id='$login'";    
$tru_gcoin = $db->Execute($tru_gcoin_query);
    check_queryerror($tru_gcoin_query, $tru_gcoin);

_use_money($login, $gcoin_before - $gcoinnew, $gcoin_km_before - $gcoin_km, $vpoint_before - $vpointnew);

if($Use_TuLuyen == 1) {
    $tuluyen_point = floor($CountNoResetInDay*1.5);
    $tuluyen_point_update_query = "UPDATE Character SET nbbtuluyen_point = nbbtuluyen_point + $tuluyen_point WHERE Name='$name' AND AccountID='$login'";
    $tuluyen_point_update_result = $db->Execute($tuluyen_point_update_query);
        check_queryerror($tuluyen_point_update_query, $tuluyen_point_update_result);
}

if($Use_SongTu == 1) {
    $songtu_point = floor($CountNoResetInDay*1.5);
    $songtu_point_update_query = "UPDATE Character SET nbbsongtu_point = nbbsongtu_point + $songtu_point WHERE Name='$name' AND AccountID='$login'";
    $songtu_point_update_result = $db->Execute($songtu_point_update_query);
        check_queryerror($songtu_point_update_query, $songtu_point_update_result);
}

if($Use_CuongHoa == 1) {
    $cuonghoa_point = floor($CountNoResetInDay*1.5);
    $cuonghoa_point_update_q = "UPDATE Character SET nbbcuonghoa_point = nbbcuonghoa_point + $cuonghoa_point WHERE Name='$name' AND AccountID='$login'";
    $cuonghoa_point_update_r = $db->Execute($cuonghoa_point_update_q);
        check_queryerror($cuonghoa_point_update_q, $cuonghoa_point_update_r);
    $cuonghoa_msg = "<hr />Nhận : <strong>$cuonghoa_point Điểm Cường Hóa</strong> tương ứng lần Reset thứ $CountNoResetInDay trong ngày.";
}

if($Use_HoanHaoHoa == 1) {
    $hoanhaohoa_point = floor($CountNoResetInDay*1.5);
    $hoanhao_point_update_q = "UPDATE Character SET nbbhoanhao_point = nbbhoanhao_point + $hoanhaohoa_point WHERE Name='$name' AND AccountID='$login'";
    $hoanhao_point_update_r = $db->Execute($hoanhao_point_update_q);
        check_queryerror($hoanhao_point_update_q, $hoanhao_point_update_r);
    $hoanhaohoa_msg = "<hr />Nhận : <strong>$hoanhaohoa_point Điểm Hoàn Hảo Hóa</strong> tương ứng lần Reset thứ $CountNoResetInDay trong ngày.";
}

$danhvong_basic = $clevel_before;

$danhvong_extra_mul = ($danhvong_basic - 300)/50;
if($danhvong_extra_mul < 0) $danhvong_extra_mul = 0;
$danhvong_extra = floor($danhvong_basic*$danhvong_extra_mul);
$danhvong_extra_percent = number_format($danhvong_extra_mul * 100, 0, ',', '.');

$danhvong_vip_percent = 20;
$danhvong_vip = floor($danhvong_basic * $danhvong_vip_percent/100);

$danhvong_point = $danhvong_basic + $danhvong_extra + $danhvong_vip;

$danhvong_msg = "Nhận được : <strong>$danhvong_basic điểm Danh Vọng</strong>.";
if($clevel_before >= 300) {
    $danhvong_msg .= "<br /> Reset trên 300LV nhận thêm : <strong>$danhvong_extra điểm Danh Vọng</strong> (tăng $danhvong_extra_percent %).";
} else {
    $danhvong_msg .= "<br />Reset dưới 300LV, không được nhận thêm Điểm Danh Vọng.";
}
$danhvong_msg .= "<br />Reset VIP nhận thêm <strong>$danhvong_vip điểm Danh Vọng</strong> (tăng $danhvong_vip_percent %).<br />Tổng Điểm Danh Vọng nhận được : <strong>$danhvong_point</strong> Điểm Danh Vọng.";

_topreset($login, $name, 1, 1);
_topreset_score($login, $name, $danhvong_point, 1);

//Event TOP Reset in Time
include_once('event_toprs_intime.php');

//Ghi vào Log nhung nhan vàt Reset VIP
        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->FetchRow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        if ($tiente == 'vpoint') 
        {
            $log_price = "- $vpoint_reset_vip Vpoint";
        } else 
        {
            $log_price = " - $gcoin_rs Gcoin";
        }
        
        $log_Des = "<b>$name</b> Reset OVER VIP khi ". $row[0] ." Level/". $resetold ." Reset, Relife $relife. Nhận $uythacpoint Điểm Ủy Thác.<br />$point_msg .<br /> $danhvong_msg";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vàt Reset tren 0 lan

    $reponse = "<info>OK</info>
    <gcoin>$gcoinnew</gcoin>
    <gcoin_km>$gcoin_km</gcoin_km>
    <vpoint>$vpointnew</vpoint>
    <resetpoint>$LevelUpPoint</resetpoint>
    <pointdutru>$point_dutru</pointdutru>
    <messenge>$name <strong>Reset OVER VIP</strong> ở lần Reset thứ <strong>$resetup</strong> thành công!<hr />Nhận được : <strong>$uythacpoint Điểm Ủy Thác</strong>.<hr />$danhvong_msg";
    if($Use_TuLuyen == 1) {
        $reponse .= "<hr />Nhận : <strong>$tuluyen_point Điểm Tu Luyện</strong> tương ứng lần Reset thứ $CountNoResetInDay trong ngày.<br />Tu Luyện Sức Mạnh : ". $point_tl['str'] ." điểm.<br />Tu Luyện Nhanh Nhẹn : ". $point_tl['agi'] ." điểm.<br />Tu Luyện Thể Lực : ". $point_tl['vit'] ." điểm.<br />Tu Luyện Năng Lượng : ". $point_tl['ene'] ." điểm.";
    }
    if($Use_SongTu == 1) {
        $reponse .= "<hr />Nhận : <strong>$songtu_point Điểm Song Tu</strong> tương ứng lần Reset thứ $CountNoResetInDay trong ngày.";
    }
    if($Use_CuongHoa == 1) {
        $reponse .= $cuonghoa_msg;
    }
    if($Use_HoanHaoHoa == 1) {
        $reponse .= $hoanhaohoa_msg;
    }
    
    $reponse .= "<hr />$point_msg.";
    if($point_dutru > 0) {
        $reponse .= "<br />Point sau khi Reset trên 65.000 Point. Bạn vào Game cộng điểm sau đó vào phần <b>Rút Point</b> để lấy Point còn lại";
    }
    $reponse .= "<hr />$messenge_giftcode";
    $reponse .= "</messenge>";
    
    echo $reponse;
}

?>