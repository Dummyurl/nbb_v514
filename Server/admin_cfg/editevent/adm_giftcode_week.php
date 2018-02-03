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
 
$file_edit = 'config/config_giftcode_week.php';
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
    $error = "";
    
	$content = "<?php\n";
	
	$giftcode_week_use = $_POST['giftcode_week_use'];
        $giftcode_week_use = abs(intval($giftcode_week_use));
    		$content .= "\$giftcode_week_use	= '$giftcode_week_use';\n";
    
    $gift_reset_min = $_POST['gift_reset_min'];
        $gift_reset_min = abs(intval($gift_reset_min));
    		$content .= "\$gift_reset_min	= '$gift_reset_min';\n";
     
    $gift_week_max = $_POST['gift_week_max'];
        $gift_week_max = abs(intval($gift_week_max));
    		$content .= "\$gift_week_max	= '$gift_week_max';\n";
            
     $giftcode_week_timebegin = $_POST['giftcode_week_timebegin'];
        $giftcode_week_timebegin = abs(intval($giftcode_week_timebegin));
    		$content .= "\$giftcode_week_timebegin	= '$giftcode_week_timebegin';\n";
            
     $giftcode_week_timeend = $_POST['giftcode_week_timeend'];
        $giftcode_week_timeend = abs(intval($giftcode_week_timeend));
    		$content .= "\$giftcode_week_timeend	= '$giftcode_week_timeend';\n";          if($giftcode_week_timeend < $giftcode_week_timebegin) {
    		  $error = "Lỗi : Thời gian phát GiftCode lúc kết thúc $giftcode_week_timeend h00 phải lớn hơn lúc bắt đầu $giftcode_week_timebegin h00.";
        }
            
    $trade = $_POST['trade'];
        $trade = abs(intval($trade));
    		$content .= "\$trade	= '$trade';\n";
    
    $sell = $_POST['sell'];
        $sell = abs(intval($sell));
    		$content .= "\$sell	= '$sell';\n";
    
    $repair = $_POST['repair'];
        $repair = abs(intval($repair));
    		$content .= "\$repair	= '$repair';\n";
    
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
    
    if(strlen($error) > 0) {
        $notice = "<center><font color='red'>$error</font></center>";
    } else {
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
}

include($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình GiftCode Tuần</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr><td colspan="2">GiftCode Tuần là GiftCode mỗi tài khoản chỉ được nhận và sử dụng 1 lần trong 1 tuần</td></tr>
                    <tr>
						<td width="200" align='right'>Sử dụng GiftCode Tuần: </td>
						<td>
                            <select name="giftcode_week_use">
                                <option value="0" <?php if($giftcode_week_use == 0) echo "selected='selected'"; ?> >Không</option>
                                <option value="1" <?php if($giftcode_week_use == 1) echo "selected='selected'"; ?> >GiftCode ngẫu nhiên loại 1</option>
                                <option value="2" <?php if($giftcode_week_use == 2) echo "selected='selected'"; ?> >GiftCode ngẫu nhiên loại 2</option>
                                <option value="3" <?php if($giftcode_week_use == 3) echo "selected='selected'"; ?> >GiftCode ngẫu nhiên loại 3</option>
                              </select>
                        </td>
					</tr>
                    
                    <tr>
						<td align='right' valign="top">Reset phải từ: </td>
						<td>
                            <input type="text" name="gift_reset_min" value="<?php echo $gift_reset_min; ?>" size="10"/>
                            <br />Tài khoản phải có nhân vật Reset lớn hơn hoặc đã Relife mới được nhận GiftCode Tuần
                        </td>
					</tr>
                    
					<tr>
						<td align='right' valign="top">Số GiftCode phát tối đa trong ngày: </td>
						<td>
                            <input type="text" name="gift_week_max" value="<?php echo $gift_week_max; ?>" size="10"/>
                        </td>
					</tr>
                    
                    <tr>
						<td align='right' valign="top">Thời gian phát GiftCode: </td>
						<td>
                            Từ 
                            <select name="giftcode_week_timebegin">
                            <?php for($i=7; $i<=23; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if($giftcode_week_timebegin == $i) echo "selected='selected'"; ?> ><?php echo $i; ?>h00</option>
                            <?php } ?>
                            </select>
                            Đến 
                            <select name="giftcode_week_timeend">
                            <?php for($i=7; $i<=23; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php if($giftcode_week_timeend == $i) echo "selected='selected'"; ?> ><?php echo $i; ?>h00</option>
                            <?php } ?>
                            </select>
                        </td>
					</tr>
                    
                    <tr>
						<td align='right' valign="top">Có thể Giao dịch: </td>
						<td>
                            <select name="trade">
                                <option value="1" <?php if($trade == 1) echo "selected='selected'"; ?> >Có</option>
                                <option value="0" <?php if($trade == 0) echo "selected='selected'"; ?> >Không</option>
                            </select>
                        </td>
					</tr>
                    
                    <tr>
						<td align='right' valign="top">Có thể Bán Shop: </td>
						<td>
                            <select name="sell">
                                <option value="1" <?php if($sell == 1) echo "selected='selected'"; ?> >Có</option>
                                <option value="0" <?php if($sell == 0) echo "selected='selected'"; ?> >Không</option>
                            </select>
                        </td>
					</tr>
                    
                    <tr>
						<td align='right' valign="top">Có thể Sửa: </td>
						<td>
                            <select name="repair">
                                <option value="1" <?php if($repair == 1) echo "selected='selected'"; ?> >Có</option>
                                <option value="0" <?php if($repair == 0) echo "selected='selected'"; ?> >Không</option>
                            </select>
                        </td>
					</tr>
                    
                    <tr><td colspan="2">
                    	Để giới hạn Giao dịch, Bán Shop, Sửa tham khảo hướng dẫn bên dưới<br />
                    	<a href='http://netbanbe.net/forum/showthread.php?277-SCF-Huong-dan-cau-hinh-Item-khong-duoc-ban-khong-giao-dich-khong-sua-(Thich-hop-GiftCode-tan-thu-va-phan-thuong-VIP)&p=1152#post1152' target="_blank">Hướng dẫn cấu hình Item không thể giao dịch, không cho bán ở cửa hàng cá nhân, không cho sửa</a>
                    </td></tr>
                    	
					<tr><td colspan="2"><hr></td></tr>

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
	  
