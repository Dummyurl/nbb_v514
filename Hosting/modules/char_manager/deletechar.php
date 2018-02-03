<?php
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");
include('config/config_deletechar.php');
	
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'deletechar')
	{
		$character = $_POST['character'];
		$pass2 = $_POST['pass2'];
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần xóa";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'pass2'    =>  $pass2,
                
                'pagesv'	=>	'sv_char_delete',
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
				$info = explode('<nbb>',$reponse);
				if ($info[0] == 'OK') {
					$notice = $info[1];						
                    $_SESSION['acc_vpoint'] -= $deletechar_vpoint;
                    session_destroy();
				}
				else $notice = $reponse;
			}
		}
	}
}

$accept = 1;
$chenhlech_vpoint = $_SESSION['acc_vpoint'] - $deletechar_vpoint;

$font_thieu_begin = "<font color='red'><b>";
$font_thieu_end = "</b></font>";
$font_du_begin = "<font color='green'><b>";
$font_du_end = "</b></font>";

if ( $_SESSION['nv_online'] == 1 || $chenhlech_vpoint < 0) { $accept = 0; }	
if ($chenhlech_vpoint < 0) { $notice_vpoint = "$font_thieu_begin Thiếu ". ABS($chenhlech_vpoint) ." Vpoint $font_thieu_end"; } else { $notice_vpoint = "$font_du_begin Đủ Vpoint $font_du_end"; }

$page_template = "templates/char_manager/deletechar.tpl";
?>