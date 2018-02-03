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
 * @copyright 25/3/2012
 */
include_once ("security.php");
include ('../config.php');
$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
    
// Define Ajax Request
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX) { echo 'Không được phép truy cập.'; }
else {
    $acc = $_POST['acc'];
    $name = $_POST['name'];
    $seri = $_POST['seri'];
    $vitri = $_POST['vitri'];
    
    // Neu do dupe tren nguoi
    if(strlen($name) > 0) {
        $inventory_chardupe_query = "SELECT CAST(Inventory AS image) FROM Character WHERE name='$name'";
        $inventory_chardupe_result = $db->Execute($inventory_chardupe_query) OR DIE("Query Error : $inventory_chardupe_query");
        $inventory_chardupe_fetch = $inventory_chardupe_result->FetchRow();
        $inventory_chardupe = $inventory_chardupe_fetch[0];
        $inventory_chardupe = bin2hex($inventory_chardupe);
        if(strlen($inventory_chardupe) > 0) {
            $inventory_chardupe = strtoupper($inventory_chardupe);
            $item_check = substr($inventory_chardupe, ($vitri-1)*32, 32);
            $seri_check = substr($item_check, 6, 8);
            if($seri_check == $seri) {
                $inventory_new = substr_replace($inventory_chardupe, $noitem, ($vitri-1)*32, 32);
                
                $inventory_update_query = "UPDATE Character SET Inventory=0x$inventory_new WHERE Name='$name'";
                $inventory_update_result = $db->Execute($inventory_update_query) OR DIE("Query Error : $inventory_update_query");
            } else {
                $error .= "Seri Item <strong>$seri_check</strong> không giống Seri Item Search <strong>$seri</strong>";
            }
        } else {
            $error .= "Không lấy được dữ liệu Item trên nhân vật <strong>$name</strong>";
        }
            
    }
    // Neu do Dupe trong ruong
    else {
        $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID='$acc'";
        $warehouse_result = $db->Execute($warehouse_query) OR DIE("Query Error : $warehouse_query");
        $warehouse_fetch = $warehouse_result->FetchRow();
        $warehouse = $warehouse_fetch[0];
        $warehouse = bin2hex($warehouse);
        if(strlen($warehouse) > 0) {
            $warehouse = strtoupper($warehouse);
            
            $item_check = substr($warehouse, ($vitri-1)*32, 32);
            $seri_check = substr($item_check, 6, 8);
            if($seri_check == $seri) {
                $warehouse_new = substr_replace($warehouse, $noitem, ($vitri-1)*32, 32);
                
                $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$acc'";
                $warehouse_update_result = $db->Execute($warehouse_update_query) OR DIE("Query Error : $warehouse_update_query");
            } else {
                $error .= "Seri Item <strong>$seri_check</strong> không giống Seri Item Search <strong>$seri</strong>";
            }
        } else {
            $error .= "Không lấy được dữ liệu Item trong hòm đồ tài khoản $acc";
        }
    }
    
    if(strlen($error) > 0) echo $error;
    else echo "Đã Xóa";
}

?>