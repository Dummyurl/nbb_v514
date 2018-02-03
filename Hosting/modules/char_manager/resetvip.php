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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");
include('config/config_reset.php');
include('config/config_resetvip.php');
include('config/config_hotrotanthu.php');
include('config/config_gioihanrs.php');

$thehe_choise = $_SESSION['acc_thehe'];

if ( ($_SESSION['nv_reset'] >= $reset_cap_0) AND ($_SESSION['nv_reset'] < $reset_cap_1) )
{
	$level = $level_cap_1_vip;
	$gcoin_reset_vip = $gcoin_cap_1_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_1) AND ($_SESSION['nv_reset'] < $reset_cap_2) )
{
	$level = $level_cap_2_vip;
	$gcoin_reset_vip = $gcoin_cap_2_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_2) AND ($_SESSION['nv_reset'] < $reset_cap_3) )
{
	$level = $level_cap_3_vip;
	$gcoin_reset_vip = $gcoin_cap_3_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_3) AND ($_SESSION['nv_reset'] < $reset_cap_4) )
{
	$level = $level_cap_4_vip;
	$gcoin_reset_vip = $gcoin_cap_4_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_4) AND ($_SESSION['nv_reset'] < $reset_cap_5) )
{
	$level = $level_cap_5_vip;
	$gcoin_reset_vip = $gcoin_cap_5_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_5) AND ($_SESSION['nv_reset'] < $reset_cap_6) )
{
	$level = $level_cap_6_vip;
	$gcoin_reset_vip = $gcoin_cap_6_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_6) AND ($_SESSION['nv_reset'] < $reset_cap_7) )
{
	$level = $level_cap_7_vip;
	$gcoin_reset_vip = $gcoin_cap_7_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_7) AND ($_SESSION['nv_reset'] < $reset_cap_8) )
{
	$level = $level_cap_8_vip;
	$gcoin_reset_vip = $gcoin_cap_8_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_8) AND ($_SESSION['nv_reset'] < $reset_cap_9) )
{
	$level = $level_cap_9_vip;
	$gcoin_reset_vip = $gcoin_cap_9_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_9) AND ($_SESSION['nv_reset'] < $reset_cap_10) )
{
	$level = $level_cap_10_vip;
	$gcoin_reset_vip = $gcoin_cap_10_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_10) AND ($_SESSION['nv_reset'] < $reset_cap_11) )
{
	$level = $level_cap_11_vip;
	$gcoin_reset_vip = $gcoin_cap_11_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_11) AND ($_SESSION['nv_reset'] < $reset_cap_12) )
{
	$level = $level_cap_12_vip;
	$gcoin_reset_vip = $gcoin_cap_12_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_12) AND ($_SESSION['nv_reset'] < $reset_cap_13) )
{
	$level = $level_cap_13_vip;
	$gcoin_reset_vip = $gcoin_cap_13_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_13) AND ($_SESSION['nv_reset'] < $reset_cap_14) )
{
	$level = $level_cap_14_vip;
	$gcoin_reset_vip = $gcoin_cap_14_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_14) AND ($_SESSION['nv_reset'] < $reset_cap_15) )
{
	$level = $level_cap_15_vip;
	$gcoin_reset_vip = $gcoin_cap_15_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_15) AND ($_SESSION['nv_reset'] < $reset_cap_16) )
{
	$level = $level_cap_16_vip;
	$gcoin_reset_vip = $gcoin_cap_16_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_16) AND ($_SESSION['nv_reset'] < $reset_cap_17) )
{
	$level = $level_cap_17_vip;
	$gcoin_reset_vip = $gcoin_cap_17_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_17) AND ($_SESSION['nv_reset'] < $reset_cap_18) )
{
	$level = $level_cap_18_vip;
	$gcoin_reset_vip = $gcoin_cap_18_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_18) AND ($_SESSION['nv_reset'] < $reset_cap_19) )
{
	$level = $level_cap_19_vip;
	$gcoin_reset_vip = $gcoin_cap_19_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_19) AND ($_SESSION['nv_reset'] < $reset_cap_20) )
{
	$level = $level_cap_20_vip;
	$gcoin_reset_vip = $gcoin_cap_20_vip;
}
	$vpoint_reset_vip = floor($gcoin_reset_vip*(1+$vpoint_extra/100));

$char_in_top = $_SESSION['nv_top50'];
    
//Begin hỗ trợ tân thủ
if ($hotrotanthu == 1) {
    $info_hotro = 1;

	if($char_in_top == 1) {
        $info_hotro = 0;
        $level_config = $level;
        $level_reset = $level_config;
        $level_show = "<strong>{$level}</strong>";
        $level_giam = 0;
    }
    elseif($char_in_top == 2) {
        $level_config = $level;
        $level_reset = $level_config - $top2_rsredure;
        $level_show = "{$level_reset} <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top2_rsredure;
    }
    elseif($char_in_top == 3) {
        $level_config = $level;
        $level_reset = $level_config - $top3_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top3_rsredure;
    }
    elseif($char_in_top == 4) {
        $level_config = $level;
        $level_reset = $level_config - $top4_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top4_rsredure;
    }
    elseif($char_in_top >4 && $char_in_top<=10) {
        $level_config = $level;
        $level_reset = $level_config - $top10_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top10_rsredure;
    }
	elseif($char_in_top >10 && $char_in_top<=20) {
        $level_config = $level;
        $level_reset = $level_config - $top20_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top20_rsredure;
	}
	elseif($char_in_top >20 && $char_in_top<=30) {
        $level_config = $level;
        $level_reset = $level_config - $top30_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top30_rsredure;
	}
	elseif($char_in_top >30 && $char_in_top<=40) {
        $level_config = $level;
        $level_reset = $level_config - $top40_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top40_rsredure;
	}
	elseif($char_in_top >40 && $char_in_top<=50) {
        $level_config = $level;
        $level_reset = $level_config - $top50_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top50_rsredure;
	}
	else { 
        $char_in_top = '>50'; 
        $level_config = $level;
        $level_reset = $level_config - $top50_over_rsredure;
        $level_show = "<strong>{$level_reset}</strong> <font size=1>(<i><s>$level_config</s></i>)</font>";
        $level_giam = $top50_over_rsredure;
    }
} else {
    $level_config = $level;
    $level_reset = $level_config;
    $level_show = "<strong>{$level}</strong>";
    $level_giam = 0;
    $info_hotro = 0;
}
//End hỗ trợ tân thủ

$chenhlech_level = $_SESSION['nv_level'] - $level_reset;
$chenhlech_gcoin = ($_SESSION['acc_gcoin'] + $_SESSION['acc_gcoin_km']) - $gcoin_reset_vip;
$chenhlech_vpoint = $_SESSION['acc_vpoint'] - $vpoint_reset_vip;

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

$accept = 1;

if($use_gioihanrs[$thehe_choise] == 1) {
	if($char_in_top == 1) $gioihanrs = $gioihanrs_top1[$thehe_choise];
    elseif($char_in_top == 2) $gioihanrs = $gioihanrs_top2[$thehe_choise];
    elseif($char_in_top == 3) $gioihanrs = $gioihanrs_top3[$thehe_choise];
    elseif($char_in_top == 4) $gioihanrs = $gioihanrs_top4[$thehe_choise];
    elseif($char_in_top >4 && $char_in_top<=10) $gioihanrs = $gioihanrs_top10[$thehe_choise];
	elseif($char_in_top >10 && $char_in_top<=20) $gioihanrs = $gioihanrs_top20[$thehe_choise];
	elseif($char_in_top >20 && $char_in_top<=30) $gioihanrs = $gioihanrs_top30[$thehe_choise];
	elseif($char_in_top >30 && $char_in_top<=40) $gioihanrs = $gioihanrs_top40[$thehe_choise];
	elseif($char_in_top >40 && $char_in_top<=50) $gioihanrs = $gioihanrs_top50[$thehe_choise];
	else { $char_in_top = '>50'; $gioihanrs = $gioihanrs_other[$thehe_choise]; }
    
    $dayofweek = date('w', time());
    if($dayofweek == 0) {
        $gioihanrs = $gioihanrs + floor($gioihanrs * $overrs_sun_extra[$thehe_choise]/100);
    } else if($dayofweek == 6) {
        $gioihanrs = $gioihanrs + floor($gioihanrs * $overrs_sat_extra[$thehe_choise]/100);
    }
    
	if( $_SESSION['nv_resetday'] >= $gioihanrs ) 
	{
		if($_SESSION['nv_resetday'] >= ($gioihanrs+$overrs_rs[$thehe_choise])) $accept = 0;
		$notice_resetday = "$font_thieu_begin $_SESSION[nv_resetday] / $gioihanrs $font_thieu_end";
	} else $notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs $font_du_end";
} else {
	$gioihanrs = '--';
	$notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs $font_du_end";
}

if ($chenhlech_level < 0) { $notice_level = "$font_thieu_begin Thiếu ". ABS($chenhlech_level) ." level $font_thieu_end"; } else { $notice_level = "$font_du_begin Đủ Level Reset $font_du_end"; }
if ($chenhlech_gcoin < 0) { $notice_gcoin = "$font_thieu_begin Thiếu ". ABS($chenhlech_gcoin) ." Gcoin $font_thieu_end"; } else { $notice_gcoin = "$font_du_begin Đủ Gcoin Reset $font_du_end"; }
if ($chenhlech_vpoint < 0) { $notice_vpoint = "$font_thieu_begin Thiếu ". ABS($chenhlech_vpoint) ." Vpoint $font_thieu_end"; } else { $notice_vpoint = "$font_du_begin Đủ Vpoint Reset $font_du_end"; }
if ($info_hotro == 1) { $notice_hotro = "<strong><font color='blue'>Hỗ trợ tân thủ : Giảm <font color='red'>$level_giam</font> Level</font></strong><br />Cấp độ Reset trước khi giảm : $level_config<br />Cấp độ Reset sau khi giảm : <strong>$level_reset</strong>";}

if ( $_SESSION['nv_online'] == 1 || $_SESSION['nv_doinv'] == 0 || $chenhlech_level < 0 || ( $chenhlech_gcoin < 0 && $chenhlech_vpoint < 0) ) { $accept = 0; }	

$page_template = "templates/char_manager/resetvip.tpl";
?>