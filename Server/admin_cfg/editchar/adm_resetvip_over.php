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
 
require_once('config/config_reset.php');
require_once('config/config_resetvip.php');

$file_edit = 'config/config_resetvip_over.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

if(isset($_POST['uythacpoint_cap1_min']) || isset($_POST['uythacpoint_cap1_max']))
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
				<h1>Cấu Hình Reset VIP Over</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
					<table width="100%" border="0" bgcolor="#9999FF">
					  <tr bgcolor="#FFFFFF">
					    <td align="center" rowspan="2"><b>Reset</b></td>
					    <td align="center" colspan="3"><b>Điều kiện Reset</b></td>
					    <td align="center"><b>Phần thưởng</b></td>
					  </tr>
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>Level</b></td>
					    <td align="center"><b>Gcoin</b></td>
					    <td align="center"><b>Vpoint</b></td>
                        <td align="center"><b>Điểm Ủy Thác</b></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
					    <td align="center"><?php echo $level_cap_1_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_1_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_1_vip = $gcoin_cap_1_vip*(1+$vpoint_extra/100); echo $vpoint_cap_1_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap1_min" size="3" value="<?php echo $uythacpoint_cap1_min; ?>" /> - <input type="text" name="uythacpoint_cap1_max" size="3" value="<?php echo $uythacpoint_cap1_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
					    <td align="center"><?php echo $level_cap_2_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_2_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_2_vip = $gcoin_cap_2_vip*(1+$vpoint_extra/100); echo $vpoint_cap_2_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap2_min" size="3" value="<?php echo $uythacpoint_cap2_min; ?>" /> - <input type="text" name="uythacpoint_cap2_max" size="3" value="<?php echo $uythacpoint_cap2_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
					    <td align="center"><?php echo $level_cap_3_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_3_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_3_vip = $gcoin_cap_3_vip*(1+$vpoint_extra/100); echo $vpoint_cap_3_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap3_min" size="3" value="<?php echo $uythacpoint_cap3_min; ?>" /> - <input type="text" name="uythacpoint_cap3_max" size="3" value="<?php echo $uythacpoint_cap3_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
					    <td align="center"><?php echo $level_cap_4_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_4_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_4_vip = $gcoin_cap_4_vip*(1+$vpoint_extra/100); echo $vpoint_cap_4_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap4_min" size="3" value="<?php echo $uythacpoint_cap4_min; ?>" /> - <input type="text" name="uythacpoint_cap4_max" size="3" value="<?php echo $uythacpoint_cap4_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
					    <td align="center"><?php echo $level_cap_5_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_5_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_5_vip = $gcoin_cap_5_vip*(1+$vpoint_extra/100); echo $vpoint_cap_5_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap5_min" size="3" value="<?php echo $uythacpoint_cap5_min; ?>" /> - <input type="text" name="uythacpoint_cap5_max" size="3" value="<?php echo $uythacpoint_cap5_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
					    <td align="center"><?php echo $level_cap_6_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_6_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_6_vip = $gcoin_cap_6_vip*(1+$vpoint_extra/100); echo $vpoint_cap_6_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap6_min" size="3" value="<?php echo $uythacpoint_cap6_min; ?>" /> - <input type="text" name="uythacpoint_cap6_max" size="3" value="<?php echo $uythacpoint_cap6_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
					    <td align="center"><?php echo $level_cap_7_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_7_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_7_vip = $gcoin_cap_7_vip*(1+$vpoint_extra/100); echo $vpoint_cap_7_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap7_min" size="3" value="<?php echo $uythacpoint_cap7_min; ?>" /> - <input type="text" name="uythacpoint_cap7_max" size="3" value="<?php echo $uythacpoint_cap7_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
					    <td align="center"><?php echo $level_cap_8_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_8_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_8_vip = $gcoin_cap_8_vip*(1+$vpoint_extra/100); echo $vpoint_cap_8_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap8_min" size="3" value="<?php echo $uythacpoint_cap8_min; ?>" /> - <input type="text" name="uythacpoint_cap8_max" size="3" value="<?php echo $uythacpoint_cap8_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
					    <td align="center"><?php echo $level_cap_9_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_9_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_9_vip = $gcoin_cap_9_vip*(1+$vpoint_extra/100); echo $vpoint_cap_9_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap9_min" size="3" value="<?php echo $uythacpoint_cap9_min; ?>" /> - <input type="text" name="uythacpoint_cap9_max" size="3" value="<?php echo $uythacpoint_cap9_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
					    <td align="center"><?php echo $level_cap_10_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_10_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_10_vip = $gcoin_cap_10_vip*(1+$vpoint_extra/100); echo $vpoint_cap_10_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap10_min" size="3" value="<?php echo $uythacpoint_cap10_min; ?>" /> - <input type="text" name="uythacpoint_cap10_max" size="3" value="<?php echo $uythacpoint_cap10_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
					    <td align="center"><?php echo $level_cap_11_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_11_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_11_vip = $gcoin_cap_11_vip*(1+$vpoint_extra/100); echo $vpoint_cap_11_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap11_min" size="3" value="<?php echo $uythacpoint_cap11_min; ?>" /> - <input type="text" name="uythacpoint_cap11_max" size="3" value="<?php echo $uythacpoint_cap11_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
					    <td align="center"><?php echo $level_cap_12_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_12_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_12_vip = $gcoin_cap_12_vip*(1+$vpoint_extra/100); echo $vpoint_cap_12_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap12_min" size="3" value="<?php echo $uythacpoint_cap12_min; ?>" /> - <input type="text" name="uythacpoint_cap12_max" size="3" value="<?php echo $uythacpoint_cap12_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
					    <td align="center"><?php echo $level_cap_13_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_13_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_13_vip = $gcoin_cap_13_vip*(1+$vpoint_extra/100); echo $vpoint_cap_13_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap13_min" size="3" value="<?php echo $uythacpoint_cap13_min; ?>" /> - <input type="text" name="uythacpoint_cap13_max" size="3" value="<?php echo $uythacpoint_cap13_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
					    <td align="center"><?php echo $level_cap_14_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_14_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_14_vip = $gcoin_cap_14_vip*(1+$vpoint_extra/100); echo $vpoint_cap_14_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap14_min" size="3" value="<?php echo $uythacpoint_cap14_min; ?>" /> - <input type="text" name="uythacpoint_cap14_max" size="3" value="<?php echo $uythacpoint_cap14_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
					    <td align="center"><?php echo $level_cap_15_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_15_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_15_vip = $gcoin_cap_15_vip*(1+$vpoint_extra/100); echo $vpoint_cap_15_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap15_min" size="3" value="<?php echo $uythacpoint_cap15_min; ?>" /> - <input type="text" name="uythacpoint_cap15_max" size="3" value="<?php echo $uythacpoint_cap15_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
					    <td align="center"><?php echo $level_cap_16_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_16_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_16_vip = $gcoin_cap_16_vip*(1+$vpoint_extra/100); echo $vpoint_cap_16_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap16_min" size="3" value="<?php echo $uythacpoint_cap16_min; ?>" /> - <input type="text" name="uythacpoint_cap16_max" size="3" value="<?php echo $uythacpoint_cap16_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
					    <td align="center"><?php echo $level_cap_17_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_17_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_17_vip = $gcoin_cap_17_vip*(1+$vpoint_extra/100); echo $vpoint_cap_17_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap17_min" size="3" value="<?php echo $uythacpoint_cap17_min; ?>" /> - <input type="text" name="uythacpoint_cap17_max" size="3" value="<?php echo $uythacpoint_cap17_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
					    <td align="center"><?php echo $level_cap_18_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_18_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_18_vip = $gcoin_cap_18_vip*(1+$vpoint_extra/100); echo $vpoint_cap_18_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap18_min" size="3" value="<?php echo $uythacpoint_cap18_min; ?>" /> - <input type="text" name="uythacpoint_cap18_max" size="3" value="<?php echo $uythacpoint_cap18_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
					    <td align="center"><?php echo $level_cap_19_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_19_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_19_vip = $gcoin_cap_19_vip*(1+$vpoint_extra/100); echo $vpoint_cap_19_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap19_min" size="3" value="<?php echo $uythacpoint_cap19_min; ?>" /> - <input type="text" name="uythacpoint_cap19_max" size="3" value="<?php echo $uythacpoint_cap19_max; ?>" /></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
					    <td align="center"><?php echo $level_cap_20_vip; ?></td>
					    <td align="center"><?php echo $gcoin_cap_20_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_20_vip = $gcoin_cap_20_vip*(1+$vpoint_extra/100); echo $vpoint_cap_20_vip; ?></td>
                        <td align="center"><input type="text" name="uythacpoint_cap20_min" size="3" value="<?php echo $uythacpoint_cap20_min; ?>" /> - <input type="text" name="uythacpoint_cap20_max" size="3" value="<?php echo $uythacpoint_cap20_max; ?>" /></td>
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
	  
