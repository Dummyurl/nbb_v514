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
	if(isset($_GET['page'])) $page = $_GET['page'];
    else $page = 'event_epitem_view';
	switch ($page)
	{
		case 'event_epitem_regnew': 
			include('modules/event/event_epitem_regnew.php');
			break;
		case 'event_epitem_reged': 
			include('modules/event/event_epitem_reged.php');
			break;
        case 'event_epitem_rank': 
			include('modules/event/event_epitem_rank.php');
			break;
		default: include("modules/event/event_epitem_view.php"); break;
	}
?>