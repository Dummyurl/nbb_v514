<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Chuyển nhân vật sang tài khoản khác</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
        <center>
    		<b>Chi phí : <?php echo number_format($char2accother_gcoin, 0, ',', '.'); ?> Gcoin</b><br />
            Được sử dụng Gcoin Khuyến Mãi<br /><br />
            <strong>Hướng dẫn Chuyển nhân vật sang tài khoản khác : </strong><br />
             - <strong>Chuyển nhân vật sang Tài khoản khác</strong> thực chất là chuyển toàn bộ dữ liệu từ Nhân vật tài khoản này sang Nhân vật ở tài khoản khác.<br />
            - Tạo sẵn <strong>Nhân vật thay thế</strong> với tên mới trên <strong>tài khoản cần chuyển sang</strong><br />
            - Chọn <strong>nhân vật cần cần chuyển</strong> trên <strong>tài khoản hiện tại</strong><br />
            - Chọn <strong>Nhân vật thay thế</strong> trên <strong>tài khoản cần chuyển sang</strong><br /><br />
             
    	</center>
        <br /><br />
<form id="char2accother" name="char2accother" method="post" action="index.php?mod=char_manager&act=char2accother">
    <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Nhân vật chuyển : </td>
			<td><strong><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
		</tr>
        <tr>
			<td align="right" width="250px">Tài khoản chuyển sang</td>
            <td>
				<input class="txt_160" name="acctranfer" type="text" id="acctranfer" size="14" maxlength="10" />
			</td>
		</tr>
        <tr>
			<td align="right" width="250px">Nhân vật thay thế</td>
            <td>
				<input class="txt_160" name="chartranfer" type="text" id="chartranfer" size="14" maxlength="10" />
			</td>
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
                <input class="txt_160" name="ans" type="text" id="ans" size="17" maxlength="10" value="<?php echo $_POST['ans']; ?>" onfocus="focus_chuso(this.value,'msg_'+this.name);" onkeyup="check_chuso_4_10(this.value,'msg_'+this.name)"> <label id="msg_ans" class="msg"></label>
            </span></td>
          </tr>
		<tr>
			<td align="right">Đổi nhân vật</td>
			<td><?php echo $doinv; ?></td>
		</tr>
		<tr>
			<td align="right">Thoát Game</td>
			<td><?php echo $online; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi Tên Nhân Vật" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="char2accother" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->