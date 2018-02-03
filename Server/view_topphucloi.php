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

$passtransfer = $_POST["passtransfer"];

if ($passtransfer == $transfercode) {
    $action = $_POST['action'];

    switch ($action){ 
    	case 'daily':
            //********* TOP Phuc Loi Daily **************************
            $date_now = date('d/m', $timestamp);
            $date_yesterday = date('d/m', $timestamp - 24*60*60);
            
            $day_yesterday = date('d', $timestamp - 24*60*60);
            $month_yesterday = date('m', $timestamp - 24*60*60);
            
            
            $TopPL[$action]['date'] = array($date_now, $date_yesterday);
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP Daily NOW
                    $TopPL[$action][$date_now][$i] = array();
                    $top_daily_query = "SELECT TOP 20 acc, plpoint FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [date]='". date('Y-m-d', $timestamp) ."' AND plpoint>0 ORDER BY plpoint DESC";
                    $top_daily_result = $db->Execute($top_daily_query);
                        check_queryerror($top_daily_query, $top_daily_result);
                    while($top_daily_fetch = $top_daily_result->FetchRow()) {
                        
                        $acc = $top_daily_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$date_now][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_daily_fetch[1]
                        );
                    }
                    
                    // TOP Daily YESTERDAY
                    $TopPL[$action][$date_yesterday][$i] = array();
                    $top_daily_query = "SELECT TOP 20 acc, plpoint FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [date]='". date('Y-m-d', $timestamp - 24*60*60) ."' AND plpoint>0 ORDER BY plpoint DESC";
                    $top_daily_result = $db->Execute($top_daily_query);
                        check_queryerror($top_daily_query, $top_daily_result);
                    while($top_daily_fetch = $top_daily_result->FetchRow()) {
                        
                        $acc = $top_daily_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$date_yesterday][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_daily_fetch[1]
                        );
                    }
                }
            }
    	break;
    
    	case 'week':
            //********* TOP Phuc Loi WEEK **************************
            $week_now = date('W', $timestamp);
            $week_before = date('W', $timestamp - 7*24*60*60);
            $TopPL[$action]['date'] = array($week_now, $week_before);
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP WEEK NOW
                    $TopPL[$action][$week_now][$i] = array();
                    $top_week_query = "SELECT TOP 20 acc, SUM(plpoint) AS SUM_PL FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND DATEPART( wk, [date])=". $week_now ." GROUP BY acc HAVING SUM(plpoint)>0 ORDER BY SUM_PL DESC";
                    $top_week_result = $db->Execute($top_week_query);
                        check_queryerror($top_week_query, $top_week_result);
                    while($top_week_fetch = $top_week_result->FetchRow()) {
                        
                        $acc = $top_week_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$week_now][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_week_fetch[1]
                        );
                    }
                    
                    // TOP WEEK YESTERDAY
                    $TopPL[$action][$week_before][$i] = array();
                    $top_week_query = "SELECT TOP 20 acc, SUM(plpoint) AS SUM_PL FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND DATEPART( wk, [date])=". $week_before ." GROUP BY acc HAVING SUM(plpoint)>0 ORDER BY SUM_PL DESC";
                    $top_week_result = $db->Execute($top_week_query);
                        check_queryerror($top_week_query, $top_week_result);
                    while($top_week_fetch = $top_week_result->FetchRow()) {
                        
                        $acc = $top_week_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$week_before][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_week_fetch[1]
                        );
                    }
                }
            }
    	break;
    
    	case 'month':
            //********* TOP Phuc Loi MONTH **************************
            if($month == 1) {
                $month_before = 12;
            } else {
                $month_before = $month - 1;
            }
            $TopPL[$action]['date'] = array($month, $month_before);
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP MONTH NOW
                    $TopPL[$action][$month][$i] = array();
                    $top_month_query = "SELECT TOP 20 acc, SUM(plpoint) AS SUM_PL FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND DATEPART( month, [date])=". $month ." GROUP BY acc HAVING SUM(plpoint)>0 ORDER BY SUM_PL DESC";
                    $top_month_result = $db->Execute($top_month_query);
                        check_queryerror($top_month_query, $top_month_result);
                    while($top_month_fetch = $top_month_result->FetchRow()) {
                        
                        $acc = $top_month_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$month][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_month_fetch[1]
                        );
                    }
                    
                    // TOP Month Before
                    $TopPL[$action][$month_before][$i] = array();
                    $top_month_query = "SELECT TOP 20 acc, SUM(plpoint) AS SUM_PL FROM nbb_pl_daily JOIN MEMB_INFO ON acc collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND DATEPART( month, [date])=". $month_before ." GROUP BY acc HAVING SUM(plpoint)>0 ORDER BY SUM_PL DESC";
                    $top_month_result = $db->Execute($top_month_query);
                        check_queryerror($top_month_query, $top_month_result);
                    while($top_month_fetch = $top_month_result->FetchRow()) {
                        
                        $acc = $top_month_fetch[0];
                        $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$acc' ORDER BY Relifes DESC, Resets DESC";
                        $nvchinh_result = $db->Execute($nvchinh_query);
                            check_queryerror($nvchinh_query, $nvchinh_result);
                        $nvchinh_fetch = $nvchinh_result->FetchRow();
                        
                        $TopPL[$action][$month_before][$i][] = array(
                            'name'  =>  $nvchinh_fetch[0],
                            'plpoint'   =>  $top_month_fetch[1]
                        );
                    }
                }
            }
    	break;
    }
    
    $TopPL_data = json_encode($TopPL);
    echo "<info>OK</info><toppl>" . $TopPL_data . "</toppl>";
}
$db->Close();
?>