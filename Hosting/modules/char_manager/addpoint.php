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
	if ($action == 'addpoint')
	{
		$character = $_POST['character'];
		$str = $_POST['str'];
		$dex = $_POST['dex'];
		$vit = $_POST['vit'];
		$ene = $_POST['ene'];
		$ml = $_POST['ml'];

		$sum_point = $str + $dex + $vit + $ene + $ml;
		
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Cộng Điểm";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (preg_match("/[^0-9$]/", $str))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : Điểm cộng cho Sức mạnh chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif (preg_match("/[^0-9$]/", $dex))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : Điểm cộng cho Nhanh nhẹn chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif (preg_match("/[^0-9$]/", $vit))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : Điểm cộng cho Sức khỏe chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif (preg_match("/[^0-9$]/", $ene))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : Điểm cộng cho Năng lượng chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif (preg_match("/[^0-9$]/", $ml))
		{
	    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : Điểm cộng cho Mệnh lệnh chỉ được sử dụng số (1-9).</font>"; 
		}
		elseif ($sum_point == 0) {
			$notice = "<font size='2' color='red'>Dữ liệu lỗi : Chưa điền điểm để cộng.</font>";
		}
		elseif ($sum_point > $_SESSION['nv_point'])
		{
			$notice = "<font size='2' color='red'>Dữ liệu lỗi : Tổng điểm cộng lớn hơn Point hiện có.</font>";
		}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'str'    =>  $str,
                'dex'    =>  $dex,
                'vit'    =>  $vit,
                'ene'    =>  $ene,
                'ml'    =>  $ml,
                
                'pagesv'	=>	'sv_char_addpoint',
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
					$point_after = $_SESSION['nv_point']-$sum_point;
					
					$_SESSION['nv_point'] = $point_after;
				}
				else $notice = $reponse;
			}
		}
	}
}

$accept = 1;
if ($_SESSION['nv_doinv'] == 0) { $accept = 0; }

$page_template = "templates/char_manager/addpoint.tpl";
?>