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

	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th width="200" align="right" scope="row">Kết quả trận bóng : </th>
        <td><font color="#FF0000"><b><?php echo "$doi1 &nbsp;&nbsp; ($kq1) - ($kq2) &nbsp;&nbsp; $doi2"; ?></b></font></td>
      </tr>
      <tr>
        <th align="right" scope="row">Giải thi đấu : </th>
        <td><?php echo $giai; ?></td>
      </tr>
      <tr>
        <th align="right" scope="row">Thi đấu lúc  : </th>
        <td><?php echo $time_dau; ?></td>
      </tr>
	  <tr>
        <th align="right" scope="row">Số dự đoán đúng : </th>
        <td><font color="#0000FF"><b><?php echo $slg_dudoan; ?></b></font></td>
      </tr>
    </table>
	<br>
    <table width="98%" border="1" align="center" cellpadding="2" cellspacing="2" style="border-collapse:collapse">
      <tr>
        <th colspan="6" align="center" scope="col">Giải thưởng </th>
      </tr>
      <tr>
        <td align="center"><strong>Giải</strong></td>
        <td align="center"><strong>Nhân vật trúng giải </strong></td>
        <td align="center"><strong>Vpoint nhận thưởng </strong></td>
        <td align="center"><strong>Dự đoán</strong></td>
        <td align="center"><strong>Sai số </strong></td>
        <td align="center"><strong>Dự đoán lúc</strong></td>
      </tr>
<?php if($giai1_char) { ?>
      <tr>
        <td align="center"><strong>Giải nhất</strong></td>
        <td align="center"><?php echo $giai1_char; ?></td>
        <td align="center"><?php echo number_format($event_bongda_giai1, 0, ',', '.'); ?></td>
        <td align="center"><?php echo $giai1_dudoan; ?></td>
        <td align="center"><?php echo $giai1_saiso; ?></td>
        <td align="center"><?php echo $giai1_time; ?></td>
      </tr>
<?php } ?>
<?php if($giai2_char) { ?>
      <tr>
        <td align="center"><strong>Giải nhì</strong></td>
        <td align="center"><?php echo $giai2_char; ?></td>
        <td align="center"><?php echo number_format($event_bongda_giai2, 0, ',', '.'); ?></td>
        <td align="center"><?php echo $giai2_dudoan; ?></td>
        <td align="center"><?php echo $giai2_saiso; ?></td>
        <td align="center"><?php echo $giai2_time; ?></td>
      </tr>
<?php } ?>
<?php if($giai3_char) { ?>
      <tr>
        <td align="center"><strong>Giải ba</strong></td>
        <td align="center"><?php echo $giai3_char; ?></td>
        <td align="center"><?php echo number_format($event_bongda_giai3, 0, ',', '.'); ?></td>
        <td align="center"><?php echo $giai3_dudoan; ?></td>
        <td align="center"><?php echo $giai3_saiso; ?></td>
        <td align="center"><?php echo $giai3_time; ?></td>
      </tr>
<?php } ?>
    </table>
	<div class="clear">
	</div>
</div>
<!-- End Content -->