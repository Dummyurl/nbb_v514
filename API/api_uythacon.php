<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 5/10/2011
 * @WebSite http://netbanbe.net
 * @FileName api_uythacon.php
 */

include('checklic.php');

// Thuc hien chuc nang
$Map = $_POST['Map'];           $Map = abs(intval($Map));
$ToaDoX = $_POST['ToaDoX'];     $ToaDoX = abs(intval($ToaDoX));
$ToaDoY = $_POST['ToaDoY'];     $ToaDoY = abs(intval($ToaDoY));

if( ($Map == 0 && $ToaDoX>=95 && $ToaDoX<=175 && $ToaDoY>=90 && $ToaDoY<=165) || ($Map == 3 && $ToaDoX>=165 && $ToaDoX<=205 && $ToaDoY>=85 && $ToaDoY<=130) ) $accept_uythac = 1;
else $accept_uythac = 0;

echo "
        <info>OK</info>
        <accept_uythac>" . $accept_uythac ."</accept_uythac>
    ";
?>