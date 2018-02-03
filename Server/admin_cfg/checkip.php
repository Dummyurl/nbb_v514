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
 
SESSION_start();
include('adm_pass.php');
$file_listip = "listip.txt";

if(!is_file($file_listip)) 
{ 
	$fp_host = fopen($file_listip, "w");
	fclose($fp_host);
}
if(!is_file($file_listip)) 
{ 
	echo "<center>Khong the tao file <b>$file_listip</b> . Vui long tao file <b>$file_listip</b> dat vao trong thu muc <b>admin</b> va chuyen <b>File permission</b> cua file <b>$file_listip</b> sang <b>666</b><br><img src='images/chmod.jpg'></center>"; 
	exit();
}
if(!is_writable($file_listip)) 
{ 
	echo "<center>File <b>$file_listip</b> khong the ghi. Vui long su dung chuong trinh <a href='http://filezilla-project.org/download.php' target='_blank'><b>FileZilla</b></a> chuyen <b>File permission</b> cua file <b>$file_listip</b> sang <b>666</b><br><img src='../images/chmod.jpg'></center>"; 
	exit(); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Kiểm tra IP</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
$fopen_ip = fopen($file_listip, "r");

while ( !feof($fopen_ip) )
	{
		$read_ip = fgets($fopen_ip,50);
		$list_ip[] = $read_ip;
	}
	fclose($fopen_ip);

if ( in_array($_SERVER['REMOTE_ADDR'], $list_ip) ){ 
        echo "<center>IP của bạn đã được cập nhập sẵn.</center>";
    }
else {
	if ($_POST['submit']) {
		$code = md5($_POST[code]);
		if ($code == $pass_checkip) $_SESSION['code'] = $pass_checkip;
	}
	if (!$_SESSION['code'] || $_SESSION['code'] != $pass_checkip) {
		echo "<center><form action='' method='post'>
		Code: <input type='password' name='code'> <input type='submit' name='submit' value='Submit'>
		</form></center>
		";
		exit;
	}
		$new_ip = $_SERVER['REMOTE_ADDR'];
		$fp = fopen($file_listip, "a+");  
		fputs ($fp, "$new_ip\n");  
		fclose($fp);
		echo "<center>IP của bạn đã được cập nhập thành công.</center>";
}
?>
</body>
</html>