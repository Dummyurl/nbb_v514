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
	case 'shop_taphoa': 
		$file_edit = 'config/shop_taphoa.txt';
		$folder_img = 'shop_taphoa';
		$tilte = "Cửa hàng Tạp Hóa";
		break;
	case 'shop_event': 
		$file_edit = 'config/shop_event.txt';
		$folder_img = 'shop_event';
		$tilte = "Cửa hàng Vé Event";
		break;
	case 'shop_acient': 
		$file_edit = 'config/shop_acient.txt';
		$folder_img = 'shop_acient';
		$tilte = "Cửa hàng SET Thần Thánh";
		break;
	case 'shop_kiem': 
		$file_edit = 'config/shop_kiem.txt';
		$folder_img = 'shop_kiem';
		$tilte = "Cửa hàng Kiếm";
		break;
	case 'shop_gay': 
		$file_edit = 'config/shop_gay.txt';
		$folder_img = 'shop_gay';
		$tilte = "Cửa hàng Gậy";
		break;
	case 'shop_cung': 
		$file_edit = 'config/shop_cung.txt';
		$folder_img = 'shop_cung';
		$tilte = "Cửa hàng Cung";
		break;
	case 'shop_vukhikhac': 
		$file_edit = 'config/shop_vukhikhac.txt';
		$folder_img = 'shop_vukhikhac';
		$tilte = "Cửa hàng Vũ Khí Khác";
		break;
	case 'shop_khien': 
		$file_edit = 'config/shop_khien.txt';
		$folder_img = 'shop_khien';
		$tilte = "Cửa hàng Khiên";
		break;
	case 'shop_mu': 
		$file_edit = 'config/shop_mu.txt';
		$folder_img = 'shop_mu';
		$tilte = "Cửa hàng Mũ";
		break;
	case 'shop_ao': 
		$file_edit = 'config/shop_ao.txt';
		$folder_img = 'shop_ao';
		$tilte = "Cửa hàng Áo";
		break;
	case 'shop_quan': 
		$file_edit = 'config/shop_quan.txt';
		$folder_img = 'shop_quan';
		$tilte = "Cửa hàng Quần";
		break;
	case 'shop_tay': 
		$file_edit = 'config/shop_tay.txt';
		$folder_img = 'shop_tay';
		$tilte = "Cửa hàng Tay";
		break;
	case 'shop_chan': 
		$file_edit = 'config/shop_chan.txt';
		$folder_img = 'shop_chan';
		$tilte = "Cửa hàng Chân";
		break;
	case 'shop_trangsuc': 
		$file_edit = 'config/shop_trangsuc.txt';
		$folder_img = 'shop_trangsuc';
		$tilte = "Cửa hàng Trang Sức";
		break;
	case 'shop_canh': 
		$file_edit = 'config/shop_canh.txt';
		$folder_img = 'shop_canh';
		$tilte = "Cửa hàng Cánh";
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
		$key = $_POST['key'];
		$code = $_POST['code'];       $code = strtoupper($code);
		$des = $_POST['des'];
		$price = $_POST['price']; $price = abs(intval($price));
		$target_x = $_POST['target_x'];   $target_x = abs(intval($target_x));
		$target_y = $_POST['target_y'];   $target_y = abs(intval($target_y));
		$img = $_POST['img'];
		
        $error = "";
        if (!preg_match("/^[A-F0-9]*$/i", $code))
    	{
            $error .= "Dữ liệu lỗi <strong>Mã Item</strong> : $code . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($code) < 32 || strlen($code)%32 != 0 ) {
            $error .= "Dữ liệu lỗi <strong>Mã Item</strong> : $code sai cấu trúc.<br />";
        }
        
        if(strlen($error) > 0) {
            $notice = "<center><b><font color='red'>$error</font></b></center>";
        } else {
            $item_get = shop_load($file_edit);
            $slg_item = count($item_get);
            $content = '';
    		for($i=0;$i<$slg_item;$i++)
    		{
    			$content .= $item_get[$i]['key']."|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['price']."|".$item_get[$i]['target_x']."|".$item_get[$i]['target_y']."|".$item_get[$i]['img']."|";
    			if($i<($slg_item-1)) $content .= "\n";
    		}
    		
    		if($slg_item>0) $content .= "\n";
    		$content .= $key."|".$code."|".$des."|".$price."|".$target_x."|".$target_y."|".$img."|";
    		
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
		$key = $_POST['key'];
		$code = $_POST['code'];       $code = strtoupper($code);
		$des = $_POST['des'];
		$price = $_POST['price'];     $price = abs(intval($price));
		$target_x = $_POST['target_x'];   $target_x = abs(intval($target_x));
		$target_y = $_POST['target_y'];   $target_y = abs(intval($target_y));
		$img = $_POST['img'];
		
        $error = "";
        if (!preg_match("/^[A-F0-9]*$/i", $code))
    	{
            $error .= "Dữ liệu lỗi <strong>Mã Item</strong> : $code . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($code) < 32 || strlen($code)%32 != 0 ) {
            $error .= "Dữ liệu lỗi <strong>Mã Item</strong> : $code sai cấu trúc.<br />";
        }
        
        if(strlen($error) > 0) {
            $notice = "<center><b><font color='red'>$error</font></b></center>";
        } else {
            $item_get = shop_load($file_edit);
    		
    		$item_get[$item]['key'] = $key;
    		$item_get[$item]['code'] = $code;
    		$item_get[$item]['des'] = $des;
    		$item_get[$item]['price'] = $price;
    		$item_get[$item]['target_x'] = $target_x;
    		$item_get[$item]['target_y'] = $target_y;
    		$item_get[$item]['img'] = $img;
    		
    		$slg_item = count($item_get);
    		$content = '';
    		for($i=0;$i<$slg_item;$i++)
    		{
    			$content .= $item_get[$i]['key']."|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['price']."|".$item_get[$i]['target_x']."|".$item_get[$i]['target_y']."|".$item_get[$i]['img']."|";
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
		
		$item_get = shop_load($file_edit);
		$slg_item = count($item_get);
		$content = '';
		for($i=0;$i<$slg_item;$i++)
		{
			if($i != $item)
			{
				$content .= $item_get[$i]['key']."|".$item_get[$i]['code']."|".$item_get[$i]['des']."|".$item_get[$i]['price']."|".$item_get[$i]['target_x']."|".$item_get[$i]['target_y']."|".$item_get[$i]['img']."|";
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


$item_read = shop_load($file_edit);
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
		$content = "<center><b>Thêm Item</b></center><br>
			<form id='editconfig' name='editconfig' method='post' action='admin.php?mod=editwebshop&act=".$act."'>
			<input type='hidden' name='action' value='add'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Key Item</td>
					<td ><input type='text' name='key' value='bless' size='15'/> (Viết liền, không dấu. Bao gồm : \"1-9\", \"a-z\", \"A-Z\" và dấu \"_\")</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mã Item</td>
					<td ><input type='text' name='code' value='1E0000001234560000C0000000000000' size='36' maxlength='32'/> <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã Item</a></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả Item</td>
					<td ><input type='text' name='des' value='Bless' size='30'/> (Chú giải về Item)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Giá Item</td>
					<td ><input type='text' name='price' value='100' size='5'/> Vpoint</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hàng</td>
					<td ><input type='text' name='target_x' value='1' size='1'/> (Số ô Item chiếm chiều ngang)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Cột</td>
					<td ><input type='text' name='target_y' value='1' size='1'/> (Số ô Item chiếm chiều dọc)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hình Item</td>
					<td ><input type='text' name='img' value='bless.jpg' size='20'/> Hình nằm trong thư mục <b></i>img_item/".$folder_img."</i></b></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >&nbsp;</td>
					<td align='center'><input type='submit' name='Submit' value='Thêm Item' ". $show_accept ." /></td>
				</tr>
			</table>
			</form>";
		echo $content;
		break;
	
	case 'edit': 
		$item = $_GET['item'];
		$item_right = $item - 1;
		$content = "<center><b>Sửa Item</b></center><br>
			<form id='editconfig' name='editconfig' method='post' action='admin.php?mod=editwebshop&act=".$act."'>
			<input type='hidden' name='action' value='edit'/>
			<input type='hidden' name='item' value='".$item_right."'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Key Item</td>
					<td ><input type='text' name='key' value='".$item_read[$item_right][key]."' size='15'/> (Viết liền, không dấu. Bao gồm : \"1-9\", \"a-z\", \"A-Z\" và dấu \"_\")</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mã Item</td>
					<td ><input type='text' name='code' value='".$item_read[$item_right][code]."' size='36' maxlength='32'/> <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã Item</a></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả Item</td>
					<td ><input type='text' name='des' value='".$item_read[$item_right][des]."' size='30'/> (Chú giải về Item)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Giá Item</td>
					<td ><input type='text' name='price' value='".$item_read[$item_right][price]."' size='5'/> Vpoint</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hàng</td>
					<td ><input type='text' name='target_x' value='".$item_read[$item_right][target_x]."' size='1'/> (Số ô Item chiếm chiều ngang)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Cột</td>
					<td ><input type='text' name='target_y' value='".$item_read[$item_right][target_y]."' size='1'/> (Số ô Item chiếm chiều dọc)</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hình Item</td>
					<td ><input type='text' name='img' value='".$item_read[$item_right][img]."' size='20'/> 
					<img src='img_item/".$folder_img."/".$item_read[$item_right][img]."'>
					<br>Hình nằm trong thư mục <b></i>img_item/".$folder_img."</i></b></td>
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
			<form id='delitem' name='delitem' method='post' action='admin.php?mod=editwebshop&act=".$act."'>
			<input type='hidden' name='action' value='del'/>
			<input type='hidden' name='item' value='".$item_right."'/>
			<table width='100%' border='0' cellpadding='3' cellspacing='1' bgcolor='#9999FF'>
				<tr bgcolor='#FFFFFF' >
					<td >Key Item</td>
					<td >".$item_read[$item_right][key]."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mã Item</td>
					<td >".$item_read[$item_right][code]."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Mổ tả Item</td>
					<td >".$item_read[$item_right][des]."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Giá Item</td>
					<td >".$item_read[$item_right][price]." Vpoint</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hàng</td>
					<td >".$item_read[$item_right][target_x]."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Cột</td>
					<td >".$item_read[$item_right][target_y]."</td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >Hình Item</td>
					<td ><img src='img_item/".$folder_img."/".$item_read[$item_right][img]."'></td>
				</tr>
				<tr bgcolor='#FFFFFF' >
					<td >&nbsp;</td>
					<td align='center'><input type='submit' name='Submit' value='Xóa' ". $show_accept ." /></td>
				</tr>
			</table>
			</form>";
		echo $content;
		
		break;	
		
	default: 
		echo "<b>x</b>: Item chiếm x ô chiều ngang.<br>
				<b>y</b>: Item chiếm y ô chiều dọc.<br>
				<div align='right'><a href='admin.php?mod=editwebshop&act=".$act."&page=add'>+ Thêm Item</a></div><br>";
		display_shop($item_read,$act); 
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
	  
