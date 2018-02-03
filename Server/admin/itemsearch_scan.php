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
 

/**
 * @author NetBanBe
 * @copyright 2012
 */
session_start();

include_once ("security.php");
include ('../config.php');
include_once('../function.php');
$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
$scan_slg = 50;

echo "|";
    $thehe = $_SESSION['thehe'];
    $scanday = $_SESSION['scanday'];
    $time_scan_check = $timestamp - $scanday*24*60*60;
    $time_scan_check = date('m/d/Y H:i:s', $time_scan_check);
    switch ($scanday){ 
    	case 1:
            $viewscan = "Quét Item trong những nhân vật, tài khoản Online trong <strong>1 ngày</strong> trở lại đây";
    	break;
    
    	case 2:
            $viewscan = "Quét Item trong những nhân vật, tài khoản Online trong <strong>2 ngày</strong> trở lại đây";
    	break;
    
    	case 3:
            $viewscan = "Quét Item trong những nhân vật, tài khoản Online trong <strong>3 ngày</strong> trở lại đây";
    	break;
        
        case 7:
            $viewscan = "Quét Item trong những nhân vật, tài khoản Online trong <strong>7 ngày</strong> trở lại đây";
    	break;
        
        case 30:
            $viewscan = "Quét Item trong những nhân vật, tài khoản Online trong <strong>30 ngày</strong> trở lại đây";
    	break;
        
    	default :
            $viewscan = "Quét Item Toàn Server";
    }

echo $viewscan . "<br />";
    
if(!$_SESSION['data_first']) {
    if($scanday > 0) {
        $acc_total_query = "SELECT count(*) FROM MEMB_STAT JOIN MEMB_INFO ON MEMB_STAT.memb___id collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND ConnectTM > '$time_scan_check'";
            if($_SESSION['thehe'] != 0) {
                $acc_total_query .= " AND thehe=$thehe";
            }
            
        $inventory_total_query = "SELECT count(*) FROM Character JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM > '$time_scan_check' JOIN MEMB_INFO ON MEMB_STAT.memb___id collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT";
            if($_SESSION['thehe'] != 0) {
                $inventory_total_query .= " AND thehe=$thehe";
            }
        
    } else {
        $acc_total_query = "SELECT count(*) FROM MEMB_INFO";
            if($_SESSION['thehe'] != 0) {
                $acc_total_query .= " WHERE thehe=$thehe";
            }
        $inventory_total_query = "SELECT count(*) FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT";
            if($_SESSION['thehe'] != 0) {
                $inventory_total_query .= " AND thehe=$thehe";
            }
    }
    
    $acc_total_result = $db->Execute($acc_total_query) OR DIE("Query Error : $acc_total_query");
    $acc_total_fetch = $acc_total_result->FetchRow();
    $_SESSION['acc_total_scan'] = $acc_total_fetch[0];

    
    $inventory_total_result = $db->Execute($inventory_total_query) OR DIE("Query Error : $inventory_total_query");
    $inventory_total_fetch = $inventory_total_result->FetchRow();
    $_SESSION['inventory_total_scan'] = $inventory_total_fetch[0];
    
    $_SESSION['data_first'] = true;
    
    $_SESSION['acc_scan'] = 0;
    $_SESSION['inventory_scan'] = 0;
}

$acccolor = dechex(rand(0,10000000));
$charcolor = dechex(rand(0,10000000));

echo "Đã quét tài khoản : <font color='#". $acccolor ."'><b>" . $_SESSION['acc_scan'] . "</b></font> / " . $_SESSION['acc_total_scan'] . "<br />";
echo "Đã quét nhân vật : <font color='#". $charcolor ."'><b>" . $_SESSION['inventory_scan'] . "</b></font> / " . $_SESSION['inventory_total_scan'] . "<br />";

$time_begin = date("H:i:s d/m", $_SESSION['timebegin']);
echo "Bắt đầu quét lúc : $time_begin<br />";

$time_dukien = date("H:i:s d/m", $_SESSION['timebegin'] + floor($_SESSION['acc_total_scan'] + $_SESSION['inventory_total_scan'])/2 );
echo "Thời gian dự kiến quét đến : $time_dukien<br />";

$time_scan = _time() - $_SESSION['timebegin'];
$hour_scan = floor($time_scan / 3600);
$minute_scan = floor(($time_scan % 3600) / 60);
$second_scan = $time_scan % 60;
echo "Đã quét : $hour_scan giờ $minute_scan phút $second_scan giây";

echo "<hr />";

if($_SESSION['finish'] == "unfinish") {
    
    if($scanday > 0) {
        $acc_scan_query = "SELECT MEMB_INFO.memb___id, thehe FROM MEMB_INFO JOIN MEMB_STAT ON MEMB_INFO.memb___id collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM> '$time_scan_check'";
        if($_SESSION['thehe'] != 0) {
            $acc_scan_query .= " AND thehe=$thehe";
        }
        
        $acc_scan_query .= " ORDER BY ConnectTM DESC";
    } else {
        $acc_scan_query = "SELECT MEMB_INFO.memb___id , thehe FROM MEMB_INFO JOIN MEMB_STAT ON MEMB_INFO.memb___id collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT";
        if($_SESSION['thehe'] != 0) {
            $acc_scan_query .= " AND thehe=$thehe";
        }
        $acc_scan_query .= " ORDER BY ConnectTM DESC";
    }
    $scan_start = 0;
    while($scan_start < $scan_slg) {
        $acc_scan_result = $db->SelectLimit($acc_scan_query, 1, $_SESSION['acc_scan']) OR DIE("Query Error : $acc_scan_query");
        $acc_scan_fetch = $acc_scan_result->FetchRow();
        $acc = $acc_scan_fetch[0];
        $name = '';
        $thehe = $acc_scan_fetch[1];
        
        $char_pri_query = "SELECT TOP 1 Name, Resets, Relifes FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
        $char_pri_result = $db->Execute($char_pri_query) or die("Query Error: $char_pri_query");
        $char_pri_fetch = $char_pri_result->FetchRow();
        $char_pri_name = $char_pri_fetch[0];
        $char_pri_reset = $char_pri_fetch[1];
        $char_pri_relife = $char_pri_fetch[2];
        
        $_SESSION['acc_scan']++;
        
        // Online
        $online_query = "SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='$acc'";
        $online_result = $db->Execute($online_query);
        $online_fetch = $online_result->FetchRow();
        if($online_fetch[0] == 1) {
        	$online = "<font color='blue'><b>Online</b></font>";
        } else {
        	$online = "<font color='red'>Offline</font>";
        }
        
        // Scan Warehouse
        $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID='$acc'";
        $warehouse_result = $db->Execute($warehouse_query) OR DIE("Query Error : $warehouse_query");
        $warehouse_fetch = $warehouse_result->FetchRow();
        $warehouse = $warehouse_fetch[0];
        
        if(strlen($warehouse) > 0) {
            $warehouse = bin2hex($warehouse);
            $warehouse = strtoupper($warehouse);
            
            $item_total = floor(strlen($warehouse)/32);
            $item_count = 0;
            $vitri = array();
            $level = array();
            $seri = array();
            $key_flag = 0;
            
            for($i=0; $i<$item_total; $i++) {
                $item = substr($warehouse,$i*32, 32);
                
                if($item != $noitem) {
                    $item_seri = substr($item, 6, 8);
                    
                    $item_code = substr($item, 0, 2);
                    $item_type = substr($item, 18, 1);
                    // Lấy thông tin Level
                    $iop 	= hexdec(substr($item,2,2)); 	// Item Level/Skill/Option Data
                    // Kiểm tra LV Item
                    if ($iop>128) $checklv	= $iop-128;
                    else $checklv = $iop;
                    $itemlevel	= floor($checklv/8);
                    
                    // Excellent option check
                    $excline = 0;
                    $group = hexdec($item_type);
                    if(in_array($group, array(0,1,2,3,4,5,6,7,8,9,10,11)) || ($group == 12 && in_array($id, array(0,1,2,3,4,5,6,36,37,38,39,40,41,42,43,49,50,130,131,132,133,134,135) ) ) || ($group == 13 && in_array($id, array(0,1,2,3,8,9,12,13,20,21,22,23,24,25,26,27,28,30,67,80,106,123) ) ) ) {
                        $ioo 	= hexdec(substr($item,14,2)); 	// Item Excellent Info/ Option
                        if($ioo>=64)	{ $iop+=4; $ioo+=-64; }
                    	if($ioo<32)	{ $iopx6=0; } else { $iopx6=1; $ioo+=-32; $excline++; }
                    	if($ioo<16)	{ $iopx5=0; } else { $iopx5=1; $ioo+=-16; $excline++; }
                    	if($ioo<8)	{ $iopx4=0; } else { $iopx4=1; $ioo+=-8; $excline++; }
                    	if($ioo<4)	{ $iopx3=0; } else { $iopx3=1; $ioo+=-4; $excline++; }
                    	if($ioo<2)	{ $iopx2=0; } else { $iopx2=1; $ioo+=-2; $excline++; }
                    	if($ioo<1)	{ $iopx1=0; } else { $iopx1=1; $ioo+=-1; $excline++; }
                    }
                        
                    
                    $item_finded = true;
                    
                    if($item_finded === true && $_SESSION['item_exl']>0) {
                        if($excline >= $_SESSION['item_exl']) {
                            
                        } else {
                            $item_finded = false;
                        }
                    }
                    
                    if($item_finded === true) {
                        if($item_seri === $_SESSION['itemseri']) {
                            
                        } else if(strlen($_SESSION['itemseri']) == 8) {
                            $item_finded = false;
                        }
                    }
                        
                    
                    if($item_finded === true) {
                        if($item_code === $_SESSION['itemcode'] && $item_type === $_SESSION['itemtype'] ) {
                            
                        } else if(strlen($_SESSION['itemcode']) == 2) {
                            $item_finded = false;
                        }
                    }
                        
                                
                    if($item_finded === true) {
                        if($itemlevel < $_SESSION['itemlevel'] || $itemlevel > 15) {
                            $item_finded = false;
                        }
                    }
                    
                
                    if($item_finded === true) {
                        $item_count++;
                        $key_flag++;
                        $vitri[$key_flag] = $i+1;
                        $level[$key_flag] = $itemlevel;
                        $seri[$key_flag] = $item_seri;
                        
                        $item_name[$key_flag] = '';
                        $item_info[$key_flag] = '';
                        $item_image[$key_flag] = '';
                        
                        include('../config_license.php');
                        include_once('../func_getContent.php');
                        $getcontent_url = $url_license . "/api_iteminfo.php";
                        $getcontent_data = array(
                            'acclic'    =>  $acclic,
                            'key'    =>  $key,
                            
                            'item'    =>  $item
                        ); 
                        
                        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                    
                    	if ( empty($reponse) ) {
                            $item_name[$key_flag] = "Không kết nối được đến API";
                            $err = true;
                        }
                        else {
                            $info = read_TagName($reponse, 'info');
                            if($info == "Error") {
                                $item_name[$key_flag] = $reponse;
                            } elseif ($info == "OK") {
                                $iteminfo = read_TagName($reponse, 'iteminfo');
                                $iteminfo_arr = unserialize_safe($iteminfo);
                                
                                $item_name[$key_flag] = $iteminfo_arr['item_name'];
                                $item_info[$key_flag] = $iteminfo_arr['item_info'];
                                $item_image[$key_flag] = $iteminfo_arr['item_image'];
                                $item_seria[$key_flag] = $item_seri;
                            } else {
                                $item_name[$key_flag] = "Kết nối API gặp sự cố.";
                            }
                        }
                    }
                }
            }
            if($item_count > $_SESSION['itemslg']) {
                $item_vitri = "";
                foreach($vitri as $key => $value) {
                    $hang = ceil($value/8);
                    $cot = $value%8;
                    if($cot == 0) $cot = 8;
                    if($level[$key] >= 10 && $level[$key] <= 11) $level_item = "<font color='blue'><b>+$level[$key]</b></font>";
                    elseif($level[$key] >= 12 && $level[$key] <= 13) $level_item = "<font color='brown'><b>+$level[$key]</b></font>";
                    elseif($level[$key] >= 14 && $level[$key] <= 15) $level_item = "<font color='red'><b>+$level[$key]</b></font>";
                    else $level_item = "<<b>+$level[$key]</b>";
                    
                    $item_vitri .= "<span id='itemtooltip_" . $acc . $value ."' class='itemtooltip'>" . $item_name[$key]. " (Seri: <strong><font color='blue'>$item_seria[$key_flag]</font></strong>) <img src='../items/" . $item_image[$key] . ".gif' border=0 /> (Hàng $hang, Cột $cot $level_item)</span> <span id='itemdel_". $acc ."_". $name ."_". $seri[$key] ."_". $value ."'><a href='#' acc='$acc' name='$name' seri='". $seri[$key] ."' vitri='$value' class='itemdel'>Xóa Item</a></span><div id='data_itemtooltip_" . $acc . $value . "' style='display:none;'><div style='background-color: #121212; font-size: 14px; text-align: center; padding: 10px;'><img src='../items/" . $item_image[$key] . ".gif' border=0 /><br />" . $item_info[$key] . "</div></div><br />";
                }
                $itemfinded .= "<tr><td align='center' valign='top'>$acc <i>($thehe)</i> <br />- $online<hr />Char Chính:<br />$char_pri_name (<font color='blue'><strong>$char_pri_reset</strong></font>/<font color='red'><strong>$char_pri_relife</strong></font>)</td><td valign='top'>Hòm Đồ</td><td align='center' valign='top'>$item_count</td><td>$item_vitri</td></tr>";
            }
        }
            
        // Scan Inventory
        $inventory_query = "SELECT Name, CAST(Inventory AS image) FROM Character WHERE AccountID='$acc'";
        $inventory_result = $db->Execute($inventory_query);
        while($inventory_fetch = $inventory_result->FetchRow()) {
            $name = $inventory_fetch[0];
            
            $char_online = "";
            if($online_fetch[0] == 1) {
                $char_online_query = "SELECT GameIDC FROM AccountCharacter WHERE Id='$acc'";
                $char_online_result = $db->Execute($char_online_query);
                    check_queryerror($char_online_query, $char_online_result);
                $char_online_fetch = $char_online_result->FetchRow();
                if($char_online_fetch[0] == $name) $char_online = "<font color='blue'><b>Online</b></font>";
            }
            
            $inventory = $inventory_fetch[1];
            $inventory = bin2hex($inventory);
            $inventory = strtoupper($inventory);
            
            $item_total = floor(strlen($inventory)/32);
            $item_count = 0;
            $vitri = array();
            $level = array();
            $seri = array();
            $key_flag = 0;
            
            for($i=0; $i<$item_total; $i++) {
                $item = substr($inventory,$i*32, 32);
                if($item != $noitem) {
                    $item_seri = substr($item, 6, 8);
                    
                    $item_code = substr($item, 0, 2);
                    $item_type = substr($item, 18, 1);
                    
                    // Lấy thông tin Level
                    $iop 	= hexdec(substr($item,2,2)); 	// Item Level/Skill/Option Data
                    // Kiểm tra LV Item
                    if ($iop>128) $checklv	= $iop-128;
                    else $checklv = $iop;
                    $itemlevel	= floor($checklv/8);
                    
                    // Excellent option check
                    $excline = 0;
                    $group = hexdec($item_type);
                    if(in_array($group, array(0,1,2,3,4,5,6,7,8,9,10,11)) || ($group == 12 && in_array($id, array(0,1,2,3,4,5,6,36,37,38,39,40,41,42,43,49,50,130,131,132,133,134,135) ) ) || ($group == 13 && in_array($id, array(0,1,2,3,8,9,12,13,20,21,22,23,24,25,26,27,28,30,67,80,106,123) ) ) ) {
                        $ioo 	= hexdec(substr($item,14,2)); 	// Item Excellent Info/ Option
                        if($ioo>=64)	{ $iop+=4; $ioo+=-64; }
                    	if($ioo<32)	{ $iopx6=0; } else { $iopx6=1; $ioo+=-32; $excline++; }
                    	if($ioo<16)	{ $iopx5=0; } else { $iopx5=1; $ioo+=-16; $excline++; }
                    	if($ioo<8)	{ $iopx4=0; } else { $iopx4=1; $ioo+=-8; $excline++; }
                    	if($ioo<4)	{ $iopx3=0; } else { $iopx3=1; $ioo+=-4; $excline++; }
                    	if($ioo<2)	{ $iopx2=0; } else { $iopx2=1; $ioo+=-2; $excline++; }
                    	if($ioo<1)	{ $iopx1=0; } else { $iopx1=1; $ioo+=-1; $excline++; }
                    }
                        
                    
                    $item_finded = true;
                    
                    if($item_finded === true && $_SESSION['item_exl']>0) {
                        if($excline >= $_SESSION['item_exl']) {
                            
                        } else {
                            $item_finded = false;
                        }
                    }
                    
                    if($item_finded === true) {
                        if($item_seri === $_SESSION['itemseri']) {
                            
                        } else if(strlen($_SESSION['itemseri']) == 8) {
                            $item_finded = false;
                        }
                    }
                        
                    
                    if($item_finded === true) {
                        if($item_code === $_SESSION['itemcode'] && $item_type === $_SESSION['itemtype'] ) {
                            
                        } else if(strlen($_SESSION['itemcode']) == 2) {
                            $item_finded = false;
                        }
                    }
                        
                                
                    if($item_finded === true) {
                        if($itemlevel < $_SESSION['itemlevel'] || $itemlevel > 15 ) {
                            $item_finded = false;
                        }
                    }
                    
                
                    if($item_finded === true) {
                        $item_count++;
                        $key_flag++;
                        $vitri[$key_flag] = $i+1;
                        $level[$key_flag] = $itemlevel;
                        $seri[$key_flag] = $item_seri;
                        
                        $item_name[$key_flag] = '';
                        $item_info[$key_flag] = '';
                        $item_image[$key_flag] = '';
                        
                        include('../config_license.php');
                        include_once('../func_getContent.php');
                        $getcontent_url = $url_license . "/api_iteminfo.php";
                        $getcontent_data = array(
                            'acclic'    =>  $acclic,
                            'key'    =>  $key,
                            
                            'item'    =>  $item
                        ); 
                        
                        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                    
                    	if ( empty($reponse) ) {
                            $item_name[$key_flag] = "Không kết nối được đến API";
                            $err = true;
                        }
                        else {
                            $info = read_TagName($reponse, 'info');
                            if($info == "Error") {
                                $item_name[$key_flag] = $reponse;
                            } elseif ($info == "OK") {
                                $iteminfo = read_TagName($reponse, 'iteminfo');
                                $iteminfo_arr = unserialize_safe($iteminfo);
                                
                                $item_name[$key_flag] = $iteminfo_arr['item_name'];
                                $item_info[$key_flag] = $iteminfo_arr['item_info'];
                                $item_image[$key_flag] = $iteminfo_arr['item_image'];
                                $item_seria[$key_flag] = $item_seri;
                            } else {
                                $item_name[$key_flag] = "Kết nối API gặp sự cố.";
                            }
                        }
                    }
                }
            }
            
            if($item_count > $_SESSION['itemslg']) {
                $item_vitri = "";
                foreach($vitri as $key => $value) {
                    
                    if($level[$key] >= 10 && $level[$key] <= 11) $level_item = "<font color='blue'><b>+$level[$key]</b></font>";
                    elseif($level[$key] >= 12 && $level[$key] <= 13) $level_item = "<font color='brown'><b>+$level[$key]</b></font>";
                    elseif($level[$key] >= 14 && $level[$key] <= 15) $level_item = "<font color='red'><b>+$level[$key]</b></font>";
                    else $level_item = "<<b>+$level[$key]</b>";
    	                
                    if($value <= 12) {
                        switch ($value){ 
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
                        }
                        $item_vitri .= "<span id='itemtooltip_" . $acc . $name . $value ."' class='itemtooltip'>" . $item_name[$key] . " (Seri: <strong><font color='blue'>$item_seria[$key_flag]</font></strong>) <img src='../items/" . $item_image[$key] . ".gif' border=0 /> ($name_item $level_item)</span> <span id='itemdel_". $acc ."_". $name ."_". $seri[$key] ."_". $value ."'><a href='#' acc='$acc' name='$name' seri='". $seri[$key] ."' vitri='$value' class='itemdel'>Xóa Item</a></span><div id='data_itemtooltip_" . $acc . $name . $value . "' style='display:none;'><div style='background-color: #121212; font-size: 14px; text-align: center; padding: 10px;'><img src='../items/" . $item_image[$key] . ".gif' border=0 /><br />" . $item_info[$key] . "</div></div><br />";
                    } else {
                        $vitri_new = $value - 12;
                        $hang = ceil($vitri_new/8);
                        $cot = $vitri_new%8;
                        if($cot == 0) $cot = 8;
                        
    	                $item_vitri .= "<span id='itemtooltip_" . $acc . $name . $value ."' class='itemtooltip'>" . $item_name[$key]. " (Seri: <strong><font color='blue'>$item_seria[$key_flag]</font></strong>) <img src='../items/" . $item_image[$key] . ".gif' border=0 /> (Hàng $hang, Cột $cot $level_item)</span> <span id='itemdel_". $acc ."_". $name ."_". $seri[$key] ."_". $value ."'><a href='#' acc='$acc' name='$name' seri='". $seri[$key] ."' vitri='$value' class='itemdel'>Xóa Item</a></span><div id='data_itemtooltip_" . $acc . $name . $value . "' style='display:none;'><div style='background-color: #121212; font-size: 14px; text-align: center; padding: 10px;'><img src='../items/" . $item_image[$key] . ".gif' border=0 /><br />" . $item_info[$key] . "</div></div><br />";
                    }
                }
                $itemfinded .= "<tr><td align='center' valign='top'>$acc <i>($thehe)</i> <br /> $online<hr />Char Chính:<br />$char_pri_name (<font color='blue'><strong>$char_pri_reset</strong></font>/<font color='red'><strong>$char_pri_relife</strong></font>)</td><td align='center' valign='top'>$name <br /> $char_online</td><td align='center' valign='top'>$item_count</td><td>$item_vitri</td></tr>";
            }
            $_SESSION['inventory_scan']++;
        }
        $scan_start++;
        if( $_SESSION['acc_scan'] >= $_SESSION['acc_total_scan']) {
            $_SESSION['finish'] = "finish";
            break;
        }
    }
        
    echo "|$itemfinded|";
} else {
    echo "<strong>Đã Quét hoàn tất</strong>.|finish|";
}
$db->Close();
?>