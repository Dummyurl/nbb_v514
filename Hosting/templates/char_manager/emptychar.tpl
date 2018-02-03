<?php if (isset($_SESSION[mu_nvchon])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xóa Đồ Nhân Vật</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
		<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"><br>
    	<b>Lưu ý</b>: Nhân vật Xóa đồ không được đang trong Game<br />
        Cất hết đồ không cần xóa ra khỏi người, hành trang và cửa hàng cá nhân<br />
        </center>
<br>
<form id="emptychar" name="emptychar" method="post" action="index.php?mod=char_manager&act=emptychar">
	<input type="hidden" name="action" value="emptychar" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật Xóa Đồ :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Xóa Đồ" onclick="return confirm('Bạn đã chắc chắn cất hết đồ trên người như hình ảnh minh họa, chỉ để lại đồ cần xóa không? Nếu chưa chắc vui lòng chọn Cancel . Mọi vấn đề mất mát do không cất đồ các bạn tự chịu trách nhiệm.')" /></td>
			</tr>
		</table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('modules/char_manager.php'); ?>