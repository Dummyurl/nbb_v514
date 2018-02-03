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
    $topsongtu_arr = array();
    for($i=1;$i<count($thehe_choise);$i++) {
        if(strlen($thehe_choise[$i]) > 1) {
            $topsongtu_q = "SELECT TOP $slg_top Name, nbbsongtu_lv, SCFMarryHusbandWife FROM Character JOIN MEMB_INFO ON SCFMarried=1 AND Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i ORDER BY nbbsongtu_lv DESC, nbbsongtu_exp DESC, nbbsongtu_cp DESC";
            $topsongtu_r = $db->Execute($topsongtu_q);
                check_queryerror($topsongtu_q, $topsongtu_r);
            while($topsongtu_f = $topsongtu_r->FetchRow()) {
                $topsongtu_arr[$i][] = array(
                    'name'  => $topsongtu_f[0],
                    'songtu_lv' =>  $topsongtu_f[1],
                    'vochong'   =>  $topsongtu_f[2]
                );
            }
        }
    }
    
    $topsongtu_data = json_encode($topsongtu_arr);
    echo "<info>OK</info><topsongtu>$topsongtu_data</topsongtu>";
}
$db->Close();
?>