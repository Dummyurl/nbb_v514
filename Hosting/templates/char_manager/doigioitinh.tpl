<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đổi Giới Tính</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

		<center>
    		<b>Được sử dụng Gcoin Khuyến Mại</b><br />
    	</center>
    		<ul>
                <?php if($keep_bxh != 1) { ?>
    			<li>Đổi Giới Tính sẽ bị xóa hết số lần Reset trong bảng TOP : TOP Điểm Reset, TOP Ngày, TOP Tuần, TOP Tháng. Vì vậy chỉ nên Đổi Giới tính Đầu Tháng khi Số lần Reset trong bảng TOP còn ít.</li>
    			<li>Nếu Nhân vật đổi Giới Tính đạt giải thưởng Event. Vui lòng đợi BQT tổng kết và có thông báo trước rồi mới thực hiện Đổi Giới Tính. Nếu BQT chưa tổng kết mà Đổi Giới Tính, dữ liệu TOP của bạn sẽ bị xóa. Vì vậy, bạn sẽ bị mất giải Event.</li>
                <?php } else { ?>
                <li><font color='red'><strong>Đổi Giới Tính không bị xóa dữ liệu trong bảng xếp hạng</strong></font></li>
                <?php } ?>
    		</ul>
    	
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">Phí (Gcoin)</th>
			<th align="center" scope="col">% Reset bị mất</th>
			<th align="center" scope="col">Reset ít nhất</th>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo number_format($doigt_gcoin, 0, ',', '.'); ?> Gcoin</td>
		    <td align="center"><?php echo $doigt_trureset; ?> %</td>
		    <td align="center"><?php echo $doigt_resetmin; ?> Reset</td>
		  </tr>
		</table>
		<br>
		<center><img src="img_item/mac_mathet.jpg">&nbsp;
    	<img src="img_item/tuido_mathet.jpg"></center><br>
    	<blockquote><div align="justify">- Đổi nhân vật khác trước khi đổi giới tính.<br>
    	- Sau khi đổi giới tính, toàn bộ nhiệm vụ đã làm sẽ bị hủy bỏ.</div></blockquote>

<form id="doigioitinh" name="doigioitinh" method="post" action="index.php?mod=char_manager&act=doigioitinh">
	<input type="hidden" name="action" value="doigioitinh" />
	<input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    <table width="100%" border="0" cellpadding="1" cellspacing="1">
    	<tr>
			<td align="right" width="40%">Nhân vật Đổi Giới Tính</td>
			<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><b>Điều kiện Đổi Giới Tính</b></td>
		</tr>
		<tr>
			<td align="right">Reset</td>
			<td><?php echo "$doigt_resetmin ($notice_reset)"; ?></td>
		</tr>
		<tr>
			<td align="right">Gcoin</td>
			<td><?php echo number_format($doigt_gcoin, 0, ',', '.')." ($notice_gcoin)"; ?></td>
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
			<td align="right">Chọn Giới Tính đổi sang</td>
			<td>
				<select name="gioitinh">
					<?php if ($_SESSION['nv_class'] != $class_dw_1 && $_SESSION['nv_class'] != $class_dw_2 && $_SESSION['nv_class'] != $class_dw_3 ) { ?><option value="0" selected="selected">Dark Wizard</option><?php } ?>
					<?php if ($_SESSION['nv_class'] != $class_dk_1 && $_SESSION['nv_class'] != $class_dk_2 && $_SESSION['nv_class'] != $class_dk_3 ) { ?><option value="16">Dark Knight</option><?php } ?>
					<?php if ($_SESSION['nv_class'] != $class_elf_1 && $_SESSION['nv_class'] != $class_elf_2 && $_SESSION['nv_class'] != $class_elf_3 ) { ?><option value="32">Elf</option><?php } ?>
					<?php if ($_SESSION['nv_class'] != $class_mg_1 && $_SESSION['nv_class'] != $class_mg_2 && ( !isset($mg_use) || $mg_use == 1 ) ) { ?><option value="48">Magic Gladiator</option><?php } ?>
					<?php if ($_SESSION['nv_class'] != $class_dl_1 && $_SESSION['nv_class'] != $class_dl_2 && ( !isset($dl_use) || $dl_use == 1 ) ) { ?><option value="64">Dark Lord</option><?php } ?>
					<?php if ($_SESSION['nv_class'] != $class_sum_1 && $_SESSION['nv_class'] != $class_sum_2 && $_SESSION['nv_class'] != $class_sum_3 && ( !isset($sum_use) || $sum_use == 1 ) ) { ?><option value="80">Summoner</option><?php } ?>
                    <?php if ( $_SESSION['nv_class'] != $class_rf_1 && $_SESSION['nv_class'] != $class_rf_2  && ( !isset($rf_use) || $rf_use == 1 ) ) { ?><option value="96">Rage Fighter</option><?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Mật khẩu cấp 2</td>
			<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Đổi giới tính" onclick="return confirm('Lưu ý:\n + Đổi Giới Tính sẽ bị xóa hết số lần Reset trong bảng TOP : TOP Điểm Reset, TOP Ngày, TOP Tuần, TOP Tháng. Vì vậy chỉ nên Đổi Giới tính Đầu Tháng khi Số lần Reset trong bảng TOP còn ít.\n + Nếu Nhân vật đổi Giới Tính đạt giải thưởng Event. Vui lòng đợi BQT tổng kết và có thông báo trước rồi mới thực hiện Đổi Giới Tính. Nếu BQT chưa tổng kết mà Đổi Giới Tính, dữ liệu TOP của bạn sẽ bị xóa. Vì vậy, bạn sẽ bị mất giải Event.\n\n Nếu bạn đã chắc chắn muốn Đổi Giới Tính hãy ấn OK !!!');" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
		</tr>
	</table>
</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->