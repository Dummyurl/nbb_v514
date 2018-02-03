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
include('config/config_giftcode_rs.php');

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

	default :  $file_giftcode = 'config/giftcode_random_type1.txt';
}

    //Đọc File GiftCode
	$slg_item = 0;
	if(is_file($file_giftcode)) {
		$fopen_host = fopen($file_giftcode, "r");
		$total_rate = 0;
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
        				$total_rate += $item_info[3];
        				$item_read[] = array (
        					'des'	=> $item_info[2],
        					'rate'	=> $item_info[3],
        					'stat'	=> $stat
        				);
    				}
				}
			}
		}
	} else $fopen_host = fopen($filename, "w");
	fclose($fopen_host);
    
    for($i=0; $i<count($item_read); $i++) {
        $item_read[$i]['rate'] = floor($item_read[$i]['rate']*100/$total_rate);
    }

$page_template = "templates/event/giftcode_rs.tpl";
?>