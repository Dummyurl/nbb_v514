<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Quản lý nhân vật</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
<center>
	<form id="ChonNV" name="ChonNV" method="post" action="">
	  <input type='hidden' name='ChonNV' value='ChonNV'>
	  <table align=center  width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" width="40%">Chọn nhân vật : </td>
			<td>
				<select name="nhanvat">
			    <option value="0">-- Chọn nhân vật --</option>
			    	<?php if(!isset($_SESSION['mu_nvchon'])) $_SESSION['mu_nvchon'] = null; ?>
                    <?php if ($_SESSION['nv_slg']>0) { ?> <option value="<?php echo $_SESSION['char1'] ?>" <?php if($_SESSION['mu_nvchon']==$_SESSION['char1']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char1']; ?></option> <?php } ?>
					<?php if ($_SESSION['nv_slg']>1) { ?> <option value="<?php echo $_SESSION['char2'] ?>" <?php if($_SESSION['mu_nvchon']==$_SESSION['char2']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char2']; ?></option> <?php } ?>
					<?php if ($_SESSION['nv_slg']>2) { ?> <option value="<?php echo $_SESSION['char3'] ?>" <?php if($_SESSION['mu_nvchon']==$_SESSION['char3']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char3']; ?></option> <?php } ?>
					<?php if ($_SESSION['nv_slg']>3) { ?> <option value="<?php echo $_SESSION['char4'] ?>" <?php if($_SESSION['mu_nvchon']==$_SESSION['char4']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char4']; ?></option> <?php } ?>
					<?php if ($_SESSION['nv_slg']>4) { ?> <option value="<?php echo $_SESSION['char5'] ?>" <?php if($_SESSION['mu_nvchon']==$_SESSION['char5']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char5']; ?></option> <?php } ?>

			  	</select>
				 <label id="msg_nhanvat" class="msg"></label>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type='submit' name='submit' value='Chọn Nhân Vật' onclick="return btn_check_chonNV();"></td>
		</tr>
	  </table>
	</form>
</center>

<br/>
<?php if(isset($_SESSION['mu_nvchon'])) { ?>
		  
<?php if (isset($Use_TuLuyen) && $Use_TuLuyen == 1) { ?>	
    <a href="#char_manager&act=tuluyen" rel="ajax" class="cont05">
		<p><img src="images/cutkyhot.gif" alt="" />Tu Luyện
		<span>Tăng Điểm Thuộc Tính</span></p>
	</a>
<?php } ?>

<?php if (isset($Use_SongTu) && $Use_SongTu == 1) { ?>	
    <a href="#char_manager&act=songtu" rel="ajax" class="cont05">
		<p><img src="images/cutkyhot.gif" alt="" />Song Tu
		<span>Vợ Chồng Song Tu</span></p>
	</a>
<?php } ?>

<?php if (isset($Use_LockItem) && $Use_LockItem == 1) { ?>	
    <a href="#char_manager&act=lock_item" rel="ajax" class="cont05">
		<p><img src="images/cutkyhot.gif" alt="" />Bảo vệ Item
		<span>Khóa Giao Dịch</span></p>
	</a>
<?php } ?>

    <a href="#char_manager&act=jewel2bank" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Gửi Jewel
		<span>Vào ngân hàng</span></p>
	</a>
    	
	<a href="#char_manager&act=reset" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset
		<span>Jewel</span></p>
	</a>
			
<?php if ( isset($Use_ResetVIP) && $Use_ResetVIP == 1 ) { ?>
	<a href="#char_manager&act=resetvip" rel="ajax" class="cont05">
		<p><img src="images/cutkyhot.gif" alt="" />Reset VIP
		<span>Gcoin - Vpoint</span></p>
	</a>
<?php } ?>
		
	<a href="#char_manager&act=relife" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Relife
		<span>Tái Sinh</span></p>
	</a>

<?php if ( isset($Use_ResetOver) && $Use_ResetOver == 1 ) { ?>
	<a href="#char_manager&act=resetover" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset OVER
		<span>Jewel</span></p>
	</a>
			
	<?php if (isset($Use_ResetVIP) && $Use_ResetVIP == 1) { ?>
	<a href="#char_manager&act=resetvipover" rel="ajax" class="cont05">
		<p><img src="images/cutkyhot.gif" alt="" />Reset VIP OVER
		<span>Gcoin - Vpoint</span></p>
	</a>
	<?php } ?>
<?php } ?>
	
<?php if (isset($Use_UyThacOnline) && $Use_UyThacOnline == 1) { ?>
    <a href="#char_manager&act=uythaconline" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Ủy Thác
		<span>Online</span></p>
	</a>
<?php } ?>
			
<?php if ( isset($Use_UyThacOffline) && $Use_UyThacOffline == 1) { ?>
    <a href="#char_manager&act=uythacoffline" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Ủy Thác
		<span>Offline</span></p>
	</a>
<?php } ?>
			
<?php if ( (isset($Use_UyThacOnline) && $Use_UyThacOnline == 1) || (isset($Use_UyThacOffline) && $Use_UyThacOffline == 1)) { ?>
    <a href="#char_manager&act=uythac_reset" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset
		<span>Bằng Điểm Ủy Thác</span></p>
	</a>
			
    <?php if (isset($Use_ResetVIP) && $Use_ResetVIP == 1) { ?>
    <a href="#char_manager&act=uythac_resetvip" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset VIP
		<span>Bằng Điểm Ủy Thác</span></p>
	</a>
    <?php } ?>
<?php } ?>
	
	<a href="#char_manager&act=rutpoint" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Rút Point
		<span>Rút Điểm Dự Trữ</span></p>
	</a>
	
	<a href="#char_manager&act=deletechar" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Xóa Nhân Vật
		<span>Xóa Nhân Vật Trực Tiếp Trên Web</span></p>
	</a>

	<a href="#char_manager&act=addpoint" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Cộng Điểm
		<span>Cộng Điểm Trên Web</span></p>
	</a>

	<a href="#char_manager&act=move" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Di chuyển
		<span>Đổi MAP</span></p>
	</a>
			
	<a href="#char_manager&act=pk" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Rửa Tội
		<span>Xóa PK</span></p>
	</a>
			
	<a href="#char_manager&act=resetpoint" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset Point
		<span>Cộng Lại Điểm</span></p>
	</a>
	
	<a href="#char_manager&act=taytuy" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Tẩy Tủy
		<span>Reset lại</span></p>
	</a>
			
	<a href="#char_manager&act=rsmaster" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Reset Master
		<span>Cộng Lại Master</span></p>
	</a>

<?php if (isset($Use_DoiGioiTinh) && $Use_DoiGioiTinh == 1) { ?>
    <a href="#char_manager&act=doigioitinh" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Đổi Giới Tính
		<span>Chuyển giới</span></p>
	</a>
<?php } ?>
	
	<a href="#char_manager&act=khoaitem" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Khóa Đồ
		<span>Bảo vệ đồ</span></p>
	</a>

<?php if (isset($Use_ChangeName) && $Use_ChangeName == 1) { ?>
	<a href="#char_manager&act=changename" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Đổi Tên Nhân Vật
		<span>Làm lại cuộc đời</span></p>
	</a>
<?php } ?>
			
<?php if (isset($Use_Char2AccOther) && $Use_Char2AccOther == 1) { ?>
	<a href="#char_manager&act=char2accother" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Chuyển Nhân Vật
		<span>Sang Tài Khoản Khác</span></p>
	</a>
<?php } ?>
			
	<a href="#char_manager&act=emptychar" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Xóa Đồ Nhân Vật
		<span>Xóa đồ trên người</span></p>
	</a>
    
    <a href="#char_manager&act=reset_quest" rel="ajax" class="cont05">
		<p><img src="images/dot.png" alt="" />Làm lại Nhiệm Vụ
		<span>Về Class cấp 1</span></p>
	</a>
    <br class="clear" />
<?php } ?>

</div>
<!-- End Content -->