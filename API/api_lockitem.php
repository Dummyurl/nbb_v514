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
	case 'list':
        $inventory_send = $_POST['inventory_send'];
        
        $listitem_arr = array();
        
        $inventory_send_itemtotal = floor(strlen($inventory_send)/32);
        for($i=0; $i<$inventory_send_itemtotal; ++$i) {
            $item = substr($inventory_send,$i*32,32);
            if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                $item_info = ItemInfo($itemdata_arr, $item);
                $item_info['vitri'] = $i;
                if( $item_info['exc_anc'] > 0 || $item_info['socket'] == 1 ){
                    if( hexdec($item_info['serial']) == 0 ) {
                        $item_info['item_spec'] = 1;    // Seri 0
                        $listitem_arr[] = $item_info;
                    } else if (hexdec($item_info['serial']) < 4294967280) {
                        $item_info['item_spec'] = 0;
                        $listitem_arr[] = $item_info;
                    } else if( hexdec($item_info['serial']) == 4294967280 ) {
                        $item_info['item_spec'] = 2;    // Item da bao ve
                        $listitem_arr[] = $item_info;
                    } else {
                        $item_info['item_spec'] = 3;    // Item dac biet
                        $listitem_arr[] = $item_info;
                    }
                }
            }
        }
    
        $listitem = serialize($listitem_arr);
        echo "
            <info>OK</info>
            <listitem>" . $listitem ."</listitem>
        ";
    break;
    
    case 'lock':
        $serial = $_POST['serial'];
        $vitri = $_POST['vitri'];
        $inventory_send = $_POST['inventory_send'];
        $gcoin = $_POST['gcoin'];
        $gcoin_km = $_POST['gcoin_km'];
        $lockitem_gcoin = $_POST['lockitem_gcoin'];
        
        if($gcoin_km >= $lockitem_gcoin) $gcoin_km = $gcoin_km - $lockitem_gcoin;
        else {
            $gcoin = $gcoin - ($lockitem_gcoin - $gcoin_km);
            $gcoin_km = 0;
        }
        
        $item = substr($inventory_send,$vitri*32,32);
        $item_info = ItemInfo($itemdata_arr, $item);
        if($item_info['serial'] == $serial) {
            $item = substr_replace($item, 'FFFFFFF0', 6, 8);
            $inventory_receive = substr_replace($inventory_send, $item, $vitri*32, 32);
            $msg = "OK";
        } else {
            $inventory_receive = $inventory_send;
            $msg = "Vị trí Item đã bị thay đổi, vui lòng Load lại trang để đọc dữ liệu mới.";
        }
        
        $data_arr = array(
            'msg'   =>  $msg,
            'inventory_receive' =>  $inventory_receive,
            'item_lock' =>  $item_info,
            'gcoin_new' =>  $gcoin,
            'gcoinkm_new'   =>  $gcoin_km
        );
        $data = serialize($data_arr);
        echo "
            <info>OK</info>
            <data>". $data ."</data>
        ";
    break;
    
    case 'unlock':
        $vitri = $_POST['vitri'];
        $inventory_send = $_POST['inventory_send'];
        $serial_new = $_POST['serial_new'];
        $serial_new_len = strlen($serial_new);
        if($serial_new_len<8) {
            for($i=0; $i<(8-$serial_new_len); ++$i) {
                $serial_new = '0'. $serial_new;
            }
        }
        
        $item = substr($inventory_send,$vitri*32,32);
        $item_info = ItemInfo($itemdata_arr, $item);
        if($item_info['serial'] == 'FFFFFFF0') {
            $item = substr_replace($item, $serial_new, 6, 8);
            $inventory_receive = substr_replace($inventory_send, $item, $vitri*32, 32);
            $item_info['serial'] = $serial_new;
            $msg = "OK";
        } else {
            $inventory_receive = $inventory_send;
            $msg = "Vị trí Item đã bị thay đổi, vui lòng Load lại trang để đọc dữ liệu mới.";
        }
        
        $data_arr = array(
            'msg'   =>  $msg,
            'inventory_receive' =>  $inventory_receive,
            'item_unlock'   =>  $item_info
        );
        $data = serialize($data_arr);
        echo "
            <info>OK</info>
            <data>". $data ."</data>
        ";
    break;
}

?>