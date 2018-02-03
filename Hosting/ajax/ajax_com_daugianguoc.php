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
 
include('config/config_daugianguoc.php');

$action = $_GET['action'];

switch ($action){ 
	case 'bid':
        $bidid = $_GET['bidid'];    $bidid = abs(intval($bidid));
        $bid = $_GET['bid'];        $bid = abs(intval($bid));
        
        if($bid + $Vpoint_Bid > $_SESSION['acc_vpoint'] ) {
            echo "Tài khoản không đủ Vpoint để tham gia đấu giá. Cần có ít nhất $bid Vpoint để đặt và $Vpoint_Bid chi phí đấu giá";
        } else {
            $getcontent_url = $server_url . "/sv_com.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $_SESSION['mu_nvchon'],
                'action'    =>  'bid',
                'bidid'    =>  $bidid,
                'bid'   =>  $bid,
                
                'pagesv'	=>	'sv_com_daugianguoc',
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            );
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
            
            if ( empty($reponse) ) echo "Server bảo trì.";
            elseif($reponse == "login_other") {
            	echo "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
            	session_destroy();
            }
            else {
            	if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                    $_SESSION['acc_vpoint'] = $_SESSION['acc_vpoint'] - ($bid + $Vpoint_Bid);
                    echo "OK";
            	} else echo $reponse;
            }
        }
	break;

	case 'bidding_view':
        $bidid = $_GET['bidid'];    $bidid = abs(intval($bidid));
        $getcontent_url = $server_url . "/sv_com.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            'action'    =>  'bidding_view',
            'bidid'    =>  $bidid,
            
            'pagesv'	=>	'sv_com_daugianguoc',
            'string_login'    =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        );
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        if ( empty($reponse) ) echo "Server bảo trì.";
        elseif($reponse == "login_other") {
        	echo "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
        	session_destroy();
        }
        else {
        	if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                $data = read_TagName($reponse, 'data', 1);
                $data_arr = unserialize_safe($data);
                if(!is_array($data_arr)) $data_arr = array();
                echo "<br /><a href='#' class='close_bidding_view' bidid='". $bidid ."'>Đóng lại</a><br />";
                echo '<table border="1" style="border-collapse: collapse;" cellpadding="2" cellspacing="3" width="90%" align="center">
                    <tr>
                        <td align="center"><strong>Nhân vật</strong></td>
                        <td align="center"><strong>Giá đặt</strong></td>
                        <td align="center"><strong>Đặt lúc</strong></td>
                    </tr>';
                foreach($data_arr as $biddata) {
                    echo '
                        <tr>
                            <td align="center">'. $biddata['name'] .'</td>
                            <td align="center">'. number_format($biddata['bid_vpoint'], 0, ',', '.') .' Vpoint</td>
                            <td align="center">'. $biddata['bid_time'] .'</td>
                        </tr>
                    ';
                }
                echo '</table>';
                echo "<br /><a href='#' class='close_bidding_view' bidid='". $bidid ."'>Đóng lại</a><br />";
        	} else echo $reponse;
        }
	break;
    
    case 'reward':
        $bidid = $_GET['bidid'];    $bidid = abs(intval($bidid));
        $getcontent_url = $server_url . "/sv_com.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            'action'    =>  'reward',
            'bidid'    =>  $bidid,
            
            'pagesv'	=>	'sv_com_daugianguoc',
            'string_login'    =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        );
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        if ( empty($reponse) ) echo "Server bảo trì.";
        elseif($reponse == "login_other") {
        	echo "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
        	session_destroy();
        }
        else {
        	if ( read_TagName($reponse, 'info', 1) == 'OK' ) {
                echo "OK";
        	} else echo $reponse;
        }
    break;
}



?>