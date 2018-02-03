<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event >> <?php echo $event_epitem_name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php include('templates/event/event_epitem_head.tpl'); ?>
<center><b>Giới thiệu Event <?php echo $event_epitem_name; ?></b></center>
<br /><br />
    
    <p><strong>Cách thức tham gia: </strong></p>
<ul>
  <li>  Mỗi nhân vật có thể đăng ký nhiều Item</li>
  <li> Item phải để Trên người nhân vật</li>
  <li> Sử dụng chức năng <a href="#event&act=event_epitem&page=event_epitem_regnew" rel="ajax" ><strong>Đăng ký Item tham gia Event</strong></a> trên web để đăng ký item</li>
  <li> Item đăng ký phải có từ <strong><?php echo $event_epitem_exlmin_begin; ?> - <?php echo $event_epitem_exlmax_begin; ?> dòng hoàn hảo</strong> </li>
  <li> Item đăng ký phải có <strong>cấp độ tối từ <?php echo $event_epitem_lvlmin_begin; ?> - <?php echo $event_epitem_lvlmax_begin; ?></strong> </li>
  <li> Item đã đăng ký không được chuyển sang tài khoản khác cho tới khi kết thúc Event.</li>
  <li> Khi ép thành công Item đã đăng kí, các bạn hãy Xác nhận hoàn thành trong phần <a href="#event&act=event_epitem&page=event_epitem_reged" rel="ajax" ><strong>Item đã đăng ký</strong></a>.</li>
  <li><a href="#event&act=event_epitem&page=event_epitem_rank" rel="ajax" ><strong>Bảng xếp hạng</strong></a> sẽ dựa vào thời gian Hoàn thành cấp sớm nhất và Nhân vật Hoàn thành nhiều nhất để xếp hạng.</li>
</ul>
<p><strong>Điều kiện hoàn thành:</strong></p>
<ul>
  <li>Item đã đăng ký có từ <strong><?php echo $event_epitem_exlmin_end; ?> - <?php echo $event_epitem_exlmax_end; ?> dòng hoàn hảo</strong></li>
  <li>Item đã đăng ký có <strong>cấp đồ từ <?php echo $event_epitem_lvlmin_end; ?> - <?php echo $event_epitem_lvlmax_end; ?></strong></li>
  <li>Item đã đăng ký nằm trên nhân vật đăng ký</li>
</ul>
<p><strong>Thời gian tham gia Event</strong>: <b><font color='red'>0h00 <?php echo date('d/m/Y',strtotime($event_epitem_begin)); ?> - 24h00 <?php echo date('d/m/Y',strtotime($event_epitem_end)); ?> </font></b></p>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->