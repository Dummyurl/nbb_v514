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
if ($Use_TienTe != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
	if ( !isset($_SESSION['mu_username']) ) {
		echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
		include('modules/home.php');
	} else {
		//include_once('config/config_chucnang.php');
        $act = isset($_GET['act']) ? $_GET['act'] : null;
		switch ($act)
		{
			case 'vpoint2item': include('modules/tiente/vpoint2item.php'); break;
			case 'item2vpoint': include('modules/tiente/item2vpoint.php'); break;
			case 'gcoin2vpoint': include('modules/tiente/gcoin2vpoint.php'); break;
            case 'gcoin2vipmoney': 
                if ($Use_Gcoin2VipMoney != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/gcoin2vipmoney.php');  }
                break;
            case 'gcoin2wcoin': 
                if ($Use_Gcoin2WCoin != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/gcoin2wcoin.php');  }
                break;
            case 'gcoin2wcoinp': 
                if ($Use_Gcoin2WCoinP != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/gcoin2wcoinp.php');  }
                break;
            case 'gcoin2goblincoin': 
                if ($Use_Gcoin2GoblinCoin != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/gcoin2goblincoin.php');  }
                break;
            case 'vpoint2gcoin': include('modules/tiente/vpoint2gcoin.php'); break;
            //case 'vpoint2cash': include('modules/tiente/vpoint2cash.php'); break;
            //case 'cash2vpoint': include('modules/tiente/cash2vpoint.php'); break;
            case 'ipbonuspoint2vpoint': 
                if ($Use_IPBonus2Vpoint != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/ipbonuspoint2vpoint.php');  }
                break;
            
            case 'ipbonuspoint2pcpoint': 
                if ($Use_IPBonus2PCPoint != 1) {
					echo "<center>Chức năng không có hoặc không được sử dụng</center>";
				}
				else { include('modules/tiente/ipbonuspoint2pcpoint.php');  }
                break;
                
            default : $page_template = 'templates/tiente.tpl';
		}
	}
}

?>