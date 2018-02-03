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
include('config/config_giftcode_tanthu.php');
include('config/config_sms.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'giftcode_change')
	{
		$character = $_POST['character'];
        $giftcode = $_POST['giftcode'];
		$pass2 = $_POST['pass2'];
        
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật muốn đổi GiftCode";
		}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (empty($giftcode))
		{
			$notice = "Chưa nhập Mã GiftCode";
		}
		elseif (!preg_match("/^[a-zA-Z0-9]*$/i", $giftcode))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Mã GiftCode chỉ được sử dụng kí tự a-z, A-Z, số (1-9).</font>";
			}
        elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass2))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_giftcode_change.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'giftcode'    =>  $giftcode,
                'pass2'    =>  $pass2,
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
				$info = explode('<nbb>',$reponse);
				if ($info[0] == 'OK') {
					$notice = $info[2];
					$_SESSION['acc_vpoint'] = $info[1];
				}
				else $notice = $reponse;
			}
		}
	}
}

if (isset($_SESSION['mu_nvchon'])) {
    $accept = 1;
    if (isset($_SESSION['nv_online']) && $_SESSION['nv_online'] == 1) {
        $accept = '0';
        $online = "<font color='red'><b>Chưa Thoát</b></font><br>(Sau khi Thoát Game hãy chọn lại Nhân vật)";
    } else $online = "<font color='green'>Đã Thoát</font>";
}

$page_template = "templates/event/giftcode_change.tpl";
?>