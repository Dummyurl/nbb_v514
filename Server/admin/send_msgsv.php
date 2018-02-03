<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

$mess_send = "Kiểm tra hệ thống";
$joinserver_port	= 20;

include('../config.php');
include('../function.php');
include_once('../config_license.php');
include_once('../func_getContent.php');
$getcontent_url = $url_license . "/api_sendmess.php";
$getcontent_data = array(
    'acclic'    =>  $acclic,
    'key'    =>  $key,
    
    'mess_send'    =>  $mess_send
); 

$reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

$info = read_TagName($reponse, 'info');
if ($info == "OK") {
    $mess_receive = read_TagName($reponse, 'mess_receive', 0);
    $mess_total = $mess_receive[0];
    
    for($i=1; $i<=$mess_total; $i++) {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($x = socket_connect($socket, '127.0.0.1', $joinserver_port))
        {
            socket_write($socket, $mess_receive[$i]);
        } else {
            socket_close($socket);
            break;
        }
        socket_close($socket);
    }
}

?>