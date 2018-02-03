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

    switch ($action){ 
    	case 'regnew_list':
            $inventory_send = $_POST['inventory_send'];
            $event_epitem_exlmin_begin = $_POST['event_epitem_exlmin_begin'];
            $event_epitem_exlmax_begin = $_POST['event_epitem_exlmax_begin'];
            $event_epitem_lvlmin_begin = $_POST['event_epitem_lvlmin_begin'];
            $event_epitem_lvlmax_begin = $_POST['event_epitem_lvlmax_begin'];
            
            $listitem_arr = array();
            
            $inventory_send_itemtotal = floor(strlen($inventory_send)/32);
            for($i=0; $i<$inventory_send_itemtotal; ++$i) {
                $item = substr($inventory_send,$i*32,32);
                if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                    $item_info = ItemInfo($itemdata_arr, $item);
                    if($item_info['exc_total'] >= $event_epitem_exlmin_begin && $item_info['exc_total'] <= $event_epitem_exlmax_begin && $item_info['level'] >= $event_epitem_lvlmin_begin && $item_info['level'] <= $event_epitem_lvlmax_begin) {
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
        
        case 'regnew_item':
            $serial = $_POST['serial'];
            $inventory_send = $_POST['inventory_send'];
            $event_epitem_exlmin_begin = $_POST['event_epitem_exlmin_begin'];
            $event_epitem_exlmax_begin = $_POST['event_epitem_exlmax_begin'];
            $event_epitem_lvlmin_begin = $_POST['event_epitem_lvlmin_begin'];
            $event_epitem_lvlmax_begin = $_POST['event_epitem_lvlmax_begin'];
            
            $msg = "Item không hợp lệ";
            $inventory_send_itemtotal = floor(strlen($inventory_send)/32);
            for($i=0; $i<$inventory_send_itemtotal; ++$i) {
                $item = substr($inventory_send,$i*32,32);
                if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                    $item_info = ItemInfo($itemdata_arr, $item);
                    if($item_info['serial'] == $serial && $item_info['exc_total'] >= $event_epitem_exlmin_begin && $item_info['exc_total'] <= $event_epitem_exlmax_begin && $item_info['level'] >= $event_epitem_lvlmin_begin && $item_info['level'] <= $event_epitem_lvlmax_begin) {
                        $msg = "OK";
                        break;
                    }
                }
            }
            
            $data_arr = array(
                'msg'   =>  $msg,
                'infoitem'  =>  $item_info['info'],
                'itemcode'  =>  $item_info['item_code'],
                'lvl'   =>  $item_info['level'],
                'image' =>  $item_info['image']
            );
            $data = serialize($data_arr);
            
            echo "
                <info>OK</info>
                <data>" . $data ."</data>
            ";
        break;
        
        case 'update':
            $serial = $_POST['serial'];
            $inventory_send = $_POST['inventory_send'];
            $event_epitem_exlmin_end = $_POST['event_epitem_exlmin_end'];
            $event_epitem_exlmax_end = $_POST['event_epitem_exlmax_end'];
            $event_epitem_lvlmin_end = $_POST['event_epitem_lvlmin_end'];
            $event_epitem_lvlmax_end = $_POST['event_epitem_lvlmax_end'];
            
            $inventory_send_itemtotal = floor(strlen($inventory_send)/32);
            
            $msg = "Item không nằm trên nhân vật";
            $iteminfo = "";
            $itemlv = "";
            $itemname = "";
            $item_totalexc = "";
            
            for($i=0; $i<$inventory_send_itemtotal; ++$i) {
                $item = substr($inventory_send,$i*32,32);
                if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                    $item_info = ItemInfo($itemdata_arr, $item);
                    
                    if($item_info['serial'] == $serial) {
                        if($item_info['exc_total'] >= $event_epitem_exlmin_end && $item_info['exc_total'] <= $event_epitem_exlmax_end && $item_info['level'] >= $event_epitem_lvlmin_end && $item_info['level'] <= $event_epitem_lvlmax_end) {
                            $msg = "OK";
                            $iteminfo = $item_info['info'];
                            $itemlv = $item_info['level'];
                            $itemname = $item_info['name'];
                            $item_totalexc = $item_info['exc_total'];
                            break;
                        } else {
                            $msg = "Item chưa đủ điều kiện hoàn thành";
                            break;
                        }
                    }
                }
            }
            
            $data_arr = array(
                'msg'   =>  $msg,
                'infoitem'  =>  $iteminfo,
                'lvl'   =>  $itemlv,
                'itemname'  =>  $itemname,
                'item_totalexc'    =>  $item_totalexc
            );
            $data = serialize($data_arr);
            echo "
                <info>OK</info>
                <data>" . $data ."</data>
            ";
        break;
     }



?>