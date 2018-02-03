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

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    $kqxs_q = "SELECT TOP 1 giai0, giai1, giai21, giai22, giai31, giai32, giai33, giai34, giai35, giai36, giai41, giai42, giai43, giai44, giai51, giai52, giai53, giai54, giai55, giai56, giai61, giai62, giai63, giai71, giai72, giai73, giai74, ngay FROM NBB_KQXS ORDER BY ngay DESC";
    $kqxs_r = $db->Execute($kqxs_q);
        check_queryerror($kqxs_q, $kqxs_r);
    $kqxs_f = $kqxs_r->FetchRow();
    
    if(count($kqxs_f) > 0) {
        $kqxs_arr['date'] = date('Y-m-d', strtotime($kqxs_f[27]));
        $kqxs_arr['kqxs'] = array(
            0   =>  $kqxs_f[0],
            1   =>  $kqxs_f[1],
            2   =>  array(
                        0   =>  $kqxs_f[2],
                        1   =>  $kqxs_f[3]
                    ),
            3   =>  array(
                        0   =>  $kqxs_f[4],
                        1   =>  $kqxs_f[5],
                        2   =>  $kqxs_f[6],
                        3   =>  $kqxs_f[7],
                        4   =>  $kqxs_f[8],
                        5   =>  $kqxs_f[9]
                    ),
            4   =>  array(
                        0   =>  $kqxs_f[10],
                        1   =>  $kqxs_f[11],
                        2   =>  $kqxs_f[12],
                        3   =>  $kqxs_f[13]
                    ),
            5   =>  array(
                        0   =>  $kqxs_f[14],
                        1   =>  $kqxs_f[15],
                        2   =>  $kqxs_f[16],
                        3   =>  $kqxs_f[17],
                        4   =>  $kqxs_f[18],
                        5   =>  $kqxs_f[19]
                    ),
            6   =>  array(
                        0   =>  $kqxs_f[20],
                        1   =>  $kqxs_f[21],
                        2   =>  $kqxs_f[22]
                    ),
            7   =>  array(
                        0   =>  $kqxs_f[23],
                        1   =>  $kqxs_f[24],
                        2   =>  $kqxs_f[25],
                        3   =>  $kqxs_f[26]
                    )
        );
        
        $kqxs_data = json_encode($kqxs_arr);
        echo "<kqxs>$kqxs_data</kqxs>";
    }
}

?>