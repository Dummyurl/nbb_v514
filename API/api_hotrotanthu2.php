<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');


// Thuc hien chuc nang

$level = $_POST['level'];     $level = abs(intval($level));
$char_in_top = $_POST['char_in_top'];     $char_in_top = abs(intval($char_in_top));
$top2_rsredure = $_POST['top2_rsredure'];     $top2_rsredure = abs(intval($top2_rsredure));
$top3_rsredure = $_POST['top3_rsredure'];     $top3_rsredure = abs(intval($top3_rsredure));
$top4_rsredure = $_POST['top4_rsredure'];     $top4_rsredure = abs(intval($top4_rsredure));
$top10_rsredure = $_POST['top10_rsredure'];     $top10_rsredure = abs(intval($top10_rsredure));
$top20_rsredure = $_POST['top20_rsredure'];     $top20_rsredure = abs(intval($top20_rsredure));
$top30_rsredure = $_POST['top30_rsredure'];     $top30_rsredure = abs(intval($top30_rsredure));
$top40_rsredure = $_POST['top40_rsredure'];     $top40_rsredure = abs(intval($top40_rsredure));
$top50_rsredure = $_POST['top50_rsredure'];     $top50_rsredure = abs(intval($top50_rsredure));
$top50_over_rsredure = $_POST['top50_over_rsredure'];     $top50_over_rsredure = abs(intval($top50_over_rsredure));

if($char_in_top == 1) {
    $level = $level;
} elseif($char_in_top == 2) {
    $level = $level - $top2_rsredure;
} elseif($char_in_top == 3) {
    $level = $level - $top3_rsredure;
} elseif($char_in_top == 4) {
    $level = $level - $top4_rsredure;
} elseif($char_in_top >= 5 && $char_in_top <= 10) {
    $level = $level - $top10_rsredure;
} elseif($char_in_top >= 11 && $char_in_top <= 20) {
    $level = $level - $top20_rsredure;
} elseif($char_in_top >= 21 && $char_in_top <= 30) {
    $level = $level - $top30_rsredure;
} elseif($char_in_top >= 31 && $char_in_top <= 40) {
    $level = $level - $top40_rsredure;
} elseif($char_in_top >= 41 && $char_in_top <= 50) {
    $level = $level - $top50_rsredure;
} else {
    $level = $level - $top50_over_rsredure;
}

echo "
        <info>OK</info>
        <level>" . $level ."</level>
    ";

?>