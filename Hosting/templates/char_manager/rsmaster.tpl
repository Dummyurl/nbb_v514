<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset Master Skill</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    <blockquote><div align="justify">
    	- Reset Master Skill : Xóa toàn bộ Master Skill đã cộng, lấy lại điểm Master Skill theo <b>Cấp độ Master</b>
    	- Đổi nhân vật khác trước khi Reset Master Skill.
    </blockquote>

<form id="rsmaster" name="rsmaster" method="post" action="index.php?mod=char_manager&act=rsmaster">
	<input type="hidden" name="action" value="rsmaster" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    <table width="100%" border="0" cellpadding="3" cellspacing="1">
    	<tr>
			<td align="right" width="40%">Nhân vật Reset Master Skill</td>
			<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><b>Điều kiện Reset Master Skill</b></td>
		</tr>
		<tr>
			<td align="right">Nhân vật Master</td>
			<td><?php echo $nvmaster; ?></td>
		</tr>
        <tr>
			<td align="right">Đổi nhân vật</td>
			<td><?php echo $doinv; ?></td>
		</tr>
		<tr>
			<td align="right">Thoát Game</td>
			<td><?php echo $online; ?></td>
		</tr>
		<tr>
			<td align="right">Mật khẩu cấp 2</td>
			<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Reset Master Skill" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	</table>
</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->