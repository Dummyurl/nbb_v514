<?php if (isset($_SESSION[mu_nvchon])) { ?>

<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Tiền Tệ >> Đổi IP Bonus Point sang PC Point</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="ipbonuspoint2pcpoint" name="ipbonuspoint2pcpoint" method="post" action="index.php?mod=tiente&act=ipbonuspoint2pcpoint">
    <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
				<center>
                    <b>Tỷ lệ quy đổi : 1 IP Bonus Point = 1 PC Point</b><br />
                    <strong>IP Bonus Point</strong> hiện có : <strong><?php echo $_SESSION['IPBonusPoint']; ?></strong> <i>(Đăng nhập lại tài khoản để cập nhập mới)</i>
                </center>
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật nhận PC Point :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
            <tr>
				<td align="right">IP Bonus Point</td>
				<td><input type="text" name="ipbonuspoint" id="ipbonuspoint" size="14" maxlength="10"/> -> PC Point</td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Đổi IP Bonus Point sang PC Point" /></td>
			</tr>
	  	</table>
<input type="hidden" name="action" value="ipbonuspoint2pcpoint" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>