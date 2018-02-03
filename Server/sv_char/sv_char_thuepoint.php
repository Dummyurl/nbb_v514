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
$point = $_POST['point'];
$tiente = $_POST['tiente'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {
switch($point) {
	case $thuepoint_point1: $gia = $thuepoint_gcoin1; $relife_yc=$thuepoint_relife1; break;
	case $thuepoint_point2: $gia = $thuepoint_gcoin2; $relife_yc=$thuepoint_relife2; break;
	case $thuepoint_point3: $gia = $thuepoint_gcoin3; $relife_yc=$thuepoint_relife3; break;
	case $thuepoint_point4: $gia = $thuepoint_gcoin4; $relife_yc=$thuepoint_relife4; break;
	case $thuepoint_point5: $gia = $thuepoint_gcoin5; $relife_yc=$thuepoint_relife5; break;
	case $thuepoint_point6: $gia = $thuepoint_gcoin6; $relife_yc=$thuepoint_relife6; break;
	case $thuepoint_point7: $gia = $thuepoint_gcoin7; $relife_yc=$thuepoint_relife7; break;
	case $thuepoint_point8: $gia = $thuepoint_gcoin8; $relife_yc=$thuepoint_relife8; break;
	case $thuepoint_point9: $gia = $thuepoint_gcoin9; $relife_yc=$thuepoint_relife9; break;
	case $thuepoint_point10: $gia = $thuepoint_gcoin10; $relife_yc=$thuepoint_relife19; break;
	
	case $thuepoint_point11: $gia = $thuepoint_gcoin11; $relife_yc=$thuepoint_relife11; break;
	case $thuepoint_point12: $gia = $thuepoint_gcoin12; $relife_yc=$thuepoint_relife12; break;
	case $thuepoint_point13: $gia = $thuepoint_gcoin13; $relife_yc=$thuepoint_relife13; break;
	case $thuepoint_point14: $gia = $thuepoint_gcoin14; $relife_yc=$thuepoint_relife14; break;
	case $thuepoint_point15: $gia = $thuepoint_gcoin15; $relife_yc=$thuepoint_relife15; break;
	case $thuepoint_point16: $gia = $thuepoint_gcoin16; $relife_yc=$thuepoint_relife16; break;
	case $thuepoint_point17: $gia = $thuepoint_gcoin17; $relife_yc=$thuepoint_relife17; break;
	case $thuepoint_point18: $gia = $thuepoint_gcoin18; $relife_yc=$thuepoint_relife18; break;
	case $thuepoint_point19: $gia = $thuepoint_gcoin19; $relife_yc=$thuepoint_relife19; break;
	case $thuepoint_point20: $gia = $thuepoint_gcoin20; $relife_yc=$thuepoint_relife20;  break;
	
	case $thuepoint_point21: $gia = $thuepoint_gcoin21; $relife_yc=$thuepoint_relife21; break;
	case $thuepoint_point22: $gia = $thuepoint_gcoin22; $relife_yc=$thuepoint_relife22; break;
	case $thuepoint_point23: $gia = $thuepoint_gcoin23; $relife_yc=$thuepoint_relife23; break;
	case $thuepoint_point24: $gia = $thuepoint_gcoin24; $relife_yc=$thuepoint_relife24; break;
	case $thuepoint_point25: $gia = $thuepoint_gcoin25; $relife_yc=$thuepoint_relife25; break;
	case $thuepoint_point26: $gia = $thuepoint_gcoin26; $relife_yc=$thuepoint_relife26; break;
	case $thuepoint_point27: $gia = $thuepoint_gcoin27; $relife_yc=$thuepoint_relife27; break;
	case $thuepoint_point28: $gia = $thuepoint_gcoin28; $relife_yc=$thuepoint_relife28; break;
	case $thuepoint_point29: $gia = $thuepoint_gcoin29; $relife_yc=$thuepoint_relife29; break;
	case $thuepoint_point30: $gia = $thuepoint_gcoin30; $relife_yc=$thuepoint_relife30;  break;
	
	case $thuepoint_point31: $gia = $thuepoint_gcoin31; $relife_yc=$thuepoint_relife31; break;
	case $thuepoint_point32: $gia = $thuepoint_gcoin32; $relife_yc=$thuepoint_relife32; break;
	case $thuepoint_point33: $gia = $thuepoint_gcoin33; $relife_yc=$thuepoint_relife33; break;
	case $thuepoint_point34: $gia = $thuepoint_gcoin34; $relife_yc=$thuepoint_relife34; break;
	case $thuepoint_point35: $gia = $thuepoint_gcoin35; $relife_yc=$thuepoint_relife35; break;
	case $thuepoint_point36: $gia = $thuepoint_gcoin36; $relife_yc=$thuepoint_relife36; break;
	case $thuepoint_point37: $gia = $thuepoint_gcoin37; $relife_yc=$thuepoint_relife37; break;
	case $thuepoint_point38: $gia = $thuepoint_gcoin38; $relife_yc=$thuepoint_relife38; break;
	case $thuepoint_point39: $gia = $thuepoint_gcoin39; $relife_yc=$thuepoint_relife39; break;
	case $thuepoint_point40: $gia = $thuepoint_gcoin40; $relife_yc=$thuepoint_relife40;  break;
	
	case $thuepoint_point41: $gia = $thuepoint_gcoin41; $relife_yc=$thuepoint_relife41; break;
	case $thuepoint_point42: $gia = $thuepoint_gcoin42; $relife_yc=$thuepoint_relife42; break;
	case $thuepoint_point43: $gia = $thuepoint_gcoin43; $relife_yc=$thuepoint_relife43; break;
	case $thuepoint_point44: $gia = $thuepoint_gcoin44; $relife_yc=$thuepoint_relife44; break;
	case $thuepoint_point45: $gia = $thuepoint_gcoin45; $relife_yc=$thuepoint_relife45; break;
	case $thuepoint_point46: $gia = $thuepoint_gcoin46; $relife_yc=$thuepoint_relife46; break;
	case $thuepoint_point47: $gia = $thuepoint_gcoin47; $relife_yc=$thuepoint_relife47; break;
	case $thuepoint_point48: $gia = $thuepoint_gcoin48; $relife_yc=$thuepoint_relife48; break;
	case $thuepoint_point49: $gia = $thuepoint_gcoin49; $relife_yc=$thuepoint_relife49; break;
	case $thuepoint_point50: $gia = $thuepoint_gcoin50; $relife_yc=$thuepoint_relife50;  break;
	
	default: $gia = 999999; $relife_yc=999; break;
}



$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

//Kiểm tra những nhân vật đã thuê Point và xử lý khi hết thời gian
$query_check_thuepoint = "SELECT Name,TimeThuePoint,AccountID FROM Character Where IsThuePoint=1";
	$result_check_thuepoint = $db->Execute($query_check_thuepoint);

while($check_thuepoint = $result_check_thuepoint->fetchrow()) 	{
	if ( $check_thuepoint[1] < $timestamp )
	{
		//Check Online
		$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$check_thuepoint[2]' AND ConnectStat='1'");
		$online_check = $sql_online_check->numrows();
		if ($online_check > 0){ 
			//Check Doi NV
	   		$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$check_thuepoint[2]' AND GameIDC='$check_thuepoint[0]'");
			$doinv_check = $sql_doinv_check->numrows();
			if ($doinv_check < 1){ 
		   		$query_update = "Update Character SET [clevel]='400',[Resets]=Resets-1,[IsThuePoint]='2',[LevelUpPoint]='0',[pointdutru]='0',[strength]='26',[dexterity]='26',[vitality]='26',[energy]='26',[Life]='110',[MaxLife]='110',[Mana]='60',[MaxMana]='60',[Leadership]='0' Where Name='$check_thuepoint[0]'";
		   		$run_update = $db->Execute($query_update);
			}
		}
		else {
			$query_update = "Update Character SET [clevel]='400',[Resets]=Resets-1,[IsThuePoint]='2',[LevelUpPoint]='0',[pointdutru]='0',[strength]='26',[dexterity]='26',[vitality]='26',[energy]='26',[Life]='110',[MaxLife]='110',[Mana]='60',[MaxMana]='60',[Leadership]='0' Where Name='$check_thuepoint[0]'";
			$run_update = $db->Execute($query_update);
		}
	}
}

kiemtra_char($login,$name);

$sql_char_check = $db->Execute("SELECT Relifes,IsThuePoint FROM Character WHERE Name='$name' and AccountID = '$login'"); 
$char_check = $sql_char_check->fetchrow();

$vpoint_result = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
$vpoint = $vpoint_result->fetchrow();

$gcoin_check = $db->Execute("Select gcoin From MEMB_INFO where memb___id='$login'");
$gcoin = $gcoin_check->fetchrow();

if ( ($char_check[1] == 1) || ($char_check[1] == 2) ) {
	echo "Nhân vật $name đã thuê Point. Bạn phải Reset mới có thể thuê Point tiếp."; exit();
}

if ( $point_chenh > 5000 ) { echo "Đừng làm trò xấu tính thế chứ. Ăn đòn bây giờ."; exit(); }

if ( $char_check[0] < $relife_yc ) {
	echo "Nhân vật $name phải ReLife ít nhất $relife_yc lần mới có thể thuê $point Point."; exit();
}

	$gcoin_new = $gcoin[0] - $gia;
	$gia_vpoint = $gia*(1+($vpoint_extra/100));
	$vpoint_new = $vpoint[0] - $gia_vpoint;
	
if ($tiente == 'gcoin' && $gcoin_new < 0 ) {
	 	echo "Bạn có $gcoin[0] gcoin. Bạn cần $gia gcoin để thuê $point Point."; exit();
	}
elseif ( $tiente == 'vpoint' && $vpoint_new < 0 ) { 
		echo "Bạn có $vpoint[0] Vpoint. Bạn cần $gia_vpoint Vpoint để thuê $point Point."; exit();
	}
	
    $time = $timestamp+86400;

$pointdutru_after = $row[10] + $point;
$msquery = "UPDATE Character SET pointdutru=$pointdutru_after, IsThuePoint='1', TimeThuePoint='$time', PointThue='$point' WHERE Name = '$name'";
$msresults= $db->Execute($msquery) or die("Lỗi Query: $msquery");

if ($tiente == 'gcoin') {
	$msquery1 = "UPDATE MEMB_INFO SET [gcoin] = '$gcoin_new' WHERE memb___id = '$login'";
	$msresults1= $db->Execute($msquery1) or die("Lỗi Query: $msquery1");
} elseif ($tiente == 'vpoint') {
	$msquery1 = "UPDATE MEMB_INFO SET [vpoint] = '$vpoint_new' WHERE memb___id = '$login'";
	$msresults1= $db->Execute($msquery1) or die("Lỗi Query: $msquery1");
}

//Ghi vào Log nhung nhan vat thue point
		$Date = date("h:iA, d/m/Y");  
		$file = "log/modules/log_thuepoint.php";  
		$fp = fopen($file, "a+");  
if ($tiente == 'vpoint') {
		fputs ($fp, "<br>Lúc: $Date <br> 
		Nhân vật <b>$name</b> đã <font color=#FF0000>thuê</font> <b>$point Point</b> thành công. Trước Thuê Point: <b>$vpoint[0]</b> V.Point . Sau Thuê Point: <b>$vpoint_new</b> V.Point.
		<br>\n");  
} elseif ($tiente == 'gcoin') {
	fputs ($fp, "<br>Lúc: $Date <br> 
		Nhân vật <b>$name</b> đã <font color=#FF0000>thuê</font> <b>$point Point</b> thành công. Trước Thuê Point: <b>$gcoin[0]</b> Gcoin . Sau Thuê Point: <b>$gcoin_new</b> Gcoin.
		<br>\n");  
}
		fclose($fp);
//End Ghi vào Log nhung nhan vat doi gioi tinh


	echo "$name đã thuê $point Point thành công.";
}

?>