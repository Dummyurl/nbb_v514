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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");

switch ($act)
{
	case 'shop_taphoa': 
		$file_shop = 'config/shop_taphoa.txt';
		$folder_img = 'shop_taphoa';
		$tilte = "Cửa hàng Tạp Hóa";
		break;
	case 'shop_event': 
		$file_shop = 'config/shop_event.txt';
		$folder_img = 'shop_event';
		$tilte = "Cửa hàng Vé Event";
		break;
	case 'shop_acient': 
		$file_shop = 'config/shop_acient.txt';
		$folder_img = 'shop_acient';
		$tilte = "Cửa hàng SET Thần Thánh";
		break;
	case 'shop_kiem': 
		$file_shop = 'config/shop_kiem.txt';
		$folder_img = 'shop_kiem';
		$tilte = "Cửa hàng Kiếm";
		break;
	case 'shop_gay': 
		$file_shop = 'config/shop_gay.txt';
		$folder_img = 'shop_gay';
		$tilte = "Cửa hàng Gậy";
		break;
	case 'shop_cung': 
		$file_shop = 'config/shop_cung.txt';
		$folder_img = 'shop_cung';
		$tilte = "Cửa hàng Cung";
		break;
	case 'shop_vukhikhac': 
		$file_shop = 'config/shop_vukhikhac.txt';
		$folder_img = 'shop_vukhikhac';
		$tilte = "Cửa hàng Vũ Khí Khác";
		break;
	case 'shop_khien': 
		$file_shop = 'config/shop_khien.txt';
		$folder_img = 'shop_khien';
		$tilte = "Cửa hàng Khiên";
		break;
	case 'shop_mu': 
		$file_shop = 'config/shop_mu.txt';
		$folder_img = 'shop_mu';
		$tilte = "Cửa hàng Mũ";
		break;
	case 'shop_ao': 
		$file_shop = 'config/shop_ao.txt';
		$folder_img = 'shop_ao';
		$tilte = "Cửa hàng Áo";
		break;
	case 'shop_quan': 
		$file_shop = 'config/shop_quan.txt';
		$folder_img = 'shop_quan';
		$tilte = "Cửa hàng Quần";
		break;
	case 'shop_tay': 
		$file_shop = 'config/shop_tay.txt';
		$folder_img = 'shop_tay';
		$tilte = "Cửa hàng Tay";
		break;
	case 'shop_chan': 
		$file_shop = 'config/shop_chan.txt';
		$folder_img = 'shop_chan';
		$tilte = "Cửa hàng Chân";
		break;
	case 'shop_trangsuc': 
		$file_shop = 'config/shop_trangsuc.txt';
		$folder_img = 'shop_trangsuc';
		$tilte = "Cửa hàng Trang Sức";
		break;
	case 'shop_canh': 
		$file_shop = 'config/shop_canh.txt';
		$folder_img = 'shop_canh';
		$tilte = "Cửa hàng Cánh";
		break;
	default: $file_shop = ''; break;
}
	
	if (isset($_POST['action']))
	{
		$action = $_POST['action'];
		if ($action == 'shop')
		{
			$character = $_POST['character'];
			$item = $_POST['item'];
			$slg = $_POST['slg'];
			$pass2 = $_POST['pass2'];
			
			if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
			elseif (empty($character))
			{
				$notice = "Chưa chọn nhân vật mua đồ";
			}
			elseif (preg_match("/[^a-zA-Z0-9_$]/", $character))
				{
					$notice = "Dữ liệu lỗi - Nhân vật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
				}
			elseif(empty($item)) {
				$notice = "Chưa chọn vé tham gia Event muốn mua";
			}
			elseif (preg_match("/[^a-zA-Z0-9_$]/", $item))
				{
					$notice = "Dữ liệu lỗi - Item chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
				}
			elseif(empty($slg)) {
				$notice = "Chưa chọn số lượng vé muốn mua";
			}
			elseif (preg_match("/[^0-9$]/", $slg))
			{
		    	$notice = "Dữ liệu lỗi : $slg . Số lượng Chỉ được sử dụng số (1-9)."; 
			}
			elseif (empty($pass2))
			{
				$notice = "Chưa nhập mật khẩu cấp 2";
			}
			elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2))
				{
					$notice = "Dữ liệu lỗi - Mật khẩu cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
				}
			else {
			
			$getcontent_url = $server_url . "/shop_item.php";
            $getcontent_data = array(
                'login'    =>  $_SESSION['mu_username'],
                'name'    =>  $character,
                'pass2'    =>  $pass2,
                'act'    =>  $act,
                'item'    =>  $item,
                'slg'    =>  $slg,
                'string_login'    =>  $_SESSION['checklogin'],
                'passtransfer'    =>  $passtransfer
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

				if ( empty($reponse) ) $notice = "Server bảo trì.";
				elseif($reponse == "login_other") {
					$notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
					session_destroy();
				}
				else {
					$info = explode('<nbb>',$reponse);
					if ($info[0] == 'OK') {
						$chiphi = $info[1];
						$notice = $info[2];
						$_SESSION['acc_vpoint'] = $_SESSION['acc_vpoint']-$chiphi;
					}
					else $notice = $reponse;
				}
			}
		}
	}
	//Đọc File Shop
	$slg_item = 0;
	$fopen_host = fopen($file_shop, "r");
	while (!feof($fopen_host)) {
		$item_get = fgets($fopen_host,200);
		$item_get = preg_replace('(\n)', '', $item_get);
        $item_get = trim($item_get);
        if(substr($item_get,0,2) != '//') {
    		$item_info = explode('|', $item_get);
    		
    		if(strlen($item_info[1]) == 32)
    		{
    			$item_read[] = array (
    				'key'	=> $item_info[0],
    				'code'	=> $item_info[1],
    				'des'	=> $item_info[2],
    				'price'	=> $item_info[3],
                    'x'	=> $item_info[4],
                    'y'	=> $item_info[5],
    				'img'	=> $item_info[6]
    			);
    			++$slg_item;
    		}
        }
	}
	fclose($fopen_host);
    
    $itemfirst_x = $item_read[0]['x'];  $itemfirst_x = abs(intval($itemfirst_x));
    $itemfirst_y = $item_read[0]['y'];  $itemfirst_y = abs(intval($itemfirst_y));
    if($itemfirst_x == 0) $itemfirst_x=1;
    if($itemfirst_y == 0) $itemfirst_y=1;
    
    // So Item tren 1 hang
    $itemperrow = floor(8/$itemfirst_x);
    // So Item tren 1 cot
    $itempercolumn = floor(8/$itemfirst_y);
    // So luong Item toi da
    $itemfirst_slg = $itemperrow*$itempercolumn;
    
	$page_template = "templates/webshop/shop_item.tpl";
?>