<?php if (isset($_SESSION[mu_nvchon])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Event >> Nhận Item hỗ trợ Event</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="event_itemfull" name="event_itemfull" method="post" action="index.php?mod=event&act=itemfull">
	<input type="hidden" name="action" value="event_itemfull" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center">#</td>
					<td align="center"><strong>Đồ vật</strong></td>
					<td align="center"><strong>Nhận</strong></td>
				</tr>
<?php for($i=0;$i<$slg_item;$i++) { ?>
				<tr <?php if($i%2==0) echo 'bgcolor="#CCFFFF"'; else echo 'bgcolor="#FFFFFF"'; ?>  >
					<td align="center"><?php echo $i+1; ?></td>
					<td align="center"><?php echo $item_read[$i][des]; ?></td>
					<td align="center"><input type="radio" name="item" class="item" <?php if($i==0) { ?> checked="checked" <?php } ?> value="<?php echo $item_read[$i][key]; ?>" /></td>
				</tr>
<?php } ?>
				<tr bgcolor="#FFFFFF" >
					<td colspan="5" align="justify">
					<center><b>Trước khi nhận Item bạn phải đọc thông báo này</b></center><br />
					- <span class="chudo">Khi mua: nhân vật mua đồ không được là nhân vật trong Game và không là nhân vật thoát ra sau cùng.</span><br />
					- <span class="chudo">Phải để trống đủ chỗ chứa đồ trong rương đồ chung.</span>
					</td>
				</tr>
			</table>
    	<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Nhận đồ" /></td>
			</tr>
	  	</table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>