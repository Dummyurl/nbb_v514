<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">ResetVIP bằng điểm Ủy Thác</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

		<center>
    		<b>Được sử dụng Gcoin Khuyến Mại</b>
    	</center>

    	<blockquote><div align="center">
    		<b>Reset VIP bằng điểm Ủy Thác</b><br>
    		- Không được tính <b><font color='red'>bảng Xếp hạng Điểm Reset</font></b><br />
    		- Không được tính <b><font color='red'>bảng Xếp hạng số lần thực hiện Reset</font></b><br />
    		- Không cần cởi đồ.<br>
    		- Không cần thoát Game.<br>
    		- Không cần đổi nhân vật.<br>
    		Sau khi Reset bằng điểm Ủy Thác nhân vật chỉ tăng số lần Reset, không có Point. Khi thực hiện Reset bằng Jewel hay Reset VIP bằng Gcoin, Vpoint sẽ nhận được số Point tương ứng với cách Reset đó.
    	</div></blockquote>
    	<br>
		
		<form id="reset" name="reset" method="post" action="index.php?mod=char_manager&act=uythac_resetvip">
		  <input type="hidden" name="action" value="uythac_resetvip" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		  <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Reset</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Reset</b></td>
				</tr>
				<tr>
					<td align="right">Reset lần thứ</td>
					<td><?php echo $_SESSION['nv_reset']+1; ?></td>
				</tr>
				<tr>
					<td align="right">Điểm Ủy Thác</td>
					<td><?php echo number_format($_SESSION['nv_point_uythac'], 0, ',', '.') . " / " . number_format($point_uythac, 0, ',', '.')." ($notice_point_uythac)"; ?></td>
				</tr>
				<tr>
					<td align="right">Gcoin</td>
					<td><?php echo "$gcoin_reset_vip ($notice_gcoin)"; ?></td>
				</tr>
				<tr>
					<td align="right">Vpoint</td>
					<td><?php echo "$vpoint_reset_vip ($notice_vpoint)"; ?></td>
				</tr>
				<tr>
					<td align="right">Chọn loại đơn vị Tiền Tệ</td>
					<td>
						<input name="tiente" type="radio" value="gcoin" checked="checked" /> Gcoin
		      			<input type="radio" name="tiente" value="vpoint" /> Vpoint
		      		</td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Thực hiện Reset VIP" onclick="return btn_check_verify(this.form.vImageCodP.value,'msg_vImageCodP');" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> ></td>
				</tr>
			</table>
		</form>
        
        <br /><br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Reset</b></td>
		    <td align="center"><b>Điểm Ủy Thác</b></td>
		    <td align="center"><b>Gcoin</b></td>
		    <td align="center"><b>Vpoint</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_1; ?></td>
		    <td align="center"><?php echo $gcoin_cap_1_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_1_vip = $gcoin_cap_1_vip*(1+$vpoint_extra/100); echo $vpoint_cap_1_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_2; ?></td>
		    <td align="center"><?php echo $gcoin_cap_2_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_2_vip = $gcoin_cap_2_vip*(1+$vpoint_extra/100); echo $vpoint_cap_2_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_3; ?></td>
		    <td align="center"><?php echo $gcoin_cap_3_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_3_vip = $gcoin_cap_3_vip*(1+$vpoint_extra/100); echo $vpoint_cap_3_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_4; ?></td>
		    <td align="center"><?php echo $gcoin_cap_4_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_4_vip = $gcoin_cap_4_vip*(1+$vpoint_extra/100); echo $vpoint_cap_4_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_5; ?></td>
		    <td align="center"><?php echo $gcoin_cap_5_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_5_vip = $gcoin_cap_5_vip*(1+$vpoint_extra/100); echo $vpoint_cap_5_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_6; ?></td>
		    <td align="center"><?php echo $gcoin_cap_6_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_6_vip = $gcoin_cap_6_vip*(1+$vpoint_extra/100); echo $vpoint_cap_6_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_7; ?></td>
		    <td align="center"><?php echo $gcoin_cap_7_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_7_vip = $gcoin_cap_7_vip*(1+$vpoint_extra/100); echo $vpoint_cap_7_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_8; ?></td>
		    <td align="center"><?php echo $gcoin_cap_8_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_8_vip = $gcoin_cap_8_vip*(1+$vpoint_extra/100); echo $vpoint_cap_8_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_9; ?></td>
		    <td align="center"><?php echo $gcoin_cap_9_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_9_vip = $gcoin_cap_9_vip*(1+$vpoint_extra/100); echo $vpoint_cap_9_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_10; ?></td>
		    <td align="center"><?php echo $gcoin_cap_10_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_10_vip = $gcoin_cap_10_vip*(1+$vpoint_extra/100); echo $vpoint_cap_10_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_11; ?></td>
		    <td align="center"><?php echo $gcoin_cap_11_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_11_vip = $gcoin_cap_11_vip*(1+$vpoint_extra/100); echo $vpoint_cap_11_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_12; ?></td>
		    <td align="center"><?php echo $gcoin_cap_12_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_12_vip = $gcoin_cap_12_vip*(1+$vpoint_extra/100); echo $vpoint_cap_12_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_13; ?></td>
		    <td align="center"><?php echo $gcoin_cap_13_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_13_vip = $gcoin_cap_13_vip*(1+$vpoint_extra/100); echo $vpoint_cap_13_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_14; ?></td>
		    <td align="center"><?php echo $gcoin_cap_14_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_14_vip = $gcoin_cap_14_vip*(1+$vpoint_extra/100); echo $vpoint_cap_14_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_15; ?></td>
		    <td align="center"><?php echo $gcoin_cap_15_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_15_vip = $gcoin_cap_15_vip*(1+$vpoint_extra/100); echo $vpoint_cap_15_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_16; ?></td>
		    <td align="center"><?php echo $gcoin_cap_16_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_16_vip = $gcoin_cap_16_vip*(1+$vpoint_extra/100); echo $vpoint_cap_16_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_17; ?></td>
		    <td align="center"><?php echo $gcoin_cap_17_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_17_vip = $gcoin_cap_17_vip*(1+$vpoint_extra/100); echo $vpoint_cap_17_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_18; ?></td>
		    <td align="center"><?php echo $gcoin_cap_18_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_18_vip = $gcoin_cap_18_vip*(1+$vpoint_extra/100); echo $vpoint_cap_18_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_19; ?></td>
		    <td align="center"><?php echo $gcoin_cap_19_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_19_vip = $gcoin_cap_19_vip*(1+$vpoint_extra/100); echo $vpoint_cap_19_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
		    <td align="center"><?php echo $point_uythac_rsvip_cap_20; ?></td>
		    <td align="center"><?php echo $gcoin_cap_20_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_20_vip = $gcoin_cap_20_vip*(1+$vpoint_extra/100); echo $vpoint_cap_20_vip; ?></td>
		  </tr>
<?php } ?>
		</table>
	<div class="clear">
	</div>
</div>
<!-- End Content -->