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
 
$file_edit = 'config/config_gioihanrs.php';
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
	
	$use_gioihanrs = $_POST['use_gioihanrs'];
        foreach($use_gioihanrs as $k => $v) {
            $use_gioihanrs[$k] = abs(intval($v));
        }
            
	$gioihanrs_top1 = $_POST['gioihanrs_top1'];
        foreach($gioihanrs_top1 as $k => $v) {
            $gioihanrs_top1[$k] = abs(intval($v));
        }
    $gioihanrs_top2 = $_POST['gioihanrs_top2'];
        foreach($gioihanrs_top2 as $k => $v) {
            $gioihanrs_top2[$k] = abs(intval($v));
        }
    $gioihanrs_top3 = $_POST['gioihanrs_top3'];
        foreach($gioihanrs_top3 as $k => $v) {
            $gioihanrs_top3[$k] = abs(intval($v));
        }
    $gioihanrs_top4 = $_POST['gioihanrs_top4'];
        foreach($gioihanrs_top4 as $k => $v) {
            $gioihanrs_top4[$k] = abs(intval($v));
        }
        
    
    $gioihanrs_top10 = $_POST['gioihanrs_top10'];
        foreach($gioihanrs_top10 as $k => $v) {
            $gioihanrs_top10[$k] = abs(intval($v));
        }
            
	$gioihanrs_top20 = $_POST['gioihanrs_top20'];		
        foreach($gioihanrs_top20 as $k => $v) {
            $gioihanrs_top20[$k] = abs(intval($v));
        }
            
	$gioihanrs_top30 = $_POST['gioihanrs_top30'];		
        foreach($gioihanrs_top30 as $k => $v) {
            $gioihanrs_top30[$k] = abs(intval($v));
        }
            
	$gioihanrs_top40 = $_POST['gioihanrs_top40'];		
        foreach($gioihanrs_top40 as $k => $v) {
            $gioihanrs_top40[$k] = abs(intval($v));
        }
            
	$gioihanrs_top50 = $_POST['gioihanrs_top50'];		
        foreach($gioihanrs_top50 as $k => $v) {
            $gioihanrs_top50[$k] = abs(intval($v));
        }
            
	$gioihanrs_other = $_POST['gioihanrs_other'];		
        foreach($gioihanrs_other as $k => $v) {
            $gioihanrs_other[$k] = abs(intval($v));
        }
    
    $overrs_sat_extra = $_POST['overrs_sat_extra'];		
        foreach($overrs_sat_extra as $k => $v) {
            $overrs_sat_extra[$k] = abs(intval($v));
        }
    
    $overrs_sun_extra = $_POST['overrs_sun_extra'];		
        foreach($overrs_sun_extra as $k => $v) {
            $overrs_sun_extra[$k] = abs(intval($v));
        }
    
    $use_overrs = $_POST['use_overrs'];		
        foreach($use_overrs as $k => $v) {
            $use_overrs[$k] = abs(intval($v));
        }
            
    $overrs_rs = $_POST['overrs_rs'];		
        foreach($overrs_rs as $k => $v) {
            $overrs_rs[$k] = abs(intval($v));
        }
            
    $overrs_gcoin = $_POST['overrs_gcoin'];		
        foreach($overrs_gcoin as $k => $v) {
            $overrs_gcoin[$k] = abs(intval($v));
        }
    foreach($use_gioihanrs as $k => $v) {
        $content .= "\$use_gioihanrs[$k]	= $use_gioihanrs[$k];\n";
        $content .= "\$gioihanrs_top1[$k]	= $gioihanrs_top1[$k];\n";
        $content .= "\$gioihanrs_top2[$k]	= $gioihanrs_top2[$k];\n";
        $content .= "\$gioihanrs_top3[$k]	= $gioihanrs_top3[$k];\n";
        $content .= "\$gioihanrs_top4[$k]	= $gioihanrs_top4[$k];\n";
        $content .= "\$gioihanrs_top10[$k]	= $gioihanrs_top10[$k];\n";
        $content .= "\$gioihanrs_top20[$k]	= $gioihanrs_top20[$k];\n";
        $content .= "\$gioihanrs_top30[$k]	= $gioihanrs_top30[$k];\n";
        $content .= "\$gioihanrs_top40[$k]	= $gioihanrs_top40[$k];\n";
        $content .= "\$gioihanrs_top50[$k]	= $gioihanrs_top50[$k];\n";
        $content .= "\$gioihanrs_other[$k]	= $gioihanrs_other[$k];\n";
        $content .= "\$overrs_sat_extra[$k]	= $overrs_sat_extra[$k];\n";
        $content .= "\$overrs_sun_extra[$k]	= $overrs_sun_extra[$k];\n";
        $content .= "\$use_overrs[$k]	= $use_overrs[$k];\n";
        $content .= "\$overrs_rs[$k]	= $overrs_rs[$k];\n";
        $content .= "\$overrs_gcoin[$k]	= $overrs_gcoin[$k];\n";
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
include('config/config_thehe.php');
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Giới hạn Reset</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
            <font color='blue'><strong>Chức năng cần LIC</strong></font><br /><br />
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<?php 
                    for($i=1; $i<count($thehe_choise); $i++) { 
                        if(strlen($thehe_choise[$i]) > 0) {
                ?>
                    - Sử dụng Giới hạn Reset <strong><font color="red"><?php echo $thehe_choise[$i]; ?></font></strong>: 
						Không <input name="use_gioihanrs[<?php echo $i; ?>]" type="radio" value="0" <?php if($use_gioihanrs[$i]==0) echo "checked='checked'"; ?>/>
						Có <input name="use_gioihanrs[<?php echo $i; ?>]" type="radio" value="1" <?php if($use_gioihanrs[$i]==1) echo "checked='checked'"; ?>/>
					<br /><br />
					<table width="100%" border="0" bgcolor="#9999FF">
					  <tr bgcolor="#FFFFFF">
					    <td align="center" rowspan="2"><b>TOP</b></td>
					    <td align="center" colspan="3"> <strong>Giới hạn số lần Reset tối đa / ngày</strong></td>
					  </tr>
                      
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>Thứ 2 - Thứ 6</b></td>
                        <td align="center"><b>Thứ 7</b></td>
                        <td align="center"><b>Chủ Nhật</b></td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 1</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top1[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top1[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top1[$i]+floor($gioihanrs_top1[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top1[$i]+floor($gioihanrs_top1[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
                      
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 2</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top2[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top2[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top2[$i]+floor($gioihanrs_top2[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top2[$i]+floor($gioihanrs_top2[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 3</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top3[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top3[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top3[$i]+floor($gioihanrs_top3[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top3[$i]+floor($gioihanrs_top3[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 4</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top4[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top4[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top4[$i]+floor($gioihanrs_top4[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top4[$i]+floor($gioihanrs_top4[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
                      <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 5-10</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top10[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top10[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top10[$i]+floor($gioihanrs_top10[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top10[$i]+floor($gioihanrs_top10[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 11-20</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top20[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top20[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top20[$i]+floor($gioihanrs_top20[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top20[$i]+floor($gioihanrs_top20[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 21-30</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top30[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top30[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top30[$i]+floor($gioihanrs_top30[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top30[$i]+floor($gioihanrs_top30[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 31-40</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top40[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top40[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top40[$i]+floor($gioihanrs_top40[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top40[$i]+floor($gioihanrs_top40[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP 41-50</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_top50[<?php echo $i; ?>]" value="<?php echo $gioihanrs_top50[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top50[$i]+floor($gioihanrs_top50[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_top50[$i]+floor($gioihanrs_top50[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>
					  
					  <tr bgcolor="#FFFFFF">
					    <td align="center"><b>TOP > 50</b></td>
					    <td align="center">Reset tối đa <input type="text" name="gioihanrs_other[<?php echo $i; ?>]" value="<?php echo $gioihanrs_other[$i]; ?>" size="1"/> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_other[$i]+floor($gioihanrs_other[$i] * $overrs_sat_extra[$i]/100); ?> lần/ngày</td>
                        <td align="center"><?php echo $gioihanrs_other[$i]+floor($gioihanrs_other[$i] * $overrs_sun_extra[$i]/100); ?> lần/ngày</td>
					  </tr>

					</table>
                    <br />
                    - Thứ 7 tăng giới hạn Reset thêm : <input name="overrs_sat_extra[<?php echo $i; ?>]" id="overrs_sat_extra" value="<?php echo $overrs_sat_extra[$i]; ?>" size="1" /> % <br />
                    - Chủ nhật tăng giới hạn Reset thêm : <input name="overrs_sun_extra[<?php echo $i; ?>]" id="overrs_sun_extra" value="<?php echo $overrs_sun_extra[$i]; ?>" size="1" /> % <br />
                    
                    <br /><br />
                    - Sử dụng Reset Vượt mức : 
						Không <input name="use_overrs[<?php echo $i; ?>]" type="radio" value="0" <?php if($use_overrs[$i]==0) echo "checked='checked'"; ?>/>
						Có <input name="use_overrs[<?php echo $i; ?>]" type="radio" value="1" <?php if($use_overrs[$i]==1) echo "checked='checked'"; ?>/>
					<br />
                    Số lần Reset vượt mức cho phép : <input name="overrs_rs[<?php echo $i; ?>]" id="overrs_rs" value="<?php echo $overrs_rs[$i]; ?>" /><br />
                    Gcoin cần thêm khi Reset vượt mức : <input name="overrs_gcoin[<?php echo $i; ?>]" id="overrs_gcoin" value="<?php echo $overrs_gcoin[$i]; ?>" />
                    <hr />
                <?php } } ?>
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
	  
