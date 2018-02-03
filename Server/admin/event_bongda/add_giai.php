<?php
	if($_POST['addgiai'] == 'ok')
	{
		$giai_name = $_POST['giai_name'];
		$query_addgiai = "INSERT INTO bongda_giaidau (giai_Name) VALUES ('$giai_name')";
		$result_addgiai = $db->Execute($query_addgiai) OR DIE("Loi query : $query_addgiai");
		echo "<center>Đã thêm giải đấu <b>$giai_name</b>.</center>";
	}
	if($_POST['giai_end'] == 'ok')
	{
		$giai_id = $_POST['giai_id'];
		$giai_name = $_POST['giai_name'];
		
		$query_check_tranofgiai = "SELECT * FROM bongda_tran WHERE giai_id='$giai_id' AND status='0'";
		$result_check_tranofgiai = $db->Execute($query_check_tranofgiai);
		$check_tranofgiai = $result_check_tranofgiai->numrows();
		
		if($check_tranofgiai > 0) {
			echo "<center>Không thể kết thúc Giải đấu <b>$giai_name</b>. Giải đấu này vẫn còn trận chưa đấu</center>";
		}
		else {
			$query_update_giai = "UPDATE bongda_giaidau SET status=1 WHERE giai_id='$giai_id'";
			$result_update_giai = $db->Execute($query_update_giai) OR DIE("Loi query : $query_update_giai");
			echo "<center>Giải đấu <b>$giai_name</b> đã kết thúc.</center>";
		}
	}
?>
<form name="addgiai" method="post" action="">
	<input type="hidden" name="addgiai" value="ok">
Thêm Giải Đấu :
  <input name="giai_name" type="text" id="giai_name" size="50">
  <input type="submit" name="Submit" value="Thêm">
  <input name="Reset" type="reset" id="Reset" value="Nhập lại">
</form>
<p align="center"><strong>Danh sách giải đấu</strong></p>
<table width="100%" border="1" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">STT</th>
    <th scope="col">Giải Đấu </th>
	<th scope="col">Tình Trạng </th>
  </tr>
  <?php
  	$query_selectgiai = "SELECT giai_id,giai_name,status FROM bongda_giaidau ORDER BY status, giai_id DESC";
	$result_selectgiai = $db->Execute($query_selectgiai);
	$stt = 0;
	while($row = $result_selectgiai->fetchrow())
	{
		$stt++;
		if($row[2] == 0) $tinhtrang = "<font color='blue'><b>Giải chưa kết thúc</b></font>";
		else $tinhtrang = "<font color='red'><s>Giải đã kết thúc</s></font>";
  ?>
  <tr>
    <th scope="row"><?php echo $stt; ?></th>
    <td align="center"><?php echo $row[1]; ?></td>
	<td align="center"><?php echo $tinhtrang; ?> 
	  <?php if($row[2] == 0) { ?>
	  <form name="form1" method="post" action="">
		<input type="hidden" name="giai_id" value="<?php echo $row[0]; ?>">
		<input type="hidden" name="giai_end" value="ok">
		<input type="hidden" name="giai_name" value="<?php echo $row[1]; ?>">
	  	<input name="Submit" type="submit" id="Submit" value="Kết thúc giải">
	  </form>
	  <?php } ?>
	</td>
  </tr>
  <?php
  	}
  ?>
</table>
