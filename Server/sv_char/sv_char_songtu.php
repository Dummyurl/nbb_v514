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
 
include('config/config_songtu.php');

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
    
    switch ($action) {
	case 'update':
        $married_q = "SELECT SCFMarried, SCFMarryHusbandWife, nbbsongtu_lv, nbbsongtu_point, nbbsongtu_exp, nbbsongtu_cp, Class FROM Character WHERE Name='$name'";
        $married_r = $db->Execute($married_q);
            check_queryerror($married_q, $married_r);
        $married_f = $married_r->FetchRow();
        
        $married = $married_f[0];
        $vochong = $married_f[1];
        $songtu_lv = $married_f[2];
        $songtu_point = $married_f[3];
        $songtu_exp = $married_f[4];
        $songtu_cp = $married_f[5];
        
        $class = $married_f[6];
        if( ($class >= 32 && $class <= 35) || ($class >= 80 && $class <= 83) ) {
            $gender = "f";
            $phoingau = "Chồng";
        } else {
            $gender = "m";
            $phoingau = "Vợ";
        }
        
        if($married == 1) {
            if($songtu_point >= 10) {
                $vochong_songtu_q = "SELECT nbbsongtu_lv, nbbsongtu_point FROM Character WHERE Name='$vochong'";
                $vochong_songtu_r = $db->Execute($vochong_songtu_q);
                    check_queryerror($vochong_songtu_q, $vochong_songtu_r);
                $vochong_songtu_f = $vochong_songtu_r->FetchRow();
                $vochong_songtu_lv = $vochong_songtu_f[0];
                $vochong_songtu_point = $vochong_songtu_f[1];
                
                if($songtu_lv <= $vochong_songtu_lv) {
                    include_once('config_license.php');
                    include_once('func_getContent.php');
                    $getcontent_url = $url_license . "/api_songtu.php";
                    $getcontent_data = array(
                        'acclic'    =>  $acclic,
                        'key'    =>  $key,
                        'action'    =>  'update',
                        
                        'songtu_lv'  =>  $songtu_lv,
                        'songtu_exp'  =>  $songtu_exp,
                        'songtu_point'  =>  $songtu_point,
                        'songtu_expcoban' =>  $songtu_expcoban,
                        'songtu_expextra' =>  $songtu_expextra
                    ); 
                    
                    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                
                	if ( empty($reponse) ) {
                        echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                        exit();
                    }
                    else {
                        $info = read_TagName($reponse, 'info');
                        if ($info == "OK") {
                            $songtu_data = read_TagName($reponse, 'songtu');
                            if(strlen($songtu_data) == 0) {
                                echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                                
                                $arr_view = "\nDataSend:\n";
                                foreach($getcontent_data as $k => $v) {
                                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                                }
                                writelog("log_api.txt", $arr_view . $reponse);
                                exit();
                            } else {
                                $songtu_arr = json_decode($songtu_data, true);
                                $songtu_exp_new = $songtu_arr['songtu_exp_new'];
                                $songtu_point_new = $songtu_arr['songtu_point_new'];
                                $tangcap = $songtu_arr['tangcap'];
                            }
                        } else {
                            echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                            writelog("log_api.txt", $reponse);
                            exit();
                        }
                    }
                    
                    $songtu_update_q = "UPDATE Character SET nbbsongtu_exp = $songtu_exp_new, nbbsongtu_point = $songtu_point_new WHERE Name='$name'";
                    $songtu_update_r = $db->Execute($songtu_update_q);
                        check_queryerror($songtu_update_q, $songtu_update_r);
                    
                    $songtu_updated_arr = array(
                        'exp'   =>  $songtu_exp_new,
                        'stpoint'   =>  $songtu_point_new,
                        'tangcap'   =>  $tangcap
                    );
                    $songtu_updated = json_encode($songtu_updated_arr);
                    
                    echo "<info>OK</info><songtu_info>$songtu_updated</songtu_info>";
                } else {
                    echo "Cấp độ Song Tu của bạn lớn hơn <strong>$phoingau</strong>.<br />Không thể tiến hành Song Tu.<br />Hãy đợi <strong>$phoingau</strong> bạn thăng cấp Song Tu bằng bạn mới có thể tiếp tục Song Tu.<br /><strong>Gợi ý</strong> : Tặng <strong>$phoingau</strong> bạn Điểm Song Tu để cùng nhau Song Tu.";
                }
            } else {
                echo "Phải có ít nhất 10 điểm Song Tu mới có thể tiến hành Song Tu.";
            }
        } else {
            echo "Chưa kết hôn, không thể tiến hành Song Tu.";
        }
            
	break;

	case 'thangcap':
        $heart_q = "SELECT jewel_heart FROM MEMB_INFO WHERE memb___id='$login'";
        $heart_r = $db->Execute($heart_q);
            check_queryerror($heart_q, $heart_r);
        $heart_f = $heart_r->FetchRow();
        $heart = $heart_f[0];
        if($heart < 1) { // Heart check fail
            echo "Cần ít nhất 1 Trái Tim trong ngân hàng để tiến hành Thăng cấp Song Tu.<br />Bạn có thể nhặt Trái Tim trong quá trình Luyện hoặc mua trong WebShop.<br />Cách gửi Trái Tim vào Ngân hàng : Chức năng <strong>Nhân Vật > Gửi Jewel vào Ngân Hàng</strong>";
        } else {    // Heart check ok
            $songtu_q = "SELECT nbbsongtu_lv, nbbsongtu_cp, nbbsongtu_exp FROM Character WHERE Name='$name'";
            $songtu_r = $db->Execute($songtu_q);
                check_queryerror($songtu_q, $songtu_r);
            $songtu_f = $songtu_r->FetchRow();
            $songtu_lv = $songtu_f[0];
            $songtu_cp = $songtu_f[1];
            $songtu_exp = $songtu_f[2];
            
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_songtu.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'thangcap',
                
                'songtu_lv'  =>  $songtu_f[0],
                'songtu_cp' =>  $songtu_f[1],
                'songtu_expcoban' =>  $songtu_expcoban,
                'songtu_expextra' =>  $songtu_expextra,
                'songtu_cpcoban' =>  $songtu_cpcoban,
                'songtu_cpextra' =>  $songtu_cpextra
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if ($info == "OK") {
                    $songtu_data = read_TagName($reponse, 'songtu');
                    if(strlen($songtu_data) == 0) {
                        echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                        
                        $arr_view = "\nDataSend:\n";
                        foreach($getcontent_data as $k => $v) {
                            $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                        }
                        writelog("log_api.txt", $arr_view . $reponse);
                        exit();
                    } else {
                        $songtu_arr = json_decode($songtu_data, true);
                        $exp_songtu_sum = $songtu_arr['exp_songtu_sum'];
                        $cp_percent = $songtu_arr['cp_percent'];
                        $cp_new = $songtu_arr['cp_new'];
                        $cp_rand = $songtu_arr['cp_rand'];
                        $exp_songtu_next = $songtu_arr['exp_songtu_next'];
                    }
                } else {
                    echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                    writelog("log_api.txt", $reponse);
                    exit();
                }
            }
            
            if($songtu_exp < $exp_songtu_sum) {
                echo "Chưa đủ độ Thân Mật để thăng cấp Song Tu";
            } else {
                $heart_new = $heart - 1;
                $heart_update_q = "UPDATE MEMB_INFO SET jewel_heart = $heart_new WHERE memb___id='$login'";
                $heart_update_r = $db->Execute($heart_update_q);
                    check_queryerror($heart_update_q, $heart_update_r);
                
                if($cp_percent < 100) { // Thang cap that bai
                    $thangcap_update_q = "UPDATE Character SET nbbsongtu_cp = $cp_new WHERE Name='$name' AND AccountID='$login'";
                    $thangcap_update_r = $db->Execute($thangcap_update_q);
                        check_queryerror($thangcap_update_q, $thangcap_update_r);
                        
                    $tangcap = 0;
                    $thangcap_updated_arr = array(
                        'cp_rand'  =>  $cp_rand,
                        'cp_percent'   =>  $cp_percent,
                        'heart'  =>  $heart_new,
                        'tangcap'   =>  $tangcap
                    );
                    
                    $songtu_lv_new = $songtu_lv + 1;
                    $log_Des = "Nhân vật <strong>$name</strong> thăng cấp <strong>Song Tu</strong> từ cấp <strong>$songtu_lv</strong> lên ". $songtu_lv_new ." thất bại. Chúc phúc đạt <strong>$cp_percent %</strong>.";
                } else { // Thang cap thanh cong
                    $songtu_lv_new = $songtu_lv+1;
                    
                    $thangcap_update_q = "UPDATE Character SET nbbsongtu_lv = $songtu_lv_new, nbbsongtu_cp = 0 WHERE Name='$name' AND AccountID='$login'";
                    $thangcap_update_r = $db->Execute($thangcap_update_q);
                        check_queryerror($thangcap_update_q, $thangcap_update_r);
                        
                    $songtu_point_percent = $songtu_pointpercent + $songtu_lv_new * $songtu_pointpercent;
                    
                    $tangcap = 1;
                    
                    $thangcap_updated_arr = array(
                        'songtu_lv'   =>  $songtu_lv_new,
                        'songtu_exp_next'   =>  $exp_songtu_next,
                        'songtu_point_percent'  =>  $songtu_point_percent,
                        'tangcap'   =>  $tangcap
                    );
                    
                    $log_Des = "Nhân vật <strong>$name</strong> thăng cấp <strong>Song Tu</strong> từ cấp <strong>$songtu_lv</strong> lên cấp <strong>". $songtu_lv_new ."</strong> thành công.";
                    
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
                        $mess_send = '['. $thehe_name. '] '. $name .' đã thăng cấp Song Tu lên '. $songtu_lv_new;
                        
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
                
                $thangcap_updated = json_encode($thangcap_updated_arr);
                
                echo "<info>OK</info><songtu_info>$thangcap_updated</songtu_info>";
                
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
        }
	break;
    
    case 'gift_stpoint':
        $gift_stpoint = abs(intval($_POST['gift_stpoint']));
        
        if($gift_stpoint <= 0) {
            echo "Điểm Song Tu muốn tặng phải lớn hơn 0";
        } else {
            $songtu_q = "SELECT SCFMarried, SCFMarryHusbandWife, nbbsongtu_lv, nbbsongtu_point FROM Character WHERE Name='$name'";
            $songtu_r = $db->Execute($songtu_q);
                check_queryerror($songtu_q, $songtu_r);
            $songtu_f = $songtu_r->FetchRow();
            $songtu_married = $songtu_f[0];
            $songtu_vochong = $songtu_f[1];
            $songtu_lv = $songtu_f[2];
            $songtu_point = $songtu_f[3];
            
            if($songtu_married != 1) {
                echo "Bạn chưa kết hôn, không thể tặng Điểm Song Tu.";
            } else {
                $vochong_songtu_q = "SELECT nbbsongtu_lv, nbbsongtu_point FROM Character WHERE Name='$vochong'";
                $vochong_songtu_r = $db->Execute($vochong_songtu_q);
                    check_queryerror($vochong_songtu_q, $vochong_songtu_r);
                $vochong_songtu_f = $vochong_songtu_r->FetchRow();
                $vochong_songtu_lv = $vochong_songtu_f[0];
                $vochong_songtu_point = $vochong_songtu_f[1];
                
                if($songtu_lv < $vochong_songtu_lv) {
                    echo "Cấp độ Song Tu của bạn nhỏ hơn Bạn Đời. Không thể tặng Điểm Song Tu.";
                } else {
                    $songtu_point_new = $songtu_point - $gift_stpoint;
                    $vochong_songtu_point_new = $vochong_songtu_point + $gift_stpoint;
                    
                    if($songtu_point_new < 0) {
                        echo "$gift_stpoint Điểm Song Tu muốn tặng lớn hơn điểm Song Tu hiện có $songtu_point. Vui lòng chọn nhiều nhất $songtu_point Điểm Song Tu.";
                    } else {
                        $heart_q = "SELECT jewel_heart FROM MEMB_INFO WHERE memb___id='$login'";
                        $heart_r = $db->Execute($heart_q);
                            check_queryerror($heart_q, $heart_r);
                        $heart_f = $heart_r->FetchRow();
                        $heart = $heart_f[0];
                        if($heart < 1) { // Heart check fail
                            echo "Cần ít nhất 1 Trái Tim trong ngân hàng để tiến hành tặng Điểm Song Tu.<br />Bạn có thể nhặt Trái Tim trong quá trình Luyện hoặc mua trong WebShop.<br />Cách gửi Trái Tim vào Ngân hàng : Chức năng <strong>Nhân Vật > Gửi Jewel vào Ngân Hàng</strong>";
                        } else {
                            $heart_new = $heart - 1;
                            $heart_update_q = "UPDATE MEMB_INFO SET jewel_heart = $heart_new WHERE memb___id='$login'";
                            $heart_update_r = $db->Execute($heart_update_q);
                                check_queryerror($heart_update_q, $heart_update_r);
                                
                            $stpoint_update_q = "UPDATE Character SET nbbsongtu_point = $songtu_point_new WHERE Name='$name'";
                            $stpoint_update_r = $db->Execute($stpoint_update_q);
                                check_queryerror($stpoint_update_q, $stpoint_update_r);
                                
                            $vochong_stpoint_update_q = "UPDATE Character SET nbbsongtu_point = $vochong_songtu_point_new WHERE Name='$songtu_vochong'";
                            $vochong_stpoint_update_r = $db->Execute($vochong_stpoint_update_q);
                                check_queryerror($vochong_stpoint_update_q, $vochong_stpoint_update_r);
                            
                            $gift_arr = array(
                                'songtu_point'  =>  $songtu_point_new,
                                'heart' =>  $heart_new
                            );
                            
                            $gift_info = json_encode($gift_arr);
                            echo "<info>OK</info><gift_info>$gift_info</gift_info>";
                            
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
                            
                            $log_Des = "<strong>$name</strong> tặng <strong>$gift_stpoint Điểm Song Tu</strong> cho <strong>$songtu_vochong</strong>";
                            
                            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                            $insert_log_result = $db->execute($insert_log_query);
                                check_queryerror($insert_log_query, $insert_log_result);
                        //End Ghi vào Log
                        }
                    }
                }
            }
        }
            
        
    break;
    
    default :
        $married_q = "SELECT SCFMarried, SCFMarryHusbandWife, nbbsongtu_lv, nbbsongtu_point, nbbsongtu_exp, nbbsongtu_cp FROM Character WHERE Name='$name'";
        $married_r = $db->Execute($married_q);
            check_queryerror($married_q, $married_r);
        $married_f = $married_r->FetchRow();
        
        $married = $married_f[0];
        $vochong = $married_f[1];
        $songtu_lv = $married_f[2];
        $songtu_point = $married_f[3];
        $songtu_exp = $married_f[4];
        $songtu_cp = $married_f[5];
        
        $songtu_arr = array(
            'married'   =>  $married,
            'vochong'   =>  $vochong,
            'songtu_lv' =>  $songtu_lv,
            'songtu_point'  =>  $songtu_point,
            'songtu_exp'    =>  $songtu_exp,
            'songtu_cp' =>  $songtu_cp
        );
        
        if($married == 1) {
            $vochong_songtu_q = "SELECT nbbsongtu_lv, nbbsongtu_point FROM Character WHERE Name='$vochong'";
            $vochong_songtu_r = $db->Execute($vochong_songtu_q);
                check_queryerror($vochong_songtu_q, $vochong_songtu_r);
            $vochong_songtu_f = $vochong_songtu_r->FetchRow();
            $vochong_songtu_lv = $vochong_songtu_f[0];
            $vochong_songtu_point = $vochong_songtu_f[1];
            
            $songtu_arr['vochong_lv'] = $vochong_songtu_lv;
            $songtu_arr['vochong_point'] = $vochong_songtu_point;
        }
        
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_songtu.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            'action'    =>  'songtu_list',
            
            'songtu_info'    =>  json_encode($songtu_arr),
            'songtu_cpcoban'  =>  $songtu_cpcoban,
            'songtu_cpextra'  =>  $songtu_cpextra
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            echo "Server bảo trì vui lòng liên hệ Admin để FIX";
            exit();
        }
        else {
            $info = read_TagName($reponse, 'info');
            if ($info == "OK") {
                $songtu_data = read_TagName($reponse, 'tuluyen');
                if(strlen($songtu_data) == 0) {
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
        
        echo "<nbb>OK<nbb>$songtu_data<nbb>";
    }

	
	

}

?>