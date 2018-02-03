<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Giải Trí >> Đánh Lô</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
    <center>Kết quả xổ số <strong>Miền Bắc</strong> ngày <strong><?php echo date('d/m/Y', strtotime($kqxs_arr['date'])); ?></strong></center>
    <table width="100%" border="0" cellspacing="2" cellpadding="5" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
        <td align="right" width="100"><b>Giải đặc biệt</b></td>
	    <td align="center"><?php echo $giai[0]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải nhất</b></td>
	    <td align="center"><?php echo $giai[1]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải nhì</b></td>
	    <td align="center"><?php echo $giai[2]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải ba</b></td>
	    <td align="center"><?php echo $giai[3]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải tư</b></td>
	    <td align="center"><?php echo $giai[4]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải năm</b></td>
	    <td align="center"><?php echo $giai[5]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải sáu</b></td>
	    <td align="center"><?php echo $giai[6]; ?></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="right"><b>Giải bảy</b></td>
	    <td align="center"><?php echo $giai[7]; ?></td>
	  </tr>
    </table>
    
    <br /><br />
    <strong>Luật chơi</strong><br />
    <ul>
        <li>1 điểm = <?php echo number_format($lo_diem_gcoin, 0, ',', '.'); ?> Gcoin</li>
        <li>1 điểm ăn <?php echo number_format($lo_win, 0, ',', '.'); ?> Gcoin</li>
        <li>Đọ 2 số cuối 27 giải</li>
        <li>0h00 - 18h00 (6h chiều) mở ghi lô</li>
        <li>20h00 (8h tối) - 24h00 (12h đêm) trả kết quả lô</li>
        <li>Nếu trúng n nháy (n = 2,3,4,...) sẽ nhận : n x <?php echo number_format($lo_win, 0, ',', '.'); ?> Gcoin</li>
    </ul>
    
    <center>
    <?php if($hour_now >= 18) { echo "<strong>Đã hết giờ ghi Lô</strong>."; } else { ?>
        Bạn đang có <font color='red'><strong><span id="lo_gcoin"><?php echo number_format($_SESSION['acc_gcoin'], 0, ',', '.'); ?></span></strong></font> Gcoin<br />
        Đánh con 
        <select id="lo_so">
            <?php for($i=0; $i<=99; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        sử dụng 
        <select id="lo_diem">
            <?php for($i=0; $i<=$max_diemlo; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        điểm = <span id="diemlo_gcoin">0</span> Gcoin
        <br />
        <input type="submit" name="Submit" id="relax_lo_danh" value="Đánh Lô" />
        <div id="lo_msg"></div>
    <?php } ?>
        <br /><br />
        <input type="button" id="btn_lo_hítory" value="Xem lịch sử ghi Lô" />
    </center>
    
    <div id="lo_history">
        &nbsp;
    </div>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->