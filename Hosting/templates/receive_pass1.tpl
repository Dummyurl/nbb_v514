<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Lấy mật khẩu Web cấp 1</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="changepass1" name="changepass1" method="post" action="index.php?mod=receive_pass1">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="40%">Tài khoản</td>
			<td><input type="text" name="acc" id="acc" size="14" maxlength="10"></td>
		</tr>
		<tr>
			<td align="right">Mã kiểm tra</td>
			<td><img src="img.php?size=6"></td>
		</tr>
		<tr>
			<td align="right">Xác minh mã kiểm tra</td>
			<td><?php $vImage->showCodBox(1); ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Lấy mật khẩu Web cấp 1" /></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="receivepass1" />
</form>
		<div class="clear">
	</div>
</div>
<!-- End Content -->