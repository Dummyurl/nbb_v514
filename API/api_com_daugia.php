<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
include('request_count.php');

include('func_item.php');

$itemdata_arr = ItemDataArr();

$action = $_POST['action'];

switch ($action){ 
	case 'bid_list':
        $warehouse1 = $_POST['warehouse1'];
        
        $listitem_arr = array();
        
        $warehouse1_itemtotal = floor(strlen($warehouse1)/32);
        for($i=0; $i<$warehouse1_itemtotal; ++$i) {
            $item = substr($warehouse1,$i*32,32);
            if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                $item_info = ItemInfo($itemdata_arr, $item);
                $item_info['vitri'] = $i;
                
                if( hexdec($item_info['serial']) == 0 ) {
                    $item_info['item_spec'] = 1;    // Seri 0
                } else if (hexdec($item_info['serial']) < 4294967280) {
                    $item_info['item_spec'] = 0;
                } else if( hexdec($item_info['serial']) == 4294967280 ) {
                    $item_info['item_spec'] = 2;    // Item da bao ve
                } else {
                    $item_info['item_spec'] = 3;    // Item dac biet
                }
                        
                $listitem_arr[] = array(
                    'name'  =>  $item_info['name'],
                    'info'  =>  $item_info['info'],
                    'image' =>  $item_info['image'],
                    'item_code'    =>  $item_info['item_code'],
                    'vitri'    =>  $item_info['vitri'],
                    'item_spec' =>  $item_info['item_spec']
                );
            }
        }
    
        $listitem = serialize($listitem_arr);
        echo "
            <info>OK</info>
            <listitem>" . $listitem ."</listitem>
        ";
    break;
    
    case 'itembid_send':
        $warehouse1 = $_POST['warehouse1'];
        $vitri = $_POST['vitri'];
        $item_code = $_POST['item_code'];
        
        $no_item = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
        
        $data_arr = array();
        
        if(substr($warehouse1, $vitri*32, 32) != $item_code) {
            $info = "Error";
            $message = "Item đã bị thay đổi.";
        } else {
            $info = "OK";
            $message = "";
            $warehouse1_new = substr_replace($warehouse1, $no_item, $vitri*32, 32);
            $item_info = ItemInfo($itemdata_arr, $item_code);
            $data_arr = array(
                'warehouse1_new'    =>  $warehouse1_new,
                'item_name' =>  $item_info['name'],
                'item_info' =>  $item_info['info'],
                'item_image' =>  $item_info['image'],
                'item_group' =>  $item_info['item_group']
            );
        }
        
    
        $data = serialize($data_arr);
        echo "
            <info>$info</info>
            <message>$message</message>
            <data>" . $data ."</data>
        ";
    break;
    
    case 'reward':
        $data_send = $_POST['data_send'];
        $data_send_arr = unserialize_safe($data_send);
        
        $item_getcode = GetCode($data_send_arr['item_code']);
        $item_info = ItemsData($itemdata_arr, $item_getcode['id'],$item_getcode['group'],$item_getcode['level']);
                
        $item_x = $item_info['x'];
        $item_y = $item_info['y'];
        
        $slot_accept = CheckSlot($itemdata_arr, $data_send_arr['warehouse1'],$item_x,$item_y);
        
        $warehouse1_receive = "";
        if($slot_accept == 0) {
            $info = "Error";
            $msg = "Hòm đồ chung không đủ chỗ chứa Item. Vui lòng dọn dẹp lại hòm đồ chung.";
        } else {
            $info = "OK";
            $warehouse1_receive = substr_replace($data_send_arr['warehouse1'], $data_send_arr['item_code'], ($slot_accept-1)*32, 32);
        }
        
        
        echo "
            <info>$info</info>
            <msg>$msg</msg>
            <warehouse1>" . $warehouse1_receive ."</warehouse1>
        ";
    break;
}

?>