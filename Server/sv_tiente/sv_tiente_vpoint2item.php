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
 

include_once('config/config_itemvpoint.php');

$login=$_POST["login"];
$name=$_POST["name"];
$item=$_POST["item"];
$slg=$_POST["slg"];
$pass2 = $_POST['pass2'];

settype($slg, 'integer');

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
	
$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_block_acc($login);
kiemtra_block_char($login,$name);
kiemtra_doinv($login,$name);
kiemtra_online($login);
	
$query = "select vpoint from MEMB_INFO WHERE memb___id='$login'";
$result = $db->Execute( $query );
$row = $result->fetchrow();

$inventory_result_sql = $db->Execute("SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'");
$inventory_result = $inventory_result_sql->fetchrow();

switch ($item)
{
	case "gold":	$item_code="0C1000001234560000E0000000000000";	$item_name="Item Gold";	$gia=$item_low;	break;
	case "zen":		$item_code="0C0000001234560000E0000000000000";	$item_name="Item Zen";	$gia=$item_hight;	break;
    case "vpoint50k":		$item_code="0F0000001234560000E0000000000000";	$item_name="Item Zen 50k";	$gia=$item_50k;	break;
	
	//Mac dinh
	default:		$item_code="00000000000000000000000000000000";	$item_name="Giá trị sai";	$gia=999999999;	break;
}


$gias = $slg*$gia;
$check=$row[0]-$gias;

if( $check < 0 ){
echo "Bạn đang có $row[0] Vpoint. $slg đồ $item_name giá $gias Vpoint.<br>Bạn còn thiếu $check Vpoint"; exit(); }

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory1 = substr($inventory,0,12*32);
$inventory2 = substr($inventory,12*32,64*32);
$inventory3 = substr($inventory,76*32);

$item_codes = '';
$no_item = 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF';

//Kiem tra khoang trong trong tui do
$inventory_trong = '';
$otrong = 8;
for($i=0;$i<$otrong;$i++) $inventory_trong .= $no_item;
$inventory_trong = strtoupper($inventory_trong);

$inventory_kt = substr($inventory2,0,$otrong*32);
$inventory_kt = strtoupper($inventory_kt);

if($inventory_trong != $inventory_kt) { echo "Túi đồ chưa để trống $otrong ô đầu tiên. Vui lòng vào Game và để trống $otrong ô đầu tiên trong túi đồ"; exit(); }
//End Kiem tra khoang trong trong tui do

for($i=0;$i<$slg;++$i){
	$serial = _getSerial();
	$item_code = substr_replace($item_code, $serial, 6, 8);
	$item_codes .= $item_code;
	}

$inventory2_after = substr_replace($inventory2, $item_codes, 0, $slg*32);

$inventory_after = $inventory1.$inventory2_after.$inventory3;

kiemtra_doinv($login,$name);

$general = "UPDATE Character SET [inventory]=0x$inventory_after WHERE name='$name'";
$msgeneral = $db->Execute($general) or die("Loi query: $general");

$general1 = "UPDATE MEMB_INFO SET vpoint = $check WHERE memb___id='$login'";
$msgeneral1 = $db->Execute($general1);

//Ghi vào Log nhung nhan vat mua ve Jewel
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "- $gias Vpoint";
        $log_Des = "Mua $slg $item_name";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vat mua ve Jewel


echo "OK<nbb>Bạn đã mua thành công $slg Item $item_name. Bạn đã bị trừ $gias V.Point.<br>Nếu muốn mua tiếp đồ, bạn cần vào Game bỏ đồ vừa mua vào Rương trước khi mua tiếp.";
}

?>