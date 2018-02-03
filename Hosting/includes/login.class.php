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
// Dang nhap
$ip_client = get_ip();

if (isset($_POST["login"]))
{
        include_once("config/config.php");
        include_once("config/config_sms.php");

        $accountid = $_POST['username'];
        $passwordid = $_POST['password'];
        
    include_once("vimage.php");
	$vImage = new vImage();
	$vImage->loadCodes();
	if(!($vImage->checkCode())) {
		$error = "Sai mã kiểm tra";
	}    
	elseif (($accountid == NULL) || ($passwordid == NULL)) {$error = "<font size='4' color='red'>Hãy điền tên đăng nhập và mật khẩu.</font>";}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $accountid))
		{
			$error = "<font size='4' color='red'>Dữ liệu lỗi - Tài khoản chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
		}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $passwordid))
		{
			$error = "<font size='4' color='red'>Dữ liệu lỗi - Mật khẩu chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
		}
	elseif ( $accountid == 'demo' && $passwordid == 'demo')
		{
			$_SESSION['mu_username'] = $accountid;
            $_SESSION['mu_nvchon'] = 'Demo';
			$_SESSION['mu_Ranking'] = 'Rankingok';
            
    		jum('index.php');
		}
	else {
        $getcontent_url = $server_url . "/view.php";
        $getcontent_data = array(
            'action'    =>  'login',
            'login'    =>  $accountid,
            'pass'    =>  md5($passwordid),
            'ip'    =>  $ip_client,
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show_reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
		if( empty($show_reponse) )
		{
			$error = "<font size='3' color='red'>Server đang bảo trì</font>";
		}
		else if($show_reponse == 'PASSRAN_KGCO') {
			$error = "<font color='red'><b>Danh sách Mật khẩu ngẫu nhiên chưa khởi tạo hoặc đã sử dụng hết</b></font>.<br>Tài khoản của bạn đang ở chế độ <b>sử dụng mật khẩu ngẫu nhiên để tăng độ bảo mật</b>.<br>Vui lòng <b>dùng SĐT của tài khoản <font color='red'>$accountid</font></b> nhắn tin với cú pháp bên dưới để lấy danh sách mật khẩu ngẫu nhiên mới.<br><font color='red'><b>VNU &nbsp;&nbsp;&nbsp; $cuphap &nbsp;&nbsp;&nbsp; PR &nbsp;&nbsp;&nbsp; $accountid</b></font> &nbsp;&nbsp;&nbsp; gửi &nbsp;&nbsp;&nbsp; <font color='blue'> <b>8185</b> </font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font>";
		}
		else if($show_reponse == 'PASSRAN_SAI') {
			$error = "<font color='red'><b>Mật khẩu không đúng</b></font>.<br>Tài khoản của bạn đang ở chế độ <b>sử dụng mật khẩu ngẫu nhiên để tăng độ bảo mật</b>.<br>Nếu bạn quên danh sách mật khẩu ngẫu nhiên đã nhận, vui lòng <b>dùng SĐT của tài khoản <font color='red'>$accountid</font></b> nhắn tin với cú pháp bên dưới để lấy danh sách mật khẩu ngẫu nhiên mới.<br><font color='red'><b>VNU &nbsp;&nbsp;&nbsp; $cuphap &nbsp;&nbsp;&nbsp; PR &nbsp;&nbsp;&nbsp; $accountid</b></font> &nbsp;&nbsp;&nbsp; gửi &nbsp;&nbsp;&nbsp; <font color='blue'> <b>8185</b> </font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font><br>
Các Mật khẩu cũ chưa sử dụng thì sẽ bị xóa hết để bảo mật.";
		}
		else {
			$info = read_TagName($show_reponse, 'info', 1);
            if ($info == 'OK') {
				$_SESSION['mu_username'] = $accountid;
                $_SESSION['checklogin'] = read_TagName($show_reponse, 'stringlogin', 1);
                
                $accthehe = abs(intval(read_TagName($show_reponse, 'thehe', 1)));
                if ($accthehe == 0) $accthehe = 1;
                $_SESSION['acc_thehe'] = $accthehe;
                $_SESSION['thehe'] = $accthehe;
                
                $_SESSION['acc_gcoin'] = read_TagName($show_reponse, 'gcoin', 1);
                $_SESSION['acc_gcoin_km'] = read_TagName($show_reponse, 'gcoinkm', 1);
                $_SESSION['acc_vpoint'] = read_TagName($show_reponse, 'vpoint', 1);
                $_SESSION['acc_zen'] = read_TagName($show_reponse, 'zen', 1);
                $_SESSION['acc_heart'] = read_TagName($show_reponse, 'heart', 1);
                $_SESSION['acc_chao'] = read_TagName($show_reponse, 'chao', 1);
                $_SESSION['acc_cre'] = read_TagName($show_reponse, 'create', 1);
                $_SESSION['acc_blue'] = read_TagName($show_reponse, 'blue', 1);
                $_SESSION['acc_phone'] = read_TagName($show_reponse, 'phone', 1);
                $_SESSION['acc_passran'] = read_TagName($show_reponse, 'passran', 1);
                $_SESSION['IPBonusPoint'] = read_TagName($show_reponse, 'IPBonusPoint', 1);
                $ipbonus_info = read_TagName($show_reponse, 'ipbonus_info', 1);
                
                $nv_slg = 0;
                for($i=1;$i<=5;$i++)
                {
                    if(strlen(read_TagName($show_reponse, 'char'.$i, 1))>=4)
                    {
                        $nv_slg++;
                        $_SESSION['char'.$nv_slg] = read_TagName($show_reponse, 'char'.$i, 1);
                    }
                }
                $_SESSION['nv_slg'] = $nv_slg;
                if(strlen($ipbonus_info) > 10) $notice = $ipbonus_info . "<br />Do IP Quán NET hay bị thay đổi mỗi khi nhảy mạng, vì vậy các bạn thường xuyên đăng nhập lại để kiểm tra. Nếu thấy thông báo không chơi ở Quán NET đăng ký IP Bonus, vui lòng liên hệ chủ quán để cập nhập IP mới.";
                else $notice = '<strong>Bạn hiện không chơi ở Quán NET đăng ký IP Bonus.<br />Hãy chơi ở quán NET đăng ký IP Bonus để nhận được nhiều ưu đãi trong quá trình chơi.<br /><a href="#acc_manager&act=ipbonus_list" rel="menuajax">Danh sách quán NET đăng ký IP Bonus xem tại đây</a></strong>';
			}
			else { 
				$error = "<font size='4' color='red'>$show_reponse</font>"; 
			}
		}
    }
}

// Logout
if (isset($_POST['logout'])) {
  session_destroy();
  setcookie("last_sendsv", "", time()-3600);
  jum('index.php');
}

// Chon Nhan Vat
if (isset($_POST['ChonNV'])) {
	$nhanvat = $_POST['nhanvat'];
    if( $sendsv === false) { $error = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
    elseif(empty($nhanvat)) { $error = "Chưa chọn Nhân vật"; }
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $nhanvat))
		{
			$error = "<font size='4' color='red'>Dữ liệu lỗi - Nhân vật chọn chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font>";
		}
	else {
		
        $getcontent_url = $server_url . "/view.php";
        $getcontent_data = array(
            'action'    =>  'chonNV',
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $nhanvat,
            'ip'    =>  $ip_client,
            'string_login'  =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

		if ( empty($reponse) ) { $error = "<font size='3' color='red'>Server bảo trì.</font>"; }
		elseif($reponse == "login_other") {
			$error = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
			session_destroy();
		}
		else {
			if (read_TagName($reponse, 'info', 1) != 'OK') { $error = $reponse; }
			else {
				$_SESSION['mu_nvchon'] = $nhanvat;
				
				$_SESSION['nv_online'] = read_TagName($reponse, 'online', 1);
				$_SESSION['nv_doinv'] = read_TagName($reponse, 'doinv', 1);
				$_SESSION['nv_class'] = read_TagName($reponse, 'class', 1);
				$_SESSION['nv_level'] = read_TagName($reponse, 'level', 1);
				$_SESSION['nv_point'] = read_TagName($reponse, 'point', 1);
				$_SESSION['nv_pointdutru'] = read_TagName($reponse, 'point_dutru', 1);
				$_SESSION['nv_zen'] = read_TagName($reponse, 'zen', 1);
				$_SESSION['nv_reset'] = read_TagName($reponse, 'reset', 1);
				$_SESSION['nv_resetday'] = read_TagName($reponse, 'resetday', 1);
				$_SESSION['nv_resetmonth'] = read_TagName($reponse, 'resetmonth', 1);
				$_SESSION['nv_relife'] = read_TagName($reponse, 'relife', 1);
				$_SESSION['nv_khoado'] = read_TagName($reponse, 'khoado', 1);
				$_SESSION['nv_thuepoint'] = read_TagName($reponse, 'thuepoint', 1);
				$_SESSION['nv_pointevent'] = read_TagName($reponse, 'pointevent', 1);
				$_SESSION['nv_uythaconline'] = read_TagName($reponse, 'uythacon', 1);
				$_SESSION['nv_point_uythac'] = read_TagName($reponse, 'pointuythac', 1);
                $_SESSION['nv_point_uythac_event'] = read_TagName($reponse, 'pointuythac_event', 1);
				$_SESSION['nv_uythac_offline'] = read_TagName($reponse, 'uythacoff', 1);
				$_SESSION['nv_uythac_offline_time'] = read_TagName($reponse, 'uythacoff_time', 1);
                $_SESSION['nv_uythac_offline_daily'] = read_TagName($reponse, 'uythacoff_daily', 1);
                $_SESSION['nv_top50'] = read_TagName($reponse, 'top50', 1);
                $_SESSION['point_event'] = read_TagName($reponse, 'point_event', 1);
                $_SESSION['event1_type1'] = read_TagName($reponse, 'event1_type1', 1);
                $_SESSION['event1_type2'] = read_TagName($reponse, 'event1_type2', 1);
                $_SESSION['event1_type3'] = read_TagName($reponse, 'event1_type3', 1);
                $_SESSION['event1_type1_daily'] = read_TagName($reponse, 'event1_type1_daily', 1);
                $_SESSION['event1_type2_daily'] = read_TagName($reponse, 'event1_type2_daily', 1);
                $_SESSION['event1_type3_daily'] = read_TagName($reponse, 'event1_type3_daily', 1);
                $_SESSION['quest_daily'] = read_TagName($reponse, 'qwait', 1);
				
				setcookie("nweb_loaddata", time(), time()+3600);
				
				$notice = "Đã chọn nhân vật : <b>$nhanvat</b>";
				$remove_choisenv = 1;
			}
		}
	}
}
?>