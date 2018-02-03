<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif" /></div>
    <div class="title">Khóa Đồ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif" /></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<table cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td valign="top" width="491" align="center">
    	
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Chọn</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
                    <td>&nbsp;</td>
					<td><b>Điều kiện Khóa - Mở khóa đồ</b></td>
				</tr>
				<tr>
					<td align="right" valign="top">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">Thoát Game</td>
					<td><?php echo $online; ?></td>
				</tr>
			</table>
<?php if($_SESSION[nv_khoado] != 1) { ?>
		<form id="khoaitem" name="khoaitem" method="post" action="index.php?mod=char_manager&act=khoaitem">
		<table>
		  <input type="hidden" name="action" value="khoaitem" />
		  	<tr>
		  		<td align="center" colspan="2"><b>Khóa Đồ</b></td>
		  	</tr>
            <tr>
		  		<td align="right"><b>Khởi tạo Mã khóa đồ : </b></td>
		  		<td><input type="password" name="makhoado" size="14" maxlength="10"/></td>
		  	</tr>
		  	<tr>
		  		<td align="right"><b>Nhập lại mã khóa đồ : </b></td>
		  		<td><input type="password" name="remakhoado" size="14" maxlength="10"/></td>
		  	</tr>
		  </table>
		  <input type="submit" name="Submit" value="Khóa Đồ" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> />
		</form>
		
<?php } else { ?>
		
		<form id="mokhoaitem" name="mokhoaitem" method="post" action="index.php?mod=char_manager&act=khoaitem">
		<table>
		  <input type="hidden" name="action" value="mokhoaitem" />
		  	<tr>
		  		<td align="center" colspan="2"><b>Mở Khóa Đồ</b></td>
		  	</tr>
            <tr>
		  		<td align="right"><b>Mã khóa đồ : </b></td>
		  		<td><input type="password" name="makhoado" size="14" maxlength="10"/></td>
		  	</tr>
		  </table>
		  <input type="submit" name="Submit" value="Mở Khóa Đồ" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> />
		</form>

		<hr />
		
		<form id="editmakhoa" name="editmakhoa" method="post" action="index.php?mod=char_manager&act=khoaitem">
		<table>
		  <input type="hidden" name="action" value="editmakhoa" />
		  	<tr>
		  		<td align="center" colspan="2"><b>Đổi mã Khóa Đồ</b></td>
		  	</tr>
            <tr>
		  		<td align="right"><b>Mật khẩu Cấp 2 : </b></td>
		  		<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
		  	</tr>
			<tr>
		  		<td align="right"><b>Mã khóa đồ mới : </b></td>
		  		<td><input type="password" name="makhoado" size="14" maxlength="10"/></td>
		  	</tr>
		  	<tr>
		  		<td align="right"><b>Nhập lại mã khóa đồ mới : </b></td>
		  		<td><input type="password" name="remakhoado" size="14" maxlength="10"/></td>
		  	</tr>
		  </table>
		  <input type="submit" name="Submit" value="Sửa mã Khóa Đồ" />
		</form>
<?php } ?>
	</td>
  </tr>
</table>
						
	<div class="clear">
	</div>
</div>
<!-- End Content -->