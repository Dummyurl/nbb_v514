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
 
include('config/config_tuluyen.php');

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
    
    switch ($action) {
	case 'update':
        $tltype = $_POST['tltype'];
        switch ($tltype) { 
        	case 'str':
                $tuluyen_query = "SELECT nbbtuluyen_str, nbbtuluyen_str_point, nbbtuluyen_str_exp, nbbtuluyen_point FROM Character WHERE Name='$name' AND AccountID='$login'";
                $type_name = "Sức mạnh";
        	break;
        
        	case 'agi':
                $tuluyen_query = "SELECT nbbtuluyen_agi, nbbtuluyen_agi_point, nbbtuluyen_agi_exp, nbbtuluyen_point FROM Character WHERE Name='$name' AND AccountID='$login'";
                $type_name = "Nhanh nhẹn";
        	break;
        
        	case 'vit':
                $tuluyen_query = "SELECT nbbtuluyen_vit, nbbtuluyen_vit_point, nbbtuluyen_vit_exp, nbbtuluyen_point FROM Character WHERE Name='$name' AND AccountID='$login'";
                $type_name = "Thể lực";
        	break;
        
        	case 'ene':
                $tuluyen_query = "SELECT nbbtuluyen_ene, nbbtuluyen_ene_point, nbbtuluyen_ene_exp, nbbtuluyen_point FROM Character WHERE Name='$name' AND AccountID='$login'";
                $type_name = "Năng lượng";
        	break;
        
        	default :
                echo "Dữ liệu tu luyện sai."; exit();
        }
        
        $tuluyen_result = $db->Execute($tuluyen_query);
            check_queryerror($tuluyen_query, $tuluyen_result);
        $tuluyen_fetch = $tuluyen_result->FetchRow();
        $tltype_cap = $tuluyen_fetch[0];
        $tltype_point = $tuluyen_fetch[1];
        $tltype_exp = $tuluyen_fetch[2];
        $tl_point = $tuluyen_fetch[3];
        
        if($tl_point >= 10) {
            
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_tuluyen.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'update',
                
                'tltype_cap'  =>  $tltype_cap,
                'tltype_exp'  =>  $tltype_exp,
                'tl_point'  =>  $tl_point,
                'tuluyen_expcoban' =>  $tuluyen_expcoban,
                'tuluyen_expextra' =>  $tuluyen_expextra
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if ($info == "OK") {
                    $tuluyen_data = read_TagName($reponse, 'tuluyen');
                    if(strlen($tuluyen_data) == 0) {
                        echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                        
                        $arr_view = "\nDataSend:\n";
                        foreach($getcontent_data as $k => $v) {
                            $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                        }
                        writelog("log_api.txt", $arr_view . $reponse);
                        exit();
                    } else {
                        $tuluyen_arr = json_decode($tuluyen_data, true);
                        $tltype_exp_new = $tuluyen_arr['tltype_exp_new'];
                        $tl_point_new = $tuluyen_arr['tl_point_new'];
                        $tangcap = $tuluyen_arr['tangcap'];
                    }
                } else {
                    echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                    writelog("log_api.txt", $reponse);
                    exit();
                }
            }
            
            switch ($tltype){ 
            	case 'str':
                    $tuluyen_update_query = "UPDATE Character SET nbbtuluyen_str_exp = $tltype_exp_new, nbbtuluyen_point = $tl_point_new WHERE Name='$name' AND AccountID='$login'";
            	break;
            
            	case 'agi':
                    $tuluyen_update_query = "UPDATE Character SET nbbtuluyen_agi_exp = $tltype_exp_new, nbbtuluyen_point = $tl_point_new WHERE Name='$name' AND AccountID='$login'";
            	break;
            
            	case 'vit':
                    $tuluyen_update_query = "UPDATE Character SET nbbtuluyen_vit_exp = $tltype_exp_new, nbbtuluyen_point = $tl_point_new WHERE Name='$name' AND AccountID='$login'";
            	break;
            
            	case 'ene':
                    $tuluyen_update_query = "UPDATE Character SET nbbtuluyen_ene_exp = $tltype_exp_new, nbbtuluyen_point = $tl_point_new WHERE Name='$name' AND AccountID='$login'";
            	break;
            
            	default :
                    echo "Dữ liệu tu luyện sai."; exit();
            }
            
            $tuluyen_update_result = $db->Execute($tuluyen_update_query);
                check_queryerror($tuluyen_update_query, $tuluyen_update_result);
                
            $tuluyen_updated_arr = array(
                'exp'   =>  $tltype_exp_new,
                'tlpoint'   =>  $tl_point_new,
                'tangcap'   =>  $tangcap
            );
            $tuluyen_updated = json_encode($tuluyen_updated_arr);
            
            echo "<info>OK</info><tuluyen_info>$tuluyen_updated</tuluyen_info>";
            
            
            //Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
        	$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                $info_log_result = $db->Execute($info_log_query);
                    check_queryerror($info_log_query, $info_log_result);
                $info_log = $info_log_result->fetchrow();
                
                $log_acc = "$login";
                $log_gcoin = $info_log[0];
                $log_gcoin_km = $info_log[1];
                $log_vpoint = $info_log[2];
                $log_price = "";
                
                $log_Des = "Nhân vật <strong>$name</strong> tu luyện <strong>$type_name</strong> cấp $tltype_cap từ $tltype_exp lên $tltype_exp_new /.";
                $log_time = $timestamp;
                
                $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                $insert_log_result = $db->execute($insert_log_query);
                    check_queryerror($insert_log_query, $insert_log_result);
        	//End Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
        	
        } else {
            echo "Điểm Tu Luyện nhỏ hơn 10. Không thể thực hiện tu luyện"; exit();
        }
            
	break;

	case 'thangcap':
        $chao_query = "SELECT jewel_chao FROM MEMB_INFO WHERE memb___id='$login'";
        $chao_result = $db->Execute($chao_query);
            check_queryerror($chao_query, $chao_result);
        $chao_fetch = $chao_result->FetchRow();
        $chao = $chao_fetch[0];
        
        
        if($chao < 1) { // Chao check fail
            echo "Cần ít nhất 1 Chao trong ngân hàng để tiến hành Thăng cấp Tu Luyện."; exit();
        } else {    // Chao check ok
            $tltype = $_POST['tltype'];
            switch ($tltype){ 
            	case 'str':
                    $tuluyen_query = "SELECT nbbtuluyen_str, nbbtuluyen_str_point, nbbtuluyen_str_exp, nbbtuluyen_str_cp FROM Character WHERE Name='$name' AND AccountID='$login'";
                    $type_name = "Sức mạnh";
            	break;
            
            	case 'agi':
                    $tuluyen_query = "SELECT nbbtuluyen_agi, nbbtuluyen_agi_point, nbbtuluyen_agi_exp, nbbtuluyen_agi_cp FROM Character WHERE Name='$name' AND AccountID='$login'";
                    $type_name = "Nhanh nhẹn";
            	break;
            
            	case 'vit':
                    $tuluyen_query = "SELECT nbbtuluyen_vit, nbbtuluyen_vit_point, nbbtuluyen_vit_exp, nbbtuluyen_vit_cp FROM Character WHERE Name='$name' AND AccountID='$login'";
                    $type_name = "Thể lực";
            	break;
            
            	case 'ene':
                    $tuluyen_query = "SELECT nbbtuluyen_ene, nbbtuluyen_ene_point, nbbtuluyen_ene_exp, nbbtuluyen_ene_cp FROM Character WHERE Name='$name' AND AccountID='$login'";
                    $type_name = "Năng lượng";
            	break;
            
            	default :
                    echo "Dữ liệu tu luyện sai."; exit();
            }
            
            $tuluyen_result = $db->Execute($tuluyen_query);
                check_queryerror($tuluyen_query, $tuluyen_result);
            $tuluyen_fetch = $tuluyen_result->FetchRow();
            $tltype_cap = $tuluyen_fetch[0];
            $tltype_point = $tuluyen_fetch[1];
            $tltype_exp = $tuluyen_fetch[2];
            $tltype_cp = $tuluyen_fetch[3];
       
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_tuluyen.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'thangcap',
                
                'tltype_cap'  =>  $tltype_cap,
                'tuluyen_expcoban' =>  $tuluyen_expcoban,
                'tuluyen_expextra' =>  $tuluyen_expextra,
                'tuluyen_cpcoban' =>  $tuluyen_cpcoban,
                'tuluyen_cpextra' =>  $tuluyen_cpextra,
                'tuluyen_pointcoban'   =>  $tuluyen_pointcoban,
                'tuluyen_pointextra'   =>  $tuluyen_pointextra,
                'tltype_cp'    =>  $tltype_cp,
                'tltype_exp'   =>  $tltype_exp
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if ($info == "OK") {
                    $tuluyen_data = read_TagName($reponse, 'tuluyen');
                    if(strlen($tuluyen_data) == 0) {
                        echo "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                        
                        $arr_view = "\nDataSend:\n";
                        foreach($getcontent_data as $k => $v) {
                            $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                        }
                        writelog("log_api.txt", $arr_view . $reponse);
                        exit();
                    } else {
                        $tuluyen_arr = json_decode($tuluyen_data, true);
                        $exp_tuluyen_sum = $tuluyen_arr['exp_tuluyen_sum'];
                        $cp_rand = $tuluyen_arr['cp_rand'];
                        $tltype_cp_new = $tuluyen_arr['tltype_cp_new'];
                        $cp_sum = $tuluyen_arr['cp_sum'];
                        $tltype_cp_percent = $tuluyen_arr['tltype_cp_percent'];
                        $point_new = $tuluyen_arr['point_new'];
                        $point_next = $tuluyen_arr['point_next'];
                        $exp_tuluyen_next = $tuluyen_arr['exp_tuluyen_next'];
                    }
                } else {
                    echo "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                    writelog("log_api.txt", $reponse);
                    exit();
                }
            }
            
            if( $tltype_exp < $exp_tuluyen_sum ) {   // Kg tang cap
                echo "Chưa đủ Điểm Tu Luyện thực hiện Thăng Cấp";
            } else {
                $chao_new = $chao - 1;
                $chao_update_query = "UPDATE MEMB_INFO SET jewel_chao = $chao_new WHERE memb___id='$login'";
                $chao_update_result = $db->Execute($chao_update_query);
                    check_queryerror($chao_update_query, $chao_update_result);
                    
                
                if($tltype_cp_new < $cp_sum) { // Thang cap that bai
                    switch ($tltype) { 
                    	case 'str':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_str_cp = $tltype_cp_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'agi':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_agi_cp = $tltype_cp_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'vit':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_vit_cp = $tltype_cp_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'ene':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_ene_cp = $tltype_cp_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	default :
                            echo "Dữ liệu tu luyện sai."; exit();
                    }
                    
                    $thangcap_update_result = $db->Execute($thangcap_update_query);
                        check_queryerror($thangcap_update_query, $thangcap_update_result);
                        
                    $tangcap = 0;
                    $thangcap_updated_arr = array(
                        'tlcp_rand'  =>  $cp_rand,
                        'tlcp'   =>  $tltype_cp_percent,
                        'chao'  =>  $chao_new,
                        'tangcap'   =>  $tangcap
                    );
                    $log_Des = "Nhân vật <strong>$name</strong> thăng cấp <strong>$type_name</strong> từ cấp <strong>$tltype_cap</strong> lên ". $tltype_cap + 1 ." thất bại. Chúc phúc đạt <strong>$tltype_cp_percent %</strong>.";
                } else { // Thang cap thanh cong
                    $tltype_cap_new = $tltype_cap + 1;
                    switch ($tltype) { 
                    	case 'str':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_str = $tltype_cap_new, nbbtuluyen_str_cp = 0, nbbtuluyen_str_point = $point_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'agi':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_agi = $tltype_cap_new, nbbtuluyen_agi_cp = 0, nbbtuluyen_agi_point = $point_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'vit':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_vit = $tltype_cap_new, nbbtuluyen_vit_cp = 0, nbbtuluyen_vit_point = $point_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	case 'ene':
                            $thangcap_update_query = "UPDATE Character SET nbbtuluyen_ene = $tltype_cap_new, nbbtuluyen_ene_cp = 0, nbbtuluyen_ene_point = $point_new WHERE Name='$name' AND AccountID='$login'";
                    	break;
                    
                    	default :
                            echo "Dữ liệu tu luyện sai."; exit();
                    }
                    
                    $thangcap_update_result = $db->Execute($thangcap_update_query);
                        check_queryerror($thangcap_update_query, $thangcap_update_result);
                        
                    $tangcap = 1;
                    
                    $thangcap_updated_arr = array(
                        'tl_cap'   =>  $tltype_cap_new,
                        'tl_point'   =>  $point_new,
                        'tl_point_next'   =>  $point_next,
                        'tl_exp'   =>  $tltype_exp,
                        'tl_exp_next'   =>  $exp_tuluyen_next,
                        'tangcap'   =>  $tangcap
                    );
                    
                    $log_Des = "Nhân vật <strong>$name</strong> thăng cấp <strong>$type_name</strong> từ cấp <strong>$tltype_cap</strong> lên <strong>". $tltype_cap + 1 ."</strong> thành công.";
                }
                
                
                $thangcap_updated = json_encode($thangcap_updated_arr);
                
                echo "<info>OK</info><tuluyen_info>$thangcap_updated</tuluyen_info>";
                
                //Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
            	$info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
                    $info_log_result = $db->Execute($info_log_query);
                        check_queryerror($info_log_query, $info_log_result);
                    $info_log = $info_log_result->fetchrow();
                    
                    $log_acc = "$login";
                    $log_gcoin = $info_log[0];
                    $log_gcoin_km = $info_log[1];
                    $log_vpoint = $info_log[2];
                    $log_price = "";
                    
                    $log_time = $timestamp;
                    
                    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
                    $insert_log_result = $db->execute($insert_log_query);
                        check_queryerror($insert_log_query, $insert_log_result);
            	//End Ghi vào Log nhung nhan vat gui Jewel vao ngan hang
            }
        } // End Chao check
            
	break;
    
    default :
        $tuluyen_query = "SELECT nbbtuluyen_str, nbbtuluyen_str_point, nbbtuluyen_str_exp, nbbtuluyen_str_cp, nbbtuluyen_agi, nbbtuluyen_agi_point, nbbtuluyen_agi_exp, nbbtuluyen_agi_cp, nbbtuluyen_vit, nbbtuluyen_vit_point, nbbtuluyen_vit_exp, nbbtuluyen_vit_cp, nbbtuluyen_ene, nbbtuluyen_ene_point, nbbtuluyen_ene_exp, nbbtuluyen_ene_cp, nbbtuluyen_point FROM Character WHERE Name='$name' AND AccountID='$login'";
        $tuluyen_result = $db->Execute($tuluyen_query);
            check_queryerror($tuluyen_query, $tuluyen_result);
        $tuluyen_fetch = $tuluyen_result->FetchRow();
        
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_tuluyen.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            'action'    =>  'tuluyen_list',
            
            'tuluyen_fetch'    =>  json_encode($tuluyen_fetch),
            'tuluyen_cpcoban'  =>  $tuluyen_cpcoban,
            'tuluyen_cpextra'  =>  $tuluyen_cpextra
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            echo "Server bảo trì vui lòng liên hệ Admin để FIX";
            exit();
        }
        else {
            $info = read_TagName($reponse, 'info');
            if ($info == "OK") {
                $tuluyen_data = read_TagName($reponse, 'tuluyen');
                if(strlen($tuluyen_data) == 0) {
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

        echo "<nbb>OK<nbb>$tuluyen_data<nbb>";
}

	
	

}

?>