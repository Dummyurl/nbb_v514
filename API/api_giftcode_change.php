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

// Thuc hien chuc nang
$item_read = stripcslashes($_POST['item_read']);
$item_read_arr = json_decode($item_read, true);
$warehouse1 = $_POST['warehouse1'];

$total_rate = 0;
$item_read_count = count($item_read_arr);
for($i=0; $i<$item_read_count; $i++) {
    $total_rate += $item_read_arr[$i]['rate'];
}

$item_choise_rate = rand(1, $total_rate);
$rate_item = 0;
for($i=0; $i<$item_read_count; $i++) {
    $item_read_arr[$i]['rate_min'] = $rate_item + 1;
    $rate_item += $item_read_arr[$i]['rate'];
    $item_read_arr[$i]['rate_max'] = $rate_item;
    if($item_choise_rate >= $item_read_arr[$i]['rate_min'] && $item_choise_rate <= $item_read_arr[$i]['rate_max']) {
        $item_choise_i = $i;
        $item_choise = $item_read_arr[$i]['code'];
        break;
    }
}

$info = "OK";
$msg = "";
$warehouse1_check = $warehouse1;
$item_choise_itemtotal = floor(strlen($item_choise)/32);
$item_gift_arr = array();

if(strlen($warehouse1) < 8*4*32) {
    $info = "Error";
    $msg = "Rương đồ chung chưa mở. Vui lòng vào nhân vật, mở Rương đồ chung rồi nhận lại.";
} else {
    for($i=0; $i<$item_choise_itemtotal; ++$i) {
        $item = substr($item_choise,$i*32,32);
        if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
            $item_getcode = GetCode($item);
            $item_info = ItemsData($itemdata_arr, $item_getcode['id'],$item_getcode['group'],$item_getcode['level']);
                    
            $item_x = $item_info['x'];
            $item_y = $item_info['y'];
            
            $slot_accept = CheckSlot($itemdata_arr, $warehouse1_check,$item_x,$item_y);
            
            if($slot_accept == 0) {
                $info = "Error";
                $msg = "Rương đồ chung không đủ chỗ chứa Item. Vui lòng dọn dẹp lại Rương đồ chung.";
                break;
            } else {
                $warehouse1_check = substr_replace($warehouse1_check, $item, ($slot_accept-1)*32, 32);
                $vitri = $slot_accept-1;
                $item_gift_arr[] = array(
                    'code'  =>  $item,
                    'vitri' =>  $vitri
                );
            }
        }
    }
}

    

    $item_gift = json_encode($item_gift_arr);
    echo "
        <info>$info</info>
        <msg>$msg</msg>
        <item_choise>$item_choise_i</item_choise>
        <item_gift>" . $item_gift ."</item_gift>
    ";

?>