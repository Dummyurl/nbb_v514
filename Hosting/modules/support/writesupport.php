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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");

if ( $_POST['action'] == 'sendsupport' )
{
	$supporttitle = $_POST['supporttitle'];
	$supportcontent = $_POST['supportcontent'];
	
    if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
	elseif (empty($supporttitle))
	{
		$notice = "Chưa nhập Tiêu đề Hỗ trợ";
	}
	elseif (empty($supportcontent))
	{
		$notice = "Chưa nhập Nội dung Hỗ trợ";
	}
	else {
        $support_add_query = "INSERT INTO support (AccountID, sup_title, sup_content, sup_timenew, sup_time) VALUES ('$_SESSION[mu_username]', '$supporttitle', '$supportcontent', $time_now, $time_now)";
        $support_add_result = mysql_query($support_add_query);
            check_queryerror($support_add_query, $support_add_result);
        $notice = "Thêm hỗ trợ thành công. BQT sẽ trả lời bạn trong giây lát, chậm nhất là 24h.";
        $addsupport_status = 1;
	}
} 
if ($addsupport_status != 1 ) $page_template = "templates/support/writesupport.tpl";
?>