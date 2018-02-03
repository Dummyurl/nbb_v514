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
 
$file_edit = 'config/config_guild_balance.php';
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
	
	$guild_maxmem 	= $_POST['guild_maxmem'];
        $guild_maxmem = abs(intval($guild_maxmem));
            if($guild_maxmem > 40) $guild_maxmem = 40;
    		$content .= "\$guild_maxmem	= $guild_maxmem;\n";
	$guild_maxmem_redurepoint 	= $_POST['guild_maxmem_redurepoint'];
        $guild_maxmem_redurepoint = abs(intval($guild_maxmem_redurepoint));
    		$content .= "\$guild_maxmem_redurepoint	= $guild_maxmem_redurepoint;\n";
	$guild_top12lm_redurepoint 	= $_POST['guild_top12lm_redurepoint'];
        $guild_top12lm_redurepoint = abs(intval($guild_top12lm_redurepoint));
    		$content .= "\$guild_top12lm_redurepoint	= $guild_top12lm_redurepoint;\n";
	/*
    $guild_top1_pl 	= $_POST['guild_top1_pl'];
        $guild_top1_pl = abs(intval($guild_top1_pl));
    		$content .= "\$guild_top1_pl	= $guild_top1_pl;\n";
	$guild_top1_chao 	= $_POST['guild_top1_chao'];
        $guild_top1_chao = abs(intval($guild_top1_chao));
    		$content .= "\$guild_top1_chao	= $guild_top1_chao;\n";
	$guild_top1_rs 	= $_POST['guild_top1_rs'];
        $guild_top1_rs = abs(intval($guild_top1_rs));
    		$content .= "\$guild_top1_rs	= $guild_top1_rs;\n";
	*/
    
    $guild_top2addpoint 	= $_POST['guild_top2addpoint'];	
        $guild_top2addpoint = abs(intval($guild_top2addpoint));
        	$content .= "\$guild_top2addpoint	= $guild_top2addpoint;\n";
	$guild_top3addpoint 	= $_POST['guild_top3addpoint'];	
        $guild_top3addpoint = abs(intval($guild_top3addpoint));
        	$content .= "\$guild_top3addpoint	= $guild_top3addpoint;\n";
	$guild_top4addpoint 	= $_POST['guild_top4addpoint'];	
        $guild_top4addpoint = abs(intval($guild_top4addpoint));
        	$content .= "\$guild_top4addpoint	= $guild_top4addpoint;\n";
	$guild_top5addpoint 	= $_POST['guild_top5addpoint'];	
        $guild_top5addpoint = abs(intval($guild_top5addpoint));
        	$content .= "\$guild_top5addpoint	= $guild_top5addpoint;\n";
	$guild_top6overaddpoint 	= $_POST['guild_top6overaddpoint'];	
        $guild_top6overaddpoint = abs(intval($guild_top6overaddpoint));
        	$content .= "\$guild_top6overaddpoint	= $guild_top6overaddpoint;\n";
	$guild_top10overaddpoint 	= $_POST['guild_top10overaddpoint'];	
        $guild_top10overaddpoint = abs(intval($guild_top10overaddpoint));
        	$content .= "\$guild_top10overaddpoint	= $guild_top10overaddpoint;\n";
	$guild_addpoint_require_mem 	= $_POST['guild_addpoint_require_mem'];	
        $guild_addpoint_require_mem = abs(intval($guild_addpoint_require_mem));
        	$content .= "\$guild_addpoint_require_mem	= $guild_addpoint_require_mem;\n";
	$guild_addpoint_require_day 	= $_POST['guild_addpoint_require_day'];	
        $guild_addpoint_require_day = abs(intval($guild_addpoint_require_day));
        	$content .= "\$guild_addpoint_require_day	= $guild_addpoint_require_day;\n";
	$guild_addpoint_require_rs 	= $_POST['guild_addpoint_require_rs'];	
        $guild_addpoint_require_rs = abs(intval($guild_addpoint_require_rs));
        	$content .= "\$guild_addpoint_require_rs	= $guild_addpoint_require_rs;\n";
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
				<h1>Cấu Hình Cân bằng Thế Lực</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					
                    <tr>
						<td colspan="2">Guild nhiều hơn <input type="text" name="guild_maxmem" value="<?php echo $guild_maxmem; ?>" size="2"/> thành viên bị trừ <input type="text" name="guild_maxmem_redurepoint" value="<?php echo $guild_maxmem_redurepoint; ?>" maxlength="2" size="2"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td colspan="2">Guild TOP 1 Hùng Mạnh Liên Minh với Guild TOP 2 Hùng Mạnh : thành viên 2 Guild bị trừ <input type="text" name="guild_top12lm_redurepoint" value="<?php echo $guild_top12lm_redurepoint; ?>" maxlength="2" size="2"/>% Point khi Reset</td>
					</tr>
                    <!--
                    <tr>
						<td colspan="2">
                            <strong>Phúc lợi hàng ngày Guild TOP 1 Hùng Mạnh</strong> :
                            <ul>
                                <li>Điểm Phúc Lợi : <input type="text" name="guild_top1_pl" value="<?php echo $guild_top1_pl; ?>" size="2"/></li>
                                <li>Ngọc Hỗn Nguyên trong ngân hàng : <input type="text" name="guild_top1_chao" value="<?php echo $guild_top1_chao; ?>" size="2"/></li>
                                <li>Điều kiện thành viên nhận thưởng : Ngày hôm trước thực hiện ít nhất <input type="text" name="guild_top1_rs" value="<?php echo $guild_top1_rs; ?>" size="2"/> lần Reset</li>
                            </ul>
                        </td>
					</tr>
                    -->
                    <tr>
                        <td colspan="2">
                            <strong>Hỗ trợ Bang Hội Yếu:</strong>
                        </td>
                    </tr>
                    <tr>
						<td width="250" align="right">Guild TOP 2 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top2addpoint" value="<?php echo $guild_top2addpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td align="right">Guild TOP 3 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top3addpoint" value="<?php echo $guild_top3addpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td align="right">Guild TOP 4 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top4addpoint" value="<?php echo $guild_top4addpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td align="right">Guild TOP 5 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top5addpoint" value="<?php echo $guild_top5addpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td align="right">Guild TOP 6-10 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top6overaddpoint" value="<?php echo $guild_top6overaddpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    <tr>
						<td align="right">Guild dưới TOP 10 hùng mạnh được thêm : </td>
						<td><input type="text" name="guild_top10overaddpoint" value="<?php echo $guild_top10overaddpoint; ?>" maxlength="2" size="5"/>% Point khi Reset</td>
					</tr>
                    
                    <tr>
						<td colspan="2" align="left">
                            <strong>Điều kiện Bang Hội yếu được nhận Point hỗ trợ khi Reset</strong>:
                            <ul>
                                <li>Số thành viên trong Bang Hội phải từ <input type="text" name="guild_addpoint_require_mem" value="<?php echo $guild_addpoint_require_mem; ?>" maxlength="2" size="5"/> trở lên</li>
                                <li>Bang Hội đã được thành lập trên <input type="text" name="guild_addpoint_require_day" value="<?php echo $guild_addpoint_require_day; ?>" maxlength="2" size="5"/> ngày</li>
                                <li>Tổng số lần thực hiện Reset của các thành viên trong ngày hôm trước phải trên <input type="text" name="guild_addpoint_require_rs" value="<?php echo $guild_addpoint_require_rs; ?>" maxlength="3" size="5"/> lần</li>
                            </ul>
                        </td>
					</tr>
					
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
	  
