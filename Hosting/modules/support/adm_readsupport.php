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

$subid = $_GET['id'];   $subid = abs(intval($subid));

if ( $_POST['action'] == 'sendsupport' )
{
	$supportcontent = $_POST['supportcontent'];
    $theodoi = $_POST['theodoi'];
	
    if (empty($supportcontent))
	{
		$notice = "Chưa nhập Nội dung Trả lời Hỗ trợ";
	}
	else {
        $support_add_query = "INSERT INTO support (AccountID, supid_parent, sup_content, sup_time) VALUES ('$_SESSION[mu_username]', $subid, '$supportcontent', $time_now)";
        $support_add_result = mysql_query($support_add_query);
            check_queryerror($support_add_query, $support_add_result);
        
        $update_support_status_query = "UPDATE support SET sup_timenew=$time_now, sup_status=1, sup_read=0";
        
        if($theodoi) $update_support_status_query .= ", sup_theodoi=1";
            else $update_support_status_query .= ", sup_theodoi=0";
        
        $update_support_status_query .= " WHERE supid=$subid";
        $update_support_status_result = mysql_query($update_support_status_query);
            check_queryerror($update_support_status_query, $update_support_status_result);
            
        $notice = "Trả lời hỗ trợ thành công.";
        $replied = 1;
	}
}

if($_POST['check'] == 1)
{
        $update_check_query = "UPDATE support SET ";
        if(isset($_POST['repplied'])) $update_check_query .= "sup_status=1, ";
            else $update_check_query .= "sup_status=0, ";

        if(isset($_POST['theodoi'])) $update_check_query .= "sup_theodoi=1 ";
            else $update_check_query .= "sup_theodoi=0 ";
        $update_check_query .= "WHERE supid=$subid";
        
        $update_check_result = mysql_query($update_check_query);
            check_queryerror($update_check_query, $update_check_result);
}
    
    $supportget_questbegin_query = "SELECT AccountID, sup_title, sup_content, sup_time, sup_status, sup_theodoi FROM support WHERE supid=$subid";
    $supportget_questbegin_result = mysql_query($supportget_questbegin_query);
        check_queryerror($supportget_questbegin_query, $supportget_questbegin_result);
    $check_questbegin = mysql_num_rows($supportget_questbegin_result);
    if( $check_questbegin>0 )   // Nếu tồn tại Support
    {
        $supportget_questbegin = mysql_fetch_assoc($supportget_questbegin_result);
        $repllied =  $supportget_questbegin['sup_status'];
        $theodoi = $supportget_questbegin['sup_theodoi'];
        
        $timepost = date('h:i A d/m/Y', $supportget_questbegin['sup_time']);

        $class_title = "support_tdtitle_quest";
        $class_content = "support_tdcontent_quest";
        $title = $supportget_questbegin['sup_title'];

        $support_read[] = array (
                            'title' =>  "<i> $timepost </i> - <b> $title </b><i> ( Tài khoản : <font color=red>$supportget_questbegin[AccountID]</font> )</i>",
                            'content'   =>  $supportget_questbegin['sup_content'],
                            'class_title'   =>  $class_title,
                            'class_content'   =>  $class_content,
                        );
        
        $supportget_continue_query = "SELECT AccountID, sup_content, sup_time FROM support WHERE supid_parent=$subid ORDER BY sup_time";
        $supportget_continue_result = mysql_query($supportget_continue_query);
            check_queryerror($supportget_continue_query, $supportget_continue_result);
        while( $supportget_continue = mysql_fetch_assoc($supportget_continue_result) )
        {
            $timepost = date('h:i A d/m/Y', $supportget_continue['sup_time']);
            if($supportget_continue['AccountID'] != $_SESSION[mu_username]) // Nếu là người chơi
            {
                $class_title = "support_tdtitle_quest";
                $class_content = "support_tdcontent_quest";
                $title = "Thắc mắc";
            } else  // Nếu là BQT
            {
                $class_title = "support_tdtitle_ans";
                $class_content = "support_tdcontent_ans";
                $title = "Ban Quản Trị đã trả lời";
            }
            
            $support_read[] = array (
                            'title' =>  "<i>". $timepost ."</i> - <b>". $title ."</b>",
                            'content'   =>  $supportget_continue['sup_content'],
                            'class_title'   =>  $class_title,
                            'class_content'   =>  $class_content,
                        );

        }
    } else  // Nếu không tồn tại Support 
    {
        $notice = "Không tồn tại Hỗ trợ";
    }

$page_template = "templates/support/adm_readsupport.tpl";
} else echo "<center><font color='red'>Bạn không phải BQT - Không được phép truy cập</font></center>";
?>