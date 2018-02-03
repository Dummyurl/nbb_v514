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

$acc_dich = $_REQUEST['acc_dich'];
$passweb_dich = $_REQUEST['passweb_dich'];
$pass2_dich = $_REQUEST['pass2_dich'];

    $sql_username_check_query = "SELECT memb___id FROM MEMB_INFO WHERE memb___id='$acc_dich'";
	$sql_username_check = $db->Execute($sql_username_check_query); 
		check_queryerror($sql_username_check_query, $sql_username_check);
        $username_check = $sql_username_check->numrows(); 
	if ($username_check <= 0){ 
 		echo "Tài khoản trên Server chuyển tới không tồn tại."; exit();
	}
    
    $sql_username_chuyen_check_query = "SELECT * FROM Log_chuyensv WHERE acc='$acc_dich'";
    $sql_username_chuyen_check = $db->Execute($sql_username_chuyen_check_query); 
		check_queryerror($sql_username_chuyen_check_query,$sql_username_chuyen_check);
        $username_chuyen_check = $sql_username_chuyen_check->numrows(); 
	if ($username_chuyen_check > 0){ 
 		echo "Trước đây, Tài khoản này đã được thức hiện chuyển dữ liệu. Hiện tại, Không cho phép thực hiện chuyển dữ liệu tới tài khoản này."; exit();
	}
    
    $sql_pw_check_query = "SELECT * FROM MEMB_INFO WHERE memb__pwdmd5='$passweb_dich' and memb___id='$acc_dich'";
    $sql_pw_check = $db->Execute($sql_pw_check_query); 
		check_queryerror($sql_pw_check_query,$sql_pw_check);
        $pw_check = $sql_pw_check->numrows(); 
	if ($pw_check <= 0){ 
		echo "Mật khẩu cấp 1 không đúng."; exit();
	}
    
    $sql_pw2_check_query = "SELECT * FROM MEMB_INFO WHERE pass2='$pass2_dich' and memb___id='$acc_dich'";
    $sql_pw2_check = $db->Execute($sql_pw2_check_query); 
		check_queryerror($sql_pw2_check_query,$sql_pw2_check);
        $pw2_check = $sql_pw2_check->numrows(); 
	if ($pw2_check <= 0){ 
 		echo "Mật khẩu cấp 2 không đúng."; exit();
 	}
	
	
	$query = "Select GameID1,GameID2,GameID3,GameID4,GameID5 from AccountCharacter WHERE Id='$acc_dich'";
	$result = $db->Execute($query);
        check_queryerror($query, $result);
		$row = $result->fetchrow();
        for($i=0; $i<count($row); $i++) {
            if(check_nv($acc_dich, $row[$i]) == 0) {
                $row[$i] = '';
            }
        }
        
    $output = "
        <info>OK</info>
        <char>$row[0]</char>
        <char>$row[1]</char>
        <char>$row[2]</char>
        <char>$row[3]</char>
        <char>$row[4]</char>
    ";
echo $output;
?>