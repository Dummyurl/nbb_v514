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
include('config/config_doigioitinh.php');

if ($Use_DoiGioiTinh != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'doigioitinh')
	{
		$character = $_POST['character'];
		$gioitinh = $_POST['gioitinh'];
		$pass2 = $_POST['pass2'];
		
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Đổi giới tính";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif (preg_match("/[^0-9$]/", $gioitinh))
			{
				$notice = "Dữ liệu lỗi - Giới tính chỉ được sử dụng số (1-9).";
			}
		elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
			{
				$notice = "Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'pass2'    =>  $pass2,
                'gioitinh'    =>  $gioitinh,
                
                'pagesv'	=>	'sv_char_doigioitinh',
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
					
					$_SESSION['acc_gcoin'] = $char[1];
					$_SESSION['acc_gcoin_km'] = $char[2];
					
					$_SESSION['nv_class'] = $gioitinh;
					$_SESSION['nv_reset'] = $char[3];
				}
				else $notice = $reponse;
			}
		}
	}
}

$chenhlech_gcoin = $_SESSION['acc_gcoin'] + $_SESSION['acc_gcoin_km'] - $doigt_gcoin;
$chenhlech_reset = $doigt_resetmin - $_SESSION['nv_reset'];

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

if ($chenhlech_gcoin < 0) { $notice_gcoin = "$font_thieu_begin Thiếu ". ABS($chenhlech_gcoin) ." Gcoin $font_thieu_end"; } else { $notice_gcoin = "$font_du_begin Đủ Gcoin Đổi Giới Tính $font_du_end"; }
if ($chenhlech_reset > 0) { $notice_reset = "$font_thieu_begin Thiếu ". ABS($chenhlech_reset) ." Reset $font_thieu_end"; } else { $notice_reset = "$font_du_begin Đủ  $doigt_resetmin Reset để Đổi Giới Tính $font_du_end"; }

$accept = 1;
if ( $_SESSION['nv_online'] == 1 || $_SESSION['nv_doinv'] == 0 || $chenhlech_reset > 0 || $chenhlech_vpoint < 0 ) { $accept = 0; }	

$page_template = "templates/char_manager/doigioitinh.tpl";
}
?>