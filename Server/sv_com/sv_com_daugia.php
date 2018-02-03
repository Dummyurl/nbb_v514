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
 

$login = $_POST['login'];
$name = $_POST['name'];
$action = $_POST['action'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

// Xu ly Dau gia ket thuc
    // Danh sach nhung Item ket thuc co nguoi tra gia
    $daugia_end_bided_q = "SELECT acc_own, bid_vpoint FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND status=1 AND bid_status=1 AND acc<>acc_own AND bid_end<$timestamp";
    $daugia_end_bided_r = $db->Execute($daugia_end_bided_q);
        check_queryerror($daugia_end_bided_q, $daugia_end_bided_r);
    while($daugia_end_bided_f = $daugia_end_bided_r->FetchRow()) {
        $acc_ban = $daugia_end_bided_f[0];
        $vpoint_mua = $daugia_end_bided_f[1];
        // Update Vpoint cho nguoi ban
        $money_update_q = "UPDATE MEMB_INFO SET vpoint = vpoint + $vpoint_mua WHERE memb___id='$acc_ban'";
        $money_update_r = $db->Execute($money_update_q);
            check_queryerror($money_update_q, $money_update_r);
    }
    
    // Thiet lap trang thai Item da ket thuc
    $daugia_end_query = "UPDATE DauGia_Item SET bid_status=0 WHERE bid_end<$timestamp AND bid_status=1";
    $daugia_end_result = $db->Execute($daugia_end_query);
        check_queryerror($daugia_end_query, $daugia_end_result);
// End Xu ly Dau gia ket thuc

include('config/config_daugia.php');
include('config/config_thehe.php');

    switch ($action){ 
    	case 'bid_list':
            kiemtra_online($login);
            
            $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
            $warehouse_result = $db->Execute($warehouse_query);
                check_queryerror($warehouse_query, $warehouse_result);
            $warehouse_fetch = $warehouse_result->FetchRow();
            $warehouse = $warehouse_fetch[0];
            $warehouse = bin2hex($warehouse);
            $warehouse = strtoupper($warehouse);
            
            $warehouse1 = substr($warehouse,0,120*32);
            $warehouse2 = substr($warehouse,120*32);
            
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_com_daugia.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'bid_list',
                
                'warehouse1'    =>  $warehouse1
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if($info == "Error") {
                    echo read_TagName($reponse, 'message');
                    exit();
                } elseif ($info == "OK") {
                    $listitem = read_TagName($reponse, 'listitem');
                    if(strlen($listitem) == 0) {
                        echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                        
                        $arr_view = "\nDataSend:\n";
                        foreach($getcontent_data as $k => $v) {
                            $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                        }
                        writelog("log_api.txt", $arr_view . $reponse);
                        exit();
                    }
                } else {
                    echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                    writelog("log_api.txt", $reponse);
                    exit();
                }
            }
            
            echo "<nbb>OK<nbb>$listitem<nbb>";
    	break;
        
        case 'itembid_send':
            kiemtra_online($login);
            
            $vitri = $_POST['vitri'];           $vitri = abs(intval($vitri));
            $item_code = $_POST['item_code'];
            $price_min = $_POST['price_min'];   $price_min = abs(intval($price_min));
            $price_max = $_POST['price_max'];   $price_max = abs(intval($price_max));
            $bidday = $_POST['bidday'];         $bidday = abs(intval($bidday));
            $itempass = $_POST['itempass'];
            $passopd = $_POST['passopd'];
            
            if($vitri < 0 || $vitri > 120) {
                echo '<font color="red"><b>Vị trí Item sai</b></font>';
            } else if(strlen($item_code) != 32) {
                echo '<font color="red"><b>Item Code sai</b></font>';
            } else if($price_min <= 0) {
                echo '<font color="red"><b>Giá khởi điểm phải lớn hơn 0 Vpoint</b></font>';
            } else if($price_min % 100 != 0) {
                echo '<font color="red"><b>Giá khởi điểm phải chia hết cho 100</b></font>';
            } else if($price_max <= $price_min) {
                echo '<font color="red"><b>Giá mua đứt phải lớn hơn giá khởi điểm</b></font>';
            } else if($price_max % 100 != 0) {
                echo '<font color="red"><b>Giá mua đứt phải chia hết cho 100</b></font>';
            } else if(!preg_match("/^[0-9A-F]*$/i", $item_code)) {
                echo '<font color="red"><b>Item Code không hợp lệ</b></font>';
            } else if($bidday <= 0 || $bidday > 3) {
                echo '<font color="red"><b>Thời gian Item trên sàn không cho phép</b></font>';
            } else if(!preg_match("/^[a-zA-Z0-9_]*$/i", $itempass)) {
                echo "<font color='red'><b>Mật khẩu bảo vệ chỉ được bao gồm a-z, A-Z, 0-9</b></font>";
            } else if(!preg_match("/^[a-zA-Z0-9_]*$/i", $passopd)) {
                echo "<font color='red'><b>Mật khẩu OPD chỉ được bao gồm a-z, A-Z, 0-9</b></font>";
            } else {
                
                $flag = true;
                
                $acc_info_query = "SELECT vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                $acc_info_result = $db->Execute($acc_info_query);
                    check_queryerror($acc_info_query, $acc_info_result);
                $acc_info_fetch = $acc_info_result->FetchRow();
                $vpoint = $acc_info_fetch[0];
                
                $vpoint_cost = $bidday*$Bid_Vpoint_Daily;
                
                if($vpoint_cost > $vpoint ) {
                    echo "<font color='red'><b>Tài khoản không đủ Vpoint để tham gia đấu giá. Cần có ít nhất ". number_format($vpoint_cost, 0, ',', '.') ." Vpoint để đưa Item lên sàn đấu giá trong vòng ". $bidday ." ngày<br />";
                    $flag = false;
                }
                
                if($flag === true) {
                    if(strlen($opd) > 0) {
                        $opd_check = kiemtra_opd($acc, $opd);
                        if($opd_check['flag'] === false) {
                            echo $opd_check['notice'];
                        } else {
                            $trade_safe = 1;
                        }
                    } else {
                        $trade_safe = 0;
                    }
                        
                }
                
                if($flag === true) {
                    $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
                    $warehouse_result = $db->Execute($warehouse_query);
                        check_queryerror($warehouse_query, $warehouse_result);
                    $warehouse_fetch = $warehouse_result->FetchRow();
                    $warehouse = $warehouse_fetch[0];
                    $warehouse = bin2hex($warehouse);
                    $warehouse = strtoupper($warehouse);
                    
                    $warehouse1 = substr($warehouse,0,120*32);
                    $warehouse2 = substr($warehouse,120*32);
                    
                    include_once('config_license.php');
                    include_once('func_getContent.php');
                    $getcontent_url = $url_license . "/api_com_daugia.php";
                    $getcontent_data = array(
                        'acclic'    =>  $acclic,
                        'key'    =>  $key,
                        'action'    =>  'itembid_send',
                        
                        'warehouse1'    =>  $warehouse1,
                        'vitri'    =>  $vitri,
                        'item_code'    =>  $item_code
                    ); 
                    
                    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                
                	if ( empty($reponse) ) {
                        echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                        exit();
                    }
                    else {
                        $info = read_TagName($reponse, 'info');
                        if($info == "Error") {
                            echo read_TagName($reponse, 'message');
                            exit();
                        } elseif ($info == "OK") {
                            $data = read_TagName($reponse, 'data');
                            if(strlen($data) == 0) {
                                echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                                
                                $arr_view = "\nDataSend:\n";
                                foreach($getcontent_data as $k => $v) {
                                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                                }
                                writelog("log_api.txt", $arr_view . $reponse);
                                exit();
                            } else {
                                $data_arr = unserialize_safe($data);
                                kiemtra_online($login);
                                
                                // Update VPoint
                                $vpoint_update_query = "UPDATE MEMB_INFO SET vpoint=vpoint-$vpoint_cost WHERE memb___id='$login'";
                                $vpoint_update_result = $db->Execute($vpoint_update_query);
                                    check_queryerror($vpoint_update_query, $vpoint_update_result);
                                // Update WareHouse
                                $warehouse_new = $data_arr['warehouse1_new'] . $warehouse2;
                                $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                                $warehouse_update_result = $db->Execute($warehouse_update_query);
                                    check_queryerror($warehouse_update_query, $warehouse_update_result);
                                // Insert Dau Gia
                                $char_best_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$login' ORDER BY relifes DESC, Resets DESC";
                                $char_best_result = $db->Execute($char_best_query);
                                    check_queryerror($char_best_query, $char_best_result);
                                $char_best_fetch = $char_best_result->FetchRow();
                                $char_best = $char_best_fetch[0];
                                
                                $bid_end = $timestamp + $bidday * 24*60*60;
                                $bid_insert_query = "INSERT INTO DauGia_Item (item_name, item_code, item_info, item_image, price_min, price_max, bid_end, acc_own, char_own, item_group, itempass, trade_safe) VALUES ('". $data_arr['item_name'] ."', '". $item_code ."', N'". $data_arr['item_info'] ."', '". $data_arr['item_image'] ."', $price_min, $price_max, $bid_end, '$login', '$char_best', '". $data_arr['item_group'] ."', '$itempass', $trade_safe)";
                                $bid_insert_result = $db->Execute($bid_insert_query);
                                    check_queryerror($bid_insert_query, $bid_insert_result);
                                // Insert Bid
                                $bidid_query = "SELECT bid_id FROM DauGia_Item WHERE item_code='". $item_code ."' AND price_min='$price_min' AND price_max='$price_max' AND bid_end=$bid_end AND acc_own='$login' AND char_own='$char_best'";
                                $bidid_result = $db->Execute($bidid_query);
                                    check_queryerror($bidid_query, $bidid_result);
                                $bidid_fetch = $bidid_result->FetchRow();
                                $bidid = $bidid_fetch[0];
                                
                                $bid_insert_query = "INSERT INTO DauGia_Bid (bid_id, acc, name, bid_vpoint, bid_time) VALUES ($bidid, '$login', '$char_best', $price_min, $bid_end)";
                                $bid_insert_result = $db->Execute($bid_insert_query);
                                    check_queryerror($bid_insert_query, $bid_insert_result);
                                    
                                echo "<info>OK</info>";
                            }
                        } else {
                            echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                            writelog("log_api.txt", $reponse);
                            exit();
                        }
                    }
                }
            }
            
        break;
        
        case 'listitem_biding':
            $thehe_query = "";
            foreach($thehe_choise as $thehe_key => $thehe_val) {
                if(strlen($thehe_val) > 0) {
                    if(strlen($thehe_query) > 0) $thehe_query .= ",";
                    $thehe_query .= $thehe_key;
                }
            }
            
            $listitem_query = "SELECT DauGia_Item.bid_id, item_name, item_info, item_image, price_min, price_max, bid_end, acc_own, char_own, item_group, acc, name, bid_vpoint, bid_time, itempass, trade_safe FROM DauGia_Item JOIN MEMB_INFO ON DauGia_Item.acc_own collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ($thehe_query) AND bid_status=1 JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND status=1 ORDER BY bid_end";
            $listitem_result = $db->Execute($listitem_query);
                check_queryerror($listitem_query, $listitem_result);
            
            $listitem_arr = array();
            $item_group_count = array();
            while($listitem_fetch = $listitem_result->FetchRow()) {
                $item_group = $listitem_fetch[9];
                if(!isset($item_group) || $item_group == NULL) {
                    $item_group = 30;
                }
                
                if(isset($item_group_count[$item_group])) {
                    ++$item_group_count[$item_group];
                } else {
                    $item_group_count[$item_group] = 1;
                }
                
                if(isset($listitem_fetch[14]) && strlen($listitem_fetch[14]) > 0) {
                    $itempass = 1;
                } else {
                    $itempass = 0;
                }
                
                $listitem_arr[] = array (
                    'bid_id'    =>  $listitem_fetch[0],
                    'item_name' =>  $listitem_fetch[1],
                    'item_info' =>  $listitem_fetch[2],
                    'item_image'    =>  $listitem_fetch[3],
                    'price_max'    =>  $listitem_fetch[5],
                    'bid_end'    =>  date('H:i d/m', $listitem_fetch[6]),
                    'acc_own'    =>  $listitem_fetch[7],
                    'char_own'    =>  $listitem_fetch[8],
                    'item_group'    =>  $item_group,
                    'itempass'    =>  $itempass,
                    'trade_safe'    =>  $listitem_fetch[15],
                    'acc'   =>  $listitem_fetch[10],
                    'name'   =>  $listitem_fetch[11],
                    'bid_vpoint'   =>  $listitem_fetch[12]
                );
            }
            
            $data_arr = array(
                'item_group_count'  =>  $item_group_count,
                'listitem'  =>  $listitem_arr
            );
            
            $data = serialize($data_arr);
            echo "<nbb>OK<nbb>$data<nbb>";
    	break;
        
        case 'bid':
            $bidid = $_POST['bidid'];
            $bid = $_POST['bid'];
            $itempass = $_POST['itempass'];
            
            $daugia_info_query = "SELECT price_max, acc_own, acc, bid_vpoint, itempass FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id=$bidid AND bid_status=1 AND DauGia_Item.bid_id = DauGia_Bid.bid_id AND status=1";
            $daugia_info_result = $db->Execute($daugia_info_query);
                check_queryerror($daugia_info_query, $daugia_info_result);
            $daugia_info_check = $daugia_info_result->NumRows();
            
            if($daugia_info_check == 0) {
                echo "Đấu giá không tồn tại hoặc đã kết thúc.";
            } else {
                $daugia_info_fetch = $daugia_info_result->FetchRow();
                $price_max = $daugia_info_fetch[0];
                $acc_own = $daugia_info_fetch[1];
                $acc = $daugia_info_fetch[2];
                $bid_vpoint = $daugia_info_fetch[3];
                $itempass_check = $daugia_info_fetch[4];
                
                $acc_info_query = "SELECT vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                $acc_info_result = $db->Execute($acc_info_query);
                    check_queryerror($acc_info_query, $acc_info_result);
                $acc_info_fetch = $acc_info_result->FetchRow();
                $vpoint = $acc_info_fetch[0];
                
                if($login == $acc_own) {
                    echo "Chủ sở hữu Item không được tham gia đấu giá";
                } else if($login == $acc) {
                    echo "Bạn hiện đang trả giá cao nhất cho Item này.<br />Chỉ được tham gia khi có người trả giá cao hơn.";
                } else if(strlen($itempass_check) > 0 && $itempass_check != $itempass) {
                    echo "Mật khẩu bảo vệ để mua Item không chính xác.";
                } else if($bid <= $bid_vpoint) {
                    echo "Giá Đấu $bid Vpoint phải lớn hơn Giá đấu hiện tại $bid_vpoint Vpoint";
                } else if($bid > $price_max) {
                    echo "Giá đấu $bid Vpoint chỉ được bằng $price_max Vpoint để mua đứt Item.";
                } else if($bid + $Bid_Vpoint_Member > $vpoint ) {
                    echo "Tài khoản không đủ Vpoint để tham gia đấu giá. Cần có ít nhất $bid Vpoint để đặt và $Bid_Vpoint_Member Vpoint chi phí đấu giá";
                } else {
                    // Hoan tra Vpoint neu ITem khong phai cua chu so huu
                    if($acc_own != $acc) {
                        $vpoint_update_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$bid_vpoint WHERE memb___id='$acc'";
                        $vpoint_update_result = $db->Execute($vpoint_update_query);
                            check_queryerror($vpoint_update_query, $vpoint_update_result);
                    }
                    // Tru Vpoint cua acc dau gia
                    $vpoint_tru = $bid + $Bid_Vpoint_Member;
                    $vpoint_tru_query = "UPDATE MEMB_INFO SET vpoint=vpoint-$vpoint_tru WHERE memb___id='$login'";
                    $vpoint_tru_result = $db->Execute($vpoint_tru_query);
                        check_queryerror($vpoint_tru_query, $vpoint_tru_result);
                    // Update nguoi dau gia cu
                    $daugia_old_query = "UPDATE DauGia_Bid SET status=0 WHERE status=1 AND bid_id=$bidid";
                    $daugia_old_result = $db->Execute($daugia_old_query);
                        check_queryerror($daugia_old_query, $daugia_old_result);
                    // Insert nguoi dau gia moi
                    $char_best_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$login' ORDER BY relifes DESC, Resets DESC";
                    $char_best_result = $db->Execute($char_best_query);
                        check_queryerror($char_best_query, $char_best_result);
                    $char_best_fetch = $char_best_result->FetchRow();
                    $char_best = $char_best_fetch[0];
                    
                    $daugia_new_query = "INSERT INTO DauGia_Bid (bid_id, acc, name, bid_vpoint, bid_time) VALUES ($bidid, '$login', '$char_best', $bid, $timestamp)";
                    $daugia_new_result = $db->Execute($daugia_new_query);
                        check_queryerror($daugia_new_query, $daugia_new_result);
                    // Ket thuc dau gia neu gia dat = gia mua dut
                    if($bid == $price_max) {
                        // Ket thuc dau gia
                        $daugia_end_query = "UPDATE DauGia_Item SET bid_status=0 WHERE bid_status=1 AND bid_id=$bidid";
                        $daugia_end_result = $db->Execute($daugia_end_query);
                            check_queryerror($daugia_end_query, $daugia_end_result);
                        // Cong VPoint cho chu item
                        $vpoint_add = floor($bid*(100-$Bid_VAT)/100);
                        $own_vpoint_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$vpoint_add WHERE memb___id='$acc_own'";
                        $own_vpoint_result = $db->Execute($own_vpoint_query);
                            check_queryerror($own_vpoint_query, $own_vpoint_result);
                        
                        echo "<info>OK2</info>";
                    } else {
                        echo "<info>OK</info>";
                    }
                }
            }
            
        break;
        
        case 'bid_end':
            $bidwin_list_query = "SELECT DauGia_Item.bid_id, item_name, item_info, item_image, bid_end, char_own, name, bid_vpoint, bid_time, price_min, price_max, reward_status, reward_time FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND bid_status=0 AND status=1 AND acc='$login' AND acc_own<>'$login' ORDER BY reward_status, reward_time DESC";
            $bidwin_list_result = $db->Execute($bidwin_list_query);
                check_queryerror($bidwin_list_query, $bidwin_list_result);
            
            $bidwin_count = 0;
            $bidwin_query = "";
            while($bidwin_list_fetch = $bidwin_list_result->FetchRow()) {
                ++$bidwin_count;
                $bidwin_list[] = array(
                    'bid_id'    =>  $bidwin_list_fetch[0],
                    'item_name'    =>  $bidwin_list_fetch[1],
                    'item_info'    =>  $bidwin_list_fetch[2],
                    'item_image'    =>  $bidwin_list_fetch[3],
                    'bid_end'    =>  date('H:i d/m', $bidwin_list_fetch[4]),
                    'char_own'    =>  $bidwin_list_fetch[5],
                    'acc'    =>  $login,
                    'name'    =>  $bidwin_list_fetch[6],
                    'bid_vpoint'    =>  $bidwin_list_fetch[7],
                    'bid_time'  =>  date('H:i d/m', $bidwin_list_fetch[8]),
                    'price_min' =>  $bidwin_list_fetch[9],
                    'price_max' =>  $bidwin_list_fetch[10],
                    'reward_status' =>  $bidwin_list_fetch[11],
                    'reward_time'  =>  date('H:i d/m', $bidwin_list_fetch[12])
                );
                
                if(strlen($bidwin_query) > 0) $bidwin_query .= ",";
                $bidwin_query .= $bidwin_list_fetch[0];
            }
            
            if($bidwin_count < 10) {
                if(strlen($bidwin_query) > 0) {
                    $bidwin_query = "AND DauGia_Bid.bid_id NOT IN ($bidwin_query)";
                }
                $bidwin_count_less = 10 - $bidwin_count;
                $bidend_list_query = "SELECT TOP $bidwin_count_less DauGia_Bid.bid_id FROM DauGia_Bid JOIN DauGia_Item ON DauGia_Bid.bid_id = DauGia_Item.bid_id AND acc='$login' AND acc_own<>'$login' AND bid_status=0 $bidwin_query GROUP BY DauGia_Bid.bid_id ORDER BY DauGia_Bid.bid_id DESC";
                $bidend_list_result = $db->Execute($bidend_list_query);
                    check_queryerror($bidend_list_query, $bidend_list_result);
                while($bidend_list_fetch = $bidend_list_result->FetchRow()) {
                    $bidid = $bidend_list_fetch[0];
                    $bid_info_query = "SELECT DauGia_Item.bid_id, item_name, item_info, item_image, bid_end, char_own, name, bid_vpoint, bid_time, price_min, price_max, reward_status, acc, reward_time FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND DauGia_Item.bid_id=$bidid AND status=1";
                    $bid_info_result = $db->Execute($bid_info_query);
                        check_queryerror($bid_info_query, $bid_info_result);
                    $bid_info_fetch = $bid_info_result->FetchRow();
                    
                    $bidwin_list[] = array(
                        'bid_id'    =>  $bid_info_fetch[0],
                        'item_name'    =>  $bid_info_fetch[1],
                        'item_info'    =>  $bid_info_fetch[2],
                        'item_image'    =>  $bid_info_fetch[3],
                        'bid_end'    =>  date('H:i d/m', $bid_info_fetch[4]),
                        'char_own'    =>  $bid_info_fetch[5],
                        'acc'   =>  $bidwin_list_fetch[12],
                        'name'    =>  $bid_info_fetch[6],
                        'bid_vpoint'    =>  $bid_info_fetch[7],
                        'bid_time'  =>  date('H:i d/m', $bid_info_fetch[8]),
                        'price_min' =>  $bid_info_fetch[9],
                        'price_max' =>  $bid_info_fetch[10],
                        'reward_status' =>  $bidwin_list_fetch[11],
                        'reward_time'  =>  date('H:i d/m', $bid_info_fetch[13])
                    );
                }
            }
            
            $bidwin_send = serialize($bidwin_list);
            echo "<nbb>OK<nbb>$bidwin_send<nbb>";
        break;
        
        case 'reward':
            kiemtra_online($login);
            
            $bidid = $_POST['bidid'];   $bidid = abs(intval($bidid));
            $item_reward_query = "SELECT item_code FROM DauGia_Item A JOIN DauGia_Bid B ON A.bid_id=$bidid AND A.bid_id=B.bid_id AND bid_status=0 AND reward_status=0 AND acc='$login' AND status=1";
            $item_reward_result = $db->Execute($item_reward_query);
                check_queryerror($item_reward_query, $item_reward_result);
            $item_reward_count = $item_reward_result->NumRows();
            if($item_reward_count == 0) {
                echo "Giải thưởng đã nhận. Vui lòng không nhận lại.";
            } else {
                $item_reward_fetch = $item_reward_result->FetchRow();
                $item_code = $item_reward_fetch[0];
                
                $warehouse_query = "SELECT Items FROM warehouse WHERE AccountID='$login'";
                $warehouse_result = $db->Execute($warehouse_query);
                    check_queryerror($warehouse_query, $warehouse_result);
                $warehouse_fetch = $warehouse_result->FetchRow();
                $warehouse = $warehouse_fetch[0];
                $warehouse = bin2hex($warehouse);
                $warehouse = strtoupper($warehouse);
                $warehouse1 = substr($warehouse,0,120*32);
                $warehouse2 = substr($warehouse,120*32);
                
                $data_send_arr = array(
                    'item_code' =>  $item_code,
                    'warehouse1'    =>  $warehouse1
                );
                $data_send = serialize($data_send_arr);
                
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_com_daugia.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key,
                    'action'    =>  'reward',
                    
                    'data_send'    =>  $data_send
                ); 
                $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
            
            	if ( empty($reponse) ) {
                    $notice = "Server bảo trì. Vui lòng liên hệ Admin để FIX";
                }
                else {
                    $info = read_TagName($reponse, 'info');
                    if($info == "Error") {
                        $notice = read_TagName($reponse, 'msg');
                    }
                    else if ($info == "OK") {
                        $warehouse1_receive = read_TagName($reponse, 'warehouse1');
                        if( strlen($warehouse1) == 0 ) {
                            $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                            
                            $arr_view = "\nDataSend:\n";
                            foreach($getcontent_data as $k => $v) {
                                $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                            }
                            writelog("log_api.txt", $arr_view . $reponse);
                        } else {
                            kiemtra_online($login);
            
                        	$warehouse_new = $warehouse1_receive . $warehouse2;
                            
                            $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                            $warehouse_update_result = $db->Execute($warehouse_update_query);
                                check_queryerror($warehouse_update_query, $warehouse_update_result);
                                
                            $nhangiai_query = "UPDATE DauGia_Item SET reward_status=1, reward_time=$timestamp WHERE bid_id=$bidid";
                            $nhangiai_result = $db->Execute($nhangiai_query);
                                check_queryerror($nhangiai_query, $nhangiai_result);
                            $notice  = "<info>OK</info>";
                        }
                    } else {
                        $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                        writelog("log_api.txt", $reponse);
                    }
                }
            }
            
            echo $notice;
        break;
        
        // Dau gia khong co ai tham gia
        case 'bid_own_unfinish':
            $bidown_list_query = "SELECT DauGia_Item.bid_id, item_name, item_info, item_image, price_min, price_max, bid_end, name, bid_vpoint, bid_time, itempass, trade_safe FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND bid_status=0 AND reward_status=0 AND acc_own='$login' AND acc='$login' AND status=1 ORDER BY DauGia_Item.bid_id DESC";
            $bidown_list_result = $db->Execute($bidown_list_query);
                check_queryerror($bidown_list_query, $bidown_list_result);
            
            $bidown_list_arr = array();
            while($bidown_list_fetch = $bidown_list_result->FetchRow()) {
                $bidown_list_arr[] = array(
                    'bid_id'    =>  $bidown_list_fetch[0],
                    'item_name'    =>  $bidown_list_fetch[1],
                    'item_info'    =>  $bidown_list_fetch[2],
                    'item_image'    =>  $bidown_list_fetch[3],
                    'price_min'    =>  $bidown_list_fetch[4],
                    'price_max'    =>  $bidown_list_fetch[5],
                    'bid_end'    =>  date('H:i d/m', $bidown_list_fetch[6]),
                    'name'    =>  $bidown_list_fetch[7],
                    'bid_vpoint'    =>  $bidown_list_fetch[8],
                    'bid_time'    =>  date('H:i d/m', $bidown_list_fetch[9]),
                    'itempass'    =>  $bidown_list_fetch[10],
                    'trade_safe'    =>  $bidown_list_fetch[11]
                );
            }
            
            $bidown_list = serialize($bidown_list_arr);
            echo "<nbb>OK<nbb>$bidown_list<nbb>";
        break;
        
        // Dau gia da co nguoi mua
        case 'bid_own_finish':
            $bidown_list_query = "SELECT TOP 10 DauGia_Item.bid_id, item_name, item_info, item_image, price_min, price_max, bid_end, name, bid_vpoint, bid_time, itempass, trade_safe FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND bid_status=0 AND acc_own='$login' AND acc <> '$login' AND status=1 ORDER BY DauGia_Item.bid_id DESC";
            $bidown_list_result = $db->Execute($bidown_list_query);
                check_queryerror($bidown_list_query, $bidown_list_result);
            
            $bidown_list_arr = array();
            while($bidown_list_fetch = $bidown_list_result->FetchRow()) {
                $bidown_list_arr[] = array(
                    'bid_id'    =>  $bidown_list_fetch[0],
                    'item_name'    =>  $bidown_list_fetch[1],
                    'item_info'    =>  $bidown_list_fetch[2],
                    'item_image'    =>  $bidown_list_fetch[3],
                    'price_min'    =>  $bidown_list_fetch[4],
                    'price_max'    =>  $bidown_list_fetch[5],
                    'bid_end'    =>  date('H:i d/m', $bidown_list_fetch[6]),
                    'name'    =>  $bidown_list_fetch[7],
                    'bid_vpoint'    =>  $bidown_list_fetch[8],
                    'bid_time'    =>  date('H:i d/m', $bidown_list_fetch[9]),
                    'itempass'    =>  $bidown_list_fetch[10],
                    'trade_safe'    =>  $bidown_list_fetch[11]
                );
            }
            
            $bidown_list = serialize($bidown_list_arr);
            echo "<nbb>OK<nbb>$bidown_list<nbb>";
        break;
        
        // Dau gia dang dien ra
        case 'bid_own_bidding':
            $bidown_list_query = "SELECT DauGia_Item.bid_id, item_name, item_info, item_image, price_min, price_max, bid_end, name, bid_vpoint, bid_time, itempass, trade_safe FROM DauGia_Item JOIN DauGia_Bid ON DauGia_Item.bid_id = DauGia_Bid.bid_id AND bid_status=1 AND acc_own='$login' AND status=1 ORDER BY DauGia_Item.bid_id DESC";
            $bidown_list_result = $db->Execute($bidown_list_query);
                check_queryerror($bidown_list_query, $bidown_list_result);
            
            $bidown_list_arr = array();
            while($bidown_list_fetch = $bidown_list_result->FetchRow()) {
                $bidown_list_arr[] = array(
                    'bid_id'    =>  $bidown_list_fetch[0],
                    'item_name'    =>  $bidown_list_fetch[1],
                    'item_info'    =>  $bidown_list_fetch[2],
                    'item_image'    =>  $bidown_list_fetch[3],
                    'price_min'    =>  $bidown_list_fetch[4],
                    'price_max'    =>  $bidown_list_fetch[5],
                    'bid_end'    =>  date('H:i d/m', $bidown_list_fetch[6]),
                    'name'    =>  $bidown_list_fetch[7],
                    'bid_vpoint'    =>  $bidown_list_fetch[8],
                    'bid_time'    =>  date('H:i d/m', $bidown_list_fetch[9]),
                    'itempass'    =>  $bidown_list_fetch[10],
                    'trade_safe'    =>  $bidown_list_fetch[11]
                );
            }
            
            $bidown_list = serialize($bidown_list_arr);
            echo "<nbb>OK<nbb>$bidown_list<nbb>";
        break;
        
        case 'giahan':
            $bidid = $_POST['bidid'];       $bidid = abs(intval($bidid));
            $bidday = $_POST['bidday'];     $bidday = abs(intval($bidday));
            
            if($bidday <= 0 || $bidday > 3) {
                echo '<font color="red"><b>Thời gian Item trên sàn không cho phép</b></font>';
            } else {
                $acc_info_query = "SELECT vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                $acc_info_result = $db->Execute($acc_info_query);
                    check_queryerror($acc_info_query, $acc_info_result);
                $acc_info_fetch = $acc_info_result->FetchRow();
                $vpoint = $acc_info_fetch[0];
                
                $vpoint_cost = $bidday*$Bid_Vpoint_Daily;
                
                if($vpoint_cost > $vpoint ) {
                    echo "<font color='red'><b>Tài khoản không đủ Vpoint để gia hạn đấu giá. Cần có ít nhất ". number_format($vpoint_cost, 0, ',', '.') ." Vpoint gia hạn Item trong vòng ". $bidday ." ngày";
                } else {
                    // Update VPoint
                    $vpoint_update_query = "UPDATE MEMB_INFO SET vpoint=vpoint-$vpoint_cost WHERE memb___id='$login'";
                    $vpoint_update_result = $db->Execute($vpoint_update_query);
                        check_queryerror($vpoint_update_query, $vpoint_update_result);
                        
                    // Update gia han
                    $bid_end = $timestamp + $bidday * 24*60*60;
                    $giahan_query = "UPDATE DauGia_Item SET bid_end=$bid_end, bid_status=1 WHERE bid_id=$bidid AND bid_status=0";
                    $giahan_result = $db->Execute($giahan_query);
                        check_queryerror($giahan_query, $giahan_result);
                    
                    echo "<info>OK</info>";
                }
            }
        break;
        
        case 'rutitem':
            kiemtra_online($login);
            
            $bidid = $_POST['bidid'];   $bidid = abs(intval($bidid));
            
            $item_rut_query = "SELECT item_code FROM DauGia_Item A JOIN DauGia_Bid B ON A.bid_id=$bidid AND A.bid_id=B.bid_id AND bid_status=0 AND reward_status=0 AND acc='$login' AND status=1";
            $item_rut_result = $db->Execute($item_rut_query);
                check_queryerror($item_rut_query, $item_rut_result);
            $item_rut_count = $item_rut_result->NumRows();
            if($item_rut_count == 0) {
                echo "Item đã rút, vui lòng không rút lại.";
            } else {
                $item_rut_fetch = $item_rut_result->FetchRow();
                $item_code = $item_rut_fetch[0];
                
                $warehouse_query = "SELECT Items FROM warehouse WHERE AccountID='$login'";
                $warehouse_result = $db->Execute($warehouse_query);
                    check_queryerror($warehouse_query, $warehouse_result);
                $warehouse_fetch = $warehouse_result->FetchRow();
                $warehouse = $warehouse_fetch[0];
                $warehouse = bin2hex($warehouse);
                $warehouse = strtoupper($warehouse);
                $warehouse1 = substr($warehouse,0,120*32);
                $warehouse2 = substr($warehouse,120*32);
                
                $data_send_arr = array(
                    'item_code' =>  $item_code,
                    'warehouse1'    =>  $warehouse1
                );
                $data_send = serialize($data_send_arr);
                
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_com_daugia.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key,
                    'action'    =>  'reward',
                    
                    'data_send'    =>  $data_send
                ); 
                $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
            
            	if ( empty($reponse) ) {
                    $notice = "Server bảo trì. Vui lòng liên hệ Admin để FIX";
                }
                else {
                    $info = read_TagName($reponse, 'info');
                    if($info == "Error") {
                        $notice = read_TagName($reponse, 'msg');
                    }
                    else if ($info == "OK") {
                        $warehouse1_receive = read_TagName($reponse, 'warehouse1');
                        if( strlen($warehouse1) == 0 ) {
                            $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                            
                            $arr_view = "\nDataSend:\n";
                            foreach($getcontent_data as $k => $v) {
                                $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                            }
                            writelog("log_api.txt", $arr_view . $reponse);
                        } else {
                            kiemtra_online($login);
            
                        	$warehouse_new = $warehouse1_receive . $warehouse2;
                            
                            $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                            $warehouse_update_result = $db->Execute($warehouse_update_query);
                                check_queryerror($warehouse_update_query, $warehouse_update_result);
                                
                            $bid_del_query = "DELETE FROM DauGia_Item WHERE bid_id=$bidid";
                            $bid_del_result = $db->Execute($bid_del_query);
                                check_queryerror($bid_del_query, $bid_del_result);
                            $notice  = "<info>OK</info>";
                        }
                    } else {
                        $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                        writelog("log_api.txt", $reponse);
                    }
                }
            }
            
            echo $notice;
        break;
    }
}

?>