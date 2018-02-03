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
 
	include("security.php");
include_once('../config.php');
include_once('function.php');
$noitem = "FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF";
$kris_non = "00000000000000000000000000000000";
$title = "Item Log - List Item";

SESSION_start();
if ($_POST[submit]) {
	$pass_online = md5($_POST[online]);
	if ($pass_online == "$passcode") $_SESSION['online'] = "$passcode";
}
if (!$_SESSION['online'] || $_SESSION['online'] != "$passcode") {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='online'>
	Code: <input type=password name=online> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
?>

<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body bgcolor="#F9E7CF">
<?php require('linktop.php'); ?>
<?php
    $acc = $_GET['acc'];
    $type = $_GET['type'];
    if($type == 'inventory') {
        $name = $_GET['name'];
    }
    $logtime = $_GET['logtime'];
    $logtime = date('Y-m-d H:i:s', $logtime);
?>
<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="4" align="center">
		Log Item tài khoản <strong><font color='red'><?php echo $acc; ?></font></strong> <?php if(isset($name)) echo "- Nhân vật <strong><font color='blue'>$name</font></strong>" ?> tại thời điểm <strong><font color='brown'><?php echo $logtime; ?></font></strong>
	</td>
</tr>

<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Hình ảnh</td>
    <td align="center">Item</td>
	<td align="center">Thông tin Item</td>
</tr>


<?php    
    if($type == 'warehouse') {
        $warehouse_query = "SELECT Items FROM NBB_Log_WareHouse WHERE acc='$acc' AND log_time='$logtime'";
        $warehouse_result = $db->Execute($warehouse_query);
            check_queryerror($warehouse_query, $warehouse_result);
        $warehouse_fetch = $warehouse_result->FetchRow();
        $item_list = $warehouse_fetch[0];
    } else {
        $inventory_query = "SELECT Inventory FROM NBB_Log_Inventory WHERE acc='$acc' AND name='$name' AND log_time='$logtime'";
        $inventory_result = $db->Execute($inventory_query);
            check_queryerror($inventory_query, $inventory_result);
        $inventory_fetch = $inventory_result->FetchRow();
        $item_list = $inventory_fetch[0];
    }
    $item_list = bin2hex($item_list);
    $item_list = strtoupper($item_list);
    $item_total = floor(strlen($item_list)/32);
    
    $item_arr = array();
    for($i=0; $i<$item_total; $i++) {
        $item = substr($item_list,$i*32, 32);
        if($item != $noitem && $item != $kris_non) {
            $item_arr[] = $item;
        }
    }
    
    $item_data = serialize($item_arr);
    include('../config_license.php');
    include_once('../func_getContent.php');
    $getcontent_url = $url_license . "/api_itemlog.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'item_data'    =>  $item_data
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $error = "Không kết nối được đến API";
        $err = true;
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $error = $reponse;
            $err = true;
        } elseif ($info == "OK") {
            $iteminfo = read_TagName($reponse, 'iteminfo');
            $iteminfo_arr = array();
            $iteminfo_arr = unserialize_safe($iteminfo);
            
            $stt = 0;
            foreach($iteminfo_arr as $key => $val) {
                ++$stt;
                $seri_hex = $val['item_seri'];
                $seri_dec = hexdec($seri_hex);
                if($seri_dec >= hexdec('FFFFFFF0')) {
                    $seri_hex = "<font color='red'><b>". $seri_hex . "</b></font>";
                    $seri_dec = "<font color='red'><b>". $seri_dec . "</b></font>";
                }
                
                echo "<tr bgcolor='#F9E7CF' >
            		<td align='center'>$stt</td>
                    <td align='center' style='background-color: #121212; font-size: 14px; text-align: center; padding: 10px;'><img src='../items/" . $val['item_image'] . ".gif' border=0 /></td>
            		<td align='center' style='background-color: #121212; font-size: 14px; text-align: center; padding: 10px;'>". $val['item_info'] ."</td>
            		<td align='left'>
                        <strong>Item Name</strong>: ". $val['item_name'] ."<br />
                        <strong>Item Code</strong>: ". $val['item_code'] ."<br />
                        <strong>Item Seri HEX</strong>: ". $seri_hex ."<br />
                        <strong>Item Seri DEC</strong>: ". $seri_dec ."
                    </td>";
                    
            	echo "</tr>";
            }
                
        } else {
            $error = "Kết nối API gặp sự cố.";
            $err = true;
        }
    }
    
    if($err === true) {
        echo "<tr bgcolor='#F9E7CF' ><td align='center' colspan='3'>$error</td></tr>";
    }
            
?>
												
</table>
<br>
<center>
<?php
$db->Close();
?>
</center>

</body>
</html>