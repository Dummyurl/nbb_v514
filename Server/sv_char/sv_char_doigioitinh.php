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
 

include_once('config/config_doigioitinh.php');
include_once('config/config_event.php');

$login = $_POST['login'];
$name = $_POST['name'];
$gioitinh = $_POST['gioitinh'];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

fixrs($name);

kiemtra_pass2($login,$pass2);
kiemtra_char($login,$name);
kiemtra_doinv($login,$name);

$sql_char_check = $db->Execute("SELECT Class,Resets,Resets_Time,NoResetInDay FROM Character WHERE Name='$name' and AccountID = '$login'"); 
$char_check = $sql_char_check->fetchrow();

$gcoin_check = $db->Execute("Select gcoin,gcoin_km From MEMB_INFO where memb___id='$login'");
$gcoin = $gcoin_check->fetchrow();

$gcoin_before = $gcoin[0];
$gcoin_km_before = $gcoin[1];

	switch ($gioitinh)
	{
		case $class_dw_1:	$gioitinhsau = "Dark Wizard"; break;
		case $class_dk_1:	$gioitinhsau = "Dark Knight"; break;
		case $class_elf_1:	$gioitinhsau = "ELF"; break;
		case $class_sum_1:	$gioitinhsau = "Summoner"; break;
		case $class_mg_1:	$gioitinhsau = "Magic Gladiator"; break;
		case $class_dl_1:	$gioitinhsau = "Dark Lord"; break;
        case $class_rf_1:	$gioitinhsau = "Rage Fighter"; break;
	};

if ($char_check[0] == $gioitinh) {
	echo "Nhân vật $name đang có giới tính trùng với giới tính muốn đổi. Xin vui lòng kiểm tra lại."; exit();
}

if ( $char_check[1] < $doigt_resetmin ) {
	echo "Nhân vật $name không đủ số lần Reset yêu cầu để Đổi Giới Tính."; exit();
} elseif($char_check[1] == 0) {
    $reset_after = 0;
} else {
    if($doigt_trureset>0) $reset_after = ceil($char_check[1] * ( 1 - ($doigt_trureset/100) ));
    else  $reset_after = $char_check[1];
}

if ( $char_check[3] <= 0 ) {
	$rs_day_after = 0;
} else { 
    if($doigt_trureset > 0) $rs_day_after = ceil( $char_check[3] * ( 1 - ($doigt_trureset/100) ) );
    else  $rs_day_after = $char_check[3];
}

	switch ($char_check[0])
	{
		case $class_dw_1:		$gioitinhtruoc = "Dark Wizard"; break;
		case $class_dw_2:		$gioitinhtruoc = "Soul Master"; break;
		case $class_dw_3:		$gioitinhtruoc = "Grand Master"; break;
		
		case $class_dk_1:	$gioitinhtruoc = "Dark Knight"; break;
		case $class_dk_2:	$gioitinhtruoc = "Blade Knight"; break;
		case $class_dk_3:	$gioitinhtruoc = "Blade Master"; break;
		
		case $class_elf_1:	$gioitinhtruoc = "ELF"; break;
		case $class_elf_2:	$gioitinhtruoc = "Muse ELF"; break;
		case $class_elf_3:	$gioitinhtruoc = "Hight Elf"; break;
		
		case $class_mg_1:	$gioitinhtruoc = "Magic Gladiator"; break;
		case $class_mg_2:	$gioitinhtruoc = "Duel Master"; break;
		
		case $class_dl_1:	$gioitinhtruoc = "Dark Lord"; break;
		case $class_dl_2:	$gioitinhtruoc = "Lord Emperor"; break;
		
		case $class_sum_1:	$gioitinhtruoc = "Summoner"; break;
		case $class_sum_2:	$gioitinhtruoc = "Blood Summoner"; break;
		case $class_sum_3:	$gioitinhtruoc = "Dimension Master"; break;
        
        case $class_rf_1:	$gioitinhtruoc = "Rage Fighter"; break;
		case $class_rf_2:	$gioitinhtruoc = "First Master"; break;
	};
    
$gcoinnew = $gcoin[0];
$gcoin_km = $gcoin[1];
$gcoin_total = $gcoinnew + $gcoin_km;

if ($gcoin_total < $doigt_gcoin){ 
 echo "Bạn có $gcoin_total Gcoin. Bạn cần $doigt_gcoin Gcoin để đổi giới tính."; exit();
} else {
    if($gcoin_km >= $doigt_gcoin) $gcoin_km = $gcoin_km - $doigt_gcoin;
   else {
        $gcoinnew = $gcoinnew - ($doigt_gcoin - $gcoin_km);
        $gcoin_km = 0;
   }
}

$inventory_result_sql = $db->Execute("SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'");
$inventory_result = $inventory_result_sql->fetchrow();
$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
$inventory1 = substr($inventory,0,12*32);

$inventory1_fresh = "";
for($i=0; $i<strlen($inventory1); $i++) {
    $inventory1_fresh .= "F";
}

if($inventory1 != $inventory1_fresh) {
    echo "Chưa tháo hết đồ trên người, vui lòng tháo hết đồ trên người trước khi Đổi Giới Tính."; exit();
}

kiemtra_doinv($login,$name);

$questnothing = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";

$msquery = "UPDATE Character SET Class='$gioitinh', Resets='$reset_after', ResetNBB='$reset_after', [MagicList]= CONVERT(varbinary(180), null), NoResetInDay='$rs_day_after',[Quest]=0x$questnothing, DGT_Time='$timestamp' WHERE Name = '$name'";
$msresults= $db->Execute($msquery) or die("Lỗi Query: $msquery");

$msquery1 = "UPDATE MEMB_INFO SET [gcoin] = '$gcoinnew',gcoin_km=$gcoin_km WHERE memb___id = '$login'";
$msresults1= $db->Execute($msquery1) or die("Lỗi Query: $msquery1");

//Reset Master Level
include_once('MasterLV.php');

_use_money($login, $gcoin_before-$gcoinnew, $gcoin_km_before - $gcoin_km, 0);

if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    if($Use_SendMess_DGT == 1) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. ']Chúc mừng '. $name .' Đổi Giới Tính từ '. $gioitinhtruoc .' sang '. $gioitinhsau;
        
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_sendmess.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'mess_send'    =>  $mess_send
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
        $info = read_TagName($reponse, 'info');
        if ($info == "OK") {
            $mess_receive = read_TagName($reponse, 'mess_receive', 0);
            $mess_total = $mess_receive[0];
            
            for($i=1; $i<=$mess_total; $i++) {
                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                if ($x = socket_connect($socket, '127.0.0.1', $joinserver_port))
                {
                    socket_write($socket, $mess_receive[$i]);
                } else {
                    socket_close($socket);
                    break;
                }
                socket_close($socket);
            }
        }
    }
}

if($keep_bxh != 1) {
    if( ($event_toprs_on == 1) && (strtotime($event_toprs_begin) < $timestamp) && (strtotime($event_toprs_end) > $timestamp) )
    {
    	$selectrs_eventtop_query = "SELECT * FROM Event_TOP_RS WHERE name='$name'";
    	$selectrs_eventtop_result = $db->Execute($selectrs_eventtop_query) OR DIE("Lỗi Query: $selectrs_eventtop_query");
    	$selectrs_eventtop_check = $selectrs_eventtop_result->NumRows();
    	
    	if($selectrs_eventtop_check > 0)
    	{
    		$delete_data_query = "DELETE Event_TOP_RS WHERE name='$name'";
    		$delete_data_result = $db->Execute($delete_data_query) OR DIE("Lỗi Query: $delete_data_query");
    	}
    }
    
    _topreset_erase_month($name, $month, 1);
}
    

//Ghi vào Log nhung nhan vat doi gioi tinh
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $doigt_gcoin Gcoin";
        $log_Des = "$name Đổi Giới tính từ $gioitinhtruoc sang $gioitinhsau";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat doi gioi tinh


    
	echo "OK<nbb>$gcoinnew<nbb>$gcoin_km<nbb>$reset_after<netbanbe>$name đã đổi giới tính từ $gioitinhtruoc thành $gioitinhsau.";
}

?>