<?php
	if($_POST['tran_end'] == 'ok')
	{
		$tran_id = $_POST['tran_id'];
		$kq1 = $_POST['kq1'];
		$kq2 = $_POST['kq2'];
		$doi1_name = $_POST['tran_doi1'];
		$doi2_name = $_POST['tran_doi2'];
		
		$query_update_tran = "UPDATE bongda_tran SET tran_kq1='$kq1',tran_kq2='$kq2',status='1' WHERE tran_id='$tran_id'";
		$result_update_tran = $db->Execute($query_update_tran) OR DIE("Loi query : $query_update_tran");
		
		function swap(&$x,&$y) {
			$temp = $x;
			$x = $y;
			$y = $temp;
		}
		
		if($kq1 > $kq2) $ketqua_dudoan = 1;
		elseif($kq1 == $kq2) $ketqua_dudoan = 2;
		else $ketqua_dudoan = 3;
		
		$dudoan_query = "SELECT dudoan_id,acc,dudoan_slg FROM bongda_dudoankq WHERE dudoan_kq='$ketqua_dudoan' AND tran_id='$tran_id' ORDER BY dudoan_slg, time";
		$dudoan_result = $db->Execute($dudoan_query);
		
		$slg_dudoan = $dudoan_result->numrows();
		
		$check = 0;
		while($dudoan = $dudoan_result->fetchrow() )
		{
			$check++;
			$check_dudoan = abs($slg_dudoan - $dudoan[2]);
			if( $check == 1 ) {
				$giai1 = $check_dudoan;	$giai1_id = $dudoan[0];	$giai1_acc = $dudoan[1];
			} elseif( $check == 2 ) {
				$giai2 = $check_dudoan;	$giai2_id = $dudoan[0];	$giai2_acc = $dudoan[1];
				if($giai2 < $giai1)
				{
					swap($giai1,$giai2);
					swap($giai1_id,$giai2_id);
					swap($giai1_acc,$giai2_acc);
				}
			} elseif( $check == 3) {
				$giai3 = $check_dudoan;	$giai3_id = $dudoan[0]; $giai3_acc = $dudoan[1];
				if($giai3 < $giai2)
				{
					swap($giai2,$giai3);
					swap($giai2_id,$giai3_id);
					swap($giai2_acc,$giai3_acc);
				}
				if($giai2 < $giai1)
				{
					swap($giai1,$giai2);
					swap($giai1_id,$giai2_id);
					swap($giai1_acc,$giai2_acc);
				}
			} else {
				if($check_dudoan < $giai3)
				{
					$giai3 = $check_dudoan;	$giai3_id = $dudoan[0];	$giai3_acc = $dudoan[1];
					if($giai3 < $giai2)
					{
						swap($giai2,$giai3);
						swap($giai2_id,$giai3_id);
						swap($giai2_acc,$giai3_acc);
					}
					if($giai2 < $giai1)
					{
						swap($giai1,$giai2);
						swap($giai1_id,$giai2_id);
						swap($giai1_acc,$giai2_acc);
					}
				}
			}
		}
		
		
		//Update thong tin giai thuong
		if($giai1_acc) {
			$update_giai1_query = "UPDATE bongda_dudoankq SET status='1' WHERE dudoan_id='$giai1_id'";
				$update_giai1_result = $db->Execute($update_giai1_query);
			$update_phanthuong_giai1_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$event_bongda_giai1 WHERE memb___id='$giai1_acc'";
				$update_phanthuong_giai1_result = $db->Execute($update_phanthuong_giai1_query);
		}
		if($giai1_acc) {
			$update_giai2_query = "UPDATE bongda_dudoankq SET status='2' WHERE dudoan_id='$giai2_id'";
				$update_giai2_result = $db->Execute($update_giai2_query);
			$update_phanthuong_giai2_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$event_bongda_giai2 WHERE memb___id='$giai2_acc'";
				$update_phanthuong_giai2_result = $db->Execute($update_phanthuong_giai2_query);
		}
		if($giai1_acc) {
			$update_giai3_query = "UPDATE bongda_dudoankq SET status='3' WHERE dudoan_id='$giai3_id'";
				$update_giai3_result = $db->Execute($update_giai3_query);
			$update_phanthuong_giai3_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$event_bongda_giai3 WHERE memb___id='$giai3_acc'";
				$update_phanthuong_giai3_result = $db->Execute($update_phanthuong_giai3_query);
		}	
		
		echo "<center><font color='red'>Trận đấu <b>$doi1_name - $doi2_name</b> đã kết thúc với tỷ số <b>$kq1 - $kq2</b></font></center><br>";
		echo "<table width='80%' border='1' style='border-collapse:collapse' align='center' cellpadding='2' cellspacing='2'>
				  <tr>
				    <th align='center' scope='col'>Giải</th>
				    <th align='center' scope='col'>Mã dự đoán </th>
				    <th align='center' scope='col'>Tài khoản </th>
				    <th align='center' scope='col'>Vpoin thưởng </th>
				    <th align='center' scope='col'>Sai số </th>
				  </tr>";
		if($giai1_acc) echo "<tr>
				    <th align='center' scope='row'>1</th>
				    <td align='center'>$giai1_id</td>
				    <td align='center'>$giai1_acc</td>
				    <td align='center'>$event_bongda_giai1</td>
				    <td align='center'>$giai1</td>
				  </tr>";
		if($giai1_acc) echo "<tr>
				    <th align='center' scope='row'>2</th>
				    <td align='center'>$giai2_id</td>
				    <td align='center'>$giai2_acc</td>
				    <td align='center'>$event_bongda_giai2</td>
				    <td align='center'>$giai2</td>
				  </tr>";
		if($giai1_acc) echo "<tr>
				    <th align='center' scope='row'>3</th>
				    <td align='center'>$giai3_id</td>
				    <td align='center'>$giai3_acc</td>
				    <td align='center'>$event_bongda_giai3</td>
				    <td align='center'>$giai3</td>
				  </tr>";
				echo "</table><br>";
		
	}
?>
<p align="center"><b>Danh sách các trận chưa đấu</b></p>
<table width="100%" border="1" style="border-collapse:collapse" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th align="center" valign="top" scope="col">STT</th>
    <th align="center" valign="top" scope="col">Giải đấu </th>
    <th align="center" valign="top" scope="col">Đội Thi Đấu </th>
    <th align="center" valign="top" scope="col">Thời gian thi đấu </th>
    <th align="center" valign="top" scope="col">Thông tin dự đoán </th>
    <th align="center" valign="top" scope="col">Kết quả trận đấu </th>
    <th align="center" valign="top" scope="col">Trạng thái </th>
  </tr>
  <?php 
  	$query_select_tran = "SELECT tran_id,tran_doi1,tran_doi2,tran_kq1,tran_kq2,time,giai_name FROM bongda_tran A JOIN bongda_giaidau B ON A.giai_id=B.giai_id AND A.status='0' ORDER BY time";
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
    <td align="center" valign="top"><a href="#" onMouseOut="hidetip();" onMouseOver="showtip('Tổng số dự đoán: <?php echo $dudoan_total; ?>.<br> Dự đoán thắng: <?php echo $dudoan_win_slg; ?>.<br> Dự đoán Hòa: <?php echo $dudoan_draw_slg; ?>.<br> Dự đoán Thua: <?php echo $dudoan_lose_slg; ?>.');">Thông tin dự đoán</a> </td>
    <td align="center" valign="top"><input name="kq1" type="text" id="kq1" size="3" value="<?php echo $row[3]; ?>"> 
      - 
        <input name="kq2" type="text" id="kq2" size="3" value="<?php echo $row[4]; ?>"></td>
    <td align="center" valign="top">Chưa đấu 
      <input type="submit" name="Submit" value="Kết thúc trận"></td>
  </tr>
  </form>
  <?php 
  	}
  ?>
</table>
