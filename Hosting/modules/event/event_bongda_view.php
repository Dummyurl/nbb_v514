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
	$time = time()+date("25200");

	$fp_host = fopen($file_host, "r");
	$time_host = fgets($fp_host,15);
	fclose($fp_host);
	if ($time >= ($time_host+60))
	{
		
		$getcontent_url = $server_url . "/view_event_bongda.php";
        $getcontent_data = array(
            'action'    =>  'view',
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

		if ( !empty($show) )
		{
		//Ghi vào file
			$fp = fopen($file_host, "w+");  
			fputs ($fp, $time."\n".$show);
			fclose($fp);
		//End Ghi vào File
		}
	}
	
	$line = 0;
	$fopen_host = fopen($file_host, "r");
	$dudoan_info = 0;
	while (!feof($fopen_host)) {
		$line++;
		$line_info = fgets($fopen_host,200);
		if ( $line == 1 )
		{
			$time_get = gmdate("h:i d/m/Y",$line_info);
		}
		else {
			if( substr($line_info,0,10) == '<netbanbe>') $dudoan_info++;
			else {
				if($dudoan_info == 0)
				{
					$tran_info = explode('<nbb>', $line_info);
					$tran_id = $tran_info[1];
					$doi1 = $tran_info[2];
					$doi2 = $tran_info[3];
					$time_dau = date('h:iA d/m/Y',$tran_info[4]);
					$giai = $tran_info[5];
					
					if($giai) {
						$bong_dudoan[] = array (
							'tran_id' => $tran_id,
							'doi1' => $doi1,
							'doi2' => $doi2,
							'time_dau' => $time_dau,
							'giai' => $giai
						);
					}
				}
				elseif($dudoan_info == 1)
				{
					$tran_info = explode('<nbb>', $line_info);
					$tran_id = $tran_info[1];
					$doi1 = $tran_info[2];
					$doi2 = $tran_info[3];
					$time_dau = date('h:iA d/m/Y',$tran_info[4]);
					$giai = $tran_info[5];
					
					if($giai) {
						$bong_wait[] = array (
							'tran_id' => $tran_id,
							'doi1' => $doi1,
							'doi2' => $doi2,
							'time_dau' => $time_dau,
							'giai' => $giai
						);
					}
				}
				else {
					$tran_info = explode('<nbb>', $line_info);
					$tran_id = $tran_info[1];
					$doi1 = $tran_info[2];
					$doi2 = $tran_info[3];
					$tyso1 = $tran_info[4];
					$tyso2 = $tran_info[5];
					$time_dau = date('h:iA d/m/Y',$tran_info[6]);
					$giai = $tran_info[7];
					
					if($giai) {
						$bong_finish[] = array (
							'tran_id' => $tran_id,
							'doi1' => $doi1,
							'doi2' => $doi2,
							'tyso1' => $tyso1,
							'tyso2' => $tyso2,
							'time_dau' => $time_dau,
							'giai' => $giai
						);
					}
				}
			}
		}
	}
	fclose($fopen_host);

$page_template = "templates/event/event_bongda_view.tpl";
?>