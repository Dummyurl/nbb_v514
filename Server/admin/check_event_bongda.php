<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	include('../config.php');
	include('function.php');
	include('../config/config_event.php');
	
$tran_id = $_GET['tran_id'];    $tran_id = antiinject_query($tran_id);
$ketqua_dudoan = $_GET['ketqua_dudoan'];    $ketqua_dudoan = antiinject_query($ketqua_dudoan);
	
		function swap(&$x,&$y) {
			$temp = $x;
			$x = $y;
			$y = $temp;
		}
		
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
		$sql_char1_check = $db->SelectLimit("Select Name From Character where AccountID='$giai1_acc' ORDER BY Relifes DESC, Resets DESC", 1, 0);
			$char1_check = $sql_char1_check->fetchrow();
		$sql_char2_check = $db->SelectLimit("Select Name From Character where AccountID='$giai2_acc' ORDER BY Relifes DESC, Resets DESC", 1, 0);
			$char2_check = $sql_char2_check->fetchrow();
		$sql_char3_check = $db->SelectLimit("Select Name From Character where AccountID='$giai3_acc' ORDER BY Relifes DESC, Resets DESC", 1, 0);
			$char3_check = $sql_char3_check->fetchrow();
		
		echo "<table width='80%' border='1' style='border-collapse:collapse' align='center' cellpadding='2' cellspacing='2'>
				  <tr>
				    <th align='center' scope='col'>Giải</th>
				    <th align='center' scope='col'>Mã dự đoán </th>
				    <th align='center' scope='col'>Tài khoản </th>
				   <th align='center' scope='col'>Nhân vật </th>
				    <th align='center' scope='col'>Vpoin thưởng </th>
				    <th align='center' scope='col'>Sai số </th>
				  </tr>";
		if($giai1_acc) echo "<tr>
				    <th align='center' scope='row'>1</th>
				    <td align='center'>$giai1_id</td>
				    <td align='center'>$giai1_acc</td>
				    <td align='center'>$char1_check[0]</td>
				    <td align='center'>$event_bongda_giai1</td>
				    <td align='center'>$giai1</td>
				  </tr>";
		if($giai2_acc) echo "<tr>
				    <th align='center' scope='row'>2</th>
				    <td align='center'>$giai2_id</td>
				    <td align='center'>$giai2_acc</td>
				    <td align='center'>$char2_check[0]</td>
				    <td align='center'>$event_bongda_giai2</td>
				    <td align='center'>$giai2</td>
				  </tr>";
		if($giai3_acc) echo "<tr>
				    <th align='center' scope='row'>3</th>
				    <td align='center'>$giai3_id</td>
				    <td align='center'>$giai3_acc</td>
				    <td align='center'>$char3_check[0]</td>
				    <td align='center'>$event_bongda_giai3</td>
				    <td align='center'>$giai3</td>
				  </tr>";
				echo "</table>";
$db->Close();
?>