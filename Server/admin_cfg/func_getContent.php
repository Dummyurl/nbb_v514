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
 
function _getContent_sync( $url, $data = null, $method = "GET", $use_curl = false ) {
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
    	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
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

?>