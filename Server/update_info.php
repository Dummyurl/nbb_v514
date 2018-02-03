<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

	include_once("security.php");
include_once("config.php");
$flag_update_file = "flag_update.txt";

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    $fp = fopen($flag_update_file, "r");
		$flag_update = fgets($fp);
	fclose($fp);
    $flag_update_arr = json_decode($flag_update, true);
    if(!is_array($flag_update_arr)) $flag_update_arr = array();
    
    $action = $_POST['action'];
    switch ($action){ 
    	case 'get_content':
            $file = $_POST['file'];
            $file_config = stripcslashes($file);
            
            $file_config_content = "";
            $fp = fopen($file_config, "r");
        		while (!feof($fp)) {
            		$file_config_content .= fgets($fp) . "\n";
            	}
        	fclose($fp);
            echo $file_config_content;
            
            unset($flag_update_arr[$ipget][$file]);
            $flag_update_new = json_encode($flag_update_arr);
            $fp = fopen($flag_update_file, "w");  
        	@fputs ($fp, $flag_update_new);  
        	fclose($fp);
    	break;
    
    	default :
            if(count($flag_update_arr[$ipget]) > 0) {
                $list_update = json_encode($flag_update_arr[$ipget]);
            } else {
                $list_update = "";
            }
            
            echo $list_update;
    }
}

?>