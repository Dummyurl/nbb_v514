<div class="pad10">
    <center><strong><?php echo $lang_home_event; ?></strong></center>
    <ul>
	<?php 
        if($khuyenmai == 1) {
            $lang_arr = array($khuyenmai_phantram);
            echo "<li>". _langarr($lang_home_eventcard, $lang_arr) ."</li>";
        }
        
        if($event_epitem_on == 1 && (strtotime($event_epitem_end) >= time() - 5*24*60*60) ) {
            $lang_arr = array($event_epitem_name, date('d/m', strtotime($event_epitem_begin)), date('d/m', strtotime($event_epitem_end)));
            echo "<li>". _langarr($lang_home_eventepitem, $lang_arr) ."</li>";
        }
        
        if($giftcode_rs_use > 0) {
            echo "<li>". $lang_home_event_giftcoders ."</li>";
        }
        
        if($giftcode_week_use > 0) {
            echo "<li>". $lang_home_event_giftcodeweek ."</li>";
        }
        
        if($giftcode_month_use > 0) {
            echo "<li>". $lang_home_event_giftcodemonth ."</li>";
        }
        
        if($giftcode_tanthu_use == 1) {
            echo "<li>". $lang_home_event_giftcodenewmem ."</li>";
        }
        
        if($event_santa_ticket == 1) {
            echo "<li>". $lang_home_event_santaticket ."</li>";
        }
        
        if($event_bongda_on == 1) {
            echo "<li>". $lang_home_event_football ."</li>";
        }
        
        if($event1_on == 1 && (strtotime($event_toppoint_end) >= time() - 5*24*60*60) ) {
            $lang_arr = array($event1_name, date('d/m', strtotime($event_toppoint_begin)), date('d/m', strtotime($event_toppoint_end)));
            echo "<li>". _langarr($lang_home_event_item2point, $lang_arr) ."</li>";
        }
        
        if($event_toppoint_on == 1 && (strtotime($event_toppoint_end) >= time() - 5*24*60*60) ) {
            $lang_arr = array($event_toppoint_name, date('d/m', strtotime($event_toppoint_begin)), date('d/m', strtotime($event_toppoint_end)));
            echo "<li>". _langarr($lang_home_event_topitem2point, $lang_arr) ."</li>";
        }
        
        if($event_topcard_on == 1 && (strtotime($event_topcard_end) >= time() - 5*24*60*60) ) {
            $lang_arr = array($event_topcard_name, date('d/m', strtotime($event_topcard_begin)), date('d/m', strtotime($event_topcard_end)));
            echo "<li>". _langarr($lang_home_event_topcard, $lang_arr) ."</li>";
        }
        
        if($event_toprs_on == 1 && (strtotime($event_toprs_end) >= time() - 5*24*60*60) ) {
            $lang_arr = array($event_toprs_name, date('d/m', strtotime($event_toprs_begin)), date('d/m', strtotime($event_toprs_end)));
            echo "<li>". _langarr($lang_home_event_toprs, $lang_arr) ."</li>";
        }
    ?>
    </ul>
    
<?php
    if($Use_DauGiaNguoc == 1) {
        if(count($listitem_arr) > 0) {
?>
    <hr />
    <center><a href="#com&act=daugianguoc" rel="ajax"><b><?php echo $lang_home_dgn; ?></b></a></center><br />
    
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFFFF">
        <?php 
            $item_count = 0;
            $image_width_total = 0;
            foreach($listitem_arr as $item) { 
                $item_view = false;
                $thehe_str = "";
                foreach($item['thehe'] as $thehe_val) {
                    if(strlen($thehe_choise[$thehe_val]) > 0) {
                        if(isset($_SESSION['acc_thehe'])) {
                            if($thehe_val == $_SESSION['acc_thehe']) $item_view = true;
                        } else {
                            $item_view = true;
                        }
                        
                        if(strlen($thehe_str) > 0) $thehe_str .= " - ";
                        $thehe_str .= "<strong>". $thehe_choise[$thehe_val] ."</strong>";
                    }
                }
                if($item_view === true) {
                    ++$item_count;
                    $image_info = getimagesize("items/". $item['item_image']. ".gif");
                    $image_width = $image_info[0];
                    $image_width_total += $image_width;
                    if($image_width_total > 500) break;
        ?>
            <td align="center" bgcolor="#121212">
                <a href="#com&act=daugianguoc&page=daugianguoc_listitem_biding" rel="ajax" id="item_dgn_tooltip_<?php echo $item['bid_id']; ?>" class="item_dg_tooltip">
                    <img src="items/<?php echo $item['item_image']; ?>.gif" /><br />
                    <strong><font color='cyan'><?php echo number_format($item['price_min'], 0, ',', '.'); ?> Vpoint</font></strong><br />
                    <strong><font color='orange'><?php echo $item['time_end']; ?></font></strong>
                </a>
                <div id="data_item_dgn_tooltip_<?php echo $item['bid_id']; ?>" style="display:none;">
                    <div style="background-color: #121212; font-size: 12px;"><?php echo $item['item_info']; ?></div>
                </div>
            </td>
        <?php if($item_count == 5) break; } } ?>
        </tr>
    </table>
<?php
        }
    }
?>

<?php
    if($Use_DauGia == 1) {
        if(count($group_item) > 0) {
?>
    <hr />
        <center><b><?php echo $lang_home_market; ?></b><br />
        
        <?php
            $count_flag = 0;
            
            foreach($group_item as $group_key => $group_val) {
                if($group_key > 0) {
                    if($group_key % 5 == 0) {
                        echo "<br />";
                    } else {
                        echo " | ";
                    }
                }
        ?>
        	<a href="#com&act=daugia&page=daugia_biding&type=<?php echo $group_val['group_type']; ?>" rel="ajax"><?php echo $group_val['group_name']; ?> (<strong><font color='blue'><?php echo $group_val['group_count']; ?></font></strong>)</a>
                
        <?php } ?>
        </center><br />
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form' align="center">
            <tr bgcolor="#FFFFFF">
            <?php
                $item_count = 0;
                $image_width_total = 0;
                foreach($listitem_dg_arr as $item) {
                    ++$item_count;
                    $image_info = getimagesize("items/". $item['item_image']. ".gif");
                    $image_width = $image_info[0];
                    $image_width_total += $image_width;
                    if($image_width_total > 500) break;
            ?>
                <td align="center" bgcolor="#121212" valign="bottom">
                    <a href="#com&act=daugia&page=daugia_biding&type=<?php echo $item['item_group']; ?>" rel="ajax" id="item_dg_tooltip_<?php echo $item['bid_id']; ?>" class="item_dg_tooltip">
                    <img src="items/<?php echo $item['item_image']; ?>.gif" /><br />
                    <strong><font color='cyan'><?php echo number_format($item['bid_vpoint'], 0, ',', '.'); ?> Vpoint</font></strong><br />
                    <strong><font color='orange'><?php echo $item['name']; ?></font></strong><br />
                    <strong><font color='orange'><?php echo $item['bid_end']; ?></font></strong>
                    </a>
                    <div id="data_item_dg_tooltip_<?php echo $item['bid_id']; ?>" style="display:none;">
                        <div style="background-color: #121212; font-size: 12px;"><?php echo $item['item_info']; ?></div>
                    </div>
                </td>
            <?php
                    if($item_count == 5) break;
                }
            ?>
            </tr>
        </table>
<?php
        }
    }
?>
    
	<div class="clear">
	</div>
</div>