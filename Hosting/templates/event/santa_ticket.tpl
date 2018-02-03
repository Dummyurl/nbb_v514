<?php if (isset($_SESSION[mu_nvchon])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Event >> Đổi vé Santa Ticket</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="santa_ticket" name="santa_ticket" method="post" action="index.php?mod=event&act=santa_ticket">
	<input type="hidden" name="action" value="santa_ticket" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center">#</td>
					<td align="center">Đồ vật</td>
					<td align="center">Thông tin</td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td align="center">1</td>
					<td align="center"><img src="img_item/santa_ticket.jpg"></td>
					<td align="center"><?php echo $event_item_name; ?> giá trị quy đổi <b> <?php echo number_format($event_vpoint, 0, ',', '.'); ?> </b> V.Point</td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td colspan="3" align="justify">
					<center><b>Trước khi đổi bạn phải đọc thông báo này</b></center><br />
					- <span class="chudo">Khi đổi: nhân vật đổi không được là nhân vật trong Game và không là nhân vật thoát ra sau cùng.</span><br>
					- Số V.Point nhận được tương ứng với số vé làng Santa trong người.<br />
					- Mọi vấn đề mất đồ khi không làm theo hướng dẫn chúng tôi hoàn toàn không chịu trách nhiệm.
					</td>
				</tr>
			</table>
    	<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
    	<tr>
    		<td align="right">Nhân vật đổi Event:</td>
    		<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
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
			<td align="right">Mật khẩu cấp 2</td>
			<td><input type="password" name="pass2" size="14" maxlength="32" class="keyboardInput"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi V.Point" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	  </table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>