<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event >> <?php echo $event_bongda_name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

  <div align="center"><font color="#0000FF"><b>Danh sách trận bóng đang dự đoán</b></font></div>
  <table width="100%" border="1" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
    <tr>
      <th align="center" scope="col">STT</th>
      <th align="center" scope="col">Giải Đấu </th>
      <th align="center" scope="col">Đội Thi Đấu </th>
      <th align="center" scope="col">Thời Gian Thi Đấu </th>
      <th align="center" scope="col">Tham gia dự đoán </th>
    </tr>
<?php 
	$stt = 0;
	if(count($bong_dudoan)>0) {
	foreach( $bong_dudoan as $bong_du_doan ) 
	{
	$stt++;
?>
    <tr>
      <th align="center" scope="row"><?php echo $stt; ?></th>
      <td align="center"><?php echo $bong_du_doan[giai]; ?></td>
      <td align="center"><?php echo $bong_du_doan[doi1].' - '.$bong_du_doan[doi2]; ?></td>
      <td align="center"><?php echo $bong_du_doan[time_dau]; ?></td>
      <td align="center"><a href="#event&act=event_bongda&page=event_bongda_dudoan&tranid=<?php echo $bong_du_doan['tran_id']; ?>" rel="ajax" >Tham gia dự đoán</a></td>
    </tr>
<?php
	}
	}
?>
  </table> 
  <br>
  
  <div align="center"><font color="#990000"><strong>Danh sách trận bóng hết hạn dự đoán - Đang chờ cập nhập kết quả</strong></font></div>
  <table width="100%" border="1" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
    <tr>
      <th align="center" scope="col">STT</th>
      <th align="center" scope="col">Giải Đấu </th>
      <th align="center" scope="col">Đội Thi Đấu </th>
      <th align="center" scope="col">Thời Gian Thi Đấu </th>
      </tr>
<?php 
	$stt = 0;
	if(count($bong_wait)>0) {
	foreach( $bong_wait as $bongwait ) 
	{
	$stt++;
?>
    <tr>
      <th align="center" scope="row"><?php echo $stt; ?></th>
      <td align="center"><?php echo $bongwait[giai]; ?></td>
      <td align="center"><?php echo $bongwait[doi1].' - '.$bongwait[doi2]; ?></td>
      <td align="center"><?php echo $bongwait[time_dau]; ?></td>
      </tr>
<?php
	}
	}
?>
  </table> 
  <br>
  
  <div align="center"><font color="#FF0000"><strong>Danh sách trận bóng có kết quả dự đoán </strong></font></div>
  <table width="100%" border="1" style="border-collapse:collapse" cellspacing="0" cellpadding="0">
    <tr>
      <th align="center" scope="col">STT</th>
      <th align="center" scope="col">Giải Đấu </th>
      <th align="center" scope="col">Đội Thi Đấu </th>
      <th align="center" scope="col">Thời Gian Thi Đấu </th>
      <th align="center" scope="col">Kết quả trận đấu </th>
      <th align="center" scope="col">Kết quả dự đoán </th>
    </tr>
<?php 
	$stt = 0;
	if(count($bong_finish)>0) {
	foreach( $bong_finish as $bongfinish ) 
	{
	$stt++;
?>
    <tr>
      <th align="center" scope="row"><?php echo $stt; ?></th>
      <td align="center"><?php echo $bongfinish[giai]; ?></td>
      <td align="center"><?php echo $bongfinish[doi1].' - '.$bongfinish[doi2]; ?></td>
      <td align="center"><?php echo $bongfinish[time_dau]; ?></td>
      <td align="center"><?php echo $bongfinish[tyso1].' - '.$bongfinish[tyso2]; ?></td>
      <td align="center"><a href="#event&act=event_bongda&page=event_bongda_ketqua&tranid=<?php echo $bongfinish['tran_id']; ?>" rel="ajax" >Kết quả dự đoán</a></td>
    </tr>
<?php
	}
	}
?>
  </table> 
	<div class="clear">
	</div>
</div>
<!-- End Content -->