<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Giải Trí</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<?php if(isset($Use_GiaiTri_Lo) && $Use_GiaiTri_Lo == 1) { ?>
    <a href="#relax&act=relax_lo" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Đánh Lô
		<span style="line-height:18px">Vận may đang đỏ, chơi thôi...</span></p>
	</a>
<?php } ?>
<?php if(isset($Use_GiaiTri_De) && $Use_GiaiTri_De == 1) { ?>
    <a href="#relax&act=relax_de" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Đánh Đề
		<span style="line-height:18px">Vận may đang đỏ, chơi thôi...</span></p>
	</a>
<?php } ?>

	<br class="clear" />

</div>