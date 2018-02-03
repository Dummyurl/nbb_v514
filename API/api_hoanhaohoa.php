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
	case 'item_list':
        $warehouse1 = $_POST['warehouse1'];
        $dangep = stripcslashes($_POST['dangep']);
            $dangep_arr = json_decode($dangep, true);
        $hoanhaohoa_cpcoban = $_POST['hoanhaohoa_cpcoban'];
        $hoanhaohoa_cpextra = $_POST['hoanhaohoa_cpextra'];
        $vukhi_cp_extra = $_POST['vukhi_cp_extra'];
            if($vukhi_cp_extra < 1) $vukhi_cp_extra = 1;
        $giap_cp_extra = $_POST['giap_cp_extra'];
            if($giap_cp_extra < 1) $giap_cp_extra = 1;
        $wing3_cp_extra = $_POST['wing3_cp_extra'];
            if($wing3_cp_extra < 1) $wing3_cp_extra = 1;
        $wing2_cp_extra = $_POST['wing2_cp_extra'];
            if($wing2_cp_extra < 1) $wing2_cp_extra = 1;
        
        
        $listitem_arr = array();
        
        $warehouse1_itemtotal = floor(strlen($warehouse1)/32);
        for($i=0; $i<$warehouse1_itemtotal; ++$i) {
            $item = substr($warehouse1,$i*32,32);
            if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                $item_info = ItemInfo($itemdata_arr, $item);
                if( (in_array($item_info['type'], array(0, 1, 2, 4, 5)) && $item_info['exc_total'] < 6) || (in_array($item_info['type'], array(3)) && $item_info['exc_total'] < 5) || (in_array($item_info['type'], array(7, 8, 9)) && $item_info['exc_total'] < 4)  ) {
                    $item_info['vitri'] = $i;
                    $item_serial = $item_info['serial'];
                    if( hexdec($item_info['serial']) == 0 ) {
                        $item_info['item_spec'] = 1;    // Seri 0
                    } else if (hexdec($item_info['serial']) < 4294967280) {
                        $item_info['item_spec'] = 0;
                    } else if( hexdec($item_info['serial']) == 4294967280 ) {
                        $item_info['item_spec'] = 2;    // Item da bao ve
                    } else {
                        $item_info['item_spec'] = 3;    // Item dac biet
                    }
                    $cp_percent = 0;
                    
                    if( $item_info['item_spec'] == 0 && isset($dangep_arr[$item_serial]) ) {
                        
                        $exc_total = $item_info['exc_total'];
                        $cp_sum = 0;
                        
                        for($j=1; $j <= $exc_total + 1; $j++) {
                            $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($j-1) ));
                            $cp_sum = $cp_sum + $cp_cap;
                        }
                        
                        if( in_array($item_info['type'], array(0, 5)) ) {
                            $cp_sum = $cp_sum * $vukhi_cp_extra;
                        } else if( in_array($item_info['type'], array(1, 2, 4)) ) {
                            $cp_sum = $cp_sum * $giap_cp_extra;
                        } else if( in_array($item_info['type'], array(7, 8, 9)) ) {
                            $cp_sum = $cp_sum * $wing3_cp_extra;
                        } else if( in_array($item_info['type'], array(3)) ) {
                            $cp_sum = $cp_sum * $wing2_cp_extra;
                        }
                        
                        $cp = $dangep_arr[$item_serial]['cp'];
                        $cp_percent = (floor($cp/$cp_sum*100) < 100) ? number_format(($cp/$cp_sum*100), 2, ',', '.') : 100;
                    }
                            
                    $listitem_arr[] = array(
                        'name'  =>  $item_info['name'],
                        'info'  =>  $item_info['info'],
                        'image' =>  $item_info['image'],
                        'item_code'    =>  $item_info['item_code'],
                        'vitri'    =>  $item_info['vitri'],
                        'item_spec' =>  $item_info['item_spec'],
                        'serial'    =>  $item_info['serial'],
                        'exc_total' =>  $item_info['exc_total'],
                        'cp_percent'    =>  $cp_percent
                    );
                }
            }
        }
        
        $listitem = json_encode($listitem_arr);
        echo "
            <info>OK</info>
            <listitem>" . $listitem ."</listitem>
        ";
    break;
    
    case 'hh_up':
        $warehouse1 = $_POST['warehouse1'];
        $vitri = $_POST['vitri'];
        $serial = $_POST['serial'];
        $cp = $_POST['cp'];
        
        $hoanhaohoa_cpcoban = $_POST['hoanhaohoa_cpcoban'];
        $hoanhaohoa_cpextra = $_POST['hoanhaohoa_cpextra'];
        $vukhi_cp_extra = floatval($_POST['vukhi_cp_extra']);
            if($vukhi_cp_extra < 1) $vukhi_cp_extra = 1;
        $vukhi_exl = stripcslashes($_POST['vukhi_exl']);
            $vukhi_exl = json_decode($vukhi_exl, true);
        $giap_cp_extra = floatval($_POST['giap_cp_extra']);
            if($giap_cp_extra < 1) $giap_cp_extra = 1;
        $giap_exl = stripcslashes($_POST['giap_exl']);
            $giap_exl = json_decode($giap_exl, true);
        $wing3_cp_extra = floatval($_POST['wing3_cp_extra']);
            if($wing3_cp_extra < 1) $wing3_cp_extra = 1;
        $wing3_exl = stripcslashes($_POST['wing3_exl']);
            $wing3_exl = json_decode($wing3_exl, true);
        $wing2_cp_extra = floatval($_POST['wing2_cp_extra']);
            if($wing2_cp_extra < 1) $wing2_cp_extra = 1;
        $wing2_exl = stripcslashes($_POST['wing2_exl']);
            $wing2_exl = json_decode($wing2_exl, true);
        
        $info = "OK";
        $message = "";
        $hhup_arr = array();
        
        // Lấy item cần Hoàn Hảo Hóa
        $item = substr($warehouse1,$vitri*32,32);
        $item_info = ItemInfo($itemdata_arr, $item);
        if($item_info['serial'] != $serial) {
            $info = "Error";
            $message = "Item đã di chuyển vị trí. Vui lòng truy cập lại tính năng Hoàn Hảo Hóa để lấy vị trí mới.";
        } else {
            $exc_total = $item_info['exc_total'];
            $cp_sum = 0;
            for($j=1; $j <= $exc_total + 1; $j++) {
                $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($j-1) ));
                $cp_sum = $cp_sum + $cp_cap;
            }
            if( in_array($item_info['type'], array(0, 5)) ) {
                $cp_sum = $cp_sum * $vukhi_cp_extra;
            } else if( in_array($item_info['type'], array(1, 2, 4)) ) {
                $cp_sum = $cp_sum * $giap_cp_extra;
            } else if( in_array($item_info['type'], array(7, 8, 9)) ) {
                $cp_sum = $cp_sum * $wing3_cp_extra;
            } else if( in_array($item_info['type'], array(3)) ) {
                $cp_sum = $cp_sum * $wing2_cp_extra;
            }
            
            $cp_rand = rand(4, 5);
            $cp_new = $cp + $cp_rand;
            $cp_percent = (floor($cp_new/$cp_sum*100) < 100) ? number_format(($cp_new/$cp_sum*100), 2, ',', '.') : 100;
            
            $hhup_arr['cp_rand'] = $cp_rand;
            $hhup_arr['cp_new'] = $cp_new;
            $hhup_arr['cp_percent'] = $cp_percent;
            $hhup_arr['up'] = 0;
            $hhup_arr['item_name'] = $item_info['name'];
            
            if($cp_percent == 100) {    // Thang cap Item
                
                $tyle_tong = 0;
                $tyle = array();
                if( in_array($item_info['type'], array(0, 5)) ) {       // Vu khi
                    
                    if($item_info['exc_1'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[1],
                            'dong'  =>  1
                        );
                        $tyle_tong += $vukhi_exl[1];
                    }
                    if($item_info['exc_2'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[2],
                            'dong'  =>  2
                        );
                        $tyle_tong += $vukhi_exl[2];
                    }
                    if($item_info['exc_3'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[3],
                            'dong'  =>  3
                        );
                        $tyle_tong += $vukhi_exl[3];
                    }
                    if($item_info['exc_4'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[4],
                            'dong'  =>  4
                        );
                        $tyle_tong += $vukhi_exl[4];
                    }
                    if($item_info['exc_5'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[5],
                            'dong'  =>  5
                        );
                        $tyle_tong += $vukhi_exl[5];
                    }
                    if($item_info['exc_6'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $vukhi_exl[6],
                            'dong'  =>  6
                        );
                        $tyle_tong += $vukhi_exl[6];
                    }
                    
                } else if( in_array($item_info['type'], array(1, 2, 4)) ) {     // Giap
                    if($item_info['exc_1'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[1],
                            'dong'  =>  1
                        );
                        $tyle_tong += $giap_exl[1];
                    }
                    if($item_info['exc_2'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[2],
                            'dong'  =>  2
                        );
                        $tyle_tong += $giap_exl[2];
                    }
                    if($item_info['exc_3'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[3],
                            'dong'  =>  3
                        );
                        $tyle_tong += $giap_exl[3];
                    }
                    if($item_info['exc_4'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[4],
                            'dong'  =>  4
                        );
                        $tyle_tong += $giap_exl[4];
                    }
                    if($item_info['exc_5'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[5],
                            'dong'  =>  5
                        );
                        $tyle_tong += $giap_exl[5];
                    }
                    if($item_info['exc_6'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $giap_exl[6],
                            'dong'  =>  6
                        );
                        $tyle_tong += $giap_exl[6];
                    }
                } else if( in_array($item_info['type'], array(7, 8, 9)) ) {     // Wing 3
                    if($item_info['exc_1'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing3_exl[1],
                            'dong'  =>  1
                        );
                        $tyle_tong += $wing3_exl[1];
                    }
                    if($item_info['exc_2'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing3_exl[2],
                            'dong'  =>  2
                        );
                        $tyle_tong += $wing3_exl[2];
                    }
                    if($item_info['exc_3'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing3_exl[3],
                            'dong'  =>  3
                        );
                        $tyle_tong += $wing3_exl[3];
                    }
                    if($item_info['exc_4'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing3_exl[4],
                            'dong'  =>  4
                        );
                        $tyle_tong += $wing3_exl[4];
                    }
                } else if( in_array($item_info['type'], array(3)) ) {       // Wing 2
                    if($item_info['exc_1'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing2_exl[1],
                            'dong'  =>  1
                        );
                        $tyle_tong += $wing2_exl[1];
                    }
                    if($item_info['exc_2'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing2_exl[2],
                            'dong'  =>  2
                        );
                        $tyle_tong += $wing2_exl[2];
                    }
                    if($item_info['exc_3'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing2_exl[3],
                            'dong'  =>  3
                        );
                        $tyle_tong += $wing2_exl[3];
                    }
                    if($item_info['exc_4'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing2_exl[4],
                            'dong'  =>  4
                        );
                        $tyle_tong += $wing2_exl[4];
                    }
                    if($item_info['exc_5'] == 0) {
                        $tyle[] = array(
                            'tyle'  =>  $wing2_exl[5],
                            'dong'  =>  5
                        );
                        $tyle_tong += $wing2_exl[5];
                    }
                }
                
                $tyle_moc = 0;
                foreach($tyle as $tl_k => $tl_v) {
                    $tyle[$tl_k]['tyle_percent'] = $tyle_moc + ceil($tyle[$tl_k]['tyle']/$tyle_tong*100);
                    $tyle_moc = $tyle[$tl_k]['tyle_percent'];
                }
                
                $moc = rand(1, 100);
                $dong_up = 0;
                foreach($tyle as $tl_k => $tl_v) {
                    if($tyle[$tl_k]['tyle_percent'] >= $moc) {
                        $dong_up = $tyle[$tl_k]['dong'];
                        break;
                    }
                }
                
                if($dong_up > 0) {
                    $exc_option 	= hexdec(substr($item,14,2)); 	// Item Excellent Info/ Option
                    switch ($dong_up){ 
                    	case 1:
                            $exc_option_new = $exc_option + 1;
                    	break;
                    
                    	case 2:
                            $exc_option_new = $exc_option + 2;
                    	break;
                    
                    	case 3:
                            $exc_option_new = $exc_option + 4;
                    	break;
                    
                    	case 4:
                            $exc_option_new = $exc_option + 8;
                    	break;
                    
                    	case 5:
                            $exc_option_new = $exc_option + 16;
                    	break;
                    
                    	case 6:
                            $exc_option_new = $exc_option + 32;
                    	break;
                    
                    }
                    $exc_option_new = dechex($exc_option_new);
                    if(strlen($exc_option_new) == 1) $exc_option_new = "0". $exc_option_new;
                    $item_new = substr_replace($item, $exc_option_new, 14, 2);
                    
                    // Thực hiện Update Iventory
                    $warehouse1_update = substr_replace($warehouse1, $item_new, $vitri*32, 32);
                    
                    $hhup_arr['warehouse1_update'] = $warehouse1_update;
                    $hhup_arr['up'] = 1;
                    $hhup_arr['cp_percent'] = 0;
                    $hhup_arr['exc_total_new'] = $exc_total + 1;
                    $hhup_arr['hh_new'] = "";
                    if( in_array($item_info['type'], array(0, 5)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "Tăng lượng MANA khi giết quái (MANA/8)";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "Tăng lượng LIFE khi giết quái (LIFE/8)";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Tốc độ tấn công +7";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "Tăng lực tấn công 2%";
                        	break;
                            
                            case 5:
                                $hhup_arr['hh_new'] = "Tăng lực tấn công (Cấp độ/20)";
                        	break;
                            
                            case 6:
                                $hhup_arr['hh_new'] = "Khả năng xuất hiện lực tấn công hoàn hảo +10%";
                        	break;
                        }
                    } else if( in_array($item_info['type'], array(1, 2, 4)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "Lượng ZEN rơi ra khi giết quái +40%";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "Khả năng xuất hiện phòng thủ hoàn hảo +10%";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Phản hồi sát thương +5%";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "Giảm sát thương +4%";
                        	break;
                            
                            case 5:
                                $hhup_arr['hh_new'] = "Lượng MANA tối đa +4%";
                        	break;
                            
                            case 6:
                                $hhup_arr['hh_new'] = "Lượng HP tối đa +4%";
                        	break;
                        }
                    } else if( in_array($item_info['type'], array(7)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "Cơ hội loại bỏ sức phòng thủ 5%";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "Phản đòn khi cận chiến 5%";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn HP 5%";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn nội lực 5%";
                        	break;
                        }
                    } else if( in_array($item_info['type'], array(8)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "Cơ hội loại bỏ sức phòng thủ 3%";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "Phản đòn khi cận chiến 3%";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn HP 3%";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn nội lực 3%";
                        	break;
                        }
                    } else if( in_array($item_info['type'], array(9)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "Cơ hội loại bỏ sức phòng thủ 7%";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "Phản đòn khi cận chiến 7%";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn HP 7%";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "Khả năng hồi phục hoàn toàn nội lực 7%";
                        	break;
                        }
                    } else if( in_array($item_info['type'], array(3)) ) {
                        switch ($dong_up){ 
                        	case 1:
                                $hhup_arr['hh_new'] = "+ 115 Lượng HP tối đa";
                        	break;
                        
                        	case 2:
                                $hhup_arr['hh_new'] = "+ 115 Lượng MP tối đa";
                        	break;
                        
                        	case 3:
                                $hhup_arr['hh_new'] = "Khả năng loại bỏ phòng thủ đối phương +3%";
                        	break;
                            
                            case 4:
                                $hhup_arr['hh_new'] = "+ 50 Lực hành động tối đa ";
                        	break;
                            
                            case 5:
                                $hhup_arr['hh_new'] = "Tốc độ tấn công +7";
                        	break;
                        }
                    }
                    
                } else {
                    $info = "Error";
                    $message = "Không tìm thấy dòng cần nâng cấp.";
                }
            }
        }
        
            $hhup_data = json_encode($hhup_arr);
        echo "
            <info>$info</info>
            <message>" . $message ."</message>
            <hhup>" . $hhup_data ."</hhup>
        ";
    break;
}

?>