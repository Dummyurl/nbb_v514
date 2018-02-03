<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">WebShop >> <?php echo $tilte; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="shop_jewel" name="shop_jewel" method="post" action="index.php?mod=webshop&act=<?php echo $act; ?>">
	<input type="hidden" name="action" value="shop" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center">#</td>
					<td align="center"><strong>Đồ vật</strong></td>
					<td align="center"><strong>Giá</strong> <br />
				    (V.Point)</td>
					<td align="center"><strong>Hình</strong></td>
					<td align="center"><strong>Mua</strong></td>
				</tr>
<?php for($i=0;$i<$slg_item;$i++) { ?>
				<tr <?php if($i%2==0) echo 'bgcolor="#CCFFFF"'; else echo 'bgcolor="#FFFFFF"'; ?>  >
					<td align="center"><?php echo $i+1; ?></td>
					<td align="center"><?php echo $item_read[$i]['des']; ?></td>
					<td align="center"><?php echo number_format($item_read[$i]['price'], 0, ',', '.'); ?></td>
					<td align="center"><img src="img_item/<?php echo $folder_img.'/'.$item_read[$i]['img']; ?>"></td>
					<td align="center"><input type="radio" name="item" class="item" <?php if($i==0) { ?> checked="checked" <?php } ?> value="<?php echo $item_read[$i]['key']; ?>" x="<?php echo $item_read[$i]['x']; ?>" y="<?php echo $item_read[$i]['y']; ?>" /></td>
				</tr>
<?php } ?>
				<tr bgcolor="#FFFFFF" >
					<td colspan="5" align="justify">
					<center><b>Trước khi mua bạn phải đọc thông báo này</b></center><br />
					- <span class="chudo">Khi mua: nhân vật mua đồ không được là nhân vật trong Game và không là nhân vật thoát ra sau cùng.</span><br />
					- <span class="chudo">Cất hết đồ trong khu vực mất đồ như hình bên dưới.</span><br />
                    - Số V.Point sẽ mất khi mua tương ứng với món đồ cần mua.<br />
					- Sau khi mua xong 1 món đồ nếu bạn muốn mua tiếp món thứ 2 thì hãy vào game cất món đồ đã mua trước khi mua tiếp món thứ 2.<br />
					- Mọi vấn đề mất đồ khi không làm theo hướng dẫn chúng tôi hoàn toàn không chịu trách nhiệm.
					</td>
				</tr>
			</table>
    	<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
    		<tr>
				<td align="right" width="40%">Nhân vật Mua hàng :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td align="right">Số lượng đồ cần mua</td>
				<td>
					<select name="slg" id="slg">
						<?php
                            for($i=1; $i<=$itemfirst_slg; $i++) {
                                echo "<option value=". $i .">". $i ."</option>";
                            }
                        ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Mua đồ" onclick="return confirm('Bạn chắc chắn đã cất hết đồ như trên hình vẽ khu vực mất đồ bên trên chưa?\n- Nếu chưa hãy chọn Cancel để hủy.\n- Nếu đã cất chọn OK để mua đồ.\nMọi vấn đề mất đồ không làm theo hướng dẫn, BQT không chịu trách nhiệm.');" /></td>
			</tr>
	  	</table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>