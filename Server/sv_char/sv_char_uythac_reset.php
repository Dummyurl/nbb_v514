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
include_once('config/config_uythac_reset.php');
include_once('config/config_relife.php');
include_once('config/config_event.php');

$login = $_POST['login'];
$name = $_POST['name'];

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

$check_jewel = $db->Execute("SELECT jewel_chao,jewel_cre,jewel_blue FROM MEMB_INFO WHERE memb___id='$login'");
$jewel = $check_jewel->fetchrow();

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
	$point_uythac = $point_uythac_rs_cap_1;
	$zen = $zen_cap_1;
	$time_reset_next = $time_reset_next_1;
	$chao = $chao_cap_1;
	$cre = $cre_cap_1;
	$blue = $blue_cap_1;
}
elseif ( ($row[1] >= $reset_cap_1) AND ($row[1] < $reset_cap_2) )
{
	$point_uythac = $point_uythac_rs_cap_2;
	$zen = $zen_cap_2;
	$time_reset_next = $time_reset_next_2;
	$chao = $chao_cap_2;
	$cre = $cre_cap_2;
	$blue = $blue_cap_2;
}
elseif ( ($row[1] >= $reset_cap_2) AND ($row[1] < $reset_cap_3) )
{
	$point_uythac = $point_uythac_rs_cap_3;
	$zen = $zen_cap_3;
	$time_reset_next = $time_reset_next_3;
	$chao = $chao_cap_3;
	$cre = $cre_cap_3;
	$blue = $blue_cap_3;
}
elseif ( ($row[1] >= $reset_cap_3) AND ($row[1] < $reset_cap_4) )
{
	$point_uythac = $point_uythac_rs_cap_4;
	$zen = $zen_cap_4;
	$time_reset_next = $time_reset_next_4;
	$chao = $chao_cap_4;
	$cre = $cre_cap_4;
	$blue = $blue_cap_4;
}
elseif ( ($row[1] >= $reset_cap_4) AND ($row[1] < $reset_cap_5) )
{
	$point_uythac = $point_uythac_rs_cap_5;
	$zen = $zen_cap_5;
	$time_reset_next = $time_reset_next_5;
	$chao = $chao_cap_5;
	$cre = $cre_cap_5;
	$blue = $blue_cap_5;
}
elseif ( ($row[1] >= $reset_cap_5) AND ($row[1] < $reset_cap_6) )
{
	$point_uythac = $point_uythac_rs_cap_6;
	$zen = $zen_cap_6;
	$time_reset_next = $time_reset_next_6;
	$chao = $chao_cap_6;
	$cre = $cre_cap_6;
	$blue = $blue_cap_6;
}
elseif ( ($row[1] >= $reset_cap_6) AND ($row[1] < $reset_cap_7) )
{
	$point_uythac = $point_uythac_rs_cap_7;
	$zen = $zen_cap_7;
	$time_reset_next = $time_reset_next_7;
	$chao = $chao_cap_7;
	$cre = $cre_cap_7;
	$blue = $blue_cap_7;
}
elseif ( ($row[1] >= $reset_cap_7) AND ($row[1] < $reset_cap_8) )
{
	$point_uythac = $point_uythac_rs_cap_8;
	$zen = $zen_cap_8;
	$time_reset_next = $time_reset_next_8;
	$chao = $chao_cap_8;
	$cre = $cre_cap_8;
	$blue = $blue_cap_8;
}
elseif ( ($row[1] >= $reset_cap_8) AND ($row[1] < $reset_cap_9) )
{
	$point_uythac = $point_uythac_rs_cap_9;
	$zen = $zen_cap_9;
	$time_reset_next = $time_reset_next_9;
	$chao = $chao_cap_9;
	$cre = $cre_cap_9;
	$blue = $blue_cap_9;
}
elseif ( ($row[1] >= $reset_cap_9) AND ($row[1] < $reset_cap_10) )
{
	$point_uythac = $point_uythac_rs_cap_10;
	$zen = $zen_cap_10;
	$time_reset_next = $time_reset_next_10;
	$chao = $chao_cap_10;
	$cre = $cre_cap_10;
	$blue = $blue_cap_10;
}
elseif ( ($row[1] >= $reset_cap_10) AND ($row[1] < $reset_cap_11) )
{
	$point_uythac = $point_uythac_rs_cap_11;
	$zen = $zen_cap_11;
	$time_reset_next = $time_reset_next_11;
	$chao = $chao_cap_11;
	$cre = $cre_cap_11;
	$blue = $blue_cap_11;
}
elseif ( ($row[1] >= $reset_cap_11) AND ($row[1] < $reset_cap_12) )
{
	$point_uythac = $point_uythac_rs_cap_12;
	$zen = $zen_cap_12;
	$time_reset_next = $time_reset_next_12;
	$chao = $chao_cap_12;
	$cre = $cre_cap_12;
	$blue = $blue_cap_12;
}
elseif ( ($row[1] >= $reset_cap_12) AND ($row[1] < $reset_cap_13) )
{
	$point_uythac = $point_uythac_rs_cap_13;
	$zen = $zen_cap_13;
	$time_reset_next = $time_reset_next_13;
	$chao = $chao_cap_13;
	$cre = $cre_cap_13;
	$blue = $blue_cap_13;
}
elseif ( ($row[1] >= $reset_cap_13) AND ($row[1] < $reset_cap_14) )
{
	$point_uythac = $point_uythac_rs_cap_14;
	$zen = $zen_cap_14;
	$time_reset_next = $time_reset_next_14;
	$chao = $chao_cap_14;
	$cre = $cre_cap_14;
	$blue = $blue_cap_14;
}
elseif ( ($row[1] >= $reset_cap_14) AND ($row[1] < $reset_cap_15) )
{
	$point_uythac = $point_uythac_rs_cap_15;
	$zen = $zen_cap_15;
	$time_reset_next = $time_reset_next_15;
	$chao = $chao_cap_15;
	$cre = $cre_cap_15;
	$blue = $blue_cap_15;
}
elseif ( ($row[1] >= $reset_cap_15) AND ($row[1] < $reset_cap_16) )
{
	$point_uythac = $point_uythac_rs_cap_16;
	$zen = $zen_cap_16;
	$time_reset_next = $time_reset_next_16;
	$chao = $chao_cap_16;
	$cre = $cre_cap_16;
	$blue = $blue_cap_16;
}
elseif ( ($row[1] >= $reset_cap_16) AND ($row[1] < $reset_cap_17) )
{
	$point_uythac = $point_uythac_rs_cap_17;
	$zen = $zen_cap_17;
	$time_reset_next = $time_reset_next_17;
	$chao = $chao_cap_17;
	$cre = $cre_cap_17;
	$blue = $blue_cap_17;
}
elseif ( ($row[1] >= $reset_cap_17) AND ($row[1] < $reset_cap_18) )
{
	$point_uythac = $point_uythac_rs_cap_18;
	$zen = $zen_cap_18;
	$time_reset_next = $time_reset_next_18;
	$chao = $chao_cap_18;
	$cre = $cre_cap_18;
	$blue = $blue_cap_18;
}
elseif ( ($row[1] >= $reset_cap_18) AND ($row[1] < $reset_cap_19) )
{
	$point_uythac = $point_uythac_rs_cap_19;
	$zen = $zen_cap_19;
	$time_reset_next = $time_reset_next_19;
	$chao = $chao_cap_19;
	$cre = $cre_cap_19;
	$blue = $blue_cap_19;
}
elseif ( ($row[1] >= $reset_cap_19) AND ($row[1] < $reset_cap_20) )
{
	$point_uythac = $point_uythac_rs_cap_20;
	$zen = $zen_cap_20;
	$time_reset_next = $time_reset_next_20;
	$chao = $chao_cap_20;
	$cre = $cre_cap_20;
	$blue = $blue_cap_20;
}

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
    
$relife = $row[5];
$resetold = $row[1];        $resetold = abs(intval($resetold));
$resetup = $resetold + 1;


//Cong thuc Reset
if ( ($jewel[0] < $chao) OR ($jewel[1] < $cre) OR ($jewel[2] < $blue) )
{
	echo "Bạn không đủ Jewel trong ngân hàng.<br>Số lần Reset hiện tại của bạn là $row[1]. Bạn cần $chao Chao , $cre Creation , $blue Blue Feather."; exit();
}
if ($row[2] < $zen) {echo "$name cần $zen Zen để Reset lần $resetup."; exit();}

//Reset lần 1
if ($row[1] == $reset_cap_0)
	{
		$resetmoeny = $row[2] - $zen_cap_1;
	}
//Reset cấp 1
elseif ($row[1] < $reset_cap_1)
	{
		$resetmoeny = $row[2] - $zen_cap_1;
	}
//Reset cấp 1 -> 2
elseif ($row[1] >= $reset_cap_1 AND $row[1] < $reset_cap_2)
	{
		$resetmoeny = $row[2] - $zen_cap_2;
	}
//Reset cấp 2 -> 3
elseif ($row[1] >= $reset_cap_2 AND $row[1] < $reset_cap_3)
	{
		$resetmoeny = $row[2] - $zen_cap_3;
	}
//Reset cấp 3 -> 4
elseif ($row[1] >= $reset_cap_3 AND $row[1] < $reset_cap_4)
	{
		$resetmoeny = $row[2] - $zen_cap_4;
	}
//Reset cấp 4 -> 5
elseif ($row[1] >= $reset_cap_4 AND $row[1] < $reset_cap_5)
	{
		$resetmoeny = $row[2] - $zen_cap_5;
	}
//Reset cấp 5 -> 6
elseif ($row[1] >= $reset_cap_5 AND $row[1] < $reset_cap_6)
	{
		$resetmoeny = $row[2] - $zen_cap_6;
	}
//Reset cấp 6 -> 7
elseif ($row[1] >= $reset_cap_6 AND $row[1] < $reset_cap_7)
	{
		$resetmoeny = $row[2] - $zen_cap_7;
	}
//Reset cấp 7 -> 8
elseif ($row[1] >= $reset_cap_7 AND $row[1] < $reset_cap_8)
	{
		$resetmoeny = $row[2] - $zen_cap_8;
	}
//Reset cấp 8 -> 9
elseif ($row[1] >= $reset_cap_8 AND $row[1] < $reset_cap_9)
	 {
		$resetmoeny = $row[2] - $zen_cap_9;
	}
//Reset cấp 9 -> 10
elseif ($row[1] >= $reset_cap_9 AND $row[1] < $reset_cap_10)
	{
		$resetmoeny = $row[2] - $zen_cap_10;
	 }
//Reset cấp 10 -> 11
elseif ($row[1] >= $reset_cap_10 AND $row[1] < $reset_cap_11)
	{
		$resetmoeny = $row[2] - $zen_cap_11;
	}
//Reset cấp 11 -> 12
elseif ($row[1] >= $reset_cap_11 AND $row[1] < $reset_cap_12)
	{
		$resetmoeny = $row[2] - $zen_cap_12;
	 }
//Reset cấp 12 -> 13
elseif ($row[1] >= $reset_cap_12 AND $row[1] < $reset_cap_13)
	{
		$resetmoeny = $row[2] - $zen_cap_13;
	}
//Reset cấp 13 -> 14
elseif ($row[1] >= $reset_cap_13 AND $row[1] < $reset_cap_14)
	{
		$resetmoeny = $row[2] - $zen_cap_14;
	}
//Reset cấp 14 -> 15
elseif ($row[1] >= $reset_cap_14 AND $row[1] < $reset_cap_15)
	{
		$resetmoeny = $row[2] - $zen_cap_15;
	}
//Reset cấp 15 -> 16
elseif ($row[1] >= $reset_cap_15 AND $row[1] < $reset_cap_16)
	{
		$resetmoeny = $row[2] - $zen_cap_16;
	}
//Reset cấp 16 -> 17
elseif ($row[1] >= $reset_cap_16 AND $row[1] < $reset_cap_17)
	{
		$resetmoeny = $row[2] - $zen_cap_17;
	}
//Reset cấp 17 -> 18
elseif ($row[1] >= $reset_cap_17 AND $row[1] < $reset_cap_18)
	{
		$resetmoeny = $row[2] - $zen_cap_18;
	}
//Reset cấp 18 -> 19
elseif ($row[1] >= $reset_cap_18 AND $row[1] < $reset_cap_19)
	{
		$resetmoeny = $row[2] - $zen_cap_19;
	}
//Reset cấp 19 -> 20
elseif ($row[1] >= $reset_cap_19 AND $row[1] < $reset_cap_20)
	{
		$resetmoeny = $row[2] - $zen_cap_20;
	}

//End Cong thuc Reset

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

	$sql_reset_script="Update dbo.character set [money]='$resetmoeny',[resets]=$resetup, ResetNBB=$resetup,[PointUyThac]='$point_uythac_after', PointUyThac_Event='$point_uythac_event_after', [reset_total]=$reset_total where AccountID = '$login' AND name='$name'";
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

$tru_jewel = $db->Execute("UPDATE MEMB_INFO SET jewel_chao=jewel_chao-$chao,jewel_cre=jewel_cre-$cre,jewel_blue=jewel_blue-$blue WHERE memb___id='$login'");

//Event GiftCode Reset
include_once('sv_giftcode_rs.php');

if(file_exists('config/config_sendmess.php')) {
    include_once('config/config_sendmess.php');
    if($Use_SendMess_UyThacRS == 1) {
        $thehe_query = "Select thehe From MEMB_INFO where memb___id='$login'";
        $thehe_result = $db->Execute($thehe_query);
            check_queryerror($thehe_query, $thehe_result);
        $thehe_fetch = $thehe_result->fetchrow();
        $thehe = $thehe_fetch[0];
        
        include('config/config_thehe.php');
        $thehe_name = $thehe_choise[$thehe];
        $mess_send = '['. $thehe_name. '] '. $name .' RS Ủy Thác lần '. $resetup;
        
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

_topreset($login, $name, 0, 0, 1);

//Ghi vào Log nhung nhan vàt Reset
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "$name Reset Ủy Thác lần thứ $resetup, Relife $relife. Sử dụng <strong>$point_uythac</strong> điểm Ủy Thác. Trước Reset <strong>$point_uythac_before</strong> điểm Ủy Thác, <strong>$point_uythac_event_before</strong> điểm Ủy Thác Event. Sau Reset <strong>$point_uythac_after</strong> điểm Ủy Thác, <strong>$point_uythac_event_after</strong> điểm Ủy Thác Event.";
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log nhung nhan vàt Reset

echo "OK<nbb>$resetmoeny<nbb>$point_uythac_after<nbb>$point_uythac_event_after<netbanbe>$name Reset lần thứ $resetup thành công!<br />$messenge_giftcode";
}

?>