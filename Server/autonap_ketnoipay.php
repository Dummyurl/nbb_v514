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
 * @author NetBanBe
 * @copyright 2012
 */
include('autonap_ketnoipay_api.php');
switch ($cardtype){ 
    case 'MobiPhone':    // Mobifone    
        $TxtType = 'VMS';
        $TxtUrl  = 'http://api.knp.vn:64980';
    break;
    
    case 'VinaPhone':    // Vinaphone
        $TxtType = 'VNP';
        $TxtUrl  = 'http://api.knp.vn:64980';
    break;
    
    case 'Viettel':    // Viettel
        $TxtType = 'VTT';
        $TxtUrl  = 'http://api.knp.vn:64990';
    break;
    
    case 'GATE':    // Viettel
        $TxtType = 'GATE';
        $TxtUrl  = 'http://api.knp.vn:64986';
    break;
    
    case 'VTC':    // Viettel
        $TxtType = 'VTC';
        $TxtUrl  = 'http://api.knp.vn:64987';
    break;
}

# Gửi thẻ lên máy chủ FPAY
$TxtKey   = md5(trim($ketnoipay_partnerid.$TxtType.$card_num_encode.$ketnoipay_signal));
$gateWay  = new gateWay($ketnoipay_partnerid,$TxtType,$card_num_encode,$card_serial_encode,'',$TxtKey,$TxtUrl);
$response = $gateWay->ReturnResult();

if(strpos($response,'RESULT:10') !== false) // thẻ đúng
{
	$edit_menhgia = str_replace('RESULT:10@','',$response);
    $edit_menhgia = abs(intval($edit_menhgia));
    $up_stat = 2;

    $logcontent_after = "Thẻ đúng. Mệnh giá: $edit_menhgia VNĐ.";
    include('autonap_duyet.php');
} 
elseif(strpos($response,'RESULT:03') !== false || strpos($response,'RESULT:07') !== false || strpos($response,'RESULT:06') !== false)
{
    $error_code = "";
    $notice = "Mã thẻ cào hoặc seri không chính xác. <br />Vui lòng kiểm tra lại cẩn thận.";
    $up_stat = 3;
    
    $logcontent_after = $notice;
    include('autonap_duyet.php');
	
}
elseif(strpos($response,'RESULT:05') !== false || strpos($response,'RESULT:08') !== false)
{
    $error_code = "";
    $notice = "Thẻ đã sử dụng hoặc thẻ chưa kích hoạt.";
    $up_stat = 3;
    
    $logcontent_after = $notice;
    include('autonap_duyet.php');
	
}
elseif(strpos($response,'RESULT:11') !== false)
{
    $error_code = "";
    $notice = "Thẻ đã gửi sang hệ thống kết nối pay rồi.<br />Không gửi thẻ này nữa.";
    $up_stat = 3;
    
    $logcontent_after = "Thẻ sai. $notice";
    include('autonap_duyet.php');
    
} elseif(strpos($response,'RESULT:99') !== false || strpos($response,'RESULT:00') !== false || strpos($response,'RESULT:01') !== false || strpos($response,'RESULT:04') !== false || strpos($response,'RESULT:09') !== false)
{
    $notice_nap = "Đăng kí mua V.Point bằng thẻ <strong>$cardtype</strong> cho tài khoản <strong>$login</strong> thành công. Hãy theo dõi trong phần danh sách thẻ đã nạp.";
    $logcontent_after = $notice_nap;
} else {
	$notice_nap = "Đăng kí mua V.Point bằng thẻ <strong>$cardtype</strong> cho tài khoản <strong>$login</strong> thành công. Hãy theo dõi trong phần danh sách thẻ đã nạp.";
    $logcontent_after = $notice_nap;
}

// Write Log Nap KetNoiPay
    $logcontent = "Partnerid: $ketnoipay_partnerid. Signal: $ketnoipay_signal. Mã thẻ: $card_num_encode, Seri thẻ: $card_serial_encode. URL nạp: $TxtUrl. Reponse: $response";
    $logcontent .= $logcontent_after;
    _writelog("log_auto_ketnoipay.txt", $logcontent);
// End Write Log Nap Bao Kim
?>