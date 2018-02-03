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
require_once('baokim_BKTransactionAPI.php');
switch ($cardtype){ 
    case 'MobiPhone':    // Mobifone    
        $card_type_bk = 92;
    break;
    
    case 'VinaPhone':    // Vinaphone
        $card_type_bk = 93;
    break;
    
    case 'Viettel':    // Viettel
        $card_type_bk = 107;
    break;
    
    default :  $card_type_bk = 'Unknow';
}
$url = "https://www.baokim.vn/the-cao/saleCard/wsdl";
$bk = new BKTransactionAPI($url);
$transaction_id = _time();

/*
 * API nap the cao dien thoai cho Merchant
 * */
$info_topup = new TopupToMerchantRequest();
$info_topup->api_password = $password_bk;
$info_topup->api_username = $username_bk;
$info_topup->card_id = $card_type_bk;
$info_topup->merchant_id = $merchant_id;
$info_topup->pin_field = $card_num_encode;
$info_topup->seri_field = $card_serial_encode;
$info_topup->transaction_id = $transaction_id;
$data_sign_array = (array)$info_topup;
ksort($data_sign_array);
$data_sign = md5($secure_pass . implode('', $data_sign_array));
$info_topup->data_sign = $data_sign;
$reponse_bk = $bk->DoTopupToMerchant($info_topup);

// Neu co phan hoi tu bao kim
if(isset($reponse_bk->error_code) || isset($reponse_bk->info_card)) {
    if($reponse_bk->error_code==0)//nạp thẻ đúng
    {
        $edit_menhgia = $reponse_bk->info_card;
        $edit_menhgia = abs(intval($edit_menhgia));
        $up_stat = 2;
    
        $logcontent_after = "Thông tin thẻ: Thẻ đúng. Mệnh giá: $edit_menhgia VNĐ.";
    } else {    //nạp thẻ sai
        $error_code = $reponse_bk->error_code;
        $notice = $reponse_bk->error_message;
        $up_stat = 3;
        
        $logcontent_after = "Thẻ sai.";
    }
        // Write Log Nap Bao Kim
        $logcontent = "Tài khoản Kết nối: $username_bk. Mật khẩu Kết nối: $password_bk. Mã WebSite: $merchant_id. Mật khẩu: $secure_pass. Mã thẻ: $card_num_encode, Seri thẻ: $card_serial_encode. URL nạp: $url. ";
        $logcontent .= $logcontent_after;
        _writelog("log_autobaokim.txt", $logcontent);
        // End Write Log Nap Bao Kim
        
    include('autonap_duyet.php');
} else {
    $notice_nap = "Đăng kí mua V.Point bằng thẻ <strong>$cardtype</strong> cho tài khoản <strong>$login</strong> thành công. Hãy theo dõi trong phần danh sách thẻ đã nạp.";
}

?>