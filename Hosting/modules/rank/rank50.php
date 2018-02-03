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
 
	if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");
if ($Use_XepHang != 1) {
	echo "<center>Chức năng không có hoặc không được sử dụng</center>";
}
else {
if ( !isset($_SESSION['mu_username']) ) {
	echo "<div align=center><font color=red><b>Hãy Login trước khi thực hiện chức năng này</b></font></div>";
	include('modules/home.php');
} else {
	
	
	// Chon The he
    if ($thehe_choise)
    {
        if(!isset($_SESSION['thehe'])) $_SESSION['thehe'] = count($thehe_choise)-1;
        if(isset($_GET['thehe'])) $_SESSION['thehe'] = abs(intval($_GET['thehe']));
        $theheid = $_SESSION['thehe'];
    }
	
	
	/*
		Các bước tiến hành:
		B1: Đọc file trên host lấy thời gian lưu file
		B2: So sánh thời gian hiện tại với thời gian lưu file
		B3: Nếu thời gian hiện tại lớn hơn thời gian lưu file 3600 (1h) thì đọc file trên Server
		B4: Lưu nội dung file trên Server vào file trên Host
		B5: Đọc file lưu trên Host và hiển thị
	*/
	$file_host = "data/top_50.txt";

	$time = time();
    $theheid = $_SESSION['thehe'];

	$fp_host = fopen($file_host, "a+");
	$rank_info = fgets($fp_host);
	fclose($fp_host);
    
    $rank_arr = unserialize_safe($rank_info);
    $time_top = $rank_arr[$theheid]['time'];
        $time_top = intval($time_top);
    
	if ( ($time_top > $time) || ( ($time >= ($time_top+300)) && (date("d", $time) != date("d", $rank_arr[$theheid]['timeget'])) ) )
	{
		$getcontent_url = $server_url . "/view_top50.php";
        $getcontent_data = array(
            'thehe'    =>  $theheid,
            'passtransfer'    =>  $passtransfer
        ); 
        
        $show = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

		if ( !empty($show) )
		{
            $show_explode = explode('<nbb>', $show);
            if(isset($show_explode[1]) && $show_explode[1] == 'OK') {
                $rank_get_arr = unserialize_safe($show_explode[2]);
                $rank_get_arr[$theheid]['time'] = $time;
                $rank_arr[$theheid] = $rank_get_arr[$theheid];
                
                $rank_serialize = serialize($rank_arr);
                
                //Ghi vào file
        			$fp = fopen($file_host, "w+");  
        			fputs ($fp, $rank_serialize);
        			fclose($fp);
        		//End Ghi vào File
                
                $time_top = $time;
            } else {
                $err = "Lỗi : $show";
            }
		}
	}
    
    $time_top = date("d/m/Y",$rank_arr[$theheid]['timeget']);

	foreach($rank_arr[$theheid] as $key => $value) {
        if(is_array($rank_arr[$theheid][$key])) {
            switch($value['class'])
            {
                case 0:  $rank_arr[$theheid][$key]['class'] = 'Dark Wizark'; break;
                case 1:  $rank_arr[$theheid][$key]['class'] ='Soul Master'; break;
                case 2: $rank_arr[$theheid][$key]['class'] ='Grand Master'; break;
                case 3:  $rank_arr[$theheid][$key]['class'] ='Grand Master'; break;
                
                case 16:  $rank_arr[$theheid][$key]['class'] ='Dark Knight'; break;
                case 17:  $rank_arr[$theheid][$key]['class'] ='Blade Knight'; break;
                case 18:    $rank_arr[$theheid][$key]['class'] ='Blade Master'; break;
                case 19:  $rank_arr[$theheid][$key]['class'] ='Blade Master'; break;
                
                case 32:  $rank_arr[$theheid][$key]['class'] ='Elf'; break;
                case 33:  $rank_arr[$theheid][$key]['class'] ='Muse Elf'; break;
                case 34:    $rank_arr[$theheid][$key]['class'] ='Hight Elf';  break;
                case 35:  $rank_arr[$theheid][$key]['class'] ='Hight Elf';  break;
                
                case 48:  $rank_arr[$theheid][$key]['class'] ='Magic Gladiator'; break;
                case 49:    $rank_arr[$theheid][$key]['class'] ='Duel Master'; break;
                case 50:  $rank_arr[$theheid][$key]['class'] ='Duel Master'; break;
                
                case 64:  $rank_arr[$theheid][$key]['class'] ='DarkLord'; break;
                case 65:    $rank_arr[$theheid][$key]['class'] ='Lord Emperor'; break;
                case 66:  $rank_arr[$theheid][$key]['class'] ='Lord Emperor'; break;
                
                case 80:  $rank_arr[$theheid][$key]['class'] ='Sumonner'; break;
                case 81:  $rank_arr[$theheid][$key]['class'] ='Bloody Summoner'; break;
                case 82:    $rank_arr[$theheid][$key]['class'] ='Dimension Master'; break;
                case 83:  $rank_arr[$theheid][$key]['class'] ='Dimension Master'; break;
                
                case 96:  $rank_arr[$theheid][$key]['class'] ='Rage Fighter'; break;
                case 97:    $rank_arr[$theheid][$key]['class'] ='First Master'; break;
                case 98:  $rank_arr[$theheid][$key]['class'] ='First Master'; break;
            }
        }
    }
    
    $rank = $rank_arr[$theheid];
    $title_top = "TOP 50 lúc 0h00 $time_top";
    $thehe_name = $thehe_choise[$theheid];
    
	$page_template = 'templates/rank/rank50.tpl';
}
}
?>