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

    $cardserial = substr($card_serial_encode,2,10);
	$url = 'http://id.vtc.vn/emobile/1/chargevcoin.html';
	$userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16';
    $postdata = array(
        '__EVENTTARGET'  =>  '',
        '__EVENTARGUMENT'  =>  '',
        '__VIEWSTATE'  =>  '%2FwEPDwUKLTMyODQyMTUzNw9kFgJmD2QWAgIBD2QWBAIDD2QWAgIBDxYCHgdWaXNpYmxlaGQCBQ9kFgRmDw8WAh4EVGV4dAUcTuG6oXAgVmNvaW4gdOG7qyB0aOG6uyBWY29pbmRkAgEPZBYCZg9kFgRmDw8WAh8BBQJQTWRkAgYPDxYCHwEFBU7huqFwZGQYAQUoY3RsMDAkQ29udGVudFBsYWNlSG9sZGVyMSRtbHZDaGFyZ2VWY29pbg8PZGZkfSnZ3XkirelN65mHqnZcR0tw1B0%3D',
        '__EVENTVALIDATION'  =>  '%2FwEWBwLAn7qSDQLk3OOqDwLbqqutAQKi1IKDDgL6ouC%2BAgLEgfKBCALhwKaQAcoVzqcLT960OgmoM45%2FLneomPDz',
        'ctl00%24ContentPlaceHolder1%24txtSerinumber'  =>  $cardserial,
        'ctl00%24ContentPlaceHolder1%24txtCardCode'  =>  $card_num_encode,
        'ctl00%24ContentPlaceHolder1%24txtAccount'  =>  $accvtc,
        'ctl00%24ContentPlaceHolder1%24btnChargeVcoin'  =>  'N%E1%BA%A1p',
        'ctl00%24ContentPlaceHolder1%24menubottom%24ddlAccountAction'  =>  -1,
        'ctl00%24ContentPlaceHolder1%24menubottom%24ddlDepositVcoin'  =>  0,
        'ctl00%24ContentPlaceHolder1%24menubottom%24ddlTransfer'  =>  0,
        'ctl00%24ContentPlaceHolder1%24menubottom%24ddlPayment'  =>  0,
        'ctl00%24ContentPlaceHolder1%24menubottom%24ddlUtilities'  =>  0,
        'ctl00%24ContentPlaceHolder1%24HiddenField1'  =>  1
    );
    
	$reponse = _sendcard($url, $postdata, $userAgent );
	
	preg_match('#<span id="ctl00_ContentPlaceHolder1_lbTotalVcoinCharged">(.*)</span>#', $reponse, $vcoinnap);
	preg_match('#<span id="ctl00_ContentPlaceHolder1_lbTitle">(.*)</span>#', $reponse, $response_notice);
	preg_match('#<span id="ctl00_ContentPlaceHolder1_lblError" style="color:Red;">(.*)</span>#', $reponse, $response_error);
	
    // Write Log Nap VTC
    $logcontent = "Tài khoản VTC: $accvtc. Mã thẻ: $card_num_encode, Seri thẻ: $card_serial_encode. URL nạp: $url. Thông tin trả về: $response_notice[1]. Vcoin: $vcoinnap[1]. Thông tin lỗi: $response_error[1]";
    
    _writelog("log_autovtc.txt", $logcontent);
    // End Write Log Nap VTC
    
	if(strlen($response_notice[1]) > 0 || strlen($response_error[1]) > 0) {
	   if($response_notice[1] == "Nạp Vcoin thành công") {
    		$up_stat = 2;
            
            if($vcoinnap[1]>5 && $vcoinnap[1]<16) $edit_menhgia=10000;
    		else if($vcoinnap[1]>16 && $vcoinnap[1]<28) $edit_menhgia=20000;
    		else if($vcoinnap[1]>46 && $vcoinnap[1]<68) $edit_menhgia=50000;
    		else if($vcoinnap[1]>96 && $vcoinnap[1]<120) $edit_menhgia=100000;
    		else if($vcoinnap[1]>186 && $vcoinnap[1]<260) $edit_menhgia=200000;
    		else if($vcoinnap[1]>286 && $vcoinnap[1]<380) $edit_menhgia=300000;
    		else if($vcoinnap[1]>486 && $vcoinnap[1]<600) $edit_menhgia=500000;
            else {$edit_menhgia = 0; $cardright = false;}
    	}
    	else {
    		$up_stat = 3;
            $error .= $response_error[1];
    	}
        include('autonap_duyet.php');
	} else {
	   $notice_nap = "Đăng kí mua V.Point bằng thẻ <strong>$cardtype</strong> cho tài khoản <strong>$login</strong> thành công. Hãy theo dõi trong phần danh sách thẻ đã nạp.";
	}
?>