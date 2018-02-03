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
include_once('config.php');
include_once('function.php');
include_once('config/config_event.php');

$login = $_POST['login'];
$name = $_POST['name'];
$action = $_POST['action'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
$time_event_begin = strtotime($event_epitem_begin);
$time_event_end = strtotime($event_epitem_end) + 24*60*60;


    switch ($action){ 
    	case 'regnew_list':
        if( ($event_epitem_on == 1) && ($time_event_begin < $timestamp) && ($time_event_end > $timestamp) )
            {
                
            checklogin($login,$string_login);
            if(check_nv($login, $name) == 0) {
                echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
            }

            $chracter_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
            $character_result = $db->Execute($chracter_query);
                check_queryerror($chracter_query, $character_result);
            $character_fetch = $character_result->FetchRow();
            $inventory = $character_fetch[0];
            $inventory = bin2hex($inventory);
            $inventory = strtoupper($inventory);
            
            $inventory1 = substr($inventory,0,12*32);
            $inventory2 = substr($inventory,12*32,64*32);
            $inventory_send = $inventory1 . $inventory2;
            
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_event_epitem.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  $action,
                
                'inventory_send'    =>  $inventory_send,
                'event_epitem_exlmin_begin'  =>  $event_epitem_exlmin_begin,
                'event_epitem_exlmax_begin'  =>  $event_epitem_exlmax_begin,
                'event_epitem_lvlmin_begin'  =>  $event_epitem_lvlmin_begin,
                'event_epitem_lvlmax_begin'  =>  $event_epitem_lvlmax_begin
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
            
            $listitem_arr = unserialize($listitem);
            foreach($listitem_arr as $key => $value) {
                $listitem_arr_new[$key] = $value;
                $check_reg_query = "SELECT count(*) FROM EventEpItem WHERE seri='". $value['serial'] ."' AND time_reg > $time_event_begin";
                $check_reg_result = $db->Execute($check_reg_query);
                    check_queryerror($check_reg_query, $check_reg_result);
                $check_reg_fetch = $check_reg_result->FetchRow();
                if($check_reg_fetch[0] ==0) {
                    $listitem_arr_new[$key]['reged'] = 0;
                } else {
                    $listitem_arr_new[$key]['reged'] = 1;
                }
            }
            
            $listitem_arr_new = serialize($listitem_arr_new);
            
            echo "<nbb>OK<nbb>$listitem_arr_new<nbb>";
        } else {
            echo "Không phải thời gian diễn ra Event"; exit();
        }
    	break;
        
        case 'regnew_item':
        if( ($event_epitem_on == 1) && ($time_event_begin < $timestamp) && ($time_event_end > $timestamp) )
            {
            checklogin($login,$string_login);
            if(check_nv($login, $name) == 0) {
                echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
            }

            $serial = $_POST['serial'];
            
            $chracter_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
            $character_result = $db->Execute($chracter_query);
                check_queryerror($chracter_query, $character_result);
            $character_fetch = $character_result->FetchRow();
            $inventory = $character_fetch[0];
            $inventory = bin2hex($inventory);
            $inventory = strtoupper($inventory);
            
            $inventory1 = substr($inventory,0,12*32);
            $inventory2 = substr($inventory,12*32,64*32);
            $inventory_send = $inventory1 . $inventory2;
            
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_event_epitem.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  $action,
                
                'inventory_send'    =>  $inventory_send,
                'serial'    =>  $serial,
                'event_epitem_exlmin_begin'  =>  $event_epitem_exlmin_begin,
                'event_epitem_exlmax_begin'  =>  $event_epitem_exlmax_begin,
                'event_epitem_lvlmin_begin'  =>  $event_epitem_lvlmin_begin,
                'event_epitem_lvlmax_begin'  =>  $event_epitem_lvlmax_begin
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
                    $data_arr = unserialize_safe($data);
                    $msg = $data_arr['msg'];
                    $infoitem = $data_arr['infoitem'];
                    $itemcode = $data_arr['itemcode'];
                    $lvl = $data_arr['lvl'];
                    $image = $data_arr['image'];
                    if(strlen($msg) == 0 || strlen($infoitem) == 0 || strlen($itemcode) == 0 || strlen($lvl) == 0 || strlen($image) == 0) {
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
            
            if($msg == 'OK') {
                $itemcheck_query = "SELECT count(*) FROM EventEpItem WHERE seri='$serial' AND time_reg > $time_event_begin";
                $itemcheck_result = $db->Execute($itemcheck_query);
                    check_queryerror($itemcheck_query, $itemcheck_result);
                $itemcheck_fetch = $itemcheck_result->FetchRow();
                
                if($itemcheck_fetch[0] == 0) {
                    $regitem_query = "INSERT INTO EventEpItem (acc, name, item, seri, lvl, time_reg, info, image) VALUES ('$login', '$name', '$itemcode', '$serial', $lvl, $timestamp, '$infoitem', '$image')";
                    $regitem_result = $db->Execute($regitem_query);
                        check_queryerror($regitem_query, $regitem_result);
                        
                    $notice = "OK";
                } else {
                    $notice = "Item đã đăng ký từ trước. Không được đăng ký lại.";
                }
            } else $notice = $msg;
            
            echo $notice;
         } else {
            echo "Không phải thời gian diễn ra Event"; exit();
        }
    	break;
        
    	case 'reged':
            checklogin($login,$string_login);
            if(check_nv($login, $name) == 0) {
                echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
            }

            $itemreg = array();
            $itemreg_query = "SELECT seri, image, time_reg, info, time_finish, infoend, status FROM EventEpItem WHERE acc='$login' AND name='$name' AND time_reg > $time_event_begin";
            $itemreg_result = $db->Execute($itemreg_query);
                check_queryerror($itemreg_query, $itemreg_result);
            while($itemreg_fetch = $itemreg_result->FetchRow()) {
                $itemreg[] = array(
                    'seri'  =>  $itemreg_fetch[0],
                    'image' =>  $itemreg_fetch[1],
                    'time_reg'  =>  date('H:i d/m', $itemreg_fetch[2]),
                    'info'  =>  $itemreg_fetch[3],
                    'time_finish'   =>  date('H:i d/m', $itemreg_fetch[4]),
                    'infoend'   =>  $itemreg_fetch[5],
                    'status'    =>  $itemreg_fetch[6]
                );
            }
            $itemreg_send = serialize($itemreg);
            
            echo "<nbb>OK<nbb>$itemreg_send<nbb>";
    	break;
    
    	case 'update':
        if( ($event_epitem_on == 1) && ($time_event_begin < $timestamp) && ($time_event_end > $timestamp) )
            {
            checklogin($login,$string_login);
            if(check_nv($login, $name) == 0) {
                echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
            }

            $serial = $_POST['serial'];
            
            $check_query = "SELECT count(*) FROM EventEpItem WHERE seri='$serial' AND acc='$login' AND name='$name' AND time_reg > $time_event_begin";
            $check_result = $db->Execute($check_query);
                check_queryerror($check_query, $check_result);
            $check_fetch = $check_result->FetchRow();
            
            if($check_fetch[0] == 0) {
                echo "Item đăng ký không thuộc tài khoản và nhân vật này."; exit();
            } else {
                $chracter_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
                $character_result = $db->Execute($chracter_query);
                    check_queryerror($chracter_query, $character_result);
                $character_fetch = $character_result->FetchRow();
                $inventory = $character_fetch[0];
                $inventory = bin2hex($inventory);
                $inventory = strtoupper($inventory);
                
                $inventory1 = substr($inventory,0,12*32);
                $inventory2 = substr($inventory,12*32,64*32);
                $inventory_send = $inventory1 . $inventory2;
                
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_event_epitem.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key,
                    'action'    =>  $action,
                    
                    'inventory_send'    =>  $inventory_send,
                    'serial'    =>  $serial,
                    'event_epitem_exlmin_end'  =>  $event_epitem_exlmin_end,
                    'event_epitem_exlmax_end'  =>  $event_epitem_exlmax_end,
                    'event_epitem_lvlmin_end'  =>  $event_epitem_lvlmin_end,
                    'event_epitem_lvlmax_end'  =>  $event_epitem_lvlmax_end
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
                        $data_arr = unserialize_safe($data);
                        $msg = $data_arr['msg'];
                        $infoitem = $data_arr['infoitem'];
                        $lvlitem = $data_arr['lvl'];
                        $itemname = $data_arr['itemname'];
                        $item_totalexc = $data_arr['item_totalexc'];
                        if(strlen($msg) == 0) {
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
                
                if($msg == 'OK') {
                    $update_query = "UPDATE EventEpItem SET time_finish=$timestamp, infoend='$infoitem', status=1 WHERE acc='$login' AND name='$name' AND seri='$serial' AND status=0 AND time_reg > $time_event_begin";
                    $update_result = $db->Execute($update_query);
                        check_queryerror($update_query, $update_result);
                    if(file_exists('config/config_sendmess.php')) {
                        include_once('config/config_sendmess.php');
                        if($Use_SendMess_Event_EpItem == 1) {
                            $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
                            $thehe_result = $db->Execute($thehe_query);
                                check_queryerror($thehe_query, $thehe_result);
                            $thehe_fetch = $thehe_result->fetchrow();
                            $thehe = $thehe_fetch[0];
                            
                            include('config/config_thehe.php');
                            $thehe_name = $thehe_choise[$thehe];
                            $mess_send = '['. $thehe_name. '] '. $name .' hoàn thành nâng cấp Item '. $itemname .' +'. $lvlitem .' '. $item_totalexc .' dòng hoàn hảo';
                            
                            include_once('config_license.php');
                            include_once('func_getContent.php');
                            $getcontent_url = $url_license . "/api_sendmess.php";
                            $getcontent_data = array(
                                'acclic'    =>  $acclic,
                                'key'    =>  $key,
                                
                                'mess_send'    =>  $mess_send
                            ); 
                            
                            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                        
                            $info = read_TagName($reponse, 'info');
                            if ($info == "OK") {
                                $mess_receive = read_TagName($reponse, 'mess_receive', 0);
                                $mess_total = $mess_receive[0];
                                
                                for($i=1; $i<=$mess_total; $i++) {
                                    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                                    if ($x = socket_connect($socket, '127.0.0.1', $joinserver_port))
                                    {
                                        socket_write($socket, $mess_receive[$i]);
                                    } else {
                                        socket_close($socket);
                                        break;
                                    }
                                    socket_close($socket);
                                }
                            }
                        }
                    }
                }
                
                echo "<nbb>OK<nbb>$msg<nbb>$infoitem<nbb>";
            }
        } else {
            echo "Không phải thời gian diễn ra Event"; exit();
        }
    	break;
        
        case 'rank':
            include('config/config_thehe.php');
            $inthehe = '(';
            foreach($thehe_choise as $key => $value) {
                if(strlen($inthehe) > 5) {
                    $inthehe .= " OR ";
                }
                if(strlen($value) > 0) {
                    $inthehe .= "thehe=$key";
                }
            }
            $inthehe .= ')';
            
            
            $list_rank_ear_list = array();
            $list_rank_ear_query = "SELECT EventEpItem.acc, EventEpItem.name, EventEpItem.image, EventEpItem.time_reg, EventEpItem.info, EventEpItem.time_finish, EventEpItem.infoend FROM EventEpItem JOIN MEMB_INFO ON EventEpItem.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND EventEpItem.status=1 AND EventEpItem.time_reg > $time_event_begin AND $inthehe ORDER BY time_finish";
            $list_rank_ear_result = $db->Execute($list_rank_ear_query);
                check_queryerror($list_rank_ear_query, $list_rank_ear_result);
            while($list_rank_ear_fetch = $list_rank_ear_result->FetchRow()) {
                $islogin = 0;
                if($list_rank_ear_fetch[0] == $login) $islogin = 1;
                $list_rank_ear_list[] = array(
                    'name'  =>  $list_rank_ear_fetch[1],
                    'image' =>  $list_rank_ear_fetch[2],
                    'time_reg'  =>  date('H:i d/m', $list_rank_ear_fetch[3]),
                    'info'  =>  $list_rank_ear_fetch[4],
                    'time_finish'   =>  date('H:i d/m', $list_rank_ear_fetch[5]),
                    'infoend'   =>  $list_rank_ear_fetch[6],
                    'islogin'   =>  $islogin
                );
            }
            
            $list_rank_slg_list = array();
            $list_rank_slg_query = "SELECT EventEpItem.name, count(EventEpItem.name) as count FROM EventEpItem JOIN MEMB_INFO ON EventEpItem.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND EventEpItem.status=1 AND EventEpItem.time_reg > $time_event_begin AND $inthehe GROUP BY name ORDER BY count DESC";
            $list_rank_slg_result = $db->Execute($list_rank_slg_query);
                check_queryerror($list_rank_slg_query, $list_rank_slg_result);
            while($list_rank_slg_fetch = $list_rank_slg_result->FetchRow()) {
                $list_rank_slg_list[] = array(
                    'name'  =>  $list_rank_slg_fetch[0],
                    'count' =>  $list_rank_slg_fetch[1]
                );
            }
            
            $list_rank_ear = serialize($list_rank_ear_list);
            $list_rank_slg = serialize($list_rank_slg_list);
            
            echo "<nbb>OK<nbb>$list_rank_slg<nbb>$list_rank_ear<nbb>";
        break;
    }
}
$db->Close();
?>