<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi 7 số bí mật - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    <center>
    	Sử dụng <strong>7 mã số bí mật</strong> khi : Xóa nhân vật, Đặt mã khóa hòm đồ,...<br />
    	<b>Sau khi đổi xong, phải đăng nhập lại Game mới có hiệu lực</b>
    </center>
<form id="changesnonumb" name="changesnonumb" method="post" action="index.php?mod=acc_manager&act=changesnonumb">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">7 số bí mật mới</td>
			<td><input type="text" name="snonumb" id="snonumb" size="14" maxlength="7" onkeyup="check_so(this.value,'msg_'+this.name)"> <label id="msg_snonumb" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi 7 Số Bí mật"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changesnonumb" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->