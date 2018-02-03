<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Giải Trí >> Đánh Đề</div>
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
        <li>1.000 Gcoin ăn <?php echo number_format($de_win*1000, 0, ',', '.'); ?> Gcoin</li>
        <li>Đọ 2 số cuối giải đặc biệt</li>
        <li>0h00 - 18h00 (6h chiều) mở ghi đề</li>
        <li>20h00 (8h tối) - 24h00 (12h đêm) trả kết quả đề</li>
        <li>Nếu trúng n.000 (n = 2,3,4,...) Gcoin sẽ nhận : n x <?php echo number_format($de_win*1000, 0, ',', '.'); ?> Gcoin</li>
    </ul>
    
    <center>
    <?php if($hour_now >= 18) { echo "<strong>Đã hết giờ ghi Đề</strong>."; } else { ?>
        Bạn đang có <font color='red'><strong><span id="de_gcoin"><?php echo number_format($_SESSION['acc_gcoin'], 0, ',', '.'); ?></span></strong></font> Gcoin<br />
        Đánh con 
        <select id="de_so">
            <?php for($i=0; $i<=99; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        sử dụng 
        <select id="de_diem">
            <?php for($i=0; $i<=$max_diemde; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        .000 Gcoin
        <br />
        <input type="submit" name="Submit" id="relax_de_danh" value="Đánh Đề" />
        <div id="de_msg"></div>
    <?php } ?>
        <br /><br />
        <input type="button" id="btn_de_hítory" value="Xem lịch sử ghi Đề" />
    </center>
    
    <div id="de_history">
        &nbsp;
    </div>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->