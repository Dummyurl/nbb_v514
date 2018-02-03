<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">WebShop >> Cửa hàng Tiền Zen</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<form id="shop_zen" name="shop_zen" method="post" action="index.php?mod=webshop&act=shop_zen">
	<input type="hidden" name="action" value="shop_zen" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
		<tr><td align="center" colspan="2"><strong><?php echo number_format($zen_mua, 0, ',', '.'); ?> Zen</strong> = <strong><?php echo number_format($vpoint_chiphi, 0, ',', '.'); ?> Vpoint</strong></td></tr>
		<tr>
			<td align="right" width="40%">Chọn mức Zen cần mua</td>
			<td>
				<select name="slg">
					<option value="1" selected="selected"><?php echo number_format($zen_mua, 0, ',', '.'); ?> Zen = <?php echo number_format($vpoint_chiphi, 0, ',', '.'); ?> V.Point</option>
					<option value="2"><?php echo number_format($zen_mua*2, 0, ',', '.'); ?> Zen = <?php echo number_format($vpoint_chiphi*2, 0, ',', '.'); ?> V.Point</option>
					<option value="3"><?php echo number_format($zen_mua*3, 0, ',', '.'); ?> Zen = <?php echo number_format($vpoint_chiphi*3, 0, ',', '.'); ?> V.Point</option>
					<option value="4"><?php echo number_format($zen_mua*4, 0, ',', '.'); ?> Zen = <?php echo number_format($vpoint_chiphi*4, 0, ',', '.'); ?> V.Point</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Mật khẩu cấp 2</td>
			<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Mua Zen" onclick="return btn_check_verify(this.form.vImageCodP.value,'msg_vImageCodP');" /></td>
		</tr>
	  </table>
</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->