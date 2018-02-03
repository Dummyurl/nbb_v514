<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title"><?php echo $name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php
if ($thehe_choise)
{
    echo "<table align='center' width='90%' border='0'> <tr>";
    for($i=count($thehe_choise)-1;$i>0;$i--)
    {
        if(strlen($thehe_choise[$i]) > 0) {
            echo "<td align='center'>";
            if($_SESSION['thehe'] == $i ) echo "<b><font color='red'>";
                else echo '<a href="#event&act='. $_GET['act'] .'&thehe='.$i.'" rel="ajax" >';
            echo $thehe_choise[$i];
            if($_SESSION['thehe'] == $i ) echo "</font></b>";
                else echo "</a>";
            echo "</td>";
        }
    }
    echo "</tr> </table>";
}
?>
		<center>
			Thời gian diễn ra Event : <b>0h00 <?php echo $time_begin; ?></b> đến <b>24h00 <?php echo $time_end; ?></b><br>
    		Cập nhập lúc: <?php echo $time_top; ?> ( 5 phút cập nhập 1 lần )
    	</center>
    		
    	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th align="center" scope="col">#</th>
		    <th align="center" scope="col"><?php echo $info1_name; ?></th>
		    <th align="center" scope="col"><?php echo $info2_name; ?></th>
		  </tr>
<?php if(isset($info) && is_array($info)) { for($i=0;$i<count($info);$i++) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $i+1; ?></td>
		    <td align="center"><?php echo $info[$i]['info1']; ?></td>
		    <td align="center"><?php echo $info[$i]['info2']; ?></td>
		  </tr>
<?php } } ?>
		</table>

	<div class="clear">
	</div>
</div>
<!-- End Content -->