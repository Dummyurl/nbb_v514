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
    
    case 'webshop_cfg_add':
        $code = $_POST['code'];
        
        $item_info = ItemInfo($itemdata_arr, $code);
        
        $item_webshop_info['code'] = $code;
        $item_webshop_info['name'] = $item_info['name'];
        $item_webshop_info['image'] = $item_info['image'];
        $item_webshop_info['info'] = $item_info['info'];
        $item_webshop_info['exl_type'] = $item_info['type'];
        
        if($item_info['exc_anc'] == 2) {
            $item_webshop_info['webshop_type'] = 14;
        } else {
            switch ($item_info['group']){ 
            	case 0:
                    $item_webshop_info['webshop_type'] = 2;
            	break;
            
            	case 1:
                    $item_webshop_info['webshop_type'] = 5;
            	break;
            
            	case 2:
                    $item_webshop_info['webshop_type'] = 5;
            	break;
            
            	case 3:
                    $item_webshop_info['webshop_type'] = 5;
            	break;
            
            	case 4:
                    $item_webshop_info['webshop_type'] = 4;
            	break;
            
            	case 5:
                    $item_webshop_info['webshop_type'] = 3;
            	break;
            
            	case 6:
                    $item_webshop_info['webshop_type'] = 6;
            	break;
            
            	case 7:
                    $item_webshop_info['webshop_type'] = 7;
            	break;
            
            	case 8:
                    $item_webshop_info['webshop_type'] = 8;
            	break;
            
            	case 9:
                    $item_webshop_info['webshop_type'] = 9;
            	break;
            
            	case 10:
                    $item_webshop_info['webshop_type'] = 10;
            	break;
            
            	case 11:
                    $item_webshop_info['webshop_type'] = 11;
            	break;
            
            	case 12:
                    if(in_array($item_info['id'], array(0, 1, 2))) {
                        $item_webshop_info['webshop_type'] = 13;
                    } elseif(in_array($item_info['type'], array(3, 7, 8, 9))) {
                        $item_webshop_info['webshop_type'] = 13;
                    } else {
                        $item_webshop_info['webshop_type'] = 1;
                    }
                    
            	break;
            
            	case 13:
                    if(in_array($item_info['type'], array(3, 7, 8, 9))) {
                        $item_webshop_info['webshop_type'] = 13;
                    } elseif(in_array($item_info['type'], array(4, 5))) {
                        $item_webshop_info['webshop_type'] = 12;
                    } else {
                        $item_webshop_info['webshop_type'] = 1;
                    }
                    
            	break;
            
            	default :
                    $item_webshop_info['webshop_type'] = 1;
            }
        }
        
        $info = "OK";
        $message = "";
            
        $item_webshop = json_encode($item_webshop_info);
            
        echo "
            <info>$info</info>
            <message>" . $message ."</message>
            <item_webshop_info>" . $item_webshop ."</item_webshop_info>
        ";
    break;
    
    case 'webshop_buy':
        $data_send = $_POST['data_send'];
        $data_send_arr = unserialize_safe($data_send);
        $item = $data_send_arr['item_code'];
        $item_slg = $data_send_arr['item_slg'];
        $seri = $data_send_arr['seri'];
        
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
                $item = substr_replace($item, $seri[$i], 6, 8);
                
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