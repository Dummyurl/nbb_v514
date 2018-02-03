<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
if(isset($_POST['gift_slg'])) $gift_slg = abs(intval($_POST['gift_slg']));
else $gift_slg = 1;
$gifttime = substr(time(), -6);
    //Config
	$characters = 'abcdefghijklmnpqrstuvwxyz123456789';
	$random_string_length = 4;
	
    // Create GiftCode
    $giftcode_arr = array();
    for($gift_i = 1; $gift_i<= $gift_slg; $gift_i++) {
        $giftcode = "";
        for ($i = 0; $i < $random_string_length; $i++) { 
    		$giftcode .= $characters[rand(0, strlen($characters) - 1)]; 
     	}
        $gifttime++;
        $giftcode .= $gifttime;
        $giftcode_arr[] = strtoupper($giftcode);
    } 
     	
    
    echo "<info>OK</info>";
    if($gift_slg == 1) {
        echo "<giftcode>" . $giftcode_arr[0] ."</giftcode>";
    } else {
        $giftcode_encode = json_encode($giftcode_arr);
        echo "<giftcode>" . $giftcode_encode ."</giftcode>";
    }

?>