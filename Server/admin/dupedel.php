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

echo "Đã xóa : " . $_SESSION['dupe_del'] . " / " . $_SESSION['dupe_total'] . "<hr />";

if($_SESSION['del_finish'] == "unfinish") {
    $noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
    
    $info_dupe_query = "SELECT acc, name, seri, slgitem FROM Dupe_Scan WHERE isdupe=1 ORDER BY acc, name";
    $info_dupe_result = $db->SelectLimit($info_dupe_query, 1, $_SESSION['dupe_del']);
    $info_dupe_fetch = $info_dupe_result->FetchRow();
    
    $acc = $info_dupe_fetch[0];
    $name = $info_dupe_fetch[1];
    $seri_dupe = $info_dupe_fetch[2];
    $slgitem = $info_dupe_fetch[3];
    
    // Neu la nhan vat
    if(strlen($name) > 0) {
        $inventory_query = "SELECT Inventory FROM Character WHERE Name='$name'";
        $inventory_result = $db->Execute($inventory_query);
        $inventory_fetch = $inventory_result->FetchRow();
        $inventory = $inventory_fetch[0];
        $inventory = bin2hex($inventory);
        $inventory = strtoupper($inventory);
    
        echo "Đang Xóa đồ Dupe Nhân vật : <strong>$name</strong> của tài khoản <strong>$acc</strong> <br />";
        
        $item_total = floor(strlen($inventory)/32);
        $inventory_new = "";
        for($i=0; $i<$item_total; $i++) {
            $item = substr($inventory,$i*32, 32);
            $seri = substr($item, 6, 8);
            if($seri == $seri_dupe) {
                $inventory_new .= $noitem;
            } else {
                $inventory_new .= $item;
            }
        }
        
        $iventory_update_query = "UPDATE Character SET Inventory=0x$inventory_new WHERE Name='$name'";
        $iventory_update_result = $db->Execute($iventory_update_query);
    }
    // Neu la hom do
    else {
        $warehouse_query = "SELECT Items FROM warehouse WHERE AccountID='$acc'";
        $warehouse_result = $db->Execute($warehouse_query);
        $warehouse_fetch = $warehouse_result->FetchRow();
        $warehouse = $warehouse_fetch[0];
        $warehouse = bin2hex($warehouse);
        $warehouse = strtoupper($warehouse);
    
        echo "Đang xóa Item Dupe trong hòm đồ tài khoản : <strong>$acc</strong> <br />";
        
        $item_total = floor(strlen($warehouse)/32);
        $warehouse_new = "";
        for($i=0; $i<$item_total; $i++) {
            $item = substr($warehouse,$i*32, 32);
            $seri = substr($item, 6, 8);
            if($seri == $seri_dupe) {
                $warehouse_new .= $noitem;
            } else {
                $warehouse_new .= $item;
            }
        }
        $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$acc'";
        $warehouse_update_result = $db->Execute($warehouse_update_query);
    }
    
    $_SESSION['dupe_del']++;
    if($_SESSION['dupe_del'] >= $_SESSION['dupe_total']) $_SESSION['del_finish'] = "finish";
} else {
    echo "<strong>Đã Xóa đồ Dupe hoàn tất</strong>.";
}
$db->Close();
?>