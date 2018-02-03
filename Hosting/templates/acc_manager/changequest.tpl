<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi Câu hỏi bí mật - Dùng Tin Nhắn SMS</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="changequest" name="changequest" method="post" action="index.php?mod=acc_manager&act=changequest">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="250px">Câu hỏi bí mật mới</td>
			<td>
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
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi Câu Hỏi Bí Mật" onclick="return btn_check_quest();"/></td>
		</tr>
	  </table>
<input type="hidden" name="action" value="changequest" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->