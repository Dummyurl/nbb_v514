<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset Point</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	
    	<blockquote><p align="center">- Sau khi Reset Point, nhân vật sẽ lấy lại toàn bộ điểm đã cộng.<br>
    	- Chi phí Reset Point: <?php echo number_format($resetpoint_vpoint, 0, ',', '.'); ?> V.Point</p></blockquote>
		
		<form id="resetpoint" name="resetpoint" method="post" action="index.php?mod=char_manager&act=resetpoint">
		  <input type="hidden" name="action" value="resetpoint" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Reset Point :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Reset Point</b></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">Mật khẩu Cấp 2</td>
					<td><input type="password" name="pass2" size="20" /></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Reset Point" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->