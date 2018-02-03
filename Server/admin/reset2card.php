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
include_once('../config/config_napthe.php');
include('function.php');

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Reset -> Card</title>
</head>
<body bgcolor="#F9E7CF">
<?php
    $card_query = "SELECT acc, menhgia, card_type FROM CardPhone WHERE status=2";
    $card_result = $db->Execute($card_query);
    while($card_fetch = $card_result->FetchRow()) {
        $acc = $card_fetch[0];
        $menhgia = $card_fetch[1];
        $card_type = $card_fetch[2];
        
        if ($menhgia == 10000) { $gcoinadd = $menhgia10000; }
    	if ($menhgia == 20000) { $gcoinadd = $menhgia20000; }
    	if ($menhgia == 30000) { $gcoinadd = $menhgia30000; }
    	if ($menhgia == 50000) { $gcoinadd = $menhgia50000; }
    	if ($menhgia == 100000) { $gcoinadd = $menhgia100000; }
    	if ($menhgia == 200000) { $gcoinadd = $menhgia200000; }
    	if ($menhgia == 300000) { $gcoinadd = $menhgia300000; }
    	if ($menhgia == 500000) { $gcoinadd = $menhgia500000; }
    	
        $gcoin_km = 0;
    	//Khuyen mai chung
    	if ($khuyenmai == 1 && $khuyenmai_phantram>0) {
    		$gcoin_km = floor($gcoinadd*($khuyenmai_phantram/100));
    	}
    	//Gcoin khi nạp thẻ VTC nhiều hơn các thẻ khác
    	if ($card_type == 'VTC' && $khuyenmai_vtc > 0) {
    	   $gcoinadd = floor($gcoinadd*(1+($khuyenmai_vtc/100)));
           if($gcoin_km>0) $gcoin_km = floor($gcoin_km*(1+($khuyenmai_vtc/100)));
    	}
        //Gcoin khi nạp thẻ GATE nhiều hơn các thẻ khác
    	if ($card_type == 'GATE' && $khuyenmai_gate > 0) {
    	   $gcoinadd = floor($gcoinadd*(1+($khuyenmai_gate/100)));
           if($gcoin_km>0) $gcoin_km = floor($gcoin_km*(1+($khuyenmai_gate/100)));
    	}
        
        $gcoin_update_query = "UPDATE MEMB_INFO SET gcoin=gcoin+$gcoinadd, gcoin_km=gcoin_km+$gcoin_km WHERE memb___id='$acc'";
        $gcoin_update_result = $db->Execute($gcoin_update_query);
    }
    echo "UPDATE thanh cong";
$db->Close();
?>
</body>
</html>