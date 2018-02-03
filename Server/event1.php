<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * @Version		v5.12.0722
 * @Release		22/07/2012
 
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
	include_once("security.php");
include_once('config.php');
include_once('function.php');
include_once('config/config_event.php');
include_once('config/config_event1.php');

$login = $_POST['login'];
$name = $_POST['name'];
$event1_type = $_POST['event1_type'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

if( (strtotime($event_toppoint_begin) < $timestamp) && (strtotime($event_toppoint_end) + 24*60*60 > $timestamp ) )
{

    $string_login = $_POST['string_login'];
    checklogin($login,$string_login);
    
if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

    kiemtra_doinv($login,$name);
    kiemtra_online($login);
    
    $event1_type1_slg = event1_type1_slg($name);
    $event1_type2_slg = event1_type2_slg($name);
    $event1_type3_slg = event1_type3_slg($name);
    
    $event1_type1_daily_slg = event1_type1_daily_slg($name);
    $event1_type2_daily_slg = event1_type2_daily_slg($name);
    $event1_type3_daily_slg = event1_type3_daily_slg($name);
    
    if ( ($event1_type == '1') && ($event1_type1_daily_slg >= $event1_loai1_daily_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 1 trong ngày : <strong>$event1_loai1_daily_slg</strong>. Không thể đổi thêm."; exit();
    }
    elseif ( ($event1_type == '2') && ($event1_type2_daily_slg >= $event1_loai2_daily_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 2 trong ngày : <strong>$event1_loai2_daily_slg</strong>. Không thể đổi thêm."; exit();
    }
    elseif ( ($event1_type == '3') && ($event1_type3_daily_slg >= $event1_loai3_daily_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 3 trong ngày : <strong>$event1_loai3_daily_slg</strong>. Không thể đổi thêm."; exit();
    }
    
    if ( ($event1_type == '1') && ($event1_type1_slg >= $event1_loai1_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 1. Không thể đổi thêm."; exit();
    }
    elseif ( ($event1_type == '2') && ($event1_type2_slg >= $event1_loai2_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 2. Không thể đổi thêm."; exit();
    }
    elseif ( ($event1_type == '3') && ($event1_type3_slg >= $event1_loai3_slg) ) { 
    	echo "Bạn đã đổi đủ số lượng phần thưởng Event loại 3. Không thể đổi thêm."; exit();
    }
    
    $gcoin_query = "SELECT gcoin FROM MEMB_INFO WHERE memb___id='$login'";
    $gcoin_result_sql = $db->Execute($gcoin_query);
    $gcoin_result = $gcoin_result_sql->fetchrow();
    
    $chracter_query = "SELECT CAST(Inventory AS image),Money,event1_type1,event1_type2,event1_type3 FROM Character WHERE AccountID = '$login' AND Name='$name'";
    $character_result_sql = $db->Execute($chracter_query);
    $character_result = $character_result_sql->fetchrow();
    
    $inventory = $character_result[0];
    $inventory = bin2hex($inventory);
    $inventory = strtoupper($inventory);
    
    $inventory1 = substr($inventory,0,12*32);
    $inventory2 = substr($inventory,12*32,64*32);
    $inventory3 = substr($inventory,76*32);
    
    
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_event1.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'inventory2'    =>  $inventory2,
            'event1_itemdrop1_code'    =>  strtoupper($event1_itemdrop1_code),
            'event1_itemdrop2_code'    =>  strtoupper($event1_itemdrop2_code),
            'event1_itemshop_code'    =>  strtoupper($event1_itemshop_code)
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
            echo $notice;
            exit();
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $message = read_TagName($reponse, 'message');
                echo $message;
                exit();
            } elseif ($info == "OK") {
                $data = read_TagName($reponse, 'data');
                $data_arr = unserialize_safe($data);
                $item1 = $data_arr['item1'];
                $item2 = $data_arr['item2'];
                $itemshop = $data_arr['itemshop'];
                $inventory2_after = $data_arr['inventory2_after'];
                
                if(strlen($item1) == 0 || strlen($item2) == 0 || strlen($itemshop) == 0 || strlen($inventory2_after) == 0) {
                    echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                    
                    $arr_view = "\nDataSend:\n";
                    foreach($getcontent_data as $k => $v) {
                        $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                    }
                    writelog("log_api.txt", $arr_view . $reponse);
                    exit();
                }
            } else {
                echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                writelog("log_api.txt", $reponse);
                exit();
            }
        }
    
     	$slg_event = $item1 + $item2;
            
        $inventory_after = $inventory1.$inventory2_after.$inventory3;
     	
    if ( ($item1 < 1) AND ($item2 < 1) ) { echo "Nhân vật không có vật phẩm tham gia Event."; }
    else {
    		
    	$point_event = 0;
    	
    	if ($event1_type == '1') {
    		$zen_total = $item1*$event1_loai1_zen1 + $item2*$event1_loai1_zen2;
    		if ( ($slg_event+ $event1_type1_daily_slg) > $event1_loai1_daily_slg) {
    			echo "Bạn đã đổi $event1_type1_daily_slg phần thưởng loại 1 trong ngày. Bạn muốn đổi tiếp $slg_event phần thưởng loại 1, vượt quá quy định cho phép là tối đa trong ngày $event1_loai1_daily_slg phần thưởng loại 1. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( ($slg_event+ $event1_type1_slg) > $event1_loai1_slg) {
    			echo "Bạn đã đổi $event1_type1_slg phần thưởng loại 1. Bạn muốn đổi tiếp $slg_event phần thưởng loại 1, vượt quá quy định cho phép là tối đa $event1_loai1_slg phần thưởng loại 1. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( $character_result[1] < $zen_total ) { echo "Không đủ Zen đổi phần thưởng . Bạn có $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name . Bạn cần $zen_total Zen để đổi phần thưởng . Hiện tại nhân vật chỉ có $character_result[1] Zen"; exit(); }
    		else {
    			for($i=0;$i<$item1;$i++) {
    				$point_add = rand($event1_loai1_point1_min,$event1_loai1_point1_max);
    				$point_event = $point_event + $point_add;
    			}
    			for($j=0;$j<$item2;$j++) {
    				$point_add = rand($event1_loai1_point2_min,$event1_loai1_point2_max);
    				$point_event = $point_event + $point_add;
    			}
    			$Character_update = "UPDATE Character SET [inventory]=0x$inventory_after,[point_event]=point_event+$point_event,[Money]=Money-$zen_total,[event1_type1]=event1_type1+$slg_event WHERE Name='$name'";
    			$Notice = "Bạn đã đổi $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $zen_total Zen nhận được $point_event Point Event.<br />Point này sau khi Reset sẽ được cộng thêm vào Point Reset.";
                
                //Begin Log
    				$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    		        $info_log_result = $db->Execute($info_log_query);
    		            check_queryerror($info_log_query, $info_log_result);
    		        $info_log = $info_log_result->fetchrow();
    		        
    		        $log_acc = "$login";
    		        $log_gcoin = $info_log[0];
    		        $log_gcoin_km = $info_log[1];
    		        $log_vpoint = $info_log[2];
    		        $log_price = "-";
    		        $log_Des = "$item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $zen_total Zen nhận được $point_event Point Event";
    		        $log_time = $timestamp;
    		        
    		        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    		        $insert_log_result = $db->execute($insert_log_query);
    		            check_queryerror($insert_log_query, $insert_log_result);
    			// End Log
    		}
    	}
    	elseif ($event1_type == '2') {
    		$itemshop_need = $item1*$event1_loai2_itemshop_slg1 + $item2*$event1_loai2_itemshop_slg2;
    		if ( ($slg_event+ $event1_type2_daily_slg) > $event1_loai2_daily_slg) {
    			echo "Bạn đã đổi $event1_type2_daily_slg phần thưởng loại 2 trong ngày. Bạn muốn đổi tiếp $slg_event phần thưởng loại 2, vượt quá quy định cho phép là tối đa trong ngày $event1_loai2_daily_slg phần thưởng loại 2. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( ($slg_event + $event1_type2_slg) > $event1_loai2_slg) {
    			echo "Bạn đã đổi $event1_type2_slg phần thưởng loại 2. Bạn muốn đổi tiếp $slg_event phần thưởng loại 2, vượt quá quy định cho phép là tối đa $event1_loai2_slg phần thưởng loại 2. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( $itemshop < $itemshop_need ) { echo "Nhân vật có $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $itemshop $event1_itemshop_name. Nhân vật thiếu $event1_itemshop_name để đổi . Vui lòng lấy thêm $event1_itemshop_name ."; exit(); }
    		elseif ( $itemshop > $itemshop_need ) { echo "Nhân vật có $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $itemshop $event1_itemshop_name. Nhân vật thừa $event1_itemshop_name để đổi. Vui lòng cất bớt $event1_itemshop_name ."; exit(); }
    		else {
    			for($i=0;$i<$item1;$i++) {
    				$point_add = rand($event1_loai2_point1_min,$event1_loai2_point1_max);
    				$point_event = $point_event + $point_add;
    			}
    			for($j=0;$j<$item2;$j++) {
    				$point_add = rand($event1_loai2_point2_min,$event1_loai2_point2_max);
    				$point_event = $point_event + $point_add;
    			}
    			$Character_update = "UPDATE Character SET [inventory]=0x$inventory_after,[point_event]=point_event+$point_event,[event1_type2]=event1_type2+$slg_event WHERE Name='$name'";
    			$Notice = "Bạn đã đổi $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $itemshop $event1_itemshop_name nhận được $point_event PointEvent.<br />Point này sau khi Reset sẽ được cộng thêm vào Point Reset.";
                
                //Begin Log
    				$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    		        $info_log_result = $db->Execute($info_log_query);
    		            check_queryerror($info_log_query, $info_log_result);
    		        $info_log = $info_log_result->fetchrow();
    		        
    		        $log_acc = "$login";
    		        $log_gcoin = $info_log[0];
    		        $log_gcoin_km = $info_log[1];
    		        $log_vpoint = $info_log[2];
    		        $log_price = "-";
    		        $log_Des = "$item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $itemshop $event1_itemshop_name nhận được $point_event Point Event";
    		        $log_time = $timestamp;
    		        
    		        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    		        $insert_log_result = $db->execute($insert_log_query);
    		            check_queryerror($insert_log_query, $insert_log_result);
    			// End Log
    		}
    	}
    	elseif ($event1_type == '3') {
    		$gcoin_total = $item1*$event1_loai3_gcoin1 + $item2*$event1_loai3_gcoin2;
    		if ( ($slg_event+ $event1_type3_daily_slg) > $event1_loai3_daily_slg) {
    			echo "Bạn đã đổi $event1_type3_daily_slg phần thưởng loại 3 trong ngày. Bạn muốn đổi tiếp $slg_event phần thưởng loại 3, vượt quá quy định cho phép là tối đa trong ngày $event1_loai3_daily_slg phần thưởng loại 3. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( ($slg_event+ $event1_type3_slg) > $event1_loai3_slg) {
    			echo "Bạn đã đổi $event1_type3_slg phần thưởng loại 3. Bạn muốn đổi tiếp $slg_event phần thưởng loại 3, vượt quá quy định cho phép là tối đa $event1_loai3_slg phần thưởng loại 3. Hãy cất bớt Item đổi phần thưởng."; exit();
    		}
    		elseif ( $gcoin_result[0] < $gcoin_total ) { echo "Không đủ Gcoin đổi phần thưởng . Bạn có $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name . Bạn cần $gcoin_total Gcoin để đổi phần thưởng . Hiện tại nhân vật chỉ có $gcoin_result[0] Gcoin"; exit(); }
    		else {
    			for($i=0;$i<$item1;$i++) {
    				$point_add = rand($event1_loai3_point1_min,$event1_loai3_point1_max);
    				$point_event = $point_event + $point_add;
    			}
    			for($j=0;$j<$item2;$j++) {
    				$point_add = rand($event1_loai3_point2_min,$event1_loai3_point2_max);
    				$point_event = $point_event + $point_add;
    			}
    			$Character_update = "UPDATE Character SET [inventory]=0x$inventory_after,[point_event]=point_event+$point_event,[event1_type3]=event1_type3+$slg_event WHERE Name='$name'";
    			$Gcoin_update = "UPDATE MEMB_INFO SET [gcoin]=gcoin-$gcoin_total Where memb___id='$login'";
    			$Notice = "Bạn đã đổi $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name và $gcoin_total Gcoin nhận được $point_event PointEvent.<br />Point này sau khi Reset sẽ được cộng thêm vào Point Reset.";
    			
    			//Begin Log
    				$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    		        $info_log_result = $db->Execute($info_log_query);
    		            check_queryerror($info_log_query, $info_log_result);
    		        $info_log = $info_log_result->fetchrow();
    		        
    		        $log_acc = "$login";
    		        $log_gcoin = $info_log[0];
    		        $log_gcoin_km = $info_log[1];
    		        $log_vpoint = $info_log[2];
    		        $log_price = "- $gcoin_total Gcoin";
    		        $log_Des = "Đổi $item1 $event1_itemdrop1_name, $item2 $event1_itemdrop2_name nhận được $point_event Point Event";
    		        $log_time = $timestamp;
    		        
    		        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    		        $insert_log_result = $db->execute($insert_log_query);
    		            check_queryerror($insert_log_query, $insert_log_result);
    			// End Log
    		}
    	}
    	
    	kiemtra_doinv($login,$name);
    	kiemtra_online($login);
    
    	$Character_Update_rs = $db->Execute($Character_update) OR Die("Lỗi Query : $Character_update");
    if($event1_type == '3') { $Gcoin_Update_rs = $db->Execute($Gcoin_update) OR Die("Lỗi Query : $Gcoin_update"); }
    
    //Event TOP Point
    include_once('event_toppoint_intime.php');
    
    	echo $Notice;
      }
} else {
     if(strtotime($event_toppoint_begin) > $timestamp) {
        echo "Thời gian bắt đầu Event : 0h00 $event_toppoint_begin . Event chưa bắt đầu, không thể đổi Point"; exit();
     }
     else if( (strtotime($event_toppoint_end) + 24*60*60) < $timestamp) {
        echo "Thời gian kết thúc Event : 24h00 $event_toppoint_end . Event đã kết thúc, không thể đổi Point"; exit();
     }
}

}
$db->Close();
?>