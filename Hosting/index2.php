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
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

if(!isset($_SESSION)) session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('NetNWEB',true);
include_once('lang/lang_vn.php');
include_once('includes/function.php');
include_once('config/config_dongbo.php');
include_once('config/config_chucnang.php');
include_once('config/config_sms.php');
include_once('config/config.php');
include_once('config/config_domain.php');
include_once('config/config_event.php');
include_once('config/config_thehe.php');
include_once('hosting_sync2.php');

$server_url = _trimendslashurl($server_url);
if($opensite == 0)
{
	echo $lang_off; exit();
}

include_once('config/config_firewall.php');
if($use_antiddos == 1)
{
	include_once('firewall.php');
}

include('includes/login.class.php');

_loaddata();

if (isset($error)) {
echo "<fieldset>
    <legend>Lỗi:</legend>
    <CENTER>$error</CENTER>
  </fieldset>";
}

// Nếu có $Module -> Load trang Module
if(isset($_GET['mod'])) $module = $_GET['mod'];

if(isset($module)) {
    // Kiểm tra điều kiện biến Module
    // Nếu không có ký tự đặc biệt thì Load Module
    // Nếu có ký tự đặc biệt thì Load Page ErrorFile
    if (!preg_match("/^[a-zA-Z0-9_]*$/i", $module)) {
        $module = "errorfile";
    }
} else {
    $module = "home";
}
// Kiểm tra nếu tồn tại Module thì Load Module
if (is_file("modules/". $module .".php")) 
    include("modules/". $module .".php");
// Nếu không tồn tại Module thì Load Page ErrorFile
else {
    include("modules/errorfile.php");
    $module = "errorfile";
}

if( isset($page_template) ) include( $page_template );
?>