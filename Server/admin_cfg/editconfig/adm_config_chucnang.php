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
 
$file_edit = 'config/config_chucnang.php';
if(!is_file($file_edit)) 
{ 
	$fp_host = fopen($file_edit, "w");
	fclose($fp_host);
}

if(is_writable($file_edit))	{ $can_write = "<font color=green>Có thể ghi</font>"; $accept = 1;}
	else { $can_write = "<font color=red>Không thể ghi - Hãy sử dụng chương trình FTP FileZilla chuyển <b>File permission</b> sang 666</font>"; $accept = 0; }

if($_POST['action'] == 'edit')
{
	$content = "<?php\n";
	
    foreach($_POST as $key => $value) {
	   if($key != 'Submit' && $key != 'action') {
            $value = abs(intval($value));
            $content .= "\$". $key ."	= $value;\n";	       
	   }
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
				<h1>Cấu Hình Chức năng</h1>
			</div><br>
			Tệp tin <?php echo "<b>".$file_edit."</b> : ".$can_write; ?>
		  <div class="select-bar"></div>
			<div class="table">
<?php if($notice) echo $notice; ?>
				<form id="editconfig" name="editconfig" method="post" action="">
				<input type="hidden" name="action" value="edit"/>
				<table width="100%">
					
                    <tr><td colspan="2"><b>Chức năng trên Menu chính</b> :</td></tr>
					<tr>
						<td width="200" align="right">Sử dụng Kích Kẹt: </td>
                        
						<td><input type="checkbox" name="Use_KichKet" value="1" <?php if($Use_KichKet == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng Luyện Bảo: </td>
                        
						<td><input type="checkbox" name="Use_LuyenBao" value="1" <?php if($Use_LuyenBao == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng Máy Chao: </td>
                        
						<td><input type="checkbox" name="Use_MayChao" value="1" <?php if($Use_MayChao == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng Nhiệm vụ Phúc Lợi: </td>
                        
						<td><input type="checkbox" name="Use_QuestDaily" value="1" <?php if($Use_QuestDaily == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng Thuê Item: </td>
                        
						<td><input type="checkbox" name="Use_ThueItem" value="1" <?php if($Use_ThueItem == 1) echo "checked"; ?>/> <i>Chỉ sử dụng cho <strong><font color='red'>khách hàng thân thiết của NetBanBe</font></strong> (Khách hàng đã sử dụng NWeb ít nhất 3 tháng).<br />Những bạn nào muốn sử dụng liên hệ Yahoo : <font color='blue'><strong>nwebmu</strong></font> để cài đặt</i></td>
					</tr>
                    <tr>
						<td width="200" align="right">Sử dụng WebShop: </td>
                        
						<td><input type="checkbox" name="Use_WebShop" value="1" <?php if($Use_WebShop == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Tiền tệ: </td>
						<td><input type="checkbox" name="Use_TienTe" value="1" <?php if($Use_TienTe == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Nạp thẻ: </td>
						<td><input type="checkbox" name="Use_NapThe" value="1" <?php if($Use_NapThe == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Event: </td>
						<td><input type="checkbox" name="Use_Event" value="1" <?php if($Use_Event == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Xếp hạng: </td>
						<td><input type="checkbox" name="Use_XepHang" value="1" <?php if($Use_XepHang == 1) echo "checked"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr /></td></tr>
					
					<tr><td colspan="2"><b>Chức năng Nhân vật</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng Hệ thống Tu Luyện: </td>
						<td><input type="checkbox" name="Use_TuLuyen" value="1" <?php if($Use_TuLuyen == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Hệ thống Song Tu: </td>
						<td><input type="checkbox" name="Use_SongTu" value="1" <?php if($Use_SongTu == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Bảo Vệ Đồ: </td>
						<td><input type="checkbox" name="Use_LockItem" value="1" <?php if($Use_LockItem == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font> <i>(Chỉ sử dụng cho Server SCF 11.11.82 hoặc mới hơn)</i>
                        </td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Reset Over: </td>
						<td><input type="checkbox" name="Use_ResetOver" value="1" <?php if($Use_ResetOver == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font> <i>(Phải bật tính năng Giới Hạn Reset mới sử dụng được)</i>
                        </td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Đổi giới tính: </td>
						<td><input type="checkbox" name="Use_DoiGioiTinh" value="1" <?php if($Use_DoiGioiTinh == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Reset VIP: </td>
						<td><input type="checkbox" name="Use_ResetVIP" value="1" <?php if($Use_ResetVIP == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
					<tr>
						<td align="right">Sử dụng Ủy thác Offline: </td>
						<td><input type="checkbox" name="Use_UyThacOffline" value="1" <?php if($Use_UyThacOffline == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
					<tr>
						<td align="right">Sử dụng Ủy thác Online: </td>
						<td><input type="checkbox" name="Use_UyThacOnline" value="1" <?php if($Use_UyThacOnline == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
					<tr>
						<td align="right">Sử dụng Đổi Tên Nhân Vật: </td>
						<td><input type="checkbox" name="Use_ChangeName" value="1" <?php if($Use_ChangeName == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Chuyển Nhân Vật Sang Tài Khoản Khác: </td>
						<td><input type="checkbox" name="Use_Char2AccOther" value="1" <?php if($Use_Char2AccOther == 1) echo "checked"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr /></td></tr>
					
                    <tr><td colspan="2"><b>Chức năng Luyện Bảo</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng Hệ thống Cường Hóa: </td>
						<td><input type="checkbox" name="Use_CuongHoa" value="1" <?php if($Use_CuongHoa == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Hệ thống Hoàn Hảo Hóa: </td>
						<td><input type="checkbox" name="Use_HoanHaoHoa" value="1" <?php if($Use_HoanHaoHoa == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    
                    <tr><td colspan="2"><b>Chức năng Máy Chao</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng Ép Lông Condor: </td>
						<td><input type="checkbox" name="Use_MayChao_LongCondor" value="1" <?php if($Use_MayChao_LongCondor == 1) echo "checked"; ?>/>
                        <font color='blue'><strong>Chức năng cần LIC</strong></font>
                        </td>
					</tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    
					<tr><td colspan="2"><b>Chức năng Nạp thẻ</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng nạp thẻ GATE: </td>
						<td><input type="checkbox" name="Use_CardGATE" value="1" <?php if($Use_CardGATE == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng nạp thẻ VTC: </td>
						<td><input type="checkbox" name="Use_CardVTCOnline" value="1" <?php if($Use_CardVTCOnline == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng nạp thẻ Viettel: </td>
						<td><input type="checkbox" name="Use_CardViettel" value="1" <?php if($Use_CardViettel == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng nạp thẻ MobiFone: </td>
						<td><input type="checkbox" name="Use_CardMobi" value="1" <?php if($Use_CardMobi == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng nạp thẻ VinaPhone: </td>
						<td><input type="checkbox" name="Use_CardVina" value="1" <?php if($Use_CardVina == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    
                    <tr><td colspan="2"><b>Chức năng Thuê Item</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng Cho Thuê Tạp hóa: </td>
						<td><input type="checkbox" name="Use_ThueTapHoa" value="1" <?php if($Use_ThueTapHoa == 1) echo "checked"; ?>/></td>
					</tr>
					
					<tr>
						<td align="right">Sử dụng Cửa hàng Kiếm: </td>
						<td><input type="checkbox" name="Use_ThueKiem" value="1" <?php if($Use_ThueKiem == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Gậy: </td>
						<td><input type="checkbox" name="Use_ThueGay" value="1" <?php if($Use_ThueGay == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Cung: </td>
						<td><input type="checkbox" name="Use_ThueCung" value="1" <?php if($Use_ThueCung == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Vũ Khí Khác: </td>
						<td><input type="checkbox" name="Use_ThueVuKhiKhac" value="1" <?php if($Use_ThueVuKhiKhac == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Khiên: </td>
						<td><input type="checkbox" name="Use_ThueKhien" value="1" <?php if($Use_ThueKhien == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Mũ: </td>
						<td><input type="checkbox" name="Use_ThueMu" value="1" <?php if($Use_ThueMu == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Áo: </td>
						<td><input type="checkbox" name="Use_ThueAo" value="1" <?php if($Use_ThueAo == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Quần: </td>
						<td><input type="checkbox" name="Use_ThueQuan" value="1" <?php if($Use_ThueQuan == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Tay: </td>
						<td><input type="checkbox" name="Use_ThueTay" value="1" <?php if($Use_ThueTay == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Chân: </td>
						<td><input type="checkbox" name="Use_ThueChan" value="1" <?php if($Use_ThueChan == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Trang Sức: </td>
						<td><input type="checkbox" name="Use_ThueTrangSuc" value="1" <?php if($Use_ThueTrangSuc == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Cánh: </td>
						<td><input type="checkbox" name="Use_ThueCanh" value="1" <?php if($Use_ThueCanh == 1) echo "checked"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr /></td></tr>
                    
                    <tr><td colspan="2"><b>Chức năng WebShop</b> :</td></tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Tạp hóa: </td>
						<td><input type="checkbox" name="Use_ShopTapHoa" value="1" <?php if($Use_ShopTapHoa == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng vé Event: </td>
						<td><input type="checkbox" name="Use_ShopVeEvent" value="1" <?php if($Use_ShopVeEvent == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng SET Thần Thánh: </td>
						<td><input type="checkbox" name="Use_ShopAcient" value="1" <?php if($Use_ShopAcient == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Kiếm: </td>
						<td><input type="checkbox" name="Use_ShopKiem" value="1" <?php if($Use_ShopKiem == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Gậy: </td>
						<td><input type="checkbox" name="Use_ShopGay" value="1" <?php if($Use_ShopGay == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Cung: </td>
						<td><input type="checkbox" name="Use_ShopCung" value="1" <?php if($Use_ShopCung == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Vũ Khí Khác: </td>
						<td><input type="checkbox" name="Use_ShopVuKhiKhac" value="1" <?php if($Use_ShopVuKhiKhac == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Khiên: </td>
						<td><input type="checkbox" name="Use_ShopKhien" value="1" <?php if($Use_ShopKhien == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Mũ: </td>
						<td><input type="checkbox" name="Use_ShopMu" value="1" <?php if($Use_ShopMu == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Áo: </td>
						<td><input type="checkbox" name="Use_ShopAo" value="1" <?php if($Use_ShopAo == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Quần: </td>
						<td><input type="checkbox" name="Use_ShopQuan" value="1" <?php if($Use_ShopQuan == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Tay: </td>
						<td><input type="checkbox" name="Use_ShopTay" value="1" <?php if($Use_ShopTay == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Chân: </td>
						<td><input type="checkbox" name="Use_ShopChan" value="1" <?php if($Use_ShopChan == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Trang Sức: </td>
						<td><input type="checkbox" name="Use_ShopTrangSuc" value="1" <?php if($Use_ShopTrangSuc == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng Cánh: </td>
						<td><input type="checkbox" name="Use_ShopCanh" value="1" <?php if($Use_ShopCanh == 1) echo "checked"; ?>/></td>
					</tr>
					<tr>
						<td align="right">Sử dụng Cửa hàng tiền Zen: </td>
						<td><input type="checkbox" name="Use_ShopTienZen" value="1" <?php if($Use_ShopTienZen == 1) echo "checked"; ?>/></td>
					</tr>
					<tr><td colspan="2"><hr /></td></tr>
                    
					<tr><td colspan="2"><b>Chức năng Tiền Tệ</b> :</td></tr>
					
                    <tr>
						<td align="right">Sử dụng chuyển Gcoin sang VipMoney: </td>
						<td><input type="checkbox" name="Use_Gcoin2VipMoney" value="1" <?php if($Use_Gcoin2VipMoney == 1) echo "checked"; ?>/></td>
					</tr>
                    
                    <tr>
						<td align="right">Sử dụng chuyển Gcoin sang WCoin: </td>
						<td><input type="checkbox" name="Use_Gcoin2WCoin" value="1" <?php if($Use_Gcoin2WCoin == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng chuyển Gcoin sang WCoinP: </td>
						<td><input type="checkbox" name="Use_Gcoin2WCoinP" value="1" <?php if($Use_Gcoin2WCoinP == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng chuyển Gcoin sang GoblinCoin: </td>
						<td><input type="checkbox" name="Use_Gcoin2GoblinCoin" value="1" <?php if($Use_Gcoin2GoblinCoin == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng chuyển IP Bonus sang Vpoint: </td>
						<td><input type="checkbox" name="Use_IPBonus2Vpoint" value="1" <?php if($Use_IPBonus2Vpoint == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng chuyển IP Bonus sang PCPoint: </td>
						<td><input type="checkbox" name="Use_IPBonus2PCPoint" value="1" <?php if($Use_IPBonus2PCPoint == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr><td colspan="2"><hr /></td></tr>
                    
					<tr><td colspan="2"><b>Chức năng Giải trí</b> :</td></tr>
					
                    <tr>
						<td align="right">Sử dụng Đánh Lô: </td>
						<td><input type="checkbox" name="Use_GiaiTri_Lo" value="1" <?php if($Use_GiaiTri_Lo == 1) echo "checked"; ?>/></td>
					</tr>
                    <tr>
						<td align="right">Sử dụng Đánh Đề: </td>
						<td><input type="checkbox" name="Use_GiaiTri_De" value="1" <?php if($Use_GiaiTri_De == 1) echo "checked"; ?>/></td>
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
	  
