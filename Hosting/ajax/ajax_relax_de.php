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

$action = $_GET['action'];

switch ($action){
    case 'danhde':
        $de_so = $_GET['de_so'];            $de_so = abs(intval($de_so));
        $de_diem = $_GET['de_diem'];        $de_diem = abs(intval($de_diem));
        
        if($de_diem == 0) {
            echo "Chưa chọn Gcoin muốn đánh";
        } else {
            $getcontent_url = $server_url . "/sv_relax.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'action'    =>  'danhde',
                'de_so'    =>  $de_so,
                'de_diem'    =>  $de_diem,
                
                'pagesv'    =>  'sv_relax_de',
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
                    $_SESSION['acc_gcoin'] = read_TagName($reponse, 'gconnew', 1);
                    
                    $msg = read_TagName($reponse, 'msg', 1);
                    echo "|OK|". number_format($_SESSION['acc_gcoin'], 0, ',', '.') ."|";
        		} else echo $reponse;
        	}
        }
        
        break;
        
    case 'de_history':
        $getcontent_url = $server_url . "/sv_relax.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'action'    =>  'de_history',
            
            'pagesv'    =>  'sv_relax_de',
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
                
                $de_history = read_TagName($reponse, 'de_history', 1);
                $de_history_arr = json_decode($de_history, true);
                $de_his_content = "";
                if(is_array($de_history_arr) && count($de_history_arr) > 0) {
                        $de_his_content .= '<table width="100%" border="0" bgcolor="#9999FF">';
                        $de_his_content .= '<tr bgcolor="#FFFFFF">';
                        $de_his_content .= '<th scope="col" align="center">#</th>';
                        $de_his_content .= '<th scope="col" align="center">Đánh Con</th>';
                        $de_his_content .= '<th scope="col" align="center">Gcoin Đánh</th>';
                        $de_his_content .= '<th scope="col" align="center">Ngày đánh</th>';
                        $de_his_content .= '<th scope="col" align="center">Thông tin</th>';
                        $de_his_content .= '</tr>';
                    foreach($de_history_arr as $k => $v) {
                        $stt = $k + 1;
                        $info = '';
                        if($v['status'] == 0) {
                            $info = "Chưa xổ";
                        } else if($v['status'] == 1) {
                            $info = "Đã trúng được ". $v['gcoin_win'] ." Gcoin";
                        } else if($v['status'] == 2) {
                            $info = "Không trúng Đề";
                        }
                        
                        $de_his_content .= '<tr bgcolor="#FFFFFF">';
                        $de_his_content .= '<td align="center">'. $stt .'</td>';
                        $de_his_content .= '<td align="center">'. $v['danhso'] .'</td>';
                        $de_his_content .= '<td align="center">'. $v['gcoin_danh'] .'</td>';
                        $de_his_content .= '<td align="center">'. date('d/m/Y H:i', $v['time_danh']) .'</td>';
                        $de_his_content .= '<td align="center">'. $info .'</td>';
                        $de_his_content .= '</tr>';
                    }
                        $de_his_content .= '</table>';
                }
                
                echo $de_his_content;
    		} else echo $reponse;
    	}
        
        break;
    
    default:
        $lo_diem = $_GET['ilo_diem'];         $lo_diem = abs(intval($lo_diem));
        
        $lo_gcoin = $lo_diem * $lo_diem_gcoin;
        echo number_format($lo_gcoin, 0, ',', '.');
}

        

?>