<?php

/**
 * @author NetBanBe
 * @copyright 2012
 */
 
$key_encode = 'nbbapisecure';

$lic_acc = "79mu";
$lic_key = "1341642499";

$lic_acc_encode = _encode($key_encode, $lic_acc);
$lic_key_encode = _encode($key_encode, $lic_key);

$lic_acc_decode = _decode($key_encode, $lic_acc_encode);
$lic_key_decode = _decode($key_encode, $lic_key_encode);

echo "LIC Acc Encode : ". $lic_acc_encode;
echo "<br />Key Encode : ". $lic_key_encode;

echo "<br /><br />LIC Acc Decode : ". $lic_acc_decode;
echo "<br />Key Decode : ". $lic_key_decode;



function _encode($key_encode, $string) {
    $encode = $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key_encode), $string, MCRYPT_MODE_CBC, md5(md5($key_encode))));
    
    return $encode;
}

function _decode($key_encode, $string) {
    $string = str_replace(" ", "+", $string);
    $decode = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key_encode), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key_encode))), "\0");
    return $decode;
}

?>