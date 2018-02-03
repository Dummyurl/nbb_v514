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
 
$file_edit = 'config/config_uplvitem.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

function _convert_num_abs($num) {
    if(!is_numeric($num) || $num < 0) {
        return 0;
    }
    return $num;
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

$action = $_POST[action];

if($action == 'edit')
{
	$content = "<?php\n";
	
	$lvmax 	= $_POST['lvmax'];		
        $lvmax = abs(intval($lvmax));
        if($lvmax > 15) $lvmax = 15;
            $content .= "\$lvmax	= $lvmax;\n";
	
    $lv1_chao 	= $_POST['lv1_chao'];		
        $lv1_chao = _convert_num_abs($lv1_chao);
            $content .= "\$lv1_chao	= $lv1_chao;\n";
	$lv1_cre 	= $_POST['lv1_cre'];		
        $lv1_cre = _convert_num_abs($lv1_cre);
            $content .= "\$lv1_cre	= $lv1_cre;\n";
	$lv1_blue 	= $_POST['lv1_blue'];		
        $lv1_blue = _convert_num_abs($lv1_blue);
            $content .= "\$lv1_blue	= $lv1_blue;\n";
	$lv1_max 	= $_POST['lv1_max'];		
        $lv1_max = _convert_num_abs($lv1_max);
            $content .= "\$lv1_max	= $lv1_max;\n";
	
    $lv2_chao 	= $_POST['lv2_chao'];		
        $lv2_chao = _convert_num_abs($lv2_chao);
            $content .= "\$lv2_chao	= $lv2_chao;\n";
	$lv2_cre 	= $_POST['lv2_cre'];		
        $lv2_cre = _convert_num_abs($lv2_cre);
            $content .= "\$lv2_cre	= $lv2_cre;\n";
	$lv2_blue 	= $_POST['lv2_blue'];		
        $lv2_blue = _convert_num_abs($lv2_blue);
            $content .= "\$lv2_blue	= $lv2_blue;\n";
	$lv2_max 	= $_POST['lv2_max'];		
        $lv2_max = _convert_num_abs($lv2_max);
            $content .= "\$lv2_max	= $lv2_max;\n";
	
    $lv3_chao 	= $_POST['lv3_chao'];		
        $lv3_chao = _convert_num_abs($lv3_chao);
            $content .= "\$lv3_chao	= $lv3_chao;\n";
	$lv3_cre 	= $_POST['lv3_cre'];		
        $lv3_cre = _convert_num_abs($lv3_cre);
            $content .= "\$lv3_cre	= $lv3_cre;\n";
	$lv3_blue 	= $_POST['lv3_blue'];		
        $lv3_blue = _convert_num_abs($lv3_blue);
            $content .= "\$lv3_blue	= $lv3_blue;\n";
	$lv3_max 	= $_POST['lv3_max'];		
        $lv3_max = _convert_num_abs($lv3_max);
            $content .= "\$lv3_max	= $lv3_max;\n";
	
    $lv4_chao 	= $_POST['lv4_chao'];		
        $lv4_chao = _convert_num_abs($lv4_chao);
            $content .= "\$lv4_chao	= $lv4_chao;\n";
	$lv4_cre 	= $_POST['lv4_cre'];		
        $lv4_cre = _convert_num_abs($lv4_cre);
            $content .= "\$lv4_cre	= $lv4_cre;\n";
	$lv4_blue 	= $_POST['lv4_blue'];		
        $lv4_blue = _convert_num_abs($lv4_blue);
            $content .= "\$lv4_blue	= $lv4_blue;\n";
	$lv4_max 	= $_POST['lv4_max'];		
        $lv4_max = _convert_num_abs($lv4_max);
            $content .= "\$lv4_max	= $lv4_max;\n";
	
    $lv5_chao 	= $_POST['lv5_chao'];		
        $lv5_chao = _convert_num_abs($lv5_chao);
            $content .= "\$lv5_chao	= $lv5_chao;\n";
	$lv5_cre 	= $_POST['lv5_cre'];		
        $lv5_cre = _convert_num_abs($lv5_cre);
            $content .= "\$lv5_cre	= $lv5_cre;\n";
	$lv5_blue 	= $_POST['lv5_blue'];		
        $lv5_blue = _convert_num_abs($lv5_blue);
            $content .= "\$lv5_blue	= $lv5_blue;\n";
	$lv5_max 	= $_POST['lv5_max'];		
        $lv5_max = _convert_num_abs($lv5_max);
            $content .= "\$lv5_max	= $lv5_max;\n";
	
    $lv6_chao 	= $_POST['lv6_chao'];		
        $lv6_chao = _convert_num_abs($lv6_chao);
            $content .= "\$lv6_chao	= $lv6_chao;\n";
	$lv6_cre 	= $_POST['lv6_cre'];		
        $lv6_cre = _convert_num_abs($lv6_cre);
            $content .= "\$lv6_cre	= $lv6_cre;\n";
	$lv6_blue 	= $_POST['lv6_blue'];		
        $lv6_blue = _convert_num_abs($lv6_blue);
            $content .= "\$lv6_blue	= $lv6_blue;\n";
	$lv6_max 	= $_POST['lv6_max'];		
        $lv6_max = _convert_num_abs($lv6_max);
            $content .= "\$lv6_max	= $lv6_max;\n";
	
    $lv7_chao 	= $_POST['lv7_chao'];		
        $lv7_chao = _convert_num_abs($lv7_chao);
            $content .= "\$lv7_chao	= $lv7_chao;\n";
	$lv7_cre 	= $_POST['lv7_cre'];		
        $lv7_cre = _convert_num_abs($lv7_cre);
            $content .= "\$lv7_cre	= $lv7_cre;\n";
	$lv7_blue 	= $_POST['lv7_blue'];		
        $lv7_blue = _convert_num_abs($lv7_blue);
            $content .= "\$lv7_blue	= $lv7_blue;\n";
	$lv7_max 	= $_POST['lv7_max'];		
        $lv7_max = _convert_num_abs($lv7_max);
            $content .= "\$lv7_max	= $lv7_max;\n";
	
    $lv8_chao 	= $_POST['lv8_chao'];		
        $lv8_chao = _convert_num_abs($lv8_chao);
            $content .= "\$lv8_chao	= $lv8_chao;\n";
	$lv8_cre 	= $_POST['lv8_cre'];		
        $lv8_cre = _convert_num_abs($lv8_cre);
            $content .= "\$lv8_cre	= $lv8_cre;\n";
	$lv8_blue 	= $_POST['lv8_blue'];		
        $lv8_blue = _convert_num_abs($lv8_blue);
            $content .= "\$lv8_blue	= $lv8_blue;\n";
	$lv8_max 	= $_POST['lv8_max'];		
        $lv8_max = _convert_num_abs($lv8_max);
            $content .= "\$lv8_max	= $lv8_max;\n";
	
    $lv9_chao 	= $_POST['lv9_chao'];		
        $lv9_chao = _convert_num_abs($lv9_chao);
            $content .= "\$lv9_chao	= $lv9_chao;\n";
	$lv9_cre 	= $_POST['lv9_cre'];		
        $lv9_cre = _convert_num_abs($lv9_cre);
            $content .= "\$lv9_cre	= $lv9_cre;\n";
	$lv9_blue 	= $_POST['lv9_blue'];		
        $lv9_blue = _convert_num_abs($lv9_blue);
            $content .= "\$lv9_blue	= $lv9_blue;\n";
	$lv9_max 	= $_POST['lv9_max'];		
        $lv9_max = _convert_num_abs($lv9_max);
            $content .= "\$lv9_max	= $lv9_max;\n";
	
    $lv10_chao 	= $_POST['lv10_chao'];		
        $lv10_chao = _convert_num_abs($lv10_chao);
            $content .= "\$lv10_chao	= $lv10_chao;\n";
	$lv10_cre 	= $_POST['lv10_cre'];		
        $lv10_cre = _convert_num_abs($lv10_cre);
            $content .= "\$lv10_cre	= $lv10_cre;\n";
	$lv10_blue 	= $_POST['lv10_blue'];		
        $lv10_blue = _convert_num_abs($lv10_blue);
            $content .= "\$lv10_blue	= $lv10_blue;\n";
	$lv10_max 	= $_POST['lv10_max'];		
        $lv10_max = _convert_num_abs($lv10_max);
            $content .= "\$lv10_max	= $lv10_max;\n";
	
    $lv11_chao 	= $_POST['lv11_chao'];		
        $lv11_chao = _convert_num_abs($lv11_chao);
            $content .= "\$lv11_chao	= $lv11_chao;\n";
	$lv11_cre 	= $_POST['lv11_cre'];		
        $lv11_cre = _convert_num_abs($lv11_cre);
            $content .= "\$lv11_cre	= $lv11_cre;\n";
	$lv11_blue 	= $_POST['lv11_blue'];		
        $lv11_blue = _convert_num_abs($lv11_blue);
            $content .= "\$lv11_blue	= $lv11_blue;\n";
	$lv11_max 	= $_POST['lv11_max'];		
        $lv11_max = _convert_num_abs($lv11_max);
            $content .= "\$lv11_max	= $lv11_max;\n";
	
    $lv12_chao 	= $_POST['lv12_chao'];		
        $lv12_chao = _convert_num_abs($lv12_chao);
            $content .= "\$lv12_chao	= $lv12_chao;\n";
	$lv12_cre 	= $_POST['lv12_cre'];		
        $lv12_cre = _convert_num_abs($lv12_cre);
            $content .= "\$lv12_cre	= $lv12_cre;\n";
	$lv12_blue 	= $_POST['lv12_blue'];		
        $lv12_blue = _convert_num_abs($lv12_blue);
            $content .= "\$lv12_blue	= $lv12_blue;\n";
	$lv12_max 	= $_POST['lv12_max'];		
        $lv12_max = _convert_num_abs($lv12_max);
            $content .= "\$lv12_max	= $lv12_max;\n";
	
    $lv13_chao 	= $_POST['lv13_chao'];		
        $lv13_chao = _convert_num_abs($lv13_chao);
            $content .= "\$lv13_chao	= $lv13_chao;\n";
	$lv13_cre 	= $_POST['lv13_cre'];		
        $lv13_cre = _convert_num_abs($lv13_cre);
            $content .= "\$lv13_cre	= $lv13_cre;\n";
	$lv13_blue 	= $_POST['lv13_blue'];		
        $lv13_blue = _convert_num_abs($lv13_blue);
            $content .= "\$lv13_blue	= $lv13_blue;\n";
	$lv13_max 	= $_POST['lv13_max'];		
        $lv13_max = _convert_num_abs($lv13_max);
            $content .= "\$lv13_max	= $lv13_max;\n";
	
    $lv14_chao 	= $_POST['lv14_chao'];		
        $lv14_chao = _convert_num_abs($lv14_chao);
            $content .= "\$lv14_chao	= $lv14_chao;\n";
	$lv14_cre 	= $_POST['lv14_cre'];		
        $lv14_cre = _convert_num_abs($lv14_cre);
            $content .= "\$lv14_cre	= $lv14_cre;\n";
	$lv14_blue 	= $_POST['lv14_blue'];		
        $lv14_blue = _convert_num_abs($lv14_blue);
            $content .= "\$lv14_blue	= $lv14_blue;\n";
	$lv14_max 	= $_POST['lv14_max'];		
        $lv14_max = _convert_num_abs($lv14_max);
            $content .= "\$lv14_max	= $lv14_max;\n";
	
    $lv15_chao 	= $_POST['lv15_chao'];		
        $lv15_chao = _convert_num_abs($lv15_chao);
            $content .= "\$lv15_chao	= $lv15_chao;\n";
	$lv15_cre 	= $_POST['lv15_cre'];		
        $lv15_cre = _convert_num_abs($lv15_cre);
            $content .= "\$lv15_cre	= $lv15_cre;\n";
	$lv15_blue 	= $_POST['lv15_blue'];		
        $lv15_blue = _convert_num_abs($lv15_blue);
            $content .= "\$lv15_blue	= $lv15_blue;\n";
	$lv15_max 	= $_POST['lv15_max'];		
        $lv15_max = _convert_num_abs($lv15_max);
            $content .= "\$lv15_max	= $lv15_max;\n";
	
    
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
				<h1>Cấu Hình Rửa tội</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				Cấp độ ép đồ tối đa : <input name="lvmax" value="<?php echo $lvmax; ?>" /> (Tối đa là 15)
                <table width="100%" border="0" bgcolor="#9999FF">
				  <tr bgcolor="#FFFFFF">
				    <th scope="col" align="center">Ép đồ</th>
				    <th scope="col" align="center">Chao</th>
                    <th scope="col" align="center">Creation</th>
                    <th scope="col" align="center">Blue Feather</th>
                    <th scope="col" align="center">Tỷ lệ thành công tối đa</th>
				  </tr>
                  
				  <tr bgcolor="#FFFFFF">
				    <td align="center">+0 -> +1</td>
				    <td align="center"><input type="text" name="lv1_chao" value="<?php echo $lv1_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv1_cre" value="<?php echo $lv1_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv1_blue" value="<?php echo $lv1_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv1_max" value="<?php echo $lv1_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+1 -> +2</td>
				    <td align="center"><input type="text" name="lv2_chao" value="<?php echo $lv2_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv2_cre" value="<?php echo $lv2_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv2_blue" value="<?php echo $lv2_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv2_max" value="<?php echo $lv2_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+2 -> +3</td>
				    <td align="center"><input type="text" name="lv3_chao" value="<?php echo $lv3_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv3_cre" value="<?php echo $lv3_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv3_blue" value="<?php echo $lv3_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv3_max" value="<?php echo $lv3_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+3 -> +4</td>
				    <td align="center"><input type="text" name="lv4_chao" value="<?php echo $lv4_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv4_cre" value="<?php echo $lv4_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv4_blue" value="<?php echo $lv4_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv4_max" value="<?php echo $lv4_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+4 -> +5</td>
				    <td align="center"><input type="text" name="lv5_chao" value="<?php echo $lv5_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv5_cre" value="<?php echo $lv5_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv5_blue" value="<?php echo $lv5_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv5_max" value="<?php echo $lv5_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+5 -> +6</td>
				    <td align="center"><input type="text" name="lv6_chao" value="<?php echo $lv6_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv6_cre" value="<?php echo $lv6_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv6_blue" value="<?php echo $lv6_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv6_max" value="<?php echo $lv6_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+6 -> +7</td>
				    <td align="center"><input type="text" name="lv7_chao" value="<?php echo $lv7_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv7_cre" value="<?php echo $lv7_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv7_blue" value="<?php echo $lv7_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv7_max" value="<?php echo $lv7_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+7 -> +8</td>
				    <td align="center"><input type="text" name="lv8_chao" value="<?php echo $lv8_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv8_cre" value="<?php echo $lv8_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv8_blue" value="<?php echo $lv8_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv8_max" value="<?php echo $lv8_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+8 -> +9</td>
				    <td align="center"><input type="text" name="lv9_chao" value="<?php echo $lv9_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv9_cre" value="<?php echo $lv9_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv9_blue" value="<?php echo $lv9_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv9_max" value="<?php echo $lv9_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+9 -> +10</td>
				    <td align="center"><input type="text" name="lv10_chao" value="<?php echo $lv10_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv10_cre" value="<?php echo $lv10_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv10_blue" value="<?php echo $lv10_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv10_max" value="<?php echo $lv10_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+10 -> +11</td>
				    <td align="center"><input type="text" name="lv11_chao" value="<?php echo $lv11_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv11_cre" value="<?php echo $lv11_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv11_blue" value="<?php echo $lv11_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv11_max" value="<?php echo $lv11_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+11 -> +12</td>
				    <td align="center"><input type="text" name="lv12_chao" value="<?php echo $lv12_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv12_cre" value="<?php echo $lv12_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv12_blue" value="<?php echo $lv12_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv12_max" value="<?php echo $lv12_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+12 -> +13</td>
				    <td align="center"><input type="text" name="lv13_chao" value="<?php echo $lv13_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv13_cre" value="<?php echo $lv13_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv13_blue" value="<?php echo $lv13_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv13_max" value="<?php echo $lv13_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+13 -> +14</td>
				    <td align="center"><input type="text" name="lv14_chao" value="<?php echo $lv14_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv14_cre" value="<?php echo $lv14_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv14_blue" value="<?php echo $lv14_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv14_max" value="<?php echo $lv14_max; ?>" size="3"/> %</td>
				  </tr>
                  
                  <tr bgcolor="#FFFFFF">
				    <td align="center">+14 -> +15</td>
				    <td align="center"><input type="text" name="lv15_chao" value="<?php echo $lv15_chao; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv15_cre" value="<?php echo $lv15_cre; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv15_blue" value="<?php echo $lv15_blue; ?>" size="3"/> %</td>
                    <td align="center"><input type="text" name="lv15_max" value="<?php echo $lv15_max; ?>" size="3"/> %</td>
				  </tr>
                  
				</table>
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
	  
