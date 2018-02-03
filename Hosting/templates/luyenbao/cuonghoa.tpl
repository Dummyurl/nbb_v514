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
    <li><strong>Điểm Cường Hóa</strong> nhận được khi Reset, Reset VIP, Reset OVER, Reset OVER VIP.</li>
    <li><font color='red'><strong>Reset VIP, Reset VIP Over</strong></font> nhận được <font color='blue'><strong>gấp 1.5 lần Điểm Cường Hóa</strong></font> so với Reset thường.</li>
    <li><strong>Điểm Cường Hóa</strong> có thể đổi từ Điểm Phúc Lợi trong <strong><a href="#questdaily" rel="ajax">Nhiệm Vụ Hàng Ngày</a></strong>.</li>
    <li><strong>Chi phí Cường Hóa</strong> : 100 Điểm Cường Hóa + 1 Chao trong Ngân Hàng.</li>
</ul>
<center>
    <div class="info"><strong>Điểm Cường Hóa : <font color="red"><span id="chpoint"><?php echo $ch_point; ?></span></font></strong></div>
    
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
                <span id="itemch_unactive_<?php echo $item['vitri']; ?>">
                <?php
                    if($item['item_spec'] == 1 || $item['item_spec'] == 3) {
                            echo "<s>Item đặc biệt không thể Cường Hóa</s>";
                    } else if($item['item_spec'] == 2) {
                        echo "<s>Item đã bảo vệ không được Cường Hóa. Hãy Hủy Bảo vệ để Tiến Hành Cường Hóa.</s>";
                    } else {
                ?>
                    <a href="#" class="item_ch_open" id="item_ch_open_<?php echo $item['vitri']; ?>" style="<?php if($item['cp_percent'] > 0) echo "display: none;"; ?>" vitri="<?php echo $item['vitri']; ?>">Tiến hành Cường Hóa <strong><?php echo $item['name']; ?></strong></a>
                <?php } ?>
                </span>
                <span id="itemch_active_<?php echo $item['vitri']; ?>" style="<?php if($item['cp_percent'] == 0) echo "display: none;"; ?>">
                    <a href="#" class="item_ch_close" vitri="<?php echo $item['vitri']; ?>">Đóng lại</a><br /><br />
                    Cấp độ hiện tại : +<strong><span id="itemlv_now_<?php echo $item['vitri']; ?>"><?php echo $item['level']; ?></span></strong><br />
                    Tiến hành Cường Hóa lên : +<strong><font color="blue"><span id="itemlv_up_<?php echo $item['vitri']; ?>"><?php echo $item['level']+1; ?></span></font></strong><br />
                    Chúc Phúc : <font color="red"><strong><span id="itemch_cp_<?php echo $item['vitri']; ?>"><?php echo $item['cp_percent']; ?></span> %</strong></font><br /> <font color="silver"><i>(Chúc phúc đạt 100% => Cường hóa thành công)</i></font><br />
                    <input type="button" class="chitem" id="chitem_<?php echo $item['vitri']; ?>" value="Tiến hành Cường Hóa" vitri="<?php echo $item['vitri']; ?>" serial="<?php echo $item['serial']; ?>" item_lvl="<?php echo $item['level']; ?>" />
                    
                    <span id="itemch_loading_<?php echo $item['vitri']; ?>"></span><br />
                    <span id="itemch_view_<?php echo $item['vitri']; ?>"></span>
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