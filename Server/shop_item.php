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
$act = $_POST['act'];
$item=$_POST["item"];
$slg=$_POST["slg"];
$pass2 = $_POST['pass2'];


$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

	switch ($act)
	{
		case 'shop_taphoa': 
			$file_shop = 'config/shop_taphoa.txt';
			$file_log = 'shop_taphoa.php';
			break;
		case 'shop_event': 
			$file_shop = 'config/shop_event.txt';
			$file_log = 'shop_event.php';
			break;
		case 'shop_acient': 
			$file_shop = 'config/shop_acient.txt';
			$file_log = 'shop_acient.php';
			break;
		case 'shop_kiem': 
			$file_shop = 'config/shop_kiem.txt';
			$file_log = 'shop_kiem.php';
			break;
		case 'shop_gay': 
			$file_shop = 'config/shop_gay.txt';
			$file_log = 'shop_gay.php';
			break;
		case 'shop_cung': 
			$file_shop = 'config/shop_cung.txt';
			$file_log = 'shop_cung.php';
			break;
		case 'shop_vukhikhac': 
			$file_shop = 'config/shop_vukhikhac.txt';
			$file_log = 'shop_vukhikhac.php';
			break;
		case 'shop_khien': 
			$file_shop = 'config/shop_khien.txt';
			$file_log = 'shop_khien.php';
			break;
		case 'shop_mu': 
			$file_shop = 'config/shop_mu.txt';
			$file_log = 'shop_mu.php';
			break;
		case 'shop_ao': 
			$file_shop = 'config/shop_ao.txt';
			$file_log = 'shop_ao.php';
			break;
		case 'shop_quan': 
			$file_shop = 'config/shop_quan.txt';
			$file_log = 'shop_quan.php';
			break;
		case 'shop_tay': 
			$file_shop = 'config/shop_tay.txt';
			$file_log = 'shop_tay.php';
			break;
		case 'shop_chan': 
			$file_shop = 'config/shop_chan.txt';
			$file_log = 'shop_chan.php';
			break;
		case 'shop_trangsuc': 
			$file_shop = 'config/shop_trangsuc.txt';
			$file_log = 'shop_trangsuc.php';
			break;
		case 'shop_canh': 
			$file_shop = 'config/shop_canh.txt';
			$file_log = 'shop_canh.php';
			break;
		default: $file_shop = ''; break;
	}
	
	//Đọc File Shop
	$stt = 0;
	$accept = 0;
	if(is_file($file_shop)) 
	{
		$fopen_host = fopen($file_shop, "r");
		while (!feof($fopen_host)) {
			$item_get = fgets($fopen_host,200);
            $item_get = preg_replace('(\n)', '', $item_get);
            $item_get = trim($item_get);
            if(substr($item_get,0,2) != '//') {
                $item_info = explode('|', $item_get);
    			if ($item == $item_info[0]) {
    				$item_code=$item_info[1];	
    				$item_name=$item_info[2];	
    				$gia=$item_info[3];
    				$target_x = $item_info[4];
    				$target_y = $item_info[5];
    				$accept = 1;
    				break;
    			}
            }
		}
	} else $fopen_host = fopen($file_shop, "w");
	fclose($fopen_host);

if($accept == 0) { echo "Trên Server không có Item bạn muốn mua. Chi tiết vui lòng liên hệ BQT để cập nhập."; exit(); }
	
kiemtra_pass2($login,$pass2);
kiemtra_doinv($login,$name);
	
$query = "select vpoint from MEMB_INFO WHERE memb___id='$login'";
$result = $db->Execute( $query );
$row = $result->fetchrow();
$vpoint_before = $row[0];

$inventory_result_sql = $db->Execute("SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'");
$inventory_result = $inventory_result_sql->fetchrow();


$gias = $slg*$gia;
$check=$row[0]-$gias;

if( $check < 0 ){
echo "Bạn đang có $row[0] Vpoint. $slg đồ $item_name giá $gias Vpoint.<br>Bạn còn thiếu $check Vpoint"; exit(); }
 

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
$inventory1 = substr($inventory,0,12*32);
$inventory2 = substr($inventory,12*32,64*32);
$inventory3 = substr($inventory,76*32);

// o Item
for($x=1; $x<=8; $x++) {
    for($y=1; $y<=8; $y++) {
        $o[$x][$y] = substr($inventory2,(($x-1)*8+$y-1)*32,32);
    }
}
// End o Item
$no_item = 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF';

// So Item tren 1 hang
$itemperrow = floor(8/$target_x);
// So Item tren 1 cot
$itempercolumn = floor(8/$target_y);

$err_check = false;

$item_slgmax = $itemperrow*$itempercolumn;
if($slg > $item_slgmax) {
    echo "Số lượng Item chọn $slg lớn hơn số lượng Item tối đa $item_slgmax";
    $err_check = true;
    exit();
}

if($err_check == false) {
    
    // So hang Item can mua
    $rowitem = ceil($slg/$itemperrow);
    // So Item o hang cuoi cung
    $iteminlastrow = $slg - $itemperrow*($rowitem-1);
    
    $item_code_general = array();
    $log_seri = '';
    for($i=0;$i<$slg;++$i){
        $items = "";
        $oitem = floor(strlen($item_code)/32);
    
        for($j=0; $j<$oitem; $j++) {
            $item = substr($item_code, $j*32, 32);
            if($item != "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF") {
            	$serial = _getSerial();
                $log_seri .= $serial . ', ';
            	$item = substr_replace($item, $serial, 6, 8);
            }
            $items .= $item;
        }
    	$item_code_general[] = $items;
    }
    
    $itemreplace = 0;
    // Kiem tra o item va nhung o lien quan o hang FULL Item
    for($i_row=1; $i_row<=$rowitem-1; $i_row++) {
        for($i_column=1; $i_column<=$itemperrow; $i_column++) {
            // Toa do o chua Item
            $item_x = 1+($i_row-1)*$target_y;
            $item_y = 1+($i_column-1)*$target_x;
            // Kiem tra o chua Item can thiet khong mang code
            for($x_extra=$item_x; $x_extra<$item_x+$target_y; $x_extra++) {
                for($y_extra=$item_y; $y_extra<$item_y+$target_x; $y_extra++) {
                    if($o[$x_extra][$y_extra] != $no_item) {
                        echo "Có đồ trong hành trang ( $x_extra,$y_extra ). Hãy cất đồ trước khi mua để tránh mất mát đáng tiếc";
                        $err_check = true;
                        exit();
                    }
                }
            }
            if($err_check == true) break;
            else {
                $o[$item_x][$item_y] = $item_code_general[$itemreplace];
                $itemreplace ++;
            }
        }
        if($err_check == true) break;
    }
    
    if($err_check == false) {
        // Kiem tra o item va nhung o lien quan o hang cuoi cung
        $slg_item_less = $slg - $itemreplace;
        if($slg_item_less > 0) {
            $item_x = 1+($rowitem-1)*$target_y;
            for($i_column=1; $i_column<=$slg_item_less; $i_column++) {
                $item_y = 1+($i_column-1)*$target_x;

                // Kiem tra o chua Item can thiet khong mang code
                for($x_extra=$item_x; $x_extra<$item_x+$target_y; $x_extra++) {
                    for($y_extra=$item_y; $y_extra<$item_y+$target_x; $y_extra++) {
                        if($o[$x_extra][$y_extra] != $no_item) {
                            echo "Có đồ trong hành trang ( $x_extra,$y_extra ). Hãy cất đồ trước khi mua để tránh mất mát đáng tiếc.";
                            $err_check = true;
                            exit();
                        }
                    }
                }
                if($err_check == true) break;
                else {
                    $o[$item_x][$item_y] = $item_code_general[$itemreplace];
                    $itemreplace ++;
                }
            }
        }
    }
}

if($err_check == false) {

    $inventory2_after = "";
    for($x=1; $x<=8; $x++) {
        for($y=1; $y<=8; $y++) {
            $inventory2_after .= $o[$x][$y];
        }
    }
    
    $inventory_after = $inventory1.$inventory2_after.$inventory3;

kiemtra_doinv($login,$name);

    $general = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
    $msgeneral = $db->Execute($general) or die("Loi query: $general");
    
    $general1 = "UPDATE MEMB_INFO SET vpoint = $check WHERE memb___id='$login'";
    $msgeneral1 = $db->Execute($general1);
    
    _use_money($login, 0, 0, $vpoint_before - $check);
    
    //Ghi vào Log nhung nhan vat mua Item
    		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
            $info_log_result = $db->Execute($info_log_query);
                check_queryerror($info_log_query, $info_log_result);
            $info_log = $info_log_result->fetchrow();
            
            $log_acc = "$login";
            $log_gcoin = $info_log[0];
            $log_gcoin_km = $info_log[1];
            $log_vpoint = $info_log[2];
            $log_price = "- $gias Vpoint";
            $log_Des = "Mua $slg vật phẩm $item_name .Seri: $log_seri";
            $log_time = $timestamp;
            
            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
            $insert_log_result = $db->execute($insert_log_query);
                check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log nhung nhan vat mua Item
    
    echo "OK<nbb>$gias<nbb>Bạn đã mua thành công $slg Item $item_name. Bạn đã bị trừ $gias V.Point.<br>Nếu muốn mua tiếp đồ, bạn cần vào Game bỏ đồ vừa mua vào Rương trước khi mua tiếp.";
}
    
}
$db->Close();
?>