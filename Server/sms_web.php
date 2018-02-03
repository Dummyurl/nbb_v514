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
include_once ('function.php');

$login =  $_POST['login'];
$KeyXuLy =  $_POST['KeyXuLy'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];

	$KeyXuLy = strtoupper($KeyXuLy);
	kiemtra_acc($login);

	switch ($KeyXuLy) {
		case 'RECEIVEPASS1' :
			//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
			$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp')";
			$insert_result = $db->Execute($insert_query);
			$content = "<nbb>OK<nbb>$timestamp<nbb>";
			break;
			
		case 'CHANGEPASS1' :
			checklogin($login,$string_login);
			$pass1new =  $_POST['pass1new'];
			$leng_pass1new = strlen($pass1new);
			if (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass1new))
			{
				$content = "Dữ liệu lỗi - Mật khẩu Web mới chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
			elseif($leng_pass1new<6)
			{
				$content = "Dữ liệu lỗi - Mật khẩu Web mới phải có ít nhất 6 kí tự.";
			} else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$pass1new')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGEPASS2' :
			checklogin($login,$string_login);
			$pass2new =  $_POST['pass2new'];
			$leng_pass2new = strlen($pass2new);
			if (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass2new))
			{
				$content = "Dữ liệu lỗi - Mật khẩu Web Cấp 2 mới chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
			elseif($leng_pass2new<6)
			{
				$content = "Dữ liệu lỗi - Mật khẩu Web Cấp 2 mới phải có ít nhất 6 kí tự.";
			} else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$pass2new')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGEPASSGAME' :
			checklogin($login,$string_login);
			$passgamenew =  $_POST['passgamenew'];
			$leng_passgamenew = strlen($passgamenew);
			if (!preg_match("/^[a-zA-Z0-9_]*$/i", $passgamenew))
			{
				$content = "Dữ liệu lỗi - Mật khẩu Game mới chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
			elseif($leng_passgamenew<6)
			{
				$content = "Dữ liệu lỗi - Mật khẩu Game mới phải có ít nhất 6 kí tự.";
			} else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$passgamenew')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGEQUEST' :
			checklogin($login,$string_login);
			$quest =  $_POST['quest'];
			if( $quest < 1 || $quest > 5 ) {
				$content = "Mã câu hỏi bí mật sai";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$quest')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGEANS' :
			checklogin($login,$string_login);
			$ans =  $_POST['ans'];
			$leng_ans = strlen($ans);
			if (!preg_match("/^[a-zA-Z0-9_]*$/i", $ans))
			{
				$content = "Dữ liệu lỗi - Câu trả lời bí mật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
			}
			elseif($leng_ans<4)
			{
				$content = "Dữ liệu lỗi - Câu trả lời bí mật mới phải có ít nhất 4 kí tự.";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$ans')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGESNONUMB' :
			checklogin($login,$string_login);
			$snonumb =  $_POST['snonumb'];
            $snonumb_len = strlen($snonumb);
			if (!preg_match("/^[0-9]*$/i", $snonumb))
			{
				$content = "Dữ liệu lỗi - 7 Số bí mật chỉ được sử dụng số 0-9.";
			}
			elseif($snonumb_len<7)
			{
				$content = "Dữ liệu lỗi - 7 Số bí mật không đủ 7 số.";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp',$snonumb)";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
        case 'CHANGEEMAIL' :
			checklogin($login,$string_login);
			$email =  $_POST['email'];
			if (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[\.a-z]{2,6}$/i", $email))
			{
				$content = "Dữ liệu lỗi - Không đúng dạng Email.";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$email')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'CHANGESDT' :
			checklogin($login,$string_login);
			$tel=  $_POST['tel'];
			$leng_tel = strlen($tel);
			if (!preg_match("/^[0-9]*$/i", $tel))
			{
				$content = "Dữ liệu lỗi - Số điện thoại chỉ được dùng số 0-9.";
			}
			elseif($leng_tel<10 || $leng_tel>11)
			{
				$content = "Dữ liệu lỗi - Số điện thoại phải từ 10-11 số.";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$tel')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
			
		case 'PASSRAN' :
			checklogin($login,$string_login);
			$status =  $_POST['status'];
			if ( !($status == 0 || $status == 1) ) {
				$content = "Dữ liệu sai";
			}
			else {
				//Delete Data trung
				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
				
				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code,dulieu1) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp','$status')";
				$insert_result = $db->Execute($insert_query);
				$content = "<nbb>OK<nbb>$timestamp<nbb>";
			}
			break;
		
        case 'GIFTCODE_WEEK' :
            include('config/config_giftcode_week.php');
            if($giftcode_week_use > 0) {
                // Check Time Gift Week
                if(date('H', $timestamp) < $giftcode_week_timebegin || date('H', $timestamp) >= $giftcode_week_timeend) {
                    $time_gift_now = date('H:i:s', $timestamp);
                    if(date('H', $timestamp) < $giftcode_week_timebegin) {
                        $content = "Hiện tại là : $time_gift_now . Chưa đến giờ nhận GiftCode tuần.";
                    } else if(date('H', $timestamp) >= $giftcode_week_timeend) {
                        $content = "Hiện tại là : $time_gift_now . Đã hết giờ nhận GiftCode tuần.";
                    }
                } else {
                    $reset_check_query = "SELECT * FROM Character WHERE AccountID='$login' AND (Resets>= $gift_reset_min OR Relifes>0)";
                    $reset_check_result = $db->Execute($reset_check_query);
                        check_queryerror($reset_check_query, $reset_check_result);
                    $reset_check = $reset_check_result->NumRows();
                    if($reset_check == 0) {
                        $content = "Tài khoản phải có nhân vật Reset từ $gift_reset_min lần trở lên hoặc đã ReLife mới có thể nhận GiftCode Tuần.";
                        echo $content;
                        exit();
                    }
                    // Check Slg Gift Daily
                    $ngay_now = date('Y-m-d', $timestamp);
                    $gift_daily_query = "SELECT * FROM GiftCode WHERE ngay='$ngay_now' AND type=2";
                    $gift_daily_result = $db->Execute($gift_daily_query);
                        check_queryerror($gift_daily_query, $gift_daily_result);
                    $gift_daily = $gift_daily_result->NumRows();
                    if($gift_daily >= $gift_week_max) {
                        $content = "Mỗi ngày chỉ nhận được $gift_week_max GiftCode tuần.<br> Hiện tại đã đạt đến giới hạn, hẹn bạn vào ngày mai.";
                    } else {
                        // Check Gift User
                        $time_gift_allow = $timestamp - 7*24*60*60;
                        $check_gift_user_query = "SELECT gift_timeuse FROM GiftCode WHERE acc='$login' AND type=2 AND gift_timeuse>$time_gift_allow";
                        $check_gift_user_result = $db->Execute($check_gift_user_query);
                            check_queryerror($check_gift_user_query, $check_gift_user_result);
                        $check_gift_user = $check_gift_user_result->NumRows();
                        if($check_gift_user > 0) {
                            $check_gift_user_fetch = $check_gift_user_result->FetchRow();
                            $gift_timeuse = $check_gift_user_fetch[0];
                            $time_gift_next = $gift_timeuse + 7*24*60*60;
                            $date_gift_next = date('d/m/Y H:i:s', $time_gift_next);
                            $content = "Trong 1 tuần bạn chỉ được phép nhận và sử dụng 1 GiftCode Tuần.<br> Thời gian nhận GiftCode tuần lần tiếp theo của bạn là sau $date_gift_next .";
                        } else {
                            $time_receive_gift_allow = $timestamp - 60;
                            $check_time_send_before_query = "SELECT time FROM GiftLog WHERE acc='$login' AND type=2";
                            $check_time_send_before_result = $db->Execute($check_time_send_before_query);
                                check_queryerror($check_time_send_before_query, $check_time_send_before_result);
                            $check_time_send_before = $check_time_send_before_result->NumRows();
                            $check_time_send_before_fetch = $check_time_send_before_result->FetchRow();
                            $time_send_before = $check_time_send_before_fetch[0];
                            if($time_send_before > $time_receive_gift_allow) {
                                $time_gift_wait = $time_send_before + 60 - $timestamp;
                                $content = "Bạn phải chờ thêm $time_gift_wait giây nữa mới được tiếp tục đăng ký nhận GiftCode.";
                            } else {
                                if($check_time_send_before > 0) {
                                    $giftlog_update_query = "UPDATE GiftLog SET time='$timestamp' WHERE acc='$login' AND type=2";
                                    $giftlog_update_result = $db->Execute($giftlog_update_query);
                                        check_queryerror($giftlog_update_query, $giftlog_update_result);
                                } else {
                                    $giftlog_insert_query = "INSERT INTO GiftLog (acc, type, time) VALUES ('$login', 2, $timestamp)";
                                    $giftlog_insert_result = $db->Execute($giftlog_insert_query);
                                        check_queryerror($giftlog_insert_query, $giftlog_insert_result);
                                }
                                
                                $percent = rand(1, 100);
                                if($percent > 50) {
                                    //Delete Data trung
                    				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
                    				
                    				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp')";
                    				$insert_result = $db->Execute($insert_query);
                    				$content = "<nbb>OK<nbb>$timestamp<nbb>";
                                } else {
                                    $content = "Bạn thiếu may mắn rồi.<br> Hãy thử lại sau 1 phút nữa, có thể thần may mắn sẽ mỉm cười với bạn.";
                                }
                            }
                        } 
                    }
                }
            } else $content = "Chức năng không được sử dụng.";
                
            break;
		
        case 'GIFTCODE_MONTH' :
            include('config/config_giftcode_month.php');
            if($giftcode_month_use > 0) {
                // Check Time Gift Month
                if(date('H', $timestamp) < $giftcode_month_timebegin || date('H', $timestamp) >= $giftcode_month_timeend) {
                    $time_gift_now = date('H:i:s', $timestamp);
                    if(date('H', $timestamp) < $giftcode_month_timebegin) {
                        $content = "Hiện tại là : $time_gift_now . Chưa đến giờ nhận GiftCode tháng.";
                    } else if(date('H', $timestamp) >= $giftcode_month_timeend) {
                        $content = "Hiện tại là : $time_gift_now . Đã hết giờ nhận GiftCode tháng.";
                    }
                } else {
                    $reset_check_query = "SELECT * FROM Character WHERE AccountID='$login' AND (Resets>= $gift_reset_min OR Relifes>0)";
                    $reset_check_result = $db->Execute($reset_check_query);
                        check_queryerror($reset_check_query, $reset_check_result);
                    $reset_check = $reset_check_result->NumRows();
                    if($reset_check == 0) {
                        $content = "Tài khoản phải có nhân vật Reset từ $gift_reset_min lần trở lên hoặc đã ReLife mới có thể nhận GiftCode Tháng.";
                        echo $content;
                        exit();
                    }
                    // Check Slg Gift Daily
                    $ngay_now = date('Y-m-d', $timestamp);
                    $gift_daily_query = "SELECT * FROM GiftCode WHERE ngay='$ngay_now' AND type=2";
                    $gift_daily_result = $db->Execute($gift_daily_query);
                        check_queryerror($gift_daily_query, $gift_daily_result);
                    $gift_daily = $gift_daily_result->NumRows();
                    if($gift_daily >= $gift_month_max) {
                        $content = "Mỗi ngày chỉ nhận được $gift_month_max GiftCode tháng.<br> Hiện tại đã đạt đến giới hạn, hẹn bạn vào ngày mai.";
                    } else {
                        // Check Gift User
                        $time_gift_allow = $timestamp - 30*24*60*60;
                        $check_gift_user_query = "SELECT gift_timeuse FROM GiftCode WHERE acc='$login' AND type=3 AND gift_timeuse>$time_gift_allow";
                        $check_gift_user_result = $db->Execute($check_gift_user_query);
                            check_queryerror($check_gift_user_query, $check_gift_user_result);
                        $check_gift_user = $check_gift_user_result->NumRows();
                        if($check_gift_user > 0) {
                            $check_gift_user_fetch = $check_gift_user_result->FetchRow();
                            $gift_timeuse = $check_gift_user_fetch[0];
                            $time_gift_next = $gift_timeuse + 30*24*60*60;
                            $date_gift_next = date('d/m/Y H:i:s', $time_gift_next);
                            $content = "Trong 1 tháng bạn chỉ được phép nhận và sử dụng 1 GiftCode Tháng.<br> Thời gian nhận GiftCode tháng lần tiếp theo của bạn là sau $date_gift_next .";
                        } else {
                            $time_receive_gift_allow = $timestamp - 60;
                            $check_time_send_before_query = "SELECT time FROM GiftLog WHERE acc='$login' AND type=3";
                            $check_time_send_before_result = $db->Execute($check_time_send_before_query);
                                check_queryerror($check_time_send_before_query, $check_time_send_before_result);
                            $check_time_send_before = $check_time_send_before_result->NumRows();
                            $check_time_send_before_fetch = $check_time_send_before_result->FetchRow();
                            $time_send_before = $check_time_send_before_fetch[0];
                            if($time_send_before > $time_receive_gift_allow) {
                                $time_gift_wait = $time_send_before + 60 - $timestamp;
                                $content = "Bạn phải chờ thêm $time_gift_wait giây nữa mới được tiếp tục đăng ký nhận GiftCode.";
                            } else {
                                if($check_time_send_before > 0) {
                                    $giftlog_update_query = "UPDATE GiftLog SET time='$timestamp' WHERE acc='$login' AND type=3";
                                    $giftlog_update_result = $db->Execute($giftlog_update_query);
                                        check_queryerror($giftlog_update_query, $giftlog_update_result);
                                } else {
                                    $giftlog_insert_query = "INSERT INTO GiftLog (acc, type, time) VALUES ('$login', 3, $timestamp)";
                                    $giftlog_insert_result = $db->Execute($giftlog_insert_query);
                                        check_queryerror($giftlog_insert_query, $giftlog_insert_result);
                                }
                                
                                $percent = rand(1, 100);
                                if($percent > 50) {
                                    //Delete Data trung
                    				$del_data_trung = $db->Execute("DELETE FROM SMS WHERE KeyXuLy='$KeyXuLy' AND acc='$login'");
                    				
                    				$insert_query = "INSERT INTO SMS (acc,KeyXuLy,time,Code) VALUES ('$login','$KeyXuLy','$timestamp','$timestamp')";
                    				$insert_result = $db->Execute($insert_query);
                    				$content = "<nbb>OK<nbb>$timestamp<nbb>";
                                } else {
                                    $content = "Bạn thiếu may mắn rồi.<br> Hãy thử lại sau 1 phút nữa, có thể thần may mắn sẽ mỉm cười với bạn.";
                                }
                            }
                        } 
                    }
                }
            } else $content = "Chức năng không được sử dụng.";
                
            break;
            
        default: $content = "Sai dữ liệu.";
	}
	
	echo $content;
}
$db->Close();
?>