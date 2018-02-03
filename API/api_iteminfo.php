<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');

include('func_item.php');

$itemdata_arr = ItemDataArr();

$item = $_POST['item'];

$item_info = ItemInfo($itemdata_arr, $item);
$item_name = $item_info['name'] . ' +' . $item_info['level'];
if($item_info['exc_total'] > 0) {
    $item_name .= " (". $item_info['exc_total'] ." dòng HH)";
}

$iteminfo_arr = array(
    'item_name' =>  $item_name,
    'item_info' =>  $item_info['info'],
    'item_serial' =>  $item_info['serial'],
    'item_image'    =>  $item_info['image']
);

$iteminfo = serialize($iteminfo_arr);
echo "
    <info>OK</info>
    <iteminfo>" . $iteminfo ."</iteminfo>
";

?>