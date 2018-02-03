<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đấu Giá Ngược >> Nhận Giải</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    include('templates/com/daugianguoc_head.tpl'); 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center>";
?>
<center><b>Nhận Giải Thưởng</b></center><br /><br />
    
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
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['item_image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212"><?php echo $item['item_info']; ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td align="center" colspan="2">
                <strong>Thông tin đấu giá</strong><br />
                Tên Item : <strong><?php echo $item['item_name']; ?></strong><br />
                Giá đấu nhỏ nhất : <strong><?php echo number_format($item['price_min'], 0, ',', '.'); ?> Vpoint</strong><br />
                Giá đấu phải chia hết cho : <strong><?php echo number_format($item['bid_mod'], 0, ',', '.'); ?></strong><br />
                Thời gian bắt đầu : <strong><?php echo $item['time_begin']; ?></strong><br />
                Thời gian kết thúc : <strong><?php echo $item['time_end']; ?></strong><br />
                <font color='red'>Nhân vật thắng cuộc : <strong><?php echo $item['char_win']; ?></strong></font> 
                <img src="images/win.gif" border="0" /> 
                <span id='reward_<?php echo $item['bid_id']; ?>'>
                <?php
                    if($item['nhangiai'] == 0) {
                        echo '<a href="#" class="reward_dgn" bidid="'. $item['bid_id'] .'">Nhận Giải</a> <span id="loading_reward_'. $item['bid_id'] .'"></span><br /> <span id="reward_err_'. $item['bid_id'] .'"></span>';
                    } else {
                        echo "Đã nhận: ". $item['nhangiai_time'];
                    }
                ?>
                </span>
                <br />
                
                Giá Item : <font color='blue'><strong><?php echo number_format($item['vpoint_win'], 0, ',', '.'); ?> Vpoint</strong></font>
                <br /><br /><br />
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item Thắng Giải</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>