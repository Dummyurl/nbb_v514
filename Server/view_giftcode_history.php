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
include_once("function.php");

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    $login = $_POST["login"];
    
    $giftcode_history_data_arr = array();
    
    $time_get_last = _time() - 7*24*60*60;
    // Giftcode SMS
    $giftcode_sms_query = "SELECT KeyXuLy, time, Code FROM SMS WHERE acc='$login' AND (KeyXuLy='GIFTCODE_RS' OR KeyXuLy='GIFTCODE_WEEK' OR KeyXuLy='GIFTCODE_MONTH') AND time>$time_get_last ORDER BY time";
    $giftcode_sms_result = $db->Execute($giftcode_sms_query);
        check_queryerror($giftcode_sms_query, $giftcode_sms_result);
    
    while($giftcode_sms_fetch = $giftcode_sms_result->FetchRow()) {
        $exp = 0;
        switch ($giftcode_sms_fetch[0]){ 
        	case 'GIFTCODE_RS':
                if(_time() - $giftcode_sms_fetch[1] > 60*60) $exp = 1;
        	break;
        
        	case 'GIFTCODE_WEEK':
                if(_time() - $giftcode_sms_fetch[1] > 5*60) $exp = 1;
        	break;
        
        	case 'GIFTCODE_MONTH':
                if(_time() - $giftcode_sms_fetch[1] > 5*60) $exp = 1;
        	break;
        
        	default :
        }
        
        $giftcode_history_data_arr['sms'][] = array (
            'KeyXuLy' =>  $giftcode_sms_fetch[0],
            'time' =>  $giftcode_sms_fetch[1],
            'exp'  =>  $exp,
            'Code' =>  $giftcode_sms_fetch[2]
        );
    }
    
    // Giftcode History UnRecive
    $giftcode_history_un_q = "SELECT gift_code, name, type, gift_time, gift_timeuse FROM GiftCode WHERE acc='$login' AND status=1 ORDER BY gift_time DESC";
    $giftcode_history_un_r = $db->Execute($giftcode_history_un_q);
        check_queryerror($giftcode_history_un_q, $giftcode_history_un_r);
    
    while($giftcode_history_un_f = $giftcode_history_un_r->FetchRow()) {
        $giftcode_history_data_arr['giftcode'][] = array (
            'gift_code' =>  $giftcode_history_un_f[0],
            'name' =>  $giftcode_history_un_f[1],
            'type' =>  $giftcode_history_un_f[2],
            'gift_time' =>  $giftcode_history_un_f[3],
            'gift_timeuse' =>  $giftcode_history_un_f[4],
            'status' =>  1
        );
    }
    
    // Giftcode History
    $giftcode_history_query = "SELECT TOP 10 gift_code, name, type, gift_time, gift_timeuse, status FROM GiftCode WHERE acc='$login' AND status<>1 ORDER BY gift_time DESC";
    $giftcode_history_result = $db->Execute($giftcode_history_query);
        check_queryerror($giftcode_history_query, $giftcode_history_result);
    
    while($giftcode_history_fetch = $giftcode_history_result->FetchRow()) {
        $giftcode_history_data_arr['giftcode'][] = array (
            'gift_code' =>  $giftcode_history_fetch[0],
            'name' =>  $giftcode_history_fetch[1],
            'type' =>  $giftcode_history_fetch[2],
            'gift_time' =>  $giftcode_history_fetch[3],
            'gift_timeuse' =>  $giftcode_history_fetch[4],
            'status' =>  $giftcode_history_fetch[5]
        );
    }
    
    
    $giftcode_history_data = serialize($giftcode_history_data_arr);
    echo "<nbb>OK<nbb>" . $giftcode_history_data . "<nbb>";
}
$db->Close();
?>