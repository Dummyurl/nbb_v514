<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
$no_item = 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF';

// Thuc hien chuc nang
$inventory2 = $_POST['inventory2'];
$event1_itemdrop1_code = $_POST['event1_itemdrop1_code'];
$event1_itemdrop2_code = $_POST['event1_itemdrop2_code'];
$event1_itemshop_code = $_POST['event1_itemshop_code'];

$item1 = 0;
$item2 = 0;
$itemshop = 0;

$item1_code1 = substr($event1_itemdrop1_code,0,4);
$item1_code2 = substr($event1_itemdrop1_code,18,1);

$item2_code1 = substr($event1_itemdrop2_code,0,4);
$item2_code2 = substr($event1_itemdrop2_code,18,1);

$event1_itemshop_code1 = substr($event1_itemshop_code,0,4);
$event1_itemshop_code2 = substr($event1_itemshop_code,18,1);

$inventory2_after = "";
for($x=0; $x<64; ++$x)
{
	$item = substr($inventory2,$x*32,32);
    if($item != $no_item) {
        $code = substr($item, 0, 4);
		$code2 = substr($item, 18, 1);
		if( ($code === $item1_code1) AND ($code2 === $item1_code2) ) {
            ++$item1;
            $item = $no_item;
		}
			
		if( ($code === $item2_code1) AND ($code2 === $item2_code2) ) {
            ++$item2;
            $item = $no_item;
		}
			
		if( ($code === $event1_itemshop_code1) AND ($code2 === $event1_itemshop_code2) ) {
            ++$itemshop;
            $item = $no_item;
		}
    }
		
    $inventory2_after .= $item;
}
    
    $data_arr = array(
        'item1' =>  $item1,
        'item2' =>  $item2,
        'itemshop'  =>  $itemshop,
        'inventory2_after'  =>  $inventory2_after
    );
    $data = serialize($data_arr);
    
echo "
    <info>OK</info>
    <data>" . $data ."</data>
";


?>