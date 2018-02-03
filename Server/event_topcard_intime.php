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
 
if( ($event_topcard_on == 1) && (strtotime($event_topcard_begin) < $timestamp) && (strtotime($event_topcard_end) + 24*60*60 > $timestamp) )
{
    $datetime_now = "$year-$month-$day";
	//Kiem tra da co du lieu trong data Event_TOP_Point
	$data_check_sql = $db->Execute("SELECT * FROM Event_TOP_Card WHERE acc='$acc' AND [time]='$datetime_now'");
	$data_check = $data_check_sql->numrows();
	//Du lieu da co
	if($data_check > 0) 
	{
		$update_data_query = "UPDATE Event_TOP_Card SET gcoin=gcoin+$gcoinadd WHERE acc='$acc' AND [time]='$datetime_now'";
		$update_data_result = $db->Execute($update_data_query) OR DIE("Lỗi Query: $update_data_query");
	}
	//Du lieu chua co
	else {
		$insert_data_query = "INSERT INTO Event_TOP_Card (acc, gcoin, [time]) VALUES ('$acc', $gcoinadd, '$datetime_now')";
		$insert_data_result = $db->Execute($insert_data_query) OR DIE("Lỗi Query: $insert_data_query");
	}
}
?>