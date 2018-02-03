<p align="center"><b>Danh sách các trận đã đấu</b></p>
<table width="100%" border="1" style="border-collapse:collapse" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th align="center" valign="top" scope="col">STT</th>
    <th align="center" valign="top" scope="col">Giải đấu </th>
    <th align="center" valign="top" scope="col">Đội Thi Đấu </th>
    <th align="center" valign="top" scope="col">Thời gian thi đấu </th>
    <th align="center" valign="top" scope="col">Kết quả trận đấu </th>
	<th align="center" valign="top" scope="col">Thông tin dự đoán </th>
  </tr>
  <?php 
  	$query_select_tran = "SELECT tran_id,tran_doi1,tran_doi2,tran_kq1,tran_kq2,time,giai_name FROM bongda_tran A JOIN bongda_giaidau B ON A.giai_id=B.giai_id AND A.status='1' ORDER BY time DESC";
  	$result_select_tran = $db->Execute($query_select_tran);
  	$stt = 0;
  	while($row = $result_select_tran->fetchrow())
  	{
  		$stt++;
		$dudoan_win_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$row[0]' AND dudoan_kq='1'";
  			$dudoan_win_result = $db->Execute($dudoan_win_query);
  			$dudoan_win_slg = $dudoan_win_result->numrows();
  		$dudoan_draw_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$row[0]' AND dudoan_kq='2'";
  			$dudoan_draw_result = $db->Execute($dudoan_draw_query);
  			$dudoan_draw_slg = $dudoan_draw_result->numrows();
  		$dudoan_lose_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$row[0]' AND dudoan_kq='3'";
  			$dudoan_lose_result = $db->Execute($dudoan_lose_query);
  			$dudoan_lose_slg = $dudoan_lose_result->numrows();
  		$dudoan_total = $dudoan_win_slg + $dudoan_draw_slg + $dudoan_lose_slg;
		
		//Lay ket qua giai nhat
		$giai1_query = "SELECT acc,dudoan_slg FROM bongda_dudoankq WHERE tran_id='$row[0]' AND status='1'";
		$giai1_result = $db->Execute($giai1_query);
		$giai1 = $giai1_result->fetchrow();
		
		$sql_char1_check = $db->SelectLimit("Select Name From Character where AccountID='$giai1[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
		$char1_check = $sql_char1_check->fetchrow();
		
		//Lay ket qua giai hai
		$giai2_query = "SELECT acc,dudoan_slg FROM bongda_dudoankq WHERE tran_id='$row[0]' AND status='2'";
		$giai2_result = $db->Execute($giai2_query);
		$giai2 = $giai2_result->fetchrow();
		
		$sql_char2_check = $db->SelectLimit("Select Name From Character where AccountID='$giai2[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
		$char2_check = $sql_char2_check->fetchrow();
		
		//Lay ket qua giai ba
		$giai3_query = "SELECT acc,dudoan_slg FROM bongda_dudoankq WHERE tran_id='$row[0]' AND status='3'";
		$giai3_result = $db->Execute($giai3_query);
		$giai3 = $giai3_result->fetchrow();
		
		$sql_char3_check = $db->SelectLimit("Select Name From Character where AccountID='$giai3[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
		$char3_check = $sql_char3_check->fetchrow();
  ?>
  <form name='tran1' action="" method="post">
  	<input type="hidden" name="tran_id" value="<?php echo $row[0]; ?>">
  	<input type="hidden" name="tran_end" value="ok">
  	<input type="hidden" name="tran_doi1" value="<?php echo $row[1]; ?>">
  	<input type="hidden" name="tran_doi2" value="<?php echo $row[2]; ?>">
  <tr>
    <th align="center" valign="top" scope="row"><?php echo $stt; ?></th>
    <td align="center" valign="top"><?php echo $row[6];?></td>
    <td align="center" valign="top"><?php echo $row[1].' - '.$row[2]; ?></td>
    <td align="center" valign="top"><?php echo date('h:iA d/m/Y',$row[5]); ?></td>
    <td align="center" valign="top"><?php echo $row[3].' - '.$row[4]; ?></td>
	<td align="center" valign="top"><a href="#" onMouseOut="hidetip();" onMouseOver="showtip('Tổng số dự đoán: <?php echo $dudoan_total; ?>.<br> Dự đoán thắng: <?php echo $dudoan_win_slg; ?>.<br> Dự đoán Hòa: <?php echo $dudoan_draw_slg; ?>.<br> Dự đoán Thua: <?php echo $dudoan_lose_slg; ?>.<br> Giải nhất : <?php echo $char1_check[0]; ?> - Dự đoán : <?php echo $giai1[1]; ?><br>Giải nhì : <?php echo $char2_check[0]; ?> - Dự đoán : <?php echo $giai2[1]; ?>.<br>Giải 3 : <?php echo $char2_check[0]; ?> - Dự đoán : <?php echo $giai3[1]; ?>');">Thông tin dự đoán</a></td>
  </tr>
  </form>
  <?php 
  	}
  ?>
</table>