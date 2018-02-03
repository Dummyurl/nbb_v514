<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đấu Giá Ngược >> Quy Tắc</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php 
    include('templates/com/daugianguoc_head.tpl'); 
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center>";
?>
<br />
<center><b>Quy tắc Đấu Giá Ngược:</b></center><br />
<ul>
    <li>Không giới hạn số lần đặt giá cho 1 Item</li>
    <li>Người chơi đặt giá thấp nhất và giá đặt được ít người đặt nhất sẽ thắng.</li>
    <li>
        <strong>Ví dụ:</strong>
        <ul>
            <li>Đấu giá ngược Item : Lông Vũ 7 màu</li>
            <li>Có 3 người chơi đặt Giá : 2.000 Vpoint</li>
            <li><strong>Có 1 người chơi đặt Giá : 3.000 Vpoint</strong></li>
            <li>Có 2 người chơi đặt Giá : 4.000 Vpoint</li>
            <li>Có 1 người chơi đặt Giá : 5.000 Vpoint</li>
            <li><strong>Người chơi đặt giá 3.000 Vpoint dành chiến thắng</strong> : vì giá đặt 3.000 Vpoint là <strong>thấp nhất và duy nhất</strong>.<br />Người chơi đặt giá 2.000 Vpoint là thấp nhất nhưng không duy nhất.</li>
            <li>Người chơi chiến thắng chỉ phải trả 3.000 Vpoint để nhận được Lông Vũ 7 màu</li>
        </ul>
    </li>
    <li>Nếu giá thấp nhất và duy nhất có hơn 2 người đặt. Người chơi đặt giá trước sẽ thắng</li>
    <li><strong>Ví dụ:</strong>
        <ul>
            <li>Đấu giá ngược Item : Lông Vũ 7 màu</li>
            <li>Có 3 người chơi đặt Giá : 2.000 Vpoint</li>
            <li><strong>Có 2 người chơi đặt Giá : 3.000 Vpoint</strong></li>
            <li>Có 2 người chơi đặt Giá : 4.000 Vpoint</li>
            <li><strong>Người chơi đặt giá 3.000 Vpoint đầu tiên dành chiến thắng</strong>: vì giá đặt 3.000 Vpoint là <strong>thấp nhất và ít người đặt nhất</strong>. Giá 2.000 Vpoint thấp nhất nhưng nhiều người đặt.</li>
            <li>Người chơi chiến thắng chỉ phải trả 3.000 Vpoint để nhận được Lông Vũ 7 màu</li>
        </ul>
    </li>
</ul>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>