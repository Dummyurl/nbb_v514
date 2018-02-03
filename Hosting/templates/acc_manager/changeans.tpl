<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi Câu trả lời bí mật - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<form id="changeans" name="changeans" method="post" action="index.php?mod=acc_manager&act=changeans">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Câu trả lời bí mật mới</td>
			<td><input type="password" name="ans" id="ans" size="14" maxlength="50" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)"> <label id="msg_ans" class="msg"></label></td>
		</tr>
		<tr>
			<td align="right">Xác minh Câu trả lời bí mật mới</td>
			<td><input type="password" name="ans_verify" id="ans_verify" size="14" maxlength="50" onfocus="focus_chuso(this.value,'msg_'+this.name);" onblur="onblur_check_repass(this.form.ans.value,this.value,'msg_'+this.name)"> <label id="msg_ans_verify" class="msg"></label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi Câu trả lời Bí Mật" onclick="return btn_check_ans();"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changeans" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->