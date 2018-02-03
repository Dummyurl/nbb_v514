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
 

/**
 * @author NetBanBe
 * @copyright 2011
 */
 include_once("security.php");
include('../config.php');
	$title = "Kiểm tra Item nhân vật";
session_start();
if ($_POST[submit]) {
	$pass_admin = md5($_POST[useradmin]);
	if ($pass_admin == $passadmin) $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
	echo "<center><form action='' method=post><input type='hidden' name='username' value='admin'>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
	exit;
}
function antiinject_query($value) {
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}

function check_queryerror($query,$result) {
    if ($result === false) die("Query Error : $query");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<center>
<form name="checklog" method="GET" action="">
    Nhân vật cần kiểm tra : <input name="character" value="<?php echo $_GET['character']; ?>" /> 
    <input type="submit" value="Kiểm tra Item Nhân vật" />
</form>
</center>

<?php
$name = $_GET['character'];    $name = antiinject_query(trim($name));
if(strlen($name) > 0) {
    $inventory_query = "SELECT Inventory FROM Character WHERE Name='$name'";
    $inventory_result_sql = $db->Execute($inventory_query);
    $inventory_result = $inventory_result_sql->fetchrow();
    
    $inventory = $inventory_result[0];
    $inventory = bin2hex($inventory);
    $inventory = strtoupper($inventory);
    $inventory1 = substr($inventory,0,12*32);
    $inventory2 = substr($inventory,12*32,64*32);
    $inventory3 = substr($inventory,76*32);
    
    
    
    echo "<br /><strong>Iventory 1</strong> : <br />";
    for($i=1; $i<=12; $i++) {
        $item = substr($inventory1,($i-1)*32, 32);
        $seri = substr($item, 6, 8);
        echo "Item $i : " .$item . " (Seri : $seri)<br />";
    }
    
    echo "<br /><strong>Iventory 2</strong> : <br />";
    for($x=1; $x<=8; $x++) {
        for($y=1; $y<=8; $y++) {
            $o[$x][$y] = substr($inventory2,(($x-1)*8+$y-1)*32,32);
            $seri = substr($o[$x][$y], 6, 8);
            echo "Item $x, $y : " . $o[$x][$y] . " (Seri : $seri)<br />";
        }
    }
    
    $total_item_inventory3 = floor(strlen($inventory3)/32);
    echo "<br /><strong>Iventory 3</strong> $total_item_inventory3 : <br />";
    for($i=1; $i<=$total_item_inventory3; $i++) {
        $item = substr($inventory3,($i-1)*32, 32);
        $seri = substr($item, 6, 8);
        echo "Item $i : " .$item . " (Seri : $seri)<br />";
    }
}
$db->Close();
?>
</body>
</html>