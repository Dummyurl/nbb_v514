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
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('NetNWEB',true);
include('config/config.php');
include('includes/function.php');
	$getcontent_url = $server_url . "/checkonline.php";
    $getcontent_data = array(
        'passtransfer'    =>  $passtransfer
    ); 
    
    $CheckOnline_Reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php
echo '<b>Kiểm tra kết nối đến Server</b>';
if(isset($error)) echo "<p><font color='red'><strong>Lỗi</strong> : </font>$error</p>";
echo '<blockquote>';
echo 'Tình trạng: ';

	if (empty($CheckOnline_Reponse)) {
		echo '<font color=red>Không kết nối với Server. $server_url hiện tại : '.$server_url.' .<br>
		Kiểm tra lại <b>$server_url</b> trong file config.php trong phần Web Hosting và đảm bảo phần Web trên Server đang chạy.</font>';
	} elseif($CheckOnline_Reponse == 'Error') {
		echo '<font color=red>Mã so sánh giữa Web và Server không chính xác. Kiểm tra lại <b>$passtransfer</b> trong file config.php trong phần Web Hosting và <b>$transfercode</b> trong file config.php trong phần Web Server</font>';
	} elseif($CheckOnline_Reponse == 'OK') {
		echo '<font color=green><b>Kết nối đến Server thành công</b></font>';
	} elseif($CheckOnline_Reponse == 'Khong co quyen truy cap') {
		echo "<font color=green><b>Chưa cập nhập IP của Hosting trong <i>$list_ip</i> trong file <i>config.php</i> của phần WebServer</b> . Cách tìm IP của Hosting xem tại: <a href='http://muweb.netbanbe.net/index.php#domain2ip' target='_blank'>http://muweb.netbanbe.net/index.php#domain2ip</a></font>";
	} else {
		echo "<font color=red><b>$CheckOnline_Reponse</b></font>";
	}
echo '</blockquote>';
?>