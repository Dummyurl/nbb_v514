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

$email = $_POST['email'];

$pass2 = $_POST['pass2'];
$quest = $_POST['quest'];
$ans = $_POST['ans'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

kiemtra_pass2($login,$pass2);
//Get Info
$get_info_query = "SELECT mail_addr,fpas_ques,fpas_answ FROM MEMB_INFO WHERE memb___id='$login'";
$get_info_result = $db->Execute($get_info_query);
$get_info = $get_info_result->fetchrow();

if($email == $get_info[0])
{
	echo "Địa chỉ Email mới trùng với địa chỉ Email cũ"; exit();
}
if($quest != $get_info[1])
{
	echo "Câu hỏi bí mật kiểm tra không đúng"; exit();
}
if($ans != $get_info[2])
{
	echo "Câu trả lời bí mật kiểm tra không đúng"; exit();
}

$email_exits_query = "SELECT * FROM MEMB_INFO WHERE mail_addr='$email'";
$email_exits_result = $db->Execute($email_exits_query);
    check_queryerror($email_exits_query, $email_exits_result);
$email_exits = $email_exits_result->NumRows();

if($email_exits > 0) {
    echo "Địa chỉ Email mới đã có người sử dụng. Vui lòng dùng địa chỉ Email khác."; exit();
}

$update_email_query = "UPDATE MEMB_INFO SET mail_addr='$email' WHERE memb___id='$login'";

	$update_email_result = $db->Execute($update_email_query);
	
    //Ghi vào Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "$login Đổi Email từ ". $get_info[0] ." sang ".$email;
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
    //End Ghi vào Log
    
	echo "Đổi Email thành : <b>$email</b> thành công.";
}

?>