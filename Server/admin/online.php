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
$title = "Online";
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
<?php

	$fpage = intval($_GET['page']);
	if(empty($fpage)){ $fpage = 1; }

	$query_total_acc = "SELECT Count(*) FROM MEMB_INFO";
	$result_total_acc = $db->Execute($query_total_acc);
	$total_acc = $result_total_acc->fetchrow();

	$query_total_char = "SELECT Count(*) FROM Character";
	$result_total_char = $db->Execute($query_total_char);
	$total_char = $result_total_char->fetchrow();
	
	$query = "SELECT Count(*) FROM Memb_Stat WHERE ConnectStat='1'";
	$result = $db->Execute($query);
	$total_char_online = $result->fetchrow();

$count_SV	=	count($server);
	for ($i=0;$i<$count_SV;$i++) {
		$query_Sub[$i] = "Select count(*) from Memb_Stat where ConnectStat='1' and ServerName='$server[$i]'";
		$result_Sub[$i] = $db->Execute($query_Sub[$i]);
		$total_char_online_Sub[$i] = $result_Sub[$i]->fetchrow();
	}
?>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="7" align="center">
		Tài khoản: <b><font color="red"><?php echo "$total_acc[0]"; ?></font></b> | Nhân vật: <b><font color="red"><?php echo "$total_char[0]"; ?></font></b> | Đang chơi: <b><font color="red"><?php echo "$total_char_online[0]"; ?></font></b><br>
		<table width="80%" cellspacing="2" cellpadding="3" border="0">
			<tr>
				<?php for($i=0;$i<$count_SV;$i++) { ?>
				<td align="center"><?php echo $server[$i]; ?> : <b><font color="red"><?php echo $total_char_online_Sub[$i][0]; ?></font></b></td>
				<?php } ?>
			</tr>
		</table>
	</td>
</tr>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Nhân vật</td>
	<td align="center"><font color=red><strong>RL</strong></font> / <font color=blue><strong>RS</strong></font> / LV</td>
	<td align="center">Class</td>
	<td align="center">Server</td>
	<td align="center">Map</td>
    <td align="center">Thế hệ</td>
</tr>


<?php
	$row_per_page = 15;
    $fstart = ($fpage-1)*$row_per_page;

$char_online_query = "SELECT MEMB_INFO.memb___id, Name, Resets, Class, Clevel, Strength, Dexterity, Vitality, Energy, MapNumber, MapPosX, MapPosY, PkLevel, PkCount, Leadership, LevelUpPoint, ctlcode, relifes, thehe, ServerName, MEMB_STAT.IP, MEMB_INFO.ip FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT JOIN AccountCharacter ON AccountCharacter.GameIDC collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectStat = 1 ORDER BY ServerName, MapNumber, MapPosX, MapPosY, thehe, Name";
$char_online_result = $db->SelectLimit($char_online_query, $row_per_page, $fstart) OR DIE("Query Error : $char_online_query");

$rank = $fstart;
while($char_online_fetch = $char_online_result->FetchRow()) {
    $rank++;
    
    $account = $char_online_fetch[0];
    $Name = $char_online_fetch[1];
    $Reset = $char_online_fetch[2];
    $Class = $char_online_fetch[3];
    $Clevel = $char_online_fetch[4];
    $Strength = $char_online_fetch[5];
    $Dexterity = $char_online_fetch[6];
    $Vitality = $char_online_fetch[7];
    $Energy = $char_online_fetch[8];
    $MapNumber = $char_online_fetch[9];
    $MapPosX = $char_online_fetch[10];
    $MapPosY = $char_online_fetch[11];
    $PkLevel = $char_online_fetch[12];
    $PkCount = $char_online_fetch[13];
    $Leadership = $char_online_fetch[14];
    $LevelUpPoint = $char_online_fetch[15];
    $ctlcode = $char_online_fetch[16];
    $relifes = $char_online_fetch[17];
    $thehe = $char_online_fetch[18];
    $ServerName = $char_online_fetch[19];
    $memstat_ip = $char_online_fetch[20];
    $meminfo_ip = $char_online_fetch[21]; 
    
    if ($Strength < 0) {$Strength = $Strength + 65536;}
    if ($Dexterity < 0) {$Dexterity = $Dexterity+65536;}
    if ($Vitality < 0) {$Vitality = $Vitality+65536;}
    if ($Energy < 0) {$Energy = $Energy+65536;}
    if ($Leadership < 0) {$Leadership = $Leadership+65536;}
    
    $total_stat = $Strength + $Dexterity + $Vitality + $Energy;
    if($Class == 64 || $Class == 65 || $Class == 66) {
        $total_stat += $Leadership;
    }
    
    switch($PkLevel)
    {
        case 1: $PkLevel = 'Siêu Anh Hùng';        break;
        case 2: $PkLevel = 'Anh Hùng';        break;
        case 3: $PkLevel = 'Dân Thường';        break;
        case 4: $PkLevel = 'Sát Thủ';        break;
        case 5: $PkLevel = 'Sát Thủ Khát Máu';        break;
        case 6: $PkLevel = 'Sát Thủ Điên Cuồng';        break;
        default: $PkLevel = 'Chưa xác định PK';
    }
    
    switch($Class)
    {
        case 0: $Class ='Dark Wizard';        break;
        case 1: $Class ='Soul Master';        break;
        case 2: 
        case 3: $Class ='Grand Master';        break;
        case 16: $Class ='Dark Knight';        break;
        case 17: $Class ='Blade Knight';        break;
        case 18: 
        case 19: $Class ='Blade Master';        break;
        case 32: $Class ='Elf';        break;
        case 33: $Class ='Muse Elf';        break;
        case 34: 
        case 35: $Class ='Hight Elf';       break;
        case 48: $Class ='Magic Gladiator';        break;
        case 49: 
        case 50: $Class ='Duel Master';        break;
        case 64: $Class ='DarkLord';        break;
        case 65: 
        case 66: $Class ='Lord Emperor';        break;
        case 80: $Class ='Sumoner';        break;
        case 81: $Class ='Bloody Summoner';        break;
        case 82: 
        case 83: $Class ='Dimension Master';        break;
        case 96: $Class ='Rage Fighter';        break;
        case 97: 
        case 98: $Class ='First Class';        break;
        default: $Class ='Không xác định Class';
    }
    
    switch($MapNumber)
    {
        case 0: $MapNumber = 'Lorencia'; break;
        case 1: $MapNumber = 'Dungeon'; break;
        case 2: $MapNumber = 'Davias'; break;
        case 3: $MapNumber = 'Noria'; break;
        case 4: $MapNumber = 'LostTower'; break;
        case 5: $MapNumber = 'Exile'; break;
        case 6: $MapNumber = 'Stadium'; break;
        case 7: $MapNumber = 'Atlans'; break;
        case 8: $MapNumber = 'Tarkan'; break;
        case 10: $MapNumber = 'Icarus'; break;
        case 11: $MapNumber = 'BloodCastle 1'; break;
        case 12: $MapNumber = 'BloodCastle 2'; break;
        case 13: $MapNumber = 'BloodCastle 3'; break;
        case 14: $MapNumber = 'BloodCastle 4'; break;
        case 15: $MapNumber = 'BloodCastle 5'; break;
        case 16: $MapNumber = 'BloodCastle 6'; break;
        case 17: $MapNumber = 'BloodCastle 7'; break;
        case 52: $MapNumber = 'BloodCastle 8'; break;
        case 9: $MapNumber = 'DevilSquare 1-2-3-4'; break;
        case 32: $MapNumber = 'Devil Square 5-6-7'; break;
        case 35: $MapNumber = 'Devil Square'; break;
        case 18: $MapNumber = 'ChaosCastle 1'; break;
        case 19: $MapNumber = 'ChaosCastle 2'; break;
        case 20: $MapNumber = 'ChaosCastle 3'; break;
        case 21: $MapNumber = 'ChaosCastle 4'; break;
        case 22: $MapNumber = 'ChaosCastle 5'; break;
        case 23: $MapNumber = 'ChaosCastle 6'; break;
        case 53: $MapNumber = 'ChaosCastle 7'; break;
        case 24: $MapNumber = 'Kalima 1'; break;
        case 25: $MapNumber = 'Kalima 2'; break;
        case 26: $MapNumber = 'Kalima 3'; break;
        case 27: $MapNumber = 'Kalima 4'; break;
        case 28: $MapNumber = 'Kalima 5'; break;
        case 29: $MapNumber = 'Kalima 6'; break;
        case 36: $MapNumber = 'Kalima 7'; break;
        case 30: $MapNumber = 'Valley Of Loren'; break;
        case 31: $MapNumber = 'Land Of Trials'; break;
        case 33: $MapNumber = 'Aida'; break;
        case 34: $MapNumber = 'CryWolf'; break;
        case 37: $MapNumber = 'Kantru 1'; break;
        case 38: $MapNumber = 'Kantru 2'; break;
        case 39: $MapNumber = 'Kantru Ref'; break;
        case 40: $MapNumber = 'Silent Map'; break;
        case 41: $MapNumber = 'Balgass Barrack'; break;
        case 42: $MapNumber = 'Balgass Refuge'; break;
        case 45: $MapNumber = 'Illusion Temple 1'; break;
        case 46: $MapNumber = 'Illusion Temple 2'; break;
        case 47: $MapNumber = 'Illusion Temple 3'; break;
        case 48: $MapNumber = 'Illusion Temple 4'; break;
        case 49: $MapNumber = 'Illusion Temple 5'; break;
        case 50: $MapNumber = 'Illusion Temple 6'; break;
        case 51: $MapNumber = 'Elbeland'; break;
        case 56: $MapNumber = 'Swamp Of Calmness'; break;
        case 57: $MapNumber = 'Raklion'; break;
        case 58: $MapNumber = 'Raklion BOSS'; break;
        case 62: $MapNumber = 'Santa Town'; break;
        case 63: $MapNumber = 'Vulcanus'; break;
        case 64: $MapNumber = 'Duel Arena'; break;
        case 65: $MapNumber = 'Doppel Ganger-A'; break;
        case 66: $MapNumber = 'Doppel Ganger-B'; break;
        case 67: $MapNumber = 'Doppel Ganger-C'; break;
        case 68: $MapNumber = 'Doppel Ganger-D'; break;
        case 69: $MapNumber = 'Empire Guardian-A'; break;
        case 70: $MapNumber = 'Empire Guardian-B'; break;
        case 71: $MapNumber = 'Empire Guardian-C'; break;
        case 72: $MapNumber = 'Empire Guardian-D'; break;
        case 79: $MapNumber = 'Market Loren'; break;
        default: $MapNumber = 'Chưa xác định MAP';
    }
    
    if(strlen($thehe_choise[$thehe]) > 0) {
        $thehechar =  $thehe_choise[$thehe];
    } else {
        $thehechar = $thehe;
    }
    
    echo"<tr bgcolor='#F9E7CF' >
		<td align='center'>$rank</td>
		<td align='center'><a href='#' onMouseOut='hidetip();' onMouseOver=\"showtip('Level: $Clevel. Tổng số Point sử dụng: $total_stat, Point dư: $LevelUpPoint. Tình trạng: $PkLevel, Giết người: $PkCount.');\">$Name</a> <em>($account)</em></td>
		<td align='center'><font color=red>$relifes</font> / <font color=blue>$Reset</font> / $c$Clevel</td>
		<td align='center'>$Class</td>
		<td align='center'>$ServerName</td>
		<td align='center'>$MapNumber: $MapPosX , $MapPosY</td>
        <td align='center'>$thehechar (id: $thehe)</td>
	</tr>";
}
		
?>
												
</table>
<br>
<center>
<?php
$totalpages = floor(($total_char_online[0]-1) / $row_per_page) + 1; 
		$c = 0;
		if ($totalpages > 0) {
			echo "Trang: [".$totalpages."] ";
		}
		while($c<$totalpages){
			$page = $c + 1;
			if($_GET['page']==$page){
				echo "[$page] ";
			}else{//else 
				echo "<a href=\"?page=$page\">[$page] </a> ";
			} 
			$c = $c+1; 
		} 
$db->Close();
?>
</center>
<script type="text/javascript" src="js/tooltip.js"></script>
</body>
</html>