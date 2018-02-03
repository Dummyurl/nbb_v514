<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event - Sự Kiện</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    <a href="#event&act=award" rel="ajax" class="cont03">
		<p><img src="images/cutkyhot.gif" alt="" />Nhận Giải Thưởng Event
		<span style="line-height:18px">Nhận Item đoạt giải Event</span></p>
	</a>

<?php if ($hotroitem_on == 1) { ?>
    <a href="#event&act=itemfull" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nhận Item FULL +15
		<span style="line-height:18px">Nhận Item hỗ trợ FULL +15</span></p>
	</a>
<?php } ?>

<?php if ($event_epitem_on == 1) { ?>
    <a href="#event&act=event_epitem" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" /><?php echo $event_epitem_name; ?>
		<span style="line-height:18px"></span></p>
	</a>
<?php } ?>


<?php
    include('config/config_giftcode_rs.php');
    if ($giftcode_rs_use > 0) {
?>
    <a href="#event&act=giftcode_rs" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />GiftCode Reset
		<span style="line-height:18px">GiftCode nhận được khi Reset</span></p>
	</a>
<?php } ?>


<?php
    include('config/config_giftcode_week.php');
    if ($giftcode_week_use > 0) {
?>
    <a href="#event&act=giftcode_week" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />GiftCode Tuần
		<span style="line-height:18px">GiftCode nhận được hàng tuần</span></p>
	</a>
<?php } ?>


<?php
    include('config/config_giftcode_month.php');
    if ($giftcode_month_use > 0) {
?>
    <a href="#event&act=giftcode_month" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />GiftCode Tháng
		<span style="line-height:18px">GiftCode nhận được hàng tháng</span></p>
	</a>
<?php } ?>


<?php
    include('config/config_giftcode_tanthu.php');
    if ($giftcode_tanthu_use == 1) { 
?>
    <a href="#event&act=giftcode_tanthu" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />GiftCode Tân Thủ
		<span style="line-height:18px">GiftCode nhận 1 lần duy nhất</span></p>
	</a>
<?php } ?>


    <?php
    include('config/config_giftcode_up_reset.php');
    if ($giftcode_up_reset_use > 0) {
    ?>
    <a href="#event&act=giftcode_up_reset" rel="ajax" class="cont03">
        <p><img src="images/dot.png" alt="" />GiftCode Up Reset
            <span style="line-height:18px">GiftCode mất phí</span></p>
    </a>
    <?php } ?>

<?php
    if ($giftcode_rs_use > 0 || $giftcode_week_use > 0 || $giftcode_month_use > 0 || $giftcode_tanthu_use == 1) {
?>
    <a href="#event&act=giftcode_change" rel="ajax" class="cont03">
		<p><img src="images/cutkyhot.gif" alt="" />Nhận phần thưởng GiftCode
		<span style="line-height:18px">Đổi GiftCode ra Item</span></p>
	</a>
<?php } ?>

<?php
    if ($giftcode_rs_use > 0 || $giftcode_week_use > 0 || $giftcode_month_use > 0 || $giftcode_tanthu_use == 1) {
?>
    <a href="#event&act=giftcode_history" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Lịch sử GiftCode
		<span style="line-height:18px">Danh sách GiftCode đã nhận</span></p>
	</a>
<?php } ?>

<?php if ($event_santa_ticket == 1) { ?>
    <a href="#event&act=santa_ticket" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Đổi vé làng Santa
		<span style="line-height:18px">Nhận Vpoint</span></p>
	</a>
<?php } ?>


<?php if ($event_bongda_on == 1) { ?>
    <a href="#event&act=event_bongda" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Dự đoán Bóng Đá
		<span style="line-height:18px">Dự đoán kết quả trận bóng</span></p>
	</a>
<?php } ?>


<?php if ($event1_on == 1) { ?>
    <a href="#event&act=event1" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" /><?php echo $event1_name; ?>
		<span style="line-height:18px">Event Đổi Point</span></p>
	</a>
<?php } ?>


<?php if ($event_toprs_on == 1) { ?>
    <a href="#event&act=event_toprs" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" /><?php echo $event_toprs_name; ?>
		<span style="line-height:18px"></span></p>
	</a>
<?php } ?>


<?php if ($event_toppoint_on == 1) { ?>
    <a href="#event&act=event_toppoint" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" /><?php echo $event_toppoint_name; ?>
		<span style="line-height:18px"></span></p>
	</a>
<?php } ?>


<?php if ($event_topcard_on == 1) { ?>
    <a href="#event&act=event_topcard" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" /><?php echo $event_topcard_name; ?>
		<span style="line-height:18px"></span></p>
	</a>
<?php } ?>


	<br class="clear" />
</div>