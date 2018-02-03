<?php
include('config/config_buy_server_vip.php');
if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'buy_server_vip') {
        $pass2 = $_POST['pass2'];
        $vip_choose = $_POST['vip_choose'];

        if ($sendsv === false) {
            $notice = "Tốc độ xử lý của bạn quá nhanh, vui lòng chờ vài giây rồi tiếp tục thực hiện.";
        } elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2)) {
            $notice = "<font color='red'>Dữ liệu lỗi - Mật khẩu Web cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
        } elseif (preg_match("/[^0-9$]/", $vip_choose)) {
            $notice = "<font color='red'>Dữ liệu lỗi - Chưa chọn gói VIP.</font>";
        } else {

            $getcontent_url = $server_url . "/sv_acc.php";
            $getcontent_data = array(
                'login' => $_SESSION['mu_username'],
                'pass2' => $pass2,
                'vip_choose' => $vip_choose,

                'pagesv' => 'sv_buy_server_vip',
                'string_login' => $_SESSION['checklogin'],
                'passtransfer' => $passtransfer
            );

            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

            if (empty($reponse)) $notice = "<font size='3' color='red'>Server bảo trì.</font>";
            elseif ($reponse == "login_other") {
                $notice = "<font size='3' color='red'>Tài khoản đã được đăng nhập trên trình duyệt khác hoặc máy tính khác.</font>";
                session_destroy();
            } else {
                $info = explode('<nbb>',$reponse);
                if ($info[0] == 'OK') {
                    $notice = $info[1];

                    $_SESSION['acc_gcoin'] -= $buy_server_vip_price[$vip_choose];
                }
                else $notice = $reponse;
            }
        }
    }
}

$page_template = "templates/acc_manager/buy_server_vip.tpl";
?>