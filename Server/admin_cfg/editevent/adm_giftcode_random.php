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
 
$page = $_GET['page'];

switch ($act)
{
	case 'giftcode_random_type1': 
		$file_edit = 'config/giftcode_random_type1.txt';
		$tilte = "Phần thưởng GiftCode ngẫu nhiên loại 1";
		break;
        
	case 'giftcode_random_type2': 
		$file_edit = 'config/giftcode_random_type2.txt';
		$tilte = "Phần thưởng GiftCode ngẫu nhiên loại 2";
		break;
        
	case 'giftcode_random_type3': 
		$file_edit = 'config/giftcode_random_type3.txt';
		$tilte = "Phần thưởng GiftCode ngẫu nhiên loại 3";
		break;
	
	default: $file_edit = ''; break;
}

if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

if($accept==0) $show_accept = "disabled='disabled'";
else $show_accept = "";

require_once('admin_cfg/function.php');


$action = $_POST[action];

switch ($action)
{
	case 'add':
		$code = $_POST['code'];
		$des = $_POST['des'];
		$rate = $_POST['rate']; $rate = abs(intval($rate));

        $error = "";
        if (!preg_match("/^[A-F0-9]*$/i", $code))
    	{
            $error .= "Dữ liệu lỗi <strong>Mã phần thưởng</strong> : $code . Chỉ được sử dụng ký tự a-f, A-F, so (0-9).<br />"; 
    	}
        if( strlen($code) < 32 || strlen($code)%32 != 0 ) {
            $error .= "Dữ liệu lỗi <strong>Mã phần thưởng</strong> : $code sai cấu trúc.<br />";
        }
        
        if(strlen($error) > 0) {
            $notice = "<center><b><font color='red'>" . $error . "</font></b></center>";
        } else {
            $item_get = giftcode_load($file_edit);
            $slg_item = count($item_get);
    		$content = '';
    		for($i=0;$i<$slg_item;$i++)
    		{
    			$content .= "|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['rate']."|";
    			if($i<($slg_item-1)) $content .= "\n";
    		}
            
            if($slg_item > 0) $content .= "\n";
            $content .= "|".$code."|".$des."|".$rate."|";
            
    		replacecontent($file_edit,$content);
    		
    		include('config/config_sync.php');
		    for($i=0; $i<count($url_hosting); $i++)
		    {
		        if($url_hosting[$i]) {
		            $sync_send = _sync($url_hosting[$i], $file_edit, $content);
		            if($sync_send == 'OK') {
		                
		            } else {
		                $err .= $sync_send;
		            }
		        }
		    }
		    
			if($err) {
		        $notice = "<center><font color='red'><strong>Lỗi :</strong><br />$err</font></center>";
		    } else {
		    	$notice = "<center><font color='blue'>Sửa thành công</font></center>";
		    }
        }
        
		break;
	
	case 'edit':
		$item = $_POST['item'];
		$code = $_POST['code'];
		$des = $_POST['des'];
		$rate = $_POST['rate'];     $rate = abs(intval($rate));
		
        $error = "";
        if (!preg_match("/^[A-F0-9]*$/i", $code))
    	{
            $error .= "Dữ liệu lỗi <strong>Mã phần thưởng</strong> : $code . Chỉ được sử dụng ký tự a-f, A-F, so (0-9).<br />"; 
    	}
        if( strlen($code) < 32 || strlen($code)%32 != 0 ) {
            $error .= "Dữ liệu lỗi <strong>Mã phần thưởng</strong> : $code sai cấu trúc.<br />";
        }
        
        if(strlen($error) > 0) {
            $notice = "<center><b><font color='red'>" . $error . "</font></b></center>";
        } else {
            $item_get = giftcode_load($file_edit);
    		
    		$item_get[$item]['code'] = $code;
    		$item_get[$item]['des'] = $des;
    		$item_get[$item]['rate'] = $rate;
    		
    		$slg_item = count($item_get);
    		$content = '';
    		for($i=0;$i<$slg_item;$i++)
    		{
    			$content .= "|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['rate']."|";
    			if($i<($slg_item-1)) $content .= "\n";
    		}
    		
    		replacecontent($file_edit,$content);
    		
    		include('config/config_sync.php');
		    for($i=0; $i<count($url_hosting); $i++)
		    {
		        if($url_hosting[$i]) {
		            $sync_send = _sync($url_hosting[$i], $file_edit, $content);
		            if($sync_send == 'OK') {
		                
		            } else {
		                $err .= $sync_send;
		            }
		        }
		    }
		    
			if($err) {
		        $notice = "<center><font color='red'><strong>Lỗi :</strong><br />$err</font></center>";
		    } else {
		    	$notice = "<center><font color='blue'>Sửa thành công</font></center>";
		    }
        }
		break;
	
	case 'del':
		$item = $_POST['item'];
		
		$item_get = giftcode_load($file_edit);
		$slg_item = count($item_get);
		$content = '';
		for($i=0;$i<$slg_item;$i++)
		{
			if($i != $item)
			{
				$content .= "|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['rate']."|";
			if( $i<($slg_item-1) ) $content .= "\n";
			}
		}
		replacecontent($file_edit,$content);
		include('config/config_sync.php');
	    for($i=0; $i<count($url_hosting); $i++)
	    {
	        if($url_hosting[$i]) {
	            $sync_send = _sync($url_hosting[$i], $file_edit, $content);
	            if($sync_send == 'OK') {
	                
	            } else {
	                $err .= $sync_send;
	            }
	        }
	    }
	    
		if($err) {
	        $notice = "<center><font color='red'><strong>Lỗi :</strong><br />$err</font></center>";
	    } else {
	    	$notice = "<center><font color='blue'>Sửa thành công</font></center>";
	    }
		break;
}


$item_read = giftcode_load($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình <?php echo $tilte; ?></h1>
			</div><br>
				Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php 
if($notice) echo $notice;

switch ($page)
{
	case 'add': 
		$content = "<center><b>Thêm phần thưởng</b></center><br>
			<form id='editconfig' name='editconfig' method='post' action='admin.php?mod=editevent&act=".$act."'>
			<input type='hidden' name='action' value='add'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Mã phần thưởng</td>
					<td ><input type='text' name='code' value='' size='36' /> <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả phần thưởng</td>
					<td ><input type='text' name='des' value='' size='30'/> (Chú giải về phần thưởng như : 10 viên Bless, 10 viên Soul)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Tỷ lệ xuất hiện</td>
					<td ><input type='text' name='rate' value='10' size='5'/> (Tỷ lệ càng cao, khả năng ra phần thường này càng lớn)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >&nbsp;</td>
					<td align='center'><input type='submit' name='Submit' value='Thêm phần thưởng' ". $show_accept ." /></td>
				</tr>
			</table>
			</form>";
		echo $content;
		break;
	
	case 'edit': 
		$item = $_GET['item'];
		$item_right = $item - 1;
		$content = "<center><b>Sửa Phần thưởng</b></center><br>
			<form id='editconfig' name='editconfig' method='post' action='admin.php?mod=editevent&act=".$act."'>
			<input type='hidden' name='action' value='edit'/>
			<input type='hidden' name='item' value='".$item_right."'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Mã Phần thưởng</td>
					<td ><input type='text' name='code' value='".$item_read[$item_right]['code']."' size='36' /> <a href='admin/giftcode_getitem.php'>Hướng dẫn lấy mã phần thưởng</a></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả phần thưởng</td>
					<td ><input type='text' name='des' value='".$item_read[$item_right]['des']."' size='30'/> (Chú giải về phần thưởng như : 10 viên Bless, 10 viên Soul)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Tỷ lệ xuất hiện</td>
					<td ><input type='text' name='rate' value='".$item_read[$item_right]['rate']."' size='5'/> (Tỷ lệ càng cao, khả năng ra phần thường này càng lớn)</td>
				</tr>
				
				<tr bgcolor='#FFFFFF' >
					<td >&nbsp;</td>
					<td align='center'><input type='submit' name='Submit' value='Sửa' ". $show_accept ." /></td>
				</tr>
			</table>
			</form>";
		echo $content;
		break;
	
	case 'del':
		$item = $_GET['item'];
		$item_right = $item - 1;
		$content = "<center><b>Xóa Item</b></center><br>
			<form id='delitem' name='delitem' method='post' action='admin.php?mod=editevent&act=".$act."'>
			<input type='hidden' name='action' value='del'/>
			<input type='hidden' name='item' value='".$item_right."'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Mã Phần thưởng</td>
					<td >".$item_read[$item_right]['code']."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả Phần thưởng</td>
					<td >".$item_read[$item_right]['des']."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Tỷ lệ xuất hiện</td>
					<td >".$item_read[$item_right]['rate']." Vpoint</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >&nbsp;</td>
					<td align='left'><input type='submit' name='Submit' value='Xóa' ". $show_accept ." /></td>
				</tr>
			</table>
			</form>";
		echo $content;
		
		break;	
		
	default: 
		echo "<b>Tỷ lệ xuất hiện</b>: Tỷ lệ này càng cao thì khả năng ra đồ càng nhiều.<br>
				Phần thưởng quý nên để tỷ lệ xuất hiện thấp.<br>
				<div align='right'><a href='admin.php?mod=editevent&act=".$act."&page=add'>+ Thêm phần thưởng</a></div><br>";
		giftcode_display($item_read,$act); 
		break;
	
}

?>
				
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br>
			- Tên WebSite<br>
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
