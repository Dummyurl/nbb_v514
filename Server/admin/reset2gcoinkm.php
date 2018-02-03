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
 
include_once('../config.php');
include('function.php');
$gcoinkm_per_rs = 350;
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Reset -> Gcoin KM</title>
</head>
<body bgcolor="#F9E7CF">
<?php
    $char_query = "SELECT AccountID, Name, Resets FROM Character WHERE Resets>10";
    $char_result = $db->Execute($char_query);
    while($char_fetch = $char_result->FetchRow()) {
        $acc = $char_fetch[0];
        $name = $char_fetch[1];
        $reset = $char_fetch[2];
        $reset = $reset-10;
        
        if($reset>0) {
            $gcoinkm_update = $reset*$gcoinkm_per_rs;
            $update_gcoinkm_query = "UPDATE MEMB_INFO SET gcoin_km=gcoin_km+$gcoinkm_update WHERE memb___id='$acc'";
            $update_gcoinkm_result = $db->Execute($update_gcoinkm_query);
        }
    }
    echo "UPDATE thanh cong";
$db->Close();
?>
</body>
</html>