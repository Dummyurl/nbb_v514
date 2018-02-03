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
include_once("config.php");
include ('config/config_thehe.php');

$slg_top = 20;

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    $toppoint_arr = array();
    for($i=1;$i<count($thehe_choise);$i++) {
        if(strlen($thehe_choise[$i]) > 1) {
            $toppoint_q = "SELECT TOP $slg_top Name, point_total, point_rs, point_rsday, point_event, point_songtu, point_tuluyen FROM nbb_toppoint JOIN MEMB_INFO ON point_total>0 AND nbb_toppoint.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i ORDER BY point_total DESC";
            $toppoint_r = $db->Execute($toppoint_q);
                check_queryerror($toppoint_q, $toppoint_r);
            while($toppoint_f = $toppoint_r->FetchRow()) {
                $toppoint_arr[$i][] = array(
                    'name'  => $toppoint_f[0],
                    'total'   =>  $toppoint_f[1],
                    'rs'   =>  $toppoint_f[2],
                    'rsday'   =>  $toppoint_f[3],
                    'event'   =>  $toppoint_f[4],
                    'songtu'   =>  $toppoint_f[5],
                    'tuluyen'   =>  $toppoint_f[6]
                );
            }
        }
    }
    
    $toppoint_data = json_encode($toppoint_arr);
    echo "<info>OK</info><toppoint>$toppoint_data</toppoint>";
}
$db->Close();
?>