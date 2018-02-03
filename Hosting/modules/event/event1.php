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
include('config/config_event.php');
include('config/config_event1.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'event1')
	{
		$character = $_POST['character'];
		$event1_type = $_POST['event1_type'];
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật gửi Jewel";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		else {
			
			$getcontent_url = $server_url . "/event1.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'event1_type'    =>  $event1_type,
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            ); 
            
            $notice = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

			if ( empty($notice) ) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
			elseif($notice == "login_other") {
				$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
				session_destroy();
			}
			
		}
	}
}

if (isset($_SESSION['mu_nvchon'])) {
    $accept = 1;
    if ($_SESSION['nv_online'] == 1) {
        $accept = 0;
        $online = "<font color='red'><b>Chưa Thoát</b></font><br>(Sau khi Thoát Game hãy chọn lại Nhân vật)";
    } else $online = "<font color='green'>Đã Thoát</font>";
	if ($_SESSION['nv_doinv'] == 1) $doinv = "<font color='green'>Đã đổi</font>"; else {
	   $accept = 0;
       $doinv = "<font color='red'><b>Chưa đổi</b></font><br>(Sau khi đổi nhân vật khác trong Game, hãy chọn lại nhân vật trên Web)";
	}
}

$page_template = "templates/event/event1.tpl";
?>