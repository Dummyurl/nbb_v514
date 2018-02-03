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
	
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'vpoint2gcoin')
	{
		$vpoint = $_POST['vpoint'];
		$pass2 = $_POST['pass2'];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif(empty($vpoint)) {
			$notice = "Chưa chọn số lượng Vpoint muốn đổi";
		}
		elseif (preg_match("/[^0-9$]/", $vpoint))
			{
				$notice = "Dữ liệu lỗi - Vpoint chỉ được sử dụng số (1-9).";
			}
        elseif ( $vpoint > floor($_SESSION['acc_vpoint']/10)*10 )
			{
				$notice = "Dữ liệu lỗi - Vpoint muốn đổi lớn hơn số Vpoint có thể đổi.";
			}
		elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
			{
				$notice = "Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif ($_SESSION['acc_vpoint'] < $vpoint) {
			$notice	= "Vpoint cần đổi lớn hơn Vpoint hiện có";
		}
		else {
			
			$getcontent_url = $server_url . "/sv_tiente.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'pass2'    =>  $pass2,
                'vpoint'    =>  $vpoint,
                
                'pagesv'	=>	'sv_tiente_vpoint2gcoin',
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
				if (read_TagName($reponse, 'info', 1) == 'OK') {
					$notice = read_TagName($reponse, 'messenge', 1);
					$_SESSION['acc_gcoin'] = read_TagName($reponse, 'gcoin', 1);
					$_SESSION['acc_vpoint'] = read_TagName($reponse, 'vpoint', 1);
				}
				else $notice = $reponse;
			}
		}
	}
}


$page_template = "templates/tiente/vpoint2gcoin.tpl";
?>