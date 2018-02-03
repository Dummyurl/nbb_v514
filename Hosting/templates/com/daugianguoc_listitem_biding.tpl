<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đấu Giá Ngược >> Đang Đấu</div>
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

<center><b>Danh sách Item đang đấu giá</b></center><br /><br />
    
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Thông tin</b></td>
        </tr>
        <?php 
            if(count($listitem_arr) > 0) {
            foreach($listitem_arr as $item) { 
                $item_view = false;
                $thehe_str = "";
                foreach($item['thehe'] as $thehe_val) {
                    if(strlen($thehe_choise[$thehe_val]) > 0) {
                        if($thehe_val == $_SESSION['acc_thehe']) $item_view = true;
                        if(strlen($thehe_str) > 0) $thehe_str .= " - ";
                        $thehe_str .= "<strong>". $thehe_choise[$thehe_val] ."</strong>";
                    }
                }
                if($item_view === true) {
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
                Item đấu giá dành cho : <?php echo $thehe_str; ?>
                <br /><br />
                <?php if($item['bid_time_status'] == 0) echo "<font color='red'><b>Chưa đến giờ đấu giá</b></font>"; else { ?>
                <i>(Có thể đấu nhiều lần cho 1 Item)</i><br />
                Giá đấu <input type="text" id="bid_<?php echo $item['bid_id']; ?>" size="5" /> Vpoint <input type="button" class="bid_dgn" bidid="<?php echo $item['bid_id']; ?>" price_min="<?php echo $item['price_min']; ?>" bid_mod="<?php echo $item['bid_mod']; ?>" value="Đặt Giá" /> <span id="loading_<?php echo $item['bid_id']; ?>"></span><br /><span id="notice_<?php echo $item['bid_id']; ?>"></span><br />
                <i>(Chi phí cho 1 lần đặt giá : <?php echo number_format($Vpoint_Bid, 0, ',', '.'); ?> Vpoint)</i><br />
                <a href="#" bidid="<?php echo $item['bid_id']; ?>" class="dgn_bidding_view">Xem danh sách đấu giá của bạn cho Item này</a> <span id="loading_bidding_view_<?php echo $item['bid_id']; ?>"></span><br />
                <span id="notice_bidding_view_<?php echo $item['bid_id']; ?>"></span>
                <?php } ?>
                <br /><br /><br />
            </td>
        </tr>
        <?php } } } else echo "<center><font color='red'><strong>Không có Item Đấu Giá</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>