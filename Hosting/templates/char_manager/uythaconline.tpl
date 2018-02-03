<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Ủy Thác Online</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    	<center>
    		<b>Điều kiện Ủy Thác và nhận điểm Ủy Thác Online</b><br>
    		- Phải ủy thác ở <b><?php echo $uythacon_server; ?></b>.<br>
    		- Phải đứng trong làng <b>Lorencia</b> ( 95 < Tọa độ X < 175 === 90 < Tọa độ Y < 165 ).<br>
    		- Hoặc làng <b>Noria</b> ( 165 < Tọa độ X < 205 === 85 < Tọa độ Y < 130 ).<br>
    		- Nhân vật phải đang trong Game.<br>
    		- Trong quá trình Ủy thác có thể tùy ý di chuyển giữa 2 làng Lorencia, Noria.<br>
    		<br>
    		<b>Mất Ủy Thác nếu</b><br>
    		- Đi ra khỏi khu vực Ủy thác.<br>
    		- Đổi Server.<br>
    		- Khi mất Ủy thác có thể kích hoạt lại Ủy thác Trên Web.
    		<br><br>
    		<b>Điểm Ủy Thác: 1 phút Ủy Thác Online = 1 điểm Ủy Thác</b><br>
    		<br><b>Lưu ý</b>: <font color='red'>Để tránh tình trạng tích lũy, Điểm Ủy Thác sẽ <b>suy giảm 10%</b> vào 24h hàng ngày. Các bạn lưu ý sử dụng hết trước 24h hàng ngày.</font><br />
            <strong>Số điểm Uỷ Thác tối đa là : 1.440 điểm</strong> ( Tổng điểm Uỷ Thác Online và Offline )
    	</center>
    	<br><br>
    	<form id="UyThacOnline" name="UyThacOnline" method="post" action="index.php?mod=char_manager&act=uythaconline">
    		  <input type="hidden" name="action" value="UyThacOnline" />
    		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
    		<table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Ủy thác Online :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Ủy Thác Online" <?php if($accept == 0) { ?> disabled="disabled" <?php } ?> /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->