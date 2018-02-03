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
 
$file_edit = 'config/config_dongbo.php';
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
	$vpoint_extra = $_POST['vpoint_extra'];    $vpoint_extra = abs(intval($vpoint_extra));
	
    $class_dw_1 = $_POST['class_dw_1'];        $class_dw_1 = abs(intval($class_dw_1));
	$class_dw_2 = $_POST['class_dw_2'];        $class_dw_2 = abs(intval($class_dw_2));
	$class_dw_3 = $_POST['class_dw_3'];        $class_dw_3 = abs(intval($class_dw_3));
	
    $class_dk_1 = $_POST['class_dk_1'];        $class_dk_1 = abs(intval($class_dk_1));
	$class_dk_2 = $_POST['class_dk_2'];        $class_dk_2 = abs(intval($class_dk_2));
	$class_dk_3 = $_POST['class_dk_3'];        $class_dk_3 = abs(intval($class_dk_3));
	
    $class_elf_1 = $_POST['class_elf_1'];      $class_elf_1 = abs(intval($class_elf_1));
	$class_elf_2 = $_POST['class_elf_2'];      $class_elf_2 = abs(intval($class_elf_2));
	$class_elf_3 = $_POST['class_elf_3'];      $class_elf_3 = abs(intval($class_elf_3));
	
    
    $class_mg_1 = $_POST['class_mg_1'];        $class_mg_1 = abs(intval($class_mg_1));
    $class_mg_1 = $_POST['class_mg_1'];        $class_mg_1 = abs(intval($class_mg_1));
	$class_mg_2 = $_POST['class_mg_2'];        $class_mg_2 = abs(intval($class_mg_2));
	$class_dl_1 = $_POST['class_dl_1'];        $class_dl_1 = abs(intval($class_dl_1));
	$class_dl_2 = $_POST['class_dl_2'];        $class_dl_2 = abs(intval($class_dl_2));
	$class_sum_1 = $_POST['class_sum_1'];      $class_sum_1 = abs(intval($class_sum_1));
	$class_sum_2 = $_POST['class_sum_2'];      $class_sum_2 = abs(intval($class_sum_2));
	$class_sum_3 = $_POST['class_sum_3'];      $class_sum_3 = abs(intval($class_sum_3));
    $class_rf_1 = $_POST['class_rf_1'];        $class_rf_1 = abs(intval($class_rf_1));
	$class_rf_2 = $_POST['class_rf_2'];        $class_rf_2 = abs(intval($class_rf_2));
	
	$content = "<?php\n";
	$content .= "\$vpoint_extra	= $vpoint_extra;\n";
	$content .= "\$class_dw_1 = $class_dw_1;\n";
	$content .= "\$class_dw_2 = $class_dw_2;\n";
	$content .= "\$class_dw_3 = $class_dw_3;\n";
	$content .= "\$class_dk_1 = $class_dk_1;\n";
	$content .= "\$class_dk_2 = $class_dk_2;\n";
	$content .= "\$class_dk_3 = $class_dk_3;\n";
	$content .= "\$class_elf_1 = $class_elf_1;\n";
	$content .= "\$class_elf_2 = $class_elf_2;\n";
	$content .= "\$class_elf_3 = $class_elf_3;\n";
	
    if(isset($_POST['mg_use'])) {
        $mg_use = 1;
    } else {
        $mg_use = 2;
    }
    $content .= "\$mg_use = $mg_use;\n";
    $content .= "\$class_mg_1 = $class_mg_1;\n";
	$content .= "\$class_mg_2 = $class_mg_2;\n";
	
    if(isset($_POST['dl_use'])) {
        $dl_use = 1;
    } else {
        $dl_use = 2;
    }
    $content .= "\$dl_use = $dl_use;\n";
    $content .= "\$class_dl_1 = $class_dl_1;\n";
	$content .= "\$class_dl_2 = $class_dl_2;\n";
	
    if(isset($_POST['sum_use'])) {
        $sum_use = 1;
    } else {
        $sum_use = 2;
    }
    $content .= "\$sum_use = $sum_use;\n";
    $content .= "\$class_sum_1 = $class_sum_1;\n";
	$content .= "\$class_sum_2 = $class_sum_2;\n";
	$content .= "\$class_sum_3 = $class_sum_3;\n";
    
    if(isset($_POST['rf_use'])) {
        $rf_use = 1;
    } else {
        $rf_use = 2;
    }
    $content .= "\$rf_use = $rf_use;\n";
    $content .= "\$class_rf_1 = $class_rf_1;\n";
	$content .= "\$class_rf_2 = $class_rf_2;\n";
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
				<h1>Cấu Hình Chung</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="200">Vpoint Extra: </td>
						<td><input type="text" name="vpoint_extra" value="<?php echo $vpoint_extra; ?>" size="3" maxlength="2"/> %<br>
						<b><i>Vpoint sử dụng nhiều hơn Gcoin trong 1 số chức năng</i></b> : <?php echo $vpoint_extra; ?> %</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Mã nhân vật DarkWizard cấp 1: </td>
						<td><input type="text" name="class_dw_1" value="<?php echo $class_dw_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật DarkWizard cấp 2: </td>
						<td><input type="text" name="class_dw_2" value="<?php echo $class_dw_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật DarkWizard cấp 3: </td>
						<td><input type="text" name="class_dw_3" value="<?php echo $class_dw_3; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Mã nhân vật DarkKnight cấp 1: </td>
						<td><input type="text" name="class_dk_1" value="<?php echo $class_dk_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật DarkKnight cấp 2: </td>
						<td><input type="text" name="class_dk_2" value="<?php echo $class_dk_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật DarkKnight cấp 3: </td>
						<td><input type="text" name="class_dk_3" value="<?php echo $class_dk_3; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Mã nhân vật ELF cấp 1: </td>
						<td><input type="text" name="class_elf_1" value="<?php echo $class_elf_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật ELF cấp 2: </td>
						<td><input type="text" name="class_elf_2" value="<?php echo $class_elf_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật ELF cấp 3: </td>
						<td><input type="text" name="class_elf_3" value="<?php echo $class_elf_3; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Sử dụng MG: </td>
						<td><input type="checkbox" name="mg_use" value="1" <?php if(!isset($mg_use) || $mg_use == 1) echo "checked" ?> /></td>
					</tr>
                    <tr>
						<td>Mã nhân vật MG cấp 1: </td>
						<td><input type="text" name="class_mg_1" value="<?php echo $class_mg_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật MG cấp 2: </td>
						<td><input type="text" name="class_mg_2" value="<?php echo $class_mg_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Sử dụng DL: </td>
						<td><input type="checkbox" name="dl_use" value="1" <?php if(!isset($dl_use) || $dl_use == 1) echo "checked" ?> /></td>
					</tr>
                    <tr>
						<td>Mã nhân vật DarkLord cấp 1: </td>
						<td><input type="text" name="class_dl_1" value="<?php echo $class_dl_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật DarkLord cấp 2: </td>
						<td><input type="text" name="class_dl_2" value="<?php echo $class_dl_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td>Sử dụng Summoner: </td>
						<td><input type="checkbox" name="sum_use" value="1" <?php if(!isset($sum_use) || $sum_use == 1) echo "checked" ?> /></td>
					</tr>
                    <tr>
						<td>Mã nhân vật Summoner cấp 1: </td>
						<td><input type="text" name="class_sum_1" value="<?php echo $class_sum_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật Summoner cấp 2: </td>
						<td><input type="text" name="class_sum_2" value="<?php echo $class_sum_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật Summoner cấp 3: </td>
						<td><input type="text" name="class_sum_3" value="<?php echo $class_sum_3; ?>" size="3" maxlength="2"/></td>
					</tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    
                    <tr>
						<td>Sử dụng RF: </td>
						<td><input type="checkbox" name="rf_use" value="1" <?php if(!isset($rf_use) || $rf_use == 1) echo "checked" ?> /></td>
					</tr>
                    <tr>
						<td>Mã nhân vật Rage Fighter cấp 1: </td>
						<td><input type="text" name="class_rf_1" value="<?php echo $class_rf_1; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr>
						<td>Mã nhân vật RageFighter cấp 2: </td>
						<td><input type="text" name="class_rf_2" value="<?php echo $class_rf_2; ?>" size="3" maxlength="2"/></td>
					</tr>
					<tr><td colspan="2"><hr /></td></tr>
					
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
	  
