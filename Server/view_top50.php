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
include_once("function.php");
include("config/config_thehe.php");

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {

_top50();

    $thehe = $_POST['thehe'];
    
    $Top50_data_arr = array();
    if(strlen($thehe_choise[$thehe]) > 1) {
        $top50_query = "SELECT Name, NBB_Relifes_0h, NBB_Resets_0h, Class, Top50 FROM Character JOIN MEMB_INFO ON Character.AccountID = MEMB_INFO.memb___id AND thehe=$thehe AND Top50>0 ORDER BY Top50";
        $top50_result = $db->Execute($top50_query);
            check_queryerror($top50_query, $top50_result);
            
        while($top50_fetch = $top50_result->FetchRow()) {
            $name = $top50_fetch[0];
            $relife = $top50_fetch[1];
            $reset = $top50_fetch[2];
            $class = $top50_fetch[3];
            $top50 = $top50_fetch[4];
            
            $Top50_data_arr[$thehe][$top50] = array(
                'name'  =>  $name,
                'relife'    =>  $relife,
                'reset' =>  $reset,
                'class' =>  $class,
                'top50' =>  $top50
            );
        }
        
        $Top50_data_arr[$thehe]['timeget'] = _time();
    }
    
    $Top50_data = serialize($Top50_data_arr);
    echo "<nbb>OK<nbb>" . $Top50_data . "<nbb>";
}
$db->Close();
?>