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

include('config/config_tuluyen.php');

$getcontent_url = $server_url . "/sv_char.php";
$getcontent_data = array(
    'login'    =>  $_SESSION['mu_username'],
    'name'    =>  $_SESSION['mu_nvchon'],
    
    'pagesv'	=>	'sv_char_tuluyen',
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
		$tuluyen_info = $info[2];
		$tuluyen_arr = json_decode($tuluyen_info, true);
	}
	else $notice = $reponse;
}

for($pointtype = 1; $pointtype <=4; $pointtype++) {
    switch ($pointtype){ 
	case 1:
        $type_cap = $tuluyen_arr['str_cap'];
        $type_exp = $tuluyen_arr['str_exp'];
        $type_point = $tuluyen_arr['str_point'];
        $type_cp = $tuluyen_arr['str_cp'];
        $type = 'str';
	break;

	case 2:
        $type_cap = $tuluyen_arr['agi_cap'];
        $type_exp = $tuluyen_arr['agi_exp'];
        $type_point = $tuluyen_arr['agi_point'];
        $type_cp = $tuluyen_arr['agi_cp'];
        $type = 'agi';
	break;

	case 3:
        $type_cap = $tuluyen_arr['vit_cap'];
        $type_exp = $tuluyen_arr['vit_exp'];
        $type_point = $tuluyen_arr['vit_point'];
        $type_cp = $tuluyen_arr['vit_cp'];
        $type = 'vit';
	break;

	case 4:
        $type_cap = $tuluyen_arr['ene_cap'];
        $type_exp = $tuluyen_arr['ene_exp'];
        $type_point = $tuluyen_arr['ene_point'];
        $type_cp = $tuluyen_arr['ene_cp'];
        $type = 'ene';
	break;
}
    
    $exp_tuluyen_sum[$pointtype] = 0;
    $sumpoint[$pointtype] = 0;
    for($i=1; $i<=$type_cap+1; $i++) {
        $exp_tuluyen[$pointtype] = floor($tuluyen_expcoban * (1 + $tuluyen_expextra * ($i-1) ));
        $exp_tuluyen_sum[$pointtype] = $exp_tuluyen_sum[$pointtype] + $exp_tuluyen[$pointtype];
        $pointcap[$pointtype] = floor($tuluyen_pointcoban * (1 + $tuluyen_pointextra * ($i-1) ));
        $sumpoint[$pointtype] = $sumpoint[$pointtype] + $pointcap[$pointtype];
    }
    
    if($type_exp >= $exp_tuluyen_sum[$pointtype]) {
        $exp_now[$pointtype] = "<font color='blue'>$type_exp</font>";
        $form_input[$pointtype] = '<input type="button" value="Thăng Cấp" class="tl_thangcap" id="btn_tc_'. $type .'" tltype="'. $type .'" /><br /><strong><font color="red">Chúc Phúc : <span id="tlcp_'. $type .'">'. $type_cp .'</span> %</font></strong>';
    }
    else {
        $exp_now[$pointtype] = "$type_exp";
        $form_input[$pointtype] = '<input type="button" value="Tu luyện" class="tuluyen" id="btn_tl_'. $type .'" tltype="'. $type .'" />';
    }
    
}
    
	
$page_template = "templates/char_manager/tuluyen.tpl";
?>