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
 
include_once ("security.php");
include ('../config.php');
include ('function.php');
include ('../config/config_thehe.php');
$title = "Admin";
session_start();
if ($_POST[submit]) {
    $pass_admin = md5($_POST[useradmin]);
    if ($pass_admin == $passadmin)
        $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
    echo "<center><form action='' method=post><input type='hidden' name='username' value='admin'>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title><?php echo $title; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>
<?php
$action = $_POST['action'];
$name = $_POST['name'];
$acc = $_POST['acc'];
$ip = $_POST['ip'];
$gcoin = $_POST['gcoin'];
$gcoin = abs(intval($gcoin));
$gcoin_km = $_POST['gcoin_km'];
$gcoin_km = abs(intval($gcoin_km));
$vpoint = $_POST['vpoint'];
$vpoint = abs(intval($vpoint));
$zen = $_POST['zen'];
$zen = abs(intval($zen));

switch ($action) {
    case "search_char":
        if (empty($name)) {
            $notice = "Chưa điền tên nhân vật cần tìm vào ô trống";
        } else {
            $sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' ");
            $name_check = $sql_name_check->numrows();

            if ($name_check <= 0) {
                $notice = "Không có nhân vật này";
            } else {
                $query = "select resets,clevel,LevelUpPoint,Strength,Dexterity,Vitality,Energy,Leadership,class,AccountID,PkLevel,PkCount,makhoado,ctlcode,relifes,point_event,UyThac,PointUyThac,pointdutru,MapNumber,MapPosX,MapPosY, PointUyThac_Event, TOP50 from Character WHERE Name='$name'";
                $result = $db->Execute($query) or die("Lỗi Query: $query");
                $row = $result->fetchrow();

                $check_online_query =
                    "SELECT * FROM MEMB_STAT MS JOIN AccountCharacter AC ON ConnectStat='1' AND memb___id='$row[9]' AND MS.memb___id collate DATABASE_DEFAULT = AC.Id collate DATABASE_DEFAULT AND GameIDC='$name'";
                $check_online_result = $db->Execute($check_online_query) OR DIE("Query Error : $check_online_query");
                $result1 = $check_online_result->numrows();

                $sv_query = "Select ServerName from MEMB_STAT where ConnectStat='1' AND memb___id='$row[9]'";
                $sv_result = $db->Execute($sv_query);
                $sv = $sv_result->fetchrow();

                switch ($row[8]) {
                    case 0:
                        $class = 'Dark Wizard';
                        break;
                    case 1:
                        $class = 'Soul Master';
                        break;
                    case 2:
                    case 3:
                        $class = 'Grand Master';
                        break;

                    case 16:
                        $class = 'Dark Knight';
                        break;
                    case 17:
                        $class = 'Blade Knight';
                        break;
                    case 18:
                    case 19:
                        $class = 'Blade Master';
                        break;

                    case 32:
                        $class = 'Elf';
                        break;
                    case 33:
                        $class = 'Muse Elf';
                        break;
                    case 34:
                    case 35:
                        $class = 'Hight Elf';
                        break;

                    case 48:
                        $class = 'Magic Gladiator';
                        break;
                    case 49:
                    case 50:
                        $class = 'Duel Master';
                        break;

                    case 64:
                        $class = 'DarkLord';
                        break;
                    case 65:
                    case 66:
                        $class = 'Lord Emperor';
                        break;

                    case 80:
                        $class = 'Sumoner';
                        break;
                    case 81:
                        $class = 'Bloody Summoner';
                        break;
                    case 82:
                    case 83:
                        $class = 'Dimension Master';
                        break;

                    case 96:
                        $class = 'Rage Fighter';
                        break;
                    case 97:
                    case 98:
                        $class = 'First Class';
                        break;
                }

                switch ($row[19]) {
                    case 0:
                        $map = 'Lorencia';
                        break;
                    case 1:
                        $map = 'Dungeon';
                        break;
                    case 2:
                        $map = 'Davias';
                        break;
                    case 3:
                        $map = 'Noria';
                        break;
                    case 4:
                        $map = 'LostTower';
                        break;
                    case 5:
                        $map = 'Exile';
                        break;
                    case 6:
                        $map = 'Stadium';
                        break;
                    case 7:
                        $map = 'Atlans';
                        break;
                    case 8:
                        $map = 'Tarkan';
                        break;
                    case 10:
                        $map = 'Icarus';
                        break;
                    case 11:
                        $map = 'BloodCastle 1';
                        break;
                    case 12:
                        $map = 'BloodCastle 2';
                        break;
                    case 13:
                        $map = 'BloodCastle 3';
                        break;
                    case 14:
                        $map = 'BloodCastle 4';
                        break;
                    case 15:
                        $map = 'BloodCastle 5';
                        break;
                    case 16:
                        $map = 'BloodCastle 6';
                        break;
                    case 17:
                        $map = 'BloodCastle 7';
                        break;
                    case 52:
                        $map = 'BloodCastle 8';
                        break;
                    case 9:
                        $map = 'DevilSquare 1-2-3-4';
                        break;
                    case 32:
                        $map = 'DevilSquare 1-2-3-4';
                        break;
                    case 35:
                        $map = 'Lorencia';
                        break;
                    case 18:
                        $map = 'ChaosCastle 1';
                        break;
                    case 19:
                        $map = 'ChaosCastle 2';
                        break;
                    case 20:
                        $map = 'ChaosCastle 3';
                        break;
                    case 21:
                        $map = 'ChaosCastle 4';
                        break;
                    case 22:
                        $map = 'ChaosCastle 5';
                        break;
                    case 23:
                        $map = 'ChaosCastle 6';
                        break;
                    case 53:
                        $map = 'ChaosCastle 7';
                        break;
                    case 24:
                        $map = 'Kalima 1';
                        break;
                    case 25:
                        $map = 'Kalima 2';
                        break;
                    case 26:
                        $map = 'Kalima 3';
                        break;
                    case 27:
                        $map = 'Kalima 4';
                        break;
                    case 28:
                        $map = 'Kalima 5';
                        break;
                    case 29:
                        $map = 'Kalima 6';
                        break;
                    case 36:
                        $map = 'Kalima 7';
                        break;
                    case 30:
                        $map = 'Valley Of Loren';
                        break;
                    case 31:
                        $map = 'Land Of Trials';
                        break;
                    case 33:
                        $map = 'Aida';
                        break;
                    case 34:
                        $map = 'CryWolf';
                        break;
                    case 37:
                        $map = 'Kantru 1';
                        break;
                    case 38:
                        $map = 'Kantru 2';
                        break;
                    case 39:
                        $map = 'Kantru Ref';
                        break;
                    case 40:
                        $map = 'Silent Map';
                        break;
                    case 41:
                        $map = 'Balgass Barrack';
                        break;
                    case 42:
                        $map = 'Balgass Refuge';
                        break;
                    case 45:
                        $map = 'Illusion Temple 1';
                        break;
                    case 46:
                        $map = 'Illusion Temple 2';
                        break;
                    case 47:
                        $map = 'Illusion Temple 3';
                        break;
                    case 48:
                        $map = 'Illusion Temple 4';
                        break;
                    case 49:
                        $map = 'Illusion Temple 5';
                        break;
                    case 50:
                        $map = 'Illusion Temple 6';
                        break;
                    case 51:
                        $map = 'Elbeland';
                        break;
                    case 56:
                        $map = 'Swamp Of Calmness';
                        break;
                    case 57:
                        $map = 'Raklion';
                        break;
                    case 58:
                        $map = 'Raklion BOSS';
                        break;
                    case 62:
                        $map = 'Santa Town';
                        break;
                    case 63:
                        $map = 'Vulcanus';
                        break;
                    case 64:
                        $map = 'Duel Arena';
                        break;
                    case 65:
                        $map = 'Doppel Ganger-A';
                        break;
                    case 66:
                        $map = 'Doppel Ganger-B';
                        break;
                    case 67:
                        $map = 'Doppel Ganger-C';
                        break;
                    case 68:
                        $map = 'Doppel Ganger-D';
                        break;
                    case 69:
                        $map = 'Empire Guardian-A';
                        break;
                    case 70:
                        $map = 'Empire Guardian-B';
                        break;
                    case 71:
                        $map = 'Empire Guardian-C';
                        break;
                    case 72:
                        $map = 'Empire Guardian-D';
                        break;
                    case 79:
                        $map = 'Market Loren';
                        break;
                    default:
                        $map = 'Unknow';
                }
                ;


                switch ($row[13]) {
                    case 0:
                        $status = 'Binh thuong';
                        break;
                    case 8:
                        $status = 'GameMaster';
                        break;
                    case 18:
                        $status = 'Khoa do';
                        break;
                    case 1:
                        $status = 'Block hoặc Ủy Thác';
                        break;
                    case 99:
                        $status = 'Admin Block';
                        break;
                }

                if ($row[3] < 0) {
                    $row[3] = $row[3] + 65536;
                }
                if ($row[4] < 0) {
                    $row[4] = $row[4] + 65536;
                }
                if ($row[5] < 0) {
                    $row[5] = $row[5] + 65536;
                }
                if ($row[6] < 0) {
                    $row[6] = $row[6] + 65536;
                }
                if ($row[7] < 0) {
                    $row[7] = $row[7] + 65536;
                }

                if ($row[16] == 1)
                    $uythac = 'Đang Ủy Thác';
                else
                    $uythac = 'Không Ủy Thác';
                if ($result1 > 0) {
                    $online = 'Online';
                } else
                    $online = 'Offline';
                
                $resetday = _get_reset_day($name,$timestamp);
                $resetmonth = _get_reset_month($name);
                
                $top50 = $row[23];
                if($top50 == 0) $top50 = ">50";
                
                if ($row[8] != 64) {
                    $notice = "Tài khoản: $row[9] - Tên nhân vật: $name ($class).<br>
				   Relife: $row[14], Reset: $row[0], Level: $row[1], Point chưa cộng: $row[2], Point dự trữ: $row[18], Point Event : $row[15] | Ủy Thác : $uythac, Point Ủy Thác : $row[17], Point Ủy Thác Event : $row[22]<br>
				   Streng: $row[3], Dexterity: $row[4], Vitality: $row[5], Energy: $row[6] | Reset/Ngày : $resetday, Reset/Tháng : $resetmonth | TOP lúc 0h: $top50<br>
				   Phạm tội: $row[10], Giết người: $row[11]. Trạng thái: $status | Nhân vật đang ở : $map ( $sv[0] ), tọa độ : $row[20],$row[21]<br>
				   Mã khóa đồ: $row[12]. Nhân vật đang: $online.";

                } elseif ($row[8] == 64) {
                    $notice = "Tài khoản: $row[9] - Tên nhân vật: $name ($class).<br>
				   Relife: $row[14], Reset: $row[0], Level: $row[1], Point chưa cộng: $row[2], Point dự trữ: $row[18], Point Event : $row[15] | Ủy Thác : $uythac, Point Ủy Thác : $row[17], Point Ủy Thác Event : $row[22]<br>
				   Streng: $row[3], Dexterity: $row[4], Vitality: $row[5], Energy: $row[6], Leadership: $row[7] | Reset/Ngày : $resetday, Reset/Tháng : $resetmonth | TOP lúc 0h: $top50<br>
				   Phạm tội: $row[10], Giết người: $row[11]. Trạng thái: $status | Nhân vật đang ở : $map ( $sv[0] ), tọa độ : $row[20],$row[21]<br>
				   Mã khóa đồ: $row[12]. Nhân vật đang: $online.";
                }
            }
        }
        break;
    case "block_char":
        if (empty($name)) {
            $notice = "Chưa điền tên nhân vật cần tìm vào ô trống";
        } else {
            $sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' ");
            $name_check = $sql_name_check->numrows();
            if ($name_check <= 0) {
                $notice = "Không có nhân vật này";
            } else {
                $sql_block_script1 =
                    "update character set ctlcode='99',ErrorSubBlock=99 where name='$name'";
                $sql_block_exec1 = $db->Execute($sql_block_script1);

                $notice = "Nhân vật $name đã bị Block";
            }
        }
        break;
    case "unblock_char":
        if (empty($name)) {
            $notice = "Chưa điền tên nhân vật cần tìm vào ô trống";
        } else {
            $sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' ");
            $name_check = $sql_name_check->numrows();
            if ($name_check <= 0) {
                $notice = "Không có nhân vật này";
            } else {
                $sql_unblock_script1 =
                    "update character set ctlcode='0',ErrorSubBlock=0 where name='$name'";
                $sql_unblock_exec1 = $db->Execute($sql_unblock_script1);

                $notice = "Nhân vật $name đã được bỏ Block";
            }
        }
        break;
    case "kt_acc":
        if (empty($acc)) {
            $notice = "Chưa điền tên tài khoản vào chỗ trống";
        }
        //        elseif ($acc == 'admin') {
        //            $notice = "Tài khoản không được phép kiểm tra";
        //        }
        else {
            $sql_username_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc'");
            $username_check = $sql_username_check->numrows();
            if ($username_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                //Lấy thông tin IP Server
                $ipsv_query = "SELECT IP FROM MEMB_STAT WHERE memb___id='$acc'";
                $ipsv_result = $db->Execute($ipsv_query);
                $ipsv_fetch = $ipsv_result->FetchRow();
                $ipsv = $ipsv_fetch[0];
                
                //Lấy thông tin IP từ Acc
                $query = "select bank,vpoint,mail_addr,memb___id,memb__pwd2,fpas_ques,fpas_answ,pass2,bloc_code,gcoin,tel__numb,time_checksms,ip,gcoin_km, thehe from MEMB_INFO WHERE memb___id='$acc'";
                $result = $db->Execute($query);
                $row = $result->fetchrow();
                if ($row[8] == 1) {
                    $block = 'Đang bị Block';
                } else {
                    $block = 'Không bị Block';
                }
                switch ($row[5]) {
                    case 1:
                        $quest = "Tên con vật yêu thích?";
                        break;
                    case 2:
                        $quest = "Trường cấp 1 của bạn tên gì?";
                        break;
                    case 3:
                        $quest = "Người bạn yêu quý nhất?";
                        break;
                    case 4:
                        $quest = "Trò chơi bạn thích nhất?";
                        break;
                    case 5:
                        $quest = "Nơi để lại kỉ niệm khó quên nhất?";
                        break;
                }
                $hsd = $row[11] + 30 * 24 * 60 * 60;
                $hsd = date('h:i A d/m/Y', $hsd);

                $list_char_query = "SELECT Name, Resets, Relifes FROM Character WHERE AccountID='$acc'";
                $list_char_result = $db->Execute($list_char_query);
                $char = '';
                while($list_char_fetch = $list_char_result->FetchRow()) {
                    if(strlen($char) > 0) $char .= " - ";
                    $char .= "$list_char_fetch[0] (<font color='red'>$list_char_fetch[2]</font>/<font color='blue'>$list_char_fetch[1]</font>)";
                }

                $notice = "<b>Tài khoản</b> : $acc ( IPWeb: $row[12] - IPSV: $ipsv ) . <b>Ngân hàng</b> : $row[9] <strong>Gcoin</strong>, $row[13] <strong>Gcoin Khuyến Mãi</strong>, $row[1] <strong>V.Point</strong>, $row[0] <b>Zen</b>.<br />
                <b>Tình trạng</b> : $block . <strong>Thế hệ</strong> : $row[14] . <b>Hạn sử dụng</b> : $hsd<br> 
                <b>Mật khẩu cấp 1</b> : $row[4] . <b>Mật khẩu cấp 2</b> : $row[7] . <b>Câu hỏi bí mật</b> : $quest - <b>Câu trả lời bí mật</b> : $row[6] <br /> 
                <b>Email</b> : $row[2] . <b>SDT</b> : $row[10] <br />
				<b>Nhân vật</b> : $char";

            }
        }
        break;

    case "giahan_acc":
        if (empty($acc)) {
            $notice = "Chưa kiểm tra tài khoản";
        } else {
            $sql_username_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc'");
            $username_check = $sql_username_check->numrows();
            if ($username_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $time_giahan = 30 * 24 * 60 * 60;
                $giahan_query = "UPDATE MEMB_INFO SET time_checksms=time_checksms+$time_giahan WHERE memb___id='$acc'";
                $giahan_result = $db->Execute($giahan_query) or die("Loi query : $giahan_query");

                $notice = "Gia hạn tài khoản $acc thành công";
            }
        }
        break;

    case "searchip":
        if (empty($ip)) {
            $notice = "Chưa nhập IP";
        } else {
            $query_searchip = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE ip='$ip'");
            echo "Các Tài khoản cùng IP $ip ( Tài khoản ( Nhân vật : <font color=blue>RS</font>/<font color=red>RL</font> ) ) :<br>";
            while ($accip = $query_searchip->fetchrow()) {
                //Lấy dữ liệu nhân vật chính
                $sql_char_check = $db->SelectLimit("Select Name,Resets,Relifes From Character where AccountID='$accip[0]' ORDER BY Relifes DESC, Resets DESC",
                    1, 0);
                $char_check = $sql_char_check->fetchrow();

                $acc_ip[] = $accip[0];
                $char_ip[] = $char_check[0];
                $resets[] = $char_check[1];
                $relifes[] = $char_check[2];
            }
            $num_acc = count($acc_ip);
            $num_loop = (ceil($num_acc / 5)) * 5;
            echo '<table width=100% cellspacing=1 cellpadding=3 border=0 bgcolor=#0000ff>
					<tr bgcolor=#ffffcc>
				';
            for ($i = 0; $i < $num_loop; $i++) {
                if (!empty($acc_ip[$i])) {
                    echo "<td align=center>$acc_ip[$i]<br>$char_ip[$i] : <font color=blue>$resets[$i]</font>/<font color=red>$relifes[$i]</font></td>
					";
                } else
                    echo '<td>&nbsp;</td>
					';
                if (($i > 1) and ($i < $num_loop) and ($i % 5 == 4)) {
                    echo '</tr>
								<tr bgcolor=#ffffcc>';
                }
            }
            echo '</tr></table>';
        }
        break;
     
    case "ipserver":
        $ipsv = $_POST['ipsv'];
        if (empty($ipsv)) {
            $notice = "Chưa nhập IP";
        } else {
            $query_searchip = $db->Execute("SELECT memb___id FROM MEMB_STAT WHERE IP='$ipsv'");
            echo "Các Tài khoản cùng IP $ipsv ( Tài khoản ( Nhân vật : <font color=blue>RS</font>/<font color=red>RL</font> ) ) :<br>";
            while ($accip = $query_searchip->fetchrow()) {
                //Lấy dữ liệu nhân vật chính
                $sql_char_check = $db->SelectLimit("Select Name,Resets,Relifes From Character where AccountID='$accip[0]' ORDER BY Relifes DESC, Resets DESC",
                    1, 0);
                $char_check = $sql_char_check->fetchrow();

                $acc_ip[] = $accip[0];
                $char_ip[] = $char_check[0];
                $resets[] = $char_check[1];
                $relifes[] = $char_check[2];
            }
            $num_acc = count($acc_ip);
            $num_loop = (ceil($num_acc / 5)) * 5;
            echo '<table width=100% cellspacing=1 cellpadding=3 border=0 bgcolor=#0000ff>
					<tr bgcolor=#ffffcc>
				';
            for ($i = 0; $i < $num_loop; $i++) {
                if (!empty($acc_ip[$i])) {
                    echo "<td align=center>$acc_ip[$i]<br>$char_ip[$i] : <font color=blue>$resets[$i]</font>/<font color=red>$relifes[$i]</font></td>
					";
                } else
                    echo '<td>&nbsp;</td>
					';
                if (($i > 1) and ($i < $num_loop) and ($i % 5 == 4)) {
                    echo '</tr>
								<tr bgcolor=#ffffcc>';
                }
            }
            echo '</tr></table>';
        }
        break; 
     
    case "block_acc":
        if (empty($acc)) {
            $notice = "Chưa điền tên tài khoản vào chỗ trống";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();
            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $sql_block_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$loginname' and bloc_code='1' AND admin_block='1'");
                $block_check = $sql_block_check->numrows();

                if ($block_check > 0) {
                    $notice = "Tài khoản này đang bị Block";
                    exit();
                } else {
                    $sql_blockacc_query =
                        "Update MEMB_INFO set [bloc_code]='1',admin_block='1' where memb___id='$acc'";
                    $sql_blockacc_results = $db->Execute($sql_blockacc_query);

                    $notice = "Đã block tài khoản $acc thành công";
                }
            }
        }
        break;
    case "unblock_acc":
        if (empty($acc)) {
            $notice = "Chưa điền tên tài khoản vào chỗ trống";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();
            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $sql_block_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$loginname' and bloc_code='0'");
                $block_check = $sql_block_check->numrows();

                if ($block_check > 0) {
                    $notice = "Tài khoản này không bị bị Block";
                    exit();
                } else {
                    $sql_blockacc_query =
                        "Update MEMB_INFO set [bloc_code]='0',admin_block='0' where memb___id='$acc'";
                    $sql_blockacc_results = $db->Execute($sql_blockacc_query);

                    $notice = "Đã bỏ block tài khoản $acc thành công";
                }
            }
        }
        break;
    case "bank_add":
        if (empty($acc)) {
            $notice = "Chưa điền tên tài khoản vào chỗ trống";
        } elseif ((!preg_match("/^[0-9]*$/i", $zen))) {
            $notice = "Zen cộng thêm chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $vpoint))) {
            $notice = "V.Point cộng thêm chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $gcoin))) {
            $notice = "Gcoin cộng thêm chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $gcoin_km))) {
            $notice = "Gcoin khuyến mãi cộng thêm chỉ được sử dụng số";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();
            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $query = "select bank,vpoint,gcoin,gcoin_km from MEMB_INFO WHERE memb___id='$acc'";
                $result = $db->Execute($query);
                $row = $result->fetchrow();

                $zend_cong = $row[0] + $zen;
                $vpoint_cong = $row[1] + $vpoint;
                $gcoin_cong = $row[2] + $gcoin;
                $gcoin_km_cong = $row[3] + $gcoin_km;

                $sql_script = "Update MEMB_INFO set [gcoin]=$gcoin_cong,[gcoin_km]=$gcoin_km_cong, [bank]=$zend_cong,[vpoint]=$vpoint_cong where memb___id='$acc'";
                $sql_exec = $db->Execute($sql_script) or die("Query Error : $sql_script");

                $notice = "Tài khoản $acc đã cộng thêm: $gcoin Gcoin, $gcoin_km Gcoin khuyến mãi, $vpoint V.Point, $zen Zen  trong ngân hàng";
            }
        }
        break;
    case "bank_tru":
        if (empty($acc)) {
            $notice = "Chưa điền tên tài khoản vào chỗ trống";
        } elseif ((!preg_match("/^[0-9]*$/i", $zen))) {
            $notice = "Zen trừ đi chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $vpoint))) {
            $notice = "V.Point trừ đi chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $gcoin))) {
            $notice = "Gcoin trừ đi chỉ được sử dụng số";
        } elseif ((!preg_match("/^[0-9]*$/i", $gcoin_km))) {
            $notice = "Gcoin khuyến mãi trừ đi chỉ được sử dụng số";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();
            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $query = "select bank,vpoint,gcoin,gcoin_km from MEMB_INFO WHERE memb___id='$acc'";
                $result = $db->Execute($query);
                $row = $result->fetchrow();

                $zen_tru = $row[0] - $zen;
                $vpoint_tru = $row[1] - $vpoint;
                $gcoin_tru = $row[2] - $gcoin;
                $gcoin_km_tru = $row[3] - $gcoin_km;

                if ($bank < 0) {
                    $notice = "Không đủ Zen trong ngân hàng để trừ";
                } elseif ($vpoint_tru < 0) {
                    $notice = "Không đủ V.Point trong ngân hàng để trừ";
                } elseif ($gcoin_tru < 0) {
                    $notice = "Không đủ Gcoin để trừ";
                } elseif ($gcoin_km_tru < 0) {
                    $notice = "Không đủ Gcoin khuyến mãi để trừ";
                } else {
                    $sql_script = "Update MEMB_INFO set [gcoin]=$gcoin_tru, [gcoin_km]=$gcoin_km_tru, [vpoint]=$vpoint_tru, [bank]=$zen_tru where memb___id='$acc'";
                    $sql_exec = $db->Execute($sql_script) or die("Query Error : $sql_script");

                    $notice = "Tài khoản $acc đã trừ đi: $gcoin Gcoin, $gcoin_km Gcoin khuyến mãi, $vpoint V.Point trong ngân hàng";
                }
            }
        }
        break;

    case "khoado_khoa":
        if (empty($name)) {
            $notice = "Chưa điền tên nhân vật cần khóa vào ô trống";
        } else {
            $sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' ");
            $name_check = $sql_name_check->numrows();
            if ($name_check <= 0) {
                $notice = "Không có nhân vật này";
            } else {
                $sql_khoa_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and khoado='1' and makhoado='adminkhoa'");
                $khoa_check = $sql_khoa_check->numrows();

                if ($khoa_check > 0) {
                    $notice = "Nhân vật $name đang bị Admin khóa";
                } else {
                    $sql_khoado = "UPDATE Character SET CtlCode='18', khoado='1', makhoado='adminkhoa' WHERE Name='$name'";
                    $rs_khoado = $db->Execute($sql_khoado) or die("Lỗi Query: $sql_khoado");

                    $notice = "Nhân vật $name đã được Admin khóa đồ";
                }
            }
        }
        break;

    case "khoado_mo":
        if (empty($name)) {
            $notice = "Chưa điền tên nhân vật cần khóa vào ô trống";
        } else {
            $sql_name_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' ");
            $name_check = $sql_name_check->numrows();
            if ($name_check <= 0) {
                $notice = "Không có nhân vật này";
            } else {
                $sql_khoa_check = $db->Execute("SELECT Name FROM Character WHERE Name='$name' and khoado='0'");
                $khoa_check = $sql_khoa_check->numrows();

                if ($khoa_check > 0) {
                    $notice = "Nhân vật $name không bị khóa";
                } else {
                    $sql_mokhoado = "UPDATE Character SET CtlCode='0', khoado='0', makhoado='0' WHERE Name='$name'";
                    $rs_mokhoado = $db->Execute($sql_mokhoado) or die("Lỗi Query: $sql_mokhoado");

                    $notice = "Nhân vật $name đã được mở khóa đồ";
                }
            }
        }
        break;

    case "change_email":
        $email = $_POST['email'];
        if (empty($acc)) {
            $notice = "Chưa điền tài khoản cần đổi Email vào ô trống";
        } elseif (empty($email)) {
            $notice = "Chưa điền Email cần đổi vào ô trống";
        } elseif (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[\.a-z]{2,6}$/i", $email)) {
            $notice = "Không đúng dạng Email";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();

            $email_check_query = $db->Execute("SELECT mail_addr FROM MEMB_INFO WHERE mail_addr='$email' ");
            $email_check = $email_check_query->numrows();

            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } elseif ($email_check > 0) {
                $notice = "Email đã có người sử dụng";
            } else {
                $sql_change_email = "UPDATE MEMB_INFO SET mail_addr='$email' WHERE memb___id='$acc'";
                $rs_change_email = $db->Execute($sql_change_email) or die("Lỗi Query: $sql_change_email");

                $notice = "Tài khoản $acc đã đổi Email thành : $email ";
            }
        }
        break;

    case "change_quest":
        $quest = $_POST['quest'];
        $ans = $_POST['ans'];
        if (empty($acc)) {
            $notice = "Chưa điền tài khoản cần đổi Câu hỏi - Câu trả lời vào ô trống";
        } elseif (empty($quest) || $quest < 1) {
            $notice = "Chưa chọn câu hỏi bí mật";
        } elseif (empty($ans)) {
            $notice = "Chưa nhập câu trả lời";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();

            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } else {
                $sql_change_quest = "UPDATE MEMB_INFO SET fpas_ques='$quest', fpas_answ='$ans' WHERE memb___id='$acc'";
                $rs_change_quest = $db->Execute($sql_change_quest) or die("Lỗi Query: $sql_change_quest");

                $notice = "Đổi câu hỏi & câu trả lời cho tài khoản $acc thành công";
            }
        }
        break;

    case "change_sdt":
        $sdt = $_POST['sdt'];
        if (empty($acc)) {
            $notice = "Chưa điền tài khoản cần đổi SDT vào ô trống";
        } elseif (empty($sdt)) {
            $notice = "Chưa điền SDT vào ô trống";
        } elseif (!preg_match("/^[0-9]*$/i", $sdt)) {
            $notice = "SDT chỉ được sử dụng số";
        } else {
            $sql_loginname_check = $db->Execute("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc' ");
            $loginname_check = $sql_loginname_check->numrows();

            $sdt_length = strlen($sdt);
            $sdt_check = substr($sdt, 0, 2);

            if ($loginname_check <= 0) {
                $notice = "Không tồn tại tài khoản $acc";
            } elseif (($sdt_check == '09' && $sdt_length == 10) || ($sdt_check == '01' && $sdt_length ==
            11)) {
                $sql_change_sdt = "UPDATE MEMB_INFO SET tel__numb='$sdt' WHERE memb___id='$acc'";
                $rs_change_sdt = $db->Execute($sql_change_sdt) or die("Lỗi Query: $sql_change_sdt");

                $notice = "Tài khoản $acc đã đổi SDT thành $sdt";
            } else {
                $notice = "SDT phải là số điện thoại di động";
            }
        }
    break;

    case 'reset_event1':
        $thehe = $_POST['thehe'];   $thehe = abs(intval($thehe));
        if($thehe == 99) {
            $reset_event1_query = "Update Character SET event1_type1=0, event1_type2=0, event1_type3=0 FROM Character JOIN MEMB_INFO ON event1_type1>0 OR event1_type2>0 OR event1_type3>0";
        } else {
            $reset_event1_query = "Update Character SET event1_type1=0, event1_type2=0, event1_type3=0 FROM Character JOIN MEMB_INFO ON event1_type1>0 OR event1_type2>0 OR event1_type3>0 AND thehe=$thehe";
        }
        
        $reset_event1_result = $db->Execute($reset_event1_query);
        $notice = "Đã kết thúc Event đổi Item sang Point của Thế hệ $thehe_choise[$thehe]";
    break;
        
    case 'reset_epitem':
        $thehe = $_POST['thehe'];   $thehe = abs(intval($thehe));
         if($thehe == 99) {
            $reset_event_epitem_query = "TRUNCATE TABLE EventEpItem";
        } else {
            $reset_event_epitem_query = "DELETE EventEpItem FROM EventEpItem JOIN MEMB_INFO ON EventEpItem.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$thehe";
        }
        
        $reset_event_epitem_result = $db->Execute($reset_event_epitem_query);

        $notice = "Đã kết thúc Event Ép Item của Thế hệ $thehe_choise[$thehe]";
    break;
        
}

if (isset($notice)) {
    echo "<blockquote>" . $notice . "</blockquote>";
}
?>
<body bgcolor="#F9E7CF">
<?php require ('linktop.php'); ?>
<TABLE cellSpacing=0 width=100% border=0>
<!-- Quan ly nhan vat -->
	<TR>
		<TD colspan="3">
			<table>
				<tr>
					<td align="center" width="15%">Xử lý nhân vật</td>
					<td align="center" width="40%">
						<form name='search_char' method='post' action=''>
			                <input type="text" name="name" id="name" maxlength=10 size="20"  value="<?php echo
$_POST[name]; ?>">
							<input type='hidden' name='action' id='action' value='search_char'>
			                <input type="submit" name="Submit" value="Kiểm tra">
			              </form>
					</td>
					<td align="center">
						<form name='block_char' method='post' action=''>
			                <input type='hidden' name='name' id='name' value='<?php echo
$_POST[name]; ?>'>
			                <input type='hidden' name='action' id='action' value='block_char'>
			                <input type="submit" name="Submit" value="Block">
			              </form>
					</td>
					<td align="center">
						<form name='unblock_char' method='post' action=''>
			                <input type='hidden' name='name' id='name' value='<?php echo
$_POST[name]; ?>'>
			                <input type='hidden' name='action' id='action' value='unblock_char'>
			                <input type="submit" name="Submit" value="Bỏ Block">
			              </form>
					</td>
					<td align="center">
						<form name='khoado_khoa' method='post' action=''>
			                <input type='hidden' name='name' id='name' value='<?php echo
$_POST[name]; ?>'>
			                <input type='hidden' name='action' id='action' value='khoado_khoa'>
			                <input type="submit" name="Submit" value="Khóa đồ">
			              </form>
					</td>
					<td align="center">
						<form name='khoado_mo' method='post' action=''>
			                <input type='hidden' name='name' id='name' value='<?php echo
$_POST[name]; ?>'>
			                <input type='hidden' name='action' id='action' value='khoado_mo'>
			                <input type="submit" name="Submit" value="Mở khóa đồ">
			              </form>
					</td>
				</tr>
			</table>
		</TD>
	</TR>

<!-- Quan ly tai khoan -->

	<TR>
		<TD align=left colspan="3">
			<table>
				<tr>
					<TD width="15%">Xử lý tài khoản</TD>
					<td align="center" width="40%">
						<form name='kt_acc' method='post' action=''>
			                <input type="text" name="acc" maxlength=10 size="20" value="<?php echo
$_POST[acc]; ?>">
			                <input type='hidden' name='action' id='action' value='kt_acc'>
			                <input type="submit" name="Submit" value="Kiểm tra">
			              </form>
					</td>
					<td align="center">
						<form name='block_acc' method='post' action=''>
			                <input type='hidden' name='acc' id='acc' value='<?php echo $_POST[acc]; ?>'>
			                <input type='hidden' name='action' id='action' value='block_acc'>
			                <input type="submit" name="Submit" value="Block Acc">
			              </form>
					</td>
					<td align="center">
						<form name='unblock_acc' method='post' action=''>
			                <input type='hidden' name='acc' id='acc' value='<?php echo $_POST[acc]; ?>'>
			                <input type='hidden' name='action' id='action' value='unblock_acc'>
			                <input type="submit" name="Submit" value="UnBlock Acc">
			              </form>
					</td>
					<td align="center">
						<form name='giahan_acc' method='post' action=''>
			              	<input type='hidden' name='acc' id='acc' value='<?php echo $_POST[acc]; ?>'>
			                <input type='hidden' name='action' id='action' value='giahan_acc'>
			                <input type="submit" name="Submit" value="Gia hạn Acc">
			              </form>
					</td>
				</tr>
			</table>
		</TD>
	</TR>

<!-- End Quan ly tai khoan -->

<!-- Khóa đồ -->


	<TR>
		<TD align=left colspan="2">
			<div align="center">
              <form name='IPWeb' method='post' action=''>
              	Tìm IP Web
                <input type="text" name="ip" maxlength=15 size="20" value="<?php echo
$_POST[ip]; ?>">
                <input type='hidden' name='action' id='action' value='searchip'>
                <input type="submit" name="Submit" value="Tìm IP Web">
              </form>
            </div>
		</TD>
        <TD align=left >
			<div align="center">
              <form name='IPServer' method='post' action=''>
              	Tìm IP Server
                <input type="text" name="ipsv" maxlength=15 size="20" value="<?php echo
$_POST['ipsv']; ?>">
                <input type='hidden' name='action' id='action' value='ipserver'>
                <input type="submit" name="Submit" value="Tìm IP Server">
              </form>
            </div>
		</TD>
	</TR>

<TR>
		<TD align=middle>
			Đổi Email
		</TD>
		<TD align=middle>
			Đổi câu hỏi - Câu trả lời bí mật
		</TD>
		<TD align=middle>
			Đổi SĐT
		</TD>
	</TR>
	<TR>
		<TD align=left>
			<div align="center">
              <form name='change_email' method='post' action=''>
                Acc : <input type="text" name="acc" maxlength=10 size="12" value="<?php echo
$_POST[acc]; ?>"><br>
    			Email mới : <input type="text" name="email" size="12""><br>
                <input type='hidden' name='action' id='action' value='change_email'>
                <input type="submit" name="Submit" value="Đổi Email">
              </form>
            </div>
		</TD>
		<TD align=left>
			<div align="center">
              <form name='change_quest' method='post' action=''>
                Acc : <input type="text" name="acc" maxlength=10 size="15" value="<?php echo
$_POST[acc]; ?>"><br>
                Câu hỏi mới : <select name="quest">
							    <option>- Chọn câu hỏi bí mật -</option>
							    <option value="1">Tên con vật yêu thích?</option>
							    <option value="2">Trường cấp 1 của bạn tên gì?</option>
							    <option value="3">Người bạn yêu quý nhất?</option>
							    <option value="4">Trò chơi bạn thích nhất?</option>
							    <option value="5">Nơi để lại kỉ niệm khó quên nhất?</option>
							  </select><br>
                Trả lời mới : <input type="text" name="ans" maxlength=10 size="20""><br>
                <input type='hidden' name='action' id='action' value='change_quest'>
                <input type="submit" name="Submit" value="Đổi">
              </form>
            </div>
		</TD>
		<TD align=left>
			<div align="center">
              <form name='change_sdt' method='post' action=''>
                Acc : <input type="text" name="acc" maxlength=15 size="15" value="<?php echo
$_POST[acc]; ?>"><br>
                Số ĐT mới : <input type="text" name="sdt" maxlength=15 size="15""><br>
                <input type='hidden' name='action' id='action' value='change_sdt'>
                <input type="submit" name="Submit" value="Đổi SDT">
              </form>
            </div>
		</TD>
	</TR>
<!-- End Khóa đồ -->

	<TR>
		<TD colspan="3" align=middle>
			Thêm Gcoin, Vpoint, Zen Bank cho tài khoản
		</TD>
	</TR>
	<TR>
		<TD colspan="3" align=left>
			<div align="center">
              <form name='bank_add' method='post' action=''>
                Acc : <input type="text" name="acc" maxlength=10 size="10" value="<?php echo
$_POST[acc]; ?>"> + 
				Gcoin : <input type="text" name="gcoin" value="0" maxlength=20 size="6"> + 
                Gcoin Khuyến Mãi : <input type="text" name="gcoin_km" value="0" maxlength=20 size="6"> + 
                V.Point : <input type="text" name="vpoint" value="0" maxlength=20 size="6"> +
                Zen Bank : <input type="text" name="zen" value="0" maxlength=20 size="10">
				<input type='hidden' name='action' id='action' value='bank_add'>
                <input type="submit" name="Submit" value="Cộng Bank">
              </form>
            </div>
		</TD>
	</TR>
	<TR>
		<TD colspan="3" align=middle>
			Trừ Gcoin, V.Point, Zen Bank cho tài khoản
		</TD>
	</TR>
	<TR>
		<TD colspan="3" align=left>
			<div align="center">
              <form name='bank_tru' method='post' action=''>
                Acc : <input type="text" name="acc" maxlength=10 size="20" value="<?php echo
$_POST[acc]; ?>"> - 
				Gcoin : <input type="text" name="gcoin" value="0" maxlength=20 size="6"> -
                Gcoin Khuyến Mãi : <input type="text" name="gcoin_km" value="0" maxlength=20 size="6"> -
                V.Point : <input type="text" name="vpoint" value="0" maxlength=20 size="6"> - 
                Zen Bank : <input type="text" name="zen" value="0" maxlength=20 size="10"> 
				<input type='hidden' name='action' id='action' value='bank_tru'>
                <input type="submit" name="Submit" value="Trừ Bank">
              </form>
            </div>
		</TD>
	</TR>
	<TR>
		<TD colspan="3" align=left>
		<hr>
			<div align="center">
              
              <form name='bank_tru' method='post' action=''>
                Kết thúc Event <b>Ép Item (Truyền Nhân Goblin)</b>
                Thế hệ 
                <select name="thehe">
                    <option value='99'>Tất cả</option>
                    <?php 
                        for($i=1; $i<count($thehe_choise); $i++) {
                            if(strlen($thehe_choise[$i]) > 0) {
                                echo "<option value='$i'>$thehe_choise[$i]</option>";
                            }
                        }
                    ?>
                </select>
				<input type='hidden' name='action' id='action' value='reset_epitem'>
                <input type="submit" name="Submit" value="Kết thúc">
              </form>
            </div>
		</TD>
	</TR>
</TABLE>	
</BODY></HTML>
<?php
$db->Close();
?>