<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
$maxline = 59;

function _utf8_to_ascii($string){
        if(!$string) return false;
        $unicode = array(
            'a' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'Đ|đ',
            'e' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'Í|Ì|Ỉ|Ĩ|Ị|í|ì|ỉ|ĩ|ị',
            'o' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ|ý|ỳ|ỷ|ỹ|ỵ'
        );
        foreach($unicode as $nonUnicode=>$uni) $string = preg_replace("/($uni)/i",$nonUnicode,$string);
    return $string;
}

function _ascii2hex($ascii) {
	//$ascii = utf8_to_ascii($ascii);
    $hex = '';
	for ($i = 0; $i < strlen($ascii); $i++) {
		$byte = strtoupper(dechex(ord($ascii{$i})));
		$byte = str_repeat('0', 2 - strlen($byte)).$byte;
		$hex.=$byte." ";
	}
	$hex=str_replace(" ", "", $hex);
	return $hex;
}

function _hex2ascii($hex){
	$ascii='';
	$hex=str_replace(" ", "", $hex);
	for($i=0; $i<strlen($hex); $i=$i+2) {
		$ascii.=chr(hexdec(substr($hex, $i, 2)));
	}
	return($ascii);
}

function _int_int_divide($x, $y) {
//Returns the integer division of $x/$y. 
    if ($x == 0) return 0;
    if ($y == 0) return FALSE;
    return ($x % $y >= $y / 2) ? (($x - ($x % $y)) / $y) + 1 : ($x - ($x % $y)) / $y;
}

function _string_explode($str, $len) {
    $str = str_replace('  ', ' ', $str);
    $str_explode = explode(' ', $str);
    $str_explode_total = count($str_explode);
    
    $str_arr = array();
    $str_i = 0;
    for($i=0; $i<$str_explode_total; ++$i) {
        if(strlen($str_arr[$str_i]) == 0) {
            $str_arr[$str_i] = $str_explode[$i];
        }
        elseif(strlen($str_arr[$str_i] . ' ' . $str_explode[$i]) < $len) {
            $str_arr[$str_i] .= ' ' . $str_explode[$i];
        } else {
            ++$str_i;
            $str_arr[$str_i] = $str_explode[$i];
        }
    }
    
    return $str_arr;
}

function _create_msg($msg)
{  
    $header = '';
    $header .= _hex2ascii("C144A10024000000");   // Starting header of the message
    
    $msglength = strlen($msg);
    
    if ($msglength < 34 && $msglength != 0) {	// Starting calculations to divide the message box so the message looks centerd
        $divisor = (34 - $msglength);
        $start_space = _int_int_divide($divisor , 2);
        
        for ($i=0;$i<=$start_space;$i++) {
        	$header .= " ";
        }
        $header .= $msg;   // Insert the message in the packet
        		
    	for ($j=0;$j<=($divisor-$start_space);$j++) {
    	   $header .= " ";
    	}
    } else {						// If the message is longer that 64 chars no need for spaces
    	$header .= $msg;   // Insert the message in the packet if msg > 34
    }

    $header .= _hex2ascii("00BED3410000F8BBB90400000000FCBBB904A4FF1A06F8F04100FFFFFFFF"); // Remainding header
    
    return $header;
}

// Thuc hien chuc nang
$mess_send = $_POST['mess_send'];
    $mess_send_arr = _string_explode($mess_send, $maxline);
    
    $mess_send_total = count($mess_send_arr);
    for($i=0; $i<$mess_send_total; ++$i) {
        $mess_receive = _create_msg($mess_send_arr[$i]);
        $mess_receive_str .= "<mess_receive>". $mess_receive ."</mess_receive>";
    }
    
    echo "<info>OK</info>";
    echo $mess_receive_str;

?>