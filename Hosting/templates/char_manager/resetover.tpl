<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset OVER</div>
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
    		- <strong>Lưu ý : <font color='red'>Reset OVER không tăng Reset thực của nhân vật</font></strong>.<br />
            - Reset OVER sẽ nhận được số điểm Ủy Thác ngẫu nhiên.<br />
            - Số điểm Ủy Thác nhận được tương đương với khi Ủy Thác Offline.<br />
            <font color='blue'><strong>Do vậy, Reset OVER không ảnh hưởng tới TOP <font color='red'>Reset/Relife</font></strong></font>.<br />
            - <strong>Reset OVER </strong> chỉ thực hiện được khi đã <strong>MAX Reset ngày và Reset vượt mức</strong>.<br />
            - Reset OVER được tính vào <b>BXH Điểm Reset</b><br />
    		- Reset OVER được tính vào <b>BXH số lần thực hiện Reset</b>
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
					<td align="center" colspan="2"><b>Điều kiện Reset OVER</b><br /><i><font color='red'>(Màu đỏ là không đủ điều kiện)</font></i></td>
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
					<td><input type="button" name="Submit" value="Thực hiện Reset OVER" id="btn_rs_over" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /> <span id="rs_loading"></span></td>
				</tr>
			</table>
            <div id="rs_err"></div>
    </div>
        <br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="8" align="center">
		    	Jewel cần cho Reset phải được gửi trong <a href="#bank&act=jewel2bank" onclick="$('index2.php?mod=bank&act=jewel2bank','hienthi');">ngân hàng</a><br>
	    	</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center" rowspan="2"><b>Reset</b></td>
		    <td align="center" colspan="5"><b>Điều kiện Reset</b></td>
		    <td align="center"><b>Phần thưởng</b></td>
		  </tr>
          <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Level</b></td>
		    <td align="center"><b>Zen</b></td>
		    <td align="center"><b>Chao</b></td>
		    <td align="center"><b>Create</b></td>
		    <td align="center"><b>Blue</b></td>
		    <td align="center"><b>Điểm Ủy Thác</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_1; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_1, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap1_min. " - ". $uythacpoint_cap1_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_2; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_2, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap2_min. " - ". $uythacpoint_cap2_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_3; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_3, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap3_min. " - ". $uythacpoint_cap3_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_4; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_4, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap4_min. " - ". $uythacpoint_cap4_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_5; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_5, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap5_min. " - ". $uythacpoint_cap5_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_6; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_6, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap6_min. " - ". $uythacpoint_cap6_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_7; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_7, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap7_min. " - ". $uythacpoint_cap7_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_8; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_8, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap8_min. " - ". $uythacpoint_cap8_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_9; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_9, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap9_min. " - ". $uythacpoint_cap9_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_10; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_10, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap10_min. " - ". $uythacpoint_cap10_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_11; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_11, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap11_min. " - ". $uythacpoint_cap11_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_12; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_12, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap12_min. " - ". $uythacpoint_cap12_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_13; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_13, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap13_min. " - ". $uythacpoint_cap13_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_14; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_14, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap14_min. " - ". $uythacpoint_cap14_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_15; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_15, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap15_min. " - ". $uythacpoint_cap15_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_16; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_16, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap16_min. " - ". $uythacpoint_cap16_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_17; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_17, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap17_min. " - ". $uythacpoint_cap17_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_18; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_18, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap18_min. " - ". $uythacpoint_cap18_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_19; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_19, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap19_min. " - ". $uythacpoint_cap19_max; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></div></td>
		    <td><div align="center"><?php echo $level_cap_20; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_20, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $uythacpoint_cap20_min. " - ". $uythacpoint_cap20_max; ?></div></td>
		  </tr>
<?php } ?>
		</table>
        
	<div class="clear">
	</div>
<?php } ?>
</div>
<!-- End Content -->