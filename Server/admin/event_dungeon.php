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
$title = "Dungeon";
$server_dungeon = "HT-5";


SESSION_start();
if ($_POST[submit]) {
	$pass_online = md5($_POST[online]);
	if ($pass_online == "$passcode") $_SESSION['online'] = "$passcode";
}
if (!$_SESSION['online'] || $_SESSION['online'] != "$passcode") {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='online'>
	Code: <input type=password name=online> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}


$char_dun_query = "SELECT Name, Relifes, Resets, Class, MapPosX, MapPosY FROM Character JOIN AccountCharacter ON MapNumber=1 AND Character.AccountID collate DATABASE_DEFAULT = AccountCharacter.Id collate DATABASE_DEFAULT AND Character.Name=AccountCharacter.GameIDC JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectStat=1 AND ServerName='$server_dungeon' AND MapPosY>140";
$char_dun_result = $db->Execute($char_dun_query);
$count_dun = $char_dun_result->NumRows();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Refresh" content="10" />
<title><?php echo $count_dun . "-" . $title; ?></title>
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F9E7CF">
<div id="dhtmltooltip"></div>
<img id="dhtmlpointer" src="images/tooltiparrow.gif">

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td align="center" colspan="7">Tổng đang ở Dungeon : <?php echo $count_dun; ?></td>
</tr>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Nhân vật</td>
	<td align="center">ReLife</td>
	<td align="center">ReSet</td>
	<td align="center">Class</td>
	<td align="center">Server</td>
	<td align="center">Map</td>
</tr>


<?php
$stt = 0;
while($char_dun_fetch = $char_dun_result->FetchRow()) {
    switch($char_dun_fetch[3])
    {
        case 0: $ClassChar ='Dark Wizard';        break;
        case 1: $ClassChar ='Soul Master';        break;
        case 2: 
        case 3: $ClassChar ='Grand Master';        break;
        case 16: $ClassChar ='Dark Knight';        break;
        case 17: $ClassChar ='Blade Knight';        break;
        case 18: 
        case 19: $ClassChar ='Blade Master';        break;
        case 32: $ClassChar ='Elf';        break;
        case 33: $ClassChar ='Muse Elf';        break;
        case 34: 
        case 35: $ClassChar ='Hight Elf';       break;
        case 48: $ClassChar ='Magic Gladiator';        break;
        case 49: 
        case 50: $ClassChar ='Duel Master';        break;
        case 64: $ClassChar ='DarkLord';        break;
        case 65: 
        case 66: $ClassChar ='Lord Emperor';        break;
        case 80: $ClassChar ='Sumoner';        break;
        case 81: $ClassChar ='Bloody Summoner';        break;
        case 82: 
        case 83: $ClassChar ='Dimension Master';        break;
        case 96: $ClassChar ='Rage Fighter';        break;
        case 97: 
        case 98: $ClassChar ='First Class';        break;
        default: $ClassChar ='Không xác định Class';
    }
    
    $stt++;
    echo"<tr bgcolor='#F9E7CF' >
		<td align='center'>$stt</td>
		<td align='center'>$char_dun_fetch[0]</td>
		<td align='center'>$char_dun_fetch[1]</td>
		<td align='center'>$char_dun_fetch[2]</td>
		<td align='center'>$ClassChar</td>
		<td align='center'>$server_dungeon</td>
		<td align='center'>Dungeon: $char_dun_fetch[4] , $char_dun_fetch[5]</td>
	</tr>";
}
$db->Close();
?>
</table>
<script type="text/javascript" src="js/tooltip.js"></script>
</body>
</html>