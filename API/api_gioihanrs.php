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
$gioihanrs_top10 = $_POST['gioihanrs_top10'];     $gioihanrs_top10 = abs(intval($gioihanrs_top10));
$gioihanrs_top20 = $_POST['gioihanrs_top20'];     $gioihanrs_top20 = abs(intval($gioihanrs_top20));
$gioihanrs_top30 = $_POST['gioihanrs_top30'];     $gioihanrs_top30 = abs(intval($gioihanrs_top30));
$gioihanrs_top40 = $_POST['gioihanrs_top40'];     $gioihanrs_top40 = abs(intval($gioihanrs_top40));
$gioihanrs_top50 = $_POST['gioihanrs_top50'];     $gioihanrs_top50 = abs(intval($gioihanrs_top50));
$gioihanrs_other = $_POST['gioihanrs_other'];     $gioihanrs_other = abs(intval($gioihanrs_other));

if($char_in_top >0 && $char_in_top<=10) $gioihanrs = $gioihanrs_top10;
elseif($char_in_top >10 && $char_in_top<=20) $gioihanrs = $gioihanrs_top20;
elseif($char_in_top >20 && $char_in_top<=30) $gioihanrs = $gioihanrs_top30;
elseif($char_in_top >30 && $char_in_top<=40) $gioihanrs = $gioihanrs_top40;
elseif($char_in_top >40 && $char_in_top<=50) $gioihanrs = $gioihanrs_top50;
else $gioihanrs = $gioihanrs_other;

echo "
        <info>OK</info>
        <gioihanrs>" . $gioihanrs ."</gioihanrs>
    ";

?>