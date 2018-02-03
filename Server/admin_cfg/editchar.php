<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
$act = $_GET['act'];
switch ($act) {
	case 'point_rsday': include('editchar/adm_point_rsday.php'); break;
    case 'quest_daily': include('editchar/adm_quest_daily.php'); break;
    case 'tuluyen': include('editchar/adm_tuluyen.php'); break;
    case 'songtu': include('editchar/adm_songtu.php'); break;
    case 'reset': include('editchar/adm_reset.php'); break;
	case 'resetvip': include('editchar/adm_resetvip.php'); break;
	case 'gioihanrs': include('editchar/adm_gioihanrs.php'); break;
	case 'hotrotanthu': include('editchar/adm_hotrotanthu.php'); break;
	case 'relife': include('editchar/adm_relife.php'); break;
	case 'uythacoffline': include('editchar/adm_uythacoffline.php'); break;
	case 'uythac_reset': include('editchar/adm_uythac_reset.php'); break;
	case 'uythac_resetvip': include('editchar/adm_uythac_resetvip.php'); break;
	case 'ruatoi': include('editchar/adm_ruatoi.php'); break;
	case 'taytuy': include('editchar/adm_taytuy.php'); break;
	case 'doigioitinh': include('editchar/adm_doigioitinh.php'); break;
	case 'uplvitem': include('editchar/adm_uplvitem.php'); break;
    case 'thehe': include('editchar/adm_thehe.php'); break;
    case 'lockitem': include('editchar/adm_lockitem.php'); break;
    case 'reset_over': include('editchar/adm_reset_over.php'); break;
    case 'resetvip_over': include('editchar/adm_resetvip_over.php'); break;
	default: include('checkwrite.php'); break;
}
?>