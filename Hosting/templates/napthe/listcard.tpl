<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Nạp thẻ >> Danh sách thẻ nạp</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	<form id="reset" name="reset" method="post" action="index.php?mod=napthe&act=listcard" style="text-align: center;">
		<input type="hidden" name="action" value="listcard" />
	    	<table width="100%" border="0" cellpadding="1" cellspacing="1" align="center">
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Xem danh sách thẻ nạp" ></td>
				</tr>
			</table>
	</form>

<?php if(isset($accept) && $accept == 1) { ?>	
	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th scope="col" align="center">#</td>
			<th scope="col" align="center">Loại thẻ</td>
			<th scope="col" align="center">Mã thẻ</td>
			<th scope="col" align="center">Serial</td>
			<th scope="col" align="center">Ngày nạp</td>
			<th scope="col" align="center">Tình trạng</td>
		  </tr>
	<?php for($i=0;$i<$stt;$i++) { ?>		  
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $cardphone[$i]['stt']; ?></td>
			<td align="center"><?php echo $cardphone[$i]['card_type']; ?></td>
			<td align="center"><?php echo $cardphone[$i]['card_num']; ?></td>
			<td align="center"><?php echo $cardphone[$i]['card_serial']; ?></td>
			<td align="center"><?php echo $cardphone[$i]['card_time']; ?></td>
			<td align="center"><?php echo $cardphone[$i]['card_status']; ?></td>
		  </tr>
	<?php } ?>		  
	</table>
<?php } ?>

	<div class="clear">
	</div>
</div>
<!-- End Content -->