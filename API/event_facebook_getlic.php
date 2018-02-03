<?php

/**
 * @author NetBanBe
 * @copyright 2014
 */

include('config.php');
include('function.php');

$acclic_receive = $_POST['licacc'];
$key_receive = $_POST['lickey'];

if(strlen($acclic_receive) > 0 && strlen($key_receive) > 0) {
    $lic_key = $acclic_receive . $key_receive;
    
    $lic_arr = _readlic($file_licnweb);
    
    if( isset($lic_arr[$lic_key]) ) {
        $hsd_time = $lic_arr[$lic_key]['hsd'];
        if($hsd_time > $timestamp) {
            echo "<nbb>OK<nbb>$hsd_time<nbb>";
        } else {
            echo "<nbb>OK<nbb>1<nbb>";
        }
        
    } else {
        echo "<nbb>OK<nbb>9<nbb>";
    }
} else {
    echo "Không có dữ liệu LIC NWebMU";
}

?>