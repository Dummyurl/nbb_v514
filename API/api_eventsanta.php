<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 5/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
$no_item = 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF';

// Thuc hien chuc nang
$inventory2 = $_POST['inventory2'];
$event_item_code = $_POST['event_item_code'];

// API cu
$inventory = $_POST['inventory'];

// API Moi
if(strlen($inventory2) > 0) {
	$item_code1 = strtoupper(substr($event_item_code,0,4));
	$item_code2 = strtoupper(substr($event_item_code,18,1));
	
	$santa_ticket = 0;

	for($x=0; $x<64; ++$x)
	{
		$item = substr($inventory2,$x*32,32);
		$code = substr($item, 0, 4);
		$code2 = substr($item, 18, 1);
		if( ($code === $item_code1) AND ($code2 === $item_code2) )
			++$santa_ticket;
 	}
    
    echo "
        <info>OK</info>
        <santa_ticket>" . $santa_ticket ."</santa_ticket>
    ";
}

// API cu
elseif(strlen($inventory) > 0) {
    $inventory1 = substr($inventory,0,12*32);
    $inventory2 = substr($inventory,12*32,64*32);
    $inventory3 = substr($inventory,76*32,32*32);
    	
	$item_code1 = substr($event_item_code,0,4);
	$item_code2 = substr($event_item_code,18,1);
	
	$santa_ticket = 0;
    
    $inventory2_after = "";
	for($x=0; $x<64; ++$x)
	{
		$item = substr($inventory2,$x*32,32);
        if($item != $no_item) {
            $code = substr($item, 0, 4);
    		$code = strtoupper($code);
    		$code2 = substr($item, 18, 1);
    		$code2 = strtoupper($code2);
    		if( ($code === $item_code1) AND ($code2 === $item_code2) ) {
                ++$santa_ticket;
                $item = $no_item;
    		}
        }
		$inventory2_after .= $item;
 	}
        
    $inventory_after = $inventory1.$inventory2_after.$inventory3;
    
    echo "
        <info>OK</info>
        <santa_ticket>" . $santa_ticket ."</santa_ticket>
        <inventory_after>" . $inventory_after ."</inventory_after>
    ";
}


?>