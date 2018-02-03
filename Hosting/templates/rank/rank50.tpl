<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng TOP 50</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<?php if(isset($err)) echo "<center><font color='red'><b>$err</b></font></center>"; ?>

        <center><font color='blue'><strong><?php echo $title_top; ?></strong></font></center><br />
        	
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">#</th>
		    <th align="center" scope="col">Nhân vật</th>
		    <th align="center" scope="col">Relife</th>
            <th align="center" scope="col">Reset</th>
		    <th align="center" scope="col">Lớp nhân vật</th>
            <th align="center" scope="col">Thế hệ</th>
		  </tr>
<?php 
    foreach($rank as $key => $val) { 
        if(is_int($key)) {
?>

		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $key; ?></td>
		    <td align="center"><?php echo $val['name']; ?></td>
		    <td align="center"><?php echo $val['relife']; ?></td>
            <td align="center"><?php echo $val['reset']; ?></td>
		    <td align="center"><?php echo $val['class']; ?></td>
            <td align="center"><?php echo $thehe_name; ?></td>
		  </tr>
<?php } } ?>
		</table>
        <br /><br />
<div class="clear">
	</div>
</div>
<!-- End Content -->