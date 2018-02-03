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
if ($Use_CardMobi != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
	include('config/config_napthe_mobi.php');
	include('config/config_napthe.php');
	if (isset($_POST['action']))
	{
		$action = $_POST['action'];
		if ($action == 'nap_mobi')
		{
			$cardtype = "MobiPhone";
			$menhgia = $_POST['menhgia'];
			$card_num = $_POST['card_num'];
			$card_serial = $_POST['card_serial'];
			
			if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
			elseif(empty($menhgia))
			{
				$notice = "Chưa chọn mệnh giá thẻ";
			}
			elseif (!preg_match("/^[0-9]*$/i", $menhgia))
				{
					$error = "<font size='4' color='red'>Dữ liệu lỗi - Mệnh giá chỉ được sử dụng số (1-9).</font>";
				}
			elseif (empty($card_num)) {
				$notice = "Chưa điền Mã thẻ";
			}
			elseif (!preg_match("/^[0-9]*$/u", $card_num))
			{
		    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : $card_num . Chỉ được sử dụng số (1-9).</font>"; 
			}
			elseif (empty($card_serial)) {
				$notice = "Chưa điền Serial thẻ";
			}
			elseif (!preg_match("/^[a-zA-Z0-9]*$/u", $card_serial))
			{
		    	$notice = "<font size='2' color='red'>Dữ liệu lỗi : $card_serial . Serial Chỉ được sử dụng chu a-z, A-Z và số (1-9).</font>"; 
			}
			else {
				
				$getcontent_url = $server_url . "/vpoint_cardphone.php";
	            $getcontent_data = array(
	                'login'    =>  $_SESSION['mu_username'],
	                'cardtype'    =>  $cardtype,
	                'menhgia'    =>  $menhgia,
	                'card_num'    =>  $card_num,
	                'card_serial'    =>  $card_serial,
	                'string_login'    =>  $_SESSION['checklogin'],
	                'passtransfer'    =>  $passtransfer
	            ); 
	            
	            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

				if ( empty($reponse) ) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
				elseif($reponse == "login_other") {
					$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
					session_destroy();
				} else {
				    $notice = read_TagName($reponse, 'msg', 1);
                    $gcoin = read_TagName($reponse, 'gcoin', 1);
                    $gcoinkm = read_TagName($reponse, 'gcoinkm', 1);
                    if(strlen($notice) == 0) $notice = $reponse;
                    elseif($gcoin > 0) {
                        $_SESSION['acc_gcoin'] = $gcoin;
                        $_SESSION['acc_gcoin_km'] = $gcoinkm;
                    }
				}
			}
		}
	}
	
        $menhgia10000_km = 0;
		$menhgia20000_km = 0;
		$menhgia30000_km = 0;
		$menhgia50000_km = 0;
		$menhgia100000_km = 0;
		$menhgia200000_km = 0;
		$menhgia300000_km = 0;
		$menhgia500000_km = 0;
	
	//Khuyen mai chung
	if ($khuyenmai == 1 ) {
		$menhgia10000_km = $menhgia10000*($khuyenmai_phantram/100);
		$menhgia20000_km = $menhgia20000*($khuyenmai_phantram/100);
		$menhgia30000_km = $menhgia30000*($khuyenmai_phantram/100);
		$menhgia50000_km = $menhgia50000*($khuyenmai_phantram/100);
		$menhgia100000_km = $menhgia100000*($khuyenmai_phantram/100);
		$menhgia200000_km = $menhgia200000*($khuyenmai_phantram/100);
		$menhgia300000_km = $menhgia300000*($khuyenmai_phantram/100);
		$menhgia500000_km = $menhgia500000*($khuyenmai_phantram/100);
	}
		
	$page_template = "templates/napthe/mobi.tpl";
	}
?>