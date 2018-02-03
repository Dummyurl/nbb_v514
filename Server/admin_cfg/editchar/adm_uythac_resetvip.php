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

$file_edit = 'config/config_uythac_resetvip.php';
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
	
	$point_uythac_rsvip_cap_1 = $_POST['point_uythac_rsvip_cap_1'];
        $point_uythac_rsvip_cap_1 = abs(intval($point_uythac_rsvip_cap_1));
    		$content .= "\$point_uythac_rsvip_cap_1	= '$point_uythac_rsvip_cap_1';\n";
	$point_uythac_rsvip_cap_2 = $_POST['point_uythac_rsvip_cap_2'];
        $point_uythac_rsvip_cap_2 = abs(intval($point_uythac_rsvip_cap_2));
    		$content .= "\$point_uythac_rsvip_cap_2	= '$point_uythac_rsvip_cap_2';\n";
	$point_uythac_rsvip_cap_3 = $_POST['point_uythac_rsvip_cap_3'];
        $point_uythac_rsvip_cap_3 = abs(intval($point_uythac_rsvip_cap_3));
    		$content .= "\$point_uythac_rsvip_cap_3	= '$point_uythac_rsvip_cap_3';\n";
	$point_uythac_rsvip_cap_4 = $_POST['point_uythac_rsvip_cap_4'];
        $point_uythac_rsvip_cap_4 = abs(intval($point_uythac_rsvip_cap_4));
    		$content .= "\$point_uythac_rsvip_cap_4	= '$point_uythac_rsvip_cap_4';\n";
	$point_uythac_rsvip_cap_5 = $_POST['point_uythac_rsvip_cap_5'];
        $point_uythac_rsvip_cap_5 = abs(intval($point_uythac_rsvip_cap_5));
    		$content .= "\$point_uythac_rsvip_cap_5	= '$point_uythac_rsvip_cap_5';\n";
	$point_uythac_rsvip_cap_6 = $_POST['point_uythac_rsvip_cap_6'];
        $point_uythac_rsvip_cap_6 = abs(intval($point_uythac_rsvip_cap_6));
    		$content .= "\$point_uythac_rsvip_cap_6	= '$point_uythac_rsvip_cap_6';\n";
	$point_uythac_rsvip_cap_7 = $_POST['point_uythac_rsvip_cap_7'];
        $point_uythac_rsvip_cap_7 = abs(intval($point_uythac_rsvip_cap_7));
    		$content .= "\$point_uythac_rsvip_cap_7	= '$point_uythac_rsvip_cap_7';\n";
	$point_uythac_rsvip_cap_8 = $_POST['point_uythac_rsvip_cap_8'];
        $point_uythac_rsvip_cap_8 = abs(intval($point_uythac_rsvip_cap_8));
    		$content .= "\$point_uythac_rsvip_cap_8	= '$point_uythac_rsvip_cap_8';\n";
	$point_uythac_rsvip_cap_9 = $_POST['point_uythac_rsvip_cap_9'];
        $point_uythac_rsvip_cap_9 = abs(intval($point_uythac_rsvip_cap_9));
    		$content .= "\$point_uythac_rsvip_cap_9	= '$point_uythac_rsvip_cap_9';\n";
	$point_uythac_rsvip_cap_10 = $_POST['point_uythac_rsvip_cap_10'];
        $point_uythac_rsvip_cap_10 = abs(intval($point_uythac_rsvip_cap_10));
    		$content .= "\$point_uythac_rsvip_cap_10	= '$point_uythac_rsvip_cap_10';\n";
	$point_uythac_rsvip_cap_11 = $_POST['point_uythac_rsvip_cap_11'];
        $point_uythac_rsvip_cap_11 = abs(intval($point_uythac_rsvip_cap_11));
    		$content .= "\$point_uythac_rsvip_cap_11	= '$point_uythac_rsvip_cap_11';\n";
	$point_uythac_rsvip_cap_12 = $_POST['point_uythac_rsvip_cap_12'];
        $point_uythac_rsvip_cap_12 = abs(intval($point_uythac_rsvip_cap_12));
    		$content .= "\$point_uythac_rsvip_cap_12	= '$point_uythac_rsvip_cap_12';\n";
	$point_uythac_rsvip_cap_13 = $_POST['point_uythac_rsvip_cap_13'];
        $point_uythac_rsvip_cap_13 = abs(intval($point_uythac_rsvip_cap_13));
    		$content .= "\$point_uythac_rsvip_cap_13	= '$point_uythac_rsvip_cap_13';\n";
	$point_uythac_rsvip_cap_14 = $_POST['point_uythac_rsvip_cap_14'];
        $point_uythac_rsvip_cap_14 = abs(intval($point_uythac_rsvip_cap_14));
    		$content .= "\$point_uythac_rsvip_cap_14	= '$point_uythac_rsvip_cap_14';\n";
	$point_uythac_rsvip_cap_15 = $_POST['point_uythac_rsvip_cap_15'];
        $point_uythac_rsvip_cap_15 = abs(intval($point_uythac_rsvip_cap_15));
    		$content .= "\$point_uythac_rsvip_cap_15	= '$point_uythac_rsvip_cap_15';\n";
	$point_uythac_rsvip_cap_16 = $_POST['point_uythac_rsvip_cap_16'];
        $point_uythac_rsvip_cap_16 = abs(intval($point_uythac_rsvip_cap_16));
    		$content .= "\$point_uythac_rsvip_cap_16	= '$point_uythac_rsvip_cap_16';\n";
	$point_uythac_rsvip_cap_17 = $_POST['point_uythac_rsvip_cap_17'];
        $point_uythac_rsvip_cap_17 = abs(intval($point_uythac_rsvip_cap_17));
    		$content .= "\$point_uythac_rsvip_cap_17	= '$point_uythac_rsvip_cap_17';\n";
	$point_uythac_rsvip_cap_18 = $_POST['point_uythac_rsvip_cap_18'];
        $point_uythac_rsvip_cap_18 = abs(intval($point_uythac_rsvip_cap_18));
    		$content .= "\$point_uythac_rsvip_cap_18	= '$point_uythac_rsvip_cap_18';\n";
	$point_uythac_rsvip_cap_19 = $_POST['point_uythac_rsvip_cap_19'];
        $point_uythac_rsvip_cap_19 = abs(intval($point_uythac_rsvip_cap_19));
    		$content .= "\$point_uythac_rsvip_cap_19	= '$point_uythac_rsvip_cap_19';\n";
	$point_uythac_rsvip_cap_20 = $_POST['point_uythac_rsvip_cap_20'];
        $point_uythac_rsvip_cap_20 = abs(intval($point_uythac_rsvip_cap_20));
    		$content .= "\$point_uythac_rsvip_cap_20	= '$point_uythac_rsvip_cap_20';\n";

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
				<h1>Cấu Hình Ủy Thác Online - ResetVIP</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
					<table width="100%" border="0" bgcolor="#9999FF">
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>Reset</b></td>
					    <td align="center"><b>Điểm Ủy Thác</b></td>
					    <td align="center"><b>Gcoin</b></td>
					    <td align="center"><b>Vpoint</b></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_1" value="<?php echo $point_uythac_rsvip_cap_1; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_1_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_1_vip = $gcoin_cap_1_vip*(1+$vpoint_extra/100); echo $vpoint_cap_1_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_2" value="<?php echo $point_uythac_rsvip_cap_2; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_2_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_2_vip = $gcoin_cap_2_vip*(1+$vpoint_extra/100); echo $vpoint_cap_2_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_3" value="<?php echo $point_uythac_rsvip_cap_3; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_3_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_3_vip = $gcoin_cap_3_vip*(1+$vpoint_extra/100); echo $vpoint_cap_3_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_4" value="<?php echo $point_uythac_rsvip_cap_4; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_4_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_4_vip = $gcoin_cap_4_vip*(1+$vpoint_extra/100); echo $vpoint_cap_4_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_5" value="<?php echo $point_uythac_rsvip_cap_5; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_5_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_5_vip = $gcoin_cap_5_vip*(1+$vpoint_extra/100); echo $vpoint_cap_5_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_6" value="<?php echo $point_uythac_rsvip_cap_6; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_6_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_6_vip = $gcoin_cap_6_vip*(1+$vpoint_extra/100); echo $vpoint_cap_6_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_7" value="<?php echo $point_uythac_rsvip_cap_7; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_7_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_7_vip = $gcoin_cap_7_vip*(1+$vpoint_extra/100); echo $vpoint_cap_7_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_8" value="<?php echo $point_uythac_rsvip_cap_8; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_8_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_8_vip = $gcoin_cap_8_vip*(1+$vpoint_extra/100); echo $vpoint_cap_8_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_9" value="<?php echo $point_uythac_rsvip_cap_9; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_9_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_9_vip = $gcoin_cap_9_vip*(1+$vpoint_extra/100); echo $vpoint_cap_9_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_10" value="<?php echo $point_uythac_rsvip_cap_10; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_10_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_10_vip = $gcoin_cap_10_vip*(1+$vpoint_extra/100); echo $vpoint_cap_10_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_11" value="<?php echo $point_uythac_rsvip_cap_11; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_11_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_11_vip = $gcoin_cap_11_vip*(1+$vpoint_extra/100); echo $vpoint_cap_11_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_12" value="<?php echo $point_uythac_rsvip_cap_12; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_12_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_12_vip = $gcoin_cap_12_vip*(1+$vpoint_extra/100); echo $vpoint_cap_12_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_13" value="<?php echo $point_uythac_rsvip_cap_13; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_13_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_13_vip = $gcoin_cap_13_vip*(1+$vpoint_extra/100); echo $vpoint_cap_13_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_14" value="<?php echo $point_uythac_rsvip_cap_14; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_14_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_14_vip = $gcoin_cap_14_vip*(1+$vpoint_extra/100); echo $vpoint_cap_14_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_15" value="<?php echo $point_uythac_rsvip_cap_15; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_15_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_15_vip = $gcoin_cap_15_vip*(1+$vpoint_extra/100); echo $vpoint_cap_15_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_16" value="<?php echo $point_uythac_rsvip_cap_16; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_16_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_16_vip = $gcoin_cap_16_vip*(1+$vpoint_extra/100); echo $vpoint_cap_16_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_17" value="<?php echo $point_uythac_rsvip_cap_17; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_17_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_17_vip = $gcoin_cap_17_vip*(1+$vpoint_extra/100); echo $vpoint_cap_17_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_18" value="<?php echo $point_uythac_rsvip_cap_18; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_18_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_18_vip = $gcoin_cap_18_vip*(1+$vpoint_extra/100); echo $vpoint_cap_18_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_19" value="<?php echo $point_uythac_rsvip_cap_19; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_19_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_19_vip = $gcoin_cap_19_vip*(1+$vpoint_extra/100); echo $vpoint_cap_19_vip; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
					    <td align="center"><input type="text" name="point_uythac_rsvip_cap_20" value="<?php echo $point_uythac_rsvip_cap_20; ?>" size="1"/></td>
					    <td align="center"><?php echo $gcoin_cap_20_vip; ?></td>
					    <td align="center"><?php $vpoint_cap_20_vip = $gcoin_cap_20_vip*(1+$vpoint_extra/100); echo $vpoint_cap_20_vip; ?></td>
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
	  
