<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Song Tu</div>
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
                else echo '<a href="#rank&act=rank_songtu&thehe='.$i.'" rel="ajax">';
            echo $thehe_choise[$i];
            if($_SESSION['thehe'] == $i ) echo "</font></b>";
                else echo "</a>";
            echo "</td>";
        }
    }
    echo "</tr> </table><hr />";
}
?>
        <center>Cập nhập lúc: <?php echo $time_top; ?> ( 1h cập nhập 1 lần )</center>
    	<center><b><font color="red">Danh sách TOP Cặp Đôi Cao Thủ</font></b></center>
		<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center" scope="col">#</td>
		    <td align="center" scope="col"><b>Nhân vật</b></td>
		    <td align="center" scope="col"><b>Cấp Độ Song Tu</b></td>
            <td align="center" scope="col"><b>Point Song Tu</b></td>
		    <td align="center" scope="col"><b>Bạn Đời</b></td>
		  </tr>
<?php 
    if(isset($topsongtu_arr[$theheid]) && is_array($topsongtu_arr[$theheid])) {
        foreach($topsongtu_arr[$theheid] as $tst_k => $tst_v) {
?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $tst_k+1; ?></td>
		    <td align="center"><strong><?php echo $tst_v['name']; ?></strong></td>
            <td align="center"><?php echo $tst_v['songtu_lv']; ?></td>
            <td align="center"><?php echo $songtu_pointpercent*(1 + $tst_v['songtu_lv']); ?> % Point Reset</td>
            <td align="center"><?php echo $tst_v['vochong']; ?></td>
		  </tr>
<?php   } } ?>
		</table>


	<div class="clear">
	</div>
</div>
<!-- End Content -->