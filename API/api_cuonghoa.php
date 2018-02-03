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
        $dangcuonghoa = stripcslashes($_POST['dangcuonghoa']);
        $dangcuonghoa_arr = json_decode($dangcuonghoa, true);
        $cuonghoa_cpcoban = $_POST['cuonghoa_cpcoban'];
        $cuonghoa_cpextra = $_POST['cuonghoa_cpextra'];
        
        $listitem_arr = array();
        
        $warehouse1_itemtotal = floor(strlen($warehouse1)/32);
        for($i=0; $i<$warehouse1_itemtotal; ++$i) {
            $item = substr($warehouse1,$i*32,32);
            if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
                $item_info = ItemInfo($itemdata_arr, $item);
                if($item_info['exc_total'] > 0 && $item_info['level'] < 15 && in_array($item_info['type'], array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)) ) {
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
                    if( isset($dangcuonghoa_arr[$item_serial]['item_lvl']) && $dangcuonghoa_arr[$item_serial]['item_lvl'] == $item_info['level'] ) {
                        
                        $item_lvl = $item_info['level'];
                        $cp_sum = 0;
                        
                        for($j=1; $j <= $item_info['level'] + 1; $j++) {
                            $cp_cap = floor($cuonghoa_cpcoban * (1 + $cuonghoa_cpextra * ($j-1) ));
                            $cp_sum = $cp_sum + $cp_cap;
                        }
                        $cp = $dangcuonghoa_arr[$item_serial]['cp'];
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
                        'level' =>  $item_info['level'],
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
    
    case 'ch_up':
        $warehouse1 = $_POST['warehouse1'];
        $vitri = $_POST['vitri'];
        $serial = $_POST['serial'];
        $item_lvl = $_POST['item_lvl'];
        $cp = $_POST['cp'];
        $cuonghoa_cpcoban = $_POST['cuonghoa_cpcoban'];
        $cuonghoa_cpextra = $_POST['cuonghoa_cpextra'];
        
        $info = "OK";
        $message = "";
        $chup_arr = array();
        
        // Lấy item cần Cường Hóa
        $item = substr($warehouse1,$vitri*32,32);
        $item_info = ItemInfo($itemdata_arr, $item);
        if($item_info['serial'] != $serial) {
            $info = "Error";
            $message = "Item đã di chuyển vị trí. Vui lòng truy cập lại tính năng Cường Hóa để lấy vị trí mới.";
        } else if($item_info['level'] != $item_lvl) {
            $info = "Error";
            $message = "Cấp độ Item đã thay đổi. Vui lòng truy cập lại tính năng Cường Hóa để lấy cấp độ mới.";
        } else {
            $cp_sum = 0;
            for($i=1; $i <= $item_lvl+1; $i++) {
                $cp_cap = floor($cuonghoa_cpcoban * (1 + $cuonghoa_cpextra * ($i-1) ));
                $cp_sum = $cp_sum + $cp_cap;
            }
            
            $cp_rand = rand(4, 5);
            $cp_new = $cp + $cp_rand;
            $cp_percent = (floor($cp_new/$cp_sum*100) < 100) ? number_format(($cp_new/$cp_sum*100), 2, ',', '.') : 100;
            
            $chup_arr['cp_rand'] = $cp_rand;
            $chup_arr['cp_new'] = $cp_new;
            $chup_arr['cp_percent'] = $cp_percent;
            $chup_arr['uplv'] = 0;
            $chup_arr['item_name'] = $item_info['name'];
            
            if($cp_percent == 100) {    // Thang cap Item
                // Lấy thông tin Level
                $iop 	= hexdec(substr($item,2,2)); 	// Item Level/Skill/Option Data
                // Cộng LV
                $uplv = $iop+8;
                // Chuyển ngược thông tin LV từ DEC -> HEX
                $newop = dechex($uplv);
                // Kiểm tra độ dài thông tin LV, nếu chỉ có 1 ký tự thì thêm 0 đằng trước
                if(strlen($newop) == 1) $newop = '0'.$newop;
                // Thay thế thông tin LV mới vào chuỗi Item
                $item_new = substr_replace($item, $newop, 2, 2);
                // Thực hiện Update Iventory
                $warehouse1_update = substr_replace($warehouse1, $item_new, $vitri*32, 32);
                
                $chup_arr['warehouse1_update'] = $warehouse1_update;
                $chup_arr['uplv'] = 1;
                $chup_arr['itemlvl_new'] = $item_lvl + 1;
                $chup_arr['cp_percent'] = 0;
            }
        }
        
            $chup_data = json_encode($chup_arr);
        echo "
            <info>$info</info>
            <message>" . $message ."</message>
            <chup>" . $chup_data ."</chup>
        ";
    break;
}

?>