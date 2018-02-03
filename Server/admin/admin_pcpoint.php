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
 
	include_once("security.php");
include('../config.php');

SESSION_start();
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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="css/tooltip.css" rel="stylesheet" type="text/css" />

</head>
<body>
<center>Sắp xếp theo : <a href="admin_vpoint.php?sapxep=gcoin" target="_self">Gcoin</a> - <a href="admin_vpoint.php?sapxep=vpoint" target="_self">Vpoint</a> - <a href="admin_pcpoint.php" target="_self">PCPoints</a></center>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Tài khoản</td>
	<td align="center">Nhân vật</td>
	<td align="center">PCPoint</td>
</tr>

<?php
	$query = "SELECT TOP 50 AccountID, Name, SCFPCPoints FROM Character ORDER BY SCFPCPoints DESC";
	$result = $db->Execute($query);

while($row = $result->fetchrow())
  	{

	$rank = $rank+1;
		echo"<tr bgcolor='#ffffcc' >
		<td align='center'>$rank</td>
		<td align='center'>$row[0]</td>
		<td align='center'>$row[1]</td>
		<td align='center'>$row[2]</td>
		</tr>";
}
$db->Close();
?>

</table>
</body>