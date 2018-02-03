<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset bằng điểm Ủy Thác</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    	<blockquote><div align="center">
    		<b>Reset bằng điểm Ủy Thác</b><br>
    		- Không được tính <b><font color='red'>bảng Xếp hạng Điểm Reset</font></b><br />
    		- Không được tính <b><font color='red'>bảng Xếp hạng số lần thực hiện Reset</font></b><br />
    		- Không cần cởi đồ.<br>
    		- Không cần thoát Game<br>
    		Sau khi Reset bằng điểm Ủy Thác nhân vật chỉ tăng số lần Reset, không có Point. Khi thực hiện Reset bằng Jewel hay Reset VIP bằng Gcoin, Vpoint sẽ nhận được số Point tương ứng với cách Reset đó.
    	</div></blockquote>
    	<br>
    	<form id="uythac_reset" name="uythac_reset" method="post" action="index.php?mod=char_manager&act=uythac_reset">
			<input type="hidden" name="action" value="uythac_reset" />
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
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Thực hiện Reset" onclick="return btn_check_verify(this.form.vImageCodP.value,'msg_vImageCodP');" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> ></td>
				</tr>
			</table>
		</form>
        
        <br /><br />
        <table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <td colspan="8" align="center">
		    	Jewel cần cho Reset phải được gửi trong <a href="#bank&act=jewel2bank" onclick="$('index2.php?mod=bank&act=jewel2bank','hienthi');">ngân hàng</a><br>
	    	</td>
		  </tr>
		  <tr bgcolor="#FFFFFF">
		    <td align="center"><b>Reset</b></td>
		    <td align="center"><b>Điểm Ủy Thác</b></td>
		    <td align="center"><b>Zen</b></td>
		    <td align="center"><b>Chao</b></td>
		    <td align="center"><b>Create</b></td>
		    <td align="center"><b>Blue</b></td>
		  </tr>
<?php if ($cap_reset_max>0) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_1; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_1, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_1; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_1; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_2; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_2, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_2; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_2; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_3; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_3, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_3; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_3; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_4; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_4, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_4; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_4; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_5; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_5, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_5; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_5; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_6; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_6, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_6; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_6; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_7; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_7, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_7; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_7; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_8; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_8, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_8; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_8; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_9; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_9, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_9; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_9; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_10; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_10, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_10; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_10; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_11; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_11, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_11; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_11; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_12; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_12, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_12; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_12; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_13; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_13, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_13; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_13; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_14; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_14, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_14; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_14; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_15; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_15, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_15; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_15; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_16; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_16, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_16; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_16; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_17; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_17, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_17; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_17; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_18; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_18, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_18; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_18; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_19; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_19, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_19; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_19; ?></div></td>
		  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
		  <tr bgcolor="#FFFFFF">
		    <td><div align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></div></td>
		    <td><div align="center"><?php echo $point_uythac_rs_cap_20; ?></div></td>
		    <td><div align="center"><?php echo number_format($zen_cap_20, 0, ',', '.'); ?></div></td>
		    <td><div align="center"><?php echo $chao_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $cre_cap_20; ?></div></td>
		    <td><div align="center"><?php echo $blue_cap_20; ?></div></td>
		  </tr>
<?php } ?>
		</table>
	<div class="clear">
	</div>
</div>
<!-- End Content -->