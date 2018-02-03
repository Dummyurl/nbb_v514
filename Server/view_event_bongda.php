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
$passtransfer = $_POST['passtransfer'];
$action = $_POST['action'];
if ($passtransfer == $transfercode) {
	switch ($action) {
		case 'view':
				$show ="";
				$time_now = $timestamp;
				$time_accept_dudoan = $time_now-45*60;
				
				$list_tran_chuadau_query = "SELECT tran_id,tran_doi1,tran_doi2,time,giai_name FROM bongda_tran A JOIN bongda_giaidau B ON A.giai_id=B.giai_id AND A.status='0' AND time > $time_accept_dudoan ORDER BY time";
				$list_tran_chuadau_result = $db->Execute($list_tran_chuadau_query);
				
				$list_tran_chuadau_chuaduyet_query = "SELECT tran_id,tran_doi1,tran_doi2,time,giai_name FROM bongda_tran A JOIN bongda_giaidau B ON A.giai_id=B.giai_id AND A.status='0' AND time < $time_accept_dudoan ORDER BY time";
				$list_tran_chuadau_chuaduyet_result = $db->Execute($list_tran_chuadau_chuaduyet_query);
				
				$list_tran_dadau_query = "SELECT TOP 20 tran_id,tran_doi1,tran_doi2,tran_kq1,tran_kq2,time,giai_name FROM bongda_tran A JOIN bongda_giaidau B ON A.giai_id=B.giai_id AND A.status='1' ORDER BY time DESC";
				$list_tran_dadau_result = $db->Execute($list_tran_dadau_query);
				
				while ($list_tran_chuadau = $list_tran_chuadau_result->fetchrow())
				{
					$show .= "<nbb>$list_tran_chuadau[0]<nbb>$list_tran_chuadau[1]<nbb>$list_tran_chuadau[2]<nbb>$list_tran_chuadau[3]<nbb>$list_tran_chuadau[4]<nbb>\n";
				}
				$show .= "<netbanbe>\n";
				
				while ($list_tran_chuadau_chuaduyet = $list_tran_chuadau_chuaduyet_result->fetchrow())
				{
					$show .= "<nbb>$list_tran_chuadau_chuaduyet[0]<nbb>$list_tran_chuadau_chuaduyet[1]<nbb>$list_tran_chuadau_chuaduyet[2]<nbb>$list_tran_chuadau_chuaduyet[3]<nbb>$list_tran_chuadau_chuaduyet[4]<nbb>\n";
				}
				$show .= "<netbanbe>\n";
				
				while ($list_tran_dadau = $list_tran_dadau_result->fetchrow())
				{
					$show .= "<nbb>$list_tran_dadau[0]<nbb>$list_tran_dadau[1]<nbb>$list_tran_dadau[2]<nbb>$list_tran_dadau[3]<nbb>$list_tran_dadau[4]<nbb>$list_tran_dadau[5]<nbb>$list_tran_dadau[6]<nbb>\n";
				}
				echo $show;
			break;
			
		case 'goiy':
				$tran_id = $_POST['tran_id'];
				$dudoan_win_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$tran_id' AND dudoan_kq='1'";
					$dudoan_win_result = $db->Execute($dudoan_win_query);
					$dudoan_win = $dudoan_win_result->numrows();
				
				$dudoan_draw_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$tran_id' AND dudoan_kq='2'";
					$dudoan_draw_result = $db->Execute($dudoan_draw_query);
					$dudoan_draw = $dudoan_draw_result->numrows();
					
				$dudoan_lose_query = "SELECT * FROM bongda_dudoankq WHERE tran_id='$tran_id' AND dudoan_kq='3'";
					$dudoan_lose_result = $db->Execute($dudoan_lose_query);
					$dudoan_lose = $dudoan_lose_result->numrows();
					
					$dudoan_win = floor($dudoan_win/10);	$dudoan_win = $dudoan_win.'x';
					$dudoan_draw = floor($dudoan_draw/10);	$dudoan_draw = $dudoan_draw.'x';
					$dudoan_lose = floor($dudoan_lose/10);	$dudoan_lose = $dudoan_lose.'x';
					
				echo "<nbb>$dudoan_win<nbb>$dudoan_draw<nbb>$dudoan_lose<nbb>";
			break;
			
		case 'mydudoan':
				$tran_id = $_POST['tran_id'];
				$login = $_POST['login'];
				
				$show = "<netbanbe>";
				
				$my_dudoan_query = "SELECT dudoan_id,dudoan_kq,dudoan_slg,time FROM bongda_dudoankq WHERE acc='$login' AND tran_id='$tran_id'";
				$my_dudoan_result = $db->Execute($my_dudoan_query);
				
				while ($my_dudoan = $my_dudoan_result->fetchrow())
				{
					$show .= "<nbb>$my_dudoan[0]<nbb>$my_dudoan[1]<nbb>$my_dudoan[2]<nbb>$my_dudoan[3]<nbb><netbanbe>";
				}
				
				echo $show;
			break;
			
		case 'ketqua':
				$tran_id = $_POST['tran_id'];
				$show = "<netbanbe>";
				
				//Lay ket qua tran dau
				$ketqua_query = "SELECT tran_kq1,tran_kq2 FROM bongda_tran WHERE tran_id='$tran_id'";
				$ketqua_result = $db->Execute($ketqua_query);
				$ketqua = $ketqua_result->fetchrow();
				
				if($ketqua[0] > $ketqua[1]) $ketqua_dudoan = 1;
				elseif($ketqua[0] == $ketqua[1]) $ketqua_dudoan = 2;
				else $ketqua_dudoan = 3;
				
				$dudoan_query = "SELECT * FROM bongda_dudoankq WHERE dudoan_kq='$ketqua_dudoan' AND tran_id='$tran_id'";
				$dudoan_result = $db->Execute($dudoan_query);
				
				$slg_dudoan = $dudoan_result->numrows();
				$show .= "$slg_dudoan<netbanbe>";
				
				//Lay ket qua giai nhat
				$giai1_query = "SELECT acc,dudoan_slg,time FROM bongda_dudoankq WHERE tran_id='$tran_id' AND status='1'";
				$giai1_result = $db->Execute($giai1_query);
				$giai1 = $giai1_result->fetchrow();
				
				$sql_char_check = $db->SelectLimit("Select Name From Character where AccountID='$giai1[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
				$char_check = $sql_char_check->fetchrow();
				
				$show .= "$char_check[0]<nbb>$giai1[1]<nbb>$giai1[2]<netbanbe>";
				
				//Lay ket qua giai hai
				$giai2_query = "SELECT acc,dudoan_slg,time FROM bongda_dudoankq WHERE tran_id='$tran_id' AND status='2'";
				$giai2_result = $db->Execute($giai2_query);
				$giai2 = $giai2_result->fetchrow();
				
				$sql_char_check = $db->SelectLimit("Select Name From Character where AccountID='$giai2[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
				$char_check = $sql_char_check->fetchrow();
				
				$show .= "$char_check[0]<nbb>$giai2[1]<nbb>$giai2[2]<netbanbe>";
				
				//Lay ket qua giai ba
				$giai3_query = "SELECT acc,dudoan_slg,time FROM bongda_dudoankq WHERE tran_id='$tran_id' AND status='3'";
				$giai3_result = $db->Execute($giai3_query);
				$giai3 = $giai3_result->fetchrow();
				
				$sql_char_check = $db->SelectLimit("Select Name From Character where AccountID='$giai3[0]' ORDER BY Relifes DESC, Resets DESC", 1, 0);
				$char_check = $sql_char_check->fetchrow();
				
				$show .= "$char_check[0]<nbb>$giai3[1]<nbb>$giai3[2]<netbanbe>";
		
				echo $show;
			break;
			
		default: echo "";
	}
	
}
$db->Close();
?>