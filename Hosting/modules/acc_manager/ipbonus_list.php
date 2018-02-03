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
 
if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else 
{
    $file_host = "data/ipbonus_list.txt";
	
	$time = time()+date("25179");

	if(is_file($file_host)) $fp_host = fopen($file_host, "r");
		else $fp_host = fopen($file_host, "w");
		
	$time_host = fgets($fp_host,15);
	fclose($fp_host);
	if ($time >= ($time_host+300))
	{
		$getcontent_url = $server_url . "/view_ipbonus.php";
        $getcontent_data = array(
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
		
		if ( !empty($show) )
		{
		//Ghi vào file
			$fp = fopen($file_host, "w");  
			fputs ($fp, $time."\n".$show);
			fclose($fp);
		//End Ghi vào File
		}
	}
	$line = 0;
	$fopen_host = fopen($file_host, "r");
	while (!feof($fopen_host)) {
		$line ++;
		$character = fgets($fopen_host,200);
		$char_info = explode('<nbb>', $character);
		if ( $line == 1 )
		{
			$time_get = gmdate("h:i A d/m/Y", intval($character));
		}
		elseif(isset($char_info[1]) && strlen($char_info[1])>0) {
            $netname[] = $char_info[1];
            $netaddr[] = $char_info[2];
		}
	}
	fclose($fopen_host);
        
    $page_template = 'templates/acc_manager/ipbonus_list.tpl';
}
?>