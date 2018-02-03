<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Đại anh hùng trong tháng</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<?php include('templates/rank/ranking_head.tpl'); ?>
<?php if( (!$choise_topmonth) || ($choise_topmonth == $slg_topmonth_show) ) { ?>
    	<center>Cập nhập lúc: <?php echo $time_top; ?> ( 5 phút cập nhập 1 lần )</center>
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th scope="col" align="center">#</th>
		    <th scope="col" align="center"><font color="blue">Nhân vật</font></th>
		    <th scope="col" align="center"><font color="red">Reset</font> / tháng</th>
            <th scope="col" align="center">Cấp độ</th>
		    <th scope="col" style="color: rgb(255, 153, 0); text-align: center;">Lớp nhân vật</th>
            <th scope="col" style="color: blue; text-align: center;">Đổi Giới Tính Lúc</th>
		    <th scope="col" style="color: rgb(255, 153, 0); text-align: center;">Thế hệ</th>
		  </tr>
	<?php for($i=0;$i<count($char);$i++) { 
		
	?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $j=$i+1; echo $j; ?></td>
		    <td align="center"><font color="blue"><?php echo $char[$i]['name']; ?></font></td>
		    <td align="center"><font color="red"><?php echo $char[$i]['reset']; ?></font></td>
            <td align="center"><?php echo $char[$i]['level']; ?></td>
		    <td align="center" style="color: rgb(255, 153, 0); text-align: center;"><?php echo $char[$i]['nvclass']; ?></td>
            <td align="center" style="color: blue; text-align: center;"><?php echo $char[$i]['dgt_time']; ?></td>
		    <td align="center" style="color: rgb(255, 153, 0); text-align: center;"><?php echo $char[$i]['thehe']; ?></td>
		  </tr>
	<?php } ?>
		</table>
<?php } ?>

<div class="clear">
	</div>
</div>
<!-- End Content -->