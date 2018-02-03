<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Bang Hội</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

        <center>Cập nhập lúc: <?php echo date('H:i d/m/Y', $time_host); ?></center>
        <br />
    	<center><b><font color="red">Danh sách Bang Hội nhiều Point nhất</font></b></center>
		<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center" scope="col">#</td>
		    <td align="center" scope="col"><b>Bang Hội</b></td>
		    <td align="center" scope="col"><b>Chủ Hội</b></td>
		    <td align="center" scope="col"><b>Thành Viên</b></td>
		    <td align="center" scope="col"><b>Reset Tổng</b></td>
		    <td align="center" scope="col"><b>Point Tổng</b></td>
		  </tr>
<?php for($i=0;$i<$slg_GPoint;$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $i+1; ?></td>
		    <td align="center"><?php echo $gtop['Point'][$i]['GName']; ?></td>
		    <td align="center"><?php echo $gtop['Point'][$i]['GMaster']; ?></td>
		    <td align="center"><?php echo number_format($gtop['Point'][$i]['SlgMem'], 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($gtop['Point'][$i]['RSTotal'], 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($gtop['Point'][$i]['PointTotal'], 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
		</table>
		<br /><br />
		<center><b><font color="red">Danh sách Bang Hội Reset nhiều nhất</font></b></center>
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center">#</td>
		    <td align="center"><b>Bang Hội</b></td>
		    <td align="center"><b>Chủ Hội</b></td>
		    <td align="center"><b>Thành Viên</b></td>
		    <td align="center"><b>Reset Tổng</b></td>
		    <td align="center"><b>Point Tổng</b></td>
		  </tr>
<?php for($i=0;$i<$slg_GReset;$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $i+1; ?></td>
		    <td align="center"><?php echo $gtop['RS'][$i]['GName']; ?></td>
		    <td align="center"><?php echo $gtop['RS'][$i]['GMaster']; ?></td>
		    <td align="center"><?php echo number_format($gtop['RS'][$i]['SlgMem'], 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($gtop['RS'][$i]['RSTotal'], 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($gtop['RS'][$i]['PointTotal'], 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
		</table>

	<div class="clear">
	</div>
</div>
<!-- End Content -->