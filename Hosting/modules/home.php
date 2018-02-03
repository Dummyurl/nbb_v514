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
 
	include('config/config_napthe.php');
	include('config/config_event.php');
    include('config/config_giftcode_rs.php');
    include('config/config_giftcode_week.php');
    include('config/config_giftcode_month.php');
    include('config/config_giftcode_tanthu.php');
    include('config/config_daugianguoc.php');
    include('config/config_daugia.php');
	include('config/config_thehe.php');

	if($Use_DauGiaNguoc == 1) {
		$line = 0;
		$fopen_host = fopen("data/daugianguoc_bidding.txt", "r");
		while (!feof($fopen_host)) {
			$line++;
			$info = fgets($fopen_host);
			if ( $line == 1 )
			{
				$time_top = gmdate("h:i A d/m/Y", intval($info));
			}
			else {
	              $listitem = $info;
			}
		}
		fclose($fopen_host);
	    $listitem_arr = unserialize_safe($listitem);
	    if(!is_array($listitem_arr)) $listitem_arr = array();
	}
    
    if($Use_DauGia == 1) {
        $line = 0;
    	$fopen_host = fopen('data/daugia_bidding.txt', "r");
    	while (!feof($fopen_host)) {
    		$line++;
    		$info = fgets($fopen_host);
    		if ( $line == 1 )
    		{
    			$time_top = gmdate("h:i A d/m/Y", intval($info));
    		}
    		else {
                  $data = $info;
    		}
    	}
    	fclose($fopen_host);
        $data_arr = unserialize_safe($data);
        if(!is_array($data_arr)) {
            $listitem_dg_arr = array();
            $item_group_count = array();
        } else {
            $listitem_dg_arr = $data_arr['listitem'];
            $item_group_count = $data_arr['item_group_count'];
        }
        
        $group_item = array();
        foreach($item_group_count as $group_type => $group_count) {
            switch ($group_type){ 
            	case 0:    $group_name = $lang_itemgroup_sword;
            	break;
            
            	case 1:    $group_name = $lang_itemgroup_axe;
            	break;
                
            	case 2:    $group_name = $lang_itemgroup_mace;
            	break;
                
            	case 3:    $group_name = $lang_itemgroup_crepter;
            	break;
                
            	case 4:    $group_name = $lang_itemgroup_spear;
            	break;
                
            	case 5:    $group_name = $lang_itemgroup_bow;
            	break;
                
            	case 6:    $group_name = $lang_itemgroup_crossbow;
            	break;
                
            	case 7:    $group_name = $lang_itemgroup_staff;
            	break;
                
            	case 8:    $group_name = $lang_itemgroup_shield;
            	break;
                
            	case 9:    $group_name = $lang_itemgroup_helm;
            	break;
                
            	case 10:    $group_name = $lang_itemgroup_armor;
            	break;
                
            	case 11:    $group_name = $lang_itemgroup_pant;
            	break;
                
            	case 12:    $group_name = $lang_itemgroup_glove;
            	break;
                
            	case 13:    $group_name = $lang_itemgroup_boot;
            	break;
                
            	case 14:    $group_name = $lang_itemgroup_wing;
            	break;
                
            	case 15:    $group_name = $lang_itemgroup_pet;
            	break;
                
            	case 16:    $group_name = $lang_itemgroup_ring;
            	break;
                
            	case 17:    $group_name = $lang_itemgroup_pendant;
            	break;
                
            	case 18:    $group_name = $lang_itemgroup_orb;
            	break;
                
            	case 19:    $group_name = $lang_itemgroup_scrool;
            	break;
                
            	case 20:    $group_name = $lang_itemgroup_jewel;
            	break;
                
            	case 21:    $group_name = $lang_itemgroup_potion;
            	break;
                
            	case 22:    $group_name = $lang_itemgroup_amulet;
            	break;
                
            	case 23:    $group_name = $lang_itemgroup_event;
            	break;
                
            	case 24:    $group_name = $lang_itemgroup_eventmix;
            	break;
                
            	case 25:    $group_name = $lang_itemgroup_quest;
            	break;
                
            	case 26:    $group_name = $lang_itemgroup_gift;
            	break;
                
            	case 27:    $group_name = $lang_itemgroup_petmix;
            	break;
                
            	case 28:    $group_name = $lang_itemgroup_itemmix;
            	break;
                
            	case 29:    $group_name = $lang_itemgroup_castlesiege;
            	break;
                
            	default :    $group_name = $lang_itemgroup_other;
            }
            $group_item[] = array(
                'group_type'    =>  $group_type,
                'group_name'    =>  $group_name,
                'group_count'   =>  $group_count
            );
        }
    }
        
    $page_template = "templates/home.tpl";
?>