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
 
include_once ("security.php");
include ('../config.php');
include ('function.php');

$title = "Tạo GiftCode Phát";
session_start();
if ($_POST[submit]) {
    $pass_admin = md5($_POST[useradmin]);
    if ($pass_admin == $passadmin)
        $_SESSION['useradmin'] = $passadmin;
}
if (!$_SESSION['useradmin'] || $_SESSION['useradmin'] != $passadmin) {
    echo "<center><form action='' method=post><input type='hidden' name='username' value='admin'>
	Code: <input type=password name=useradmin> <input type=submit name=submit value=Submit>
	</form></center>
	";
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title><?php echo $title; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8" />
</head>
<body>
<?php require('linktop.php'); ?>
<form action="" name="frm_giftphat" id="frm_giftphat" method="POST">
    <center>
    <strong>Số lượng GiftCode</strong> : <input name="gift_slg" id="gift_slg" value="<?php if($_POST['gift_slg']) echo $_POST['gift_slg']; ?>" size="3" />
    <input type="submit" name="submit_frm_giftphat" value="Tạo GiftCode Phát" />
    </center>
</form>

<?php

if($_POST['gift_slg']) {
    $gift_slg = abs(intval($_POST['gift_slg']));
    $acc_list_arr = explode(',', $acc_list);
    $err = "";
    $err_flag = false;
    
    if($gift_slg == 0) {
        $err .= "Số lượng GiftCode phải lớn hơn 0.<br />";
        $err_flag = true;
    }
    
    if($err_flag === false) {
        include_once('../config_license.php');
        include_once('../func_getContent.php');
        $getcontent_url = $url_license . "/api_giftcode_create.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'gift_slg'  =>  $gift_slg
        ); 
        
        $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
    
    	if ( empty($reponse) ) {
            $err .= "Server bao tri vui long lien he Admin de FIX";
            $err_flag = true;
        }
        else {
            $info = read_TagName($reponse, 'info');
            if($info == "Error") {
                $message = read_TagName($reponse, 'message');
                $err .= $message;
                $err_flag = true;
            } elseif($info == "OK") {
                $giftcode = read_TagName($reponse, 'giftcode');
                if(strlen($giftcode) == 0) {
                    $err .= "Du lieu tra ve loi. Vui long lien he Admin de FIX";
                    $err_flag = true;
                }
            } else {
                $err .= "Ket noi API gap su co. Admin MU vui long lien he nha cung cap NWebMU de kiem tra";
                $err_flag = true;
            }
        }
    }
    
    $msg = "";
    if($err_flag === false) {
        if($gift_slg == 1) {
            $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, type, gift_time, ngay, status) VALUES ('$giftcode', 5, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
            $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                check_queryerror($giftcode_insert_query, $giftcode_insert_result);
            $msg .= "GiftCode : <strong>$giftcode</strong> <br />";
        } else {
            $giftcode_arr = json_decode($giftcode, true);
            foreach($giftcode_arr as $giftcode) {
                $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, type, gift_time, ngay, status) VALUES ('$giftcode', 5, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
                $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                    check_queryerror($giftcode_insert_query, $giftcode_insert_result);
                $msg .= "GiftCode : <strong>$giftcode</strong> <br />";
            }
        }
    }
    
    if($err_flag === false) {
        echo $msg;
    }
    if($err_flag === true) {
        echo "<strong>Lỗi</strong> : <br />" . $err;
    } 
}

?>

</body>
</html>
<?php
$db->Close();
?>