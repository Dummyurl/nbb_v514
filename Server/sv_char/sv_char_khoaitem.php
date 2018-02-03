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
 

$login =  $_POST['login'];
$name =  $_POST['name'];
$action =  $_POST['action'];
$makhoado =  $_POST['makhoado'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_block_char($login,$name);

$query_checkkhoado = "SELECT khoado,makhoado,CtlCode,ErrorSubBlock FROM Character WHERE Name='$name'";
$result_checkkhoado = $db->Execute($query_checkkhoado);
$checkkhoado = $result_checkkhoado->fetchrow();

if ( $action == 'khoado' ) {
	if ( $checkkhoado[2] == '1' && $checkkhoado[3] == '1') {
		echo "Nhân vật bị Block do vào Server không đúng quy định - Không được phép sử dụng chức năng này"; exit();
	}
	elseif ( $checkkhoado[0] == '1' ) {
		echo "Nhân vật Đã khóa đồ."; exit();
	}
	else {
		$query_updatekhoado = "UPDATE dbo.Character SET [khoado]='1',[makhoado]='$makhoado',[CtlCode]='18' WHERE Name = '$name' AND AccountID = '$login'";
	}
}
elseif ( $action == 'mokhoado' ) {
	if ( $checkkhoado[2] == '1' && $checkkhoado[3] == '1') {
		echo "Nhân vật bị Block do vào Server không đúng quy định - Không được phép sử dụng chức năng này"; exit();
	}
	elseif ( $checkkhoado[0] == '0' ) {
		echo "Nhân vật Chưa khóa đồ."; exit();
	}
	elseif ( $checkkhoado[1] != $makhoado ) {
		echo "Mã khóa đồ không chính xác."; exit();
	}
	else {
		$query_updatekhoado = "UPDATE dbo.Character SET [khoado]='0',[CtlCode]='0' WHERE Name = '$name' AND AccountID = '$login'";
	}
}
elseif ( $action == 'editmakhoa' ) {
	if ( $checkkhoado[0] == '0' ) {
		echo "Nhân vật Chưa khóa đồ."; exit();
	}
	elseif ( $checkkhoado[1] == $makhoado ) {
		echo "Mã khóa đồ mới giống mã khóa đồ cũ."; exit();
	}
	else {
		$pass2 =  $_POST['pass2'];
		$query_updatekhoado = "UPDATE dbo.Character SET [makhoado]='$makhoado' WHERE Name = '$name' AND AccountID = '$login'";
	}
}

if ( $action == 'editmakhoa' ) {
	kiemtra_pass2($login,$pass2);
}
$updatekhoado= $db->Execute($query_updatekhoado);

	if ( $action == 'khoado' ) {
		echo "<info>OK</info><msg>$name khóa đồ thành công.</msg>";
	}
	elseif ( $action == 'mokhoado' ) {
		echo "<info>OK</info><msg>$name mở khóa đồ thành công.</msg>";
	}
	elseif ( $action == 'editmakhoa' ) {
		echo "<info>OK</info><msg>$name sửa mã khóa đồ thành công.</msg>";
	}
}

?>