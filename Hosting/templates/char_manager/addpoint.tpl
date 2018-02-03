<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Cộng Điểm</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

		<form id="addpoint" name="addpoint" method="post" action="index.php?mod=char_manager&act=addpoint">
		  <input type="hidden" name="action" value="addpoint" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		  <table width="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Cộng Điểm :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Cộng Điểm</b></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">Điểm có thể cộng</td>
					<td><b><?php echo $_SESSION['nv_point']; ?></b></td>
				</tr>
			  	<tr>
			  		<td align="right"><b>Sức mạnh : </b></td>
			  		<td><input type="text" name="str" id="str" value="0" size="6" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_str" class="msg"></label></td>
			  	</tr>
			  	<tr>
			  		<td align="right"><b>Nhanh nhẹn : </b></td>
			  		<td><input type="text" name="dex" id="dex" value="0" size="6" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_dex" class="msg"></label></td>
			  	</tr>
			  	<tr>
			  		<td align="right"><b>Sức khỏe : </b></td>
			  		<td><input type="text" name="vit" id="vit" value="0" size="6" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_vit" class="msg"></label></td>
			  	</tr>
			  	<tr>
			  		<td align="right"><b>Năng lượng : </b></td>
			  		<td><input type="text" name="ene" id="ene" value="0" size="6" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_ene" class="msg"></label></td>
			  	</tr>
<?php if( ($_SESSION[nv_class] == $class_dl_1) || ($_SESSION[nv_class] == $class_dl_2) ) { ?>
			  	<tr>
			  		<td align="right"><b>Mệnh lệnh : </b></td>
			  		<td><input type="text" name="ml" id="ml" value="0" size="6" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> <label id="msg_ml" class="msg"></label></td>
			  	</tr>
<?php } ?>
				<tr>
			  		<td align="right">&nbsp;</td>
			  		<td><input type="submit" name="Submit" value="Cộng Điểm" onclick="return btn_check_addpoint();" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
			  	</tr>
		  	</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->