<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Xóa nhân vật</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	
    	<blockquote><p align="center">
            - Sau khi xóa nhân vật trên web. Nhân vật trong game của bạn cũng bị mất hoàn toàn.<br />
            - Hãy chắc chắn trước khi xóa.<br />
            - Sau khi xóa nhân vật bạn cần phải đăng nhập lại.<br />
        	- Chi phí xóa nhân vật: <?php echo number_format($deletechar_vpoint, 0, ',', '.'); ?> V.Point
        </p></blockquote>
		
		<form id="deletechar" name="deletechar" method="post" action="index.php?mod=char_manager&act=deletechar">
		  <input type="hidden" name="action" value="deletechar" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật cần xóa :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Xóa</b></td>
				</tr>
                <tr>
					<td align="right">VPoint:</td>
					<td><?php echo $notice_vpoint; ?></td>
				</tr>
				<tr>
					<td align="right">Thoát Game:</td>
					<td><?php echo $online; ?></td>
				</tr>
				<tr>
					<td align="right">Mật khẩu Cấp 2</td>
					<td><input type="password" name="pass2" size="20" /></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Xóa nhân vật" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->