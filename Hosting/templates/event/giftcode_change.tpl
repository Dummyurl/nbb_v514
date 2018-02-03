<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Event >> Nhận phần thưởng GiftCode</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="giftcode_change" name="giftcode_change" method="post" action="index.php?mod=event&act=giftcode_change">
	<input type="hidden" name="action" value="giftcode_change" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="justify">
					<center><b>Trước khi đổi bạn phải đọc thông báo này</b></center><br />
					- <span class="chudo">Khi đổi: phải thoát Game.</span><br>
					- Phần thưởng nhận được tương ứng với lớp nhân vật đang chọn.<br />
					- Đồ nhận được sẽ nằm trong rương đồ chung.
					</td>
				</tr>
			</table>
    	<br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
    	<tr>
    		<td align="right">Nhân vật đổi Event:</td>
    		<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
		</tr>
		<tr>
			<td align="right">Thoát Game</td>
			<td><?php echo $online; ?></td>
		</tr>
		<tr>
			<td align="right">Mã GiftCode</td>
			<td><input name="giftcode" size="14" maxlength="10" /></td>
		</tr>
        <tr>
			<td align="right">Mật khẩu cấp 2</td>
			<td><input type="password" name="pass2" size="14" maxlength="32" class="keyboardInput"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi GiftCode" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	  </table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>