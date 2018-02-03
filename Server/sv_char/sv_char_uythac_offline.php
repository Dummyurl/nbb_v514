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
 

include_once('config/config_uythacoffline.php');

$name = $_POST['name'];
$login = $_POST['login'];
$pass2 = $_POST['pass2'];
$act = $_POST['act'];
$getuythac = $_POST['getuythac'];

$passtransfer = $_POST['passtransfer'];
if ($passtransfer == $transfercode) {

$string_login = $_POST['string_login'];
checklogin($login,$string_login);

if(check_nv($login, $name) == 0) {
    echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại."; exit();
}

kiemtra_char($login,$name);
kiemtra_pass2($login,$pass2);
kiemtra_doinv($login,$name);
kiemtra_online($login);

$sql_UyThac_check = $db->Execute("SELECT uythacoffline_stat,uythacoffline_time,PointUyThac,ctlcode,makhoado, ErrorSubBlock, khoado FROM Character WHERE Name='$name'");
$UyThac_check = $sql_UyThac_check->fetchrow();

$AdminBlock = $UyThac_check[4];
$khoado = $UyThac_check[6];

$gcoin_result = $db->Execute("Select gcoin,gcoin_km From MEMB_INFO where memb___id='$login'");
$gcoin = $gcoin_result->fetchrow();

$gcoin_before = $gcoin[0];
$gcoin_km = $gcoin[1];

$gcoinnew = $gcoin[0];
$gcoin_km_before = $gcoin[1];
$gcoin_total = $gcoinnew + $gcoin_km;

if($act == 'uythac_begin')
{
	$time_dis_q = "SELECT DisConnectTM FROM MEMB_STAT WHERE memb___id='$login'";
    $time_dis_r = $db->Execute($time_dis_q);
        check_queryerror($time_dis_q, $time_dis_r);
    $time_dis_f = $time_dis_r->FetchRow();
    $time_dis = strtotime($time_dis_f[0]);
    
    if( ($timestamp - $time_dis) < 5*60 ) {
        echo "Bạn phải thoát Game ít nhất 5 phút mới được bắt đầu Ủy Thác Offline."; exit();
    }
    if ($UyThac_check[0] == 1){
   		echo "Nhân vật Ủy thác đang trong tình trạng Ủy Thác Offline."; exit();
	}
    if ($UyThac_check[3] == 1 || $UyThac_check[3] == 99 || $AdminBlock == 99){
   		echo "Nhân vật đang bị khóa."; exit();
	}
    if ($UyThac_check[3] == 18 && $UyThac_check[4] == 'adminkhoa'){
   		echo "Nhân vật đang bị Admin khóa đồ."; exit();
	}
	$uythac_query = "Update Character SET uythacoffline_stat='1', uythacoffline_time='$timestamp', CtlCode='1', UyThac = 0 WHERE Name='$name'";
}

if($act == 'uythac_end')
{
	if ($UyThac_check[0] == 0){
	   		echo "Nhân vật hiện tại không Ủy Thác Offline."; exit();
		}
    elseif ($UyThac_check[3] == 99 || $AdminBlock == 99){
	   		echo "Nhân vật đang bị khóa."; exit();
		}
    elseif ($UyThac_check[3] == 18 && $UyThac_check[4] == 'adminkhoa'){
	   		echo "Nhân vật đang bị Admin khóa đồ."; exit();
		}
        
        $UyThac_info_query = "SELECT PointUyThac, UyThacOffline_Daily FROM Character WHERE Name='$name'";
        $UyThac_info_result = $db->Execute($UyThac_info_query);
            check_queryerror($UyThac_info_query, $UyThac_info_result);
        $UyThac_info_fetch = $UyThac_info_result->FetchRow();
        $PointUyThac = $UyThac_info_fetch[0];
        $UyThacOffline_Daily = $UyThac_info_fetch[1];
        $UyThacLuc = $UyThac_check[1];
        $PointUyThacCheck = $UyThac_check[2];
        
        $time_uythac = $timestamp - $UyThacLuc;
        $phut_uythac = floor($time_uythac/60);
        $phut_uythac_goc = $phut_uythac;
        if($phut_uythac > 720) $phut_uythac = 720;
        if( $UyThacOffline_Daily > 0 && ($UyThacOffline_Daily + $phut_uythac) > 720) {
            $phut_uythac = 720 - $UyThacOffline_Daily;
        }

        if( ($PointUyThac + $phut_uythac) > 1440 ) {
            $phut_uythac = 1440 - $PointUyThac;
        }

        
        $timebegin_day = strtotime("$year-$month-$day");
        // Neu Uy Thac tu ngay hom truoc
        if($UyThacLuc < $timebegin_day) {
            $phut_uythacdaily = floor(($timestamp - $timebegin_day)/60);
        } else {
            $phut_uythacdaily = floor(($timestamp - $UyThacLuc)/60);
        }
        
        if($phut_uythac < 0) $phut_uythac = 0;
        if($phut_uythacdaily < 0) $phut_uythacdaily = 0;
        
        
    if($getuythac) {
    
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_uythacoff.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'phut_uythac'   =>  $phut_uythac,
            'uythacoff_price'    =>  $uythacoff_price,
            'gcoin_total'   =>  $gcoin_total,
            'phut_1point'   =>  $phut_1point,
            'gcoin_km'  =>  $gcoin_km,
            'gcoinnew'  =>  $gcoinnew,
            'PointUyThacCheck'  =>  $PointUyThacCheck
        ); 
        
        // Reduce Gcoin For Union Castle Begin
        include('config/config_castleown_gcoin_reduce.php');
        if($castleown_gcoin_reduce_enable == 1) {
            $castle_onwer = _castleown($name, $castleown_gcoin_reduce_day);
            if($castle_onwer == 1) {
                $getcontent_data['castleown_gcoin_reduce_percent'] = $castleown_gcoin_reduce_percent;
            } else if($castle_onwer == 2) {
                $castle_onwer_notice = "Bạn thuộc Liên Minh giữ thành nhưng cách trận CTC trước quá 7 ngày. Vì vậy không được giảm Gcoin.";
            } else if($castle_onwer == 4) {
                $castle_onwer_notice = "Bang hội của bạn giữ thành nhưng không có Liên Minh. Vì vậy không được giảm Gcoin.";
            }
        }
        // Reduce Gcoin For Union Castle End
         
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
            echo $notice;
            exit();
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $message = read_TagName($reponse, 'message');
                echo $message;
                exit();
            } elseif ($info == "OK") {
                $data = read_TagName($reponse, 'data');
                $data_arr = unserialize_safe($data);
                $point_uythac_after = $data_arr['point_uythac_after'];
                $gcoinnew = $data_arr['gcoinnew'];
                $gcoin_km = $data_arr['gcoin_km'];
                $uythac_point = $data_arr['uythac_point'];
                $gcoin_uythac = $data_arr['gcoin_uythac'];
                $gcoin_castle_owner_before = $data_arr['gcoin_castle_owner_before'];
                $gcoin_reduce_notice = $data_arr['gcoin_reduce_notice'];
                
                if(strlen($point_uythac_after) == 0 || strlen($gcoinnew) == 0 || strlen($gcoin_km) == 0 || strlen($uythac_point) == 0 || strlen($gcoin_uythac) == 0) {
                    echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                    $arr_view = "\nDataSend:\n";
                    foreach($getcontent_data as $k => $v) {
                        $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                    }
                    writelog("log_api.txt", $arr_view . $reponse);
                    exit();
                }
            } else {
                echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                writelog("log_api.txt", $reponse);
                exit();
            }
        }
        
        if($khoado == 0) {
            $uythac_query = "Update Character SET uythacoffline_stat='0', uythacoffline_time='0', CtlCode='0', PointUyThac='$point_uythac_after', UyThacOffline_Daily=UyThacOffline_Daily+$phut_uythacdaily WHERE Name='$name'";
        } else {
            $uythac_query = "Update Character SET uythacoffline_stat='0', uythacoffline_time='0', CtlCode='18', PointUyThac='$point_uythac_after', UyThacOffline_Daily=UyThacOffline_Daily+$phut_uythacdaily WHERE Name='$name'";
        }
    	
    	$gcoin_query = "Update MEMB_INFO SET gcoin='$gcoinnew',gcoin_km='$gcoin_km' WHERE memb___id='$login'";
        $gcoin_update = $db->Execute($gcoin_query);
        
        _use_money($login, $gcoin_before - $gcoinnew, $gcoin_km_before - $gcoin_km, 0);
        
    } else {
        if($khoado == 0) {
            $uythac_query = "Update Character SET uythacoffline_stat='0', uythacoffline_time='0', CtlCode='0' WHERE Name='$name'";
        } else {
            $uythac_query = "Update Character SET uythacoffline_stat='0', uythacoffline_time='0', CtlCode='18' WHERE Name='$name'";
        }
        
    }

}

kiemtra_doinv($login,$name);
kiemtra_online($login);

    $uythac_result= $db->Execute($uythac_query);
    

	if($act == 'uythac_begin')
	{
		echo "OK<nbb>$name đã Ủy thác thành công.";
        //Ghi vào Log
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        $log_price = "-";
        $log_Des = "$name bắt đầu Ủy thác lúc " . date('H:i:s d/m', $timestamp);

        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
		//End Ghi vào Log
	}
	if($act == 'uythac_end')
	{
		//Ghi vào Log nhung nhan vàt Reset
		$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
        $info_log_result = $db->Execute($info_log_query);
            check_queryerror($info_log_query, $info_log_result);
        $info_log = $info_log_result->fetchrow();
        
        $log_acc = "$login";
        $log_gcoin = $info_log[0];
        $log_gcoin_km = $info_log[1];
        $log_vpoint = $info_log[2];
        if($getuythac) {
            $phut_uythac_daily = 720 - $UyThacOffline_Daily;
                if($phut_uythac_daily < 0) $phut_uythac_daily = 0;
            $phut_uythac_less = 1440 - $PointUyThac;
                if($phut_uythac_less < 0) $phut_uythac_less = 0;
            $phut_uythac_maxreceive = $phut_uythac_daily;
            if($phut_uythac_maxreceive > $phut_uythac_less) $phut_uythac_maxreceive = $phut_uythac_less;
            
            $log_price = "- $gcoin_uythac Gcoin";
            $log_Des = "$name Đã Ủy Thác Offline trong ngày : <strong>$UyThacOffline_Daily/720 phút</strong>, còn lại : <strong>$phut_uythac_daily phút</strong>.<br />Điểm Ủy Thác hiện tại : <strong>$PointUyThac/1440</strong>, còn lại : <strong>$phut_uythac_less điểm</strong><br />Vì vậy, $name tối đa nhận được điểm Ủy Thác trong : <strong>$phut_uythac_maxreceive</strong> phút.<br />$name đã Ủy thác trong : <strong>$phut_uythac_goc phút</strong>.<br />Nhận được <strong>$uythac_point điểm Ủy Thác</strong> tương ứng <strong>$phut_uythac phút Ủy Thác</strong>. Trước Ủy Thác <strong>$PointUyThacCheck</strong> điểm, Sau Ủy Thác <strong>$point_uythac_after</strong> điểm..<br />Chi phí <b>$gcoin_uythac</b> Gcoin.";
        } else {
            $log_price = "- 0 Gcoin";
            $log_Des = "$name đã Ủy thác trong $phut_uythac_goc phút, Lựa chọn không nhận điểm Ủy Thác";
        }
            
        $log_time = $timestamp;
        
        $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
        $insert_log_result = $db->execute($insert_log_query);
            check_queryerror($insert_log_query, $insert_log_result);
		//End Ghi vào Log nhung nhan vàt Reset
        
        if($getuythac) { 
            if(isset($gcoin_reduce_notice) && $gcoin_reduce_notice > 0) {
                $price_notice = "Chi phí : $gcoin_castle_owner_before Gcoin.<br /> Bạn thuộc Liên Minh giữ thành. Được giảm <strong>". $castleown_gcoin_reduce_percent ."%</strong> chi phí. Chỉ mất : $gcoin_uythac Gcoin.<br />Tiết kiệm :<strong> $gcoin_reduce_notice Gcoin</strong>";
            } else {
                $price_notice = "Chi phí : <strong>$gcoin_uythac Gcoin</strong>.";
            }
            
            echo "OK<nbb>$gcoinnew<nbb>$gcoin_km<nbb>$uythac_point<nbb>$phut_uythac<nbb>$name đã kết thúc Ủy thác thành công.<br />$name Đã Ủy Thác Offline trong ngày : <strong>$UyThacOffline_Daily/720 phút</strong>, còn lại : <strong>$phut_uythac_daily phút</strong>.<br />Điểm Ủy Thác hiện tại : <strong>$PointUyThac/1440</strong>, còn lại : <strong>$phut_uythac_less điểm</strong><br />Vì vậy, $name tối đa nhận được điểm Ủy Thác trong : <strong>$phut_uythac_maxreceive</strong> phút.<br />$name đã Ủy thác trong : <strong>$phut_uythac_goc phút</strong>.<br />Nhận được <strong>$uythac_point điểm Ủy Thác</strong> tương ứng <strong>$phut_uythac phút Ủy Thác</strong>.<br /> $price_notice ";
        } else {
            echo "OK<nbb>$name đã kết thúc Ủy thác thành công. Ủy thác trong <b>$phut_uythac</b> phút, Do lựa chọn <b>không nhận điểm Ủy Thác</b> vì vậy nhân vật không được nhận điểm Ủy Thác.";
        }
	}
}

?>