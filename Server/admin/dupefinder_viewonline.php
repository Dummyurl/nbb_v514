<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

session_start();

include_once ("security.php");
include ('../config.php');

$online_query = "Select count(*) from Memb_Stat where ConnectStat='1'";
$online_result = $db->Execute($online_query);
$online_fetch = $online_result->FetchRow();
$online = $online_fetch[0];
echo $online;

?>