<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
$file_listip = "admin_cfg/listip.txt";
$fopen_ip = fopen($file_listip, "r");

while ( !feof($fopen_ip) )
	{
		$read_ip = fgets($fopen_ip,50);
		$read_ip = preg_replace('(\n)', '', $read_ip);
		$list_ip[] = $read_ip;
	}
	fclose($fopen_ip);
if ( !in_array($_SERVER['REMOTE_ADDR'], $list_ip) ){ 
        echo "Ban Khong Phai Thanh Vien BQT thi vao lam gi? he he";
        exit();
    }
?>