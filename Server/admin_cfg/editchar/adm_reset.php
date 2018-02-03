<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
$file_edit = 'config/config_reset.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

$action = $_POST[action];

if($action == 'edit')
{
	$content = "<?php\n";
	
	$level_after_reset = $_POST['level_after_reset'];
        $level_after_reset = abs(intval($level_after_reset));
    		$content .= "\$level_after_reset	= $level_after_reset;\n";
	$cap_reset_max = $_POST['cap_reset_max'];
        $cap_reset_max = abs(intval($cap_reset_max));
    		$content .= "\$cap_reset_max	= $cap_reset_max;\n";
	$log_reset	=	$_POST['log_reset'];
        $log_reset = abs(intval($log_reset));
    		$content .= "\$log_reset	= $log_reset;\n";

	$reset_cap_0 = 0;
        $reset_cap_0 = abs(intval($reset_cap_0));
    		$content .= "\$reset_cap_0	= $reset_cap_0;\n";
//Reset từ cấp 0 tới Cấp 1
$reset_cap_1 = $_POST['reset_cap_1'];
    $reset_cap_1 = abs(intval($reset_cap_1));
		$content .= "\$reset_cap_1	= $reset_cap_1;\n";
	$level_cap_1 = $_POST['level_cap_1'];
        $level_cap_1 = abs(intval($level_cap_1));
    		$content .= "\$level_cap_1	= $level_cap_1;\n";
	$zen_cap_1 = $_POST['zen_cap_1'];
        $zen_cap_1 = abs(intval($zen_cap_1));
    		$content .= "\$zen_cap_1	= $zen_cap_1;\n";
	$time_reset_next_1 = $_POST['time_reset_next_1'];
        $time_reset_next_1 = abs(intval($time_reset_next_1));
    		$content .= "\$time_reset_next_1	= $time_reset_next_1;\n";
	$chao_cap_1 = $_POST['chao_cap_1'];
        $chao_cap_1 = abs(intval($chao_cap_1));
    		$content .= "\$chao_cap_1	= $chao_cap_1;\n";
	$cre_cap_1 = $_POST['cre_cap_1'];
        $cre_cap_1 = abs(intval($cre_cap_1));
    		$content .= "\$cre_cap_1	= $cre_cap_1;\n";
	$blue_cap_1 = $_POST['blue_cap_1'];	
        $blue_cap_1 = abs(intval($blue_cap_1));
        	$content .= "\$blue_cap_1	= $blue_cap_1;\n";
	$point_cap_1 = $_POST['point_cap_1'];
        $point_cap_1 = abs(intval($point_cap_1));
    		$content .= "\$point_cap_1	= $point_cap_1;\n";
	$ml_cap_1 = $_POST['ml_cap_1'];
        $ml_cap_1 = abs(intval($ml_cap_1));
    		$content .= "\$ml_cap_1	= $ml_cap_1;\n";
//Reset từ lần Cấp 1 tới Cấp 2
$reset_cap_2 = $_POST['reset_cap_2'];
    $reset_cap_2 = abs(intval($reset_cap_2));
		$content .= "\$reset_cap_2	= $reset_cap_2;\n";
	$level_cap_2 = $_POST['level_cap_2'];
        $level_cap_2 = abs(intval($level_cap_2));
    		$content .= "\$level_cap_2	= $level_cap_2;\n";	
	$zen_cap_2 = $_POST['zen_cap_2'];
        $zen_cap_2 = abs(intval($zen_cap_2));
    		$content .= "\$zen_cap_2	= $zen_cap_2;\n";
	$time_reset_next_2 = $_POST['time_reset_next_2'];
        $time_reset_next_2 = abs(intval($time_reset_next_2));
    		$content .= "\$time_reset_next_2	= $time_reset_next_2;\n";
	$chao_cap_2 = $_POST['chao_cap_2'];
        $chao_cap_2 = abs(intval($chao_cap_2));
    		$content .= "\$chao_cap_2	= $chao_cap_2;\n";	
	$cre_cap_2 = $_POST['cre_cap_2'];
        $cre_cap_2 = abs(intval($cre_cap_2));
    		$content .= "\$cre_cap_2	= $cre_cap_2;\n";
	$blue_cap_2 = $_POST['blue_cap_2'];
        $blue_cap_2 = abs(intval($blue_cap_2));
        	$content .= "\$blue_cap_2	= $blue_cap_2;\n";
	$point_cap_2 = $_POST['point_cap_2'];
        $point_cap_2 = abs(intval($point_cap_2));
    		$content .= "\$point_cap_2	= $point_cap_2;\n";
	$ml_cap_2 = $_POST['ml_cap_2'];
        $ml_cap_2 = abs(intval($ml_cap_2));
    		$content .= "\$ml_cap_2	= $ml_cap_2;\n";
//Reset từ lần Cấp 2 tới Cấp 3
$reset_cap_3 = $_POST['reset_cap_3'];
    $reset_cap_3 = abs(intval($reset_cap_3));
		$content .= "\$reset_cap_3	= $reset_cap_3;\n";
	$level_cap_3 = $_POST['level_cap_3'];
        $level_cap_3 = abs(intval($level_cap_3));
    		$content .= "\$level_cap_3	= $level_cap_3;\n";
	$zen_cap_3 = $_POST['zen_cap_3'];
        $zen_cap_3 = abs(intval($zen_cap_3));
    		$content .= "\$zen_cap_3	= $zen_cap_3;\n";
	$time_reset_next_3 = $_POST['time_reset_next_3'];
        $time_reset_next_3 = abs(intval($time_reset_next_3));
    		$content .= "\$time_reset_next_3	= $time_reset_next_3;\n";
	$chao_cap_3 = $_POST['chao_cap_3'];	
        $chao_cap_3 = abs(intval($chao_cap_3));
        	$content .= "\$chao_cap_3	= $chao_cap_3;\n";
	$cre_cap_3 = $_POST['cre_cap_3'];
        $cre_cap_3 = abs(intval($cre_cap_3));
    		$content .= "\$cre_cap_3	= $cre_cap_3;\n";
	$blue_cap_3 = $_POST['blue_cap_3'];
        $blue_cap_3 = abs(intval($blue_cap_3));
    		$content .= "\$blue_cap_3	= $blue_cap_3;\n";
	$point_cap_3 = $_POST['point_cap_3'];
        $point_cap_3 = abs(intval($point_cap_3));
    		$content .= "\$point_cap_3	= $point_cap_3;\n";
	$ml_cap_3 = $_POST['ml_cap_3'];
        $ml_cap_3 = abs(intval($ml_cap_3));
    		$content .= "\$ml_cap_3	= $ml_cap_3;\n";
//Reset từ lần Cấp 3 tới Cấp 4
$reset_cap_4 = $_POST['reset_cap_4'];
    $reset_cap_4 = abs(intval($reset_cap_4));
		$content .= "\$reset_cap_4	= $reset_cap_4;\n";
	$level_cap_4 = $_POST['level_cap_4'];
        $level_cap_4 = abs(intval($level_cap_4));
    		$content .= "\$level_cap_4	= $level_cap_4;\n";
	$zen_cap_4 = $_POST['zen_cap_4'];
        $zen_cap_4 = abs(intval($zen_cap_4));
    		$content .= "\$zen_cap_4	= $zen_cap_4;\n";
	$time_reset_next_4 = $_POST['time_reset_next_4'];
        $time_reset_next_4 = abs(intval($time_reset_next_4));
    		$content .= "\$time_reset_next_4	= $time_reset_next_4;\n";
	$chao_cap_4 = $_POST['chao_cap_4'];
        $chao_cap_4 = abs(intval($chao_cap_4));
    		$content .= "\$chao_cap_4	= $chao_cap_4;\n";
	$cre_cap_4 = $_POST['cre_cap_4'];
        $cre_cap_4 = abs(intval($cre_cap_4));
    		$content .= "\$cre_cap_4	= $cre_cap_4;\n";
	$blue_cap_4 = $_POST['blue_cap_4'];
        $blue_cap_4 = abs(intval($blue_cap_4));
    		$content .= "\$blue_cap_4	= $blue_cap_4;\n";
	$point_cap_4 = $_POST['point_cap_4'];
        $point_cap_4 = abs(intval($point_cap_4));
    		$content .= "\$point_cap_4	= $point_cap_4;\n";
	$ml_cap_4 = $_POST['ml_cap_4'];
        $ml_cap_4 = abs(intval($ml_cap_4));
    		$content .= "\$ml_cap_4	= $ml_cap_4;\n";
//Reset từ lần Cấp 4 tới Cấp 5
$reset_cap_5 = $_POST['reset_cap_5'];
    $reset_cap_5 = abs(intval($reset_cap_5));
		$content .= "\$reset_cap_5	= $reset_cap_5;\n";
	$level_cap_5 = $_POST['level_cap_5'];
        $level_cap_5 = abs(intval($level_cap_5));
    		$content .= "\$level_cap_5	= $level_cap_5;\n";
	$zen_cap_5 = $_POST['zen_cap_5'];
        $zen_cap_5 = abs(intval($zen_cap_5));
    		$content .= "\$zen_cap_5	= $zen_cap_5;\n";
	$time_reset_next_5 = $_POST['time_reset_next_5'];
        $time_reset_next_5 = abs(intval($time_reset_next_5));
    		$content .= "\$time_reset_next_5	= $time_reset_next_5;\n";
	$chao_cap_5 = $_POST['chao_cap_5'];
        $chao_cap_5 = abs(intval($chao_cap_5));
    		$content .= "\$chao_cap_5	= $chao_cap_5;\n";
	$cre_cap_5 = $_POST['cre_cap_5'];
        $cre_cap_5 = abs(intval($cre_cap_5));
    		$content .= "\$cre_cap_5	= $cre_cap_5;\n";
	$blue_cap_5 = $_POST['blue_cap_5'];
        $blue_cap_5 = abs(intval($blue_cap_5));
    		$content .= "\$blue_cap_5	= $blue_cap_5;\n";
	$point_cap_5 = $_POST['point_cap_5'];
        $point_cap_5 = abs(intval($point_cap_5));
    		$content .= "\$point_cap_5	= $point_cap_5;\n";
	$ml_cap_5 = $_POST['ml_cap_5'];
        $ml_cap_5 = abs(intval($ml_cap_5));
    		$content .= "\$ml_cap_5	= $ml_cap_5;\n";
//Reset từ lần Cấp 5 tới Cấp 6
$reset_cap_6 = $_POST['reset_cap_6'];
    $reset_cap_6 = abs(intval($reset_cap_6));
		$content .= "\$reset_cap_6	= $reset_cap_6;\n";
	$level_cap_6 = $_POST['level_cap_6'];
        $level_cap_6 = abs(intval($level_cap_6));
    		$content .= "\$level_cap_6	= $level_cap_6;\n";
	$zen_cap_6 = $_POST['zen_cap_6'];
        $zen_cap_6 = abs(intval($zen_cap_6));
    		$content .= "\$zen_cap_6	= $zen_cap_6;\n";
	$time_reset_next_6 = $_POST['time_reset_next_6'];
        $time_reset_next_6 = abs(intval($time_reset_next_6));
    		$content .= "\$time_reset_next_6	= $time_reset_next_6;\n";
	$chao_cap_6 = $_POST['chao_cap_6'];
        $chao_cap_6 = abs(intval($chao_cap_6));
    		$content .= "\$chao_cap_6	= $chao_cap_6;\n";
	$cre_cap_6 = $_POST['cre_cap_6'];
        $cre_cap_6 = abs(intval($cre_cap_6));
    		$content .= "\$cre_cap_6	= $cre_cap_6;\n";
	$blue_cap_6 = $_POST['blue_cap_6'];	
        $blue_cap_6 = abs(intval($blue_cap_6));
        	$content .= "\$blue_cap_6	= $blue_cap_6;\n";
	$point_cap_6 = $_POST['point_cap_6'];
        $point_cap_6 = abs(intval($point_cap_6));
    		$content .= "\$point_cap_6	= $point_cap_6;\n";
	$ml_cap_6 = $_POST['ml_cap_6'];
        $ml_cap_6 = abs(intval($ml_cap_6));
    		$content .= "\$ml_cap_6	= $ml_cap_6;\n";
//Reset từ lần Cấp 6 tới Cấp 7
$reset_cap_7 = $_POST['reset_cap_7'];
    $reset_cap_7 = abs(intval($reset_cap_7));
		$content .= "\$reset_cap_7	= $reset_cap_7;\n";
	$level_cap_7 = $_POST['level_cap_7'];
        $level_cap_7 = abs(intval($level_cap_7));
    		$content .= "\$level_cap_7	= $level_cap_7;\n";
	$zen_cap_7 = $_POST['zen_cap_7'];
        $zen_cap_7 = abs(intval($zen_cap_7));
    		$content .= "\$zen_cap_7	= $zen_cap_7;\n";
	$time_reset_next_7 = $_POST['time_reset_next_7'];
        $time_reset_next_7 = abs(intval($time_reset_next_7));
    		$content .= "\$time_reset_next_7	= $time_reset_next_7;\n";
	$chao_cap_7 = $_POST['chao_cap_7'];
        $chao_cap_7 = abs(intval($chao_cap_7));
    		$content .= "\$chao_cap_7	= $chao_cap_7;\n";
	$cre_cap_7 = $_POST['cre_cap_7'];
        $cre_cap_7 = abs(intval($cre_cap_7));
    		$content .= "\$cre_cap_7	= $cre_cap_7;\n";
	$blue_cap_7 = $_POST['blue_cap_7'];
        $blue_cap_7 = abs(intval($blue_cap_7));
    		$content .= "\$blue_cap_7	= $blue_cap_7;\n";
	$point_cap_7 = $_POST['point_cap_7'];
        $point_cap_7 = abs(intval($point_cap_7));
    		$content .= "\$point_cap_7	= $point_cap_7;\n";
	$ml_cap_7 = $_POST['ml_cap_7'];
        $ml_cap_7 = abs(intval($ml_cap_7));
    		$content .= "\$ml_cap_7	= $ml_cap_7;\n";
//Reset từ lần Cấp 7 tới Cấp 8
$reset_cap_8 = $_POST['reset_cap_8'];
    $reset_cap_8 = abs(intval($reset_cap_8));
		$content .= "\$reset_cap_8	= $reset_cap_8;\n";
	$level_cap_8 = $_POST['level_cap_8'];
        $level_cap_8 = abs(intval($level_cap_8));
    	   	$content .= "\$level_cap_8	= $level_cap_8;\n";
	$zen_cap_8 = $_POST['zen_cap_8'];
        $zen_cap_8 = abs(intval($zen_cap_8));
    		$content .= "\$zen_cap_8	= $zen_cap_8;\n";
	$time_reset_next_8 = $_POST['time_reset_next_8'];
        $time_reset_next_8 = abs(intval($time_reset_next_8));
    		$content .= "\$time_reset_next_8	= $time_reset_next_8;\n";
	$chao_cap_8 = $_POST['chao_cap_8'];
        $chao_cap_8 = abs(intval($chao_cap_8));
    		$content .= "\$chao_cap_8	= $chao_cap_8;\n";
	$cre_cap_8 = $_POST['cre_cap_8'];
        $cre_cap_8 = abs(intval($cre_cap_8));
    		$content .= "\$cre_cap_8	= $cre_cap_8;\n";
	$blue_cap_8 = $_POST['blue_cap_8'];
        $blue_cap_8 = abs(intval($blue_cap_8));
    		$content .= "\$blue_cap_8	= $blue_cap_8;\n";
	$point_cap_8 = $_POST['point_cap_8'];
        $point_cap_8 = abs(intval($point_cap_8));
    		$content .= "\$point_cap_8	= $point_cap_8;\n";
	$ml_cap_8 = $_POST['ml_cap_8'];
        $ml_cap_8 = abs(intval($ml_cap_8));
    	   	$content .= "\$ml_cap_8	= $ml_cap_8;\n";
//Reset từ lần Cấp 8 tới Cấp 9
$reset_cap_9 = $_POST['reset_cap_9'];
    $reset_cap_9 = abs(intval($reset_cap_9));
		$content .= "\$reset_cap_9	= $reset_cap_9;\n";
	$level_cap_9 = $_POST['level_cap_9'];
        $level_cap_9 = abs(intval($level_cap_9));
    		$content .= "\$level_cap_9	= $level_cap_9;\n";
	$zen_cap_9 = $_POST['zen_cap_9'];
        $zen_cap_9 = abs(intval($zen_cap_9));
    		$content .= "\$zen_cap_9	= $zen_cap_9;\n";
	$time_reset_next_9 = $_POST['time_reset_next_9'];
        $time_reset_next_9 = abs(intval($time_reset_next_9));
    		$content .= "\$time_reset_next_9	= $time_reset_next_9;\n";
	$chao_cap_9 = $_POST['chao_cap_9'];
        $chao_cap_9 = abs(intval($chao_cap_9));
    		$content .= "\$chao_cap_9	= $chao_cap_9;\n";
	$cre_cap_9 = $_POST['cre_cap_9'];
        $cre_cap_9 = abs(intval($cre_cap_9));
    		$content .= "\$cre_cap_9	= $cre_cap_9;\n";
	$blue_cap_9 = $_POST['blue_cap_9'];
        $blue_cap_9 = abs(intval($blue_cap_9));
    		$content .= "\$blue_cap_9	= $blue_cap_9;\n";
	$point_cap_9 = $_POST['point_cap_9'];
        $point_cap_9 = abs(intval($point_cap_9));
    		$content .= "\$point_cap_9	= $point_cap_9;\n";
	$ml_cap_9 = $_POST['ml_cap_9'];
        $ml_cap_9 = abs(intval($ml_cap_9));
    		$content .= "\$ml_cap_9	= $ml_cap_9;\n";
//Reset từ lần Cấp 9 tới Cấp 10
$reset_cap_10 = $_POST['reset_cap_10'];
    $reset_cap_10 = abs(intval($reset_cap_10));
		$content .= "\$reset_cap_10	= $reset_cap_10;\n";
	$level_cap_10 = $_POST['level_cap_10'];
        $level_cap_10 = abs(intval($level_cap_10));
    		$content .= "\$level_cap_10	= $level_cap_10;\n";
	$zen_cap_10 = $_POST['zen_cap_10'];
        $zen_cap_10 = abs(intval($zen_cap_10));
    		$content .= "\$zen_cap_10	= $zen_cap_10;\n";
	$time_reset_next_10 = $_POST['time_reset_next_10'];
        $time_reset_next_10 = abs(intval($time_reset_next_10));
    		$content .= "\$time_reset_next_10	= $time_reset_next_10;\n";
	$chao_cap_10 = $_POST['chao_cap_10'];
        $chao_cap_10 = abs(intval($chao_cap_10));
    		$content .= "\$chao_cap_10	= $chao_cap_10;\n";
	$cre_cap_10 = $_POST['cre_cap_10'];
        $cre_cap_10 = abs(intval($cre_cap_10));
    		$content .= "\$cre_cap_10	= $cre_cap_10;\n";
	$blue_cap_10 = $_POST['blue_cap_10'];
        $blue_cap_10 = abs(intval($blue_cap_10));
    		$content .= "\$blue_cap_10	= $blue_cap_10;\n";
	$point_cap_10 = $_POST['point_cap_10'];
        $point_cap_10 = abs(intval($point_cap_10));
    		$content .= "\$point_cap_10	= $point_cap_10;\n";
	$ml_cap_10 = $_POST['ml_cap_10'];
        $ml_cap_10 = abs(intval($ml_cap_10));
    	   	$content .= "\$ml_cap_10	= $ml_cap_10;\n";
//Reset từ lần Cấp 10 tới Cấp 11
$reset_cap_11 = $_POST['reset_cap_11'];
    $reset_cap_11 = abs(intval($reset_cap_11));
		$content .= "\$reset_cap_11	= $reset_cap_11;\n";
	$level_cap_11 = $_POST['level_cap_11'];
        $level_cap_11 = abs(intval($level_cap_11));
    		$content .= "\$level_cap_11	= $level_cap_11;\n";
	$zen_cap_11 = $_POST['zen_cap_11'];
        $zen_cap_11 = abs(intval($zen_cap_11));
    		$content .= "\$zen_cap_11	= $zen_cap_11;\n";
	$time_reset_next_11 = $_POST['time_reset_next_11'];
        $time_reset_next_11 = abs(intval($time_reset_next_11));
    		$content .= "\$time_reset_next_11	= $time_reset_next_11;\n";
	$chao_cap_11 = $_POST['chao_cap_11'];
        $chao_cap_11 = abs(intval($chao_cap_11));
    		$content .= "\$chao_cap_11	= $chao_cap_11;\n";
	$cre_cap_11 = $_POST['cre_cap_11'];
        $cre_cap_11 = abs(intval($cre_cap_11));
    		$content .= "\$cre_cap_11	= $cre_cap_11;\n";
	$blue_cap_11 = $_POST['blue_cap_11'];
        $blue_cap_11 = abs(intval($blue_cap_11));
    		$content .= "\$blue_cap_11	= $blue_cap_11;\n";
	$point_cap_11 = $_POST['point_cap_11'];
        $point_cap_11 = abs(intval($point_cap_11));
    		$content .= "\$point_cap_11	= $point_cap_11;\n";
	$ml_cap_11 = $_POST['ml_cap_11'];
        $ml_cap_11 = abs(intval($ml_cap_11));
    		$content .= "\$ml_cap_11	= $ml_cap_11;\n";
//Reset từ lần Cấp 11 tới Cấp 12
$reset_cap_12 = $_POST['reset_cap_12'];
    $reset_cap_12 = abs(intval($reset_cap_12));
		$content .= "\$reset_cap_12	= $reset_cap_12;\n";
	$level_cap_12 = $_POST['level_cap_12'];
        $level_cap_12 = abs(intval($level_cap_12));
    		$content .= "\$level_cap_12	= $level_cap_12;\n";
	$zen_cap_12 = $_POST['zen_cap_12'];
        $zen_cap_12 = abs(intval($zen_cap_12));
    		$content .= "\$zen_cap_12	= $zen_cap_12;\n";
	$time_reset_next_12 = $_POST['time_reset_next_12'];
        $time_reset_next_12 = abs(intval($time_reset_next_12));
    		$content .= "\$time_reset_next_12	= $time_reset_next_12;\n";
	$chao_cap_12 = $_POST['chao_cap_12'];
        $chao_cap_12 = abs(intval($chao_cap_12));
    		$content .= "\$chao_cap_12	= $chao_cap_12;\n";
	$cre_cap_12 = $_POST['cre_cap_12'];
        $cre_cap_12 = abs(intval($cre_cap_12));
    		$content .= "\$cre_cap_12	= $cre_cap_12;\n";
	$blue_cap_12 = $_POST['blue_cap_12'];
        $blue_cap_12 = abs(intval($blue_cap_12));
    		$content .= "\$blue_cap_12	= $blue_cap_12;\n";
	$point_cap_12 = $_POST['point_cap_12'];
        $point_cap_12 = abs(intval($point_cap_12));
    		$content .= "\$point_cap_12	= $point_cap_12;\n";
	$ml_cap_12 = $_POST['ml_cap_12'];
        $ml_cap_12 = abs(intval($ml_cap_12));
    		$content .= "\$ml_cap_12	= $ml_cap_12;\n";
//Reset từ lần Cấp 12 tới Cấp 13
$reset_cap_13 = $_POST['reset_cap_13'];
    $reset_cap_13 = abs(intval($reset_cap_13));
		$content .= "\$reset_cap_13	= $reset_cap_13;\n";
	$level_cap_13 = $_POST['level_cap_13'];
        $level_cap_13 = abs(intval($level_cap_13));
    		$content .= "\$level_cap_13	= $level_cap_13;\n";
	$zen_cap_13 = $_POST['zen_cap_13'];
        $zen_cap_13 = abs(intval($zen_cap_13));
    		$content .= "\$zen_cap_13	= $zen_cap_13;\n";
	$time_reset_next_13 = $_POST['time_reset_next_13'];
        $time_reset_next_13 = abs(intval($time_reset_next_13));
    		$content .= "\$time_reset_next_13	= $time_reset_next_13;\n";
	$chao_cap_13 = $_POST['chao_cap_13'];
        $chao_cap_13 = abs(intval($chao_cap_13));
    		$content .= "\$chao_cap_13	= $chao_cap_13;\n";
	$cre_cap_13 = $_POST['cre_cap_13'];
        $cre_cap_13 = abs(intval($cre_cap_13));
    		$content .= "\$cre_cap_13	= $cre_cap_13;\n";
	$blue_cap_13 = $_POST['blue_cap_13'];
        $blue_cap_13 = abs(intval($blue_cap_13));
    		$content .= "\$blue_cap_13	= $blue_cap_13;\n";
	$point_cap_13 = $_POST['point_cap_13'];	
        $point_cap_13 = abs(intval($point_cap_13));
        	$content .= "\$point_cap_13	= $point_cap_13;\n";
	$ml_cap_13 = $_POST['ml_cap_13'];
        $ml_cap_13 = abs(intval($ml_cap_13));
    		$content .= "\$ml_cap_13	= $ml_cap_13;\n";
//Reset từ lần Cấp 13 tới Cấp 14
$reset_cap_14 = $_POST['reset_cap_14'];
    $reset_cap_14 = abs(intval($reset_cap_14));
		$content .= "\$reset_cap_14	= $reset_cap_14;\n";
	$level_cap_14 = $_POST['level_cap_14'];
        $level_cap_14 = abs(intval($level_cap_14));
    		$content .= "\$level_cap_14	= $level_cap_14;\n";
	$zen_cap_14 = $_POST['zen_cap_14'];
        $zen_cap_14 = abs(intval($zen_cap_14));
    		$content .= "\$zen_cap_14	= $zen_cap_14;\n";
	$time_reset_next_14 = $_POST['time_reset_next_14'];
        $time_reset_next_14 = abs(intval($time_reset_next_14));
    		$content .= "\$time_reset_next_14	= $time_reset_next_14;\n";
	$chao_cap_14 = $_POST['chao_cap_14'];
        $chao_cap_14 = abs(intval($chao_cap_14));
    		$content .= "\$chao_cap_14	= $chao_cap_14;\n";
	$cre_cap_14 = $_POST['cre_cap_14'];
        $cre_cap_14 = abs(intval($cre_cap_14));
    		$content .= "\$cre_cap_14	= $cre_cap_14;\n";
	$blue_cap_14 = $_POST['blue_cap_14'];
        $blue_cap_14 = abs(intval($blue_cap_14));
    		$content .= "\$blue_cap_14	= $blue_cap_14;\n";
	$point_cap_14 = $_POST['point_cap_14'];
        $point_cap_14 = abs(intval($point_cap_14));
    		$content .= "\$point_cap_14	= $point_cap_14;\n";
	$ml_cap_14 = $_POST['ml_cap_14'];
        $ml_cap_14 = abs(intval($ml_cap_14));
    		$content .= "\$ml_cap_14	= $ml_cap_14;\n";
//Reset từ lần Cấp 14 tới Cấp 15
$reset_cap_15 = $_POST['reset_cap_15'];
    $reset_cap_15 = abs(intval($reset_cap_15));
		$content .= "\$reset_cap_15	= $reset_cap_15;\n";
	$level_cap_15 = $_POST['level_cap_15'];
        $level_cap_15 = abs(intval($level_cap_15));
    		$content .= "\$level_cap_15	= $level_cap_15;\n";
	$zen_cap_15 = $_POST['zen_cap_15'];
        $zen_cap_15 = abs(intval($zen_cap_15));
    		$content .= "\$zen_cap_15	= $zen_cap_15;\n";
	$time_reset_next_15 = $_POST['time_reset_next_15'];
        $time_reset_next_15 = abs(intval($time_reset_next_15));
    		$content .= "\$time_reset_next_15	= $time_reset_next_15;\n";
	$chao_cap_15 = $_POST['chao_cap_15'];
        $chao_cap_15 = abs(intval($chao_cap_15));
    		$content .= "\$chao_cap_15	= $chao_cap_15;\n";
	$cre_cap_15 = $_POST['cre_cap_15'];
        $cre_cap_15 = abs(intval($cre_cap_15));
    		$content .= "\$cre_cap_15	= $cre_cap_15;\n";
	$blue_cap_15 = $_POST['blue_cap_15'];
        $blue_cap_15 = abs(intval($blue_cap_15));
    		$content .= "\$blue_cap_15	= $blue_cap_15;\n";
	$point_cap_15 = $_POST['point_cap_15'];
        $point_cap_15 = abs(intval($point_cap_15));
    		$content .= "\$point_cap_15	= $point_cap_15;\n";
	$ml_cap_15 = $_POST['ml_cap_15'];
        $ml_cap_15 = abs(intval($ml_cap_15));
    		$content .= "\$ml_cap_15	= $ml_cap_15;\n";
//Reset từ lần Cấp 15 tới Cấp 16
$reset_cap_16 = $_POST['reset_cap_16'];
    $reset_cap_16 = abs(intval($reset_cap_16));
		$content .= "\$reset_cap_16	= $reset_cap_16;\n";
	$level_cap_16 = $_POST['level_cap_16'];
        $level_cap_16 = abs(intval($level_cap_16));
    		$content .= "\$level_cap_16	= $level_cap_16;\n";
	$zen_cap_16 = $_POST['zen_cap_16'];
        $zen_cap_16 = abs(intval($zen_cap_16));
    		$content .= "\$zen_cap_16	= $zen_cap_16;\n";
	$time_reset_next_16 = $_POST['time_reset_next_16'];
        $time_reset_next_16 = abs(intval($time_reset_next_16));
    		$content .= "\$time_reset_next_16	= $time_reset_next_16;\n";
	$chao_cap_16 = $_POST['chao_cap_16'];
        $chao_cap_16 = abs(intval($chao_cap_16));
    		$content .= "\$chao_cap_16	= $chao_cap_16;\n";
	$cre_cap_16 = $_POST['cre_cap_16'];
        $cre_cap_16 = abs(intval($cre_cap_16));
    		$content .= "\$cre_cap_16	= $cre_cap_16;\n";
	$blue_cap_16 = $_POST['blue_cap_16'];
        $blue_cap_16 = abs(intval($blue_cap_16));
    		$content .= "\$blue_cap_16	= $blue_cap_16;\n";
	$point_cap_16 = $_POST['point_cap_16'];
        $point_cap_16 = abs(intval($point_cap_16));
    		$content .= "\$point_cap_16	= $point_cap_16;\n";
	$ml_cap_16 = $_POST['ml_cap_16'];
        $ml_cap_16 = abs(intval($ml_cap_16));
    		$content .= "\$ml_cap_16	= $ml_cap_16;\n";
//Reset từ lần Cấp 16 tới Cấp 17
$reset_cap_17 = $_POST['reset_cap_17'];
    $reset_cap_17 = abs(intval($reset_cap_17));
		$content .= "\$reset_cap_17	= $reset_cap_17;\n";
	$level_cap_17 = $_POST['level_cap_17'];
        $level_cap_17 = abs(intval($level_cap_17));
    		$content .= "\$level_cap_17	= $level_cap_17;\n";
	$zen_cap_17 = $_POST['zen_cap_17'];
        $zen_cap_17 = abs(intval($zen_cap_17));
    		$content .= "\$zen_cap_17	= $zen_cap_17;\n";
	$time_reset_next_17 = $_POST['time_reset_next_17'];
        $time_reset_next_17 = abs(intval($time_reset_next_17));
    		$content .= "\$time_reset_next_17	= $time_reset_next_17;\n";
	$chao_cap_17 = $_POST['chao_cap_17'];
        $chao_cap_17 = abs(intval($chao_cap_17));
    		$content .= "\$chao_cap_17	= $chao_cap_17;\n";
	$cre_cap_17 = $_POST['cre_cap_17'];
        $cre_cap_17 = abs(intval($cre_cap_17));
    		$content .= "\$cre_cap_17	= $cre_cap_17;\n";
	$blue_cap_17 = $_POST['blue_cap_17'];
        $blue_cap_17 = abs(intval($blue_cap_17));
    		$content .= "\$blue_cap_17	= $blue_cap_17;\n";
	$point_cap_17 = $_POST['point_cap_17'];
        $point_cap_17 = abs(intval($point_cap_17));
    		$content .= "\$point_cap_17	= $point_cap_17;\n";
	$ml_cap_17 = $_POST['ml_cap_17'];
        $ml_cap_17 = abs(intval($ml_cap_17));
    		$content .= "\$ml_cap_17	= $ml_cap_17;\n";
//Reset từ lần Cấp 17 tới Cấp 18
$reset_cap_18 = $_POST['reset_cap_18'];
    $reset_cap_18 = abs(intval($reset_cap_18));
		$content .= "\$reset_cap_18	= $reset_cap_18;\n";
	$level_cap_18 = $_POST['level_cap_18'];
        $level_cap_18 = abs(intval($level_cap_18));
    		$content .= "\$level_cap_18	= $level_cap_18;\n";
	$zen_cap_18 = $_POST['zen_cap_18'];
        $zen_cap_18 = abs(intval($zen_cap_18));
    		$content .= "\$zen_cap_18	= $zen_cap_18;\n";
	$time_reset_next_18 = $_POST['time_reset_next_18'];
        $time_reset_next_18 = abs(intval($time_reset_next_18));
    		$content .= "\$time_reset_next_18	= $time_reset_next_18;\n";
	$chao_cap_18 = $_POST['chao_cap_18'];
        $chao_cap_18 = abs(intval($chao_cap_18));
    		$content .= "\$chao_cap_18	= $chao_cap_18;\n";
	$cre_cap_18 = $_POST['cre_cap_18'];
        $cre_cap_18 = abs(intval($cre_cap_18));
    		$content .= "\$cre_cap_18	= $cre_cap_18;\n";
	$blue_cap_18 = $_POST['blue_cap_18'];
        $blue_cap_18 = abs(intval($blue_cap_18));
    		$content .= "\$blue_cap_18	= $blue_cap_18;\n";
	$point_cap_18 = $_POST['point_cap_18'];
        $point_cap_18 = abs(intval($point_cap_18));
    		$content .= "\$point_cap_18	= $point_cap_18;\n";
	$ml_cap_18 = $_POST['ml_cap_18'];
        $ml_cap_18 = abs(intval($ml_cap_18));
    		$content .= "\$ml_cap_18	= $ml_cap_18;\n";
//Reset từ lần Cấp 18 tới Cấp 19
$reset_cap_19 = $_POST['reset_cap_19'];
    $reset_cap_19 = abs(intval($reset_cap_19));
		$content .= "\$reset_cap_19	= $reset_cap_19;\n";
	$level_cap_19 = $_POST['level_cap_19'];
        $level_cap_19 = abs(intval($level_cap_19));
    		$content .= "\$level_cap_19	= $level_cap_19;\n";
	$zen_cap_19 = $_POST['zen_cap_19'];
        $zen_cap_19 = abs(intval($zen_cap_19));
    		$content .= "\$zen_cap_19	= $zen_cap_19;\n";
	$time_reset_next_19 = $_POST['time_reset_next_19'];
        $time_reset_next_19 = abs(intval($time_reset_next_19));
    		$content .= "\$time_reset_next_19	= $time_reset_next_19;\n";
	$chao_cap_19 = $_POST['chao_cap_19'];
        $chao_cap_19 = abs(intval($chao_cap_19));
    		$content .= "\$chao_cap_19	= $chao_cap_19;\n";
	$cre_cap_19 = $_POST['cre_cap_19'];
        $cre_cap_19 = abs(intval($cre_cap_19));
    		$content .= "\$cre_cap_19	= $cre_cap_19;\n";
	$blue_cap_19 = $_POST['blue_cap_19'];
        $blue_cap_19 = abs(intval($blue_cap_19));
    		$content .= "\$blue_cap_19	= $blue_cap_19;\n";
	$point_cap_19 = $_POST['point_cap_19'];
        $point_cap_19 = abs(intval($point_cap_19));
    		$content .= "\$point_cap_19	= $point_cap_19;\n";
	$ml_cap_19 = $_POST['ml_cap_19'];
        $ml_cap_19 = abs(intval($ml_cap_19));
    		$content .= "\$ml_cap_19	= $ml_cap_19;\n";
//Reset từ lần Cấp 19 tới Cấp 20
$reset_cap_20 = $_POST['reset_cap_20'];	
    $reset_cap_20 = abs(intval($reset_cap_20));
    	$content .= "\$reset_cap_20	= $reset_cap_20;\n";
	$level_cap_20 = $_POST['level_cap_20'];
        $level_cap_20 = abs(intval($level_cap_20));
    		$content .= "\$level_cap_20	= $level_cap_20;\n";
	$zen_cap_20 = $_POST['zen_cap_20'];
        $zen_cap_20 = abs(intval($zen_cap_20));
    		$content .= "\$zen_cap_20	= $zen_cap_20;\n";
	$time_reset_next_20 = $_POST['time_reset_next_20'];
        $time_reset_next_20 = abs(intval($time_reset_next_20));
    		$content .= "\$time_reset_next_20	= $time_reset_next_20;\n";
	$chao_cap_20 = $_POST['chao_cap_20'];
        $chao_cap_20 = abs(intval($chao_cap_20));
    		$content .= "\$chao_cap_20	= $chao_cap_20;\n";
	$cre_cap_20 = $_POST['cre_cap_20'];
        $cre_cap_20 = abs(intval($cre_cap_20));
    		$content .= "\$cre_cap_20	= $cre_cap_20;\n";
	$blue_cap_20 = $_POST['blue_cap_20'];
        $blue_cap_20 = abs(intval($blue_cap_20));
    		$content .= "\$blue_cap_20	= $blue_cap_20;\n";
	$point_cap_20 = $_POST['point_cap_20'];
        $point_cap_20 = abs(intval($point_cap_20));
    		$content .= "\$point_cap_20	= $point_cap_20;\n";
	$ml_cap_20 = $_POST['ml_cap_20'];
        $ml_cap_20 = abs(intval($ml_cap_20));
    		$content .= "\$ml_cap_20	= $ml_cap_20;\n";
	
	
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
	replacecontent($file_edit,$content);
	
	include('config/config_sync.php');
    for($i=0; $i<count($url_hosting); $i++)
    {
        if($url_hosting[$i]) {
            $sync_send = _sync($url_hosting[$i], $file_edit, $content);
            if($sync_send == 'OK') {
                
            } else {
                $err .= $sync_send;
            }
        }
    }
    
	if($err) {
        $notice = "<center><font color='red'><strong>Lỗi :</strong><br />$err</font></center>";
    } else {
    	$notice = "<center><font color='blue'>Sửa thành công</font></center>";
    }
}

include($file_edit);
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Reset</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				Level nhân vật sau khi Reset : <input type="text" name="level_after_reset" value="<?php echo $level_after_reset; ?>" size="2"/><br>
				Số cấp Reset hiển thị dành cho người chơi : <input type="text" name="cap_reset_max" value="<?php echo $cap_reset_max; ?>" size="2"/><br>
				Số cấp Reset nhỏ nhất để ghi Log (Reset lớn hơn sẽ được ghi vào Log) : <input type="text" name="log_reset" value="<?php echo $log_reset; ?>" size="2"/><br><br>
				<i><b>Time</b>: Là khoảng thời gian được phép thực hiện lần Reset tiếp theo (tính theo phút)</i><br><br>
				<table width="100%" border="0" bgcolor="#9999FF">
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp Reset</b></td>
				    <td align="center"><b>Reset</b></td>
				    <td align="center"><b>Level</b></td>
				    <td align="center"><b>Zen</b></td>
				    <td align="center"><b>Chao</b></td>
				    <td align="center"><b>Create</b></td>
				    <td align="center"><b>Blue</b></td>
				    <td align="center"><b>Point</b></td>
				    <td align="center"><b>Mệnh lệnh</b></td>
				    <td align="center"><b>Time</b></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 1</b></td>
				    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - "; ?><input type="text" name="reset_cap_1" value="<?php echo $reset_cap_1; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_1" value="<?php echo $level_cap_1; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_1" value="<?php echo $zen_cap_1; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_1" value="<?php echo $chao_cap_1; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_1" value="<?php echo $cre_cap_1; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_1" value="<?php echo $blue_cap_1; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_1" value="<?php echo $point_cap_1; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_1" value="<?php echo $ml_cap_1; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_1" value="<?php echo $time_reset_next_1; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 2</b></td>
				    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - "; ?><input type="text" name="reset_cap_2" value="<?php echo $reset_cap_2; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_2" value="<?php echo $level_cap_2; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_2" value="<?php echo $zen_cap_2; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_2" value="<?php echo $chao_cap_2; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_2" value="<?php echo $cre_cap_2; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_2" value="<?php echo $blue_cap_2; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_2" value="<?php echo $point_cap_2; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_2" value="<?php echo $ml_cap_2; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_2" value="<?php echo $time_reset_next_2; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 3</b></td>
				    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - "; ?><input type="text" name="reset_cap_3" value="<?php echo $reset_cap_3; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_3" value="<?php echo $level_cap_3; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_3" value="<?php echo $zen_cap_3; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_3" value="<?php echo $chao_cap_3; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_3" value="<?php echo $cre_cap_3; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_3" value="<?php echo $blue_cap_3; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_3" value="<?php echo $point_cap_3; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_3" value="<?php echo $ml_cap_3; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_3" value="<?php echo $time_reset_next_3; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 4</b></td>
				    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - "; ?><input type="text" name="reset_cap_4" value="<?php echo $reset_cap_4; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_4" value="<?php echo $level_cap_4; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_4" value="<?php echo $zen_cap_4; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_4" value="<?php echo $chao_cap_4; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_4" value="<?php echo $cre_cap_4; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_4" value="<?php echo $blue_cap_4; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_4" value="<?php echo $point_cap_4; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_4" value="<?php echo $ml_cap_4; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_4" value="<?php echo $time_reset_next_4; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 5</b></td>
				    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - "; ?><input type="text" name="reset_cap_5" value="<?php echo $reset_cap_5; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_5" value="<?php echo $level_cap_5; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_5" value="<?php echo $zen_cap_5; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_5" value="<?php echo $chao_cap_5; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_5" value="<?php echo $cre_cap_5; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_5" value="<?php echo $blue_cap_5; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_5" value="<?php echo $point_cap_5; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_5" value="<?php echo $ml_cap_5; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_5" value="<?php echo $time_reset_next_5; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 6</b></td>
				    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - "; ?><input type="text" name="reset_cap_6" value="<?php echo $reset_cap_6; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_6" value="<?php echo $level_cap_6; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_6" value="<?php echo $zen_cap_6; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_6" value="<?php echo $chao_cap_6; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_6" value="<?php echo $cre_cap_6; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_6" value="<?php echo $blue_cap_6; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_6" value="<?php echo $point_cap_6; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_6" value="<?php echo $ml_cap_6; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_6" value="<?php echo $time_reset_next_6; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 7</b></td>
				    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - "; ?><input type="text" name="reset_cap_7" value="<?php echo $reset_cap_7; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_7" value="<?php echo $level_cap_7; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_7" value="<?php echo $zen_cap_7; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_7" value="<?php echo $chao_cap_7; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_7" value="<?php echo $cre_cap_7; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_7" value="<?php echo $blue_cap_7; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_7" value="<?php echo $point_cap_7; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_7" value="<?php echo $ml_cap_7; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_7" value="<?php echo $time_reset_next_7; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 8</b></td>
				    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - "; ?><input type="text" name="reset_cap_8" value="<?php echo $reset_cap_8; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_8" value="<?php echo $level_cap_8; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_8" value="<?php echo $zen_cap_8; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_8" value="<?php echo $chao_cap_8; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_8" value="<?php echo $cre_cap_8; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_8" value="<?php echo $blue_cap_8; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_8" value="<?php echo $point_cap_8; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_8" value="<?php echo $ml_cap_8; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_8" value="<?php echo $time_reset_next_8; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 9</b></td>
				    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - "; ?><input type="text" name="reset_cap_9" value="<?php echo $reset_cap_9; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_9" value="<?php echo $level_cap_9; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_9" value="<?php echo $zen_cap_9; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_9" value="<?php echo $chao_cap_9; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_9" value="<?php echo $cre_cap_9; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_9" value="<?php echo $blue_cap_9; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_9" value="<?php echo $point_cap_9; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_9" value="<?php echo $ml_cap_9; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_9" value="<?php echo $time_reset_next_9; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 10</b></td>
				    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - "; ?><input type="text" name="reset_cap_10" value="<?php echo $reset_cap_10; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_10" value="<?php echo $level_cap_10; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_10" value="<?php echo $zen_cap_10; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_10" value="<?php echo $chao_cap_10; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_10" value="<?php echo $cre_cap_10; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_10" value="<?php echo $blue_cap_10; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_10" value="<?php echo $point_cap_10; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_10" value="<?php echo $ml_cap_10; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_10" value="<?php echo $time_reset_next_10; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 11</b></td>
				    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - "; ?><input type="text" name="reset_cap_11" value="<?php echo $reset_cap_11; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_11" value="<?php echo $level_cap_11; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_11" value="<?php echo $zen_cap_11; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_11" value="<?php echo $chao_cap_11; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_11" value="<?php echo $cre_cap_11; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_11" value="<?php echo $blue_cap_11; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_11" value="<?php echo $point_cap_11; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_11" value="<?php echo $ml_cap_11; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_11" value="<?php echo $time_reset_next_11; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 12</b></td>
				    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - "; ?><input type="text" name="reset_cap_12" value="<?php echo $reset_cap_12; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_12" value="<?php echo $level_cap_12; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_12" value="<?php echo $zen_cap_12; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_12" value="<?php echo $chao_cap_12; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_12" value="<?php echo $cre_cap_12; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_12" value="<?php echo $blue_cap_12; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_12" value="<?php echo $point_cap_12; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_12" value="<?php echo $ml_cap_12; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_12" value="<?php echo $time_reset_next_12; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 13</b></td>
				    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - "; ?><input type="text" name="reset_cap_13" value="<?php echo $reset_cap_13; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_13" value="<?php echo $level_cap_13; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_13" value="<?php echo $zen_cap_13; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_13" value="<?php echo $chao_cap_13; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_13" value="<?php echo $cre_cap_13; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_13" value="<?php echo $blue_cap_13; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_13" value="<?php echo $point_cap_13; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_13" value="<?php echo $ml_cap_13; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_13" value="<?php echo $time_reset_next_13; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 14</b></td>
				    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - "; ?><input type="text" name="reset_cap_14" value="<?php echo $reset_cap_14; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_14" value="<?php echo $level_cap_14; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_14" value="<?php echo $zen_cap_14; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_14" value="<?php echo $chao_cap_14; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_14" value="<?php echo $cre_cap_14; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_14" value="<?php echo $blue_cap_14; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_14" value="<?php echo $point_cap_14; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_14" value="<?php echo $ml_cap_14; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_14" value="<?php echo $time_reset_next_14; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 15</b></td>
				    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - "; ?><input type="text" name="reset_cap_15" value="<?php echo $reset_cap_15; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_15" value="<?php echo $level_cap_15; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_15" value="<?php echo $zen_cap_15; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_15" value="<?php echo $chao_cap_15; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_15" value="<?php echo $cre_cap_15; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_15" value="<?php echo $blue_cap_15; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_15" value="<?php echo $point_cap_15; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_15" value="<?php echo $ml_cap_15; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_15" value="<?php echo $time_reset_next_15; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 16</b></td>
				    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - "; ?><input type="text" name="reset_cap_16" value="<?php echo $reset_cap_16; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_16" value="<?php echo $level_cap_16; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_16" value="<?php echo $zen_cap_16; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_16" value="<?php echo $chao_cap_16; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_16" value="<?php echo $cre_cap_16; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_16" value="<?php echo $blue_cap_16; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_16" value="<?php echo $point_cap_16; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_16" value="<?php echo $ml_cap_16; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_16" value="<?php echo $time_reset_next_16; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 17</b></td>
				    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - "; ?><input type="text" name="reset_cap_17" value="<?php echo $reset_cap_17; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_17" value="<?php echo $level_cap_17; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_17" value="<?php echo $zen_cap_17; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_17" value="<?php echo $chao_cap_17; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_17" value="<?php echo $cre_cap_17; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_17" value="<?php echo $blue_cap_17; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_17" value="<?php echo $point_cap_17; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_17" value="<?php echo $ml_cap_17; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_17" value="<?php echo $time_reset_next_17; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 18</b></td>
				    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - "; ?><input type="text" name="reset_cap_18" value="<?php echo $reset_cap_18; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_18" value="<?php echo $level_cap_18; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_18" value="<?php echo $zen_cap_18; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_18" value="<?php echo $chao_cap_18; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_18" value="<?php echo $cre_cap_18; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_18" value="<?php echo $blue_cap_18; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_18" value="<?php echo $point_cap_18; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_18" value="<?php echo $ml_cap_18; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_18" value="<?php echo $time_reset_next_18; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 19</b></td>
				    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - "; ?><input type="text" name="reset_cap_19" value="<?php echo $reset_cap_19; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_19" value="<?php echo $level_cap_19; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_19" value="<?php echo $zen_cap_19; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_19" value="<?php echo $chao_cap_19; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_19" value="<?php echo $cre_cap_19; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_19" value="<?php echo $blue_cap_19; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_19" value="<?php echo $point_cap_19; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_19" value="<?php echo $ml_cap_19; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_19" value="<?php echo $time_reset_next_19; ?>" size="1"/></td>
				  </tr>
				  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Cấp 20</b></td>
				    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - "; ?><input type="text" name="reset_cap_20" value="<?php echo $reset_cap_20; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="level_cap_20" value="<?php echo $level_cap_20; ?>" size="2"/></td>
				    <td align="center"><input type="text" name="zen_cap_20" value="<?php echo $zen_cap_20; ?>" size="10"/></td>
				    <td align="center"><input type="text" name="chao_cap_20" value="<?php echo $chao_cap_20; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="cre_cap_20" value="<?php echo $cre_cap_20; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="blue_cap_20" value="<?php echo $blue_cap_20; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="point_cap_20" value="<?php echo $point_cap_20; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="ml_cap_20" value="<?php echo $ml_cap_20; ?>" size="1"/></td>
				    <td align="center"><input type="text" name="time_reset_next_20" value="<?php echo $time_reset_next_20; ?>" size="1"/></td>
				  </tr>
				</table>
				<center><input type="submit" name="Submit" value="Sửa" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></center>
				</form>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br>
			- Tên WebSite<br>
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
