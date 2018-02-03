<?php if (isset($_SESSION[mu_nvchon])) { ?>
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
<center><b>Item đã đăng ký</b></center>
    
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
            <td align="center" bgcolor="#121212">
                <font color='pink'>Đăng ký : <?php echo $item['time_reg']; ?> </font><br />
                <?php echo $item['info']; ?>
            </td>
            <?php if($item['status'] == 0) { ?>
            <td align="center" id="td_<?php echo $item['seri']; ?>">
                <a href="#" serial='<?php echo $item['seri']; ?>' class="epitem_update" >Xác nhận hoàn thành Event</a> <span id="loading_<?php echo $item['seri']; ?>"></span><br /> <span id="err_<?php echo $item['seri']; ?>"  style="color:#FF0000"></span>
            </td>
            <?php } else { ?> 
            <td align="center" bgcolor="#121212">
                <font color='yellow'>Hoàn thành : <?php echo $item['time_finish']; ?> </font><br />
                <?php 
                    echo $item['info']; 
                ?>
            </td>
            <?php } ?>
            
        </tr>
        <?php } } else echo "<center><font color='red'><strong>Không có Item đăng ký</strong></font></center>"; ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>