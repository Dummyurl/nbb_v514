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
 

include_once('config/config_reset.php');
include_once('config/config_resetvip.php');
include_once('config/config_uythac_resetvip.php');
include_once('config/config_relife.php');
include_once('config/config_event.php');

$login = $_POST['login'];
$name = $_POST['name'];
$tiente = $_POST['tiente'];

$resetnow = $_POST['resetnow'];  $resetnow = abs(intval($resetnow));

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);
if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

fixrs($name);

kiemtra_doinv($login,$name);

$inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID = '$login' AND Name='$name'";

$inventory_result_sql = $db->Execute($inventory_query);
$inventory_result = $inventory_result_sql->fetchrow();

$sql_char_back_reged_check = $db->Execute("SELECT Name FROM Character_back WHERE Name='$name' and AccountID = '$login'"); 
$char_back_reged_check = $sql_char_back_reged_check->numrows();

$result = $db->Execute("Select Clevel,Resets,Money,LevelUpPoint,Class,Relifes,PointUyThac, PointUyThac_Event From Character where AccountID = '$login' AND Name='$name'");
$row = $result->fetchrow();
$clevel_before = $row[0];

if($resetnow >0 && abs(intval($row[1])) == 0) {
    echo "Hệ thống Reset bị gián đoạn. Vui lòng Reset lại";
    exit();
}

$gcoin_result = $db->Execute("Select gcoin, gcoin_km, vpoint From MEMB_INFO where memb___id='$login'");
$gcoin = $gcoin_result->fetchrow();

$thehe_result = $db->Execute("Select thehe From MEMB_INFO where memb___id='$login'");
$thehe = $thehe_result->fetchrow();

$inventory = $inventory_result[0];
$inventory = bin2hex($inventory);
$inventory3 = substr($inventory,76*32,32*32);
$inventory3 = strtoupper($inventory3);

$no_item = 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF';
for ($i=0;$i<32;$i++) $shop_empty .= $no_item;

if ($inventory3 != $shop_empty) { echo "Cửa hàng cá nhân có vật phẩm. Vui lòng bỏ ra khỏi cửa hàng cá nhân để tránh bị mất đồ."; exit(); }

if ( ($row[1] >= $reset_cap_0) AND ($row[1] < $reset_cap_1) )
{
	$point_uythac = $point_uythac_rsvip_cap_1;
	$gcoin_reset_vip = $gcoin_cap_1_vip;
	$time_reset_next = $time_reset_next_1;
}
elseif ( ($row[1] >= $reset_cap_1) AND ($row[1] < $reset_cap_2) )
{
	$point_uythac = $point_uythac_rsvip_cap_2;
	$gcoin_reset_vip = $gcoin_cap_2_vip;
	$time_reset_next = $time_reset_next_2;
}
elseif ( ($row[1] >= $reset_cap_2) AND ($row[1] < $reset_cap_3) )
{
	$point_uythac = $point_uythac_rsvip_cap_3;
	$gcoin_reset_vip = $gcoin_cap_3_vip;
	$time_reset_next = $time_reset_next_3;
}
elseif ( ($row[1] >= $reset_cap_3) AND ($row[1] < $reset_cap_4) )
{
	$point_uythac = $point_uythac_rsvip_cap_4;
	$gcoin_reset_vip = $gcoin_cap_4_vip;
	$time_reset_next = $time_reset_next_4;
}
elseif ( ($row[1] >= $reset_cap_4) AND ($row[1] < $reset_cap_5) )
{
	$point_uythac = $point_uythac_rsvip_cap_5;
	$gcoin_reset_vip = $gcoin_cap_5_vip;
	$time_reset_next = $time_reset_next_5;
}
elseif ( ($row[1] >= $reset_cap_5) AND ($row[1] < $reset_cap_6) )
{
	$point_uythac = $point_uythac_rsvip_cap_6;
	$gcoin_reset_vip = $gcoin_cap_6_vip;
	$time_reset_next = $time_reset_next_6;
}
elseif ( ($row[1] >= $reset_cap_6) AND ($row[1] < $reset_cap_7) )
{
	$point_uythac = $point_uythac_rsvip_cap_7;
	$gcoin_reset_vip = $gcoin_cap_7_vip;
	$time_reset_next = $time_reset_next_7;
}
elseif ( ($row[1] >= $reset_cap_7) AND ($row[1] < $reset_cap_8) )
{
	$point_uythac = $point_uythac_rsvip_cap_8;
	$gcoin_reset_vip = $gcoin_cap_8_vip;
	$time_reset_next = $time_reset_next_8;
}
elseif ( ($row[1] >= $reset_cap_8) AND ($row[1] < $reset_cap_9) )
{
	$point_uythac = $point_uythac_rsvip_cap_9;
	$gcoin_reset_vip = $gcoin_cap_9_vip;
	$time_reset_next = $time_reset_next_9;
}
elseif ( ($row[1] >= $reset_cap_9) AND ($row[1] < $reset_cap_10) )
{
	$point_uythac = $point_uythac_rsvip_cap_10;
	$gcoin_reset_vip = $gcoin_cap_10_vip;
	$time_reset_next = $time_reset_next_10;
}
elseif ( ($row[1] >= $reset_cap_10) AND ($row[1] < $reset_cap_11) )
{
	$point_uythac = $point_uythac_rsvip_cap_11;
	$gcoin_reset_vip = $gcoin_cap_11_vip;
	$time_reset_next = $time_reset_next_11;
}
elseif ( ($row[1] >= $reset_cap_11) AND ($row[1] < $reset_cap_12) )
{
	$point_uythac = $point_uythac_rsvip_cap_12;
	$gcoin_reset_vip = $gcoin_cap_12_vip;
	$time_reset_next = $time_reset_next_12;
}
elseif ( ($row[1] >= $reset_cap_12) AND ($row[1] < $reset_cap_13) )
{
	$point_uythac = $point_uythac_rsvip_cap_13;
	$gcoin_reset_vip = $gcoin_cap_13_vip;
	$time_reset_next = $time_reset_next_13;
}
elseif ( ($row[1] >= $reset_cap_13) AND ($row[1] < $reset_cap_14) )
{
	$point_uythac = $point_uythac_rsvip_cap_14;
	$gcoin_reset_vip = $gcoin_cap_14_vip;
	$time_reset_next = $time_reset_next_14;
}
elseif ( ($row[1] >= $reset_cap_14) AND ($row[1] < $reset_cap_15) )
{
	$point_uythac = $point_uythac_rsvip_cap_15;
	$gcoin_reset_vip = $gcoin_cap_15_vip;
	$time_reset_next = $time_reset_next_15;
}
elseif ( ($row[1] >= $reset_cap_15) AND ($row[1] < $reset_cap_16) )
{
	$point_uythac = $point_uythac_rsvip_cap_16;
	$gcoin_reset_vip = $gcoin_cap_16_vip;
	$time_reset_next = $time_reset_next_16;
}
elseif ( ($row[1] >= $reset_cap_16) AND ($row[1] < $reset_cap_17) )
{
	$point_uythac = $point_uythac_rsvip_cap_17;
	$gcoin_reset_vip = $gcoin_cap_17_vip;
	$time_reset_next = $time_reset_next_17;
}
elseif ( ($row[1] >= $reset_cap_17) AND ($row[1] < $reset_cap_18) )
{
	$point_uythac = $point_uythac_rsvip_cap_18;
	$gcoin_reset_vip = $gcoin_cap_18_vip;
	$time_reset_next = $time_reset_next_18;
}
elseif ( ($row[1] >= $reset_cap_18) AND ($row[1] < $reset_cap_19) )
{
	$point_uythac = $point_uythac_rsvip_cap_19;
	$gcoin_reset_vip = $gcoin_cap_19_vip;
	$time_reset_next = $time_reset_next_19;
}
elseif ( ($row[1] >= $reset_cap_19) AND ($row[1] < $reset_cap_20) )
{
	$point_uythac = $point_uythac_rsvip_cap_20;
	$gcoin_reset_vip = $gcoin_cap_20_vip;
	$time_reset_next = $time_reset_next_20;
}

$point_uythac_before = $row[6];
$point_uythac_event_before = $row[7];
$point_uythac_total = $point_uythac_before + $point_uythac_event_before;

if ($point_uythac_total < $point_uythac) {
	echo "Thiếu Điểm Ủy Thác<br>$name đang có: $point_uythac_total điểm Ủy Thác. Để Reset tiếp bạn cần $point_uythac Điểm Ủy Thác."; exit();
}

if($point_uythac_before >= $point_uythac) {
    $point_uythac_after = $point_uythac_before - $point_uythac;
    $point_uythac_event_after = $point_uythac_event_before;
} else {
    $point_uythac_after = 0;
    $point_uythac_event_after = $point_uythac_event_before - ($point_uythac - $point_uythac_before);
}
$gcoin_before = $gcoin[0];
$gcoin_km_before = $gcoin[1];
$vpoint_before = $gcoin[2];

$gcoinnew = $gcoin[0];
$gcoin_km = $gcoin[1];
$vpointnew = $gcoin[2];
$gcoin_total = $gcoinnew + $gcoin_km;
if ($tiente == 'gcoin') {
	
    // Reduce Gcoin For Union Castle Begin
    include('config/config_castleown_gcoin_reduce.php');
    if($castleown_gcoin_reduce_enable == 1) {
         $castle_onwer = _castleown($name, $castleown_gcoin_reduce_day);
        if($castle_onwer == 1) {
            $gcoin_rs_castle_owner_before = $gcoin_reset_vip;
            $gcoin_reset_vip = floor($gcoin_reset_vip*(100-$castleown_gcoin_reduce_percent)/100);
            $gcoin_rs_notice = $gcoin_rs_castle_owner_before - $gcoin_reset_vip;
            $castle_onwer_notice = "Chi phí : $gcoin_rs_castle_owner_before Gcoin.<br /> Bạn thuộc Liên Minh giữ thành. Được giảm <strong>". $castleown_gcoin_reduce_percent ."%</strong> chi phí. Chỉ mất : $gcoin_reset_vip Gcoin.<br />Tiết kiệm :<strong> $castle_onwer_notice Gcoin</strong>";
        } else if($castle_onwer == 2) {
            $castle_onwer_notice = "Bạn thuộc Liên Minh giữ thành nhưng cách trận CTC trước quá 7 ngày. Vì vậy không được giảm Gcoin.";
        } else if($castle_onwer == 4) {
            $castle_onwer_notice = "Bang hội của bạn giữ thành nhưng không có Liên Minh. Vì vậy không được giảm Gcoin.";
        }
    }
    // Reduce Gcoin For Union Castle End
    
    if ( $gcoin_total < $gcoin_reset_vip ) 
	{
		echo "Không có đủ gcoin yêu cầu Reset. Bạn đang Reset $row[1] lần. Bạn cần có $gcoin_reset_vip gcoin chi phí Reset VIP"; exit();
	}
	else {
	   if($gcoin_km >= $gcoin_reset_vip) $gcoin_km = $gcoin_km - $gcoin_reset_vip;
       else {
            $gcoinnew = $gcoinnew - ($gcoin_reset_vip - $gcoin_km);
            $gcoin_km = 0;
       }
	   
	}
} elseif ($tiente == 'vpoint') {
	$vpoint_reset_vip = $gcoin_reset_vip*(1+($vpoint_extra/100));
	if ( $vpointnew < ($vpoint_reset_vip) ) 
	{
		echo "Không có đủ Vpoint yêu cầu Reset. Bạn đang Reset $row[1] lần. Bạn cần có $vpoint_reset_vip Vpoint chi phí Reset VIP"; exit();
	}
	else $vpointnew = $vpointnew - $vpoint_reset_vip;
} else { echo "Sai loại tiền tệ"; exit(); }

$relife = $row[5];
$resetold = $row[1];        $resetold = abs(intval($resetold));
$resetup = $resetold + 1;

switch ($row[5]) {
	case 0:
		$reset_relifes = $rl_reset_relife1;
		break;
	case 1:
		$reset_relifes = $rl_reset_relife2;
		break;
	case 2:
		$reset_relifes = $rl_reset_relife3;
		break;
	case 3:
		$reset_relifes = $rl_reset_relife4;
		break;
	case 4:
		$reset_relifes = $rl_reset_relife5;
		break;
	case 5:
		$reset_relifes = $rl_reset_relife6;
		break;
	case 6:
		$reset_relifes = $rl_reset_relife7;
		break;
	case 7;
		$reset_relifes = $rl_reset_relife8;
		break;
	case 8:
		$reset_relifes = $rl_reset_relife9;
		break;
	case 9:
		$reset_relifes = $rl_reset_relife10;
		break;
	case 10:
		$reset_relifes = $rl_reset_relife11;
		break;
}

if ( $row[1] >= $reset_relifes ) { 
	 echo "$name đang ReLife: $row[5] - Reset: $row[1]. Để Reset tiếp bạn cần phải ReLife."; exit();
}

kiemtra_doinv($login,$name);

// Reset Total
$reset_total = 0;
if($char_relfe >= 1) $reset_total += $rl_reset_relife1;
if($char_relfe >= 2) $reset_total += $rl_reset_relife2;
if($char_relfe >= 3) $reset_total += $rl_reset_relife3;
if($char_relfe >= 4) $reset_total += $rl_reset_relife4;
if($char_relfe >= 5) $reset_total += $rl_reset_relife5;
if($char_relfe >= 6) $reset_total += $rl_reset_relife6;
if($char_relfe >= 7) $reset_total += $rl_reset_relife7;
if($char_relfe >= 8) $reset_total += $rl_reset_relife8;
if($char_relfe >= 9) $reset_total += $rl_reset_relife9;
if($char_relfe >= 10) $reset_total += $rl_reset_relife10;
$reset_total += $resetup;
// Reset Total End

_top50();

$sql_reset_script="Update dbo.character set [resets]=$resetup, ResetNBB=$resetup,[PointUyThac]='$point_uythac_after', PointUyThac_Event='$point_uythac_event_after', [reset_total]=$reset_total where AccountID = '$login' AND name='$name'";
	$sql_reset_exec = $db->Execute($sql_reset_script) or die("Lỗi Query: $sql_reset_script");

// Reset nhan vat la Darklord
if ($row[4] == 64 OR $row[4] == 65 OR $row[4] == 66)
  {
//Nhan vat dang ki tai sinh
	if ($char_back_reged_check > 0) {
	$msquery = "Update Character_back set [Resets]=$resetup,[LevelUpPoint]='$resetpoint',[Class]='$row[4]',[Leadership]='$leadership',[Relifes]='$row[5]' where AccountID = '$login' AND name='$name'";
	$msresults= $db->Execute($msquery);
	}
}

//Reset nhan vat khong phai la DarkLord
else
 {
	if ($char_back_reged_check > 0) {
		$msquery = "Update Character_back set [Resets]=$resetup,[LevelUpPoint]='$resetpoint',[Class]='$row[4]',[Relifes]='$row[5]' where AccountID = '$login' AND name='$name'";
		$msresults= $db->Execute($msquery);
	}
}

    $gcoin_update_query = "UPDATE MEMB_INFO SET [gcoin]=$gcoinnew,gcoin_km=$gcoin_km, [vpoint]=$vpointnew WHERE memb___id='$login'";
    $gcoin_update_result = $db->Execute($gcoin_update_query);
    
    _use_money($login, $gcoin_before - $gcoinnew, $gcoin_km_before - $gcoin_km, $vpoint_before - $vpointnew);
    
//Event GiftCode Reset
include_once('sv_giftcode_rs.php');

if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    if($Use_SendMess_UyThacRSVIP == 1) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. '] '. $name .' RS Ủy Thác VIP lần '. $resetup;
        
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

_topreset($login, $name, 1, 0, 1);

//Ghi vào Log nhung nhan vàt Reset
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        if ($tiente == 'vpoint') 
        {
            $log_price = "- $vpoint_reset_vip Vpoint";
        } else 
        {
            $log_price = " - $gcoin_reset_vip Gcoin";
        }
        $log_Des = "$name Reset Ủy Thác VIP lần thứ $resetup, Relife $relife. Sử dụng <strong>$point_uythac</strong> điểm Ủy Thác. Trước Reset <strong>$point_uythac_before</strong> điểm Ủy Thác, <strong>$point_uythac_event_before</strong> điểm Ủy Thác Event. Sau Reset <strong>$point_uythac_after</strong> điểm Ủy Thác, <strong>$point_uythac_event_after</strong> điểm Ủy Thác Event.";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vàt Reset

echo "OK<nbb>$gcoinnew<nbb>$gcoin_km<nbb>$vpointnew<nbb>$point_uythac_after<nbb>$point_uythac_event_after<netbanbe>$name Reset lần thứ $resetup thành công!<br />$messenge_giftcode";
}

?>