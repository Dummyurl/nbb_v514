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
    $toptuluyen_arr = array();
    for($i=1;$i<count($thehe_choise);$i++) {
        if(strlen($thehe_choise[$i]) > 1) {
            $toptuluyen_q = "SELECT TOP $slg_top Name, nbbtuluyen_str_point, nbbtuluyen_agi_point, nbbtuluyen_vit_point, nbbtuluyen_ene_point, (nbbtuluyen_str_point + nbbtuluyen_agi_point + nbbtuluyen_vit_point + nbbtuluyen_ene_point) FROM Character JOIN MEMB_INFO ON (nbbtuluyen_str_point + nbbtuluyen_agi_point + nbbtuluyen_vit_point + nbbtuluyen_ene_point)>0 AND Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i ORDER BY (nbbtuluyen_str_point + nbbtuluyen_agi_point + nbbtuluyen_vit_point + nbbtuluyen_ene_point) DESC";
            $toptuluyen_r = $db->Execute($toptuluyen_q);
                check_queryerror($toptuluyen_q, $toptuluyen_r);
            while($toptuluyen_f = $toptuluyen_r->FetchRow()) {
                $toptuluyen_arr[$i][] = array(
                    'name'  => $toptuluyen_f[0],
                    'str'   =>  $toptuluyen_f[1],
                    'agi'   =>  $toptuluyen_f[2],
                    'vit'   =>  $toptuluyen_f[3],
                    'ene'   =>  $toptuluyen_f[4],
                    'all'   =>  $toptuluyen_f[5]
                );
            }
        }
    }
    
    $toptuluyen_data = json_encode($toptuluyen_arr);
    echo "<info>OK</info><toptuluyen>$toptuluyen_data</toptuluyen>";
}
$db->Close();
?>