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
include_once('../config/config_napthe.php');
include_once("../func_timechenh.php");

$title = "CardView";
SESSION_start();
if ($_POST[submit]) {
	$pass = md5($_POST[viewcard]);
	if ($pass == "$passviewcard") $_SESSION['viewcard'] = "$passviewcard";
}
if (!$_SESSION['viewcard'] || $_SESSION['viewcard'] != "$passviewcard") {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='viewcard'>
	Code: <input type=password name=viewcard> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
$time_now = $timestamp;
$day_now = date("d",$time_now);
$month_now = date("m",$time_now);
$year_now = date("Y",$time_now);

$time_after_1day = _time()-86400;
$day_after_1day = date("d",$time_after_1day);
$month_after_1day = date("m",$time_after_1day);
$year_after_1day = date("Y",$time_after_1day);

$thang = $_GET['thang'];
$nam = $_GET['nam'];
if (isset($thang)) {
	$month=$thang;
} else $thang = $month;

if (isset($nam)) {
	$year=$nam;
} else $nam = $year;

if (!preg_match("/^[0-9]*$/i", $thang))
	{
    echo "<center>Dữ liệu lỗi. Tháng : $thang chỉ được sử dụng số.</center>"; exit();
	}

if ($thang < 1 OR $thang >12)
	{
    echo "<center>Dữ liệu lỗi. Tháng : $thang chỉ từ 1 đến 12</center>"; exit();
	}
if (!preg_match("/^[0-9]*$/i", $nam))
	{
    echo "<center>Dữ liệu lỗi. Năm : $nam chỉ được sử dụng số.</center>"; exit();
	}
if ($nam < 2008 OR $nam >2020)
	{
    echo "<center>Dữ liệu lỗi. Hiện tại chỉ cho phép năm : $nam từ 2008 đến 2010</center>"; exit();
	}

$thang_truoc = $thang - 1;
$thang_sau = $thang + 1;

$nam_truoc = $nam;
$nam_sau = $nam;

if ($month == 1) {$thang_truoc = 12; $nam_truoc= $year-1;}
if ($month == 12) {$thang_sau = 1; $nam_sau= $year+1;}



$fpage = intval($_GET['page']);
if(empty($fpage)){ $fpage = 1; }
$fstart = ($fpage-1)*$Card_per_page; 
$fstart = round($fstart,0);
$stt_str = $fstart;

$action = $_GET['action'];
if(empty($action)){ $action = ''; }

$status = intval($_GET['status']);
if(empty($status)){ $status = ''; }


$menhgia = intval($_GET['menhgia']);
if(empty($menhgia)){ $menhgia = ''; }

$query = "Select stt, acc, Name, menhgia, card_type, card_num, card_serial, ngay, status, addvpoint, timenap, timeduyet From CardPhone ";
$list_card_type = $_GET['list_card_type'];
$list_menhgia = intval($_GET['list_menhgia']);
$list_status = intval($_GET['list_status']);

if(empty($list_card_type) && empty($list_menhgia) && empty($list_status) && empty($list_ctv) && empty($list_ctv_check)) {} else { $query .="Where "; }

if(empty($list_card_type)){ $list_card_type = ''; } else { $query .= "card_type='$list_card_type' "; }

if(empty($list_menhgia)){ $list_menhgia = ''; } else { 
	if(empty($list_card_type)) {} else { $query .= "and ";}
	$query .= "menhgia='$list_menhgia' "; 
	}

if(empty($list_status)){ $list_status = ''; } else { 
	if(empty($list_card_type) && empty($list_menhgia)) {} else { $query .= "and "; }
	if($list_status == 1) { $query .= "status is NULL ";  }
	else {
		if($list_status == 2) { $list_stat = 1; }
		if($list_status == 3) { $list_stat = 2; }
		if($list_status == 4) { $list_stat = 3; }
		$query .= "status='$list_stat' "; 
		}
	}


if($list_status == 1 or $list_status == 2) { $query .= "ORDER BY stt ASC"; }
else { $query .= "ORDER BY stt DESC"; }

$result = $db->SelectLimit($query, $Card_per_page, $fstart);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.body {
	font-size: 14px;
}
tr {
	font-size: 14px;
}
td {
	font-size: 14px;
}
a:link,a:visited,a:hover,a:active {
	text-decoration: none;
}
-->
</style>
</head>
<body bgcolor="#F9E7CF">
<div id="dhtmltooltip"></div>
<img id="dhtmlpointer" src="images/tooltiparrow.gif">
<?php require('linktop.php'); ?>
<table width="100%" cellspacing="1" cellpadding="3" border="0"><tr>
<td align="center"><a href="cardphone.php">Home</a></td>

<td align="right">Loại Thẻ</td>
<td align="left"><form name=list_card_type method=get>
	<select name='list_card_type' onchange='submit();'>
		<option value=''>- Chọn Loại thẻ -</option>
		<option value="GATE" <?php if($list_card_type == 'GATE') { ?> selected="selected" <?php } ?>>GATE</option>
        <option value="VTC" <?php if($list_card_type == 'VTC') { ?> selected="selected" <?php } ?>>VTC</option>
        <option value="Viettel" <?php if($list_card_type == 'Viettel') { ?> selected="selected" <?php } ?>>Viettel</option>
		<option value="MobiPhone" <?php if($list_card_type == 'MobiPhone') { ?> selected="selected" <?php } ?>>MobiPhone</option>
		<option value="VinaPhone" <?php if($list_card_type == 'VinaPhone') { ?> selected="selected" <?php } ?>>VinaPhone</option>
		<option value="VinaGame" <?php if($list_card_type == 'VinaGame') { ?> selected="selected" <?php } ?>>VinaGame</option>
	</select>
	<input type=hidden name='thang' value='<?php echo $month; ?>'>
	<input type=hidden name='nam' value='<?php echo $year; ?>'>
	<input type=hidden name='list_menhgia' value='<?php echo $list_menhgia; ?>'>
	<input type=hidden name='page' value='<?php echo $fpage; ?>'>
</form>
</td>

<td align="right">Mệnh giá: </td>
<td align="left"><form name=list_menhgia method=get>	
	<input type=hidden name='list_card_type' value='<?php echo $list_card_type; ?>'>
	<select name='list_menhgia' onchange='submit();'>
		<option value=''>- Tất cả -</option>
		<?php if($list_card_type == 'VinaPhone' or $list_card_type == 'MobiPhone' or $list_card_type == 'Viettel') { ?>
		<option value='10000' <?php if($list_menhgia=='10000') { ?>selected='1'<?php } ?> ><?php echo number_format(10000, 0, ',', '.'); ?></option>
		<option value='20000' <?php if($list_menhgia=='20000') { ?>selected='1'<?php } ?> ><?php echo number_format(20000, 0, ',', '.'); ?></option>
		<option value='30000' <?php if($list_menhgia=='30000') { ?>selected='1'<?php } ?> ><?php echo number_format(30000, 0, ',', '.'); ?></option>
		<option value='50000' <?php if($list_menhgia=='50000') { ?>selected='1'<?php } ?> ><?php echo number_format(50000, 0, ',', '.'); ?></option>
		<option value='100000' <?php if($list_menhgia=='100000') { ?>selected='1'<?php } ?> ><?php echo number_format(100000, 0, ',', '.'); ?></option>
		<option value='200000' <?php if($list_menhgia=='200000') { ?>selected='1'<?php } ?> ><?php echo number_format(200000, 0, ',', '.'); ?></option>
		<option value='300000' <?php if($list_menhgia=='300000') { ?>selected='1'<?php } ?> ><?php echo number_format(300000, 0, ',', '.'); ?></option>
		<option value='500000' <?php if($list_menhgia=='500000') { ?>selected='1'<?php } ?> ><?php echo number_format(500000, 0, ',', '.'); ?></option>
		<?php } 
		elseif($list_card_type == 'VinaGame') { ?>
		<option value='20000' <?php if($list_menhgia=='20000') { ?>selected='1'<?php } ?> ><?php echo number_format(20000, 0, ',', '.'); ?></option>
		<option value='60000' <?php if($list_menhgia=='60000') { ?>selected='1'<?php } ?> ><?php echo number_format(60000, 0, ',', '.'); ?></option>
		<?php } 
		elseif($list_card_type == 'VTC') { ?>
		<option value='15000' <?php if($list_menhgia=='15000') { ?>selected='1'<?php } ?> ><?php echo number_format(15000, 0, ',', '.'); ?></option>
		<option value='20000' <?php if($list_menhgia=='20000') { ?>selected='1'<?php } ?> ><?php echo number_format(20000, 0, ',', '.'); ?></option>
		<option value='50000' <?php if($list_menhgia=='50000') { ?>selected='1'<?php } ?> ><?php echo number_format(50000, 0, ',', '.'); ?></option>
		<option value='60000' <?php if($list_menhgia=='60000') { ?>selected='1'<?php } ?> ><?php echo number_format(60000, 0, ',', '.'); ?></option>
		<option value='100000' <?php if($list_menhgia=='100000') { ?>selected='1'<?php } ?> ><?php echo number_format(100000, 0, ',', '.'); ?></option>
		<?php } 
		else { ?>
		<option value='10000' <?php if($list_menhgia=='10000') { ?>selected='1'<?php } ?> ><?php echo number_format(10000, 0, ',', '.'); ?></option>
		<option value='15000' <?php if($list_menhgia=='15000') { ?>selected='1'<?php } ?> ><?php echo number_format(15000, 0, ',', '.'); ?></option>
		<option value='20000' <?php if($list_menhgia=='20000') { ?>selected='1'<?php } ?> ><?php echo number_format(20000, 0, ',', '.'); ?></option>
		<option value='30000' <?php if($list_menhgia=='30000') { ?>selected='1'<?php } ?> ><?php echo number_format(30000, 0, ',', '.'); ?></option>
		<option value='50000' <?php if($list_menhgia=='50000') { ?>selected='1'<?php } ?> ><?php echo number_format(50000, 0, ',', '.'); ?></option>
		<option value='60000' <?php if($list_menhgia=='60000') { ?>selected='1'<?php } ?> ><?php echo number_format(60000, 0, ',', '.'); ?></option>
		<option value='100000' <?php if($list_menhgia=='100000') { ?>selected='1'<?php } ?> ><?php echo number_format(100000, 0, ',', '.'); ?></option>
		<option value='200000' <?php if($list_menhgia=='200000') { ?>selected='1'<?php } ?> ><?php echo number_format(200000, 0, ',', '.'); ?></option>
		<option value='300000' <?php if($list_menhgia=='300000') { ?>selected='1'<?php } ?> ><?php echo number_format(300000, 0, ',', '.'); ?></option>
		<option value='500000' <?php if($list_menhgia=='500000') { ?>selected='1'<?php } ?> ><?php echo number_format(500000, 0, ',', '.'); ?></option>	
		<?php } ?>
	</select>
	<input type=hidden name='list_status' value='<?php echo $list_status; ?>'>
	<input type=hidden name='page' value='<?php echo $fpage; ?>'>
</form>
</td>

<td align="right">Tình trạng</td>
<td align="left"><form name=list_status method=get>
	<input type=hidden name='list_card_type' value='<?php echo $list_card_type; ?>'>
	<input type=hidden name='list_menhgia' value='<?php echo $list_menhgia; ?>'>
	<select name='list_status' onchange='submit();'>
		<option value=''>- Chọn Tình trạng thẻ -</option>
		<option value="1" <?php if($list_status == '1') { ?> selected="selected" <?php } ?>>Thẻ vừa nạp/Đang chờ</option>
		<option value="2" <?php if($list_status == '2') { ?> selected="selected" <?php } ?>>Tạm ứng/Chờ kiểm tra</option>
		<option value="3" <?php if($list_status == '3') { ?> selected="selected" <?php } ?>>Thẻ đúng/Hoàn tất</option>
		<option value="4" <?php if($list_status == '4') { ?> selected="selected" <?php } ?>>Thẻ sai/Xử phạt</option>
	</select>
	<input type=hidden name='page' value='<?php echo $fpage; ?>'>
</form>
</td>

<td align="right"><a href='?action=dellcard' onMouseOut='hidetip();' onMouseOver="showtip('Xóa bớt lượng thẻ cũ, chỉ để lại 300 thẻ mới nhất .');">Xóa bớt thẻ</a></td>

</tr></table>

<?php
	$query_doanhthu = "SELECT SUM(money) FROM doanhthu WHERE month ='$month' and year='$year'";
	if(!empty($list_card_type)) {
		$query_doanhthu .= " AND card_type='$list_card_type'";
	}
	$check_doanhthu = $db->Execute("$query_doanhthu");
	$doanhthu = $check_doanhthu->fetchrow();
	$doanhthu_total = number_format($doanhthu[0], 0, ',', '.');
	
	$query_doanhthu_homqua = $db->Execute("SELECT SUM(menhgia) FROM CardPhone Where day(ngay)='$day_after_1day' AND month(ngay)='$month_after_1day' AND year(ngay)='$year_after_1day' AND status=2");
	$doanhthu_homqua = $query_doanhthu_homqua->fetchrow();
	
	$query_doanhthu_hientai = $db->Execute("SELECT SUM(menhgia) FROM CardPhone Where day(ngay)='$day_now' AND month(ngay)='$month_now' AND year(ngay)='$year_now' AND status=2");
	$doanhthu_hientai = $query_doanhthu_hientai->fetchrow();
?>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
	<tr bgcolor="#ffffcc" >
		<td align="center" colspan="3">
			<a href="?thang=<?php echo $thang_truoc; ?>&nam=<?php echo $nam_truoc; ?>">Tháng trước</a> << 		
			Doanh thu 
<?php
			if(!empty($list_card_type)) {
				echo "<font color='blue'><b>$list_card_type</b></font>";
			}
			else echo "<font color='blue'><b>Tổng</b></font>";
?>
			<font color="red"><?php echo " (Tháng $month - Năm $year) : <b>$doanhthu_total</b>"; ?></font>
			>> <a href="?thang=<?php echo $thang_sau; ?>&nam=<?php echo $nam_sau; ?>">Tháng sau</a>
			<br>
			Thời gian hiện tại : <?php echo date("h:i A d/m/Y",$timestamp); ?>
		</td>
	</tr>
	<tr bgcolor="#ffffcc" >
		<td align="center">Doanh thu hôm qua: <?php echo number_format($doanhthu_homqua[0], 0, ',', '.');?></td>
		<td align="center">Doanh thu hôm nay: <?php echo number_format($doanhthu_hientai[0], 0, ',', '.'); ?></td>
		<td align="center">Gcoin khuyến mại: <?php echo $khuyenmai_phantram; ?>%</td>
	</tr>
</table>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
	<tr bgcolor="#ffffcc" >
		<td align="center">#</td>
        <td align="center">STT</td>
		<td align="center">Tài khoản</td>
		<td align="center">Nhân vật</td>
		<td align="center">IP</td>
		<td align="center">Loại thẻ</td>
		<td align="center">Mệnh giá</td>
		<td align="center">Nạp lúc</td>
		<td align="center">Duyệt lúc</td>
		<td align="center">Tình trạng</td>
	</tr>
<?php
while($row = $result->fetchrow()) 	{

//Lấy thông tin Gcoin từ Acc nạp thẻ
$query_checkacc = "select gcoin,gcoin_km,vpoint,ip from MEMB_INFO WHERE memb___id='$row[1]'";
$result_checkacc = $db->Execute($query_checkacc);
$checkacc = $result_checkacc->fetchrow();

//Lấy thông tin Reset - ReLife của Nhân vật chính trong Acc nạp thẻ
$query_char = "select resets,relifes from Character WHERE Name='$row[2]'";
$result_char = $db->Execute($query_char);
$char = $result_char->fetchrow();

$stt_str = $stt_str + 1;
$card_date = date("h:i A d/m/Y",$row[10]);
if (!empty($row[11])) $card_duyet = date("h:i A d/m/Y",$row[11]);
else $card_duyet = '';

if ($row[8] == 0) { $status = '<font color=black>Thẻ vừa nạp/Đang chờ</font>'; $color_begin = '<font color=black>'; $color_end = '</font>';}
if ($row[8] == 1) { $status = '<font color=green>Tạm ứng/Chờ kiểm tra</font>'; $color_begin = '<font color=green>'; $color_end = '</font>';}
if ($row[8] == 2) { $status = '<font color=blue>Thẻ đúng/Hoàn tất</font>'; $color_begin = '<font color=blue>'; $color_end = '</font>';}
if ($row[8] == 3) { $status = '<font color=red>Thẻ sai/Xử phạt</font>'; $color_begin = '<font color=red>'; $color_end = '</font>';}

?>
	<tr bgcolor='#F9E7CF' >
		<td align='center'><?php echo $stt_str; ?></td>
        <td align='center'><?php echo $row[0]; ?></td>
		<td align='center'><?php echo "<a href='#' onMouseOut='hidetip();' onMouseOver=\"showtip('Gcoin : <font color=red>$checkacc[0]</font> .<br />Gcoin khuyến mại : <font color=red>$checkacc[1]</font> .<br />Vpoint : <font color=red>$checkacc[2]</font> .');\">$color_begin$row[1] (<font color=red>$checkacc[0]</font>)$color_end</a>"; ?></td>
		<td align='center'>
			<?php 
			echo "<a href='#' onMouseOut='hidetip();' onMouseOver=\"showtip('Nhân vật bảo lãnh : $row[2] .<br>ReLifes : <font color=red>$char[1]</font> .<br>Reset : <font color=blue>$char[0]</font> .');\">$color_begin$row[2](<font color=red>$char[1]</font>,<font color=blue>$char[0]</font>)$color_end</a>"; 
			?>
		</td>
		<td align='center'><?php echo $color_begin.$checkacc[3].$color_end; ?></td>
		<td align='center'><?php echo $color_begin.$row[4].$color_end; ?></td>
		<td align='center'><?php echo $color_begin.number_format($row[3], 0, ',', '.').$color_end; ?></td>
		<td align='center'><?php echo $color_begin.$card_date.$color_end; ?></td>
		<td align='center'><?php echo $color_begin.$card_duyet.$color_end; ?></td>
		<td align='center'><?php echo $status; ?></td>
	</tr>
<?php
}
echo "</table>";

$query_totalpages =$db->Execute($query);
$totalpages = $query_totalpages->numrows();
		$totalpages = $totalpages / $Card_per_page; 
		$totalpages = floor($totalpages)+1; 
		$c = 0;
		if ($totalpages > 0) {
			echo "<center>Trang: [".$totalpages."] ";
		}
		while($c<$totalpages){
			$page = $c + 1;
			if($_GET['page']==$page){
				echo "[$page] ";
			}else{
				echo "<a href=\"?page=$page&list_card_type=$list_card_type&list_menhgia=$list_menhgia&list_status=$list_status&list_ctv=$list_ctv&list_ctv_check=$list_ctv_check\">[$page] </a> ";
			} 
			$c = $c+1; 
		} 
  
		if ($totalpages > 0) {
			echo "</center>";
		}
$db->Close();
?>
<script type="text/javascript" src="js/tooltip.js"></script>
</body>
</html>