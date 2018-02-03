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
 
$file_edit = 'config/config_cuonghoa.php';
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
	
    $cuonghoa_cpcoban 	= $_POST['cuonghoa_cpcoban'];
        $cuonghoa_cpcoban = abs(intval($cuonghoa_cpcoban));
    		$content .= "\$cuonghoa_cpcoban	= $cuonghoa_cpcoban;\n";
	
    $cuonghoa_cpextra 	= $_POST['cuonghoa_cpextra'];
        $cuonghoa_cpextra = abs($cuonghoa_cpextra);
    		$content .= "\$cuonghoa_cpextra	= $cuonghoa_cpextra;\n";
	
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
				<h1>Cấu Hình Hệ thống Luyện Bảo - Cường Hóa</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				
                <form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
                <center><strong>Công thức</strong><br />
                Chúc phúc Cấp_x = <input type="text" name="cuonghoa_cpcoban" value="<?php echo $cuonghoa_cpcoban; ?>" size="3"/> * (1 + <input type="text" name="cuonghoa_cpextra" value="<?php echo $cuonghoa_cpextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Thăng cấp thất bại tốn 100 Điểm Cường Hóa + 1 Chao và nhận 4-5 điểm Chúc Phúc.<br />
                <strong>Kiểm tra</strong> : <br />
                <?php
            	$sumpoint = 0;
            	$exp_songtu_sum = 0;
                $cp_sum = 0;
            
            	for($i=1; $i<=15; $i++) {
                    
                    $cp_cap = floor($cuonghoa_cpcoban * (1 + $cuonghoa_cpextra * ($i-1) ));
                    $cp_sum = $cp_sum + $cp_cap;
                    
                    $chao_min = ceil($cp_sum/5);
                    $chao_max = ceil($cp_sum/4);
                    
                    $cuonghoa_point_min = $chao_min * 100;
                    $cuonghoa_point_max = $chao_max * 100;
                    
            	    echo "Cấp $i : Cần $cp_sum Chúc Phúc ($cuonghoa_point_min - $cuonghoa_point_max Điểm Cường Hóa, $chao_min - $chao_max Chao)<br />";
            	}
                ?>
                <br />
				<input type="submit" name="Submit" value="Sửa" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> /></center>
				</form>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Thông tin</strong>
			<div class="box">Cấu hình :<br>
			- Tên WebSite<br>
			- Địa chỉ kết nối đến Server</div>
	  </div>
	  
