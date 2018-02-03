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
$location = $_POST['location'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

switch ($location)
{
	case "loren":	$MapNumber=0;	$MapPosX=143;	$MapPosY=134;	$Mapdir=0;	$MapName='Lorencia';	break;
	case "noria":	$MapNumber=3;	$MapPosX=175;	$MapPosY=100;	$Mapdir=4;	$MapName='Noria';	break;
	default: $MapNumber=0;	$MapPosX=143;	$MapPosY=134;	$Mapdir=0;	break;
}

kiemtra_char($login,$name);

	$msquery = "UPDATE Character SET [MapNumber]='$MapNumber',[MapPosX]='$MapPosX',[MapPosY]='$MapPosY',[MapDir]='$Mapdir' WHERE Name = '$name'";
	$msresults= $db->Execute($msquery) or die("Lỗi Query: $msquery");
	

	echo "$name đã di chuyển đến $MapName thành công.";
}

?>