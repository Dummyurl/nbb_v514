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
include ('config/config_thehe.php');
include_once ('function.php');

$login = $_POST['login'];
$opd = $_POST['opd'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    $string_login = $_POST['string_login'];
    checklogin($login,$string_login);
    
    $opd_md5 = md5($opd);
    $timeallow = $timestamp - 24*60*60;
    $opd_query = "SELECT opd,time  FROM OnePassDay WHERE acc='$login'";
    $opd_result = $db->Execute($opd_query);
        check_queryerror($opd_query, $opd_result);
    $opd_exists = $opd_result->NumRows();
    if($opd_exists == 0) {
        $notice = "Tài khoản chưa khởi tạo Mật khẩu OPD.<br />Vui lòng tạo mật khẩu OPD.";
    } else {
        $opd_fetch = $opd_result->FetchRow();
        if($opd_fetch[1] < $timeallow) {
            $notice = "Mật khẩu OPD đã hết thời gian hiệu lực.<br />Vui lòng lấy Mật khẩu OPD mới.";
        } else if($opd_fetch[0] != $opd_md5) {
            $notice = "Mật khẩu OPD không chính xác.";
        } else {
            $kick_datachk_q = "SELECT * FROM NBB_Kick_DIS WHERE acc='$login' AND status=0";
            $kick_datachk_r = $db->Execute($kick_datachk_q);
                check_queryerror($kick_datachk_q, $kick_datachk_r);
            $kick_datachk_f = $kick_datachk_r->FetchRow();
            if($kick_datachk_f[0] > 0) {
                $notice = "OK";
            } else {
                $kick_ins_q = "INSERT INTO NBB_Kick_DIS (acc, time_created) VALUES ('$login', $timestamp)";
                $kick_ins_r = $db->Execute($kick_ins_q);
                    check_queryerror($kick_ins_q, $kick_ins_r);
                $notice = "OK";
            }
        }
    }

    echo $notice;
} else echo "Error";

$db->Close();
?>