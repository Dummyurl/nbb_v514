<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Hệ thống Song Tu</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
		<center><img src="images/songtu.jpg" /></center>
        <ul>
            <li><strong>Song Tu</strong> : vợ chồng song tu, sức mạnh tuyệt thế.</li>
            <li><strong>Điều Kiện Song Tu</strong> : Đã kết hôn.</li>
            <li><strong>Cấp độ Song Tu</strong> càng cao, nhân vật càng mạnh.</li>
            <li><strong>Điểm Song Tu</strong> nhận được khi Reset, Reset VIP, Reset OVER, Reset VIP OVER.</li>
            <li><font color='red'><strong>Reset VIP, Reset VIP Over</strong></font> nhận được <font color='blue'><strong>gấp 1.5 lần Điểm Song Tu</strong></font> so với Reset thường.</li>
            <li><strong>Điểm Song Tu</strong> có thể đổi từ Điểm Phúc Lợi trong <strong><a href="#questdaily" rel="ajax">Nhiệm Vụ Hàng Ngày</a></strong>.</li>
            <li>Cần <strong>10 Điểm Song Tu</strong> cho 1 lần tiến hành Song Tu</li>
        </ul>

<?php
    if($songtu_arr['married'] != 1) {
?>
    <div class="error">
        Bạn chưa kết hôn, không thể tiến hành Song Tu.<br />
        Hướng dẫn cách Kết Hôn:
        <ul>
            <li>Vào Game</li>
            <li>Đến <strong>Davias 2</strong></li>
            <li>Chồng đứng ở tọa độ : <strong>14, 25</strong></li>
            <li>Vợ đứng ở tọa độ : <strong>14, 26</strong></li>
            <li>Chỉ chuột vào đối phương rồi Đánh lệnh : <strong>/marry</strong></li>
            <li>Đồng ý kết hôn Đánh lệnh : <strong>/acceptmarry</strong></li>
        </ul>
    </div>
<?php
    } else {
?>
    <div id="tang_stpoint" style="<?php echo $style_tang_ctpoint; ?>">
        <center>
            <strong>Tặng Bạn Đời <font color="blue"><?php echo $songtu_arr['vochong']; ?></font> Điểm Song Tu</strong><br />
            Chi phí tặng Điểm Song Tu : 1 Trái Tim.<br />
            Tặng <input type="text" id="gift_st_point" value="0" size="2" /> Điểm Song Tu 
            <input type="button" id="btn_gift_st_point" value="Tiến hành Tặng" /> <span id="gift_stpoint_loading"></span>
        </center>
        <div id="gift_st_notice"></div>
    </div>
    <div class="info">
        <center>Điểm Song Tu hiện có : <font color="red"><strong><span id="st_point"><?php echo $songtu_arr['songtu_point']; ?></span></strong></font></center>
        <table width="100%" border="0" bgcolor="#9999FF">
    	  <tr bgcolor="#FFFFFF">
    	    <td align="center"><b>Cấp độ</b></td>
    	    <td align="center"><b>Thân Mật</b></td>
            <td align="center"><b>Point thưởng</b></td>
    	    <td align="center"><b>Song Tu</b></td>
    	  </tr>
          <tr bgcolor="#FFFFFF">
    	    <td align="center"><b><font color="blue"><span id="stlv"><?php echo $songtu_arr['songtu_lv']; ?></span></font></b></td>
    	    <td align="center"><b><span id="stexp"><?php echo $songtu_arr['songtu_exp']; ?></b></span> / <span id="stexpup"><?php echo $exp_songtu_sum; ?></span></td>
            <td align="center"><b><font color="red"><span id="st_percent_point"><?php echo $songtu_point_percent; ?></span> %</font></b></td>
    	    <td align="center"><span id="btn_st"><?php echo $form_input; ?></span> <span id="loading_st"></span></td>
    	  </tr>
        </table>
        <div id="stsuccess"></div>
        <div id="sterror"></div>
    </div>
<?php
    }
?>


	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>