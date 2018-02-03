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
 

$login = $_POST['login'];
$name = $_POST['name'];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {   // Begin Pass Transfer

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_pass2($login,$pass2);
kiemtra_char($login,$name);
kiemtra_doinv($login,$name);
    
$get_class_query = "SELECT Class FROM Character WHERE Name='$name'";
$get_class_result = $db->Execute($get_class_query);
$get_class = $get_class_result->fetchrow();

$arr_classmaster = array(2,3,18,19,34,35,49,50,65,66,82,83,97,98);
if (in_array($get_class[0], $arr_classmaster)) 
{
	//Nếu là Server phát triển theo WebZen (WebZen, ENC,...)
    if($server_wz == 1)
	{
	   
	   $query_get_masterlv = "SELECT MASTER_LEVEL FROM T_MasterLevelSystem WHERE CHAR_NAME='$name'";
		$result_get_masterlv = $db->Execute($query_get_masterlv) OR DIE("Loi Query : $query_get_masterlv");
		$get_masterlv = $result_get_masterlv->fetchrow();
		$masterlv = $get_masterlv[0];
		
		$sql_master_point = "UPDATE T_MasterLevelSystem SET ML_POINT='$masterlv' WHERE CHAR_NAME='$name'";
		$result_matser_point = $db->Execute($sql_master_point) OR DIE("Lỗi Query: $sql_master_point");
        
	}
	//Nếu là Server khác WebZen (SCF,...)
	else {
		$query_get_masterlv = "SELECT SCFMasterLevel FROM Character WHERE Name='$name'";
		$result_get_masterlv = $db->Execute($query_get_masterlv) OR DIE("Loi Query : $query_get_masterlv");
		$get_masterlv = $result_get_masterlv->fetchrow();
		$masterlv = $get_masterlv[0];
		
		$sql_master_point = "UPDATE Character SET SCFMasterPoints='$masterlv',SCFMasterSkill=CONVERT(varbinary(180), null),[MagicList]= CONVERT(varbinary(180), null) WHERE Name='$name'";
		$result_matser_point = $db->Execute($sql_master_point) OR DIE("Lỗi Query: $sql_master_point");
	}
    echo "
        <info>OK</info>
        <msg>Reset Master Thành Công</msg>
    ";
}
else
{
    echo "
        <info>OK</info>
        <msg>Nhân vật không phải cấp độ Master</msg>
    ";
}

} // End Pass Transfer

?>