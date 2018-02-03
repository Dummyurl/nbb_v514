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
include('config/config_relife.php');
	
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'relife')
	{
		$character = $_POST['character'];
		
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần ReLife";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                
                'pagesv'	=>	'sv_char_relife',
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
					if ( ($_SESSION['nv_class'] == 80) || ($_SESSION['nv_class'] == 81) || ($_SESSION['nv_class'] == 82) ) {
						$notice .= "<br><b>Nhân vật của bạn là Summoner. Để học được ngay Skill Buff Dmg, ngay sau khi ReLife hãy cộng ngay vào Năng Lượng 1000 điểm từ chức năng trên Web trước khi vào Game. Nếu điểm Reset của bạn < 1500 điểm sẽ được hỗ trợ ngay 1000 điểm vào Energy để có Skill Buff Dmg.</b>";
					}
					$_SESSION['nv_reset'] = 0;
					$_SESSION['nv_relife'] = $_SESSION['nv_relife']+1;
					$_SESSION['nv_level'] = 1;
					$_SESSION['nv_point'] = 0;
					$_SESSION['nv_pointdutru'] = $char[1];
				}
				else $notice = $reponse;
			}
		}
	}
}

switch ($_SESSION['nv_relife']) {
	case 0:		$rl_reset_relifes = $rl_reset_relife1;		break;
	case 1:		$rl_reset_relifes = $rl_reset_relife2;		break;
	case 2:		$rl_reset_relifes = $rl_reset_relife3;		break;
	case 3:		$rl_reset_relifes = $rl_reset_relife4;		break;
	case 4:		$rl_reset_relifes = $rl_reset_relife5;		break;
	case 5:		$rl_reset_relifes = $rl_reset_relife6;		break;
	case 6:		$rl_reset_relifes = $rl_reset_relife7;		break;
	case 7:		$rl_reset_relifes = $rl_reset_relife7;		break;
	case 8:		$rl_reset_relifes = $rl_reset_relife8;		break;
	case 9:		$rl_reset_relifes = $rl_reset_relife9;		break;
}

$chenhlech_level = 400 - $_SESSION['nv_level'];
$chenhlech_reset = $rl_reset_relifes - $_SESSION['nv_reset'];

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

if ($chenhlech_level > 0) { $notice_level = "$font_thieu_begin Thiếu ". ABS($chenhlech_level) ." level $font_thieu_end"; } else { $notice_level = "$font_du_begin Đủ Level Reset $font_du_end"; }
if ($chenhlech_reset > 0) { $notice_reset = "$font_thieu_begin Thiếu ". ABS($chenhlech_reset) ." Reset $font_thieu_end"; } else { $notice_reset = "$font_du_begin Đủ  $rl_reset_relifes Reset để Relife $font_du_end"; }

$accept = 1;
if ( ($chenhlech_level > 0) || ($chenhlech_reset > 0) ) { $accept = 0; }

$page_template = "templates/char_manager/relife.tpl";
?>