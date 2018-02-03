<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Đại anh hùng >> <font color="red"><?php echo $title_top; ?></font></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

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
<center>
	<hr />
    <b>Theo Reset / Relife</b>: <br />
	<a href="#rank&act=ranking" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type'] == 'all') echo $style_active_begin; ?>TOP ALL<?php if($_GET['act']=='ranking' && $_GET['type'] == 'all') echo $style_active_end; ?></a>
	 - <a href="#rank&act=ranking&type=DW" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='DW') echo $style_active_begin; ?>DW<?php if($_GET['act']=='ranking' && $_GET['type']=='DW') echo $style_active_end; ?></a>
	 - <a href="#rank&act=ranking&type=DK" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='DK') echo $style_active_begin; ?>DK<?php if($_GET['act']=='ranking' && $_GET['type']=='DK') echo $style_active_end; ?></a>
	 - <a href="#rank&act=ranking&type=ELF" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='ELF') echo $style_active_begin; ?>ELF<?php if($_GET['act']=='ranking' && $_GET['type']=='ELF') echo $style_active_end; ?></a>
	<?php if(!isset($mg_use) || $mg_use == 1) { ?>
	 - <a href="#rank&act=ranking&type=MG" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='MG') echo $style_active_begin; ?>MG<?php if($_GET['act']=='ranking' && $_GET['type']=='MG') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($dl_use) || $dl_use == 1) { ?>
	 - <a href="#rank&act=ranking&type=DL" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='DL') echo $style_active_begin; ?>DL<?php if($_GET['act']=='ranking' && $_GET['type']=='DL') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($sum_use) || $sum_use == 1) { ?>
	 - <a href="#rank&act=ranking&type=SuM" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='SuM') echo $style_active_begin; ?>SUM<?php if($_GET['act']=='ranking' && $_GET['type']=='SuM') echo $style_active_end; ?></a>
	<?php } ?>
	<?php if(!isset($rf_use) || $rf_use == 1) { ?>
	 - <a href="#rank&act=ranking&type=RF" rel="ajax" ><?php if($_GET['act']=='ranking' && $_GET['type']=='RF') echo $style_active_begin; ?>RF<?php if($_GET['act']=='ranking' && $_GET['type']=='RF') echo $style_active_end; ?></a>
	<?php } ?>
	
	<br />
	<hr /><br />
 </center>
    
    
<center>Cập nhập lúc: <?php echo $time_top; ?> ( 5 phút cập nhập 1 lần )</center>
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">#</th>
		    <th align="center" scope="col">Nhân vật</th>
		    <th align="center" scope="col"><font color="red">RL</font>/<font color="blue">RS</font>/LV</th>
		    <th align="center" scope="col">Lớp nhân vật</th>
            <th align="center" scope="col">Đổi Giới Tính Lúc</th>
            <th align="center" scope="col">Thế hệ</th>
		  </tr>
<?php for($i=0;$i<count($char);$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $j=$i+1; echo $j; ?></td>
		    <td align="center"><?php echo $char[$i]['name']; ?></td>
		    <td align="center"><font color="red"><?php echo $char[$i]['relife']; ?></font> / <font color="blue"><?php echo $char[$i]['reset']; ?></font>/<?php echo $char[$i]['level']; ?></td>
		    <td align="center"><?php echo $char[$i]['nvclass']; ?></td>
            <td align="center"><?php echo $char[$i]['dgt_time']; ?></td>
            <td align="center"><?php echo $char[$i]['thehe']; ?></td>
		  </tr>
<?php } ?>
		</table>

<div class="clear">
	</div>
</div>
<!-- End Content -->