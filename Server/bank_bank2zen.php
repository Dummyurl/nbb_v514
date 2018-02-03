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
include_once ('config.php');
include_once ('function.php');

$login = $_POST['login'];
$name = $_POST['name'];
$zen = $_POST['zen'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_doinv($login,$name);

$sql_zen_check = $db->Execute("SELECT Money FROM Character WHERE AccountID = '$login' AND Name='$name'");
$zen_check = $sql_zen_check->fetchrow();

$sql_zenbank_check = $db->Execute("SELECT bank FROM MEMB_INFO WHERE memb___id = '$login'");
$zenbank_check = $sql_zenbank_check->fetchrow();

$ktzen = $zen_check[0] + $zen;
$ktzenbank = $zenbank_check[0] - $zen;

if ($ktzen > 2000000000){ 
 echo "Số Zen trong nhân vật sau khi rút tiền vượt quá mức cho phép tối đa 2 tỷ Zen."; exit();
}

if ($ktzenbank < 0){ 
 echo "Số Zen trong ngân hàng không còn đủ để rút."; exit();
}

kiemtra_doinv($login,$name);

$msquery = $db->Execute("Update Character SET [Money] = '$ktzen' WHERE AccountID = '$login' AND Name='$name'");
$msquery1 = $db->Execute("Update MEMB_INFO SET [bank] = '$ktzenbank' WHERE memb___id = '$login'");


	echo "OK<nbb>Rút Zen từ ngân hàng thành công.";
}
$db->Close();
?>