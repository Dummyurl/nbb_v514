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
 
$file_edit = 'config/config_thehe.php';
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
    $thehe_choise = null;
    
	$content = "<?php\n";
	
	$thehe_choise 	= $_POST['thehe_choise'];
    $thehe_last = 0;
    
    foreach($thehe_choise as $key => $val) {
        if(strlen($val) > 0) $thehe_last = $key;
    }
    
    for($i=0; $i<=$thehe_last; $i++)
    {
        $content .= "\$thehe_choise[]	= '$thehe_choise[$i]';\n";
        
    }
	
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
$thehe_choise = null;
include($file_edit);
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Thế hệ</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editthehe" name="editthehe" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
                <input type="hidden" name="thehe_choise[]" value="" />
				<table width="100%" border="0" bgcolor="#9999FF">
				  <tr bgcolor="#FFFFFF">
				    <th scope="col" align="center">Thế Hệ</th>
				    <th scope="col" align="center">Tên Thế Hệ</th>
				  </tr>
                <?php for($i=1; $i<count($thehe_choise); $i++) { ?>
				  <tr bgcolor="#FFFFFF">
				    <td align="center">Thế hệ <?php echo $i; ?></td>
				    <td align="center"><input name="thehe_choise[]" value="<?php echo $thehe_choise[$i]; ?>" /></td>
				  </tr>
                <?php } ?>
                  <tr bgcolor="#FFFFFF">
				    <td align="center">Thế hệ <?php echo $i; ?></td>
				    <td align="center"><input name="thehe_choise[]" value="" /></td>
				  </tr>
				</table>
				<center><input type="submit" name="Submit" value="Sửa" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></center>
				</form>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br />
			- Tên WebSite<br />
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
