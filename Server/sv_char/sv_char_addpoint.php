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
 

$login =  $_POST['login'];
$name =  $_POST['name'];
$strength =  $_POST['str'];     $strength = abs(intval($strength));
$dexterity =  $_POST['dex'];    $dexterity = abs(intval($dexterity));
$vitality =  $_POST['vit'];     $vitality = abs(intval($vitality));
$energy =  $_POST['ene'];       $energy = abs(intval($energy));
$menhlenh =  $_POST['ml'];      $menhlenh = abs(intval($menhlenh));

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$query = "SELECT Strength, Dexterity, Vitality, Energy, Leadership, LevelUpPoint, Class from Character WHERE Name='$name'";
$result = $db->Execute($query);
    check_queryerror($query, $result);
$row = $result->fetchrow();
    
    $strength_get = $row[0];
    $dexterity_get = $row[1];
    $vitality_get = $row[2];
    $energy_get = $row[3];
    $menhlenh_get = $row[4];
    $leveluppoint = $row[5];
    
	if ($strength_get < 0) {$strength_get = $strength_get+65536;}
	if ($dexterity_get < 0) {$dexterity_get = $dexterity_get+65536;}
	if ($vitality_get < 0) {$vitality_get = $vitality_get+65536;}
	if ($energy_get < 0) {$energy_get = $energy_get+65536;}
	if ($menhlenh_get < 0) {$menhlenh_get = $menhlenh_get+65536;}
	
$new_str = $strength_get + $strength;
$new_agi = $dexterity_get + $dexterity;
$new_vit = $vitality_get + $vitality;
$new_eng = $energy_get + $energy;
$new_menh = $menhlenh_get + $menhlenh;

$total_pointadd = $vitality + $strength + $energy + $dexterity + $menhlenh;
$thua = $leveluppoint - $total_pointadd;

 
if ($thua < 0){ 
        echo "Bạn chỉ có $leveluppoint điểm chưa cộng. Tổng điểm muốn cộng : $total_pointadd vượt quá số điểm chưa cộng $thua điểm."; exit();
 }

$msquery = "UPDATE dbo.Character SET [Strength]='$new_str',[Dexterity] = '$new_agi',[Vitality]='$new_vit',[Energy]='$new_eng',[Leadership]='$new_menh',[LevelUpPoint]='$thua' WHERE Name = '$name' AND AccountID = '$login'";
$msresults= $db->Execute($msquery);


echo "OK<nbb>$name đã cộng điểm thành công.<br>Sức mạnh: $new_str.<br>Nhanh nhẹn: $new_agi.<br>Sức khỏe: $new_vit.<br>Năng lượng: $new_eng.<br>Mệnh lệnh: $new_menh.<br>Bạn còn thừa $thua điểm.";
}

?>