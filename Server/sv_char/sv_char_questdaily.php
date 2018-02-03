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
 
include('config/config_questdaily.php');

$login = $_POST['login'];
$name = $_POST['name'];
$action = $_POST['action'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

$datenow = date('Y-m-d', $timestamp);
$timenow_s = date('Y-m-d H:i:s', $timestamp);

    switch ($action) {
        case 'plchange':
            $pl_point_to = $_POST['pl_point_to'];
            $pl_point_change = abs(intval($_POST['pl_point_change']));
            
            $plpoint_q = "SELECT nbb_pl FROM MEMB_INFO WHERE memb___id='$login'";
            $plpoint_r = $db->Execute($plpoint_q);
                check_queryerror($plpoint_q, $plpoint_r);
            $plpoint_f = $plpoint_r->FetchRow();
            $plpoint = $plpoint_f[0];
            
            if($pl_point_change == 0) {
                echo "Điểm Phúc Lợi muốn đổi phải lớn hơn 0.";
            } elseif($pl_point_change > $plpoint) {
                echo "Điểm Phúc Lợi muốn đổi <strong>$pl_point_change</strong> lớn hơn Điểm Phúc Lợi hiện có <strong>$plpoint</strong>.<br />Không thể đổi.<br /> Vui lòng chọn giá trị nhỏ hơn hoặc bằng <strong>$plpoint</strong>";
            } else {
                $plpoint_new = $plpoint - $pl_point_change;
                $plupdate_q = "UPDATE MEMB_INFO SET nbb_pl = $plpoint_new WHERE memb___id='$login'";
                $plupdate_r = $db->Execute($plupdate_q);
                    check_queryerror($plupdate_q, $plupdate_r);
                
                switch ($pl_point_to){ 
                	case 'tl':     // Đổi sang điểm Tu Luyện
                        $tlupdate_q = "UPDATE Character SET nbbtuluyen_point = nbbtuluyen_point + $pl_point_change WHERE AccountID='$login' AND Name='$name'";
                        $tlupdate_r = $db->Execute($tlupdate_q);
                            check_queryerror($tlupdate_q, $tlupdate_r);
                        
                        $msg = "Đã đổi <strong>$pl_point_change Điểm Phúc Lợi</strong> sang <strong>Điểm Tu Luyện</strong>";
                        echo "<info>OK</info><pl>$plpoint_new</pl><msg>$msg</msg>";
                	break;
                    
                    case 'st':      // Đổi sang điểm Song Tu
                            
                        $stupdate_q = "UPDATE Character SET nbbsongtu_point = nbbsongtu_point + $pl_point_change WHERE AccountID='$login' AND Name='$name'";
                        $stupdate_r = $db->Execute($stupdate_q);
                            check_queryerror($stupdate_q, $stupdate_r);
                            
                        $msg = "Đã đổi <strong>$pl_point_change Điểm Phúc Lợi</strong> sang <strong>Điểm Song Tu</strong>";
                        echo "<info>OK</info><pl>$plpoint_new</pl><msg>$msg</msg>";
                    break;
                    
                    case 'ch':      // Đổi sang điểm Cường Hóa
                        
                        $chupdate_q = "UPDATE Character SET nbbcuonghoa_point = nbbcuonghoa_point + $pl_point_change WHERE AccountID='$login' AND Name='$name'";
                        $chupdate_r = $db->Execute($chupdate_q);
                            check_queryerror($chupdate_q, $chupdate_r);
                            
                        $msg = "Đã đổi <strong>$pl_point_change Điểm Phúc Lợi</strong> sang <strong>Điểm Cường Hóa</strong>";
                        echo "<info>OK</info><pl>$plpoint_new</pl><msg>$msg</msg>";
                    break;
                    
                    case 'hh':      // Đổi sang điểm Cường Hóa
                        $hhupdate_q = "UPDATE Character SET nbbhoanhao_point = nbbhoanhao_point + $pl_point_change WHERE AccountID='$login' AND Name='$name'";
                        $hhupdate_r = $db->Execute($hhupdate_q);
                            check_queryerror($hhupdate_q, $hhupdate_r);
                            
                        $msg = "Đã đổi <strong>$pl_point_change Điểm Phúc Lợi</strong> sang <strong>Điểm Hoàn Hảo Hóa</strong>";
                        echo "<info>OK</info><pl>$plpoint_new</pl><msg>$msg</msg>";
                    break;
                    
                	default :
                        echo "Dữ liệu đổi sang không đúng.";
                }
            }
                    
                
        break;
    
        case 'nhanthuong':
            $qindex = abs(intval($_POST['qindex']));
            
            if($qindex > 0 AND $qindex <=27) {
                $qindex_q = "SELECT count(qindex) FROM nbb_quest_daily WHERE acc='$login' AND name='$name' AND qindex=$qindex AND DATEADD(day, DATEDIFF(day, 0, date), 0)='$datenow'"; 
                $qindex_r = $db->Execute($qindex_q);
                    check_queryerror($qindex_q, $qindex_r);
                $qindex_f = $qindex_r->FetchRow();
                if($qindex_f[0] >0) {
                    echo "Nhiệm vụ này đã nhận thưởng. Không thể nhận tiếp.";
                } else {
                    $quest_arr = _quest_daily($login, $name);
                    $qwait = $quest_arr['quest_wait'];
                    $qfinish = $quest_arr[$qindex];
                    
                    if($qfinish == 1) { // hoan thanh nhiem vu
                        $phanthuong_pl = $quest_daily_pl[$qindex];
                        $phanthuong_gcoin = $quest_daily_gcoin[$qindex];
                        $phanthuong_gcoinkm = $quest_daily_gcoinkm[$qindex];
                        $phanthuong_wcoin = $quest_daily_wcoin[$qindex];
                        $phanthuong_chao = $quest_daily_chao[$qindex];
                        
                        $notice = "Hoàn thành nhiệm vụ.<br /> Đã nhận : ";
                        $phanthuong_up = "";
                        if($phanthuong_pl > 0) {
                            $notice .= "$phanthuong_pl Điểm Phúc Lợi";
                            $phanthuong_up .= "nbb_pl=nbb_pl+$phanthuong_pl";
                        }
                        if($phanthuong_gcoin > 0) {
                            if($phanthuong_pl > 0) {$notice .= " + "; $phanthuong_up .= ",";}
                            $notice .= "$phanthuong_gcoin Gcoin";
                            $phanthuong_up .= "gcoin=gcoin+$phanthuong_gcoin";
                        }
                        if($phanthuong_gcoinkm > 0) {
                            if($phanthuong_pl > 0 || $phanthuong_gcoin > 0) {$notice .= " + "; $phanthuong_up .= ",";}
                            $notice .= "$phanthuong_gcoinkm Gcoin khuyến mại";
                            $phanthuong_up .= "gcoin_km=gcoin_km+$phanthuong_gcoinkm";
                        }
                        if($phanthuong_wcoin > 0) {
                            if($phanthuong_pl > 0 || $phanthuong_gcoin > 0 || $phanthuong_gcoinkm > 0) {$notice .= " + "; $phanthuong_up .= ",";}
                            $notice .= "$phanthuong_wcoin WCoin";
                            $phanthuong_up .= "WCoin=WCoin+$phanthuong_wcoin";
                        }
                        if($phanthuong_chao > 0) {
                            if($phanthuong_pl > 0 || $phanthuong_gcoin > 0 || $phanthuong_gcoinkm > 0 || $phanthuong_wcoin > 0) {$notice .= " + "; $phanthuong_up .= ",";}
                            $notice .= "$phanthuong_chao Chao";
                            $phanthuong_up .= "jewel_chao=jewel_chao+$phanthuong_chao";
                        }
                        
                        $phanthuong_update_q = "UPDATE MEMB_INFO SET {$phanthuong_up} WHERE memb___id='$login'";
                        $phanthuong_update_r = $db->Execute($phanthuong_update_q);
                            check_queryerror($phanthuong_update_q, $phanthuong_update_r);
                        $plpoint = $quest_arr['plpoint'] + $phanthuong_pl;
                        
                        $quest_finish_q = "INSERT INTO nbb_quest_daily (acc, name, qindex, date) VALUES ('$login', '$name', $qindex, '$timenow_s')";
                        $quest_finish_r = $db->Execute($quest_finish_q);
                            check_queryerror($quest_finish_q, $quest_finish_r);
                            
                        $pldaily_check_q = "SELECT count(acc) FROM nbb_pl_daily WHERE acc='$login' AND date='$datenow'";
                        $pldaily_check_r = $db->Execute($pldaily_check_q);
                            check_queryerror($pldaily_check_q, $pldaily_check_r);
                        $pldaily_check_f = $pldaily_check_r->FetchRow();
                        if($pldaily_check_f[0] == 0) {
                            $pldaily_q = "INSERT INTO nbb_pl_daily (acc, plpoint, date) VALUES ('$login', $phanthuong_pl, '$datenow')";
                            
                        } else {
                            $pldaily_q = "UPDATE nbb_pl_daily SET plpoint = plpoint + $phanthuong_pl WHERE acc='$login' AND date='$datenow'";
                        }
                            $pldaily_r = $db->Execute($pldaily_q);
                                check_queryerror($pldaily_q, $pldaily_r);
                        
                        echo "<info>OK</info><qwait>$qwait</qwait><plpoint>$plpoint</plpoint><msg>$notice</msg>";
                    } else {
                        echo "Chưa hoàn thành nhiệm vụ. Không thể nhận giải.";
                    }
                }
            } else {
                echo "Dữ liệu nhiệm vụ không đúng.";
            }
                
        break;
        
        default :
            $nvchinh_query = "SELECT TOP 1 Name FROM Character WHERE AccountID='$login' ORDER BY Relifes DESC, Resets DESC";
            $nvchinh_result = $db->Execute($nvchinh_query);
                check_queryerror($nvchinh_query, $nvchinh_result);
            $nvchinh_fetch = $nvchinh_result->FetchRow();
            if($nvchinh_fetch[0] != $name) {
                $quest_arr['nvchinh'] = 0;
            } else {
                $quest_arr['nvchinh'] = 1;
                
                $quest_data = _quest_daily($login, $name);
                foreach($quest_data as $qk => $qv) {
                    $quest_arr[$qk] = $qv;
                }
            }
            
            
            $quest_data = json_encode($quest_arr);
            echo "<nbb>OK<nbb>$quest_data<nbb>";
    }

}

?>