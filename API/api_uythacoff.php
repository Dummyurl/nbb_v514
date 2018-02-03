<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 5/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');

// Thuc hien chuc nang
$phut_uythac = $_POST['phut_uythac'];           $phut_uythac = abs(intval($phut_uythac));
$uythacoff_price = $_POST['uythacoff_price'];   $uythacoff_price = abs(intval($uythacoff_price));
$gcoin_total = $_POST['gcoin_total'];           $gcoin_total = abs(intval($gcoin_total));
$phut_1point = $_POST['phut_1point'];           $phut_1point = abs(intval($phut_1point));
$gcoin_km = $_POST['gcoin_km'];                 $gcoin_km = abs(intval($gcoin_km));
$gcoinnew = $_POST['gcoinnew'];                 $gcoinnew = abs(intval($gcoinnew));
$PointUyThacCheck = $_POST['PointUyThacCheck']; $PointUyThacCheck = abs(intval($PointUyThacCheck));
$castleown_gcoin_reduce_percent = $_POST['castleown_gcoin_reduce_percent'];

$gcoin_uythac = $phut_uythac*$uythacoff_price;

$gcoin_castle_owner_before = 0;
$gcoin_reduce_notice = 0;

if($gcoin_total >= $gcoin_uythac)
{
	$uythac_point = floor($phut_uythac/$phut_1point);
	$phut_uythac = $uythac_point*$phut_1point;
	$gcoin_uythac = $phut_uythac*$uythacoff_price;
    
    if(isset($castleown_gcoin_reduce_percent) && $castleown_gcoin_reduce_percent > 0) {
        $gcoin_castle_owner_before = $gcoin_uythac;
        $gcoin_uythac = floor($gcoin_uythac*(100-$castleown_gcoin_reduce_percent)/100);
        $gcoin_reduce_notice = $gcoin_castle_owner_before - $gcoin_uythac;
    }
    
    if($gcoin_km >= $gcoin_uythac) {
        $gcoin_km = $gcoin_km - $gcoin_uythac;
        $step = 1;
    }
   else {
        $gcoinnew = $gcoinnew - ($gcoin_uythac - $gcoin_km);
        $gcoin_km = 0;
        $step = 2;
   }
}
else {
	$phut_uythac = floor( $gcoin_total/$uythacoff_price );
	$uythac_point = floor($phut_uythac/$phut_1point);
	$phut_uythac = $uythac_point*$phut_1point;
	$gcoin_uythac = $phut_uythac*$uythacoff_price;
    
    if(isset($castleown_gcoin_reduce_percent) && $castleown_gcoin_reduce_percent > 0) {
        $gcoin_castle_owner_before = $gcoin_uythac;
        $gcoin_uythac = floor($gcoin_uythac*(100-$castleown_gcoin_reduce_percent)/100);
        $gcoin_reduce_notice = $gcoin_castle_owner_before - $gcoin_uythac;
    }
    
	if($gcoin_km >= $gcoin_uythac) {
	  $gcoin_km = $gcoin_km - $gcoin_uythac;
      $step = 3;
	}
   else {
        $gcoinnew = $gcoinnew - ($gcoin_uythac - $gcoin_km);
        $gcoin_km = 0;
        $step = 4;
   }
}
$point_uythac_after = $PointUyThacCheck + $uythac_point;

    $data_arr = array(
        'point_uythac_after'    =>  $point_uythac_after,
        'gcoinnew'  =>  $gcoinnew,
        'gcoin_km'  =>  $gcoin_km,
        'uythac_point'  =>  $uythac_point,
        'gcoin_uythac'  =>  $gcoin_uythac,
        'gcoin_castle_owner_before' =>  $gcoin_castle_owner_before,
        'gcoin_reduce_notice'   =>  $gcoin_reduce_notice
    );
    $data = serialize($data_arr);

echo "
        <info>OK</info>
        <data>" . $data ."</data>
    ";

?>