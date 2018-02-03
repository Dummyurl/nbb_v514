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
 

$login = $_POST['login'];
$name = $_POST['name'];
$point = $_POST['point'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_char($login,$name);
kiemtra_doinv($login,$name);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$sql_char_check = $db->Execute("SELECT LevelUpPoint,pointdutru FROM Character WHERE Name='$name' and AccountID = '$login'"); 
$char_check = $sql_char_check->fetchrow(); 


$point_free = $char_check[0] + $point;
$point_dutru_after = $char_check[1] - $point;

if ( $point_free > 32000 ) {
	echo "Lỗi. Số Point chưa cộng hiện tại trên nhân vật $char_check[0] Point. Bạn muốn rút $point Point. Sau khi rút Point, số Point chưa cộng trên nhân vật $point_free lớn hơn 32000."; exit();
}
if ( $point_dutru_after < 0 ) {
	echo "Lỗi. Số point cần rút vượt quá số Point dự trữ."; exit();
}

kiemtra_doinv($login,$name);

$msquery = "UPDATE Character SET LevelUpPoint='$point_free', pointdutru='$point_dutru_after' WHERE Name = '$name'";
$msresults= $db->Execute($msquery) or die("Lỗi Query: $msquery");


	echo "OK<nbb>$name đã rút $point Point thành công.";
}

?>