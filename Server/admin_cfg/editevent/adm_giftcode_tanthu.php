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
 
$file_edit = 'config/config_giftcode_tanthu.php';
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
	
	$giftcode_tanthu_use = $_POST['giftcode_tanthu_use'];		
        $giftcode_tanthu_use = abs(intval($giftcode_tanthu_use));
            $content .= "\$giftcode_tanthu_use	= '$giftcode_tanthu_use';\n";

	$gift_dw = $_POST['gift_dw'];
        $gift_dw = strtoupper($gift_dw);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_dw))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DW</strong> : $gift_dw . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_dw) < 32 || strlen($gift_dw)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DW</strong>  : $gift_dw sai cấu trúc.<br />";
        }
    		$content .= "\$gift_dw	= '$gift_dw';\n";
	$msg_dw = $_POST['msg_dw'];    $msg_dw = htmlspecialchars($msg_dw, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_dw	= '$msg_dw';\n";
    
    $gift_dk = $_POST['gift_dk'];
        $gift_dk = strtoupper($gift_dk);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_dk))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DK</strong> : $gift_dk . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_dk) < 32 || strlen($gift_dk)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DK</strong>  : $gift_dk sai cấu trúc.<br />";
        }
    		$content .= "\$gift_dk	= '$gift_dk';\n";
	$msg_dk = $_POST['msg_dk'];    $msg_dk = htmlspecialchars($msg_dk, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_dk	= '$msg_dk';\n";
            
    $gift_elf = $_POST['gift_elf'];
        $gift_elf = strtoupper($gift_elf);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_elf))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>ELF</strong> : $gift_elf . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_elf) < 32 || strlen($gift_elf)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>ELF</strong>  : $gift_elf sai cấu trúc.<br />";
        }
    		$content .= "\$gift_elf	= '$gift_elf';\n";
	$msg_elf = $_POST['msg_elf'];    $msg_elf = htmlspecialchars($msg_elf, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_elf	= '$msg_elf';\n";
            
    $gift_mg = $_POST['gift_mg'];
        $gift_mg = strtoupper($gift_mg);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_mg))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>MG</strong> : $gift_mg . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_mg) < 32 || strlen($gift_mg)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>MG</strong>  : $gift_mg sai cấu trúc.<br />";
        }
    		$content .= "\$gift_mg	= '$gift_mg';\n";
	$msg_mg = $_POST['msg_mg'];    $msg_mg = htmlspecialchars($msg_mg, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_mg	= '$msg_mg';\n";
            
    $gift_dl = $_POST['gift_dl'];
        $gift_dl = strtoupper($gift_dl);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_dl))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DL</strong> : $gift_dl . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_dl) < 32 || strlen($gift_dl)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>DL</strong>  : $gift_dl sai cấu trúc.<br />";
        }
    		$content .= "\$gift_dl	= '$gift_dl';\n";
	$msg_dl = $_POST['msg_dl'];    $msg_dl = htmlspecialchars($msg_dl, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_dl	= '$msg_dl';\n";
            
    $gift_sum = $_POST['gift_sum'];
        $gift_sum = strtoupper($gift_sum);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_sum))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>SUM</strong> : $gift_sum . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_sum) < 32 || strlen($gift_sum)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>SUM</strong>  : $gift_sum sai cấu trúc.<br />";
        }
    		$content .= "\$gift_sum	= '$gift_sum';\n";
	$msg_sum = $_POST['msg_sum'];    $msg_sum = htmlspecialchars($msg_sum, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_sum	= '$msg_sum';\n";
            
    $gift_rf = $_POST['gift_rf'];
        $gift_rf = strtoupper($gift_rf);
        if (!preg_match("/^[A-F0-9]*$/i", $gift_rf))
    	{
            $error .= "Dữ liệu lỗi Mã Item cho <strong>RF</strong> : $gift_rf . Chi duoc su dung ki tu a-f, A-F, so (1-9).<br />"; 
    	}
        if( strlen($gift_rf) < 32 || strlen($gift_rf)%32 != 0 ) {
            $error .= "Dữ liệu lỗi Mã Item cho <strong>RF</strong>  : $gift_rf sai cấu trúc.<br />";
        }
    		$content .= "\$gift_rf	= '$gift_rf';\n";
	$msg_rf = $_POST['msg_rf'];    $msg_rf = htmlspecialchars($msg_rf, ENT_QUOTES, 'UTF-8');
            $content .= "\$msg_rf	= '$msg_rf';\n";
    

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
				<h1>Cấu Hình GiftCode Tân thủ</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>

					<tr>
						<td width="150" align='right'>Sử dụng GiftCode Tân Thủ: </td>
						<td>
                            <select name="giftcode_tanthu_use">
                                <option value="0" <?php if($giftcode_tanthu_use == 0) echo "selected='selected'"; ?> >Không</option>
                                <option value="1" <?php if($giftcode_tanthu_use == 1) echo "selected='selected'"; ?> >Có</option>
                              </select>
                        </td>
					</tr>
					<tr>
						<td align='right'>Mã Item cho <strong>DW</strong>: </td>
						<td>
                            <input type="text" name="gift_dw" value="<?php echo $gift_dw; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_dw" value="<?php echo $msg_dw; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
					<tr>
						<td align='right'>Mã Item cho <strong>DK</strong>: </td>
						<td>
                            <input type="text" name="gift_dk" value="<?php echo $gift_dk; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_dk" value="<?php echo $msg_dk; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
					<tr>
						<td align='right'>Mã Item cho <strong>ELF</strong>: </td>
						<td>
                            <input type="text" name="gift_elf" value="<?php echo $gift_elf; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_elf" value="<?php echo $msg_elf; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr>
						<td align='right'>Mã Item cho <strong>MG</strong>: </td>
						<td>
                            <input type="text" name="gift_mg" value="<?php echo $gift_mg; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_mg" value="<?php echo $msg_mg; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr>
						<td align='right'>Mã Item cho <strong>DL</strong>: </td>
						<td>
                            <input type="text" name="gift_dl" value="<?php echo $gift_dl; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_dl" value="<?php echo $msg_dl; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr>
						<td align='right'>Mã Item cho <strong>SUM</strong>: </td>
						<td>
                            <input type="text" name="gift_sum" value="<?php echo $gift_sum; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_sum" value="<?php echo $msg_sum; ?>" size="70"/></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr>
						<td align='right'>Mã Item cho <strong>RF</strong>: </td>
						<td>
                            <input type="text" name="gift_rf" value="<?php echo $gift_rf; ?>" size="70"/><br />
                            <a href='admin/giftcode_getitem.php' target='_blank'>Hướng dẫn lấy mã phần thưởng</a>
                        </td>
					</tr>
                    <tr>
						<td align='right'>Mô tả: </td>
						<td><input type="text" name="msg_rf" value="<?php echo $msg_rf; ?>" size="70"/></td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr><td colspan="2">
                    	Để giới hạn Giao dịch, Bán Shop, Sửa tham khảo hướng dẫn bên dưới<br />
                    	<a href='http://netbanbe.net/forum/showthread.php?277-SCF-Huong-dan-cau-hinh-Item-khong-duoc-ban-khong-giao-dich-khong-sua-(Thich-hop-GiftCode-tan-thu-va-phan-thuong-VIP)&p=1152#post1152' target="_blank">Hướng dẫn cấu hình Item không thể giao dịch, không cho bán ở cửa hàng cá nhân, không cho sửa</a>
                    </td></tr>
                    	
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
	  
