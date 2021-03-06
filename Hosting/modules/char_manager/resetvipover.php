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
include('config/config_gioihanrs.php');
include('config/config_resetvip_over.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'resetvipover')
	{
		$character = $_POST['character'];
		$tiente = $_POST['tiente'];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Reset";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif ($tiente == 'gcoin' || $tiente == 'vpoint') {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'tiente'    =>  $tiente,
                'resetnow'    =>  $_SESSION['nv_reset'],
                
                'pagesv'	=>	'sv_char_reset_vip_over',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
			
			if ( empty($reponse) ) $notice = "Server bảo trì.";
			elseif($reponse == "login_other") {
				$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
				session_destroy();
			}
			else {
				if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
					$notice = read_TagName($reponse, 'messenge', 1);

					$_SESSION['acc_gcoin'] = read_TagName($reponse, 'gcoin', 1);
					$_SESSION['acc_gcoin_km'] = read_TagName($reponse, 'gcoin_km', 1);
					$_SESSION['acc_vpoint'] = read_TagName($reponse, 'vpoint', 1);
					
					$_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
					$_SESSION['nv_level'] = 1;
					$_SESSION['nv_point'] = read_TagName($reponse, 'resetpoint', 1);
					$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'pointdutru', 1);
					$_SESSION['nv_resetday'] = $_SESSION['nv_resetday']+1;
					$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
				}
				else $notice = $reponse;
			}
		} else $notice = "Sai loại đơn vị tiền tệ";
	}
}

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
	

$chenhlech_level = $_SESSION['nv_level'] - $level;
$chenhlech_gcoin = ($_SESSION['acc_gcoin'] + $_SESSION['acc_gcoin_km']) - $gcoin_reset_vip;
$chenhlech_vpoint = $_SESSION['acc_vpoint'] - $vpoint_reset_vip;

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

$accept = 1;

$char_in_top = $_SESSION['nv_top50'];
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

$accept = 1;

if($use_overrs[$thehe_choise] == 0) {
    $overrs_rs[$thehe_choise] = 0;
}
if( $_SESSION['nv_resetday'] < ($gioihanrs + $overrs_rs[$thehe_choise]) ) 
{
	$accept = 0;
    $notice_vuotmuc = '';
    if($_SESSION['nv_resetday'] >= $gioihanrs) $notice_vuotmuc = "<br /><i>Cần phải Reset đủ <strong>". $overrs_rs[$thehe_choise] ."</strong> lần vượt mức bên Reset VIP mới có thể Reset OVER </i>";
	$notice_resetday = "$font_thieu_begin $_SESSION[nv_resetday] / $gioihanrs + ". $overrs_rs[$thehe_choise] ." $font_thieu_end $notice_vuotmuc";
} else $notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs + ". $overrs_rs[$thehe_choise] ." $font_du_end";

if ($chenhlech_level < 0) { $notice_level = "$font_thieu_begin Thiếu ". ABS($chenhlech_level) ." level $font_thieu_end"; } else { $notice_level = "$font_du_begin Đủ Level Reset $font_du_end"; }
if ($chenhlech_gcoin < 0) { $notice_gcoin = "$font_thieu_begin Thiếu ". ABS($chenhlech_gcoin) ." Gcoin $font_thieu_end"; } else { $notice_gcoin = "$font_du_begin Đủ Gcoin Reset $font_du_end"; }
if ($chenhlech_vpoint < 0) { $notice_vpoint = "$font_thieu_begin Thiếu ". ABS($chenhlech_vpoint) ." Vpoint $font_thieu_end"; } else { $notice_vpoint = "$font_du_begin Đủ Vpoint Reset $font_du_end"; }

if ( $_SESSION['nv_online'] == 1 || $_SESSION['nv_doinv'] == 0 || $chenhlech_level < 0 || ( $chenhlech_gcoin < 0 && $chenhlech_vpoint < 0) || $use_gioihanrs[$thehe_choise] != 1 ) { $accept = 0; }	

$page_template = "templates/char_manager/resetvipover.tpl";
?>