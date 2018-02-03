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
include_once("../func_timechenh.php");

function antiinject_query($value) {
    $value = stripslashes($value);
    $value = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    return $value;
}

function check_queryerror($query,$result) {
    if ($result === false) {
        writelog('log_query.txt', $query);
        die("Query Error : $query");
    }
}

function kiemtra_cardnumber($card_num) {
	if (!preg_match("/^[a-zA-Z0-9]*$/i", $card_num))
	{
    echo "Du lieu loi : $card_num . Chi duoc su dung ki tu a-z, A-Z va (1-9)."; exit();
	}
}

function kiemtra_kituso($login) {
	if (!preg_match("/^[0-9]*$/i", $login))
	{
    echo "Du lieu loi : $login . Chi duoc su dung so (1-9)."; exit();
	}
}

function kiemtra_kitudacbiet($login) {
	if (!preg_match("/^[a-zA-Z0-9_]*$/i", $login))
	{
    echo "Du lieu loi : $login . Chi duoc su dung ki tu a-z, A-Z, so (1-9) va dau _."; exit();
	}
}

function kiemtra_email($email) {
	if (!preg_match("/^[a-zA-Z0-9\.@_-]*$/i", $email))	{
    echo "Email Khong duoc su dung nhung ky tu dac biet."; exit();
	}
	if (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[\.a-z]{2,6}$/i", $email)) {
	echo "Dia chi Email khong dung. Xin vui long kiem tra lai."; exit();
	}
}

function checklogin($login,$stringlogin)
{
	include('config.php');
	$query_checklogin = "SELECT checklogin FROM MEMB_INFO WHERE memb___id='$login'";
	$result_checklogin = $db->Execute($query_checklogin);
        check_queryerror($query_checklogin, $result_checklogin);
	$checklogin = $result_checklogin->fetchrow();
	if($stringlogin != $checklogin[0]) {
		echo "login_other";
		exit();
	}
}

function kiemtra_acc($login) {
	include('config.php');
    $sql_username_check_query = "SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'";
	$sql_username_check = $db->Execute($sql_username_check_query); 
        check_queryerror($sql_username_check_query, $sql_username_check);
	$username_check = $sql_username_check->numrows(); 
	if ($username_check <= 0){ 
 		echo "Tài khoản không tồn tại."; exit();
	}
}

function kiemtra_loggame($login) {
	include('config.php');
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

function kiemtra_block_acc($login) {
	include('config.php');
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

function kiemtra_pass($login,$pass) {
	include('config.php');
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

function kiemtra_pass2($login,$pass2) {
	include('config.php');
	$sql_pw_check = $db->Execute("SELECT * FROM MEMB_INFO WHERE pass2='$pass2' and memb___id='$login'"); 
	$pw_check = $sql_pw_check->numrows(); 
	if ($pw_check <= 0){ 
 		echo "Mật khẩu cấp 2 không đúng."; exit();
 	}
}

function kiemtra_char($login,$name) {
	include('config.php');
	$sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and AccountID = '$login'"); 
	$name_check = $sql_name_check->numrows();
	if ($name_check <= 0){ 
   		echo "$name : Tên nhân vật sai."; exit();
	}
}

function kiemtra_block_char($login,$name) {
	include('config.php');
	$sql_block_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and CtlCode='1' and AccountID='$login'"); 
	$block_check = $sql_block_check->numrows();
	if ($block_check > 0){ 
   		echo "Nhân vật đang bị khóa."; exit();
 	}
}

function kiemtra_online($login) {
	include('config.php');
	$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$login' AND ConnectStat='1'");
	$online_check = $sql_online_check->numrows();
	if ($online_check > 0){ 
   		echo "$login chưa thoát Game. Hãy thoát Game trước khi thực hiện chức năng này."; exit();
	}
}

function kiemtra_timeout($login) {
	include('config.php');
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

function kiemtra_doinv($login,$name) {
	include('config.php');
	$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$login' AND GameIDC='$name'");
	$doinv_check = $sql_doinv_check->numrows();
	if ($doinv_check > 0){ 
   		echo "Nhân vật $name không được là nhân vật thoát ra sau cùng. Hãy vào Game và chọn nhân vật khác trước khi thực hiện chức năng này."; exit();
	}
}

function getSerial() {
	include('config.php');
	$getSerial = $db->Execute("EXEC WZ_GetItemSerial"); 
	return $getSerial;
}

if(!function_exists(_getSerial)) {
    function _getSerial() {
    	include('config.php');
    	$getSerial_query = $db->Execute("EXEC WZ_GetItemSerial");
    	$getSerial_fetch = $getSerial_query->fetchrow();
    	$Serial = dechex($getSerial_fetch[0]);
    	while(strlen($Serial) < 8) {
        	$Serial = '0'. $Serial;
        }
    	return $Serial;
    }
}

function kiemtra_GM($login) {
	global $gm;
	include('config.php');
	$sql_gm_check = $db->Execute("SELECT * FROM Character WHERE AccountID='$login' and (CtlCode=8 or CtlCode=32)"); 
	$gm_check = $sql_gm_check->numrows(); 
	if ($gm_check <= 0){ 
 		$gm = 'NoGM';
	}
	else $gm = 'isGM';
}

function kiemtra_daily($login) {
	global $dl;
	include('config.php');
	$sql_daily_check = $db->Execute("SELECT * FROM DaiLy WHERE accdl='$login'"); 
	$daily_check = $sql_daily_check->numrows(); 
	if ($daily_check <= 0){ 
 		$dl = 'NoDL';
	}
	else $dl = 'isDL';
}

function kiemtra_hackreset($login,$name) {
	include('config.php');
	$time_check = $timestamp-60;
	$sql_hack_check = $db->Execute("SELECT Name FROM Character WHERE Resets_Time>'$time_check' and Clevel = '400'"); 
	while($hack_check = $sql_hack_check->fetchrow()) 	{
		$xuly_hack = $db->Execute("Update Character SET Resets=Resets-1,NoResetInDay=NoResetInDay-1,NoResetInMonth=NoResetInMonth-1,Resets_Time=$time_check WHERE Name='$hack_check[0]'");
		if( $hack_check[0] == $name ) {
			echo "Nhân vật $name đã thực hiện hành vi Hack Reset. Bạn đã bị trừ 1 lần Reset";exit();
		}
	}
}

function check_resetday()
{
	include('config.php');
	
	$check_resetday_query = "SELECT time,status FROM Check_Action WHERE action='ResetInDay'";
	$check_resetday_result = $db->Execute($check_resetday_query);
        check_queryerror($check_resetday_query, $check_resetday_result);
	$check_resetday = $check_resetday_result->fetchrow();
	
	$check_day = date("d",$check_resetday[0]);
	if($check_day != $day)
	{
		$run_check_resetday_query = "Update Check_Action SET time='$timestamp' WHERE action='ResetInDay'";
		$run_check_resetday_result = $db->Execute($run_check_resetday_query);
            check_queryerror($run_check_resetday_query, $run_check_resetday_result);
		
		$run_resetday_query = "UPDATE Character SET NoResetInDay=0 WHERE NoResetInDay>0";
		$run_resetday_result = $db->Execute($run_resetday_query);
            check_queryerror($run_resetday_query, $run_resetday_result);
	}
}

function top50()
{
	include('config.php');
	
    $check_top50_query = "SELECT time FROM Check_Action WHERE action='Top50'";
    $check_top50_result = $db->Execute($check_top50_query);
        check_queryerror($check_top50_query, $check_top50_result);
    $check_top50 = $check_top50_result->fetchrow();
    //Reset số lần RS trong tháng khi sang tháng mới
    $time_top50 = date("d",$check_top50[0]);
    if($time_top50 != $day)
    {
       //Update Time check
       $update_time_query = "UPDATE Check_Action SET time='$timestamp' WHERE action='Top50'";
       $update_time_result = $db->Execute($update_time_query);
        check_queryerror($update_time_query, $update_time_result);
        
        // Neu khong phai ngay dau tien
        if($check_top50[0] != 0) {
            //Reset TOP 50
            $resettop50_query = "UPDATE Character SET Top50=0 WHERE Top50>0";
            $resettop50_result = $db->Execute($resettop50_query);
                check_queryerror($resettop50_query, $resettop50_result);
            
        	$query_top50 = "SELECT TOP 50 Name FROM Character ORDER BY Relifes DESC, Resets DESC , cLevel DESC";
        	$result_top50 = $db->Execute($query_top50);
                check_queryerror($query_top50, $result_top50);
        	$top = 1;
            while( $top50 = $result_top50->fetchrow() )
        	{
        		$updatetop50_query = "UPDATE Character SET Top50=$top WHERE Name='$top50[0]'";
                $updatetop50_result = $db->Execute($updatetop50_query);
                    check_queryerror($updatetop50_query, $updatetop50_result);
                $top++;
        	}
        }
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

if(!function_exists(writelog)) {
    function writelog($file, $logcontent) {
        $Date = date("h:i:sA, d/m/Y");  
    	$fp = fopen($file, "a+");  
    	fputs ($fp, "Lúc: $Date. $logcontent \n----------------------------------------------------------------------\n\n");
    	fclose($fp);
    }
}
?>