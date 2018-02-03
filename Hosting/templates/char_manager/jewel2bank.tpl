<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Gửi Jewel vào Ngân hàng</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
		<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<b>Lưu ý</b>: Nhân vật Gửi Jewel vào ngân hàng không được đang trong Game và không được là nhân vật thoát sau cùng<br><br>
		<b>Những Jewel có thể gửi</b>: Chao, Create, Blue Feather, Trái Tim .<br>
		Jewel trong ngân hàng không thể rút ra, chỉ có thể sử dụng để Reset.
<br>
<form id="jewel2bank" name="jewel2bank" method="post" action="index.php?mod=char_manager&act=jewel2bank">
	<input type="hidden" name="action" value="jewel2bank" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật gửi Jewel :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><b>Điều kiện gửi Jewel</b></td>
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
				<td><input type="submit" name="Submit" value="Gửi Jewel" onclick="return confirm('Bạn đã chắc chắn cất hết đồ trên người như hình ảnh minh họa, chỉ để lại Jewel không? Nếu chưa chắc vui lòng chọn Cancel . Mọi vấn đề mất mát do không cất đồ các bạn tự chịu trách nhiệm.')" <?php if($accept == 0) { ?> disabled="disabled" <?php } ?> /></td>
			</tr>
		</table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>