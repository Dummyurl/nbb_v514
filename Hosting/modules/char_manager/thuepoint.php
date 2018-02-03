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
if ($Use_ThuePoint != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'thuepoint')
	{
		$character = $_POST['character'];
		$point = $_POST['point'];
		$tiente = $_POST['tiente'];
		
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Tẩy tủy";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$notice = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		if (empty($point))
		{
			$notice = "Chưa chọn số Point muốn thuê";
		}
		elseif (preg_match("/[^0-9$]/", $point))
			{
				$notice = "<font size='4' color='red'>Dữ liệu lỗi - Point muốn thuê chỉ được sử dụng số (1-9) .</font>";
			}
		elseif ($tiente == 'gcoin' || $tiente == 'vpoint') {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'point'    =>  $point,
                'tiente'    =>  $tiente,
                
                'pagesv'	=>	'sv_char_thuepoint',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            ); 
            
            $notice = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

			if ( empty($notice) ) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
		} else $notice = "Sai loại đơn vị tiền tệ";
	}
}
	
	$getcontent_url = $server_url . "/view.php";
    $getcontent_data = array(
        'login'    =>  $_SESSION['mu_username'],
        'action'    =>  'view_charthuepoint',
        'string_login'    =>  $_SESSION['checklogin'],
        'passtransfer'    =>  $passtransfer
    ); 
    
    $show_reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	$char = explode('<netbanbe>',$show_reponse);
	for ($i=0; $i<5; ++$i)
	{
		$char_info = explode('<nbb>',$char[$i]);
		
		if ( !empty($char_info[0]))
		{
			if ( $char_info[1] == 0 ) {
				$info = "Chưa thuê";
				$time_free = "";
			}
			else {
				$info = "Đã Thuê";
				if ( $char_info[2] < 0 )
					{
						$time_du = abs($char_info[2]);
						$hour = floor($time_du/3600);
						$phut = floor (($time_du - $hour*3600 )/60);
						$time_free = "$hour h $phut phút";
					}
				else $time_free = "Hết giờ";
			}
			
			$showchar[] = array( Name => $char_info[0], Info => $info, Time_free => $time_free );
		}
	}

include("modules/char_manager/thuepoint_call.php");
}
?>