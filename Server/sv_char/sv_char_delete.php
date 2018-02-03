<?php

include_once('config/config_deletechar.php');

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

    $vpoint_check = $db->Execute("Select vpoint From MEMB_INFO where memb___id='$login'");
    $vpoint = $vpoint_check->fetchrow();

    $ktvpoint = $vpoint[0] - $deletechar_vpoint;

    if ($ktvpoint < 0) {
        echo "Bạn có $vpoint[0] V.Point. Bạn cần $deletechar_vpoint V.Point để xóa nhân vật.";
        exit();
    }

    $msquery_delete1 = "DELETE FROM Character WHERE AccountID='$login' AND Name = '$name'";
    $db->Execute($msquery_delete1) or die("Lỗi Query: $msquery_delete1");

    $sql_charlist_get = $db->Execute("SELECT Id, GameID1, GameID2, GameID3, GameID4, GameID5 FROM AccountCharacter WHERE Id='$login'");
    $charlist_get = $sql_charlist_get->fetchrow();

    $char_index = 0;
    for ($i = 1; $i < 6; $i++) {
        if ($charlist_get[$i] === $name) {
            $char_index = $i;
            break;
        }
    }

    if ($char_index) {
        $msquery_delete2 = "UPDATE AccountCharacter SET GameID$char_index = NULL WHERE Id='$login'";
        $db->Execute($msquery_delete2) or die("Lỗi Query: $msquery_delete2");
    } else {
        echo "Có lỗi trong quá trình xóa nhân vật. Liên hệ Admin để được hỗ trợ.";
        exit();
    }

    $msquery_update_vpoint = "UPDATE MEMB_INFO SET [vpoint] = '$ktvpoint' WHERE memb___id = '$login'";
    $db->Execute($msquery_update_vpoint) or die("Lỗi Query: $msquery_update_vpoint");

    _use_money($login, 0, 0, $deletechar_vpoint);

//Ghi vào Log
    $info_log_query = "SELECT gcoin, gcoin_km, vpoint FROM MEMB_INFO WHERE memb___id='$login'";
    $info_log_result = $db->Execute($info_log_query);
    check_queryerror($info_log_query, $info_log_result);
    $info_log = $info_log_result->fetchrow();

    $log_acc = "$login";
    $log_gcoin = $info_log[0];
    $log_gcoin_km = $info_log[1];
    $log_vpoint = $info_log[2];
    $log_price = "- $deletechar_vpoint Vpoint";
    $log_Des = "$name Xóa nhân vật";
    $log_time = $timestamp;

    $insert_log_query = "INSERT INTO Log_TienTe (acc, gcoin, gcoin_km, vpoint, price, Des, time) VALUES ('$log_acc', $log_gcoin, $log_gcoin_km, $log_vpoint, '$log_price', N'$log_Des', $log_time)";
    $insert_log_result = $db->execute($insert_log_query);
    check_queryerror($insert_log_query, $insert_log_result);
//End Ghi vào Log

    _topreset_sub($name, 1, 1800);
    echo "OK<nbb>Nhân vật $name đã xóa thành công. Bạn vui lòng đăng nhập lại để cập nhật thông tin nhân vật.";
}

?>
