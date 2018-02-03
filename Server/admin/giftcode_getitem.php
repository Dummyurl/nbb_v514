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
$title = "Lấy Mã phần thưởng GiftCode và WebShop";
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

$name = $_GET['name'];
if (!preg_match("/^[a-zA-Z0-9_]*$/i", $name) || strlen($name) > 10) $name = "";

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F9E7CF">
<center>
    <b>Lấy mã phần thưởng GiftCode và WebShop</b>
    <form action="" method="GET">
        Nhân vật chứa phần thưởng <input name="name" value="<?php echo $name; ?>" />
        <input type="submit" value="Lấy mã phần thưởng" />
    </form>
</center>
<?php
if(strlen($name) > 0) {
    $inventory_query = "SELECT CAST(Inventory AS image) FROM Character WHERE Name='$name'";
    $inventory_result = $db->Execute($inventory_query);
    $inventory_check = $inventory_result->NumRows();
    if($inventory_check == 0) {
        echo "Không tồn tại nhân vật cần lấy Mã phần thưởng";
    } else {
        $inventory_fetch = $inventory_result->fetchrow();
        
        $inventory = $inventory_fetch[0];
        $inventory = bin2hex($inventory);
        $inventory = strtoupper($inventory);
        $inventory1 = substr($inventory,0,12*32);
        $inventory2 = substr($inventory,12*32,64*32);
        $inventory3 = substr($inventory,76*32);
        
        $item_last = -1;
        $item = array();
        for($i=0; $i<64; $i++) {
            $item[$i] = substr($inventory2,$i*32,32);
            if($item[$i] != 'FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF') $item_last = $i;
        }
        if($item_last < 0) {
            echo "Nhân vật không chứa Item phần thưởng.";
        } else {
            for($i=0; $i<=$item_last; $i++) {
                $code .= $item[$i];
            }
            echo "<strong>Mã Item phần thưởng</strong> : <br>$code";
        }
            
    }
}
$db->Close();
?>
<br /><br />
<center><img src="itemcode.jpg" /></center>
</body>
</html>