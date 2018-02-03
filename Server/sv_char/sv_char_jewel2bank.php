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

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";

kiemtra_doinv($login,$name);
kiemtra_online($login);

$inventory_result_sql = $db->Execute($inventory_query);
$inventory_result = $inventory_result_sql->fetchrow();

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory = strtoupper($inventory);
$inventory1 = substr($inventory,0,12*32);
$inventory2 = substr($inventory,12*32,64*32);
$inventory3 = substr($inventory,76*32);

	$chaos = 0;
	$joc = 0;
	$blue = 0;
    $heart = 0;
    $inventory2_after = "";
	for($x=0; $x<64; ++$x)
	{
        $item_check = false;
		$item = substr($inventory2,$x*32,32);
		$code = substr($item, 0, 4);
		$code2 = substr($item, 18, 1);
		if($code === "0F00" AND $code2 ==="C") {
            ++$chaos;
            $item_check = true;
		} else if($code === "1600" AND $code2 ==="E") {
            ++$joc;
            $item_check = true;
		} else if($code === "0E00" AND $code2 === "D") {
            ++$blue;
            $item_check = true;
		} else if($code === "0C08" AND $code2 === "E") {
            ++$heart;
            $item_check = true;
		}
        if($item_check === true) {
            $item = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
        }
		
        $inventory2_after .= $item;
 	}
if ( ($chaos < 1) AND ($joc < 1) AND ($blue < 1) AND ($heart < 1) )
{ echo "Nhân vật không có Item gửi ngân hàng."; }
else {
	
	$inventory_after = $inventory1.$inventory2_after.$inventory3;

kiemtra_online($login);

$jewel_query = "SELECT jewel_chao, jewel_cre, jewel_blue, jewel_heart FROM MEMB_INFO WHERE memb___id='$login'";
$jewel_result = $db->Execute($jewel_query);
$jewel_fetch = $jewel_result->FetchRow();

$jewel_chao_before = $jewel_fetch[0];
$jewel_cre_before = $jewel_fetch[1];
$jewel_blue_before = $jewel_fetch[2];
$jewel_heart_before = $jewel_fetch[3];

$jewel_chao_after = $jewel_chao_before + $chaos;
$jewel_cre_after = $jewel_cre_before + $joc;
$jewel_blue_after = $jewel_blue_before + $blue;
$jewel_heart_after = $jewel_heart_before + $heart;

		$sql_inventory = "Update dbo.character set [inventory]=0x$inventory_after where name='$name'";
		$sql_jewel2bank="Update dbo.memb_info set [jewel_chao]=$jewel_chao_after,[jewel_cre]=$jewel_cre_after,[jewel_blue]=$jewel_blue_after,[jewel_heart]=$jewel_heart_after where memb___id='$login'";

$rs_inventory = $db->Execute($sql_inventory) or die("Lỗi Query: $sql_inventory");
$rs_jewel2bank = $db->Execute($sql_jewel2bank) or die("Lỗi Query: $sql_jewel2bank");

	
	//Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
	$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "";
        
        $log_Des = "Nhân vật $name đã gửi $chaos Chao , $joc Create , $blue Blue Feather , $heart Heart vào ngân hàng. Trước : <strong>$jewel_chao_before</strong> Chao, <strong>$jewel_cre_before</strong> Cre, <strong>$jewel_blue_before</strong> Blue, <strong>$jewel_heart_before</strong> Heart. Sau : <strong>$jewel_chao_after</strong> Chao, <strong>$jewel_cre_after</strong> Cre, <strong>$jewel_blue_after</strong> Blue, <strong>$jewel_heart_after</strong> Heart.";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
	//End Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
	
	echo "OK<nbb>$chaos<nbb>$joc<nbb>$blue<nbb>$heart<netbanbe>Nhân vật $name đã gửi $chaos Ngọc Hỗn Nguyên , $joc Ngọc Sáng Tạo , $blue Lông Chim , $heart Trái Tim vào ngân hàng thành công!";
  }
}

?>