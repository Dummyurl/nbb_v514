<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

include_once('config/config_sync.php');
function _getContent_uncheck( $url, $data = null, $method = "GET", $use_curl = false ) {
    $content = '';
    
    if(!is_array($data)) $data = null;
    if( count($data) > 0 ) {
        $postdata = urldecode(http_build_query($data, '', '&'));
    }
    else $postdata = "";
    if($method != "POST") $method = "GET";
    
    if ( $use_curl === true ) {
        $ch = curl_init();
        if($method == "POST") {
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        } else {
            curl_setopt($ch, CURLOPT_URL,$url . "?" . $postdata);
        }
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    	$content = curl_exec($ch);
    	curl_close($ch);
    } else {
        $opts = array(
            'http' => array(
                'method'    =>  $method,
                'content'   =>  $postdata
            )
        );
        $context = stream_context_create($opts);
        
        if($method == "GET" && $postdata) $url = $url . "?" . $postdata;
        $content = @file_get_contents($url, false, $context);
    }
    
	return $content;
}

if(isset($typeupdate) && $typeupdate == 2) {
        
    $getcontent_url = $server_url . "/update_info.php";
    $getcontent_data = array(
        'action'    =>  'get_flag',
        'passtransfer'    =>  $passtransfer
    ); 
    
    $update_info = _getContent_uncheck($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    $update_info_arr = json_decode($update_info, true);
    if(is_array($update_info_arr)) {
        foreach($update_info_arr as $file => $status) {
            if($status == 1 && file_exists(stripcslashes($file))) {
                $getcontent_url = $server_url . "/update_info.php";
                $getcontent_data = array(
                    'action'    =>  'get_content',
                    'file'  =>  $file,
                    'passtransfer'    =>  $passtransfer
                ); 
                
                $update_data = _getContent_uncheck($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                
                if(strrpos($update_data, '<?php') === false) {
                    
                } else {
                    $file_update = stripcslashes($file);
                    $fp = fopen($file_update, "w");  
                	@fputs ($fp, $update_data);  
                	fclose($fp);
                }
            }
        }
    }
    
}

?>