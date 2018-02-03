<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Tiền Tệ >> Đổi Vpoint sang Gcoin</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<form id="gcoin2vpoint" name="gcoin2vpoint" method="post" action="index.php?mod=tiente&act=vpoint2gcoin">
				<center>
                    <b>Tỷ giá : số Gcoin nhận được = 80% số V.Point</b><br />
                    Vpoint tối đa có thể đổi : <?php echo floor($_SESSION['acc_vpoint']/10)*10; ?> Vpoint
                
                </center>
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td align="right">Vpoint</td>
				<td><input type="text" name="vpoint" id="vpoint" size="14" maxlength="10"/> -> Gcoin</td>
			</tr>
			<tr>
				<td align="right">Mật khẩu cấp 2</td>
				<td><input type="password" name="pass2" size="14" maxlength="32"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Đổi V.Point sang Gcoin" /></td>
			</tr>
	  	</table>
<input type="hidden" name="action" value="vpoint2gcoin" />
</form>
	<div class="clear">
	</div>
</div>
<!-- End Content -->