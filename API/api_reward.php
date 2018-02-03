<?php

/** 
 * @Project NWebMU v4
 * @author [NetBanBe Group]
 * @copyright 6/10/2011
 * @WebSite http://netbanbe.net
 */

include('checklic.php');

include('func_item.php');

$itemdata_arr = ItemDataArr();

$action = $_POST['action'];

switch ($action){ 
    
    case 'reward_cfg_add':
        $code = $_POST['code'];
        $code_basic = '00000012345678000000000000000000';
        
        $id 			= substr($code,0,2); 	// Item ID
        $group 			= substr($code,18,1); 	// Item Type
        $durability		= substr($code,4,2); 	// Item Durability
        
        $item_fresh = substr_replace($code_basic, $id, 0, 2);
        $item_fresh = substr_replace($item_fresh, $group, 18, 1);
        $item_fresh = substr_replace($item_fresh, $durability, 4, 2);
        
        $item_info = ItemInfo($itemdata_arr, $item_fresh);
        
        $itemreward_info['code'] = $item_fresh;
        $itemreward_info['name'] = $item_info['name'];
        $itemreward_info['image'] = $item_info['image'];
        $itemreward_info['exl_type'] = $item_info['type'];
        
        switch ($item_info['group']){ 
        	case 0:
                $itemreward_info['reward_type'] = 2;
        	break;
        
        	case 1:
                $itemreward_info['reward_type'] = 5;
        	break;
        
        	case 2:
                $itemreward_info['reward_type'] = 5;
        	break;
        
        	case 3:
                $itemreward_info['reward_type'] = 5;
        	break;
        
        	case 4:
                $itemreward_info['reward_type'] = 4;
        	break;
        
        	case 5:
                $itemreward_info['reward_type'] = 3;
        	break;
        
        	case 6:
                $itemreward_info['reward_type'] = 6;
        	break;
        
        	case 7:
                $itemreward_info['reward_type'] = 7;
        	break;
        
        	case 8:
                $itemreward_info['reward_type'] = 8;
        	break;
        
        	case 9:
                $itemreward_info['reward_type'] = 9;
        	break;
        
        	case 10:
                $itemreward_info['reward_type'] = 10;
        	break;
        
        	case 11:
                $itemreward_info['reward_type'] = 11;
        	break;
        
        	case 12:
                if(in_array($item_info['id'], array(0, 1, 2))) {
                    $itemreward_info['reward_type'] = 13;
                } elseif(in_array($item_info['type'], array(3, 7, 8, 9))) {
                    $itemreward_info['reward_type'] = 13;
                } else {
                    $itemreward_info['reward_type'] = 1;
                }
                
        	break;
        
        	case 13:
                if(in_array($item_info['type'], array(3, 7, 8, 9))) {
                    $itemreward_info['reward_type'] = 13;
                } elseif(in_array($item_info['type'], array(4, 5))) {
                    $itemreward_info['reward_type'] = 12;
                } else {
                    $itemreward_info['reward_type'] = 1;
                }
                
        	break;
        
        	default :
                $itemreward_info['reward_type'] = 1;
        }
        
        $info = "OK";
        $message = "";
            
        $item_reward = json_encode($itemreward_info);
            
        echo "
            <info>$info</info>
            <message>" . $message ."</message>
            <item_reward_info>" . $item_reward ."</item_reward_info>
        ";
    break;
    
    case 'reward_item_info':
        $code = $_POST['code'];
        $luck = abs(intval($_POST['luck']));         if($luck != 1) $luck = 0;
        $exl[1] = abs(intval($_POST['exl1']));         if($exl[1] != 1) $exl[1] = 0;
        $exl[2] = abs(intval($_POST['exl2']));         if($exl[2] != 1) $exl[2] = 0;
        $exl[3] = abs(intval($_POST['exl3']));         if($exl[3] != 1) $exl[3] = 0;
        $exl[4] = abs(intval($_POST['exl4']));         if($exl[4] != 1) $exl[4] = 0;
        $exl[5] = abs(intval($_POST['exl5']));         if($exl[5] != 1) $exl[5] = 0;
        $exl[6] = abs(intval($_POST['exl6']));         if($exl[6] != 1) $exl[6] = 0;
        $lvl = abs(intval($_POST['lvl']));           if($lvl < 0 || $lvl > 15) $lvl = 0;
        $opt = abs(intval($_POST['opt']));           if($opt < 0 || $opt > 7) $opt = 0;
        $rewardday = abs(intval($_POST['rewardday']));           if($rewardday != 3 && $rewardday != 7 && $rewardday != 30) $rewardday = 1;
        
        $item_info = ItemInfo($itemdata_arr, $code);
        
        $Num = $item_info['group']*512 + $item_info['id'];
        
        $Excellent = 0;
        if($exl[1] == 1) $Excellent += 1;
        if($exl[2] == 1) $Excellent += 2;
        if($exl[3] == 1) $Excellent += 4;
        if($exl[4] == 1) $Excellent += 8;
        if($exl[5] == 1) $Excellent += 16;
        if($exl[6] == 1) $Excellent += 32;
        
        $Skill = 0;
        if($item_info['group'] < 6) {
            $Skill = 1;
        }
        
        $item_reward_info = array(
            'Num'   =>  $Num,
            'Lvl'   =>  $lvl,
            'Opt'   =>  $opt,
            'Luck'  =>  $luck,
            'Skill' =>  $Skill,
            'Dur'   =>  $item_info['dur'],
            'Excellent' =>  $Excellent,
            'Ancient'   =>  0,
            'JOH'   =>  0,
            'Sock1'   =>  0,
            'Sock2'   =>  0,
            'Sock3'   =>  0,
            'Sock4'   =>  0,
            'Sock5'   =>  0,
            'Days'   =>  $rewardday,
            'SerialFFFFFFFE'   =>  0
        );
        
        $info = "OK";
        $message = "";
            
        $item_reward = json_encode($item_reward_info);
            
        echo "
            <info>$info</info>
            <message>" . $message ."</message>
            <item_reward_info>" . $item_reward ."</item_reward_info>
        ";
    break;
}

?>