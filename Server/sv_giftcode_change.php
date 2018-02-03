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
include_once("config.php");

include_once("function.php");

$login=$_POST["login"];
$name=$_POST["name"];
$gift_code = $_POST['giftcode'];    $gift_code = strtoupper($gift_code);
$pass2 = $_POST['pass2'];

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_online($login);

if(check_tk_nv($login, $name) == 0) {
    echo "Tài khoản $login không có nhân vật $name. Vui lòng kiểm tra lại."; exit();
}

// Kiem tra GiftCode
$giftcode_check_query = "SELECT TOP 1 status, name, type, acc FROM GiftCode WHERE gift_code='$gift_code' ORDER BY status";
$giftcode_check_result = $db->Execute($giftcode_check_query);
$giftcode_check = $giftcode_check_result->NumRows();
if($giftcode_check == 0) {
    echo "Tài khoản $login không tồn tại GiftCode $gift_code , vui lòng kiểm tra lại."; exit();
} else {
    $giftcode__check_fetch = $giftcode_check_result->FetchRow();
    $giftcode_status = $giftcode__check_fetch[0];
    $giftcode_name = $giftcode__check_fetch[1];
    $giftcode_type = $giftcode__check_fetch[2];
    $giftcode_acc = $giftcode__check_fetch[3];

    if($giftcode_status == 0) {
        echo "Mã GiftCode ". $gift_code ." chưa được kích hoạt."; exit();
    }
    else if($giftcode_status == 2) {
        echo "Tài khoản $giftcode_acc đã sử dụng Giftcode $gift_code cho nhân vật ". $giftcode_name ." . Không thể sử dụng lại."; exit();
    }
}

$warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
$warehouse_result = $db->Execute($warehouse_query);
    check_queryerror($warehouse_query, $warehouse_result);
$warehouse_c = $warehouse_result->NumRows();
if($warehouse_c == 0) {
    echo "Chưa mở Rương đồ chung. Hãy vào Game, mở Rương đồ chung, sau đó thoát Game rồi nhận thưởng.";
    exit();
}
$warehouse_fetch = $warehouse_result->FetchRow();
$warehouse = $warehouse_fetch[0];
$warehouse = bin2hex($warehouse);
$warehouse = strtoupper($warehouse);

$warehouse1 = substr($warehouse,0,120*32);
$warehouse2 = substr($warehouse,120*32);

$trade	= 1;
$sell	= 1;
$repair	= 1;

switch ($giftcode_type) {
	// GiftCode Reset
    case 1:
        if($giftcode_name != $name) {
            echo "GiftCode $gift_code không phải của nhân vật $name . Không thể nhận thưởng."; exit();
        }
        include_once("config/config_giftcode_rs.php");
        switch ($giftcode_rs_use){
        	case 1:
                $file_giftcode = 'config/giftcode_random_type1.txt';
        	break;

        	case 2:
                $file_giftcode = 'config/giftcode_random_type2.txt';
        	break;

        	case 3:
                $file_giftcode = 'config/giftcode_random_type3.txt';
        	break;

        	default :  echo "Chức năng GiftCode Reset không sử dụng"; exit();
        }

        //Đọc File GiftCode
    	$slg_item = 0;
    	if(is_file($file_giftcode)) {
    		$fopen_host = fopen($file_giftcode, "r");
    		while (!feof($fopen_host)) {
    			$get_item = fgets($fopen_host,1000);
    			$get_item = preg_replace('(\n)', '', $get_item);
    			if($get_item) {
    				$item_info = explode('|', $get_item);
    				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
    				    $check_stat = substr($get_item,0,2);
        				if($check_stat == '//') $stat = 0;
        				else $stat = 1;
        				if($stat == 1) {
        				    $slg_item++;
            				$item_read[] = array (
            					'code'	=> $item_info[1],
            					'rate'	=> $item_info[3]
            				);
                            $gift_des[] = $item_info[2];
        				}
    				}
    			}
    		}
    	} else $fopen_host = fopen($filename, "w");
    	fclose($fopen_host);

	break;

    // GiftCode Week
	case 2:
        if($giftcode_acc != $login) {
            echo "Giftcode $giftcode không phải của tài khoản $login. Không thể nhận thưởng"; exit();
        }
        include_once("config/config_giftcode_week.php");
        switch ($giftcode_week_use){
        	case 1:
                $file_giftcode = 'config/giftcode_random_type1.txt';
        	break;

        	case 2:
                $file_giftcode = 'config/giftcode_random_type2.txt';
        	break;

        	case 3:
                $file_giftcode = 'config/giftcode_random_type3.txt';
        	break;

        	default :  echo "Chức năng GiftCode tuần không sử dụng"; exit();
        }

        //Đọc File GiftCode
    	$slg_item = 0;
    	if(is_file($file_giftcode)) {
    		$fopen_host = fopen($file_giftcode, "r");
    		while (!feof($fopen_host)) {
    			$get_item = fgets($fopen_host,1000);
    			$get_item = preg_replace('(\n)', '', $get_item);
    			if($get_item) {
    				$item_info = explode('|', $get_item);
    				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
    				    $check_stat = substr($get_item,0,2);
        				if($check_stat == '//') $stat = 0;
        				else $stat = 1;
        				if($stat == 1) {
        				    $slg_item++;
            				$item_read[] = array (
            					'code'	=> $item_info[1],
            					'rate'	=> $item_info[3]
            				);
                            $gift_des[] = $item_info[2];
        				}
    				}
    			}
    		}
    	} else $fopen_host = fopen($filename, "w");
    	fclose($fopen_host);

	break;

	// GiftCode Month
    case 3:
        if($giftcode_acc != $login) {
            echo "Giftcode $giftcode không phải của tài khoản $login. Không thể nhận thưởng"; exit();
        }
        include_once("config/config_giftcode_month.php");
        switch ($giftcode_month_use){
        	case 1:
                $file_giftcode = 'config/giftcode_random_type1.txt';
        	break;

        	case 2:
                $file_giftcode = 'config/giftcode_random_type2.txt';
        	break;

        	case 3:
                $file_giftcode = 'config/giftcode_random_type3.txt';
        	break;

        	default :  echo "Chức năng GiftCode tháng không sử dụng"; exit();
        }

        //Đọc File GiftCode
    	$slg_item = 0;
    	if(is_file($file_giftcode)) {
    		$fopen_host = fopen($file_giftcode, "r");
    		while (!feof($fopen_host)) {
    			$get_item = fgets($fopen_host,1000);
    			$get_item = preg_replace('(\n)', '', $get_item);
    			if($get_item) {
    				$item_info = explode('|', $get_item);
    				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
    				    $check_stat = substr($get_item,0,2);
        				if($check_stat == '//') $stat = 0;
        				else $stat = 1;
        				if($stat == 1) {
        				    $slg_item++;
            				$item_read[] = array (
            					'code'	=> $item_info[1],
            					'rate'	=> $item_info[3]
            				);
                            $gift_des[] = $item_info[2];
        				}
    				}
    			}
    		}
    	} else $fopen_host = fopen($filename, "w");
    	fclose($fopen_host);

	break;

    // GiftCode Acc
	case 4:
        if($giftcode_acc != $login) {
            echo "Giftcode $giftcode không phải của tài khoản $login. Không thể nhận thưởng"; exit();
        }
        include_once("config/config_giftcode_acc.php");
        switch ($giftcode_acc_use){
        	case 1:
                $file_giftcode = 'config/giftcode_random_type1.txt';
        	break;

        	case 2:
                $file_giftcode = 'config/giftcode_random_type2.txt';
        	break;

        	case 3:
                $file_giftcode = 'config/giftcode_random_type3.txt';
        	break;

        	default :  echo "Chức năng GiftCode Tài Khoản không sử dụng"; exit();
        }

        //Đọc File GiftCode
    	$slg_item = 0;
    	if(is_file($file_giftcode)) {
    		$fopen_host = fopen($file_giftcode, "r");
    		while (!feof($fopen_host)) {
    			$get_item = fgets($fopen_host,1000);
    			$get_item = preg_replace('(\n)', '', $get_item);
    			if($get_item) {
    				$item_info = explode('|', $get_item);
    				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
    				    $check_stat = substr($get_item,0,2);
        				if($check_stat == '//') $stat = 0;
        				else $stat = 1;
        				if($stat == 1) {
        				    $slg_item++;
            				$item_read[] = array (
            					'code'	=> $item_info[1],
            					'rate'	=> $item_info[3]
            				);
                            $gift_des[] = $item_info[2];
        				}
    				}
    			}
    		}
    	} else $fopen_host = fopen($filename, "w");
    	fclose($fopen_host);

	break;

    //GiftCode Phat
    case 5:
        include_once("config/config_giftcode_phat.php");
        switch ($giftcode_phat_use){
        	case 1:
                $file_giftcode = 'config/giftcode_random_type1.txt';
        	break;

        	case 2:
                $file_giftcode = 'config/giftcode_random_type2.txt';
        	break;

        	case 3:
                $file_giftcode = 'config/giftcode_random_type3.txt';
        	break;

        	default :  echo "Chức năng GiftCode Phát không sử dụng"; exit();
        }

        //Đọc File GiftCode
    	$slg_item = 0;
    	if(is_file($file_giftcode)) {
    		$fopen_host = fopen($file_giftcode, "r");
    		while (!feof($fopen_host)) {
    			$get_item = fgets($fopen_host,1000);
    			$get_item = preg_replace('(\n)', '', $get_item);
    			if($get_item) {
    				$item_info = explode('|', $get_item);
    				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
    				    $check_stat = substr($get_item,0,2);
        				if($check_stat == '//') $stat = 0;
        				else $stat = 1;
        				if($stat == 1) {
        				    $slg_item++;
            				$item_read[] = array (
            					'code'	=> $item_info[1],
            					'rate'	=> $item_info[3]
            				);
                            $gift_des[] = $item_info[2];
        				}
    				}
    			}
    		}
    	} else $fopen_host = fopen($filename, "w");
    	fclose($fopen_host);

	break;

    // GiftCode Tan thu
    case 9:
        include_once("config/config_giftcode_tanthu.php");
        $class_check_query = "SELECT Class FROM Character WHERE Name='$name'";
        $class_check_result = $db->Execute($class_check_query);
            check_queryerror($class_check_query, $class_check_result);
        $class_check = $class_check_result->FetchRow();

        $ClassType =  $class_check[0];
        switch ($ClassType){
        	case 0:
            case 1:
            case 2:
            case 3:
                $GiftCode = $gift_dw;
                $msg_giftcode = $msg_dw;
        	break;

        	case 16:
            case 17:
            case 18:
            case 19:
                $GiftCode = $gift_dk;
                $msg_giftcode = $msg_dk;
        	break;

        	case 32:
            case 33:
            case 34:
            case 35:
                $GiftCode = $gift_elf;
                $msg_giftcode = $msg_elf;
        	break;

            case 48:
            case 49:
            case 50:
                $GiftCode = $gift_mg;
                $msg_giftcode = $msg_mg;
        	break;

            case 64:
            case 65:
            case 66:
                $GiftCode = $gift_dl;
                $msg_giftcode = $msg_dl;
        	break;

            case 80:
            case 81:
            case 82:
            case 83:
                $GiftCode = $gift_sum;
                $msg_giftcode = $msg_sum;
        	break;

            case 96:
            case 97:
            case 98:
                $GiftCode = $gift_rf;
                $msg_giftcode = $msg_rf;
        	break;

        	default :  echo "Lớp nhân vật chưa định nghĩa."; exit();
        }
            $item_read[] = array (
				'code'	=> $GiftCode,
				'rate'	=> 1
			);
            $gift_des[] = $msg_giftcode;
        $trade	= 0;
        $sell	= 0;
        $repair	= 0;
	break;

	// GifCode Up Reset
    case 20:
        include_once("config/config_giftcode_up_reset.php");
        $msquery_update_resets = "UPDATE Character SET [Resets] = $gift_reset_up_to WHERE AccountID = '$login' and name = '$name'";
        $db->Execute($msquery_update_resets) or die("Lỗi Query: $msquery_update_resets");

        $giftcode_update_query = "UPDATE GiftCode SET name='$name', acc='$login', status=2, gift_timeuse='$timestamp' WHERE gift_code='$gift_code' AND status=1 AND type=$giftcode_type";
        $giftcode_update_result = $db->Execute($giftcode_update_query);
        check_queryerror($giftcode_update_query, $giftcode_update_result);

        //Ghi vào Log
        $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
        check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();

        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "Tài khoản $login đã đổi GiftCode $gift_code cho nhân vật : $name. và tăng Reset lên $gift_reset_up_to lần";
        $log_time = $timestamp;

        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
        check_queryerror($insert_log_query, $insert_log_result);
        //End Ghi vào Log

        echo "Bạn đã đổi thành công GiftCode cho nhân vật <strong>$name</strong>.<br>Nhân vật <strong>$name</strong> vừa tăng Reset thành $gift_reset_up_to lần";
        exit();
        break;
	default : echo "Mã GiftCode không đúng loại."; exit();
}

include_once('config_license.php');
include_once('func_getContent.php');
$getcontent_url = $url_license . "/api_giftcode_change.php";
$getcontent_data = array(
    'acclic'    =>  $acclic,
    'key'    =>  $key,

    'item_read'    =>  json_encode($item_read),
    'warehouse1'   =>  $warehouse1
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
        $message = read_TagName($reponse, 'msg');
        echo $message;
        exit();
    } elseif($info == "OK") {
        $item_choise = read_TagName($reponse, 'item_choise');
        $item_gift = read_TagName($reponse, 'item_gift');
        if(strlen($item_choise) == 0) {
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
$item_gift_arr = json_decode($item_gift, true);
$msg_giftcode = $gift_des[$item_choise];

$itemgift_count = count($item_gift_arr);
if($itemgift_count > 0) {

    $warehouse1_new = $warehouse1;
    for($i=0; $i<$itemgift_count; $i++) {
        $item = $item_gift_arr[$i]['code'];

        $item_seri = substr($item, 6, 8);
        $item_seri_dec = hexdec($item_seri);

        if($repair == 0) {
            $item = substr_replace($item, 'FFFFFFFF', 6, 8);
        } elseif($item_seri_dec < 4294967280) {
        	$serial = _getSerial();
        	$item = substr_replace($item, $serial, 6, 8);
        }
        $warehouse1_new = substr_replace($warehouse1_new, $item, $item_gift_arr[$i]['vitri']*32, 32);
    }
kiemtra_online($login);

    $warehouse_new = $warehouse1_new . $warehouse2;

    $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
    $warehouse_update_result = $db->Execute($warehouse_update_query);
        check_queryerror($warehouse_update_query, $warehouse_update_result);

    $giftcode_update_query = "UPDATE GiftCode SET name='$name', acc='$login', status=2, gift_timeuse='$timestamp' WHERE gift_code='$gift_code' AND status=1 AND type=$giftcode_type";
    $giftcode_update_result = $db->Execute($giftcode_update_query);
        check_queryerror($giftcode_update_query, $giftcode_update_result);

    //Ghi vào Log
    		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
            $info_log_result = $db->Execute($info_log_query);
                check_queryerror($info_log_query, $info_log_result);
            $info_log = $info_log_result->fetchrow();

            $log_acc = "$login";
            $log_gcoin = $info_log[0];
            $log_gcoin_km = $info_log[1];
            $log_vpoint = $info_log[2];
            $log_price = "-";
            $log_Des = "Tài khoản $login đã đổi GiftCode $gift_code cho nhân vật : $name. Phần thưởng GiftCode: $msg_giftcode";
            $log_time = $timestamp;

            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
            $insert_log_result = $db->execute($insert_log_query);
                check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log nhung nhan vat mua Item

    echo "Bạn đã đổi thành công GiftCode cho nhân vật <strong>$name</strong>.<br>Phần thưởng GiftCode: $msg_giftcode";

} else {
    echo "Mã GiftCode không đúng định dạng."; exit();
}
}
$db->Close();
?>