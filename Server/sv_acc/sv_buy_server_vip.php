<?php
include_once('config/config_buy_server_vip.php');

$login = $_POST['login'];
$name = $_POST['name'];
$pass2 = $_POST['pass2'];
$vip_choose = abs(intval($_POST['vip_choose']));

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    $string_login = $_POST['string_login'];
    checklogin($login, $string_login);

    kiemtra_pass2($login, $pass2);
    kiemtra_online($login);

    $vip_day_choise = $buy_server_vip_day[$vip_choose];
    $vip_price_choise = $buy_server_vip_price[$vip_choose];

    if ($vip_choose >= $buy_server_vip_slg) {
        echo "Sai cấu hình. Liên hệ Admin để Fix.";
        exit();
    }

    $gcoin_check = $db->Execute("Select gcoin From MEMB_INFO where memb___id='$login'");
    $gcoin = $gcoin_check->fetchrow();

    $kt_gcoin = $gcoin[0] - $vip_price_choise;

    if ($kt_gcoin < 0) {
        echo "Bạn có $gcoin[0] Gcoin. Bạn cần $vip_price_choise Gcoin để đăng kí gói VIP này.";
        exit();
    }

    $msquery_update_gcoin = "UPDATE MEMB_INFO SET [gcoin] = '$kt_gcoin' WHERE memb___id = '$login'";
    $db->Execute($msquery_update_gcoin) or die("Lỗi Query: $msquery_update_gcoin");

    $msquery_update_account = "UPDATE MEMB_INFO SET out__days = GETDATE(), SCFIsVip = 1, SCFVipDays = SCFVipDays + $vip_day_choise WHERE memb___id = '$login'";
    $db->Execute($msquery_update_account) or die("Lỗi Query: $msquery_update_account");

    _use_money($login, $vip_price_choise, 0, 0);

//Ghi vào Log
    $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    $info_log_result = $db->Execute($info_log_query);
    check_queryerror($info_log_query, $info_log_result);
    $info_log = $info_log_result->fetchrow();

    $log_acc = "$login";
    $log_gcoin = $info_log[0];
    $log_gcoin_km = $info_log[1];
    $log_vpoint = $info_log[2];
    $log_price = "- $vip_price_choise Gcoin";
    $log_Des = "$name Đăng kí vào Server VIP";
    $log_time = $timestamp;

    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    $insert_log_result = $db->execute($insert_log_query);
    check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log
    echo "OK<nbb>Bạn đã đăng kí vào Server VIP thành công.";
}
?>
