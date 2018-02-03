<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */
define('NetNWEB',true);

include('includes/function.php');
include('config/config_sync.php');

$ip_send = get_ip();
$ip_sv = gethostbyname($sv_noip);

if(!isset($sv_noip) || (isset($sv_noip) && ($ip_send == $ip_sv))) {
    $err_flag = false;
    
    if(!is_dir('config')) {
        echo '<error>2</error>';
        $err_flag = true;
    } elseif(!is_writable('config')) { 
        echo "<error>3</error>"; 
        $err_flag = true;
    } else {
        if ($folder_read = opendir('config')) {
        	$write_flag = true;
            while ($item = readdir($folder_read)) {
        		if ($item != "." && $item != "..") {
            		//Is File
            		if ( is_file('config'."/".$item) ) {
                        if(!is_writable('config'."/".$item)) {
                           $write_flag = false; 
                        }
        			}
        		}
        	}
            closedir($folder_read);
            unset($item);
            
            if($write_flag === false) {
                echo "<error>4</error>";
                $err_flag = true;
            }
        }
    }
    
    if($err_flag === false) {
        $file_sync = $_POST['file_sync'];   $file_sync = stripcslashes($file_sync);
        $data_sync = $_POST['data_sync'];   
            if( strpos($data_sync, '{\"') !== false || strpos($data_sync, "\'") !== false || strpos($data_sync, '\"') !== false ) {
                $data_sync = stripcslashes($data_sync);
            }
            
        
        if ( is_file($file_sync) ) {
            $fput = fopen($file_sync, "w");
            fwrite($fput, $data_sync);
            fclose($fput);
            
            echo '<success>OK</success>';
        } else {
            echo '<error>8</error>';
        }
    }
} else {
    echo '<error>9</error>';
}

?>