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
include('config/config_hotrotanthu.php');
include('config/config_gioihanrs.php');

$thehe_choise = $_SESSION['acc_thehe'];

//Info Reset
if ( ($_SESSION['nv_reset'] >= $reset_cap_0) AND ($_SESSION['nv_reset'] < $reset_cap_1) )
{
	$level = $level_cap_1;
	$zen = $zen_cap_1;
	$chao = $chao_cap_1;
	$cre = $cre_cap_1;
	$blue = $blue_cap_1;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_1) AND ($_SESSION['nv_reset'] < $reset_cap_2) )
{
	$level = $level_cap_2;
	$zen = $zen_cap_2;
	$chao = $chao_cap_2;
	$cre = $cre_cap_2;
	$blue = $blue_cap_2;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_2) AND ($_SESSION['nv_reset'] < $reset_cap_3) )
{
	$level = $level_cap_3;
	$zen = $zen_cap_3;
	$chao = $chao_cap_3;
	$cre = $cre_cap_3;
	$blue = $blue_cap_3;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_3) AND ($_SESSION['nv_reset'] < $reset_cap_4) )
{
	$level = $level_cap_4;
	$zen = $zen_cap_4;
	$chao = $chao_cap_4;
	$cre = $cre_cap_4;
	$blue = $blue_cap_4;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_4) AND ($_SESSION['nv_reset'] < $reset_cap_5) )
{
	$level = $level_cap_5;
	$zen = $zen_cap_5;
	$chao = $chao_cap_5;
	$cre = $cre_cap_5;
	$blue = $blue_cap_5;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_5) AND ($_SESSION['nv_reset'] < $reset_cap_6) )
{
	$level = $level_cap_6;
	$zen = $zen_cap_6;
	$chao = $chao_cap_6;
	$cre = $cre_cap_6;
	$blue = $blue_cap_6;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_6) AND ($_SESSION['nv_reset'] < $reset_cap_7) )
{
	$level = $level_cap_7;
	$zen = $zen_cap_7;
	$chao = $chao_cap_7;
	$cre = $cre_cap_7;
	$blue = $blue_cap_7;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_7) AND ($_SESSION['nv_reset'] < $reset_cap_8) )
{
	$level = $level_cap_8;
	$zen = $zen_cap_8;
	$chao = $chao_cap_8;
	$cre = $cre_cap_8;
	$blue = $blue_cap_8;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_8) AND ($_SESSION['nv_reset'] < $reset_cap_9) )
{
	$level = $level_cap_9;
	$zen = $zen_cap_9;
	$chao = $chao_cap_9;
	$cre = $cre_cap_9;
	$blue = $blue_cap_9;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_9) AND ($_SESSION['nv_reset'] < $reset_cap_10) )
{
	$level = $level_cap_10;
	$zen = $zen_cap_10;
	$chao = $chao_cap_10;
	$cre = $cre_cap_10;
	$blue = $blue_cap_10;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_10) AND ($_SESSION['nv_reset'] < $reset_cap_11) )
{
	$level = $level_cap_11;
	$zen = $zen_cap_11;
	$chao = $chao_cap_11;
	$cre = $cre_cap_11;
	$blue = $blue_cap_11;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_11) AND ($_SESSION['nv_reset'] < $reset_cap_12) )
{
	$level = $level_cap_12;
	$zen = $zen_cap_12;
	$chao = $chao_cap_12;
	$cre = $cre_cap_12;
	$blue = $blue_cap_12;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_12) AND ($_SESSION['nv_reset'] < $reset_cap_13) )
{
	$level = $level_cap_13;
	$zen = $zen_cap_13;
	$chao = $chao_cap_13;
	$cre = $cre_cap_13;
	$blue = $blue_cap_13;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_13) AND ($_SESSION['nv_reset'] < $reset_cap_14) )
{
	$level = $level_cap_14;
	$zen = $zen_cap_14;
	$chao = $chao_cap_14;
	$cre = $cre_cap_14;
	$blue = $blue_cap_14;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_14) AND ($_SESSION['nv_reset'] < $reset_cap_15) )
{
	$level = $level_cap_15;
	$zen = $zen_cap_15;
	$chao = $chao_cap_15;
	$cre = $cre_cap_15;
	$blue = $blue_cap_15;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_15) AND ($_SESSION['nv_reset'] < $reset_cap_16) )
{
	$level = $level_cap_16;
	$zen = $zen_cap_16;
	$chao = $chao_cap_16;
	$cre = $cre_cap_16;
	$blue = $blue_cap_16;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_16) AND ($_SESSION['nv_reset'] < $reset_cap_17) )
{
	$level = $level_cap_17;
	$zen = $zen_cap_17;
	$chao = $chao_cap_17;
	$cre = $cre_cap_17;
	$blue = $blue_cap_17;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_17) AND ($_SESSION['nv_reset'] < $reset_cap_18) )
{
	$level = $level_cap_18;
	$zen = $zen_cap_18;
	$chao = $chao_cap_18;
	$cre = $cre_cap_18;
	$blue = $blue_cap_18;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_18) AND ($_SESSION['nv_reset'] < $reset_cap_19) )
{
	$level = $level_cap_19;
	$zen = $zen_cap_19;
	$chao = $chao_cap_19;
	$cre = $cre_cap_19;
	$blue = $blue_cap_19;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_19) AND ($_SESSION['nv_reset'] < $reset_cap_20) )
{
	$level = $level_cap_20;
	$zen = $zen_cap_20;
	$chao = $chao_cap_20;
	$cre = $cre_cap_20;
	$blue = $blue_cap_20;
}

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
$chenhlech_zen = $_SESSION['nv_zen'] - $zen;
$chenhlech_chao = $_SESSION['acc_chao'] - $chao;
$chenhlech_cre = $_SESSION['acc_cre'] - $cre;
$chenhlech_blue = $_SESSION['acc_blue'] - $blue;

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
		$accept = 0;
		$notice_resetday = "$font_thieu_begin $_SESSION[nv_resetday] / $gioihanrs $font_thieu_end";
	} else $notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs $font_du_end";
} else {
	$gioihanrs = '--';
	$notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs $font_du_end";
}

if ($chenhlech_level < 0) { $notice_level = "$font_thieu_begin Thiếu ". ABS($chenhlech_level) ." level $font_thieu_end"; } else { $notice_level = "$font_du_begin Đủ Level Reset $font_du_end"; }
if ($chenhlech_zen < 0) { $notice_zen = "$font_thieu_begin Thiếu ". number_format(ABS($chenhlech_zen), 0, ',', '.') ." Zen $font_thieu_end"; } else { $notice_zen = "$font_du_begin Đủ Zen Reset $font_du_end"; }
if ($chenhlech_chao < 0) { $notice_chao = "$font_thieu_begin Thiếu ". ABS($chenhlech_chao) ." Chao $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Chao vào Ngân Hàng</a>)"; } else { $notice_chao = "$font_du_begin Đủ Chao Reset $font_du_end"; }
if ($chenhlech_cre < 0) { $notice_cre = "$font_thieu_begin Thiếu ". ABS($chenhlech_cre) ." Creation $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Creation vào Ngân Hàng</a>)"; } else { $notice_cre = "$font_du_begin Đủ Creation Reset $font_du_end"; }
if ($chenhlech_blue < 0) { $notice_blue = "$font_thieu_begin Thiếu ". ABS($chenhlech_blue) ." Blue Feather $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Lông Chim vào Ngân Hàng</a>)"; } else { $notice_blue = "$font_du_begin Đủ Blue Feather Reset $font_du_end"; }
if ($info_hotro == 1) { $notice_hotro = "<strong><font color='blue'>Hỗ trợ tân thủ : Giảm <font color='red'>$level_giam</font> Level</font></strong><br />Cấp độ Reset trước khi giảm : $level_config<br />Cấp độ Reset sau khi giảm : <strong>$level_reset</strong>";}

if ($_SESSION['nv_online'] == 1 || $_SESSION['nv_doinv'] == 0 || $chenhlech_level < 0 || $chenhlech_zen < 0 || $chenhlech_chao < 0 || $chenhlech_cre < 0 || $chenhlech_blue < 0 ) { $accept = 0; }

$page_template = "templates/char_manager/reset.tpl";
?>