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
 
/**
 * RUN QUERY:
 * ALTER TABLE MEMB_INFO DROP PK_MEMB_INFO
 * UPDATE MEMB_INFO SET [bloc_code]='1',admin_block='1' WHERE ISNUMERIC(memb___id) = 0
*/

	include_once("security.php");
include_once ('config.php');
include_once ('function.php');

$login = $_POST['login'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$username_new = $_POST['username_new'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$pass1 = md5($pass1);
kiemtra_pass($login,$pass1);
kiemtra_pass2($login,$pass2);

    if(check_taikhoan($username_new) > 0) {
        echo "Tên Tài khoản $username_new đã tồn tại. Vui lòng chọn Tên tài khoản mới khác.";
        exit();
    }
    
	$update_username_query = "UPDATE MEMB_INFO SET memb___id='$username_new', [bloc_code]='0', admin_block='0' WHERE memb___id='$login'";
	$update_username_result = $db->Execute($update_username_query);
	   check_queryerror($update_username_query, $update_username_result);
    
    $update_memstat_query = "UPDATE MEMB_STAT SET memb___id='$username_new' WHERE memb___id='$login'";
	$update_memstat_result = $db->Execute($update_memstat_query);
	   check_queryerror($update_memstat_query, $update_memstat_result);
    
    $update_accchar_query = "UPDATE AccountCharacter SET Id='$username_new' WHERE Id='$login'";
	$update_accchar_result = $db->Execute($update_accchar_query);
	   check_queryerror($update_accchar_query, $update_accchar_result);
    
    $update_warehouse_query = "UPDATE warehouse SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_warehouse_result = $db->Execute($update_warehouse_query);
	   check_queryerror($update_warehouse_query, $update_warehouse_result);
    
    $update_extwarehouse_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='ExtendedWarehouse') UPDATE ExtendedWarehouse SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_extwarehouse_result = $db->Execute($update_extwarehouse_query);
	   check_queryerror($update_extwarehouse_query, $update_extwarehouse_result);
    
    $update_char_query = "UPDATE Character SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_char_result = $db->Execute($update_char_query);
	   check_queryerror($update_char_query, $update_char_result);
    
    $update_card_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='CardPhone') UPDATE CardPhone SET acc='$username_new' WHERE acc='$login'";
	$update_card_result = $db->Execute($update_card_query);
	   check_queryerror($update_card_query, $update_card_result);
    
    $update_bongda_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='bongda_dudoankq') UPDATE bongda_dudoankq SET acc='$username_new' WHERE acc='$login'";
	$update_bongda_result = $db->Execute($update_bongda_query);
	   check_queryerror($update_bongda_query, $update_bongda_result);
    
    $update_dupeonline_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Dupe_Online') UPDATE Dupe_Online SET acc='$username_new' WHERE acc='$login'";
	$update_dupeonline_result = $db->Execute($update_dupeonline_query);
	   check_queryerror($update_dupeonline_query, $update_dupeonline_result);
    
    $update_dupescan_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Dupe_Scan') UPDATE Dupe_Scan SET acc='$username_new' WHERE acc='$login'";
	$update_dupeonline_result = $db->Execute($update_dupescan_query);
	   check_queryerror($update_dupescan_query, $update_dupeonline_result);
    
    $update_dupescanonline_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Dupe_Scan_Online') UPDATE Dupe_Scan_Online SET acc='$username_new' WHERE acc='$login'";
	$update_dupescanonline_result = $db->Execute($update_dupescanonline_query);
	   check_queryerror($update_dupescanonline_query, $update_dupescanonline_result);
    
    $update_eventinfo_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='EVENT_INFO') UPDATE EVENT_INFO SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_eventinfo_result = $db->Execute($update_eventinfo_query);
	   check_queryerror($update_eventinfo_query, $update_eventinfo_result);
    
    $update_bc5_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='EVENT_INFO_BC_5TH') UPDATE EVENT_INFO_BC_5TH SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_bc5_result = $db->Execute($update_bc5_query);
	   check_queryerror($update_bc5_query, $update_bc5_result);
    
    $update_topcard_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Event_TOP_Card') UPDATE Event_TOP_Card SET acc='$username_new' WHERE acc='$login'";
	$update_topcard_result = $db->Execute($update_topcard_query);
	   check_queryerror($update_topcard_query, $update_topcard_result);
    
    $update_toppoint_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Event_TOP_Point') UPDATE Event_TOP_Point SET acc='$username_new' WHERE acc='$login'";
	$update_toppoint_result = $db->Execute($update_toppoint_query);
	   check_queryerror($update_toppoint_query, $update_toppoint_result);
    
    $update_toprs_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Event_TOP_RS') UPDATE Event_TOP_RS SET acc='$username_new' WHERE acc='$login'";
	$update_toprs_result = $db->Execute($update_toprs_query);
	   check_queryerror($update_toprs_query, $update_toprs_result);
    
    $update_giftcode_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='GiftCode') UPDATE GiftCode SET acc='$username_new' WHERE acc='$login'";
	$update_giftcode_result = $db->Execute($update_giftcode_query);
	   check_queryerror($update_giftcode_query, $update_giftcode_result);
    
    $update_giftlog_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='GiftLog') UPDATE GiftLog SET acc='$username_new' WHERE acc='$login'";
	$update_giftlog_result = $db->Execute($update_giftlog_query);
	   check_queryerror($update_giftlog_query, $update_giftlog_result);
    
    $update_invite1_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Invite') UPDATE Invite SET acc_invite='$username_new' WHERE acc_invite='$login'";
	$update_invite1_result = $db->Execute($update_invite1_query);
	   check_queryerror($update_invite1_query, $update_invite1_result);
    
    $update_invite2_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Invite') UPDATE Invite SET acc_accept='$username_new' WHERE acc_accept='$login'";
	$update_invite2_result = $db->Execute($update_invite2_query);
	   check_queryerror($update_invite2_query, $update_invite2_result);
    
    $update_ipbonus_query = "UPDATE IPBonus SET acc='$username_new' WHERE acc='$login'";
	$update_ipbonus_result = $db->Execute($update_ipbonus_query);
	   check_queryerror($update_ipbonus_query, $update_ipbonus_result);
    
    $update_ipbonus_acc_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='IPBonus_acc') UPDATE IPBonus_acc SET acc='$username_new' WHERE acc='$login'";
	$update_ipbonus_acc_result = $db->Execute($update_ipbonus_acc_query);
	   check_queryerror($update_ipbonus_acc_query, $update_ipbonus_acc_result);
    
    $update_log_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='Log_TienTe') UPDATE Log_TienTe SET acc='$username_new' WHERE acc='$login'";
	$update_log_result = $db->Execute($update_log_query);
	   check_queryerror($update_log_query, $update_log_result);
    
    $update_passran_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='PassRan') UPDATE PassRan SET acc='$username_new' WHERE acc='$login'";
	$update_passran_result = $db->Execute($update_passran_query);
	   check_queryerror($update_passran_query, $update_passran_result);
    
    $update_ss5quest_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='SCFS5Quest') UPDATE SCFS5Quest SET AccountID='$username_new' WHERE AccountID='$login'";
	$update_ss5quest_result = $db->Execute($update_ss5quest_query);
	   check_queryerror($update_ss5quest_query, $update_ss5quest_result);
    
    $update_sms_query = "IF EXISTS (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='SMS') UPDATE SMS SET acc='$username_new' WHERE acc='$login'";
	$update_sms_result = $db->Execute($update_sms_query);
	   check_queryerror($update_sms_query, $update_sms_result);
    
	echo "OK";
    
    $log_doitaikhoan = "Tai khoan : <strong>$login</strong> doi sang ten tai khoan moi <strong>$username_new</strong>";
    _writelog("log_doitaikhoan.html", $log_doitaikhoan);
}
$db->Close();

function _writelog($file, $logcontent) {
    $Date = date("h:i:sA, d/m/Y");  
	$fp = fopen($file, "a+");  
	fputs ($fp, "Lúc: $Date. $logcontent \n");
	fclose($fp);
}
?>