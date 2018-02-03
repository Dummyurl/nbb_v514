<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */



function _checklic($hwid) {
    $file_lic = "licyahoostatus/" . $hwid. ".txt";
    $lic = false;
    $notice = "";
    
    if( file_exists($file_lic) ) {
        // Read LIC
        $fp_host = fopen($file_lic, "r");
    	$infolic = fgets($fp_host);
    	fclose($fp_host);
        
        $infolic_explode = explode('|', $infolic);
        
        $hsd_time = $infolic_explode[1];
        $hsd_less = $hsd_time - time();
        $hsd_day = ceil($hsd_less/(24*60*60));
        
        if($hsd_day <= 0) {
            $notice = "Your LIC has expired. Let's extend the LIC.\nYour HWID: $hwid.\nPlease contact Yahoo 'nwebmu' to Register LIC.\nMessages stored in the clipboard.\nPlease paste in the NotePad to get HWID";
        } else {
            $lic = true;
            $notice = "okgaden";
        }
    } else {
        $notice = "Your HWID: $hwid.\n Please contact Yahoo 'nwebmu' to Register LIC.\nMessages stored in the clipboard.\nPlease paste in the NotePad to get HWID";
    }
    
    $lic_info = array(
        'lic'   =>  $lic,
        'notice'    =>  $notice
    );
    
    return $lic_info;
}

?>