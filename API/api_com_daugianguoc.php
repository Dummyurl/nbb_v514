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
	case 'add_daugia':
        $itemcode = $_POST['itemcode'];
        $bid_mod = $_POST['bid_mod'];       $bid_mod = abs(intval($bid_mod));
        $hour_begin = $_POST['hour_begin'];
        $date_begin = $_POST['date_begin'];
        $hour_end = $_POST['hour_end'];
        $date_end = $_POST['date_end'];
        
        $err = false;
        $info = "OK";
        $message = "";
        
        if(strlen($itemcode) != 32) {
            $message .= "Item Code chỉ được 32 ký tự.<br />";
            $err = true;
        }
        if(!preg_match("/^[a-fA-F0-9]*$/i", $itemcode)) {
            $message .= "Item Code chỉ được chứa các ký tự : 0-9, a-f, A-F.<br />";
            $err = true;
        }
        if($bid_mod == 0) {
            $message .= "Giá đặt phải chia hết : phải khác 0, và không được là chữ.<br />";
            $err = true;
        }
        $time_begin = strtotime($date_begin .' '. $hour_begin);
        $time_end = strtotime($date_end .' '. $hour_end);
        if($time_begin < $timestamp) {
            $message .= "Thời gian đấu giá bắt đầu phải lớn hơn hiện tại.<br />";
            $err = true;
        }
        if($time_begin > $time_end) {
            $message .= "Thời gian đấu giá bắt đầu phải nhỏ hơn thời gian kết thúc.<br />";
            $err = true;
        }
        
        
        if($err === false) {
            $item_info = ItemInfo($itemdata_arr, $itemcode);
            $itemname = $item_info['name'];
            $iteminfo = $item_info['info'];
            $itemimg = $item_info['image'];
        } else {
            $info = "Error";
            $iteminfo = "";
            $itemimg = "";
        }
        
        $data_arr = array(
            'itemname'  =>  $itemname,
            'iteminfo'  =>  $iteminfo,
            'itemimg'   =>  $itemimg,
            'bid_mod' =>  $bid_mod,
            'time_begin'    =>  $time_begin,
            'time_end'  =>  $time_end
        );
        $data= serialize($data_arr);
        echo "
            <info>$info</info>
            <message>$message</message>
            <data>" . $data ."</data>
        ";
    break;
    
    case 'bid_win':
        $listbid = $_POST['listbid'];
        $listbid_arr = unserialize_safe($listbid);
        foreach($listbid_arr as $bidid => $listbid_check_arr) {
            foreach($listbid_check_arr as $listbid_check) {
                $bid_vpoint = $listbid_check['bid_vpoint'];
                if( !isset($bid_vpoint_count[$bid_vpoint]) ) {
                    $bid_vpoint_count[$bid_vpoint] = 1;
                } else {
                    ++$bid_vpoint_count[$bid_vpoint];
                }
            }
            
            $bid_vpoint_min = 0;
            $bid_vpoint_min_count = 999999;
            foreach($bid_vpoint_count as $bid_vpoint_count_key => $bid_vpoint_count_val) {
                if($bid_vpoint_min_count > $bid_vpoint_count_val) {
                    $bid_vpoint_min = $bid_vpoint_count_key;
                    $bid_vpoint_min_count = $bid_vpoint_count_val;
                } else if($bid_vpoint_min_count == $bid_vpoint_count_val && $bid_vpoint_min > $bid_vpoint_count_key) {
                    $bid_vpoint_min = $bid_vpoint_count_key;
                }
            }
            
            if($bid_vpoint_min_count == 1) {
                foreach($listbid_check_arr as $listbid_check) {
                    if($listbid_check['bid_vpoint'] == $bid_vpoint_min) {
                        $win_arr[$bidid] = array(
                            'acc'   =>  $listbid_check['acc'],
                            'name'   =>  $listbid_check['name'],
                            'bid_vpoint'   =>  $listbid_check['bid_vpoint'],
                            'bid_time'   =>  $listbid_check['bid_time']
                        );
                        break;
                    }
                }
            } else {
                $win_arr[$bidid] = array(
                    'acc'   =>  '',
                    'name'   =>  '',
                    'bid_vpoint'   =>  '',
                    'bid_time'   =>  time()+5*365*24*60*60
                );
                $win_count = 0;
                
                foreach($listbid_check_arr as $listbid_check) {
                    
                    if($listbid_check['bid_vpoint'] == $bid_vpoint_min) {
                        ++$win_count;
                        if($win_arr[$bidid]['bid_time'] > $listbid_check['bid_time']) {
                            $win_arr[$bidid] = $listbid_check;
                        }
                        
                        if($win_count >= $bid_vpoint_min_count) {
                            break;
                        }
                    }
                }
            }
        }
        
        $win = serialize($win_arr);
        echo "
            <info>OK</info>
            <win>" . $win ."</win>
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
            $msg = "Hòm đồ không đủ chỗ chứa Item. Vui lòng dọn dẹp lại hòm đồ.";
        } else {
            $info = "OK";
            $item = substr_replace($data_send_arr['item_code'], $data_send_arr['item_seri'], 6, 8);
            $warehouse1_receive = substr_replace($data_send_arr['warehouse1'], $item, ($slot_accept-1)*32, 32);
        }
        
        
        echo "
            <info>$info</info>
            <msg>$msg</msg>
            <warehouse1>" . $warehouse1_receive ."</warehouse1>
        ";
    break;
 }

?>