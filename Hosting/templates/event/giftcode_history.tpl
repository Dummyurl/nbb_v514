<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Lịch sử GiftCode</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php
    if(count($giftcode_history_arr['sms']) > 0) {
?>
		<center>
			<strong>Kích hoạt GiftCode</strong><br>
    	</center>
    		
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">Loại GiftCode</th>
            <th align="center" scope="col">Tạo lúc</th>
            <th align="center" scope="col">Hạn kích hoạt</th>
            <th align="center" scope="col">Tình trạng</th>
		  </tr>
<?php for($i=0;$i<count($giftcode_history_arr['sms']);$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $giftcode_history_arr['sms'][$i]['type_name']; ?></td>
		    <td align="center"><?php echo $giftcode_history_arr['sms'][$i]['time_create']; ?></td>
            <td align="center"><?php echo $giftcode_history_arr['sms'][$i]['time_exp']; ?></td>
            <td align="center"><?php echo $giftcode_history_arr['sms'][$i]['sms_cuphap']; ?></td>
		  </tr>
<?php } ?>
		</table>
        <br /><br />
<?php } ?>
        <center>
			<strong>Lịch sử GiftCode</strong><br>
    	</center>
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">#</th>
		    <th align="center" scope="col">GiftCode</th>
		    <th align="center" scope="col">Loại GiftCode</th>
            <th align="center" scope="col">Thời gian tạo GiftCode</th>
            <th align="center" scope="col">Tình trạng</th>
		  </tr>
<?php for($i=0;$i<count($giftcode_history_arr['giftcode']);$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $i+1; ?></td>
		    <td align="center"><?php echo $giftcode_history_arr['giftcode'][$i]['gift_code']; ?></td>
		    <td align="center"><?php echo $giftcode_history_arr['giftcode'][$i]['type_name']; ?></td>
            <td align="center"><?php echo $giftcode_history_arr['giftcode'][$i]['time_create']; ?></td>
            <td align="center"><?php echo $giftcode_history_arr['giftcode'][$i]['status_info']; ?></td>
		  </tr>
<?php } ?>
		</table>

	<div class="clear">
	</div>
</div>
<!-- End Content -->