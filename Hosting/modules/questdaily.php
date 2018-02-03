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

if (isset($_SESSION['mu_nvchon'])) {
    
    include('config/config_questdaily.php');
        
    $getcontent_url = $server_url . "/sv_char.php";
    $getcontent_data = array(
        'login'    =>  $_SESSION['mu_username'],
        'name'    =>  $_SESSION['mu_nvchon'],
        
        'pagesv'	=>	'sv_char_questdaily',
        'action'    =>  'view',
        'string_login'    =>  $_SESSION['checklogin'],
        'passtransfer'    =>  $passtransfer
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    if ( empty($reponse) ) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
    elseif($reponse == "login_other") {
    	$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
    	session_destroy();
    }
    else {
    	$info = explode('<nbb>',$reponse);
    	if ($info[1] == 'OK') {
    		$quest_info = $info[2];
    		$quest_arr = json_decode($quest_info, true);
    	}
    	else $notice = $reponse;
    }
    
    
    if($quest_arr['nvchinh'] == 1) {
        $_SESSION['quest_daily'] = $quest_arr['quest_wait'];
        $nvonline = floor($quest_arr['timeonline']/60) . " giờ ". ($quest_arr['timeonline'] - floor($quest_arr['timeonline']/60)*60) . " phút";
        
        for($i=1; $i<=27; $i++) {
            switch ($i){ 
            	case 1:
                    $quest_name[$i] = "Online 1 giờ";
            	break;
            
            	case 2:
                    $quest_name[$i] = "Online 3 giờ";
            	break;
            
            	case 3:
                    $quest_name[$i] = "Online 5 giờ";
            	break;
            
            	case 4:
                    $quest_name[$i] = "Online 10 giờ";
            	break;
            
            	case 5:
                    $quest_name[$i] = "Online 15 giờ";
            	break;
            
            	case 6:
                    $quest_name[$i] = "Online 20 giờ";
            	break;
            
            	case 7:
                    $quest_name[$i] = "5 lần RS";
            	break;
            
            	case 8:
                    $quest_name[$i] = "5 lần RS VIP";
            	break;
            
            	case 9:
                    $quest_name[$i] = "10 lần RS";
            	break;
            
            	case 10:
                    $quest_name[$i] = "10 lần RS VIP";
            	break;
            
            	case 11:
                    $quest_name[$i] = "15 lần RS";
            	break;
            
            	case 12:
                    $quest_name[$i] = "15 lần RS VIP";
            	break;
            
            	case 13:
                    $quest_name[$i] = "20 lần RS";
            	break;
            
            	case 14:
                    $quest_name[$i] = "20 lần RS VIP";
            	break;
            
            	case 15:
                    $quest_name[$i] = "Tổng Nạp thẻ : 20k";
            	break;
            
            	case 16:
                    $quest_name[$i] = "Tổng Nạp thẻ : 50k";
            	break;
            
            	case 17:
                    $quest_name[$i] = "Tổng Nạp thẻ : 100k";
            	break;
            
            	case 18:
                    $quest_name[$i] = "Tổng Nạp thẻ : 200k";
            	break;
            
            	case 19:
                    $quest_name[$i] = "Tổng Nạp thẻ : 300k";
            	break;
            
            	case 20:
                    $quest_name[$i] = "Tổng Nạp thẻ : 500k";
            	break;
            
          		case 21:
                    $quest_name[$i] = "Sử dụng 1k Tiền tệ";
            	break;
            
            	case 22:
                    $quest_name[$i] = "Sử dụng 5k Tiền tệ";
            	break;
            
            	case 23:
                    $quest_name[$i] = "Sử dụng 10k Tiền tệ";
            	break;
            
            	case 24:
                    $quest_name[$i] = "Sử dụng 20k Tiền tệ";
            	break;
            
            	case 25:
                    $quest_name[$i] = "Sử dụng 50k Tiền tệ";
            	break;
            
            	case 26:
                    $quest_name[$i] = "Sử dụng 100k Tiền tệ";
            	break;
            
            	case 27:
                    $quest_name[$i] = "Sử dụng 200k Tiền tệ";
            	break;
            
            	
                default :
                    $quest_name[$i] = "Chưa định nghĩa";
            }
            
            $phanthuong[$i] = "";
            if($quest_daily_pl[$i] > 0) $phanthuong[$i] .= $quest_daily_pl[$i] ." PL";
            if($quest_daily_gcoin[$i] > 0) {
                if(strlen($phanthuong[$i]) > 0) $phanthuong[$i] .= " + ";
                $phanthuong[$i] .= $quest_daily_gcoin[$i] ." Gcoin";
            }
            if($quest_daily_gcoinkm[$i] > 0) {
                if(strlen($phanthuong[$i]) > 0) $phanthuong[$i] .= " + ";
                $phanthuong[$i] .= $quest_daily_gcoinkm[$i] ." Gcoin KM";
            }
            if($quest_daily_wcoin[$i] > 0) {
                if(strlen($phanthuong[$i]) > 0) $phanthuong[$i] .= " + ";
                $phanthuong[$i] .= $quest_daily_wcoin[$i] ." WCoin";
            }
            if($quest_daily_chao[$i] > 0) {
                if(strlen($phanthuong[$i]) > 0) $phanthuong[$i] .= " + ";
                $phanthuong[$i] .= $quest_daily_chao[$i] ." Chao";
            }
            
            if($quest_arr[$i] == 0) {
                $input[$i] = '<input type="button" class="btn_phucloi" id="btn_quest_'. $i .'" qindex="'. $i .'" value="Chưa đạt" disabled="disabled" />';
            } elseif($quest_arr[$i] == 1) {
                $input[$i] = '<input type="button" class="btn_phucloi" id="btn_quest_'. $i .'" qindex="'. $i .'" value="Nhận thưởng" />';
                $btnval[$i] = "Nhận thưởng";
            } else {
                $input[$i] = "Đã nhận";
            }
                
            
        }
    }
    
}  
    $page_template = 'templates/questdaily.tpl';
?>