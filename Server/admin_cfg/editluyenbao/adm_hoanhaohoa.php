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
 
$file_edit = 'config/config_hoanhaohoa.php';
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
	
    $hoanhaohoa_cpcoban 	= $_POST['hoanhaohoa_cpcoban'];
        $hoanhaohoa_cpcoban = abs(intval($hoanhaohoa_cpcoban));
    		$content .= "\$hoanhaohoa_cpcoban	= $hoanhaohoa_cpcoban;\n";
	
    $hoanhaohoa_cpextra 	= $_POST['hoanhaohoa_cpextra'];
        $hoanhaohoa_cpextra = abs($hoanhaohoa_cpextra);
    		$content .= "\$hoanhaohoa_cpextra	= $hoanhaohoa_cpextra;\n";
	
    
    
    $vukhi_cp_extra 	= $_POST['vukhi_cp_extra'];
        $vukhi_cp_extra = floatval($vukhi_cp_extra);
        if($vukhi_cp_extra < 1) $vukhi_cp_extra = 1;
    		$content .= "\$vukhi_cp_extra	= $vukhi_cp_extra;\n";
    $vukhi_exl = $_POST['vukhi_exl'];
    foreach($vukhi_exl as $vk_k => $vk_v) {
        $vk_v = abs(intval($vk_v));
    		$content .= "\$vukhi_exl[$vk_k]	= $vk_v;\n";
    }
    
    $giap_cp_extra 	= $_POST['giap_cp_extra'];
        $giap_cp_extra = floatval($giap_cp_extra);
        if($giap_cp_extra < 1) $giap_cp_extra = 1;
    		$content .= "\$giap_cp_extra	= $giap_cp_extra;\n";
    $giap_exl = $_POST['giap_exl'];
    foreach($giap_exl as $g_k => $g_v) {
        $g_v = abs(intval($g_v));
    		$content .= "\$giap_exl[$g_k]	= $g_v;\n";
    }
    
    $wing3_cp_extra 	= $_POST['wing3_cp_extra'];
        $wing3_cp_extra = floatval($wing3_cp_extra);
        if($wing3_cp_extra < 1) $wing3_cp_extra = 1;
    		$content .= "\$wing3_cp_extra	= $wing3_cp_extra;\n";
    $wing3_exl = $_POST['wing3_exl'];
    foreach($wing3_exl as $w3_k => $w3_v) {
        $w3_v = abs(intval($w3_v));
    		$content .= "\$wing3_exl[$w3_k]	= $w3_v;\n";
    }
    
    $wing2_cp_extra 	= $_POST['wing2_cp_extra'];
        $wing2_cp_extra = floatval($wing2_cp_extra);
        if($wing2_cp_extra < 1) $wing2_cp_extra = 1;
    		$content .= "\$wing2_cp_extra	= $wing2_cp_extra;\n";
    $wing2_exl = $_POST['wing2_exl'];
    foreach($wing2_exl as $w2_k => $w2_v) {
        $w2_v = abs(intval($w2_v));
    		$content .= "\$wing2_exl[$w2_k]	= $w2_v;\n";
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
				<h1>Cấu Hình Hệ thống Luyện Bảo - Hoàn Hảo Hóa</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				
                <form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
                <center>
                    <strong>Công thức</strong><br />
                    Chúc phúc Gốc Dòng_Hoàn Hảo_x = <input type="text" name="hoanhaohoa_cpcoban" value="<?php echo $hoanhaohoa_cpcoban; ?>" size="3"/> * (1 + <input type="text" name="hoanhaohoa_cpextra" value="<?php echo $hoanhaohoa_cpextra; ?>" size="3"/> * (Dòng_Hoàn Hảo_x - 1))<br />
                    Thăng cấp thất bại tốn 100 Điểm Hoàn Hảo Hóa + 1 Chao và nhận 4-5 điểm Chúc Phúc.<br />
                </center>
                <strong>Kiểm tra</strong> : <br />
                <?php
            	$sumpoint = 0;
            	$exp_songtu_sum = 0;
                $cp_sum = 0;
            
            	for($i=1; $i<=6; $i++) {
                    
                    $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($i-1) ));
                    $cp_sum = $cp_sum + $cp_cap;
                    
                    $chao_min = ceil($cp_sum/5);
                    $chao_max = ceil($cp_sum/4);
                    
                    $hoanhaohoa_point_min = $chao_min * 100;
                    $hoanhaohoa_point_max = $chao_max * 100;
                    
            	    echo "Từ ". ($i-1) ." lên $i dòng hoàn hảo : Cần $cp_sum Chúc Phúc ($hoanhaohoa_point_min - $hoanhaohoa_point_max Điểm Hoàn Hảo Hóa, $chao_min - $chao_max Chao)<br />";
            	}
                ?>
                
                
                <hr />
                <center>
                    <strong>Mức độ ưu tiên thêm dòng hoàn hảo</strong><br />
                    Mức độ càng cao, càng dễ tạo dòng đó.
                </center><br />
                <strong><font color="red">Vũ khí + Dây Chuyền</font></strong> :<br />
                Chúc Phúc <strong>Vũ khí + Dây Chuyền</strong> = Chúc Phúc Gốc * <input type="text" name="vukhi_cp_extra" value="<?php echo $vukhi_cp_extra; ?>" size="1" maxlength="4" /> (Thiết lập : Nhỏ nhất là 1)<br />
                <?php
                    if($vukhi_cp_extra > 1) {
                        $cp_sum = 0;
                    
                    	for($i=1; $i<=6; $i++) {
                            
                            $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($i-1) ) * $vukhi_cp_extra);
                            $cp_sum = $cp_sum + $cp_cap;
                            
                            $chao_min = ceil($cp_sum/5);
                            $chao_max = ceil($cp_sum/4);
                            
                            $hoanhaohoa_point_min = $chao_min * 100;
                            $hoanhaohoa_point_max = $chao_max * 100;
                            
                    	    echo "Từ ". ($i-1) ." lên $i dòng hoàn hảo : Cần $cp_sum Chúc Phúc ($hoanhaohoa_point_min - $hoanhaohoa_point_max Điểm Hoàn Hảo Hóa, $chao_min - $chao_max Chao)<br />";
                         }
                    }
                ?>
                <table border="0">
                    <tr>
                        <td align="right">Tăng lượng MANA khi giết quái (MANA/8) :</td>
                        <td align="left"><input type="text" name="vukhi_exl[1]" value="<?php echo $vukhi_exl[1]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Tăng lượng LIFE khi giết quái (LIFE/8) :</td>
                        <td align="left"><input type="text" name="vukhi_exl[2]" value="<?php echo $vukhi_exl[2]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Tốc độ tấn công +7 :</td>
                        <td align="left"><input type="text" name="vukhi_exl[3]" value="<?php echo $vukhi_exl[3]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Tăng lực tấn công 2% :</td>
                        <td align="left"><input type="text" name="vukhi_exl[4]" value="<?php echo $vukhi_exl[4]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Tăng lực tấn công (Cấp độ/20) :</td>
                        <td align="left"><input type="text" name="vukhi_exl[5]" value="<?php echo $vukhi_exl[5]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Khả năng xuất hiện lực tấn công hoàn hảo +10% :</td>
                        <td align="left"><input type="text" name="vukhi_exl[6]" value="<?php echo $vukhi_exl[6]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                </table>
                
                <hr />
                <strong><font color="red">Giáp + Khiên + Nhẫn</font></strong> :<br />
                Chúc Phúc <strong>Giáp + Khiên + Nhẫn</strong> = Chúc Phúc Gốc * <input type="text" name="giap_cp_extra" value="<?php echo $giap_cp_extra; ?>" size="1" maxlength="4" /> (Thiết lập : Nhỏ nhất là 1)<br />
                <?php
                    if($giap_cp_extra > 1) {
                        $cp_sum = 0;
                    
                    	for($i=1; $i<=6; $i++) {
                            
                            $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($i-1) ) * $giap_cp_extra);
                            $cp_sum = $cp_sum + $cp_cap;
                            
                            $chao_min = ceil($cp_sum/5);
                            $chao_max = ceil($cp_sum/4);
                            
                            $hoanhaohoa_point_min = $chao_min * 100;
                            $hoanhaohoa_point_max = $chao_max * 100;
                            
                    	    echo "Từ ". ($i-1) ." lên $i dòng hoàn hảo : Cần $cp_sum Chúc Phúc ($hoanhaohoa_point_min - $hoanhaohoa_point_max Điểm Hoàn Hảo Hóa, $chao_min - $chao_max Chao)<br />";
                         }
                    }
                ?>
                <table border="0">
                    <tr>
                        <td align="right">Lượng ZEN rơi ra khi giết quái +40% :</td>
                        <td align="left"><input type="text" name="giap_exl[1]" value="<?php echo $giap_exl[1]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Khả năng xuất hiện phòng thủ hoàn hảo +10% :</td>
                        <td align="left"><input type="text" name="giap_exl[2]" value="<?php echo $giap_exl[2]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Phản hồi sát thương +5% :</td>
                        <td align="left"><input type="text" name="giap_exl[3]" value="<?php echo $giap_exl[3]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Giảm sát thương +4% :</td>
                        <td align="left"><input type="text" name="giap_exl[4]" value="<?php echo $giap_exl[4]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Lượng MANA tối đa +4% :</td>
                        <td align="left"><input type="text" name="giap_exl[5]" value="<?php echo $giap_exl[5]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Lượng HP tối đa +4% :</td>
                        <td align="left"><input type="text" name="giap_exl[6]" value="<?php echo $giap_exl[6]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                </table>
                
                <hr />
                <strong><font color="red">Cánh cấp 2.5 + 3 + 4</font></strong> :<br />
                Chúc Phúc <strong>Cánh cấp 2.5 + 3 + 4</strong> = Chúc Phúc Gốc * <input type="text" name="wing3_cp_extra" value="<?php echo $wing3_cp_extra; ?>" size="1" maxlength="4" /> (Thiết lập : Nhỏ nhất là 1)<br />
                <?php
                    if($wing3_cp_extra > 1) {
                        $cp_sum = 0;
                    
                    	for($i=1; $i<=4; $i++) {
                            
                            $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($i-1) ) * $wing3_cp_extra);
                            $cp_sum = $cp_sum + $cp_cap;
                            
                            $chao_min = ceil($cp_sum/5);
                            $chao_max = ceil($cp_sum/4);
                            
                            $hoanhaohoa_point_min = $chao_min * 100;
                            $hoanhaohoa_point_max = $chao_max * 100;
                            
                    	    echo "Từ ". ($i-1) ." lên $i dòng hoàn hảo : Cần $cp_sum Chúc Phúc ($hoanhaohoa_point_min - $hoanhaohoa_point_max Điểm Hoàn Hảo Hóa, $chao_min - $chao_max Chao)<br />";
                         }
                    }
                ?>
                <table border="0">
                    <tr>
                        <td align="right">Cơ hội loại bỏ sức phòng thủ 3% / 5% / 7% :</td>
                        <td align="left"><input type="text" name="wing3_exl[1]" value="<?php echo $wing3_exl[1]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Phản đòn khi cận chiến 3% / 5% / 7% :</td>
                        <td align="left"><input type="text" name="wing3_exl[2]" value="<?php echo $wing3_exl[2]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Khả năng hồi phục hoàn toàn HP 3% / 5% / 7% :</td>
                        <td align="left"><input type="text" name="wing3_exl[3]" value="<?php echo $wing3_exl[3]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Khả năng hồi phục hoàn toàn nội lực 3% / 5% / 7% :</td>
                        <td align="left"><input type="text" name="wing3_exl[4]" value="<?php echo $wing3_exl[4]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                </table>
                
                <hr />
                <strong><font color="red">Cánh cấp 2</font></strong> :<br />
                Chúc Phúc <strong>Cánh cấp 2</strong> = Chúc Phúc Gốc * <input type="text" name="wing2_cp_extra" value="<?php echo $wing2_cp_extra; ?>" size="1" maxlength="4" /> (Thiết lập : Nhỏ nhất là 1)<br />
                <?php
                    if($wing2_cp_extra > 1) {
                        $cp_sum = 0;
                    
                    	for($i=1; $i<=5; $i++) {
                            
                            $cp_cap = floor($hoanhaohoa_cpcoban * (1 + $hoanhaohoa_cpextra * ($i-1) ) * $wing2_cp_extra);
                            $cp_sum = $cp_sum + $cp_cap;
                            
                            $chao_min = ceil($cp_sum/5);
                            $chao_max = ceil($cp_sum/4);
                            
                            $hoanhaohoa_point_min = $chao_min * 100;
                            $hoanhaohoa_point_max = $chao_max * 100;
                            
                    	    echo "Từ ". ($i-1) ." lên $i dòng hoàn hảo : Cần $cp_sum Chúc Phúc ($hoanhaohoa_point_min - $hoanhaohoa_point_max Điểm Hoàn Hảo Hóa, $chao_min - $chao_max Chao)<br />";
                         }
                    }
                ?>
                <table border="0">
                    <tr>
                        <td align="right">+ 115 Lượng HP tối đa :</td>
                        <td align="left"><input type="text" name="wing2_exl[1]" value="<?php echo $wing2_exl[1]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">+ 115 Lượng MP tối đa :</td>
                        <td align="left"><input type="text" name="wing2_exl[2]" value="<?php echo $wing2_exl[2]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Khả năng loại bỏ phòng thủ đối phương +3% :</td>
                        <td align="left"><input type="text" name="wing2_exl[3]" value="<?php echo $wing2_exl[3]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">+ 50 Lực hành động tối đa :</td>
                        <td align="left"><input type="text" name="wing2_exl[4]" value="<?php echo $wing2_exl[4]; ?>" size="1" maxlength="2" /></td>
                    </tr>
                    <tr>
                        <td align="right">Tốc độ tấn công +7 :</td>
                        <td align="left"><input type="text" name="wing2_exl[5]" value="<?php echo $wing2_exl[5]; ?>" size="1" maxlength="2" /></td>
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
	  
