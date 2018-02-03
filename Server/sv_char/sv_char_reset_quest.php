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
 

$login = $_POST['login'];
$name = $_POST['name'];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_char($login,$name);
kiemtra_doinv($login,$name);

$time_resetquest_allow = $timestamp - 24*60*60;
$time_resetquest_allow2 = $timestamp + 30;
$reset_quest_check_query = "SELECT count(*) FROM Log_TienTe WHERE acc='$login' AND time>$time_resetquest_allow AND time<$time_resetquest_allow2 AND Des like '$name Đã làm lại Quest%'";
$reset_quest_check_result = $db->Execute($reset_quest_check_query);
    check_queryerror($reset_quest_check_query, $reset_quest_check_result);
$reset_quest_check_fetch = $reset_quest_check_result->FetchRow();
if($reset_quest_check_fetch[0] > 0) {
    echo "1 Ngày chỉ được phép Reset Quest 1 lần. Vui lòng chờ 24h kể từ lần Reset Quest trước."; exit();
}

$char_info_query = "SELECT Class, CAST(Inventory as image) FROM Character WHERE Name='$name'";
$char_info_result = $db->Execute($char_info_query);
    check_queryerror($char_info_query, $char_info_result);
$char_info_fetch = $char_info_result->FetchRow();

$ClassType =  $char_info_fetch[0];
    switch ($ClassType){ 
        case 1:
        case 2:
        case 3:
            $class_base = 0;
    	break;
    
        case 17:
        case 18:
        case 19:
            $class_base = 16;
    	break;
    
        case 33:
        case 34:
        case 35:
            $class_base = 32;
    	break;
        
        case 49:
        case 50:
            $class_base = 48;
    	break;
        
        case 65:
        case 66:
            $class_base = 64;
    	break;
        
        case 81:
        case 82:
        case 83:
            $class_base = 80;
    	break;
        
        case 97:
        case 98:
            $class_base = 96;
    	break;
    
    	default :
            $class_base = 'error';
    }
    
   

if($class_base === 'error') {
    echo "Nhân vật chưa làm nhiệm vụ nào. Không thể Reset nhiệm vụ."; exit();
}

$inventory = $char_info_fetch[1];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
$inventory1 = substr($inventory,0,12*32);

$inventory1_fresh = "";
for($i=0; $i<12*32; $i++) {
    $inventory1_fresh .= "F";
}

if($inventory1 != $inventory1_fresh) {
    echo "Nhân vật chưa tháo hết đồ trên người. Vui lòng tháo hết đồ để tránh mất mát tài sản."; exit();
}


kiemtra_doinv($login,$name);

$questnothing = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
$char_update_query = "UPDATE Character SET [Class]=$class_base, [MagicList]= CONVERT(varbinary(180), null), [Quest]=0x$questnothing WHERE Name='$name'";
$char_update_result = $db->Execute($char_update_query);
    check_queryerror($char_update_query, $char_update_result);

//Ghi vào Log nhung nhan vat Lam lai Quest
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "$name Đã làm lại Quest thành công.";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat Lam lai Quest


	echo "<info>OK</info><class>$class_base</class>";
}

?>