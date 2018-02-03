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
 
	include("security.php");
	include('../config.php');
	include('function.php');
	include_once("../func_timechenh.php");
	include('../config/config_event.php');

session_start();
if ($_POST[submit]) {
	$pass_admin = md5($_POST[useradmin]);
	if ($pass_admin == $passadmin) $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
	echo "<center><form action='' method=post>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}

	function jump($url)
	{
		echo "<script> window.location.href='$url'; </script>";
	}
?>
<HTML>
<HEAD>
	<TITLE>Event dự đoán Bóng Đá</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
</HEAD>
<body>
<div id="dhtmltooltip"></div>
<img id="dhtmlpointer" src="images/tooltiparrow.gif">
<?php require('linktop.php'); ?>
<p align="center"><a href="?page=add_giai">Quản lý Giải Đấu</a> | <a href="?page=add_bong">Thêm Trận Đấu</a> | <a href="?page=bong_chuadau">Danh sách trận chưa đấu</a> | <a href="?page=bong_dadau">Danh sách trận đã đấu</a><br>
<?php
	$time_now = _time()-60*60;
	echo date('h:iA d/m/Y',$time_now);
?>
</p>
<hr>
<?php
	$page = $_GET['page'];
	if($page) include("event_bongda/$page.php");
	else include("event_bongda/bong_chuadau.php");
$db->Close();
?>
<script type="text/javascript" src="js/tooltip.js"></script>
</body>
</html>