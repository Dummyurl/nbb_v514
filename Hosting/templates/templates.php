<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
    include('templates/temp_config.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="robots" content="index,follow" />
    <meta name="robots" content="noodp,noydir" />
    <meta http-equiv="Expires" content="-1" />
    
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
<title>Quản lý tài khoản - <?php echo $title; ?> | NWebMU</title>
<meta name="description" content="Quản lý Tài khoản <?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />

<link type="text/css" rel="stylesheet" href="images/style.css" />
<link type="text/css" rel="stylesheet" href="images/simpleblue_style.css">

<script type="text/javascript" src="js/angular.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/tooltip.jquery.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="js/js_140527.js"></script>
<script type="text/javascript" src="js/check.js"></script>
</head>
<body>
<div id="header">
	<div id="wrapper" class="canhgiua">
    	<div id="logo"><a href="http://netbanbe.net"><img src="images/logo.png" /></a></div> <!-- logo -->
        <div id="topmenu">
        	<ul>
            	<li><a href="#register" rel="ajax">Đăng kí tài khoản</a></li><li>|</li>
                <li><a href="<?php echo $link_download; ?>">Tải game</a></li><li>|</li>
                <li><a href="<?php echo $link_forum; ?>">Diễn đàn</a></li><li>|</li>
                <li><a href="<?php echo $link_homepage; ?>" class="active" style="color: rgb(255, 255, 255);">Trang chủ</a></li>
                <div class="clear"></div>
            </ul>
        </div> <!-- topmenu -->
        <div class="clear"></div>
    </div> <!-- wrapper -->
</div> <!-- header -->

<div id="body-wrapper" class="canhgiua">
	<div id="content-wrap">
    	<div class="top"></div>
        <div class="middle">

<!-- Box Menu -->
<?php include('templates/box_menu.tpl'); ?>
<!-- End Box Menu -->	

<!-- Content -->
<div id="content">
<?php
echo '<div id="loading" style="display:none; text-align:center;"><img id="imgajaxloader" src="images/loading.gif" style="border-width: 0px;" /></div>';
echo "<div id='hienthi'>";

if (isset($nbbinfo)) {
	echo "<div class='info'>$nbbinfo</div>";
}

if (isset($error)) {
	echo "<div class='error'>$error</div>";
}

if (isset($notice)) {
	echo "<div class='success'>$notice</div>";
}

if($page_template) include( $page_template );

echo "</div>";
?>      				

</div> <!-- content -->
            <div class="clear"></div>
        </div>    
    	<div class="bottom"></div>      
    </div> <!-- content-wrap -->
    <div id="sidebar">	

<!-- Box Character -->
<?php include('modules/box_login.php'); ?>
<!-- End Box Character -->

<!-- Box Character -->
<?php include('modules/box_character.php'); ?>
<!-- End Box Character -->

<!-- Box Character -->
<?php include('modules/box_account.php'); ?>
<!-- End Box Character -->

	
    </div> <!-- siderbar -->
    <div class="clear"></div>
</div> <!-- body-wrapper -->
<div id="footer-above"></div>
<div id="footer">
	<div class="canhgiua">
        <div class="line1">
   			<a style="width: 118px;" href="#support_sms" rel="ajax" > Liên hệ hỗ trợ</a> | Hotline : <?php echo $hotline; ?>
        </div>
        <div class="line2">
    		<ul>
            	<li><a href="<?php echo $link_homepage; ?>">Trang chủ</a></li><li>|</li>
                <li><a href="<?php echo $link_forum; ?>">Diễn đàn</a></li><li>|</li>
                <li><a href="<?php echo $link_download; ?>">Tải game</a></li><li>|</li>
                <li><a href="#register" rel="ajax">Đăng kí</a></li>
                <div class="clear"></div>
            </ul>
            <p>
				<!-- Box Character -->
                <?php include('templates/box_copyright.tpl'); ?>
                <!-- End Box Character -->
		    </p>
            <div class="clear"></div>
        </div>
    </div>
</div> <!-- footer -->

<!-- Box Support Online -->
<?php include('templates/box_supportym.tpl'); ?>
<!-- End Box Support Online -->
</body>
</html>