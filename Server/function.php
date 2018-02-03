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
 
foreach ($_REQUEST as $check_request) {
	if (!preg_match("/^[a-zA-Z0-9_\/\.@!#$%^ ]*$/i", $check_request))
	{
        echo "Khong duoc su dung ky tu dac biet";
		exit();
	}
}

include_once("func_timechenh.php");

if(!function_exists(antiinject_query)) {
        function antiinject_query($value) {
        $value = stripslashes($value);
        $value = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
        return $value;
    }
}


if(!function_exists(check_queryerror)) {
    function check_queryerror($query,$result) {
        if ($result === false) {
            writelog('log_query.txt', $query);
            die("Query Error : $query");
        }
    }
}

if(!function_exists(kiemtra_cardnumber)) {
    function kiemtra_cardnumber($card_num) {
    	if (!preg_match("/^[a-zA-Z0-9]*$/i", $card_num))
    	{
        echo "Du lieu loi : $card_num . Chi duoc su dung ki tu a-z, A-Z va (1-9)."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_kituso)) {
    function kiemtra_kituso($login) {
    	if (!preg_match("/^[0-9]*$/i", $login))
    	{
        echo "Du lieu loi : $login . Chỉ được sử dụng số (0-9) và không được bắt đầu bằng số 0."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_kitudacbiet)) {
    function kiemtra_kitudacbiet($login) {
    	if (!preg_match("/^[a-zA-Z0-9_]*$/i", $login))
    	{
        echo "Du lieu loi : $login . Chi duoc su dung ki tu a-z, A-Z, so (1-9) va dau _."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_email)) {
    function kiemtra_email($email) {
    	if (!preg_match("/^[a-zA-Z0-9\.@_-]*$/i", $email))	{
        echo "Email Khong duoc su dung nhung ky tu dac biet."; exit();
    	}
    	if (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[\.a-z]{2,6}$/i", $email)) {
    	echo "Dia chi Email khong dung. Xin vui long kiem tra lai."; exit();
    	}
    }
}
    

if(!function_exists(check_phone)) {
        function check_phone($phone,$taikhoan)
    {
    	global $db, $timestamp, $day, $month, $year;
    	$phone = substr($phone, 2);
    	$phone = '0'.$phone;
    	$sql_phone_check = $db->Execute("SELECT * FROM MEMB_INFO WHERE tel__numb='$phone' AND memb___id='$taikhoan'"); 
    	$phone_check = $sql_phone_check->numrows();
    	return $phone_check;
    }
}

if(!function_exists(check_taikhoan)) {
    function check_taikhoan($taikhoan) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_acc_check_query = "SELECT * FROM MEMB_INFO WHERE memb___id='$taikhoan'";
    	$sql_acc_check = $db->Execute($sql_acc_check_query);
    	$acc_check = $sql_acc_check->numrows();
    	return $acc_check;
    }
}

if(!function_exists(_nv_chinh)) {
    function _nv_chinh($account) {
    	global $db;
    	$nv_chinh_q = "SELECT TOP 1 Name FROM Character WHERE AccountID = '$account' ORDER BY relifes DESC, resets DESC, cLevel DESC";
    	$nv_chinh_r = $db->Execute($nv_chinh_q);
            check_queryerror($nv_chinh_q, $nv_chinh_r);
    	$nv_chinh_f = $nv_chinh_r->FetchRow();
        
    	return $nv_chinh_f[0];
    }
}
    
if(!function_exists(check_nv)) {
    function check_nv($account, $name) {
    	global $db;
    	$sql_nv_check_query = "SELECT * FROM Character WHERE AccountID = '$account' AND Name='$name'";
    	$sql_nv_check_result = $db->Execute($sql_nv_check_query);
            check_queryerror($sql_nv_check_query, $sql_nv_check_result);
    	$nv_check = $sql_nv_check_result->numrows();
    	return $nv_check;
    }
}

if(!function_exists(check_tk_nv)) {
    function check_tk_nv($login, $name) {
    	global $db, $timestamp, $day, $month, $year;
    	$tknv_check_query = "SELECT * FROM Character WHERE Name='$name' AND AccountID='$login'";
    	$tknv_check_result = $db->Execute($tknv_check_query);
    	$tknv_check = $tknv_check_result->numrows();
    	return $tknv_check;
    }
}
    
if(!function_exists(check_online)) {
    function check_online($taikhoan) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$taikhoan' AND ConnectStat='1'");
    	$online_check = $sql_online_check->numrows();
    	return $online_check;
    }
}
    
if(!function_exists(check_doinv)) {
    function check_doinv($name) {
    	global $db, $timestamp, $day, $month, $year;
        
    	$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE GameIDC='$name'");
    	$doinv_check = $sql_doinv_check->numrows();
    	return $doinv_check;
    }
}
    
if(!function_exists(checklogin)) {
    function checklogin($login,$stringlogin)
    {
    	global $db, $timestamp, $day, $month, $year;
    	$query_checklogin = "SELECT checklogin FROM MEMB_INFO WHERE memb___id='$login'";
    	$result_checklogin = $db->Execute($query_checklogin);
            check_queryerror($query_checklogin, $result_checklogin);
    	$checklogin = $result_checklogin->fetchrow();
    	if($stringlogin != $checklogin[0]) {
    		echo "login_other";
    		exit();
    	}
    }
}
    
if(!function_exists(kiemtra_acc)) {
    function kiemtra_acc($login) {
    	global $db, $timestamp, $day, $month, $year;
        $sql_username_check_query = "SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'";
    	$sql_username_check = $db->Execute($sql_username_check_query); 
            check_queryerror($sql_username_check_query, $sql_username_check);
    	$username_check = $sql_username_check->numrows(); 
    	if ($username_check <= 0){ 
     		echo "Tài khoản không tồn tại."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_loggame)) {
    function kiemtra_loggame($login) {
    	global $db, $timestamp, $day, $month, $year;
    	if ($login != 'admin') {
    	   $sql_loggame_check_query = "SELECT * FROM MEMB_STAT WHERE memb___id='$login'";
    		$sql_loggame_check = $db->Execute($sql_loggame_check_query); 
                check_queryerror($sql_loggame_check_query, $sql_loggame_check);
    		$loggame_check = $sql_loggame_check->numrows(); 
    		if ($loggame_check < 1){ 
    	 		echo "Tài khoản phải vào Game tạo ít nhất 1 nhân vật mới có thể đăng nhập."; exit();
    		}
    	}
    }
}
    
if(!function_exists(kiemtra_block_acc)) {
        function kiemtra_block_acc($login) {
    	global $db, $timestamp, $day, $month, $year;
        $sql_blockacc_check_query = "SELECT admin_block,BlockTime,BlockSlg FROM MEMB_INFO WHERE memb___id='$login' AND bloc_code='1'";
    	$sql_blockacc_check = $db->Execute($sql_blockacc_check_query); 
            check_queryerror($sql_blockacc_check_query, $sql_blockacc_check);
    	$blockacc_check = $sql_blockacc_check->numrows();
    	if($blockacc_check > 0){
    	   $blockacc_info = $sql_blockacc_check->fetchrow();
           if($blockacc_info[0]==1) {
                echo "Tài khoản đang bị Admin khóa."; exit();
           } else {
                $time_block = $blockacc_info[2]+1;
                $time_unblock = ($blockacc_info[2]+1)*60-$blockacc_info[1];
                echo "Tài khoản của bạn đang bị Khóa do Hack.<br /> Thời gian khóa : $time_block giờ.<br /> Bạn còn bị khóa trong $time_unblock phút nữa."; exit();
           }
           
       	}
    }
}

if(!function_exists(kiemtra_pass)) {
        function kiemtra_pass($login,$pass) {
    	global $db, $timestamp, $day, $month, $year;
    		$pass_stat_qr = "SELECT * FROM MEMB_INFO WHERE memb___id='$login' AND passran='1'";
            $pass_stat_query = $db->Execute($pass_stat_qr);
                check_queryerror($pass_stat_qr, $pass_stat_query);
    		$pass_stat = $pass_stat_query->numrows();
    		if($pass_stat == 0)
    		{
    			$check_pass_qr = "SELECT * FROM MEMB_INFO WHERE memb___id='$login' AND memb__pwdmd5='$pass'";
                $check_pass_query = $db->Execute($check_pass_qr);
                    check_queryerror($check_pass_qr, $check_pass_query);
    			$check_pass = $check_pass_query->numrows();
    			if( $check_pass == 0 )
    			{
    	 			echo "Mật khẩu cấp 1 không đúng."; exit();
    			}
     		} else {
     		     $passran_slg_qr = "SELECT * FROM PassRan WHERE acc='$login'";
     			$passran_slg_query = $db->Execute($passran_slg_qr);
                    check_queryerror($passran_slg_qr, $passran_slg_query);
     			$passran_slg = $passran_slg_query->numrows();
     			if($passran_slg > 0)
     			{
    	 			$passran_check_query = $db->Execute("SELECT * FROM PassRan WHERE acc='$login' AND pass_md5='$pass'");
    	 			$passran_check = $passran_check_query->numrows();
    	 			if($passran_check > 0)
    	 			{
    	 				$passran_delete = $db->Execute("DELETE FROM PassRan WHERE acc='$login' AND pass_md5='$pass'");
    	 			} else {
    	 				echo "PASSRAN_SAI"; exit();
    	 			}
     			} else {
     				echo "PASSRAN_KGCO"; exit();
     			}
     		}
    }
}

if(!function_exists(kiemtra_pass2)) {
        function kiemtra_pass2($login,$pass2) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_pw_check = $db->Execute("SELECT * FROM MEMB_INFO WHERE pass2='$pass2' and memb___id='$login'"); 
    	$pw_check = $sql_pw_check->numrows(); 
    	if ($pw_check <= 0){ 
     		echo "Mật khẩu cấp 2 không đúng."; exit();
     	}
    }
}

if(!function_exists(kiemtra_opd)) {
    function kiemtra_opd($acc, $opd) {
        global $db, $timestamp;
        $timeallow = $timestamp - 24*60*60;
        
        $flag = true;
        
        $opd_query = "SELECT opd,time  FROM OnePassDay WHERE acc='$acc'";
        $opd_result = $db->Execute($opd_query);
            check_queryerror($opd_query, $opd_result);
        $opd_exists = $opd_result->NumRows();
        if($opd_exists == 0) {
            $notice = "Tài khoản chưa khởi tạo Mật khẩu OPD.<br />Vui lòng tạo mật khẩu OPD.";
            $flag = false;
        } else {
            $opd_fetch = $opd_result->FetchRow();
            if($opd_fetch[1] < $timeallow) {
                $notice = "Mật khẩu OPD đã hết thời gian hiệu lực.<br />Vui lòng lấy Mật khẩu OPD mới.";
                $flag = false;
            } else if($opd_fetch[0] != $opd_md5) {
                $notice = "Mật khẩu OPD không chính xác.";
                $flag = false;
            }
        }
        
        $out = array(
            'flag' => $flag,
            'notice'    =>  $notice
        );
        
        return $out;
    }
}

if(!function_exists(kiemtra_char)) {
    function kiemtra_char($login,$name) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and AccountID = '$login'"); 
    	$name_check = $sql_name_check->numrows();
    	if ($name_check <= 0){ 
       		echo "$name : Tên nhân vật sai."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_block_char)) {
    function kiemtra_block_char($login,$name) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_block_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and (CtlCode='1' OR CtlCode='99') and AccountID='$login'"); 
    	$block_check = $sql_block_check->numrows();
    	if ($block_check > 0) {
       		echo "Nhân vật đang bị khóa."; exit();
     	}
    }
}
    
if(!function_exists(kiemtra_online)) {
    function kiemtra_online($login) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$login' AND ConnectStat='1'");
    	$online_check = $sql_online_check->numrows();
    	if ($online_check > 0){ 
       		echo "$login chưa thoát Game. Hãy thoát Game trước khi thực hiện chức năng này."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_timeout)) {
    function kiemtra_timeout($login) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_timeout_check = $db->Execute("SELECT DisconnectTM FROM MEMB_STAT WHERE memb___id='$login'");
    	$timeout_check = $sql_timeout_check->fetchrow();
    	$time_out = strtotime($timeout_check[0]);
    	$time_now = $timestamp;
    	$time_chenh = $time_now - $time_out;
    
    	if ($time_chenh < 90){ 
    		$time_wait = 90 - $time_chenh;
       		echo "Đợi $time_wait giây nữa mới được phép thực hiện chức năng này."; exit();
    	}
    }
}
    
if(!function_exists(kiemtra_doinv)) {
        function kiemtra_doinv($login,$name) {
    	global $db, $timestamp, $day, $month, $year;
    	$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$login' AND GameIDC='$name'");
    	$doinv_check = $sql_doinv_check->numrows();
    	if ($doinv_check > 0){ 
       		echo "Nhân vật $name không được là nhân vật thoát ra sau cùng. Hãy vào Game và chọn nhân vật khác trước khi thực hiện chức năng này."; exit();
    	}
    }
}

if(!function_exists(_getSerial)) {
    function _getSerial() {
    	global $db, $timestamp, $day, $month, $year;
    	$getSerial_query = $db->Execute("EXEC WZ_GetItemSerial");
    	$getSerial_fetch = $getSerial_query->fetchrow();
    	$Serial = dechex($getSerial_fetch[0]);
    	while(strlen($Serial) < 8) {
        	$Serial = '0'. $Serial;
        }
    	return $Serial;
    }
}

if(!function_exists(_sno_numb)) {
    function _sno_numb($sno_numb) {
        $sno_year = rand(0, 95);
        if(strlen($sno_year) == 1) $sno_year = '0' . $sno_year;
        
        $sno_month = rand(1, 12);
        if(strlen($sno_month) == 1) $sno_month = '0'. $sno_month;
        
        $sno_day = rand(1, 31);
        if(strlen($sno_day) == 1) $sno_day = '0'. $sno_day;
        
        $sno_numb = abs(intval($sno_numb));
        $sno_numb_len = strlen($sno_numb);
        if($sno_numb_len < 7) {
            for($i=0; $i<(7-$sno_numb_len); ++$i) {
                $sno_numb = '0'. $sno_numb;
            }
        }
        
        $sno = $sno_year . $sno_month . $sno_day . $sno_numb;
        
        return $sno;
    }
}
    
if(!function_exists(kiemtra_GM)) {
    function kiemtra_GM($login) {
    	global $gm;
    	global $db, $timestamp, $day, $month, $year;
    	$sql_gm_check = $db->Execute("SELECT * FROM Character WHERE AccountID='$login' and (CtlCode=8 or CtlCode=32)"); 
    	$gm_check = $sql_gm_check->numrows(); 
    	if ($gm_check <= 0){ 
     		$gm = 'NoGM';
    	}
    	else $gm = 'isGM';
    }
}
    
if(!function_exists(_point_tuluyen)) {
    function _point_tuluyen($name) {
        global $db;
        $point_tuluyen_query = "SELECT nbbtuluyen_str_point, nbbtuluyen_agi_point, nbbtuluyen_vit_point, nbbtuluyen_ene_point FROM Character WHERE Name='$name'";
        $point_tuluyen_result = $db->Execute($point_tuluyen_query);
            check_queryerror($point_tuluyen_query, $point_tuluyen_result);
        $point_tuluyen_fetch = $point_tuluyen_result->FetchRow();
        
        if(isset($point_tuluyen_fetch)) {
            $point_tuluyen_arr = array(
                'str'   =>  abs(intval($point_tuluyen_fetch[0])),
                'agi'   =>  abs(intval($point_tuluyen_fetch[1])),
                'vit'   =>  abs(intval($point_tuluyen_fetch[2])),
                'ene'   =>  abs(intval($point_tuluyen_fetch[3])),
            );
        } else {
            $point_tuluyen_arr = array(
                'str'   =>  0,
                'agi'   =>  0,
                'vit'   =>  0,
                'ene'   =>  0,
            );
        }
            
        
        return $point_tuluyen_arr;
    }
}

if(!function_exists(_quest_daily)) {
    function _quest_daily($login, $name) {
        global $db, $timestamp, $year, $month, $day;
        
        $datenow = date('Y-m-d', $timestamp);
        
        $plpoint_q = "SELECT nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
        $plpoint_r = $db->Execute($plpoint_q);
            check_queryerror($plpoint_q, $plpoint_r);
        $plpoint_f = $plpoint_r->FetchRow();
        $quest_arr['plpoint'] = $plpoint_f[0];
        
        $timeonline_query = "SELECT timeonline FROM nbb_timeonline_date WHERE acc='$login' AND date='$datenow'";
        $timeonline_result = $db->Execute($timeonline_query);
            check_queryerror($timeonline_query, $timeonline_result);
        $timeonline_check = $timeonline_result->NumRows();
        if($timeonline_check == 0) {
            $timeonline = 0;
        } else {
            $timeonline_fetch = $timeonline_result->FetchRow();
            $timeonline = $timeonline_fetch[0];
        }
        $quest_arr['timeonline'] = $timeonline;
        
        $resetcount_query = "SELECT reset, resetvip FROM TopReset WHERE acc='$login' AND name='$name' AND year=$year AND month=$month AND day=$day";
        $resetcount_result = $db->Execute($resetcount_query);
            check_queryerror($resetcount_query, $resetcount_result);
        $resetcount_check = $resetcount_result->NumRows();
        if($resetcount_check == 0) {
            $resetall = 0;
            $resetvip = 0;
        } else {
            $resetcount_fetch = $resetcount_result->FetchRow();
            $resetall = $resetcount_fetch[0];
            $resetvip = $resetcount_fetch[1];
        }
        $quest_arr['rsall'] = $resetall;
        $quest_arr['rsvip'] = $resetvip;
        
        $cardnap_q = "SELECT SUM(menhgia) FROM CardPhone WHERE acc='$login' AND ngay='$datenow' AND status=2";
        $cardnap_r = $db->Execute($cardnap_q);
            check_queryerror($cardnap_q, $cardnap_r);
        $cardnap_f = $cardnap_r->FetchRow();
        $quest_arr['cardnap'] = (!isset($cardnap_f[0]) || is_null($cardnap_f[0]) ? 0 : $cardnap_f[0]);
        
        $usemoney_q = "SELECT gcoin, gcoin_km, vpoint FROM nbb_use_money WHERE acc='$login' AND date='$datenow'";
        $usemoney_r = $db->Execute($usemoney_q);
            check_queryerror($usemoney_q, $usemoney_r);
        $usemoney_check = $usemoney_r->NumRows();
        if($usemoney_check == 0) {
            $quest_arr['usemoney'] = 0;
        } else {
            $usemoney_f = $usemoney_r->FetchRow();
            $quest_arr['usemoney'] = $usemoney_f[0] + $usemoney_f[1] + $usemoney_f[2];
        }
        
        for($i=1; $i<=27; $i++) {
            $quest_arr[$i] = 0;        // flag nhan thuong. 0: chua du dieu kien, 1: du dieu kien & chua nha, 2: da nhan
        }
        
        $qindex_q = "SELECT qindex FROM nbb_quest_daily WHERE acc='$login' AND DATEADD(day, DATEDIFF(day, 0, date), 0)='$datenow'"; 
        $qindex_r = $db->Execute($qindex_q);
            check_queryerror($qindex_q, $qindex_r);
        while($qindex_f = $qindex_r->FetchRow()) {
            $qindex = $qindex_f[0];
            $quest_arr[$qindex] = 2;
        }
        
        $quest_arr['quest_wait'] = 0;
        for($i=1; $i<=27; $i++) {
            if($quest_arr[$i] != 2) {
                switch ($i){ 
                case 1:
                    if(floor($timeonline/60) >= 1) { $quest_arr[$i] = 1; $quest_arr['quest_wait']++; }
            	break;
            
            	case 2:
                    if(floor($timeonline/60) >= 3) { $quest_arr[$i] = 1; $quest_arr['quest_wait']++; }
            	break;
            
            	case 3:
                    if(floor($timeonline/60) >= 5) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
                    
            	break;
            
            	case 4:
                    if(floor($timeonline/60) >= 10) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 5:
                    if(floor($timeonline/60) >= 15) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 6:
                    if(floor($timeonline/60) >= 20) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 7:
                    if($resetall >= 5) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 8:
                    if($resetvip >= 5) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 9:
                    if($resetall >= 10) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 10:
                    if($resetvip >= 10) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 11:
                    if($resetall >= 15) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 12:
                    if($resetvip >= 15) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 13:
                    if($resetall >= 20) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
            
            	case 14:
                    if($resetvip >= 20) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 15:
                    if($quest_arr['cardnap'] >= 20*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 16:
                    if($quest_arr['cardnap'] >= 50*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 17:
                    if($quest_arr['cardnap'] >= 100*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 18:
                    if($quest_arr['cardnap'] >= 200*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 19:
                    if($quest_arr['cardnap'] >= 300*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 20:
                    if($quest_arr['cardnap'] >= 500*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 21:
                    if($quest_arr['usemoney'] >= 1*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 22:
                    if($quest_arr['usemoney'] >= 5*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 23:
                    if($quest_arr['usemoney'] >= 10*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 24:
                    if($quest_arr['usemoney'] >= 20*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 25:
                    if($quest_arr['usemoney'] >= 50*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 26:
                    if($quest_arr['usemoney'] >= 100*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                case 27:
                    if($quest_arr['usemoney'] >= 200*1000) { $quest_arr[$i] = 1;  $quest_arr['quest_wait']++; }
            	break;
                
                }
            }
            
        }
        
        return $quest_arr;
    }
}

if(!function_exists(_use_money)) {
    function _use_money($login, $gcoin = 0, $gcoin_km = 0, $vpoint = 0) {
        global $db, $timestamp, $day, $month, $year;
        $datenow = "$year-$month-$day";
        
        $check_exists_q = "SELECT count(acc) FROM nbb_use_money WHERE acc='$login' AND date='$datenow'";
        $check_exists_r = $db->Execute($check_exists_q);
            check_queryerror($check_exists_q, $check_exists_r);
        $check_exists_f = $check_exists_r->FetchRow();
        if($check_exists_f[0] == 0) {
            $use_money_q = "INSERT INTO nbb_use_money (acc, gcoin, gcoin_km, vpoint, date) VALUES ('$login', $gcoin, $gcoin_km, $vpoint, '$datenow')";
        } else {
            $use_money_q = "UPDATE nbb_use_money SET gcoin = gcoin + $gcoin, gcoin_km = gcoin_km + $gcoin_km, vpoint = vpoint + $vpoint WHERE acc='$login' AND date='$datenow'";
        }
            $use_money_r = $db->Execute($use_money_q);
                check_queryerror($use_money_q, $use_money_r);
    }
}

if(!function_exists(_get_reset_day)) {
    function _get_reset_day($name, $time)
    {
    	global $db;
        $day = date("d",$time);
        $month = date("m",$time);
        $year = date("Y",$time);
        
        $reset_day_query = "SELECT reset FROM TopReset WHERE name='$name' AND year=$year AND month=$month AND day=$day";
        $reset_day_result = $db->Execute($reset_day_query);
        
        $reset_day_check = $reset_day_result->NumRows();
        if($reset_day_check > 0) {
            $reset_day_fetch = $reset_day_result->FetchRow();
            $reset_day = $reset_day_fetch[0];
        } else {
            $reset_day = 0;
        }
        
        return $reset_day;
    }
}

if(!function_exists(_get_resetscore_day)) {
    function _get_resetscore_day($name, $time)
    {
    	global $db;
        $day = date("d",$time);
        $month = date("m",$time);
        $year = date("Y",$time);
        
        $resetscore_day_query = "SELECT reset_score FROM TopResetScore WHERE name='$name' AND year=$year AND month=$month AND day=$day";
        $resetscore_day_result = $db->Execute($resetscore_day_query);
        
        $resetscore_day_check = $resetscore_day_result->NumRows();
        if($resetscore_day_check > 0) {
            $resetscore_day_fetch = $resetscore_day_result->FetchRow();
            $resetscore_day = $resetscore_day_fetch[0];
        } else {
            $resetscore_day = 0;
        }
        
        return $resetscore_day;
    }
}

if(!function_exists(_get_reset_month)) {
    function _get_reset_month($name)
    {
    	global $db, $timestamp, $day, $month, $year;
        
        $reset_month_query = "SELECT SUM(reset) FROM TopReset WHERE name='$name' AND year=$year AND month=$month";
        $reset_month_result = $db->Execute($reset_month_query);
        
        $reset_month_check = $reset_month_result->NumRows();
        if($reset_month_check > 0) {
            $reset_month_fetch = $reset_month_result->FetchRow();
            $reset_month = $reset_month_fetch[0];
        } else {
            $reset_month = 0;
        }
        
        return $reset_month;
    }
}

if(!function_exists(_get_resetscore_month)) {
    function _get_resetscore_month($name)
    {
    	global $db, $timestamp, $day, $month, $year;
        
        $resetscore_month_query = "SELECT SUM(reset_score) FROM TopResetScore WHERE name='$name' AND year=$year AND month=$month";
        $resetscore_month_result = $db->Execute($resetscore_month_query);
        
        $resetscore_month_check = $resetscore_month_result->NumRows();
        if($resetscore_month_check > 0) {
            $resetscore_month_fetch = $resetscore_month_result->FetchRow();
            $resetscore_month = $resetscore_month_fetch[0];
        } else {
            $resetscore_month = 0;
        }
        
        return $resetscore_month;
    }
}

if(!function_exists(_topreset)) {
    function _topreset($login, $name, $vip = 0, $resetover = 0, $uythac = 0)
    {
    	global $db, $timestamp, $day, $month, $year;
        $week = date("W",$timestamp);
        
        $datatop_check_query = "SELECT count(*) FROM TopReset WHERE acc='$login' AND name='$name' AND year=$year AND month=$month AND day=$day";
        $datatop_check_result = $db->Execute($datatop_check_query);
            check_queryerror($datatop_check_query, $datatop_check_result);
        $datatop_check_fetch = $datatop_check_result->FetchRow();
        if($datatop_check_fetch[0] == 0) {
            if($vip == 1) {
                if($uythac == 0) {
                    if($resetover == 0) {
                        $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, resetvip, reset_pri, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 1, 1, 1, 1, $year, $month, $week, $day, $timestamp)";
                    } else {
                        $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, resetvip, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 1, 1, 1, $year, $month, $week, $day, $timestamp)";
                    }
                } else {
                    $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, resetvip, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 0, 1, 1, $year, $month, $week, $day, $timestamp)";
                }
            } else {
                if($uythac == 0) {
                    if($resetover == 0) {
                        $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, reset_pri, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 1, 1, 1, $year, $month, $week, $day, $timestamp)";
                    } else {
                        $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 1, 1, $year, $month, $week, $day, $timestamp)";
                    }
                } else {
                    $datatop_insert_query = "INSERT INTO TopReset (acc, name, reset, reset_all, year, month, week, day, time) VALUES ('$login', '$name', 0, 1, $year, $month, $week, $day, $timestamp)";
                }
                
                    
            }
            
            $datatop_insert_result = $db->Execute($datatop_insert_query);
                check_queryerror($datatop_insert_query, $datatop_insert_result);
        } else {
            $vip_query = "";
            if($vip == 1) {
                $vip_query = ", resetvip = resetvip + 1";
            }
            
            $reset_query = "";
            $pri_query = "";
            if($uythac == 0) {
                $reset_query = ", reset = reset + 1";
                if($resetover == 0) {
                    $pri_query = ", reset_pri = reset_pri + 1";
                }
            }
                
            $datatop_update_query = "UPDATE TopReset SET reset_all = reset_all + 1 ". $reset_query . $vip_query . $pri_query ." WHERE acc='$login' AND name='$name' AND year=$year AND month=$month AND day=$day";
            $datatop_update_result = $db->Execute($datatop_update_query);
                check_queryerror($datatop_update_query, $datatop_update_result);
        }
    }
}

if(!function_exists(_topreset_score)) {
    function _topreset_score($login, $name, $resetscore, $resetover = 0)
    {
    	global $db, $timestamp, $day, $month, $year;
        $week = date("W",$timestamp);
        
        $datatop_check_query = "SELECT count(*) FROM TopResetScore WHERE acc='$login' AND name='$name' AND year=$year AND month=$month AND day=$day";
        $datatop_check_result = $db->Execute($datatop_check_query);
            check_queryerror($datatop_check_query, $datatop_check_result);
        $datatop_check_fetch = $datatop_check_result->FetchRow();
        if($datatop_check_fetch[0] == 0) {
            if($resetover == 0) {
                $datatop_insert_query = "INSERT INTO TopResetScore (acc, name, reset_score, reset_score_pri, year, month, week, day, time) VALUES ('$login', '$name', $resetscore, $resetscore, $year, $month, $week, $day, $timestamp)";
            } else {
                $datatop_insert_query = "INSERT INTO TopResetScore (acc, name, reset_score, year, month, week, day, time) VALUES ('$login', '$name', $resetscore, $year, $month, $week, $day, $timestamp)";
            }
            
            $datatop_insert_result = $db->Execute($datatop_insert_query);
                check_queryerror($datatop_insert_query, $datatop_insert_result);
        } else {
            $pri_query = "";
            if($resetover == 0) {
                $pri_query = ", reset_score_pri = reset_score_pri + $resetscore";
            }
            $datatop_update_query = "UPDATE TopResetScore SET reset_score=reset_score+$resetscore". $pri_query ." WHERE acc='$login' AND name='$name' AND year=$year AND month=$month AND day=$day";
            $datatop_update_result = $db->Execute($datatop_update_query);
                check_queryerror($datatop_update_query, $datatop_update_result);
        }
    }
}

if(!function_exists(_topreset_erase_month)) {
    function _topreset_erase_month($name, $month, $keepday = 0) {
        global $db, $timestamp, $day, $month, $year;
        
        $keepday_q = "";
        if($keepday == 1) {
            $keepday_q = "AND [day] <> $day";
        }
        
        $topreset_erase_query = "DELETE FROM TopReset WHERE name='$name' AND [month]=$month $keepday_q";
        $topreset_erase_result = $db->Execute($topreset_erase_query);
            check_queryerror($topreset_erase_query, $topreset_erase_result);
            
        $topreset_score_erase_query = "DELETE FROM TopResetScore WHERE name='$name' AND [month]=$month $keepday_q";
        $topreset_score_erase_result = $db->Execute($topreset_score_erase_query);
            check_queryerror($topreset_score_erase_query, $topreset_score_erase_result);
    }
}

if(!function_exists(_topreset_sub)) {
    function _topreset_sub($name, $resetsub, $resetscoresub) {
        global $db, $timestamp, $day, $month, $year;
        $datetime_now = "$year-$month-$day";
        
        $topreset_query = "SELECT reset, resetvip, reset_pri, reset_all FROM TopReset WHERE name='$name' AND [day]=$day AND [month]=$month AND [year]=$year";
        $topreset_result = $db->Execute($topreset_query);
            check_queryerror($topreset_query, $topreset_result);
        $topreset_exists = $topreset_result->NumRows();
        if($topreset_exists > 0) {
            $topreset_fetch = $topreset_result->FetchRow();
            $reset_after = $topreset_fetch[0] - $resetsub;
                if($reset_after < 0) $reset_after = 0;
            $resetvip_after = $topreset_fetch[1] - $resetsub;
                if($resetvip_after < 0) $resetvip_after = 0;
            $reset_pri_after = $topreset_fetch[2] - $resetsub;
                if($reset_pri_after < 0) $reset_pri_after = 0;
            $reset_all_after = $topreset_fetch[3] - $resetsub;
                if($reset_all_after < 0) $reset_all_after = 0;
            
            $topreset_sub_query = "UPDATE TopReset SET reset=$reset_after, resetvip=$resetvip_after, reset_pri=$reset_pri_after, reset_all=$reset_all_after WHERE name='$name' AND [day]=$day AND [month]=$month AND [year]=$year";
            $topreset_sub_result = $db->Execute($topreset_sub_query);
                check_queryerror($topreset_sub_query, $topreset_sub_result);
        }
        
        $topreset_score_query = "SELECT reset_score, reset_score_pri FROM TopResetScore WHERE name='$name' AND [day]=$day AND [month]=$month AND [year]=$year";
        $topreset_score_result = $db->Execute($topreset_score_query);
            check_queryerror($topreset_score_query, $topreset_score_result);
        $topreset_score_exists = $topreset_score_result->NumRows();
        
        if($topreset_score_exists > 0) {
            $topreset_score_fetch = $topreset_score_result->FetchRow();
            $reset_score_after = $topreset_score_fetch[0] - $resetscoresub;
                if($reset_score_after < 0) $reset_score_after = 0;
            $reset_score_pri_after = $topreset_score_fetch[1] - $resetscoresub;
                if($reset_score_pri_after < 0) $reset_score_pri_after = 0;
            
            $topreset_score_sub_query = "UPDATE TopResetScore SET reset_score=$reset_score_after, reset_score_pri=$reset_score_pri_after WHERE name='$name' AND [day]=$day AND [month]=$month AND [year]=$year";
            $topreset_score_sub_result = $db->Execute($topreset_score_sub_query);
                check_queryerror($topreset_score_sub_query, $topreset_score_sub_result);
        }
        
        $topreset_event_query = "SELECT resets, reset_score FROM Event_TOP_RS WHERE name='$name' AND [time]='$datetime_now'";
        $topreset_event_result = $db->execute($topreset_event_query);
            check_queryerror($topreset_event_query, $topreset_event_result);
        $topreset_event_exists = $topreset_event_result->numRows();
        if($topreset_event_exists > 0) {
            $topreset_event_fetch = $topreset_event_result->FetchRow();
            $reset_after = $topreset_event_fetch[0] - $resetsub;
                if($reset_after < 0) $reset_after = 0;
            $reset_score_after = $topreset_event_fetch[1] - $resetscoresub;
                if($reset_score_after < 0) $reset_score_after = 0;
            
            $topreset_event_update_query = "UPDATE Event_TOP_RS SET resets=$reset_after, reset_score=$reset_score_after WHERE name='$name' AND [time]='$datetime_now'";
            $topreset_event_update_result = $db->Execute($topreset_event_update_query);
                check_queryerror($topreset_event_update_query, $topreset_event_update_result);
        }
    }
}


// Action Day
$check_day_q = "SELECT time FROM Check_Action WHERE action='ActionDay'";
$check_day_r = $db->Execute($check_day_q);
    check_queryerror($check_day_q, $check_day_r);
$check_day = $check_day_r->fetchrow();
//Reset số lần RS trong tháng khi sang tháng mới
$day_get = date("d",$check_day[0]);
$hour_get = date("H",$check_day[0]);
$hour = date("H",$timestamp);

if($hour_get != $hour)
{
    _guild_data_sort();
        
    $update_time_query = "UPDATE Check_Action SET time='$timestamp' WHERE action='ActionDay'";
    $update_time_result = $db->Execute($update_time_query);
        check_queryerror($update_time_query, $update_time_result);
}

if($day_get != $day)
{
    _top50($day_get);
}


function _top50($day_get = 0)
{
	global $db;
	
    // Neu khong phai ngay dau tien
    if($day_get != 0) {
        //Reset TOP 50
        $resettop50_query = "UPDATE Character SET Top50=0, NBB_Resets_0h=0, NBB_Relifes_0h=0 WHERE Top50>0";
        $resettop50_result = $db->Execute($resettop50_query);
            check_queryerror($resettop50_query, $resettop50_result);
        $thehe_q = "SELECT DISTINCT thehe FROM MEMB_INFO ORDER BY thehe";
        $thehe_r = $db->Execute($thehe_q);
            check_queryerror($thehe_q, $thehe_r);

        while($thehe_f = $thehe_r->FetchRow()) {
            $thehe = $thehe_f[0];
            $query_top50 = "SELECT TOP 50 Name, Resets, Relifes FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$thehe ORDER BY Relifes DESC, Resets DESC, cLevel DESC, Resets_Time";
        	$result_top50 = $db->Execute($query_top50);
                check_queryerror($query_top50, $result_top50);
            $top = 1;
            while( $top50 = $result_top50->fetchrow() )
        	{
        	   $name = $top50[0];
        	   $reset_0h = $top50[1];
               $relife_0h = $top50[2];
        		$updatetop50_query = "UPDATE Character SET Top50=$top, NBB_Resets_0h=$reset_0h , NBB_Relifes_0h=$relife_0h WHERE Name='$name'";
                $updatetop50_result = $db->Execute($updatetop50_query);
                    check_queryerror($updatetop50_query, $updatetop50_result);
                $top++;
        	}
        }
    }
}

function _guild_data_sort() {
    global $db, $timestamp;
    include('config/config_thehe.php');
    
    $thehe_query = "";
    foreach($thehe_choise as $thehe_key => $thehe_val) {
        if(strlen($thehe_val) > 0) {
            if(strlen($thehe_query) > 0) $thehe_query .= ",";
            $thehe_query .= $thehe_key;
        }
    }
    
    // Kiem tra co Guild
    $guild_q = "SELECT G_Name FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .")";
    $guild_r = $db->Execute($guild_q);
        check_queryerror($guild_q, $guild_r);
    $guild_chk = $guild_r->NumRows();
    
    if($guild_chk > 0) {
        // TOP Guild Refresh
        $GuildTop_refresh_q = "UPDATE Guild SET G_TopPoint=0, G_TopRS=0, G_TopMem=0 FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .")";
        $GuildTop_refresh_r = $db->Execute($GuildTop_refresh_q);
            check_queryerror($GuildTop_refresh_q, $GuildTop_refresh_r);
        
        // Guild Data Day
        while($guild_f = $guild_r->FetchRow()) {
            $g_name = $guild_f[0];
            
            $g_data_day_q = "SELECT SUM(reset_total) AS Sum_RS, SUM(point_total) AS Sum_PointTotal FROM Character JOIN GuildMember ON G_Name='$g_name' AND Character.Name collate DATABASE_DEFAULT = GuildMember.Name collate DATABASE_DEFAULT JOIN nbb_toppoint ON GuildMember.Name collate DATABASE_DEFAULT = nbb_toppoint.Name collate DATABASE_DEFAULT";
            $g_data_day_r = $db->Execute($g_data_day_q);
                check_queryerror($g_data_day_q, $g_data_day_r);
            $g_data_day_f = $g_data_day_r->FetchRow();
            
            $g_data_day_slgmem_q = "SELECT Count(Name) FROM GuildMember WHERE G_Name='$g_name'";
            $g_data_day_slgmem_r = $db->Execute($g_data_day_slgmem_q);
                check_queryerror($g_data_day_slgmem_q, $g_data_day_slgmem_r);
            $g_data_day_slgmem_f = $g_data_day_slgmem_r->FetchRow();
            
            $g_reset_total = abs(intval($g_data_day_f[0]));
            $g_point_total = abs(intval($g_data_day_f[1]));
            $g_mem_total = abs(intval($g_data_day_slgmem_f[0]));
            
            $g_data_update_q = "UPDATE Guild SET G_PointTotal = $g_point_total, G_SlgMem = $g_mem_total, G_RSTotal = $g_reset_total WHERE G_NAME = '$g_name'";
            $g_data_update_r = $db->Execute($g_data_update_q);
                check_queryerror($g_data_update_q, $g_data_update_r);
        }
    }
}

// Action Day End

// Action Lo de
include('config/config_chucnang.php');
if( (isset($Use_GiaiTri_De) && $Use_GiaiTri_De == 1) || (isset($Use_GiaiTri_Lo) && $Use_GiaiTri_Lo == 1) ) {
    $date_now = date('Y-m-d', $timestamp);
    $hour_now = date('H', $timestamp);
    if($hour_now >= 20) {
        $kqxs_geted_q = "SELECT timecheck, status FROM NBB_KQXS WHERE ngay='$date_now'";
        $kqxs_geted_r = $db->Execute($kqxs_geted_q);
            check_queryerror($kqxs_geted_q, $kqxs_geted_r);
        $kqxs_geted_c = $kqxs_geted_r->NumRows();
        if($kqxs_geted_c == 0) {
            $kqxs_insert_q = "INSERT INTO NBB_KQXS (ngay) VALUES ('$date_now')";
            $kqxs_insert_r = $db->Execute($kqxs_insert_q);
                check_queryerror($kqxs_insert_q, $kqxs_insert_r);
        } else {
            $kqxs_geted_f = $kqxs_geted_r->FetchRow();
            $kqxs_time_check =  $kqxs_geted_f[0];
            $kqxs_status =  $kqxs_geted_f[1];
            
            if( $kqxs_status == 0 && ( ($timestamp - $kqxs_time_check) > 5*60 || $timestamp < $kqxs_time_check ) ) {    // Chua co KQXS, lay ket qua
                include_once('config_license.php');
                include_once('func_getContent.php');
                $getcontent_url = $url_license . "/api_kqxs.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key
                ); 
                
                $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
                $kqxs_flag = false;
            	if ( empty($reponse) ) {
                    
                }
                else {
                    $info = read_TagName($reponse, 'info');
                    if($info == "OK") {
                        $kqxs = read_TagName($reponse, 'kqxs');
                        $kqxs_arr = json_decode($kqxs, true);
                        if(is_array($kqxs_arr)) {
                            $kqxs_flag = true;
                            $kqxs_update_q = "UPDATE NBB_KQXS SET status=1, timecheck=$timestamp, giai0=". $kqxs_arr[0] .", giai1=". $kqxs_arr[1] .", giai21=". $kqxs_arr[2][0] .", giai22=". $kqxs_arr[2][1] .", giai31=". $kqxs_arr[3][0] .", giai32=". $kqxs_arr[3][1] .", giai33=". $kqxs_arr[3][2] .", giai34=". $kqxs_arr[3][3] .", giai35=". $kqxs_arr[3][4] .", giai36=". $kqxs_arr[3][5] .", giai41=". $kqxs_arr[4][0] .", giai42=". $kqxs_arr[4][1] .", giai43=". $kqxs_arr[4][2] .", giai44=". $kqxs_arr[4][3] .", giai51=". $kqxs_arr[5][0] .", giai52=". $kqxs_arr[5][1] .", giai53=". $kqxs_arr[5][2] .", giai54=". $kqxs_arr[5][3] .", giai55=". $kqxs_arr[5][4] .", giai56=". $kqxs_arr[5][5] .", giai61=". $kqxs_arr[6][0] .", giai62=". $kqxs_arr[6][1] .", giai63=". $kqxs_arr[6][2] .", giai71=". $kqxs_arr[7][0] .", giai72=". $kqxs_arr[7][1] .", giai73=". $kqxs_arr[7][2] .", giai74=". $kqxs_arr[7][3] ." WHERE ngay='$date_now'";
                            $kqxs_update_r = $db->Execute($kqxs_update_q);
                                check_queryerror($kqxs_update_q, $kqxs_update_r);
                        }
                    }
                }
                
                if($kqxs_flag == false) {
                    $kqxs_timecheck_q = "UPDATE NBB_KQXS SET timecheck=$timestamp WHERE ngay='$date_now'";
                    $kqxs_timecheck_r = $db->Execute($kqxs_timecheck_q);
                        check_queryerror($kqxs_timecheck_q, $kqxs_timecheck_r);
                }
            }
        }
    }
    
    // Trao giai ket qua xo so
	$timeget = $timestamp - 5;
    $kqxs_q = "SELECT giai0, giai1, giai21, giai22, giai31, giai32, giai33, giai34, giai35, giai36, giai41, giai42, giai43, giai44, giai51, giai52, giai53, giai54, giai55, giai56, giai61, giai62, giai63, giai71, giai72, giai73, giai74, ngay FROM NBB_KQXS WHERE status=1 AND (time_get IS NULL OR time_get<$timeget)";
    $kqxs_r = $db->Execute($kqxs_q);
        check_queryerror($kqxs_q, $kqxs_r);
    $kqxs_c = $kqxs_r->NumRows();
    
    if($kqxs_c > 0) {
    	while($kqxs_kq = $kqxs_r->FetchRow()) {
            $ngay = $kqxs_kq[27];
            
            $time_get_update_q = "UPDATE NBB_KQXS SET time_get = $timestamp WHERE ngay='$ngay'";
            $time_get_update_r = $db->Execute($time_get_update_q);
                check_queryerror($time_get_update_q, $time_get_update_r);
            
            // Trao giai De
            $de_finish = false;
            $de_q = "SELECT TOP 5 stt, acc, danhso, gcoin_danh FROM NBB_Relax_De WHERE ngay='$ngay' AND status=0";
            $de_r = $db->Execute($de_q);
                check_queryerror($de_q, $de_r);
            $de_c = $de_r->NumRows();
            if($de_c == 0) {
                $de_finish = true;
            } else {
                include('config/config_relax_de.php');
                while($de_f = $de_r->FetchRow()) {
                    $de_stt = $de_f[0];
                    $de_acc = $de_f[1];
                    $de_danhso = $de_f[2];
                    $de_gcoin_danh = $de_f[3];
                    
                    if($de_danhso == $kqxs_kq[0]) {
                        $de_gcoin_win = $de_gcoin_danh * $de_win;
                        
                        $de_update_q = "UPDATE NBB_Relax_De SET gcoin_win=$de_gcoin_win, status=1 WHERE stt=$de_stt AND status=0";
                        $de_update_r = $db->Execute($de_update_q);
                            check_queryerror($de_update_q, $de_update_r);
                        $update_de_row = $db->Affected_Rows();
                        if($update_de_row > 0) {
                            $money_update_q = "UPDATE MEMB_INFO SET gcoin = gcoin + $de_gcoin_win WHERE memb___id='$de_acc'";
                            $money_update_r = $db->Execute($money_update_q);
                                check_queryerror($money_update_q, $money_update_r);
                                
                             //Ghi vào Log
                            $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$de_acc'";
                            $info_log_result = $db->Execute($info_log_query);
                                check_queryerror($info_log_query, $info_log_result);
                            $info_log = $info_log_result->FetchRow();
                            
                            $log_acc = "$de_acc";
                            $log_gcoin = $info_log[0];
                            $log_gcoin_km = $info_log[1];
                            $log_vpoint = $info_log[2];
                            
                            $log_price = " + $de_gcoin_win Gcoin";
                            
                            $log_Des = "Đánh đề con ". $de_danhso ." dùng ". $de_gcoin_danh ." Gcoin. Trúng giải nhận : $de_gcoin_win Gcoin.";
                            $log_time = $timestamp;
                            
                            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                            $insert_log_result = $db->execute($insert_log_query);
                                check_queryerror($insert_log_query, $insert_log_result);
                            //End Ghi vào Log
                        }
                    } else {
                        $de_update_q = "UPDATE NBB_Relax_De SET status=2 WHERE stt=$de_stt";
                        $de_update_r = $db->Execute($de_update_q);
                            check_queryerror($de_update_q, $de_update_r);
                    }
                }
            }
            
            // Trao giai Lo
            $lo_finish = false;
            $lo_q = "SELECT TOP 5 stt, acc, danhso, diem FROM NBB_Relax_Lo WHERE ngay='$ngay' AND status=0";
            $lo_r = $db->Execute($lo_q);
                check_queryerror($lo_q, $lo_r);
            $lo_c = $lo_r->NumRows();
            if($lo_c == 0) {
                $lo_finish = true;
            } else {
                include('config/config_relax_lo.php');
                while($lo_f = $lo_r->FetchRow()) {
                    $lo_stt = $lo_f[0];
                    $lo_acc = $lo_f[1];
                    $lo_danhso = $lo_f[2];
                    $lo_diem = $lo_f[3];
                    
                    $lo_nhay = 0;
                    for($kqxs_i = 0; $kqxs_i <= 26; $kqxs_i++) {
                        if($lo_danhso == $kqxs_kq[$kqxs_i]) {
                            $lo_nhay++;
                        }
                    }
                    
                    if($lo_nhay == 0) {
                        $lo_update_q = "UPDATE NBB_Relax_Lo SET status=2 WHERE stt=$lo_stt";
                        $lo_update_r = $db->Execute($lo_update_q);
                            check_queryerror($lo_update_q, $lo_update_r);
                    } else {
                        $lo_gcoin_win = $lo_nhay * $lo_diem * $lo_win;
                        
                        $lo_update_q = "UPDATE NBB_Relax_Lo SET nhay_win = $lo_nhay, gcoin_win=$lo_gcoin_win, status=1 WHERE stt=$lo_stt AND status=0";
                        $lo_update_r = $db->Execute($lo_update_q);
                            check_queryerror($lo_update_q, $lo_update_r);
                        $update_lo_row = $db->Affected_Rows();
                        if($update_lo_row > 0) {
                            $money_update_q = "UPDATE MEMB_INFO SET gcoin = gcoin + $lo_gcoin_win WHERE memb___id='$lo_acc'";
                            $money_update_r = $db->Execute($money_update_q);
                                check_queryerror($money_update_q, $money_update_r);
                                
                            //Ghi vào Log
                            $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$lo_acc'";
                            $info_log_result = $db->Execute($info_log_query);
                                check_queryerror($info_log_query, $info_log_result);
                            $info_log = $info_log_result->FetchRow();
                            
                            $log_acc = "$lo_acc";
                            $log_gcoin = $info_log[0];
                            $log_gcoin_km = $info_log[1];
                            $log_vpoint = $info_log[2];
                            
                            $log_price = " + $lo_gcoin_win Gcoin";
                            
                            $log_Des = "Đánh $lo_diem điểm con lô ". $lo_danhso .". Trúng giải nhận : $lo_gcoin_win Gcoin.";
                            $log_time = $timestamp;
                            
                            $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                            $insert_log_result = $db->execute($insert_log_query);
                                check_queryerror($insert_log_query, $insert_log_result);
                            //End Ghi vào Log
                        }
                    }
                }
            }
            
            // UP status trao het Lo + De
            if($de_finish == true && $lo_finish == true) {
                $kqxs_update_q = "UPDATE NBB_KQXS SET status=2 WHERE ngay='$ngay'";
                $kqxs_update_r = $db->Execute($kqxs_update_q);
                    check_queryerror($kqxs_update_q, $kqxs_update_r);
            }
    	}
    }
}
    
// Action Lo de End

function _guild_xh() {
    global $db;
    include('config/config_thehe.php');
    $slg_top = 20;
    
    $thehe_query = "";
    foreach($thehe_choise as $thehe_key => $thehe_val) {
        if(strlen($thehe_val) > 0) {
            if(strlen($thehe_query) > 0) $thehe_query .= ",";
            $thehe_query .= $thehe_key;
        }
    }
    
    // Kiem tra co Guild
    $guild_exist_q = "SELECT TOP 1 G_Name FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .")";
    $guild_exist_r = $db->Execute($guild_exist_q);
        check_queryerror($guild_exist_q, $guild_exist_r);
    $guild_exist_chk = $guild_exist_r->NumRows();
    
    if($guild_exist_chk > 0) {
        // Ngay dau tien
        $data_first_q = "SELECT TOP 1 G_PointTotal FROM Guild JOIN Character ON G_PointTotal > 0 AND Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .")";
        $data_first_r = $db->Execute($data_first_q);
            check_queryerror($data_first_q, $data_first_r);
        $data_first_chk = $data_first_r->NumRows();
        if($data_first_chk == 0) {
            _guild_data_sort();
        }
        // Ngay dau tien End
        
        $xh_check_q = "SELECT TOP 1 G_Name FROM Guild JOIN Character ON G_TopPoint > 0 AND Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .")";
        $xh_check_r = $db->Execute($xh_check_q);
            check_queryerror($xh_check_q, $xh_check_r);
        $xh_check_f = $xh_check_r->NumRows();
        if($xh_check_f[0] < 1) {
            // Guild TOP Point
            $g_toppoint_q = "SELECT TOP $slg_top G_Name FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .") ORDER BY G_PointTotal DESC";
            $g_toppoint_r = $db->Execute($g_toppoint_q);
                check_queryerror($g_toppoint_q, $g_toppoint_r);
            
            $top_point = 1;
            while($g_toppoint_f = $g_toppoint_r->FetchRow()) {
                $g_name = $g_toppoint_f[0];
                $g_toppoint_u_q = "UPDATE Guild SET G_TopPoint = $top_point WHERE G_Name = '$g_name'";
                $g_toppoint_u_r = $db->Execute($g_toppoint_u_q);
                    check_queryerror($g_toppoint_u_q, $g_toppoint_u_r);
                $top_point++;
            }
            
            // Guild TOP RS
            $g_toprs_q = "SELECT TOP $slg_top G_Name FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .") ORDER BY G_RSTotal DESC";
            $g_toprs_r = $db->Execute($g_toprs_q);
                check_queryerror($g_toprs_q, $g_toprs_r);
            
            $top_rs = 1;
            while($g_toprs_f = $g_toprs_r->FetchRow()) {
                $g_name = $g_toprs_f[0];
                $g_toprs_u_q = "UPDATE Guild SET G_TopRS = $top_rs WHERE G_Name = '$g_name'";
                $g_toprs_u_r = $db->Execute($g_toprs_u_q);
                    check_queryerror($g_toprs_u_q, $g_toprs_u_r);
                $top_rs++;
            }
            
            // Guild TOP MEM
            $g_topmem_q = "SELECT TOP $slg_top G_Name FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .") ORDER BY G_SlgMem DESC";
            $g_topmem_r = $db->Execute($g_topmem_q);
                check_queryerror($g_topmem_q, $g_topmem_r);
            
            $top_mem = 1;
            while($g_topmem_f = $g_topmem_r->FetchRow()) {
                $g_name = $g_topmem_f[0];
                $g_topmem_u_q = "UPDATE Guild SET G_TopMem = $top_mem WHERE G_Name = '$g_name'";
                $g_topmem_u_r = $db->Execute($g_topmem_u_q);
                    check_queryerror($g_topmem_u_q, $g_topmem_u_r);
                $top_mem++;
            }
        }
    }
}

function _guild_extra_point($name) {
    global $db, $timestamp;
    
    $time_update_q = "SELECT GUILD.G_Name, time_update_rsyesterday, G_TopPoint, G_SlgMem, G_Created FROM GUILD JOIN GuildMember ON GUILD.G_Name collate DATABASE_DEFAULT = GuildMember.G_Name collate DATABASE_DEFAULT AND Name='$name'";
    $time_update_r = $db->Execute($time_update_q);
        check_queryerror($time_update_q, $time_update_r);
    $time_update_chk = $time_update_r->NumRows();
    if($time_update_chk > 0) {
        $time_update_f = $time_update_r->FetchRow();
        $G_Name = $time_update_f[0];
        $time_update_rsyesterday = $time_update_f[1];
        $G_TopPoint = $time_update_f[2];
        $G_SlgMem = $time_update_f[3];
        $G_Create = strtotime($time_update_f[4]);
        
        $return['G_TopPoint'] = $G_TopPoint;
        $return['G_SlgMem'] = $G_SlgMem;
        $return['G_Create'] = $G_Create;
        $return['G_Created_day'] = floor( ($timestamp - $G_Create)/(24*60*60) );
        
        if(date('d', $time_update_rsyesterday) != date('d', $timestamp)) {
            $day_yesterday = date('d', $timestamp - 24*60*60);
            $month_yesterday = date('m', $timestamp - 24*60*60);
            $year_yesterday = date('Y', $timestamp - 24*60*60);
            
            $rs_total_yesterday_q = "SELECT SUM(reset_all) AS Sum_RS FROM TopReset JOIN GuildMember ON TopReset.name collate DATABASE_DEFAULT = GuildMember.Name collate DATABASE_DEFAULT AND G_Name='$G_Name' AND day=$day_yesterday AND month=$month_yesterday AND year=$year_yesterday";
            $rs_total_yesterday_r = $db->Execute($rs_total_yesterday_q);
                check_queryerror($rs_total_yesterday_q, $rs_total_yesterday_r);
                
            $rs_total_yesterday_f = $rs_total_yesterday_r->FetchRow();
            $rs_total_yesterday = abs(intval($rs_total_yesterday_f[0]));
            
            $rs_total_u_q = "UPDATE GUILD SET G_RSYesterday = $rs_total_yesterday, time_update_rsyesterday = $timestamp WHERE G_Name='$G_Name'";
            $rs_total_u_r = $db->Execute($rs_total_u_q);
                check_queryerror($rs_total_u_q, $rs_total_u_r);
            $return['G_RSYesterday'] = $rs_total_yesterday;
            
            return $return;
        } else {
            $rs_total_yesterday_q = "SELECT G_RSYesterday FROM GUILD WHERE G_Name='$G_Name'";
            $rs_total_yesterday_r = $db->Execute($rs_total_yesterday_q);
                check_queryerror($rs_total_yesterday_q, $rs_total_yesterday_r);
                
            $rs_total_yesterday_f = $rs_total_yesterday_r->FetchRow();
            $return['G_RSYesterday'] = $rs_total_yesterday_f[0];
            
            return $return;
        }
    } else {
        return 'none';
    }
}

if(!function_exists(_castleown)) {
    function _castleown($name, $day_castle_owner = 7) {
        global $db, $timestamp;
        
        $g_union_query = "SELECT Guild.G_Name, G_Union, Number FROM Guild JOIN GuildMember ON Guild.G_Name collate DATABASE_DEFAULT = GuildMember.G_Name collate DATABASE_DEFAULT AND Name='$name'";
        $g_union_result = $db->Execute($g_union_query);
            check_queryerror($g_union_query, $g_union_result);
        $g_union_fetch = $g_union_result->FetchRow();
        $g_name = $g_union_fetch[0];
        $g_union = $g_union_fetch[1];
        $g_number = $g_union_fetch[2];
            
        if($g_union > 0) {
            if($g_union == $g_number) {
                $g_union_pri = $g_name;
            } else {
                $g_union_pri_query = "SELECT G_Name FROM Guild WHERE Number = $g_union";
                $g_union_pri_result = $db->Execute($g_union_pri_query);
                    check_queryerror($g_union_pri_query, $g_union_pri_result);
                $g_union_pri_fetch = $g_union_pri_result->FetchRow();
                $g_union_pri = $g_union_pri_fetch[0];
            }
            
            $g_castle_owner_query = "SELECT SIEGE_END_DATE FROM MuCastle_DATA WHERE OWNER_GUILD = '$g_union_pri'";
            $g_castle_owner_result = $db->Execute($g_castle_owner_query);
                check_queryerror($g_castle_owner_query, $g_castle_owner_result);
            $g_castle_owner_check = $g_castle_owner_result->NumRows();
            if($g_castle_owner_check > 0) {
                $g_castle_owner_fetch = $g_castle_owner_result->FetchRow();
                $g_castle_owner_date = $g_castle_owner_fetch[0];
                $g_castle_owner_date_time = strtotime($g_castle_owner_date);
                
                if( ($timestamp - $g_castle_owner_date_time) > $day_castle_owner * 24*60*60 ) {
                    return 2;   // Qua thoi gian giu thanh
                } else {
                    return 1;   // Nam trong LM giu thanh
                }
            } else {
                return 3;   // Kg Nam trong LM giu thanh
            }
        } else {
            $g_castle_owner_query = "SELECT * FROM MuCastle_DATA WHERE OWNER_GUILD = '$g_name'";
            $g_castle_owner_result = $db->Execute($g_castle_owner_query);
                check_queryerror($g_castle_owner_query, $g_castle_owner_result);
            $g_castle_owner_check = $g_castle_owner_result->NumRows();
            if($g_castle_owner_check > 0) {
                return 4;   // Giu thanh nhung khong co Lien Minh
            } else {
                return 5;   // Kg co Lien Minh, Kg giu thanh
            }
        }
    }
}

if(!function_exists(event1_type1_slg)) {
    function event1_type1_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        $event1_type1_slg_query = "SELECT ISNULL(SUM(slg), 0) FROM Event_TOP_Point WHERE name='$name' AND type=1 AND [time] >= '$event_toppoint_begin' AND [time] <= '$event_toppoint_end' GROUP BY name";
        $event1_type1_slg_result = $db->Execute($event1_type1_slg_query);
            check_queryerror($event1_type1_slg_query, $event1_type1_slg_result);
        $event1_type1_slg_fetchrow = $event1_type1_slg_result->FetchRow();

        if(intval($event1_type1_slg_fetchrow[0]) > 0) return $event1_type1_slg_fetchrow[0];
        else return 0;
    }
}

if(!function_exists(event1_type2_slg)) {
    function event1_type2_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        $event1_type2_slg_query = "SELECT ISNULL(SUM(slg), 0) FROM Event_TOP_Point WHERE name='$name' AND type=2 AND [time] >= '$event_toppoint_begin' AND [time] <= '$event_toppoint_end' GROUP BY name";
        $event1_type2_slg_result = $db->Execute($event1_type2_slg_query);
            check_queryerror($event1_type2_slg_query, $event1_type2_slg_result);
        $event1_type2_slg_fetchrow = $event1_type2_slg_result->FetchRow();
        
        if(intval($event1_type2_slg_fetchrow[0]) > 0) return $event1_type2_slg_fetchrow[0];
        else return 0;
    }
}

if(!function_exists(event1_type3_slg)) {
    function event1_type3_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        $event1_type3_slg_query = "SELECT ISNULL(SUM(slg), 0) FROM Event_TOP_Point WHERE name='$name' AND type=3 AND [time] >= '$event_toppoint_begin' AND [time] <= '$event_toppoint_end' GROUP BY name";
        $event1_type3_slg_result = $db->Execute($event1_type3_slg_query);
            check_queryerror($event1_type3_slg_query, $event1_type3_slg_result);
        $event1_type3_slg_fetchrow = $event1_type3_slg_result->FetchRow();
        
        if(intval($event1_type3_slg_fetchrow[0]) > 0) return $event1_type3_slg_fetchrow[0];
        else return 0;
    }
}

if(!function_exists(event1_type1_daily_slg)) {
    function event1_type1_daily_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        $datetime_now = "$year-$month-$day";
        $event1_type1_daily_slg_query = "SELECT slg FROM Event_TOP_Point WHERE name='$name' AND type=1 AND [time] = '$datetime_now'";
        $event1_type1_daily_slg_result = $db->Execute($event1_type1_daily_slg_query);
            check_queryerror($event1_type1_daily_slg_query, $event1_type1_daily_slg_result);
        $event1_type1_daily_slg_check = $event1_type1_daily_slg_result->NumRows();
        
        if($event1_type1_daily_slg_check > 0) {
            $event1_type1_daily_slg_fetchrow = $event1_type1_daily_slg_result->FetchRow();
            return $event1_type1_daily_slg_fetchrow[0];
        }
        
        return 0;
    }
}

if(!function_exists(event1_type2_daily_slg)) {
    function event1_type2_daily_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        
        $datetime_now = "$year-$month-$day";
        $event1_type2_daily_slg_query = "SELECT slg FROM Event_TOP_Point WHERE name='$name' AND type=2 AND [time] = '$datetime_now'";
        $event1_type2_daily_slg_result = $db->Execute($event1_type2_daily_slg_query);
            check_queryerror($event1_type2_daily_slg_query, $event1_type2_daily_slg_result);
        $event1_type2_daily_slg_check = $event1_type2_daily_slg_result->NumRows();
        
        if($event1_type2_daily_slg_check > 0) {
            $event1_type2_daily_slg_fetchrow = $event1_type2_daily_slg_result->FetchRow();
            return $event1_type2_daily_slg_fetchrow[0];
        }
        
        return 0;
    }
}

if(!function_exists(event1_type3_daily_slg)) {
    function event1_type3_daily_slg($name)
    {
    	global $db, $timestamp, $day, $month, $year, $event_toppoint_begin, $event_toppoint_end;
        
        
        $datetime_now = "$year-$month-$day";
        $event1_type3_daily_slg_query = "SELECT slg FROM Event_TOP_Point WHERE name='$name' AND type=3 AND [time] = '$datetime_now'";
        $event1_type3_daily_slg_result = $db->Execute($event1_type3_daily_slg_query);
            check_queryerror($event1_type3_daily_slg_query, $event1_type3_daily_slg_result);
        $event1_type3_daily_slg_check = $event1_type3_daily_slg_result->NumRows();
        
        if($event1_type3_daily_slg_check > 0) {
            $event1_type3_daily_slg_fetchrow = $event1_type3_daily_slg_result->FetchRow();
            return $event1_type3_daily_slg_fetchrow[0];
        }
        
        return 0;
    }
}

if(!function_exists(fixrs)) {
    function fixrs($name)
    {
    	global $db, $timestamp, $day, $month, $year;
    
        $resetcheck_query = "SELECT ResetNBB FROM Character WHERE Name='$name' AND (Resets=0 OR Resets=1) AND ResetNBB>1";
        $resetcheck_result = $db->Execute($resetcheck_query);
            check_queryerror($resetcheck_query, $resetcheck_result);
        $resetcheck_exits = $resetcheck_result->NumRows();
        if($resetcheck_exits > 0) {
            $resetfix_query = "UPDATE Character SET Resets=ResetNBB WHERE Name='$name'";
            $resetfix_result = $db->Execute($resetfix_query);
                check_queryerror($resetfix_query, $resetfix_result);
        }
    }
}

/**
 * _langarr()
 * 
 * @param mixed $string
 * @param mixed $arr
 * @return
 */
function _langarr($string, $arr) {
    foreach($arr as $str_replace) {
        $string = preg_replace('/%s/', $str_replace, $string, 1);
    }
    
    return $string;
}

function unserialize_safe($serialized) {
    // unserialize will return false for object declared with small cap o
    // as well as if there is any ws between O and :
    if (is_string($serialized) && strpos($serialized, "\0") === false) {
        if (strpos($serialized, 'O:') === false) {
            // the easy case, nothing to worry about
            // let unserialize do the job
            return @unserialize($serialized);
        } else if (!preg_match('/(^|;|{|})O:[0-9]+:"/', $serialized)) {
            // in case we did have a string with O: in it,
            // but it was not a true serialized object
            return @unserialize($serialized);
        }
    }
    return false;
}

if(!function_exists(nbb_encode)) {
        /**
     * nbb_encode()
     * Only For Number
     * @param mixed $text
     * @return
     */
    function nbb_encode($text) {
        $char[0] = array("5", "G", "T");
        $char[1] = array("8", "I", "L");
        $char[2] = array("1", "D", "Q");
        $char[3] = array("9", "C", "P");
        $char[4] = array("6", "J", "O");
        $char[5] = array("2", "H", "N");
        $char[6] = array("7", "A", "M");
        $char[7] = array("0", "F", "R");
        $char[8] = array("3", "B", "K");
        $char[9] = array("4", "E", "S");
            
        $text_encoded = "";
        for($i=0; $i<strlen($text); $i++) {
            $char_split = substr($text, $i, 1);
            $char_split = abs(intval($char_split));
            $random = rand(0, count($char[$char_split])-1);
            $char_encode = $char[$char_split][$random];
            $text_encoded .= $char_encode;
        }
        return $text_encoded;
    }
}

if(!function_exists(nbb_encode_extra)) {
        /**
     * nbb_encode_extra()
     * Add Extra Random Character
     * @param mixed $text_encoded
     * @param mixed $length
     * @return
     */
    function nbb_encode_extra($text_encoded, $length) {
        $char_arr = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T");
        if(strlen($text_encoded) < $length) {
            for($j=0; $j<($length-strlen($text_encoded)); $j++) {
                $random = array_rand($char_arr);
                $char_rand = $char_arr[$random];
                $text_encoded .= $char_rand;
                unset($char_arr[$random]);
            }
        }
        return $text_encoded;
    }
}

if(!function_exists(nbb_decode)) {
        /**
     * nbb_decode()
     * Decode Number Encoded
     * @param mixed $text_encoded
     * @return
     */
    function nbb_decode($text_encoded) {
        $char[0] = array("5", "G", "T");
        $char[1] = array("8", "I", "L");
        $char[2] = array("1", "D", "Q");
        $char[3] = array("9", "C", "P");
        $char[4] = array("6", "J", "O");
        $char[5] = array("2", "H", "N");
        $char[6] = array("7", "A", "M");
        $char[7] = array("0", "F", "R");
        $char[8] = array("3", "B", "K");
        $char[9] = array("4", "E", "S");
        
        $text_decoded = "";
        for($i=0; $i<strlen($text_encoded); $i++) {
            $char_split = substr($text_encoded, $i, 1);
            $char_decoded = null;
            for($j=0; $j<10; $j++) {
                if(in_array($char_split, $char[$j])) {
                    $char_decoded = $j;
                    break;
                }
            }
            $text_decoded .= $char_decoded;
        }
        return $text_decoded;
    }
}

if(!function_exists(get_ip)) {
	function get_ip()
    {
    	# Enable X_FORWARDED_FOR IP matching?
    	$do_check = 1;
    	$addrs = array();
    
    	if( $do_check )
    	{
    		foreach( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_f )
    		{
    			$x_f = trim($x_f);
    			if( preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f) )
    			{
    				$addrs[] = $x_f;
    			}
    		}
    
    		$addrs[] = $_SERVER['HTTP_CLIENT_IP'];
    		$addrs[] = $_SERVER['HTTP_PROXY_USER'];
    	}
    
    	$addrs[] = $_SERVER['REMOTE_ADDR'];
    
    	foreach( $addrs as $v )
    	{
    		if( $v )
    		{
    			preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $v, $match);
    			$ip = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];
    
    			if( $ip && $ip != '...' )
    			{
    				break;
    			}
    		}
    	}
    
    	if( ! $ip || $ip == '...' )
    	{
    		print_error("Không thể xác định địa chỉ IP của bạn.");
    	}
    
    	return $ip;
    }
}


/**
 * read_TagName()
 * 
 * @param mixed $content
 * @param mixed $tagname
 * @param integer $vitri
 * $vitri = 0 : output All
 * $vitri = x : output Element x, Element 0 : Count Total Element
 * @return
 */
function read_TagName($content, $tagname, $vitri = 1)
{
    $tag_begin = '<'. $tagname . '>';
    $tag_end = '</'. $tagname . '>';
    $content1 = explode($tag_begin, $content);
    $slg_string = count($content1)-1;
    $output[] = $slg_string;    // Vị trí đầu tiên xuất ra số lượng phần tử
    for($i=1; $i<count($content1); $i++)    // Duyệt từ phần tử thứ 1 đến hết
    {
        $content2 = explode($tag_end, $content1[$i]);
        $output[] = $content2[0];
    }
    
    if($vitri == 0) return $output;
    else return $output[$vitri];
}


function writelog($file, $logcontent) {
    $Date = date("h:i:sA, d/m/Y");  
	$fp = fopen($file, "a+");  
	fputs ($fp, "Lúc: $Date. $logcontent \n----------------------------------------------------------------------\n\n");
	fclose($fp);
}

    
?>