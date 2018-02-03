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
    
    $file_host = "data/daugianguoc_bidend.txt";
    
	$time = time()+date("25200");

	$fp_host = fopen($file_host, "a+");
	$time_host = fgets($fp_host);
	fclose($fp_host);
	if ($time >= ($time_host+60))
	{
		$getcontent_url = $server_url . "/sv_com.php";
        $getcontent_data = array(
            'login'    =>  $_SESSION['mu_username'],
            'name'    =>  $_SESSION['mu_nvchon'],
            
            'action'    =>  'listitem_end',
            'pagesv'    =>  'sv_com_daugianguoc',
            'string_login'    =>  $_SESSION['checklogin'],
            'passtransfer'    =>  $passtransfer
        );
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
		if ( !empty($reponse) )
		{
            $reponse_explode = explode('<nbb>', $reponse);
            if($reponse_explode[1] == 'OK') {
                //Ghi vào file
        			$fp = fopen($file_host, "w+");  
        			fputs ($fp, $time."\n".$reponse_explode[2]);
        			fclose($fp);
        		//End Ghi vào File
            } else {
                $error_module = "Lỗi : $reponse";
            }
		}
	}
    
    $line = 0;
	$fopen_host = fopen($file_host, "r");
	while (!feof($fopen_host)) {
		$line++;
		$info = fgets($fopen_host);
		if ( $line == 1 )
		{
			$time_top = gmdate("h:i A d/m/Y",$info);
		}
		else {
              $listitem = $info;
		}
	}
	fclose($fopen_host);
    $listitem_arr = unserialize_safe($listitem);
    if(!is_array($listitem_arr)) $listitem_arr = array();

$page_template = "templates/com/daugianguoc_listitem_end.tpl";
?>