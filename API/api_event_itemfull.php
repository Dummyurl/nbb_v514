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

$action = $_POST['action'];

$data_send = $_POST['data_send'];
$data_send_arr = unserialize_safe($data_send);

$item = $data_send_arr['item_code'];
$warehouse1 = $data_send_arr['warehouse1'];

$item_slg_check = floor(strlen($item)/32);

$info = "OK";
$msg = "";

for($i=0; $i<$item_slg_check; $i++) {
    $item_code = substr($item, $i*32, 32);
    
    $item_getcode = GetCode($item_code);
    $item_info = ItemsData($itemdata_arr, $item_getcode['id'],$item_getcode['group'],$item_getcode['level']);
            
    $item_x = $item_info['x'];
    $item_y = $item_info['y'];

    $slot_accept = CheckSlot($itemdata_arr, $warehouse1,$item_x,$item_y);
    
    if($slot_accept == 0) {
        $info = "Error";
        $msg = "Hòm đồ không đủ chỗ chứa Item. Vui lòng dọn dẹp lại hòm đồ.";
        break;
    } else {
        $item_code = substr_replace($item_code, "FFFFFFFF", 6, 8);
        
        $warehouse1 = substr_replace($warehouse1, $item_code, ($slot_accept-1)*32, 32);
    }
}

echo "
    <info>$info</info>
    <msg>$msg</msg>
    <warehouse1>" . $warehouse1 ."</warehouse1>
";

?>