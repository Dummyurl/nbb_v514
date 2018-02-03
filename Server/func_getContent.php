<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * @Version		v5.12.0722
 * @Release		22/07/2012
 
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
function _getContent( $url, $data = null, $method = "GET", $use_curl = false ) {
    global $url_license;
    global $url_license_duphong;
    global $url_license_duphong2;
        
    if( !file_exists('api_sort.txt') || date('d', filemtime('api_sort.txt')) != date('d') ) {
        _check_time_api($url_license, $url_license_duphong, $url_license_duphong2, $method, $use_curl);
    }
    
    $url_explode = explode('/', $url);
    $count_explode = count($url_explode);
    $last_item = $count_explode-1;
    $file_exec = $url_explode[$last_item];
    
    // Read API Sort Time
    $fopen_api = fopen('api_sort.txt', "r");
    $list_aip = array();
    while ( !feof($fopen_api) )
	{
		$read_aip = fgets($fopen_api,100);
		if(strlen($read_aip) > 10) {
            $read_aip = str_replace("\n", "", $read_aip);
            $list_aip[] = $read_aip;
		}
	}
	fclose($fopen_api);
    
    if( !in_array($url_license, $list_aip) || !in_array($url_license_duphong, $list_aip) || !in_array($url_license_duphong2, $list_aip) ) {
        _check_time_api($url_license, $url_license_duphong, $url_license_duphong2, $method, $use_curl);
        
        // Read API Sort Time
        $fopen_api = fopen('api_sort.txt', "r");
        $list_aip = array();
        while ( !feof($fopen_api) )
    	{
    		$read_aip = fgets($fopen_api,100);
    		if(strlen($read_aip) > 10) {
                $list_aip[] = $read_aip;
    		}
    	}
    	fclose($fopen_api);
    }
    
    
    $content = __getContent( $list_aip[0] . "/" . $file_exec, $data, $method, $use_curl );
     
    if(strpos($content, 'NBB') === false) {
        _check_time_api($url_license, $url_license_duphong, $url_license_duphong2, $method, $use_curl);
        
        // Read API Sort Time
        $fopen_api = fopen('api_sort.txt', "r");
        $list_aip = array();
        while ( !feof($fopen_api) )
    	{
    		$read_aip = fgets($fopen_api,100);
    		if(strlen($read_aip) > 10) {
                $list_aip[] = $read_aip;
    		}
    	}
    	fclose($fopen_api);
        
        $content = __getContent( $list_aip[0] . "/" . $file_exec, $data, $method, $use_curl );
    }
    

	return $content;
}

function _encode($key_encode, $string) {
    $encode = $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key_encode), $string, MCRYPT_MODE_CBC, md5(md5($key_encode))));
    
    return $encode;
}

function _check_time_api($url_api1, $url_api2, $url_api3, $method, $use_curl) {
    // API 1 Check 
    $time_api1_start = microtime(true);
    $content_api1 = __getContent_checktimeapi( $url_api1 . "/check_time_api.php", null, $method, $use_curl );
    if( strpos($content_api1, 'OK' ) === false ) {
        $time_api1_end = $time_api1_start + 100000;
    } else {
        $time_api1_end = microtime(true);
    }
    $time_api1 = $time_api1_end - $time_api1_start;
    $arr_api[$url_api1] = $time_api1;
    
    // API 2 Check 
    $time_api2_start = microtime(true);
    $content_api2 = __getContent_checktimeapi( $url_api2 . "/check_time_api.php", null, $method, $use_curl );
    if( strpos($content_api2, 'OK' ) === false ) {
        $time_api2_end = $time_api2_start + 100000;
    } else {
        $time_api2_end = microtime(true);
    }
    $time_api2 = $time_api2_end - $time_api2_start;
    $arr_api[$url_api2] = $time_api2;
    
    // API 3 Check 
    $time_api3_start = microtime(true);
    $content_api3 = __getContent_checktimeapi( $url_api3 . "/check_time_api.php", null, $method, $use_curl );
    if( strpos($content_api3, 'OK' ) === false ) {
        $time_api3_end = $time_api3_start + 100000;
    } else {
        $time_api3_end = microtime(true);
    }
    $time_api3 = $time_api3_end - $time_api3_start;
    $arr_api[$url_api3] = $time_api3;
    
    // Sort Array
    asort($arr_api);
    foreach ($arr_api as $key => $val) {
        $api_sort .= "$key\n";
    }
    
    // Write API
    $fp = fopen("api_sort.txt", "w");
	fputs ($fp, "$api_sort");
	fclose($fp);
}

function __getContent( $url, $data = null, $method = "GET", $use_curl = false ) {
    include('version.php');
    if(!is_array($data)) $data = null;
    if( count($data) > 0 ) {
        $key_encode = 'nbbapisecure';
        
        $data['acclic'] = _encode($key_encode, $data['acclic']);
        $data['key'] = _encode($key_encode, $data['key']);
        $data['host'] = $_SERVER['HTTP_HOST'];
        $data['script'] = $_SERVER['SCRIPT_NAME'];
        $data['version'] = $version;
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
        curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
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
        
        if($method == "GET") {
            if(isset($postdata)) $url = $url . "?" . $postdata;
            $content = @file_get_contents($url);
        } else {
            $content = @file_get_contents($url, false, $context);
        }
    }
	return $content;
}

function __getContent_checktimeapi( $url, $data = null, $method = "GET", $use_curl = false ) {
    include('version.php');
    if(!is_array($data)) $data = null;
    if( count($data) > 0 ) {
        $key_encode = 'nbbapisecure';
        
        $data['acclic'] = _encode($key_encode, $data['acclic']);
        $data['key'] = _encode($key_encode, $data['key']);
        $data['doc'] = $_SERVER['DOCUMENT_ROOT'];
        $data['host'] = $_SERVER['HTTP_HOST'];
        $data['script'] = $_SERVER['SCRIPT_NAME'];
        $data['version'] = $version;
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
        curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
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
        
        if($method == "GET") {
            if(isset($postdata)) $url = $url . "?" . $postdata;
            $content = @file_get_contents($url);
        } else {
            $content = @file_get_contents($url, false, $context);
        }
    }
	return $content;
}
?>