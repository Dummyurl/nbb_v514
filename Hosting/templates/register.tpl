<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đăng kí Tài khoản</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<?php if (isset($_SESSION['mu_username'])) { ?>
<div align="center">
	<font color="red"><b>Hãy Thoát trước khi đăng kí.</b></font><br />
	<form method="post" name="logout" action=''>
		<input type="hidden" name="logout" value="logout" />
		<input type="submit" name="submit" value='Thoát' />
	</form>
</div>
<?php } else { ?>
<form method="post" name="register" action='index.php?mod=register'>
	<input type="hidden" name="register" value="register" />
                    <table align="center"  width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="width_25" align="right">Tên tài khoản <font color="red">*</font> </td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="username" type="text" id="username" size="14" maxlength="10" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" onfocus="focus_chuso_4_10(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)" /> <label id="msg_username" class="msg"></label>
                        </span></td>
                      </tr>
                      <tr>
                        <td class="width_25" align="right"><b>Lưu ý</b></td>
                        <td  class="width_45">
                            (*) <em>Tên tài khoản không bắt đầu bằng số 0 .</em><br />
                            (*) <em>Tên tài khoản không kết thúc bằng số .</em><br />
                            (*) <em>Tên nhân vật không bắt đầu bằng số 0 .</em><br />
                            (*) <em>Tên nhân vật phải có đầy đủ cả chữ lẫn số</em>.
                        </td>
                      </tr>
                      <?php 
                        $thehe_count = 0;
                        $thehe_lastid = 0;
                        for($i=count($thehe_choise)-1;$i>=1;$i--) {
                            if(strlen($thehe_choise[$i]) > 0) {
                                if($thehe_lastid == 0) $thehe_lastid = $i;
                                $thehe_count++;
                            }
                        }
                        
                        if($thehe_count > 1) {
                      ?>
                      <tr>
                        <td class="width_25" align="right">Thế hệ <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <select name="thehe">
                                <?php
                                    for($i=count($thehe_choise)-1;$i>=1;$i--) {
                                        if(strlen($thehe_choise[$i]) > 0) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $thehe_choise[$i]; ?></option>
                                <?php
                                    } }
                                ?>
                              </select>
                        </td>
                      </tr>
                      <?php
                        } else {
                            echo "<input type='hidden' name='thehe' value='". $thehe_lastid ."' />";
                        }
                      ?>
                      <tr>
                        <td class="width_25" align="right">Mật khẩu Game <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="passgame" type="password" id="passgame" size="14" maxlength="10" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)">  <label id="msg_passgame" class="msg"></label>
                        </span></td>
                      </tr>
					  <tr>
                        <td class="width_25" align="right">Mật khẩu Web cấp 1 <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="pass1" type="password" id="pass1" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)" /> <label id="msg_pass1" class="msg"></label>
                        </span></td>
                      </tr>
					  <tr>
                        <td class="width_25" align="right">Mật khẩu Web cấp 2 <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="pass2" type="password" id="pass2" size="14" maxlength="32" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_20(this.value,'msg_'+this.name)" /> <label id="msg_pass2" class="msg"></label>
                        </span></td>
                      </tr>
					  <tr>
                        <td class="width_25" align="right">Địa chỉ E-Mail <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="email" type="text" id="email" size="17" maxlength="50" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" onkeyup="check_email(this.value,'msg_'+this.name)" /> <label id="msg_email" class="msg"></label>
                        </span></td>
                      </tr>
                      <tr>
                        <td class="width_25" align="right">Câu hỏi bí mật <font color="red">*</font></td>
                        <td >
                        	<select name="quest">
							    <option value="0">- Chọn câu hỏi bí mật -</option>
							    <option value="1" <?php if (isset($_POST['quest']) && $_POST['quest']=='1') { ?> selected="selected" <?php } ?> >Tên con vật yêu thích?</option>
							    <option value="2" <?php if (isset($_POST['quest']) && $_POST['quest']=='2') { ?> selected="selected" <?php } ?> >Trường cấp 1 của bạn tên gì?</option>
							    <option value="3" <?php if (isset($_POST['quest']) && $_POST['quest']=='3') { ?> selected="selected" <?php } ?> >Người bạn yêu quý nhất?</option>
							    <option value="4" <?php if (isset($_POST['quest']) && $_POST['quest']=='4') { ?> selected="selected" <?php } ?> >Trò chơi bạn thích nhất?</option>
							    <option value="5" <?php if (isset($_POST['quest']) && $_POST['quest']=='5') { ?> selected="selected" <?php } ?> >Nơi để lại kỉ niệm khó quên nhất?</option>
							  </select>
							 <label id="msg_quest" class="msg"></label>
                        </td>
                      </tr>
                      <tr>
                        <td class="width_25" align="right">Câu Trả lời bí mật <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="ans" type="text" id="ans" size="17" maxlength="50" value="<?php if(isset($_POST['ans'])) echo $_POST['ans']; ?>" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)"> <label id="msg_ans" class="msg"></label>
                        </span></td>
                      </tr>
                      <tr>
                        <td class="width_25" align="right" valign="top">7 số bí mật <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="sno_numb" type="text" id="sno_numb" size="7" maxlength="7" value="<?php if(isset($_POST['sno_numb'])) echo $_POST['sno_numb']; ?>" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)"> <label id="msg_sno_numb" class="msg"></label>
                        </span><br /><br />
                        <em>
                            7 số bí mật sử dụng khi : Xóa nhân vật, Đặt Mã Hòm đồ, Bang Hội,...
                        </em>
                        </td>
                      </tr>
                      <tr>
                        <td class="width_25" align="right" valign="top">Số điện thoại <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <input class="txt_160" name="tel" type="text" id="tel" size="17" maxlength="15" value="<?php if(isset($_POST['tel'])) echo $_POST['tel']; ?>" onfocus="focus_tel(this.value,'msg_'+this.name);" onkeyup="check_tel(this.value,'msg_'+this.name)"> <label id="msg_tel" class="msg"></label>
                        </span><br /><br />
                        <em>Phải là SĐT di động, và chính xác để có thể nhận <strong><font color="red">GiftCode</font></strong>, <strong>tham gia Event</strong>, <strong>đổi thông tin Tài khoản, Mật khẩu</strong>...</em>
                        </td>
                      </tr>
					  <tr>
                        <td class="width_25" align="right">Thành viên giới thiệu <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <b><?php if(isset($_SESSION['mu_invite'])) echo $_SESSION['mu_invite']; ?></b>
						</td>
                      </tr>
    				  <tr>
                        <td class="width_25" align="right">Mã kiểm tra <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="img.php?size=6"></font></div>
                        </span></td>
                      </tr>
    				  <tr>
                        <td class="width_25" align="right">Nhập Mã kiểm tra <font color="red">*</font></td>
                        <td class="width_45"><span class="sp_input">
                            <?php $vImage->showCodBox(1); ?> <label id="msg_vImageCodP" class="msg"></label>
                        </span></td>
                      </tr>
    				  <tr>
                        <td colspan="2" align="center">
    						<input type="submit" name="Submit" value="Đăng kí" onclick="return btn_check_register();" class="button">
    						<input type="reset" name="Reset" value="Nhập lại" class="button" />
    					</td>
                      </tr>
                    </table>
                  </form>
<?php } ?>
	<div class="clear">
	</div>
</div>
<!-- End Content -->