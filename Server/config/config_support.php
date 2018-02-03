<?php
$user_support = 0;      // 0: Khong Su dung he thong Support - 1 : Su dung he thong Support
$dbhost = "localhost";
$dbuser = "net_pm";
$dbpass = "phucmadata";
$dbname = "pm_support";

$time_now = time();
$time_now = $time_now - 0*60*60;

$quantri_support = '"admin","nhavy12","nhavy1102"';
$quantri_arr = array("admin", "nhavy12", "nhavy1102");

if ( $user_support == 1 )
{
    $conn = @mysql_connect($dbhost,$dbuser,$dbpass) or DIE("Can't not connect Database");
    @mysql_select_db($dbname,$conn) or DIE("Can't not select DB $dbname");
    
    function check_queryerror($query,$result) {
        if ($result === false) die("Query Error : $query <br /> Error: (" . mysql_errno() . ") " . mysql_error());
    }
}
?>