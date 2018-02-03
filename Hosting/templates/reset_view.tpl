<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Điệu kiện Reset</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    <center><strong>Bảng cấp độ Reset</strong></center>
    <table width="100%" border="0" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
	    <td align="center" rowspan="2"><b>Reset</b></td>
	    <td align="center" colspan="10"><b>Level Reset theo TOP</b></td>
	  </tr>
      <tr bgcolor="#FFFFFF">
	    <td align="center" class="col_odd"><b>1</b></td>
	    <td align="center"><b>2</b></td>
	    <td align="center" class="col_odd"><b>3</b></td>
	    <td align="center"><b>4</b></td>
	    <td align="center" class="col_odd"><b>5-10</b></td>
	    <td align="center"><b>11-20</b></td>
	    <td align="center" class="col_odd"><b>21-30</b></td>
	    <td align="center"><b>31-40</b></td>
        <td align="center" class="col_odd"><b>41-50</b></td>
        <td align="center"><b>>50</b></td>
	  </tr>
<?php if ($cap_reset_max>0) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_1; ?></div></td>
        <td><div align="center"><?php echo $level_cap_1-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_1-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_1-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_1-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_1-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_1-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_1-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_1-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_1-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>1) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_2; ?></div></td>
        <td><div align="center"><?php echo $level_cap_2-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_2-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_2-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_2-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_2-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_2-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_2-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_2-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_2-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>2) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_3; ?></div></td>
        <td><div align="center"><?php echo $level_cap_3-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_3-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_3-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_3-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_3-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_3-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_3-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_3-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_3-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>3) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_4; ?></div></td>
        <td><div align="center"><?php echo $level_cap_4-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_4-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_4-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_4-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_4-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_4-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_4-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_4-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_4-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>4) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_5; ?></div></td>
        <td><div align="center"><?php echo $level_cap_5-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_5-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_5-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_5-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_5-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_5-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_5-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_5-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_5-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>5) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_6; ?></div></td>
        <td><div align="center"><?php echo $level_cap_6-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_6-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_6-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_6-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_6-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_6-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_6-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_6-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_6-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>6) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_7; ?></div></td>
        <td><div align="center"><?php echo $level_cap_7-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_7-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_7-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_7-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_7-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_7-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_7-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_7-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_7-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>7) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_8; ?></div></td>
        <td><div align="center"><?php echo $level_cap_8-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_8-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_8-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_8-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_8-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_8-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_8-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_8-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_8-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>8) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_9; ?></div></td>
        <td><div align="center"><?php echo $level_cap_9-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_9-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_9-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_9-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_9-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_9-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_9-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_9-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_9-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>9) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_10; ?></div></td>
        <td><div align="center"><?php echo $level_cap_10-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_10-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_10-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_10-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_10-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_10-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_10-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_10-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_10-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>10) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_11; ?></div></td>
        <td><div align="center"><?php echo $level_cap_11-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_11-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_11-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_11-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_11-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_11-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_11-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_11-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_11-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>11) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_12; ?></div></td>
        <td><div align="center"><?php echo $level_cap_12-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_12-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_12-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_12-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_12-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_12-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_12-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_12-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_12-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>12) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_13; ?></div></td>
        <td><div align="center"><?php echo $level_cap_13-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_13-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_13-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_13-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_13-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_13-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_13-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_13-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_13-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>13) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_14; ?></div></td>
        <td><div align="center"><?php echo $level_cap_14-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_14-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_14-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_14-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_14-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_14-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_14-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_14-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_14-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>14) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_15; ?></div></td>
        <td><div align="center"><?php echo $level_cap_15-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_15-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_15-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_15-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_15-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_15-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_15-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_15-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_15-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>15) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_16; ?></div></td>
        <td><div align="center"><?php echo $level_cap_16-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_16-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_16-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_16-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_16-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_16-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_16-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_16-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_16-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>16) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_17; ?></div></td>
        <td><div align="center"><?php echo $level_cap_17-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_17-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_17-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_17-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_17-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_17-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_17-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_17-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_17-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>17) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_18; ?></div></td>
        <td><div align="center"><?php echo $level_cap_18-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_18-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_18-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_18-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_18-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_18-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_18-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_18-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_18-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>18) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_19; ?></div></td>
        <td><div align="center"><?php echo $level_cap_19-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_19-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_19-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_19-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_19-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_19-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_19-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_19-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_19-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
<?php if ($cap_reset_max>19) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></div></td>
	    <td><div align="center" class="col_odd"><?php echo $level_cap_20; ?></div></td>
        <td><div align="center"><?php echo $level_cap_20-$top2_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_20-$top3_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_20-$top4_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_20-$top10_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_20-$top20_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_20-$top30_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_20-$top40_rsredure; ?></div></td>
        <td><div align="center" class="col_odd"><?php echo $level_cap_20-$top50_rsredure; ?></div></td>
        <td><div align="center"><?php echo $level_cap_20-$top50_over_rsredure; ?></div></td>
	  </tr>
<?php } ?>
	</table>
    <br />
    <center><strong>Bảng điều kiện và Phần thưởng Reset</strong></center>
    <table width="100%" border="0" bgcolor="#9999FF">
	  <tr bgcolor="#FFFFFF">
	    <td align="center" rowspan="2"><b>Reset</b></td>
	    <td align="center" colspan="5"><b>Yêu cầu cần</b></td>
	    <td align="center" colspan="2"><b>Phần thưởng</b></td>
	  </tr>
      <tr bgcolor="#FFFFFF">
	    <td align="center"><b>Zen</b></td>
	    <td align="center"><b>Chao</b></td>
	    <td align="center"><b>Create</b></td>
	    <td align="center"><b>Blue</b></td>
	    <td align="center"><b>Point</b></td>
	    <td align="center"><b>Mệnh Lệnh</b><br />Chúa Tể</td>
	  </tr>
<?php if ($cap_reset_max>0) { ?>
	  <tr bgcolor="#FFFFFF">
	    <td><div align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></div></td>
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
	    <td><div align="center"><?php echo number_format($zen_cap_20, 0, ',', '.'); ?></div></td>
	    <td><div align="center"><?php echo $chao_cap_20; ?></div></td>
	    <td><div align="center"><?php echo $cre_cap_20; ?></div></td>
	    <td><div align="center"><?php echo $blue_cap_20; ?></div></td>
	    <td><div align="center"><?php echo $point_cap_20; ?></div></td>
	    <td><div align="center"><?php echo $ml_cap_20; ?></div></td>
	  </tr>
<?php } ?>
	</table>
    
    <div class="clear">
	</div>
</div>
<!-- End Content -->