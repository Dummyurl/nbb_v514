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
include_once('config/config_event.php');

$action = $_POST['action'];
$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    switch ($action)
    {
	case 'view_toprs':
		for($i=1; $i<count($thehe_choise); $i++) {
            if(strlen($thehe_choise[$i]) > 0) {
                $query = "SELECT name, SUM(reset_score) FROM Event_TOP_RS JOIN MEMB_INFO ON Event_TOP_RS.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i AND [time] >= '$event_toprs_begin' AND [time] <= '$event_toprs_end' GROUP BY name ORDER BY SUM(reset_score) DESC";
        		$result = $db->SelectLimit($query, 30, 0);
                
        		while($row = $result->fetchrow()) 	{
        			echo "$row[0]<nbb>$row[1]<nbb>$i<nbb>\n";
        		}
            }
		}
            
		break;
		
	case 'view_toppoint':
		for($i=1; $i<count($thehe_choise); $i++) {
            if(strlen($thehe_choise[$i]) > 0) {
                $query = "SELECT name, SUM(points) FROM Event_TOP_Point JOIN MEMB_INFO ON Event_TOP_Point.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i AND [time] >= '$event_toppoint_begin' AND [time] <= '$event_toppoint_end' GROUP BY name ORDER BY SUM(points) DESC";
        		$result = $db->SelectLimit($query, 30, 0);

        		while($row = $result->fetchrow()) 	{
        			echo "$row[0]<nbb>$row[1]<nbb>$i<nbb>\n";
        		}
            }
		}
                
		break;
		
	case 'view_topcard':
		for($i=1; $i<count($thehe_choise); $i++) {
            if(strlen($thehe_choise[$i]) > 0) {
                $query = "SELECT acc, SUM(Event_TOP_Card.gcoin) FROM Event_TOP_Card JOIN MEMB_INFO ON Event_TOP_Card.acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=$i AND [time] >= '$event_topcard_begin' AND [time] <= '$event_topcard_end' GROUP BY acc ORDER BY SUM(Event_TOP_Card.gcoin) DESC";
        		$result = $db->SelectLimit($query, 30, 0);
  
        		while($row = $result->fetchrow()) 	{
        			$sql_char_check = $db->SelectLimit("Select Name From Character where AccountID='$row[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
        			$char_check = $sql_char_check->fetchrow();
        
        			echo "$char_check[0]<nbb>$row[1]<nbb>$i<nbb>\n";
        		}
            }
		}
        
		break;
			
    }
}
?>