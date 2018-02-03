<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Hệ thống tu luyện</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
		<center><img src="images/tuluyen.jpg" /></center><br />
    	
        <ul>
            <li><strong>Điểm Tu Luyện</strong> nhận được khi : Reset, Reset VIP, Reset OVER, Reset VIP OVER.</li>
            <li><font color='red'><strong>Reset VIP, Reset VIP Over</strong></font> nhận được <font color='blue'><strong>gấp 1.5 lần điểm Tu Luyện</strong></font> so với Reset thường.</li>
            <li>Cần <strong>10 Điểm Tu Luyện</strong> cho 1 lần tiến hành Tu Luyện</li>
            <li><strong>Thăng cấp thành công</strong> khi <strong>Điểm Chúc Phúc đạt 100%</strong>.</li>
            <li>Thăng cấp : Cần 1 Chao trong <a href="#char_manager&act=jewel2bank" rel="ajax">ngân hàng</a></li>
        </ul>

<center>Điểm Tu Luyện hiện có : <font color='red'><b><span id="tl_point"><?php echo $tuluyen_arr['tuluyen_point']; ?></span></b></font></center>        
<br />
<table width="100%" border="0" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
	    <td align="center"><b>Thuộc Tính</b></td>
	    <td align="center"><b>Cấp</b></td>
        <td align="center"><b>Point</b></td>
        <td align="center"><b>Điểm Tu Luyện</b></td>
        <td align="center"><b>Point cấp sau</b></td>
	    <td align="center"><b>Tu Luyện</b></td>
	  </tr>

	  <tr bgcolor="#FFFFFF">
	    <td align="center"><strong>Sức Mạnh</strong></td>
        <td align="center"><font color='blue'><b><span id="tlcap_str"><?php echo $tuluyen_arr['str_cap']; ?></span></b></font></td>
        <td align="center"><font color='red'><span id="tlpoint_str"><?php echo $tuluyen_arr['str_point']; ?></span></font></td>
        <td align="center"><b><span id="tlexp_str"><?php echo $exp_now[1]; ?></span></b> / <span id="tlexpnext_str"><?php echo $exp_tuluyen_sum[1]; ?></span></td>
        <td align="center"><span id="tlpointnext_str"><?php echo $sumpoint[1]; ?></span></td>
        <td align="center"><span id="btn_tlstr"><?php echo $form_input[1]; ?></span> <span id="loading_tlstr"></span></td>
	  </tr>
      
      <tr bgcolor="#FFFFFF">
	    <td align="center"><strong>Nhanh Nhẹn</strong></td>
        <td align="center"><font color='blue'><b><span id="tlcap_agi"><?php echo $tuluyen_arr['agi_cap']; ?></span></b></font></td>
        <td align="center"><font color='red'><span id="tlpoint_agi"><?php echo $tuluyen_arr['agi_point']; ?></span></font></td>
        <td align="center"><b><span id="tlexp_agi"><?php echo $exp_now[2]; ?></span></b> / <span id="tlexpnext_agi"><?php echo $exp_tuluyen_sum[2]; ?></span></td>
        <td align="center"><span id="tlpointnext_agi"><?php echo $sumpoint[2]; ?></span></td>
        <td align="center"><span id="btn_tlagi"><?php echo $form_input[2]; ?></span> <span id="loading_tlagi"></span></td>
	  </tr>
      
      <tr bgcolor="#FFFFFF">
	    <td align="center"><strong>Thể Lực</strong></td>
        <td align="center"><font color='blue'><b><span id="tlcap_vit"><?php echo $tuluyen_arr['vit_cap']; ?></span></b></font></td>
        <td align="center"><font color='red'><span id="tlpoint_vit"><?php echo $tuluyen_arr['vit_point']; ?></span></font></td>
        <td align="center"><b><span id="tlexp_vit"><?php echo $exp_now[3]; ?></span></b> / <span id="tlexpnext_vit"><?php echo $exp_tuluyen_sum[3]; ?></span></td>
        <td align="center"><span id="tlpointnext_vit"><?php echo $sumpoint[3]; ?></span></td>
        <td align="center"><span id="btn_tlvit"><?php echo $form_input[3]; ?></span> <span id="loading_tlvit"></span></td>
	  </tr>
      
      <tr bgcolor="#FFFFFF">
	    <td align="center"><strong>Năng Lượng</strong></td>
        <td align="center"><font color='blue'><b><span id="tlcap_ene"><?php echo $tuluyen_arr['ene_cap']; ?></span></b></font></td>
        <td align="center"><font color='red'><span id="tlpoint_ene"><?php echo $tuluyen_arr['ene_point']; ?></span></font></td>
        <td align="center"><b><span id="tlexp_ene"><?php echo $exp_now[4]; ?></span></b> / <span id="tlexpnext_ene"><?php echo $exp_tuluyen_sum[4]; ?></span></td>
        <td align="center"><span id="tlpointnext_ene"><?php echo $sumpoint[4]; ?></span></td>
        <td align="center"><span id="btn_tlene"><?php echo $form_input[4]; ?></span> <span id="loading_enestr"></span></td>
	  </tr>
</table>

<div id="tlsuccess"></div>
<div id="tlerror"></div>

	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>