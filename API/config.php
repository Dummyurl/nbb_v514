<?php

/**
 * @author NetBanBe
 * @copyright 2012
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time();

$passtransfer = "nwebpp";

$file_licnweb = "lic_nweb.txt";

$key_encode = 'nbbapisecure';

function _writelic($file, $lic_arr) {
	$lic_data = json_encode($lic_arr);
    
    $fp = fopen($file, "w");  
	fputs ($fp, $lic_data);
	fclose($fp);
}

function _readlic($file) {
	$fp_host = fopen($file, "r");
	$lic_data = fgets($fp_host);
	fclose($fp_host);
    
    if(strlen($lic_data) > 10) {
        $lic_arr = json_decode($lic_data, true);
    } else {
        $lic_arr = array();
    }
    
    return $lic_arr;
}
    

function _writelog($file, $logcontent) {
    $Date = date("h:i:sA, d/m/Y");  
	$fp = fopen($file, "a+");  
	fputs ($fp, "Lúc: $Date. $logcontent \n");
	fclose($fp);
}

?>