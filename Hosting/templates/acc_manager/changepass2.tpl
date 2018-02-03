<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi mật khẩu Cấp 2 - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<form id="changepass2" name="changepass2" method="post" action="index.php?mod=acc_manager&act=changepass2">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Mật khẩu Cấp 2 mới</td>
			<td><input type="password" name="pass2new" id="pass2new" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)"> <label id="msg_pass2new" class="msg"></label></td>
		</tr>
		<tr>
			<td align="right">Xác minh Mật khẩu Cấp 2 mới</td>
			<td><input type="password" name="pass2new_verify" id="pass2new_verify" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onblur="onblur_check_repass(this.form.pass2new.value,this.value,'msg_'+this.name)"> <label id="msg_pass2new_verify" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi mật khẩu Cấp 2" onclick="return btn_check_changepass2();"/></td>
		</tr>
	</table>
<input type="hidden" name="action" value="changepass2" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->