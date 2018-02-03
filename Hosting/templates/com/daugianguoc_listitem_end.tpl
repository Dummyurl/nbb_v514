<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đấu Giá Ngược >> Đấu Giá Kết Thúc</div>
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
<center><b>Danh sách Item Kết thúc Đấu Giá</b></center><br /><br />
    
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
                <br />
                <font color='red'>Nhân vật thắng cuộc : <strong><?php echo $item['char_win']; ?></strong></font> <img src="images/win.gif" border="0" /><br />
                Giá Item : <font color='blue'><strong><?php echo number_format($item['vpoint_win'], 0, ',', '.'); ?> Vpoint</strong></font> <br />
                <a href="#listbid_<?php echo $item['bid_id']; ?>" bidid="<?php echo $item['bid_id']; ?>" class="listbid" title="Danh sách đấu giá Item <strong><font color='red'><?php echo $item['item_name']; ?></font></strong>" >Xem danh sách Đấu Giá</a>
                <div style="display: none;">
            		<div id="listbid_<?php echo $item['bid_id']; ?>" style="width:600px;height:300px;overflow:auto;">
            			<table border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="3" width="90%" align="center">
                            <tr>
                                <td align="center"><strong>Nhân vật</strong></td>
                                <td align="center"><strong>Giá đặt</strong></td>
                                <td align="center"><strong>Đặt lúc</strong></td>
                                <td align="center"><strong>Thế hệ</strong></td>
                            </tr>
                            <?php 
                                foreach($item['listbid'] as $listbid) { 
                                    $tr_style = "";
                                    $img_win = "";
                                    if($listbid['win'] == 1) {
                                        $tr_style = 'bgcolor="#FFFFCC"';
                                        $img_win = '<img src="images/win.gif" border="0" />';
                                    }
                            ?>
                            <tr <?php echo $tr_style; ?>>
                                <td align="center"><?php echo $listbid['name']. " " . $img_win; ?> </td>
                                <td align="center"><?php echo number_format($listbid['bid_vpoint'], 0, ',', '.'); ?> Vpoint</td>
                                <td align="center"><?php echo $listbid['bid_time']; ?></td>
                                <td align="center"><?php echo $thehe_choise[$listbid['thehe']]; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
            		</div>
            	</div>
                <br /><br /><br />
            </td>
        </tr>
        <?php } } } else echo "<center><font color='red'><strong>Không có Item Kết thúc Đấu Giá</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>