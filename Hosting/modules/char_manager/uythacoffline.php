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
include('config/config_uythacoffline.php');
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == 'uythacoffline')
	{
		$character = $_POST['character'];
		$pass2 = $_POST['pass2'];
		$act = $_POST['act'];
        $getuythac = $_POST['getuythac'];
		
		if (empty($character))
		{
			$notice = "Chưa chọn nhân vật cần Ủy Thác";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		elseif (empty($pass2))
		{
			$notice = "Chưa nhập mật khẩu cấp 2";
		}
		elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
			{
				$error = "<font size='4' color='red'>Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
			}
		else {
			
			$getcontent_url = $server_url . "/sv_char.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'act'    =>  $act,
                'getuythac'    =>  $getuythac,
                'pass2'    =>  $pass2,
                
                'pagesv'	=>	'sv_char_uythac_offline',
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
				if ($info[0] == 'OK') {
					$notice = $info[1];
					
					if($act == 'uythac_begin')
					{
						$_SESSION['nv_uythac_offline'] = 1;
					}
					if($act == 'uythac_end')
					{
					   if($getuythac) {
					       $_SESSION['nv_uythac_offline'] = 0;
    						$_SESSION['nv_uythac_offline_time'] = 0;
    						$_SESSION['acc_gcoin'] = $info[1];
    						$_SESSION['acc_gcoin_km'] = $info[2];
    					
    						$point_uythac_add = $info[3];
    						$phut_uythac = $info[4];
    						
    						$_SESSION['nv_point_uythac'] = $_SESSION['nv_point_uythac'] + $point_uythac_add;
    						
    						$notice = $info[5];
					   } else {
					       $_SESSION['nv_uythac_offline'] = 0;
					   }
					}
					
				}
				else $notice = $reponse;
			}
		}
	}
}

if( ($_SESSION['nv_point_uythac'] + (720-$_SESSION['nv_uythac_offline_daily']) ) > 1440 ) {
    $uythac_goiy = "Bạn đã có ". $_SESSION['nv_point_uythac'] ." Điểm Ủy Thác. Tối đa bạn có thể có : 1440 Điểm Ủy Thác.<br /><strong>Bạn chỉ nên Ủy Thác trong ". (1440-$_SESSION['nv_point_uythac']) ." phút để nhận ". (1440-$_SESSION['nv_point_uythac']) ." Điểm Ủy Thác</strong>";
} elseif( $_SESSION['nv_uythac_offline_daily'] > 0 ) {
	$uythac_goiy_phut = ((720-$_SESSION['nv_uythac_offline_daily'])>0) ? (720-$_SESSION['nv_uythac_offline_daily']) : 0;
	
    $uythac_goiy = "Bạn đã nhận Ủy Thác ". $_SESSION['nv_uythac_offline_daily'] ." phút Offline trong ngày. Tối đa bạn có thể Ủy Thác trong ngày : 720 phút.<br /><strong>Bạn chỉ nên Ủy Thác trong ". (720-$_SESSION['nv_uythac_offline_daily']) ." phút để nhận ". $uythac_goiy_phut ." Điểm Ủy Thác</strong>";
} else {
    $uythac_goiy = "Tối đa bạn có thể Ủy Thác trong 1 lần : 720 phút.<br /><strong>Bạn chỉ nên Ủy Thác trong 720 phút để nhận 720 Điểm Ủy Thác.</strong>";
}


$uythac_msg = "";
$phutuythac = $_SESSION['nv_uythac_offline_time'];

if( $_SESSION['nv_uythac_offline_time'] > 720 ) {
    $phutuythac = 720;
    $uythac_msg .= "- Bạn đã Ủy Thác hơn 12 tiếng, bạn chỉ được phép Ủy thác tối đa trong 1 lần là 12 tiếng. <strong>Điểm Ủy Thác tối đa nhận được : 720 điểm</strong>.<br />";
}

if( ($_SESSION['nv_uythac_offline_daily'] > 0) && ($phutuythac + $_SESSION['nv_uythac_offline_daily'])>720 ) {
    $phutuythac = 720 - $_SESSION['nv_uythac_offline_daily'];
    if($phutuythac < 0) $phutuythac = 0;
    $uythac_msg .= "- Bạn đã nhận Ủy Thác trong ngày ". $_SESSION['nv_uythac_offline_daily']. " phút. Bạn chỉ được phép Ủy Thác tối đa trong ngày 12 tiếng : 720 Điểm.<br />++ <strong>Bạn được phép nhận tối đa : ". $phutuythac ." Điểm Ủy Thác</strong>.<br />";
}

if( ($_SESSION['nv_point_uythac'] + $phutuythac) > 1440) {
    $phutuythac = 1440 - $_SESSION['nv_point_uythac'];
    if($phutuythac < 0) $phutuythac = 0;
    $uythac_msg .= "- Điểm Ủy thác tối đa được phép là : 1440 Điểm. Bạn đã có : ". $_SESSION['nv_point_uythac'] ." Điểm. <br />++ <strong>Bạn được phép nhận tối đa : ". $phutuythac ." Điểm Ủy Thác</strong>.<br />";
}

$uythac_price = $phutuythac*$uythacoff_price;

$uythac_msg .=  "Cần <strong>$uythac_price</strong> Gcoin để nhận hết số Điểm Ủy Thác trong <strong>". $phutuythac ."</strong> Phút Ủy Thác";

$accept = 1;
if ($_SESSION['nv_online'] == 1 || $_SESSION['nv_doinv'] == 0 ) { $accept = 0; }

$page_template = "templates/char_manager/uythacoffline.tpl";
?>