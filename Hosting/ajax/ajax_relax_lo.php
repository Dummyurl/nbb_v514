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
 

include('config/config_relax_lo.php');

$action = $_GET['action'];

switch ($action){
    case 'danhlo':
        $lo_so = $_GET['lo_so'];            $lo_so = abs(intval($lo_so));
        $lo_diem = $_GET['lo_diem'];        $lo_diem = abs(intval($lo_diem));
        
        if($lo_diem == 0) {
            echo "Chưa chọn điểm lô muốn đánh";
        } else {
            $getcontent_url = $server_url . "/sv_relax.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'action'    =>  'danhlo',
                'lo_so'    =>  $lo_so,
                'lo_diem'    =>  $lo_diem,
                
                'pagesv'    =>  'sv_relax_lo',
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
        
    case 'lo_history':
        $getcontent_url = $server_url . "/sv_relax.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'action'    =>  'lo_history',
            
            'pagesv'    =>  'sv_relax_lo',
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
                
                $lo_history = read_TagName($reponse, 'lo_history', 1);
                $lo_history_arr = json_decode($lo_history, true);
                $lo_his_content = "";
                if(is_array($lo_history_arr) && count($lo_history_arr) > 0) {
                        $lo_his_content .= '<table width="100%" border="0" bgcolor="#9999FF">';
                        $lo_his_content .= '<tr bgcolor="#FFFFFF">';
                        $lo_his_content .= '<th scope="col" align="center">#</th>';
                        $lo_his_content .= '<th scope="col" align="center">Đánh Con</th>';
                        $lo_his_content .= '<th scope="col" align="center">Điểm</th>';
                        $lo_his_content .= '<th scope="col" align="center">Ngày đánh</th>';
                        $lo_his_content .= '<th scope="col" align="center">Thông tin</th>';
                        $lo_his_content .= '</tr>';
                    foreach($lo_history_arr as $k => $v) {
                        $stt = $k + 1;
                        $info = '';
                        if($v['status'] == 0) {
                            $info = "Chưa xổ";
                        } else if($v['status'] == 1) {
                            $info = "Đã trúng ". $v['nhay_win'] ." nháy được ". $v['gcoin_win'] ." Gcoin";
                        } else if($v['status'] == 2) {
                            $info = "Không trúng Lô";
                        }
                        
                        $lo_his_content .= '<tr bgcolor="#FFFFFF">';
                        $lo_his_content .= '<td align="center">'. $stt .'</td>';
                        $lo_his_content .= '<td align="center">'. $v['danhso'] .'</td>';
                        $lo_his_content .= '<td align="center">'. $v['diem'] .'</td>';
                        $lo_his_content .= '<td align="center">'. date('d/m/Y H:i', $v['time_danh']) .'</td>';
                        $lo_his_content .= '<td align="center">'. $info .'</td>';
                        $lo_his_content .= '</tr>';
                    }
                        $lo_his_content .= '</table>';
                }
                
                echo $lo_his_content;
    		} else echo $reponse;
    	}
        
        break;
    
    default:
        $lo_diem = $_GET['ilo_diem'];         $lo_diem = abs(intval($lo_diem));
        
        $lo_gcoin = $lo_diem * $lo_diem_gcoin;
        echo number_format($lo_gcoin, 0, ',', '.');
}

        

?>