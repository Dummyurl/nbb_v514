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
include('config/config_itemvpoint.php');

if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'vpoint2item')
	{
		$character = $_POST['character'];
		$item = $_POST['item'];
		$slg = $_POST['slg'];
		$pass2 = $_POST['pass2'];
		
		if ($item == 'gold') $price = $item_low;
		elseif ($item == 'zen') $price = $item_hight;
		
		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif (empty($character))
		{
			$notice = "Chưa chọn nhân vật mua đồ";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif(empty($item)) {
			$notice = "Chưa chọn Item V.Point muốn mua";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $item))
			{
				$notice = "Dữ liệu lỗi - Item chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif(empty($slg)) {
			$notice = "Chưa chọn số lượng Item muốn mua";
		}
		elseif (preg_match("/[^0-9$]/", $slg))
			{
				$notice = "Dữ liệu lỗi - Số lượng chỉ được sử dụng số (1-9).";
			}
		elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
			{
				$notice = "Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
		elseif ( ($price*$slg) > $_SESSION['acc_vpoint'] ) {
			$notice = "Số Vpoint cần để mua Item Vpoint vượt quá số Vpoint hiện có";
		}
		else {
			
			$getcontent_url = $server_url . "/sv_tiente.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'pass2'    =>  $pass2,
                'item'    =>  $item,
                'slg'    =>  $slg,
                
                'pagesv'	=>	'sv_tiente_vpoint2item',
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
					$notice = $info[1];
					$_SESSION['acc_vpoint'] = $_SESSION['acc_vpoint'] - $price*$slg;
				}
				else $notice = $reponse;
			}
		}
	}
}


$page_template = "templates/tiente/vpoint2item.tpl";
?>