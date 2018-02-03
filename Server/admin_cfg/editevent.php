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
	case 'event_week': include('editevent/adm_event_week.php'); break;
    case 'event_month': include('editevent/adm_event_month.php'); break;
    
    case 'event1': include('editevent/adm_event1.php'); break;
	case 'event_santa': include('editevent/adm_event_santa.php'); break;
    
    case 'giftcode_tanthu': include('editevent/adm_giftcode_tanthu.php'); break;
    case 'giftcode_rs': include('editevent/adm_giftcode_rs.php'); break;
    case 'giftcode_week': include('editevent/adm_giftcode_week.php'); break;
    case 'giftcode_month': include('editevent/adm_giftcode_month.php'); break;
    case 'giftcode_acc': include('editevent/adm_giftcode_acc.php'); break;
    case 'giftcode_phat': include('editevent/adm_giftcode_phat.php'); break;
    
    case 'giftcode_random_type1': include('editevent/adm_giftcode_random.php'); break;
    case 'giftcode_random_type2': include('editevent/adm_giftcode_random.php'); break;
    case 'giftcode_random_type3': include('editevent/adm_giftcode_random.php'); break;
    
	default: include('editevent/adm_event.php'); break;
}
?>