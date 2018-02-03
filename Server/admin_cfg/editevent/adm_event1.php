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
 
$file_edit = 'config/config_event1.php';
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
	$event1_itemdrop1_code = $_POST['event1_itemdrop1_code'];
	$event1_itemdrop1_name = $_POST['event1_itemdrop1_name'];
	$event1_itemdrop2_code = $_POST['event1_itemdrop2_code'];
	$event1_itemdrop2_name = $_POST['event1_itemdrop2_name'];
	$event1_itemshop_code = $_POST['event1_itemshop_code'];
	$event1_itemshop_name = $_POST['event1_itemshop_name'];

	// Doi phan thuong loai 1
	$event1_loai1_daily_slg = $_POST['event1_loai1_daily_slg'];    $event1_loai1_daily_slg = abs(intval($event1_loai1_daily_slg));
    $event1_loai1_slg = $_POST['event1_loai1_slg'];    $event1_loai1_slg = abs(intval($event1_loai1_slg));
	$event1_loai1_zen1 = $_POST['event1_loai1_zen1'];  $event1_loai1_zen1 = abs(intval($event1_loai1_zen1));
	$event1_loai1_zen2 = $_POST['event1_loai1_zen2'];  $event1_loai1_zen2 = abs(intval($event1_loai1_zen2));
	
	$event1_loai1_point1_min = $_POST['event1_loai1_point1_min'];  $event1_loai1_point1_min = abs(intval($event1_loai1_point1_min));
	$event1_loai1_point1_max = $_POST['event1_loai1_point1_max'];  $event1_loai1_point1_max = abs(intval($event1_loai1_point1_max));
	
	$event1_loai1_point2_min = $_POST['event1_loai1_point2_min'];  $event1_loai1_point2_min = abs(intval($event1_loai1_point2_min));
	$event1_loai1_point2_max = $_POST['event1_loai1_point2_max'];  $event1_loai1_point2_max = abs(intval($event1_loai1_point2_max));
	
	// Doi phan thuong loai 2
	$event1_loai2_daily_slg = $_POST['event1_loai2_daily_slg'];    $event1_loai2_daily_slg = abs(intval($event1_loai2_daily_slg));
    $event1_loai2_slg = $_POST['event1_loai2_slg'];    $event1_loai2_slg = abs(intval($event1_loai2_slg));
	$event1_loai2_itemshop_slg1 = $_POST['event1_loai2_itemshop_slg1'];    $event1_loai2_itemshop_slg1 = abs(intval($event1_loai2_itemshop_slg1));
	$event1_loai2_point1_min = $_POST['event1_loai2_point1_min'];  $event1_loai2_point1_min = abs(intval($event1_loai2_point1_min));
	$event1_loai2_point1_max = $_POST['event1_loai2_point1_max'];  $event1_loai2_point1_max = abs(intval($event1_loai2_point1_max));
	
	$event1_loai2_itemshop_slg2 = $_POST['event1_loai2_itemshop_slg2'];    $event1_loai2_itemshop_slg2 = abs(intval($event1_loai2_itemshop_slg2));
	$event1_loai2_point2_min = $_POST['event1_loai2_point2_min'];  $event1_loai2_point2_min = abs(intval($event1_loai2_point2_min));
	$event1_loai2_point2_max = $_POST['event1_loai2_point2_max'];  $event1_loai2_point2_max = abs(intval($event1_loai2_point2_max));
	
	// Doi phan thuong loai 3
	$event1_loai3_daily_slg = $_POST['event1_loai3_daily_slg'];    $event1_loai3_daily_slg = abs(intval($event1_loai3_daily_slg));
    $event1_loai3_slg = $_POST['event1_loai3_slg'];    $event1_loai3_slg = abs(intval($event1_loai3_slg));
	$event1_loai3_gcoin1 = $_POST['event1_loai3_gcoin1'];  $event1_loai3_gcoin1 = abs(intval($event1_loai3_gcoin1));
	$event1_loai3_gcoin2 = $_POST['event1_loai3_gcoin2'];  $event1_loai3_gcoin2 = abs(intval($event1_loai3_gcoin2));
	
	$event1_loai3_point1_min = $_POST['event1_loai3_point1_min'];  $event1_loai3_point1_min = abs(intval($event1_loai3_point1_min));
	$event1_loai3_point1_max = $_POST['event1_loai3_point1_max'];  $event1_loai3_point1_max = abs(intval($event1_loai3_point1_max));
	
	$event1_loai3_point2_min = $_POST['event1_loai3_point2_min'];  $event1_loai3_point2_min = abs(intval($event1_loai3_point2_min));
	$event1_loai3_point2_max = $_POST['event1_loai3_point2_max'];  $event1_loai3_point2_max = abs(intval($event1_loai3_point2_max));
	
	$content = "<?php\n";
	$content .= "\$event1_itemdrop1_code	= '$event1_itemdrop1_code';\n";
	$content .= "\$event1_itemdrop1_name	= '$event1_itemdrop1_name';\n";
	$content .= "\$event1_itemdrop2_code	= '$event1_itemdrop2_code';\n";
	$content .= "\$event1_itemdrop2_name	= '$event1_itemdrop2_name';\n";
	$content .= "\$event1_itemshop_code	= '$event1_itemshop_code';\n";
	$content .= "\$event1_itemshop_name	= '$event1_itemshop_name';\n";
	$content .= "\$event1_loai1_slg	= $event1_loai1_slg;\n";
    $content .= "\$event1_loai1_daily_slg	= $event1_loai1_daily_slg;\n";
	$content .= "\$event1_loai1_zen1	= $event1_loai1_zen1;\n";
	$content .= "\$event1_loai1_zen2	= $event1_loai1_zen2;\n";
	$content .= "\$event1_loai1_point1_min	= $event1_loai1_point1_min;\n";
	$content .= "\$event1_loai1_point1_max	= $event1_loai1_point1_max;\n";
	$content .= "\$event1_loai1_point2_min	= $event1_loai1_point2_min;\n";
	$content .= "\$event1_loai1_point2_max	= $event1_loai1_point2_max;\n";
	$content .= "\$event1_loai2_slg	= $event1_loai2_slg;\n";
    $content .= "\$event1_loai2_daily_slg	= $event1_loai2_daily_slg;\n";
	$content .= "\$event1_loai2_itemshop_slg1	= $event1_loai2_itemshop_slg1;\n";
	$content .= "\$event1_loai2_point1_min	= $event1_loai2_point1_min;\n";
	$content .= "\$event1_loai2_point1_max	= $event1_loai2_point1_max;\n";
	$content .= "\$event1_loai2_itemshop_slg2	= $event1_loai2_itemshop_slg2;\n";
	$content .= "\$event1_loai2_point2_min	= $event1_loai2_point2_min;\n";
	$content .= "\$event1_loai2_point2_max	= $event1_loai2_point2_max;\n";
	$content .= "\$event1_loai3_slg	= $event1_loai3_slg;\n";
    $content .= "\$event1_loai3_daily_slg	= $event1_loai3_daily_slg;\n";
	$content .= "\$event1_loai3_gcoin1	= $event1_loai3_gcoin1;\n";
	$content .= "\$event1_loai3_gcoin2	= $event1_loai3_gcoin2;\n";
	$content .= "\$event1_loai3_point1_min	= $event1_loai3_point1_min;\n";
	$content .= "\$event1_loai3_point1_max	= $event1_loai3_point1_max;\n";
	$content .= "\$event1_loai3_point2_min	= $event1_loai3_point2_min;\n";
	$content .= "\$event1_loai3_point2_max	= $event1_loai3_point2_max;\n";
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
				<h1>Cấu Hình Đổi Item -> Point</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table>
					<tr><td colspan="2"><b>Mô tả sự kiện</b><br>
					    - Trong quá trình đánh quái, người chơi sẽ nhặt được <?php echo $event1_itemdrop1_name; ?> và <?php echo $event1_itemdrop2_name; ?><br>
					    - Sử dụng <?php echo $event1_itemdrop1_name; ?>, <?php echo $event1_itemdrop2_name; ?> để đổi lấy phần thưởng sự kiện.<br>
					</td>
					</tr>
					
					<tr>
						<td width="100">Tên Item loại 1: </td>
						<td><input type="text" name="event1_itemdrop1_name" value="<?php echo $event1_itemdrop1_name; ?>" size="40"/></td>
					</tr>
					<tr>
						<td>Mã Item loại 1: </td>
						<td><input type="text" name="event1_itemdrop1_code" value="<?php echo $event1_itemdrop1_code; ?>" size="40" maxlength="32"/> (32 mã lấy từ MuMaker)</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td width="100">Tên Item loại 2: </td>
						<td><input type="text" name="event1_itemdrop2_name" value="<?php echo $event1_itemdrop2_name; ?>" size="40"/></td>
					</tr>
					<tr>
						<td>Mã Item loại 2: </td>
						<td><input type="text" name="event1_itemdrop2_code" value="<?php echo $event1_itemdrop2_code; ?>" size="40" maxlength="32"/> (32 mã lấy từ MuMaker)</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr>
						<td width="100">Tên Item bán WebShop: </td>
						<td><input type="text" name="event1_itemshop_name" value="<?php echo $event1_itemshop_name; ?>" size="40"/></td>
					</tr>
					<tr>
						<td>Mã Item bán WebShop: </td>
						<td><input type="text" name="event1_itemshop_code" value="<?php echo $event1_itemshop_code; ?>" size="40" maxlength="32"/> (32 mã lấy từ MuMaker)</td>
					</tr>
					<tr><td colspan="2"><hr></td></tr>
					
					<tr><td colspan="2"><b>Công thức đổi phần thưởng</b> :<br>
					<b>- Phần thưởng loại 1</b> :<br>
					1 <?php echo $event1_itemdrop1_name; ?> + <input type="text" name="event1_loai1_zen1" value="<?php echo $event1_loai1_zen1; ?>" size="10"/> Zen = <input type="text" name="event1_loai1_point1_min" value="<?php echo $event1_loai1_point1_min; ?>" size="2"/> - <input type="text" name="event1_loai1_point1_max" value="<?php echo $event1_loai1_point1_max; ?>" size="2"/> point<br>
					1 <?php echo $event1_itemdrop2_name; ?> + <input type="text" name="event1_loai1_zen2" value="<?php echo $event1_loai1_zen2; ?>" size="10"/> Zen = <input type="text" name="event1_loai1_point2_min" value="<?php echo $event1_loai1_point2_min; ?>" size="2"/> - <input type="text" name="event1_loai1_point2_max" value="<?php echo $event1_loai1_point2_max; ?>" size="2"/> point<br>
					Đổi tối đa trong ngày : <input type="text" name="event1_loai1_daily_slg" value="<?php echo $event1_loai1_daily_slg; ?>" size="2"/> phần thưởng<br>
                    Đổi tối đa : <input type="text" name="event1_loai1_slg" value="<?php echo $event1_loai1_slg; ?>" size="2"/> phần thưởng
					<br><br>
					
					<b>- Phần thưởng loại 2</b> :<br>
					1 <?php echo $event1_itemdrop1_name; ?> + <input type="text" name="event1_loai2_itemshop_slg1" value="<?php echo $event1_loai2_itemshop_slg1; ?>" size="2"/> <?php echo $event1_itemshop_name; ?> = <input type="text" name="event1_loai2_point1_min" value="<?php echo $event1_loai2_point1_min; ?>" size="2"/> - <input type="text" name="event1_loai2_point1_max" value="<?php echo $event1_loai2_point1_max; ?>" size="2"/> point<br>
					1 <?php echo $event1_itemdrop2_name; ?> + <input type="text" name="event1_loai2_itemshop_slg2" value="<?php echo $event1_loai2_itemshop_slg2; ?>" size="2"/> <?php echo $event1_itemshop_name; ?> = <input type="text" name="event1_loai2_point2_min" value="<?php echo $event1_loai2_point2_min; ?>" size="2"/> - <input type="text" name="event1_loai2_point2_max" value="<?php echo $event1_loai2_point2_max; ?>" size="2"/> point<br>
					Đổi tối đa trong ngày : <input type="text" name="event1_loai2_daily_slg" value="<?php echo $event1_loai2_daily_slg; ?>" size="2"/> phần thưởng<br>
                    Đổi tối đa : <input type="text" name="event1_loai2_slg" value="<?php echo $event1_loai2_slg; ?>" size="2"/> phần thưởng
					<br><br>
					
					<b>- Phần thưởng loại 3</b> :<br>
					1 <?php echo $event1_itemdrop1_name; ?> + <input type="text" name="event1_loai3_gcoin1" value="<?php echo $event1_loai3_gcoin1; ?>" size="5"/> Gcoin = <input type="text" name="event1_loai3_point1_min" value="<?php echo $event1_loai3_point1_min; ?>" size="2"/> - <input type="text" name="event1_loai3_point1_max" value="<?php echo $event1_loai3_point1_max; ?>" size="2"/> point<br>
					1 <?php echo $event1_itemdrop2_name; ?> + <input type="text" name="event1_loai3_gcoin2" value="<?php echo $event1_loai3_gcoin2; ?>" size="5"/> Gcoin = <input type="text" name="event1_loai3_point2_min" value="<?php echo $event1_loai3_point2_min; ?>" size="2"/> - <input type="text" name="event1_loai3_point2_max" value="<?php echo $event1_loai3_point2_max; ?>" size="2"/> point<br>
					Đổi tối đa trong ngày : <input type="text" name="event1_loai3_daily_slg" value="<?php echo $event1_loai3_daily_slg; ?>" size="2"/> phần thưởng<br>
                    Đổi tối đa : <input type="text" name="event1_loai3_slg" value="<?php echo $event1_loai3_slg; ?>" size="2"/> phần thưởng
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
	  
