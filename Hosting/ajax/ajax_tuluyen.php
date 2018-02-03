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
        $tltype = $_GET['tltype'];
        
        if(in_array($tltype, array('str', 'agi', 'vit', 'ene'))) {
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'action'    =>  'update',
                'tltype'    =>  $tltype,
                
                'pagesv'	=>	'sv_char_tuluyen',
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
                    $tuluyen_info = read_TagName($reponse, 'tuluyen_info', 1);
                    echo "|OK|$tuluyen_info|";
        		} else echo $reponse;
        	}
        } else {
            echo "Dữ liệu tu luyện không đúng.";
        }
	break;

	case 'thangcap':
        $tltype = $_GET['tltype'];
        
        if(in_array($tltype, array('str', 'agi', 'vit', 'ene'))) {
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'action'    =>  'thangcap',
                'tltype'    =>  $tltype,
                
                'pagesv'	=>	'sv_char_tuluyen',
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
                    $tuluyen_info = read_TagName($reponse, 'tuluyen_info', 1);
                    $tuluyen_info_arr = json_decode($tuluyen_info, true);
                    
                    if($tuluyen_info_arr['tangcap'] == 0) { // Thang cap that bai
                        $tuluyen_info_arr['msg'] = "Thăng cấp thất bại.<br />Nhận được <strong>". $tuluyen_info_arr['tlcp_rand'] ." điểm Chúc Phúc</strong>.<br />Sử dụng 1 Chao, còn lại ". $tuluyen_info_arr['chao'] ." Chao.";
                    } else {    // Thang cap thanh cong
                        switch ($tltype){ 
                        	case 'str':
                                $type_name = "Sức mạnh";
                        	break;
                        
                        	case 'agi':
                                $type_name = "Nhanh nhẹn";
                        	break;
                        
                        	case 'vit':
                                $type_name = "Thể lực";
                        	break;
                        
                        	case 'ene':
                                $type_name = "Năng lượng";
                        	break;
                        
                        	default :
                                echo "Dữ liệu tu luyện sai."; exit();
                        }
                        $tuluyen_info_arr['msg'] = "Thăng cấp thành công <strong>$type_name</strong> lên cấp <strong>". $tuluyen_info_arr['tl_cap'] ."</strong>.<br />Khi thực hiện Reset sẽ nhận được thêm <strong>". $tuluyen_info_arr['tl_point'] ." Point $type_name</strong>.";
                        
                    }
                    
                    $tuluyen_info = json_encode($tuluyen_info_arr);
                    echo "|OK|$tuluyen_info|";
        		} else echo $reponse;
        	}
        } else {
            echo "Dữ liệu tu luyện không đúng.";
        }
    break;
}



?>