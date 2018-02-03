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
 
$file_edit = 'config/config_hotrotanthu.php';
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
	
    foreach($_POST as $key => $value) {
	   if($key != 'Submit' && $key != 'action') {
            $value = abs(intval($value));
            $content .= "\$". $key ."	= $value;\n";	       
	   }
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

include($file_edit);
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Hỗ trợ Tân thủ</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
            <font color='blue'><strong>Chức năng cần LIC</strong></font><br /><br />
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
					- Sử dụng Hỗ trợ tân thủ : 
						Không <input name="hotrotanthu" type="radio" value="0" <?php if($hotrotanthu==0) echo "checked='checked'"; ?>/>
						Có <input name="hotrotanthu" type="radio" value="1" <?php if($hotrotanthu==1) echo "checked='checked'"; ?>/>
					<br><br>
					<table width="100%" border="0" bgcolor="#9999FF">
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP</b></td>
					    <td align="center"><b>LV Giảm</b></td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 2</b></td>
					    <td align="center"><input type="text" name="top2_rsredure" value="<?php echo $top2_rsredure; ?>" size="1"/></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 3</b></td>
					    <td align="center"><input type="text" name="top3_rsredure" value="<?php echo $top3_rsredure; ?>" size="1"/></td>
					  </tr>
                      
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 4</b></td>
					    <td align="center"><input type="text" name="top4_rsredure" value="<?php echo $top4_rsredure; ?>" size="1"/></td>
					  </tr>
                      
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 5-10</b></td>
					    <td align="center"><input type="text" name="top10_rsredure" value="<?php echo $top10_rsredure; ?>" size="1"/></td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 11-20</b></td>
					    <td align="center"><input type="text" name="top20_rsredure" value="<?php echo $top20_rsredure; ?>" size="1"/></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 21-30</b></td>
					    <td align="center"><input type="text" name="top30_rsredure" value="<?php echo $top30_rsredure; ?>" size="1"/></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 31-40</b></td>
					    <td align="center"><input type="text" name="top40_rsredure" value="<?php echo $top40_rsredure; ?>" size="1"/></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>TOP 41-50</b></td>
					    <td align="center"><input type="text" name="top50_rsredure" value="<?php echo $top50_rsredure; ?>" size="1"/></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					  	  <td align="center"><b>Không nằm trong TOp 50</b></td>
					    <td align="center"><input type="text" name="top50_over_rsredure" value="<?php echo $top50_over_rsredure; ?>" size="1"/></td>
					  </tr>
					  
					</table>
				<center><input type="submit" name="Submit" value="Sửa" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></center>
				</form>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br>
			- Tên WebSite<br>
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
