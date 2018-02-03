<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Event >> <?php echo $event1_name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<form id="event1" name="event1" method="post" action="index.php?mod=event&act=event1">
	<input type="hidden" name="action" value="event1" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="3" align="center">
		    	<b>Vật phẩm Event</b>
	    	</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Tên vật phẩm</b></td>
		    <td align="center"><b>Hình Ảnh</b></td>
		    <td align="center"><b>Ghi chú</b></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $event1_itemshop_name; ?></td>
		    <td align="center"><img src="img_item/heart.gif"></td>
		    <td align="center"><b>Cách Nhận</b> : Đánh quái khi tham gia sự kiện <strong>Lâu Đài Máu</strong>, <strong>Quảng Trưởng Quỷ</strong> hoặc mua tại <strong><a href="#webshop&act=shop_taphoa" rel="ajax" >Shop Tạp Hóa</a></strong><br>
<b>Chức Năng</b> : Sử dụng để ghép với Huy Chương nhận phần thưởng</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $event1_itemdrop1_name; ?></td>
		    <td align="center"><img src="img_item/silver_medal.jpg"></td>
		    <td align="center"><b>Cách Nhận</b> : Đánh quái khi tham gia sự kiện <strong>Lâu Đài Máu</strong>, <strong>Quảng Trưởng Quỷ</strong> hoặc mua tại <strong><a href="#webshop&act=shop_taphoa" rel="ajax" >Shop Tạp Hóa</a></strong><br>
<b>Chức Năng</b> : Sử dụng để ghép với Heart , Zen và Gcoin nhận phần thưởng</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $event1_itemdrop2_name; ?></td>
		    <td align="center"><img src="img_item/gold_medal.jpg"></td>
		    <td align="center"><b>Cách Nhận</b> : Đánh quái khi tham gia sự kiện <strong>Lâu Đài Máu</strong>, <strong>Quảng Trưởng Quỷ</strong> hoặc mua tại <strong><a href="#webshop&act=shop_taphoa" rel="ajax" >Shop Tạp Hóa</a></strong><br>
<b>Chức Năng</b> : Sử dụng để ghép với Heart , Zen và Gcoin nhận phần thưởng</td>
		  </tr>
		</table>
		<br>
    	
    	<table width="100%" border="0" cellpadding="3" cellspacing="1">
		<tr>
    		<td align="justify" colspan="2">
    		  <p align="center"><strong>Công Thức Ghép Đổi Lấy Phần Thưởng</strong></p>
    		  <p><strong> Loại 1</strong></p>
    		  <ul>
    		    <li> 1 <?php echo $event1_itemdrop1_name; ?>   +  <?php echo number_format($event1_loai1_zen1, 0, ',', '.'); ?> Zen = <?php echo $event1_loai1_point1_min; ?> - <?php echo $event1_loai1_point1_max; ?> Point    		      </li>
  		        <li>1 <?php echo $event1_itemdrop2_name; ?> + <?php echo number_format($event1_loai1_zen2, 0, ',', '.'); ?> Zen = <?php echo $event1_loai1_point2_min; ?> - <?php echo $event1_loai1_point2_max; ?> Point </li>
    		  </ul>
                    <i>Đổi tối đa trong ngày : <b><?php echo $event1_loai1_daily_slg; ?></b> Phần thưởng loại 1 / ngày</i><br>
                    <i>Đổi tối đa : <b><?php echo $event1_loai1_slg; ?></b> Phần thưởng loại 1 / nhân vật</i><br>
			  <br />
    		  <p><strong>Loại 2   		      </strong></p>
    		  <ul>
    		    <li>1 <?php echo $event1_itemdrop1_name; ?>  + <?php echo $event1_loai2_itemshop_slg1; ?> <?php echo $event1_itemshop_name; ?> = <?php echo $event1_loai2_point1_min; ?> - <?php echo $event1_loai2_point1_max; ?> Point    		      </li>
  		        <li>1 <?php echo $event1_itemdrop2_name; ?>   + <?php echo $event1_loai2_itemshop_slg2; ?> <?php echo $event1_itemshop_name; ?> = <?php echo $event1_loai2_point2_min; ?> - <?php echo $event1_loai2_point2_max; ?> Point </li>
    		  </ul>
                    <i>Đổi tối đa trong ngày : <b><?php echo $event1_loai2_daily_slg; ?></b> Phần thưởng loại 2 / ngày</i><br>
                    <i>Đổi tối đa : <b><?php echo $event1_loai2_slg; ?></b> Phần thưởng loại 2 / nhân vật</i><br>
			  <br />
    		  <p><strong>Loại 3    		    </strong></p>
    		  <ul>
    		    <li>1 <?php echo $event1_itemdrop1_name; ?> + <?php echo $event1_loai3_gcoin1; ?> Gcoin = <?php echo $event1_loai3_point1_min; ?> - <?php echo $event1_loai3_point1_max; ?> Point    		      </li>
  		        <li>1 <?php echo $event1_itemdrop2_name; ?> + <?php echo $event1_loai3_gcoin2; ?> Gcoin = <?php echo $event1_loai3_point2_min; ?> - <?php echo $event1_loai3_point2_max; ?> Point </li>
   		      </ul>
                    <i>Đổi tối đa trong ngày : <b><?php echo $event1_loai3_daily_slg; ?></b> Phần thưởng loại 3 / ngày</i><br>
                    <i>Đổi tối đa : <b><?php echo $event1_loai3_slg; ?></b> Phần thưởng loại 3 / nhân vật</i><br>
			  <br />    		  
    		  <p><strong>Lưu ý: </strong></p>
    		  <ul>
    		    <li>Số Point nhận được là ngẫu nhiên trong khoảng theo bảng trên</li>
  		        <li> Số Point nhận được là vĩnh viễn ( Nghĩa là cho dù Reset hay Relife cũng không bị mất đi )</li>
   		        <li> Số Point nhân vật nhận được = Số Point Relife + Point Reset + Point Event</li>
   		        <li>Khi đổi phần thưởng phải bỏ hết đồ trong người vào hòm đồ. Đồ trên người, trong túi đồ, cửa hàng cá nhân (như hình cảnh báo bên dưới) sẽ bị xoá hoàn toàn khi đổi phần thưởng.</li>
   		        <li> Nhân vật đổi Event không được đang trong Game và không được là nhân vật thoát sau cùng<br>
	                                          </li>
   		    </ul>
			<center><img src="img_item/mac_mathet.jpg">&nbsp;
    		<img src="img_item/tuido_mathet.jpg"></center><br>
		</td>
		</tr>
		<tr>
    		<td align="center" colspan="2">
	    		Nhân vật đổi Event: <strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong>
				  <br>
				  Chọn loại phần thưởng : 
				  <input name="event1_type" type="radio" value="1" checked="checked" />
			    Loại 1 
			    <input name="event1_type" type="radio" value="2" />
			    Loại 2 
			    <input name="event1_type" type="radio" value="3" />
		    Loại 3
		    </td>
		</tr>
		<tr>
			<td align="right" width='200'>Đổi nhân vật</td>
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
			<td align="center" colspan="2"><input type="submit" name="Submit" value="Đổi Event" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	  </table>
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>