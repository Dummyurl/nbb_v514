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
 

include_once('config/config_daugianguoc.php');
include('config/config_thehe.php');

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
$daugia_end_query = "SELECT bid_id FROM DauGiaNguoc_Item WHERE time_end<$timestamp AND bid_status=1";
$daugia_end_result = $db->Execute($daugia_end_query);
    check_queryerror($daugia_end_query, $daugia_end_result);
while($daugia_end_fetch = $daugia_end_result->FetchRow()) {
    $bid_id = $daugia_end_fetch[0];
    $listbid_query = "SELECT acc, name, bid_vpoint, bid_time FROM DauGiaNguoc_Bid WHERE bid_id=$bid_id";
    $listbid_result = $db->Execute($listbid_query);
        check_queryerror($listbid_query, $listbid_result);
    $listbid_count = $listbid_result->NumRows();
    if($listbid_count > 0) {
    // Có tham gia đấu giá, lấy danh sách
        while($listbid_fetch = $listbid_result->FetchRow()) {
            $listbid[$bid_id][] = array(
                'acc'   =>  $listbid_fetch[0],
                'name'   =>  $listbid_fetch[1],
                'bid_vpoint'   =>  $listbid_fetch[2],
                'bid_time'   =>  $listbid_fetch[3]
            );
        }
    } else {
    // Khong co ai tham gia, Update ket thuc
        $daugia_end_update_query = "UPDATE DauGiaNguoc_Item SET bid_status=0 WHERE bid_id=$bid_id";
        $daugia_end_update_result = $db->Execute($daugia_end_update_query);
            check_queryerror($daugia_end_update_query, $daugia_end_update_result);
    }
}

if(count($listbid) > 0) {
    
    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_com_daugianguoc.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        'action'    =>  'bid_win',
        
        'listbid'    =>  serialize($listbid)
    ); 
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $notice = "Server bảo trì. Vui lòng liên hệ Admin để FIX";
    }
    else {
        $info = read_TagName($reponse, 'info');
        if ($info == "OK") {
            $win = read_TagName($reponse, 'win');
            if( strlen($win) == 0 ) {
                $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                
                $arr_view = "\nDataSend:\n";
                foreach($getcontent_data as $k => $v) {
                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                }
                writelog("log_api.txt", $arr_view . $reponse);
            } else {
            	$win_arr = unserialize_safe($win);
                foreach($win_arr as $bidid => $win_val) {
                    $daugia_end_update_query = "UPDATE DauGiaNguoc_Item SET bid_status=0 WHERE bid_id=$bidid";
                    $daugia_end_update_result = $db->Execute($daugia_end_update_query);
                        check_queryerror($daugia_end_update_query, $daugia_end_update_result);
                        
                    $win_update_query = "UPDATE DauGiaNguoc_Bid SET win=1 WHERE acc='". $win_val['acc'] ."' AND name='". $win_val['name'] ."' AND bid_vpoint='". $win_val['bid_vpoint'] ."' AND bid_time='". $win_val['bid_time'] ."'";
                    $win_update_result = $db->Execute($win_update_query);
                        check_queryerror($win_update_query, $win_update_result);
                        
                    // Hoan tra Vpoint
                    $bid_acc_query = "SELECT acc, SUM(bid_vpoint) FROM DauGiaNguoc_Bid WHERE bid_id=$bidid GROUP BY acc";
                    $bid_acc_result = $db->Execute($bid_acc_query);
                        check_queryerror($bid_acc_query, $bid_acc_result);
                    while($bid_acc_fetch = $bid_acc_result->FetchRow()) {
                        $acc_bid = $bid_acc_fetch[0];
                        $vpoint_bid_sum = $bid_acc_fetch[1];
                        if($acc_bid == $win_val['acc']) {
                            $vpoint_bid_sum = $vpoint_bid_sum - $win_val['bid_vpoint'];
                        }
                        $vpoint_update_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$vpoint_bid_sum WHERE memb___id='$acc_bid'";
                        $vpoint_update_result = $db->Execute($vpoint_update_query);
                            check_queryerror($vpoint_update_query, $vpoint_update_result);
                    }
                }
            }
        } else {
            $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
            writelog("log_api.txt", $reponse);
        }
    }
    if(isset($notice)) {
        echo $notice;
        exit();
    }
}
// End xu ly dau gia ket thuc

    switch ($action){ 
    	case 'listitem_biding':
            
            $listitem_query = "SELECT bid_id, item_name, item_info, item_image, price_min, bid_mod, time_begin, time_end FROM DauGiaNguoc_Item WHERE bid_status=1 ORDER BY time_end";
            $listitem_result = $db->Execute($listitem_query);
                check_queryerror($listitem_query, $listitem_result);
            
            $listitem_arr = array();
            while($listitem_fetch = $listitem_result->FetchRow()) {
                
                $thehe_query = "SELECT thehe FROM DauGiaNguoc_TheHe WHERE bid_id=". $listitem_fetch[0];
                $thehe_result = $db->Execute($thehe_query);
                    check_queryerror($thehe_query, $thehe_result);
                $thehe = array();
                $item_in_thehe = false;
                while($thehe_fetch = $thehe_result->FetchRow()) {
                    $thehe_check = $thehe_fetch[0];
                    $thehe[] = $thehe_check;
                    if(strlen($thehe_choise[$thehe_check]) > 0) $item_in_thehe = true;
                }
                
                if($item_in_thehe === true) {
                    $bid_time_status = 1;
                    if($timestamp < $listitem_fetch[6]) {
                        $bid_time_status = 0;
                    }
                    $listitem_arr[] = array(
                        'bid_id'    =>  $listitem_fetch[0],
                        'item_name' =>  $listitem_fetch[1],
                        'item_info' =>  $listitem_fetch[2],
                        'item_image'    =>  $listitem_fetch[3],
                        'price_min'    =>  $listitem_fetch[4],
                        'bid_mod'    =>  $listitem_fetch[5],
                        'bid_time_status'    =>  $bid_time_status,
                        'time_begin'    =>  date('H:i d/m/Y', $listitem_fetch[6]),
                        'time_end'    =>  date('H:i d/m/Y', $listitem_fetch[7]),
                        'thehe' =>  $thehe
                    );
                }
            }
            
            $listitem = serialize($listitem_arr);
            echo "<nbb>OK<nbb>$listitem<nbb>";
    	break;
        
        case 'listitem_end':
            
            $listitem_query = "SELECT A.bid_id, item_name, item_info, item_image, price_min, bid_mod, time_begin, time_end, name, bid_vpoint FROM DauGiaNguoc_Item A JOIN DauGiaNguoc_Bid B ON A.bid_id=B.bid_id AND bid_status=0 AND win=1 ORDER BY time_end DESC";
            $listitem_result = $db->Execute($listitem_query);
                check_queryerror($listitem_query, $listitem_result);
            
            $listitem_arr = array();
            $slg = 0;
            while($listitem_fetch = $listitem_result->FetchRow()) {
                
                $thehe_query = "SELECT thehe FROM DauGiaNguoc_TheHe WHERE bid_id=". $listitem_fetch[0];
                
                $thehe_result = $db->Execute($thehe_query);
                    check_queryerror($thehe_query, $thehe_result);
                $thehe = array();
                $item_in_thehe = false;
                while($thehe_fetch = $thehe_result->FetchRow()) {
                    $thehe_check = $thehe_fetch[0];
                    $thehe[] = $thehe_check;
                    if(strlen($thehe_choise[$thehe_check]) > 0) $item_in_thehe = true;
                }
                
                if($item_in_thehe == true) {
                    ++$slg;
                    
                    $listbid_query = "SELECT name, bid_vpoint, bid_time, win, thehe FROM DauGiaNguoc_Bid A JOIN MEMB_INFO B ON A.acc collate DATABASE_DEFAULT =B.memb___id collate DATABASE_DEFAULT AND bid_id=". $listitem_fetch[0] ." ORDER BY bid_vpoint, bid_time";
                    $listbid_result = $db->Execute($listbid_query);
                        check_queryerror($listbid_query, $listbid_result);
                    
                    $listbid = array();
                    while($listbid_fetch = $listbid_result->FetchRow()) {
                        
                        $win = 0;
                        if($listbid_fetch[0] == $listitem_fetch[8] && $listbid_fetch[1] == $listitem_fetch[9]) $win = 1;
                        $listbid[] = array(
                            'name'  =>  $listbid_fetch[0],
                            'bid_vpoint'    =>  $listbid_fetch[1],
                            'bid_time'  =>  date('H:i:s d/m', $listbid_fetch[2]),
                            'win'   =>  $listbid_fetch[3],
                            'thehe' =>  $listbid_fetch[4]
                        );
                    }
                    
                    $listitem_arr[] = array(
                        'bid_id'    =>  $listitem_fetch[0],
                        'item_name' =>  $listitem_fetch[1],
                        'item_info' =>  $listitem_fetch[2],
                        'item_image'    =>  $listitem_fetch[3],
                        'price_min'    =>  $listitem_fetch[4],
                        'bid_mod'    =>  $listitem_fetch[5],
                        'time_begin'    =>  date('H:i d/m/Y', $listitem_fetch[6]),
                        'time_end'    =>  date('H:i d/m/Y', $listitem_fetch[7]),
                        'char_win'  =>  $listitem_fetch[8],
                        'vpoint_win'    =>  $listitem_fetch[9],
                        'thehe' =>  $thehe,
                        'listbid'   =>  $listbid
                    );
                    
                    if($slg >= 10) break;
                }
            }
            
            $listitem = serialize($listitem_arr);
            echo "<nbb>OK<nbb>$listitem<nbb>";
    	break;
    	
        case 'listitem_win':
            
            $listitem_query = "SELECT TOP 10 A.bid_id, item_name, item_info, item_image, price_min, bid_mod, time_begin, time_end, name, bid_vpoint, reward_status, reward_time FROM DauGiaNguoc_Item A JOIN DauGiaNguoc_Bid B ON bid_status=0 AND A.bid_id=B.bid_id AND win=1 AND acc='$login' ORDER BY time_end DESC";
            $listitem_result = $db->Execute($listitem_query);
                check_queryerror($listitem_query, $listitem_result);
            
            $listitem_arr = array();
            while($listitem_fetch = $listitem_result->FetchRow()) {
                
                $listbid_query = "SELECT name, bid_vpoint, bid_time, win FROM DauGiaNguoc_Bid WHERE bid_id=". $listitem_fetch[0] ." ORDER BY bid_vpoint, bid_time";
                $listbid_result = $db->Execute($listbid_query);
                    check_queryerror($listbid_query, $listbid_result);
                
                if(isset($listitem_fetch[11])) {
                    $nhangiai_time = date('H:i:s d/m', $listitem_fetch[11]);
                } else {
                    $nhangiai_time = '';
                }
                
                $listitem_arr[] = array(
                    'bid_id'    =>  $listitem_fetch[0],
                    'item_name' =>  $listitem_fetch[1],
                    'item_info' =>  $listitem_fetch[2],
                    'item_image'    =>  $listitem_fetch[3],
                    'price_min'    =>  $listitem_fetch[4],
                    'bid_mod'    =>  $listitem_fetch[5],
                    'time_begin'    =>  date('H:i d/m/Y', $listitem_fetch[6]),
                    'time_end'    =>  date('H:i d/m/Y', $listitem_fetch[7]),
                    'char_win'  =>  $listitem_fetch[8],
                    'vpoint_win'    =>  $listitem_fetch[9],
                    'nhangiai'    =>  $listitem_fetch[10],
                    'nhangiai_time' =>  $nhangiai_time
                );
            }
            
            $listitem = serialize($listitem_arr);
            echo "<nbb>OK<nbb>$listitem<nbb>";
    	break;
        
        case 'bid':
            $bidid = $_POST['bidid'];   $bidid = abs(intval($bidid));
            $bid = $_POST['bid'];       $bid = abs(intval($bid));

            $daugia_info_query = "SELECT price_min, bid_mod, time_begin, time_end, bid_status FROM DauGiaNguoc_Item WHERE bid_id=$bidid";
            $daugia_info_result = $db->Execute($daugia_info_query);
                check_queryerror($daugia_info_query, $daugia_info_result);
            $daugia_numb = $daugia_info_result->NumRows();
            if($daugia_numb == 0) {
                echo "Đấu giá không tồn tại.";
            } else {
                $bided_check_query = "SELECT count(*) FROM DauGiaNguoc_Bid WHERE acc='$login' AND bid_id=$bidid AND bid_vpoint=$bid";
                $bided_check_result = $db->Execute($bided_check_query);
                    check_queryerror($bided_check_query, $bided_check_result);
                $bided_check_fetch = $bided_check_result->FetchRow();
                if($bided_check_fetch[0] > 0) {
                    echo "Bạn đã đấu cho Item với giá này rồi. Vui lòng chọn giá đấu khác.";
                } else {
                    $daugia_info_fetch = $daugia_info_result->FetchRow();
                    $price_min = $daugia_info_fetch[0];
                    $bid_mod = $daugia_info_fetch[1];
                    $time_begin = $daugia_info_fetch[2];
                    $time_end = $daugia_info_fetch[3];
                    $bid_status = $daugia_info_fetch[4];
                    
                    $vpoint_query = "SELECT vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                    $vpoint_result = $db->Execute($vpoint_query);
                        check_queryerror($vpoint_query, $vpoint_result);
                    $vpoint_fetch = $vpoint_result->FetchRow();
                    $vpoint = $vpoint_fetch[0];
                    
                    if($bid_status == 0) {
                        echo "Đấu giá đã kết thúc.";
                    } else if($time_end < $timestamp){
                        echo "Đấu giá đã kết thúc.";
                    } else if($time_begin > $timestamp) {
                        echo "Đấu giá chưa bắt đầu.";
                    } else if($bid < $price_min) {
                        echo "Giá đấu $bid phải lớn hơn hoặc bằng ". number_format($price_min, 0, ',', '.');
                    } else if($bid % $bid_mod != 0) {
                        echo "Giá đấu $bid phải chia hết cho $bid_mod";
                    } else if($vpoint < ($bid + $Vpoint_Bid)) {
                        echo "Tài khoản không đủ Vpoint để tham gia đấu giá. Cần có ít nhất $bid Vpoint để đặt và $Vpoint_Bid chi phí đấu giá";
                    } else {
                        $bid_insert_query = "INSERT INTO DauGiaNguoc_Bid (bid_id, acc, name, bid_vpoint, bid_time) VALUES ($bidid, '$login', '$name', $bid, $timestamp)";
                        $bid_insert_result = $db->Execute($bid_insert_query);
                            check_queryerror($bid_insert_query, $bid_insert_result);
                        $vpoint_tru = $bid + $Vpoint_Bid;
                        $vpoint_tru_query = "UPDATE MEMB_INFO SET vpoint=vpoint-$vpoint_tru WHERE memb___id='$login'";
                        $vpoint_tru_result = $db->Execute($vpoint_tru_query);
                            check_queryerror($vpoint_tru_query, $vpoint_tru_result);
                        echo "OK";
                    }
                }
            }
    	break;
        
        case 'bidding_view':
            $bidid = $_POST['bidid'];   $bidid = abs(intval($bidid));
            $listbid_query = "SELECT name, bid_vpoint, bid_time FROM DauGiaNguoc_Bid WHERE bid_id=$bidid AND acc='$login'";
            $listbid_result = $db->Execute($listbid_query);
                check_queryerror($listbid_query, $listbid_result);
            while($listbid_fetch = $listbid_result->FetchRow()) {
                $listbid_arr[] = array(
                    'name'  =>  $listbid_fetch[0],
                    'bid_vpoint'    =>  $listbid_fetch[1],
                    'bid_time'  =>  date('H:i:s d/m', $listbid_fetch[2])
                );
            }
            
            $listbid = serialize($listbid_arr);
            
            echo "
                <info>OK</info>
                <data>". $listbid ."</data>
            ";
        break;
        
        case 'reward':
            kiemtra_online($login);
            
            $bidid = $_POST['bidid'];   $bidid = abs(intval($bidid));
            $item_reward_query = "SELECT item_code FROM DauGiaNguoc_Item A JOIN DauGiaNguoc_Bid B ON A.bid_id=$bidid AND A.bid_id=B.bid_id AND bid_status=0 AND reward_status=0 AND acc='$login' AND win=1";
            $item_reward_result = $db->Execute($item_reward_query);
                check_queryerror($item_reward_query, $item_reward_result);
            $item_reward_count = $item_reward_result->NumRows();
            if($item_reward_count == 0) {
                echo "Giải thưởng đã nhận. Vui lòng không nhận lại.";
            } else {
                $item_reward_fetch = $item_reward_result->FetchRow();
                $item_code = $item_reward_fetch[0];
                $item_seri = _getSerial();
                
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
                    'item_seri' =>  $item_seri,
                    'warehouse1'    =>  $warehouse1
                );
                $data_send = serialize($data_send_arr);
                
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_com_daugianguoc.php";
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
                                
                            $nhangiai_query = "UPDATE DauGiaNguoc_Item SET reward_status=1, reward_time=$timestamp WHERE bid_id=$bidid";
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
    }
}
$db->Close();
?>