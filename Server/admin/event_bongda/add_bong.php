<?php
if($_POST[addbong] == 'ok')
{
	$doi1 = $_POST['doi1'];
	$doi2 = $_POST['doi2'];
	$giaidau = $_POST['giaidau'];
	$gio = $_POST['gio'];
	$phut = $_POST['phut'];
	$ngay = $_POST['ngay'];
	$thang = $_POST['thang'];
	$nam = $_POST['nam'];
	
	$time_bong = strtotime("$thang/$ngay/$nam $gio:$phut");
	if( $time_bong<$time_now )
	{
		echo "<center><b>Thời gian diễn ra trận đấu đã qua, không thể thêm trận đấu.</b></center><br>";
	}
	else {
		$query_select_giai = "SELECT giai_name FROM bongda_giaidau WHERE giai_id='$giaidau'";
		$result_select_giai = $db->Execute($query_select_giai);
		$giai_name = $result_select_giai->fetchrow();
		
		$query_addbong = "INSERT INTO bongda_tran (tran_doi1,tran_doi2,giai_id,time) VALUES ('$doi1','$doi2','$giaidau','$time_bong')";
		$result_addbong = $db->Execute($query_addbong) OR DIE("Lỗi Query : $query_addbong");
		
		jump('event_bongda.php?page=bong_chuadau');
	}
}
?>
<script language="javascript">
	var D = new Date();
	var ngay = D.getDate();
	var thang = D.getMonth();
	var nam = D.getFullYear();
</script>
Thêm trận đấu :
<br>
<form name="add_tranbong" method="post" action="">
	<input type="hidden" name="addbong" value="ok">
  Tên đội 1 : 
  <input name="doi1" type="text" id="doi1" size="30" value="<?php echo $_POST['doi1']; ?>">
  <br>
  Tên đội 2 : 
  <input name="doi2" type="text" id="doi2" size="30" value="<?php echo $_POST['doi2']; ?>">
  <br>
  Giải đấu : 
 <select name="giaidau">
  	<?php
  		$query_select_giai = "SELECT giai_id,giai_name FROM bongda_giaidau WHERE status='0'";
  		$result_select_giai = $db->Execute($query_select_giai);
  		while($row = $result_select_giai->fetchrow())
  		{
  			echo "<option value=\"$row[0]\">$row[1]</option>";
  		}
  	?>
  </select>
  <br>
  Thời gian thi đấu : 
  <select name="gio">
  	<script language="javascript">
		for(i=0;i<=23;i++)
		{
			document.write("<option value=\""+i+"\">"+i+" giờ</option>");
		}
	</script>
  </select>
<select name="phut">
	<script language="javascript">
		for(i=0;i<=59;i++)
		{
			document.write("<option value=\""+i+"\">"+i+" phút</option>");
		}
	</script>
</select> 
 - ngày 
<select name="ngay">
	<script language="javascript">
		for(i=1;i<=31;i++)
		{
			document.write("<option value=\""+i+"\">"+i+" </option>");
		}
	</script>
</select>
 tháng 
 <select name="thang">
 	<script language="javascript">
		for(i=1;i<=12;i++)
		{
			document.write("<option value=\""+i+"\">"+i+"</option>");
		}
	</script>
 </select> 
 năm 
 <select name="nam">
 	<script language="javascript">
		for(i=nam;i<=nam+1;i++)
		{
			document.write("<option value=\""+i+"\">"+i+"</option>");
		}
	</script>
 </select>
 <br>
 <input type="submit" name="Submit" value="Thêm trận bóng">
 <input type="reset" name="Submit2" value="Nhập lại">
</form>
<?php
	include("event_bongda/bong_chuadau.php");
?>