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
require_once('config/config_dongbo.php');

$file_edit = 'config/config_resetvip.php';
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
	
	$level_cap_1_vip = $_POST['level_cap_1_vip'];
        $level_cap_1_vip = abs(intval($level_cap_1_vip));
    		$content .= "\$level_cap_1_vip	= $level_cap_1_vip;\n";
	$gcoin_cap_1_vip = $_POST['gcoin_cap_1_vip'];
        $gcoin_cap_1_vip = abs(intval($gcoin_cap_1_vip));
    		$content .= "\$gcoin_cap_1_vip	= $gcoin_cap_1_vip;\n";
	$point_cap_1_vip = $_POST['point_cap_1_vip'];
        $point_cap_1_vip = abs(intval($point_cap_1_vip));
    		$content .= "\$point_cap_1_vip	= $point_cap_1_vip;\n";
	$ml_cap_1_vip = $_POST['ml_cap_1_vip'];
        $ml_cap_1_vip = abs(intval($ml_cap_1_vip));
    		$content .= "\$ml_cap_1_vip	= $ml_cap_1_vip;\n";
	
	$level_cap_2_vip = $_POST['level_cap_2_vip'];
        $level_cap_2_vip = abs(intval($level_cap_2_vip));
    		$content .= "\$level_cap_2_vip	= $level_cap_2_vip;\n";
	$gcoin_cap_2_vip = $_POST['gcoin_cap_2_vip'];
        $gcoin_cap_2_vip = abs(intval($gcoin_cap_2_vip));
    		$content .= "\$gcoin_cap_2_vip	= $gcoin_cap_2_vip;\n";
	$point_cap_2_vip = $_POST['point_cap_2_vip'];
        $point_cap_2_vip = abs(intval($point_cap_2_vip));
    		$content .= "\$point_cap_2_vip	= $point_cap_2_vip;\n";
	$ml_cap_2_vip = $_POST['ml_cap_2_vip'];
        $ml_cap_2_vip = abs(intval($ml_cap_2_vip));
    		$content .= "\$ml_cap_2_vip	= $ml_cap_2_vip;\n";
	
	$level_cap_3_vip = $_POST['level_cap_3_vip'];
        $level_cap_3_vip = abs(intval($level_cap_3_vip));
    		$content .= "\$level_cap_3_vip	= $level_cap_3_vip;\n";
	$gcoin_cap_3_vip = $_POST['gcoin_cap_3_vip'];
        $gcoin_cap_3_vip = abs(intval($gcoin_cap_3_vip));
    		$content .= "\$gcoin_cap_3_vip	= $gcoin_cap_3_vip;\n";
	$point_cap_3_vip = $_POST['point_cap_3_vip'];
        $point_cap_3_vip = abs(intval($point_cap_3_vip));
    		$content .= "\$point_cap_3_vip	= $point_cap_3_vip;\n";
	$ml_cap_3_vip = $_POST['ml_cap_3_vip'];
        $ml_cap_3_vip = abs(intval($ml_cap_3_vip));
    		$content .= "\$ml_cap_3_vip	= $ml_cap_3_vip;\n";
	
	$level_cap_4_vip = $_POST['level_cap_4_vip'];
        $level_cap_4_vip = abs(intval($level_cap_4_vip));
    		$content .= "\$level_cap_4_vip	= $level_cap_4_vip;\n";
	$gcoin_cap_4_vip = $_POST['gcoin_cap_4_vip'];
        $gcoin_cap_4_vip = abs(intval($gcoin_cap_4_vip));
    		$content .= "\$gcoin_cap_4_vip	= $gcoin_cap_4_vip;\n";
	$point_cap_4_vip = $_POST['point_cap_4_vip'];
        $point_cap_4_vip = abs(intval($point_cap_4_vip));
    		$content .= "\$point_cap_4_vip	= $point_cap_4_vip;\n";
	$ml_cap_4_vip = $_POST['ml_cap_4_vip'];
        $ml_cap_4_vip = abs(intval($ml_cap_4_vip));
    		$content .= "\$ml_cap_4_vip	= $ml_cap_4_vip;\n";
	
	$level_cap_5_vip = $_POST['level_cap_5_vip'];
        $level_cap_5_vip = abs(intval($level_cap_5_vip));
    		$content .= "\$level_cap_5_vip	= $level_cap_5_vip;\n";
	$gcoin_cap_5_vip = $_POST['gcoin_cap_5_vip'];
        $gcoin_cap_5_vip = abs(intval($gcoin_cap_5_vip));
    		$content .= "\$gcoin_cap_5_vip	= $gcoin_cap_5_vip;\n";
	$point_cap_5_vip = $_POST['point_cap_5_vip'];
        $point_cap_5_vip = abs(intval($point_cap_5_vip));
    		$content .= "\$point_cap_5_vip	= $point_cap_5_vip;\n";
	$ml_cap_5_vip = $_POST['ml_cap_5_vip'];
        $ml_cap_5_vip = abs(intval($ml_cap_5_vip));
    		$content .= "\$ml_cap_5_vip	= $ml_cap_5_vip;\n";
	
	$level_cap_6_vip = $_POST['level_cap_6_vip'];
        $level_cap_6_vip = abs(intval($level_cap_6_vip));
    		$content .= "\$level_cap_6_vip	= $level_cap_6_vip;\n";
	$gcoin_cap_6_vip = $_POST['gcoin_cap_6_vip'];
        $gcoin_cap_6_vip = abs(intval($gcoin_cap_6_vip));
    		$content .= "\$gcoin_cap_6_vip	= $gcoin_cap_6_vip;\n";
	$point_cap_6_vip = $_POST['point_cap_6_vip'];
        $point_cap_6_vip = abs(intval($point_cap_6_vip));
    		$content .= "\$point_cap_6_vip	= $point_cap_6_vip;\n";
	$ml_cap_6_vip = $_POST['ml_cap_6_vip'];	
        $ml_cap_6_vip = abs(intval($ml_cap_6_vip));
        	$content .= "\$ml_cap_6_vip	= $ml_cap_6_vip;\n";
	
	$level_cap_7_vip = $_POST['level_cap_7_vip'];
        $level_cap_7_vip = abs(intval($level_cap_7_vip));
    		$content .= "\$level_cap_7_vip	= $level_cap_7_vip;\n";
	$gcoin_cap_7_vip = $_POST['gcoin_cap_7_vip'];
        $gcoin_cap_7_vip = abs(intval($gcoin_cap_7_vip));
    		$content .= "\$gcoin_cap_7_vip	= $gcoin_cap_7_vip;\n";
	$point_cap_7_vip = $_POST['point_cap_7_vip'];
        $point_cap_7_vip = abs(intval($point_cap_7_vip));
    		$content .= "\$point_cap_7_vip	= $point_cap_7_vip;\n";
	$ml_cap_7_vip = $_POST['ml_cap_7_vip'];
        $ml_cap_7_vip = abs(intval($ml_cap_7_vip));
    		$content .= "\$ml_cap_7_vip	= $ml_cap_7_vip;\n";
	
	$level_cap_8_vip = $_POST['level_cap_8_vip'];
        $level_cap_8_vip = abs(intval($level_cap_8_vip));
    		$content .= "\$level_cap_8_vip	= $level_cap_8_vip;\n";
	$gcoin_cap_8_vip = $_POST['gcoin_cap_8_vip'];
        $gcoin_cap_8_vip = abs(intval($gcoin_cap_8_vip));
    		$content .= "\$gcoin_cap_8_vip	= $gcoin_cap_8_vip;\n";
	$point_cap_8_vip = $_POST['point_cap_8_vip'];
        $point_cap_8_vip = abs(intval($point_cap_8_vip));
    		$content .= "\$point_cap_8_vip	= $point_cap_8_vip;\n";
	$ml_cap_8_vip = $_POST['ml_cap_8_vip'];
        $ml_cap_8_vip = abs(intval($ml_cap_8_vip));
    		$content .= "\$ml_cap_8_vip	= $ml_cap_8_vip;\n";
	
	$level_cap_9_vip = $_POST['level_cap_9_vip'];
        $level_cap_9_vip = abs(intval($level_cap_9_vip));
    		$content .= "\$level_cap_9_vip	= $level_cap_9_vip;\n";
	$gcoin_cap_9_vip = $_POST['gcoin_cap_9_vip'];
        $gcoin_cap_9_vip = abs(intval($gcoin_cap_9_vip));
    		$content .= "\$gcoin_cap_9_vip	= $gcoin_cap_9_vip;\n";
	$point_cap_9_vip = $_POST['point_cap_9_vip'];
        $point_cap_9_vip = abs(intval($point_cap_9_vip));
    		$content .= "\$point_cap_9_vip	= $point_cap_9_vip;\n";
	$ml_cap_9_vip = $_POST['ml_cap_9_vip'];
        $ml_cap_9_vip = abs(intval($ml_cap_9_vip));
    		$content .= "\$ml_cap_9_vip	= $ml_cap_9_vip;\n";
	
	$level_cap_10_vip = $_POST['level_cap_10_vip'];
        $level_cap_10_vip = abs(intval($level_cap_10_vip));
    		$content .= "\$level_cap_10_vip	= $level_cap_10_vip;\n";
	$gcoin_cap_10_vip = $_POST['gcoin_cap_10_vip'];
        $gcoin_cap_10_vip = abs(intval($gcoin_cap_10_vip));
    		$content .= "\$gcoin_cap_10_vip	= $gcoin_cap_10_vip;\n";
	$point_cap_10_vip = $_POST['point_cap_10_vip'];
        $point_cap_10_vip = abs(intval($point_cap_10_vip));
    		$content .= "\$point_cap_10_vip	= $point_cap_10_vip;\n";
	$ml_cap_10_vip = $_POST['ml_cap_10_vip'];
        $ml_cap_10_vip = abs(intval($ml_cap_10_vip));
    		$content .= "\$ml_cap_10_vip	= $ml_cap_10_vip;\n";
	
	$level_cap_11_vip = $_POST['level_cap_11_vip'];
        $level_cap_11_vip = abs(intval($level_cap_11_vip));
    		$content .= "\$level_cap_11_vip	= $level_cap_11_vip;\n";
	$gcoin_cap_11_vip = $_POST['gcoin_cap_11_vip'];
        $gcoin_cap_11_vip = abs(intval($gcoin_cap_11_vip));
    		$content .= "\$gcoin_cap_11_vip	= $gcoin_cap_11_vip;\n";
	$point_cap_11_vip = $_POST['point_cap_11_vip'];
        $point_cap_11_vip = abs(intval($point_cap_11_vip));
    		$content .= "\$point_cap_11_vip	= $point_cap_11_vip;\n";
	$ml_cap_11_vip = $_POST['ml_cap_11_vip'];
        $ml_cap_11_vip = abs(intval($ml_cap_11_vip));
    		$content .= "\$ml_cap_11_vip	= $ml_cap_11_vip;\n";
	
	$level_cap_12_vip = $_POST['level_cap_12_vip'];
        $level_cap_12_vip = abs(intval($level_cap_12_vip));
    		$content .= "\$level_cap_12_vip	= $level_cap_12_vip;\n";
	$gcoin_cap_12_vip = $_POST['gcoin_cap_12_vip'];
        $gcoin_cap_12_vip = abs(intval($gcoin_cap_12_vip));
    		$content .= "\$gcoin_cap_12_vip	= $gcoin_cap_12_vip;\n";
	$point_cap_12_vip = $_POST['point_cap_12_vip'];	
        $point_cap_12_vip = abs(intval($point_cap_12_vip));
        	$content .= "\$point_cap_12_vip	= $point_cap_12_vip;\n";
	$ml_cap_12_vip = $_POST['ml_cap_12_vip'];
        $ml_cap_12_vip = abs(intval($ml_cap_12_vip));
    		$content .= "\$ml_cap_12_vip	= $ml_cap_12_vip;\n";
	
	$level_cap_13_vip = $_POST['level_cap_13_vip'];
        $level_cap_13_vip = abs(intval($level_cap_13_vip));
    		$content .= "\$level_cap_13_vip	= $level_cap_13_vip;\n";
	$gcoin_cap_13_vip = $_POST['gcoin_cap_13_vip'];
        $gcoin_cap_13_vip = abs(intval($gcoin_cap_13_vip));
    		$content .= "\$gcoin_cap_13_vip	= $gcoin_cap_13_vip;\n";
	$point_cap_13_vip = $_POST['point_cap_13_vip'];
        $point_cap_13_vip = abs(intval($point_cap_13_vip));
    		$content .= "\$point_cap_13_vip	= $point_cap_13_vip;\n";
	$ml_cap_13_vip = $_POST['ml_cap_13_vip'];
        $ml_cap_13_vip = abs(intval($ml_cap_13_vip));
    		$content .= "\$ml_cap_13_vip	= $ml_cap_13_vip;\n";
	
	$level_cap_14_vip = $_POST['level_cap_14_vip'];
        $level_cap_14_vip = abs(intval($level_cap_14_vip));
    		$content .= "\$level_cap_14_vip	= $level_cap_14_vip;\n";
	$gcoin_cap_14_vip = $_POST['gcoin_cap_14_vip'];
        $gcoin_cap_14_vip = abs(intval($gcoin_cap_14_vip));
    		$content .= "\$gcoin_cap_14_vip	= $gcoin_cap_14_vip;\n";
	$point_cap_14_vip = $_POST['point_cap_14_vip'];
        $point_cap_14_vip = abs(intval($point_cap_14_vip));
    		$content .= "\$point_cap_14_vip	= $point_cap_14_vip;\n";
	$ml_cap_14_vip = $_POST['ml_cap_14_vip'];
        $ml_cap_14_vip = abs(intval($ml_cap_14_vip));
    		$content .= "\$ml_cap_14_vip	= $ml_cap_14_vip;\n";
	
	$level_cap_15_vip = $_POST['level_cap_15_vip'];
        $level_cap_15_vip = abs(intval($level_cap_15_vip));
    		$content .= "\$level_cap_15_vip	= $level_cap_15_vip;\n";
	$gcoin_cap_15_vip = $_POST['gcoin_cap_15_vip'];	
        $gcoin_cap_15_vip = abs(intval($gcoin_cap_15_vip));
        	$content .= "\$gcoin_cap_15_vip	= $gcoin_cap_15_vip;\n";
	$point_cap_15_vip = $_POST['point_cap_15_vip'];
        $point_cap_15_vip = abs(intval($point_cap_15_vip));
    		$content .= "\$point_cap_15_vip	= $point_cap_15_vip;\n";
	$ml_cap_15_vip = $_POST['ml_cap_15_vip'];
        $ml_cap_15_vip = abs(intval($ml_cap_15_vip));
    		$content .= "\$ml_cap_15_vip	= $ml_cap_15_vip;\n";
	
	$level_cap_16_vip = $_POST['level_cap_16_vip'];
        $level_cap_16_vip = abs(intval($level_cap_16_vip));
    		$content .= "\$level_cap_16_vip	= $level_cap_16_vip;\n";
	$gcoin_cap_16_vip = $_POST['gcoin_cap_16_vip'];
        $gcoin_cap_16_vip = abs(intval($gcoin_cap_16_vip));
    		$content .= "\$gcoin_cap_16_vip	= $gcoin_cap_16_vip;\n";
	$point_cap_16_vip = $_POST['point_cap_16_vip'];
        $point_cap_16_vip = abs(intval($point_cap_16_vip));
    		$content .= "\$point_cap_16_vip	= $point_cap_16_vip;\n";
	$ml_cap_16_vip = $_POST['ml_cap_16_vip'];
        $ml_cap_16_vip = abs(intval($ml_cap_16_vip));
    		$content .= "\$ml_cap_16_vip	= $ml_cap_16_vip;\n";
	
	$level_cap_17_vip = $_POST['level_cap_17_vip'];
        $level_cap_17_vip = abs(intval($level_cap_17_vip));
    		$content .= "\$level_cap_17_vip	= $level_cap_17_vip;\n";
	$gcoin_cap_17_vip = $_POST['gcoin_cap_17_vip'];
        $gcoin_cap_17_vip = abs(intval($gcoin_cap_17_vip));
    		$content .= "\$gcoin_cap_17_vip	= $gcoin_cap_17_vip;\n";
	$point_cap_17_vip = $_POST['point_cap_17_vip'];
        $point_cap_17_vip = abs(intval($point_cap_17_vip));
    		$content .= "\$point_cap_17_vip	= $point_cap_17_vip;\n";
	$ml_cap_17_vip = $_POST['ml_cap_17_vip'];
        $ml_cap_17_vip = abs(intval($ml_cap_17_vip));
    		$content .= "\$ml_cap_17_vip	= $ml_cap_17_vip;\n";
	
	$level_cap_18_vip = $_POST['level_cap_18_vip'];
        $level_cap_18_vip = abs(intval($level_cap_18_vip));
    		$content .= "\$level_cap_18_vip	= $level_cap_18_vip;\n";
	$gcoin_cap_18_vip = $_POST['gcoin_cap_18_vip'];
        $gcoin_cap_18_vip = abs(intval($gcoin_cap_18_vip));
    		$content .= "\$gcoin_cap_18_vip	= $gcoin_cap_18_vip;\n";
	$point_cap_18_vip = $_POST['point_cap_18_vip'];
        $point_cap_18_vip = abs(intval($point_cap_18_vip));
    		$content .= "\$point_cap_18_vip	= $point_cap_18_vip;\n";
	$ml_cap_18_vip = $_POST['ml_cap_18_vip'];
        $ml_cap_18_vip = abs(intval($ml_cap_18_vip));
    		$content .= "\$ml_cap_18_vip	= $ml_cap_18_vip;\n";
	
	$level_cap_19_vip = $_POST['level_cap_19_vip'];
        $level_cap_19_vip = abs(intval($level_cap_19_vip));
    		$content .= "\$level_cap_19_vip	= $level_cap_19_vip;\n";
	$gcoin_cap_19_vip = $_POST['gcoin_cap_19_vip'];
        $gcoin_cap_19_vip = abs(intval($gcoin_cap_19_vip));
    		$content .= "\$gcoin_cap_19_vip	= $gcoin_cap_19_vip;\n";
	$point_cap_19_vip = $_POST['point_cap_19_vip'];
        $point_cap_19_vip = abs(intval($point_cap_19_vip));
    		$content .= "\$point_cap_19_vip	= $point_cap_19_vip;\n";
	$ml_cap_19_vip = $_POST['ml_cap_19_vip'];
        $ml_cap_19_vip = abs(intval($ml_cap_19_vip));
    		$content .= "\$ml_cap_19_vip	= $ml_cap_19_vip;\n";
	
	$level_cap_20_vip = $_POST['level_cap_20_vip'];
        $level_cap_20_vip = abs(intval($level_cap_20_vip));
    		$content .= "\$level_cap_20_vip	= $level_cap_20_vip;\n";
	$gcoin_cap_20_vip = $_POST['gcoin_cap_20_vip'];
        $gcoin_cap_20_vip = abs(intval($gcoin_cap_20_vip));
    		$content .= "\$gcoin_cap_20_vip	= $gcoin_cap_20_vip;\n";
	$point_cap_20_vip = $_POST['point_cap_20_vip'];
        $point_cap_20_vip = abs(intval($point_cap_20_vip));
    		$content .= "\$point_cap_20_vip	= $point_cap_20_vip;\n";
	$ml_cap_20_vip = $_POST['ml_cap_20_vip'];
        $ml_cap_20_vip = abs(intval($ml_cap_20_vip));
    		$content .= "\$ml_cap_20_vip	= $ml_cap_20_vip;\n";
	
	
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
				<h1>Cấu Hình ResetVIP</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
					- Cấp Reset lấy từ Reset thường.<br>
					- Vpoint tính theo Gcoin + Vpoin Extra trong cấu hình chung.<br>
					<br>
					<table width="100%" border="0" bgcolor="#9999FF">
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>Reset</b></td>
					    <td align="center"><b>Level</b></td>
					    <td align="center"><b>Gcoin</b></td>
					    <td align="center"><b>Vpoint</b></td>
					    <td align="center"><b>Point</b></td>
					    <td align="center"><b>Mệnh Lệnh</b></td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_0++; echo "$reset_cap_0 - $reset_cap_1"; ?></td>
					    <td align="center"><input type="text" name="level_cap_1_vip" value="<?php echo $level_cap_1_vip; ?>" size="2"/> <?php echo $level_cap_1; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_1_vip" value="<?php echo $gcoin_cap_1_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_1_vip = floor($gcoin_cap_1_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_1_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_1_vip" value="<?php echo $point_cap_1_vip; ?>" size="2"/> <?php echo $point_cap_1; ?></td>
					    <td align="center"><input type="text" name="ml_cap_1_vip" value="<?php echo $ml_cap_1_vip; ?>" size="2"/> <?php echo $ml_cap_1; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_1++; echo "$reset_cap_1 - $reset_cap_2"; ?></td>
					    <td align="center"><input type="text" name="level_cap_2_vip" value="<?php echo $level_cap_2_vip; ?>" size="2"/> <?php echo $level_cap_2; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_2_vip" value="<?php echo $gcoin_cap_2_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_2_vip = floor($gcoin_cap_2_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_2_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_2_vip" value="<?php echo $point_cap_2_vip; ?>" size="2"/> <?php echo $point_cap_2; ?></td>
					    <td align="center"><input type="text" name="ml_cap_2_vip" value="<?php echo $ml_cap_2_vip; ?>" size="2"/> <?php echo $ml_cap_2; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_2++; echo "$reset_cap_2 - $reset_cap_3"; ?></td>
					    <td align="center"><input type="text" name="level_cap_3_vip" value="<?php echo $level_cap_3_vip; ?>" size="2"/> <?php echo $level_cap_3; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_3_vip" value="<?php echo $gcoin_cap_3_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_3_vip = floor($gcoin_cap_3_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_3_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_3_vip" value="<?php echo $point_cap_3_vip; ?>" size="2"/> <?php echo $point_cap_3; ?></td>
					    <td align="center"><input type="text" name="ml_cap_3_vip" value="<?php echo $ml_cap_3_vip; ?>" size="2"/> <?php echo $ml_cap_3; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_3++; echo "$reset_cap_3 - $reset_cap_4"; ?></td>
					    <td align="center"><input type="text" name="level_cap_4_vip" value="<?php echo $level_cap_4_vip; ?>" size="2"/> <?php echo $level_cap_4; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_4_vip" value="<?php echo $gcoin_cap_4_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_4_vip = floor($gcoin_cap_4_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_4_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_4_vip" value="<?php echo $point_cap_4_vip; ?>" size="2"/> <?php echo $point_cap_4; ?></td>
					    <td align="center"><input type="text" name="ml_cap_4_vip" value="<?php echo $ml_cap_4_vip; ?>" size="2"/> <?php echo $ml_cap_4; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_4++; echo "$reset_cap_4 - $reset_cap_5"; ?></td>
					    <td align="center"><input type="text" name="level_cap_5_vip" value="<?php echo $level_cap_5_vip; ?>" size="2"/> <?php echo $level_cap_5; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_5_vip" value="<?php echo $gcoin_cap_5_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_5_vip = floor($gcoin_cap_5_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_5_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_5_vip" value="<?php echo $point_cap_5_vip; ?>" size="2"/> <?php echo $point_cap_5; ?></td>
					    <td align="center"><input type="text" name="ml_cap_5_vip" value="<?php echo $ml_cap_5_vip; ?>" size="2"/> <?php echo $ml_cap_5; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_5++; echo "$reset_cap_5 - $reset_cap_6"; ?></td>
					    <td align="center"><input type="text" name="level_cap_6_vip" value="<?php echo $level_cap_6_vip; ?>" size="2"/> <?php echo $level_cap_6; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_6_vip" value="<?php echo $gcoin_cap_6_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_6_vip = floor($gcoin_cap_6_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_6_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_6_vip" value="<?php echo $point_cap_6_vip; ?>" size="2"/> <?php echo $point_cap_6; ?></td>
					    <td align="center"><input type="text" name="ml_cap_6_vip" value="<?php echo $ml_cap_6_vip; ?>" size="2"/> <?php echo $ml_cap_6; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_6++; echo "$reset_cap_6 - $reset_cap_7"; ?></td>
					    <td align="center"><input type="text" name="level_cap_7_vip" value="<?php echo $level_cap_7_vip; ?>" size="2"/> <?php echo $level_cap_7; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_7_vip" value="<?php echo $gcoin_cap_7_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_7_vip = floor($gcoin_cap_7_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_7_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_7_vip" value="<?php echo $point_cap_7_vip; ?>" size="2"/> <?php echo $point_cap_7; ?></td>
					    <td align="center"><input type="text" name="ml_cap_7_vip" value="<?php echo $ml_cap_7_vip; ?>" size="2"/> <?php echo $ml_cap_7; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_7++; echo "$reset_cap_7 - $reset_cap_8"; ?></td>
					    <td align="center"><input type="text" name="level_cap_8_vip" value="<?php echo $level_cap_8_vip; ?>" size="2"/> <?php echo $level_cap_8; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_8_vip" value="<?php echo $gcoin_cap_8_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_8_vip = floor($gcoin_cap_8_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_8_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_8_vip" value="<?php echo $point_cap_8_vip; ?>" size="2"/> <?php echo $point_cap_8; ?></td>
					    <td align="center"><input type="text" name="ml_cap_8_vip" value="<?php echo $ml_cap_8_vip; ?>" size="2"/> <?php echo $ml_cap_8; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_8++; echo "$reset_cap_8 - $reset_cap_9"; ?></td>
					    <td align="center"><input type="text" name="level_cap_9_vip" value="<?php echo $level_cap_9_vip; ?>" size="2"/> <?php echo $level_cap_9; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_9_vip" value="<?php echo $gcoin_cap_9_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_9_vip = floor($gcoin_cap_9_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_9_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_9_vip" value="<?php echo $point_cap_9_vip; ?>" size="2"/> <?php echo $point_cap_9; ?></td>
					    <td align="center"><input type="text" name="ml_cap_9_vip" value="<?php echo $ml_cap_9_vip; ?>" size="2"/> <?php echo $ml_cap_9; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_9++; echo "$reset_cap_9 - $reset_cap_10"; ?></td>
					    <td align="center"><input type="text" name="level_cap_10_vip" value="<?php echo $level_cap_10_vip; ?>" size="2"/> <?php echo $level_cap_10; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_10_vip" value="<?php echo $gcoin_cap_10_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_10_vip = floor($gcoin_cap_10_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_10_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_10_vip" value="<?php echo $point_cap_10_vip; ?>" size="2"/> <?php echo $point_cap_10; ?></td>
					    <td align="center"><input type="text" name="ml_cap_10_vip" value="<?php echo $ml_cap_10_vip; ?>" size="2"/> <?php echo $ml_cap_10; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_10++; echo "$reset_cap_10 - $reset_cap_11"; ?></td>
					    <td align="center"><input type="text" name="level_cap_11_vip" value="<?php echo $level_cap_11_vip; ?>" size="2"/> <?php echo $level_cap_11; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_11_vip" value="<?php echo $gcoin_cap_11_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_11_vip = floor($gcoin_cap_11_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_11_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_11_vip" value="<?php echo $point_cap_11_vip; ?>" size="2"/>  <?php echo $point_cap_11; ?></td>
					    <td align="center"><input type="text" name="ml_cap_11_vip" value="<?php echo $ml_cap_11_vip; ?>" size="2"/> <?php echo $ml_cap_11; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_11++; echo "$reset_cap_11 - $reset_cap_12"; ?></td>
					    <td align="center"><input type="text" name="level_cap_12_vip" value="<?php echo $level_cap_12_vip; ?>" size="2"/> <?php echo $level_cap_12; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_12_vip" value="<?php echo $gcoin_cap_12_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_12_vip = floor($gcoin_cap_12_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_12_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_12_vip" value="<?php echo $point_cap_12_vip; ?>" size="2"/>  <?php echo $point_cap_12; ?></td>
					    <td align="center"><input type="text" name="ml_cap_12_vip" value="<?php echo $ml_cap_12_vip; ?>" size="2"/> <?php echo $ml_cap_12; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_12++; echo "$reset_cap_12 - $reset_cap_13"; ?></td>
					    <td align="center"><input type="text" name="level_cap_13_vip" value="<?php echo $level_cap_13_vip; ?>" size="2"/> <?php echo $level_cap_13; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_13_vip" value="<?php echo $gcoin_cap_13_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_13_vip = floor($gcoin_cap_13_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_13_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_13_vip" value="<?php echo $point_cap_13_vip; ?>" size="2"/>  <?php echo $point_cap_13; ?></td>
					    <td align="center"><input type="text" name="ml_cap_13_vip" value="<?php echo $ml_cap_13_vip; ?>" size="2"/> <?php echo $ml_cap_13; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_13++; echo "$reset_cap_13 - $reset_cap_14"; ?></td>
					    <td align="center"><input type="text" name="level_cap_14_vip" value="<?php echo $level_cap_14_vip; ?>" size="2"/> <?php echo $level_cap_14; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_14_vip" value="<?php echo $gcoin_cap_14_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_14_vip = floor($gcoin_cap_14_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_14_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_14_vip" value="<?php echo $point_cap_14_vip; ?>" size="2"/>  <?php echo $point_cap_14; ?></td>
					    <td align="center"><input type="text" name="ml_cap_14_vip" value="<?php echo $ml_cap_14_vip; ?>" size="2"/> <?php echo $ml_cap_14; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_14++; echo "$reset_cap_14 - $reset_cap_15"; ?></td>
					    <td align="center"><input type="text" name="level_cap_15_vip" value="<?php echo $level_cap_15_vip; ?>" size="2"/> <?php echo $level_cap_15; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_15_vip" value="<?php echo $gcoin_cap_15_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_15_vip = floor($gcoin_cap_15_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_15_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_15_vip" value="<?php echo $point_cap_15_vip; ?>" size="2"/>  <?php echo $point_cap_15; ?></td>
					    <td align="center"><input type="text" name="ml_cap_15_vip" value="<?php echo $ml_cap_15_vip; ?>" size="2"/> <?php echo $ml_cap_15; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_15++; echo "$reset_cap_15 - $reset_cap_16"; ?></td>
					    <td align="center"><input type="text" name="level_cap_16_vip" value="<?php echo $level_cap_16_vip; ?>" size="2"/> <?php echo $level_cap_16; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_16_vip" value="<?php echo $gcoin_cap_16_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_16_vip = floor($gcoin_cap_16_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_16_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_16_vip" value="<?php echo $point_cap_16_vip; ?>" size="2"/>  <?php echo $point_cap_16; ?></td>
					    <td align="center"><input type="text" name="ml_cap_16_vip" value="<?php echo $ml_cap_16_vip; ?>" size="2"/> <?php echo $ml_cap_16; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_16++; echo "$reset_cap_16 - $reset_cap_17"; ?></td>
					    <td align="center"><input type="text" name="level_cap_17_vip" value="<?php echo $level_cap_17_vip; ?>" size="2"/> <?php echo $level_cap_17; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_17_vip" value="<?php echo $gcoin_cap_17_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_17_vip = floor($gcoin_cap_17_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_17_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_17_vip" value="<?php echo $point_cap_17_vip; ?>" size="2"/>  <?php echo $point_cap_17; ?></td>
					    <td align="center"><input type="text" name="ml_cap_17_vip" value="<?php echo $ml_cap_17_vip; ?>" size="2"/> <?php echo $ml_cap_17; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_17++; echo "$reset_cap_17 - $reset_cap_18"; ?></td>
					    <td align="center"><input type="text" name="level_cap_18_vip" value="<?php echo $level_cap_18_vip; ?>" size="2"/> <?php echo $level_cap_18; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_18_vip" value="<?php echo $gcoin_cap_18_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_18_vip = floor($gcoin_cap_18_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_18_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_18_vip" value="<?php echo $point_cap_18_vip; ?>" size="2"/>  <?php echo $point_cap_18; ?></td>
					    <td align="center"><input type="text" name="ml_cap_18_vip" value="<?php echo $ml_cap_18_vip; ?>" size="2"/> <?php echo $ml_cap_18; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_18++; echo "$reset_cap_18 - $reset_cap_19"; ?></td>
					    <td align="center"><input type="text" name="level_cap_19_vip" value="<?php echo $level_cap_19_vip; ?>" size="2"/> <?php echo $level_cap_19; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_19_vip" value="<?php echo $gcoin_cap_19_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_19_vip = floor($gcoin_cap_19_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_19_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_19_vip" value="<?php echo $point_cap_19_vip; ?>" size="2"/>  <?php echo $point_cap_19; ?></td>
					    <td align="center"><input type="text" name="ml_cap_19_vip" value="<?php echo $ml_cap_19_vip; ?>" size="2"/> <?php echo $ml_cap_19; ?></td>
					  </tr>

					  <tr bgcolor="#FFFFFF">
					    <td align="center"><?php $reset_cap_19++; echo "$reset_cap_19 - $reset_cap_20"; ?></td>
					    <td align="center"><input type="text" name="level_cap_20_vip" value="<?php echo $level_cap_20_vip; ?>" size="2"/> <?php echo $level_cap_20; ?></td>
					    <td align="center"><input type="text" name="gcoin_cap_20_vip" value="<?php echo $gcoin_cap_20_vip; ?>" size="3"/></td>
					    <td align="center"><?php $vpoint_cap_20_vip = floor($gcoin_cap_20_vip*(1+$vpoint_extra/100)); echo $vpoint_cap_20_vip; ?></td>
					    <td align="center"><input type="text" name="point_cap_20_vip" value="<?php echo $point_cap_20_vip; ?>" size="2"/>  <?php echo $point_cap_20; ?></td>
					    <td align="center"><input type="text" name="ml_cap_20_vip" value="<?php echo $ml_cap_20_vip; ?>" size="2"/> <?php echo $ml_cap_20; ?></td>
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
	  
