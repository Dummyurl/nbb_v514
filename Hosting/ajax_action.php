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
 
session_start();
define('NetNWEB',true);
	include_once('config/config.php');
	include_once('includes/function.php');
	
// Define Ajax Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) { echo 'Khong duoc phep truy cap.'; }
else {
    if( isset($_GET['ajax']) )
    {
    	if ( preg_match("/^[a-zA-Z0-9_]+$/", $_GET['ajax']) )
    	{
            if (is_file("ajax/ajax_". $_GET['ajax'] .".php")) 
    		{
                include("ajax/ajax_". $_GET['ajax'] .".php");
    		}
            else echo "Not File Ajax";
    	}
        else echo $_GET['ajax'] . " : Parameter Ajax Don't Allow";
    }
}
?>