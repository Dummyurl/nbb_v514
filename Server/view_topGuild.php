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

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    _guild_xh();
    
$slg_top = 20;
$thehe_query = "";
foreach($thehe_choise as $thehe_key => $thehe_val) {
    if(strlen($thehe_val) > 0) {
        if(strlen($thehe_query) > 0) $thehe_query .= ",";
        $thehe_query .= $thehe_key;
    }
}

    // TOP GULD Point
    $GuildPoint_q = "SELECT TOP 20 G_NAME, G_Master, G_PointTotal, G_SlgMem, G_RSTotal FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .") ORDER BY G_PointTotal DESC";
    $GuildPoint_r = $db->Execute($GuildPoint_q);
        check_queryerror($GuildPoint_q, $GuildPoint_r);
    
    $count_guildmember = 0;    
    while($GuildPoint_f = $GuildPoint_r->FetchRow()) {
        $G_Name = $GuildPoint_f[0];
        $G_Master = $GuildPoint_f[1];
        $G_PointTotal = $GuildPoint_f[2];
        $G_SlgMem = $GuildPoint_f[3];
        $G_RSTotal = $GuildPoint_f[4];
        
        $GTop['Point'][$count_guildmember]['GName'] = $G_Name;
        $GTop['Point'][$count_guildmember]['GMaster'] = $G_Master;
        $GTop['Point'][$count_guildmember]['PointTotal'] = $G_PointTotal;
        $GTop['Point'][$count_guildmember]['SlgMem'] = $G_SlgMem;
        $GTop['Point'][$count_guildmember]['RSTotal'] = $G_RSTotal;
        
        $count_guildmember++;
    }
	
    // TOP GULD RESET
    $GuildReset_q = "SELECT TOP 20 G_NAME, G_Master, G_PointTotal, G_SlgMem, G_RSTotal FROM Guild JOIN Character ON Guild.G_Master collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN (". $thehe_query .") ORDER BY G_RSTotal DESC";
    $GuildReset_r = $db->Execute($GuildReset_q);
        check_queryerror($GuildReset_q, $GuildReset_r);
    
    $count_guildreset = 0;
    while($GuildReset_f = $GuildReset_r->FetchRow()) {
        $G_Name = $GuildReset_f[0];
        $G_Master = $GuildReset_f[1];
        $G_PointTotal = $GuildReset_f[2];
        $G_SlgMem = $GuildReset_f[3];
        $G_RSTotal = $GuildReset_f[4];
        
        $GTop['RS'][$count_guildreset]['GName'] = $G_Name;
        $GTop['RS'][$count_guildreset]['GMaster'] = $G_Master;
        $GTop['RS'][$count_guildreset]['PointTotal'] = $G_PointTotal;
        $GTop['RS'][$count_guildreset]['SlgMem'] = $G_SlgMem;
        $GTop['RS'][$count_guildreset]['RSTotal'] = $G_RSTotal;
        
        $count_guildreset++;
    }
	
	$data_gtop = json_encode($GTop);
	
	echo "<nbb>$data_gtop</nbb>";
}
$db->Close();
?>