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
$title = "Admin IP Bonus";
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

if($_POST['action'] == 'add_ipbonus') {
    $acc = $_POST['acc'];           $acc = antiinject_query($acc);
    $netname = $_POST['netname'];   $netname = antiinject_query($netname);
    $netaddr = $_POST['netaddr'];   $netaddr = antiinject_query($netaddr);
    $netquan = $_POST['netquan'];   $netquan = antiinject_query($netquan);
    $netquan_add = $_POST['netquan_add'];   $netquan_add = antiinject_query($netquan_add);
    $thanhpho = $_POST['thanhpho'];         $thanhpho = antiinject_query($thanhpho);
    $thanhpho_add = $_POST['thanhpho_add']; $thanhpho_add = antiinject_query($thanhpho_add);
    if(strlen($netquan_add) > 1) $netquan = $netquan_add;
    if(strlen($thanhpho_add) > 1) $thanhpho = $thanhpho_add;
    
    if(strlen($acc) == 0 || strlen($netname) == 0 || strlen($netaddr) == 0 || strlen($netquan) == 0 || strlen($thanhpho) == 0) {
        $notice = "Chưa điền đầy đủ dữ liệu";
    } else {
        $acc_check_query = "SELECT ip FROM MEMB_INFO WHERE memb___id='$acc'";
        $acc_check_result = $db->Execute($acc_check_query);
            check_queryerror($acc_check_query, $acc_check_result);
        $acc_check = $acc_check_result->NumRows();
        if($acc_check == 0) {
            $notice = "Tài khoản không tồn tại, vui lòng tạo tài khoản Game của chủ quán NET trước.";
        } else {
            $ip_fetch = $acc_check_result->FetchRow();
            $ip = $ip_fetch[0];
            $ipbonus_add_query = "INSERT INTO IPBonus (acc, ip, InternetName, Address, QuanHuyen, ThanhPho) VALUES ('$acc', '$ip', '$netname', '$netaddr', '$netquan', '$thanhpho')";
            $ipbonus_add_result = $db->Execute($ipbonus_add_query);
                check_queryerror($ipbonus_add_query, $ipbonus_add_result);
            $notice = "Thêm Quán NET $netname tham gia IP Bonus thành công";
        }
    }
}

if($_POST['action'] == 'del_ipbonus') {
    $ipbonus_id = $_POST['ipbonus_id']; $ipbonus_id = abs(intval($ipbonus_id));
    $ipbonus_del_query = "DELETE FROM IPBonus WHERE ipbonus_id='$ipbonus_id'";
    $ipbonus_del_result = $db->Execute($ipbonus_del_query);
        check_queryerror($ipbonus_del_query, $ipbonus_del_result);
    $notice = "Xóa IP Bonus thành công.";
}

if (isset($notice)) {
    echo "<blockquote>" . $notice . "</blockquote>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title><?php echo $title; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>
<body bgcolor="#F9E7CF">
<?php require ('linktop.php'); ?>

<form id="addipbonus" name="addipbonus" method="post" action="">
    <input type="hidden" name="action" value="add_ipbonus" />
  <strong>Thêm quán NET</strong> :<br />
  Tài khoản chủ tiệm NET : 
    <input name="acc" type="text" id="acc" value="<?php echo $_POST['acc']; ?>" /> 
    <br />
    Tên tiệm NET : 
    <input type="text" name="netname" value="<?php echo $_POST['netname']; ?>" />
    <br />
  Địa chỉ : 
  <input type="text" name="netaddr" value="<?php echo $_POST['netaddr']; ?>" />
  <br />
  Quận / Huyện : 
  <select name="netquan">
    <?php
        $quanhuyen_select_query = "SELECT QuanHuyen FROM IPBonus GROUP BY QuanHuyen ORDER BY QuanHuyen";
        $quanhuyen_select_result = $db->Execute($quanhuyen_select_query);
            check_queryerror($quanhuyen_select_query, $quanhuyen_select_result);
        while($quanhuyen_fetch = $quanhuyen_select_result->FetchRow()) {
            echo "<option value='$quanhuyen_fetch[0]'>$quanhuyen_fetch[0]</option>";
        }
    ?>
  </select>
  hoặc nhập
  <input type="text" name="netquan_add" value="<?php echo $_POST['netquan_add']; ?>" />
  <br />
  Thành phố : 
  <select name="thanhpho">
    <?php
        $thanhpho_select_query = "SELECT ThanhPho FROM IPBonus GROUP BY ThanhPho ORDER BY ThanhPho";
        $thanhpho_select_result = $db->Execute($thanhpho_select_query);
            check_queryerror($thanhpho_select_query, $thanhpho_select_result);
        while($thanhpho_fetch = $thanhpho_select_result->FetchRow()) {
            echo "<option value='$thanhpho_fetch[0]'>$thanhpho_fetch[0]</option>";
        }
    ?>
  </select>
hoặc nhập
  <input type="text" name="thanhpho_add" value="<?php echo $_POST['thanhpho_add']; ?>" />
  <br />
  <input type="submit" name="Submit" value="Thêm" />
</form>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="9" align="center">
		Danh sách IP Bonus
	</td>
</tr>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Tài khoản chủ NET</td>
    <td align="center">IP</td>
	<td align="center">Tên tiệm Internet</td>
	<td align="center">Địa chỉ</td>
	<td align="center">Quận / Huyện</td>
	<td align="center">Thành Phố</td>
    <td align="center">Tài khoản GAME</td>
	<td align="center">&nbsp;</td>
</tr>
<?php
    $ipbonus_list_query = "SELECT acc, ip, InternetName, Address, QuanHuyen, ThanhPho, totalacc, ipbonus_id FROM IPBonus ORDER BY ThanhPho, QuanHuyen, Address, InternetName, totalacc";
    $ipbonus_list_result = $db->Execute($ipbonus_list_query) OR DIE("Query Error : $ipbonus_list_query");
    $stt = 0;
    while($ipbonus_list_fetch = $ipbonus_list_result->FetchRow()) {
        $stt++;
?>
<tr bgcolor="#ffffcc" >
	<td align="center"><?php echo $stt; ?></td>
	<td align="center"><?php echo $ipbonus_list_fetch[0]; ?></td>
    <td align="center"><?php echo $ipbonus_list_fetch[1]; ?></td>
	<td align="center"><?php echo $ipbonus_list_fetch[2]; ?></td>
	<td align="center"><?php echo $ipbonus_list_fetch[3]; ?></td>
	<td align="center"><?php echo $ipbonus_list_fetch[4]; ?></td>
	<td align="center"><?php echo $ipbonus_list_fetch[5]; ?></td>
    <td align="center"><?php echo $ipbonus_list_fetch[6]; ?></td>
	<td align="center">
        <form id="del_ipbonus" name="del_ipbonus" method="post" action="">
          <input name="action" type="hidden" id="action" value="del_ipbonus" />
          <input name="ipbonus_id" type="hidden" id="ipbonus_id" value="<?php echo $ipbonus_list_fetch[7]; ?>" />
          <input type="submit" name="Submit" value="Xóa" />
        </form>
    </td>
</tr>
<?php
    }
$db->Close();
?>
</body>
</html>