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
 

$action = $_GET['action'];

switch ($action){ 
	case 'update':
        $getcontent_url = $server_url . "/sv_char.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            'action'    =>  'update',
            
            'pagesv'	=>	'sv_char_songtu',
            'string_login'    =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        );
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) $error_module = "Server bảo trì.";
    	elseif($reponse == "login_other") {
    		$error_module = "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
    		session_destroy();
    	}
    	else {
    		if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                $songtu_info = read_TagName($reponse, 'songtu_info', 1);
                echo "|OK|$songtu_info|";
    		} else echo $reponse;
    	}
	break;

	case 'thangcap':
        
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'action'    =>  'thangcap',
                
                'pagesv'	=>	'sv_char_songtu',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            );
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) $error_module = "Server bảo trì.";
        	elseif($reponse == "login_other") {
        		$error_module = "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
        		session_destroy();
        	}
        	else {
        		if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                    $songtu_info = read_TagName($reponse, 'songtu_info', 1);
                    $songtu_info_arr = json_decode($songtu_info, true);
                    
                    if($songtu_info_arr['tangcap'] == 0) { // Thang cap that bai
                        $songtu_info_arr['msg'] = "Thăng cấp thất bại.<br />Nhận được <strong>". $songtu_info_arr['cp_rand'] ." điểm Chúc Phúc</strong>.<br />Sử dụng 1 Trái Tim, còn lại ". $songtu_info_arr['heart'] ." Trái Tim.";
                    } else {    // Thang cap thanh cong
                        $songtu_info_arr['msg'] = "Thăng cấp thành công <strong>Song Tu</strong> lên cấp <strong>". $songtu_info_arr['songtu_lv'] ."</strong>.<br />Khi thực hiện Reset sẽ nhận được thêm <strong>". $songtu_info_arr['songtu_point_percent'] ." % Point</strong>.";
                        
                    }
                    
                    $songtu_info = json_encode($songtu_info_arr);
                    echo "|OK|$songtu_info|";
        		} else echo $reponse;
        	}
    break;
    
    case 'gift_stpoint':
        $gift_stpoint = abs(intval($_GET['gift_stpoint']));
        if($gift_stpoint <= 0) {
            echo "Điểm Song Tu muốn tặng phải lớn hơn 0";
        } else {
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'action'    =>  'gift_stpoint',
                'gift_stpoint'  =>  $gift_stpoint,
                
                'pagesv'	=>	'sv_char_songtu',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            );
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) $error_module = "Server bảo trì.";
        	elseif($reponse == "login_other") {
        		$error_module = "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
        		session_destroy();
        	}
        	else {
        		if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                    $gift_info = read_TagName($reponse, 'gift_info', 1);

                    echo "|OK|$gift_info|";
        		} else echo $reponse;
        	}
        }
    break;
}



?>