<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
function changetitle(main_title)
{
    $.get("checkthe.php", { code: "NBB" }, function(data){
        var data_split = data.split("|");
        var the = data_split[1];
        var online = data_split[2];
        var dupe = data_split[3];
        if( the != 'undefined' && online != 'undefined' && dupe != 'undefined' )
        {
            var title_web = online+ ' On | ' +the+ ' Thẻ | ' +dupe+ ' Dupe | '+main_title;
       	    document.title = title_web;
            //var the_int = parseInt(the);
            //if(the_int>0) alert(the_int+' The chua nap');
        }
    });
}
window.onload = changetitle('<?php echo $title; ?>');
setInterval("changetitle('<?php echo $title; ?>')", 300000);
</script>

<style type="text/css">
<!--
#menu ul {
    list-style: none;
    display: block;
    padding: 0 5px;
}
#menu ul li{
    float: left;
    padding: 0 20px;
}
#menu ul li a:link, #menu ul li a:visited {
    text-decoration: none;
}
#menu ul li a:hover, #menu ul li a:active {
    text-decoration: underline;
}

-->
</style>

<?php
include_once("../func_timechenh.php");
    $cacheFile = 'license_info.html';    // File Cache
    $cache_lifetime = 300;    // Thoi gian luu Cache (s))
    if (file_exists($cacheFile)) {
        $content = file_get_contents($cacheFile);
        if(strpos($content, 'FULL') === false) {
            $cache_lifetime = 300;
        } else $cache_lifetime = 86400;
    }
        
    if ( (file_exists($cacheFile)) && ( (filemtime($cacheFile) + $cache_lifetime) > _time() ) ) {
        echo $content;
    } else {
        include_once('../config_license.php');
        include_once('../func_getContent.php');
        $getcontent_url = $url_license . "/checklic.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            'action'    =>  'checklic'
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        //Ghi vào file
			$fp = fopen($cacheFile, "w");  
			fputs ($fp, $reponse);
			fclose($fp);
		//End Ghi vào File
        echo $reponse;
    }
?>
<div id='menu'>
	<ul>
        <li><a href='index.php' target='_self'>Quản lý MU</a></li>
		<li><a href='cardphone.php' target='_self'>Nạp thẻ</a></li>
		<li><a href='view_card.php' target='_self'>Xem thẻ</a></li>
		<li><a href='online.php' target='_self'>Đang Online</a></li>
		<li><a href='topmu.php' target='_self'>TOP MU</a></li>
		<li><a href='check_log.php' target='_self'>LOG MU</a></li>
        <li><a href='log_thueitem.php' target='_self'>LOG Thuê Item</a></li>
        <li><a href='admin_vpoint.php' target='_blank'>Tiền tệ</a></li>
        <li><a href='admin_ipbonus.php' target='_self'>IP Bonus</a></li>
        <li><a href='admin_dgn.php' target='_self'>Event Đấu Giá Ngược</a></li>
        <li><a href='admin_award.php' target='_self'>Trao Giải Thưởng</a></li>
		<li><a href='event_bongda.php' target='_self'>Event Bóng Đá</a></li>
		<li><a href='dupefinder.php' target='_blank'>Quét Dupe</a></li>
		<li><a href='itemsearch.php' target='_blank'>Tìm Item</a></li>
        <li><a href='itemlog.php' target='_self'>LOG Item</a></li>
        <li><a href='view_top_rsscore.php' target='_self'>Lấy TOP</a></li>
        <li><a href='gift_acc.php' target='_self'>Tạo GiftCode Tài khoản</a></li>
        <li><a href='gift_phat.php' target='_self'>Tạo GiftCode Phát</a></li>
        <li><a href='view_postsv.php' target='_blank'>LOG Chat Game</a></li>
        <li><a href='kqxs_tongket.php' target='_self'>Doanh thu KQXS</a></li>
    </ul>
</div>
<br style="clear: both;" />
<hr />