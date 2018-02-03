<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');


// Thuc hien chuc nang
$capsudung = $_POST['capsudung'];           $capsudung = abs(intval($capsudung));
$Resetnow = $_POST['Resetnow'];     $Resetnow = abs(intval($Resetnow));
$Relifenow = $_POST['Relifenow'];     $Relifenow = abs(intval($Relifenow));
$level = $_POST['level'];     $level = abs(intval($level));

$cap1_reset_min = $_POST['cap1_reset_min'];     $cap1_reset_min = abs(intval($cap1_reset_min));
$cap1_reset_max = $_POST['cap1_reset_max'];     $cap1_reset_max = abs(intval($cap1_reset_max));
$cap1_relife_min = $_POST['cap1_relife_min'];     $cap1_relife_min = abs(intval($cap1_relife_min));
$cap1_relife_max = $_POST['cap1_relife_max'];     $cap1_relife_max = abs(intval($cap1_relife_max));
$cap1_levelgiam = $_POST['cap1_levelgiam'];     $cap1_levelgiam = abs(intval($cap1_levelgiam));

$cap2_reset_min = $_POST['cap2_reset_min'];     $cap2_reset_min = abs(intval($cap2_reset_min));
$cap2_reset_max = $_POST['cap2_reset_max'];     $cap2_reset_max = abs(intval($cap2_reset_max));
$cap2_relife_min = $_POST['cap2_relife_min'];     $cap2_relife_min = abs(intval($cap2_relife_min));
$cap2_relife_max = $_POST['cap2_relife_max'];     $cap2_relife_max = abs(intval($cap2_relife_max));
$cap2_levelgiam = $_POST['cap2_levelgiam'];     $cap2_levelgiam = abs(intval($cap2_levelgiam));

$cap3_reset_min = $_POST['cap3_reset_min'];     $cap3_reset_min = abs(intval($cap3_reset_min));
$cap3_reset_max = $_POST['cap3_reset_max'];     $cap3_reset_max = abs(intval($cap3_reset_max));
$cap3_relife_min = $_POST['cap3_relife_min'];     $cap3_relife_min = abs(intval($cap3_relife_min));
$cap3_relife_max = $_POST['cap3_relife_max'];     $cap3_relife_max = abs(intval($cap3_relife_max));
$cap3_levelgiam = $_POST['cap3_levelgiam'];     $cap3_levelgiam = abs(intval($cap3_levelgiam));

$cap4_reset_min = $_POST['cap4_reset_min'];     $cap4_reset_min = abs(intval($cap4_reset_min));
$cap4_reset_max = $_POST['cap4_reset_max'];     $cap4_reset_max = abs(intval($cap4_reset_max));
$cap4_relife_min = $_POST['cap4_relife_min'];     $cap4_relife_min = abs(intval($cap4_relife_min));
$cap4_relife_max = $_POST['cap4_relife_max'];     $cap4_relife_max = abs(intval($cap4_relife_max));
$cap4_levelgiam = $_POST['cap4_levelgiam'];     $cap4_levelgiam = abs(intval($cap4_levelgiam));

$cap5_reset_min = $_POST['cap5_reset_min'];     $cap5_reset_min = abs(intval($cap5_reset_min));
$cap5_reset_max = $_POST['cap5_reset_max'];     $cap5_reset_max = abs(intval($cap5_reset_max));
$cap5_relife_min = $_POST['cap5_relife_min'];     $cap5_relife_min = abs(intval($cap5_relife_min));
$cap5_relife_max = $_POST['cap5_relife_max'];     $cap5_relife_max = abs(intval($cap5_relife_max));
$cap5_levelgiam = $_POST['cap5_levelgiam'];     $cap5_levelgiam = abs(intval($cap5_levelgiam));

if( ($capsudung >= 1) && ($cap1_reset_min<=$Resetnow && $Resetnow<=$cap1_reset_max) && ($cap1_relife_min<=$Relifenow && $Relifenow<=$cap1_relife_max) ) {
	$level = $level - $cap1_levelgiam;
}
elseif( ($capsudung >= 2) && ($cap2_reset_min<=$Resetnow && $Resetnow<=$cap2_reset_max) && ($cap2_relife_min<=$Relifenow && $Relifenow<=$cap2_relife_max) ) {
	$level = $level - $cap2_levelgiam;
}
elseif( ($capsudung >= 3) && ($cap3_reset_min<=$Resetnow && $Resetnow<=$cap3_reset_max) && ($cap3_relife_min<=$Relifenow && $Relifenow<=$cap3_relife_max) ) {
	$level = $level - $cap3_levelgiam;
}
elseif( ($capsudung >= 4) && ($cap4_reset_min<=$Resetnow && $Resetnow<=$cap4_reset_max) && ($cap4_relife_min<=$Relifenow && $Relifenow<=$cap4_relife_max) ) {
	$level = $level - $cap4_levelgiam;
}
elseif( ($capsudung >= 5) && ($cap5_reset_min<=$Resetnow && $Resetnow<=$cap5_reset_max) && ($cap5_relife_min<=$Relifenow && $Relifenow<=$cap5_relife_max) ) {
	$level = $level - $cap5_levelgiam;
}

echo "
        <info>OK</info>
        <level>" . $level ."</level>
    ";

?>