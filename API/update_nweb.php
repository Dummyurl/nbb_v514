<?php

/**
 * @author NetBanBe
 * @copyright 2012
 */
include('config.php');
include('function.php');

$ip_send = fetch_ip();

if($ip_send == "123.30.168.68") {
    $pass_transfer = $_REQUEST['pass_transfer'];
    
    if($pass_transfer == $passtransfer) {
        $lic_arr = _readlic($file_licnweb);
        
        $acclic = $_REQUEST['acclic'];
        $keylic = $_REQUEST['keylic'];
        $noip = $_REQUEST['noip'];
        $hsd = $_REQUEST['hsd'];
        
        $lic_key = $acclic . $keylic;
        $lic_arr[$lic_key] = array(
            'noip'  =>  $noip,
            'hsd'   =>  $hsd
        );
        
        _writelic($file_licnweb, $lic_arr);
        
        echo "<info>OK</info>";
    } else {
        echo "Pass Transfer Wrong";
    }
} else {
    echo "IP Wrong : $ip_send";
}

?>