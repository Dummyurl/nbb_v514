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

    $url = 'https://pay.gate.vn/Default.aspx';
	$userAgent = 'Mozilla/5.0 (Windows NT 6.1; rv:16.0) Gecko/20100101 Firefox/16.0';
	$postdata = array(
        '__EVENTTARGET'  =>  '',
        '__EVENTARGUMENT'  =>  '',
        '__LASTFOCUS'  =>  '',
        '__VIEWSTATE'  =>  '%2FwEPDwUKLTM3MjQ0MzM2MA9kFgJmD2QWAgIDD2QWAgIBD2QWAgIPDxBkZBYAZGRGzkN65N9h8kD404z%2BzNqB8dnFJA%3D%3D',
        'ctl00%24PSPContent%24txtGateName'  =>  $accgate,
        'ctl00%24PSPContent%24txtSerial'  =>  $card_serial_encode,
        'ctl00%24PSPContent%24txtPin'  =>  $card_num_encode,
        'ctl00%24PSPContent%24btnOK'  =>  'N%3Fp+th%3F',
        'ctl00%24PSPContent%24ddlCity'  =>  '',
        '__EVENTVALIDATION'  =>  '%2FwEWCALWnauTCQL7o6CcDgKWmNrRAwKIw92rDQKRncD7BQKJkNSPAwKYxebJDQLNmvzrCNGfoRDz9O0HdoEJJkWVwq6FPk%2Bf'
    );
	$response = _sendcard($url, $postdata, $userAgent );
	
	preg_match('#<span id="ctl00_PSPContent_lbMsg" class="errorText" style="color:Green;">Đã nạp thành công với mệnh giá(.*)</span>#',$response,$bacgate);
    preg_match('#<span id="ctl00_PSPContent_lbMsg" class="errorText" style="color:Green;">(.*)</span>#',$response,$response_notice);
    preg_match('#<span id="ctl00_PSPContent_lbMsg" class="errorText">(.*)</span>#',$response,$response_error);
    
    // Write Log Nap GATE
    $logcontent = "Tài khoản GATE: $accgate. Mã thẻ: $card_num_encode, Seri thẻ: $card_serial_encode. URL nạp: $url. Thông tin trả về: $response_notice[1]. Thông tin lỗi: $response_error[1]";
    
    _writelog("log_autogate.txt", $logcontent);
    // End Write Log Nap GATE
    
	if(strlen($response_notice[1]) > 0 || strlen($response_error[1]) > 0) {
        if(!empty($response_notice[1])) {
            $up_stat = 2;
            $edit_menhgia = str_replace(',','',$bacgate[1]);
    	}
    	else {
    		$up_stat = 3;
            if(substr_count($response_error[1], "giao dịch nạp thẻ trong 5 phút")) {
            	$error = "Hệ thống nạp thẻ gián đoạn. Vui lòng chờ 5 phút sau nạp lại.";
            } else {
            	$error .= $response_error[1];
            }
    	}
        include('autonap_duyet.php');
	} else {
	   $notice_nap = "Đăng kí mua V.Point bằng thẻ <strong>$cardtype</strong> cho tài khoản <strong>$login</strong> thành công. Hãy theo dõi trong phần danh sách thẻ đã nạp.";
	}

?>