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
include('config/config_uythac_resetvip.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'uythac_resetvip')
	{
		$character = $_POST['character'];
		$tiente = $_POST[tiente];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Reset";
		}
		elseif (preg_match("[^a-zA-Z0-9_$]", $character))
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
                
                'pagesv'	=>	'sv_char_uythac_reset_vip',
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
				$info = explode('<netbanbe>',$reponse);
				$char = explode('<nbb>',$info[0]);
				if ($char[0] == 'OK') {
					$notice = $info[1];
					
					$_SESSION['acc_gcoin'] = $char[1];
					$_SESSION['acc_gcoin_km'] = $char[2];
					$_SESSION['acc_vpoint'] = $char[3];
					$_SESSION['nv_point_uythac'] = $char[4];
					$_SESSION['nv_point_uythac_event'] = $char[5];
					
					$_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
					$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
				}
				else $notice = $reponse;
			}
		} else $notice = "Sai loại đơn vị tiền tệ";
	}
}

if ( ($_SESSION['nv_reset'] >= $reset_cap_0) AND ($_SESSION['nv_reset'] < $reset_cap_1) )
{
	$point_uythac = $point_uythac_rsvip_cap_1;
	$gcoin_reset_vip = $gcoin_cap_1_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_1) AND ($_SESSION['nv_reset'] < $reset_cap_2) )
{
	$point_uythac = $point_uythac_rsvip_cap_2;
	$gcoin_reset_vip = $gcoin_cap_2_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_2) AND ($_SESSION['nv_reset'] < $reset_cap_3) )
{
	$point_uythac = $point_uythac_rsvip_cap_3;
	$gcoin_reset_vip = $gcoin_cap_3_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_3) AND ($_SESSION['nv_reset'] < $reset_cap_4) )
{
	$point_uythac = $point_uythac_rsvip_cap_4;
	$gcoin_reset_vip = $gcoin_cap_4_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_4) AND ($_SESSION['nv_reset'] < $reset_cap_5) )
{
	$point_uythac = $point_uythac_rsvip_cap_5;
	$gcoin_reset_vip = $gcoin_cap_5_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_5) AND ($_SESSION['nv_reset'] < $reset_cap_6) )
{
	$point_uythac = $point_uythac_rsvip_cap_6;
	$gcoin_reset_vip = $gcoin_cap_6_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_6) AND ($_SESSION['nv_reset'] < $reset_cap_7) )
{
	$point_uythac = $point_uythac_rsvip_cap_7;
	$gcoin_reset_vip = $gcoin_cap_7_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_7) AND ($_SESSION['nv_reset'] < $reset_cap_8) )
{
	$point_uythac = $point_uythac_rsvip_cap_8;
	$gcoin_reset_vip = $gcoin_cap_8_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_8) AND ($_SESSION['nv_reset'] < $reset_cap_9) )
{
	$point_uythac = $point_uythac_rsvip_cap_9;
	$gcoin_reset_vip = $gcoin_cap_9_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_9) AND ($_SESSION['nv_reset'] < $reset_cap_10) )
{
	$point_uythac = $point_uythac_rsvip_cap_10;
	$gcoin_reset_vip = $gcoin_cap_10_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_10) AND ($_SESSION['nv_reset'] < $reset_cap_11) )
{
	$point_uythac = $point_uythac_rsvip_cap_11;
	$gcoin_reset_vip = $gcoin_cap_11_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_11) AND ($_SESSION['nv_reset'] < $reset_cap_12) )
{
	$point_uythac = $point_uythac_rsvip_cap_12;
	$gcoin_reset_vip = $gcoin_cap_12_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_12) AND ($_SESSION['nv_reset'] < $reset_cap_13) )
{
	$point_uythac = $point_uythac_rsvip_cap_13;
	$gcoin_reset_vip = $gcoin_cap_13_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_13) AND ($_SESSION['nv_reset'] < $reset_cap_14) )
{
	$point_uythac = $point_uythac_rsvip_cap_14;
	$gcoin_reset_vip = $gcoin_cap_14_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_14) AND ($_SESSION['nv_reset'] < $reset_cap_15) )
{
	$point_uythac = $point_uythac_rsvip_cap_15;
	$gcoin_reset_vip = $gcoin_cap_15_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_15) AND ($_SESSION['nv_reset'] < $reset_cap_16) )
{
	$point_uythac = $point_uythac_rsvip_cap_16;
	$gcoin_reset_vip = $gcoin_cap_16_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_16) AND ($_SESSION['nv_reset'] < $reset_cap_17) )
{
	$point_uythac = $point_uythac_rsvip_cap_17;
	$gcoin_reset_vip = $gcoin_cap_17_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_17) AND ($_SESSION['nv_reset'] < $reset_cap_18) )
{
	$point_uythac = $point_uythac_rsvip_cap_18;
	$gcoin_reset_vip = $gcoin_cap_18_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_18) AND ($_SESSION['nv_reset'] < $reset_cap_19) )
{
	$point_uythac = $point_uythac_rsvip_cap_19;
	$gcoin_reset_vip = $gcoin_cap_19_vip;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_19) AND ($_SESSION['nv_reset'] < $reset_cap_20) )
{
	$point_uythac = $point_uythac_rsvip_cap_20;
	$gcoin_reset_vip = $gcoin_cap_20_vip;
}
	$vpoint_reset_vip = $gcoin_reset_vip*(1+$vpoint_extra/100);
	
$chenhlech_level = $_SESSION['nv_level'] - $level;
$chenhlech_gcoin = ($_SESSION['acc_gcoin'] + $_SESSION['acc_gcoin_km']) - $gcoin_reset_vip;
$chenhlech_vpoint = $_SESSION['acc_vpoint'] - $vpoint_reset_vip;
$chenhlech_pointuythac = ($_SESSION['nv_point_uythac'] + $_SESSION['nv_point_uythac_event']) - $point_uythac;

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

if ($chenhlech_pointuythac < 0) { $notice_point_uythac = "$font_thieu_begin Thiếu ". number_format(ABS($chenhlech_pointuythac), 0, ',', '.') ." Điểm Ủy Thác $font_thieu_end"; } else { $notice_point_uythac = "$font_du_begin Đủ Điểm Ủy Thác $font_du_end"; }
if ($chenhlech_level < 0) { $notice_level = "$font_thieu_begin Thiếu ". ABS($chenhlech_level) ." level $font_thieu_end"; } else { $notice_level = "$font_du_begin Đủ Level Reset $font_du_end"; }
if ($chenhlech_gcoin < 0) { $notice_gcoin = "$font_thieu_begin Thiếu ". ABS($chenhlech_gcoin) ." Gcoin $font_thieu_end"; } else { $notice_gcoin = "$font_du_begin Đủ Gcoin Reset $font_du_end"; }
if ($chenhlech_vpoint < 0) { $notice_vpoint = "$font_thieu_begin Thiếu ". ABS($chenhlech_vpoint) ." Vpoint $font_thieu_end"; } else { $notice_vpoint = "$font_du_begin Đủ Vpoint Reset $font_du_end"; }
if ($info_hotro == 1) { $notice_hotro = "Hỗ trợ tân thủ : Giảm $level_giam Level";}
if($_SESSION['nv_resetday'] >= $gioihanrs) { $notice_resetday = "$font_thieu_begin $_SESSION[nv_resetday] / $gioihanrs $font_thieu_end"; } else { $notice_resetday = "$font_du_begin $_SESSION[nv_resetday] / $gioihanrs $font_du_end"; }

$accept = 1;
if ( $_SESSION['nv_doinv'] == 0 || $chenhlech_pointuythac < 0 || ( $chenhlech_gcoin < 0 && $chenhlech_vpoint < 0 ) ) { $accept = 0; }	

$page_template = "templates/char_manager/uythac_resetvip.tpl";
?>