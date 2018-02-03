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
 
/*
	Create : 19:32 28/12/2011
*/
include('config/config_uplvitem.php');
    $chao = $_GET['ichao'];         $chao = abs(intval($chao));
    $cre = $_GET['icre'];           $cre = abs(intval($cre));
    $blue = $_GET['iblue'];         $blue = abs(intval($blue));
    $lvitem = $_GET['ilvitem'];     $lvitem = abs(intval($lvitem));
    
    switch ($lvitem){ 
	case '0':
        $chao_percent = $lv1_chao;
        $cre_percent = $lv1_cre;
        $blue_percent = $lv1_blue;
        $max_percent = $lv1_max;
	break;

	case '1':
        $chao_percent = $lv2_chao;
        $cre_percent = $lv2_cre;
        $blue_percent = $lv2_blue;
        $max_percent = $lv2_max;
	break;

	case '2':
        $chao_percent = $lv3_chao;
        $cre_percent = $lv3_cre;
        $blue_percent = $lv3_blue;
        $max_percent = $lv3_max;
	break;

    case '3':
        $chao_percent = $lv4_chao;
        $cre_percent = $lv4_cre;
        $blue_percent = $lv4_blue;
        $max_percent = $lv4_max;
	break;

    case '4':
        $chao_percent = $lv5_chao;
        $cre_percent = $lv5_cre;
        $blue_percent = $lv5_blue;
        $max_percent = $lv5_max;
	break;

    case '5':
        $chao_percent = $lv6_chao;
        $cre_percent = $lv6_cre;
        $blue_percent = $lv6_blue;
        $max_percent = $lv6_max;
	break;

    case '6':
        $chao_percent = $lv7_chao;
        $cre_percent = $lv7_cre;
        $blue_percent = $lv7_blue;
        $max_percent = $lv7_max;
	break;

    case '7':
        $chao_percent = $lv8_chao;
        $cre_percent = $lv8_cre;
        $blue_percent = $lv8_blue;
        $max_percent = $lv8_max;
	break;

    case '8':
        $chao_percent = $lv9_chao;
        $cre_percent = $lv9_cre;
        $blue_percent = $lv9_blue;
        $max_percent = $lv9_max;
	break;

    case '9':
        $chao_percent = $lv10_chao;
        $cre_percent = $lv10_cre;
        $blue_percent = $lv10_blue;
        $max_percent = $lv10_max;
	break;

    case '10':
        $chao_percent = $lv11_chao;
        $cre_percent = $lv11_cre;
        $blue_percent = $lv11_blue;
        $max_percent = $lv11_max;
	break;

    case '11':
        $chao_percent = $lv12_chao;
        $cre_percent = $lv12_cre;
        $blue_percent = $lv12_blue;
        $max_percent = $lv12_max;
	break;

    case '12':
        $chao_percent = $lv13_chao;
        $cre_percent = $lv13_cre;
        $blue_percent = $lv13_blue;
        $max_percent = $lv13_max;
	break;

    case '13':
        $chao_percent = $lv14_chao;
        $cre_percent = $lv14_cre;
        $blue_percent = $lv14_blue;
        $max_percent = $lv14_max;
	break;

    case '14':
        $chao_percent = $lv15_chao;
        $cre_percent = $lv15_cre;
        $blue_percent = $lv15_blue;
        $max_percent = $lv15_max;
	break;

	default :
        $chao_percent = 0;
        $cre_percent = 0;
        $blue_percent = 0;
        $max_percent = 0;
}
    $percent = $chao * $chao_percent + $cre * $cre_percent + $blue * $blue_percent;
    if($percent > $max_percent) $percent = $max_percent;
    
    echo "<font color=blue><b>$percent %</b></font> / <font color=red><b>$max_percent %</b></font>";

?>