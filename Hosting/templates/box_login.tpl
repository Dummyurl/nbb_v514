<!-- Box Login -->
		<div class="top">Đăng nhập</div>
		<div class="middle">
			<form name="login" id="login" action="" method="post">
			<img style="margin-left: -20px;" src="images/logintop.png">
				<div class="loginpanel">
					<table style="color: rgb(255, 255, 255);" align="center" width="220">
					<input name="login" value="login" type="hidden">
						<tr><td>Tài khoản</td></tr>
						<tr><td style="background: url(&quot;images/inputbg.png&quot;) no-repeat scroll left center transparent; height: 32px; width: 20px;"><input id="username" name="username" maxlength="10" value="Tài khoản" onfocus="if (this.value == 'Tài khoản'){this.value='';}" onblur="if (this.value == '') {this.value='Tài khoản';}" style="color: Gray; width: 190px; height: 22px; border: 0pt none; background: none repeat scroll 0% 0% transparent;" type="text"></td></tr>
						<tr><td>Mật khẩu</td></tr>
						<tr><td style="background: url(&quot;images/inputbg.png&quot;) no-repeat scroll left center transparent; height: 32px; width: 20px;"><input name="password" id="password" style="color: Gray; width: 190px; height: 22px; border: 0pt none; background: none repeat scroll 0% 0% transparent;" type="password"></td></tr>
						<tr><td style="padding-top: 10px; padding-left: 20px;"><img src="img.php?size=6" /></td></tr>
						<tr><td>Nhập 6 mã kiểm tra bên trên</td></tr>
						<tr><td style="background: url(&quot;images/inputbg.png&quot;) no-repeat scroll left center transparent; height: 32px; width: 20px;"><input name="vImageCodP" id="vImageCodP" onfocus="focus_codeverify(this.value,'msg_'+this.name);" type="text"> </td></tr>
						<tr><td>&nbsp;</td></tr>
					</table>							
				</div>
			<img style="margin-left: -20px;" src="images/loginbottom.png">
			<input src="images/dangnhap.gif" style="margin-left: 90px; margin-top: 10px;" type="image">
			</form>	
			<table style="color: rgb(96, 96, 96); font-size: 13px; font-weight: bold;" border="0" cellpadding="0" cellspacing="5" width="100%">
				<tr>
					<td class="loginbottomlinks" style="background: url(&quot;images/dot.gif&quot;) no-repeat scroll left center transparent; padding-left: 15px;"><a href="#receive_pass1" rel="ajax" >
						Quên mật khẩu?</a></td>
					<td class="loginbottomlinks" style="background: url(&quot;images/dot.gif&quot;) no-repeat scroll left center transparent; padding-left: 15px;"><a href="#register" rel="ajax" >
						Đăng ký mới</a></td>
				</tr>
			</table>			
        </div>
        <div class="bottom">

        </div>  		
<div class="padtop clear">
</div>
<!-- End Box Login -->