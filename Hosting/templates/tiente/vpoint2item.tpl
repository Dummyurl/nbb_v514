<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Tiền Tệ >> Mua Item Vpoint</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="vpoint2item" name="vpoint2item" method="post" action="index.php?mod=tiente&act=vpoint2item">
	<input type="hidden" name="action" value="vpoint2item" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center">#</td>
					<td align="center"><strong>Đồ vật</strong></td>
					<td align="center"><strong>Thông tin</strong></td>
					<td align="center"><strong>Giá</strong> <br />
				    ( V.Point )</td>
					<td align="center"><strong>Mua</strong></td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td align="center">1</td>
					<td align="center"><img src="img_item/gold.gif"></td>
					<td align="center">Item Gold giá quy đổi <b><?php echo number_format($item_low, 0, ',', '.'); ?> V.Point</b></td>
					<td align="center"><?php echo number_format($item_low, 0, ',', '.'); ?></td>
					<td align="center"><input type="radio" name="item" checked="checked" value="gold"></td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td align="center">2</td>
					<td align="center"><img src="img_item/zen.gif"></td>
					<td align="center">Item Zen giá quy đổi <b><?php echo number_format($item_hight, 0, ',', '.'); ?> V.Point</b></td>
					<td align="center"><?php echo number_format($item_hight, 0, ',', '.'); ?></td>
					<td align="center"><input type="radio" name="item" value="zen"></td>
				</tr>
                <tr bgcolor="#FFFFFF" >
					<td align="center">3</td>
					<td align="center"><img src="img_item/zen50k.jpg"></td>
					<td align="center">
						Item Zen giá quy đổi <b><?php echo number_format($item_50k, 0, ',', '.'); ?> V.Point</b>
						<br /><br /><b><font color='red'>Lưu ý</font></b> : Item Vpoint 50k không được ném ra đất. 
						<br />Ném ra đất bị mất, BQT không chịu trách nhiệm.
					</td>
					<td align="center"><?php echo number_format($item_50k, 0, ',', '.'); ?></td>
					<td align="center"><input type="radio" name="item" value="vpoint50k"></td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td colspan="8" align="justify">
					<center><b>Trước khi mua bạn phải đọc thông báo này</b></center><br />
					- Số V.Point sẽ mất khi mua tương ứng với món đồ cần mua.<br />
					- Sau khi mua xong , nếu bạn muốn mua tiếp thì hãy vào game cất đồ đã mua trước khi mua tiếp.<br />
					- Mọi vấn đề mất đồ khi không làm theo hướng dẫn chúng tôi hoàn toàn không chịu trách nhiệm.
					</td>
				</tr>
			</table>
    	<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật Mua Item Vpoint :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td align="right">Số lượng đồ cần mua</td>
				<td>
					<select name="slg">
						<option value="1" selected="selected">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Mua Item V.Point" /></td>
			</tr>
	  	</table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>