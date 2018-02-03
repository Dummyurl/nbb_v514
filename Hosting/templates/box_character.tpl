<?php
if( isset($_SESSION['mu_username']) ) {
?>
<!-- Box Character -->
<div class="top">Nhân Vật</div>
<div class="middle">
	<img style="margin-left: -20px;" src="images/logintop.png">
		<div class="loginpanel">
            <center>
            <?php if (isset($_SESSION['mu_nvchon'])) { ?>
            <img border="0" src="images/<?php echo $img_class; ?>" width='190' /><br>
            <strong class="clr02" style="color: yellow; font-size: 20px;"><?php echo $_SESSION['mu_nvchon']; ?></strong><br>
			( <?php echo $class; ?> )<br /><br />
            <?php } else $_SESSION['mu_nvchon'] = null; ?>
            <form id="ChonNV" name="ChonNV" method="post" action="">
                <input type='hidden' name='ChonNV' value='ChonNV' />
                <select name="nhanvat" onchange="submit();">
    			    <option value="0">-- Chọn nhân vật --</option>
    			    	<?php if ($_SESSION['nv_slg']>0) { ?> <option value="<?php echo $_SESSION['char1'] ?>" <?php if(isset($_SESSION['mu_nvchon']) && $_SESSION['mu_nvchon']==$_SESSION['char1']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char1']; ?></option> <?php } ?>
    					<?php if ($_SESSION['nv_slg']>1) { ?> <option value="<?php echo $_SESSION['char2'] ?>" <?php if(isset($_SESSION['mu_nvchon']) && $_SESSION['mu_nvchon']==$_SESSION['char2']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char2']; ?></option> <?php } ?>
    					<?php if ($_SESSION['nv_slg']>2) { ?> <option value="<?php echo $_SESSION['char3'] ?>" <?php if(isset($_SESSION['mu_nvchon']) && $_SESSION['mu_nvchon']==$_SESSION['char3']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char3']; ?></option> <?php } ?>
    					<?php if ($_SESSION['nv_slg']>3) { ?> <option value="<?php echo $_SESSION['char4'] ?>" <?php if(isset($_SESSION['mu_nvchon']) && $_SESSION['mu_nvchon']==$_SESSION['char4']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char4']; ?></option> <?php } ?>
    					<?php if ($_SESSION['nv_slg']>4) { ?> <option value="<?php echo $_SESSION['char5'] ?>" <?php if(isset($_SESSION['mu_nvchon']) && $_SESSION['mu_nvchon']==$_SESSION['char5']) { ?> selected='selected' <?php } ?> > <?php echo $_SESSION['char5']; ?></option> <?php } ?>
			  	</select>
            </form><br />
            </center>
		</div>
	<img style="margin-left: -20px;" src="images/loginbottom.png" />
    <?php if (isset($_SESSION['mu_nvchon'])) { ?>
	<div class="text_blue3">
        <strong>Cấp độ</strong> : <?php echo isset($_SESSION['nv_level']) ? $_SESSION['nv_level'] : 0; ?>
	</div>
    <div class="text_blue3">
        <strong>Điểm chưa cộng</strong> : <?php echo isset($_SESSION['nv_point']) ? number_format($_SESSION['nv_point'], 0, ',', '.') : 0; ?>
	</div>
	<div class="text_blue3">
        <strong>Điểm dự trữ</strong> : <?php echo isset($_SESSION['nv_pointdutru']) ? number_format($_SESSION['nv_pointdutru'], 0, ',', '.') : 0; ?>
	</div>
    <div class="text_blue3">
        <strong>Point Event</strong> : <?php echo isset($_SESSION['point_event']) ? number_format($_SESSION['point_event'], 0, ',', '.') : 0; ?>
	</div>
    <?php
        include_once('config/config_event.php');
        include_once('config/config_event1.php');
        if($event_toppoint_on == 1 && (strtotime($event_toppoint_begin) < time()) && (strtotime($event_toppoint_end) + 5*24*60*60 > time() )) {
    ?>
    <div class="text_blue3">
        <strong>Event Huy Chương 1</strong> : <font color='blue'><?php echo isset($_SESSION['event1_type1_daily']) ? number_format($_SESSION['event1_type1_daily'], 0, ',', '.') : 0; ?></font>/<?php echo number_format($event1_loai1_daily_slg, 0, ',', '.'); ?> - <font color='red'><?php echo isset($_SESSION['event1_type1']) ? number_format($_SESSION['event1_type1'], 0, ',', '.') : 0; ?>/<?php echo number_format($event1_loai1_slg, 0, ',', '.'); ?></font>
	</div>
    <div class="text_blue3">
        <strong>Event Huy Chương 2</strong> : <font color='blue'><?php echo isset($_SESSION['event1_type2_daily']) ? number_format($_SESSION['event1_type2_daily'], 0, ',', '.') : 0; ?></font>/<?php echo number_format($event1_loai2_daily_slg, 0, ',', '.'); ?> - <font color='red'><?php echo isset($_SESSION['event1_type2']) ? number_format($_SESSION['event1_type2'], 0, ',', '.') : 0; ?>/<?php echo number_format($event1_loai2_slg, 0, ',', '.'); ?></font>
	</div>
    <div class="text_blue3">
        <strong>Event Huy Chương 3</strong> : <font color='blue'><?php echo isset($_SESSION['event1_type3_daily']) ? number_format($_SESSION['event1_type3_daily'], 0, ',', '.') : 0; ?></font>/<?php echo number_format($event1_loai3_daily_slg, 0, ',', '.'); ?> - <font color='red'><?php echo isset($_SESSION['event1_type3']) ? number_format($_SESSION['event1_type3'], 0, ',', '.') : 0; ?>/<?php echo number_format($event1_loai3_slg, 0, ',', '.'); ?></font>
	</div>
    <?php
        }
    ?>
	<div class="text_blue3">
        <strong>Zen</strong> : <?php echo isset($_SESSION['nv_zen']) ? number_format($_SESSION['nv_zen'], 0, ',', '.') : 0; ?>
	</div>
	<div class="text_blue3">
        <strong><font color='red'>ReLife</font>/<font color='blue'>Reset</font></strong> : <font color='red'><?php echo isset($_SESSION['nv_relife']) ? $_SESSION['nv_relife'] : 0; ?></font> / <font color='blue'><?php echo isset($_SESSION['nv_reset']) ? $_SESSION['nv_reset'] : 0; ?></font>
	</div>
	<div class="text_blue3">
        <strong>Reset/ngày</strong> : <?php echo isset($_SESSION['nv_resetday']) ? $_SESSION['nv_resetday'] : 0; ?>
	</div>
	<div class="text_blue3">
        <strong>Reset/tháng</strong> : <?php echo isset($_SESSION['nv_resetmonth']) ? $_SESSION['nv_resetmonth'] : 0; ?>
	</div>
	<div class="text_blue3">
        <strong>Ủy Thác Online</strong> : <?php echo $uythac; ?>
	</div>
	<div class="text_blue3">
        <strong>Ủy Thác Offline</strong> : <?php echo $uythacoffline; ?>
	</div>
	<div class="text_blue3">
        <strong>Đã Ủy Thác Offline</strong> : <?php echo isset($_SESSION['nv_uythac_offline_time']) ? $_SESSION['nv_uythac_offline_time'] : 0; ?> phút
	</div>
    <div class="text_blue3">
        <strong>Đã Ủy Thác Offline trong ngày</strong> : <?php echo isset($_SESSION['nv_uythac_offline_daily']) ? $_SESSION['nv_uythac_offline_daily'] : 0; ?> phút
	</div>
	<div class="text_blue3">
        <strong>Điểm Ủy Thác</strong> : <?php echo isset($_SESSION['nv_point_uythac']) ? $_SESSION['nv_point_uythac'] : 0; ?>
	</div>
	<div class="text_blue3">
        <strong>Điểm Ủy Thác Event</strong> : <?php echo isset($_SESSION['nv_point_uythac_event']) ? $_SESSION['nv_point_uythac_event'] : 0; ?>
	</div>
	<div class="text_blue3">
        <strong>Khóa đồ</strong> : <?php echo $khoado; ?>
	</div>
	<div class="text_blue3">
        <strong>Đổi nhân vật khác</strong> : <?php echo $doinv; ?>
	</div>
	<div class="text_blue3">
        <strong>Thoát Game</strong> : <?php echo $online; ?>
	</div>	
    <?php } ?>
</div>
<div class="bottom">

</div>  		
<div class="padtop clear">
</div>

<!-- End Box Character -->
<?php } ?>