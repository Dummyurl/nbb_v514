<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
    <div id="rs_content">
    	<blockquote><div align="center">
    		- Reset không cần cởi đồ.<br>
    		- Sau khi Reset hãy vào phần <b><a href="#char_manager&act=rutpoint" rel="ajax">Rút Point</a></b> để lấy Point sử dụng.
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
					<td><strong><?php echo $_SESSION['nv_reset']+1; ?></strong></td>
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
						<?php echo $_SESSION['nv_level'] . " / {$level_show} ({$notice_level})"; ?>
						<?php if($info_hotro == 1) echo "<br>{$notice_hotro}"; ?>
					</td>
				</tr>
				<tr>
					<td align="right">Zen</td>
					<td><?php echo number_format($zen, 0, ',', '.')." ($notice_zen)"; ?></td>
				</tr>
				<tr>
					<td align="right">Chao</td>
					<td><?php echo "$chao ($notice_chao)"; ?></td>
				</tr>
				<tr>
					<td align="right">Creation</td>
					<td><?php echo "$cre ($notice_cre)"; ?></td>
				</tr>
				<tr>
					<td align="right">Blue</td>
					<td><?php echo "$blue ($notice_blue)"; ?></td>
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
					<td align="right">&nbsp;</td>
					<td><input type="button" value="Thực hiện Reset" id="btn_rs" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /> <span id="rs_loading"></span></td>
				</tr>
			</table>
            <div id="rs_err"></div>
    </div>
        <br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="8" align="center">
		    	Jewel cần cho Reset phải được gửi trong <a href="#char_manager&act=jewel2bank" rel="ajax">ngân hàng</a><br>
	    	</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Reset</b></td>
		    <td align="center"><b>Level</b></td>
		    <td align="center"><b>Zen</b></td>
		    <td align="center"><b>Chao</b></td>
		    <td align="center"><b>Create</b></td>
		    <td align="center"><b>Blue</b></td>
		    <td align="center"><b>Point</b></td>
		    <td align="center"><b>Mệnh lệnh</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_1 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_1 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_1, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_1; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_2 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_2 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_2, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_2; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_3 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_3 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_3, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_3; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_4 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_4 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_4, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_4; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_5 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_5 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_5, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_5; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_6 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_6 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_6, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_6; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_7 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_7 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_7, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_7; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_8 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_8 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_8, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_8; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_9 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_9 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_9, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_9; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_10 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_10 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_10, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_10; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_11 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_11 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_11, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_11; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_12 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_12 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_12, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_12; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_13 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_13 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_13, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_13; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_14 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_14 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_14, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_14; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_15 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_15 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_15, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_15; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_16 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_16 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_16, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_16; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_17 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_17 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_17, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_17; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_18 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_18 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_18, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_18; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_19 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_19 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_19, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_19; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></div></td>
		    <td><div align="center"><?php echo "<b>" . abs($level_cap_20 - $level_giam) . "</b> <font size=1>(<i><s>". $level_cap_20 ."</s></i>)</font>"; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_20, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $point_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $ml_cap_20; ?></div></td>
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