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
 
$file_edit = 'config/config.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

$action = $_POST[action];

if($action == 'edit')
{
	$opensite = $_POST['opensite'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$server_url = $_POST['server_url'];
	$passtransfer = $_POST['passtransfer'];
    $getcontent_method = $_POST['getcontent_method'];
    $getcontent_curl = $_POST['getcontent_curl'];
	
	$content = "<?php\n";
	$content .= "include('config/config_dongbo.php');\n";
	$content .= "include('config/config_chucnang.php');\n";
	$content .= "\$opensite	= $opensite;\n";
	$content .= "\$title	= '$title';\n";
	$content .= "\$description	= '$description';\n";
	$content .= "\$keywords	= '$keywords';\n";
	$content .= "\$server_url = '$server_url';\n";
	$content .= "\$passtransfer = '$passtransfer';\n";
    $content .= "\$getcontent_method = '$getcontent_method';\n";
    $content .= "\$getcontent_curl = $getcontent_curl;\n";
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
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

include($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình WebSite</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="100">Mở WebSite: </td>
						<td>Đóng <input name="opensite" type="radio" value="0" <?php if($opensite==0) echo "checked='checked'"; ?>/>
						Mở <input name="opensite" type="radio" value="1" <?php if($opensite==1) echo "checked='checked'"; ?>/>
						<br>
						<b><i>Mô tả</i></b> : WebSite bảo trì để nâng cấp</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					<tr>
						<td width="100">Tên WebSite: </td>
						<td><input type="text" name="title" value="<?php echo $title; ?>" size="50"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $title; ?></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					<tr>
						<td>Mô tả: </td>
						<td><input type="text" name="description" value="<?php echo $description; ?>" size="50"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $description; ?></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					<tr>
						<td>Từ khóa: </td>
						<td><input type="text" name="keywords" value="<?php echo $keywords; ?>" size="70"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $keywords; ?></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					<tr>
						<td>Địa chỉ phần WebServer: </td>
						<td><input type="text" name="server_url" value="<?php echo $server_url; ?>" size="70"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $server_url; ?><br>
						<a href='checkconnect.php' target='_blank'><font color='blue'>Kiểm tra kết nối đến Server</font></a></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					<tr>
						<td>Mã kiểm tra: </td>
						<td><input type="text" name="passtransfer" value="<?php echo $passtransfer; ?>" size="70"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $passtransfer; ?></td>
					</tr>
                    
                    <tr><td colspan="2"><hr></td></tr>
					<tr>
						<td>Phương Thức Truyền Dữ liệu: </td>
						<td><input type="text" name="getcontent_method" value="<?php echo $getcontent_method; ?>" size="70"/><br>
						<b><i>Đang sử dụng</i></b> : <?php echo $getcontent_method; ?> (<strong>POST</strong> hoặc <strong>GET</strong>)</td>
					</tr>
                    <tr>
						<td>Sử dụng Curl: </td>
						<td>Sử dụng <input name="getcontent_curl" type="radio" value="true" <?php if($getcontent_curl == true) echo "checked='checked'"; ?>/>
                        Không Sử dụng <input name="getcontent_curl" type="radio" value="false" <?php if($getcontent_curl == false) echo "checked='checked'"; ?>/>
						<br />
						<b><i>Mô tả</i></b> : Server phải cho phép sử dụng Curl</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td align="center"><input type="submit" name="Submit" value="Sửa" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></td>
					</tr>
                    
				</table>
				</form>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br>
			- Tên WebSite<br>
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
