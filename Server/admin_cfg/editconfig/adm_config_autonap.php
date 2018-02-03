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
 
$file_edit = 'config_autonap.php';
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
	
	$auto_gate = $_POST['auto_gate'];			
        if(!isset($auto_gate)) $auto_gate = 'false';
        $content .= "\$auto_gate	= $auto_gate;\n";
    $gate_doitac = $_POST['gate_doitac'];			$content .= "\$gate_doitac	= '$gate_doitac';\n";
    
    $auto_vtc = $_POST['auto_vtc'];			
        if(!isset($auto_vtc)) $auto_vtc = 'false';
        $content .= "\$auto_vtc	= $auto_vtc;\n";
    $vtc_doitac = $_POST['vtc_doitac'];			$content .= "\$vtc_doitac	= '$vtc_doitac';\n";
    
    $telcard_use = $_POST['telcard_use'];			
        if(!isset($telcard_use)) $telcard_use = 'false';
        $content .= "\$telcard_use	= $telcard_use;\n";
    $telcard_doitac = $_POST['telcard_doitac'];			$content .= "\$telcard_doitac	= '$telcard_doitac';\n";
    
    $accgate = $_POST['accgate'];			$content .= "\$accgate	= '$accgate';\n";
    
    $accvtc = $_POST['accvtc'];			$content .= "\$accvtc	= '$accvtc';\n";
    
    $ketnoipay_partnerid = $_POST['ketnoipay_partnerid'];			$content .= "\$ketnoipay_partnerid	= '$ketnoipay_partnerid';\n";
    $ketnoipay_signal = $_POST['ketnoipay_signal'];			$content .= "\$ketnoipay_signal	= '$ketnoipay_signal';\n";
    
    $secure_pass = $_POST['secure_pass'];			$content .= "\$secure_pass	= '$secure_pass';\n";
    $merchant_id = $_POST['merchant_id'];			$content .= "\$merchant_id	= '$merchant_id';\n";
    $username_bk = $_POST['username_bk'];			$content .= "\$username_bk	= '$username_bk';\n";
    $password_bk = $_POST['password_bk'];			$content .= "\$password_bk	= '$password_bk';\n";
    
    $teknet_cpid = $_POST['teknet_cpid'];			$content .= "\$teknet_cpid	= '$teknet_cpid';\n";
    $teknet_key = $_POST['teknet_key'];			$content .= "\$teknet_key	= '$teknet_key';\n";
    $getcontent_url_sendcard = $_POST['getcontent_url_sendcard'];			$content .= "\$getcontent_url_sendcard	= '$getcontent_url_sendcard';\n";
    
	$content .= "?>";
	
	require_once('admin_cfg/function.php');
	replacecontent($file_edit,$content);
	
	$notice = "<center><font color='red'>Sửa thành công</font></center>";
}

include($file_edit);
?>
		<div id="center-column">
			<div class="top-bar">
				<h1>Auto Nạp Thẻ</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr><td colspan="2"><strong>Tự động nạp thẻ GATE</strong></td></tr>
                    <tr>
						<td width="150" align='right' valign='top'>Sử dụng tự động nạp thẻ GATE: </td>
						<td>
                            <input type="checkbox" name="auto_gate" value="true" <?php if($auto_gate == true) echo "checked"; ?>/>
                        </td>
                    </tr>
                    <tr>
                        <td align='right' valign='top'>Nạp thẻ GATE vào: </td>
						<td>
                            <select name="gate_doitac">
                                <option value="KETNOIPAY" <?php if($gate_doitac == 'KETNOIPAY') echo "selected='selected'"; ?> >KETNOIPAY - ketnoipay.com</option>
                                <option value="GATE" <?php if($gate_doitac == 'GATE') echo "selected='selected'"; ?> >GATE - pay.gate.vn</option>
                            </select>
                        </td>
					</tr>
                    
                    <tr><td colspan="2"><strong>Tự động nạp thẻ VTC</strong></td></tr>
                    <tr>
						<td align='right' valign='top'>Sử dụng tự động nạp thẻ VTC: </td>
						<td>
                            <input type="checkbox" name="auto_vtc" value="true" <?php if($auto_vtc == true) echo "checked"; ?>/>
                        </td>
                    </tr>
                    <tr>
                        <td align='right' valign='top'>Nạp thẻ VTC vào: </td>
						<td>
                            <select name="vtc_doitac">
                                <option value="KETNOIPAY" <?php if($vtc_doitac == 'KETNOIPAY') echo "selected='selected'"; ?> >KETNOIPAY - ketnoipay.com</option>
                                <option value="VTC" <?php if($vtc_doitac == 'VTC') echo "selected='selected'"; ?> >VTC - ebank.vtc.vn</option>
                            </select>
                        </td>
					</tr>
                    
                    <tr><td colspan="2"><strong>Tự động nạp thẻ Điện thoại : VinaPhone, MobiPhone, Viettel</strong></td></tr>
                    <tr>
						<td align='right' valign='top'>Sử dụng tự động nạp thẻ Điện Thoại: </td>
						<td>
                            <input type="checkbox" name="telcard_use" value="true" <?php if($telcard_use == true) echo "checked"; ?>/>
                        </td>
                    </tr>
                    <tr>
                        <td align='right' valign='top'>Nạp thẻ Điện thoại vào: </td>
						<td>
                            <select name="telcard_doitac">
                                <option value="KETNOIPAY" <?php if($telcard_doitac == 'KETNOIPAY') echo "selected='selected'"; ?> >KETNOIPAY - ketnoipay.com</option>
                            </select>
                        </td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
                    <tr><td colspan="2"><strong>Thông tin hệ thống GATE - pay.gate.vn</strong></td></tr>
                    <tr>
						<td align='right' valign='top'>Tài khoản Gate: </td>
						<td><input type="text" name="accgate" value="<?php echo $accgate; ?>" size="50"/><br /><i>(Không cần điền nếu không sử dụng)</i></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr><td colspan="2"><strong>Thông tin hệ thống VTC - ebank.vtc.vn</strong></td></tr>
                    <tr>
						<td align='right' valign='top'>Tài khoản VTC: </td>
						<td><input type="text" name="accvtc" value="<?php echo $accvtc; ?>" size="50"/><br /><i>(Không cần điền nếu không sử dụng)</i></td>
					</tr>
                    <tr><td colspan="2"><hr></td></tr>
                    
                    <tr><td colspan="2"><strong>Thông tin hệ thống KETNOIPAY - ketnoipay.com</strong></td></tr>
                    <tr>
						<td align='right' valign='top'>Mã khách hàng: </td>
						<td><input type="text" name="ketnoipay_partnerid" value="<?php echo $ketnoipay_partnerid; ?>" size="50"/><br /><i>(Không cần điền nếu không sử dụng)</i></td>
					</tr>
                    <tr>
						<td align='right' valign='top'>Chữ ký giao dịch: </td>
						<td><input type="text" name="ketnoipay_signal" value="<?php echo $ketnoipay_signal; ?>" size="50"/><br /><i>(Không cần điền nếu không sử dụng)</i></td>
					</tr>
                    <tr><td colspan="2">
                        Khi bạn <strong>tạo tài khoản ở Kết Nối Pay</strong>, vui lòng <strong>nói với nhân viên Kết Nối Pay</strong> :<br />
                        <ul>
                            <li>Bạn được giới thiệu bởi : <strong>Nguyễn Xuân Vinh</strong></li>
                            <li><strong>Tài khoản Kết Nối Pay</strong> của người giới thiệu : <strong>nguyenxuanvinh</strong></li>
                            <li>Yahoo người giới thiệu : <strong>nwebmu</strong></li>
                        </ul>
                        Sau đó bạn <strong>gửi cho mình thông tin của bạn đăng ký trên Kết Nối Pay</strong>:
                        <ul>
                            <li>Họ và Tên của bạn : </li>
                            <li>Tài khoản Kết Nối Pay : </li>
                        </ul>
                        <strong>Mục đích</strong>:
                        <ul>
                            <li>Bạn sẽ trở thành <strong>Cộng Tác Viên</strong> của mình</li>
                            <li>Mình sẽ được hưởng thêm <strong>0.5% dựa trên doanh thu của bạn</strong></li>
                            <li><strong>Triết khấu của bạn với Kết Nối Pay vẫn không thay đổi</strong>, không liên quan gì tới 0.5% hưởng thêm của mình</li>
                        </ul>
                        <strong>Hãy cùng hợp tác để 2 bên cùng có lợi</strong>. Các bạn dùng WebSite của mình thì hãy làm Cộng Tác Viên của mình để mình được hưởng 0.5% dựa trên doanh thu của bạn.
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
	  
