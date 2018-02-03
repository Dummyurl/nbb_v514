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
if ($Use_WebShop != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
	if ( !isset($_SESSION['mu_username']) ) {
		echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
		include('modules/home.php');
	} else {
		$act = isset($_GET['act']) ? $_GET['act'] : null;
		switch ($act)
		{
			case 'shop_taphoa': 
				if ($Use_ShopTapHoa != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_event': 
				if ($Use_ShopVeEvent != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_acient': 
				if ($Use_ShopAcient != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_kiem': 
				if ($Use_ShopKiem != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_gay': 
				if ($Use_ShopGay != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_cung': 
				if ($Use_ShopCung != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_vukhikhac': 
				if ($Use_ShopVuKhiKhac != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_khien': 
				if ($Use_ShopKhien != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_mu': 
				if ($Use_ShopMu != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_ao': 
				if ($Use_ShopAo != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_quan': 
				if ($Use_ShopQuan != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_tay': 
				if ($Use_ShopTay != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_chan': 
				if ($Use_ShopChan != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_trangsuc': 
				if ($Use_ShopTrangSuc != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_canh': 
				if ($Use_ShopCanh != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/webshop/shop_item.php'); }
				break;
			case 'shop_zen': 
				if ($Use_ShopTienZen != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else {include('modules/webshop/shop_zen.php'); }
				break;
			case 'shop_itemzen': include('modules/webshop/shop_itemzen.php'); break;
			case 'bank2zen': include('modules/webshop/bank2zen.php'); break;
			
			default : $page_template = 'templates/webshop.tpl';
		}
	}
}

?>