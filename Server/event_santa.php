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
include_once("config.php");
include_once("function.php");

$block_dupe = true;
$allow_itemnoseri = false;

	include_once("config/config_event_santa_ticket.php");
	
$login=$_POST["login"];
$name=$_POST["name"];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_doinv($login,$name);
kiemtra_online($login);

$query = "select vpoint from MEMB_INFO WHERE memb___id='$login'";
$result = $db->Execute( $query );
$row = $result->fetchrow();

$inventory_result_sql = $db->Execute("SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'");
$inventory_result = $inventory_result_sql->fetchrow();

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);

$inventory1 = substr($inventory,0,12*32);
$inventory2 = substr($inventory,12*32,64*32);
$inventory3 = substr($inventory,76*32);

    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_eventsanta.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'inventory2'    =>  $inventory2,
        'event_item_code'    =>  $event_item_code
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
            $santa_ticket = read_TagName($reponse, 'santa_ticket');
            if(strlen($santa_ticket) == 0) {
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


if ( $santa_ticket <= 0 )
{
	echo "Không có vé làng Santa để đổi ra V.Point";
    exit();
}
else {
    
    $item_code1 = strtoupper(substr($event_item_code,0,4));
	$item_code2 = strtoupper(substr($event_item_code,18,1));
    $inventory2_after = "";
    
    $seri_arr = array();
    $seridupe = "";
    $dupe = false;
    $item_notallow = 0;
    
	for($x=0; $x<64; ++$x)
	{
		$item = substr($inventory2,$x*32,32);
		$code = substr($item, 0, 4);
		$code2 = substr($item, 18, 1);
        $seri = substr($item, 6, 8);
		if($code === $item_code1 AND $code2 === $item_code2) {
            $item = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
            if($allow_itemnoseri === false && ($seri == "00000000" || $seri == "FFFFFFFF")) {
                $item_notallow++;
            }
            else if(!in_array($seri, $seri_arr)) {
                $seri_arr[] = $seri;
            } else {
                if($seri != "00000000") {
                    $dupe = true;
                    if(strlen($seridupe) > 0) $seridupe .= ", ";
                    $seridupe .= "$seri";
                }
            }
		}
		$inventory2_after .= $item;
 	}
        
    $inventory_after = $inventory1.$inventory2_after.$inventory3;
    
    $vpoint_add = ($santa_ticket - $item_notallow)*$event_vpoint;
    $vpoint_after = $row[0] + $vpoint_add;
    
if($dupe == true && $block_dupe == true) {
    $char_block_query = "UPDATE Character SET ctlcode='99', ErrorSubBlock=99 WHERE name='$name'";
    $char_block_result = $db->Execute($char_block_query);
    
    $acc_block_query = "Update MEMB_INFO SET [bloc_code]='1',admin_block='1' WHERE memb___id='$login'";
    $acc_block_result = $db->Execute($acc_block_query);
    // Ghi vào Log nhung nhan vàt Block do Dupe
    $log_acc = "$name";
    $log_gcoin = 0;
    $log_gcoin_km = 0;
    $log_vpoint = 0;
    $log_price = "-";
    
    $log_Des = "Tài khoản <b>$login</b> - Nhân vật <strong>$name</strong> chứa Vé làng Santa Dupe Seri : <strong>$seridupe</strong>. Khóa tài khoản, nhân vật.";
    $log_time = $timestamp;
    
    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    $insert_log_result = $db->execute($insert_log_query);
    // End Ghi vào Log nhung nhan vàt Block do Dupe
    
    echo "Nhân vật $name chứa Vé làng Santa Dupe. Khóa tài khoản, nhân vật."; exit();
}

kiemtra_doinv($login,$name);
kiemtra_online($login);

$general = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
$msgeneral = $db->Execute($general) or die("Loi query: $general");

$general1 = "UPDATE MEMB_INFO SET vpoint = $vpoint_after WHERE memb___id='$login'";
$msgeneral1 = $db->Execute($general1);

// Begin Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "+ $vpoint_add VPoint";
        $log_Des = "Đổi $santa_ticket vé làng Santa";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
// End Log
echo "OK<nbb>$vpoint_after<nbb>Bạn đã đổi thành công $santa_ticket vé làng Santa ra $vpoint_add V.Point.";
}
}
$db->Close();
?>