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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");

include('config/config_sms.php');

if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else {
		
		$getcontent_url = $server_url . "/view_giftcode_history.php";
        $getcontent_data = array(
            'login' =>  $_SESSION['mu_username'],
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        $giftcode_history_arr = array();
        if ( !empty($show) )
		{
            $show_explode = explode('<nbb>', $show);
            if($show_explode[1] == 'OK') {
                $giftcode_history_arr = unserialize_safe($show_explode[2]);
            } else {
                $err = "Lỗi : $show";
            }
		}
        // Giftcode SMS
        if(!isset($giftcode_history_arr['sms'])) $giftcode_history_arr['sms'] = array();
        foreach($giftcode_history_arr['sms'] as $key => $val) {
            if($val['exp'] == 1) {
                $giftcode_history_arr['sms'][$key]['sms_cuphap'] = "GiftCode đã hết hạn kích hoạt, vui lòng tạo GiftCode mới";
            } else {
                $giftcode_history_arr['sms'][$key]['sms_cuphap'] = "<font color='red'><b>VNU&nbsp;&nbsp;$cuphap&nbsp;&nbsp;". $giftcode_history_arr['sms'][$key]['Code'] ."</b></font>&nbsp;&nbsp;gửi&nbsp;&nbsp;<font color='blue'><b>8185</b></font>";
            }
                
            $giftcode_history_arr['sms'][$key]['time_create'] = date('H:i d/m', $giftcode_history_arr['sms'][$key]['time']);
            
            switch ($val['KeyXuLy']){ 
            	case 'GIFTCODE_RS':
                    $giftcode_history_arr['sms'][$key]['time_exp'] = date('H:i d/m', $giftcode_history_arr['sms'][$key]['time'] + 60*60);
                    $giftcode_history_arr['sms'][$key]['type_name'] = "Reset";
            	break;
            
            	case 'GIFTCODE_WEEK':
                    $giftcode_history_arr['sms'][$key]['time_exp'] = date('H:i d/m', $giftcode_history_arr['sms'][$key]['time'] + 5*60);
                    $giftcode_history_arr['sms'][$key]['type_name'] = "Tuần";
            	break;
            
            	case 'GIFTCODE_MONTH':
                    $giftcode_history_arr['sms'][$key]['time_exp'] = date('H:i d/m', $giftcode_history_arr['sms'][$key]['time'] + 5*60);
                    $giftcode_history_arr['sms'][$key]['type_name'] = "Tháng";
            	break;
            
            	default :
            }
            
        }
        
        
        // GiftCode History
        if(!isset($giftcode_history_arr['giftcode'])) $giftcode_history_arr['giftcode'] = array();
        foreach($giftcode_history_arr['giftcode'] as $key => $val) {
            switch ($val['type']){ 
            	case 1:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Reset";
            	break;
            
            	case 2:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Tuần";
            	break;
            
            	case 3:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Tháng";
            	break;
                
                case 4:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Tài Khoản";
            	break;
                
                case 5:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Phát";
            	break;
                
                case 9:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Tân Thủ";
            	break;

                case 20:
                    $giftcode_history_arr['giftcode'][$key]['type_name'] = "Giftcode Up Reset";
                    break;
            
            	default : $giftcode_history_arr['giftcode'][$key]['type_name'] = "Chưa định nghĩa";
            }
            
            $giftcode_history_arr['giftcode'][$key]['time_create'] = date('H:i d/m', $giftcode_history_arr['giftcode'][$key]['gift_time']);
            
            switch ($val['status']){ 
            	case 0:
                    $giftcode_history_arr['giftcode'][$key]['status_info'] = "Chưa kích hoạt";
            	break;
            
            	case 1:
                    $giftcode_history_arr['giftcode'][$key]['status_info'] = "<font color='blue'><b>Đã kích hoạt</b></font>";
            	break;
            
            	case 2:
                    $giftcode_history_arr['giftcode'][$key]['status_info'] = "Đã sử dụng";
            	break;
            
            	default :
            }
        }
	
	$page_template = 'templates/event/giftcode_history.tpl';
}
?>