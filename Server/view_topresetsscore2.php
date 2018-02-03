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
    $type = $_POST['type'];
    $action = $_POST['action'];

    switch ($action){ 
    	case 'daily':
            //********* TOP Reset Score Daily **************************
            $date_now = date('d/m', $timestamp);
            
            $day_yesterday = date('d', $timestamp - 24*60*60);
            $month_yesterday = date('m', $timestamp - 24*60*60);
            $year_yesterday = date('Y', $timestamp - 24*60*60);
            $date_yesterday = $day_yesterday ."/". $month_yesterday;
            
            $TopResetScore[$action]['date'] = array($date_now, $date_yesterday);
            
            switch($type)
            {
                case 'dw': $type_query = "AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;
                case 'dk': $type_query = "AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;
                case 'elf': $type_query = "AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;
                case 'mg': $type_query = "AND (Class = 48 OR Class = 49  OR Class = 50) "; break;
                case 'dl': $type_query = "AND (Class = 64 OR Class = 65  OR Class = 66) "; break;
                case 'sum': $type_query = "AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;
                case 'rf': $type_query = "AND (Class = 96 OR Class = 97 OR Class = 98) "; break;
                default : $type_query = "";
            }
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP Daily NOW
                    $TopResetScore[$action][$type][$date_now][$i] = array();
                    $top_daily_query = "SELECT TOP 20 TopResetScore.name, reset_score_pri, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [day]=". $day ." AND [month]=". $month ." AND [year]=". $year ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." ORDER BY reset_score_pri DESC, Resets_Time";
                    $top_daily_result = $db->Execute($top_daily_query);
                        check_queryerror($top_daily_query, $top_daily_result);
                    while($top_daily_fetch = $top_daily_result->FetchRow()) {
                        $TopResetScore[$action][$type][$date_now][$i][] = array(
                            'name'  =>  $top_daily_fetch[0],
                            'reset_score'   =>  $top_daily_fetch[1],
                            'class' =>  $top_daily_fetch[2],
                            'thehe' =>  $top_daily_fetch[3]
                        );
                    }
                    
                    // TOP Daily YESTERDAY
                    $TopResetScore[$action][$type][$date_yesterday][$i] = array();
                    $top_daily_query = "SELECT TOP 20 TopResetScore.name, reset_score_pri, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [day]=". $day_yesterday ." AND [month]=". $month_yesterday ." AND [year]=". $year_yesterday ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." ORDER BY reset_score_pri DESC, Resets_Time";
                    $top_daily_result = $db->Execute($top_daily_query);
                        check_queryerror($top_daily_query, $top_daily_result);
                    while($top_daily_fetch = $top_daily_result->FetchRow()) {
                        $TopResetScore[$action][$type][$date_yesterday][$i][] = array(
                            'name'  =>  $top_daily_fetch[0],
                            'reset_score'   =>  $top_daily_fetch[1],
                            'class' =>  $top_daily_fetch[2],
                            'thehe' =>  $top_daily_fetch[3]
                        );
                    }
                }
            }
    	break;
    
    	case 'week':
            //********* TOP Reset Score WEEK **************************
            $week_now = date('W', $timestamp);
            $week_before = date('W', $timestamp - 7*24*60*60);
            $TopResetScore[$action]['date'] = array($week_now, $week_before);
            
            switch($type)
            {
                case 'dw': $type_query = "AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;
                case 'dk': $type_query = "AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;
                case 'elf': $type_query = "AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;
                case 'mg': $type_query = "AND (Class = 48 OR Class = 49  OR Class = 50) "; break;
                case 'dl': $type_query = "AND (Class = 64 OR Class = 65  OR Class = 66) "; break;
                case 'sum': $type_query = "AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;
                case 'rf': $type_query = "AND (Class = 96 OR Class = 97 OR Class = 98) "; break;
                default : $type_query = "";
            }
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP WEEK NOW
                    $TopResetScore[$action][$type][$week_now][$i] = array();
                    $top_week_query = "SELECT TOP 20 TopResetScore.name, SUM(reset_score_pri) AS ResetScoreWeek, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [week]=". $week_now ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time ORDER BY ResetScoreWeek DESC, Resets_Time";
                    $top_week_result = $db->Execute($top_week_query);
                        check_queryerror($top_week_query, $top_week_result);
                    while($top_week_fetch = $top_week_result->FetchRow()) {
                        $TopResetScore[$action][$type][$week_now][$i][] = array(
                            'name'  =>  $top_week_fetch[0],
                            'reset_score'   =>  $top_week_fetch[1],
                            'class' =>  $top_week_fetch[2],
                            'thehe' =>  $top_week_fetch[3]
                        );
                    }
                    
                    // TOP WEEK YESTERDAY
                    $TopResetScore[$action][$type][$week_before][$i] = array();
                    $top_week_query = "SELECT TOP 20 TopResetScore.name, SUM(reset_score_pri) AS ResetScoreWeek, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [week]=". $week_before ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time ORDER BY ResetScoreWeek DESC, Resets_Time";
                    $top_week_result = $db->Execute($top_week_query);
                        check_queryerror($top_week_query, $top_week_result);
                    while($top_week_fetch = $top_week_result->FetchRow()) {
                        $TopResetScore[$action][$type][$week_before][$i][] = array(
                            'name'  =>  $top_week_fetch[0],
                            'reset_score'   =>  $top_week_fetch[1],
                            'class' =>  $top_week_fetch[2],
                            'thehe' =>  $top_week_fetch[3]
                        );
                    }
                }
            }
    	break;
    
    	case 'month':
            //********* TOP Reset Score MONTH **************************
            if($month == 1) {
                $month_before = 12;
                $year_before = $year - 1;
            } else {
                $month_before = $month - 1;
                $year_before = $year;
            }
            $TopResetScore[$action]['date'] = array($month, $month_before);
        
            switch($type)
            {
                case 'dw': $type_query = "AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;
                case 'dk': $type_query = "AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;
                case 'elf': $type_query = "AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;
                case 'mg': $type_query = "AND (Class = 48 OR Class = 49  OR Class = 50) "; break;
                case 'dl': $type_query = "AND (Class = 64 OR Class = 65  OR Class = 66) "; break;
                case 'sum': $type_query = "AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;
                case 'rf': $type_query = "AND (Class = 96 OR Class = 97 OR Class = 98) "; break;
                default : $type_query = "";
            }
            
            for($i=1;$i<count($thehe_choise);$i++) {
                if(strlen($thehe_choise[$i]) > 1) {
                    // TOP MONTH NOW
                    $TopResetScore[$action][$type][$month][$i] = array();
                    $top_month_query = "SELECT TOP 20 TopResetScore.name, SUM(reset_score_pri) AS ResetScoreMonth, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [month]=". $month ." AND [year]=". $year ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time ORDER BY ResetScoreMonth DESC, Resets_Time";
                    $top_month_result = $db->Execute($top_month_query);
                        check_queryerror($top_month_query, $top_month_result);
                    while($top_month_fetch = $top_month_result->FetchRow()) {
                        $TopResetScore[$action][$type][$month][$i][] = array(
                            'name'  =>  $top_month_fetch[0],
                            'reset_score'   =>  $top_month_fetch[1],
                            'class' =>  $top_month_fetch[2],
                            'thehe' =>  $top_month_fetch[3]
                        );
                    }
                    
                    // TOP Month Before
                    $TopResetScore[$action][$type][$month_before][$i] = array();
                    $top_month_query = "SELECT TOP 20 TopResetScore.name, SUM(reset_score_pri) AS ResetScoreMonth, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe=". $i ." AND [month]=". $month_before ." AND [year]=". $year_before ." JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $type_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time ORDER BY ResetScoreMonth DESC, Resets_Time";
                    $top_month_result = $db->Execute($top_month_query);
                        check_queryerror($top_month_query, $top_month_result);
                    while($top_month_fetch = $top_month_result->FetchRow()) {
                        $TopResetScore[$action][$type][$month_before][$i][] = array(
                            'name'  =>  $top_month_fetch[0],
                            'reset_score'   =>  $top_month_fetch[1],
                            'class' =>  $top_month_fetch[2],
                            'thehe' =>  $top_month_fetch[3]
                        );
                    }
                }
            }
    	break;
    }
    
    $TopResetScore_data = serialize($TopResetScore);
    echo "<nbb>OK<nbb>" . $TopResetScore_data . "<nbb>";
}
$db->Close();
?>