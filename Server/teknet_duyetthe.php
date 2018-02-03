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
 
include_once('config.php');
include_once('config/config_napthe.php');
include_once('config/config_event.php');

$timestamp = _time();
$time_now = $timestamp;
$day_now = date("d",$time_now);
$month_now = date("m",$time_now);
$year_now = date("Y",$time_now);

if ($edit_menhgia != $menhgia) {
	$query_editmenhgia = "Update CardPhone Set menhgia=$edit_menhgia Where stt=$stt";
	$editmenhgia =$db->Execute($query_editmenhgia);
	$menhgia = $edit_menhgia;
}
$card_type = $cardtype;

$query_upstat = "Update CardPhone Set status=2 Where stt=$stt";
$upstat =$db->Execute($query_upstat);

    if ($menhgia == 10000) { $gcoinadd = $menhgia10000; }
	if ($menhgia == 20000) { $gcoinadd = $menhgia20000; }
	if ($menhgia == 30000) { $gcoinadd = $menhgia30000; }
	if ($menhgia == 50000) { $gcoinadd = $menhgia50000; }
	if ($menhgia == 100000) { $gcoinadd = $menhgia100000; }
	if ($menhgia == 200000) { $gcoinadd = $menhgia200000; }
	if ($menhgia == 300000) { $gcoinadd = $menhgia300000; }
	if ($menhgia == 500000) { $gcoinadd = $menhgia500000; }
	
    $gcoin_km = 0;
	//Khuyen mai chung
	if ($khuyenmai == 1 && $khuyenmai_phantram>0) {
		$gcoin_km = floor($gcoinadd*($khuyenmai_phantram/100));
	}
	//Gcoin khi nạp thẻ VTC nhiều hơn các thẻ khác
	if ($card_type == 'VTC' && $khuyenmai_vtc > 0) {
	   $gcoinadd = floor($gcoinadd*(1+($khuyenmai_vtc/100)));
       if($gcoin_km>0) $gcoin_km = floor($gcoin_km*(1+($khuyenmai_vtc/100)));
	}
    //Gcoin khi nạp thẻ GATE nhiều hơn các thẻ khác
	if ($card_type == 'GATE' && $khuyenmai_gate > 0) {
	   $gcoinadd = floor($gcoinadd*(1+($khuyenmai_gate/100)));
       if($gcoin_km>0) $gcoin_km = floor($gcoin_km*(1+($khuyenmai_gate/100)));
	}
        
	//Begin Kiểm tra có tồn tại doanh thu của loại thẻ nạp
	$check_tontai_doanhthu_cardtype = $db->Execute("SELECT month FROM doanhthu WHERE month='$month' and year='$year' AND card_type='$card_type'");
	$tontai_doanhthu_cardtype = $check_tontai_doanhthu_cardtype->numrows();
	if ($tontai_doanhthu_cardtype == 0) {
		$update_doanhthu_cardtype = $db->Execute("INSERT INTO doanhthu (month, year,card_type) VALUES ($month, $year,'$card_type')");
	}
	//End Kiểm tra có tồn tại doanh thu của loại thẻ nạp
    // Update doanh thu
	$query_updatedoanhthu = "Update doanhthu set money=money+$menhgia Where month='$month' And year='$year' AND card_type='$card_type'";
	$updatedoanhthu =$db->Execute($query_updatedoanhthu);
    // End Update doanh thu
    
    // Lay Gcoin cua tai khoan hien co
		$gcoin_truoc_query = "SELECT gcoin FROM MEMB_INFO WHERE memb___id='$acc'";
		$gcoin_truoc_result = $db->Execute($gcoin_truoc_query);
		$gcoin_truoc = $gcoin_truoc_result->fetchrow();
	// End Lay Gcoin cua tai khoan hien co	
    // Cong Gcoin
		$query_addgcoin = "Update MEMB_INFO set gcoin=gcoin+$gcoinadd,gcoin_km=gcoin_km+$gcoin_km Where memb___id='$acc'";
		$addgcoin =$db->Execute($query_addgcoin);
   // End Cong Gcoin
   
   // Update Card
		$query_statgcoin = "Update CardPhone set addvpoint=1,timeduyet=$timestamp Where stt=$stt";
		$statgcoin =$db->Execute($query_statgcoin);
	// End Update Card
    
		//Ghi vào Log
			$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$acc'";
	        $info_log_result = $db->Execute($info_log_query);
	            check_queryerror($info_log_query, $info_log_result);
	        $info_log = $info_log_result->fetchrow();
	        
	        $log_acc = "$acc";
	        $log_gcoin = $info_log[0];
	        $log_gcoin_km = $info_log[1];
	        $log_vpoint = $info_log[2];
	        $log_price = "+ $gcoinadd Gcoin, $gcoin_km Gcoin khuyến mãi";
	        $log_Des = "Nạp thẻ $card_type : $menhgia VNĐ";
	        $log_time = $timestamp;
	        
	        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
	        $insert_log_result = $db->execute($insert_log_query);
	            check_queryerror($insert_log_query, $insert_log_result);
		//End Ghi vào Log
		//Begin Invite
			//Kiem tra co tai khoan gioi thieu khong
			$invite_check_query = "SELECT acc_invite FROM Invite WHERE acc_accept='$acc'";
			$invite_check_result = $db->Execute($invite_check_query);
			$invite_have = $invite_check_result->numrows();
			if($invite_have > 0)
			{
				$vpoint_invite = floor($gcoinadd*5/100);
				$acc_invite = $invite_check_result->fetchrow();
				$update_vpoint_meminvite_query = "UPDATE MEMB_INFO SET vpoint=vpoint+$vpoint_invite WHERE memb___id='$acc_invite[0]'";
				$update_vpoin_memtinvite_result = $db->Execute($update_vpoint_meminvite_query);
				
				$update_vpoint_invite_query = "UPDATE Invite SET vpoint_invite=vpoint_invite+$vpoint_invite WHERE acc_accept='$acc' AND acc_invite='$acc_invite[0]'";
				$update_vpoint_invite_result = $db->Execute($update_vpoint_invite_query);
			}
		//End Invite
	//Event TOP Reset in Time
	include_once('event_topcard_intime.php');

?>