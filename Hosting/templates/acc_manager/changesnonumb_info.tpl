<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi 7 số bí mật - Dùng Thông tin Tài Khoản</div>
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
<form id="changesnonumb_info" name="changesnonumb_info" method="post" action="index.php?mod=acc_manager&act=changesnonumb_info">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">7 số bí mật mới</td>
			<td><input type="text" name="snonumb" id="snonumb" size="14" maxlength="7" onkeyup="check_so(this.value,'msg_'+this.name)"> <label id="msg_snonumb" class="msg"></label></td>
		</tr>
	<tr>
			<td align="center" colspan="2"><b>Thông tin kiểm tra</b></td>
		</tr>
		<tr>
            <td class="width_25" align="right">Mật khẩu Web cấp 2 <font color="red">*</font></td>
            <td class="width_45"><span class="sp_input">
                <input class="txt_160" name="pass2" type="password" id="pass2" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)"> <label id="msg_pass2" class="msg"></label>
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
			<td><input type="submit" name="Submit" value="Đổi 7 Số bí mật" /></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changesnonumb_info" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->