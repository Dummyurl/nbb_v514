<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Luyện Bảo >> Hoàn Hảo Hóa</div>
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
    <li><strong>Điểm Hoàn Hảo Hóa</strong> nhận được khi Reset, Reset VIP, Reset OVER, Reset OVER VIP.</li>
    <li><font color='red'><strong>Reset VIP, Reset VIP Over</strong></font> nhận được <font color='blue'><strong>gấp 1.5 lần Điểm Hoàn Hảo Hóa</strong></font> so với Reset thường.</li>
    <li><strong>Điểm Hoàn Hảo Hóa</strong> có thể đổi từ Điểm Phúc Lợi trong <strong><a href="#questdaily" rel="ajax">Nhiệm Vụ Hàng Ngày</a></strong>.</li>
    <li>Dòng hoàn hảo thêm vào được chọn <strong>ngẫu nhiên</strong> trong số các dòng hoàn hảo chưa có</li>
    <li><strong>Chi phí Hoàn Hảo Hóa</strong> : 100 Điểm Hoàn Hảo Hóa + 1 Chao trong Ngân Hàng.</li>
</ul>
<center>
    <div class="info"><strong>Điểm Hoàn Hảo Hóa : <font color="red"><span id="hhpoint"><?php echo $hh_point; ?></span></font></strong></div>
    
    <b>Danh sách Item trong rương đồ của bạn</b>
</center>
<br />
    
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Thông tin</b></td>
        </tr>
        <?php 
            if(count($listitem_arr) > 0) {
            foreach($listitem_arr as $item) { 
        ?>
        <tr bgcolor="#FFFFFF">
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212"><?php echo $item['info']; ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td align="center" colspan="2" id="item_<?php echo $item['vitri']; ?>">
                <span id="itemhh_unactive_<?php echo $item['vitri']; ?>">
                <?php
                    if($item['item_spec'] == 1 || $item['item_spec'] == 3) {
                            echo "<s>Item đặc biệt không thể Hoàn Hảo Hóa</s>";
                    } else if($item['item_spec'] == 2) {
                        echo "<s>Item đã bảo vệ không được Hoàn Hảo Hóa. Hãy Hủy Bảo vệ để Tiến Hành Hoàn Hảo Hóa.</s>";
                    } else {
                ?>
                    <a href="#" class="item_hh_open" id="item_hh_open_<?php echo $item['vitri']; ?>" style="<?php if($item['cp_percent'] > 0) echo "display: none;"; ?>" vitri="<?php echo $item['vitri']; ?>">Tiến hành Thêm Dòng Hoàn Hảo <strong><?php echo $item['name']; ?></strong></a>
                <?php } ?>
                </span>
                <span id="itemhh_active_<?php echo $item['vitri']; ?>" style="<?php if($item['cp_percent'] == 0) echo "display: none;"; ?>">
                    <a href="#" class="item_hh_close" vitri="<?php echo $item['vitri']; ?>">Đóng lại</a><br /><br />
                    Số dòng hoàn hảo hiện tại : <strong><span id="itemhh_now_<?php echo $item['vitri']; ?>"><?php echo $item['exc_total']; ?></span></strong><br />
                    Tiến hành Tăng dòng hoàn hảo lên : <strong><font color="blue"><span id="itemhh_up_<?php echo $item['vitri']; ?>"><?php echo $item['exc_total']+1; ?></span></font></strong><br />
                    Chúc Phúc : <font color="red"><strong><span id="itemhh_cp_<?php echo $item['vitri']; ?>"><?php echo $item['cp_percent']; ?></span> %</strong></font><br /> <font color="silver"><i>(Chúc phúc đạt 100% => Thêm dòng Hoàn hảo thành công)</i></font><br />
                    <input type="button" class="hhitem" id="hhitem_<?php echo $item['vitri']; ?>" value="Tiến hành Thêm Dòng Hoàn Hảo" vitri="<?php echo $item['vitri']; ?>" serial="<?php echo $item['serial']; ?>" exc_total="<?php echo $item['exc_total']; ?>" />
                    
                    <span id="itemhh_loading_<?php echo $item['vitri']; ?>"></span><br />
                    <span id="itemhh_view_<?php echo $item['vitri']; ?>"></span>
                </span>
                <br /><br />
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } ?>