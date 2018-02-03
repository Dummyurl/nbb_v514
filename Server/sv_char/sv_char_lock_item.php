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
 
include_once('config/config_event.php');
$time_event_begin = strtotime($event_epitem_begin);
$time_event_end = strtotime($event_epitem_end) + 24*60*60;

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

    switch ($action){ 
    	case 'list':
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
            $getcontent_url = $url_license . "/api_lockitem.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  $action,
                
                'inventory_send'    =>  $inventory_send
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
                if($timestamp > $time_event_end) {
                    $listitem_arr_new[$key]['event_epitem'] = 0;
                } else {
                    $check_reg_query = "SELECT count(*) FROM EventEpItem WHERE seri='". $value['serial'] ."' AND time_reg > $time_event_begin AND time_finish IS NULL";
                    $check_reg_result = $db->Execute($check_reg_query);
                        check_queryerror($check_reg_query, $check_reg_result);
                    $check_reg_fetch = $check_reg_result->FetchRow();
                    if($check_reg_fetch[0] ==0 ) {
                        $listitem_arr_new[$key]['event_epitem'] = 0;
                    } else {
                        $listitem_arr_new[$key]['event_epitem'] = 1;
                    }
                }
            }
            
            $listitem_arr_new = serialize($listitem_arr_new);
            
            echo "<nbb>OK<nbb>$listitem_arr_new<nbb>";
    	break;
        
        case 'lock':
            include('config/config_lockitem.php');
            kiemtra_doinv($login,$name);
            kiemtra_online($login);
            
            $opd = $_POST['opd'];   $opd_md5 = md5($opd);
            $timeallow = $timestamp - 24*60*60;
            $opd_query = "SELECT opd,time  FROM OnePassDay WHERE acc='$login'";
            $opd_result = $db->Execute($opd_query);
                check_queryerror($opd_query, $opd_result);
            $opd_exists = $opd_result->NumRows();
            if($opd_exists == 0) {
                $notice = "Tài khoản chưa khởi tạo Mật khẩu OPD.<br />Vui lòng tạo mật khẩu OPD.";
            } else {
                $opd_fetch = $opd_result->FetchRow();
                if($opd_fetch[1] < $timeallow) {
                    $notice = "Mật khẩu OPD đã hết thời gian hiệu lực.<br />Vui lòng lấy Mật khẩu OPD mới.";
                } else if($opd_fetch[0] != $opd_md5) {
                    $notice = "Mật khẩu OPD không chính xác.";
                } else {
                    $serial = $_POST['serial'];
                    $vitri = $_POST['vitri'];
                    
                    $accinfo_query = "SELECT gcoin, gcoin_km FROM MEMB_INFO WHERE memb___id='$login'";
                    $accinfo_result = $db->Execute($accinfo_query);
                        check_queryerror($accinfo_query, $accinfo_result);
                    $accinfo_fetch = $accinfo_result->FetchRow();
                    $gcoin_before = $accinfo_fetch[0];
                    $gcoin_km_before = $accinfo_fetch[1];
                    
                    $gcoin = $accinfo_fetch[0];
                    $gcoin_km = $accinfo_fetch[1];
                    
                    if( ($gcoin + $gcoin_km) < $lockitem_gcoin ) {
                        $notice = "Không đủ Gcoin hoặc Gcoin khuyến mãi để thực hiện Bảo vệ Đồ";
                    } else {
                        $chracter_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
                        $character_result = $db->Execute($chracter_query);
                            check_queryerror($chracter_query, $character_result);
                        $character_fetch = $character_result->FetchRow();
                        $inventory = $character_fetch[0];
                        $inventory = bin2hex($inventory);
                        $inventory = strtoupper($inventory);
                        $inventory_len = strlen($inventory);
                        
                        $inventory1 = substr($inventory,0,12*32);
                        $inventory2 = substr($inventory,12*32,64*32);
                        $inventory3 = substr($inventory,76*32);
                        $inventory_send = $inventory1 . $inventory2;
                        
                        include_once('config_license.php');
                        include_once('func_getContent.php');
                        $getcontent_url = $url_license . "/api_lockitem.php";
                        $getcontent_data = array(
                            'acclic'    =>  $acclic,
                            'key'    =>  $key,
                            'action'    =>  $action,
                            
                            'inventory_send'    =>  $inventory_send,
                            'serial'    =>  $serial,
                            'gcoin' =>  $gcoin,
                            'gcoin_km'  =>  $gcoin_km,
                            'lockitem_gcoin'  =>  $lockitem_gcoin,
                            'vitri' =>  $vitri
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
                                $inventory_receive = $data_arr['inventory_receive'];
                                $item_lock_arr = $data_arr['item_lock'];
                                $gcoin_new = $data_arr['gcoin_new'];
                                $gcoinkm_new = $data_arr['gcoinkm_new'];
                                if(strlen($msg) == 0 || strlen($inventory_receive) == 0 || count($item_lock_arr) == 0 || strlen($gcoin_new) == 0 || strlen($gcoinkm_new) == 0) {
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
                            kiemtra_doinv($login,$name);
                            kiemtra_online($login);
                            $inventory_after = $inventory_receive . $inventory3;
                            $inventory_after_len = strlen($inventory_after);
                            
                            if($inventory_len != $inventory_after_len) {
                                $notice = "Dữ liệu item sau khi xử lý sai.";
                            } else {
                                $infoacc_update_query = "UPDATE MEMB_INFO SET gcoin=$gcoin_new, gcoin_km=$gcoinkm_new WHERE memb___id='$login'";
                                $infoacc_update_result = $db->Execute($infoacc_update_query);
                                    check_queryerror($infoacc_update_query, $infoacc_update_result);
                                
                                _use_money($login, $gcoin_before-$gcoin_new, $gcoin_km_before - $gcoinkm_new, 0);
                                $inventory_update_query = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
                                $inventory_update_result = $db->Execute($inventory_update_query);
                                    check_queryerror($inventory_update_query, $inventory_update_result);
                                
                                $itemlock_data_query = "INSERT INTO ItemLock (acc, name, item, seri, lvl, image, info, time) VALUES ('$login', '$name', '". $item_lock_arr['item_code'] ."', '". $item_lock_arr['serial'] ."', '". $item_lock_arr['level'] ."', '". $item_lock_arr['image'] ."', '". $item_lock_arr['info'] ."', $timestamp)";
                                $itemlock_data_result = $db->Execute($itemlock_data_query);
                                    check_queryerror($itemlock_data_query, $itemlock_data_result);
                                
                                //Ghi vào Log
                            		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                                    $info_log_result = $db->Execute($info_log_query);
                                        check_queryerror($info_log_query, $info_log_result);
                                    $info_log = $info_log_result->fetchrow();
                                    
                                    $log_acc = "$login";
                                    $log_gcoin = $info_log[0];
                                    $log_gcoin_km = $info_log[1];
                                    $log_vpoint = $info_log[2];
                                    $log_price = "- $lockitem_gcoin Gcoin";
                                    $log_Des = "$name Bảo vệ Item ". $item_lock_arr['name'] .", Seri: ". $item_lock_arr['serial'];
                                    $log_time = $timestamp;
                                    
                                    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                                    $insert_log_result = $db->execute($insert_log_query);
                                        check_queryerror($insert_log_query, $insert_log_result);
                                $notice = "<info>OK</info><gcoin>$gcoin_new</gcoin><gcoinkm>$gcoinkm_new</gcoinkm>";
                            //End Ghi vào Log
                            }
                        } else $notice = $msg;
                    }
                }
            }
            
            echo $notice;
    	break;
        
    	case 'unlock':
            include('config/config_lockitem.php');
            kiemtra_doinv($login,$name);
            kiemtra_online($login);
            
            $opd = $_POST['opd'];   $opd_md5 = md5($opd);
            $timeallow = $timestamp - 24*60*60;
            $opd_query = "SELECT opd,time  FROM OnePassDay WHERE acc='$login'";
            $opd_result = $db->Execute($opd_query);
                check_queryerror($opd_query, $opd_result);
            $opd_exists = $opd_result->NumRows();
            if($opd_exists == 0) {
                $notice = "Tài khoản chưa khởi tạo Mật khẩu OPD.<br />Vui lòng tạo mật khẩu OPD.";
            } else {
                $opd_fetch = $opd_result->FetchRow();
                if($opd_fetch[1] < $timeallow) {
                    $notice = "Mật khẩu OPD đã hết thời gian hiệu lực.<br />Vui lòng lấy Mật khẩu OPD mới.";
                } else if($opd_fetch[0] != $opd_md5) {
                    $notice = "Mật khẩu OPD không chính xác.";
                } else {
                    $vitri = $_POST['vitri'];
                    
                    $serial_new = _getSerial();
                    
                    $chracter_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
                    $character_result = $db->Execute($chracter_query);
                        check_queryerror($chracter_query, $character_result);
                    $character_fetch = $character_result->FetchRow();
                    $inventory = $character_fetch[0];
                    $inventory = bin2hex($inventory);
                    $inventory = strtoupper($inventory);
                    $inventory_len = strlen($inventory);
                    
                    $inventory1 = substr($inventory,0,12*32);
                    $inventory2 = substr($inventory,12*32,64*32);
                    $inventory3 = substr($inventory,76*32);
                    $inventory_send = $inventory1 . $inventory2;
                    
                    include_once('config_license.php');
                    include_once('func_getContent.php');
                    $getcontent_url = $url_license . "/api_lockitem.php";
                    $getcontent_data = array(
                        'acclic'    =>  $acclic,
                        'key'    =>  $key,
                        'action'    =>  $action,
                        
                        'inventory_send'    =>  $inventory_send,
                        'vitri'    =>  $vitri,
                        'serial_new'    =>  $serial_new
                        
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
                            $inventory_receive = $data_arr['inventory_receive'];
                            $item_unlock_arr = $data_arr['item_unlock'];
                            if(strlen($msg) == 0 || strlen($inventory_receive) == 0 || count($item_unlock_arr) == 0) {
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
                        kiemtra_doinv($login,$name);
                        kiemtra_online($login);
                        $inventory_after = $inventory_receive . $inventory3;
                        $inventory_after_len = strlen($inventory_after);
                        
                        if($inventory_len != $inventory_after_len) {
                            $notice = "Dữ liệu item sau khi xử lý sai.";
                        } else {
                            $inventory_update_query = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
                            $inventory_update_result = $db->Execute($inventory_update_query);
                                check_queryerror($inventory_update_query, $inventory_update_result);
                            
                            $itemunlock_data_query = "INSERT INTO ItemLock (acc, name, item, seri, lvl, image, info, time, status) VALUES ('$login', '$name', '". $item_unlock_arr['item_code'] ."', '". $item_unlock_arr['serial'] ."', '". $item_unlock_arr['level'] ."', '". $item_unlock_arr['image'] ."', '". $item_unlock_arr['info'] ."', $timestamp, 0)";
                            $itemunlock_data_result = $db->Execute($itemunlock_data_query);
                                check_queryerror($itemunlock_data_query, $itemunlock_data_result);
                            
                            //Ghi vào Log
                        		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                                $info_log_result = $db->Execute($info_log_query);
                                    check_queryerror($info_log_query, $info_log_result);
                                $info_log = $info_log_result->fetchrow();
                                
                                $log_acc = "$login";
                                $log_gcoin = $info_log[0];
                                $log_gcoin_km = $info_log[1];
                                $log_vpoint = $info_log[2];
                                $log_price = "-";
                                $log_Des = "$name Hủy Bảo vệ Item ". $item_unlock_arr['name'] .", Seri: ". $item_unlock_arr['serial'];
                                $log_time = $timestamp;
                                
                                $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                                $insert_log_result = $db->execute($insert_log_query);
                                    check_queryerror($insert_log_query, $insert_log_result);
                            $notice = "<nbb>OK<nbb>". $item_unlock_arr['serial'] ."<nbb>";
                        //End Ghi vào Log
                        }
                    } else $notice = $msg;
                }
            }
            
            echo $notice;
    	break;
    }
}

?>