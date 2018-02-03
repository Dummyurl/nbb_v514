<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">ReLife</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="9" align="center">ReLife là bắt buộc khi đạt mức Reset quy định</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">ReLife</th>
		    <th align="center" scope="col">Reset</th>
		    <th align="center" scope="col">Level</th>
		    <th align="center" scope="col">Point</th>
		    <th align="center" scope="col">Mệnh lệnh</th>
		  </tr>
<?php if ( $cap_relife_max>0 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">1</td>
		    <td align="center"><?php echo $rl_reset_relife1; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife1, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife1, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>1 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">2</td>
		    <td align="center"><?php echo $rl_reset_relife2; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife2, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife2, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>2 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">3</td>
		    <td align="center"><?php echo $rl_reset_relife3; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife3, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife3, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>3 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">4</td>
		    <td align="center"><?php echo $rl_reset_relife4; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife4, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife4, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>4 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">5</td>
		    <td align="center"><?php echo $rl_reset_relife5; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife5, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife5, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>5 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">6</td>
		    <td align="center"><?php echo $rl_reset_relife6; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife6, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife6, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>6 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">7</td>
		    <td align="center"><?php echo $rl_reset_relife7; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife7, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife7, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>7 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">8</td>
		    <td align="center"><?php echo $rl_reset_relife8; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife8, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife8, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ( $cap_relife_max>8 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">9</td>
		    <td align="center"><?php echo $rl_reset_relife9; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife9, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife9, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_relife_max>9 ) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">10</td>
		    <td align="center"><?php echo $rl_reset_relife10; ?></td>
		    <td align="center">400</td>
		    <td align="center"><?php echo number_format($rl_point_relife10, 0, ',', '.'); ?></td>
		    <td align="center"><?php echo number_format($rl_ml_relife10, 0, ',', '.'); ?></td>
		  </tr>
<?php } ?>
		</table>
    	<blockquote><div align="center">
    		- ReLife không cần cởi đồ.<br>
    		- Sau khi ReLife hãy vào phần <b><a href="#char_manager&act=rutpoint" onclick="$('index2.php?mod=char_manager&act=rutpoint','hienthi');">Rút Point</a></b> để lấy Point sử dụng.
    	</div></blockquote>

		<form id="relife" name="relife" method="post" action="index.php?mod=char_manager&act=relife">
		  	<input type="hidden" name="action" value="relife" />
		    <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Reset</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện ReLife</b></td>
				</tr>
				<tr>
					<td align="right">ReLife lần thứ</td>
					<td><?php echo $_SESSION['nv_relife']+1; ?></td>
				</tr>
				<tr>
					<td align="right">Reset</td>
					<td><?php echo "$_SESSION[nv_reset] ($notice_reset)"; ?></td>
				</tr>
				<tr>
					<td align="right">Cấp độ</td>
					<td><?php echo "$_SESSION[nv_level] ($notice_level)"; ?></td>
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
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="ReLife" onclick="return btn_check_verify(this.form.vImageCodP.value,'msg_vImageCodP');" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>
		
	<div class="clear">
	</div>
</div>
<!-- End Content -->