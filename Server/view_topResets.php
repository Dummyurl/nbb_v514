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
include("config/config_thehe.php");
$top_type = $_POST['top_type'];
if(empty($top_type)){ $top_type = ''; }
$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
	for($i=1;$i<count($thehe_choise);$i++) {
	   if(strlen($thehe_choise[$i]) > 1) {
            if($top_type == 'DW' || $top_type == 'DK' || $top_type == 'ELF' || $top_type == 'MG' || $top_type == 'DL' || $top_type == 'SuM' || $top_type == 'RF') {
            	$query = "SELECT TOP 20 ";
            } else {
            	$query = "SELECT TOP 50 ";
            }
            
            $query .= "Name,Class,relifes,Resets, cLevel, DGT_Time FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." ";
            
            switch($top_type)
            {
                case 'DW': $query .= "AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;
                case 'DK': $query .= "AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;
                case 'ELF': $query .= "AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;
                case 'MG': $query .= "AND (Class = 48 OR Class = 49  OR Class = 50) "; break;
                case 'DL': $query .= "AND (Class = 64 OR Class = 65  OR Class = 66) "; break;
                case 'SuM': $query .= "AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;
                case 'RF': $query .= "AND (Class = 96 OR Class = 97 OR Class = 98) "; break;
            }
            
            $query .= "ORDER BY relifes DESC, resets DESC , cLevel DESC, Resets_Time";
            $result = $db->Execute($query);
            $stt = 0;
            while($row = $result->fetchrow()) 	{
                ++$stt;
                $name = $row[0];
                $class = $row[1];
                $relife = $row[2];
                $reset = $row[3];
                $level = $row[4];
                $dgt_time = $row[5];
                    if($dgt_time > 0) $dgt_time = date('d/m H:i:s', $dgt_time);
                    else $dgt_time = '';
                $thehe = $i;
            
           	    echo "$name<nbb>$class<nbb>$relife<nbb>$reset<nbb>$level<nbb>$dgt_time<nbb>$thehe<nbb>\n";
            
            }
        }
    }
}
$db->Close();
?>