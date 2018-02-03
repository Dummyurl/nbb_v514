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
 
	include_once("security.php");
include_once ('config.php');
include ('config/config_thehe.php');
include_once ('function.php');

// Tai khoan chua nhung tu sau thi khong cho dang ky
$acc_not_allow = array('admin', 'adm', 'djs', 'dis', 'diz', 'djz', 'dkm');
/////////////////////////////////////////////////////

$slg_thehe = count($thehe_choise) - 1;

$username = $_POST['username'];
$thehe = $_POST['thehe'];
$passgame = $_POST['passgame'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$email = $_POST['email'];
$quest = $_POST['quest'];
$ans = $_POST['ans'];
$sno_numb = $_POST['$sno_numb'];
$tel = $_POST['tel'];
$invite = $_POST['invite'];
$ip = $_POST['ip'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {
	$passmd5 = md5($pass1);
    
    $sno_numb = abs(intval($sno_numb));
    $sno_numb_len = strlen($sno_numb);
    if($sno_numb_len < 7) {
        for($i=0; $i<(7-$sno_numb_len); ++$i) {
            $sno_numb = '0'. $sno_numb;
        }
    }
if ($type_acc == 1) {
	kiemtra_kituso($username);
}

$username_uper = strtoupper($username);
$username_lower = strtolower($username);

foreach($acc_not_allow as $strnotallow) {
    if ( substr_count($username_lower, $strnotallow) > 0 )
    {
    	echo "Tên tài khoản không được phép đăng ký.";
    	exit();
    }
}

				
$sql_username_check = $db->Execute("SELECT count(*) FROM MEMB_INFO WHERE LOWER(memb___id)='$username_lower'"); 
$username_check = $sql_username_check->FetchRow();

if ($username_check[0] > 0){ 
	echo "Tên tài khoản đã có người sử dụng"; exit();
}

if(strlen($thehe_choise[$thehe]) == 0) {
    echo "Chưa cấu hình thế hệ trên Server. Vui lòng liên hệ Admin để kiểm tra."; exit();
} 

//Xu ly Invite
if (!preg_match("/^[a-zA-Z0-9_]*$/i", $invite)) $invite = "";
if( strlen($invite) > 0 )
{
	//Kiem tra tai khoan gioi thieu co ton tai
	$sql_username_invite_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$invite'"); 
	$username_invite_check = $sql_username_invite_check->numrows();
	if($username_invite_check <= 0)
	{
		echo "Tài khoản giới thiệu không tồn tại."; exit();
	}
	//Neu co tai khoan gioi thieu thi ghi vao du lieu
	$add_invite_query = "INSERT INTO Invite (acc_invite,acc_accept,time_invite) VALUES ('$invite','$username_lower','$timestamp')";
	$add_invite_result = $db->Execute($add_invite_query) OR DIE("Lỗi Query: $add_invite_query");
}
    
$time = date('Y-m-d',$timestamp);
$time_checksms = $timestamp - 15*24*60*60;

$sno = _sno_numb($sno_numb);

if ( $server_md5 == 1 ) {
	$query_insertacc = "INSERT INTO MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,mail_addr,appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code,memb__pwd2,fpas_ques,fpas_answ,pass2,memb__pwdmd5,tel__numb,time_checksms,thehe, ip) VALUES ('$username_lower',[dbo].[fn_md5]('$passgame','$username_lower'),'11111', $sno,'$email','$time','$time','$time','$time','1','0','0','$pass1','$quest','$ans','$pass2','$passmd5','$tel','$time_checksms',$thehe, '$ip')";
}
else {
	$query_insertacc = "INSERT INTO MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,mail_addr,appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code,memb__pwd2,fpas_ques,fpas_answ,pass2,memb__pwdmd5,tel__numb,time_checksms,thehe, ip) VALUES ('$username_lower','$passgame','11111', $sno,'$email','$time','$time','$time','$time','1','0','0','$pass1','$quest','$ans','$pass2','$passmd5','$tel','$time_checksms',$thehe, '$ip')";
}
$result_insertacc = $db->Execute($query_insertacc) or die("Lỗi Query: $query_insertacc");
if($slg_thehe>1) {
    $check_AccountCharacter_query = "SELECT * FROM AccountCharacter WHERE Id='$username_lower'";
    $check_AccountCharacter_result = $db->Execute($check_AccountCharacter_query) or die("Lỗi Query: $check_AccountCharacter_query");
    $check_AccountCharacter = $check_AccountCharacter_result->NumRows();
    if($check_AccountCharacter==0) {
        $char_ao_query = "INSERT INTO AccountCharacter (Id,GameID1,GameID2,GameID3,GameID4,GameID5,GameIDC) VALUES ('$username_lower','NhamSV1','NhamSV2','NhamSV3','NhamSV4','NhamSV5','NhamSV1')";
        $char_ao_result = $db->Execute($char_ao_query) or die("Lỗi Query: $char_ao_query");
    }
    
    $check_MEMB_STAT_query = "SELECT * FROM MEMB_STAT WHERE memb___id='$username_lower'";
    $check_MEMB_STAT_result = $db->Execute($check_MEMB_STAT_query) or die("Lỗi Query: $check_MEMB_STAT_query");
    $check_MEMB_STAT = $check_MEMB_STAT_result->NumRows();
    if($check_MEMB_STAT==0) {
        $insert_MEMB_STAT_query = "INSERT INTO MEMB_STAT (memb___id,ConnectStat) VALUES ('$username_lower',0)";
        $insert_MEMB_STAT_result = $db->Execute($insert_MEMB_STAT_query) or die("Lỗi Query: $insert_MEMB_STAT_query");
    }
}

echo "OK";
} else echo "Error";
$db->Close();
?>