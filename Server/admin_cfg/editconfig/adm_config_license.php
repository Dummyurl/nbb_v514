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
 
$file_edit = 'config_license.php';
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
	
	$content = "<?php\n";
	
	$acclic = $_POST['acclic'];			$content .= "\$acclic	= '$acclic';\n";
	$key = $_POST['key'];		        $content .= "\$key	= '$key';\n";
    
    $url_license = $_POST['url_license'];		        $content .= "\$url_license	= '$url_license';\n";
    $url_license_duphong = $_POST['url_license_duphong'];		        $content .= "\$url_license_duphong	= '$url_license_duphong';\n";
    $url_license_duphong2 = $_POST['url_license_duphong2'];		        $content .= "\$url_license_duphong2	= '$url_license_duphong2';\n";
    
    $getcontent_method = $_POST['getcontent_method'];		        $content .= "\$getcontent_method	= '$getcontent_method';\n";
    $getcontent_curl = $_POST['getcontent_curl'];	
        if(!isset($getcontent_curl)) $getcontent_curl = 'false';
        $content .= "\$getcontent_curl	= $getcontent_curl;\n";
	
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
	replacecontent($file_edit,$content);
	
	$notice = "<center><font color='red'>Sửa thành công</font></center>";
}

include($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>License NWebMU</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="100">AccLIC: </td>
						<td><input type="text" name="acclic" value="<?php echo $acclic; ?>" size="50"/></td>
					</tr>
					<tr>
						<td width="100">Key: </td>
						<td><input type="text" name="key" value="<?php echo $key; ?>" size="50"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
                    
                    <tr><td colspan="2">Liên kết đến API</td></tr>
                    <tr>
						<td width="100">API chính: </td>
						<td><input type="text" name="url_license" value="<?php echo $url_license; ?>" size="50"/></td>
					</tr>
                    <tr>
						<td width="100">API dự phòng 1: </td>
						<td><input type="text" name="url_license_duphong" value="<?php echo $url_license_duphong; ?>" size="50"/></td>
					</tr>
                    <tr>
						<td width="100">API dự phòng 2: </td>
						<td><input type="text" name="url_license_duphong2" value="<?php echo $url_license_duphong2; ?>" size="50"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr><td colspan="2">Phương thức truyền dữ liệu</td></tr>
                    <tr>
						<td width="100">Phương thức kết nối: </td>
						<td>
                            <select name="getcontent_method">
                                <option value="GET" <?php if($getcontent_method == 'GET') echo "selected='selected'"; ?> >GET</option>
                                <option value="POST" <?php if($getcontent_method == 'POST') echo "selected='selected'"; ?> >POST</option>
                            </select>
                        </td>
					</tr>
                    <tr>
						<td width="100">Sử dụng Curl: </td>
						<td>
                            <input type="checkbox" name="getcontent_curl" value="true" <?php if($getcontent_curl == true) echo "checked"; ?>/>
                            <i>(Phải mở hàm CURL trong php.ini)</i>
                        </td>
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
	  
