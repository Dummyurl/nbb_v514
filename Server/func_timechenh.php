<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

$timestamp = _time();
$day = date("d",$timestamp);
$month = date("m",$timestamp);
$year = date("Y",$timestamp);
function _time() {
    $time_chenh = 0*24*60*60;
    $time_now = time() + $time_chenh;
    return $time_now;
}

?>