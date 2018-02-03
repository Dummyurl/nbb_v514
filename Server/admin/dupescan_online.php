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
$dupe_block = false;    // true: Khóa khi phát hiện Dupe, false: Không khóa
$scan_slg = 50;       // So luong Tai khoan Quet tren 1 lan load trang
$time_scan_between = 10;    // minutes

function _strpos_all($haystack, $needle, $offset = 0, &$results = array()) {               
    $offset = strpos($haystack, $needle, $offset);
    if($offset === false) {
        return $results;            
    } else {
        $results[] = $offset;
        return _strpos_all($haystack, $needle, ($offset + 1), $results);
    }
}


echo "<i>Sử dụng khi Server đang Online. Block những tài khoản có chứa đồ Dupe. Không xóa đồ Dupe, Admin tự kiểm tra cho chính xác rồi mới đưa ra biện pháp xử lý.</i><br /><br />";

$time_end_loop = _time() - $_SESSION['time_endloop'];
if($time_end_loop < $time_scan_between*60) {
    $time_wait_begin_loop = $time_scan_between*60 - $time_end_loop;
    echo "<strong>Đang chờ ". $time_wait_begin_loop. "s ...</strong>";
} else {
    if($_SESSION['scanonline'] == 0) {
        
        $time_dis_scan = date('Y-m-d H:i:s', _time() - $time_scan_between*60);
    
        $online_query = "SELECT memb___id FROM MEMB_STAT WHERE ConnectStat=1 OR (ConnectStat=0 AND DisConnectTM>'$time_dis_scan') ORDER BY ConnectStat DESC, DisConnectTM DESC, ServerName";
        $online_result = $db->Execute($online_query) OR DIE("Query Error : $online_query");
        $online = array();
        while($online_fetch = $online_result->FetchRow()) {
            $online[] = $online_fetch[0];
        }
        
        if(count($online>0)) {
            $_SESSION['acconline'] = $online;
            $_SESSION['total_scan'] = count($online);
            
            unset($_SESSION['Dupe_Scan_Online']);
            $_SESSION['Dupe_Scan_Online'] = array();
            
            unset($_SESSION['seri']);
            $_SESSION['seri'] = array();
            
            unset($_SESSION['seri_dupe']);
            $_SESSION['seri_dupe'] = array();
        }
    } 
    
    if($_SESSION['total_scan'] > 0 AND $_SESSION['scanonline'] < $_SESSION['total_scan']) {
    /////////////////////////////////////////////////////////////////////////////////
        
        $itemdupe_checked_online_query = "SELECT count(*) FROM Dupe_Online";
    	$itemdupe_checked_online_result = $db->Execute($itemdupe_checked_online_query) OR DIE("Query Error : $itemdupe_checked_online_query");
    	$itemdupe_checked_online_fetch = $itemdupe_checked_online_result->FetchRow();
    	if(strlen($itemdupe_checked_online_fetch[0]) == 0) $itemdupe_checked_online = 0;
    	else $itemdupe_checked_online = $itemdupe_checked_online_fetch[0];
    
    	echo "Số Item Dupe phát hiện khi quét Online : <strong>$itemdupe_checked_online</strong><br />";
    /////////////////////////////////////////////////////////////////////////////////    
        
        echo "Đang Quét : " . $_SESSION['scanonline'] . "/" . $_SESSION['total_scan'] . " trường hợp.<br />";
        
        $scan_start = 1;
            
        while($scan_start <= $scan_slg) {
            $accid_scan = $_SESSION['scanonline'];
            $acc_scan = $_SESSION['acconline'][$accid_scan];
        
            $name_scan_query = "SELECT GameIDC FROM AccountCharacter WHERE Id='$acc_scan'";
            $name_scan_result = $db->Execute($name_scan_query) OR DIE("Query Error : $name_scan_query");
            $name_scan_fetch = $name_scan_result->FetchRow();
            $name_scan = $name_scan_fetch[0];
            
            $isdupe = false;
            
            $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID='$acc_scan'";
            $warehouse_result = $db->Execute($warehouse_query) OR DIE("Query Error : $warehouse_query");
            $warehouse_fetch = $warehouse_result->FetchRow();
            
            if(strlen($warehouse_fetch[0]) > 0) {
                $warehouse = $warehouse_fetch[0];
                $warehouse = bin2hex($warehouse);
                $warehouse = strtoupper($warehouse);
                
                $item_warehouse_total = floor(strlen($warehouse)/32);
                for($i=0; $i<$item_warehouse_total; $i++) {
                    $item = substr($warehouse,$i*32, 32);
                    if($item != $noitem) {
                        $seri = substr($item, 6, 8);
                        if($seri != "00000000" && substr($seri, 0, 7) != "FFFFFFF") {
                            $vitri = $i+1;
                            
                            $_SESSION['Dupe_Scan_Online'][] = array(
                                'acc'   =>  $acc_scan,
                                'name'  =>  '',
                                'item'  =>  $item,
                                'seri'  =>  $seri,
                                'vitri' =>  $vitri
                            );
                            
                            if(isset($_SESSION['seri'][$seri])) {
                                $_SESSION['seri'][$seri]++;
                            } else {
                                $_SESSION['seri'][$seri] = 1;
                            }
                        }
                    }
                }
            }
                
        
            // Scan nhan vat cua tai khoan
            $inventory_query = "SELECT Name, CAST(Inventory AS image) FROM Character WHERE AccountID='$acc_scan'";
            $inventory_result = $db->Execute($inventory_query) OR DIE("Query Error : $inventory_query");
            while($inventory_fetch = $inventory_result->FetchRow()) {
                $name_scan = $inventory_fetch[0];
                $Inventory = $inventory_fetch[1];
                $Inventory = bin2hex($Inventory);
                $Inventory = strtoupper($Inventory);
                
                $item_inventory_total = floor(strlen($Inventory)/32) - 32;  // Kg tinh 32 o cua hang ca nhan
                for($i=0; $i<$item_inventory_total; $i++) {
                    $item = substr($Inventory,$i*32, 32);
                    if($item != $noitem) {
                        $seri = substr($item, 6, 8);
                        if($seri != "00000000" && substr($seri, 0, 7) != "FFFFFFF") {
                            $vitri = $i+1;
                            
                            $_SESSION['Dupe_Scan_Online'][] = array(
                                'acc'   =>  $acc_scan,
                                'name'  =>  $name_scan,
                                'item'  =>  $item,
                                'seri'  =>  $seri,
                                'vitri' =>  $vitri
                            );
                            
                            if(isset($_SESSION['seri'][$seri])) {
                                $_SESSION['seri'][$seri]++;
                            } else {
                                $_SESSION['seri'][$seri] = 1;
                            }
                        }
                    }
                }
            }
            
            $_SESSION['scanonline']++;
            
            if($_SESSION['scanonline'] >= $_SESSION['total_scan']) {
                $_SESSION['checkdupe'] = 1;
                break;
            }
            
            $scan_start++;
        }
    } 
    // Quet Online ket thuc, Chuyen du lieu Dupe va khoa tai khoan, nhan vat
    elseif($_SESSION['checkdupe'] == 1) {
    /////////////////////////////////////////////////////////////////////////////////
        $itemdupe_checked_online_query = "SELECT count(*) FROM Dupe_Online";
    	$itemdupe_checked_online_result = $db->Execute($itemdupe_checked_online_query) OR DIE("Query Error : $itemdupe_checked_online_query");
    	$itemdupe_checked_online_fetch = $itemdupe_checked_online_result->FetchRow();
    	if(strlen($itemdupe_checked_online_fetch[0]) == 0) $itemdupe_checked_online = 0;
    	else $itemdupe_checked_online = $itemdupe_checked_online_fetch[0];
    
    	echo "Số Item Dupe phát hiện khi quét Online : <strong>$itemdupe_checked_online</strong><br />";
    ///////////////////////////////////////////////////////////////////////////////// 
        
        echo "Khóa tài khoản, nhân vật chứa đồ Dupe";
        
        // Loc Seri Dupe
        foreach($_SESSION['seri'] as $key => $val) {
            if($val > 1) {
                $_SESSION['seri_dupe'][] = $key;
            }
        }
        
        // Kiem tra du lieu Dupe
        foreach($_SESSION['Dupe_Scan_Online'] as $dataitem) {
            if(in_array($dataitem['seri'], $_SESSION['seri_dupe'])) {
                $acc_dupe = $dataitem['acc'];
                $name_dupe = $dataitem['name'];
                $seri_dupe = $dataitem['seri'];
                $item_dupe = $dataitem['item'];
                $vitri = $dataitem['vitri'];
                
                // Item Dupe in Inventory
                if(strlen($name_dupe) > 0) {
                    // Check Data in Table Dupe
                    $datadupe_check_query = "SELECT count(*) FROM Dupe_Online WHERE acc='$acc_dupe' AND name='$name_dupe' AND seri='$seri_dupe' AND vitri=$vitri";
                    $datadupe_check_result = $db->Execute($datadupe_check_query) OR DIE("Query Error : $datadupe_check_query");
                    $datadupe_check_fetch = $datadupe_check_result->FetchRow();
                    if($datadupe_check_fetch[0] == 0) {
                        $insert_datadupe_query = "INSERT INTO Dupe_Online (acc, name, item, seri, vitri, time ) VALUES ('$acc_dupe', '$name_dupe', '$item_dupe', '$seri_dupe', $vitri, $timestamp)";
                        $insert_datadupe_result = $db->Execute($insert_datadupe_query) OR DIE("Query Error : $insert_datadupe_query");
                    
                        $log_duped = "";
                        if($dupe_block === true) {
                            $char_block_query = "UPDATE Character SET ctlcode='99', ErrorSubBlock=99 WHERE name='$name_dupe'";
                            $char_block_result = $db->Execute($char_block_query) OR DIE("Query Error : $char_block_query");
                            
                            $acc_block_query = "Update MEMB_INFO SET [bloc_code]='1',admin_block='1' WHERE memb___id='$acc_dupe'";
                            $acc_block_result = $db->Execute($acc_block_query) OR DIE("Query Error : $acc_block_query");
                            
                            $log_duped = " Khóa tài khoản, nhân vật.";
                        }
                        
                        // Ghi vào Log nhung nhan vàt Block do Dupe
                        $log_acc = "$acc_dupe";
                        $log_gcoin = 0;
                        $log_gcoin_km = 0;
                        $log_vpoint = 0;
                        $log_price = "-";
                        
                        $log_Des = "Tài khoản <b>$acc_dupe</b> - Nhân vật <strong>$name_dupe</strong> chứa đồ Dup Seri : <strong>$seri_dupe</strong>.". $log_duped;
                        $log_time = $timestamp;
                        
                        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                        $insert_log_result = $db->execute($insert_log_query) OR DIE("Query Error : $insert_log_query");
                        // End Ghi vào Log nhung nhan vàt Block do Dupe
                        
                    }
                } 
                // Item Dupe in WareHouse
                else {
                    // Check Data in Table Dupe
                    $datadupe_check_query = "SELECT count(*) FROM Dupe_Online WHERE acc='$acc_dupe' AND seri='$seri_dupe' AND (name='' OR name IS NULL) AND vitri=$vitri";
                    $datadupe_check_result = $db->Execute($datadupe_check_query) OR DIE("Query Error : $datadupe_check_query");
                    $datadupe_check_fetch = $datadupe_check_result->FetchRow();
                    if($datadupe_check_fetch[0] == 0) {
                        $insert_datadupe_query = "INSERT INTO Dupe_Online (acc, item, seri, vitri, time ) VALUES ('$acc_dupe', '$item_dupe', '$seri_dupe', $vitri, $timestamp)";
                        $insert_datadupe_result = $db->Execute($insert_datadupe_query) OR DIE("Query Error : $insert_datadupe_query");
                    
                        $log_duped = "";
                        if($dupe_block === true) {
                            $acc_block_query = "Update MEMB_INFO SET [bloc_code]='1',admin_block='1' WHERE memb___id='$acc_dupe'";
                            $acc_block_result = $db->Execute($acc_block_query) OR DIE("Query Error : $acc_block_query");
                            
                            $log_duped = " Khóa tài khoản, nhân vật.";
                        }
                        
                        // Ghi vào Log nhung nhan vàt Block do Dupe
                        $log_acc = "$acc_dupe";
                        $log_gcoin = 0;
                        $log_gcoin_km = 0;
                        $log_vpoint = 0;
                        $log_price = "-";
                        
                        $log_Des = "Tài khoản <b>$acc_dupe</b> - chứa đồ Dup Seri : <strong>$seri_dupe</strong> trong hòm đồ.". $log_duped;
                        $log_time = $timestamp;
                        
                        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                        $insert_log_result = $db->Execute($insert_log_query) OR DIE("Query Error : $insert_log_query");
                        // End Ghi vào Log nhung nhan vàt Block do Dupe
                        
                    }
                }
            }
        }
    
        $_SESSION['checkdupe'] = 2;
        $_SESSION['checkdupe_scan'] = 0;
        $_SESSION['checkdupe2_repeat'] = 1;
    }
    // Kiem tra du lieu Dupe giai doan 2
    elseif($_SESSION['checkdupe'] == 2) {
    /////////////////////////////////////////////////////////////////////////////////
        $itemdupe_checked_online_query = "SELECT count(*) FROM Dupe_Online";
    	$itemdupe_checked_online_result = $db->Execute($itemdupe_checked_online_query) OR DIE("Query Error : $itemdupe_checked_online_query");
    	$itemdupe_checked_online_fetch = $itemdupe_checked_online_result->FetchRow();
    	if(strlen($itemdupe_checked_online_fetch[0]) == 0) $itemdupe_checked_online = 0;
    	else $itemdupe_checked_online = $itemdupe_checked_online_fetch[0];
    
    	echo "Số Item Dupe phát hiện khi quét Online : <strong>$itemdupe_checked_online</strong><br />";
    ///////////////////////////////////////////////////////////////////////////////// 
        $scan_start = 1;
        while($scan_start <= $scan_slg) {
            // Check Du lieu Dupe
            $dupe_total_query = "SELECT count(*) FROM Dupe_Online";
            $dupe_total_result = $db->Execute($dupe_total_query) OR DIE("Query Error : $dupe_total_query");
            $dupe_total_fetch =  $dupe_total_result->FetchRow();
            $dupe_total = $dupe_total_fetch[0];
        
            if($dupe_total > 0) {
                $nodupe = false;
                $dupe_data_query = "SELECT acc, name, item, seri, vitri FROM Dupe_Online";
                $dupe_data_result = $db->SelectLimit($dupe_data_query, 1, $_SESSION['checkdupe_scan']) OR DIE("Query Error : $dupe_data_query");
                $dupe_data_fetch = $dupe_data_result->FetchRow();
                if(strlen($dupe_data_fetch[0]) > 0) {
                    $acc_dupe = $dupe_data_fetch[0];
                    $name_dupe = $dupe_data_fetch[1];
                    $item_dupe = $dupe_data_fetch[2];
                    $seri_dupe = $dupe_data_fetch[3];
                    $vitri = $dupe_data_fetch[4];
                    
                    $notice = "Kiểm tra Item Dupe";
                    if(strlen($name_dupe) > 0) $notice .= " trên nhân vật <strong>$name_dupe</strong>";
                    $notice .= " của tài khoản <strong>$acc_dupe</strong><br />";
                    //echo $notice;
                    
                    // Dem so luong Dupe
                    $slgdupe_query = "SELECT count(*) FROM Dupe_Online WHERE seri='$seri_dupe'";
                    $slgdupe_result = $db->Execute($slgdupe_query) OR DIE("Query Error : $slgdupe_query");
                    $slgdupe_fetch = $slgdupe_result->FetchRow();
                    $slgdupe = $slgdupe_fetch[0];
                    // Neu chi co duy nhat 1 du lieu dupe, xoa du lieu dupe do
                    if($slgdupe == 1) {
                        // Xoa du lieu dupe
                        $dupe_del_query = "DELETE FROM Dupe_Online WHERE seri='$seri_dupe'";
                        $dupe_del_result = $db->Execute($dupe_del_query) OR DIE("Query Error : $dupe_del_query");
                        
                        $_SESSION['checkdupe_scan']--;
                        $nodupe = true;
                        $test = 1;
                    } 
                    // Neu co nhieu du lieu Dupe, kiem tra du lieu Dupe hien tai
                    else {
                        // Du lieu dupe nam tren nhan vat
                        if(strlen($name_dupe) > 0) {
                            $inventory_chardupe_query = "SELECT CAST(Inventory AS image) FROM Character WHERE name='$name_dupe'";
                            $inventory_chardupe_result = $db->Execute($inventory_chardupe_query) OR DIE("Query Error : $inventory_chardupe_query");
                            $inventory_chardupe_fetch = $inventory_chardupe_result->FetchRow();
                            $inventory_chardupe = $inventory_chardupe_fetch[0];
                            $inventory_chardupe = bin2hex($inventory_chardupe);
                            $inventory_chardupe = strtoupper($inventory_chardupe);
                            $seri_in_vitri = substr($inventory_chardupe, ($vitri-1)*32+6, 8);
                            
                            // Khong chua item dupe
                            if($seri_in_vitri != $seri_dupe) {
                                // Xoa du lieu dupe
                                $dupe_del_query = "DELETE FROM Dupe_Online WHERE seri='$seri_dupe' AND name='$name_dupe' AND vitri=$vitri";
                                $dupe_del_result = $db->Execute($dupe_del_query) OR DIE("Query Error : $dupe_del_query");
                                $_SESSION['checkdupe_scan']--;
                                $nodupe = true;
    
                            }
                            $test = 2;
                        } 
                        // Du lieu Dupe trong ruong do
                        else {
                            $warehouse_accdupe_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID='$acc_dupe'";
                            $warehouse_accdupe_result = $db->Execute($warehouse_accdupe_query) OR DIE("Query Error : $warehouse_accdupe_query");
                            $warehouse_accdupe_fetch = $warehouse_accdupe_result->FetchRow();
                            $warehouse_accdupe = $warehouse_accdupe_fetch[0];
                            $warehouse_accdupe = bin2hex($warehouse_accdupe);
                            $warehouse_accdupe = strtoupper($warehouse_accdupe);
                            
                            // Kiem tra vi tri Item Dupe
                            $item_check = substr($warehouse_accdupe, ($vitri-1)*32, 32);
                            $seri_check = substr($item_check, 6, 8);
                            if($seri_check != $seri_dupe) {
                                // Xoa du lieu dupe
                                $dupe_del_query = "DELETE FROM Dupe_Online WHERE seri='$seri_dupe' AND acc='$acc_dupe' AND (name IS NULL OR name = '') AND vitri=$vitri";
                                $dupe_del_result = $db->Execute($dupe_del_query) OR DIE("Query Error : $dupe_del_query");
                            }
                            $test = 3;
                        }
                    }
                    
                    // Giai Block
                    if(strlen($name_dupe) > 0) {
                        // Check Nhan vat co chua do dupe khong
                        $char_dupe_check_query = "SELECT count(*) FROM Dupe_Online WHERE name='$name_dupe'";
                        $char_dupe_check_result = $db->Execute($char_dupe_check_query) OR DIE("Query Error : $char_dupe_check_query");
                        $char_dupe_check_fetch = $char_dupe_check_result->FetchRow();
                        if($char_dupe_check_fetch[0] == 0) {
                            // Giai Block neu nhan vat khong co du lieu Dupe
                            $char_unblock_query = "UPDATE Character SET Ctlcode='0',ErrorSubBlock=0 WHERE Name='$name_dupe' AND (SELECT count(*) FROM Dupe_Online WHERE name='$name_dupe')=0";
                            $char_unblock_result = $db->Execute($char_unblock_query) OR DIE("Query Error : $char_unblock_query");
                            
                            // Ghi vào Log nhan vật giai Block do Dupe nham
                                $log_acc = "$acc_dupe";
                                $log_gcoin = 0;
                                $log_gcoin_km = 0;
                                $log_vpoint = 0;
                                $log_price = 0;
                                
                                $log_Des = "Tài khoản <b>$acc_dupe</b> - Nhân vật <strong>$name_dupe</strong> được giải Block do kiểm tra không chứa đồ Dupe.";
                                $log_Des .= $test;
                                $log_time = $timestamp;
                                
                                $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                                $insert_log_result = $db->execute($insert_log_query) OR DIE("Query Error : $insert_log_query");
                        }
                        // End Ghi vào Log nhan vật giai Block do Dupe nham
                    }
                    
                    // Giai Block neu tai khoan khong co du lieu Dupe
                    $acc_dupe_check_query = "SELECT count(*) FROM Dupe_Online WHERE acc='$acc_dupe'";
                    $acc_dupe_check_result = $db->Execute($acc_dupe_check_query) OR DIE("Query Error : $acc_dupe_check_query");
                    $acc_dupe_check_fetch = $acc_dupe_check_result->FetchRow();
                    if($acc_dupe_check_fetch[0] == 0) {
                        $acc_unblock_query = "UPDATE MEMB_INFO SET [bloc_code]='0',admin_block='0' WHERE memb___id='$acc_dupe' AND (SELECT count(*) FROM Dupe_Online WHERE acc='$acc_dupe')=0";
                        $acc_unblock_result = $db->Execute($acc_unblock_query) OR DIE("Query Error : $acc_unblock_query");
                        
                        // Ghi vào Log tai khoan giai Block do Dupe nham
                            $log_acc = "$acc_dupe";
                            $log_gcoin = 0;
                            $log_gcoin_km = 0;
                            $log_vpoint = 0;
                            $log_price = 0;
                            
                            $log_Des = "Tài khoản <b>$acc_dupe</b> được giải Block do kiểm tra không chứa đồ Dupe.";
                            $log_Des .= $test;
                            $log_time = $timestamp;
                            
                            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                            $insert_log_result = $db->execute($insert_log_query) OR DIE("Query Error : $insert_log_query");                    
                    }
                    // End Ghi vào Log tai khoan giai Block do Dupe nham
                }
            }
                
            $_SESSION['checkdupe_scan']++;
            
            if($_SESSION['checkdupe_scan'] >= $dupe_total) {
                if($_SESSION['checkdupe2_repeat'] == 1) {
                    $_SESSION['checkdupe2_repeat'] = 2;
                    $_SESSION['checkdupe_scan'] = 0;
                } else {
                    $_SESSION['scanonline'] = 0;
                    $_SESSION['time_endloop'] = _time();
                }
            }
            
            $scan_start++;
        }
    }
}

    
$db->Close();
?>