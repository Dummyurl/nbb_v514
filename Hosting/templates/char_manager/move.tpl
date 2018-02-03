<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Di chuyển</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

		<form id="move" name="move" method="post" action="index.php?mod=char_manager&act=move">
		  <input type="hidden" name="action" value="move" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		  <table width="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Cần di chuyển :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="right">Khu vực chuyển đến</td>
					<td>
						<select name="location">
						    <option value="loren">Lorencia</option>
							<option value="noria">Noria</option>
						</select>
		  			</td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Di chuyển" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->