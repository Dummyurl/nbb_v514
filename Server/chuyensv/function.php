<?php

/**
 * @author NetBanBe
 * @copyright 2013
 */

function check_queryerror($query,$result) {
    if ($result === false) die("Query Error : $query");
}

function check_nv($account, $name) {
	global $db;
	$sql_nv_check_query = "SELECT * FROM Character WHERE AccountID = '$account' AND Name='$name'";
	$sql_nv_check_result = $db->Execute($sql_nv_check_query);
        check_queryerror($sql_nv_check_query, $sql_nv_check_result);
	$nv_check = $sql_nv_check_result->numrows();
	return $nv_check;
}

function _writelog($file, $logcontent) {
    $Date = date("h:i:sA, d/m/Y");  
	$fp = fopen($file, "a+");  
	fputs ($fp, "====================== Lúc: $Date ====================== \n $logcontent \n\n");
	fclose($fp);
}

?>