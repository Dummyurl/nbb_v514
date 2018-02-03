<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event >> <?php echo $event_epitem_name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    include('templates/event/event_epitem_head.tpl'); 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center>";
?>
<center><b>Đăng ký Item tham gia Event</b></center>
    
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
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $item['image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212"><?php echo $item['info']; ?></td>
            <td align="center" id="td_<?php echo $item['serial']; ?>">
                <?php 
                    if($item['reged'] == 0) {
                        if($item['item_spec'] == 1 || $item['item_spec'] == 3) {
                            echo "<s>Item đặc biệt không thể tham gia</s>";
                        } else if($item['item_spec'] == 2) {
                            echo "<s>Item đã bảo vệ không được tham gia</s>";
                        } else {
                            
                        
                ?>
                            <a href="#" serial='<?php echo $item['serial']; ?>' class="epitem_reg" >Đăng ký</a> <span id="loading_<?php echo $item['serial']; ?>"></span><br /> <span id="err_<?php echo $item['serial']; ?>"  style="color:#FF0000"></span>
                <?php } } else { echo "<s>Item đã đăng ký</s>"; } ?>
            </td>
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item hợp lệ</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>