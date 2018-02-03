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
 
	include_once("security.php");
include_once("config.php");
include ('config/config_thehe.php');

$slg_top = 50;

$login = $_POST['login'];
$action = $_POST['action'];
$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    
    switch ($action){ 
    
    	case 'mypl':
            $mypl_q = "SELECT nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
            $mypl_r = $db->Execute($mypl_q);
                check_queryerror($mypl_q, $mypl_r);
            $mypl_f = $mypl_r->FetchRow();
            $mypl = $mypl_f[0];
            
            $mystore_arr = array();
            
            $mystore_dangban_q = "SELECT market_id, plpoint, price, name_buy FROM nbb_plmarket WHERE acc='$login' AND status=0 ORDER BY time_begin DESC";
            $mystore_dangban_r = $db->Execute($mystore_dangban_q);
                check_queryerror($mystore_dangban_q, $mystore_dangban_r);
            
            while($mystore_dangban_f = $mystore_dangban_r->FetchRow()) {
                
                $info = "<font color='red'><strong>Đang Bán</strong></font>";
                $dangban = 1;
                
                $mystore_arr[] = array(
                    'id'    =>  $mystore_dangban_f[0],
                    'plpoint'   =>  $mystore_dangban_f[1],
                    'price' =>  $mystore_dangban_f[2],
                    'info'  =>  $info,
                    'dangban'   =>  $dangban
                );
            }
            
            $mystore_other_q = "SELECT TOP 20 market_id, plpoint, price, name_buy, time_end, status FROM nbb_plmarket WHERE acc='$login' AND status>0 ORDER BY time_end DESC";
            $mystore_other_r = $db->Execute($mystore_other_q);
                check_queryerror($mystore_other_q, $mystore_other_r);
            
            while($mystore_other_f = $mystore_other_r->FetchRow()) {
                
                $dangban = 0;
                $time_end = date('H:i d/m', strtotime($mystore_other_f[4]));
                if($mystore_other_f[5] == 1) {
                    $vat = floor($mystore_other_f[2]*0.1);
                    if($vat == 0) $vat = 1;
                    $vpoint = $mystore_other_f[2] - $vat;
                    $info = "<font color='blue'><strong>Đã Bán</strong></font> cho <strong>". $mystore_other_f[3] ."</strong> lúc $time_end<br />Nộp thuế VAT (10%) : $vat Vpoint.<br /><strong>Thu về : $vpoint Vpoint</strong>.";
                } else {
                    $info = "<font color='silver'>Đã Hủy Bán lúc $time_end</font>";
                }
                    
                
                $mystore_arr[] = array(
                    'id'    =>  $mystore_other_f[0],
                    'plpoint'   =>  $mystore_other_f[1],
                    'price' =>  $mystore_other_f[2],
                    'info'  =>  $info,
                    'dangban'   =>  $dangban
                );
            }
            
            $mystore = json_encode($mystore_arr);
           
           echo "<info>OK</info><mypl>$mypl</mypl><mystore>$mystore</mystore>";
    	break;
        
        case 'banpl':
            $plpoint_ban = abs(intval($_POST['plpoint_ban']));
            $plpoint_vpoint = abs(intval($_POST['plpoint_vpoint']));
            
            $mypl_q = "SELECT nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
            $mypl_r = $db->Execute($mypl_q);
                check_queryerror($mypl_q, $mypl_r);
            $mypl_f = $mypl_r->FetchRow();
            $mypl = $mypl_f[0];
            
            if($plpoint_ban <= 0) {
                echo "<strong>Điểm Phúc Lợi</strong> cần bán phải lớn hơn 0.";
            } else if($plpoint_vpoint <= 0) {
                echo "<strong>Giá bán</strong> Điểm Phúc Lợi phải lớn hơn 0.";
            } else if($mypl < $plpoint_ban) {
                echo "Điểm Phúc Lợi hiện có không đủ để bán.<br />Vui lòng chọn Điểm Phúc Lợi để bán thấp hơn $mypl";
            } else {
                $mypl_new = $mypl - $plpoint_ban;
                
                $mypl_update_q = "UPDATE MEMB_INFO SET nbb_pl = $mypl_new WHERE memb___id='$login'";
                $mypl_update_r = $db->Execute($mypl_update_q);
                    check_queryerror($mypl_update_q, $mypl_update_r);
                
                $tygia = $plpoint_vpoint / $plpoint_ban;
                $nvchinh = _nv_chinh($login);
                
                $time_begin = date('Y-m-d H:i:s', $timestamp);
                $insert_marketpl_q = "INSERT INTO nbb_plmarket (acc, name, plpoint, price, tygia, time_begin) VALUES ('$login', '$nvchinh', $plpoint_ban, $plpoint_vpoint, $tygia, '$time_begin')";
                $insert_marketpl_r = $db->Execute($insert_marketpl_q);
                    check_queryerror($insert_marketpl_q, $insert_marketpl_r);
                    
                $msg = "Đã bán <strong>$plpoint_ban Điểm Phúc Lợi</strong> với giá <strong>$plpoint_vpoint Vpoint</strong>.<br />Chúc bạn buôn bán thuận buồm xuôi gió ^_^";
                
                echo "<info>OK</info><plnew>$mypl_new</plnew><msg>$msg</msg>";
            }
        break;
        
        case 'muapl':
            $store_id = abs(intval($_POST['store_id']));
            
            $store_q = "SELECT plpoint, price, acc FROM nbb_plmarket WHERE market_id=$store_id AND status=0";
            $store_r = $db->Execute($store_q);
                check_queryerror($store_q, $store_r);
            $store_chk = $store_r->NumRows();
            if($store_chk == 0) {
                echo "Gói Phúc Lợi này đã bị người khác mua.<br />Vui lòng chọn gói Phúc Lợi khác.";
            } else {
                
                $store_f = $store_r->FetchRow();
                $plpoint_ban = $store_f[0];
                $price = $store_f[1];
                $acc_ban = $store_f[2];
                
                $mua_info_q = "SELECT vpoint, nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
                $mua_info_r = $db->Execute($mua_info_q);
                    check_queryerror($mua_info_q, $mua_info_r);
                $mua_info_f = $mua_info_r->FetchRow();
                $vpoint = $mua_info_f[0];
                $plpoint = $mua_info_f[1];
                
                if($vpoint < $price) {
                    echo "Bạn không có đủ Vpoint để mua.";
                } else {
                    
                    $nvchinh = _nv_chinh($login);
                    $time_end = date('Y-m-d H:i:s', $timestamp);
                    $store_update_q = "UPDATE nbb_plmarket SET name_buy='$nvchinh', status=1, time_end = '$time_end' WHERE market_id=$store_id";
                    $store_update_r = $db->Execute($store_update_q);
                        check_queryerror($store_update_q, $store_update_r);
                    
                    
                    $vpoint_new = $vpoint - $price;
                    $plpoint_new = $plpoint + $plpoint_ban;
                    $mua_update_q = "UPDATE MEMB_INFO SET vpoint = $vpoint_new, nbb_pl = $plpoint_new WHERE memb___id='$login'";
                    $mua_update_r = $db->Execute($mua_update_q);
                        check_queryerror($mua_update_q, $mua_update_r);
                        
                    $vat = floor($price*0.1);
                    if($vat == 0) $vat = 1;
                    $ban_vpoint = $price - $vat;
                    
                    $ban_update_q = "UPDATE MEMB_INFO SET vpoint = vpoint + $ban_vpoint WHERE memb___id='$acc_ban'";
                    $ban_update_r = $db->Execute($ban_update_q);
                        check_queryerror($ban_update_q, $ban_update_r);
                        
                    $msg = "Đã mua $plpoint_ban Điểm Phúc Lợi giá $price Vpoint.";
                    
                    echo "<info>OK</info><vpoint>$vpoint_new</vpoint><msg>$msg</msg>";
                }
            }
            
        break;
        
        case 'huyban':
            $store_id = abs(intval($_POST['store_id']));
            
            $store_q = "SELECT plpoint, acc, status FROM nbb_plmarket WHERE market_id=$store_id";
            $store_r = $db->Execute($store_q);
                check_queryerror($store_q, $store_r);
            $store_chk = $store_r->NumRows();
            if($store_chk == 0) {
                echo "Gói Phúc Lợi này không tồn tại.";
            } else {
                $store_f = $store_r->FetchRow();
                if($store_f[1] != "$login") {
                    echo "Gói Phúc Lợi này không phải của bạn.";
                } else if($store_f[2] == 1) {
                    echo "Gói Phúc Lợi này đã bán.";
                } else if($store_f[2] == 2) {
                    echo "Gói Phúc Lơi này đã hủy.";
                } else {
                    $plpoint_ban = $store_f[0];
                    
                    $time_end = date('Y-m-d H:i:s', $timestamp);
                    $store_update_q = "UPDATE nbb_plmarket SET status=2, time_end = '$time_end' WHERE market_id=$store_id";
                    $store_update_r = $db->Execute($store_update_q);
                        check_queryerror($store_update_q, $store_update_r);
                    
                    $plpoint_q = "SELECT nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
                    $plpoint_r = $db->Execute($plpoint_q);
                        check_queryerror($plpoint_q, $plpoint_r);
                    $plpoint_f = $plpoint_r->FetchRow();
                    $plpoint = $plpoint_f[0];
                    
                    $plpoint_new = $plpoint + $plpoint_ban;
                    
                    $pl_update_q = "UPDATE MEMB_INFO SET nbb_pl = $plpoint_new WHERE memb___id='$login'";
                    $pl_update_r = $db->Execute($pl_update_q);
                        check_queryerror($pl_update_q, $pl_update_r);
                    
                    $msg = "Đã hủy gói Phúc Lợi này.";
                        
                    echo "<info>OK</info><plpoint>$plpoint_new</plpoint>><msg>$msg</msg>";
                    
                }
            }
            
        break;
        
    	default :
            $listpl_arr = array();
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    $listpl_q = "SELECT TOP $slg_top market_id, Name, plpoint, price, acc FROM nbb_plmarket JOIN MEMB_INFO ON nbb_plmarket.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i AND status=0 ORDER BY tygia";
                    $listpl_r = $db->Execute($listpl_q);
                        check_queryerror($listpl_q, $toptuluyen_r);
                    while($listpl_f = $listpl_r->FetchRow()) {
                        $mystore = 0;
                        if($listpl_f[4] == "$login") {
                            $mystore = 1;
                        }
                        $listpl_arr[$i][] = array(
                            'id'  => $listpl_f[0],
                            'name'  => $listpl_f[1],
                            'plpoint'   =>  $listpl_f[2],
                            'price'   =>  $listpl_f[3],
                            'mystore'   =>  $mystore
                        );
                    }
                }
            }
            
            $listpl_data = json_encode($listpl_arr);
            echo "<info>OK</info><listpl_data>$listpl_data</listpl_data>";
    }
}
$db->Close();
?>