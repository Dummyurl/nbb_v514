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
include_once("../func_timechenh.php");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="css/tooltip.css" rel="stylesheet" type="text/css" />

</head>
<body>
<table cellspacing='2' width='100%' border='0'>
	<tr>
		<td><a href='index.php' target='_self'>Quản lý MU</a></td>
		<td><a href='cardphone.php' target='_self'>Nạp thẻ</a></td>
		<td><a href='view_card.php' target='_self'>Xem thẻ</a></td>
		<td><a href='online.php' target='_self'>Đang Online</a></td>
		<td><a href='topmu.php' target='_self'>TOP MU</a></td>
		<td><a href='../log/' target='_self'>LOG MU</a></td>
	</tr>
</table>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Tài khoản</td>
	<td align="center">Tình trạng</td>
	<td align="center">Thời gian</td>
</tr>

<?php
	$query = "SELECT Name,IsThuePoint,TimeThuePoint From Character Where IsThuePoint>0 Order By TimeThuePoint ASC";
	$result = $db->Execute($query);
$time = _time();
while($row = $result->fetchrow())
  	{
	$rank = $rank+1;
	if ($row[1] == 1) $status = "Đang thuê Point";
	if ($row[1] == 2) $status = "Đã xử lý";
	$time_du = $row[2]-$time;
		$hour = floor($time_du/3600);
		$phut = floor (($time_du - $hour*3600 )/60);
		$time_free = "$hour h $phut phút";
						
		echo"<tr bgcolor='#ffffff' >
		<td align='center'>$rank</td>
		<td align='center'>$row[0]</td>
		<td align='center'>$status</td>
		<td align='center'>$time_free</td>
		</tr>";
}
$db->Close();
?>
</table>
</body>