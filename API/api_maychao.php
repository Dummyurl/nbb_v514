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

$info = 'OK';
$item_success = "350000123456780000D0000000000000";

switch ($action){ 
	case 'longcondor_check_item':
    case 'longcondor_quay':
        $warehouse1 = $_POST['warehouse1'];
        
        $check_info_arr = array();
        $item_nguyenlieu = array();
        
        // Define
        $percent_max = 60;
        $percent_luck = 1;
        $percent_skill = 7;
        $percent_ancient_lv = 2;
        
        
        $percent = 1;
        for($i=0; $i<=4; $i++) {
            $item_arr[$i]['slg'] = 0;
            $item_arr[$i]['check'] = 0; 
        }
        $percent_ancient = $percent_ancient_lv;
        
        
        for($i=0; $i<32; ++$i) {
            $item = substr($warehouse1,$i*32,32);
            if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                $item_info = ItemInfo($itemdata_arr, $item);

                $item_info['vitri'] = $i;
                
                if((ceil(($item_info['vitri']+1)/8) + $item_info['y'] - 1) <= 4) {
                    $item_serial = $item_info['serial'];
                    if( hexdec($item_info['serial']) == 4294967280 ) {
                        $err .= $item_info['name'] . " đang được bảo vệ. Không thể sử dụng để xoay Lông Vũ Condor.<br />";
                    }
                            
                    if( $item_info['group'] == 12 && $item_info['id'] == 15 && $item_info['level'] == 0 ) { // Chao
                        ++$item_arr[0]['slg'];
                        $item_arr[0]['check']   = 1;
                        $item_nguyenlieu[] = $item;
                        $itemview_arr[] = array(
                            'info'  =>  $item_info['info'],
                            'img'   =>  $item_info['image']
                        );
                    } elseif( $item_info['group'] == 14 && $item_info['id'] == 22 && $item_info['level'] == 0 ) {   // Cre
                        ++$item_arr[1]['slg'];
                        $item_arr[1]['check']   = 1;
                        $item_nguyenlieu[] = $item;
                        $itemview_arr[] = array(
                            'info'  =>  $item_info['info'],
                            'img'   =>  $item_info['image']
                        );
                    } elseif( $item_info['group'] == 12 && $item_info['id'] == 31 && $item_info['level'] == 0 ) {   // Soul+1
                        ++$item_arr[2]['slg'];
                        $item_arr[2]['check']   = 1;
                        $item_nguyenlieu[] = $item;
                        $itemview_arr[] = array(
                            'info'  =>  $item_info['info'],
                            'img'   =>  $item_info['image']
                        );
                    } elseif( $item_info['type'] == 3 ) {   // Wing 2
                        ++$item_arr[3]['slg'];
                        if($item_info['level'] >= 9 && $item_info['opt'] >= 1 ) {
                            $item_arr[3]['check']   = 1;
                            $item_nguyenlieu[] = $item;
                        } else {
                            $item_arr[3]['check']   = 2;    // Kg dat dieu kien
                            $err .= $item_info['name'] . " không thể sử dụng để xoay Lông Vũ Condor.<br />";
                        }
                        
                        $itemview_arr[] = array(
                            'info'  =>  $item_info['info'],
                            'img'   =>  $item_info['image']
                        );
                    } elseif( $item_info['exc_anc'] == 2 ) {   // Item Than
                        if($item_info['level'] >= 7 && $item_info['opt'] >= 1 ) {
                            $item_arr[4]['slg'] = 1;
                            $item_arr[4]['check']   = 1;
                            $item_nguyenlieu[] = $item;
                            
                            if($item_info['level'] == 7) {
                                $percent_ancient = 2;
                            } else {
                                $lv_multi = $item_info['level']-7;
                                for($j=0; $j<$lv_multi; $j++) {
                                    $percent_ancient *= $percent_ancient_lv;
                                }
                            }
                            
                            if($item_info['luck'] == 1) $percent_ancient += $percent_luck;
                            if($item_info['skill'] == 1) $percent_ancient += $percent_skill;
                            
                            $percent += $percent_ancient;
                            
                            $itemview_arr[] = array(
                                'info'  =>  $item_info['info'],
                                'img'   =>  $item_info['image']
                            );
                        } else {
                            $item_arr[4]['check']   = 2;    // Kg dat dieu kien
                            $err .= $item_info['name'] . " không thể sử dụng để xoay Lông Vũ Condor.<br />";
                        }
                    } else {
                        $err .= $item_info['name'] . " không thể sử dụng để xoay Lông Vũ Condor.<br />";
                    }
                }
            }
        }
        
        if($percent > $percent_max) $percent = $percent_max;
        for($i=0; $i<=4; $i++) {
            switch ($i){ 
            	case 0:
                    $item_name = "Ngọc Hỗn Nguyên";
            	break;
            
            	case 1:
                    $item_name = "Ngọc Sáng Tạo";
            	break;
            
            	case 2:
                    $item_name = "Cụm Ngọc Tâm Linh +1";
            	break;
                
                case 3:
                    $item_name = "Cánh Cấp 2 +9 +Tự động hồi phục HP+4% trở lên";
            	break;
                
                case 4:
                    $item_name = "Item Thần +7 +4op trở lên";
            	break;
            }
            if($item_arr[$i]['check'] == 0) {
                $err .= "Thiếu <strong>$item_name</strong>.<br />";
            }
            if($item_arr[$i]['slg'] > 1) {
                $err .= "Số lượng <strong>$item_name</strong> vượt quá mức quy định.<br />";
            }
        }
        
        $check_info_arr['item'] = $item_arr;
        $check_info_arr['item_view'] = $itemview_arr;
        $check_info_arr['percent'] = $percent;
        $check_info_arr['err'] = $err;
        $check_info_arr['accept'] = 0;
        if($item_arr[0]['check'] == 1 && $item_arr[1]['check'] == 1 && $item_arr[2]['check'] == 1 && $item_arr[3]['check'] == 1 && $item_arr[4]['check'] == 1 && strlen($check_info_arr['err']) == 0) $check_info_arr['accept'] = 1;
        
        
        switch ($action) {
        	case 'longcondor_quay':
                $serial = $_POST['serial'];
                $msg = '';
                $success = 0;
                $item_nguyenlieu_data = '';
                $item_epsuccess = '';
                
                if($check_info_arr['accept'] == 1) {
                    
                    $empty_item = '';
                    for($i=0; $i<32*8*4; $i++) {
                        $empty_item .= 'F';
                    }
                    
                    $warehouse1_new = substr_replace($warehouse1, $empty_item, 0, 32*8*4);
                    
                    $rand = rand(1, 99);
                    if($rand <= $percent) {
                        $success = 1;   // Ep thanh cong
                        $item_epsuccess = substr_replace($item_success, $serial, 6, 8);
                        $warehouse1_new = substr_replace($warehouse1_new, $item_epsuccess, 0, 32);
                    } else {
                        $success = 2;   // Ep xit
                    }
                    
                    $item_nguyenlieu_data = json_encode($item_nguyenlieu);
                }
                
                echo "
                    <info>OK</info>
                    <reponse>$success</reponse>
                    <warehouse1>$warehouse1_new</warehouse1>
                    <item_nguyenlieu>$item_nguyenlieu_data</item_nguyenlieu>
                    <item_epsuccess>$item_epsuccess</item_epsuccess>
                ";
        	break;
        
        	default :
                
                $check_info = json_encode($check_info_arr);
                echo "
                    <info>OK</info>
                    <check_info>" . $check_info ."</check_info>
                ";
        }
        
        
    break;
    
    
}

?>