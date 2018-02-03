<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Điểm Danh Vọng >> <font color="red"><?php echo $title_top_class; ?></font></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<?php if(isset($err)) echo "<center><font color='red'><b>$err</b></font></center>"; ?>

<?php 
if(!isset($_GET['action'])) $_GET['action'] = 'daily';
if(!isset($_GET['type'])) $_GET['type'] = 'all';

if ($thehe_choise)
{
    echo "<table align='center' width='90%' border='0'> <tr>";
    for($i=count($thehe_choise)-1;$i>0;$i--)
    {
        if(strlen($thehe_choise[$i]) > 0) {
            echo "<td align='center'>";
            if($_SESSION['thehe'] == $i ) echo "<b><font color='red'>";
                else echo '<a href="#rank&act='. $_GET['act'] .'&action='. $_GET['action'] .'&type='. $_GET['type'] .'&thehe='.$i.'" rel="ajax">';
            echo $thehe_choise[$i];
            if($_SESSION['thehe'] == $i ) echo "</font></b>";
                else echo "</a>";
            echo "</td>";
        }
    }
    echo "</tr> </table>";
}

$style_active_begin = "<b><font color='red'>";
$style_active_end = "</font></b>";
?>
<hr />
    <center><b>Xếp hạng Theo Điểm Danh Vọng 2</b>: </center>
	<b>Điểm danh vọng</b> : Là số điểm nhận được tương ứng với cấp độ (LV) của Nhân vật khi thực hiện Reset, Reset OVER  (Reset Ủy Thác không được tính)<br />
    <font color='red'><strong>BXH Danh Vọng 2</strong></font> tính điểm Danh Vọng từ :
    <ul>
        <li><font color='blue'><strong>Reset</strong></font></li>
        <li><font color='blue'><strong>Reset VIP</strong></font></li>
    </ul>
<center>
	<b>Ngày</b> : 
	<a href="#rank&act=rankpointrs2&action=daily&type=all" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='all') echo $style_active_begin; ?>ALL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='all') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=daily&type=dw" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dw') echo $style_active_begin; ?>DW<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dw') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=daily&type=dk" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dk') echo $style_active_begin; ?>DK<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dk') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=daily&type=elf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='elf') echo $style_active_begin; ?>ELF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='elf') echo $style_active_end; ?></a>
	<?php if(!isset($mg_use) || $mg_use == 1) { ?>
     - <a href="#rank&act=rankpointrs2&action=daily&type=mg" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='mg') echo $style_active_begin; ?>MG<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='mg') echo $style_active_end; ?></a> -
    <?php } ?>
    <?php if(!isset($dl_use) || $dl_use == 1) { ?>
	<a href="#rank&act=rankpointrs2&action=daily&type=dl" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dl') echo $style_active_begin; ?>DL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='dl') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($sum_use) || $sum_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=daily&type=sum" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='sum') echo $style_active_begin; ?>SUM<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='sum') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($rf_use) || $rf_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=daily&type=rf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='rf') echo $style_active_begin; ?>RF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='daily' && $_GET['type']=='rf') echo $style_active_end; ?></a>
	<?php } ?>
	<br />
	<b>Tuần</b> (0h00 T2 - 24h00 CN) : 
	<a href="#rank&act=rankpointrs2&action=week&type=all" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='all') echo $style_active_begin; ?>ALL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='all') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=week&type=dw" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dw') echo $style_active_begin; ?>DW<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dw') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=week&type=dk" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dk') echo $style_active_begin; ?>DK<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dk') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=week&type=elf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='elf') echo $style_active_begin; ?>ELF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='elf') echo $style_active_end; ?></a>
    <?php if(!isset($mg_use) || $mg_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=week&type=mg" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='mg') echo $style_active_begin; ?>MG<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='mg') echo $style_active_end; ?></a>
    <?php } ?>
	<?php if(!isset($dl_use) || $dl_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=week&type=dl" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dl') echo $style_active_begin; ?>DL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='dl') echo $style_active_end; ?></a>
	<?php } ?>
		<?php if(!isset($sum_use) || $sum_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=week&type=sum" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='sum') echo $style_active_begin; ?>SUM<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='sum') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($rf_use) || $rf_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=week&type=rf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='rf') echo $style_active_begin; ?>RF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='week' && $_GET['type']=='rf') echo $style_active_end; ?></a>
	<?php } ?>
	<br />
	<b>Tháng</b> : 
	<a href="#rank&act=rankpointrs2&action=month&type=all" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='all') echo $style_active_begin; ?>ALL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='all') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=month&type=dw" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dw') echo $style_active_begin; ?>DW<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dw') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=month&type=dk" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dk') echo $style_active_begin; ?>DK<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dk') echo $style_active_end; ?></a>
	 - <a href="#rank&act=rankpointrs2&action=month&type=elf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='elf') echo $style_active_begin; ?>ELF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='elf') echo $style_active_end; ?></a>
	<?php if(!isset($mg_use) || $mg_use == 1) { ?>
     - <a href="#rank&act=rankpointrs2&action=month&type=mg" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='mg') echo $style_active_begin; ?>MG<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='mg') echo $style_active_end; ?></a> -
    <?php } ?>
    <?php if(!isset($dl_use) || $dl_use == 1) { ?>
	<a href="#rank&act=rankpointrs2&action=month&type=dl" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dl') echo $style_active_begin; ?>DL<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='dl') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($sum_use) || $sum_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=month&type=sum" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='sum') echo $style_active_begin; ?>SUM<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='sum') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($rf_use) || $rf_use == 1) { ?>
	 - <a href="#rank&act=rankpointrs2&action=month&type=rf" rel="ajax" ><?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='rf') echo $style_active_begin; ?>RF<?php if($_GET['act']=='rankpointrs2' && $_GET['action']=='month' && $_GET['type']=='rf') echo $style_active_end; ?></a>
	<?php } ?>
		<br />
	<hr /><br />
 </center>
 
<center>Cập nhập lúc: <?php echo $time_top; ?> ( 5 phút cập nhập 1 lần )</center><br />
    <?php 
        foreach($rank as $key => $val) {
    ?>
        <center><font color='blue'><?php echo $title_top[$key]; ?></font></center>	
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">#</th>
		    <th align="center" scope="col">Nhân vật</th>
		    <th align="center" scope="col">Điểm Danh Vọng</th>
		    <th align="center" scope="col">Lớp nhân vật</th>
            <th align="center" scope="col">Thế hệ</th>
		  </tr>
<?php foreach($val as $key2 => $val2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $key2+1; ?></td>
		    <td align="center"><?php echo $val2['name']; ?></td>
		    <td align="center"><?php echo $val2['reset_score']; ?></td>
		    <td align="center"><?php echo $val2['class']; ?></td>
            <td align="center"><?php echo $val2['thehe']; ?></td>
		  </tr>
<?php } ?>
		</table>
        <br /><br />
    <?php 
        }
    ?>
<div class="clear">
	</div>
</div>
<!-- End Content -->