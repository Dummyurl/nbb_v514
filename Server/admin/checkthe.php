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
 
	$code = $_GET['code'];
if($code == 'NBB') {
include_once('../config.php');
include('function.php');
$the_query = "SELECT count(*) FROM CardPhone WHERE status=0 OR status IS NULL";
$the_result = $db->Execute($the_query);
$the_fetch = $the_result->FetchRow();
$the = $the_fetch[0];

$online_query = "Select count(*) from Memb_Stat where ConnectStat='1'";
$online_result = $db->Execute($online_query);
$online_fetch = $online_result->FetchRow();
$online = $online_fetch[0];

$dupe_query = "Select count(*) from Dupe_Online";
$dupe_result = $db->Execute($dupe_query);
$dupe_fetch = $dupe_result->FetchRow();
$dupe = $dupe_fetch[0];

echo "|".$the."|".$online."|".$dupe."|";
}
$db->Close();
?>