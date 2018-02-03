<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');

include_once('yahoostatus_func.php');

$passtransfer = $_GET['passtransfer'];
$hwid = $_GET['hwid'];



if($passtransfer == 'netbanbe') {
    $lic_info = _checklic($hwid);
    $PointAdd = $_GET['PointAdd'];
    $YahooStatus = $_GET['YahooStatus'];
    $YahooStatus_explode = explode('_', $YahooStatus);
    $ym_rei = array();
    $ym_count = 0;
    foreach($YahooStatus_explode as $ymstatus_v) {
        $ym_count++;
        if($ym_count > 5 && $lic_info['lic'] === false) break;      // Khong phai LIC chi xu ly 5 Status
        $ym_arr = explode(",", $ymstatus_v);
        if($ym_arr[2] == 1) $ym_arr[1] = $ym_arr[1] + $PointAdd;
        $ym_rei[] = array(
            'yahoo' =>  $ym_arr[0],
            'point' =>  $ym_arr[1]
        );
    }
    
    $rec = "|OK|";
    foreach($ym_rei as $ym_rei_v) {
        $rec .= $ym_rei_v['yahoo'] . "," . $ym_rei_v['point'] . "|";
    }
    
    echo $rec;
} else {
    echo "Request Error";
}

?>