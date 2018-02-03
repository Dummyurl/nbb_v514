<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');
include('request_count.php');

$action = $_POST['action'];

switch ($action) {
	
    case 'update':
        $songtu_lv = $_POST['songtu_lv'];
        $songtu_exp = $_POST['songtu_exp'];
        $songtu_point = $_POST['songtu_point'];
        $songtu_expcoban = $_POST['songtu_expcoban'];
        $songtu_expextra = $_POST['songtu_expextra'];
            
            $songtu_exp_new = $songtu_exp + 10;
            $songtu_point_new = $songtu_point - 10;
            
            $exp_songtu_sum = 0;
            for($i=1; $i<=$songtu_lv+1; $i++) {
                $exp_songtu = floor($songtu_expcoban * (1 + $songtu_expextra * ($i-1) ));
                $exp_songtu_sum = $exp_songtu_sum + $exp_songtu;
            }
            
            if( $songtu_exp_new < $exp_songtu_sum ) {   // Kg tang cap
                $tangcap = 0;
            } else {    // Tang cap
                $tangcap = 1;
            }
        
        $songtu_arr = array(
            'songtu_exp_new'   =>  $songtu_exp_new,
            'songtu_point_new' =>  $songtu_point_new,
            'tangcap' =>  $tangcap
        );
        $songtu_data = json_encode($songtu_arr);
        
        echo "
            <info>OK</info>
            <songtu>$songtu_data</songtu>
            ";
	break;

	case 'thangcap':
        $songtu_lv = $_POST['songtu_lv'];
        $songtu_cp = $_POST['songtu_cp'];
        $songtu_expcoban = $_POST['songtu_expcoban'];
        $songtu_expextra = $_POST['songtu_expextra'];
        $songtu_cpcoban = $_POST['songtu_cpcoban'];
        $songtu_cpextra = $_POST['songtu_cpextra'];
        
        $exp_songtu_sum = 0;
        $cp_sum = 0;
        $point_new = 0;
        for($i=1; $i<=$songtu_lv+1; $i++) {
            $exp_songtu = floor($songtu_expcoban * (1 + $songtu_expextra * ($i-1) ));
            $exp_songtu_sum = $exp_songtu_sum + $exp_songtu;
            $cp_cap = floor($songtu_cpcoban * (1 + $songtu_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_rand = rand(4, 5);
        $cp_new = $songtu_cp + $cp_rand;
        $cp_percent = (floor($cp_new/$cp_sum*100) < 100) ? number_format(($cp_new/$cp_sum*100), 2, ',', '.') : 100;
        
        $exp_songtu_next = 0;
        for($i=1; $i<=$songtu_lv+2; $i++) {
            $exp_songtu_cap = floor($songtu_expcoban * (1 + $songtu_expextra * ($i-1) ));
            $exp_songtu_next = $exp_songtu_next + $exp_songtu_cap;
        }
                    
        $songtu_arr = array(
            'exp_songtu_sum'   =>  $exp_songtu_sum,
            'cp_percent'   =>  $cp_percent,
            'cp_new'   =>  $cp_new,
            'cp_rand'  =>  $cp_rand,
            'exp_songtu_next'  =>  $exp_songtu_next
        );
        $songtu_data = json_encode($songtu_arr);
        
        echo "
            <info>OK</info>
            <songtu>$songtu_data</songtu>
            ";
	break;
    
	default :  // tuluyen_list
        $songtu_info = stripcslashes($_POST['songtu_info']);
            $songtu_arr = json_decode($songtu_info, true);
        $songtu_cpcoban = $_POST['songtu_cpcoban'];
        $songtu_cpextra = $_POST['songtu_cpextra'];
        
        $cp_sum = 0;
        for($i=1; $i<=$songtu_arr['songtu_lv']+1; $i++) {
            $cp_cap = floor($songtu_cpcoban * (1 + $songtu_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_percent = (floor($songtu_arr['songtu_cp']/$cp_sum*100) < 100) ? floor($songtu_arr['songtu_cp']/$cp_sum*100) : 100;
        
        $songtu_arr['cp_percent'] = $cp_percent;
        
        $songtu_data = json_encode($songtu_arr);
        
        echo "
            <info>OK</info>
            <tuluyen>$songtu_data</tuluyen>
            ";
}
        
        
        

?>