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

$title = "Tạo GiftCode Tài Khoản";
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
<form action="" name="frm_giftacc" id="frm_giftacc" method="POST">
    <center>
    <strong>Tài khoản</strong> <i>(Các tài khoản cách nhau dấu ",")</i> : <input name="acc_list" id="acc_list" value="<?php if($_POST['acc_list']) echo $_POST['acc_list']; ?>" size="50" />
    <input type="submit" name="submit_frm_giftacc" value="Tạo GiftCode Tài khoản" />
</form>
<br /><br />
<form action="" name="frm_giftnv" id="frm_giftnv" method="POST">
    <center>
    <strong>Nhân vật</strong> <i>(Các nhân vật cách nhau dấu ",")</i> : <input name="nv_list" id="nv_list" value="<?php if($_POST['nv_list']) echo $_POST['nv_list']; ?>" size="50" />
    <input type="submit" name="submit_frm_giftnv" value="Tạo GiftCode Nhân vật" />
</form>
<?php

if($_POST['acc_list']) {
    $acc_list = $_POST['acc_list'];
    $acc_list_arr = explode(',', $acc_list);
    $err = "";
    $err_flag = false;
    foreach($acc_list_arr as $acc) {
        $acc = preg_replace("/ /", "", $acc);
        if(strlen($acc) > 0) {
            if (!preg_match("/^[a-zA-Z0-9_]*$/i", $acc))
        	{
                $err .= "Tài khoản $acc chứa ký tự đặc biệt.<br />";
                $err_flag = true;
        	}
            $acc_c_q = "SELECT count(memb___id) FROM MEMB_INFO WHERE memb___id='$acc'";
            $acc_c_r = $db->Execute($acc_c_q);
                check_queryerror($acc_c_q, $acc_c_r);
            $acc_c_f = $acc_c_r->FetchRow();
            if($acc_c_f[0] != 1) {
                $err .= "Tài khoản $acc không tồn tại.<br />";
                $err_flag = true;
            } else {
                $acc_arr[] = $acc;
            }
        }
    }
    
    if($err_flag === false) {
        $acc_count = count($acc_arr);
        if($acc_count == 0) {
            $err .= "Dữ liệu tài khoản sai.<br />";
            $err_flag = true;
        }
    }
        
    
    if($err_flag === false) {
        include_once('../config_license.php');
        include_once('../func_getContent.php');
        $getcontent_url = $url_license . "/api_giftcode_create.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'gift_slg'  =>  $acc_count
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
        if($acc_count == 1) {
            $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode', '".$acc_arr[0] ."', 4, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
            $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                check_queryerror($giftcode_insert_query, $giftcode_insert_result);
            $msg .= "GiftCode của tài khoản <strong>". $acc_arr[0] ."</strong> : <strong>$giftcode</strong> <br />";
        } else {
            $giftcode_arr = json_decode($giftcode, true);
            foreach($acc_arr as $key => $acc) {
                $giftcode_acc = $giftcode_arr[$key];
                $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode_acc', '".$acc_arr[$key] ."', 4, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
                $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                    check_queryerror($giftcode_insert_query, $giftcode_insert_result);
                $msg .= "GiftCode của tài khoản <strong>". $acc_arr[$key] ."</strong> : <strong>$giftcode_acc</strong> <br />";
            }
        }
    }
    echo "<hr />";
    if($err_flag === false) {
        echo $msg;
    }
    if($err_flag === true) {
        echo "<strong>Lỗi</strong> : <br />" . $err;
    } 
}

if($_POST['nv_list']) {
    $nv_list = $_POST['nv_list'];
    $nv_list_arr = explode(',', $nv_list);
    $err = "";
    $err_flag = false;
    foreach($nv_list_arr as $nv) {
        $nv = preg_replace("/ /", "", $nv);
        if(strlen($nv) > 0) {
            if (!preg_match("/^[a-zA-Z0-9_]*$/i", $nv))
        	{
                $err .= "Tài khoản $nv chứa ký tự đặc biệt.<br />";
                $err_flag = true;
        	}
            
            
            
            $acc_c_q = "SELECT AccountID FROM Character WHERE Name='$nv'";
            $acc_c_r = $db->Execute($acc_c_q);
                check_queryerror($acc_c_q, $acc_c_r);
            $acc_c_exist = $acc_c_r->NumRows();
            
            if($acc_c_exist == 0) {
                $err .= "Nhân vật $nv không tồn tại.<br />";
                $err_flag = true;
            } else {
                $acc_c_f = $acc_c_r->FetchRow();
                $acc = $acc_c_f[0];
                $acc_arr[] = $acc;
            }
        }
    }
    
    if($err_flag === false) {
        $acc_count = count($acc_arr);
        if($acc_count == 0) {
            $err .= "Dữ liệu tài khoản sai.<br />";
            $err_flag = true;
        }
    }
        
    
    if($err_flag === false) {
        include_once('../config_license.php');
        include_once('../func_getContent.php');
        $getcontent_url = $url_license . "/api_giftcode_create.php";
        $getcontent_data = array(
            'acclic'    =>  $acclic,
            'key'    =>  $key,
            
            'gift_slg'  =>  $acc_count
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
        if($acc_count == 1) {
            $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode', '".$acc_arr[0] ."', 4, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
            $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                check_queryerror($giftcode_insert_query, $giftcode_insert_result);
            $msg .= "GiftCode của tài khoản <strong>". $acc_arr[0] ."</strong> : <strong>$giftcode</strong> <br />";
        } else {
            $giftcode_arr = json_decode($giftcode, true);
            foreach($acc_arr as $key => $acc) {
                $giftcode_acc = $giftcode_arr[$key];
                $giftcode_insert_query = "INSERT INTO GiftCode (gift_code, acc, type, gift_time, ngay, status) VALUES ('$giftcode_acc', '".$acc_arr[$key] ."', 4, $timestamp, '".date("Y-m-d",$timestamp)."', 1)";
                $giftcode_insert_result = $db->Execute($giftcode_insert_query);
                    check_queryerror($giftcode_insert_query, $giftcode_insert_result);
                $msg .= "GiftCode của tài khoản <strong>". $acc_arr[$key] ."</strong> : <strong>$giftcode_acc</strong> <br />";
            }
        }
    }
    echo "<hr />";
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