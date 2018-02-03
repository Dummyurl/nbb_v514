<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Nạp thẻ >> GATE</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    <?php if ($khuyenmai == 1) { ?>
    	<p align="center"><strong>Gcoin khuyến mại</strong>: <?php echo $khuyenmai_phantram; ?> %<br />
    		Gcoin khuyến mại sử dụng cho : Reset VIP, Đổi Giới tính, Ủy thác Offline.
    	</p>
    <?php } ?>
    <?php if ($khuyenmai_gate > 0) { ?>
    	<p align="center">Gcoin khi nạp thẻ GATE được nhiều hơn <?php echo $khuyenmai_gate; ?> %</p>
    <?php } ?>
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th scope="col" align="center">Thẻ GATE (VNĐ)</th>
		    <th scope="col" align="center">Gcoin</th>
		    <th scope="col" align="center">Gcoin khuyến mãi</th>
		  </tr>
<?php if($use_card10k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">10.000</td>
		    <td align="center"><?php echo number_format($menhgia10000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia10000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card20k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">20.000</td>
		    <td align="center"><?php echo number_format($menhgia20000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia20000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card30k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">30.000</td>
		    <td align="center"><?php echo number_format($menhgia30000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia30000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card50k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">50.000</td>
		    <td align="center"><?php echo number_format($menhgia50000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia50000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card100k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">100.000</td>
		    <td align="center"><?php echo number_format($menhgia100000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia100000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card200k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">200.000</td>
		    <td align="center"><?php echo number_format($menhgia200000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia200000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card300k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">300.000</td>
		    <td align="center"><?php echo number_format($menhgia300000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia300000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if($use_card500k==1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">500.000</td>
		    <td align="center"><?php echo number_format($menhgia500000, 0, ',', '.'); ?></td>
		      <td align="center"><?php echo number_format($menhgia500000_km, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
		  <tr bgcolor="#FFFFFF">
		    <td colspan="3" align="center" >
		    	<font color="red"><b>Lưu ý</b>: Sau khi nạp thẻ phải giữ thẻ cẩn thận không cho một ai biết cho đến khi nào <a href="#napthe&act=listcard" rel="ajax" ><b>TÌNH TRẠNG THẺ</b></a> đó là <b><font color="blue">Thẻ đúng/hoàn tất</font></b>. Nếu không thẻ của bạn bị người khác lấy và nạp mất thì chúng tôi hoàn toàn không chịu trách nhiệm.</font>
		    </td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td colspan="3" align="center">Số thẻ tối đa cho phép nạp trong ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center">Reset < <?php echo $reset_1; ?> lần</div></td>
		    <td colspan="2"><div align="center"><?php echo $slg_card_1; ?> thẻ / ngày</div></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php echo $reset_1; ?> < Reset < <?php echo $reset_2; ?> lần</div></td>
		    <td colspan="2"><div align="center"><?php echo $slg_card_2; ?> thẻ / ngày</div></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php echo $reset_2; ?> < Reset < <?php echo $reset_3; ?> lần</div></td>
		    <td colspan="2"><div align="center"><?php echo $slg_card_3; ?> thẻ / ngày</div></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php echo $reset_3; ?> < Reset < <?php echo $reset_4; ?> lần</div></td>
		    <td colspan="2"><div align="center"><?php echo $slg_card_4; ?> thẻ / ngày</div></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php echo $reset_4; ?> < Reset hoặc đã ReLife</div></td>
		    <td colspan="2"><div align="center"><?php echo $slg_card_max; ?> thẻ / ngày</div></td>
		  </tr>
		</table>
		<form id="vpoint_gate" name="vpoint_gate" method="post" action="index.php?mod=napthe&act=gate">
			<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
	    		<td align="right">Mệnh giá thẻ:</td>
	    		<td>
	    			<select name="menhgia">
<?php if($use_card10k==1) { ?>
						<option value="10000">10.000 VNĐ</option>
<?php } ?>
<?php if($use_card20k==1) { ?>
						<option value="20000">20.000 VNĐ</option>
<?php } ?>
<?php if($use_card30k==1) { ?>
						<option value="30000">30.000 VNĐ</option>
<?php } ?>
<?php if($use_card50k==1) { ?>
						<option value="50000" selected="selected">50.000 VNĐ</option>
<?php } ?>
<?php if($use_card100k==1) { ?>
						<option value="100000">100.000 VNĐ</option>
<?php } ?>
<?php if($use_card200k==1) { ?>
						<option value="200000">200.000 VNĐ</option>
<?php } ?>
<?php if($use_card300k==1) { ?>
						<option value="300000">300.000 VNĐ</option>
<?php } ?>
<?php if($use_card500k==1) { ?>
						<option value="500000">500.000 VNĐ</option>
<?php } ?>
					</select>
	    		</td>
			</tr>
			<tr>
	    		<td align="right" width="250px">Nhập mã thẻ:</td>
	    		<td><input type="password" name="card_num" id="card_num" maxlength="10" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_card_num" class="msg"></label></td>
			</tr>
			<tr>
				<td align="right">Nhập Serial</td>
				<td><input name="card_serial" id="card_serial" value="G" maxlength="10" /> <label id="msg_card_serial" class="msg"></label></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Nạp thẻ GATE" onclick="return btn_check_thegate();" /></td>
			</tr>
		  </table>
		  <input type="hidden" name="action" value="vpoint_gate" />
	  </form>
	  
	<div class="clear">
	</div>
</div>
<!-- End Content -->