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
 

include_once('config/config_uplvitem.php');

$login = $_POST['login'];
$name = $_POST['name'];
$chao = $_POST['chao'];
$cre = $_POST['cre'];
$blue = $_POST['blue'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {
kiemtra_doinv($login,$name);
    $string_login = $_POST['string_login'];
    checklogin($login,$string_login);
    
if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

    $check_item_query = "SELECT jewel_chao, jewel_cre, jewel_blue FROM MEMB_INFO WHERE memb___id='$login'";
    $check_item_result = $db->Execute($check_item_query);
    $check_item_fetch = $check_item_result->FetchRow();
    $check_item_chao = $check_item_fetch[0];
    $check_item_cre = $check_item_fetch[1];
    $check_item_blue = $check_item_fetch[2];
    
    if( ($check_item_chao < $chao) || ($check_item_cre < $cre) || ($check_item_blue < $blue) ) {
        echo "Jewel trong ngân hàng ít hơn Jewel đưa vào nâng cấp đồ. Vui lòng đăng nhập lại tài khoản để cập nhập chính xác số Jewel hiện có trong ngân hàng."; 
        exit();
    } else {
        // Lấy dữ liệu trong iventory
        $inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";
        $inventory_result_sql = $db->Execute($inventory_query);
        $inventory_result = $inventory_result_sql->fetchrow();
        $inventory = $inventory_result[0];
        // Chuyển iventory từ bin -> hex
        $inventory = bin2hex($inventory);
        $inventory = strtoupper($inventory);
        // Lấy item đầu tiên trong túi đồ
        $item = substr($inventory,12*32,1*32);
        
        // Lấy thông tin Item
        $id 			= hexdec(substr($item,0,2)); 	// Item ID
        $group 			= hexdec(substr($item,18,1)); 	// Item Type

        // Lấy thông tin Level
        $iop 	= hexdec(substr($item,2,2)); 	// Item Level/Skill/Option Data
        // Kiểm tra LV Item
        if ($iop>128) $checklv	= $iop-128;
        else $checklv = $iop;
        $itemlevel	= floor($checklv/8);
        
        if($item == "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF") {
            echo "Không có Item ở vị trí đầu tiên trên hành trang.";
            exit();
        }
        if(in_array($group, array(0,1,2,3,4,5,6,7,8,9,10,11,15)) || ($group == 12 && in_array($id, array(0,1,2,3,4,5,6,36,37,38,39,40,41,42,43,49,50,130,131,132,133,134,135) ) ) || ($group == 13 && in_array($id, array(0,1,2,3,8,9,12,13,20,21,22,23,24,25,26,27,28,30,67,80,106,123) ) ) ) {
            if($itemlevel>=15 || $itemlevel>=$lvmax) {
                echo "Item đã đạt cấp độ tối đa +".$itemlevel." . Không thể nâng cấp cao hơn.";
                exit();
            } else {
                switch ($itemlevel) {
                    case 0:
                            $percent_chao = $lv1_chao;
                            $percent_cre = $lv1_cre;
                            $percent_blue = $lv1_blue;
                            $percent_max = $lv1_max;
                        break;
                    case 1:
                            $percent_chao = $lv2_chao;
                            $percent_cre = $lv2_cre;
                            $percent_blue = $lv2_blue;
                            $percent_max = $lv2_max;
                        break;
                    case 2:
                            $percent_chao = $lv3_chao;
                            $percent_cre = $lv3_cre;
                            $percent_blue = $lv3_blue;
                            $percent_max = $lv3_max;
                        break;
                    case 3:
                            $percent_chao = $lv4_chao;
                            $percent_cre = $lv4_cre;
                            $percent_blue = $lv4_blue;
                            $percent_max = $lv4_max;
                        break;
                    case 4:
                            $percent_chao = $lv5_chao;
                            $percent_cre = $lv5_cre;
                            $percent_blue = $lv5_blue;
                            $percent_max = $lv5_max;
                        break;
                    case 5:
                            $percent_chao = $lv6_chao;
                            $percent_cre = $lv6_cre;
                            $percent_blue = $lv6_blue;
                            $percent_max = $lv6_max;
                        break;
                    case 6:
                            $percent_chao = $lv7_chao;
                            $percent_cre = $lv7_cre;
                            $percent_blue = $lv7_blue;
                            $percent_max = $lv7_max;
                        break;
                    case 7:
                            $percent_chao = $lv8_chao;
                            $percent_cre = $lv8_cre;
                            $percent_blue = $lv8_blue;
                            $percent_max = $lv8_max;
                        break;
                    case 8:
                            $percent_chao = $lv9_chao;
                            $percent_cre = $lv9_cre;
                            $percent_blue = $lv9_blue;
                            $percent_max = $lv9_max;
                        break;
                    case 9:
                            $percent_chao = $lv10_chao;
                            $percent_cre = $lv10_cre;
                            $percent_blue = $lv10_blue;
                            $percent_max = $lv10_max;
                        break;
                    case 10:
                            $percent_chao = $lv11_chao;
                            $percent_cre = $lv11_cre;
                            $percent_blue = $lv11_blue;
                            $percent_max = $lv11_max;
                        break;
                    case 11:
                            $percent_chao = $lv12_chao;
                            $percent_cre = $lv12_cre;
                            $percent_blue = $lv12_blue;
                            $percent_max = $lv12_max;
                        break;
                    case 12:
                            $percent_chao = $lv13_chao;
                            $percent_cre = $lv13_cre;
                            $percent_blue = $lv13_blue;
                            $percent_max = $lv13_max;
                        break;
                    case 13:
                            $percent_chao = $lv14_chao;
                            $percent_cre = $lv14_cre;
                            $percent_blue = $lv14_blue;
                            $percent_max = $lv14_max;
                        break;
                    case 14:
                            $percent_chao = $lv15_chao;
                            $percent_cre = $lv15_cre;
                            $percent_blue = $lv15_blue;
                            $percent_max = $lv15_max;
                        break;
                }
                $percent_up = $percent_chao*$chao + $percent_cre*$cre + $percent_blue*$blue;
                if($percent_up>$percent_max) $percent_up = $percent_max;
                
                $jewel_chao_after = $check_item_chao - $chao;
                    if($jewel_chao_after < 0) $jewel_chao_after = 0;
                $jewel_cre_after = $check_item_cre - $cre;
                    if($jewel_cre_after < 0) $jewel_cre_after = 0;
                $jewel_blue_after = $check_item_blue - $blue;
                    if($jewel_blue_after < 0) $jewel_blue_after = 0;
                        
                $xoay = rand(1,100);
                $exe_query = 1;
                if($xoay>$percent_up) {
                    if($itemlevel==0) {
                        $notice = "OK<nbb>Nâng cấp đồ không thành công. Chúc bạn may mắn trong lần nâng cấp đồ tiếp theo.";
                        $exe_query = 0;
                        $itemlv_after = 0;
                        $log_Des = "<b>$name</b> UP Item thất bại từ cấp độ <b>$itemlevel</b> về <b>$itemlv_after</b>.";
                    } else {
                        // Trừ LV
                        $downlv = $iop-8;
                        // Chuyển ngược thông tin LV từ DEC -> HEX
                        $newop = dechex($downlv);
                        $itemlv_after = $itemlevel-1;
                        $notice = "OK<nbb>Nâng cấp đồ không thành công. Item bị giảm 1 cấp. Chúc bạn may mắn trong lần nâng cấp đồ tiếp theo.";
                        $log_Des = "<b>$name</b> UP Item thất bại từ cấp độ <b>$itemlevel</b> về <b>$itemlv_after</b>. <strong>Jewel trước</strong> : $check_item_chao Chao, $check_item_cre Cre, $check_item_blue Blue. <strong>Sử dụng</strong> : $chao Chao, $cre Cre, $blue Blue. <strong>Jewel sau</strong> : $jewel_chao_after Chao, $jewel_cre_after Cre, $jewel_blue_after Blue.";
                    }
                } else {
                    // Cộng LV
                    $uplv = $iop+8;
                    // Chuyển ngược thông tin LV từ DEC -> HEX
                    $newop = dechex($uplv);
                    $itemlv_after = $itemlevel+1;
                    $notice = "OK<nbb>Bạn đã nâng cấp đồ thành công. Bạn thật may mắn. Chúc bạn cũng gặp được may mắn trong lần nâng cấp đồ tiếp theo.";
                    $log_Des = "<b>$name</b> UP Item thành công từ cấp độ <b>$itemlevel</b> lên <b>$itemlv_after</b>. <strong>Jewel trước</strong> : $check_item_chao Chao, $check_item_cre Cre, $check_item_blue Blue. <strong>Sử dụng</strong> : $chao Chao, $cre Cre, $blue Blue. <strong>Jewel sau</strong> : $jewel_chao_after Chao, $jewel_cre_after Cre, $jewel_blue_after Blue.";
                }
                if($exe_query==1) {
                    // Kiểm tra độ dài thông tin LV, nếu chỉ có 1 ký tự thì thêm 0 đằng trước
                    if(strlen($newop) == 1) $newop = '0'.$newop;
                    // Thay thế thông tin LV mới vào chuỗi Item
                    $item_new = substr_replace($item, $newop, 2, 2);
                    // Thực hiện Update Iventory
                    $inventory_update = substr_replace($inventory, $item_new, 12*32, 1*32);
                    
                    $iventory_update_query = "UPDATE Character SET [inventory]=0x$inventory_update WHERE AccountID = '$login' AND Name='$name'";
                    $iventory_update_result = $db->Execute($iventory_update_query);
                        if($iventory_update_result === false) die("Query Error : $iventory_update_query");
                    
                    $update_jewelbank_query = "Update dbo.memb_info set [jewel_chao]=$jewel_chao_after,[jewel_cre]=$jewel_cre_after,[jewel_blue]=$jewel_blue_after where memb___id='$login'";
                    $update_jewelbank_result = $db->Execute($update_jewelbank_query);
                        if($update_jewelbank_result === false) die("Query Error : $update_jewelbank_query");
                
                    //Ghi vào Log nhung nhan vat UP Item
                    	$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                        $info_log_result = $db->Execute($info_log_query);
                            check_queryerror($info_log_query, $info_log_result);
                        $info_log = $info_log_result->fetchrow();
                        
                        $log_acc = "$login";
                        $log_gcoin = $info_log[0];
                        $log_gcoin_km = $info_log[1];
                        $log_vpoint = $info_log[2];
                        $log_price = " - ";
                        $log_Des = $log_Des;
                        $log_time = $timestamp;
                        
                        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                        $insert_log_result = $db->execute($insert_log_query);
                            check_queryerror($insert_log_query, $insert_log_result);
                    //End Ghi vào Log nhung nhan vat UP Item
                }
                echo $notice;
            }
        } else {
            echo "Item không được phép nâng cấp";
            exit();
        } 
    }
}

?>