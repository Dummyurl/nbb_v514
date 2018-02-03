<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Nạp Thẻ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

	<a href="#napthe&act=listcard" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Danh sách thẻ nạp
		<span>Xem thẻ đã nạp</span></p>
	</a>
		
		
<?php if ($Use_CardGATE == 1) { ?>	
    <a href="#napthe&act=gate" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nạp thẻ GATE
		<span><?php if($khuyenmai_gate>0) echo "(Được thêm $khuyenmai_gate % Gcoin)"; ?></span></p>
	</a>
<?php } ?>


		
<?php if ($Use_CardVTCOnline == 1) { ?>	
    <a href="#napthe&act=vtc" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nạp thẻ VTC
		<span><?php if($khuyenmai_vtc>0) echo "(Được thêm $khuyenmai_vtc % Gcoin)"; ?></span></p>
	</a>
<?php } ?>


		
<?php if ($Use_CardViettel == 1) { ?>	
    <a href="#napthe&act=viettel" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nạp thẻ Viettel
		<span>Thẻ điện thoại Viettel</span></p>
	</a>
<?php } ?>


		
<?php if ($Use_CardVina == 1) { ?>	
    <a href="#napthe&act=vina" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nạp thẻ VinaPhone
		<span>Thẻ điện thoại Vinaphone</span></p>
	</a>
<?php } ?>


		
<?php if ($Use_CardMobi == 1) { ?>	
    <a href="#napthe&act=mobi" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Nạp thẻ MobiFone
		<span>Thẻ điện thoại MobiFone</span></p>
	</a>
<?php } ?>


    <br class="clear" />
</div>
<!-- End Content -->