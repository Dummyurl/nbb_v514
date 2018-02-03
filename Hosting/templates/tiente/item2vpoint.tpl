<?php if(isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Tiền Tệ >> Đổi Item Vpoint ra Vpoint</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="item2vpoint" name="item2vpoint" method="post" action="index.php?mod=tiente&act=item2vpoint">
	<input type="hidden" name="action" value="item2vpoint" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center">#</td>
					<td align="center"><strong>Đồ vật</strong></td>
					<td align="center"><strong>Thông tin</strong></td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td align="center">1</td>
					<td align="center"><img src="img_item/gold.gif"></td>
					<td align="center">Item Gold giá trị quy đổi <b><?php echo number_format($item_low, 0, ',', '.'); ?> V.Point</b></td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td align="center">2</td>
					<td align="center"><img src="img_item/zen.gif"></td>
					<td align="center">Item Zen giá trị quy đổi <b><?php echo number_format($item_hight, 0, ',', '.'); ?> V.Point</b></td>
				</tr>
                <tr bgcolor="#FFFFFF" >
					<td align="center">3</td>
					<td align="center"><img src="img_item/zen50k.jpg"></td>
					<td align="center">
						Item Zen giá trị quy đổi <b><?php echo number_format($item_50k, 0, ',', '.'); ?> V.Point</b>
						<br /><br /><b><font color='red'>Lưu ý</font></b> : Item Vpoint 50k không được ném ra đất. 
						<br />Ném ra đất bị mất, BQT không chịu trách nhiệm.
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" >
					<td colspan="8" align="justify">
					<center><b>Trước khi đổi bạn phải đọc thông báo này</b></center><br />
					- Cất hết đồ trên người ngoại trừ Item Vpoint và các đồ cần xóa<br />
					- Số V.Point nhận được tương ứng với số Item Vpoint đổi.<br />
					</td>
				</tr>
			</table>
    	<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
			<tr>
				<td align="right" width="40%">Nhân vật Đổi Item Vpoint :</td>
				<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Đổi V.Point" /></td>
			</tr>
	 	 </table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>