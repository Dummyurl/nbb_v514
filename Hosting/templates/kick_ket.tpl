<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">KÍCH KẸT</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    
    <center>
    	Sử dụng <strong>Kích Kẹt</strong> để kích nhân vật bị kẹt trong Game.<br />
    	<br />
        <font color='red'><strong>Mật khẩu <font color='blue'>OPD</font> (One Pass Day) : 1 Mật khẩu duy nhất dùng trong 24h kể từ khi nhận cho tất cả các chức năng cần sử dụng Mật Khẩu OPD</strong></font>.<br />
        Chức năng cần sử dụng <strong>Mật khẩu OPD</strong> để đảm bảo an toàn cho tài khoản.<br />
        <br /><br />
        <font color='blue'><strong>Hướng dẫn nhận Mật Khẩu OPD</strong></font><br />
        <font color='black'>Vui lòng dùng <strong>SĐT của tài khoản</strong> nhắn tin với cú pháp bên dưới để hoàn tất</font><br>
		<font color='red'><b>VNU&nbsp;&nbsp;&nbsp;<?php echo $cuphap; ?>&nbsp;&nbsp;&nbsp;OPD&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['mu_username']; ?></b></font>&nbsp;&nbsp;&nbsp;gửi&nbsp;&nbsp;&nbsp;<font color='blue'><b>8185</b></font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font><br /><br />
    </center>
    
    <table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<td align="right" width="150px">Mật khẩu OPD : </td>
			<td><input type="text" name="opd" id="opd" size="14" maxlength="7" /> </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" id="kickket" value="Kích Kẹt" /> </td>
		</tr>
	  </table>
        <p id="kickket_msg"></p>
    <div class="clear">
	</div>
</div>
<!-- End Content -->