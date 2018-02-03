<?php
/**
 * @author		NetBanBe
 * @copyright	2005 - 2012
 * @website		http://netbanbe.net
 * @Email		nwebmu@gmail.com
 * @HotLine		094 92 92 290
 * @Version		v5.12.0722
 * @Release		22/07/2012
 
 * WebSite hoan toan duoc thiet ke boi NetBanBe.
 * Vi vay, hay ton trong ban quyen tri tue cua NetBanBe
 * Hay ton trong cong suc, tri oc NetBanBe da bo ra de thiet ke nen NWebMU
 * Hay su dung ban quyen duoc cung cap boi NetBanBe de gop 1 phan nho chi phi phat trien NWebMU
 * Khong nen su dung NWebMU ban crack hoac tu nguoi khac dua cho. Nhung hanh dong nhu vay se lam kim ham su phat trien cua NWebMU do khong co kinh phi phat trien cung nhu san pham tri tue bi danh cap.
 * Cac ban hay su dung NWebMU duoc cung cap boi NetBanBe de NetBanBe co dieu kien phat trien them nhieu tinh nang hay hon, tot hon.
 * Cam on nhieu!
 */
 
if (isset($_SESSION['mu_nvchon'])) {
	if (isset($_SESSION['nv_online']) && $_SESSION['nv_online'] == 1) $online = "<font color='red'><b>Chưa Thoát</b></font>"; else $online = "<font color='green'>Đã Thoát</font>";
	if (isset($_SESSION['nv_doinv']) && $_SESSION['nv_doinv'] == 1) $doinv = "<font color='green'>Đã đổi</font>"; else $doinv = "<font color='red'><b>Chưa đổi</b></font>";
	
    if(!isset($_SESSION['nv_class'])) $_SESSION['nv_class'] = 0;
    
	if ( ($_SESSION['nv_class'] == 0) || ($_SESSION['nv_class'] == 1) || ($_SESSION['nv_class'] == 2) || ($_SESSION['nv_class'] == 3) ) {
        $img_class = "dw.jpg";
    	if ($_SESSION['nv_class'] == 0) $class = "Dark Wizard";
    	elseif ($_SESSION['nv_class'] == 1) $class = "Soul Master";
    	elseif ($_SESSION['nv_class'] == 2 || $_SESSION['nv_class'] == 3) $class = "Grand Master";
	}
	
	elseif ( ($_SESSION['nv_class'] == 16) || ($_SESSION['nv_class'] == 17) || ($_SESSION['nv_class'] == 18) || ($_SESSION['nv_class'] == 19) ) {
	   $img_class = "dk.jpg";
    	if ($_SESSION['nv_class'] == 16) $class = "Dark Knight";
    	elseif ($_SESSION['nv_class'] == 17) $class = "Blade Knight";
    	elseif ($_SESSION['nv_class'] == 18 || $_SESSION['nv_class'] == 19) $class = "Blade Master";
	}
	
	elseif ( ($_SESSION['nv_class'] == 32) || ($_SESSION['nv_class'] == 33) || ($_SESSION['nv_class'] == 34) || ($_SESSION['nv_class'] == 35) ) {
	   $img_class = "elf.jpg";
    	if ($_SESSION['nv_class'] == 32) $class = "ELF";
    	elseif ($_SESSION['nv_class'] == 33) $class = "Muse ELF";
    	elseif ($_SESSION['nv_class'] == 34 || $_SESSION['nv_class'] == 35) $class = "Hight ELF";
	} 
	
	elseif ( ($_SESSION['nv_class'] == 48) || ($_SESSION['nv_class'] == 49) || ($_SESSION['nv_class'] == 50) ) {
	   $img_class = "mg.jpg";
    	if ($_SESSION['nv_class'] == 48) $class = "Magic Gladiator";
    	elseif ($_SESSION['nv_class'] == 49 || $_SESSION['nv_class'] == 50) $class = "Duel Master";
	}
	
	elseif ( ($_SESSION['nv_class'] == 64) || ($_SESSION['nv_class'] == 65) || ($_SESSION['nv_class'] == 66) ) {
	   $img_class = "dl.jpg";
    	if ($_SESSION['nv_class'] == 64) $class = "DarkLord";
    	elseif ($_SESSION['nv_class'] == 65 || $_SESSION['nv_class'] == 66) $class = "Lord Emperor";
	}
	
	elseif ( ($_SESSION['nv_class'] == 80) || ($_SESSION['nv_class'] == 81) || ($_SESSION['nv_class'] == 82) || ($_SESSION['nv_class'] == 83) ) {
	   $img_class = "sum.jpg";
    	if ($_SESSION['nv_class'] == 80) $class = "Sumoner";
    	elseif ($_SESSION['nv_class'] == 81) $class = "Bloody Summoner";
    	elseif ($_SESSION['nv_class'] == 82 || $_SESSION['nv_class'] == 83) $class = "Dimension Master";
	}
    
    elseif ( ($_SESSION['nv_class'] == 96) || ($_SESSION['nv_class'] == 97) || ($_SESSION['nv_class'] == 98) ) {
	   $img_class = "rf.jpg";
    	if ($_SESSION['nv_class'] == 96) $class = "Rage Fighter";
    	elseif ($_SESSION['nv_class'] == 97 || $_SESSION['nv_class'] == 98) $class = "First Master";
	}
	
	if (isset($_SESSION['nv_uythaconline']) && $_SESSION['nv_uythaconline'] == 1) $uythac = "<font color='green'>Có</font>"; else $uythac = "<font color='red'><b>Không</b></font>";
	if (isset($_SESSION['nv_uythac_offline']) && $_SESSION['nv_uythac_offline'] == 1) $uythacoffline = "<font color='green'>Có</font>"; else $uythacoffline = "<font color='red'><b>Không</b></font>";
	if (isset($_SESSION['nv_khoado']) && $_SESSION['nv_khoado'] == 1) $khoado = "<font color='green'>Đã khóa</font>"; else $khoado = "<font color='red'><b>Chưa khóa</b></font>";
	if (isset($_SESSION['nv_thuepoint']) && $_SESSION['nv_thuepoint'] == 1) $thuepoint = "<font color='green'>Đã thuê</font>"; else $thuepoint = "<font color='red'><b>Chưa thuê</b></font>";

}
    include('templates/box_character.tpl');
?>