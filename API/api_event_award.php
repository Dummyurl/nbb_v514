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
	case 'award_add':
        $item = $_POST['item'];
        $item_arr = unserialize_safe($item);
        $item_slg = count($item_arr);
        
        $data_arr = array();
        for($i=0; $i<$item_slg; $i++) {
            $item_info = ItemInfo($itemdata_arr, $item_arr[$i]);
            $data_arr[] = array(
                'item_code'  =>  $item_arr[$i],
                'item_name'  =>  $item_info['name'],
                'item_info'  =>  $item_info['info'],
                'item_img'   =>  $item_info['image']
            );
        }
    
        $data = serialize($data_arr);
        echo "
            <info>OK</info>
            <data>" . $data ."</data>
        ";
    break;
    
       
    case 'award_receive':
        $data_send = $_POST['data_send'];
        $data_send_arr = unserialize_safe($data_send);
        $item = $data_send_arr['item_code'];
        $item_slg = $data_send_arr['item_slg'];
        $seri = $data_send_arr['seri'];
        $seri_block = $data_send_arr['seri_block'];
        
        $warehouse1 = $data_send_arr['warehouse1'];
        
        $item_getcode = GetCode($data_send_arr['item_code']);
        $item_info = ItemsData($itemdata_arr, $item_getcode['id'],$item_getcode['group'],$item_getcode['level']);
                
        $item_x = $item_info['x'];
        $item_y = $item_info['y'];
        
        $info = "OK";
        $msg = "";
        for($i=0; $i<$item_slg; $i++) {
            $slot_accept = CheckSlot($itemdata_arr, $warehouse1,$item_x,$item_y);
            
            if($slot_accept == 0) {
                $info = "Error";
                $msg = "Hòm đồ không đủ chỗ chứa Item. Vui lòng dọn dẹp lại hòm đồ.";
                break;
            } else {
                if($seri_block != 1) {
                    $item = substr_replace($item, $seri[$i], 6, 8);
                }
                
                $warehouse1 = substr_replace($warehouse1, $item, ($slot_accept-1)*32, 32);
            }
        }
        
        echo "
            <info>$info</info>
            <msg>$msg</msg>
            <warehouse1>" . $warehouse1 ."</warehouse1>
        ";
    break;
}

?>