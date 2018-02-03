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

	if ($action == 'changesnonumb_info')
	{
		$snonumb = $_POST['snonumb'];
		
		$pass2 = $_POST['pass2'];
		$quest = $_POST['quest'];
		$ans = $_POST['ans'];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif(empty($snonumb)) {
			$notice = "Chưa nhập 7 Số bí mật";
		}
		
		elseif (!preg_match("/^[0-9]*$/i", $snonumb))
			{
				$notice = "<font size='4' color='red'>Dữ liệu lỗi - 7 Số bí mật chỉ được dùng số 0-9.</font>";
			}
        elseif (strlen($snonumb) < 7)
		{
			$notice = "<font size='4' color='red'>Dữ liệu lỗi - 7 Số bí mật không đủ 7 số.</font>";
		}
        elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $ans))
			{
				$notice = "<font size='4' color='red'>Dữ liệu lỗi - Câu trả lời bí mật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass2))
			{
				$notice = "<font color='red'>Dữ liệu lỗi - Mật khẩu Web cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
			}
		elseif (!preg_match("/^[1-9]*$/i", $quest))
			{
				$notice = "<font color='red'>Dữ liệu lỗi - Chưa chọn câu hỏi bí mật.</font>";
			}
		elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $ans))
			{
				$notice = "<font color='red'>Dữ liệu lỗi - Câu trả lời bí mật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
			}
		else {
		  
            $snonumb_len = strlen($snonumb);
            if($snonumb_len < 7) {
                for($i=0; $i<(7-$snonumb_len); ++$i) {
                    $snonumb = '0'. $snonumb;
                }
            }
            
            
			$getcontent_url = $server_url . "/sv_acc.php";
	        $getcontent_data = array(
	            'login'    =>  $_SESSION['mu_username'],
	            'snonumb'    =>  $snonumb,
	            'pass2'    =>  $pass2,
	            'quest'    =>  $quest,
	            'ans'    =>  $ans,
	            
	            'pagesv'	=>	'sv_acc_change_snonumb_info',
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
				$notice = $reponse;
			}
		}
	}
}

$page_template = "templates/acc_manager/changesnonumb_info.tpl";
?>