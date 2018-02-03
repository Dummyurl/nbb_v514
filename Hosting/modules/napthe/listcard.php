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
	if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; } else {
		$accept = 1;
		
		$getcontent_url = $server_url . "/view_card.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'string_login'    =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

		if ( empty($reponse) ) $error = "<font size='3' color='red'>Server bảo trì.</font>";
		elseif($reponse == "login_other") {
				$notice = "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
				session_destroy();
			}
			else {
		$list_cardphone = explode("<br>\n", $reponse);
		$stt = 0;
		for($i=0;$i<10;$i++)
			{
				$info_cardphone = explode("<nbb>", isset($list_cardphone[$i]) ? $list_cardphone[$i] : null);
				if ( !empty($info_cardphone[1]) ) {
					++$stt;
					$card_num = $info_cardphone[1];
					$card_serial = $info_cardphone[2];
					
					switch ($info_cardphone[4])
					{
						case 0: $card_status = "Thẻ vừa nạp/Đang chờ"; $card_num = "xxxxxxxx".$info_cardphone[1]; $card_serial = "xxxxxxxx".$info_cardphone[2]; break;
						case 1: $card_status = "<font color='orange'>Tạm ứng/Chờ kiểm tra</font>"; $card_num = "xxxxxxxx".$info_cardphone[1]; $card_serial = "xxxxxxxx".$info_cardphone[2]; break;
						case 2: $card_status = "<font color='blue'>Thẻ đúng/Hoàn tất</font>"; break;
						case 3: $card_status = "<font color='red'>Thẻ sai</font>"; break;
					}
		
					$cardphone[] = array (
						'stt'	=> $stt,	
						'card_type'	=> $info_cardphone[0],
						'card_num'	=> $card_num,
						'card_serial'	=> $card_serial,
						'card_time'	=> $info_cardphone[3],
						'card_status'	=> $card_status,
					);
				}
			}
			if($stt == 0) $notice = $reponse;
		}
	}
}
$page_template = "templates/napthe/listcard.tpl";
?>