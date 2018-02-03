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
	if ($action == 'bank2zen')
	{
		$character = $_POST['character'];
		$zen = $_POST['zen'];
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật rút Zen";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (preg_match("/[^0-9$]/", $zen))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : $zen . Chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif ( $_SESSION['acc_zen'] < $zen ) {
			$notice = "<font size='2' color='red'>Dữ liệu lỗi : Số lượng Zen cần rút lớn hơn số Zen có trong ngân hàng.</font>"; 
		}
		elseif ( ($_SESSION['nv_zen'] + $zen) > 2000000000 ) {
			$notice = "<font size='2' color='red'>Dữ liệu lỗi : Sau khi rút, nhân vật có nhiều hơn 2 tỷ Zen.</font>"; 
		}
		else {
			
			$getcontent_url = $server_url . "/bank_bank2zen.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'zen'    =>  $zen,
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

				if ( $info[0] == 'OK' ) {
					$notice = $info[1];
					$_SESSION['acc_zen'] = $_SESSION['acc_zen'] - $zen;
					$_SESSION['nv_zen'] = $_SESSION['nv_zen'] + $zen;
				}
				else $notice = $reponse;
			}
		}
	}
}

$accept = 1;

if (isset($_SESSION['nv_doinv']) && $_SESSION['nv_doinv'] == 1) $doinv = "<font color='green'>Đã đổi</font>"; else {
    $doinv = "<font color='red'><b>Chưa đổi</b></font><br>(Sau khi đổi nhân vật khác trong Game, hãy chọn lại nhân vật trên Web)";
    $accept = 0;
}

$page_template = "templates/webshop/bank2zen.tpl";
?>