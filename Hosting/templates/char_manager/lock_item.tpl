<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif" /></div>
    <div class="title">Bảo Vệ Item</div>
    <div class="nr">
        <img src="images/box_tit_right.gif" /></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<table cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td valign="top" width="491" align="center">
    	<div style="text-align: left;">
        <strong>Tác dụng Chức năng Bảo Vệ Item</strong>:<br />
        <ul>
            <li>Item bảo vệ <strong>không thể giao dịch</strong> sang nhân vật khác</li>
            <li>Item bảo vệ <strong>không thể bán Shop cá nhân</strong></li>
            <li><strong>Bảo Vệ/Hủy Bảo</strong> Vệ phải dùng <strong>SĐT của tài khoản</strong> để thay đổi vì vậy độ <strong>an toàn rất cao</strong></li>
            <li>Được hỗ trợ <strong>khôi phục lấy lại đồ</strong> khi bị mất đồ.</li>
        </ul>
        </div>
        
            <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Chọn</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
                    <td>&nbsp;</td>
					<td><b>Điều kiện Bảo vệ Item</b></td>
				</tr>
				<tr>
					<td align="right" valign="top"><strong>Bảo vệ Item</strong></td>
					<td><strong><span id="price_lock"><font color='red'><?php echo number_format($lockitem_gcoin, 0, ',', '.'); ?> Gcoin</span></font></strong> <i>(Chỉ mất 1 lần khi bật bảo vệ Item, không mất phí duy trì hàng ngày)</i></td>
				</tr>
                <tr>
					<td align="right" valign="top"><strong>Hủy Bảo vệ Item</strong></td>
					<td>Miễn Phí</td>
				</tr>
                <tr>
					<td align="right" valign="top">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">Thoát Game</td>
					<td><?php echo $online; ?></td>
				</tr>
			</table>
    <center>
        <br />
        <font color='red'><strong>Mật khẩu <font color='blue'>OPD</font> (One Pass Day) : 1 Mật khẩu duy nhất dùng trong 24h kể từ khi nhận cho tất cả các chức năng cần sử dụng Mật Khẩu OPD</strong></font>.<br /><br />
        <font color='blue'><strong>Hướng dẫn nhận Mật Khẩu OPD</strong></font><br />
        <font color='black'>Vui lòng dùng <strong>SĐT của tài khoản</strong> nhắn tin với cú pháp bên dưới để hoàn tất</font><br>
		<font color='red'><b>VNU&nbsp;&nbsp;&nbsp;<?php echo $cuphap; ?>&nbsp;&nbsp;&nbsp;OPD&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['mu_username']; ?></b></font>&nbsp;&nbsp;&nbsp;gửi&nbsp;&nbsp;&nbsp;<font color='blue'><b>8185</b></font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font><br /><br />
    </center>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Thông tin</b></td>
            <td align="center"></td>
        </tr>
        <?php 
            if(isset($listitem_arr) && count($listitem_arr) > 0) {
            foreach($listitem_arr as $item) { 
        ?>
        <tr bgcolor="#FFFFFF">
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212"><?php echo $item['info']; ?></td>
            <td align="center" id="td_<?php echo $item['vitri']; ?>">
                <?php 
                    if($item['item_spec'] == 1 || $item['item_spec'] == 3) {
                        echo "Item đặc biệt.<br />Không thể bảo vệ";
                    } else if ($item['item_spec'] == 2) {
                ?>
                    <span id="lockinfo_<?php echo $item['vitri']; ?>"><font color='blue'>Item đã bảo vệ</font></span><br />
                    Mật khẩu OPD: <input type="password" id="opd_<?php echo $item['vitri']; ?>" value="" size="6" maxlength="6" /><br />
                    <span id="button_<?php echo $item['vitri']; ?>"><input type='button' vitri='<?php echo $item['vitri']; ?>' class='lockitem_unlock' value='Hủy Bảo vệ Item' /> <font color='blue'>Miễn Phí</font></span> <span id="loading_<?php echo $item['vitri']; ?>"></span><br /> <span id="err_<?php echo $item['vitri']; ?>"  style="color:#FF0000"></span>
                <?php
                    } else {
                        if($item['event_epitem'] == 1) {
                            echo "Item đang tham gia Event.<br />Không thể bảo vệ.";
                        } else {
                ?>
                <span id="lockinfo_<?php echo $item['vitri']; ?>"><font color='red'><strong>Item chưa được bảo vệ</strong></font></span><br />
                Mật khẩu OPD: <input type="password" id="opd_<?php echo $item['vitri']; ?>" value="" size="6" maxlength="6" /><br />
                <span id="button_<?php echo $item['vitri']; ?>"><input type="button" vitri='<?php echo $item['vitri']; ?>' serial='<?php echo $item['serial']; ?>' class="lockitem_lock" value="Bảo vệ Item" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /> <font color='red'><?php echo number_format($lockitem_gcoin, 0, ',', '.'); ?> Gcoin</font></span> <span id="loading_<?php echo $item['vitri']; ?>"></span><br /> <span id="err_<?php echo $item['vitri']; ?>"  style="color:#FF0000"></span>
                <?php } } ?>
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item hợp lệ</strong></font></center>"; ?>
    </table>
						
	<div class="clear">
	</div>
</div>
<!-- End Content -->