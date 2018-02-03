<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">ResetVIP</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
    <div id="rs_content">
    	<center>
    		<b>Reset VIP</b> : LV Reset thấp hơn, Không tốn Jewel, Point và Mệnh Lệnh được hưởng khi Reset cao hơn . Tuy nhiên sẽ phải tốn Gcoin hoặc Vpoint khi Reset.<br />
    		<b>Được sử dụng Gcoin Khuyến Mại</b>
    	</center>
    	

    	<blockquote><div align="center">
    		- Reset không cần cởi đồ.<br>
    		- Sau khi Reset hãy vào phần <b><a href="#char_manager&act=rutpoint" onclick="$('index2.php?mod=char_manager&act=rutpoint','hienthi');">Rút Point</a></b> để lấy Point sử dụng.
    	</div></blockquote>
    	<br />
		
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
					<td align="right">TOP</td>
					<td><strong><?php echo $char_in_top; ?></strong> (TOP lấy tại thời điểm 0h hàng ngày)</td>
				</tr>
                 <?php
                    if($use_gioihanrs[$thehe_choise] == 1) {
                ?>
                <tr>
					<td align="right">Giới hạn Reset</td>
					<td><b><?php echo $gioihanrs; ?></b> lần / ngày</td>
				</tr>
                <?php } ?>
                <?php
                    if($hotrotanthu == 1) {
                ?>
                <tr>
					<td align="right">Hỗ Trợ Tân Thủ</td>
					<td>Giảm <strong><?php echo $level_giam; ?> LV</strong> khi Reset</td>
				</tr>
                <?php } ?>
                <tr>
					<td align="right" valign="top">Cấp độ</td>
					<td>
						<?php echo $_SESSION['nv_level'] . " / {$level_show} ($notice_level)"; ?>
						<?php if($info_hotro == 1) echo "<br>$notice_hotro"; ?>
					</td>
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
					<td align="right">Reset/ngày</td>
					<td><?php echo "$notice_resetday"; ?></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">Thoát Game</td>
					<td><?php echo $online; ?></td>
				</tr>
				<tr>
					<td align="right">Chọn loại đơn vị Tiền Tệ</td>
					<td>
						<input type="radio" name="tiente" value="gcoin" checked="checked" /> Gcoin
		      			<input type="radio" name="tiente" value="vpoint" /> Vpoint
		      		</td>
				</tr>
                <?php if($use_gioihanrs[$thehe_choise]==1 && $use_overrs[$thehe_choise]==1) { ?>
                <tr>
					<td align="right">Reset Vượt Mức</td>
					<td>
                        <i>Cho phép Reset vượt mức quy định trong ngày : <b> <?php echo $overrs_rs[$thehe_choise]; ?> lần Reset </b><br />
                        Bắt buộc phải Reset bằng Gcoin.<br />
                        Chi phí thêm : <b> <?php echo $overrs_gcoin[$thehe_choise]; ?> Gcoin </b></i>
                    </td>
				</tr>
                <?php } ?>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="button" name="Submit" value="Thực hiện Reset VIP" id="btn_rsvip" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /> <span id="rs_loading"></span></td>
				</tr>
			</table>
            <div id="rs_err"></div>
    </div>
        <br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Reset</b></td>
		    <td align="center"><b>Level</b></td>
		    <td align="center"><b>Gcoin</b></td>
		    <td align="center"><b>Vpoint</b></td>
		    <td align="center"><b>Point</b></td>
		    <td align="center"><b>ML</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_1_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_1_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_1_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_1_vip = floor($gcoin_cap_1_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_1_vip; ?></td>
		    <td align="center"><?php echo $point_cap_1_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_1_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_2_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_2_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_2_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_2_vip = floor($gcoin_cap_2_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_2_vip; ?></td>
		    <td align="center"><?php echo $point_cap_2_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_2_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_3_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_3_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_3_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_3_vip = floor($gcoin_cap_3_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_3_vip; ?></td>
		    <td align="center"><?php echo $point_cap_3_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_3_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_4_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_4_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_4_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_4_vip = floor($gcoin_cap_4_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_4_vip; ?></td>
		    <td align="center"><?php echo $point_cap_4_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_4_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_5_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_5_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_5_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_5_vip = floor($gcoin_cap_5_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_5_vip; ?></td>
		    <td align="center"><?php echo $point_cap_5_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_5_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_6_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_6_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_6_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_6_vip = floor($gcoin_cap_6_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_6_vip; ?></td>
		    <td align="center"><?php echo $point_cap_6_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_6_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_7_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_7_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_7_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_7_vip = floor($gcoin_cap_7_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_7_vip; ?></td>
		    <td align="center"><?php echo $point_cap_7_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_7_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_8_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_8_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_8_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_8_vip = floor($gcoin_cap_8_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_8_vip; ?></td>
		    <td align="center"><?php echo $point_cap_8_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_8_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_9_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_9_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_9_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_9_vip = floor($gcoin_cap_9_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_9_vip; ?></td>
		    <td align="center"><?php echo $point_cap_9_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_9_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_10_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_10_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_10_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_10_vip = floor($gcoin_cap_10_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_10_vip; ?></td>
		    <td align="center"><?php echo $point_cap_10_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_10_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_11_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_11_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_11_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_11_vip = floor($gcoin_cap_11_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_11_vip; ?></td>
		    <td align="center"><?php echo $point_cap_11_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_11_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_12_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_12_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_12_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_12_vip = floor($gcoin_cap_12_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_12_vip; ?></td>
		    <td align="center"><?php echo $point_cap_12_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_12_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_13_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_13_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_13_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_13_vip = floor($gcoin_cap_13_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_13_vip; ?></td>
		    <td align="center"><?php echo $point_cap_13_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_13_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_14_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_14_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_14_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_14_vip = floor($gcoin_cap_14_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_14_vip; ?></td>
		    <td align="center"><?php echo $point_cap_14_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_14_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_15_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_15_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_15_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_15_vip = floor($gcoin_cap_15_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_15_vip; ?></td>
		    <td align="center"><?php echo $point_cap_15_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_15_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_16_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_16_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_16_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_16_vip = floor($gcoin_cap_16_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_16_vip; ?></td>
		    <td align="center"><?php echo $point_cap_16_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_16_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_17_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_17_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_17_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_17_vip = floor($gcoin_cap_17_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_17_vip; ?></td>
		    <td align="center"><?php echo $point_cap_17_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_17_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_18_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_18_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_18_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_18_vip = floor($gcoin_cap_18_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_18_vip; ?></td>
		    <td align="center"><?php echo $point_cap_18_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_18_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_19_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_19_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_19_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_19_vip = floor($gcoin_cap_19_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_19_vip; ?></td>
		    <td align="center"><?php echo $point_cap_19_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_19_vip; ?></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
		    <td align="center"><?php echo "<b>" . abs($level_cap_20_vip - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_20_vip ."</s></i>)</font>";; ?></td>
		    <td align="center"><?php echo $gcoin_cap_20_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_20_vip = floor($gcoin_cap_20_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_20_vip; ?></td>
		    <td align="center"><?php echo $point_cap_20_vip; ?></td>
		    <td align="center"><?php echo $ml_cap_20_vip; ?></td>
		  </tr>
<?php } ?>
		</table>
<?php if($use_gioihanrs[$thehe_choise] == 1) { ?>
		<br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="4" align="center">
		    	<b>Giới hạn Reset trong ngày</b><br>
		    	Nhân vật <strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong> đứng TOP <?php echo $char_in_top; ?> được Reset tối đa <b><?php echo $gioihanrs; ?></b> lần / ngày<br />
                <i>(TOP nhân vật tính tại lúc 0h00 hàng ngày)</i>
	    	</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center" rowspan="2"><b>TOP</b></td>
		    <td align="center" colspan="3"><b>Giới hạn số lần Reset/ngày</b></td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Thứ 2 - Thứ 6</b></td>
		    <td align="center"><b>Thứ 7</b></td>
            <td align="center"><b>Chủ Nhật</b></td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 1</td>
		    <td align="center"><?php echo $gioihanrs_top1[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top1[$thehe_choise] + +floor($gioihanrs_top1[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top1[$thehe_choise] + +floor($gioihanrs_top1[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 2</td>
		    <td align="center"><?php echo $gioihanrs_top2[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top2[$thehe_choise] + +floor($gioihanrs_top2[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top2[$thehe_choise] + +floor($gioihanrs_top2[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 3</td>
		    <td align="center"><?php echo $gioihanrs_top3[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top3[$thehe_choise] + +floor($gioihanrs_top3[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top3[$thehe_choise] + +floor($gioihanrs_top3[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 4</td>
		    <td align="center"><?php echo $gioihanrs_top4[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top4[$thehe_choise] + +floor($gioihanrs_top4[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top4[$thehe_choise] + +floor($gioihanrs_top4[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 5-10</td>
		    <td align="center"><?php echo $gioihanrs_top10[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top10[$thehe_choise] + +floor($gioihanrs_top10[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top10[$thehe_choise] + +floor($gioihanrs_top10[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 11-20</td>
		    <td align="center"><?php echo $gioihanrs_top20[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top20[$thehe_choise] + +floor($gioihanrs_top20[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top20[$thehe_choise] + +floor($gioihanrs_top20[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 21-30</td>
		    <td align="center"><?php echo $gioihanrs_top30[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top30[$thehe_choise] + +floor($gioihanrs_top30[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top30[$thehe_choise] + +floor($gioihanrs_top30[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 31-40</td>
		    <td align="center"><?php echo $gioihanrs_top40[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top40[$thehe_choise] + +floor($gioihanrs_top40[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top40[$thehe_choise] + +floor($gioihanrs_top40[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP 41-50</td>
		    <td align="center"><?php echo $gioihanrs_top50[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top50[$thehe_choise] + +floor($gioihanrs_top50[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_top50[$thehe_choise] + +floor($gioihanrs_top50[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center">TOP > 50</td>
		    <td align="center"><?php echo $gioihanrs_other[$thehe_choise]; ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_other[$thehe_choise] + +floor($gioihanrs_other[$thehe_choise] * $overrs_sat_extra[$thehe_choise]/100); ?> lần / ngày</td>
            <td align="center"><?php echo $gioihanrs_other[$thehe_choise] + +floor($gioihanrs_other[$thehe_choise] * $overrs_sun_extra[$thehe_choise]/100); ?> lần / ngày</td>
		  </tr>
        </table>
<?php } ?>

        <?php
            if($hotrotanthu == 1) {
        ?>
        <br />
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