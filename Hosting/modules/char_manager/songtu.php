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

include('config/config_songtu.php');

$getcontent_url = $server_url . "/sv_char.php";
$getcontent_data = array(
    'login'    =>  $_SESSION['mu_username'],
    'name'    =>  $_SESSION['mu_nvchon'],
    
    'pagesv'	=>	'sv_char_songtu',
    'action'    =>  'view',
    'string_login'    =>  $_SESSION['checklogin'],
    'passtransfer'    =>  $passtransfer
); 

$reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

if ( empty($reponse) ) $error = "<font size='3' color='red'>Server bảo trì.</font>";
elseif($reponse == "login_other") {
	$error = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
	session_destroy();
}
else {
	$info = explode('<nbb>',$reponse);
	if ($info[1] == 'OK') {
		$songtu_info = $info[2];
		$songtu_arr = json_decode($songtu_info, true);
	}
	else $error = $reponse;
}

    $exp_songtu_sum = 0;
    for($i=1; $i<=$songtu_arr['songtu_lv']+1; $i++) {
        $exp_songtu = floor($songtu_expcoban * (1 + $songtu_expextra * ($i-1) ));
        $exp_songtu_sum = $exp_songtu_sum + $exp_songtu;
    }
    
    if($songtu_arr['songtu_exp'] >= $exp_songtu_sum) {
        $exp_now = "<font color='blue'>". $songtu_arr['songtu_exp'] ."</font>";
        $form_input = '<input type="button" value="Thăng Cấp Song Tu" class="st_thangcap" id="btn_st_tc" /><br /><strong><font color="red">Chúc Phúc : <span id="stcp">'. $songtu_arr['cp_percent'] .'</span> %</font></strong>';
    }
    else {
        $exp_now = $songtu_arr['songtu_exp'];
        $form_input = '<input type="button" value="Song Tu" class="songtu" id="btn_st_up" />';
    }
    
    $songtu_point_percent = $songtu_pointpercent + $songtu_arr['songtu_lv'] * $songtu_pointpercent;
    
    if($songtu_arr['songtu_lv'] >= $songtu_arr['vochong_lv']) {
        $style_tang_ctpoint = "";
    } else {
        $style_tang_ctpoint = "display: none;";
    }
	
$page_template = "templates/char_manager/songtu.tpl";
?>