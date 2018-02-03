<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */

function _sync ($url_hosting, $file_sync, $data_sync) {
    global $typeupdate;
    if($typeupdate != 2) {
        include_once('admin_cfg/func_getContent.php');
        $getcontent_method = 'POST';
        $getcontent_curl = true;
        
        $getcontent_url = $url_hosting . "/hosting_sync.php";
        $getcontent_data = array(
            'file_sync'    =>  $file_sync,
            'data_sync'     =>  $data_sync
        ); 
        $reponse_sync = _getContent_sync($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        if ( empty($reponse_sync) ) {
            $output = "Không kết nối được đến NWeb Hosting <strong>". $url_hosting ."</strong>. Vui lòng kiểm tra lại đường dẫn<br />";
        } else {
            $error_sync = read_TagName($reponse_sync, 'error');
            $success_sync = read_TagName($reponse_sync, 'success');
            
            if(strlen($error_sync) > 0) {
                switch ($error_sync){ 
                	case 1:
                        $output = "Thư mục <strong>config</strong> và các <strong>File trong thư mục config</strong> thuộc Hosting <strong>". $url_hosting ."</strong> không có quyền ghi.<br /> Vui lòng <strong>CHMOD</strong> thư mục <strong>config sang 777</strong>, <strong>các File trong thư mục config sang 666</strong><br />";
                	break;
                    
                    case 2:
                        $output = "Không tồn tại thư mục <strong>config</strong> trên Hosting <strong>{$url_hosting}</strong>.<br />";
                	break;
                    
                    case 3:
                        $output = "Thư mục <strong>config</strong> không có quyền ghi trên Hosting <strong>{$url_hosting}</strong>. Vui lòng CHMOD thư mục <strong>config</strong> sang 777.<br />";
                	break;
                    
                    case 4:
                        $output = "File trong thư mục <strong>config</strong> không có quyền ghi trên Hosting <strong>{$url_hosting}</strong>. Vui lòng CHMOD tất cả các File trong thư mục <strong>config</strong> sang 666.<br />";
                	break;
                    
                    case 8:
                        $output = "File <strong>$file_sync</strong> không tồn tại trên Hosting <strong>{$url_hosting}</strong>. Vui lòng sử dụng phần mềm FTP UP thư mục <strong>config</strong> trên Server lên Hosting<br />";
                	break;
                    
                    case 9:
                        $output = "IP Server gửi dữ liệu đồng bộ không cho phép trên Hosting <strong>{$url_hosting}</strong>. Vui lòng sửa đúng IP hoặc NoIP rồi sử dụng phần mềm FTP UP file <strong>config_sync.php</strong> vào thư mục <strong>config</strong> trên Hosting <strong>{$url_hosting}</strong>.<br />";
                	break;
                    
                	default :
                        $output = "Lỗi Đồng Bộ trên Hosting <strong>{$url_hosting}</strong> chưa định nghĩa.<br />";
                }
            } elseif($success_sync == 'OK') {
                $output = 'OK';
            } else {
                $output = "Thiết lập đường dẫn đến Hosting <strong>{$url_hosting}</strong> sai.<br />";
            }
        }
        
        return $output;
    } else {
        return "OK";
    }
        
}

function read_TagName($content, $tagname, $vitri = 1)
{
    $tag_begin = '<'. $tagname . '>';
    $tag_end = '</'. $tagname . '>';
    $content1 = explode($tag_begin, $content);
    $slg_string = count($content1)-1;
    $output[] = $slg_string;    // Vị trí đầu tiên xuất ra số lượng phần tử
    for($i=1; $i<count($content1); $i++)    // Duyệt từ phần tử thứ 1 đến hết
    {
        $content2 = explode($tag_end, $content1[$i]);
        $output[] = $content2[0];
    }
    
    if($vitri == 0) return $output;
    else return $output[$vitri];
}

if(!function_exists(writelog)) {
    function writelog($file, $logcontent) {
        $Date = date("h:i:sA, d/m/Y");  
    	$fp = fopen($file, "a+");  
    	fputs ($fp, "Lúc: $Date. $logcontent \n----------------------------------------------------------------------\n\n");
    	fclose($fp);
    }
}

function addcontent($filename,$content)
{
	$fp = fopen($filename, "a+");  
	fputs ($fp, "$content");  
	fclose($fp);
}

function replacecontent($filename,$content)
{
	include_once('config.php');
    
    $fp = fopen($filename, "w");  
	@fputs ($fp, "$content");  
	fclose($fp);
    
    include_once('config/config_sync.php');
    if(isset($typeupdate) && $typeupdate == 2) {
        $filename_slashes = addslashes($filename);
        $flag_update_file = "flag_update.txt";
        $fp = fopen($flag_update_file, "r");
    		$flag_update = fgets($fp);
    	fclose($fp);
        
        $flag_update_arr = json_decode($flag_update, true);
        if(!is_array($flag_update_arr)) $flag_update_arr = array();
        
        foreach($list_ip as $hostip) {
            $flag_update_arr[$hostip][$filename_slashes] = 1;
        }
        
        $flag_update_new = json_encode($flag_update_arr);
        $fp = fopen($flag_update_file, "w");  
    	@fputs ($fp, $flag_update_new);  
    	fclose($fp);
    }
}

function readcontent($filename)
{
	$fp = fopen($filename, "r");
	while (!feof($fp)) {
		$line[] = fgets($fp,1000);
	}
	fclose($fp);
	return $line;
}

function shop_load($filename)
{
	$stt = 0;
	if(is_file($filename)) {
		$fopen_host = fopen($filename, "r");
		
		while (!feof($fopen_host)) {
			$get_item = fgets($fopen_host,200);
			$get_item = preg_replace('(\n)', '', $get_item);
			if($get_item) {
				$item_info = explode('|', $get_item);
				
				$check_stat = substr($get_item,0,2);
				if($check_stat == '//') $stat = 0;
				else $stat = 1;
				
				$stt++;
				
				$item_read[] = array (
					'stt'	=> $stt,
					'key'	=> $item_info[0],
					'code'	=> $item_info[1],
					'des'	=> $item_info[2],
					'price'	=> $item_info[3],
					'target_x'		=> $item_info[4],
					'target_y'		=> $item_info[5],
					'img'	=> $item_info[6],
					'stat'	=> $stat
				);
			}
		}
	} else $fopen_host = fopen($filename, "w");
	fclose($fopen_host);
	return $item_read;
}

function display_shop($item_read,$act)
{
	$stt = count($item_read);
	
	$content = "<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
		<tr bgcolor='#FFFFFF' >
			<td align='center'>#</td>
			<td align='center'>Đồ vật</td>
			<td align='center'>Giá <br />
		    (V.Point)</td>
		    <td align='center'>x</td>
		    <td align='center'>y</td>
		    <td align='center'>Hình</td>
		    <td align='center' width='50'>&nbsp;</td>
		</tr>";
	for($i=0;$i<$stt;$i++) {
		$content .= "<tr bgcolor='#FFFFFF' >
			<td align='center'>".$item_read[$i][stt]."</td>
			<td align='center'>".$item_read[$i][des]."</td>
			<td align='center'>".number_format($item_read[$i][price], 0, ',', '.')."</td>
			<td align='center'>".$item_read[$i][target_x]."</td>
			<td align='center'>".$item_read[$i][target_y]."</td>
			<td align='center'><img src='img_item/shop_taphoa/".$item_read[$i][img]."'></td>
			<td align='center'><a href='admin.php?mod=editwebshop&act=".$act."&page=edit&item=".$item_read[$i][stt]."' target='_self'>Sửa</a> / <a href='admin.php?mod=editwebshop&act=".$act."&page=del&item=".$item_read[$i][stt]."' target='_self'>Xóa</a></td>
		</tr>";
	}
	$content .= "</table>";
	
	echo $content;
}


/**
 * reward_load()
 * $filename : file data
 * 
 * @return
 * $item_type_arr[code] = array(
 *      'item_name' =>  Item Name
 *      'price' =>  Price 1 Day
 *      'img'   =>  URL Image Item
 *      'exl_type'  =>  Loai Item hoan Hao
 *      'stat'  =>  0: Kg cho thue, 1: Cho thue
  * )
 */
function reward_load($filename)
{
	$stt = 0;
    $item_data_arr = array();
	if(is_file($filename)) {
		$fopen_host = fopen($filename, "r");
		$item_data = fgets($fopen_host);
        $item_data_arr = json_decode($item_data, true);
	} else $fopen_host = fopen($filename, "w");
	fclose($fopen_host);
	
    return $item_data_arr;
}

function reward_display($item_read, $reward_type, $act)
{
	$count_item = count($item_read[$reward_type]);
	
	$content = "<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
		<tr bgcolor='#FFFFFF' >
			<td align='center'>#</td>
			<td align='center'>Đồ vật</td>
			<td align='center'>Giá thuê 1 ngày<br />
		    (Gcoin)</td>
		    <td align='center'>Hình</td>
            <td align='center'>Cho Thuê</td>
		    <td align='center' width='50'>&nbsp;</td>
		</tr>";
	$stt = 0;
    if(is_array($item_read[$reward_type])) {
        foreach($item_read[$reward_type] as $item_key => $item_val) {
    	   $stt = ++$stt;
    		$status = ($item_val['stat'] == 1) ? '<font color="blue"><strong>Có</strong></font>' : '<font color="red">Không</font>';
            $content .= "<tr bgcolor='#FFFFFF' >
    			<td align='center'>". $stt ."</td>
    			<td align='center'>". $item_val['item_name'] ."</td>
    			<td align='center'>". number_format($item_val['price'], 0, ',', '.') ."</td>
    			<td align='center' bgcolor='#333'><img src='items/". $item_val['img'] .".gif'></td>
                <td align='center' >". $status ."</td>
    			<td align='center'><a href='admin.php?mod=editreward&act=". $act ."&page=edit&reward_type=". $reward_type ."&item=". $item_key ."' target='_self'>Sửa</a> / <a href='admin.php?mod=editreward&act=". $act ."&page=del&reward_type=". $reward_type ."&item=". $item_key ."' target='_self'>Xóa</a></td>
    		</tr>";
    	}
    }
        
	$content .= "</table>";
	
	echo $content;
}

function giftcode_load($filename)
{
	$stt = 0;
	if(is_file($filename)) {
		$fopen_host = fopen($filename, "r");
		
		while (!feof($fopen_host)) {
			$get_item = fgets($fopen_host,1000);
			$get_item = preg_replace('(\n)', '', $get_item);
			if($get_item) {
				$item_info = explode('|', $get_item);
				if(strlen($item_info[1]) > 0 && strlen($item_info[1])%32 == 0) {
				    $check_stat = substr($get_item,0,2);
    				if($check_stat == '//') $stat = 0;
    				else $stat = 1;
    				
    				$stt++;
    				
    				$item_read[] = array (
    					'stt'	=> $stt,
    					'code'	=> $item_info[1],
    					'des'	=> $item_info[2],
    					'rate'	=> $item_info[3],
    					'stat'	=> $stat
    				);
				}
			}
		}
	} else $fopen_host = fopen($filename, "w");
	fclose($fopen_host);
	return $item_read;
}

function giftcode_display($item_read,$act)
{
	$stt = count($item_read);
	
	$content = "<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
		<tr bgcolor='#FFFFFF' >
			<td align='center'>#</td>
			<td align='center'>Phần thưởng</td>
			<td align='center'>Tỷ lệ xuất hiện</td>
		    <td align='center' width='50'>&nbsp;</td>
		</tr>";
	for($i=0;$i<$stt;$i++) {
		$content .= "<tr bgcolor='#FFFFFF' >
			<td align='center'>".$item_read[$i][stt]."</td>
			<td align='center'>".$item_read[$i][des]."</td>
			<td align='center'>".$item_read[$i][rate]."</td>
			<td align='center'><a href='admin.php?mod=editevent&act=".$act."&page=edit&item=".$item_read[$i][stt]."' target='_self'>Sửa</a> / <a href='admin.php?mod=editevent&act=".$act."&page=del&item=".$item_read[$i][stt]."' target='_self'>Xóa</a></td>
		</tr>";
	}
	$content .= "</table>";
	
	echo $content;
}
?>