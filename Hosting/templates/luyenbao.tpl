<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Luyện Bảo</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

<?php if(isset($Use_CuongHoa) && $Use_CuongHoa == 1) { ?>
    <a href="#luyenbao&act=cuonghoa" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Cường Hóa
		<span style="line-height:18px">Tăng Cấp Độ Item</span></p>
	</a>
<?php } ?>

<?php if(isset($Use_HoanHaoHoa) && $Use_HoanHaoHoa == 1) { ?>
    <a href="#luyenbao&act=hoanhaohoa" rel="ajax" class="cont03">
		<p><img src="images/dot.png" alt="" />Hoàn Hảo Hóa
		<span style="line-height:18px">Thêm dòng hoàn hảo</span></p>
	</a>
<?php } ?>

	<br class="clear" />

</div>