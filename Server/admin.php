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
include_once("admin_cfg/security.php");
require_once('admin_cfg/adm_pass.php');
session_start();
if ($_POST[submit]) {
	$pass_admin = md5($_POST[useradmin]);
	if ($pass_admin == $pass_trangadmin) $_SESSION['useradmin'] = $pass_trangadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $pass_trangadmin) {
	echo "<center><form action='' method=post>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
$mod = $_GET['mod'];

include('admin_cfg/header.php');
include('admin_cfg/left.php');

if( (isset($_GET['mod'])))
	{
		if ( !preg_match("/[^a-zA-Z0-9_$]/", $mod) )
		{
			if (is_file('admin_cfg/'.$mod.".php"))
			{
      	    	require_once('admin_cfg/'.$mod.".php");
   			}
   			else require_once("admin_cfg/errorfile.php");
		}
		else require_once("admin_cfg/errorfile.php");
	}
else include('admin_cfg/checkwrite.php');

include('admin_cfg/footer.php');
?>