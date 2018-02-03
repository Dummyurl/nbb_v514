<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Chợ Phúc Lợi >> Bán Điểm Phúc Lợi</div>
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
        <td><a href="#chopl" rel="ajax">Mua Điểm Phúc Lợi</a></td>
        <td><font color='blue'><strong>Bán Điểm Phúc Lợi</strong></font></td>
    </tr>
</table>
<hr />
<center>
    <div class="info"><strong>Điểm Phúc Lợi hiện có : <font color="red"><span id="plpoint"><?php echo $mypl; ?></span></font></strong></div>

<br />
    Bán <input type="text" id="plpoint_ban" size="2" maxlength="3" />Điểm Phúc Lợi giá <input type="text" id="plpoint_vpoint" size="5" maxlength="6" /> Vpoint <input type="button" id="btn_pl_ban" value="Bán Phúc Lợi" /> <span id="banpl_loading"></span>
</center>
    <div id="banpl_view"></div>
    
    <?php if(count($mystore_arr) > 0) { ?>
    <br /><br />
    <center><strong>Cửa hàng Phúc Lợi của bạn</strong></center>
    <table width="100%" border="0" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
	    <td align="center" scope="col">#</td>
	    <td align="center" scope="col"><b>Điểm PL</b></td>
	    <td align="center" scope="col"><b>Giá</b> (Vpoint)</td>
	    <td align="center" scope="col"><b>Mua</b></td>
	  </tr>
<?php 
    foreach($mystore_arr as $store_k => $store_v) {
?>
	  <tr bgcolor="#FFFFFF">
	    <td align="center"><?php echo $store_k+1; ?></td>
        <td align="center"><?php echo number_format($store_v['plpoint'], 0, ',', '.'); ?></td>
        <td align="center"><?php echo number_format($store_v['price'], 0, ',', '.'); ?></td>
        <td align="center" id="td_huyban_<?php echo $store_v['id']; ?>"><?php echo $store_v['info'] . $store_v['huyban']; ?></td>
	  </tr>
<?php   } ?>
	</table>
    <?php } ?>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->