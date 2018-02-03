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
 
include('config/config_giftcode_rs.php');
include('config/config_sms.php');
$messenge_giftcode = '';
if($giftcode_rs_use > 0 && $resetup >= $gift_reset_min) {
    $reset_choise_arr = array();
    if(strlen($gift_rs_choise) > 0) {
        $reset_choise_arr = explode(',', $gift_rs_choise);
    }
    for($i=0; $i<count($reset_choise_arr); $i++) {
        $reset_custom = trim($reset_choise_arr[$i]);
        $reset_custom = abs(intval($reset_custom));
        if($reset_custom > 0) {
            $reset_custom_arr[] = $reset_custom;
        }
    }
    if( (count($reset_custom_arr) > 0 && in_array($resetup, $reset_custom_arr)) || $resetup%$gift_rs_mod == 0 ) {
        $check_gift_rs_exits_query = "SELECT * FROM GiftLog WHERE acc='$login' AND name='$name' AND reset=$resetup AND type=1";
        $check_gift_rs_exits_result = $db->Execute($check_gift_rs_exits_query);
            check_queryerror($check_gift_rs_exits_query, $check_gift_rs_exits_result);
        $check_gift_rs_exits = $check_gift_rs_exits_result->NumRows();
        if($check_gift_rs_exits > 0) {
            $messenge_giftcode = "Bạn đã có 1 cơ hội nhận GiftCode ở mốc Reset $resetup trước đây.<br>Hiện giờ bạn không có cơ hội nhận nữa.";
        } else {
            $giftlog_insert_query = "INSERT INTO GiftLog (acc, name, reset, type, time) VALUES ('$login', '$name', $resetup, 1, $timestamp)";
            $giftlog_insert_result = $db->Execute($giftlog_insert_query);
                check_queryerror($giftlog_insert_query, $giftlog_insert_result);
                    
            $gift_rs_rate = rand(1, 100);
            if($gift_rs_rate <= $giftcode_rs_percent) {
                //Delete Data trung
                $del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='GIFTCODE_RS' AND acc='$login' AND dulieu1='$name'");
                
                $insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code, dulieu1) VALUES ('$login','GIFTCODE_RS','$timestamp','$timestamp', '$name')";
                $insert_result = $db->Execute($insert_query);
                    check_queryerror($insert_query, $insert_result);
                $messenge_giftcode = "<font color='blue'>Bạn thật may mắn nhận được GiftCode Reset ở lần Reset thứ $resetup</font>.<br />
                        <font color='black'>Vui lòng dùng SĐT của tài khoản nhắn tin với cú pháp bên dưới để hoàn tất</font><br>
						<font color='red'><b>VNU&nbsp;&nbsp;&nbsp;$cuphap&nbsp;&nbsp;&nbsp;$timestamp</b></font>&nbsp;&nbsp;&nbsp;gửi&nbsp;&nbsp;&nbsp;<font color='blue'><b>8185</b></font> <font color='gray'><i>(Phí nhắn tin : 1.000 VNĐ)</i></font><br>
						<font color='black'>Thời gian chờ tin nhắn chứng thực : 60 phút (sau 60 phút, yêu cầu sẽ bị hủy bỏ)</font>";
            } else {
                $messenge_giftcode = "Thật tiếc. Bạn không nhận được GiftCode Reset ở lần Reset thứ $resetup.<br>Chúc bạn may mắn lần sau.<br>";
            }
        }
    }
}

?>