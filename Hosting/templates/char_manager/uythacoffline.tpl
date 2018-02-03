<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Ủy thác Offline</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	
    	<blockquote><p align="center">
    		<b>Điểm Ủy Thác</b>: <?php echo $phut_1point; ?> phút Ủy Thác Offline = 1 điểm Ủy Thác<br>
    		- Chi phí Ủy thác Offline: <?php echo number_format($uythacoff_price, 0, ',', '.'); ?> Gcoin / 1 phút Ủy thác<br>
    		<b>Được sử dụng Gcoin Khuyến Mại</b><br /><br />
    		- <b>Khi Ủy Thác Offline : Nhân vật sẽ bị khóa</b>. Kết thúc Ủy thác Offline nhân vật sẽ được mở khóa.<br>
    		<b>Lưu ý</b> : Chú ý tính toán kĩ thời gian kết thúc Ủy thác Offline.
    		<br>Tránh trường hợp để quá lâu bị hết Gcoin (^_^)<br>
    		<br><b>Lưu ý</b>: <font color='red'>Để tránh tình trạng tích lũy, Điểm Ủy Thác sẽ <b>suy giảm 10%</b> vào 24h hàng ngày. Các bạn lưu ý sử dụng hết trước 24h hàng ngày.</font><br />
            <ul>
                <li><strong>Thời gian Uỷ Thác Offline tối đa trong 1 ngày là 12 tiếng</strong> ( Nếu quá 12 tiếng sẽ chỉ nhận được thời gian Uỷ Thác trong 12 tiếng ) : <strong>720 Điểm Ủy Thác</strong></li>
                <li><strong>Thời gian Uỷ Thác Offline tối đa trong 1 lần là 12 tiếng</strong> ( Nếu quá 12 tiếng sẽ chỉ nhận được thời gian Uỷ Thác trong 12 tiếng ) : <strong>720 Điểm Ủy Thác</strong></li>
                <li>Uỷ Thác Online không bị giới hạn thời gian Uỷ Thác</li>
                <li><strong>Số điểm Uỷ Thác tối đa là : 1.440 điểm</strong> ( Tổng điểm Uỷ Thác Online và Offline )</li>
            </ul>
    	</p></blockquote>
<?php if($_SESSION['nv_uythac_offline']==0) { ?>
		<form id="uythacoffline" name="uythacoffline" method="post" action="index.php?mod=char_manager&act=uythacoffline">
		  <input type="hidden" name="action" value="uythacoffline" />
		  <input type="hidden" name="act" value="uythac_begin" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Ủy thác Offline :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Ủy thác Offline</b></td>
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
					<td align="right">Mật khẩu Cấp 2</td>
					<td><input type="password" name="pass2" size="20" /></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Ủy thác Offline" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>
<?php } else { ?>
		<form id="uythacoffline" name="uythacoffline" method="post" action="index.php?mod=char_manager&act=uythacoffline">
		  <input type="hidden" name="action" value="uythacoffline" />
		  <input type="hidden" name="act" value="uythac_end" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Ủy thác Offline :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
                
                <tr>
					<td align="right" width="40%">Gợi Ý :</td>
					<td>
                        <?php echo $uythac_goiy; ?>.
                    </td>
				</tr>
                
                <tr>
					<td align="right" width="40%" valign="top">Đã Ủy Thác :</td>
					<td>
                        <strong class="clr02"><?php echo $_SESSION['nv_uythac_offline_time']; ?></strong> phút<br />
                        <?php echo $uythac_msg; ?>.
                    </td>
				</tr>
				<tr>
					<td align="right">Mật khẩu Cấp 2</td>
					<td><input type="password" name="pass2" size="20" /></td>
				</tr>
                <tr>
					<td align="right">Nhận Ủy Thác</td>
					<td>
                        <input type="checkbox" name="getuythac" checked="checked" /> <i>(Tích nếu muốn dùng Gcoin để đổi điểm Ủy Thác.<br />Không tích nếu không muốn dùng Gcoin đổi điểm Ủy Thác)</i>
                    </td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Kết thúc Ủy thác Offline" /></td>
				</tr>
			</table>
		</form>
<?php } ?>

	<div class="clear">
	</div>
</div>
<!-- End Content -->