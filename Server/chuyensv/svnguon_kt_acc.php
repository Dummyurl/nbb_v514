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
 
include('config.php');
include('function.php');

$acc_nguon = $_REQUEST['acc_nguon'];
$passweb_nguon = $_REQUEST['passweb_nguon'];
$pass2_nguon = $_REQUEST['pass2_nguon'];

	$sql_username_check_query = "SELECT gcoin, gcoin_km, vpoint, bank, jewel_chao, jewel_cre, jewel_blue, thehe, WCoin, WCoinP, GoblinCoin, CAST(MuItemShopList AS image) FROM MEMB_INFO WHERE memb___id='$acc_nguon'";
    $sql_username_check = $db->Execute($sql_username_check_query); 
        check_queryerror($sql_username_check_query, $sql_username_check);
		$username_check = $sql_username_check->numrows();
		$info_nv = $sql_username_check->fetchrow();
	if ($username_check <= 0) { 
 		echo "Tài khoản trên Server nguồn không tồn tại."; exit();
	}
    
    $sql_username_chuyen_check_query = "SELECT * FROM Log_chuyensv WHERE acc='$acc_nguon'";	
	$sql_username_chuyen_check = $db->Execute($sql_username_chuyen_check_query);
        check_queryerror($sql_username_chuyen_check_query, $sql_username_chuyen_check);
		$username_chuyen_check = $sql_username_chuyen_check->numrows(); 
	if ($username_chuyen_check > 0) { 
 		echo "Tài khoản này đã thực hiện chuyển Server."; exit();
	}
    	
	$sql_pw_check_query = "SELECT * FROM MEMB_INFO WHERE memb__pwdmd5='$passweb_nguon' and memb___id='$acc_nguon'";
    $sql_pw_check = $db->Execute($sql_pw_check_query);
        check_queryerror($sql_pw_check_query, $sql_pw_check);
		$pw_check = $sql_pw_check->numrows(); 
	if ($pw_check <= 0) { 
		echo "Mật khẩu cấp 1 không đúng."; exit();
	}
    
    $sql_pw2_check_query = "SELECT * FROM MEMB_INFO WHERE pass2='$pass2_nguon' and memb___id='$acc_nguon'";	
	$sql_pw2_check = $db->Execute($sql_pw2_check_query); 
        check_queryerror($sql_pw2_check_query, $sql_pw2_check);
		$pw2_check = $sql_pw2_check->numrows(); 
	if ($pw2_check <= 0){ 
 		echo "Mật khẩu cấp 2 không đúng."; exit();
 	}
    
 	$sql_online_check_query = "SELECT * FROM MEMB_STAT WHERE memb___id='$acc_nguon' AND ConnectStat='1'";
    $sql_online_check = $db->Execute($sql_online_check_query);
       check_queryerror($sql_online_check_query, $sql_online_check); 
	   $online_check = $sql_online_check->numrows();
	if ($online_check > 0){ 
   		echo "Nhân vật chưa thoát Game. Hãy thoát Game trước khi thực hiện chức năng này."; exit();
	}
	
 	$query = "SELECT GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$acc_nguon'";
		$result = $db->Execute( $query );
            check_queryerror($query, $result);
		$row = $result->fetchrow();
        for($i=0; $i<count($row); $i++) {
            if(check_nv($acc_nguon, $row[$i]) == 0) {
                $row[$i] = '';
            }
        }
    
	$gcoin = $info_nv[0];
    $gcoin_km = $info_nv[1];
	$vpoint = $info_nv[2];
	$zen_bank = $info_nv[3];
	$chao = $info_nv[4];
	$cre = $info_nv[5];
	$blue = $info_nv[6];
    $thehe = $info_nv[7];
    $WCoin = $info_nv[8];
    $WCoinP = $info_nv[9];
    $GoblinCoin = $info_nv[10];
    
    $MuItemShopList = $info_nv[11];
    $MuItemShopList = bin2hex($MuItemShopList);
	$MuItemShopList = strtoupper($MuItemShopList);
	
    $output = "
        <info>OK</info>
        <gcoin>$gcoin</gcoin>
        <gcoinkm>$gcoin_km</gcoinkm>
        <vpoint>$vpoint</vpoint>
        <zenbank>$zen_bank</zenbank>
        <chao>$chao</chao>
        <cre>$cre</cre>
        <blue>$blue</blue>
        <thehe>$thehe</thehe>
        <WCoin>$WCoin</WCoin>
        <WCoinP>$WCoinP</WCoinP>
        <GoblinCoin>$GoblinCoin</GoblinCoin>
        <MuItemShopList>$MuItemShopList</MuItemShopList>
        <char>$row[0]</char>
        <char>$row[1]</char>
        <char>$row[2]</char>
        <char>$row[3]</char>
        <char>$row[4]</char>
    ";
    echo $output;
?>