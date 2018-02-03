<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 5/10/2011
 * @WebSite http://netbanbe.net
 * @FileName function
 */

function antiinject_query($value) {
    $value = stripslashes($value);
    $value = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    return $value;
}

function _checklic_domainsend($domain) {
    $ipdomain = _domain2ip($domain);
    $fetchip = fetch_ip();
    if($ipdomain == $fetchip) return true;
    else return false;
}

function _domain2ip($domain) {
    $ip = gethostbyname($domain);
    return $ip;
}

function unserialize_safe($serialized) {
    $serialized = stripslashes($serialized);
    // unserialize will return false for object declared with small cap o
    // as well as if there is any ws between O and :
    if (is_string($serialized) && strpos($serialized, "\0") === false) {
        if (strpos($serialized, 'O:') === false) {
            // the easy case, nothing to worry about
            // let unserialize do the job
            return @unserialize($serialized);
        } else if (!preg_match('/(^|;|{|})O:[0-9]+:"/', $serialized)) {
            // in case we did have a string with O: in it,
            // but it was not a true serialized object
            return @unserialize($serialized);
        }
    }
    return false;
}

function fetch_ip()
{
	# Enable X_FORWARDED_FOR IP matching?
	$do_check = 1;
	$addrs = array();

	if( $do_check )
	{
		foreach( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_f )
		{
			$x_f = trim($x_f);
			if( preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f) )
			{
				$addrs[] = $x_f;
			}
		}

		$addrs[] = $_SERVER['HTTP_CLIENT_IP'];
		$addrs[] = $_SERVER['HTTP_PROXY_USER'];
	}

	$addrs[] = $_SERVER['REMOTE_ADDR'];

	foreach( $addrs as $v )
	{
		if( $v )
		{
			preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $v, $match);
			$ip = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];

			if( $ip && $ip != '...' )
			{
				break;
			}
		}
	}

	if( ! $ip || $ip == '...' )
	{
		print_error("Không thể xác định địa chỉ IP của bạn.");
	}

	return $ip;
}

function _getContent( $url, $data = null, $method = "GET", $use_curl = false ) {
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
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
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