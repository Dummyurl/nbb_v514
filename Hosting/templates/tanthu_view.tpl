<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Hỗ trợ Tân Thủ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    
<?php
        if($hotrotanthu == 1) {
?>
<table width="100%" border="0" bgcolor="#9999FF">
    <tr bgcolor="#FFFFFF">
        <td colspan="2" align="center">
        	<b>Tân Thủ Được giảm cấp độ khi Reset</b>
        </td>
    </tr>
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>Nhân vật thuộc TOP</b></td>
        <td align="center"><b>Cấp độ khi Reset được giảm</b></td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 2</b></td>
        <td align="center">Giảm <b><?php echo $top2_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 3</b></td>
        <td align="center">Giảm <b><?php echo $top3_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 4</b></td>
        <td align="center">Giảm <b><?php echo $top4_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 5-10</b></td>
        <td align="center">Giảm <b><?php echo $top10_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 11-20</b></td>
        <td align="center">Giảm <b><?php echo $top20_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 21-30</b></td>
        <td align="center">Giảm <b><?php echo $top30_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 31-40</b></td>
        <td align="center">Giảm <b><?php echo $top40_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP 41-50</b></td>
        <td align="center">Giảm <b><?php echo $top50_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
    <tr bgcolor="#FFFFFF">
        <td align="center"><b>TOP ngoài 50</b></td>
        <td align="center">Giảm <b><?php echo $top50_over_rsredure; ?></b> LV khi Reset</td>
    </tr>
    
</table>
<?php
        }
?>
    
    <div class="clear">
	</div>
</div>
<!-- End Content -->