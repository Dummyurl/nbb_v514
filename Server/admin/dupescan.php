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
include_once("../func_timechenh.php");

$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

    $dupeday = $_SESSION['dupeday'];
    $time_scan_check = $timestamp - $dupeday*24*60*60;
    $time_scan_check = date('m/d/Y H:i:s', $time_scan_check);
    switch ($dupeday){ 
    	case 1:
            $viewscan = "Quét đồ Dupe của những nhân vật, tài khoản Online trong <strong>1 ngày</strong> trở lại đây";
    	break;
    
    	case 2:
            $viewscan = "Quét đồ Dupe của những nhân vật, tài khoản Online trong <strong>2 ngày</strong> trở lại đây";
    	break;
    
    	case 3:
            $viewscan = "Quét đồ Dupe của những nhân vật, tài khoản Online trong <strong>3 ngày</strong> trở lại đây";
    	break;
        
        case 7:
            $viewscan = "Quét đồ Dupe của những nhân vật, tài khoản Online trong <strong>7 ngày</strong> trở lại đây";
    	break;
        
        case 30:
            $viewscan = "Quét đồ Dupe của những nhân vật, tài khoản Online trong <strong>30 ngày</strong> trở lại đây";
    	break;
        
    	default :
            $viewscan = "Quét đồ Dupe Toàn Server";
    }

echo "<i>Có thể Quét khi Server đang Online nhưng phải xóa đồ Dupe lúc Server bảo trì. Nếu Server Online có thể sẽ không xóa được đồ Dupe do nhân vật đang sử dụng.</i><br /><br />";
echo $viewscan . "<br />";
    
if(!$_SESSION['data_first']) {
    if($dupeday > 0) {
        $warehouse_total_query = "SELECT count(*) FROM warehouse JOIN MEMB_STAT ON warehouse.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM > '$time_scan_check'";
        $inventory_total_query = "SELECT count(*) FROM Character JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM > '$time_scan_check'";
    } else {
        $warehouse_total_query = "SELECT count(*) FROM warehouse";
        $inventory_total_query = "SELECT count(*) FROM Character";
    }
    
    $warehouse_total_result = $db->Execute($warehouse_total_query) OR DIE("Query Error : $warehouse_total_query");
    $warehouse_total_fetch = $warehouse_total_result->FetchRow();
    $_SESSION['warehouse_total_scan'] = $warehouse_total_fetch[0];

    
    $inventory_total_result = $db->Execute($inventory_total_query) OR DIE("Query Error : $inventory_total_query");
    $inventory_total_fetch = $inventory_total_result->FetchRow();
    $_SESSION['inventory_total_scan'] = $inventory_total_fetch[0];
    
    $_SESSION['data_first'] = true;
}

echo "Đã quét hòm đồ : " . $_SESSION['warehouse_scan'] . " / " . $_SESSION['warehouse_total_scan'] . "<br />";
echo "Đã quét nhân vật : " . $_SESSION['inventory_scan'] . " / " . $_SESSION['inventory_total_scan'] . "<br />";

$dupe_total_query = "SELECT SUM(slgitem) FROM Dupe_Scan WHERE isdupe=1";
$dupe_total_result = $db->Execute($dupe_total_query);
$dupe_total_fetch = $dupe_total_result->FetchRow();
$dupe_total = $dupe_total_fetch[0];
if(strlen($dupe_total) == 0) $dupe_total = 0;
echo "Số lượng Item Dupe : <strong>" . $dupe_total . "</strong><br />";

$time_begin = date("H:i:s d/m", $_SESSION['timebegin']);
echo "Bắt đầu quét lúc : $time_begin<br />";
$time_dukien = date("H:i:s d/m", $_SESSION['timebegin'] + floor($_SESSION['warehouse_total_scan'] + $_SESSION['inventory_total_scan'])/2 );
echo "Thời gian dự kiến quét đến : $time_dukien<br />";
$time_scan = _time() - $_SESSION['timebegin'];
$hour_scan = floor($time_scan / 3600);
$minute_scan = floor(($time_scan % 3600) / 60);
$second_scan = $time_scan % 60;
echo "Đã quét : $hour_scan giờ $minute_scan phút $second_scan giây";

echo "<hr />";

if($_SESSION['finish'] == "unfinish") {
    // Scan Warehouse
    if($_SESSION['scan'] == "warehouse") {
        if($dupeday > 0) {
            $warehouse_query = "SELECT AccountID, CAST(Items AS image) FROM warehouse JOIN MEMB_STAT ON warehouse.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM> '$time_scan_check' ORDER BY ConnectStat DESC, DisConnectTM DESC, AccountID";
        } else {
            $warehouse_query = "SELECT AccountID, CAST(Items AS image) FROM warehouse JOIN MEMB_STAT ON warehouse.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT ORDER BY ConnectStat DESC, DisConnectTM DESC, AccountID";
        }
        
        $warehouse_result = $db->SelectLimit($warehouse_query, 1, $_SESSION['warehouse_scan']) OR DIE("Query Error : $warehouse_query");
        $warehouse_fetch = $warehouse_result->FetchRow();
        $acc = $warehouse_fetch[0];
        $warehouse = $warehouse_fetch[1];
        $warehouse = bin2hex($warehouse);
        $warehouse = strtoupper($warehouse);
    
        echo "Đang quét hòm đồ tài khoản : <strong>$acc</strong> <br />";
        
        $item_total = floor(strlen($warehouse)/32);
        $seri_arr = array();
        for($i=0; $i<$item_total; $i++) {
            $item = substr($warehouse,$i*32, 32);
            if($item != $noitem) {
                $seri = substr($item, 6, 8);
                if($seri != "00000000" && $seri != "FFFFFFFF") {
                    if(in_array($seri, $seri_arr)) {
                        $warehouse_dupe_update_query = "UPDATE Dupe_Scan SET slgitem=slgitem+1, isdupe=1 WHERE acc='$acc' AND seri='$seri'";
                        $warehouse_dupe_update_result = $db->Execute($warehouse_dupe_update_query);
                    } else {
                        $seri_arr[] = $seri;
                        $seri_check_query = "SELECT count(*) FROM Dupe_Scan WHERE seri='$seri'";
                        $seri_check_result = $db->Execute($seri_check_query);
                        $seri_check_fetch = $seri_check_result->FetchRow();
                        
                        if($seri_check_fetch[0] == 0) $isdupe = 0;
                        else $isdupe = 1;
                        
                        $warehouse_dupe_insert_query = "INSERT INTO Dupe_Scan (acc, item, seri) VALUES ('$acc', '$item', '$seri')";
                        $warehouse_dupte_insert_result = $db->Execute($warehouse_dupe_insert_query);
                        
                        if($isdupe == 1) {
                            $checkdupeware_query = "SELECT CAST(Items AS image) FROM warehouse JOIN Dupe_Scan ON warehouse.AccountID collate DATABASE_DEFAULT = Dupe_Scan.acc collate DATABASE_DEFAULT AND acc<>'$acc' AND seri='$seri'";
                            $checkdupeware_result = $db->Execute($checkdupeware_query);
                            while($checkdupeware_fetch = $checkdupeware_result->FetchRow()) {
                                $warehouse = $checkdupeware_fetch[0];
                                $warehouse = bin2hex($warehouse);
                                $warehouse = strtoupper($warehouse);
                                
                                // Khong phai do dupe
                                if(strpos($warehouse, $seri) === false) {
                                    $isdupe = 0;
                                } 
                                // La do Dupe
                                else {
                                    $dupe_updateitem_query = "UPDATE Dupe_Scan SET isdupe=1 WHERE seri='$seri' AND isdupe=0";
                                    $dupe_updateitem_result = $db->Execute($dupe_updateitem_query);
                                }
                            }
                        }
                    }
                }
            }
        }
        unset($seri_arr);
        
        $_SESSION['warehouse_scan']++;
        if( $_SESSION['warehouse_scan'] >= $_SESSION['warehouse_total_scan']) $_SESSION['scan'] = "inventory";
    }
    // Scan Inventory
    elseif($_SESSION['scan'] == "inventory") {
        if($dupeday > 0) {
            $inventory_query = "SELECT AccountID, Name, CAST(Inventory AS image) FROM Character JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT AND ConnectTM > '$time_scan_check' ORDER BY ConnectStat DESC, DisConnectTM DESC, AccountID, Name";
        } else {
            $inventory_query = "SELECT AccountID, Name, CAST(Inventory AS image) FROM Character JOIN MEMB_STAT ON Character.AccountID collate DATABASE_DEFAULT = MEMB_STAT.memb___id collate DATABASE_DEFAULT ORDER BY ConnectStat DESC, DisConnectTM DESC, AccountID, Name";
        }
        
        $inventory_result = $db->SelectLimit($inventory_query, 1, $_SESSION['inventory_scan']);
        $inventory_fetch = $inventory_result->FetchRow();
        $acc = $inventory_fetch[0];
        $name = $inventory_fetch[1];
        $inventory = $inventory_fetch[2];
        $inventory = bin2hex($inventory);
        $inventory = strtoupper($inventory);
    
        echo "Đang quét Nhân vật : <strong>$name</strong> của tài khoản <strong>$acc</strong> <br />";
        
        $item_total = floor(strlen($inventory)/32);
        $seri_arr = array();
        for($i=0; $i<$item_total; $i++) {
            $item = substr($inventory,$i*32, 32);
            if($item != $noitem) {
                $seri = substr($item, 6, 8);
                if($seri != "00000000" && $seri != "FFFFFFFF") {
                    if(in_array($seri, $seri_arr)) {
                        $inventory_dupe_update_query = "UPDATE Dupe_Scan SET slgitem=slgitem+1, isdupe=1 WHERE acc='$acc' AND name='$name' AND seri='$seri'";
                        $inventory_dupe_update_result = $db->Execute($inventory_dupe_update_query);
                    } else {
                        $seri_check_query = "SELECT count(*) FROM Dupe_Scan WHERE seri='$seri'";
                        $seri_check_result = $db->Execute($seri_check_query);
                        $seri_check_fetch = $seri_check_result->FetchRow();
                        
                        if($seri_check_fetch[0] == 0) $isdupe = 0;
                        else $isdupe = 1;
                        
                        $inventory_dupe_insert_query = "INSERT INTO Dupe_Scan (acc, name, item, seri) VALUES ('$acc', '$name', '$item', '$seri')";
                        $inventory_dupte_insert_result = $db->Execute($inventory_dupe_insert_query);
                        
                        if($isdupe == 1) {
                            $checkdupeware_query = "SELECT CAST(Items AS image) FROM warehouse JOIN Dupe_Scan ON warehouse.AccountID collate DATABASE_DEFAULT = Dupe_Scan.acc collate DATABASE_DEFAULT AND acc<>'$acc' AND seri='$seri' AND name IS NULL";
                            $checkdupeware_result = $db->Execute($checkdupeware_query);
                            while($checkdupeware_fetch = $checkdupeware_result->FetchRow()) {
                                $warehouse = $checkdupeware_fetch[0];
                                $warehouse = bin2hex($warehouse);
                                $warehouse = strtoupper($warehouse);
                                
                                // Khong phai do dupe
                                if(strpos($warehouse, $seri) === false) {
                                    $isdupe = 0;    // Khong ton tai Item dupe trong hom do
                                } 
                                // La do Dupe
                                else {
                                    $dupe_updateitem_query = "UPDATE Dupe_Scan SET isdupe=1 WHERE seri='$seri' AND isdupe=0";
                                    $dupe_updateitem_result = $db->Execute($dupe_updateitem_query);
                                }
                            }
                            // Check tren nhan vat 
                            if($isdupe == 0) {
                                $checkdupeInven_query = "SELECT CAST(Inventory AS image) FROM Character JOIN Dupe_Scan ON Character.Name collate DATABASE_DEFAULT = Dupe_Scan.name collate DATABASE_DEFAULT AND Dupe_Scan.name<>'$name' AND seri='$seri'";
                                $checkdupeInven_result = $db->Execute($checkdupeInven_query);
                                while($checkdupeInven_fetch = $checkdupeInven_result->FetchRow()) {
                                    $Inventory = $checkdupeInven_fetch[0];
                                    $Inventory = bin2hex($Inventory);
                                    $Inventory = strtoupper($Inventory);
                                    
                                    // Khong phai do dupe
                                    if(strpos($Inventory, $seri) === false) {
                                        $isdupe = 0;    // Khong ton tai Item dupe trong hom do
                                    } 
                                    // La do Dupe
                                    else {
                                        $dupe_updateitem_query = "UPDATE Dupe_Scan SET isdupe=1 WHERE seri='$seri' AND isdupe=0";
                                        $dupe_updateitem_result = $db->Execute($dupe_updateitem_query);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        unset($seri_arr);
        
        $_SESSION['inventory_scan']++;
        if( $_SESSION['inventory_scan'] >= $_SESSION['inventory_total_scan']) $_SESSION['finish'] = "finish";
    }
} else {
    echo "<strong>Đã Quét hoàn tất</strong>.";
}
$db->Close();
?>