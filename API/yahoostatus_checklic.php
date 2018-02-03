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
    echo $lic_info['notice'];
} else {
    echo "Request Error";
}

?>