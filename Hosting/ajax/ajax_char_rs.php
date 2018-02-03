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
	case 'reset':
        $getcontent_url = $server_url . "/sv_char.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            'resetnow'    =>  $_SESSION['nv_reset'],
            
            'pagesv'	=>	'sv_char_reset',
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
			if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
				$notice = "<nbb>OK<nbb>" . read_TagName($reponse, 'messenge', 1) . "<nbb>";
				
                $_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
				$_SESSION['nv_level'] = 1;
				$_SESSION['nv_zen'] = read_TagName($reponse, 'resetmoeny', 1);
				$_SESSION['nv_point'] = read_TagName($reponse, 'resetpoint', 1);
				$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'pointdutru', 1);
				$_SESSION['nv_resetday'] = $_SESSION['nv_resetday']+1;
				$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
			}
			else $notice = $reponse;
		}
        
        echo $notice;
	break;
    
    case 'reset_over':
        $getcontent_url = $server_url . "/sv_char.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            'resetnow'    =>  $_SESSION['nv_reset'],
            
            'pagesv'	=>	'sv_char_reset_over',
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
			if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
				$notice = "<nbb>OK<nbb>" . read_TagName($reponse, 'messenge', 1) . "<nbb>";
				
                $_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
					$_SESSION['nv_level'] = 1;
					$_SESSION['nv_zen'] = read_TagName($reponse, 'resetmoeny', 1);
					$_SESSION['nv_point'] = read_TagName($reponse, 'resetpoint', 1);
					$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'pointdutru', 1);
					$_SESSION['nv_resetday'] = $_SESSION['nv_resetday']+1;
					$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
			}
			else $notice = $reponse;
		}
        
        echo $notice;
	break;

	case 'reset_vip':
        $tiente = $_GET['tiente'];
        
        if ($tiente == 'gcoin' || $tiente == 'vpoint') {
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'tiente'    =>  $tiente,
                'resetnow'    =>  $_SESSION['nv_reset'],
                
                'pagesv'	=>	'sv_char_reset_vip',
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
    			if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
    				$notice = "<nbb>OK<nbb>" . read_TagName($reponse, 'messenge', 1) . "<nbb>";
    				
                    $_SESSION['acc_gcoin'] = read_TagName($reponse, 'gcoin', 1);
    				$_SESSION['acc_gcoin_km'] = read_TagName($reponse, 'gcoin_km', 1);
    				$_SESSION['acc_vpoint'] = read_TagName($reponse, 'vpoint', 1);
    				
    				$_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
    				$_SESSION['nv_level'] = 1;
    				$_SESSION['nv_point'] = read_TagName($reponse, 'resetpoint', 1);
    				$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'pointdutru', 1);
    				$_SESSION['nv_resetday'] = $_SESSION['nv_resetday']+1;
    				$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
    			}
    			else $notice = $reponse;
    		}
        } else $notice = "Sai loại đơn vị tiền tệ";
        
        echo $notice;
    break;
    
    case 'reset_over_vip':
        $tiente = $_GET['tiente'];
        
        if ($tiente == 'gcoin' || $tiente == 'vpoint') {
            $getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'tiente'    =>  $tiente,
                'resetnow'    =>  $_SESSION['nv_reset'],
                
                'pagesv'	=>	'sv_char_reset_vip_over',
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
    			if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
    				$notice = "<nbb>OK<nbb>" . read_TagName($reponse, 'messenge', 1) . "<nbb>";
    				
                    $_SESSION['acc_gcoin'] = read_TagName($reponse, 'gcoin', 1);
					$_SESSION['acc_gcoin_km'] = read_TagName($reponse, 'gcoin_km', 1);
					$_SESSION['acc_vpoint'] = read_TagName($reponse, 'vpoint', 1);
					
					$_SESSION['nv_reset'] = $_SESSION['nv_reset']+1;
					$_SESSION['nv_level'] = 1;
					$_SESSION['nv_point'] = read_TagName($reponse, 'resetpoint', 1);
					$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'pointdutru', 1);
					$_SESSION['nv_resetday'] = $_SESSION['nv_resetday']+1;
					$_SESSION['nv_resetmonth'] = $_SESSION['nv_resetmonth']+1;
    			}
    			else $notice = $reponse;
    		}
        } else $notice = "Sai loại đơn vị tiền tệ";
        
        echo $notice;
    break;
    
    default:
        echo "Dữ liệu sai";
}



?>