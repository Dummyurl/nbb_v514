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
        $tltype_cap = $_POST['tltype_cap'];
        $tltype_exp = $_POST['tltype_exp'];
        $tl_point = $_POST['tl_point'];
        $tuluyen_expcoban = $_POST['tuluyen_expcoban'];
        $tuluyen_expextra = $_POST['tuluyen_expextra'];
            
            $tltype_exp_new = $tltype_exp + 10;
            $tl_point_new = $tl_point - 10;
            
            $exp_tuluyen_sum = 0;
            for($i=1; $i<=$tltype_cap+1; $i++) {
                $exp_tuluyen = floor($tuluyen_expcoban * (1 + $tuluyen_expextra * ($i-1) ));
                $exp_tuluyen_sum = $exp_tuluyen_sum + $exp_tuluyen;
            }
            
            if( $tltype_exp_new < $exp_tuluyen_sum ) {   // Kg tang cap
                $tangcap = 0;
            } else {    // Tang cap
                $tangcap = 1;
            }
        
        $tuluyen_arr = array(
            'tltype_exp_new'   =>  $tltype_exp_new,
            'tl_point_new' =>  $tl_point_new,
            'tangcap' =>  $tangcap
        );
        $tuluyen_data = json_encode($tuluyen_arr);
        
        echo "
            <info>OK</info>
            <tuluyen>$tuluyen_data</tuluyen>
            ";
	break;

	case 'thangcap':
        $tltype_cap = $_POST['tltype_cap'];
        $tuluyen_expcoban = $_POST['tuluyen_expcoban'];
        $tuluyen_expextra = $_POST['tuluyen_expextra'];
        $tuluyen_cpcoban = $_POST['tuluyen_cpcoban'];
        $tuluyen_cpextra = $_POST['tuluyen_cpextra'];
        $tuluyen_pointcoban = $_POST['tuluyen_pointcoban'];
        $tuluyen_pointextra = $_POST['tuluyen_pointextra'];
        $tltype_cp = $_POST['tltype_cp'];
        $tltype_exp = $_POST['tltype_exp'];
        
        $exp_tuluyen_sum = 0;
        $cp_sum = 0;
        $point_new = 0;
        for($i=1; $i<=$tltype_cap+1; $i++) {
            $exp_tuluyen = floor($tuluyen_expcoban * (1 + $tuluyen_expextra * ($i-1) ));
            $exp_tuluyen_sum = $exp_tuluyen_sum + $exp_tuluyen;
            $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
            $pointcap = floor($tuluyen_pointcoban * (1 + $tuluyen_pointextra * ($i-1) ));
            $point_new = $point_new + $pointcap;
        }
        $cp_rand = rand(4, 5);
        $tltype_cp_new = $tltype_cp + $cp_rand;
        $tltype_cp_percent = (floor($tltype_cp_new/$cp_sum*100) < 100) ? number_format(($tltype_cp_new/$cp_sum*100), 2, ',', '.') : 100;
        
        $exp_tuluyen_next = 0;
        $point_next = 0;
        for($i=1; $i<=$tltype_cap+2; $i++) {
            $exp_tuluyen_cap = floor($tuluyen_expcoban * (1 + $tuluyen_expextra * ($i-1) ));
            $exp_tuluyen_next = $exp_tuluyen_next + $exp_tuluyen_cap;
            $pointcap = floor($tuluyen_pointcoban * (1 + $tuluyen_pointextra * ($i-1) ));
            $point_next = $point_next + $pointcap;
        }
                    
        $tuluyen_arr = array(
            'exp_tuluyen_sum'   =>  $exp_tuluyen_sum,
            'tltype_cp_new' =>  $tltype_cp_new,
            'cp_rand' =>  $cp_rand,
            'tltype_cp_new' =>  $tltype_cp_new,
            'cp_sum' =>  $cp_sum,
            'tltype_cp_percent' =>  $tltype_cp_percent,
            'point_new' =>  $point_new,
            'point_next' =>  $point_next,
            'exp_tuluyen_next' =>  $exp_tuluyen_next
        );
        $tuluyen_data = json_encode($tuluyen_arr);
        
        echo "
            <info>OK</info>
            <tuluyen>$tuluyen_data</tuluyen>
            ";
	break;
    
	default :  // tuluyen_list
        $tuluyen_get = stripcslashes($_POST['tuluyen_fetch']);
            $tuluyen_fetch = json_decode($tuluyen_get, true);
        $tuluyen_cpcoban = $_POST['tuluyen_cpcoban'];
        $tuluyen_cpextra = $_POST['tuluyen_cpextra'];
        
        $cp_sum = 0;
        for($i=1; $i<=$tuluyen_fetch[0]+1; $i++) {
            $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_percent_str = (floor($tuluyen_fetch[3]/$cp_sum*100) < 100) ? floor($tuluyen_fetch[3]/$cp_sum*100) : 100;
        
        $cp_sum = 0;
        for($i=1; $i<=$tuluyen_fetch[4]+1; $i++) {
            $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_percent_agi = (floor($tuluyen_fetch[7]/$cp_sum*100) < 100) ? floor($tuluyen_fetch[7]/$cp_sum*100) : 100;
        
        $cp_sum = 0;
        for($i=1; $i<=$tuluyen_fetch[8]+1; $i++) {
            $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_percent_vit = (floor($tuluyen_fetch[3]/$cp_sum*100) < 100) ? floor($tuluyen_fetch[11]/$cp_sum*100) : 100;
        
        $cp_sum = 0;
        for($i=1; $i<=$tuluyen_fetch[12]+1; $i++) {
            $cp_cap = floor($tuluyen_cpcoban * (1 + $tuluyen_cpextra * ($i-1) ));
            $cp_sum = $cp_sum + $cp_cap;
        }
        $cp_percent_ene = (floor($tuluyen_fetch[3]/$cp_sum*100) < 100) ? floor($tuluyen_fetch[15]/$cp_sum*100) : 100;
        
        $tuluyen_arr = array(
            'str_cap'   =>  $tuluyen_fetch[0],
            'str_point' =>  $tuluyen_fetch[1],
            'str_exp' =>  $tuluyen_fetch[2],
            'str_cp' =>  $cp_percent_str,
            'agi_cap'   =>  $tuluyen_fetch[4],
            'agi_point'   =>  $tuluyen_fetch[5],
            'agi_exp'   =>  $tuluyen_fetch[6],
            'agi_cp'   =>  $cp_percent_agi,
            'vit_cap'   =>  $tuluyen_fetch[8],
            'vit_point'   =>  $tuluyen_fetch[9],
            'vit_exp'   =>  $tuluyen_fetch[10],
            'vit_cp'   =>  $cp_percent_vit,
            'ene_cap'   =>  $tuluyen_fetch[12],
            'ene_point'   =>  $tuluyen_fetch[13],
            'ene_exp'   =>  $tuluyen_fetch[14],
            'ene_cp'   =>  $cp_percent_ene,
            'tuluyen_point'   =>  $tuluyen_fetch[16]
        );
        $tuluyen_data = json_encode($tuluyen_arr);
        
        echo "
            <info>OK</info>
            <tuluyen>$tuluyen_data</tuluyen>
            ";
}
        
        
        

?>