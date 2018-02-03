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
 
$file_edit = 'config/config_tuluyen.php';
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
	
	$tuluyen_expcoban 	= $_POST['tuluyen_expcoban'];
        $tuluyen_expcoban = abs(intval($tuluyen_expcoban));
    		$content .= "\$tuluyen_expcoban	= $tuluyen_expcoban;\n";
	
    $tuluyen_expextra 	= $_POST['tuluyen_expextra'];
        $tuluyen_expextra = abs($tuluyen_expextra);
    		$content .= "\$tuluyen_expextra	= $tuluyen_expextra;\n";
	
    $tuluyen_pointcoban 	= $_POST['tuluyen_pointcoban'];
        $tuluyen_pointcoban = abs(intval($tuluyen_pointcoban));
    		$content .= "\$tuluyen_pointcoban	= $tuluyen_pointcoban;\n";
	
    $tuluyen_pointextra 	= $_POST['tuluyen_pointextra'];
        $tuluyen_pointextra = abs($tuluyen_pointextra);
    		$content .= "\$tuluyen_pointextra	= $tuluyen_pointextra;\n";
	
	$tuluyen_cpcoban 	= $_POST['tuluyen_cpcoban'];
        $tuluyen_cpcoban = abs(intval($tuluyen_cpcoban));
    		$content .= "\$tuluyen_cpcoban	= $tuluyen_cpcoban;\n";
	
    $tuluyen_cpextra 	= $_POST['tuluyen_cpextra'];
        $tuluyen_cpextra = abs($tuluyen_cpextra);
    		$content .= "\$tuluyen_cpextra	= $tuluyen_cpextra;\n";
	
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
				<h1>Cấu Hình Hệ thống Tu Luyện</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<center><strong>Công thức</strong><br />
                Điểm Tu Luyện Cấp_x = <input type="text" name="tuluyen_expcoban" value="<?php echo $tuluyen_expcoban; ?>" size="3"/> * (1 + <input type="text" name="tuluyen_expextra" value="<?php echo $tuluyen_expextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Point Cấp_x = <input type="text" name="tuluyen_pointcoban" value="<?php echo $tuluyen_pointcoban; ?>" size="3"/> * (1 + <input type="text" name="tuluyen_pointextra" value="<?php echo $tuluyen_pointextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Chúc phúc Cấp_x = <input type="text" name="tuluyen_cpcoban" value="<?php echo $tuluyen_cpcoban; ?>" size="3"/> * (1 + <input type="text" name="tuluyen_cpextra" value="<?php echo $tuluyen_cpextra; ?>" size="3"/> * (Cấp_x - 1))<br />
                Thăng cấp thất bại tốn 1 Chao và nhận 4-5 điểm Chúc Phúc.<br />
                <strong>Kiểm tra</strong> : <br />
                <?php
            	$sumpoint = 0;
            	$exp_tuluyen_sum = 0;
                $cp_sum = 0;
            
            	for($i=1; $i<=20; $i++) {
            	    $exp_tuluyen = floor($tuluyen_expcoban * (1 + $tuluyen_expextra * ($i-1) ));
            	    $exp_tuluyen_sum = $exp_tuluyen_sum + $exp_tuluyen;
            	    
                    $pointcap = floor($tuluyen_pointcoban * (1 + $tuluyen_pointextra * ($i-1) ));
            	    $sumpoint = $sumpoint + $pointcap;
                    
                    $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
                    $cp_sum = $cp_sum + $cp_cap;
                    
                    $chao_min = ceil($cp_sum/5);
                    $chao_max = ceil($cp_sum/4);
                    
            	    echo "Cấp $i : Điểm TL cần <strong>$exp_tuluyen</strong> / $exp_tuluyen_sum Điểm TL Tổng - Point nhận : <strong>$pointcap</strong> / $sumpoint Point Tổng. Cần $cp_sum Chúc Phúc ($chao_min - $chao_max Chao)<br />";
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
	  
