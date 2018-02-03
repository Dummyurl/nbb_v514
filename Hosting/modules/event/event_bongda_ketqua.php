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
	while (!feof($fopen_host) ) {
		$line_info = fgets($fopen_host,200);
		if( substr($line_info,0,10) == '<netbanbe>') $dudoan_info++;
		elseif($dudoan_info==2) {
			$tran_info = explode('<nbb>', $line_info);
			
			if($tran_info[1] == $tranid) {
				
				$doi1 = $tran_info[2];
				$doi2 = $tran_info[3];
				$kq1 = $tran_info[4];
				$kq2 = $tran_info[5];
				$time_dau = date('h:iA d/m/Y',$tran_info[6]);
				$giai = $tran_info[7];
				
				$dudoan_info++;
				$accept_dudoan = 1;
			}
		}
	}
	fclose($fopen_host);
	
if($accept_dudoan == 0) { echo "<center><font color='red'><b>Mã trận dự đoán sai.</b></font></center>"; }
else {
	//Get ket qua
	
	$getcontent_url = $server_url . "/view_event_bongda.php";
    $getcontent_data = array(
        'action'    =>  'action',
        'tran_id'    =>  $tran_id,
        'passtransfer'    =>  $passtransfer
    ); 
    
    $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
	
	if($show) {
		$ketqua_info = explode('<netbanbe>', $show);
		$slg_dudoan = $ketqua_info[1];
		
		if(strlen($ketqua_info[2])>10) {
			$giai1_info = explode('<nbb>', $ketqua_info[2]);
				$giai1_char = $giai1_info[0];
				$giai1_dudoan = $giai1_info[1];
				$giai1_saiso = abs($giai1_dudoan - $slg_dudoan);
				$giai1_time = date('h:iA d/m/Y', $giai1_info[2]);
		}
		if(strlen($ketqua_info[3])>10) {
			$giai2_info = explode('<nbb>', $ketqua_info[3]);
				$giai2_char = $giai2_info[0];
				$giai2_dudoan = $giai2_info[1];
				$giai2_saiso = abs($giai2_dudoan - $slg_dudoan);
				$giai2_time = date('h:iA d/m/Y', $giai2_info[2]);
		}
		if(strlen($ketqua_info[4])>10) {
			$giai3_info = explode('<nbb>', $ketqua_info[4]);
				$giai3_char = $giai3_info[0];
				$giai3_dudoan = $giai3_info[1];
				$giai3_saiso = abs($giai3_dudoan - $slg_dudoan);
				$giai3_time = date('h:iA d/m/Y', $giai3_info[2]);
		}
	}
	
	//Du doan ca nhan
	
	$getcontent_url = $server_url . "/view_event_bongda.php";
    $getcontent_data = array(
        'login'    =>  $_SESSION['mu_username'],
        'action'    =>  'mydudoan',
        'tran_id'    =>  $tran_id,
        'passtransfer'    =>  $passtransfer
    ); 
    
    $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
	
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
	
	$page_template = "templates/event/event_bongda_ketqua.tpl";
}
?>