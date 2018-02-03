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
include_once('config/config_hotrotanthu.php');
include_once('config/config_gioihanrs.php');
include_once('config/config_relife.php');
include_once('config/config_event.php');
include_once('config/config_chucnang.php');
include_once('config/config_point_rsday.php');
include_once('config/config_guild_balance.php');

$login = $_POST['login'];
$name = $_POST['name'];

$resetnow = $_POST['resetnow'];  $resetnow = abs(intval($resetnow));

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
_guild_xh();

$sql_PkLevel_check = $db->Execute("SELECT PkLevel FROM Character WHERE PkLevel > 3 AND AccountID = '$login' AND Name='$name'");
$PkLevel_check = $sql_PkLevel_check->numrows();

$sql_char_back_reged_check = $db->Execute("SELECT Name FROM Character_back WHERE Name='$name' and AccountID = '$login'"); 
$char_back_reged_check = $sql_char_back_reged_check->numrows();

$result = $db->Execute("Select Clevel,Resets,Money,LevelUpPoint,Class,Relifes,NoResetInDay,Resets_Time, Top50 From Character WHERE AccountID = '$login' AND Name='$name'");
$row = $result->fetchrow();
$clevel_before = $row[0];
$char_in_top = $row[8];
$char_relfe = $row[5];
$char_rsday = $row[6];

if($resetnow >0 && abs(intval($row[1])) == 0) {
    echo "Hệ thống Reset bị gián đoạn. Vui lòng Reset lại";
    exit();
}

$vpoint_result = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
$vpoint = $vpoint_result->fetchrow();

$check_jewel = $db->Execute("SELECT jewel_chao,jewel_cre,jewel_blue FROM MEMB_INFO WHERE memb___id='$login'");
$jewel = $check_jewel->fetchrow();

$thehe_result = $db->Execute("Select thehe From MEMB_INFO where memb___id='$login'");
$thehe_fetch = $thehe_result->fetchrow();
$thehe = $thehe_fetch[0];

$ResetDay = _get_reset_day($name,$timestamp);
if($char_rsday == 0 && $ResetDay > 0) {
    _topreset_erase_month($name, $month);
    $ResetDay = 0;
}
$CountNoResetInDay=$ResetDay+1;

//Begin Giới hạn Reset trong ngày
if($use_gioihanrs[$thehe] == 1) {
    
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
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $message = read_TagName($reponse, 'message');
        } elseif ($info == "OK") {
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

	if( isset($gioihanrs) && $ResetDay >= $gioihanrs) {
		echo "Bạn đã Reset hết số lần Reset trong ngày. Xin vui lòng Ủy thác và đợi Reset tiếp vào ngày mai"; exit();
	}
}
//End Giới hạn Reset trong ngày

if ($PkLevel_check > 0){ 
	 echo "Bạn đang là Sát thủ. Phải rửa tội trước khi Reset."; exit();
}

if ( ($row[1] >= $reset_cap_0) AND ($row[1] < $reset_cap_1) )
{
	$level = $level_cap_1;
	$zen = $zen_cap_1;
	$time_reset_next = $time_reset_next_1;
	$chao = $chao_cap_1;
	$cre = $cre_cap_1;
	$blue = $blue_cap_1;
}
elseif ( ($row[1] >= $reset_cap_1) AND ($row[1] < $reset_cap_2) )
{
	$level = $level_cap_2;
	$zen = $zen_cap_2;
	$time_reset_next = $time_reset_next_2;
	$chao = $chao_cap_2;
	$cre = $cre_cap_2;
	$blue = $blue_cap_2;
}
elseif ( ($row[1] >= $reset_cap_2) AND ($row[1] < $reset_cap_3) )
{
	$level = $level_cap_3;
	$zen = $zen_cap_3;
	$time_reset_next = $time_reset_next_3;
	$chao = $chao_cap_3;
	$cre = $cre_cap_3;
	$blue = $blue_cap_3;
}
elseif ( ($row[1] >= $reset_cap_3) AND ($row[1] < $reset_cap_4) )
{
	$level = $level_cap_4;
	$zen = $zen_cap_4;
	$time_reset_next = $time_reset_next_4;
	$chao = $chao_cap_4;
	$cre = $cre_cap_4;
	$blue = $blue_cap_4;
}
elseif ( ($row[1] >= $reset_cap_4) AND ($row[1] < $reset_cap_5) )
{
	$level = $level_cap_5;
	$zen = $zen_cap_5;
	$time_reset_next = $time_reset_next_5;
	$chao = $chao_cap_5;
	$cre = $cre_cap_5;
	$blue = $blue_cap_5;
}
elseif ( ($row[1] >= $reset_cap_5) AND ($row[1] < $reset_cap_6) )
{
	$level = $level_cap_6;
	$zen = $zen_cap_6;
	$time_reset_next = $time_reset_next_6;
	$chao = $chao_cap_6;
	$cre = $cre_cap_6;
	$blue = $blue_cap_6;
}
elseif ( ($row[1] >= $reset_cap_6) AND ($row[1] < $reset_cap_7) )
{
	$level = $level_cap_7;
	$zen = $zen_cap_7;
	$time_reset_next = $time_reset_next_7;
	$chao = $chao_cap_7;
	$cre = $cre_cap_7;
	$blue = $blue_cap_7;
}
elseif ( ($row[1] >= $reset_cap_7) AND ($row[1] < $reset_cap_8) )
{
	$level = $level_cap_8;
	$zen = $zen_cap_8;
	$time_reset_next = $time_reset_next_8;
	$chao = $chao_cap_8;
	$cre = $cre_cap_8;
	$blue = $blue_cap_8;
}
elseif ( ($row[1] >= $reset_cap_8) AND ($row[1] < $reset_cap_9) )
{
	$level = $level_cap_9;
	$zen = $zen_cap_9;
	$time_reset_next = $time_reset_next_9;
	$chao = $chao_cap_9;
	$cre = $cre_cap_9;
	$blue = $blue_cap_9;
}
elseif ( ($row[1] >= $reset_cap_9) AND ($row[1] < $reset_cap_10) )
{
	$level = $level_cap_10;
	$zen = $zen_cap_10;
	$time_reset_next = $time_reset_next_10;
	$chao = $chao_cap_10;
	$cre = $cre_cap_10;
	$blue = $blue_cap_10;
}
elseif ( ($row[1] >= $reset_cap_10) AND ($row[1] < $reset_cap_11) )
{
	$level = $level_cap_11;
	$zen = $zen_cap_11;
	$time_reset_next = $time_reset_next_11;
	$chao = $chao_cap_11;
	$cre = $cre_cap_11;
	$blue = $blue_cap_11;
}
elseif ( ($row[1] >= $reset_cap_11) AND ($row[1] < $reset_cap_12) )
{
	$level = $level_cap_12;
	$zen = $zen_cap_12;
	$time_reset_next = $time_reset_next_12;
	$chao = $chao_cap_12;
	$cre = $cre_cap_12;
	$blue = $blue_cap_12;
}
elseif ( ($row[1] >= $reset_cap_12) AND ($row[1] < $reset_cap_13) )
{
	$level = $level_cap_13;
	$zen = $zen_cap_13;
	$time_reset_next = $time_reset_next_13;
	$chao = $chao_cap_13;
	$cre = $cre_cap_13;
	$blue = $blue_cap_13;
}
elseif ( ($row[1] >= $reset_cap_13) AND ($row[1] < $reset_cap_14) )
{
	$level = $level_cap_14;
	$zen = $zen_cap_14;
	$time_reset_next = $time_reset_next_14;
	$chao = $chao_cap_14;
	$cre = $cre_cap_14;
	$blue = $blue_cap_14;
}
elseif ( ($row[1] >= $reset_cap_14) AND ($row[1] < $reset_cap_15) )
{
	$level = $level_cap_15;
	$zen = $zen_cap_15;
	$time_reset_next = $time_reset_next_15;
	$chao = $chao_cap_15;
	$cre = $cre_cap_15;
	$blue = $blue_cap_15;
}
elseif ( ($row[1] >= $reset_cap_15) AND ($row[1] < $reset_cap_16) )
{
	$level = $level_cap_16;
	$zen = $zen_cap_16;
	$time_reset_next = $time_reset_next_16;
	$chao = $chao_cap_16;
	$cre = $cre_cap_16;
	$blue = $blue_cap_16;
}
elseif ( ($row[1] >= $reset_cap_16) AND ($row[1] < $reset_cap_17) )
{
	$level = $level_cap_17;
	$zen = $zen_cap_17;
	$time_reset_next = $time_reset_next_17;
	$chao = $chao_cap_17;
	$cre = $cre_cap_17;
	$blue = $blue_cap_17;
}
elseif ( ($row[1] >= $reset_cap_17) AND ($row[1] < $reset_cap_18) )
{
	$level = $level_cap_18;
	$zen = $zen_cap_18;
	$time_reset_next = $time_reset_next_18;
	$chao = $chao_cap_18;
	$cre = $cre_cap_18;
	$blue = $blue_cap_18;
}
elseif ( ($row[1] >= $reset_cap_18) AND ($row[1] < $reset_cap_19) )
{
	$level = $level_cap_19;
	$zen = $zen_cap_19;
	$time_reset_next = $time_reset_next_19;
	$chao = $chao_cap_19;
	$cre = $cre_cap_19;
	$blue = $blue_cap_19;
}
elseif ( ($row[1] >= $reset_cap_19) AND ($row[1] < $reset_cap_20) )
{
	$level = $level_cap_20;
	$zen = $zen_cap_20;
	$time_reset_next = $time_reset_next_20;
	$chao = $chao_cap_20;
	$cre = $cre_cap_20;
	$blue = $blue_cap_20;
}

//Begin hỗ trợ tân thủ
if ($hotrotanthu == 1 && $char_in_top != 1) {
	
    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_hotrotanthu2.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'level'    =>  $level,
        'char_in_top'    =>  $char_in_top,
        
        'top2_rsredure'    =>  $top2_rsredure,
        'top3_rsredure'    =>  $top3_rsredure,
        'top4_rsredure'    =>  $top4_rsredure,
        'top10_rsredure'    =>  $top10_rsredure,
        'top20_rsredure'    =>  $top20_rsredure,
        'top30_rsredure'    =>  $top30_rsredure,
        'top40_rsredure'    =>  $top40_rsredure,
        'top50_rsredure'    =>  $top50_rsredure,
        'top50_over_rsredure'    =>  $top50_over_rsredure,
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $message = read_TagName($reponse, 'message');
        } elseif ($info == "OK") {
            $level = read_TagName($reponse, 'level');
            if(strlen($level) == 0) {
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
//End hỗ trợ tân thủ

switch ($char_relfe) {
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
	 echo "$name đang ReLife: $char_relfe - Reset: $row[1]. Để Reset tiếp bạn cần phải ReLife."; exit();
}

$relife = $char_relfe;
$resetold = $row[1];        $resetold = abs(intval($resetold));
$resetup = $resetold + 1;


//Cong thuc Reset
if ( ($jewel[0] < $chao) OR ($jewel[1] < $cre) OR ($jewel[2] < $blue) )
{
	echo "Bạn không đủ Jewel trong ngân hàng.<br>Số lần Reset hiện tại của bạn là $row[1]. Bạn cần $chao Chao , $cre Creation , $blue Blue Feather."; exit();
}
if ($row[0] < $level) {echo "$name cần $level level để Reset lần $resetup."; exit();}
if ($row[2] < $zen) {echo "$name cần $zen Zen để Reset lần $resetup."; exit();}

if($row[7] > $timestamp) $row[7] = 0;
$time_reset_next = $row[7]+$time_reset_next*60;
if ($time_reset_next > $timestamp) {
	$time_free = $time_reset_next - $timestamp;
	echo "$name cần $time_free giây nữa để Reset lần tiếp theo."; exit();
}

//Reset lần 1
if ($row[1] == $reset_cap_0)
	{
		$resetpoint=$point_relifes+$point_cap_1;
		$resetmoeny = $row[2] - $zen_cap_1;
		$leadership = $ml_relifes+$ml_cap_1;
	}
//Reset cấp 1
elseif ($row[1] < $reset_cap_1)
	{
		$resetpoint=$point_relifes+$point_cap_1+$row[1]*$point_cap_1;
		$resetmoeny = $row[2] - $zen_cap_1;
		$leadership = $ml_relifes+$ml_relifes+$ml_cap_1+$row[1]*$ml_cap_1;
	}
//Reset cấp 1 -> 2
elseif ($row[1] >= $reset_cap_1 AND $row[1] < $reset_cap_2)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($row[1]-($reset_cap_1-1))*$point_cap_2;
		$resetmoeny = $row[2] - $zen_cap_2;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($row[1]-($reset_cap_1-1))*$ml_cap_2;
	}
//Reset cấp 2 -> 3
elseif ($row[1] >= $reset_cap_2 AND $row[1] < $reset_cap_3)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($row[1]-($reset_cap_2-1))*$point_cap_3;
		$resetmoeny = $row[2] - $zen_cap_3;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($row[1]-($reset_cap_2-1))*$ml_cap_3;
	}
//Reset cấp 3 -> 4
elseif ($row[1] >= $reset_cap_3 AND $row[1] < $reset_cap_4)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($row[1]-($reset_cap_3-1))*$point_cap_4;
		$resetmoeny = $row[2] - $zen_cap_4;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($row[1]-($reset_cap_3-1))*$ml_cap_4;
	}
//Reset cấp 4 -> 5
elseif ($row[1] >= $reset_cap_4 AND $row[1] < $reset_cap_5)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($row[1]-($reset_cap_4-1))*$point_cap_5;
		$resetmoeny = $row[2] - $zen_cap_5;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($row[1]-($reset_cap_4-1))*$ml_cap_5;
	}
//Reset cấp 5 -> 6
elseif ($row[1] >= $reset_cap_5 AND $row[1] < $reset_cap_6)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($row[1]-($reset_cap_5-1))*$point_cap_6;
		$resetmoeny = $row[2] - $zen_cap_6;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($row[1]-($reset_cap_5-1))*$ml_cap_6;
	}
//Reset cấp 6 -> 7
elseif ($row[1] >= $reset_cap_6 AND $row[1] < $reset_cap_7)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($row[1]-($reset_cap_6-1))*$point_cap_7;
		$resetmoeny = $row[2] - $zen_cap_7;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($row[1]-($reset_cap_6-1))*$ml_cap_7;
	}
//Reset cấp 7 -> 8
elseif ($row[1] >= $reset_cap_7 AND $row[1] < $reset_cap_8)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($row[1]-($reset_cap_7-1))*$point_cap_8;
		$resetmoeny = $row[2] - $zen_cap_8;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($row[1]-($reset_cap_7-1))*$ml_cap_8;
	}
//Reset cấp 8 -> 9
elseif ($row[1] >= $reset_cap_8 AND $row[1] < $reset_cap_9)
	 {
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($row[1]-($reset_cap_8-1))*$point_cap_9;
		$resetmoeny = $row[2] - $zen_cap_9;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($row[1]-($reset_cap_8-1))*$ml_cap_9;
	}
//Reset cấp 9 -> 10
elseif ($row[1] >= $reset_cap_9 AND $row[1] < $reset_cap_10)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($row[1]-($reset_cap_9-1))*$point_cap_10;
		$resetmoeny = $row[2] - $zen_cap_10;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($row[1]-($reset_cap_9-1))*$ml_cap_10;
	 }
//Reset cấp 10 -> 11
elseif ($row[1] >= $reset_cap_10 AND $row[1] < $reset_cap_11)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($row[1]-($reset_cap_10-1))*$point_cap_11;
		$resetmoeny = $row[2] - $zen_cap_11;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($row[1]-($reset_cap_10-1))*$ml_cap_11;
	}
//Reset cấp 11 -> 12
elseif ($row[1] >= $reset_cap_11 AND $row[1] < $reset_cap_12)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($row[1]-($reset_cap_11-1))*$point_cap_12;
		$resetmoeny = $row[2] - $zen_cap_12;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($row[1]-($reset_cap_11-1))*$ml_cap_12;
	 }
//Reset cấp 12 -> 13
elseif ($row[1] >= $reset_cap_12 AND $row[1] < $reset_cap_13)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($row[1]-($reset_cap_12-1))*$point_cap_13;
		$resetmoeny = $row[2] - $zen_cap_13;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($row[1]-($reset_cap_12-1))*$ml_cap_13;
	}
//Reset cấp 13 -> 14
elseif ($row[1] >= $reset_cap_13 AND $row[1] < $reset_cap_14)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($row[1]-($reset_cap_13-1))*$point_cap_14;
		$resetmoeny = $row[2] - $zen_cap_14;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($row[1]-($reset_cap_13-1))*$ml_cap_14;
	}
//Reset cấp 14 -> 15
elseif ($row[1] >= $reset_cap_14 AND $row[1] < $reset_cap_15)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($row[1]-($reset_cap_14-1))*$point_cap_15;
		$resetmoeny = $row[2] - $zen_cap_15;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($row[1]-($reset_cap_14-1))*$ml_cap_15;
	}
//Reset cấp 15 -> 16
elseif ($row[1] >= $reset_cap_15 AND $row[1] < $reset_cap_16)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($point_cap_15*($reset_cap_15-$reset_cap_14))+($row[1]-($reset_cap_15-1))*$point_cap_16;
		$resetmoeny = $row[2] - $zen_cap_16;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($ml_cap_15*($reset_cap_15-$reset_cap_14))+($row[1]-($reset_cap_15-1))*$ml_cap_16;
	}
//Reset cấp 16 -> 17
elseif ($row[1] >= $reset_cap_16 AND $row[1] < $reset_cap_17)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($point_cap_15*($reset_cap_15-$reset_cap_14))+($point_cap_16*($reset_cap_16-$reset_cap_15))+($row[1]-($reset_cap_16-1))*$point_cap_17;
		$resetmoeny = $row[2] - $zen_cap_17;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($ml_cap_15*($reset_cap_15-$reset_cap_14))+($ml_cap_16*($reset_cap_16-$reset_cap_15))+($row[1]-($reset_cap_16-1))*$ml_cap_17;
	}
//Reset cấp 17 -> 18
elseif ($row[1] >= $reset_cap_17 AND $row[1] < $reset_cap_18)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($point_cap_15*($reset_cap_15-$reset_cap_14))+($point_cap_16*($reset_cap_16-$reset_cap_15))+($point_cap_17*($reset_cap_17-$reset_cap_16))+($row[1]-($reset_cap_17-1))*$point_cap_18;
		$resetmoeny = $row[2] - $zen_cap_18;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($ml_cap_15*($reset_cap_15-$reset_cap_14))+($ml_cap_16*($reset_cap_16-$reset_cap_15))+($ml_cap_17*($reset_cap_17-$reset_cap_16))+($row[1]-($reset_cap_17-1))*$ml_cap_18;
	}
//Reset cấp 18 -> 19
elseif ($row[1] >= $reset_cap_18 AND $row[1] < $reset_cap_19)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($point_cap_15*($reset_cap_15-$reset_cap_14))+($point_cap_16*($reset_cap_16-$reset_cap_15))+($point_cap_17*($reset_cap_17-$reset_cap_16))+($point_cap_18*($reset_cap_18-$reset_cap_17))+($row[1]-($reset_cap_18-1))*$point_cap_19;
		$resetmoeny = $row[2] - $zen_cap_19;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($ml_cap_15*($reset_cap_15-$reset_cap_14))+($ml_cap_16*($reset_cap_16-$reset_cap_15))+($ml_cap_17*($reset_cap_17-$reset_cap_16))+($ml_cap_18*($reset_cap_18-$reset_cap_17))+($row[1]-($reset_cap_18-1))*$ml_cap_19;
	}
//Reset cấp 19 -> 20
elseif ($row[1] >= $reset_cap_19 AND $row[1] < $reset_cap_20)
	{
		$resetpoint=$point_relifes+($point_cap_1*$reset_cap_1)+($point_cap_2*($reset_cap_2-$reset_cap_1))+($point_cap_3*($reset_cap_3-$reset_cap_2))+($point_cap_4*($reset_cap_4-$reset_cap_3))+($point_cap_5*($reset_cap_5-$reset_cap_4))+($point_cap_6*($reset_cap_6-$reset_cap_5))+($point_cap_7*($reset_cap_7-$reset_cap_6))+($point_cap_8*($reset_cap_8-$reset_cap_7))+($point_cap_9*($reset_cap_9-$reset_cap_8))+($point_cap_10*($reset_cap_10-$reset_cap_9))+($point_cap_11*($reset_cap_11-$reset_cap_10))+($point_cap_12*($reset_cap_12-$reset_cap_11))+($point_cap_13*($reset_cap_13-$reset_cap_12))+($point_cap_14*($reset_cap_14-$reset_cap_13))+($point_cap_15*($reset_cap_15-$reset_cap_14))+($point_cap_16*($reset_cap_16-$reset_cap_15))+($point_cap_17*($reset_cap_17-$reset_cap_16))+($point_cap_18*($reset_cap_18-$reset_cap_17))+($point_cap_19*($reset_cap_19-$reset_cap_18))+($row[1]-($reset_cap_19-1))*$point_cap_20;
		$resetmoeny = $row[2] - $zen_cap_20;
		$leadership=$ml_relifes+($ml_cap_1*$reset_cap_1)+($ml_cap_2*($reset_cap_2-$reset_cap_1))+($ml_cap_3*($reset_cap_3-$reset_cap_2))+($ml_cap_4*($reset_cap_4-$reset_cap_3))+($ml_cap_5*($reset_cap_5-$reset_cap_4))+($ml_cap_6*($reset_cap_6-$reset_cap_5))+($ml_cap_7*($reset_cap_7-$reset_cap_6))+($ml_cap_8*($reset_cap_8-$reset_cap_7))+($ml_cap_9*($reset_cap_9-$reset_cap_8))+($ml_cap_10*($reset_cap_10-$reset_cap_9))+($ml_cap_11*($reset_cap_11-$reset_cap_10))+($ml_cap_12*($reset_cap_12-$reset_cap_11))+($ml_cap_13*($reset_cap_13-$reset_cap_12))+($ml_cap_14*($reset_cap_14-$reset_cap_13))+($ml_cap_15*($reset_cap_15-$reset_cap_14))+($ml_cap_16*($reset_cap_16-$reset_cap_15))+($ml_cap_17*($reset_cap_17-$reset_cap_16))+($ml_cap_18*($reset_cap_18-$reset_cap_17))+($ml_cap_19*($reset_cap_19-$reset_cap_18))+($row[1]-($reset_cap_19-1))*$ml_cap_20;
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

$point_event_qr = $db->Execute("SELECT point_event FROM Character WHERE AccountID = '$login' AND Name='$name'");
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
        $point_songtu_msg = "<br />Cấp độ Song Tu : $songtulv cấp. Nhận thêm $point_songtu_percent % = + <strong>$point_songtu Point</strong>.";
    }
}


$point_msg = "Point theo Reset : <strong>$resetpoint Point</strong>.";
$point_msg .= "<br />Point Event Huy chương : <strong>$point_event Point</strong>";
$point_msg .= "<br />Ngày hôm qua Reset $rsday_yesterday lần, thưởng $point_rsday_percent % : + <strong>$point_rsday Point</strong> ($cfg_point_rsday_rs RS / $cfg_point_rsday_percent % Point)";
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
    $log_Des = "$name Reset lần thứ $resetup quá nhanh. Cách lần Reset trước $phut_chenh phút $giay_chenh giây";
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

// Reset Total
$reset_total = 0;
if($char_relfe >= 1) $reset_total += $rl_reset_relife1;
if($char_relfe >= 2) $reset_total += $rl_reset_relife2;
if($char_relfe >= 3) $reset_total += $rl_reset_relife3;
if($char_relfe >= 4) $reset_total += $rl_reset_relife4;
if($char_relfe >= 5) $reset_total += $rl_reset_relife5;
if($char_relfe >= 6) $reset_total += $rl_reset_relife6;
if($char_relfe >= 7) $reset_total += $rl_reset_relife7;
if($char_relfe >= 8) $reset_total += $rl_reset_relife8;
if($char_relfe >= 9) $reset_total += $rl_reset_relife9;
if($char_relfe >= 10) $reset_total += $rl_reset_relife10;
$reset_total += $resetup;
// Reset Total End


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
	$sql_reset_script="Update dbo.character set [clevel]='$clevel',[experience]='0',[money]='$resetmoeny',[LevelUpPoint]='$LevelUpPoint',[pointdutru]='$point_dutru',[resets]=$resetup, ResetNBB=$resetup,[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='0',[Leadership]='$leadership',[isThuePoint]='0',[NoResetInDay]=$CountNoResetInDay,[Resets_Time]='$timestamp',[ResetVIP]='0',[PointThue]='0', [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0', [reset_total]=$reset_total where AccountID = '$login' AND name='$name'";
	$sql_reset_exec = $db->Execute($sql_reset_script) or die("Lỗi Query: $sql_reset_script");

//Nhan vat dang ki tai sinh
	if ($char_back_reged_check > 0) {
	$msquery = "Update Character_back set [Resets]=$resetup, [LevelUpPoint]='$point_total',[Class]='$row[4]',[Leadership]='$leadership',[Relifes]='$char_relfe' where AccountID = '$login' AND name='$name'";
	$msresults= $db->Execute($msquery);
	}
}

//Reset nhan vat khong phai la DarkLord
else
 {
	$sql_reset_script="Update Character set [clevel]='$clevel',[experience]='0',[money]='$resetmoeny',[LevelUpPoint]='$LevelUpPoint',[pointdutru]='$point_dutru',[resets]=$resetup, ResetNBB=$resetup,[strength]='$Strength',[dexterity]='$Dexterity',[vitality]='$Vitality',[energy]='$Energy',[Life]='$Life',[MaxLife]='$MaxLife',[Mana]='$Mana',[MaxMana]='$MaxMana',[MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='$Mapdir',[Leadership]='0',[isThuePoint]='0',[NoResetInDay]=$CountNoResetInDay,[Resets_Time]='$timestamp',[ResetVIP]='0',[PointThue]='0', [PkLevel] = '3',[PkTime] = '0',[pkcount] = '0', [reset_total]=$reset_total where AccountID = '$login' AND name='$name'";
	$sql_reset_exec = $db->Execute($sql_reset_script) or die("Lỗi Query: $sql_reset_script");

//All Quest For Class 3
//if ($row[4] == $class_dw_3 OR $row[4] == $class_dk_3 OR $row[4] == $class_elf_3 OR $row[4] == $class_mg_2 OR $row[4] == $class_dl_2 OR $row[4] == $class_sum_3) {
//		$sql_all_quest = $db->Execute($all_quest);
//	}
	
	if ($char_back_reged_check > 0) {
		$msquery = "Update Character_back set [Resets]=$resetup,[LevelUpPoint]='$point_total',[Class]='$row[4]',[Relifes]='$char_relfe' where AccountID = '$login' AND name='$name'";
		$msresults= $db->Execute($msquery);
	}
}

//Reset Point Master Skill
//include_once('MasterLV.php');

$tru_jewel = $db->Execute("UPDATE MEMB_INFO SET jewel_chao=jewel_chao-$chao,jewel_cre=jewel_cre-$cre,jewel_blue=jewel_blue-$blue WHERE memb___id='$login'");

if($Use_TuLuyen == 1) {
    $tuluyen_point = $CountNoResetInDay;
    $tuluyen_point_update_query = "UPDATE Character SET nbbtuluyen_point = nbbtuluyen_point + $tuluyen_point WHERE Name='$name' AND AccountID='$login'";
    $tuluyen_point_update_result = $db->Execute($tuluyen_point_update_query);
        check_queryerror($tuluyen_point_update_query, $tuluyen_point_update_result);
}

if($Use_SongTu == 1) {
    $songtu_point = $CountNoResetInDay;
    $songtu_point_update_query = "UPDATE Character SET nbbsongtu_point = nbbsongtu_point + $songtu_point WHERE Name='$name' AND AccountID='$login'";
    $songtu_point_update_result = $db->Execute($songtu_point_update_query);
        check_queryerror($songtu_point_update_query, $songtu_point_update_result);
}

if($Use_CuongHoa == 1) {
    $cuonghoa_point = $CountNoResetInDay;
    $cuonghoa_point_update_q = "UPDATE Character SET nbbcuonghoa_point = nbbcuonghoa_point + $cuonghoa_point WHERE Name='$name' AND AccountID='$login'";
    $cuonghoa_point_update_r = $db->Execute($cuonghoa_point_update_q);
        check_queryerror($cuonghoa_point_update_q, $cuonghoa_point_update_r);
    $cuonghoa_msg = "<hr />Nhận : <strong>$cuonghoa_point Điểm Cường Hóa</strong> tương ứng lần Reset thứ $CountNoResetInDay trong ngày.";
}

if($Use_HoanHaoHoa == 1) {
    $hoanhaohoa_point = $CountNoResetInDay;
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

$danhvong_point = $danhvong_basic + $danhvong_extra;


$danhvong_msg = "Nhận được : <strong>$danhvong_basic điểm Danh Vọng</strong>.";
if($clevel_before >= 300) {
    $danhvong_msg .= "<br /> Reset trên 300LV nhận thêm : <strong>$danhvong_extra điểm Danh Vọng</strong> (tăng $danhvong_extra_percent %).<br />Tổng Điểm Danh Vọng nhận được : <strong>$danhvong_point</strong> Điểm Danh Vọng.";
} else {
    $danhvong_msg .= "<br />Reset dưới 300LV, không được nhận thêm Điểm Danh Vọng.";
}

_topreset($login, $name);
_topreset_score($login, $name, $danhvong_point);

//Event TOP Reset in Time
include_once('event_toprs_intime.php');
//Event GiftCode Reset
include_once('sv_giftcode_rs.php');

if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    if($Use_SendMess_RS == 1) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. '] '. $name .' Reset lần thứ '. $resetup;
        
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

//Ghi vào Log nhung nhan vàt Reset
/*
        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "";
        $log_Des = "";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
*/
        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = " - ";
        $log_Des = "<b>$name</b> Reset lần thứ <b>$resetup</b> khi ". $row[0] ." Level/". $resetold ." Reset, Relife $relife.<br />$point_msg .<br /> $danhvong_msg";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vàt Reset tren 0 lan

    $reponse = "<info>OK</info>
    <resetmoeny>$resetmoeny</resetmoeny>
    <resetpoint>$LevelUpPoint</resetpoint>
    <pointdutru>$point_dutru</pointdutru>
    <messenge>$name Reset lần thứ $resetup thành công!<hr />$danhvong_msg";
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
    $reponse .= "<hr>$messenge_giftcode";
    $reponse .= "</messenge>";
    
    echo $reponse;
}

?>