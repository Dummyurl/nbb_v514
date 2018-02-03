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
	case 'shop_taphoa': include('editwebshop/adm_shop.php'); break;
	case 'shop_event': include('editwebshop/adm_shop.php'); break;
	case 'shop_acient': include('editwebshop/adm_shop.php'); break;
	case 'shop_kiem': include('editwebshop/adm_shop.php'); break;
	case 'shop_gay': include('editwebshop/adm_shop.php'); break;
	case 'shop_cung': include('editwebshop/adm_shop.php'); break;
	case 'shop_vukhikhac': include('editwebshop/adm_shop.php'); break;
	case 'shop_khien': include('editwebshop/adm_shop.php'); break;
	case 'shop_mu': include('editwebshop/adm_shop.php'); break;
	case 'shop_ao': include('editwebshop/adm_shop.php'); break;
	case 'shop_quan': include('editwebshop/adm_shop.php'); break;
	case 'shop_tay': include('editwebshop/adm_shop.php'); break;
	case 'shop_chan': include('editwebshop/adm_shop.php'); break;
	case 'shop_trangsuc': include('editwebshop/adm_shop.php'); break;
	case 'shop_canh': include('editwebshop/adm_shop.php'); break;
	case 'shop_zen': include('editwebshop/adm_shopzen.php'); break;
	default: include('checkwrite.php'); break;
}
?>