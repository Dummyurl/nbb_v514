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
$passadmin			=		'e10adc3949ba59abbe56e057f20f883e';		//Pass để vào xem các trang: Log, Admin. Sử dụng dạng mã hóa MD5
$passviewcard		=		'e10adc3949ba59abbe56e057f20f883e';		//Pass để vào xem các trang: View Card. Sử dụng dạng mã hóa MD5
$passcard			=		'e10adc3949ba59abbe56e057f20f883e';		//Pass để vào xem các trang: CardPhone. Sử dụng dạng mã hóa MD5
$passcode			=		'e10adc3949ba59abbe56e057f20f883e';		//Pass để vào xem các trang: Online, CheckIP. Sử dụng dạng mã hóa MD5
$server_md5			=		0;			// 1: Sử dụng md5, 0: không sử dụng md5
$type_acc			=		0;			// 1: Tài khoản chỉ sử dụng số, 0: Tài khoản sử dụng cả số lẫn chữ
$transfercode		= 		'netbanbe';		// Mã so sánh nhận dữ liệu với Client
$server_wz = 0;		//0-Server SCF (Phat trien tu WebZen SS3) | 1-Server phat trien tu WebZen SS4 (ENC)
//Cach kiem tra loai Server
// Vao Database MuOnline > Character : Design Table
// Trong Table Character neu co : SCFMasterLevel, SCFMasterPoints => La Server SCF
// Vao Database MuOnline : Neu co Table T_MasterLevelSystem => La Server phat trien tu WebZen SS4 (ENC)

//Danh sách IP của Hosting cho phép truy cập vào Web trên Server
$list_ip = array(
	"127.0.0.1",		// Local
	"123.123.123.123"	// Hosting
	);

date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time();

$day = date("d",$timestamp);
$month = date("m",$timestamp);
$year = date("Y",$timestamp);

include_once("adodb/adodb.inc.php");

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
include_once('config/config_dongbo.php');
//Nạp thẻ
$Card_per_page = 30; // Số lượng card tren 1 trang. 
$datedisplay = 'd/m/Y';	//Kiểu ngày tháng hiển thị
	
//Danh sách các Server:
$server[]	=	'Sub-1';	//Tên Sub lấy trong GameServer1\Data\ServerInfo.dat : ServerName
$server[]	=	'Sub-2';	//Tên Sub lấy trong GameServer2\Data\ServerInfo.dat : ServerName
$server[]	=	'Sub-3';	//Tên Sub lấy trong GameServer3\Data\ServerInfo.dat : ServerName
$server[]	=	'Sub-4';	//Tên Sub lấy trong GameServer4\Data\ServerInfo.dat : ServerName

?>