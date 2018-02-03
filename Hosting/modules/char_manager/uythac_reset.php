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
include('config/config_uythac_reset.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'uythac_reset')
	{
		$character = $_POST['character'];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Reset";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'resetnow'    =>  $_SESSION['nv_reset'],
                
                'pagesv'	=>	'sv_char_uythac_reset',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            );
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

			if ( empty($reponse) ) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
			elseif($reponse == "login_other") {
				$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
				session_destroy();
			}
			else {
				$info = explode('<netbanbe>',$reponse);
				$char = explode('<nbb>',$info[0]);
				if ($char[0] == 'OK') {
					$notice = $info[1];
					$_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
					$_SESSION['nv_zen'] = $char[1];
					$_SESSION['nv_point_uythac'] = $char[2];
					$_SESSION['nv_point_uythac_event'] = $char[3];
					$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
				}
				else $notice = $reponse;
			}
		}
	}
}


//Info Reset
if ( ($_SESSION['nv_reset'] >= $reset_cap_0) AND ($_SESSION['nv_reset'] < $reset_cap_1) )
{
	$point_uythac = $point_uythac_rs_cap_1;
	$zen = $zen_cap_1;
	$chao = $chao_cap_1;
	$cre = $cre_cap_1;
	$blue = $blue_cap_1;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_1) AND ($_SESSION['nv_reset'] < $reset_cap_2) )
{
	$point_uythac = $point_uythac_rs_cap_2;
	$zen = $zen_cap_2;
	$chao = $chao_cap_2;
	$cre = $cre_cap_2;
	$blue = $blue_cap_2;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_2) AND ($_SESSION['nv_reset'] < $reset_cap_3) )
{
	$point_uythac = $point_uythac_rs_cap_3;
	$zen = $zen_cap_3;
	$chao = $chao_cap_3;
	$cre = $cre_cap_3;
	$blue = $blue_cap_3;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_3) AND ($_SESSION['nv_reset'] < $reset_cap_4) )
{
	$point_uythac = $point_uythac_rs_cap_4;
	$zen = $zen_cap_4;
	$chao = $chao_cap_4;
	$cre = $cre_cap_4;
	$blue = $blue_cap_4;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_4) AND ($_SESSION['nv_reset'] < $reset_cap_5) )
{
	$point_uythac = $point_uythac_rs_cap_5;
	$zen = $zen_cap_5;
	$chao = $chao_cap_5;
	$cre = $cre_cap_5;
	$blue = $blue_cap_5;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_5) AND ($_SESSION['nv_reset'] < $reset_cap_6) )
{
	$point_uythac = $point_uythac_rs_cap_6;
	$zen = $zen_cap_6;
	$chao = $chao_cap_6;
	$cre = $cre_cap_6;
	$blue = $blue_cap_6;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_6) AND ($_SESSION['nv_reset'] < $reset_cap_7) )
{
	$point_uythac = $point_uythac_rs_cap_7;
	$zen = $zen_cap_7;
	$chao = $chao_cap_7;
	$cre = $cre_cap_7;
	$blue = $blue_cap_7;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_7) AND ($_SESSION['nv_reset'] < $reset_cap_8) )
{
	$point_uythac = $point_uythac_rs_cap_8;
	$zen = $zen_cap_8;
	$chao = $chao_cap_8;
	$cre = $cre_cap_8;
	$blue = $blue_cap_8;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_8) AND ($_SESSION['nv_reset'] < $reset_cap_9) )
{
	$point_uythac = $point_uythac_rs_cap_9;
	$zen = $zen_cap_9;
	$chao = $chao_cap_9;
	$cre = $cre_cap_9;
	$blue = $blue_cap_9;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_9) AND ($_SESSION['nv_reset'] < $reset_cap_10) )
{
	$point_uythac = $point_uythac_rs_cap_10;
	$zen = $zen_cap_10;
	$chao = $chao_cap_10;
	$cre = $cre_cap_10;
	$blue = $blue_cap_10;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_10) AND ($_SESSION['nv_reset'] < $reset_cap_11) )
{
	$point_uythac = $point_uythac_rs_cap_11;
	$zen = $zen_cap_11;
	$chao = $chao_cap_11;
	$cre = $cre_cap_11;
	$blue = $blue_cap_11;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_11) AND ($_SESSION['nv_reset'] < $reset_cap_12) )
{
	$point_uythac = $point_uythac_rs_cap_12;
	$zen = $zen_cap_12;
	$chao = $chao_cap_12;
	$cre = $cre_cap_12;
	$blue = $blue_cap_12;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_12) AND ($_SESSION['nv_reset'] < $reset_cap_13) )
{
	$point_uythac = $point_uythac_rs_cap_13;
	$zen = $zen_cap_13;
	$chao = $chao_cap_13;
	$cre = $cre_cap_13;
	$blue = $blue_cap_13;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_13) AND ($_SESSION['nv_reset'] < $reset_cap_14) )
{
	$point_uythac = $point_uythac_rs_cap_14;
	$zen = $zen_cap_14;
	$chao = $chao_cap_14;
	$cre = $cre_cap_14;
	$blue = $blue_cap_14;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_14) AND ($_SESSION['nv_reset'] < $reset_cap_15) )
{
	$point_uythac = $point_uythac_rs_cap_15;
	$zen = $zen_cap_15;
	$chao = $chao_cap_15;
	$cre = $cre_cap_15;
	$blue = $blue_cap_15;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_15) AND ($_SESSION['nv_reset'] < $reset_cap_16) )
{
	$point_uythac = $point_uythac_rs_cap_16;
	$zen = $zen_cap_16;
	$chao = $chao_cap_16;
	$cre = $cre_cap_16;
	$blue = $blue_cap_16;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_16) AND ($_SESSION['nv_reset'] < $reset_cap_17) )
{
	$point_uythac = $point_uythac_rs_cap_17;
	$zen = $zen_cap_17;
	$chao = $chao_cap_17;
	$cre = $cre_cap_17;
	$blue = $blue_cap_17;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_17) AND ($_SESSION['nv_reset'] < $reset_cap_18) )
{
	$point_uythac = $point_uythac_rs_cap_18;
	$zen = $zen_cap_18;
	$chao = $chao_cap_18;
	$cre = $cre_cap_18;
	$blue = $blue_cap_18;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_18) AND ($_SESSION['nv_reset'] < $reset_cap_19) )
{
	$point_uythac = $point_uythac_rs_cap_19;
	$zen = $zen_cap_19;
	$chao = $chao_cap_19;
	$cre = $cre_cap_19;
	$blue = $blue_cap_19;
}
elseif ( ($_SESSION['nv_reset'] >= $reset_cap_19) AND ($_SESSION['nv_reset'] < $reset_cap_20) )
{
	$point_uythac = $point_uythac_rs_cap_20;
	$zen = $zen_cap_20;
	$chao = $chao_cap_20;
	$cre = $cre_cap_20;
	$blue = $blue_cap_20;
}

$chenhlech_zen = $_SESSION['nv_zen'] - $zen;
$chenhlech_chao = $_SESSION['acc_chao'] - $chao;
$chenhlech_cre = $_SESSION['acc_cre'] - $cre;
$chenhlech_blue = $_SESSION['acc_blue'] - $blue;
$chenhlech_pointuythac = ($_SESSION['nv_point_uythac'] + $_SESSION['nv_point_uythac_event']) - $point_uythac;

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

if ($chenhlech_pointuythac < 0) { $notice_point_uythac = "$font_thieu_begin Thiếu ". number_format(ABS($chenhlech_pointuythac), 0, ',', '.') ." Điểm Ủy Thác $font_thieu_end"; } else { $notice_point_uythac = "$font_du_begin Đủ Điểm Ủy Thác $font_du_end"; }
if ($chenhlech_zen < 0) { $notice_zen = "$font_thieu_begin Thiếu ". number_format(ABS($chenhlech_zen), 0, ',', '.') ." Zen $font_thieu_end"; } else { $notice_zen = "$font_du_begin Đủ Zen Reset $font_du_end"; }
if ($chenhlech_chao < 0) { $notice_chao = "$font_thieu_begin Thiếu ". ABS($chenhlech_chao) ." Chao $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Chao vào Ngân Hàng</a>)"; } else { $notice_chao = "$font_du_begin Đủ Chao Reset $font_du_end"; }
if ($chenhlech_cre < 0) { $notice_cre = "$font_thieu_begin Thiếu ". ABS($chenhlech_cre) ." Creation $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Creation vào Ngân Hàng</a>)"; } else { $notice_cre = "$font_du_begin Đủ Creation Reset $font_du_end"; }
if ($chenhlech_blue < 0) { $notice_blue = "$font_thieu_begin Thiếu ". ABS($chenhlech_blue) ." Blue Feather $font_thieu_end (<a href='#char_manager&act=jewel2bank' rel='ajax'>Gửi Lông Chim vào Ngân Hàng</a>)"; } else { $notice_blue = "$font_du_begin Đủ Blue Feather Reset $font_du_end"; }

$accept = 1;
if ($_SESSION['nv_doinv'] == 0 || $chenhlech_pointuythac < 0 || $chenhlech_zen < 0 || $chenhlech_chao < 0 || $chenhlech_cre < 0 || $chenhlech_blue < 0) { $accept = 0; }	

$page_template = "templates/char_manager/uythac_reset.tpl";
?>