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

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";

$inventory_result_sql = $db->Execute($inventory_query);
$inventory_result = $inventory_result_sql->fetchrow();

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
    
    $inventory_fresh = "";
    for($i=0; $i<strlen($inventory); $i++) {
        $inventory_fresh .= "F";
    }
		
		$sql_inventory = "Update dbo.character set [inventory]=0x$inventory_fresh where name='$name'";

$rs_inventory = $db->Execute($sql_inventory) or die("Lỗi Query: $sql_inventory");

	echo "<netbanbe>OK<netbanbe>Xóa đồ nhân vât <strong>$name</strong> thành công<netbanbe>";

}

?>