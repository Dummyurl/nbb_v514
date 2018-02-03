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
include ('../config/config_relax_lo.php');
include ('function.php');

$title = "Kết Quả Xổ Số - Tổng Kết";
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
<form action="" name="frm_kqxs_tongket" id="frm_kqxs_tongket" method="POST">
    <center>
    Từ ngày : <input name="time_begin" id="time_begin" value="<?php echo $_POST['time_begin']; ?>" size="7" />
    Tới ngày : <input name="time_end" id="time_end" value="<?php echo $_POST['time_end']; ?>" size="7" />
    <br />
    <input type="submit" name="submit_frm_toptuan" value="Xem Kết Quả TOP" />
    </center>
</form>

<?php
if(isset($_POST['time_begin']) && isset($_POST['time_end']) ) {
    $time_begin = date('Y-m-d', strtotime($_POST['time_begin']));
    $time_end = date('Y-m-d', strtotime($_POST['time_end']));
    
    $lo_q = "SELECT diem, gcoin_win, status FROM NBB_Relax_Lo WHERE ngay>='$time_begin' AND ngay <= '$time_end'";
    $lo_r = $db->Execute($lo_q);
        check_queryerror($lo_q, $lo_r);
    $lo_gcoin_in_total = 0;
    $lo_gcoin_out_total = 0;
    $lo_diem_total = 0;
    while($lo_f = $lo_r->FetchRow()) {
        $diem = $lo_f[0];
        $gcoin_win = $lo_f[1];
        $status = $lo_f[2];
        
        $lo_diem_total += $diem;
        $lo_gcoin_in_total += $diem * $lo_diem_gcoin;
        if($status == 1) {
            $lo_gcoin_out_total += $gcoin_win;
        }
    }
    $lo_gcoin = $lo_gcoin_in_total - $lo_gcoin_out_total;
    
    
    $de_q = "SELECT gcoin_danh, gcoin_win, status FROM NBB_Relax_De WHERE ngay>='$time_begin' AND ngay <= '$time_end'";
    $de_r = $db->Execute($de_q);
        check_queryerror($de_q, $de_r);
    $de_gcoin_in_total = 0;
    $de_gcoin_out_total = 0;
    while($de_f = $de_r->FetchRow()) {
        $gcoin_danh = $de_f[0];
        $gcoin_win = $de_f[1];
        $status = $de_f[2];
        
        $de_gcoin_in_total += $gcoin_danh;
        if($status == 1) {
            $de_gcoin_out_total += $gcoin_win;
        }
    }
    $de_gcoin = $de_gcoin_in_total - $de_gcoin_out_total;
    
    
    echo "<hr />";
?>
<center>
Tổng kết Lô
<table style="border-collapse: collapse;" border="1" width="100%">
    <tr>
        <td align="center" valign="top"><strong>Tổng Điểm Lô Người chơi</strong></td>
        <td align="center" valign="top"><strong>Tổng Gcoin thu vào</strong></td>
        <td align="center" valign="top"><strong>Tổng Gcoin trả Gamer ăn Lô</strong></td>
        <td align="center" valign="top"><strong>Doanh Thu</strong></td>
    </tr>
    <tr>
        <td align="center" valign="top"><?php echo number_format($lo_gcoin_in_total, 0, ',', '.'); ?></td>
        <td align="center" valign="top">+ <?php echo number_format($lo_gcoin_in_total, 0, ',', '.'); ?> Gcoin</td>
        <td align="center" valign="top">- <?php echo number_format($lo_gcoin_out_total, 0, ',', '.'); ?> Gcoin</td>
        <td align="center" valign="top"><?php echo number_format($lo_gcoin, 0, ',', '.'); ?> Gcoin</td>
    </tr>
</table>
<br /><br />

Tổng kết Đề
<table style="border-collapse: collapse;" border="1" width="100%">
    <tr>
        <td align="center" valign="top"><strong>Tổng Gcoin thu vào</strong></td>
        <td align="center" valign="top"><strong>Tổng Gcoin trả Gamer ăn Đề</strong></td>
        <td align="center" valign="top"><strong>Doanh Thu</strong></td>
    </tr>
    <tr>
        <td align="center" valign="top">+ <?php echo number_format($de_gcoin_in_total, 0, ',', '.'); ?> Gcoin</td>
        <td align="center" valign="top">- <?php echo number_format($de_gcoin_out_total, 0, ',', '.'); ?> Gcoin</td>
        <td align="center" valign="top"><?php echo number_format($de_gcoin, 0, ',', '.'); ?> Gcoin</td>
    </tr>
</table>
<br /><br />
</center>

<?php
}
?>

</body>
</html>
<?php
$db->Close();
?>