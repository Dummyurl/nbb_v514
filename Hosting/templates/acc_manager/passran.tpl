<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Bảo vệ tài khoản</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

	- Hệ thống sử dụng danh sách mật khẩu ngẫu nhiên để đăng nhập Web.<br>
	- Mỗi lần đăng nhập, mật khẩu đã sử dụng sẽ bị xóa, không thể sử dụng lại.<br>
	- Sử dụng số điện thoại đã đăng kí để nhận danh sách mật khẩu ngẫu nhiên.<br>
	
	<br>
<?php if($_SESSION[acc_passran] == 1) { ?>
	<center>
		Vui lòng dùng SĐT của tài khoản nhắn tin với cú pháp bên dưới để lấy danh sách 25 mật khẩu ngẫu nhiên<br>
						<font color='red'><b>SMS &nbsp;&nbsp;&nbsp; NET &nbsp;&nbsp;&nbsp; <?php echo $cuphap; ?> &nbsp;&nbsp;&nbsp; PR &nbsp;&nbsp;&nbsp; <?php echo $_SESSION[mu_username]; ?> </b></font> &nbsp;&nbsp;&nbsp; gửi &nbsp;&nbsp;&nbsp; <font color='blue'> <b>8117</b> </font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font><br>
		Nếu tài khoản còn mật khẩu cũ chưa sử dụng thì sẽ bị xóa hết để đề phòng sự cố.
	</center>
<?php } ?>
<form id="changepass1" name="passran" method="post" action="index.php?mod=acc_manager&act=passran">
   	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td>&nbsp;</td>
			<td>
				<?php if($_SESSION['acc_passran'] == 0) { ?>
					<input type="submit" name="Submit" value="Bật tính năng Bảo vệ Tài khoản" />
					<input type="hidden" name="status" value="1" />
				<?php } else { ?>
					<input type="submit" name="Submit" value="Tắt tính năng Bảo vệ Tài khoản" />
					<input type="hidden" name="status" value="0" />
				<?php } ?>
			</td>
		</tr>
	  </table>
<input type="hidden" name="action" value="passran" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->