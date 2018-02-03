<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset VIP OVER</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php
    if($use_gioihanrs[$thehe_choise] != 1) {
        echo "<center><b><font color='red'>Chức năng không được sử dụng do chưa bật Giới Hạn Reset</font></b></center><br />";
    } else {
?>
    <div id="rs_content">
    	<div align="left">
    		- <strong>Lưu ý : <font color='red'>Reset OVER VIP không tăng Reset thực của nhân vật</font></strong>.<br />
            - Reset OVER VIP sẽ nhận được số điểm Ủy Thác ngẫu nhiên.<br />
            - Số điểm Ủy Thác nhận được tương đương với khi Ủy Thác Offline.<br />
            <font color='blue'><strong>Do vậy, Reset OVER VIP không ảnh hưởng tới TOP <font color='red'>Reset/Relife</font></strong></font>.<br />
            - <strong>Reset OVER VIP</strong> chỉ thực hiện được khi đã <strong>MAX Reset ngày và Reset vượt mức</strong>.<br />
            - Reset OVER VIP được tính vào <b>BXH Điểm Reset</b><br />
    		- Reset OVER VIP được tính vào <b>BXH số lần thực hiện Reset</b>
    	</div>

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
					<td align="center" colspan="2"><b>Điều kiện Reset VIP OVER</b><br /><i><font color='red'>(Màu đỏ là không đủ điều kiện)</font></i></td>
				</tr>
				<tr>
					<td align="right">Reset lần thứ</td>
					<td><?php echo $_SESSION['nv_reset']+1; ?></td>
				</tr>
				<tr>
					<td align="right" valign="top">Cấp độ</td>
					<td>
						<?php echo $_SESSION['nv_level'] . " / {$level} ($notice_level)"; ?>
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
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="button" name="Submit" value="Thực hiện Reset VIP OVER" id="btn_rs_over_vip" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /> <span id="rs_loading"></span></td>
				</tr>
			</table>
            <div id="rs_err"></div>
    </div>
        <br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td align="center" rowspan="2"><b>Reset</b></td>
		    <td align="center" colspan="3"><b>Điều kiện Reset</b></td>
		    <td align="center"><b>Phần thưởng</b></td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Level</b></td>
		    <td align="center"><b>Gcoin</b></td>
		    <td align="center"><b>Vpoint</b></td>
		    <td align="center"><b>Điểm Ủy Thác</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
		    <td align="center"><?php echo $level_cap_1_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_1_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_1_vip = floor($gcoin_cap_1_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_1_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap1_min. " - ". $uythacpoint_cap1_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
		    <td align="center"><?php echo $level_cap_2_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_2_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_2_vip = floor($gcoin_cap_2_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_2_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap2_min. " - ". $uythacpoint_cap2_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
		    <td align="center"><?php echo $level_cap_3_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_3_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_3_vip = floor($gcoin_cap_3_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_3_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap3_min. " - ". $uythacpoint_cap3_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
		    <td align="center"><?php echo $level_cap_4_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_4_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_4_vip = floor($gcoin_cap_4_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_4_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap4_min. " - ". $uythacpoint_cap4_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
		    <td align="center"><?php echo $level_cap_5_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_5_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_5_vip = floor($gcoin_cap_5_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_5_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap5_min. " - ". $uythacpoint_cap5_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
		    <td align="center"><?php echo $level_cap_6_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_6_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_6_vip = floor($gcoin_cap_6_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_6_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap6_min. " - ". $uythacpoint_cap6_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
		    <td align="center"><?php echo $level_cap_7_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_7_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_7_vip = floor($gcoin_cap_7_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_7_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap7_min. " - ". $uythacpoint_cap7_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
		    <td align="center"><?php echo $level_cap_8_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_8_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_8_vip = floor($gcoin_cap_8_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_8_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap8_min. " - ". $uythacpoint_cap8_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
		    <td align="center"><?php echo $level_cap_9_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_9_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_9_vip = floor($gcoin_cap_9_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_9_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap9_min. " - ". $uythacpoint_cap9_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
		    <td align="center"><?php echo $level_cap_10_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_10_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_10_vip = floor($gcoin_cap_10_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_10_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap10_min. " - ". $uythacpoint_cap10_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
		    <td align="center"><?php echo $level_cap_11_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_11_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_11_vip = floor($gcoin_cap_11_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_11_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap11_min. " - ". $uythacpoint_cap11_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
		    <td align="center"><?php echo $level_cap_12_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_12_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_12_vip = floor($gcoin_cap_12_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_12_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap12_min. " - ". $uythacpoint_cap12_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
		    <td align="center"><?php echo $level_cap_13_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_13_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_13_vip = floor($gcoin_cap_13_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_13_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap13_min. " - ". $uythacpoint_cap13_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
		    <td align="center"><?php echo $level_cap_14_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_14_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_14_vip = floor($gcoin_cap_14_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_14_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap14_min. " - ". $uythacpoint_cap14_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
		    <td align="center"><?php echo $level_cap_15_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_15_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_15_vip = floor($gcoin_cap_15_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_15_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap15_min. " - ". $uythacpoint_cap15_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
		    <td align="center"><?php echo $level_cap_16_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_16_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_16_vip = floor($gcoin_cap_16_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_16_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap16_min. " - ". $uythacpoint_cap16_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
		    <td align="center"><?php echo $level_cap_17_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_17_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_17_vip = floor($gcoin_cap_17_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_17_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap17_min. " - ". $uythacpoint_cap17_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
		    <td align="center"><?php echo $level_cap_18_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_18_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_18_vip = floor($gcoin_cap_18_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_18_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap18_min. " - ". $uythacpoint_cap18_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
		    <td align="center"><?php echo $level_cap_19_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_19_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_19_vip = floor($gcoin_cap_19_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_19_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap19_min. " - ". $uythacpoint_cap19_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
		    <td align="center"><?php echo $level_cap_20_vip; ?></td>
		    <td align="center"><?php echo $gcoin_cap_20_vip; ?></td>
		    <td align="center"><?php $vpoint_cap_20_vip = floor($gcoin_cap_20_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_20_vip; ?></td>
		    <td><div align="center"><?php echo $uythacpoint_cap20_min. " - ". $uythacpoint_cap20_max; ?></div></td>
		  </tr>
<?php } ?>
		</table>
        
        
	<div class="clear">
	</div>
<?php } ?>
</div>
<!-- End Content -->