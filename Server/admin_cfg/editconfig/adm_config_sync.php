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

$file_edit = 'config/config_sync.php';
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
	
    $typeupdate = $_POST['typeupdate'];
    $content .= "\$typeupdate	= $typeupdate;\n";
    
    $sv_noip = $_POST['sv_noip'];
    $content .= "\$sv_noip	= '$sv_noip';\n";
    
	$url_hosting 	= $_POST['url_hosting'];
    for($i=0; $i<count($url_hosting); $i++)
    {
        if($url_hosting[$i]) {
            $content .= "\$url_hosting[]	= '$url_hosting[$i]';\n";
        }
    }
	
	$content .= "?>";
	
    include_once('admin_cfg/function.php');
    replacecontent($file_edit,$content);
    
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

$url_hosting = null;
include($file_edit);
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Đồng bộ Hosting</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="fconfig_sync" name="fconfig_sync" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				
                <strong>Chọn Loại Update</strong> : 
                <select name="typeupdate">
                    <option value="1" <?php if($typeupdate == 1) echo "selected"; ?> >Loại 1</option>
                    <option value="2" <?php if($typeupdate == 2) echo "selected"; ?> >Loại 2</option>
                </select>
                
                <hr />
                
                <strong><font color='red'>Update Loại 1</font></strong> : Update trực tiếp từ Server lên Hosting khi chỉnh sửa<br />
                Chọn loại này sẽ làm giảm LAG Server.<br /><br />
                <i>(Không cần Config phần này nếu chọn Loại Update 2)</i>
                <br />
                
                IP hoặc NoIP Server :  <input name="sv_noip" value="<?php echo $sv_noip; ?>" size="20" /> <i>(Dạng : <strong>123.123.123.123</strong> hoặc <strong>mu.myvnc.com</strong>)</i><br />
                Chỉ chỉnh sửa Config từ IP khai báo bên trên mới cập nhập được lên Hosting.<br /><br />
                
                <table width="100%" border="0" bgcolor="#9999FF">
				  <tr bgcolor="#FFFFFF">
				    <th scope="col" align="center">STT</th>
				    <th scope="col" align="center">URL NWebMU Hosting</th>
				  </tr>
                <?php for($i=0; $i<count($url_hosting); $i++) { ?>
				  <tr bgcolor="#FFFFFF">
				    <td align="center">Hosting <?php echo $i+1; ?></td>
				    <td align="center"><input name="url_hosting[]" value="<?php echo $url_hosting[$i]; ?>" size="50" /> <i>(Dạng URL: http://quanly.mu.com)</i></td>
				  </tr>
                <?php } ?>
                  <tr bgcolor="#FFFFFF">
				    <td align="center">Hosting <?php echo $i+1; ?></td>
				    <td align="center"><input name="url_hosting[]" value="" size="50" /> <i>(Dạng URL: http://quanly.mu.com)</i></td>
				  </tr>
				</table>
                
                <hr />
                
                <strong><font color='red'>Update Loại 2</font></strong> : Chỉ Update khi Web Hosting được truy cập.<br />
                Chọn loại này nếu sử dụng Hosting <strong>Firewall</strong> hoặc qua <strong>Cloud Flare</strong>.<br /><br />
                
                <hr />
                
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
	  
