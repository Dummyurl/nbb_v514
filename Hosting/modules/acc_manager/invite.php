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

$link_invite = $host_url.'/index.php?mod=register&invite='.$_SESSION['mu_username'];

if(!isset($_SESSION['mu_invdata']))
{
	
	$getcontent_url = $server_url . "/view.php";
    $getcontent_data = array(
        'login'    =>  $_SESSION['mu_username'],
        'action'    =>  'view_invite',
        'passtransfer'    =>  $passtransfer
    ); 
    
    $show_reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

	if ( empty($show_reponse) ) $notice = "<font color='red'>Server bảo trì.</font>";
	else {
		$invite_split = explode('<netbanbe>',$show_reponse);
		if( $invite_split[0] == 'OK')
		{
			$_SESSION['mu_invdata'] = 1;
			$slg_inv = count($invite_split)-1;
			$_SESSION['slg_inv'] = $slg_inv;
			for($i=1;$i<=$slg_inv;$i++)
			{
				$info_inv = explode('<nbb>',$invite_split[$i]);
				$time_inv = date('d/m/Y H:i',$info_inv[1]);
				$_SESSION['info_invite'][$i] = array(
					'character' => $info_inv[0] ,
					'time_inv' =>  $time_inv ,
					'vpoint' => $info_inv[2]
				);
			}
		}
	}
}

$page_template = "templates/acc_manager/invite.tpl";
?>