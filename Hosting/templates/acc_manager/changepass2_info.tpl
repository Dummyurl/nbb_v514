<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi mật khẩu Cấp 2 - Dùng Thông tin Tài Khoản</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="changepass2" name="changepass2" method="post" action="index.php?mod=acc_manager&act=changepass2_info">
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
			<td align="center" colspan="2"><b>Thông tin kiểm tra</b></td>
		</tr>
		<tr>
            <td class="width_25" align="right">Mật khẩu Web cấp 2 cũ<font color="red">*</font></td>
            <td class="width_45"><span class="sp_input">
                <input class="txt_160" name="pass2" type="password" id="pass2" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)"> <label id="msg_pass2" class="msg"></label>
            </span></td>
          </tr>
    	<tr>
            <td class="width_25" align="right">Địa chỉ E-Mail <font color="red">*</font></td>
            <td class="width_45"><span class="sp_input">
                <input class="txt_160" name="email" type="text" id="email" size="17" maxlength="50" value="<?php echo $_POST['email']; ?>" onkeyup="check_email(this.value,'msg_'+this.name)"> <label id="msg_email" class="msg"></label>
            </span></td>
          </tr>
    	<tr>
            <td class="width_25" align="right">Câu hỏi bí mật <font color="red">*</font></td>
            <td >
            	<select name="quest">
				    <option value="0">- Chọn câu hỏi bí mật -</option>
				    <option value="1" <?php if ($_POST['quest']=='1') { ?> selected="selected" <?php } ?> >Tên con vật yêu thích?</option>
				    <option value="2" <?php if ($_POST['quest']=='2') { ?> selected="selected" <?php } ?> >Trường cấp 1 của bạn tên gì?</option>
				    <option value="3" <?php if ($_POST['quest']=='3') { ?> selected="selected" <?php } ?> >Người bạn yêu quý nhất?</option>
				    <option value="4" <?php if ($_POST['quest']=='4') { ?> selected="selected" <?php } ?> >Trò chơi bạn thích nhất?</option>
				    <option value="5" <?php if ($_POST['quest']=='5') { ?> selected="selected" <?php } ?> >Nơi để lại kỉ niệm khó quên nhất?</option>
				  </select>
				 <label id="msg_quest" class="msg"></label>
            </td>
          </tr>
          <tr>
            <td class="width_25" align="right">Trả lời bí mật <font color="red">*</font></td>
            <td class="width_45"><span class="sp_input">
                <input class="txt_160" name="ans" type="text" id="ans" size="17" maxlength="50" value="<?php echo $_POST['ans']; ?>" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)"> <label id="msg_ans" class="msg"></label>
            </span></td>
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