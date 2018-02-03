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
	
include('config/config_daugianguoc.php');
include('config/config_thehe.php');

if($Use_DauGiaNguoc == 1) {
    $page = isset($_GET['page']) ? $_GET['page'] : null;
	switch ($page)
	{
		case 'daugianguoc_listitem_biding': 
			include('modules/com/daugianguoc_listitem_biding.php');
			break;
			
		case 'daugianguoc_listitem_end': 
			include('modules/com/daugianguoc_listitem_end.php');
			break;
			
		case 'daugianguoc_listitem_win': 
			include('modules/com/daugianguoc_listitem_win.php');
			break;
			
		default: include("templates/com/daugianguoc_listitem_view.tpl"); break;
	}
} else echo "<center><strong>Chức năng không được sử dụng.</strong></center>";
    	

?>