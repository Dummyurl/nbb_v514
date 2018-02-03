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
 
if ( !isset($_SESSION[mu_username]) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else 
{
    if ( $user_support == 1 )
    {
    	$act = $_GET['act'];
		switch ($act)
		{
			case 'writesupport': include('modules/support/writesupport.php'); break;
			case 'readsupport': include('modules/support/readsupport.php'); break;
            
            case 'adm_writesupport': include('modules/support/adm_writesupport.php'); break;
			case 'adm_readsupport': include('modules/support/adm_readsupport.php'); break;
            case 'adm_inbox': include('modules/support/adm_inbox.php'); break;
            
			default : include('modules/support/inbox.php');
		}
    }
}
?>