<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Tiền Tệ >> Đổi IP Bonus Point sang Vpoint</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="ipbonuspoint2vpoint" name="ipbonuspoint2vpoint" method="post" action="index.php?mod=tiente&act=ipbonuspoint2vpoint">
    <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
				<center>
                    <b>Tỷ lệ quy đổi : 1 IP Bonus Point = 1 Vpoint</b><br />
                    <strong>IP Bonus Point</strong> hiện có : <strong><?php echo $_SESSION['IPBonusPoint']; ?></strong> <i>(Đăng nhập lại tài khoản để cập nhập mới)</i>
                </center>
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
				<td align="right">IP Bonus Point</td>
				<td><input type="text" name="ipbonuspoint" id="ipbonuspoint" size="14" maxlength="10"/> -> Vpoint</td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Đổi IP Bonus Point sang Vpoint" /></td>
			</tr>
	  	</table>
<input type="hidden" name="action" value="ipbonuspoint2vpoint" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->