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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");
if( in_array($_SESSION[mu_username], $quantri_arr )) {
	
    
    $supporttheodoi_query = "SELECT AccountID, supid, sup_title, sup_timenew FROM support WHERE supid_parent=0 AND sup_theodoi=1 ORDER BY sup_timenew";
    $supporttheodoi_result = mysql_query($supporttheodoi_query);
        check_queryerror($supporttheodoi_query, $supporttheodoi_result);
    while( $support_theodoi = mysql_fetch_assoc($supporttheodoi_result) )
    {
        $timepost = date('h:i A d/m/Y', $support_theodoi['sup_timenew']);
        $support_status = "<i>Chưa trả lời</i>";

        $supporttheodoi[] = array(
                            'supid' => $support_theodoi['supid'],
                            'AccountID' =>  $support_theodoi['AccountID'],
                            'sup_title' => $support_theodoi['sup_title'],
                            'sup_time' => $timepost
                        );
    }
    
    $supportget_query = "SELECT AccountID, supid, sup_title, sup_timenew FROM support WHERE supid_parent=0 AND sup_status=0 AND sup_theodoi=0 ORDER BY sup_timenew";
    $supportget_result = mysql_query($supportget_query);
        check_queryerror($supportget_query, $supportget_result);
    while( $supportget = mysql_fetch_assoc($supportget_result) )
    {
        $timepost = date('h:i A d/m/Y', $supportget['sup_timenew']);
        $support_status = "<i>Chưa trả lời</i>";

        $supportlist[] = array(
                            'supid' => $supportget['supid'],
                            'AccountID' =>  $supportget['AccountID'],
                            'sup_title' => $supportget['sup_title'],
                            'sup_time' => $timepost
                        );
    }
$page_template = "templates/support/adm_inbox.tpl";
} else echo "<center><font color='red'>Bạn không phải BQT - Không được phép truy cập</font></center>";
?>