<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Rửa tội</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th scope="col" align="center">PK</th>
		    <th scope="col" align="center">Phí</th>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center">Giết <= <?php echo $pk_zen_vpoint; ?> mạng</div></td>
		    <td><div align="center"><?php echo number_format($pk_zen, 0, ',', '.'); ?> Zen/mạng</div></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center">Giết > <?php echo $pk_zen_vpoint; ?> mạng</div></td>
		    <td><div align="center"><?php echo number_format($pk_vpoint, 0, ',', '.'); ?> V.Point/mạng</div></td>
		  </tr>
		</table>
    	<br><br>
    	<form id="reset" name="reset" method="post" action="index.php?mod=char_manager&act=pk">
    		  <input type="hidden" name="action" value="pk" />
    		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    		<table width="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Rửa tội :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Rửa tội</b></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Rửa tội" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->