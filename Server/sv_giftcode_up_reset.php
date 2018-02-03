<?php
include_once('config/config_giftcode_up_reset.php');
include_once("security.php");
include_once("config.php");
include_once("function.php");

$login = $_POST['login'];
$name = $_POST['name'];
$pass2 = $_POST['pass2'];

$passtransfer = $_POST['passtransfer'];

if ($passtransfer == $transfercode) {

    $string_login = $_POST['string_login'];
    checklogin($login, $string_login);

    if (check_nv($login, $name) == 0) {
        echo "Nhân vật <b>{$name}</b> không nằm trong tài khoản <b>{$login}</b>. Vui lòng kiểm tra lại.";
        exit();
    }

    kiemtra_pass2($login, $pass2);
    kiemtra_char($login, $name);
    kiemtra_online($login);

    $gcoin_check = $db->Execute("Select gcoin From MEMB_INFO where memb___id='$login'");
    $gcoin = $gcoin_check->fetchrow();

    $kt_gcoin = $gcoin[0] - $giftcode_up_reset_gcoin;

    if ($kt_gcoin < 0) {
        echo "Bạn có $gcoin[0] Gcoin. Bạn cần $giftcode_up_reset_gcoin Gcoin để nhận loại Gifcode này.";
        exit();
    }

    $msquery_update_gcoin = "UPDATE MEMB_INFO SET [gcoin] = '$kt_gcoin' WHERE memb___id = '$login'";
    $db->Execute($msquery_update_gcoin) or die("Lỗi Query: $msquery_update_gcoin");

    $check_use_giftcode_query = "SELECT status, gift_code FROM GiftCode WHERE acc='$login' AND type=20";
    $check_use_giftcode_result = $db->Execute($check_use_giftcode_query);
    $check_use_giftcode = $check_use_giftcode_result->numrows();
    if ($check_use_giftcode > 0) {
        $gift_status = $check_use_giftcode_result->FetchRow();
        if ($gift_status[0] == 1) {
            echo "Tài khoản $login đã nhận Giftcode up reset với mã: " . $gift_status[1];
            exit();
        } else {
            echo "Tài khoản $login đã sử dụng Giftcode. Không thể nhận thêm";
            exit();
        }
    }

    $characters = 'abcdefghijklmnpqrstuvwxyz123456789';
    $random_string_length = 10;

    $gift_created = 0;
    while ($gift_created == 0) {
        $giftcode = '';
        for ($i = 0; $i < $random_string_length; $i++) {
            $giftcode .= $characters[rand(0, strlen($characters) - 1)];
        }

        $giftcode = strtoupper($giftcode);

        $giftcode_exits_query = "SELECT * FROM GiftCode WHERE acc='$login' AND gift_code='$giftcode' AND type=20 AND (status=0 OR status=1)";
        $giftcode_exits_result = $db->Execute($giftcode_exits_query);
        $giftcode_exits = $giftcode_exits_result->NumRows();
        if ($giftcode_exits == 0) $gift_created = 1;
    }

    $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, name, type, gift_time, ngay, status) VALUES ('$giftcode', '$login', '$name', 20, $timestamp, '" . date("Y-m-d", $timestamp) . "', 1)";
    $giftcode_insert_result = $db->Execute($giftcode_insert_query);
    echo "OK<nbb>Nhân vật $name đã đăng kí nhận Giftcode Up Reset thành công. Mã Giftcode của bạn là: <strong>$giftcode</strong>.";

    _use_money($login, $giftcode_up_reset_gcoin, 0, 0);

//Ghi vào Log
    $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    $info_log_result = $db->Execute($info_log_query);
    check_queryerror($info_log_query, $info_log_result);
    $info_log = $info_log_result->fetchrow();

    $log_acc = "$login";
    $log_gcoin = $info_log[0];
    $log_gcoin_km = $info_log[1];
    $log_vpoint = $info_log[2];
    $log_price = "- $giftcode_up_reset_gcoin Gcoin";
    $log_Des = "$name Đăng kí nhận Giftcode Up Reset";
    $log_time = $timestamp;

    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    $insert_log_result = $db->execute($insert_log_query);
    check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log
}
?>

