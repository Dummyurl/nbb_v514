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
include_once ('config.php');
include_once ('function.php');

$action = $_POST['action'];
$login = $_POST['login'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

switch ($action)
{
	
    case 'view_infoacc':
        include_once('config/config_event.php');
        include_once('config/config_event1.php');
        
        $name = $_POST['name'];
        
        $query_getacc = "SELECT gcoin, vpoint, bank, jewel_chao, jewel_cre, jewel_blue, tel__numb, passran, gcoin_km, thehe, IPBonusPoint, jewel_heart FROM MEMB_INFO WHERE memb___id='$login'";
		$result_getacc = $db->Execute($query_getacc);
		$getacc = $result_getacc->fetchrow();
        
    		$acc_gcoin = $getacc[0];
            $acc_gcoin_km = $getacc[8];
    		$acc_vpoint = $getacc[1];
    		$acc_zen = $getacc[2];
    		$acc_chao = $getacc[3];
    		$acc_cre = $getacc[4];
    		$acc_blue = $getacc[5];
            $acc_IPBonusPoint = $getacc[10];
            $acc_heart = $getacc[11];

		$query_nv = "select cLevel, LevelUpPoint, pointdutru, Money, Resets, Relifes, khoado, UyThac, PointUyThac, uythacoffline_stat, uythacoffline_time, Top50, UyThacOffline_Daily, point_event, PointUyThac_Event FROM Character WHERE AccountID='$login' AND Name='$name'";
		$result_nv = $db->Execute( $query_nv );
		$nv= $result_nv->fetchrow();
			$nv_Level = $nv[0];
			$nv_point = $nv[1];
			$nv_point_dutru = $nv[2];
			$nv_zen = $nv[3];
			$nv_reset = $nv[4];  if($nv_reset < 0) $nv_reset = 0;
			$nv_relife = $nv[5];
			$nv_khoado = $nv[6];
			$nv_uythacon = $nv[7];
			$nv_pointuythac = $nv[8];
            $nv_pointuythac_event = $nv[14];
			$nv_uythac_offline = $nv[9];
            $nv_uythac_offline_daily = $nv[12];
			if ($nv[10]>0) $nv_uythac_offline_time = floor(($timestamp-$nv[10])/60);
			else $nv_uythac_offline_time=0;
            $nv_top50 = $nv[11];
            $nv_point_event = $nv[13];
            $nv_event1_type1 = event1_type1_slg($name);
            $nv_event1_type2 = event1_type2_slg($name);
            $nv_event1_type3 = event1_type3_slg($name);
            $nv_event1_type1_daily = event1_type1_daily_slg($name);
            $nv_event1_type2_daily = event1_type2_daily_slg($name);
            $nv_event1_type3_daily = event1_type3_daily_slg($name);
            $nv_resetday = _get_reset_day($name,$timestamp);
            $nv_resetmonth = _get_reset_month($name);
            
		$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$login' AND GameIDC='$name'");
		$doinv_check = $sql_doinv_check->numrows();
			if ($doinv_check > 0) { $doinv = '0'; } else { $doinv = '1'; }
		
		$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$login' AND ConnectStat='1'");
		$online_check = $sql_online_check->numrows();
			if ($online_check > 0) { $online = '1'; } else { $online = '0'; }
        
        $quest_daily_arr = _quest_daily($login, $name);
        $quest_wait = $quest_daily_arr['quest_wait'];
        
        $data_arr = array(
            'acc_gcoin' =>  $acc_gcoin,
            'acc_gcoin_km'  =>  $acc_gcoin_km,
            'acc_vpoint'    =>  $acc_vpoint,
            'acc_zen'   =>  $acc_zen,
            'acc_heart'  =>  $acc_heart,
            'acc_chao'  =>  $acc_chao,
            'acc_cre'   =>  $acc_cre,
            'acc_blue'  =>  $acc_blue,
            'acc_ipbonuspoint'  =>  $acc_IPBonusPoint,
                        
            'nv_level'  =>  $nv_Level,
            'nv_point'  =>  $nv_point,
            'nv_pointdutru' =>  $nv_point_dutru,
            'nv_zen'    =>  $nv_zen,
            'nv_reset'  =>  $nv_reset,
            'nv_resetday'   =>  $nv_resetday,
            'nv_resetmonth' =>  $nv_resetmonth,
            'nv_relife' =>  $nv_relife,
            'nv_khoado' =>  $nv_khoado,
            'nv_uythacon'   =>  $nv_uythacon,
            'nv_pointuythac'    =>  $nv_pointuythac,
            'nv_pointuythac_event'    =>  $nv_pointuythac_event,
            'nv_uythac_offline' =>  $nv_uythac_offline,
            'nv_uythac_offline_daily'   =>  $nv_uythac_offline_daily,
            'nv_uythac_offline_time'    =>  $nv_uythac_offline_time,
            'nv_top50'  =>  $nv_top50,
            'nv_point_event'    =>  $nv_point_event,
            'nv_event1_type1'   =>  $nv_event1_type1,
            'nv_event1_type2'   =>  $nv_event1_type2,
            'nv_event1_type3'   =>  $nv_event1_type3,
            'nv_event1_type1_daily'   =>  $nv_event1_type1_daily,
            'nv_event1_type2_daily'   =>  $nv_event1_type2_daily,
            'nv_event1_type3_daily'   =>  $nv_event1_type3_daily,
            'qwait'   =>  $quest_wait,
            'doinv' =>  $doinv,
            'online'    =>  $online
        );
            $data = serialize($data_arr);
            echo "$data";
    break;
    
    case 'login':
        include('config/config_thehe.php');
        
		$pass = $_POST['pass'];
		$ip = $_POST['ip'];
		
		if ($type_acc == 1) {
			kiemtra_kituso($login);
		} else {
			kiemtra_kitudacbiet($login);
		}
		kiemtra_kitudacbiet($pass);
	
		kiemtra_acc($login);
		kiemtra_pass($login,$pass);
		kiemtra_block_acc($login);
		
		$query_getacc = "SELECT gcoin, vpoint, bank, jewel_chao, jewel_cre, jewel_blue, tel__numb, passran, gcoin_km, thehe, IPBonusPoint, jewel_heart FROM MEMB_INFO WHERE memb___id='$login'";
		$result_getacc = $db->Execute($query_getacc) OR DIE("Lỗi Query : $query_getacc");
		$getacc = $result_getacc->fetchrow();
        
    		$gcoin = $getacc[0];
            $gcoin_km = $getacc[8];
    		$vpoint = $getacc[1];
    		$zen = $getacc[2];
    		$chao = $getacc[3];
    		$cre = $getacc[4];
    		$blue = $getacc[5];
    		$phone = substr($getacc[6],-3);
    		$passran = $getacc[7];
            $thehe = $getacc[9];
            $IPBonusPoint = $getacc[10];
            $heart = $getacc[11];
        
        if(strlen($thehe_choise[$thehe]) == 0) {
            echo "Tài khoản không thuộc Server này.";
            exit();
        } else {
            $query_getnv = "SELECT GameID1,GameID2,GameID3,GameID4,GameID5 FROM AccountCharacter Where Id='$login'";
    		$result_getnv = $db->Execute($query_getnv) OR DIE("Lỗi Query : $query_getnv");
    		$getnv = $result_getnv->fetchrow();
    		
        		$char1 = $getnv[0];
        		$char2 = $getnv[1];
        		$char3 = $getnv[2];
        		$char4 = $getnv[3];
        		$char5 = $getnv[4];
    		
    				$numran = rand(10000,99999);
    				$time_now = $timestamp;
    				$string_login = $numran.$time_now;
    				$string_login = md5($string_login);
    			$query_stringlogin = "Update MEMB_INFO SET checklogin='$string_login',ip='$ip' WHERE memb___id='$login'";
    			$result_stringlogin = $db->Execute($query_stringlogin);
    			if($result_stringlogin === false) DIE("QUERY ERROR: $query_stringlogin");
                
                $ipmasternet_query = "SELECT ip FROM IPBonus WHERE acc='$login'";
                $ipmasternet_result = $db->Execute($ipmasternet_query);
                    check_queryerror($ipmasternet_query, $ipmasternet_result);
                $masternet_exits = $ipmasternet_result->NumRows();
                if($masternet_exits > 0) {
                    $ipmasternet_fetch = $ipmasternet_result->FetchRow();
                    $ipmasternet = $ipmasternet_fetch[0];
                    if($ipmasternet != $ip) {
                        $ipmasternet_update_query = "UPDATE IPBonus SET ip='$ip' WHERE acc='$login'";
                        $ipmasternet_update_result = $db->Execute($ipmasternet_update_query);
                            check_queryerror($ipmasternet_update_query, $ipmasternet_update_result);
                    }
                    $ipbonus_info = "Bạn là chủ Quán NET đăng ký IP Bonus. IP tại quán NET của bạn đã được cập nhập. Cảm ơn đã tham gia chương trình IP Bonus.";
                } else {
                    $ipbonus_play_query = "SELECT TOP 1 InternetName, Address, QuanHuyen, ThanhPho, ipbonus_id FROM IPBonus WHERE ip='$ip'";
                    $ipbonus_play_result = $db->Execute($ipbonus_play_query);
                        check_queryerror($ipbonus_play_query, $ipbonus_play_result);
                    $ipbonus_check = $ipbonus_play_result->NumRows();
                    
                    if($ipbonus_check == 0) {
                        $ipbonus_info = "";
                    } else {
                        $ipbonus_play_fetch = $ipbonus_play_result->FetchRow();
                        $ipbonus_info = "Bạn đang chơi tại quán NET <strong>$ipbonus_play_fetch[0]</strong> đã <strong>đăng ký IP Bonus</strong> <br /> <strong>Địa chỉ</strong> $ipbonus_play_fetch[1], $ipbonus_play_fetch[2], $ipbonus_play_fetch[3] <br />.";
                        $accinnet_query = "SELECT * FROM IPBonus_acc WHERE ipbonus_id=$ipbonus_play_fetch[4] AND acc='$login'";
                        $accinnet_result = $db->Execute($accinnet_query);
                            check_queryerror($accinnet_query, $accinnet_result);
                        $accinnet_check = $accinnet_result->NumRows();
                        if($accinnet_check == 0) {
                            $insert_accinnet_query = "INSERT INTO IPBonus_acc (ipbonus_id, acc) VALUES ($ipbonus_play_fetch[4], '$login')";
                            $insert_accinnet_result = $db->Execute($insert_accinnet_query);
                                check_queryerror($insert_accinnet_query, $insert_accinnet_result);
                            
                            $incr_totalacc_query = "UPDATE IPBonus SET totalacc=totalacc+1 WHERE ipbonus_id=$ipbonus_play_fetch[4]";
                            $incre_totalacc_result = $db->Execute($incr_totalacc_query);
                                check_queryerror($incr_totalacc_query, $incre_totalacc_result);
                        }
                    }
                }
    		  echo "
                <info>OK</info>
                <stringlogin>$string_login</stringlogin>
                <thehe>$thehe</thehe>
                <gcoin>$gcoin</gcoin>
                <gcoinkm>$gcoin_km</gcoinkm>
                <vpoint>$vpoint</vpoint>
                <zen>$zen</zen>
                <heart>$heart</heart>
                <chao>$chao</chao>
                <create>$cre</create>
                <blue>$blue</blue>
                <phone>$phone</phone>
                <passran>$passran</passran>
                <IPBonusPoint>$IPBonusPoint</IPBonusPoint>
                <ipbonus_info>$ipbonus_info</ipbonus_info>
                <char1>$char1</char1>
                <char2>$char2</char2>
                <char3>$char3</char3>
                <char4>$char4</char4>
                <char5>$char5</char5>
              ";
        }
		break;

	case 'view_invite':
		kiemtra_acc($login);
		$query = "SELECT acc_accept,time_invite,vpoint_invite FROM Invite WHERE acc_invite='$login'";
		$result = $db->Execute( $query );
		$content = "OK<netbanbe>";
		
		while( $row = $result->fetchrow() )
		{
			$char_chinh_check = $db->SelectLimit("Select Name From Character where AccountID='$row[0]' ORDER BY Relifes DESC, Resets DESC, cLevel DESC", 1, 0);
			$char_chinh = $char_chinh_check->fetchrow();
			
	
			$character = $char_chinh[0];
			$time_inv = $row[1];
			$vpoint_inv = $row[2];
			
			$content .= "$character<nbb>$time_inv<nbb>$vpoint_inv<netbanbe>";
		}

		echo $content;
		break;
		
	case 'view_acc':
		kiemtra_acc($login);
		$query = "select bank,vpoint,jewel_chao,jewel_cre,jewel_blue,gcoin from MEMB_INFO WHERE memb___id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		$zen = $row[0];
		$vpoint = $row[1];
		$gcoin = $row[5];
		
		$chao = $row[2];
		$cre = $row[3];
		$blue = $row[4];

		echo "OK<netbanbe>$zen<netbanbe>$vpoint<netbanbe>$chao<netbanbe>$cre<netbanbe>$blue<netbanbe>$gcoin";
		break;
		
	case 'view_lostinfo':
		kiemtra_acc($login);
		$query = "select mail_addr,memb__pwd2,pass2,fpas_ques,fpas_answ from MEMB_INFO WHERE memb___id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		$email = $row[0];
		$pass1 = $row[1];
		$pass2 = $row[2];
		$quest = $row[3];
		$ans = $row[4];
		
	
		echo "$email<netbanbe>$pass1<netbanbe>$pass2<netbanbe>$quest<netbanbe>$ans<netbanbe>OK";
		break;
	
	case 'view_char':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();

		echo "$row[0]<netbanbe>$row[1]<netbanbe>$row[2]<netbanbe>$row[3]<netbanbe>$row[4]";
		break;
		
	case 'chonNV':
        include_once('config/config_event.php');
        include_once('config/config_event1.php');

		$string_login = $_POST['string_login'];
		checklogin($login,$string_login);
        
		$name = $_POST['name'];
        fixrs($name);
		$query_nv = "select Class, cLevel, LevelUpPoint, pointdutru, Money, Resets, Relifes, khoado, IsThuePoint, point_event, UyThac, PointUyThac, uythacoffline_stat, uythacoffline_time, Top50, UyThacOffline_Daily, point_event, PointUyThac_Event FROM Character WHERE AccountID='$login' AND Name='$name'";
		$result_nv = $db->Execute( $query_nv ) OR DIE("Lỗi Query: $query_nv");
		$nv= $result_nv->fetchrow();
			$class = $nv[0];
			$Level = $nv[1];
			$point = $nv[2];
			$point_dutru = $nv[3];
			$zen = $nv[4];
			$reset = $nv[5];
			$relife = $nv[6];
			$khoado = $nv[7];
			$thuepoint = $nv[8];
			$point_event = $nv[9];
			$uythacon = $nv[10];
			$pointuythac = $nv[11];
            $pointuythac_event = $nv[17];
			$uythac_offline = $nv[12];
            $uythac_offline_daily = $nv[15];
			if ($nv[13]>0) $uythac_offline_time = floor(($timestamp-$nv[13])/60);
			else $uythac_offline_time=0;
            $top50 = $nv[14];
            $point_event = $nv[16];
            $event1_type1 = event1_type1_slg($name);
            $event1_type2 = event1_type2_slg($name);
            $event1_type3 = event1_type3_slg($name);
            $event1_type1_daily = event1_type1_daily_slg($name);
            $event1_type2_daily = event1_type2_daily_slg($name);
            $event1_type3_daily = event1_type3_daily_slg($name);
            $resetday = _get_reset_day($name,$timestamp);
            $resetmonth = _get_reset_month($name);
		
		$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$login' AND GameIDC='$name'");
		$doinv_check = $sql_doinv_check->numrows();
			if ($doinv_check > 0) { $doinv = '0'; } else { $doinv = '1'; }
		
		$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$login' AND ConnectStat='1'");
		$online_check = $sql_online_check->numrows();
			if ($online_check > 0) { $online = '1'; } else { $online = '0'; }
        
        $quest_daily_arr = _quest_daily($login, $name);
        $quest_wait = $quest_daily_arr['quest_wait'];
        
            echo "
                <info>OK</info>
                <online>$online</online>
                <doinv>$doinv</doinv>
                <class>$class</class>
                <level>$Level</level>
                <point>$point</point>
                <point_dutru>$point_dutru</point_dutru>
                <zen>$zen</zen>
                <reset>$reset</reset>
                <resetday>$resetday</resetday>
                <resetmonth>$resetmonth</resetmonth>
                <relife>$relife</relife>
                <khoado>$khoado</khoado>
                <thuepoint>$thuepoint</thuepoint>
                <pointevent>$point_event</pointevent>
                <uythacon>$uythacon</uythacon>
                <pointuythac>$pointuythac</pointuythac>
                <pointuythac_event>$pointuythac_event</pointuythac_event>
                <uythacoff>$uythac_offline</uythacoff>
                <uythacoff_time>$uythac_offline_time</uythacoff_time>
                <uythacoff_daily>$uythac_offline_daily</uythacoff_daily>
                <top50>$top50</top50>
                <point_event>$point_event</point_event>
                <event1_type1>$event1_type1</event1_type1>
                <event1_type2>$event1_type2</event1_type2>
                <event1_type3>$event1_type3</event1_type3>
                <event1_type1_daily>$event1_type1_daily</event1_type1_daily>
                <event1_type2_daily>$event1_type2_daily</event1_type2_daily>
                <event1_type3_daily>$event1_type3_daily</event1_type3_daily>
                <qwait>$quest_wait</qwait>
            ";
		break;
		
	case 'view_charrs':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		$time = $timestamp;
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_reset = $db->Execute("SELECT cLevel,Resets FROM Character WHERE Name='$row[$i]'");
				$rs_reset = $query_reset->fetchrow();
				$level[] = $rs_reset[0];
				$reset[] = $rs_reset[1];
				$resetinday[] = _get_reset_day($row[$i],$timestamp);
			}
			else { $reset[] = 0; $level[] = 0; $resetinday[] = 0; }
		}

		echo "$row[0]<nbb>$level[0]<nbb>$reset[0]<nbb>$resetinday[0]<netbanbe>$row[1]<nbb>$level[1]<nbb>$reset[1]<nbb>$resetinday[1]<netbanbe>$row[2]<nbb>$level[2]<nbb>$reset[2]<nbb>$resetinday[2]<netbanbe>$row[3]<nbb>$level[3]<nbb>$reset[3]<nbb>$resetinday[3]<netbanbe>$row[4]<nbb>$level[4]<nbb>$reset[4]<nbb>$resetinday[4]";
		break;
		
	case 'view_charrl':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_reset = $db->Execute("SELECT cLevel,Resets,ReLifes FROM Character WHERE Name='$row[$i]'");
				$rs_reset = $query_reset->fetchrow();
				$level[] = $rs_reset[0];
				$reset[] = $rs_reset[1];
				$relife[] = $rs_reset[2];
			}
			else { $reset[] = 0; $level[] = 0; }
		}

		echo "$row[0]<nbb>$level[0]<nbb>$reset[0]<nbb>$relife[0]<netbanbe>$row[1]<nbb>$level[1]<nbb>$reset[1]<nbb>$relife[1]<netbanbe>$row[2]<nbb>$level[2]<nbb>$reset[2]<nbb>$relife[2]<netbanbe>$row[3]<nbb>$level[3]<nbb>$reset[3]<nbb>$relife[3]<netbanbe>$row[4]<nbb>$level[4]<nbb>$reset[4]<nbb>$relife[4]";
		break;

	case 'view_charpk':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_PK = $db->Execute("SELECT PkLevel,PkCount FROM Character WHERE Name='$row[$i]'");
				$rs_PK = $query_PK->fetchrow();
				$PkLevel[] = $rs_PK[0];
				$PkCount[] = $rs_PK[1];
			}
			else { $PkLevel[] = 0; $PkCount[] = 0; }
		}

		echo "$row[0]<nbb>$PkLevel[0]<nbb>$PkCount[0]<netbanbe>$row[1]<nbb>$PkLevel[1]<nbb>$PkCount[1]<netbanbe>$row[2]<nbb>$PkLevel[2]<nbb>$PkCount[2]<netbanbe>$row[3]<nbb>$PkLevel[3]<nbb>$PkCount[3]<netbanbe>$row[4]<nbb>$PkLevel[4]<nbb>$PkCount[4]";
		break;
		
	case 'view_chargioitinh':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_Class = $db->Execute("SELECT Class FROM Character WHERE Name='$row[$i]'");
				$rs_Class = $query_Class->fetchrow();
				$Class[] = $rs_Class[0];
			}
			else { $Class[] = 0; }
		}

		echo "$row[0]<nbb>$Class[0]<netbanbe>$row[1]<nbb>$Class[1]<netbanbe>$row[2]<nbb>$Class[2]<netbanbe>$row[3]<nbb>$Class[3]<netbanbe>$row[4]<nbb>$Class[4]";
		break;
	
		case 'view_charblock':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_Class = $db->Execute("SELECT CtlCode FROM Character WHERE Name='$row[$i]'");
				$rs_Class = $query_Class->fetchrow();
				if ($rs_Class[0] == 1) $block[] = 1;
				else { $block[] = 0; } 
			}
			else { $block[] = 0; }
		}

		echo "$row[0]<nbb>$block[0]<netbanbe>$row[1]<nbb>$block[1]<netbanbe>$row[2]<nbb>$block[2]<netbanbe>$row[3]<nbb>$block[3]<netbanbe>$row[4]<nbb>$block[4]";
		break;
	
	case 'view_charaddpoint':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		$time = $timestamp;
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_point = $db->Execute("SELECT LevelUpPoint FROM Character WHERE Name='$row[$i]'");
				$rs_point = $query_point->fetchrow();
				$point[] = $rs_point[0];
			}
			else { $point[] = 0; }
		}

		echo "$row[0]<nbb>$point[0]<netbanbe>$row[1]<nbb>$point[1]<netbanbe>$row[2]<nbb>$point[2]<netbanbe>$row[3]<nbb>$point[3]<netbanbe>$row[4]<nbb>$point[4]";
		break;
		
	case 'view_combo':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		$time = $timestamp;
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_leveldk3 = $db->Execute("SELECT Clevel FROM Character WHERE Name='$row[$i]' AND (Class='2' OR Class='18' OR Class='34')");
				$rs_leveldk3 = $query_leveldk3->fetchrow();
				$leveldk3[] = $rs_leveldk3[0];
			}
			else { $leveldk3[] = 0; }
		}

		echo "$row[0]<nbb>$leveldk3[0]<netbanbe>$row[1]<nbb>$leveldk3[1]<netbanbe>$row[2]<nbb>$leveldk3[2]<netbanbe>$row[3]<nbb>$leveldk3[3]<netbanbe>$row[4]<nbb>$leveldk3[4]";
		break;
		
	case 'view_charrs2item':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		$time = $timestamp;
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_reset = $db->Execute("SELECT Resets,ReLifes FROM Character WHERE Name='$row[$i]'");
				$rs_reset = $query_reset->fetchrow();
				$reset[] = $rs_reset[0];
				$relife[] = $rs_reset[1];
			}
			else { $reset[] = 0; $relife[] = 0; }
		}

		echo "$row[0]<nbb>$reset[0]<nbb>$relife[0]<netbanbe>$row[1]<nbb>$reset[1]<nbb>$relife[1]<netbanbe>$row[2]<nbb>$reset[2]<nbb>$relife[2]<netbanbe>$row[3]<nbb>$reset[3]<nbb>$relife[3]<netbanbe>$row[4]<nbb>$reset[4]<nbb>$relife[4]";
		break;
		
	case 'view_charrutpoint':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		$time = $timestamp;
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_point = $db->Execute("SELECT LevelUpPoint,pointdutru FROM Character WHERE Name='$row[$i]'");
				$point = $query_point->fetchrow();
				$point_free[] = $point[0];
				$point_dutru[] = $point[1];
			}
			else { $point_free[] = 0; $point_dutru[] = 0; }
		}

		echo "$row[0]<nbb>$point_free[0]<nbb>$point_dutru[0]<netbanbe>$row[1]<nbb>$point_free[1]<nbb>$point_dutru[1]<netbanbe>$row[2]<nbb>$point_free[2]<nbb>$point_dutru[2]<netbanbe>$row[3]<nbb>$point_free[3]<nbb>$point_dutru[3]<netbanbe>$row[4]<nbb>$point_free[4]<nbb>$point_dutru[4]";
		break;
		
	case 'view_charthuepoint':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_point = $db->Execute("SELECT IsThuePoint,TimeThuePoint FROM Character WHERE Name='$row[$i]'");
				$point = $query_point->fetchrow();
				$point_status[] = $point[0];
				$point_time[] = $timestamp-$point[1];
			}
			else { $point_status[] = 0; $point_time[] = 0; }
		}

		echo "$row[0]<nbb>$point_status[0]<nbb>$point_time[0]<netbanbe>$row[1]<nbb>$point_status[1]<nbb>$point_time[1]<netbanbe>$row[2]<nbb>$point_status[2]<nbb>$point_time[2]<netbanbe>$row[3]<nbb>$point_status[3]<nbb>$point_time[3]<netbanbe>$row[4]<nbb>$point_status[4]<nbb>$point_time[4]";
		break;
		
	case 'view_charkhoaitem':
		$query = "select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$login'";
		$result = $db->Execute( $query );
		$row = $result->fetchrow();
		for ($i=0;$i<5;++$i)
		{
			if ( !empty($row[$i]) ) {
				$query_khoaitem = $db->Execute("SELECT khoado FROM Character WHERE Name='$row[$i]'");
				$rs_khoaitem = $query_khoaitem->fetchrow();
				$status_khoado[] = $rs_khoaitem[0];
			}
			else { $status_khoado[] = 0; }
		}

		echo "$row[0]<nbb>$status_khoado[0]<netbanbe>$row[1]<nbb>$status_khoado[1]<netbanbe>$row[2]<nbb>$status_khoado[2]<netbanbe>$row[3]<nbb>$status_khoado[3]<netbanbe>$row[4]<nbb>$status_khoado[4]";
		break;
		
	case 'viewcard':
		$fpage = intval($_POST['page']);
		if(empty($fpage)){ $fpage = 1; }
	
		$fstart = ($fpage-1)*$Card_per_page;
		$fstart = round($fstart,0);
	
		$result = $db->SelectLimit("Select menhgia,card_num,card_serial,time_create,accused,time_nap,status from Card_Vpoint WHERE accdl='" . $login . "' ORDER BY id DESC", $Card_per_page, $fstart);
	
		while($row = $result->fetchrow()) 	{
		echo"$row[0]<nbb>$row[1]<nbb>$row[2]<nbb>$row[3]<nbb>$row[4]<nbb>$row[5]<nbb>$row[6]<netbanbe>";
		}
		break;
		
	
	case 'createcard':
		$menhgia = $_POST['menhgia'];
		if ($menhgia == 10) { $vpoint_tru = $menhgia10000; }
		if ($menhgia == 20) { $vpoint_tru = $menhgia20000; }
		if ($menhgia == 30) { $vpoint_tru = $menhgia30000; }
		if ($menhgia == 40) { $vpoint_tru = $menhgia40000; }
		if ($menhgia == 50) { $vpoint_tru = $menhgia50000; }
		if ($menhgia == 100) { $vpoint_tru = $menhgia100000; }
		
		$query_kt_vpoint = "SELECT vpoint FROM DaiLy WHERE accdl='$login'";
		$result_kt_vpoint = $db->Execute($query_kt_vpoint);
		$kt_vpoint = $result_kt_vpoint->fetchrow();
		
		$vpoint_after = $kt_vpoint[0] - $vpoint_tru;
	
		if ($vpoint_after < 0) { echo "Không đủ V.Point để tạo thẻ."; exit(); }
	
		$serial = $timestamp;
		$mathe_1 = $menhgia;
		$mathe_2 = '-';
		$mathe_3 = rand(100000,999999);
		$mathe = $mathe_1.$mathe_2.$mathe_3;
	
		$time_create = date('H:i d-m-Y',$serial);
		
		$query_insert_card = "INSERT INTO Card_Vpoint (accdl,menhgia,card_num,card_serial,time_create) VALUES ('$login','$menhgia','$mathe','$serial','$time_create')";
		$result_insert_card = $db->Execute($query_insert_card);
	
		$query_tru_vpoint = "UPDATE DaiLy SET vpoint='$vpoint_after' WHERE accdl='$login'";
		$result_tru_vpoint = $db->Execute($query_tru_vpoint);
	
		echo "Tạo thẻ " . $menhgia. ".000 VND thành công.<br>Mã thẻ: $mathe<br>Serial: $serial";
		break;
		
	case 'view_infomu':
		$query_total_acc = "SELECT Count(*) FROM MEMB_INFO";
		$result_total_acc = $db->Execute($query_total_acc);
		$total_acc = $result_total_acc->fetchrow();
	
		$query_total_char = "SELECT Count(*) FROM Character";
		$result_total_char = $db->Execute($query_total_char);
		$total_char = $result_total_char->fetchrow();
	
		echo "$total_acc[0]<nbb>$total_char[0]";
		break;
	
    case 'lvitem':
        $name = $_POST['name'];
        $inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE AccountID='$login' AND Name='$name'";
        $inventory_result_sql = $db->Execute($inventory_query);
            if($inventory_result_sql === false) DIE("Query Error : $inventory_query");
        $inventory_result = $inventory_result_sql->fetchrow();

        $inventory = $inventory_result[0];
        $inventory = bin2hex($inventory);
        $item = substr($inventory,12*32,1*32);
        $item = strtoupper($item);

        if($item != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') {
            $iop 	= hexdec(substr($item,2,2)); 	// Item Level/Skill/Option Data
            // Skill Check
        	if ($iop<128) 
        		$skill	= '';
        	else {
        		$skill	= '<font color=#99FFCC size=2>Vũ khí có tuyệt chiêu</font>';
        		$iop	= $iop-128;
        	}
        	// Item Level Check
        	$itemlevel	= floor($iop/8);
        	$iop		= $iop-$itemlevel*8;
        	// Luck Check
        	if($iop<4)
        		$luck	= ''; 
        	else {
        		$luck	= "<font size=2>May mắn (Tỉ lệ thành công khi dùng Ngọc Tâm Linh +25%)<br />May mắn (Tỉ lệ gây sát thương tối đa +5%)</font>";
        		$iop	= $iop-4;
        	}
            if($itemlevel == 0) echo 'ko';
            else echo $itemlevel;
        } else echo "Item không có trong ô đầu tiên trên túi đồ.";
        break;
}


} else echo "Error";
$db->Close();
?>