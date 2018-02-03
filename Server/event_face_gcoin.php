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
 
 /**
  * Query Event
CREATE TABLE [NBB_Event_Face_Gcoin] (
    [acc] [varchar] (10) NOT NULL ,
	[fid] [bigint] NOT NULL ,
	[gcoin] [int] NOT NULL DEFAULT (0) ,
	[gcoin_km] [int] NOT NULL DEFAULT (0) ,
	[vpoint] [int] NOT NULL DEFAULT (0) ,
	[date] [smalldatetime] NOT NULL DEFAULT (2013-01-01) ,
    [time] [int] NOT NULL DEFAULT (0)
) ON [PRIMARY]
GO
  */
 
	include_once("security.php");
include_once('config.php');
include_once('function.php');

// Phan thuong
$gcoin = 0;
$gcoin_km = 10000;
$vpoint = 0;
$date_start = "2013-06-09";     // Type : YYYY-MM-DD    Năm-Tháng-Ngày
$date_end = "2013-06-20";       // Type : YYYY-MM-DD    Năm-Tháng-Ngày

$fid = $_POST['fid'];
$muacc = $_POST['muacc'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    $time_start = strtotime($date_start);
    $time_end = strtotime($date_end) + 24*60*60;
    if($timestamp < $time_start) {
        echo "Chưa đến thời gian tham gia Event";
    } elseif ($timestamp > $time_end) {
        echo "Đã hết thời gian tham gia Event.";
    } else {
        $check_received_query = "SELECT acc FROM NBB_Event_Face_Gcoin WHERE fid='$fid' AND time >= $time_start AND time <= $time_end";
        $check_received_result = $db->Execute($check_received_query);
            check_queryerror($check_received_query, $check_received_result);
        $check_received = $check_received_result->NumRows();
        if($check_received > 0) {
            $check_received_fetch = $check_received_result->FetchRow();
            $acc_received = $check_received_fetch['acc'];
            echo "Bạn đã nhận Event cho tài khoản <strong>$acc_received</strong>. Không thể nhận 2 lần.";
        } else {
            $check_acc_query = "SELECT * FROM MEMB_INFO WHERE memb___id='$muacc'";
            $check_acc_result = $db->Execute($check_acc_query);
                check_queryerror($check_acc_query, $check_acc_result);
            $check_acc = $check_acc_result->NumRows();
            if($check_acc == 0) {
                echo "Tài khoản <strong>$muacc</strong> không tồn tại.";
            } else {
                // Write Log
                $log_received_query = "INSERT INTO NBB_Event_Face_Gcoin (acc, fid, gcoin, gcoin_km, vpoint, date, time) VALUES ('$muacc', $fid, $gcoin, $gcoin_km, $vpoint, DATEADD(day, DATEDIFF(day, 0, GETDATE()), 0), $timestamp)";
                $log_received_result = $db->Execute($log_received_query);
                    check_queryerror($log_received_query, $log_received_result);
                
                // Add Money
                $money_add_query = "UPDATE MEMB_INFO SET gcoin=gcoin+$gcoin, gcoin_km=gcoin_km+$gcoin_km, vpoint=vpoint+$vpoint WHERE memb___id='$muacc'";
                $money_add_result = $db->Execute($money_add_query);
                    check_queryerror($money_add_query, $money_add_result);
                
                echo "<nbb>OK<nbb>";
            }
        } 
    }

}
$db->Close();
?>