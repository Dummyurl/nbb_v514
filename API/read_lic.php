<?php

/**
 * @author NetBanBe
 * @copyright 2014
 */

include('config.php');
include('function.php');

$licget_arr = _readlic($file_licnweb);
$urlsv_request_arr = _readlic("urlsv_count.txt");


$lic_arr = array();
foreach($licget_arr as $lic_key => $val) {
    
    $request_count = count($urlsv_request_arr[$lic_key]);
    if($request_count > 0) {
        $lic_arr[$lic_key]['noip'] = $licget_arr[$lic_key]['noip'];
        $lic_arr[$lic_key]['hsd'] = date('d/m/Y H:i', $licget_arr[$lic_key]['hsd']);
        foreach($urlsv_request_arr[$lic_key] as $k => $v) {
            $lic_arr[$lic_key]['url_sv_count'][$k] = $licget_arr[$lic_key]['url_sv'][$k] ." : ". $urlsv_request_arr[$lic_key][$k];
        }
    }
}

echo "<pre>";
print_r($lic_arr);
echo "</pre>";

?>