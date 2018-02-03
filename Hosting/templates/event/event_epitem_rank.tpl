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
<center><b>Xếp hạng Event <?php echo $event_epitem_name; ?></b></center>
    <br /><br />
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center" colspan="2"><b><font color='blue'>Xếp hạng theo số lượng Item Ép Thành Công</font></b></td>
        </tr>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Nhân Vật</b></td>
            <td align="center"><b>Số lượng Item Ép thành công</b></td>
        </tr>
        <?php 
            $tr_bgcolor1 = "#FFFFFF";
            $tr_bgcolor2 = "#FFCCFF";
            $tr_bgcolor = $tr_bgcolor1;
            if(isset($list_rank_slg_arr) && is_array($list_rank_slg_arr)) {
                foreach($list_rank_slg_arr as $rank_slg) { 
        ?>
        <tr bgcolor="<?php echo $tr_bgcolor; ?>">
            <td align="center"><strong><?php echo $rank_slg['name']; ?></strong></td>
            <td align="center"><?php echo $rank_slg['count']; ?></td>
        </tr>
        <?php 
                if($tr_bgcolor == $tr_bgcolor1) $tr_bgcolor = $tr_bgcolor2;
                else $tr_bgcolor = $tr_bgcolor1;
                }
            }
        ?>
    </table>
    <br />
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF" class='item_form'>
        <tr bgcolor="#FFFF00">
            <td align="center" colspan="4"><b><font color='blue'>Xếp hạng theo Thời gian Item Ép Thành Công Sớm nhất</font></b></td>
        </tr>
        <tr bgcolor="#FFFF00">
            <td align="center"><b>Nhân Vật</b></td>
            <td align="center"><b>Hình Ảnh</b></td>
            <td align="center"><b>Item đăng ký</b></td>
            <td align="center"><b>Item Hoàn Thành</b></td>
        </tr>
        <?php 
            $trname_bgcolor1 = "#FFFFFF";
            $trname_bgcolor2 = "#FFCCFF";
            $trname_bgcolor = $trname_bgcolor1;
            if(isset($list_rank_ear_arr) && is_array($list_rank_ear_arr)) {
                foreach($list_rank_ear_arr as $rank_ear) {
        ?>
        <tr bgcolor="#FFFFFF">
            <td align="center" bgcolor="<?php echo $trname_bgcolor; ?>"><strong><?php echo $rank_ear['name']; ?></strong></td>
            <td align="center" bgcolor="#121212"><img src="items/<?php echo $rank_ear['image']; ?>.gif"></td>
            <td align="center" bgcolor="#121212">
                <font color='pink'>Đăng ký : <?php echo $rank_ear['time_reg']; ?> </font><br />
                <?php echo $rank_ear['info']; ?>
            </td>
            <td align="center" bgcolor="#121212">
                <font color='yellow'>Hoàn thành : <?php echo $rank_ear['time_finish']; ?> </font><br />
                <?php echo $rank_ear['infoend']; ?>
            </td>
        </tr>
        <?php 
                    if($trname_bgcolor == $trname_bgcolor1) $trname_bgcolor = $trname_bgcolor2;
                    else $trname_bgcolor = $trname_bgcolor1;
                }
            }
        ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->