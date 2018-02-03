<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Nhiệm vụ hàng ngày</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    <?php 
        if (!isset($_SESSION['mu_nvchon'])) {
            echo "<strong>Chưa chọn nhân vật</strong>. <br />Nhiệm vụ phúc lợi chỉ thực hiện với nhân vật có Relife/Reset cao nhất trong tài khoản.<br />Vui lòng chọn nhân vật có <strong>Relife/Reset cao nhất</strong> trong tài khoản.";
        } else {
            if($quest_arr['nvchinh'] != 1) {
                echo "Nhân vật đang chọn không phải nhân vật chính.<br />Vui lòng chọn nhân vật có số lần Relife/Reset cao nhất trong tài khoản";
            } else {
    ?>
    <center>
    <strong>Điểm Phúc Lợi hiện có</strong> : <strong><font color='red'><span id="pl_point"><?php echo $quest_arr['plpoint']; ?></span></font></strong><br />
    Đổi <input type="text" name="pl_change" id="pl_point_change" size="2" maxlength="4" /> Điểm Phúc Lợi ra 
    <select name="pl_point_to" id="pl_point_to">
        <option value="tl">Điểm Tu Luyện</option>
        <option value="st">Điểm Song Tu</option>
        <option value="ch">Điểm Cường Hóa</option>
        <option value="hh">Điểm Hoàn Hảo Hóa</option>
    </select>
    <input type="button" name="btn_pl_change" id="btn_pl_change" value="Đổi" /> 
    <span id="loading_pl_change"></span>
    </center>
<div id="plchange_success"></div>
<div id="plchange_error"></div>

    <ul>
        <li><strong>Online</strong> : Tổng thời gian Online trong ngày. Thời gian Online chỉ cập nhập khi thoát Game.</li>
        <li><strong>Thực hiện Reset</strong> : Tổng số lần thực hiện <strong>Reset, Reset VIP, Reset OVER, Reset OVER VIP</strong>.</li>
        <li><strong>Thực hiện Reset VIP</strong> : Tổng số lần thực hiện <strong>Reset VIP, Reset VIP OVER</strong>.</li>
        <li><strong>Sử dụng Tiền Tệ</strong> : Tổng Gcoin + Gcoin Khuyến Mãi + Vpoint sử dụng trên Tài khoản.</li>
        <li><strong>Điểm PL</strong> : Điểm Phúc Lợi. Sử dụng để đổi ra Điểm Tu Luyện, Điểm Cường Hóa, Điểm Hoàn Hảo, Điểm Luyện Hóa,...</li>
        <li><strong>Chao</strong> nhận được sẽ nằm trong ngân hàng.</li>
    </ul>
    
<center>
    <strong><font color='blue'>Hôm nay, Nhân vật đã đạt được</font></strong> :<br /> 
    <table border="0" align="center">
        <tr>
            <td align="right"><strong>Online</strong> :</td>
            <td><?php echo $nvonline; ?></td>
        </tr>
        <tr>
            <td align="right"><strong>Thực hiện Reset</strong> :</td>
            <td><?php echo $quest_arr['rsall']; ?></td>
        </tr>
        <tr>
            <td align="right"><strong>Thực hiện Reset VIP</strong> :</td>
            <td><?php echo $quest_arr['rsvip']; ?></td>
        </tr>
        <tr>
            <td align="right"><strong>Tổng thẻ nạp</strong> :</td>
            <td><?php echo number_format($quest_arr['cardnap'], 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="right"><strong>Sử dụng tiền tệ</strong> :</td>
            <td><?php echo number_format($quest_arr['usemoney'], 0, ',', '.'); ?></td>
        </tr>
    </table>
</center>
<br />
<div id="qsuccess"></div>
<div id="qerror"></div>
        <table width="100%" border="0" bgcolor="#9999FF">
    	  <tr bgcolor="#FFFFFF">
    	    <td align="center"><b>Nhiệm vụ</b></td>
    	    <td align="center"><b>Phần thưởng</b></td>
            <td align="center"><b>Tình Trạng</b></td>
    	  </tr>
          
          <?php 
            for($i=1; $i<=27; $i++) { 
            if($quest_daily[$i] == 1) {
          ?>
              <tr bgcolor="#FFFFFF">
        	    <td align="left"><b><?php echo $quest_name[$i]; ?></b></td>
        	    <td align="left"><?php echo $phanthuong[$i]; ?></td>
                <td align="center"><span id="btn_spanquest_<?php echo $i; ?>"><?php echo $input[$i]; ?></span> <span id="loading_quest_<?php echo $i; ?>"></span></td>
        	  </tr>
    	  <?php } } ?>
          
       </table>
    
    <?php } } ?>
    <div class="clear">
	</div>
</div>
<!-- End Content -->