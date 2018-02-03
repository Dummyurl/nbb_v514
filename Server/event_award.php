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
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

    switch ($action){ 
    	case 'award_list':
            $award_list_arr = array();
            
            $award_unreceive_query = "SELECT award_id, award_info, item_slg, item_info, item_image, hsd_time FROM NBB_Award WHERE acc='$login' AND name='$name' AND status=0 ORDER BY award_id DESC";
            $award_unreceive_result = $db->Execute($award_unreceive_query);
                check_queryerror($award_unreceive_query, $award_unreceive_result);
            while($award_unreceive_fetch = $award_unreceive_result->FetchRow()) {
                $hsd = "";
                if(strlen($award_unreceive_fetch[5]) > 0 && $award_unreceive_fetch[5] > 0) $hsd = "Hạn sử dụng: 24h00 ". date('d/m/Y', $award_unreceive_fetch[5] - 24*60*60);
                $award_list_arr[] = array(
                    'award_id'  =>  $award_unreceive_fetch[0],
                    'award_info'  =>  $award_unreceive_fetch[1] . " $hsd",
                    'item_slg'  =>  $award_unreceive_fetch[2],
                    'item_info'  =>  $award_unreceive_fetch[3],
                    'item_image'  =>  $award_unreceive_fetch[4],
                    'status'    =>  0,
                    'receive_time'  =>  ''
                );
            }
            
            $time_receive_allow = $timestamp - 30*24*60*60;
            $award_receive_query = "SELECT award_id, award_info, item_slg, item_info, item_image, receive_time, hsd_time FROM NBB_Award WHERE acc='$login' AND name='$name' AND status=1 AND receive_time>$time_receive_allow ORDER BY receive_time DESC";
            $award_receive_result = $db->Execute($award_receive_query);
                check_queryerror($award_receive_query, $award_receive_result);
            while($award_receive_fetch = $award_receive_result->FetchRow()) {
                $hsd = "";
                if(strlen($award_unreceive_fetch[6]) > 0 && $award_unreceive_fetch[6] > 0) $hsd = "Hạn sử dụng: 24h00 ". date('d/m/Y', $award_unreceive_fetch[6] - 24*60*60);
                $award_list_arr[] = array(
                    'award_id'  =>  $award_receive_fetch[0],
                    'award_info'  =>  $award_receive_fetch[1] . " $hsd",
                    'item_slg'  =>  $award_receive_fetch[2],
                    'item_info'  =>  $award_receive_fetch[3],
                    'item_image'  =>  $award_receive_fetch[4],
                    'status'    =>  1,
                    'receive_time'  =>  date('H:i:s d/m', $award_receive_fetch[5])
                );
            }
            
            $award_list = serialize($award_list_arr);
            
            echo "<nbb>OK<nbb>$award_list<nbb>";
    	break;
        
        case 'award_receive':
            $award_id = $_POST['award_id'];     $award_id = abs(intval($award_id));
            
            $award_info_query = "SELECT item_code, status, item_slg, seri_block FROM NBB_Award WHERE acc='$login' AND name='$name' AND award_id=$award_id";
            $award_info_result = $db->Execute($award_info_query);
                check_queryerror($award_info_query, $award_info_result);
            $award_check = $award_info_result->NumRows();
            if($award_check == 0) {
                $notice = "Giải thưởng không tồn tại.";
            } else {
                $award_info_fetch = $award_info_result->FetchRow();
                if($award_info_fetch[1] == 1) {
                    $notice = "Giải thưởng đã nhận, vui lòng không nhận lại";
                } else {
                    kiemtra_online($login);
                    
                    $item_code = $award_info_fetch[0];
                    $item_slg = $award_info_fetch[2];
                    $seri_block = $award_info_fetch[3];
                    
                    $warehouse_query = "SELECT Items FROM warehouse WHERE AccountID='$login'";
                    $warehouse_result = $db->Execute($warehouse_query);
                        check_queryerror($warehouse_query, $warehouse_result);
                    $warehouse_fetch = $warehouse_result->FetchRow();
                    $warehouse = $warehouse_fetch[0];
                    $warehouse = bin2hex($warehouse);
                    $warehouse = strtoupper($warehouse);
                    $warehouse1 = substr($warehouse,0,120*32);
                    $warehouse2 = substr($warehouse,120*32);
                    
                    $seri = array();
                    if($seri_block == 0) {   
                        for($i=1; $i<=$item_slg; $i++) {
                            $seri[] = _getSerial();
                        }
                    }
                        
                    
                    $data_send_arr = array(
                        'item_code' =>  $item_code,
                        'item_slg'  =>  $item_slg,
                        'seri_block'    =>  $seri_block,
                        'seri'  =>  $seri,
                        'warehouse1'    =>  $warehouse1
                    );
                    $data_send = serialize($data_send_arr);
                    
                    include_once('config_license.php');
                    include_once('func_getContent.php');
                    $getcontent_url = $url_license . "/api_event_award.php";
                    $getcontent_data = array(
                        'acclic'    =>  $acclic,
                        'key'    =>  $key,
                        'action'    =>  'award_receive',
                        
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
                            if( strlen($warehouse1_receive) == 0 ) {
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
                                    
                                $award_update_query = "UPDATE NBB_Award SET status=1, receive_time=$timestamp WHERE acc='$login' AND name='$name' AND award_id=$award_id";
                                $award_update_result = $db->Execute($award_update_query);
                                    check_queryerror($award_update_query, $award_update_result);
                                $notice  = "<info>OK</info>";
                            }
                        } else {
                            $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                            writelog("log_api.txt", $reponse);
                        }
                    }
                }
            }
            
            echo $notice;
        break;
        
    }
}
$db->Close();
?>