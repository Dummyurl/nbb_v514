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
 

$name = $_POST['name'];
$login = $_POST['login'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_char($login,$name);

$time_on_q = "SELECT ConnectTM, DisConnectTM FROM MEMB_STAT WHERE memb___id='$login'";
$time_on_r = $db->Execute($time_on_q);
    check_queryerror($time_on_q, $time_on_r);
$time_on_f = $time_on_r->FetchRow();
$time_on = strtotime($time_on_f[0]);
$time_dis = strtotime($time_on_f[1]);

if( ($time_on < $time_dis) || ($timestamp - $time_on) < 5*60 ) {
    echo "Bạn phải Online trong Game ít nhất 5 phút mới được bắt đầu Ủy Thác Online."; exit();
}

$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$login' AND ConnectStat='1' AND ServerName like '%-1'");
	$online_check = $sql_online_check->numrows();

$sql_ingame_check = $db->Execute("SELECT * FROM AccountCharacter WHERE Id='$login' AND GameIDC='$name'");
	$ingame_check = $sql_ingame_check->numrows();
	

$sql_UyThac_check = $db->Execute("SELECT MapNumber,MapPosX,MapPosY FROM Character WHERE Name='$name'");
$UyThac_check = $sql_UyThac_check->fetchrow();

	$Map = $UyThac_check[0];
	$ToaDoX = $UyThac_check[1];
	$ToaDoY = $UyThac_check[2];
	
    
    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_uythacon.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'Map'    =>  $Map,
        'ToaDoX'    =>  $ToaDoX,
        'ToaDoY'    =>  $ToaDoY
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
        echo $notice;
        exit();
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $message = read_TagName($reponse, 'message');
            echo $message;
            exit();
        } elseif ($info == "OK") {
            $accept_uythac = read_TagName($reponse, 'accept_uythac');
            if(strlen($accept_uythac) == 0) {
                echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                $arr_view = "\nDataSend:\n";
                foreach($getcontent_data as $k => $v) {
                    $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                }
                writelog("log_api.txt", $arr_view . $reponse);
                exit();
            }
        } else {
            echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
            writelog("log_api.txt", $reponse);
            exit();
        }
    }
    


if($accept_uythac == 0) { echo "Nhân vật không trong khu vực Ủy Thác. Hoặc có thể Dữ liệu chưa cập nhập, hãy đổi nhân vật để dữ liệu Cập nhập"; exit(); }
	
	$msquery = "UPDATE Character SET [UyThac] = 1 WHERE AccountID = '$login' AND Name = '$name'";
	$msresults= $db->Execute($msquery);
	

	echo "OK<nbb>$name đã Ủy thác thành công.";
}

?>