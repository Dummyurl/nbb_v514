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
 
include('config.php');
include('function.php');

$action = $_GET['action'];

switch ($action){ 
	case 'kick':
        $acc_kick_q = "SELECT TOP 1 stt, acc FROM NBB_Kick_DIS WHERE status=0 ORDER BY stt";
        $acc_kick_r = $db->Execute($acc_kick_q);
            check_queryerror($acc_kick_q, $acc_kick_r);
        $acc_kick_chk = $acc_kick_r->NumRows();
        if($acc_kick_chk > 0) {
            $acc_kick_f = $acc_kick_r->FetchRow();
            echo "<stat>OK</stat><stt>". $acc_kick_f[0] ."</stt><acc>". $acc_kick_f[1] ."</acc>";
        } else {
            echo "<stat>None</stat>";
        }
            
	break;

	case 'kicked':
        $stt = abs(intval($_GET['stt']));
        $acc_kicked_q = "UPDATE NBB_Kick_DIS SET status=1, time_kick={$timestamp} WHERE stt={$stt} AND status=0";
        $acc_kicked_r = $db->Execute($acc_kicked_q);
            check_queryerror($acc_kicked_q, $acc_kicked_r);
	break;

	default :
}



$db->Close();
?>