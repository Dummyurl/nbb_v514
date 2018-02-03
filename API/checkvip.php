<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 5/10/2011
 * @WebSite http://netbanbe.net
 * @FileName Untitled 5
 */

$error_vip = 0;

$file_vip = "vip.txt";

if( file_exists($file_vip) ) {
    $acclic = $acclic_receive;
    $accvip_arr = array();
    // Read LIC
    $fp_host = fopen($file_vip, "r");
    while (!feof($fp_host)) {
        $infovip = fgets($fp_host,200);
        $accvip_arr[] = trim($infovip);
    }
	fclose($fp_host);
    
    if(!in_array($acclic, $accvip_arr)) {
        $error_vip = 1;
    }
} else {
    $error_vip = 1;
}

   
if($error_vip == 1) {
    $message = "Chỉ dịch vụ nhận hỗ trợ kỹ thuật từ NetBanBe mới được sử dụng chức năng này.";
    echo "
        <info>Error</info>
        <message>" . $message ."</message>
    ";
    exit();
}
?>