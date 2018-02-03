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

    switch ($action){ 
    	case 'check_item':
            $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
            $warehouse_result = $db->Execute($warehouse_query);
                check_queryerror($warehouse_query, $warehouse_result);
            $warehouse_fetch = $warehouse_result->FetchRow();
            $warehouse = $warehouse_fetch[0];
            $warehouse = bin2hex($warehouse);
            $warehouse = strtoupper($warehouse);
            
            $warehouse1 = substr($warehouse,0,120*32);
            $warehouse2 = substr($warehouse,120*32);
                    
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_maychao.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'longcondor_check_item',
                
                'warehouse1'    =>  $warehouse1
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if($info == "Error") {
                    echo read_TagName($reponse, 'message');
                    exit();
                } elseif ($info == "OK") {
                    $check_info = read_TagName($reponse, 'check_info');
                    if(strlen($check_info) == 0) {
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
            
            echo "<nbb>OK<nbb>$check_info<nbb>";
    	break;
        
        
        case 'longcondor_quay':
            kiemtra_online($login);
            $serial = _getSerial();
            $warehouse_query = "SELECT CAST(Items AS image) FROM warehouse WHERE AccountID = '$login'";
            $warehouse_result = $db->Execute($warehouse_query);
                check_queryerror($warehouse_query, $warehouse_result);
            $warehouse_fetch = $warehouse_result->FetchRow();
            $warehouse = $warehouse_fetch[0];
            $warehouse = bin2hex($warehouse);
            $warehouse = strtoupper($warehouse);
            
            $warehouse1 = substr($warehouse,0,120*32);
            $warehouse2 = substr($warehouse,120*32);
                    
            include_once('config_license.php');
            include_once('func_getContent.php');
            $getcontent_url = $url_license . "/api_maychao.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'longcondor_quay',
                
                'warehouse1'    =>  $warehouse1,
                'serial'   =>  $serial
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                echo "Server bảo trì vui lòng liên hệ Admin để FIX";
                exit();
            }
            else {
                $info = read_TagName($reponse, 'info');
                if($info == "Error") {
                    echo read_TagName($reponse, 'message');
                    exit();
                } elseif ($info == "OK") {
                    $reponse_info = read_TagName($reponse, 'reponse');
                    if(strlen($reponse_info) == 0) {
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
            
            
            if($reponse_info > 0) {
                $warehouse1_new = read_TagName($reponse, 'warehouse1');
                $warehouse_new = $warehouse1_new . $warehouse2;
                
                $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                $warehouse_update_result = $db->Execute($warehouse_update_query);
                    check_queryerror($warehouse_update_query, $warehouse_update_result);
                    
                
                //Ghi vào Log nhung nhan vat doi gioi tinh
                $item_nguyenlieu = read_TagName($reponse, 'item_nguyenlieu');
                $item_epsuccess = read_TagName($reponse, 'item_epsuccess');
                switch ($reponse_info){ 
                	case 1:
                        $log_Des = "$name đã ép thành công <strong>Lông Vũ Condor : $item_epsuccess</strong>. Nguyên liệu ép : $item_nguyenlieu";
                	break;
                
                	case 2:
                        $log_Des = "$name đã ép thất bại. Nguyên liệu ép : $item_nguyenlieu";
                	break;
                }
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
                //End Ghi vào Log nhung nhan vat doi gioi tinh
            }
            
            echo "
                    <info>OK</info>
                    <success>$reponse_info</success>
                    ";
        break;
    }
}

?>