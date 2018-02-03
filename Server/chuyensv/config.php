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
 
//Info Data
$type_connect		=		'odbc';			//Dạng kết nối Database: 'odbc' hoac 'mssql'
$localhost			=		'localhost';
$databaseuser		=		'sa';			//User quản lý SQL MuOnline (Thường là 'sa')
$databsepassword	=		'123456';		//Mật khẩu quản lý SQL MuOnline
$database			=		'MuOnline';		//Database MuOnline ('MuOnline' hoặc 'MeMuOnline')

include("../adodb/adodb.inc.php");

if($type_connect=='odbc'){
	$db = &ADONewConnection('odbc');
	$connect_mssql = $db->Connect($database,$databaseuser,$databsepassword);
	if (!$connect_mssql) die("Ket noi voi SQL Server loi! Hay kiem tra lai ODBC ton tai hoac User & Pass SQL dung.");
}

elseif($type_connect=='mssql'){
	if (extension_loaded('mssql'))
	{echo("");}
	else Die("Loi! Khong the load thu vien php_mssql.dll. Hay cho phep su dung php_mssql.dll trong php.ini");

	$db = &ADONewConnection('mssql');
	$connect_mssql = $db->Connect($localhost,$databaseuser,$databsepassword,$database);
	if (!$connect_mssql) die("Loi! Khong the ket noi SQL Server");

}

//Danh sách IP của Hosting cho phép truy cập vào Web trên Server
$list_ip = array(
	"127.0.0.1",		// Local
	"123.30.168.73"		// HOST
	);

if ( !in_array($_SERVER['REMOTE_ADDR'], $list_ip) ){ 
    echo "Khong co quyen truy cap";
    exit();
}

?>