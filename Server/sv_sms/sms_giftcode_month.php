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
 
if( $timestamp > ($time_load + 300) ) 
{ 
	$content = "Thoi gian xac thuc vuot qua thoi gian cho phep. Yeu cau da bi huy."; 	
} else {
    include_once('config_license.php');
    include_once('func_getContent.php');
    $getcontent_url = $url_license . "/api_giftcode_create.php";
    $getcontent_data = array(
        'acclic'    =>  $acclic,
        'key'    =>  $key,
        
        'KeyXuLy'    =>  $KeyXuLy,
        'code'    =>  $code
    ); 
    
    $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($reponse) ) {
        $content = "Server bao tri vui long lien he Admin de FIX";
    }
    else {
        $info = read_TagName($reponse, 'info');
        if($info == "Error") {
            $content = read_TagName($reponse, 'message');
        } elseif($info == "OK") {
            $giftcode = read_TagName($reponse, 'giftcode');
            if(strlen($giftcode) == 0) {
                $content = "Du lieu tra ve loi. Vui long lien he Admin de FIX";
            } else {
                $giftcode_unused_del_query = "DELETE GiftCode WHERE type=3 AND gift_timeuse IS NULL AND acc='$taikhoan'";
                $giftcode_unused_del_result = $db->execute($giftcode_unused_del_query);
                    check_queryerror($giftcode_unused_del_query, $giftcode_unused_del_result);
                
                
                $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode', '$taikhoan', 3, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
                $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                $content = "Ma GiftCode Thang cua tai khoan $taikhoan : $giftcode";
             	//Delete Data
            		$del_data = $db->Execute("DELETE FROM SMS WHERE Code='$code'");
            }
        } else {
            $content = "Ket noi API gap su co. Admin MU vui long lien he nha cung cap NWebMU de kiem tra";
        }
    }
}
?>