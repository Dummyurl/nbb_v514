<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi Số điện thoại qua SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="changesdt_sms" name="changesdt_sms" method="post" action="index.php?mod=acc_manager&act=changesdt_sms">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Số điện thoại mới</td>
			<td><input type="text" name="tel" id="tel" size="14" maxlength="11" onfocus="focus_tel(this.value,'msg_'+this.name);" onkeyup="check_tel(this.value,'msg_'+this.name)"> <label id="msg_tel" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi Số điện thoại" onclick="return btn_check_sdtsms();"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changesdt_sms" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->