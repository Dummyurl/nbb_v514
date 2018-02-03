<?php if (isset($_SESSION[mu_nvchon])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event >> Nhận Giải Thưởng Event</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center>";
?>
<center><b>Item đạt giải thưởng</b></center>
    
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Thông tin</b></td>
            <td align="center"></td>
        </tr>
        <?php 
            if(count($listitem_arr) > 0) {
            foreach($listitem_arr as $item) { 
                
        ?>
        <tr bgcolor="#FFFFFF">
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['item_image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212">
                <?php echo $item['item_info']; ?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td align="center" colspan="2" id="td_<?php echo $item['award_id']; ?>">
                Giải Thưởng : <strong><?php echo $item['award_info']; ?></strong><br />
                Số lượng Item : <strong><?php echo $item['item_slg']; ?></strong><br />
                
                <?php if($item['status'] == 0) { ?>
                    <span id="award_receive_<?php echo $item['award_id']; ?>">
                    <input type="button" award_id='<?php echo $item['award_id']; ?>' class="award_receive" <?php if($accept == 0) echo "disabled='disabled' value='Để Nhận Item cần Thoát Game'"; else echo "value='Nhận Item'"; ?> /> <span id="loading_<?php echo $item['award_id']; ?>"></span><br /> <span id="err_<?php echo $item['award_id']; ?>"  style="color:#FF0000"></span>
                    </span>
                <?php } else { ?> 
                    Đã nhận lúc : <strong><?php echo $item['receive_time']; ?></strong>
                <?php } ?>
                <br /><br />
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item đạt giải Event</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>