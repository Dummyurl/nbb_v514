<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi mật khẩu Web - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<form id="changepass1" name="changepass1" method="post" action="index.php?mod=acc_manager&act=changepass1">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Mật khẩu Web mới</td>
			<td><input type="password" name="pass1new" id="pass1new" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)"> <label id="msg_pass1new" class="msg"></label></td>
		</tr>
		<tr>
			<td align="right">Xác minh Mật khẩu Web mới</td>
			<td><input type="password" name="pass1new_verify" id="pass1new_verify" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onblur="onblur_check_repass(this.form.pass1new.value,this.value,'msg_'+this.name)"> <label id="msg_pass1new_verify" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi mật khẩu Web" onclick="return btn_check_changepass1();"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changepass1" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->