<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Luyện Bảo >> Cường Hóa</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    if(isset($error_module)) echo "<div class='error'>$error_module</div>";
?>
<ul>
    <li>Đặt Item cần Ép Lông Vũ Condor đặt vào 4 dòng trên cùng Hòm Đồ.</li>
    <li><strong>Danh Sách Item Ép Lông Vũ Condor</strong>:
        <ul>
            <li>Cánh Cấp 2 +9 +Tự động hồi phục HP+1% trở lên</li>
            <li>Item Thần +4op +7 trở lên</li>
            <li>1 Ngọc Hỗn Nguyên</li>
            <li>1 Ngọc Sáng Tạo</li>
            <li>1 Cụm Ngọc Tâm Linh +1 (10 viên Ngọc Tâm Linh nén)</li>
        </ul>
    </li>
    <li><b>Lưu ý</b> : Tỷ lệ thành công % càng cao thì khả năng ép thành công càng cao.</li>
    <li><strong>Cách tăng tỷ lệ % khả năng ép thành công</strong>:
        <ul>
            <li>Đồ thần + càng cao thì tỷ lệ thành công % càng cao</li>
            <li>Có thể sử dụng nhiều đồ Thần để tăng % ép thành công</li>
        </ul>
    </li>
    <li>Tất cả Item không sử dụng ép Item không được đặt lên 4 hàng đầu.</li>
</ul>
<center>
    <b>Danh sách Item Ép Lông Vũ Condor</b>
</center>
<br />
    <?php
        if($xoaylongcondor_info_arr['accept'] == 0) {
            if(strlen($xoaylongcondor_info_arr['err']) > 0) {
                echo "<div class='error'>". $xoaylongcondor_info_arr['err'] ."</div>";
            }
        } else {
            echo "<div class='success' id='xoay_longcondor_info'>";
            echo "Tỷ lệ quay thành công : ". $xoaylongcondor_info_arr['percent'] ."%<br />";
            echo "<center><input type='button' id='xoay_longcondor' value='Tiến hành Quay Lông Vũ Condor' /></center><br />";
            echo "<span id='xoay_longcondor_msg'></span>";
            echo "</div>";
        }
    ?>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Thông tin</b></td>
        </tr>
        <?php 
            if(count($xoaylongcondor_info_arr['item_view']) > 0) {
            foreach($xoaylongcondor_info_arr['item_view'] as $item) { 
        ?>
        <tr bgcolor="#FFFFFF">
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['img']; ?>.gif"></td>
            <td align="center" bgcolor="#121212"><?php echo $item['info']; ?></td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } ?>