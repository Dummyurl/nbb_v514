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
 
//Delete Data OPD Acc
$opd_delete = $db->Execute("DELETE FROM OnePassDay WHERE acc='$taikhoan'");

//Create One Pass Day

$pass = rand(111111,999999);

$pass_md5 = md5($pass);
$insert_opd = $db->Execute("INSERT INTO OnePassDay (acc,opd,time) VALUES ('$taikhoan','$pass_md5',$timestamp)");

$opd_timeuse = date('H:i d/m', $timestamp + 24*60*60);

$content = "Mat khau OPD cua tai khoan $taikhoan : $pass . Mat khau OPD co hieu luc den : $opd_timeuse";

?>