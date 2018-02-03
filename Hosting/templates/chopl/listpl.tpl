<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Chợ Phúc Lợi >> Danh sách Phúc Lợi đang bán</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    if(isset($error_module)) echo "<div class='error'>$error_module</div>";
?>
<table align='center' width='90%' border='0'>
    <tr>
        <td><font color='blue'><strong>Mua Điểm Phúc Lợi</strong></font></td>
        <td><a href="#chopl&act=banpl" rel="ajax">Bán Điểm Phúc Lợi</a></td>
    </tr>
</table>
<hr />
<ul>
    <li><strong>Điểm Phúc Lợi</strong> nhận được từ <strong><a href="#questdaily" rel="ajax">Nhiệm Vụ Hàng Ngày</a></strong> và Event.</li>
</ul>
<?php
if ($thehe_choise)
{
    echo "<table align='center' width='90%' border='0'> <tr>";
    for($i=count($thehe_choise)-1;$i>0;$i--)
    {
        if(strlen($thehe_choise[$i]) > 0) {
            echo "<td align='center'>";
            if($_SESSION['thehe'] == $i ) echo "<b><font color='red'>";
                else echo '<a href="#chopl&thehe='.$i.'" rel="ajax">';
            echo $thehe_choise[$i];
            if($_SESSION['thehe'] == $i ) echo "</font></b>";
                else echo "</a>";
            echo "</td>";
        }
    }
    echo "</tr> </table><hr />";
}
?>

<center>
    <b>Danh sách cửa hàng Phúc Lợi rẻ nhất đang bán</b>
</center>
<br />
    
    <table width="100%" border="0" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
	    <td align="center" scope="col">#</td>
	    <td align="center" scope="col"><b>Người bán</b></td>
	    <td align="center" scope="col"><b>Điểm PL</b></td>
	    <td align="center" scope="col"><b>Giá</b> (Vpoint)</td>
	    <td align="center" scope="col"><b>Mua</b></td>
	  </tr>
<?php 
if(isset($listpl_arr[$theheid]) && is_array($listpl_arr[$theheid])) {
    foreach($listpl_arr[$theheid] as $pl_k => $pl_v) {
?>
	  <tr bgcolor="#FFFFFF">
	    <td align="center"><?php echo $pl_k+1; ?></td>
	    <td align="center"><strong><?php echo $pl_v['name']; ?></strong></td>
        <td align="center"><?php echo number_format($pl_v['plpoint'], 0, ',', '.'); ?></td>
        <td align="center"><?php echo number_format($pl_v['price'], 0, ',', '.'); ?></td>
        <td align="center"><?php if($pl_v['mystore'] == 1) { echo "Cửa hàng của bạn."; } else { ?><input type="button" class="btn_plmua" id="btn_plmua_<?php echo $pl_v['id']; ?>" value="Mua" store_id="<?php echo $pl_v['id']; ?>" /><br /><span id="muapl_view_<?php echo $pl_v['id']; ?>"></span><?php } ?></td>
	  </tr>
<?php   } } ?>
	</table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->