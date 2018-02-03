<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Đổi Tên nhân vật</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
        <center>
    		<b>Chi phí : <?php echo number_format($changename_gcoin, 0, ',', '.'); ?> Gcoin</b><br />
            Được sử dụng Gcoin Khuyến Mãi<br /><br />
            <strong>Hướng dẫn Đổi Tên nhân vật : </strong><br />
            - <strong>Đổi Tên Nhân vật</strong> thực chất là chuyển toàn bộ dữ liệu từ Nhân vật này sang Nhân vật khác trong cùng 1 tài khoản.<br />
            - Tạo sẵn nhân vật với tên mới cần đổi<br />
            - Chọn nhân vật cần đổi tên<br />
            - Chọn nhân vật với tên mới cần đổi<br /><br />
    	</center>
        <br /><br />
<form id="changename" name="changename" method="post" action="index.php?mod=char_manager&act=changename">
    <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Nhân vật đổi tên : </td>
			<td><strong><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
		</tr>
        <tr>
			<td align="right" width="250px">Tên mới</td>
            <td>
				<select name="namenew">
			    <option value="0">-- Chọn nhân vật --</option>
			    	<?php if ($_SESSION[nv_slg]>0 && $_SESSION[char1]!=$_SESSION[mu_nvchon]) { ?> <option value="<?php echo $_SESSION[char1] ?>" <?php if($_SESSION[mu_nvchon]==$_SESSION[char1]) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION[char1]; ?></option> <?php } ?>
					<?php if ($_SESSION[nv_slg]>1 && $_SESSION[char2]!=$_SESSION[mu_nvchon]) { ?> <option value="<?php echo $_SESSION[char2] ?>" <?php if($_SESSION[mu_nvchon]==$_SESSION[char2]) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION[char2]; ?></option> <?php } ?>
					<?php if ($_SESSION[nv_slg]>2 && $_SESSION[char3]!=$_SESSION[mu_nvchon]) { ?> <option value="<?php echo $_SESSION[char3] ?>" <?php if($_SESSION[mu_nvchon]==$_SESSION[char3]) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION[char3]; ?></option> <?php } ?>
					<?php if ($_SESSION[nv_slg]>3 && $_SESSION[char4]!=$_SESSION[mu_nvchon]) { ?> <option value="<?php echo $_SESSION[char4] ?>" <?php if($_SESSION[mu_nvchon]==$_SESSION[char4]) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION[char4]; ?></option> <?php } ?>
					<?php if ($_SESSION[nv_slg]>4 && $_SESSION[char5]!=$_SESSION[mu_nvchon]) { ?> <option value="<?php echo $_SESSION[char5] ?>" <?php if($_SESSION[mu_nvchon]==$_SESSION[char5]) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION[char5]; ?></option> <?php } ?>

			  	</select>
				 <label id="msg_nhanvat" class="msg"></label>
			</td>
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
<input type="hidden" name="action" value="changename" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->