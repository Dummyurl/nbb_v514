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
 
$file_edit = 'config/config_doigioitinh.php';
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
	
	$doigt_gcoin 	= $_POST['doigt_gcoin'];
        $doigt_gcoin = abs(intval($doigt_gcoin));
    		$content .= "\$doigt_gcoin	= $doigt_gcoin;\n";
	$doigt_trureset 	= $_POST['doigt_trureset'];
        $doigt_trureset = abs(intval($doigt_trureset));
    		$content .= "\$doigt_trureset	= $doigt_trureset;\n";
	$doigt_resetmin 	= $_POST['doigt_resetmin'];	
        $doigt_resetmin = abs(intval($doigt_resetmin));
        	$content .= "\$doigt_resetmin	= $doigt_resetmin;\n";
	$keep_bxh 	= $_POST['keep_bxh'];	
        $keep_bxh = abs(intval($keep_bxh));
        	$content .= "\$keep_bxh	= $keep_bxh;\n";
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
				<h1>Cấu Hình Đổi Giới Tính</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="200">Chi phí: </td>
						<td><input type="text" name="doigt_gcoin" value="<?php echo $doigt_gcoin; ?>" size="5"/> Gcoin</td>
					</tr>
					<tr>
						<td>Trừ Reset: </td>
						<td><input type="text" name="doigt_trureset" value="<?php echo $doigt_trureset; ?>" size="5"/> %</td>
					</tr>
					<tr>
						<td>Điều kiện được phép Đổi Giới Tính: </td>
						<td>Reset >= <input type="text" name="doigt_resetmin" value="<?php echo $doigt_resetmin; ?>" size="5"/></td>
					</tr>
                    <tr>
						<td>Không xóa xếp hạng: </td>
						<td><input type="checkbox" name="keep_bxh" value="1" <?php if($keep_bxh == 1) echo "checked"; ?>/> (<i>Không xóa dữ liệu trong bảng xếp hạng của nhân vật Đổi Giới Tính</i>)</td>
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
	  
