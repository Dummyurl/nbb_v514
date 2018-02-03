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
 
$file_edit = 'config/config_songtu.php';
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
	
	$songtu_pointpercent 	= $_POST['songtu_pointpercent'];
        $songtu_pointpercent = abs(intval($songtu_pointpercent));
    		$content .= "\$songtu_pointpercent	= $songtu_pointpercent;\n";
	
    $songtu_expcoban 	= $_POST['songtu_expcoban'];
        $songtu_expcoban = abs(intval($songtu_expcoban));
    		$content .= "\$songtu_expcoban	= $songtu_expcoban;\n";
	
    $songtu_expextra 	= $_POST['songtu_expextra'];
        $songtu_expextra = abs($songtu_expextra);
    		$content .= "\$songtu_expextra	= $songtu_expextra;\n";
	
    $songtu_cpcoban 	= $_POST['songtu_cpcoban'];
        $songtu_cpcoban = abs(intval($songtu_cpcoban));
    		$content .= "\$songtu_cpcoban	= $songtu_cpcoban;\n";
	
    $songtu_cpextra 	= $_POST['songtu_cpextra'];
        $songtu_cpextra = abs($songtu_cpextra);
    		$content .= "\$songtu_cpextra	= $songtu_cpextra;\n";
	
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
				<h1>Cấu Hình Hệ thống Song Tu</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				Mã Item Trái Tim : <strong>0C0800123456780000E0000000000000</strong> (Sử dụng cho WebShop)<br />
                Code Item Trái Tim : Type: <strong>14</strong>, Index: <strong>12</strong>, Lvl: <strong>1</strong> (Sử dụng cho Item Drop)<br />
                <br />
                <form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				Point thưởng tương ứng với 1 cấp Song Tu : <input type="text" name="songtu_pointpercent" value="<?php echo $songtu_pointpercent; ?>" size="3"/> %
                <center><strong>Công thức</strong><br />
                Điểm Song Tu Cấp_x = <input type="text" name="songtu_expcoban" value="<?php echo $songtu_expcoban; ?>" size="3"/> * (1 + <input type="text" name="songtu_expextra" value="<?php echo $songtu_expextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Chúc phúc Cấp_x = <input type="text" name="songtu_cpcoban" value="<?php echo $songtu_cpcoban; ?>" size="3"/> * (1 + <input type="text" name="songtu_cpextra" value="<?php echo $songtu_cpextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Thăng cấp thất bại tốn 1 Trái Tim và nhận 4-5 điểm Chúc Phúc.<br />
                <strong>Kiểm tra</strong> : <br />
                <?php
            	$sumpoint = 0;
            	$exp_songtu_sum = 0;
                $cp_sum = 0;
            
            	for($i=1; $i<=20; $i++) {
            	    $exp_songtu = floor($songtu_expcoban * (1 + $songtu_expextra * ($i-1) ));
            	    $exp_songtu_sum = $exp_songtu_sum + $exp_songtu;
            	    
                    $pointcap = floor($songtu_pointcoban * (1 + $songtu_pointextra * ($i-1) ));
            	    $sumpoint = $sumpoint + $pointcap;
                    
                    $cp_cap = floor($songtu_cpcoban * (1 + $songtu_cpextra * ($i-1) ));
                    $cp_sum = $cp_sum + $cp_cap;
                    
                    $heart_min = ceil($cp_sum/5);
                    $heart_max = ceil($cp_sum/4);
                    
            	    echo "Cấp $i : Điểm Song Tu cần <strong>$exp_songtu</strong> / $exp_songtu_sum Điểm Song Tu Tổng . Cần $cp_sum Chúc Phúc ($heart_min - $heart_max Trái Tim)<br />";
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
	  
