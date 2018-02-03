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
include_once('config/config_cuonghoa.php');

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
    	case 'item_list':
            $chp_q = "SELECT nbbcuonghoa_point FROM Character WHERE AccountID='$login' AND name='$name'";
            $chp_r = $db->Execute($chp_q);
                check_queryerror($chp_q, $chp_r);
            $chp_f = $chp_r->FetchRow();
            $cuonghoa_point = $chp_f[0];
            
            $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
            $warehouse_result = $db->Execute($warehouse_query);
                check_queryerror($warehouse_query, $warehouse_result);
            $warehouse_fetch = $warehouse_result->FetchRow();
            $warehouse = $warehouse_fetch[0];
            $warehouse = bin2hex($warehouse);
            $warehouse = strtoupper($warehouse);
            
            $warehouse1 = substr($warehouse,0,120*32);
            $warehouse2 = substr($warehouse,120*32);
            
            $cp_q = "SELECT item_serial, cp, item_lvl FROM nbb_cuonghoa WHERE acc='$login' AND name='$name'";
            $cp_r = $db->Execute($cp_q);
                check_queryerror($cp_q, $cp_r);
            $dangcuonghoa_arr = array();
            while($cp_f = $cp_r->FetchRow()) {
                $item_seri = $cp_f[0];
                $dangcuonghoa_arr[$item_seri] = array(
                    'cp'    =>  $cp_f[1],
                    'item_lvl'  =>  $cp_f[2]
                );
            }
            
                    
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_cuonghoa.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'item_list',
                
                'warehouse1'    =>  $warehouse1,
                'dangcuonghoa'  =>  json_encode($dangcuonghoa_arr),
                'cuonghoa_cpcoban'  =>  $cuonghoa_cpcoban,
                'cuonghoa_cpextra'  =>  $cuonghoa_cpextra
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
            
            echo "<nbb>OK<nbb>$cuonghoa_point<nbb>$listitem<nbb>";
    	break;
        
        case 'ch_up':
            kiemtra_online($login);
            
            $vitri = abs(intval($_POST['vitri']));
            $serial = $_POST['serial'];
            $item_lvl = abs(intval($_POST['item_lvl']));
            
            $chao_q = "SELECT jewel_chao FROM MEMB_INFO WHERE memb___id='$login'";
            $chao_r = $db->Execute($chao_q);
                check_queryerror($chao_q, $chao_r);
            $chao_f = $chao_r->FetchRow();
            $jewel_chao = $chao_f[0];
            
            $chp_q = "SELECT nbbcuonghoa_point FROM Character WHERE AccountID='$login' AND name='$name'";
            $chp_r = $db->Execute($chp_q);
                check_queryerror($chp_q, $chp_r);
            $chp_f = $chp_r->FetchRow();
            $cuonghoa_point = $chp_f[0];
            
            if($cuonghoa_point < 100) {
                echo "Không đủ Điểm Cường Hóa để tiến hành Cường Hóa.";
            } else if($jewel_chao < 1) {
                echo "Không đủ Chao trong Ngân hàng để tiến hành Cường Hóa.";
            } else {
                $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
                $warehouse_result = $db->Execute($warehouse_query);
                    check_queryerror($warehouse_query, $warehouse_result);
                $warehouse_fetch = $warehouse_result->FetchRow();
                $warehouse = $warehouse_fetch[0];
                $warehouse = bin2hex($warehouse);
                $warehouse = strtoupper($warehouse);
                
                $warehouse1 = substr($warehouse,0,120*32);
                $warehouse2 = substr($warehouse,120*32);
                
                $cp = 0;
                $cp_q = "SELECT cp FROM nbb_cuonghoa WHERE acc='$login' AND name='$name' AND item_serial='$serial' AND item_lvl=$item_lvl";
                $cp_r = $db->Execute($cp_q);
                    check_queryerror($cp_q, $cp_r);
                $cp_f = $cp_r->FetchRow();
                if(isset($cp_f[0]) && intval($cp_f[0]) > 0) {
                    $cp = $cp_f[0];
                }
                
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_cuonghoa.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key,
                    'action'    =>  'ch_up',
                    
                    'vitri'    =>  $vitri,
                    'serial'   =>  $serial,
                    'item_lvl' =>  $item_lvl,
                    'cp'   =>  $cp,
                    'warehouse1'    =>  $warehouse1,
                    'cuonghoa_cpcoban'  =>  $cuonghoa_cpcoban,
                    'cuonghoa_cpextra'  =>  $cuonghoa_cpextra
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
                        $chup = read_TagName($reponse, 'chup');
                        if(strlen($chup) == 0) {
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
                
                $jewel_chao_new = $jewel_chao - 1;
                $cuonghoa_point_new = $cuonghoa_point - 100;
                $chao_update_q = "UPDATE MEMB_INFO SET jewel_chao = $jewel_chao_new WHERE memb___id='$login'";
                $chao_update_r = $db->Execute($chao_update_q);
                    check_queryerror($chao_update_q, $chao_update_r);
                
                $chp_update_q = "UPDATE Character SET nbbcuonghoa_point = $cuonghoa_point_new WHERE AccountID='$login' AND Name='$name'";
                $chp_update_r = $db->execute($chp_update_q);
                    check_queryerror($chp_update_q, $chp_update_r);
                
                $ch_info_arr = array(
                    'chao_new' =>  $jewel_chao_new,
                    'cuonghoa_point_new'    =>  $cuonghoa_point_new
                );
                
                $chup_arr = json_decode($chup, true);
                $ch_info_arr['cp_percent'] = $chup_arr['cp_percent'];
                $ch_info_arr['uplv'] = $chup_arr['uplv'];
                
                if($chup_arr['uplv'] == 0) { // UP xịt
                    $datetime = date('Y-m-d H:i:s', $timestamp);
                    if($cp > 0) {
                        $cp_update_q = "UPDATE nbb_cuonghoa SET cp=". $chup_arr['cp_new'] .", time_update='". $datetime ."' WHERE acc='$login' AND name='$name' AND item_serial='$serial' AND item_lvl=$item_lvl";
                    } else {
                        $cp_update_q = "INSERT INTO nbb_cuonghoa (acc, name, item_serial, item_lvl, cp, time_begin) VALUES ('$login', '$name', '$serial', $item_lvl, ". $chup_arr['cp_new'] .", '". $datetime ."')";
                    }
                        $cp_update_r = $db->Execute($cp_update_q);
                            check_queryerror($cp_update_q, $cp_update_r);
                    
                    $ch_info_arr['cp_rand'] = $chup_arr['cp_rand'];
                    $ch_info_arr['cp_new'] = $chup_arr['cp_new'];
                    $ch_info_arr['msg'] = "Cường Hóa Item không thành công.<br />Nhận được ". $ch_info_arr['cp_rand'] ." điểm Chúc Phúc Cường Hóa.<br />Khi Chúc Phúc Cường Hóa đạt 100%, cường hóa Item thành công.<br />Chi phí cường hóa : 1 Chao + 100 Điểm Cường Hóa.<br />Còn lại : $jewel_chao_new Chao, $cuonghoa_point_new Điểm Cường Hóa.";
                    
                    $item_lvl_new = $item_lvl + 1;
                    $log_Des = "Nhân vật <strong>$name</strong> cường hóa <strong>". $ch_info_arr['item_name'] ."</strong> từ +<strong>$item_lvl</strong> lên +<strong>". $item_lvl_new ."</strong> thất bại. Chúc phúc đạt <strong>". $ch_info_arr['cp_percent'] ." %</strong>.";
                } else {    // UP thanh cong
                    kiemtra_online($login);
                    
                    $cp_del_q = "DELETE nbb_cuonghoa WHERE acc='$login' AND name='$name' AND item_serial='$serial'";
                    $cp_del_r = $db->Execute($cp_del_q);
                        check_queryerror($cp_del_q, $cp_del_r);
                    
                    $warehouse1_update = $chup_arr['warehouse1_update'];
                     // Update WareHouse
                    $warehouse_new = $warehouse1_update . $warehouse2;
                    $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                    $warehouse_update_result = $db->Execute($warehouse_update_query);
                        check_queryerror($warehouse_update_query, $warehouse_update_result);
                    
                    $ch_info_arr['itemlvl_new'] = $chup_arr['itemlvl_new'];
                    $ch_info_arr['msg'] = "Cường Hóa Item thành công.<br />Cấp độ Item tăng từ +$item_lvl lên +". $chup_arr['itemlvl_new'] .".<br />Chi phí cường hóa : 1 Chao + 100 Điểm Cường Hóa.<br />Còn lại : $jewel_chao_new Chao, $cuonghoa_point_new Điểm Cường Hóa.";
                    
                    $log_Des = "Nhân vật <strong>$name</strong> cường hóa <strong>". $ch_info_arr['item_name'] ."</strong> từ +<strong>$item_lvl</strong> lên <strong>". $ch_info_arr['itemlvl_new'] ."</strong> thành công.";
                    
                    // Send Mess to Game
                    if(file_exists('config/config_sendmess.php')) {
                        include_once('config/config_sendmess.php');
    
                        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
                        $thehe_result = $db->Execute($thehe_query);
                            check_queryerror($thehe_query, $thehe_result);
                        $thehe_fetch = $thehe_result->fetchrow();
                        $thehe = $thehe_fetch[0];
                        
                        include('config/config_thehe.php');
                        $thehe_name = $thehe_choise[$thehe];
                        $mess_send = '['. $thehe_name. '] '. $name .' đã Cường Hóa ['. $chup_arr['item_name'] .'] lên +'. $chup_arr['itemlvl_new'];
                        
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
                    // Send Mess to Game End
                }
                
                $ch_info = json_encode($ch_info_arr);
                echo "<info>OK</info><ch_info>$ch_info</ch_info>";
                
                //Ghi vào Log
                    $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                    $info_log_result = $db->Execute($info_log_query);
                        check_queryerror($info_log_query, $info_log_result);
                    $info_log = $info_log_result->FetchRow();
                    
                    $log_acc = "$login";
                    $log_gcoin = $info_log[0];
                    $log_gcoin_km = $info_log[1];
                    $log_vpoint = $info_log[2];
                    $log_price = "";
                    $log_time = $timestamp;
                    
                    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                    $insert_log_result = $db->execute($insert_log_query);
                        check_queryerror($insert_log_query, $insert_log_result);
                //End Ghi vào Log
            }
        break;
    }
}

?>