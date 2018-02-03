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

$subid = $_GET['id'];   $subid = abs(intval($subid));

if ( $_POST['action'] == 'sendsupport' )
{
	$supportcontent = $_POST['supportcontent'];
	
    if( $sendsv === false ) { $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện."; }
	elseif (empty($supportcontent))
	{
		$notice = "Chưa nhập Nội dung Phản Hồi";
	}
	else {
        $support_add_query = "INSERT INTO support (AccountID, supid_parent, sup_content, sup_time, sup_status) VALUES ('$_SESSION[mu_username]', $subid, '$supportcontent', $time_now, 0)";
        $support_add_result = mysql_query($support_add_query);
            check_queryerror($support_add_query, $support_add_result);
            
        $update_support_status_query = "UPDATE support SET sup_timenew=$time_now, sup_status=0, sup_read=1 WHERE supid=$subid";
        $update_support_status_result = mysql_query($update_support_status_query);
            check_queryerror($update_support_status_query, $update_support_status_result);
        
        $notice = "Thêm phản hồi thành công. BQT sẽ trả lời bạn trong giây lát, chậm nhất là 24h.";
	}
} 

    
    $supportget_questbegin_query = "SELECT AccountID, sup_title, sup_content, sup_time, sup_read, sup_status FROM support WHERE supid=$subid AND (AccountID='$_SESSION[mu_username]' OR AccountID IN ($quantri_support))";
    $supportget_questbegin_result = mysql_query($supportget_questbegin_query);
        check_queryerror($supportget_questbegin_query, $supportget_questbegin_result);
    $check_questbegin = mysql_num_rows($supportget_questbegin_result);
    if( $check_questbegin>0 )   // Nếu tồn tại Support
    {
        $supportget_questbegin = mysql_fetch_assoc($supportget_questbegin_result);
        $timepost = date('h:i A d/m/Y', $supportget_questbegin['sup_time']);
        $support_status = $supportget_questbegin['sup_status'];
        if($supportget_questbegin['AccountID'] == $_SESSION[mu_username]) // Nếu là người chơi gửi
        {
            // Update da doc
            if($supportget_questbegin['sup_read'] == 0)
            {
                $update_read_query = "UPDATE support SET sup_read=1 WHERE sup_read=0 AND supid=$subid";
                $update_read_result = mysql_query($update_read_query);
                    check_queryerror($update_read_query, $update_read_result);
            }
            
            $class_title = "support_tdtitle_quest";
            $class_content = "support_tdcontent_quest";
            $title = $supportget_questbegin['sup_title'];
        } else  // Nếu là BQT gửi
        {
            // Update da doc
            $check_readbqt_query = "SELECT * FROM support_readbqt WHERE supid=$subid AND AccountID='$_SESSION[mu_username]'";
            $check_readbqt_result = mysql_query($check_readbqt_query);
                check_queryerror($check_readbqt_query, $check_readbqt_result);
            $check_readbqt = mysql_num_rows($check_readbqt_result);
            if($check_readbqt == 0) // Neu chua doc
            {
                $update_read_query = "INSERT INTO support_readbqt (supid, AccountID) VALUES ($subid, '$_SESSION[mu_username]')";
                $update_read_result = mysql_query($update_read_query);
                    check_queryerror($update_read_query, $update_read_result);
            }
            
            $class_title = "support_tdtitle_ans";
            $class_content = "support_tdcontent_ans";
            $title = "Ban Quản Trị gửi";
        }
        $support_read[] = array (
                            'title' =>  "<i>". $timepost ."</i> - <b>". $title ."</b>",
                            'content'   =>  $supportget_questbegin['sup_content'],
                            'class_title'   =>  $class_title,
                            'class_content'   =>  $class_content,
                        );
        
        $supportget_continue_query = "SELECT AccountID, sup_content, sup_time FROM support WHERE supid_parent=$subid AND (AccountID='$_SESSION[mu_username]' OR AccountID IN ($quantri_support)) ORDER BY sup_time";
        $supportget_continue_result = mysql_query($supportget_continue_query);
            check_queryerror($supportget_continue_query, $supportget_continue_result);
        while( $supportget_continue = mysql_fetch_assoc($supportget_continue_result) )
        {
            $timepost = date('h:i A d/m/Y', $supportget_continue['sup_time']);
            if($supportget_continue['AccountID'] == $_SESSION[mu_username]) // Nếu là người chơi
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
        $notice = "Không tồn tại Hỗ trợ của bạn";
    }

$page_template = "templates/support/readsupport.tpl";
?>