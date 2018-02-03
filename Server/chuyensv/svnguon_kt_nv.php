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
 
include('config.php');
include('function.php');

$nv_nguon = $_REQUEST['nv_nguon'];
$acc_nguon = $_REQUEST['acc_nguon'];

    if(check_nv($acc_nguon, $nv_nguon) == 0) {
        echo "Nhân vật <b>{$nv_nguon}</b> không nằm trong tài khoản <b>{$acc_nguon}</b>. Vui lòng kiểm tra lại."; exit();
    }

    $nv_check_query = "SELECT Class, CAST(Inventory AS image), Money, CAST(Quest AS image), Resets, Relifes, NoResetInDay, SCFPCPoints, point_event, PointUyThac, SCFMasterLevel, SCFSealItem, SCFSealTime, SCFScrollItem, SCFScrollTime FROM Character WHERE Name='$nv_nguon' AND AccountID='$acc_nguon'";
	$nv_check_result = $db->Execute($nv_check_query);
        check_queryerror($nv_check_query, $nv_check_result);
        
		$nv_check = $nv_check_result->fetchrow();
	
		$inventory = bin2hex($nv_check[1]);
		$inventory = strtoupper($inventory);
		$inventory = substr($inventory,0,76*32);

		$quest = bin2hex($nv_check[3]);
		$quest = strtoupper($quest);
        
        $class = $nv_check[0];
        $Money = $nv_check[2];
        $Resets = $nv_check[4];
        $NoResetInDay = $nv_check[6];
        $Relifes = $nv_check[5];
        $SCFPCPoints = $nv_check[7];
        $point_event = $nv_check[8];
        $PointUyThac = $nv_check[9];
        $SCFMasterLevel = $nv_check[10];
        $SCFSealItem = $nv_check[11];
        $SCFSealTime = $nv_check[12];
        $SCFScrollItem = $nv_check[13];
        $SCFScrollTime = $nv_check[14];
        
        $output = "
            <info>OK</info>
            <class>$class</class>
            <inventory>$inventory</inventory>
            <money>$Money</money>
            <quest>$quest</quest>
            <resets>$Resets</resets>
            <resetday>$NoResetInDay</resetday>
            <relife>$Relifes</relife>
            <scfpoint>$SCFPCPoints</scfpoint>
            <pointevent>$point_event</pointevent>
            <pointuythac>$PointUyThac</pointuythac>
            <scfmasterlv>$SCFMasterLevel</scfmasterlv>
            <SCFSealItem>$SCFSealItem</SCFSealItem>
            <SCFSealTime>$SCFSealTime</SCFSealTime>
            <SCFScrollItem>$SCFScrollItem</SCFScrollItem>
            <SCFScrollTime>$SCFScrollTime</SCFScrollTime>
        ";
        
		echo $output;
?>