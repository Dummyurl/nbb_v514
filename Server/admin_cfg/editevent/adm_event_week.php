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
 
$file_edit = 'config/config_eventweek.php';
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
	
    $quest_daily = $_POST['quest_daily'];
    $quest_daily_pl = $_POST['quest_daily_pl'];
    $quest_daily_gcoin = $_POST['quest_daily_gcoin'];
    $quest_daily_gcoinkm = $_POST['quest_daily_gcoinkm'];
    $quest_daily_wcoin = $_POST['quest_daily_wcoin'];
    $quest_daily_chao = $_POST['quest_daily_chao'];
    
    for($i=1; $i<=27; $i++) {
        if(!isset($quest_daily[$i])) $quest_daily[$i] = 0;
        if(!isset($quest_daily_pl[$i])) $quest_daily_pl[$i] = 0; else $quest_daily_pl[$i] = abs(intval($quest_daily_pl[$i]));
        if(!isset($quest_daily_gcoin[$i])) $quest_daily_gcoin[$i] = 0; else $quest_daily_gcoin[$i] = abs(intval($quest_daily_gcoin[$i]));
        if(!isset($quest_daily_gcoinkm[$i])) $quest_daily_gcoinkm[$i] = 0; else $quest_daily_gcoinkm[$i] = abs(intval($quest_daily_gcoinkm[$i]));
        if(!isset($quest_daily_wcoin[$i])) $quest_daily_wcoin[$i] = 0; else $quest_daily_wcoin[$i] = abs(intval($quest_daily_wcoin[$i]));
        if(!isset($quest_daily_chao[$i])) $quest_daily_chao[$i] = 0; else $quest_daily_chao[$i] = abs(intval($quest_daily_chao[$i]));
        
        $content .= "\$quest_daily[$i]	= $quest_daily[$i];\n";
        $content .= "\$quest_daily_pl[$i]	= $quest_daily_pl[$i];\n";
        $content .= "\$quest_daily_gcoin[$i]	= $quest_daily_gcoin[$i];\n";
        $content .= "\$quest_daily_gcoinkm[$i]	= $quest_daily_gcoinkm[$i];\n";
        $content .= "\$quest_daily_wcoin[$i]	= $quest_daily_wcoin[$i];\n";
        $content .= "\$quest_daily_chao[$i]	= $quest_daily_chao[$i];\n";
        
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
?>


		<div id="center-column">
			<div class="top-bar">
				<h1>Cấu Hình Event Tuần</h1>
			</div><br />
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>

				<table width="100%" border="0" bgcolor="#9999FF">
				  <tr bgcolor="#FFFFFF">
				    <td align="center" rowspan="2"><b>Sử dụng</b></td>
				    <td align="center" rowspan="2"><b>Nhiệm vụ</b></td>
				    <td align="center" colspan="5"><b>Phần thưởng</b></td>
				  </tr>
                  <tr bgcolor="#FFFFFF">
				    <td align="center"><b>Điểm Phúc Lợi</b></td>
				    <td align="center"><b>Gcoin</b></td>
				    <td align="center"><b>Gcoin KM</b></td>
                    <td align="center"><b>WCoin</b></td>
                    <td align="center"><b>Chao</b></td>
				  </tr>
				  
                  <?php
                    for($i=1; $i<=27; $i++) {
                        switch ($i){ 
                        	case 1:
                                $quest_name[$i] = "TOP 1 ALL";
                        	break;
                        
                        	case 2:
                                $quest_name[$i] = "TOP 2 ALL";
                        	break;
                        
                        	case 3:
                                $quest_name[$i] = "TOP 3 ALL";
                        	break;
                        
                        	case 4:
                                $quest_name[$i] = "TOP 4 ALL";
                        	break;
                        
                        	case 5:
                                $quest_name[$i] = "TOP 5 ALL";
                        	break;
                        
                        	case 6:
                                $quest_name[$i] = "TOP 1 Phù Thủy";
                        	break;
                        
                        	case 7:
                                $quest_name[$i] = "TOP 2 Phù Thủy";
                        	break;
                        
                        	case 8:
                                $quest_name[$i] = "TOP 3 Phù Thủy";
                        	break;
                        
                        	case 9:
                                $quest_name[$i] = "TOP 1 Chiến Binh";
                        	break;
                        
                        	case 10:
                                $quest_name[$i] = "TOP 2 Chiến Binh";
                        	break;
                        
                        	case 11:
                                $quest_name[$i] = "TOP 3 Chiến Binh";
                        	break;
                        
                        	case 12:
                                $quest_name[$i] = "TOP 1 Tiên Nữ";
                        	break;
                        
                        	case 13:
                                $quest_name[$i] = "TOP 2 Tiên Nữ";
                        	break;
                        
                        	case 14:
                                $quest_name[$i] = "TOP 3 Tiên Nữ";
                        	break;
                        
                        	case 15:
                                $quest_name[$i] = "TOP 1 Đấu Sĩ";
                        	break;
                        
                        	case 16:
                                $quest_name[$i] = "TOP 2 Đấu Sĩ";
                        	break;
                        
                        	case 17:
                                $quest_name[$i] = "TOP 3 Đấu Sĩ";
                        	break;
                        
                        	case 18:
                                $quest_name[$i] = "TOP 1 Chúa Tể";
                        	break;
                        
                        	case 19:
                                $quest_name[$i] = "TOP 2 Chúa Tể";
                        	break;
                        
                        	case 20:
                                $quest_name[$i] = "TOP 3 Chúa Tể";
                        	break;
                        
                      		case 21:
                                $quest_name[$i] = "TOP 1 Thuật Sĩ";
                        	break;
                        
                        	case 22:
                                $quest_name[$i] = "TOP 2 Thuật Sĩ";
                        	break;
                        
                        	case 23:
                                $quest_name[$i] = "TOP 3 Thuật Sĩ";
                        	break;
                        
                        	case 24:
                                $quest_name[$i] = "TOP 1 Thiết Binh";
                        	break;
                        
                        	case 25:
                                $quest_name[$i] = "TOP 2 Thiết Binh";
                        	break;
                        
                        	case 26:
                                $quest_name[$i] = "TOP 3 Thiết Binh";
                        	break;
                        
                        	case 27:
                                $quest_name[$i] = "Giải khuyến khích";
                        	break;
                
                default :
                                $quest_name[$i] = "Chưa định nghĩa";
                        }
                  ?>
                  <tr bgcolor="#FFFFFF">
				    <td align="center"><input type="checkbox" name="quest_daily[<?php echo $i; ?>]" value="1" <?php if(isset($quest_daily[$i]) && $quest_daily[$i]==1) echo "checked"; ?> /></td>
				    <td align="left"><strong><?php echo $quest_name[$i]; ?></strong></td>
                    <td align="center"><input type="text" name="quest_daily_pl[<?php echo $i; ?>]" value="<?php echo isset($quest_daily_pl[$i]) ? $quest_daily_pl[$i] : 0; ?>" size="2" maxlength="3" /></td>
                    <td align="center"><input type="text" name="quest_daily_gcoin[<?php echo $i; ?>]" value="<?php echo isset($quest_daily_gcoin[$i]) ? $quest_daily_gcoin[$i] : 0; ?>" size="2" maxlength="5" /></td>
                    <td align="center"><input type="text" name="quest_daily_gcoinkm[<?php echo $i; ?>]" value="<?php echo isset($quest_daily_gcoinkm[$i]) ? $quest_daily_gcoinkm[$i] : 0; ?>" size="2" maxlength="5" /></td>
                    <td align="center"><input type="text" name="quest_daily_wcoin[<?php echo $i; ?>]" value="<?php echo isset($quest_daily_wcoin[$i]) ? $quest_daily_wcoin[$i] : 0; ?>" size="2" maxlength="5" /></td>
                    <td align="center"><input type="text" name="quest_daily_chao[<?php echo $i; ?>]" value="<?php echo isset($quest_daily_chao[$i]) ? $quest_daily_chao[$i] : 0; ?>" size="2" maxlength="3" /></td>
				  </tr>
				  <?php } ?>
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
	  
