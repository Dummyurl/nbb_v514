<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi mật khẩu Game - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="changepassgame" name="changepassgame" method="post" action="index.php?mod=acc_manager&act=changepassgame">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Mật khẩu Game mới</td>
			<td><input type="password" name="passgamenew" id="passgamenew" size="14" maxlength="10" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)"> <label id="msg_passgamenew" class="msg"></label></td>
		</tr>
		<tr>
			<td align="right">Xác minh Mật khẩu Game mới</td>
			<td><input type="password" name="passgamenew_verify" id="passgamenew_verify" size="14" maxlength="10" onfocus="focus_chuso(this.value,'msg_'+this.name);" onblur="onblur_check_repass(this.form.passgamenew.value,this.value,'msg_'+this.name)"> <label id="msg_passgamenew_verify" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi mật khẩu Game" onclick="return btn_check_changepassgame();"/></td>
		</tr>
	</table>
<input type="hidden" name="action" value="changepassgame" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->