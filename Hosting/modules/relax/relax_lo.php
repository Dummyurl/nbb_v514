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
	
include('config/config_relax_lo.php');
    
    $file_host = "data/kqxs.txt";
    
    if(is_file($file_host)) $fopen_host = fopen($file_host, "r");
	else $fopen_host = fopen($file_host, "w");
	
    $line = 0;
	while (!feof($fopen_host)) {
		$line++;
        if($line == 1) {
            $time_host = intval(fgets($fopen_host));
        } else if($line == 2) {
            $kqxs = fgets($fopen_host);
            $kqxs_arr = json_decode($kqxs, true);
        }
	}
    fclose($fopen_host);
    $hour_host = date('H', $time_host);
    $min_host = date('i', $time_host);
    $datetime_kqxs_host = strtotime($kqxs_arr['date']);
	
	$time = time();
    $hour_now = date('H', $time);
    $min_now = date('i', $time);
    $datetime = strtotime(date('Y-m-d', $time));
	
	if ( ( ( $hour_now < 20 && abs($datetime - $datetime_kqxs_host) > 24*60*60 ) || ($hour_now >= 20 && $datetime != $datetime_kqxs_host) ) && abs($min_now - $min_host) >= 5 )
	{
		$getcontent_url = $server_url . "/sv_relax.php";
        $getcontent_data = array(
            'pagesv'    =>  'sv_relax_kqxs',
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

		if ( !empty($show) )
		{
            $kqxs_data = read_TagName($show, 'kqxs', 1);
            if(strlen($kqxs_data) > 10) {
            //Ghi vào file
    			$fp = fopen($file_host, "w");  
    			fputs ($fp,$time."\n".$kqxs_data);
    			fclose($fp);
    		//End Ghi vào File
            }
		}
	}
	
	$fopen_host = fopen($file_host, "r");
	
	while (!feof($fopen_host)) {
		$kqxs_load = fgets($fopen_host);
        if(strlen($kqxs_load) > 15) {
            $kqxs_arr = json_decode($kqxs_load, true);
            break;
        }
	}
    fclose($fopen_host);
    
    for($i=0; $i<=7; $i++) {
        $giai[$i] = "";
        if(is_array($kqxs_arr['kqxs'][$i])) {
            foreach($kqxs_arr['kqxs'][$i] as $v) {
                if(strlen($giai[$i]) > 0) $giai[$i] .= " - ";
                $giai[$i] .= $v;
            }
        } else {
            $giai[$i] = $kqxs_arr['kqxs'][$i];
        }
            
    }
    
$hour_now = date('H', time());
$max_diemlo = floor($_SESSION['acc_gcoin']/$lo_diem_gcoin);

$page_template = "templates/relax/relax_lo.tpl";
?>