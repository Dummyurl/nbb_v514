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
 

include_once('config/config_itemvpoint.php');

$block_dupe = true;
$allow_itemnoseri = false;

$time_dis_charge = 5;  // Thoat Game 5 phut moi duoc doi Item Vpoint
$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

$login=$_POST["login"];
$name=$_POST["name"];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);

kiemtra_block_acc($login);
kiemtra_block_char($login,$name);
kiemtra_doinv($login,$name);
kiemtra_online($login);

$time_dis_query = "SELECT DisConnectTM FROM MEMB_STAT WHERE memb___id='$login'";
$time_dis_result = $db->Execute($time_dis_query);
$time_dis_fetch = $time_dis_result->FetchRow();
$time_dis = strtotime($time_dis_fetch[0]);
$timewait = ($time_dis + $time_dis_charge*60) - $timestamp;
if($timewait > 0) {
    $phutwait = floor($timewait/60);
    $giaywait = $timewait%60;
    echo "Bạn cần thoát Game và chờ trong vòng <strong>$phutwait phút $giaywait giây</strong> nữa mới có thể đổi Item Vpoint.";
    exit();
}

$acc_vpoint_changed = array();
$name_vpoint_changed = array();
$seri_vpoint_changed = array();
$list_vpoint_changed_query = "SELECT acc, name, seri FROM item_vpoint_changed";
$list_vpoint_changed_result = $db->Execute($list_vpoint_changed_query);
    check_queryerror($list_vpoint_changed_query, $list_vpoint_changed_result);
while($list_vpoint_changed_fetch = $list_vpoint_changed_result->FetchRow()) {
    $acc_vpoint_changed[] = $list_vpoint_changed_fetch[0];
    $name_vpoint_changed[] = $list_vpoint_changed_fetch[1];
    $seri_vpoint_changed[] = $list_vpoint_changed_fetch[2];
}
        
$inventory_result_sql = $db->Execute("SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'");
$inventory_result = $inventory_result_sql->fetchrow();


$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
$inventory1 = substr($inventory,0,12*32);
$inventory2 = substr($inventory,12*32,64*32);
$inventory3 = substr($inventory,76*32);

	$zen50k = 0;
    $zen = 0;
	$gold = 0;
    
    $zen50k_dupe = 0;
    $zen_dupe = 0;
	$gold_dupe = 0;
    
    $inventory2_after = "";
    
    $seri_arr = array();
    $seridupe = "";
    $dupe = false;
    
	for($x=0; $x<64; ++$x)
	{
		$item = substr($inventory2,$x*32,32);
        if($item != $noitem) {
            $code = substr($item, 0, 4);
    		$code2 = substr($item, 18, 1);
            $seri = substr($item, 6, 8);
            $item_check = false;
    		if($code === "0C10" AND $code2 ==="E") {
                if($allow_itemnoseri === false && ($seri == "00000000" || $seri == "FFFFFFFF")) {
                    $gold_dupe++;
                }
                else if(in_array($seri, $seri_vpoint_changed) && $seri != "00000000") {
                    $gold_dupe++;
                } else {
                    $gold++;
                }
                $itemtype = "Item Vpoint 1k";
                $itemvalue = 1000;
                $item_check = true;
    		}	
    		else if($code === "0C00" AND $code2 ==="E") {
                if($allow_itemnoseri === false && ($seri == "00000000" || $seri == "FFFFFFFF")) {
                    $gold_dupe++;
                }
                else if(in_array($seri, $seri_vpoint_changed) && $seri != "00000000") {
                    $zen_dupe++;
                } else {
                    $zen++;
                }
                $itemtype = "Item Vpoint 10k";
                $itemvalue = 10000;
                $item_check = true;
    		}
            else if($code === "0F00" AND $code2 ==="E") {
                if($allow_itemnoseri === false && ($seri == "00000000" || $seri == "FFFFFFFF")) {
                    $gold_dupe++;
                }
                else if(in_array($seri, $seri_vpoint_changed) && $seri != "00000000") {
                    $zen50k_dupe++;
                } else {
                    $zen50k++;
                }
                $itemtype = "Item Vpoint 50k";
                $itemvalue = 50000;
                $item_check = true;
            }
            if($item_check === true) {
                if(!in_array($seri, $seri_arr)) {
                    $seri_arr[] = $seri;
                    $itemtype_arr[] = $itemtype;
                    $vpoint_arr[] = $itemvalue;
                } elseif($seri != "00000000") {
                    $dupe = true;
                    if(strlen($seridupe) > 0) $seridupe .= ", ";
                    $seridupe .= "$seri";
                }
                $item = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
            }
        }
        $inventory2_after .= $item;
    		
 	}

if($dupe == true) {
    if($block_dupe == true) {
        $char_block_query = "UPDATE Character SET ctlcode='99', ErrorSubBlock=99 WHERE name='$name'";
        $char_block_result = $db->Execute($char_block_query);
        
        $acc_block_query = "Update MEMB_INFO SET [bloc_code]='1',admin_block='1' WHERE memb___id='$login'";
        $acc_block_result = $db->Execute($acc_block_query);
        
        $log_writeblock = "Khóa tài khoản, nhân vật.";
    }
        
    // Ghi vào Log nhung nhan vàt Block do Dupe
    $log_acc = "$login";
    $log_gcoin = 0;
    $log_gcoin_km = 0;
    $log_vpoint = 0;
    $log_price = "-";
    
    $log_Des = "Tài khoản <b>$login</b> - Nhân vật <strong>$name</strong> chứa Item Vpoint Dupe Seri : <strong>$seridupe</strong>. $log_writeblock";
    $log_time = $timestamp;
    
    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    $insert_log_result = $db->execute($insert_log_query);
    // End Ghi vào Log nhung nhan vàt Block do Dupe
    
    echo "Nhân vật $name chứa Vpoint Dupe. Khóa tài khoản, nhân vật."; exit();
}

if ( count($seri_arr) == 0 )
{
	echo "Không có Item V.Point để đổi ra V.Point";
}
else {
    $query = "select vpoint from MEMB_INFO WHERE memb___id='$login'";
    $result = $db->Execute( $query );
    $row = $result->fetchrow();

 	$vpoint_add = $gold*$item_low + $zen*$item_hight + $zen50k*$item_50k;
 	$vpoint_after = $row[0] + $vpoint_add;
 	
$inventory_after = $inventory1.$inventory2_after.$inventory3;

kiemtra_doinv($login,$name);
kiemtra_online($login);

$general = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
$msgeneral = $db->Execute($general) or die("Loi query: $general");

$general1 = "UPDATE MEMB_INFO SET vpoint = $vpoint_after WHERE memb___id='$login'";
$msgeneral1 = $db->Execute($general1);

// INSERT Item Vpoint Change
foreach($seri_arr as $key => $val) {
    $vpoint_changed_insert_query = "IF NOT EXISTS (SELECT * FROM item_vpoint_changed WHERE seri='$val') BEGIN INSERT INTO item_vpoint_changed (acc, name, itemtype, seri, value, time) VALUES ('$login', '$name', '". $itemtype_arr[$key] ."', '$val', ". $vpoint_arr[$key] .", $timestamp) END";
    $vpoint_changed_insert_result = $db->Execute($vpoint_changed_insert_query);
        check_queryerror($vpoint_changed_insert_query, $vpoint_changed_insert_result);
}


//Ghi vào Log nhung nhan vat doi Item Vpoint
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "+ $vpoint_add Vpoint";
        $log_Des = "$name : Đổi $gold Gold, $zen Zen, $zen50k Zen 50k";
        if($gold_dupe > 0 || $zen_dupe > 0 || $zen50k_dupe) {
            $log_Des .= ". Nhân vật chứa";
            if($gold_dupe > 0) {
                $log_Des .= " $gold_dupe Item Gold 1k";
            }
            if($zen_dupe > 0) {
                if($gold_dupe > 0) {
                    $log_Des .= ",";
                }
                $log_Des .= " $zen_dupe Item Zen 10k";
            }
            if($zen50k_dupe > 0) {
                if($gold_dupe > 0 || $zen_dupe > 0) {
                    $log_Des .= ",";
                }
                $log_Des .= " $zen50k_dupe Item Zend 50k";
            }
            $log_Des .= " Dupe, vì vậy bị xóa và không được chuyển sang Vpoint.";
        }
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat doi Item Vpoint


    $content = "OK<nbb>$vpoint_add<nbb>Bạn đã đổi thành công $gold Gold, $zen Zen, $zen50k Zen 50k ra $vpoint_add V.Point.";
    if($gold_dupe > 0 || $zen_dupe > 0 || $zen50k_dupe) {
        $content .= " Nhân vật chứa";
        if($gold_dupe > 0) {
            $content .= " $gold_dupe Item Gold 1k";
        }
        if($zen_dupe > 0) {
            if($gold_dupe > 0) {
                $content .= ",";
            }
            $content .= " $zen_dupe Item Zen 10k";
        }
        if($zen50k_dupe > 0) {
            if($gold_dupe > 0 || $zen_dupe > 0) {
                $content .= ",";
            }
            $content .= " $zen50k_dupe Item Zend 50k";
        }
        $content .= " Dupe, vì vậy bị xóa và không được chuyển sang Vpoint.";
    }
    echo $content;
        
}
}

?>