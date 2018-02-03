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
	case 'config_sync': include('editconfig/adm_config_sync.php'); break;
    case 'config': include('editconfig/adm_config.php'); break;
	case 'config_antiddos': include('editconfig/adm_config_antiddos.php'); break;
	case 'config_dongbo': include('editconfig/adm_config_dongbo.php'); break;
	case 'config_domain': include('editconfig/adm_config_domain.php'); break;
	case 'activepro': include('editconfig/adm_activepro.php'); break;
	case 'activevip': include('editconfig/adm_activevip.php'); break;
	case 'config_chucnang': include('editconfig/adm_config_chucnang.php'); break;
	case 'config_sms': include('editconfig/adm_config_sms.php'); break;
	case 'config_autonap': include('editconfig/adm_config_autonap.php'); break;
	case 'config_license': include('editconfig/adm_config_license.php'); break;
	case 'config_sendmess': include('editconfig/adm_config_sendmess.php'); break;
	default: include('checkwrite.php'); break;
}
?>