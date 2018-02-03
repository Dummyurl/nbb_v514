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
if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else {
	if (strlen($_SESSION['mu_nvchon']) > 0) {
		if ($_SESSION['nv_online'] == 1) $online = "<font color='red'><b>Chưa Thoát</b></font><br>(Sau khi Thoát Game hãy chọn lại Nhân vật)"; else $online = "<font color='green'>Đã Thoát</font>";
		if ($_SESSION['nv_doinv'] == 1) $doinv = "<font color='green'>Đã đổi</font>"; else $doinv = "<font color='red'><b>Chưa đổi</b></font><br>(Sau khi đổi nhân vật khác trong Game, hãy chọn lại nhân vật trên Web)";
		if(isset($_GET['act'])) $act = $_GET['act'];
        else $act = null;
		switch ($act)
		{
            case 'lock_item': include('modules/char_manager/lock_item.php'); break;
			case 'jewel2bank': include('modules/char_manager/jewel2bank.php'); break;
			case 'reset': include('modules/char_manager/reset.php'); break;
			case 'resetvip': 
				if ($Use_ResetVIP != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/resetvip.php'); }
				break;
				
			case 'relife': include('modules/char_manager/relife.php'); break;
			
			case 'resetover': 
				if ( $Use_ResetOver == 1 ) {
					include('modules/char_manager/resetover.php'); 
				} else {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				break;
				
			case 'resetvipover': 
				if ($Use_ResetVIP == 1 && $Use_ResetOver == 1) {
					include('modules/char_manager/resetvipover.php');
				}
				else { echo "<center>Chức năng không có hoặc không được sử dụng</center>"; }
				break;
				
			case 'uythacoffline': 
				if ($Use_UyThacOffline != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/uythacoffline.php'); }
				break;
			case 'uythaconline': 
				if ($Use_UyThacOnline != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/uythaconline.php'); }
				break;
			case 'uythac_reset': 
				if ($Use_UyThacOnline == 1 || $Use_UyThacOffline == 1) {
					include('modules/char_manager/uythac_reset.php');
				}
				else { echo "<center>Chức năng không có hoặc không được sử dụng</center>"; }
				break;
			case 'uythac_resetvip': 
				if ( ($Use_UyThacOnline == 1 || $Use_UyThacOffline == 1) && $Use_ResetVIP == 1) {
					include('modules/char_manager/uythac_resetvip.php');
				}
				else { echo "<center>Chức năng không có hoặc không được sử dụng</center>"; }
				break;
			case 'pk': include('modules/char_manager/pk.php'); break;
			case 'doigioitinh': 
				if ($Use_DoiGioiTinh != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/doigioitinh.php'); }
				break;
			case 'move': include('modules/char_manager/move.php'); break;
			case 'addpoint': include('modules/char_manager/addpoint.php'); break;
			case 'combo': include('modules/char_manager/combo.php'); break;
			case 'resetpoint': include('modules/char_manager/resetpoint.php'); break;
			case 'taytuy': include('modules/char_manager/taytuy.php'); break;
			case 'rutpoint': include('modules/char_manager/rutpoint.php'); break;
			case 'thuepoint': 
				if ($Use_ThuePoint != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/thuepoint.php'); }
				break;
			case 'khoaitem': include('modules/char_manager/khoaitem.php'); break;
			case 'rsmaster': include('modules/char_manager/rsmaster.php'); break;
            case 'changename': 
            	if ($Use_ChangeName != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/changename.php'); }
            	break;
            case 'char2accother': 
            	if ($Use_Char2AccOther != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/char_manager/char2accother.php'); }
            	break;
            case 'emptychar': include('modules/char_manager/emptychar.php'); break;
			case 'crea_char': include('modules/char_manager/crea_char.php'); break;
			case 'reset_quest': include('modules/char_manager/reset_quest.php'); break;
			case 'deletechar': include('modules/char_manager/deletechar.php'); break;
            case 'tuluyen': 
                if (isset($Use_TuLuyen) && $Use_TuLuyen == 1) {
					include('modules/char_manager/tuluyen.php'); 
				} else echo "<center>Chức năng không có hoặc không được sử dụng</center>";
                break;
            case 'songtu': 
                if (isset($Use_SongTu) && $Use_SongTu == 1) {
					include('modules/char_manager/songtu.php'); 
				}
				else echo "<center>Chức năng không có hoặc không được sử dụng</center>";
                break;
			default: $page_template = 'templates/char_manager.tpl';
		}
	}
	else $page_template = 'templates/char_manager.tpl';
}
?>