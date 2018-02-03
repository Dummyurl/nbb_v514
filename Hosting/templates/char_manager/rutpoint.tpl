<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Rút Point</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    	<blockquote><div align="center">
    	- Rút Point từ <b>Point dự trữ</b> sang <b>Point chưa cộng</b> để sử dụng cộng điểm cho nhân vật<br>
    	- Số Point chưa cộng sau khi rút không được lớn hơn 32.000 Point.</div></blockquote>
    	<br>
		<form id="rutpoint" name="rutpoint" method="post" action="index.php?mod=char_manager&act=rutpoint">
		  <input type="hidden" name="action" value="rutpoint" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		  <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Rút Point :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Rút Point</b></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right" width="40%">Số Point cần rút :</td>
					<td><input name="point" id="point" size="7" maxlength="5" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)" /> (Tối đa <b> <?php echo $_SESSION['nv_pointdutru']; ?> </b> point ) <label id="msg_point" class="msg"></label></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Rút Point" onclick="return btn_check_rutpoint();" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->