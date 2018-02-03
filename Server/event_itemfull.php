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
 
	include_once("security.php");
include_once("config.php");
include_once("function.php");

include_once("config/config_event.php");

if($hotroitem_on != 1) {
    echo "Chức năng chưa bật!"; exit();
} else {
        $login=$_POST["login"];
    $item=$_POST["item"];
    $pass2 = $_POST['pass2'];
    
    $passtransfer = $_POST["passtransfer"];
    
    if ($passtransfer == $transfercode) {
    
        $string_login = $_POST['string_login'];
        checklogin($login,$string_login);
        
        $file_item = 'config/event_itemhotro.txt';
        	
        //Đọc File Item
        $stt = 0;
        $accept = 0;
        if(is_file($file_item)) 
        {
        	$fopen_host = fopen($file_item, "r");
        	while (!feof($fopen_host)) {
        		$item_get = fgets($fopen_host);
                $item_get = preg_replace('(\n)', '', $item_get);
                $item_get = trim($item_get);
                if(substr($item_get,0,2) != '//') {
                    $item_info = explode('|', $item_get);
        			if ($item == $item_info[0]) {
        				$item_code=$item_info[1];	
        				$item_name=$item_info[2];	
        				$accept = 1;
        				break;
        			}
                }
        	}
        } else $fopen_host = fopen($file_item, "w");
        fclose($fopen_host);
    
        if($accept == 0) { echo "Trên Server không có Item bạn muốn mua. Chi tiết vui lòng liên hệ BQT để cập nhập."; exit(); }
        	
        kiemtra_pass2($login,$pass2);
        kiemtra_doinv($login,$name);
        kiemtra_online($login);
        
        
        $warehouse_query = "SELECT Items FROM warehouse WHERE AccountID='$login'";
        $warehouse_result = $db->Execute($warehouse_query);
            check_queryerror($warehouse_query, $warehouse_result);
        $warehouse_fetch = $warehouse_result->FetchRow();
        $warehouse = $warehouse_fetch[0];
        $warehouse = bin2hex($warehouse);
        $warehouse = strtoupper($warehouse);
        $warehouse1 = substr($warehouse,0,120*32);
        $warehouse2 = substr($warehouse,120*32);
        
        
        $data_send_arr = array(
            'item_code' =>  $item_code,
            'warehouse1'    =>  $warehouse1
        );
        $data_send = serialize($data_send_arr);
        
        include_once('config_license.php');
        include_once('func_getContent.php');
        $getcontent_url = $url_license . "/api_event_itemfull.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'data_send'    =>  $data_send
        ); 
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        if ( empty($reponse) ) {
            $notice = "Server bảo trì. Vui lòng liên hệ Admin để FIX";
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $notice = read_TagName($reponse, 'message');
                if(strlen($notice) == 0) {
                    $notice = read_TagName($reponse, 'msg');
                }
            }
            else if ($info == "OK") {
                $warehouse1_receive = read_TagName($reponse, 'warehouse1');
                if( strlen($warehouse1_receive) == 0 ) {
                    $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                    
                    $arr_view = "\nDataSend:\n";
                    foreach($getcontent_data as $k => $v) {
                        $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                    }
                    writelog("log_api.txt", $arr_view . $reponse);
                } else {
                    kiemtra_online($login);
        
                	$warehouse_new = $warehouse1_receive . $warehouse2;
                    
                    $warehouse_update_query = "UPDATE warehouse SET Items=0x$warehouse_new WHERE AccountID='$login'";
                    $warehouse_update_result = $db->Execute($warehouse_update_query);
                        check_queryerror($warehouse_update_query, $warehouse_update_result);
        
                    $notice  = "<info>OK</info><item_name>$item_name</item_name>";
                }
            } else {
                $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                writelog("log_api.txt", $reponse);
            }
        }
        
        echo $notice;
    }
}

$db->Close();
?>