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
if (isset($_SESSION[mu_username])) {
    include_once("config/config_support.php");
    if ( $user_support == 1 )
    {
        $support_unread_query = "SELECT * FROM support WHERE sup_read=0 AND supid_parent=0 AND AccountID='$_SESSION[mu_username]'";
        $support_unread_result = mysql_query($support_unread_query);
            check_queryerror($support_unread_query, $support_unread_result);
        $unread = mysql_num_rows($support_unread_result);
        
        $bqtsend_query = "SELECT supid FROM support WHERE AccountID IN ($quantri_support) AND AccountID<>'$_SESSION[mu_username]' AND supid_parent=0";
        $bqtsend_result = mysql_query($bqtsend_query);
            check_queryerror($bqtsend_query, $bqtsend_result);
        while( $bqtsend = mysql_fetch_assoc($bqtsend_result) )
        {
            $check_readbqt_query = "SELECT * FROM support_readbqt WHERE supid=$bqtsend[supid] AND AccountID='$_SESSION[mu_username]'";
            $check_readbqt_result = mysql_query($check_readbqt_query);
                check_queryerror($check_readbqt_query, $check_readbqt_result);
            $readed = mysql_num_rows($check_readbqt_result);
            if( $readed == 0 ) $unread++;
        }
        
        if($unread>0) $unread_richtext = "<font color=red><b>$unread</b></font>";
        else $unread_richtext = $unread;
        
        if( in_array($_SESSION[mu_username], $quantri_arr )) {  // Neu la BQT
            $support_notans_query = "SELECT * FROM support WHERE sup_status=0 AND supid_parent=0";
            $support_notans_result = mysql_query($support_notans_query);
                check_queryerror($support_notans_query, $support_notans_result);
            $support_notans = mysql_num_rows($support_notans_result);
            
            if($support_notans>0) $support_notans_richtext = "<font color=red><b>$support_notans</b></font>";
            else $support_notans_richtext = $support_notans;
        }    
        include('templates/box_support.tpl');
    }
}

?>