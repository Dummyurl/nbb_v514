<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * @Version		v5.12.0722
 * @Release		22/07/2012
 
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
    session_start();

    include_once ("security.php");
    include ('../config.php');
    
    $mod = $_GET['mod'];
    switch ($mod){ 
	case 'scan':
        $title = "Quét đồ Dupe toàn Server";
	break;

	case 'show':
        $title = "Hiển thị tài khoản - nhân vật chưa đồ Dupe";
	break;

	case 'del':
        $title = "Xóa đồ Dupe";
	break;
    
    case 'scanonline':
        $title = "Theo dõi Dupe Online";
	break;
    
    case 'viewdupeonline':
        $title = "Xem nhân vật Dupe Online";
	break;
    
	default :
        $title = "Hệ thống Quét Dupe by NetBanBe";
        $mod = "";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
    var flag_viewonline = true;
    var AjaxAutoLoad_viewonline = function(){
        if(flag_viewonline == true) {
            var data = "";
            $.ajax({
                type: "GET",
                url: "dupefinder_viewonline.php",
                data: data, 
                beforeSend: function(){
                    flag_viewonline = false;
                },
                success: function(response){
                    $('#online_view').html(response);
                    flag_viewonline = true;
                }
            });
        }
    }
    setInterval( "AjaxAutoLoad_viewonline();", 60000 );
</script>
<?php
$online_query = "Select count(*) from Memb_Stat where ConnectStat='1'";
$online_result = $db->Execute($online_query);
$online_fetch = $online_result->FetchRow();
$online = $online_fetch[0];
?>
<center>
    <strong>Hệ thống Quét đồ Dupe by NetBanBe</strong><br />
    <form name="DupeScan" method="GET" action="dupefinder.php">
    <input type="hidden" name="mod" value="scan" />
    <select name="dupeday" onchange="this.form.submit();">
        <option value="">Chọn thời gian Quét đồ Dupe toàn Server</option>
        <option value="1">Nhân vật Online trong 1 ngày trở lại đây</option>
        <option value="2">Nhân vật Online trong 2 ngày trở lại đây</option>
        <option value="3">Nhân vật Online trong 3 ngày trở lại đây</option>
        <option value="7">Nhân vật Online trong 7 ngày trở lại đây</option>
        <option value="30">Nhân vật Online trong 1 tháng trở lại đây</option>
        <option value="all">Tất cả</option>
    </select> - 
    <?php if($mod != 'show') { ?><a href="?mod=show" target="_self"><?php } ?>Hiển thị tài khoản - nhân vật chưa đồ Dupe<?php if($mod != 'show') { ?></a><?php } ?> - 
    <?php if($mod != 'del') { ?><a href="?mod=del" target="_self"><?php } ?>Xóa đồ Dupe<?php if($mod != 'del') { ?></a><?php } ?><br />
    <?php if($mod != 'scanonline') { ?><a href="?mod=scanonline" target="_self"><?php } ?>Theo dõi Dupe Online<?php if($mod != 'scanonline') { ?></a><?php } ?> - 
    <a href="?mod=viewdupeonline" target="_self">Xem nhân vật Dupe Online</a>
    </form>
    <br />
    <i>(Nên Quét tại máy chủ MU để tránh bị hệ thống coi là BotNet do Request liên tục)</i>
</center>
<hr />

<?php
if($_GET['mod'] == "scan") {
    // Reset Dupe
    $_SESSION['finish'] = "unfinish";  // finish, unfinish
    $_SESSION['scan'] = "warehouse";   // warehouse, inventory
    $_SESSION['warehouse_scan'] = 0;
    $_SESSION['inventory_scan'] = 0;
    $_SESSION['data_first'] = false;
    
    $dupeday = $_GET['dupeday'];
    $dupeday = abs(intval($dupeday));
    $_SESSION['dupeday'] = $dupeday;
    
    $_SESSION['timebegin'] = $timestamp;
    
    $del_dupe_query = "DELETE FROM Dupe_Scan";
    $del_dupe_result = $db->Execute($del_dupe_query);
?>

<script type="text/javascript">
    var flag = true;
    var AjaxAutoLoad = function(){
        if(flag == true) {
            var data = "";
            $.ajax({
                type: "GET",
                url: "dupescan.php",
                data: data, 
                beforeSend: function(){
                    flag = false;
                },
                success: function(response){
                    $('#show').html(response);
                    if(response == '<strong>Đã Quét hoàn tất</strong>.') {
                    	clearInterval(refresh_dupescan);
                    }
                    flag = true;
                }
            });
        }
    }
    var refresh_dupescan = setInterval( "AjaxAutoLoad();", 100 );
</script>
<?php
}
?>

<?php
if($_GET['mod'] == "show") {
    echo "<table border=1 style='border-collapse:collapse;' cellpadding='3' cellspacing='3' align='center'><tr><td align='center'><strong>Tài khoản</strong></td><td align='center'><strong>Nhân vật</strong></td><td align='center'><strong>Seri Item Dupe</strong></td><td align='center'><strong>Số lượng Item Dupe</strong></td><td align='center'><strong>Item Dupe nằm trong</strong></td></tr>";
    $dupe_show_query = "SELECT acc, name, seri, slgitem FROM Dupe_Scan WHERE isdupe=1 ORDER BY acc, name";
    $dupe_show_result = $db->Execute($dupe_show_query);
    while($dupe_show_fetch = $dupe_show_result->FetchRow()) {
        echo "<tr>";
        echo "<td align='center'>" . $dupe_show_fetch[0] . "</td>";
        echo "<td align='center'>" . $dupe_show_fetch[1] . "</td>";
        echo "<td align='center'>" . $dupe_show_fetch[2] . "</td>";
        echo "<td align='center'>" . $dupe_show_fetch[3] . "</td>";
        if($dupe_show_fetch[1] == NULL) $itemin = "Hòm Đồ";
        else $itemin = "Nhân vật " . $dupe_show_fetch[1];
        echo "<td align='center'>" . $itemin . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php
if($_GET['mod'] == "del") {
    $_SESSION['del_finish'] = "unfinish";  // finish, unfinish
    $_SESSION['dupe_del'] = 0;
    
    $dupe_total_query = "SELECT count(*) FROM Dupe_Scan WHERE isdupe=1";
    $dupe_total_result = $db->Execute($dupe_total_query);
    $dupe_total_fetch = $dupe_total_result->FetchRow();
    $_SESSION['dupe_total'] = $dupe_total_fetch[0];
?>
<script type="text/javascript">
    var flag = true;
    var AjaxAutoLoad = function(){
        if(flag == true) {
            var data = "";
            $.ajax({
                type: "GET",
                url: "dupedel.php",
                data: data, 
                beforeSend: function(){
                    flag = false;
                },
                success: function(response){
                    $('#show').html(response);
                    flag = true;
                }
            });
        }
    }
    setInterval( "AjaxAutoLoad();", 100 );
</script>
<?php    
}
?>

<?php
if($_GET['mod'] == "scanonline") {
    // Reset Dupe
    $_SESSION['scanonline'] = 0;
    $_SESSION['timebegin'] = $timestamp;
    $_SESSION['time_endloop'] = 0;
?>

<script type="text/javascript">
    var flag = true;
    var AjaxAutoLoad = function(){
        if(flag == true) {
            var data = "";
            $.ajax({
                type: "GET",
                url: "dupescan_online.php",
                data: data, 
                beforeSend: function(){
                    flag = false;
                },
                success: function(response){
                    $('#show').html(response);
                    flag = true;
                }
            });
        }
    }
    setInterval( "AjaxAutoLoad();", 1000 );
</script>
<?php
}
?>

<?php
if($_GET['mod'] == "viewdupeonline") {
    include_once('../function.php');
    
    if($_GET['del_dupeonline'] == 'yes') {
        $del_dupeonline_query = "DELETE FROM Dupe_Online";
        $del_dupeonline_result = $db->Execute($del_dupeonline_query);
        echo "<center><font color='red'><strong>Đã Xóa hết dữ liệu quét Dupe Online</strong></font></center><br /><br />";
    } else {
        echo "<div align='right'><a href='?mod=viewdupeonline&del_dupeonline=yes'>Xóa dữ liệu quét Dupe Online để quét lại từ đầu.</a></div><br />";
    }
?>
<script type="text/javascript" src="js/tooltip.jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $('.dupedel').live("click",function() 
        {
            //dupeseri_$acc_$name_$seri_$item_vitri
            var acc = $(this).attr("acc");
            var name = $(this).attr("name");
            var seri = $(this).attr("seri");
            var vitri = $(this).attr("vitri");
            var dataString = 'acc='+ acc +'&name='+ name +'&seri='+ seri +'&vitri='+ vitri;
            
            $.ajax({
                type: "POST",
                url: "dupedel_online.php",
                data: dataString,
                cache: false,
                success: function(reponse){
                    $("#dupeseri_"+ acc +"_"+ name +"_"+ seri +"_"+ vitri).html(reponse);
                }
            });
            
            return false;
        });
        
        $('.itemtooltip').tooltip();
    });
</script>

<?php
    $order = $_GET['order'];
    
    echo "<table border=1 style='border-collapse:collapse;' cellpadding='3' cellspacing='3' align='center'><tr><td align='center'><strong><a href='dupefinder.php?mod=viewdupeonline&order=acc' title='Sắp xếp theo tài khoản'>Tài khoản</a></strong></td><td align='center'><strong>Nhân vật</strong></td><td align='center'><strong>Item Name</strong></td><td align='center'><strong>Hình</strong></td><td align='center'><strong><a href='dupefinder.php?mod=viewdupeonline&order=seri' title='Sắp xếp theo Seri'>Seri Item Dupe</a></strong></td><td align='center'><strong>Vị Trí Item Dupe</strong></td><td align='center'><strong>Item Dupe nằm trong</strong></td><td align='center'><strong>Online</strong></td><td align='center'><strong>Dupe lúc</strong></td><td align='center'><strong>Xóa Dupe</strong></td></tr>";
    $dupe_show_query = "SELECT acc, name, seri, vitri, time, item, thehe FROM Dupe_Online A JOIN MEMB_INFO B ON A.acc=B.memb___id";
    
    switch ($order){ 
    	case 'acc': $order_query = " ORDER BY acc, name, vitri, seri";
    	break;
    
    	case 'seri': $order_query = " ORDER BY seri, acc, name, vitri";
    	break;
    
    	default : $order_query = " ORDER BY seri, acc, name, vitri";
    }
    $dupe_show_query .= $order_query;
    
    $dupe_show_result = $db->Execute($dupe_show_query);
    
    $flag_color = 0;
    while($dupe_show_fetch = $dupe_show_result->FetchRow()) {
        $acc = $dupe_show_fetch[0];
        $name = $dupe_show_fetch[1];
        $seri = $dupe_show_fetch[2];
        $seri_dec = hexdec($seri);
        $vitri = $dupe_show_fetch[3];
        $timedupe = date('H:i:s d/m', $dupe_show_fetch[4]);
        $item = $dupe_show_fetch[5];
        $thehe = $dupe_show_fetch[6];
        
        $name_best_acc_query = "SELECT TOP 1 Name, Relifes, Resets FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC, cLevel DESC";
        $name_best_acc_result = $db->Execute($name_best_acc_query);
        $name_best_acc_fetch = $name_best_acc_result->FetchRow();
        $name_best_name = $name_best_acc_fetch[0];
        $name_best_relife = $name_best_acc_fetch[1];
        $name_best_reset = $name_best_acc_fetch[2];
        
        $name_info_query = "SELECT Relifes, Resets FROM Character WHERE Name='$name'";
        $name_info_result = $db->execute($name_info_query);
        $name_info_fetch = $name_info_result->fetchrow();
        $name_info_relife = $name_info_fetch[0];
        $name_info_reset = $name_info_fetch[1];
        
        if($dupe_show_fetch[1] == NULL OR $dupe_show_fetch[1] == "") {
            $itemin = "Hòm Đồ";
            $hang = ceil($vitri/8);
            $cot = $vitri%8;
            if($cot == 0) $cot = 8;
            
            $item_vitri = "Hàng $hang, Cột $cot";
        }
        else {
            $itemin = "Nhân vật " . $dupe_show_fetch[1];
            if($vitri <= 12) {
                switch ($vitri){ 
            	case 1: $name_item = "Vũ khí Trái";
            	break;
            
            	case 2: $name_item = "Vũ khí Phải";
            	break;
            
            	case 3: $name_item = "Mũ";
            	break;
                
                case 4: $name_item = "Áo";
            	break;
                
                case 5: $name_item = "Quần";
            	break;
                
                case 6: $name_item = "Găng Tay";
            	break;
                
                case 7: $name_item = "Giày";
            	break;
                
                case 8: $name_item = "Wing";
            	break;
                
                case 9: $name_item = "PET";
            	break;
                
                case 10: $name_item = "Dây chuyền";
            	break;
                
                case 11: $name_item = "Nhẫn Trái";
            	break;
                
                case 12: $name_item = "Nhẫn Phải";
            	break;
                
            	default :
}
                $item_vitri = "Đang dùng trên người vị trí $name_item";
            } else {
                $vitri_new = $vitri - 12;
                $hang = ceil($vitri_new/8);
                $cot = $vitri_new%8;
                if($cot == 0) $cot = 8;
                $item_vitri = "Hàng $hang, Cột $cot";
            }
        }
        
        $online_query = "SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='$acc'";
        $online_result = $db->Execute($online_query);
        $online_fetch = $online_result->FetchRow();
        if($online_fetch[0] == 1) {
        	$online = "<font color='blue'><b>Online</b></font>";
        } else {
        	$online = "<font color='red'>Offline</font>";
        }
        
        ++$flag_color;
        if($flag_color % 2 == 0) {
            $tr_color = "FFFFCC";
        } else {
            $tr_color = "FFFFFF";
        }
        
        include_once('../config_license.php');
        include_once('../func_getContent.php');
        $getcontent_url = $url_license . "/api_iteminfo.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'item'    =>  $item
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            $item_name = "Không kết nối được đến API";
            $err = true;
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $item_name = $reponse;
            } elseif ($info == "OK") {
                $iteminfo = read_TagName($reponse, 'iteminfo');
                $iteminfo_arr = unserialize_safe($iteminfo);
                
                $item_name = $iteminfo_arr['item_name'];
                $item_info = $iteminfo_arr['item_info'];
                $item_image = $iteminfo_arr['item_image'];
                
            } else {
                $item_name = "Kết nối API gặp sự cố.";
            }
        }
        
        echo "<tr bgcolor='#". $tr_color ."'>";
        echo "<td align='center'><strong>$acc</strong> ($thehe)<br /> (<i>$name_best_name (<font color='red'>$name_best_relife</font> / <font color='blue'>$name_best_reset</font>)</i>)</td>";
        echo "<td align='center'>$name (<font color='red'>$name_info_relife</font> / <font color='blue'>$name_info_reset</font>)</i>)</td>";
        echo "<td align='center' id='itemtooltip_" . $seri . $acc . $name . "' class='itemtooltip'>" . $item_name . " <div id='data_itemtooltip_" . $seri . $acc . $name . "' style='display:none;'><div style='background-color: #121212; font-size: 12px; text-align: center;'><img src='../items/" . $item_image . ".gif' border=0 /><br />" . $item_info . "</div></div></td>";
        echo "<td align='center'><img src='../items/" . $item_image . ".gif' border=0 /></td>";
        echo "<td align='center'><strong>HEX</strong>: " . $seri . "<br /><strong>DEC</strong>: ". $seri_dec ."</td>";
        echo "<td align='center'>" . $item_vitri . "</td>";
        echo "<td align='center'>" . $itemin . "</td>";
        echo "<td align='center'>" . $online . "</td>";
        echo "<td align='center'>" . $timedupe . "</td>";
        echo "<td align='center' id='dupeseri_". $acc ."_". $name ."_". $seri ."_". $vitri ."'><a href='#' acc='$acc' name='$name' seri='$seri' vitri='$vitri' class='dupedel'>Xóa Dupe</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
$db->Close();
?>
<div id="online"><strong>Đang Online</strong> : <span id="online_view" style="color: blue; font-weight: bold;"><?php echo $online; ?></span></div>
<br /><br />
<div id="show"></div>