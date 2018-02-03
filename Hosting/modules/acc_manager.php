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
 
if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>". $lang_notice_login ."</b></font></div>";
	include('modules/home.php');
} else 
{
	if(isset($_GET['act'])) $act = $_GET['act'];
    else $act = null;
		switch ($act)
		{
			case 'ipbonus_list': include('modules/acc_manager/ipbonus_list.php'); break;
			case 'invite': include('modules/acc_manager/invite.php'); break;
			case 'changeinfo': include('modules/acc_manager/changeinfo.php'); break;
			
            case 'changepassgame': include('modules/acc_manager/changepassgame.php'); break;
			case 'changepassgame_info': include('modules/acc_manager/changepassgame_info.php'); break;
			
            case 'changepass1': include('modules/acc_manager/changepass1.php'); break;
			case 'changepass1_info': include('modules/acc_manager/changepass1_info.php'); break;
			
            case 'changepass2': include('modules/acc_manager/changepass2.php'); break;
			case 'changepass2_info': include('modules/acc_manager/changepass2_info.php'); break;
			case 'changequest': include('modules/acc_manager/changequest.php'); break;
			case 'changeans': include('modules/acc_manager/changeans.php'); break;
            
            case 'changesnonumb': include('modules/acc_manager/changesnonumb.php'); break;
            case 'changesnonumb_info': include('modules/acc_manager/changesnonumb_info.php'); break;
			
            case 'changeemail': include('modules/acc_manager/changeemail.php'); break;
			case 'changeemail_info': include('modules/acc_manager/changeemail_info.php'); break;
			
            case 'changesdt_sms': include('modules/acc_manager/changesdt_sms.php'); break;
			case 'changesdt_info': include('modules/acc_manager/changesdt_info.php'); break;
			
            case 'passran': include('modules/acc_manager/passran.php'); break;
			default : $page_template = 'templates/acc_manager.tpl';
		}
}
?>