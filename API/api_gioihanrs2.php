<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
include('request_count.php');


// Thuc hien chuc nang
$char_in_top = $_POST['char_in_top'];           $char_in_top = abs(intval($char_in_top));
$gioihanrs_top1 = $_POST['gioihanrs_top1'];     $gioihanrs_top1 = abs(intval($gioihanrs_top1));
$gioihanrs_top2 = $_POST['gioihanrs_top2'];     $gioihanrs_top2 = abs(intval($gioihanrs_top2));
$gioihanrs_top3 = $_POST['gioihanrs_top3'];     $gioihanrs_top3 = abs(intval($gioihanrs_top3));
$gioihanrs_top4 = $_POST['gioihanrs_top4'];     $gioihanrs_top4 = abs(intval($gioihanrs_top4));
$gioihanrs_top10 = $_POST['gioihanrs_top10'];     $gioihanrs_top10 = abs(intval($gioihanrs_top10));
$gioihanrs_top20 = $_POST['gioihanrs_top20'];     $gioihanrs_top20 = abs(intval($gioihanrs_top20));
$gioihanrs_top30 = $_POST['gioihanrs_top30'];     $gioihanrs_top30 = abs(intval($gioihanrs_top30));
$gioihanrs_top40 = $_POST['gioihanrs_top40'];     $gioihanrs_top40 = abs(intval($gioihanrs_top40));
$gioihanrs_top50 = $_POST['gioihanrs_top50'];     $gioihanrs_top50 = abs(intval($gioihanrs_top50));
$gioihanrs_other = $_POST['gioihanrs_other'];     $gioihanrs_other = abs(intval($gioihanrs_other));
$overrs_sat_extra = $_POST['overrs_sat_extra'];     $overrs_sat_extra = abs(intval($overrs_sat_extra));
$overrs_sun_extra = $_POST['overrs_sun_extra'];     $overrs_sun_extra = abs(intval($overrs_sun_extra));
$dayofweek = $_POST['dayofweek'];     $dayofweek = abs(intval($dayofweek));


if($char_in_top == 1) $gioihanrs = $gioihanrs_top1;
elseif($char_in_top == 2) $gioihanrs = $gioihanrs_top2;
elseif($char_in_top == 3) $gioihanrs = $gioihanrs_top3;
elseif($char_in_top == 4) $gioihanrs = $gioihanrs_top4;
elseif($char_in_top >4 && $char_in_top<=10) $gioihanrs = $gioihanrs_top10;
elseif($char_in_top >10 && $char_in_top<=20) $gioihanrs = $gioihanrs_top20;
elseif($char_in_top >20 && $char_in_top<=30) $gioihanrs = $gioihanrs_top30;
elseif($char_in_top >30 && $char_in_top<=40) $gioihanrs = $gioihanrs_top40;
elseif($char_in_top >40 && $char_in_top<=50) $gioihanrs = $gioihanrs_top50;
else $gioihanrs = $gioihanrs_other;

if($dayofweek == 0) {   // Chu nhat
    $gioihanrs = $gioihanrs + floor($gioihanrs * $overrs_sun_extra/100);
} else if($dayofweek == 6) {    // T7
    $gioihanrs = $gioihanrs + floor($gioihanrs * $overrs_sat_extra/100);
}

echo "
        <info>OK</info>
        <gioihanrs>" . $gioihanrs ."</gioihanrs>
    ";

?>