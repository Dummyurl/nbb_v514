<?php
include('checklic.php');
include('request_count.php');

$file_kqxs = "kqxs.txt";
$URL_MienBac = "http://ketquaxoso.24h.com.vn/xo-so-mien-bac/";

date_default_timezone_set('Asia/Ho_Chi_Minh');
$timestamp = time();

$date_now = date('d/m/Y', $timestamp);
$date_yesterday = date('d/m/Y', $timestamp - 24*60*60);
$hour_now = date('H', $timestamp);

$kqxsget_arr = _readlic($file_kqxs);

if($hour_now >= 19) {
    if(isset($kqxsget_arr[$date_now])) {
        echo "<info>OK</info><kqxs>". json_encode($kqxsget_arr[$date_now]) ."</kqxs>";
    } else {
        //Lấy kết quả
    	$get_MienBac = @file_get_contents($URL_MienBac);
    	
    	$tach_kqxs1 = explode($date_now, $get_MienBac);
        if(count($tach_kqxs1) > 1) {
            $tach_kqxs2 = explode('Để nhận kết quả xổ số', $tach_kqxs1[1]);
            $tach_kqxs3 = explode('tengiai', $tach_kqxs2[0]);
            
            $giaidacbiet_1 = explode('FF0000">', $tach_kqxs3[1]);
            $giaidacbiet_2 = explode('</td>', $giaidacbiet_1[2]);
            if(strlen(abs(intval($giaidacbiet_2[0]))) > 2) {
                $giaidacbiet = abs(intval(substr($giaidacbiet_2[0], -2)));
                
                $giai1_1 = explode('fff;">', $tach_kqxs3[2]);
                $giai1_2 = explode('</td>', $giai1_1[2]);
                $giai1 = abs(intval(substr($giai1_2[0], -2)));
                
                $giai2_1 = explode('fbe6c4;">', $tach_kqxs3[3]);
                $giai2_2 = explode('</td>', $giai2_1[2]);
                $giai2 = explode('-', $giai2_2[0]);
                    foreach($giai2 as $k => $v) {
                        $giai2[$k] = abs(intval(substr($giai2[$k], -2)));
                    }
                
                $giai3_1 = explode('fff;">', $tach_kqxs3[4]);
                $giai3_2 = explode('</td>', $giai3_1[2]);
                $giai3 = explode('-', $giai3_2[0]);
                    foreach($giai3 as $k => $v) {
                        $giai3[$k] = abs(intval(substr($giai3[$k], -2)));
                    }
                
                $giai4_1 = explode('fbe6c4;">', $tach_kqxs3[5]);
                $giai4_2 = explode('</td>', $giai4_1[2]);
                $giai4 = explode('-', $giai4_2[0]);
                    foreach($giai4 as $k => $v) {
                        $giai4[$k] = abs(intval(substr($giai4[$k], -2)));
                    }
                
                $giai5_1 = explode('fff;">', $tach_kqxs3[6]);
                $giai5_2 = explode('</td>', $giai5_1[2]);
                $giai5 = explode('-', $giai5_2[0]);
                    foreach($giai5 as $k => $v) {
                        $giai5[$k] = abs(intval(substr($giai5[$k], -2)));
                    }
                
                $giai6_1 = explode('fbe6c4;">', $tach_kqxs3[7]);
                $giai6_2 = explode('</td>', $giai6_1[2]);
                $giai6 = explode('-', $giai6_2[0]);
                    foreach($giai6 as $k => $v) {
                        $giai6[$k] = abs(intval(substr($giai6[$k], -2)));
                    }
                
                $giai7_1 = explode('fff;">', $tach_kqxs3[8]);
                $giai7_2 = explode('</td>', $giai7_1[2]);
                $giai7 = explode('-', $giai7_2[0]);
                    foreach($giai7 as $k => $v) {
                        $giai7[$k] = abs(intval(substr($giai7[$k], -2)));
                    }
                
                
                $kqxsget_arr[$date_now] = array(
                    0   =>  $giaidacbiet,
                    1   =>  $giai1,
                    2   =>  $giai2,
                    3   =>  $giai3,
                    4   =>  $giai4,
                    5   =>  $giai5,
                    6   =>  $giai6,
                    7   =>  $giai7
                );
                
                _writelic($file_kqxs, $kqxsget_arr);
                
                echo "<info>OK</info><kqxs>". json_encode($kqxsget_arr[$date_now]) ."</kqxs>";
            } else {
                echo 'none';
            }
        } else {
            echo 'none';
        }
    }
} else {
    echo 'nottime';
}

?>