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
if ($Use_XepHang != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else {
    // Chon The he
    if ($thehe_choise)
    {
        if(!isset($_SESSION['thehe'])) $_SESSION['thehe'] = count($thehe_choise)-1;
        if(isset($_GET['thehe'])) $_SESSION['thehe'] = abs(intval($_GET['thehe']));
    }

	if ($act == "event_toprs") { 
		$file_host = "data/toprs.txt"; 
		$action = "view_toprs"; 
		$name = $event_toprs_name;
		$info1_name = "Nhân Vật";
		$info2_name = "Tổng Điểm Reset";
		$time_begin = $event_toprs_begin;
		$time_end = $event_toprs_end;
	}
	elseif ($act == "event_toppoint") { 
		$file_host = "data/toppoint.txt"; 
		$action = "view_toppoint"; 
		$name = $event_toppoint_name; 
		$info1_name = "Nhân Vật";
		$info2_name = "Point";
		$time_begin = $event_toppoint_begin;
		$time_end = $event_toppoint_end;
	}
	elseif ($act == "event_topcard") { 
		$file_host = "data/topcard.txt"; 
		$action = "view_topcard"; 
		$name = $event_topcard_name; 
		$info1_name = "Nhân Vật";
		$info2_name = "Gcoin nạp";
		$time_begin = $event_topcard_begin;
		$time_end = $event_topcard_end;
	}

	$time = time()+date("25179");

	if(is_file($file_host)) $fp_host = fopen($file_host, "r");
	else $fp_host = fopen($file_host, "w");
	$time_host = fgets($fp_host,15);
	fclose($fp_host);
	if ($time >= ($time_host+300))
	{
		
		$getcontent_url = $server_url . "/view_eventtop_intime.php";
        $getcontent_data = array(
            'action'    =>  $action,
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
		//Ghi vào file
			$fp = fopen($file_host, "w");  
			fputs ($fp, $time."\n".$show);
			fclose($fp);
		//End Ghi vào File
	}
	
	$stt = 0;
	$fopen_host = fopen($file_host, "r");
	while (!feof($fopen_host)) {
		$character = fgets($fopen_host,200);
		$char_info = explode('<nbb>', $character);
		if ( empty($char_info[1]) && strlen($char_info[0] > 5))
		{
			$time_top = gmdate("h:iA d/m/Y", intval($character));
		}
		else {
            if( isset($char_info[2]) && $char_info[2] == $_SESSION['thehe'] ) {
                $info[] = array (
                    'info1'	=> $char_info[0],
                    'info2'	=> $char_info[1]
                );
			}
		}
	}
	fclose($fopen_host);
	
	$page_template = 'templates/event/eventtop_intime.tpl';
}
}
?>