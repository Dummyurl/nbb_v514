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
 
$file_edit = 'config/config_napthe_vtc.php';
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
	
	$use_card10k = $_POST['use_card10k'];		$content .= "\$use_card10k	= $use_card10k;\n";
	$use_card20k = $_POST['use_card20k'];		$content .= "\$use_card20k	= $use_card20k;\n";
	$use_card30k = $_POST['use_card30k'];		$content .= "\$use_card30k	= $use_card30k;\n";
	$use_card50k = $_POST['use_card50k'];		$content .= "\$use_card50k	= $use_card50k;\n";
	$use_card100k = $_POST['use_card100k'];		$content .= "\$use_card100k	= $use_card100k;\n";
	$use_card200k = $_POST['use_card200k'];		$content .= "\$use_card200k	= $use_card200k;\n";
	$use_card300k = $_POST['use_card300k'];		$content .= "\$use_card300k	= $use_card300k;\n";
	$use_card500k = $_POST['use_card500k'];		$content .= "\$use_card500k	= $use_card500k;\n";
	
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
				<h1>Cấu Hình Nạp thẻ - VTC Online</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="100">Thẻ 10.000 VNĐ : </td>
						<td>Tắt <input name="use_card10k" type="radio" value="0" <?php if($use_card10k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card10k" type="radio" value="1" <?php if($use_card10k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 20.000 VNĐ : </td>
						<td>Tắt <input name="use_card20k" type="radio" value="0" <?php if($use_card20k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card20k" type="radio" value="1" <?php if($use_card20k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 30.000 VNĐ : </td>
						<td>Tắt <input name="use_card30k" type="radio" value="0" <?php if($use_card30k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card30k" type="radio" value="1" <?php if($use_card30k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 50.000 VNĐ : </td>
						<td>Tắt <input name="use_card50k" type="radio" value="0" <?php if($use_card50k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card50k" type="radio" value="1" <?php if($use_card50k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 100.000 VNĐ : </td>
						<td>Tắt <input name="use_card100k" type="radio" value="0" <?php if($use_card100k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card100k" type="radio" value="1" <?php if($use_card100k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 200.000 VNĐ : </td>
						<td>Tắt <input name="use_card200k" type="radio" value="0" <?php if($use_card200k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card200k" type="radio" value="1" <?php if($use_card200k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 300.000 VNĐ : </td>
						<td>Tắt <input name="use_card300k" type="radio" value="0" <?php if($use_card300k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card300k" type="radio" value="1" <?php if($use_card300k==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Thẻ 500.000 VNĐ : </td>
						<td>Tắt <input name="use_card500k" type="radio" value="0" <?php if($use_card500k==0) echo "checked='checked'"; ?>/> 
						Bật <input name="use_card500k" type="radio" value="1" <?php if($use_card500k==1) echo "checked='checked'"; ?>/></td>
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
	  
