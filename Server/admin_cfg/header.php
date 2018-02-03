<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>NWebMU - Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="admin_cfg/images/css.css" />
    
    <script type="text/javascript" src="admin_cfg/js/jquery-1.6.4.min.js"></script>
    <script type="text/javascript" src="admin_cfg/js/js.js"></script>
    <script type="text/javascript" src="admin_cfg/js/jquery-ui-1.8.16.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="admin_cfg/js/jquery-ui-1.8.21.custom.css" />
    
</head>
<body>
<div id="main">
	<div id="header">
		<ul id="top-navigation">
			<li <?php if($mod=='editconfig' || !$mod) { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editconfig">Cấu Hình Chung</a></span></span></li>
			<li <?php if($mod=='editchar') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editchar">Nhân Vật</a></span></span></li>
			<li <?php if($mod=='editevent') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editevent">Event</a></span></span></li>
  	        <li <?php if($mod=='editluyenbao') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editluyenbao">Luyện Bảo</a></span></span></li>
            <li <?php if($mod=='editguild') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editguild">Bang Hội</a></span></span></li>
			<li <?php if($mod=='editcom') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editcom">Cộng Đồng</a></span></span></li>
			<li <?php if($mod=='editwebshop') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editwebshop">WebShop</a></span></span></li>
            <li <?php if($mod=='editreward') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editreward">Thuê Item</a></span></span></li>
			<li <?php if($mod=='editnapthe') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editnapthe">Nạp Thẻ</a></span></span></li>
            <li <?php if($mod=='editrelax') { ?> class="active" <?php } ?> ><span><span><a href="admin.php?mod=editrelax">Giải Trí</a></span></span></li>
		</ul>
	</div>
	<div id="middle">