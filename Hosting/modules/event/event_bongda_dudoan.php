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

	$tranid = $_GET['tranid'];
	$line = 0;
	$fopen_host = fopen($file_host, "r");
	$dudoan_info = 0;
	$accept_dudoan = 0;
	while (!feof($fopen_host) && ($dudoan_info==0) ) {
		$line_info = fgets($fopen_host,200);
		if( substr($line_info,0,10) == '<netbanbe>') $dudoan_info++;
		else {
			$tran_info = explode('<nbb>', $line_info);
			
			if($tran_info[1] == $tranid) {
				
				$doi1 = $tran_info[2];
				$doi2 = $tran_info[3];
				$time_dau = date('h:iA d/m/Y',$tran_info[4]);
				$time_end = date('h:iA d/m/Y',$tran_info[4] + 45*60);
				$giai = $tran_info[5];
				
				$dudoan_info++;
				$accept_dudoan = 1;
			}
		}
	}
	fclose($fopen_host);
	
if($accept_dudoan == 0) { echo "<center><font color='red'><b>Mã trận dự đoán sai.</b></font></center>"; }
else {
	if($_POST['check_dudoan'] == 'ok')
	{
		$tran_id = $_POST['tran_id'];
		$ketqua = $_POST['ketqua'];
		$slgdudoan = $_POST['slgdudoan'];

		if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
		elseif(preg_match("/[^0-9$]/", $tran_id)) {
			$notice = "<font size='4' color='red'>Dữ liệu lỗi - Mã trận chỉ được sử dụng số (1-9).</font>";
		}
		elseif( !($ketqua == 1 || $ketqua == 2 || $ketqua == 3) ) {
			$notice = "<font size='4' color='red'>Dữ liệu lỗi - Kết quả trận đấu chỉ được sử dụng số (1-3).</font>";
		}
		elseif(preg_match("/[^0-9$]/", $slgdudoan)) {
			$notice = "<font size='4' color='red'>Dữ liệu lỗi - Số ý kiến dự đoán giống bạn chỉ được sử dụng số (1-9).</font>";
		} else {
			
			$getcontent_url = $server_url . "/event_bongda.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'action'    =>  'dudoan',
                'tran_id'    =>  $tran_id,
                'ketqua'    =>  $ketqua,
                'slgdudoan'    =>  $slgdudoan,
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            ); 
            
            $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

			if ( empty($show) ) $notice = "Server bảo trì";
			elseif($show == "login_other") {
					$notice = "Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.";
					session_destroy();
				}
			elseif($show == 'OK') {
				if($ketqua == 1) $ketqua_dudoan = 'Thắng';
				elseif($ketqua == 2) $ketqua_dudoan = 'Hòa';
				else $ketqua_dudoan = 'Thua';
				$notice = "Bạn đã dự đoán <b>$doi1</b> $ketqua_dudoan <b>$doi2</b> với <b>$slgdudoan</b> ý kiến giống bạn.";
				
				$_SESSION['acc_vpoint'] = $_SESSION['acc_vpoint']-1000;
			}
			else $notice = $show;
		}
	}
	
	//Get du doan
	$form_data = "action=goiy&tran_id=$tranid&passtransfer=$passtransfer";
	$show = @file_get_contents($server_url."/view_event_bongda.php?".$form_data);
	
	if($show) {
		$goiy_info = explode('<nbb>', $show);
		$goiy_win = $goiy_info[1];
		$goiy_draw = $goiy_info[2];
		$goiy_lose = $goiy_info[3];
	}
	
	//Du doan ca nhan
	$form_data = "action=mydudoan&login=$_SESSION[mu_username]&tran_id=$tranid&passtransfer=$passtransfer";
	$show = @file_get_contents($server_url."/view_event_bongda.php?".$form_data);
	
	if($show) {
		$mydudoan_split = explode('<netbanbe>', $show);
		$count_dudoan = count($mydudoan_split);
		
		for($i=1;$i<$count_dudoan;$i++) {
			$dudoan_info = explode('<nbb>', $mydudoan_split[$i]);
			$dudoan_id = $dudoan_info[1];
			$dudoan_kq = $dudoan_info[2];
			$dudoan_slg = $dudoan_info[3];
			$time = $dudoan_info[4];
			
			switch ($dudoan_kq) {
				case '1' : $msg_dudoan = "<font color='#0000FF'><b>$doi1</b> Thắng <b>$doi2</b></font>"; break;
				case '2' : $msg_dudoan = "<font color='#993300'><b>$doi1</b> Hòa <b>$doi2</b></font>"; break;
				case '3' : $msg_dudoan = "<font color='#FF0000'><b>$doi1</b> Thua <b>$doi2</b></font>"; break;
			}
			$time_dudoan = date('h:iA d/m/Y', $time);
			
			$mydudoan[] = array(
				'dudoan_id' => $dudoan_id,
				'msg_dudoan' => $msg_dudoan,
				'dudoan_slg' => $dudoan_slg,
				'time_dudoan' => $time_dudoan
			);
		}
	}
	
	$page_template = "templates/event/event_bongda_dudoan.tpl";
}
?>