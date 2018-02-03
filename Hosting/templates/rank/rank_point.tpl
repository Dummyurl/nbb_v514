<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Xếp hạng Point</div>
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
                else echo '<a href="#rank&act=rank_point&thehe='.$i.'" rel="ajax">';
            echo $thehe_choise[$i];
            if($_SESSION['thehe'] == $i ) echo "</font></b>";
                else echo "</a>";
            echo "</td>";
        }
    }
    echo "</tr> </table><hr />";
}
?>
<div class="info">
    <ul>
        <li><strong>Tổng</strong> : Tổng Point nhận được khi Reset lần cuối.</li>
        <li><strong>RS</strong> : Point nhận được khi Reset.</li>
        <li><strong>RSNgày</strong> : Point được thưởng tương ứng với số lần thực hiện Reset của ngày hôm trước.</li>
        <li><strong>Event</strong> : Point nhận được khi tham gia Event Huân Chương.</li>
        <li><strong>SongTu</strong> : Point nhận được từ hệ thống Song Tu.</li>
        <li><strong>TuLuyện</strong> : Point nhận được từ hệ thống Tu Luyện.</li>
        <li>BXH tính theo số Point nhận được khi Reset lần gần nhất so với lúc thời gian cập nhập BXH.</li>
        <li>Do Reset thường và Reset VIP có số Point khác nhau nên BXH chỉ mang tính tạm thời.</li>
    </ul>
</div>
        <center>Cập nhập lúc: <?php echo $time_top; ?> ( 1h cập nhập 1 lần )</center>
    	<center><b><font color="red">Danh sách Cao Thủ Point</font></b></center>
		<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center" scope="col">#</td>
		    <td align="center" scope="col"><b>Nhân vật</b></td>
		    <td align="center" scope="col"><b>Tổng</b></td>
		    <td align="center" scope="col"><b>RS</b></td>
		    <td align="center" scope="col"><b>RSNgày</b></td>
		    <td align="center" scope="col"><b>Event</b></td>
            <td align="center" scope="col"><b>SongTu</b></td>
            <td align="center" scope="col"><b>TuLuyện</b></td>
		  </tr>
<?php 
    if(isset($toppoint_arr[$theheid]) && is_array($toppoint_arr[$theheid])) {
        foreach($toppoint_arr[$theheid] as $tp_k => $tp_v) {
?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $tp_k+1; ?></td>
		    <td align="center"><strong><?php echo $tp_v['name']; ?></strong></td>
            <td align="center"><?php echo number_format($tp_v['total'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo number_format($tp_v['rs'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo number_format($tp_v['rsday'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo number_format($tp_v['event'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo number_format($tp_v['songtu'], 0, ',', '.'); ?></td>
            <td align="center"><?php echo number_format($tp_v['tuluyen'], 0, ',', '.'); ?></td>
		  </tr>
<?php   } } ?>
		</table>


	<div class="clear">
	</div>
</div>
<!-- End Content -->