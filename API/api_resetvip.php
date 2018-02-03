<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
include('request_count.php');

// Thuc hien chuc nang
$tiente = $_POST['tiente'];

if ($tiente == 'gcoin') {
    $gcoinnew = $_POST['gcoinnew'];
    $gcoin_km = $_POST['gcoin_km'];
    $gcoin_rs = $_POST['gcoin_rs'];
    
    if($gcoin_km >= $gcoin_rs) $gcoin_km = $gcoin_km - $gcoin_rs;
    else {
        $gcoinnew = $gcoinnew - ($gcoin_rs - $gcoin_km);
        $gcoin_km = 0;
    }
    
    echo "
        <info>OK</info>
        <gcoinnew>" . $gcoinnew ."</gcoinnew>
        <gcoin_km>" . $gcoin_km ."</gcoin_km>
    ";
} else {
    $gcoin_reset_vip = $_POST['gcoin_reset_vip'];
    $vpoint_extra = $_POST['vpoint_extra'];
    $vpointnew = $_POST['vpointnew'];
    
    $vpoint_reset_vip = floor($gcoin_reset_vip*(1+($vpoint_extra/100)));
	if ( $vpointnew < ($vpoint_reset_vip) ) 
	{
		echo "
            <info>Error</info>
            <message>Không có đủ Vpoint yêu cầu Reset</message>
        ";
	}
	else {
	   $vpointnew = $vpointnew - $vpoint_reset_vip;
       echo "
            <info>OK</info>
            <vpointnew>" . $vpointnew ."</vpointnew>
        ";
	}
}
?>