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
$changename_gcoin = $_POST['changename_gcoin'];    $changename_gcoin = abs(intval($changename_gcoin));
$gcoin_km = $_POST['gcoin_km'];           $gcoin_km = abs(intval($gcoin_km));
$gcoinnew = $_POST['gcoinnew'];     $gcoinnew = abs(intval($gcoinnew));

    if($gcoin_km >= $changename_gcoin) $gcoin_km = $gcoin_km - $changename_gcoin;
    else {
        $gcoinnew = $gcoinnew - ($changename_gcoin - $gcoin_km);
        $gcoin_km = 0;
    }
    
    $data_arr = array(
        'gcoinnew'  =>  $gcoinnew,
        'gcoin_km'  =>  $gcoin_km
    );
    
    $data = serialize($data_arr);
    
echo "
        <info>OK</info>
        <data>" . $data ."</data>
    ";

?>