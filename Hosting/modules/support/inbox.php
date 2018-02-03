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
    $supportget_query = "SELECT AccountID, supid, sup_title, sup_timenew, sup_read, sup_status FROM support WHERE supid_parent=0 AND (AccountID='$_SESSION[mu_username]' OR AccountID IN ($quantri_support)) ORDER BY sup_timenew DESC LIMIT 0,20";
    $supportget_result = mysql_query($supportget_query);
        check_queryerror($supportget_query, $supportget_result);
    while( $supportget = mysql_fetch_assoc($supportget_result) )
    {
        $timepost = date('h:i A d/m/Y', $supportget['sup_timenew']);
        if($supportget['AccountID'] == $_SESSION[mu_username]) // Nếu là người chơi gửi
        {
            $readed = $supportget['sup_read'];
        } else  // Nếu là BQT gửi
        {
            $check_readbqt_query = "SELECT * FROM support_readbqt WHERE supid=$supportget[supid] AND AccountID='$_SESSION[mu_username]'";
            $check_readbqt_result = mysql_query($check_readbqt_query);
                check_queryerror($check_readbqt_query, $check_readbqt_result);
            $readed = mysql_num_rows($check_readbqt_result);
        }
        
        switch($readed)
        {
            case 1 : $support_title = $supportget['sup_title']; break;
            default : $support_title = "<b><font color='red'>" . $supportget['sup_title'] . "</font></b>";
        }
        switch($supportget['sup_status'])
        {
            case 1 : $support_status = "<font color=blue><i>Đã trả lời</i></font>"; break;
            case 9 : $support_status = "<font color=red><i>Đã khóa</i></font>"; break;
            default : $support_status = "Chưa trả lời";
        }
        $supportlist[] = array(
                            'supid' => $supportget['supid'],
                            'sup_title' => $support_title,
                            'sup_time' => $timepost,
                            'sup_status' => $support_status,
                        );
    }
$page_template = "templates/support/inbox.tpl";
?>