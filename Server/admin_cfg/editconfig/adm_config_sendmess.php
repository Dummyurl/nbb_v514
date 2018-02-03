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
 
$file_edit = 'config/config_sendmess.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

if($_POST['action'] == 'edit')
{
	$content = "<?php\n";
	
    foreach($_POST as $key => $value) {
	   if($key != 'Submit' && $key != 'action') {
            $value = abs(intval($value));
            $content .= "\$". $key ."	= $value;\n";	       
	   }
	}
	
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
	replacecontent($file_edit,$content);
	
	$notice = "<center><font color='red'>Sửa thành công</font></center>";
}

include($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Thông Báo Trong Game</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr><td colspan="2"><b>Chức năng trên Menu chính</b> :</td></tr>
					<tr>
						<td width="200" align="right">Port JoinServer: </td>
                        
						<td><input type="text" name="joinserver_port" value="<?php echo $joinserver_port; ?>" /></td>
					</tr>
					<tr>
						<td width="200" align="right">Sử dụng trong Reset: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_RS" value="1" <?php if($Use_SendMess_RS == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong Reset VIP: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_RSVIP" value="1" <?php if($Use_SendMess_RSVIP == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong Ủy Thác Reset: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_UyThacRS" value="1" <?php if($Use_SendMess_UyThacRS == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong Ủy Thác Reset VIP: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_UyThacRSVIP" value="1" <?php if($Use_SendMess_UyThacRSVIP == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong ReLife: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_Relife" value="1" <?php if($Use_SendMess_Relife == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong Đổi Giới Tính: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_DGT" value="1" <?php if($Use_SendMess_DGT == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng trong Event Ép Item: </td>
                        
						<td><input type="checkbox" name="Use_SendMess_Event_EpItem" value="1" <?php if($Use_SendMess_Event_EpItem == 1) echo "checked"; ?>/></td>
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
	  
