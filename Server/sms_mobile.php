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
 
include_once('sv_sms/sms_function.php');

$smsip = "123.30.168.68";

$getip = get_ip();
if ( $getip != $smsip && $getip != '210.211.125.66' && $getip != '127.0.0.1' ) {
    $ipsmsservice = gethostbyname("sms.netbanbe.net");
    if ( $getip != $ipsmsservice ) { 
        echo "<nbb>0K<nbb>$getip Khong co quyen truy cap<nbb>";
        exit();
    }
}
    
include_once('config.php');
include_once("func_timechenh.php");

// Lấy nội dung tin nhắn
$pricesms = $_REQUEST['pricesms'];  // Cước SMS
$phone = $_REQUEST['phone'];  // Cước SMS
$message = $_REQUEST['message']; // Nội dung tin

//MESS chuẩn
$message_true = $message;
$tmp_true=explode(" ",$message_true);//cắt nội dung tin

//MESS Upper
$message = strtoupper($message);
$tmp=explode(" ",$message);//cắt nội dung tin

//Kiem tra dau so nhan tin
if($pricesms < 1) { $content = "Sai dau so nhan tin. Vui long kiem tra ki dau so gui den."; }
//Lấy danh sách mật khẩu ngẫu nhiên
else if ($tmp[0] == 'PR')
{
	$taikhoan = $tmp_true[1];
	if(check_taikhoan($taikhoan) == 0) { $content = "Tai khoan $taikhoan khong ton tai."; }
	else if( check_phone($phone,$taikhoan) <= 0 )
	{
		$content = "So Dien Thoai nay khong phai cua Tai khoan : $taikhoan.";
	} else include_once('sv_sms/sms_passran.php');
}
//Xác minh tài khoản
else if ($tmp[0] == 'XM')
{
	$taikhoan = $tmp_true[1];
	if( check_taikhoan($taikhoan) == 0 ) { $content = "Tai khoan $taikhoan khong ton tai."; }
	else include_once('sv_sms/sms_verify.php');
}
//GiftCode Tan Thu
else if ($tmp[0] == 'TANTHU')
{
	$taikhoan = $tmp_true[1];
	if( check_taikhoan($taikhoan) == 0 ) { $content = "Tai khoan $taikhoan khong ton tai."; }
	else if( check_phone($phone,$taikhoan) <= 0 )
	{
		$content = "So Dien Thoai nay khong phai cua Tai khoan : $taikhoan.";
	} else include_once('sv_sms/sms_giftcode_tanthu.php');
}
//One Pass Day
else if ($tmp[0] == 'OPD')
{
	$taikhoan = $tmp_true[1];
	if( check_taikhoan($taikhoan) == 0 ) { $content = "Tai khoan $taikhoan khong ton tai."; }
	else if( check_phone($phone,$taikhoan) <= 0 )
	{
		$content = "So Dien Thoai nay khong phai cua Tai khoan : $taikhoan.";
	} else include_once('sv_sms/sms_opd.php');
}
//Xử lý tin nhắn theo mã
else {
	$code = $tmp[0];
	if (!preg_match("/^[0-9]*$/i", $code))
	{
    		$content = "Ma xac thuc sai. Vui long kiem tra lai tin nhan.";
	}
	else 
	{
		$loaddata_query = "SELECT * FROM SMS WHERE Code='$code'";
		$sql_loaddata = $db->Execute($loaddata_query);
		$check_data = $sql_loaddata->numrows();
		$loaddata = $sql_loaddata->fetchrow();
			$taikhoan = $loaddata[0];
			$KeyXuLy = $loaddata[1];
			$time_load = $loaddata[2];
			$status = $loaddata[3];
            $dulieu1 = $loaddata[5];
		if( $pricesms < 1 )
		{
			$content = "Dau so dich vu khong duoc phep truy cap. Xin vui long doc ki huong dan nhan tin.";
		}
		else if($check_data < 1) 
		{ 
			$content = "Ma xac thuc khong ton tai hoac sai. Vui long kiem tra lai tin nhan."; 
		}
		else if( $timestamp > ($time_load + 3600) ) 
		{ 
			$content = "Thoi gian xac thuc vuot qua thoi gian cho phep. Yeu cau da bi huy."; 	
		}
		else if( $status == 1 ) 
		{ 
			$content = "Yeu cau da duoc thuc hien roi."; 
		}
		else if( check_phone($phone,$taikhoan) <= 0 )
		{
			$content = "So Dien Thoai nay khong phai cua Tai khoan : $taikhoan.";
		}
		else {
			switch ($KeyXuLy) {
				
				case 'RECEIVEPASS1':
					include_once('sv_sms/sms_receivepass1.php');
					break;
					
				case 'CHANGEPASS1':
					include_once('sv_sms/sms_changepass1.php');
					break;
					
				case 'CHANGEPASS2':
					include_once('sv_sms/sms_changepass2.php');
					break;
					
				case 'CHANGEPASSGAME':
					include_once('sv_sms/sms_changepassgame.php');
					break;
					
				case 'CHANGEQUEST':
					include_once('sv_sms/sms_changequest.php');
					break;
					
				case 'CHANGEANS':
					include_once('sv_sms/sms_changeans.php');
					break;
				
                case 'CHANGESNONUMB':
					include_once('sv_sms/sms_changesnonumb.php');
					break;
					
				case 'CHANGEEMAIL':
					include_once('sv_sms/sms_changeemail.php');
					break;
					
				case 'CHANGESDT':
					include_once('sv_sms/sms_changesdt.php');
					break;

				case 'PASSRAN':
					include_once('sv_sms/sms_passran_onoff.php');
					break;
				case 'GIFTCODE_WEEK':
					include_once('sv_sms/sms_giftcode_week.php');
					break;
				case 'GIFTCODE_MONTH':
					include_once('sv_sms/sms_giftcode_month.php');
					break;
				case 'GIFTCODE_RS':
					include_once('sv_sms/sms_giftcode_rs.php');
					break;
						
				default: $content = "Du lieu khong dung. Xin vui long kiem tra lai noi dung Tin nhan hoac lien he BQT de tro giup.";
			}
		}
	}
}
	echo "<nbb>0K<nbb>$content<nbb>";
$db->Close();
?>