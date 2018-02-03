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
 
$file_edit = 'config/config_event.php';
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
	
    $event_epitem_name = $_POST['event_epitem_name'];		$content .= "\$event_epitem_name	= '$event_epitem_name';\n";
	$event_epitem_on = $_POST['event_epitem_on'];			$content .= "\$event_epitem_on	= $event_epitem_on;\n";
    $event_epitem_begin = $_POST['event_epitem_begin'];	$content .= "\$event_epitem_begin	= '$event_epitem_begin';\n";
	$event_epitem_end = $_POST['event_epitem_end'];	$content .= "\$event_epitem_end	= '$event_epitem_end';\n";
    
	$event_epitem_exlmin_begin = $_POST['event_epitem_exlmin_begin'];
        $event_epitem_exlmin_begin = abs(intval($event_epitem_exlmin_begin));
    		$content .= "\$event_epitem_exlmin_begin	= $event_epitem_exlmin_begin;\n";
	$event_epitem_exlmax_begin = $_POST['event_epitem_exlmax_begin'];
        $event_epitem_exlmax_begin = abs(intval($event_epitem_exlmax_begin));
    		$content .= "\$event_epitem_exlmax_begin	= $event_epitem_exlmax_begin;\n";
    $event_epitem_lvlmin_begin = $_POST['event_epitem_lvlmin_begin'];
        $event_epitem_lvlmin_begin = abs(intval($event_epitem_lvlmin_begin));
    		$content .= "\$event_epitem_lvlmin_begin	= $event_epitem_lvlmin_begin;\n";
	$event_epitem_lvlmax_begin = $_POST['event_epitem_lvlmax_begin'];
        $event_epitem_lvlmax_begin = abs(intval($event_epitem_lvlmax_begin));
    		$content .= "\$event_epitem_lvlmax_begin	= $event_epitem_lvlmax_begin;\n";
    
    $event_epitem_exlmin_end = $_POST['event_epitem_exlmin_end'];
        $event_epitem_exlmin_end = abs(intval($event_epitem_exlmin_end));
    		$content .= "\$event_epitem_exlmin_end	= $event_epitem_exlmin_end;\n";
	$event_epitem_exlmax_end = $_POST['event_epitem_exlmax_end'];
        $event_epitem_exlmax_end = abs(intval($event_epitem_exlmax_end));
    		$content .= "\$event_epitem_exlmax_end	= $event_epitem_exlmax_end;\n";
    $event_epitem_lvlmin_end = $_POST['event_epitem_lvlmin_end'];
        $event_epitem_lvlmin_end = abs(intval($event_epitem_lvlmin_end));
    		$content .= "\$event_epitem_lvlmin_end	= $event_epitem_lvlmin_end;\n";
	$event_epitem_lvlmax_end = $_POST['event_epitem_lvlmax_end'];
        $event_epitem_lvlmax_end = abs(intval($event_epitem_lvlmax_end));
    		$content .= "\$event_epitem_lvlmax_end	= $event_epitem_lvlmax_end;\n";
             
	$event_bongda_name = $_POST['event_bongda_name'];		$content .= "\$event_bongda_name	= '$event_bongda_name';\n";
	$event_bongda_on = $_POST['event_bongda_on'];			$content .= "\$event_bongda_on	= $event_bongda_on;\n";
	$event_bongda_giai1 = $_POST['event_bongda_giai1'];
        $event_bongda_giai1 = abs(intval($event_bongda_giai1));
    		$content .= "\$event_bongda_giai1	= $event_bongda_giai1;\n";
	$event_bongda_giai2 = $_POST['event_bongda_giai2'];
        $event_bongda_giai2 = abs(intval($event_bongda_giai2));
    		$content .= "\$event_bongda_giai2	= $event_bongda_giai2;\n";
	$event_bongda_giai3 = $_POST['event_bongda_giai3'];
        $event_bongda_giai3 = abs(intval($event_bongda_giai3));
    		$content .= "\$event_bongda_giai3	= $event_bongda_giai3;\n";

	$event1_on = $_POST['event1_on'];		$content .= "\$event1_on	= $event1_on;\n";
	$event1_name = $_POST['event1_name'];	$content .= "\$event1_name	= '$event1_name';\n";
	
	$event_santa_ticket = $_POST['event_santa_ticket'];
        $event_santa_ticket = abs(intval($event_santa_ticket));
    		$content .= "\$event_santa_ticket	= $event_santa_ticket;\n";
	$event_santa_ticket_name = $_POST['event_santa_ticket_name'];	$content .= "\$event_santa_ticket_name	= '$event_santa_ticket_name';\n";
	
	$event_toprs_on = $_POST['event_toprs_on'];		$content .= "\$event_toprs_on	= $event_toprs_on;\n";
	$event_toprs_name = $_POST['event_toprs_name'];	$content .= "\$event_toprs_name	= '$event_toprs_name';\n";
	$event_toprs_begin = $_POST['event_toprs_begin'];	$content .= "\$event_toprs_begin	= '$event_toprs_begin';\n";
	$event_toprs_end = $_POST['event_toprs_end'];	$content .= "\$event_toprs_end	= '$event_toprs_end';\n";
	
	$event_toppoint_on = $_POST['event_toppoint_on'];		$content .= "\$event_toppoint_on	= $event_toppoint_on;\n";
	$event_toppoint_name = $_POST['event_toppoint_name'];	$content .= "\$event_toppoint_name	= '$event_toppoint_name';\n";
	$event_toppoint_begin = $_POST['event_toppoint_begin'];	$content .= "\$event_toppoint_begin	= '$event_toppoint_begin';\n";
	$event_toppoint_end = $_POST['event_toppoint_end'];	$content .= "\$event_toppoint_end	= '$event_toppoint_end';\n";
	
	$event_topcard_on = $_POST['event_topcard_on'];		$content .= "\$event_topcard_on	= $event_topcard_on;\n";
	$event_topcard_name = $_POST['event_topcard_name'];	$content .= "\$event_topcard_name	= '$event_topcard_name';\n";
	$event_topcard_begin = $_POST['event_topcard_begin'];	$content .= "\$event_topcard_begin	= '$event_topcard_begin';\n";
	$event_topcard_end = $_POST['event_topcard_end'];	$content .= "\$event_topcard_end	= '$event_topcard_end';\n";
    
    $hotroitem_on = $_POST['hotroitem_on'];		$content .= "\$hotroitem_on	= $hotroitem_on;\n";
	$hotroitem_name = $_POST['hotroitem_name'];	$content .= "\$hotroitem_name	= '$hotroitem_name';\n";;
    
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
				<h1>Cấu Hình Event</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<!-- Event Ép Item -->
					<tr><td colspan="2"><b>Event : Ép Item</b> - <font color='red'><strong>Chức năng VIP</strong></font></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_epitem_name" value="<?php echo $event_epitem_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td width="100">Thời gian Event: </td>
						<td>0h00 <input type="text" name="event_epitem_begin" id="event_epitem_begin" value="<?php echo $event_epitem_begin; ?>" size="10" maxlength="10" /> - 24h00 <input type="text" name="event_epitem_end" id="event_epitem_end" value="<?php echo $event_epitem_end; ?>" size="10" maxlength="10" /><br>
						<b>Lưu ý</b> : ghi chính xác dạng thời gian <b>năm-tháng-ngày</b> (YYYY-MM-DD)
						</td>
					</tr>
                    <tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_epitem_on" id="event_epitem_on" type="radio" value="0" <?php if($event_epitem_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event_epitem_on" type="radio" value="1" <?php if($event_epitem_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
					
                    <tr>
						<td width="100" colspan="2"><strong>Điều kiện Item đăng ký</strong>: </td>
					</tr>
                    <tr>
						<td width="100">Dòng hoàn hảo : </td>
						<td>từ <input type="text" name="event_epitem_exlmin_begin" value="<?php echo $event_epitem_exlmin_begin; ?>" size="2"/> đến <input type="text" name="event_epitem_exlmax_begin" value="<?php echo $event_epitem_exlmax_begin; ?>" size="2"/> <i>(Số dòng hoàn hảo của Item cho phép đăng ký)</i></td>
					</tr>
					<tr>
						<td width="100">Cấp độ Item: </td>
						<td>từ <input type="text" name="event_epitem_lvlmin_begin" value="<?php echo $event_epitem_lvlmin_begin; ?>" size="2"/> đến <input type="text" name="event_epitem_lvlmax_begin" value="<?php echo $event_epitem_lvlmax_begin; ?>" size="2"/> <i>(Cấp độ Item của Item cho phép đăng ký)</i></td>
					</tr>
                    
                    <tr>
						<td width="100" colspan="2"><strong>Điều kiện Item hoàn thành</strong>: </td>
					</tr>
                    <tr>
						<td width="100">Dòng hoàn hảo : </td>
						<td>từ <input type="text" name="event_epitem_exlmin_end" value="<?php echo $event_epitem_exlmin_end; ?>" size="2"/> đến <input type="text" name="event_epitem_exlmax_end" value="<?php echo $event_epitem_exlmax_end; ?>" size="2"/> <i>(Số dòng hoàn hảo của Item cho phép hoàn thành)</i></td>
					</tr>
					<tr>
						<td width="100">Cấp độ Item: </td>
						<td>từ <input type="text" name="event_epitem_lvlmin_end" value="<?php echo $event_epitem_lvlmin_end; ?>" size="2"/> đến <input type="text" name="event_epitem_lvlmax_end" value="<?php echo $event_epitem_lvlmax_end; ?>" size="2"/> <i>(Cấp độ của Item cho phép hoàn thành)</i></td>
					</tr>
                    
					<tr><td colspan="2"><hr></td></tr>
                    
                    <!-- Event dự đoán bóng đá -->
					<tr><td colspan="2"><b>Event : Dự đoán bóng đá</b></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_bongda_name" value="<?php echo $event_bongda_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_bongda_on" type="radio" value="0" <?php if($event_bongda_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event_bongda_on" type="radio" value="1" <?php if($event_bongda_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr>
						<td width="100">Giải nhất: </td>
						<td><input type="text" name="event_bongda_giai1" value="<?php echo $event_bongda_giai1; ?>" size="10"/> Vpoint</td>
					</tr>
					<tr>
						<td width="100">Giải nhì: </td>
						<td><input type="text" name="event_bongda_giai2" value="<?php echo $event_bongda_giai2; ?>" size="10"/> Vpoint</td>
					</tr>
					<tr>
						<td width="100">Giải ba: </td>
						<td><input type="text" name="event_bongda_giai3" value="<?php echo $event_bongda_giai3; ?>" size="10"/> Vpoint</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<!-- Event Đổi vé làng Santa lấy Vpoint -->
					<tr><td colspan="2"><b>Event : Đổi vé làng Santa -> VPoint</b> - <font color='blue'><strong>Chức năng cần LIC</strong></font></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_santa_ticket_name" value="<?php echo $event_santa_ticket_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_santa_ticket" type="radio" value="0" <?php if($event_santa_ticket==0) echo "checked='checked'"; ?>/>
						Có <input name="event_santa_ticket" type="radio" value="1" <?php if($event_santa_ticket==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
                    <!-- Event Đổi Item lấy Vpoint -->
					<tr><td colspan="2"><b>Event : Đổi Item -> Point</b> - <font color='blue'><strong>Chức năng cần LIC</strong></font></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event1_name" value="<?php echo $event1_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event1_on" type="radio" value="0" <?php if($event1_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event1_on" type="radio" value="1" <?php if($event1_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
					
					
					<tr><td colspan="2"><b>Event : TOP  Đổi Item -> Point trong 1 khoảng thời gian</b></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_toppoint_name" value="<?php echo $event_toppoint_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td width="100">Thời gian Event: </td>
						<td>0h00 <input type="text" name="event_toppoint_begin" id="event_toppoint_begin" value="<?php echo $event_toppoint_begin; ?>" size="10" maxlength="10" /> - 24h00 <input type="text" name="event_toppoint_end" id="event_toppoint_end" value="<?php echo $event_toppoint_end; ?>" size="10" maxlength="10" /> <br>
						<b>Lưu ý</b> : ghi chính xác dạng thời gian <b>năm-tháng-ngày</b> (YYYY-MM-DD)
						</td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_toppoint_on" type="radio" value="0" <?php if($event_toppoint_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event_toppoint_on" type="radio" value="1" <?php if($event_toppoint_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<!-- Event TOP Nạp thẻ -->
					<tr><td colspan="2"><b>Event : TOP  Nạp thẻ</b></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_topcard_name" value="<?php echo $event_topcard_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td width="100">Thời gian Event: </td>
						<td>0h00 <input type="text" name="event_topcard_begin" id="event_topcard_begin" value="<?php echo $event_topcard_begin; ?>" size="10" maxlength="10" />  - 24h00 <input type="text" name="event_topcard_end" id="event_topcard_end" value="<?php echo $event_topcard_end; ?>" size="10" maxlength="10" /> <br>
						<b>Lưu ý</b> : ghi chính xác dạng thời gian <b>năm-tháng-ngày</b> (YYYY-MM-DD)
						</td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_topcard_on" type="radio" value="0" <?php if($event_topcard_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event_topcard_on" type="radio" value="1" <?php if($event_topcard_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <!-- Event TOP Reset trong 1 khoảng thời gian -->
					<tr><td colspan="2"><b>Event : TOP  Reset trong 1 khoảng thời gian</b></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="event_toprs_name" value="<?php echo $event_toprs_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td width="100">Thời gian Event: </td>
						<td>0h00 <input type="text" name="event_toprs_begin" id="event_toprs_begin" value="<?php echo $event_toprs_begin; ?>" size="10" maxlength="10" /> - 24h00 <input type="text" name="event_toprs_end" id="event_toprs_end" value="<?php echo $event_toprs_end; ?>" size="10" maxlength="10" /><br>
						<b>Lưu ý</b> : ghi chính xác dạng thời gian <b>năm-tháng-ngày</b> (YYYY-MM-DD)
						</td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="event_toprs_on" type="radio" value="0" <?php if($event_toprs_on==0) echo "checked='checked'"; ?>/>
						Có <input name="event_toprs_on" type="radio" value="1" <?php if($event_toprs_on==1) echo "checked='checked'"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
                    
                    <!-- Hỗ trợ Item tham gia Event -->
					<tr><td colspan="2"><b>Hỗ trợ Item tham gia Event</b></td></tr>
					<tr>
						<td width="100">Tên Event: </td>
						<td><input type="text" name="hotroitem_name" value="<?php echo $hotroitem_name; ?>" size="50"/></td>
					</tr>
					<tr>
						<td>Sử dụng: </td>
						<td>Không <input name="hotroitem_on" type="radio" value="0" <?php if($hotroitem_on==0) echo "checked='checked'"; ?>/>
						Có <input name="hotroitem_on" type="radio" value="1" <?php if($hotroitem_on==1) echo "checked='checked'"; ?>/></td>
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
	  
