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
 
$file_edit = 'config/config_napthe.php';
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
	
	$menhgia10000 = $_POST['menhgia10000'];
        $menhgia10000 = abs(intval($menhgia10000));
    		$content .= "\$menhgia10000	= $menhgia10000;\n";
	$menhgia20000 = $_POST['menhgia20000'];
        $menhgia20000 = abs(intval($menhgia20000));
    		$content .= "\$menhgia20000	= $menhgia20000;\n";
	$menhgia30000 = $_POST['menhgia30000'];
        $menhgia30000 = abs(intval($menhgia30000));
    		$content .= "\$menhgia30000	= $menhgia30000;\n";
	$menhgia50000 = $_POST['menhgia50000'];
        $menhgia50000 = abs(intval($menhgia50000));
    		$content .= "\$menhgia50000	= $menhgia50000;\n";
	$menhgia100000 = $_POST['menhgia100000'];
        $menhgia100000 = abs(intval($menhgia100000));
    	   $content .= "\$menhgia100000	= $menhgia100000;\n";
	$menhgia200000 = $_POST['menhgia200000'];
        $menhgia200000 = abs(intval($menhgia200000));
    	   $content .= "\$menhgia200000	= $menhgia200000;\n";
	$menhgia300000 = $_POST['menhgia300000'];
        $menhgia300000 = abs(intval($menhgia300000));
    	   $content .= "\$menhgia300000	= $menhgia300000;\n";
	$menhgia500000 = $_POST['menhgia500000'];
        $menhgia500000 = abs(intval($menhgia500000));
    	   $content .= "\$menhgia500000	= $menhgia500000;\n";
	
		//Khống chế số lần nạp Card trong ngày
	$reset_1 = $_POST['reset_1'];
        $reset_1 = abs(intval($reset_1));
    				$content .= "\$reset_1	= $reset_1;\n";
	$slg_card_1 = $_POST['slg_card_1'];
        $slg_card_1 = abs(intval($slg_card_1));
    			$content .= "\$slg_card_1	= $slg_card_1;\n";
	
	$reset_2 = $_POST['reset_2'];
        $reset_2 = abs(intval($reset_2));
    				$content .= "\$reset_2	= $reset_2;\n";
	$slg_card_2 = $_POST['slg_card_2'];
        $slg_card_2 = abs(intval($slg_card_2));
    			$content .= "\$slg_card_2	= $slg_card_2;\n";
	
	$reset_3 = $_POST['reset_3'];
        $reset_3 = abs(intval($reset_3));
    				$content .= "\$reset_3	= $reset_3;\n";
	$slg_card_3 = $_POST['slg_card_3'];
        $slg_card_3 = abs(intval($slg_card_3));
    			$content .= "\$slg_card_3	= $slg_card_3;\n";
	
	$reset_4 = $_POST['reset_4'];
        $reset_4 = abs(intval($reset_4));
    				$content .= "\$reset_4	= $reset_4;\n";
	$slg_card_4 = $_POST['slg_card_4'];
        $slg_card_4 = abs(intval($slg_card_4));
    			$content .= "\$slg_card_4	= $slg_card_4;\n";
	
	$slg_card_max = $_POST['slg_card_max'];
        $slg_card_max = abs(intval($slg_card_max));
    		$content .= "\$slg_card_max	= $slg_card_max;\n";
	
		//Khuyến mại từng loại thẻ so với mặt bằng chung
    $khuyenmai_gate = $_POST['khuyenmai_gate'];
        $khuyenmai_gate = abs(intval($khuyenmai_gate));
    	   $content .= "\$khuyenmai_gate	= $khuyenmai_gate;\n";
	$khuyenmai_vtc = $_POST['khuyenmai_vtc'];
        $khuyenmai_vtc = abs(intval($khuyenmai_vtc));
    	   $content .= "\$khuyenmai_vtc	= $khuyenmai_vtc;\n";
		
		//Khuyến mại nạp V.Point
	$khuyenmai = $_POST['khuyenmai'];			$content .= "\$khuyenmai	= $khuyenmai;\n";
	$khuyenmai_phantram = $_POST['khuyenmai_phantram'];
        $khuyenmai_phantram = abs(intval($khuyenmai_phantram));
    	   $content .= "\$khuyenmai_phantram	= $khuyenmai_phantram;\n";
	
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
				<h1>Cấu Hình Nạp thẻ</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr>
						<td width="100">Thẻ 10.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia10000" value="<?php echo $menhgia10000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 20.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia20000" value="<?php echo $menhgia20000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 30.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia30000" value="<?php echo $menhgia30000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 50.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia50000" value="<?php echo $menhgia50000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 100.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia100000" value="<?php echo $menhgia100000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 200.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia200000" value="<?php echo $menhgia200000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 300.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia300000" value="<?php echo $menhgia300000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr>
						<td width="100">Thẻ 500.000 VNĐ : </td>
						<td><div style="float: left;"><input type="text" name="menhgia500000" value="<?php echo $menhgia500000; ?>" size="10"/></div> Gcoin</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr><td colspan="2"><b>Khống chế số lần nạp thẻ trong ngày</b><br>
					- Reset < <input type="text" name="reset_1" value="<?php echo $reset_1; ?>" size="3"/> được Nạp tối đa <input type="text" name="slg_card_1" value="<?php echo $slg_card_1; ?>" size="3"/> thẻ / ngày<br>
					- Reset < <input type="text" name="reset_2" value="<?php echo $reset_2; ?>" size="3"/> được Nạp tối đa <input type="text" name="slg_card_2" value="<?php echo $slg_card_2; ?>" size="3"/> thẻ / ngày<br>
					- Reset < <input type="text" name="reset_3" value="<?php echo $reset_3; ?>" size="3"/> được Nạp tối đa <input type="text" name="slg_card_3" value="<?php echo $slg_card_3; ?>" size="3"/> thẻ / ngày<br>
					- Reset < <input type="text" name="reset_4" value="<?php echo $reset_4; ?>" size="3"/> được Nạp tối đa <input type="text" name="slg_card_4" value="<?php echo $slg_card_4; ?>" size="3"/> thẻ / ngày<br>
					- Số thẻ nạp Tối đa : <input type="text" name="slg_card_max" value="<?php echo $slg_card_max; ?>" size="3"/> thẻ / ngày<br>
					<br>
					* Thẻ GATE nạp nhiều hơn so với thẻ Viettel, Mobi, Vina <input type="text" name="khuyenmai_gate" value="<?php echo $khuyenmai_gate; ?>" size="3"/> %
					<br>
                    * Thẻ VTC nạp nhiều hơn so với thẻ Viettel, Mobi, Vina <input type="text" name="khuyenmai_vtc" value="<?php echo $khuyenmai_vtc; ?>" size="3"/> %
					<br><br>
					
					<b>Khuyến mại nạp Gcoin : </b>
					Tắt <input name="khuyenmai" type="radio" value="0" <?php if($khuyenmai==0) echo "checked='checked'"; ?>/> 
					Bật <input name="khuyenmai" type="radio" value="1" <?php if($khuyenmai==1) echo "checked='checked'"; ?>/>
					<br>
					Tỷ lệ khuyến mại : <input type="text" name="khuyenmai_phantram" value="<?php echo $khuyenmai_phantram; ?>" size="3"/> %
						
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
	  
