<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Chợ Trời >> Hướng dẫn</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    include('templates/com/daugia_head.tpl'); 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center><br />";
?>
<center><b>Hướng dẫn Chợ Trời:</b></center><br />
<ul>
    <li>Đây là hệ thống <strong><font color='red'>người chơi tự đưa Item của mình lên Chợ Trời</font></strong> cho người chơi khác đấu giá để mua.</li>
    <li>Khi hết thời gian phiên đấu giá của Item, người chơi nào trả giá cao nhất sẽ dành được chiến thắng và được nhận Item đó.</li>
    <li>Người chơi có thể trả giá mua đứt để lấy luôn Item và kết thúc phiên đấu giá khi chưa hết phiên đấu giá.</li>
    
    <li><strong>Chi phí cho 1 lần đặt giá</strong> : <?php echo number_format($Bid_Vpoint_Member, 0, ',', '.'); ?> Vpoint / lần đặt giá</li>
    <li><strong>Chi phí cho 1 ngày đưa Item lên Chợ Trời</strong> : <?php echo number_format($Bid_Vpoint_Daily, 0, ',', '.'); ?> Vpoint / ngày</li>
    <li>Thuế VAT : <?php echo number_format($Bid_VAT, 0, ',', '.'); ?>% (Chi phí người bán phải trả cho nhà nước khi có người mua Item)</li>
    <li><strong>Item đang bán</strong> : Danh sách các Item đang trên Chợ Trời. Các bạn vào đây để tham gia đấu giá mua lại Item cần thiết.</li>
    <li><strong>Item đã tham gia mua</strong> : Danh sách các Item bạn đã tham gia và đã kết thúc phiên Đấu giá. Nếu có đấu giá bạn chiến thắng thì vào đây để lấy Item chiến thắng.</li>
    <li><strong>Đưa Item lên Chợ Trời</strong> : Đưa Item trong rương đồ của bạn lên Chợ Trời tham gia đấu giá.</li>
    <li><strong>Item trên Chợ Trời của bạn</strong> : Danh sách các Item bạn đã đưa lên Chợ Trời.</li>
    
</ul>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>