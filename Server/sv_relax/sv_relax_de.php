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

include('config/config_relax_de.php');

$login = $_POST['login'];
$action = $_POST['action'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

$date_now = date('Y-m-d', $timestamp);
$hour_now = date('H', $timestamp);

    switch ($action) { 
    	case 'danhde':
            if($hour_now >= 18) {
                echo "Đã hết giờ ghi Đề. Không thể đánh.";
            } else {
                $de_so = abs(intval($_POST['de_so']));
                $de_diem = abs(intval($_POST['de_diem']));
                
                if($de_diem == 0) {
                    echo "Chưa chọn điểm đề muốn đánh"; exit();
                } else {
                    
                    $money_danh = $de_diem * 1000;
                    
                    $money_q = "SELECT gcoin FROM MEMB_INFO WHERE memb___id='$login'";
                    $money_r = $db->Execute($money_q);
                        check_queryerror($money_q, $money_r);
                    $money_f = $money_r->FetchRow();
                    
                    if($money_f[0] < $money_danh) {
                        echo "Bạn muốn đánh $money_danh Gcoin nhưng chỉ có ". $money_f[0] ." Gcoin, <strong>không đủ Gcoin để đánh</strong>."; exit();
                    } else {
                        $gcoin_new = $money_f[0] - $money_danh;
                        
                        // Update Money
                        $money_udate_q = "UPDATE MEMB_INFO SET gcoin=$gcoin_new WHERE memb___id='$login'";
                        $money_udate_r = $db->Execute($money_udate_q);
                            check_queryerror($money_udate_q, $money_udate_r);
                            
                        // Insert De
                        $de_insert_q = "INSERT INTO NBB_Relax_De (acc, danhso, gcoin_danh, time_danh, ngay) VALUES ('$login', $de_so, $money_danh, $timestamp, '$date_now')";
                        $de_insert_r = $db->Execute($de_insert_q);
                            check_queryerror($de_insert_q, $de_insert_r);
                        
                        //Ghi vào Log
                        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                        $info_log_result = $db->Execute($info_log_query);
                            check_queryerror($info_log_query, $info_log_result);
                        $info_log = $info_log_result->FetchRow();
                        
                        $log_acc = "$login";
                        $log_gcoin = $info_log[0];
                        $log_gcoin_km = $info_log[1];
                        $log_vpoint = $info_log[2];
                        
                        $log_price = " - $money_danh Gcoin";
                        
                        $log_Des = "Đánh đề con ". $de_so ." dùng ". $money_danh ." Gcoin";
                        $log_time = $timestamp;
                        
                        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                        $insert_log_result = $db->execute($insert_log_query);
                            check_queryerror($insert_log_query, $insert_log_result);
                        //End Ghi vào Log
                        
if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    
    $char_top_q = "SELECT TOP 1 Name FROM Character WHERE AccountID='$login' ORDER BY Relifes DESC, Resets DESC, cLevel DESC";
    $char_top_r = $db->Execute($char_top_q);
        check_queryerror($char_top_q, $char_top_r);
    $char_top_f = $char_top_r->FetchRow();
    $name = $char_top_f[0];
    if(strlen($name) > 4) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. '] '. $name .' đánh Đề con '. $de_so .' : '. $money_danh .' Gcoin';
        
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
                        echo "<info>OK</info><gconnew>$gcoin_new</gconnew>";
                    }
                }
                
                    
            }
    	break;
        
        case 'de_history':
            $day5_before = date('Y-m-d', $timestamp - 5*24*60*60);
            $de_history_q = "SELECT danhso, gcoin_danh, gcoin_win, status, time_danh FROM NBB_Relax_De WHERE acc='$login' AND ngay >= '$day5_before' ORDER BY stt DESC";
            $de_history_r = $db->Execute($de_history_q);
                check_queryerror($de_history_q, $de_history_r);
            $de_history_arr = array();
            while($de_history_f = $de_history_r->FetchRow()) {
                $de_history_arr[] = array(
                    'danhso'    =>  $de_history_f[0],
                    'gcoin_danh'    =>  $de_history_f[1],
                    'gcoin_win'    =>  $de_history_f[2],
                    'status'    =>  $de_history_f[3],
                    'time_danh'    =>  $de_history_f[4],
                );
            }
            
            $de_history = json_encode($de_history_arr);
            echo "<info>OK</info><de_history>$de_history</de_history>";
        break;
        
        default:
            
    }
}

?>