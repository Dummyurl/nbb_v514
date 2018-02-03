<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Tẩy tủy</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	
    	<blockquote><p align="center">
            - Sau khi tẩy tủy, nhân vật sẽ bị trừ 1 lần Reset và có LV 400.<br />
            - Sau khi tẩy tủy, nhân vật sẽ bị xóa toàn bộ số điểm Danh Vọng trong ngày.<br />
        	- Chi phí tẩy tủy: <?php echo number_format($taytuy_vpoint, 0, ',', '.'); ?> V.Point
        </p></blockquote>
		
		<form id="taytuy" name="taytuy" method="post" action="index.php?mod=char_manager&act=taytuy">
		  <input type="hidden" name="action" value="taytuy" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Tẩy tủy :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Tẩy tủy</b></td>
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
					<td><input type="submit" name="Submit" value="Tẩy tủy" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->