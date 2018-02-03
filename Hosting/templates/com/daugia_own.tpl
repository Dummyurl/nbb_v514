<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Chợ Trời >> Item trên Chợ Trời của Bạn</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    include('templates/com/daugia_head.tpl'); 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center>";
?>
    
<center>
    <a href="#com&act=daugia&page=daugia_own" rel="ajax" ><?php if(!$type) echo $style_choise_begin; ?>Item của bạn đang bán<?php if(!$type) echo $style_choise_end; ?></a> | 
	<a href="#com&act=daugia&page=daugia_own&type=1" rel="ajax" ><?php if($type==1) echo $style_choise_begin; ?>Item của bạn đã bán<?php if($type==1) echo $style_choise_end; ?></a> |
	<a href="#com&act=daugia&page=daugia_own&type=2" rel="ajax" ><?php if($type==2) echo $style_choise_begin; ?>Item của bạn đã hết hạn đặt trên Chợ Trời<?php if($type==2) echo $style_choise_end; ?></a>
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
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['item_image']; ?>.gif" /></td>
            <td align="center" bgcolor="#121212"><?php echo $item['item_info']; ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td align="center" colspan="2" id="item_<?php echo $item['bid_id']; ?>">
                Giá khởi điểm : <strong><?php echo number_format($item['price_min'], 0, ',', '.'); ?> Vpoint</strong> - 
                Giá bán đứt : <strong><?php echo number_format($item['price_max'], 0, ',', '.'); ?> Vpoint</strong><br />
                <?php 
                    if(isset($item['itempass']) && strlen($item['itempass']) > 0) {
                        echo "Mật khẩu bảo vệ : <strong>" . $item['itempass'] . "</strong><br />";
                    } else {
                        echo "Item bán không đặt Mật khẩu bảo vệ<br />";
                    }
                    
                    if(isset($item['trade_safe']) && $item['trade_safe'] == 1) {
                        echo "Item đã xác nhận mật khẩu OPD. <strong><font color='blue'>Giao dịch an toàn</font></strong><br />";
                    } else {
                        echo "Item không xác nhận mật khẩu OPD. <strong><font color='red'>Giao dịch không an toàn</font></strong>.<br />";
                    }
                ?>
                Thiết lập kết thúc lúc : <?php echo $item['bid_end']; ?>
            <?php if(!$type) { ?>
                <br /><br />Nhân vật trả giá cao nhất hiện tại : <strong><font color='green'><?php echo $item['name']; ?></font></strong><br />
                Giá đang đặt : <strong><font color='red'><?php echo number_format($item['bid_vpoint'], 0, ',', '.'); ?> Vpoint</font></strong><br />
                Vào lúc : <strong><?php echo $item['bid_time']; ?></strong>
            <?php } ?>
            <?php if($type == 1) { ?>
                <br /><br />
                Giá Item kết thúc : <strong><font color='red'><?php echo number_format($item['bid_vpoint'], 0, ',', '.'); ?> Vpoint</font></strong><br />
                Nhân vật đã mua : <strong><font color='green'><?php echo $item['name']; ?></font></strong> <img src="images/win.gif" border="0" /> 
                <span id='reward_<?php echo $item['bid_id']; ?>'>
                <?php
                    if($item['acc'] == $_SESSION['mu_username']) {
                        if($item['reward_status'] == 0) {
                            echo '<a href="#" class="reward_dg" bidid="'. $item['bid_id'] .'">Nhận Giải</a> <span id="loading_reward_'. $item['bid_id'] .'"></span><br /> <span id="reward_err_'. $item['bid_id'] .'"></span>';
                        } else {
                            echo "Đã nhận: ". $item['reward_time'];
                        }
                    }
                ?>
                </span>
                <br />
                <?php 
                    if($item['bid_vpoint'] < $item['price_max'] ) {
                        $time_end = $item['bid_end'];
                        $bidend_type = "Hết phiên đấu giá";
                    } else {
                        $time_end = $item['bid_time'];
                        $bidend_type = "Mua đứt";
                    }
                     
                ?>
                Item bán lúc : <strong><?php echo $time_end; ?></strong><br />
                Kết thúc bán Item theo : <strong><?php echo $bidend_type; ?></strong><br /><br />
                <?php 
                    $tax = floor($item['bid_vpoint']*$Bid_VAT/100);
                ?>
                Thuế VAT phải nộp <strong><?php echo $Bid_VAT; ?>%</strong> : <strong><?php echo $tax; ?> Vpoint</strong><br />
                Bạn đã nhận được : <strong><font color='blue'><?php echo $item['bid_vpoint']-$tax; ?> Vpoint</font></strong>
            <?php } ?>
            <?php if($type == 2) { ?>
                <br /><br />
                Thời gian Item đưa lên Chợ Trời : 
                <select id="bidday_<?php echo $item['bid_id']; ?>">
                  <option value="1"><?php echo number_format($Bid_Vpoint_Daily, 0, ',', '.'); ?> Vpoint / ngày</option>
                  <option value="2"><?php echo number_format($Bid_Vpoint_Daily*2, 0, ',', '.'); ?> Vpoint / 2 ngày</option>
                  <option value="3"><?php echo number_format($Bid_Vpoint_Daily*3, 0, ',', '.'); ?> Vpoint / 3 ngày</option>
                </select>
                <input type="button" class="dg_giahan" bidid="<?php echo $item['bid_id']; ?>" value="Tiếp tục bán Item" /> <span id="loading_giahan_<?php echo $item['bid_id']; ?>"></span><br />
                hoặc <input type="button" class="dg_rutitem" bidid="<?php echo $item['bid_id']; ?>" value="Rút Item" /> <span id="loading_rutitem_<?php echo $item['bid_id']; ?>"></span><br />
            <?php } ?>
                <span id="notice_view_<?php echo $item['bid_id']; ?>"></span>
                <br /><br /><br />
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>