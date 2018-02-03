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
 
include_once ("security.php");
include ('../config.php');
include ('function.php');

$title = "View Đua TOP Tuần";
session_start();
if ($_POST[submit]) {
    $pass_admin = md5($_POST[useradmin]);
    if ($pass_admin == $passadmin)
        $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
    echo "<center><form action='' method=post><input type='hidden' name='username' value='admin'>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title><?php echo $title; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.21.custom.css" />
</head>
<body>
<?php require('linktop.php'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#time_begin').datepicker({dateFormat: 'yy-mm-dd'});
    $('#time_end').datepicker({dateFormat: 'yy-mm-dd'});
})
</script>
<form action="" name="frm_toptuan" id="frm_toptuan" method="POST">
    <center>
    Thế hệ <i>(Các thế hệ cách nhau dấu ",")</i> : <input name="thehe_list" id="thehe_list" value="<?php if($_POST['thehe_list']) echo $_POST['thehe_list']; else echo "1" ?>" size="5" /> <br />
    Bắt đầu đua TOP : <input name="time_begin" id="time_begin" value="<?php echo $_POST['time_begin']; ?>" size="7" />
    Kết thúc đua TOP : <input name="time_end" id="time_end" value="<?php echo $_POST['time_end']; ?>" size="7" /><br />
    Điểm Reset hoặc Reset nhỏ nhất tính giải : <input name="reset_score_min" id="reset_score_min" value="<?php if($_POST['reset_score_min']) echo $_POST['reset_score_min']; else echo "0" ?>" size="7" /><br />
    Lấy TOP theo Bảng Xếp Hạng 
    <select name="bxh">
        <option value="1" <?php echo ($_POST['bxh'] == 1) ? "selected" : ""; ?> >BXH Danh Vọng 1</option>
        <option value="2" <?php echo ($_POST['bxh'] == 2) ? "selected" : ""; ?> >BXH Danh Vọng 2</option>
        <option value="3" <?php echo ($_POST['bxh'] == 3) ? "selected" : ""; ?> >BXH Thực hiện Reset 1</option>
        <option value="4" <?php echo ($_POST['bxh'] == 4) ? "selected" : ""; ?> >BXH Thực hiện Reset 2</option>
        <option value="5" <?php echo ($_POST['bxh'] == 5) ? "selected" : ""; ?> >BXH Thực hiện Reset 3</option>
        <option value="6" <?php echo ($_POST['bxh'] == 6) ? "selected" : ""; ?> >BXH Reset/Relife</option>
    </select>
    <br />
    <table border="0" cellpadding="3" cellspacing="3">
        <tr>
            <td align="center" colspan="2"><strong>Phần thưởng</strong></td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 1 ALL</strong> :</td>
            <td align="left">
                <input type="text" name="top1all_pl" value="<?php echo $_POST['top1all_pl'] ? intval($_POST['top1all_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top1all_ut" value="<?php echo $_POST['top1all_ut'] ? intval($_POST['top1all_ut']) : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top1all_chao" value="<?php echo $_POST['top1all_chao'] ? intval($_POST['top1all_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 2 ALL</strong> :</td>
            <td align="left">
                <input type="text" name="top2all_pl" value="<?php echo $_POST['top2all_pl'] ? intval($_POST['top2all_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top2all_ut" value="<?php echo $_POST['top2all_ut'] ? intval($_POST['top2all_ut']) : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top2all_chao" value="<?php echo $_POST['top2all_chao'] ? intval($_POST['top2all_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 3 ALL</strong> :</td>
            <td align="left">
                <input type="text" name="top3all_pl" value="<?php echo $_POST['top3all_pl'] ? intval($_POST['top3all_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top3all_ut" value="<?php echo $_POST['top3all_ut'] ? intval($_POST['top3all_ut']) : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top3all_chao" value="<?php echo $_POST['top3all_chao'] ? intval($_POST['top3all_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 1 Class</strong> :</td>
            <td align="left">
                <input type="text" name="top1class_pl" value="<?php echo $_POST['top1class_pl'] ? intval($_POST['top1class_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top1class_ut" value="<?php echo $_POST['top1class_ut'] ? intval($_POST['top1class_ut']) : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top1class_chao" value="<?php echo $_POST['top1class_chao'] ? intval($_POST['top1class_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 2 Class</strong> :</td>
            <td align="left">
                <input type="text" name="top2class_pl" value="<?php echo $_POST['top2class_pl'] ? intval($_POST['top2class_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top2class_ut" value="<?php echo $_POST['top2class_ut'] ? $_POST['top2class_ut'] : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top2class_chao" value="<?php echo $_POST['top2class_chao'] ? intval($_POST['top2class_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
        <tr>
            <td align="right"><strong>TOP 3 Class</strong> :</td>
            <td align="left">
                <input type="text" name="top3class_pl" value="<?php echo $_POST['top3class_pl'] ? intval($_POST['top3class_pl']) : 0; ?>" size="5" /> Điểm Phúc Lợi + 
                <input type="text" name="top3class_ut" value="<?php echo $_POST['top3class_ut'] ? intval($_POST['top3class_ut']) : 0; ?>" size="5" /> Điểm Ủy Thác + 
                <input type="text" name="top3class_chao" value="<?php echo $_POST['top3class_chao'] ? intval($_POST['top3class_chao']) : 0; ?>" size="5" /> Chao ngân hàng
            </td>
        </tr>
    </table>
    <br />
    <input type="submit" name="submit_frm_toptuan" value="Xem Kết Quả TOP" />
    </center>
</form>


<?php
if($_POST) {
    $thehe_list = $_POST['thehe_list'];
    $time_begin = strtotime($_POST['time_begin']);
    $time_end = strtotime($_POST['time_end']) + 24*60*60;
    $reset_score_min = $_POST['reset_score_min'];
    
    $bxh = intval($_POST['bxh']);
    
    $top1all_pl = intval($_POST['top1all_pl']);
    $top1all_ut = intval($_POST['top1all_ut']);
    $top1all_chao = intval($_POST['top1all_chao']);
    
    $top2all_pl = intval($_POST['top2all_pl']);
    $top2all_ut = intval($_POST['top2all_ut']);
    $top2all_chao = intval($_POST['top2all_chao']);
    
    $top3all_pl = intval($_POST['top3all_pl']);
    $top3all_ut = intval($_POST['top3all_ut']);
    $top3all_chao = intval($_POST['top3all_chao']);
    
    $top1class_pl = intval($_POST['top1class_pl']);
    $top1class_ut = intval($_POST['top1class_ut']);
    $top1class_chao = intval($_POST['top1class_chao']);
    
    $top2class_pl = intval($_POST['top2class_pl']);
    $top2class_ut = intval($_POST['top2class_ut']);
    $top2class_chao = intval($_POST['top2class_chao']);
    
    $top3class_pl = intval($_POST['top3class_pl']);
    $top3class_ut = intval($_POST['top3class_ut']);
    $top3class_chao = intval($_POST['top3class_chao']);

    echo "<hr />";
    
    $query_gift = "";
    for($class_i=0; $class_i<=7; $class_i++) {
        switch ($class_i) {
        	case 1: $top_class = "Phù Thủy"; $class_query = " AND (Class = 0 OR Class = 1 OR Class = 2 OR Class = 3) "; break;         // DW
            case 2: $top_class = "Chiến Binh"; $class_query = " AND (Class = 16 OR Class = 17 OR Class = 18 OR Class = 19) "; break;     // DW
            case 3: $top_class = "Tiên Nữ"; $class_query = " AND (Class = 32 OR Class = 33 OR Class = 34 OR Class = 35) "; break;     // ELF
            case 4: $top_class = "Đấu Sĩ"; $class_query = " AND (Class = 48 OR Class = 49  OR Class = 50) "; break;                  // MG
            case 5: $top_class = "Chúa Tể"; $class_query = " AND (Class = 64 OR Class = 65  OR Class = 66) "; break;                  // DL
            case 6: $top_class = "Thuật Sĩ"; $class_query = " AND (Class = 80 OR Class = 81 OR Class = 82 OR Class = 83) "; break;     // SUM
            case 7: $top_class = "Thiết Binh"; $class_query = " AND (Class = 96 OR Class = 97 OR Class = 98) "; break;                   // RF
            default : $top_class = "Tất Cả"; $class_query = "";
        }
        
        switch ($bxh){ 
        	case 2:
                $top_query = "SELECT TOP 3 TopResetScore.name, SUM(reset_score_pri) AS ResetScoreTotal, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) AND [time] >= {$time_begin} AND [time] <= {$time_end} JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $class_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time HAVING SUM(reset_score_pri) >= {$reset_score_min} ORDER BY ResetScoreTotal DESC, Resets_Time";
                $name_score = "Điểm Danh Vọng";
        	break;
        
        	case 3:
                $top_query = "SELECT TOP 3 TopReset.name, SUM(reset_all) AS ResetScoreTotal, Class, thehe FROM TopReset JOIN MEMB_INFO ON TopReset.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) AND [time] >= {$time_begin} AND [time] <= {$time_end} JOIN Character ON TopReset.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $class_query ." GROUP BY TopReset.name, Class, Thehe, Resets_Time HAVING SUM(reset_all) >= {$reset_score_min} ORDER BY ResetScoreTotal DESC, Resets_Time";
                $name_score = "Số lần thực hiện Reset";
        	break;
            
            case 4:
                $top_query = "SELECT TOP 3 TopReset.name, SUM(reset_pri) AS ResetScoreTotal, Class, thehe FROM TopReset JOIN MEMB_INFO ON TopReset.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) AND [time] >= {$time_begin} AND [time] <= {$time_end} JOIN Character ON TopReset.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $class_query ." GROUP BY TopReset.name, Class, Thehe, Resets_Time HAVING SUM(reset_pri) >= {$reset_score_min} ORDER BY ResetScoreTotal DESC, Resets_Time";
                $name_score = "Số lần thực hiện Reset";
        	break;
            
            case 5:
                $top_query = "SELECT TOP 3 TopReset.name, SUM(reset) AS ResetScoreTotal, Class, thehe FROM TopReset JOIN MEMB_INFO ON TopReset.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) AND [time] >= {$time_begin} AND [time] <= {$time_end} JOIN Character ON TopReset.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $class_query ." GROUP BY TopReset.name, Class, Thehe, Resets_Time HAVING SUM(reset) >= {$reset_score_min} ORDER BY ResetScoreTotal DESC, Resets_Time";
                $name_score = "Số lần thực hiện Reset";
        	break;
        	
        	case 6:
                $top_query = "SELECT TOP 3 name, Resets, Class, thehe, relifes FROM Character JOIN MEMB_INFO ON Character.AccountID collate DATABASE_DEFAULT = MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) ". $class_query ." ORDER BY relifes DESC, resets DESC , cLevel DESC, Resets_Time";
                $name_score = "<font color='blue'>Reset</font> / <font color='red'>Relife</font>";
        	break;
        
        	default :
                $top_query = "SELECT TOP 3 TopResetScore.name, SUM(reset_score) AS ResetScoreTotal, Class, thehe FROM TopResetScore JOIN MEMB_INFO ON TopResetScore.acc collate DATABASE_DEFAULT =MEMB_INFO.memb___id collate DATABASE_DEFAULT AND thehe IN ({$thehe_list}) AND [time] >= {$time_begin} AND [time] <= {$time_end} JOIN Character ON TopResetScore.name collate DATABASE_DEFAULT = Character.Name collate DATABASE_DEFAULT ". $class_query ." GROUP BY TopResetScore.name, Class, Thehe, Resets_Time HAVING SUM(reset_score) >= {$reset_score_min} ORDER BY ResetScoreTotal DESC, Resets_Time";
                
                $name_score = "Điểm Danh Vọng";
        }
        
        //echo $top_query . "<hr />";
        $top_result = $db->Execute($top_query);
            check_queryerror($top_query, $top_result);
?>
<center>
<strong>TOP <?php echo $top_class; ?></strong>
<table style="border-collapse: collapse;" border="1" width="100%">
    <tr>
        <td align="center" valign="top"><strong>TOP</strong></td>
        <td align="center" valign="top"><strong>Nhân vật</strong></td>
        <td align="center" valign="top"><strong><?php echo $name_score; ?></strong></td>
        <td align="center" valign="top"><strong>Class</strong></td>
        <td align="center" valign="top"><strong>Phần thưởng</strong></td>
    </tr>
<?php
        $top_id = 0;
        while($top_fetch = $top_result->FetchRow()) {
            $top_id++;
            switch ($top_fetch[2]) {
                case 0:
                    $class_name = 'Dark Wizard';
                    break;
                case 1:
                    $class_name = 'Soul Master';
                    break;
                case 2:
                case 3:
                    $class_name = 'Grand Master';
                    break;

                case 16:
                    $class_name = 'Dark Knight';
                    break;
                case 17:
                    $class_name = 'Blade Knight';
                    break;
                case 18:
                case 19:
                    $class_name = 'Blade Master';
                    break;

                case 32:
                    $class_name = 'Elf';
                    break;
                case 33:
                    $class_name = 'Muse Elf';
                    break;
                case 34:
                case 35:
                    $class_name = 'Hight Elf';
                    break;

                case 48:
                    $class_name = 'Magic Gladiator';
                    break;
                case 49:
                case 50:
                    $class_name = 'Duel Master';
                    break;

                case 64:
                    $class_name = 'DarkLord';
                    break;
                case 65:
                case 66:
                    $class_name = 'Lord Emperor';
                    break;

                case 80:
                    $class_name = 'Sumoner';
                    break;
                case 81:
                    $class_name = 'Bloody Summoner';
                    break;
                case 82:
                case 83:
                    $class_name = 'Dimension Master';
                    break;

                case 96:
                    $class_name = 'Rage Fighter';
                    break;
                case 97:
                case 98:
                    $class_name = 'First Class';
                    break;
            }
            
            $name = $top_fetch[0];
            
            if($bxh == 6) {
            	$resets = $top_fetch[1];
                $relifes = $top_fetch[4];
            	$reset_score = "<font color='blue'>$resets</font> / <font color='red'>$relifes</font>";
            } else {
            	$reset_score = $top_fetch[1];
            	$reset_score = number_format($reset_score, 0, ',', '.');
            }
            
            $gift = "";
            if($class_i == 0) {     // TOP ALL
                
                switch ($top_id){ 
                	case 1:    // TOP 1
                        if($top1all_pl > 0) {
                            $gift .= number_format($top1all_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top1all_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top1all_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top1all_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top1all_ut WHERE Name='$name'<br />";
                        }
                        if($top1all_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top1all_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top1all_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                	break;
                
                	case 2:    // TOP 2
                        if($top2all_pl > 0) {
                            $gift .= number_format($top2all_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top2all_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top2all_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top2all_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top2all_ut WHERE Name='$name'<br />";
                        }
                        if($top2all_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top2all_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top2all_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                	break;
                
                	default :  // TOP 3
                        if($top3all_pl > 0) {
                            $gift .= number_format($top3all_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top3all_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top3all_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top3all_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top3all_ut WHERE Name='$name'<br />";
                        }
                        if($top3all_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top3all_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top3all_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                }
            } else {    // TOP Class
                
                switch ($top_id){ 
                	case 1:    // TOP 1
                        if($top1class_pl > 0) {
                            $gift .= number_format($top1class_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top1class_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top1class_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top1class_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top1class_ut WHERE Name='$name'<br />";
                        }
                        if($top1class_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top1class_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top1class_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                	break;
                
                	case 2:    // TOP 2
                        if($top2class_pl > 0) {
                            $gift .= number_format($top2class_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top2class_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top2class_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top2class_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top2class_ut WHERE Name='$name'<br />";
                        }
                        if($top2class_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top2class_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top2class_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                	break;
                
                	default :  // TOP 3
                        if($top3class_pl > 0) {
                            $gift .= number_format($top3class_pl, 0, ',', '.') . " Điểm Phúc Lợi";
                            $query_gift .= "UPDATE MEMB_INFO SET nbb_pl=nbb_pl+$top3class_pl FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                        if($top3class_ut > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top3class_ut, 0, ',', '.') . " Điểm Ủy Thác";
                            $query_gift .= "Update Character SET PointUyThac_Event = PointUyThac_Event + $top3class_ut WHERE Name='$name'<br />";
                        }
                        if($top3class_chao > 0) {
                            if(strlen($gift) > 0) {
                                $gift .= " + ";
                            }
                            $gift .= number_format($top3class_chao, 0, ',', '.') . " Chao Ngân Hàng";
                            $query_gift .= "Update MEMB_INFO SET jewel_chao = jewel_chao + $top3class_chao FROM MEMB_INFO A JOIN Character B ON A.memb___id collate DATABASE_DEFAULT = B.AccountID collate DATABASE_DEFAULT AND Name='$name'<br />";
                        }
                }
            }
            
            
?>

    <tr>
        <td align="center" valign="top"><?php echo $top_id; ?></td>
        <td align="center" valign="top"><?php echo $name; ?></td>
        <td align="center" valign="top"><?php echo $reset_score; ?></td>
        <td align="center" valign="top"><?php echo $class_name; ?></td>
        <td align="center" valign="top"><?php echo $gift; ?></td>
    </tr>

<?php
        }
?>
</table>
<br /><br />
</center>
<?php
    }
?>
<strong>Hướng dẫn đăng ký theo mẫu:</strong><br />
[QUOTE]
<ul>
  <li>Nhân vật : ...</li>
  <li>Phần thưởng : ...</li>
  <li>Dòng hoàn hảo muốn chọn : ...</li>
</ul>
[/QUOTE]<br />
<strong>Thời gian trao giải </strong>: Trong vòng <strong><font color="#FF0000">24h</font></strong> kể từ khi đăng ký.<br />
Khi nhân vật được trao giải, sẽ có chú thích từ BQT trong bài đăng ký nhận thưởng : &quot;<strong><font color="#FF0000">đã trao</font></strong>&quot;<br />
<br />
<strong>Hướng dẫn nhận thưởng :</strong>
<ul>
  <li>Đăng nhập Web tài khoản</li>
  <li>Chọn nhân vật nhận thưởng</li>
  <li>Vào chức năng : <strong><font color="#0000FF">Event &gt; Nhận giải thưởng Event</font></strong></li>
  <li>Nhận Item</li>
</ul>
<br /><br /><br />
<hr />
<strong>Query Trao Thưởng</strong><br />
<?php echo $query_gift; ?>

<?php
}
?>

</body>
</html>
<?php
$db->Close();
?>