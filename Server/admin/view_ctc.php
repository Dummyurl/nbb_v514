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
include_once('../config.php');
include('../config/config_thehe.php');
$title = "Thông tin Công Thành Chiến";
SESSION_start();
if ($_POST[submit]) {
	$pass_online = md5($_POST[online]);
	if ($pass_online == "$passcode") $_SESSION['online'] = "$passcode";
}
if (!$_SESSION['online'] || $_SESSION['online'] != "$passcode") {
	echo "<center><form action='' method=post>
	Code: <input type=password name=online> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F9E7CF">
<div id="dhtmltooltip"></div>
<img id="dhtmlpointer" src="images/tooltiparrow.gif">
<?php require('linktop.php'); ?>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Guild</td>
	<td align="center">REG_MARKS</td>
	<td align="center">IS_GIVEUP</td>
	<td align="center">SEQ_NUM</td>
</tr>


<?php

$ctc_query = "SELECT REG_SIEGE_GUILD, REG_MARKS, IS_GIVEUP, SEQ_NUM FROM MuCastle_REG_SIEGE";
$ctc_result = $db->Execute($ctc_query);

$rank = 0;
while($ctc_fetch = $ctc_result->FetchRow()) {
    $rank++;
    
    $guild = $ctc_fetch[0];
    $reg_mark = $ctc_fetch[1];
    $isgive = $ctc_fetch[2];
    $seqnum = $ctc_fetch[3];
    
    echo"<tr bgcolor='#F9E7CF' >
		<td align='center'>$rank</td>
		<td align='center'>$guild</td>
		<td align='center'>$reg_mark</td>
		<td align='center'>$isgive</td>
		<td align='center'>$seqnum</td>
	</tr>";
}
$db->Close();
?>
												
</table>

<script type="text/javascript" src="js/tooltip.js"></script>
</body>
</html>