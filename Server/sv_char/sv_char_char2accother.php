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
 

include_once('config/config_char2accother.php');

$login = $_POST['login'];

$name = $_POST['nameold'];
$acctranfer = $_POST['acctranfer'];
$chartranfer = $_POST['chartranfer'];

$pass2 = $_POST['pass2'];
$quest = $_POST['quest'];
$ans = $_POST['ans'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

if(check_nv($acctranfer, $chartranfer) == 0) {
    echo "Nhân vật <b>{$chartranfer}</b> không nằm trong tài khoản <b>{$acctranfer}</b>. Vui lòng kiểm tra lại."; exit();
}

fixrs($name);

kiemtra_pass2($login,$pass2);

kiemtra_char($login,$name);
kiemtra_online($login);
kiemtra_doinv($login,$name);

kiemtra_char($acctranfer,$chartranfer);
kiemtra_online($acctranfer);
kiemtra_doinv($acctranfer,$chartranfer);

//Get Info
$get_info_query = "SELECT mail_addr,fpas_ques,fpas_answ, thehe FROM MEMB_INFO WHERE memb___id='$login'";
$get_info_result = $db->Execute($get_info_query);
$get_info = $get_info_result->fetchrow();

if($quest != $get_info[1])
{
	echo "Câu hỏi bí mật kiểm tra không đúng"; exit();
}
if($ans != $get_info[2])
{
	echo "Câu trả lời bí mật kiểm tra không đúng"; exit();
}

$thehe_old = $get_info[3];

$info_new_query = "SELECT thehe FROM MEMB_INFO WHERE memb___id='$acctranfer'";
$info_new_result = $db->Execute($info_new_query);
    check_queryerror($info_new_query, $info_new_result);
$thehe_fetch = $info_new_result->FetchRow();
$thehe_new = $thehe_fetch[0];

if($thehe_old != $thehe_new) {
    echo "Tài khoản cũ và tài khoản chuyển sang không cùng Thế hệ hoặc Server. Chỉ được chuyển tài khoản cùng Thế hệ hoặc Server"; 
    exit();
}

$gcoin_query = "Select gcoin,gcoin_km From MEMB_INFO where memb___id='$login'";
$gcoin_result = $db->Execute($gcoin_query);
    check_queryerror($gcoin_query, $gcoin_result);
$gcoin = $gcoin_result->fetchrow();

$gcoinnew = $gcoin[0];
$gcoin_km = $gcoin[1];
$gcoin_total = $gcoinnew + $gcoin_km;

if ($gcoin_total < $char2accother_gcoin){ 
 echo "Bạn có $gcoin_total Gcoin. Bạn cần $char2accother_gcoin Gcoin để chuyển nhân vật sang tài khoản khác."; exit();
} else {
    
    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_char2accother.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'char2accother_gcoin'    =>  $char2accother_gcoin,
        'gcoinnew'    =>  $gcoinnew,
        'gcoin_km'    =>  $gcoin_km
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
        echo $notice;
        exit();
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $message = read_TagName($reponse, 'message');
            echo $message;
            exit();
        } elseif ($info == "OK") {
            $data = read_TagName($reponse, 'data');
            $data_arr = unserialize_safe($data);
            $gcoinnew = $data_arr['gcoinnew'];
            $gcoin_km = $data_arr['gcoin_km'];
            if(strlen($gcoinnew) == 0 || strlen($gcoin_km) == 0) {
                echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                $arr_view = "\nDataSend:\n";
                foreach($getcontent_data as $k => $v) {
                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                }
                writelog("log_api.txt", $arr_view . $reponse);
                exit();
            }
        } else {
            echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
            writelog("log_api.txt", $reponse);
            exit();
        }
    }
}

kiemtra_online($login);
kiemtra_doinv($login,$name);

kiemtra_online($acctranfer);
kiemtra_doinv($acctranfer,$chartranfer);

    $name_tmp_count = 0;
    $name_tmp_flag = false;
    while ($name_tmp_flag === false) {
    	++$name_tmp_count;
        $name_tmp = '*nametmp' . $name_tmp_count;
        $chartemp_check_q = "SELECT count(*) FROM Character WHERE Name='$name_tmp'";
        $chartemp_check_r = $db->Execute($chartemp_check_q);
            check_queryerror($chartemp_check_q, $chartemp_check_r);
        $chartemp_check_f = $chartemp_check_r->FetchRow();
        if($chartemp_check_f[0] == 0) {
            $name_tmp_flag = true;
        }
    }
    
    $acc_tmp_count = 0;
    $acc_tmp_flag = false;
    while ($acc_tmp_flag === false) {
    	++$acc_tmp_count;
        $acc_tmp = '*acctmp' . $acc_tmp_count;
        $acctemp_check_q = "SELECT count(*) FROM Character WHERE AccountID='$acc_tmp'";
        $acctemp_check_r = $db->Execute($acctemp_check_q);
            check_queryerror($acctemp_check_q, $acctemp_check_r);
        $acctemp_check_f = $acctemp_check_r->FetchRow();
        if($acctemp_check_f[0] == 0) {
            $acc_tmp_flag = true;
        }
    }
    
    // Update Name New to Tmp
    $new2tmp_q1 = "UPDATE Character SET AccountID='$acc_tmp', Name='$name_tmp' WHERE Name='$chartranfer' AND AccountID='$acctranfer'";
    $new2tmp_r1 = $db->Execute($new2tmp_q1);
        check_queryerror($new2tmp_q1, $new2tmp_r1);
    
    $new2tmp_q3 = "UPDATE TopReset SET acc='$acc_tmp', Name='$name_tmp' WHERE Name='$chartranfer' AND acc='$acctranfer'";
    $new2tmp_r3 = $db->Execute($new2tmp_q3);
        check_queryerror($new2tmp_q3, $new2tmp_r3);
    
    $new2tmp_q4 = "UPDATE TopResetScore SET acc='$acc_tmp', Name='$name_tmp' WHERE Name='$chartranfer' AND acc='$acctranfer'";
    $new2tmp_r4 = $db->Execute($new2tmp_q4);
        check_queryerror($new2tmp_q4, $new2tmp_r4);
    
    $new2tmp_q5 = "UPDATE Event_TOP_RS SET acc='$acc_tmp', Name='$name_tmp' WHERE Name='$chartranfer' AND acc='$acctranfer'";
    $new2tmp_r5 = $db->Execute($new2tmp_q5);
        check_queryerror($new2tmp_q5, $new2tmp_r5);
    
    $new2tmp_q6 = "UPDATE Event_TOP_Point SET acc='$acc_tmp', Name='$name_tmp' WHERE Name='$chartranfer' AND acc='$acctranfer'";
    $new2tmp_r6 = $db->Execute($new2tmp_q6);
        check_queryerror($new2tmp_q6, $new2tmp_r6);
    
    
    // Update NameOld to NameNew
    $old2new_q1 = "UPDATE Character SET AccountID='$acctranfer', Name='$chartranfer' WHERE Name='$name' AND AccountID='$login'";
    $old2new_r1 = $db->Execute($old2new_q1);
        check_queryerror($old2new_q1, $old2new_r1);
    
    $old2new_q3 = "UPDATE TopReset SET acc='$acctranfer', Name='$chartranfer' WHERE Name='$name' AND acc='$login'";
    $old2new_r3 = $db->Execute($old2new_q3);
        check_queryerror($old2new_q3, $old2new_r3);
    
    $old2new_q4 = "UPDATE TopResetScore SET acc='$acctranfer', Name='$chartranfer' WHERE Name='$name' AND acc='$login'";
    $old2new_r4 = $db->Execute($old2new_q4);
        check_queryerror($old2new_q4, $old2new_r4);
    
    $old2new_q5 = "UPDATE Event_TOP_RS SET acc='$acctranfer', Name='$chartranfer' WHERE Name='$name' AND acc='$login'";
    $old2new_r5 = $db->Execute($old2new_q5);
        check_queryerror($old2new_q5, $old2new_r5);
    
    $old2new_q6 = "UPDATE Event_TOP_Point SET acc='$acctranfer', Name='$chartranfer' WHERE Name='$name' AND acc='$login'";
    $old2new_r6 = $db->Execute($old2new_q6);
        check_queryerror($old2new_q6, $old2new_r6);
    
        
    // Update Name Old to Tmp
    $tmp2old_q1 = "UPDATE Character SET AccountID='$login', Name='$name' WHERE Name='$name_tmp' AND AccountID='$acc_tmp'";
    $tmp2old_r1 = $db->Execute($tmp2old_q1);
        check_queryerror($tmp2old_q1, $tmp2old_r1);
    
    $tmp2old_q3 = "UPDATE TopReset SET acc='$login', Name='$name' WHERE Name='$name_tmp' AND acc='$acc_tmp'";
    $tmp2old_r3 = $db->Execute($tmp2old_q3);
        check_queryerror($tmp2old_q3, $tmp2old_r3);
    
    $tmp2old_q4 = "UPDATE TopResetScore SET acc='$login', Name='$name' WHERE Name='$name_tmp' AND acc='$acc_tmp'";
    $tmp2old_r4 = $db->Execute($tmp2old_q4);
        check_queryerror($tmp2old_q4, $tmp2old_r4);    
    
    $tmp2old_q5 = "UPDATE Event_TOP_RS SET acc='$login', Name='$name' WHERE Name='$name_tmp' AND acc='$acc_tmp'";
    $tmp2old_r5 = $db->Execute($tmp2old_q5);
        check_queryerror($tmp2old_q5, $tmp2old_r5);    
    
    $tmp2old_q6 = "UPDATE Event_TOP_Point SET acc='$login', Name='$name' WHERE Name='$name_tmp' AND acc='$acc_tmp'";
    $tmp2old_r6 = $db->Execute($tmp2old_q6);
        check_queryerror($tmp2old_q6, $tmp2old_r6);   

    
    $update_gcoin_query = "UPDATE MEMB_INFO SET [gcoin] = '$gcoinnew',gcoin_km=$gcoin_km WHERE memb___id = '$login'";
    $update_gcoin_result= $db->Execute($update_gcoin_query);
        check_queryerror($update_gcoin_query, $update_gcoin_result);

    
    //Ghi vào Log nhung nhan vat doi ten
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $changename_gcoin Gcoin";
        $log_Des = "Tài khoản $login, nhân vật $name Chuyển sang Tài khoản $acctranfer, Nhân vật $chartranfer";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat doi ten
    
    echo "<info>OK</info>
        <gcoin>$gcoinnew</gcoin>
        <gcoinkm>$gcoin_km</gcoinkm>
        <notice>Nhân vật <strong>$name</strong> đã được chuyển sang Tài khoản <strong>$acctranfer</strong>, Nhân vật : <b>$chartranfer</b> thành công.</notice>
    ";
}

?>