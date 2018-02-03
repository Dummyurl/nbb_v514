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
 

/**
 * @author NetBanBe
 * @copyright 20/9/2011
 * @WebSite http://netbanbe.net
 */

    include_once('config_autonap.php');
    
    $sign = md5($teknet_cpid . ";" . $pin . ";" . $seri . ";" . $operator_id . ";" . $teknet_key);
    
    $form_data = "cpid=$teknet_cpid&card_pin=$pin&card_seri=$seri&operator_id=$operator_id&sign=$sign";
    
    // Log Send
    $url_data_send = $getcontent_url_sendcard . "?" . $form_data;
    _writelog($file_log, " + " . $url_data_send);
    // End Log Send
    
    $content = @file_get_contents(urldecode($url_data_send));
    
    if(isset($content)) {
        $info = _read_TagName($content, 'info');
        if($info == "OK") {
            $card_exits = _read_TagName($content, 'card_exits');
            $card_status = _read_TagName($content, 'card_status');
            $edit_menhgia = _read_TagName($content, 'menhgia');
            $notice = _read_TagName($content, 'notice');
            
            if($card_exits == 1) {
                $card_sai_query = "Update CardPhone set timeduyet=$timestamp, status=3 Where stt=$stt";
                $card_sai_result =$db->Execute($card_sai_query);
                
                $notice_nap = "Thẻ đã tồn tại trên hệ thống. Vui lòng không nạp lại.";
                $logcontent = "$pin - $seri | Thẻ đã tồn tại trên hệ thống.";
                _writelog($file_log, $logcontent);
            } else {
                switch ($card_status){ 
                	// The dang cho
                    case 1:
                        $notice_nap = "Thẻ đã nạp lên hệ thống. Đang trong trạng thái chờ phải hồi từ nhà mạng";
                        $logcontent = "$notice_nap :  $pin - $seri | Đang chờ";
                        _writelog($file_log, $logcontent);
                	break;
                    
                    // The dung
                	case 2:
                        $notice_nap = "Thẻ đúng. Mệnh giá thẻ : $edit_menhgia VNĐ";
                        $logcontent = "$notice_nap :  $pin - $seri | Thẻ đúng";
                        _writelog($file_log, $logcontent);
                        include_once('teknet_duyetthe.php');
                	break;
                
                	case 3:
                        $card_sai_query = "Update CardPhone set timeduyet=$timestamp, status=3 Where stt=$stt";
                        $card_sai_result =$db->Execute($card_sai_query);
                        $notice_nap = "Thẻ Sai. $notice.";
                        $logcontent = "$notice :  $pin - $seri | Thẻ sai : $card_sai_query";
                        _writelog($file_log, $logcontent);
                	break;
                }
            }
        } else {
            $notice_nap = "Thẻ đã nạp lên hệ thống. Đang trong trạng thái chờ phải hồi từ nhà mạng";
            $logcontent = "$content :  $pin - $seri | Chưa xử lý";
            _writelog($file_log, $logcontent);
        }
    } else {
        $notice_nap = "Thẻ đã nạp lên hệ thống. Đang trong trạng thái chờ phải hồi từ nhà mạng";
        $logcontent = "$content :  $pin - $seri | Chưa nhận được phản hồi";
        _writelog($file_log, $logcontent);
    }
    
    // Update Time Last Get
    $update_lastgetcard_query = "UPDATE CardPhone SET teknet_check_last='$timestamp', teknet_check_wait=teknet_check_wait+1 WHERE stt=$stt";
    $update_lastgetcard_result = $db->Execute($update_lastgetcard_query) OR DIE("Query Error : $update_lastgetcard_query");

?>