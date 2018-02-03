<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Rút Zen vào nhân vật</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="bank2zen" name="bank2zen" method="post" action="index.php?mod=webshop&act=bank2zen">
	<input type="hidden" name="action" value="bank2zen" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật Rút Zen :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><b>Điều kiện Rút Zen</b></td>
			</tr>
			<tr>
				<td align="right">Đổi nhân vật</td>
				<td><?php echo $doinv; ?></td>
			</tr>
			<tr>
				<td align="right">Số lượng Zen cần rút</td>
				<td><input name="zen" id="zen"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Rút Zen" onclick="return btn_check_verify(this.form.vImageCodP.value,'msg_vImageCodP');" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
			</tr>
	 	 </table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>