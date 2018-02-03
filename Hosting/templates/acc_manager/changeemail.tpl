<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi Email - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<form id="changeemail" name="changeemail" method="post" action="index.php?mod=acc_manager&act=changeemail">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Email mới</td>
			<td><input type="text" name="email" id="email" size="14" onkeyup="check_email(this.value,'msg_'+this.name)"> <label id="msg_email" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi Email" onclick="return btn_check_email();"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changeemail" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->