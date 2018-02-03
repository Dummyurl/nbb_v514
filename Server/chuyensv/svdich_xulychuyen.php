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
 
include('config.php');
include('function.php');

$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

$acc_nguon = $_REQUEST['acc_nguon'];
$nv_nguon = $_REQUEST['nv_nguon'];

$acc_gcoin  =   $_REQUEST['acc_gcoin'];
$acc_gcoin_km  =   $_REQUEST['acc_gcoin_km'];
$acc_vpoint =   $_REQUEST['acc_vpoint'];
$acc_zen    =   $_REQUEST['acc_zen'];
$acc_chao   =   $_REQUEST['acc_chao'];
$acc_cre    =   $_REQUEST['acc_cre'];
$acc_blue   =   $_REQUEST['acc_blue'];
$acc_thehe  =   $_REQUEST['acc_thehe'];
$acc_WCoin  =   $_REQUEST['acc_WCoin'];
$acc_WCoinP  =   $_REQUEST['acc_WCoinP'];
$acc_GoblinCoin  =   $_REQUEST['acc_GoblinCoin'];
$acc_MuItemShopList  =   $_REQUEST['acc_MuItemShopList'];

$acc_dich   =   $_REQUEST['acc_dich'];
$nv_dich    =   $_REQUEST['nv_dich'];
$nv_class   =   $_REQUEST['nv_Class'];
$nv_Inventory   =   $_REQUEST['nv_Inventory'];
$nv_money   =   $_REQUEST['nv_Money'];
$nv_quest   =   $_REQUEST['nv_Quest'];
$nv_resets  =   $_REQUEST['nv_Resets'];
$nv_NoResetInDay    =   $_REQUEST['nv_NoResetInDay'];
$nv_Relifes =   $_REQUEST['nv_Relifes'];
$nv_SCFPCPoints =   $_REQUEST['nv_SCFPCPoints'];
$nv_point_event =   $_REQUEST['nv_point_event'];
$nv_PointUyThac =   $_REQUEST['nv_PointUyThac'];
$nv_SCFMasterLevel  =   $_REQUEST['nv_SCFMasterLevel'];

$nv_SCFSealItem  =   $_REQUEST['nv_SCFSealItem'];
$nv_SCFSealTime  =   $_REQUEST['nv_SCFSealTime'];
$nv_SCFScrollItem  =   $_REQUEST['nv_SCFScrollItem'];
$nv_SCFScrollTime  =   $_REQUEST['nv_SCFScrollTime'];

    $check_online_query = "SELECT * FROM MEMB_STAT WHERE memb___id='$acc_dich' AND ConnectStat='1'";
    $sql_online_check = $db->Execute($check_online_query); 
        check_queryerror($check_online_query, $sql_online_check);
	$online_check = $sql_online_check->numrows();
	
	if ($online_check > 0) { 
   		echo "Nhân vật chưa thoát Game. Hãy thoát Game trước khi thực hiện chức năng này.";
	} else if(check_nv($acc_dich, $nv_dich) == 0) {
	   echo "Nhân vật <b>{$nv_dich}</b> không nằm trong tài khoản <b>{$acc_dich}</b>. Vui lòng kiểm tra lại."; exit();
    } else {
		$query_xulyacc = "UPDATE MEMB_INFO SET gcoin='$acc_gcoin', gcoin_km='$acc_gcoin_km',vpoint='$acc_vpoint',bank='$acc_zen',jewel_chao='$acc_chao',jewel_cre='$acc_cre',jewel_blue='$acc_blue',thehe='$acc_thehe', WCoin='$acc_WCoin', WCoinP='$acc_WCoinP', GoblinCoin='$acc_GoblinCoin', MuItemShopList=0x$acc_MuItemShopList WHERE memb___id='$acc_dich'";
		//_writelog('log_xulychuyen.txt', $query_xulyacc);
        $sql_xulyacc = $db->Execute($query_xulyacc);
            check_queryerror($query_xulyacc, $sql_xulyacc);
		
        $nv_Inventory_after = "";
        //_writelog('log_xulychuyen.txt', "Trước khi xử lý Inventory");
        $item_inventory_total = floor(strlen($nv_Inventory)/32);
        //_writelog('log_xulychuyen.txt', "Inventory Slg : $item_inventory_total");
        for($i=0; $i<$item_inventory_total; $i++) {
            $item = substr($nv_Inventory,$i*32, 32);
            if($item != $noitem) {
                $seri_new_query = "EXEC WZ_GetItemSerial";
                $seri_new_result = $db->Execute($seri_new_query);
                $seri_new_fetch = $seri_new_result->FetchRow();
                $seri_new = dechex($seri_new_fetch[0]);
                $len_serial = strlen($seri_new);
            	if($len_serial < 8) {
            	   for($j=0; $j<(8-$len_serial); $j++) {
            	       $seri_new = "0". $seri_new;
            	   }
            	}
            	$item = substr_replace($item, $seri_new, 6, 8);
            }
            $nv_Inventory_after .= $item;
        }
        //_writelog('log_xulychuyen.txt', "Sau khi xử lý Inventory");
        
		$query_xulynv = "UPDATE Character SET cLevel='400', Class='$nv_class', Inventory=0x$nv_Inventory_after, Money='$nv_money', Quest=0x$nv_quest, Resets='$nv_resets', NoResetInDay='$nv_NoResetInDay', Relifes='$nv_Relifes', SCFPCPoints='$nv_SCFPCPoints', point_event='$nv_point_event', PointUyThac='$nv_PointUyThac', SCFMasterLevel='$nv_SCFMasterLevel', SCFSealItem='$nv_SCFSealItem', SCFSealTime='$nv_SCFSealTime', SCFScrollItem='$nv_SCFScrollItem', SCFScrollTime='$nv_SCFScrollTime' WHERE Name='$nv_dich'";
        //_writelog('log_xulychuyen.txt', $query_xulynv);
		$sql_xulynv = $db->Execute($query_xulynv);
            check_queryerror($query_xulynv, $sql_xulynv);
	
		$query_log = "INSERT INTO Log_chuyensv (acc, [char], accnew, charnew ) VALUES ('$acc_nguon', '$nv_nguon', '$acc_dich', '$nv_dich' )";
		$sql_log = $db->Execute($query_log);
            check_queryerror($query_log, $sql_log);
		echo "<info>OK</info>";
        
	}
?>