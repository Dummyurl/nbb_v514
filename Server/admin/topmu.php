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
include('function.php');
include('../config/config_thehe.php');
$title = "TopMU";
$top_type = $_GET['top_type'];  $top_type = antiinject_query($top_type);
if(empty($top_type)){ $top_type = ''; }
$top_per_page = 30;
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
<center>
    <a href="topmu.php">All</a> | 
    <a href="?top_type=DW">Dark Wizard</a> | 
    <a href="?top_type=DK">Dark Knight</a> | 
    <a href="?top_type=Elf">ELF</a> | 
    <a href="?top_type=MG">MG</a> | 
    <a href="?top_type=DL">DarkLord</a> | 
    <a href="?top_type=Su.M">Summoner</a> | 
    <a href="?top_type=RF">Rage Fighter</a> 
</center>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Nhân vật</td>
	<td align="center">(RS/RL)</td>
	<td align="center">Class</td>
	<td align="center">Tình trạng</td>
    <td align="center">Thế hệ</td>
</tr>

<?php
	$fpage = intval($_GET['page']);
	if(empty($fpage)){ $fpage = 1; }
	$fstart = ($fpage-1)*$top_per_page; 
	$fstart = round($fstart,0);
	$rank = $fstart;


	$query = "SELECT AccountID, Name, Resets, Class, Clevel, Strength, Dexterity, Vitality, Energy, MapNumber, MapPosX, MapPosY, PkLevel, PkCount, Leadership, LevelUpPoint, relifes, thehe, memb___id FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT";
    
    switch($top_type)
    {
    	case 'DW': $query .= " AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;
    	case 'DK': $query .= " AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;
    	case 'Elf': $query .= " AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;
    	case 'MG': $query .= " AND (Class = 48 OR Class = 49 OR Class = 50) "; break;
    	case 'DL': $query .= " AND (Class = 64 OR Class = 65 OR Class = 66) "; break;
    	case 'Su.M': $query .= " AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;
        case 'RF': $query .= " AND (Class = 96 OR Class = 97 OR Class = 98 OR Class = 99) "; break;
    }

	$query .= " ORDER BY relifes DESC, resets DESC , cLevel DESC";

	$result = $db->SelectLimit($query, $top_per_page, $fstart);

while($row = $result->fetchrow()) 	{

$query2="Select ConnectStat,ServerName from MEMB_STAT where memb___id='$row[0]'";
$result2 = $db->Execute($query2);
$row2 = $result2->fetchrow();

$query3="Select GameIDC from AccountCharacter where Id='$row[0]'";
$result3 = $db->Execute($query3);
$row3 = $result3->fetchrow();

$rank = $rank+1;

if ($row[5] < 0) {$row[5] = $row[5]+65536;}
if ($row[6] < 0) {$row[6] = $row[6]+65536;}
if ($row[7] < 0) {$row[7] = $row[7]+65536;}
if ($row[8] < 0) {$row[8] = $row[8]+65536;}
if ($row[14] < 0) {$row[14] = $row[14]+65536;}

if ($row[3] != 64 OR $row[3] != 65 OR $row[3] != 66) {
		$total_stat = $row[5] + $row[6] + $row[7] + $row[8];
}
else {$total_stat = $row[5] + $row[6] + $row[7] + $row[8] + $row[14];}

switch($row[12])
{
    case 1: $PkLevel = 'Siêu Anh Hùng';        break;
    case 2: $PkLevel = 'Anh Hùng';        break;
    case 3: $PkLevel = 'Dân Thường';        break;
    case 4: $PkLevel = 'Sát Thủ';        break;
    case 5: $PkLevel = 'Sát Thủ Khát Máu';        break;
    case 6: $PkLevel = 'Sát Thủ Điên Cuồng';        break;
    default: $PkLevel = 'Chưa xác định PK';
}

switch($row[3])
{
    case 0: $nv_Class ='Dark Wizard';        break;
    case 1: $nv_Class ='Soul Master';        break;
    case 2: 
    case 3: $nv_Class ='Grand Master';        break;
    case 16: $nv_Class ='Dark Knight';        break;
    case 17: $nv_Class ='Blade Knight';        break;
    case 18: 
    case 19: $nv_Class ='Blade Master';        break;
    case 32: $nv_Class ='Elf';        break;
    case 33: $nv_Class ='Muse Elf';        break;
    case 34: 
    case 35: $nv_Class ='Hight Elf';       break;
    case 48: $nv_Class ='Magic Gladiator';        break;
    case 49: 
    case 50: $nv_Class ='Duel Master';        break;
    case 64: $nv_Class ='DarkLord';        break;
    case 65: 
    case 66: $nv_Class ='Lord Emperor';        break;
    case 80: $nv_Class ='Sumoner';        break;
    case 81: $nv_Class ='Bloody Summoner';        break;
    case 82: 
    case 83: $nv_Class ='Dimension Master';        break;
    case 96: $nv_Class ='Rage Fighter';        break;
    case 97: 
    case 98: $nv_Class ='First Class';        break;
    default: $nv_Class ='Không xác định Class';
}

switch($row[9])
{
    case 0: $row[9] = 'Lorencia'; break;
    case 1: $row[9] = 'Dungeon'; break;
    case 2: $row[9] = 'Davias'; break;
    case 3: $row[9] = 'Noria'; break;
    case 4: $row[9] = 'LostTower'; break;
    case 5: $row[9] = 'Exile'; break;
    case 6: $row[9] = 'Stadium'; break;
    case 7: $row[9] = 'Atlans'; break;
    case 8: $row[9] = 'Tarkan'; break;
    case 10: $row[9] = 'Icarus'; break;
    case 11: $row[9] = 'BloodCastle 1'; break;
    case 12: $row[9] = 'BloodCastle 2'; break;
    case 13: $row[9] = 'BloodCastle 3'; break;
    case 14: $row[9] = 'BloodCastle 4'; break;
    case 15: $row[9] = 'BloodCastle 5'; break;
    case 16: $row[9] = 'BloodCastle 6'; break;
    case 17: $row[9] = 'BloodCastle 7'; break;
    case 52: $row[9] = 'BloodCastle 8'; break;
    case 9: $row[9] = 'DevilSquare 1-2-3-4'; break;
    case 32: $row[9] = 'Devil Square 5-6-7'; break;
    case 35: $row[9] = 'Devil Square'; break;
    case 18: $row[9] = 'ChaosCastle 1'; break;
    case 19: $row[9] = 'ChaosCastle 2'; break;
    case 20: $row[9] = 'ChaosCastle 3'; break;
    case 21: $row[9] = 'ChaosCastle 4'; break;
    case 22: $row[9] = 'ChaosCastle 5'; break;
    case 23: $row[9] = 'ChaosCastle 6'; break;
    case 53: $row[9] = 'ChaosCastle 7'; break;
    case 24: $row[9] = 'Kalima 1'; break;
    case 25: $row[9] = 'Kalima 2'; break;
    case 26: $row[9] = 'Kalima 3'; break;
    case 27: $row[9] = 'Kalima 4'; break;
    case 28: $row[9] = 'Kalima 5'; break;
    case 29: $row[9] = 'Kalima 6'; break;
    case 36: $row[9] = 'Kalima 7'; break;
    case 30: $row[9] = 'Valley Of Loren'; break;
    case 31: $row[9] = 'Land Of Trials'; break;
    case 33: $row[9] = 'Aida'; break;
    case 34: $row[9] = 'CryWolf'; break;
    case 37: $row[9] = 'Kantru 1'; break;
    case 38: $row[9] = 'Kantru 2'; break;
    case 39: $row[9] = 'Kantru Ref'; break;
    case 40: $row[9] = 'Silent Map'; break;
    case 41: $row[9] = 'Balgass Barrack'; break;
    case 42: $row[9] = 'Balgass Refuge'; break;
    case 45: $row[9] = 'Illusion Temple 1'; break;
    case 46: $row[9] = 'Illusion Temple 2'; break;
    case 47: $row[9] = 'Illusion Temple 3'; break;
    case 48: $row[9] = 'Illusion Temple 4'; break;
    case 49: $row[9] = 'Illusion Temple 5'; break;
    case 50: $row[9] = 'Illusion Temple 6'; break;
    case 51: $row[9] = 'Elbeland'; break;
    case 56: $row[9] = 'Swamp Of Calmness'; break;
    case 57: $row[9] = 'Raklion'; break;
    case 58: $row[9] = 'Raklion BOSS'; break;
    case 62: $row[9] = 'Santa Town'; break;
    case 63: $row[9] = 'Vulcanus'; break;
    case 64: $row[9] = 'Duel Arena'; break;
    case 65: $row[9] = 'Doppel Ganger-A'; break;
    case 66: $row[9] = 'Doppel Ganger-B'; break;
    case 67: $row[9] = 'Doppel Ganger-C'; break;
    case 68: $row[9] = 'Doppel Ganger-D'; break;
    case 69: $row[9] = 'Empire Guardian-A'; break;
    case 70: $row[9] = 'Empire Guardian-B'; break;
    case 71: $row[9] = 'Empire Guardian-C'; break;
    case 72: $row[9] = 'Empire Guardian-D'; break;
    case 79: $row[9] = 'Market Loren'; break;
    default: $row[9] = 'Chưa xác định MAP';
}
$theheid = $row[17];
if(strlen($thehe_choise[$theheid]) > 0) {
    $thehechar =  $thehe_choise[$theheid];
} else {
    $thehechar = $theheid;
}

$account = $row[18];

if($row2[0] == 0 || $row3[0] <> $row[1]){ 
	$row2[0] ='<font color="Blue">Offline</font>';
	echo"<tr bgcolor='#F9E7CF' >
		<td align='center'>$rank</td>
		<td align='center'><a href='#' onMouseOut='hidetip();' onMouseOver=\"showtip('Tài khoản : $row[0].<br />Class: $nv_Class. Level: $row[4].<br>ReLife: $row[16]. Reset: $row[2].<br>Tổng số Point sử dụng: $total_stat.<br>Point dư: $row[15].<br>Tinh trang: $PkLevel.<br>Giet nguoi: $row[13].');\">$row[1]</a> <i>($account)</i></td>
		<td align='center'><font color=blue>$row[2]</font>/<font color=red>$row[16]</font></td>
		<td align='center'>$nv_Class</td>
		<td align='center'>$row2[0]</td>
        <td align='center'>$thehechar</td>
	</tr>";

}
if($row2[0] == 1 && $row3[0] == $row[1]){ 
	$row2[0] ='<font color="Red"><b>Online</b></font>';
	echo"<tr bgcolor='#F9E7CF' >
		<td align='center'>$rank</td>
		<td align='center'><a href='#' onMouseOut='hidetip();' onMouseOver=\"showtip('Tài khoản : $row[0].<br />Class: $nv_Class. Level: $row[4].<br>ReLife: $row[16]. Reset: $row[2].<br>Tổng số Point sử dụng: $total_stat.<br>Point dư: $row[15].<br>Tinh trang: $PkLevel.<br>Giet nguoi: $row[13].<br>Server: $row2[1].<br>Map: $row[9], Tọa độ: $row[10],$row[11]');\">$row[1]</a> <i>($account)</i></td>
		<td align='center'><font color=blue>$row[2]</font>/<font color=red>$row[16]</font></td>
		<td align='center'>$nv_Class</td>
		<td align='center'>$row2[0]</td>
        <td align='center'>$thehechar</td>
	</tr>";
}
	
}
$db->Close();
?>

</table>
<center><b>Trang</b>: <a href="?top_type=<?php echo $top_type; ?>&page=1">[1]</a> <a href="?top_type=<?php echo $top_type; ?>&page=2">[2]</a> <a href="?top_type=<?php echo $top_type; ?>&page=3">[3]</a> <a href="?top_type=<?php echo $top_type; ?>&page=4">[4]</a> <a href="?top_type=<?php echo $top_type; ?>&page=5">[5]</a> <a href="?top_type=<?php echo $top_type; ?>&page=6">[6]</a> <a href="?top_type=<?php echo $top_type; ?>&page=7">[7]</a> <a href="?top_type=<?php echo $top_type; ?>&page=8">[8]</a> <a href="?top_type=<?php echo $top_type; ?>&page=9">[9]</a> <a href="?top_type=<?php echo $top_type; ?>&page=10">[10]</a></center>
<script type="text/javascript" src="js/tooltip.js"></script>
</body>