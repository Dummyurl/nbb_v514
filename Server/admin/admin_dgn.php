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
include ('../config/config_thehe.php');
include ('function.php');
$title = "Admin IP Bonus";
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

switch ($_POST['action']){ 
	case 'add_dgn':
        $itemcode = $_POST['itemcode'];
        $price_min = $_POST['price_min'];   $price_min = abs(intval($price_min));
        $bid_mod = $_POST['bid_mod'];
        $hour_begin = $_POST['hour_begin'];
        $date_begin = $_POST['date_begin'];
        $hour_end = $_POST['hour_end'];
        $date_end = $_POST['date_end'];
        $thehe = $_POST['thehe'];
        
        if(count($thehe) == 0) {
            $notice = "Phải chọn ít nhất 1 thế hệ sử dụng Đấu Giá Item này.";
        } else {
            include_once('../config_license.php');
            include_once('../func_getContent.php');
            $getcontent_url = $url_license . "/api_com_daugianguoc.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                'action'    =>  'add_daugia',
                
                'itemcode'    =>  $itemcode,
                'bid_mod' =>  $bid_mod,
                'hour_begin'  =>  $hour_begin,
                'date_begin'  =>  $date_begin,
                'hour_end'  =>  $hour_end,
                'date_end'  =>  $date_end
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
        	if ( empty($reponse) ) {
                $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
            }
            else {
                $info = read_TagName($reponse, 'info');
                if($info == "Error") {
                    $notice = read_TagName($reponse, 'message');
                } elseif ($info == "OK") {
                    $data = read_TagName($reponse, 'data');
                    $data_arr = unserialize_safe($data);
                    $item_name = $data_arr['itemname'];
                    $item_info = $data_arr['iteminfo'];
                    $item_img = $data_arr['itemimg'];
                    $bid_mod = $data_arr['bid_mod'];
                    $time_begin = $data_arr['time_begin'];
                    $time_end = $data_arr['time_end'];
                    if(strlen($item_info) == 0 || strlen($item_img) == 0 || strlen($bid_mod) == 0 || strlen($time_begin) == 0 || strlen($time_end) == 0) {
                        $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                        
                        $arr_view = "\nDataSend:\n";
                        foreach($getcontent_data as $k => $v) {
                            $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                        }
                        writelog("log_api.txt", $arr_view . $reponse);
                    } else {
                    	$insert_daugia_query = "INSERT INTO DauGiaNguoc_Item (item_name, item_code, item_info, item_image, price_min, bid_mod, time_begin, time_end) VALUES ('$item_name', '$itemcode', '$item_info', '$item_img', $price_min, $bid_mod, $time_begin, $time_end)";
    			        $insert_daugia_result = $db->Execute($insert_daugia_query);
    			            check_queryerror($insert_daugia_query, $insert_daugia_result);
                        $bidid_query = "SELECT TOP 1 bid_id FROM DauGiaNguoc_Item WHERE item_code='$itemcode' AND item_image='$item_img' AND price_min='$price_min' AND bid_mod='$bid_mod' AND time_begin='$time_begin' AND time_end='$time_end' ORDER BY bid_id DESC";
                        $bidid_result = $db->Execute($bidid_query);
                            check_queryerror($bidid_query, $bidid_result);
                        $bidid_fetch = $bidid_result->FetchRow();
                        $bidid = $bidid_fetch[0];
                        
                        foreach($thehe as $thehe_key => $thehe_val) {
                            if($thehe_val == 1) {
                                $insert_thehe_query = "INSERT INTO DauGiaNguoc_TheHe (bid_id, thehe) VALUES ($bidid, $thehe_key)";
                                $insert_thehe_result = $db->Execute($insert_thehe_query);
                                    check_queryerror($insert_thehe_query, $insert_thehe_result);
                            }
                        }
                        
                        $notice = "Thêm Item Đấu Giá thành công";
                    }
                } else {
                    $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                    writelog("log_api.txt", $reponse);
                }
            }
        }
        echo $notice;
	break;

	case 'del_dgn':
        $dgn_id = $_POST['dgn_id']; $dgn_id = abs(intval($dgn_id));
        
        $check_query = "SELECT count(*) FROM DauGiaNguoc_Bid WHERE bid_id=$dgn_id";
        $check_result = $db->Execute($check_query);
            check_queryerror($check_query, $check_result);
        $check_fetch = $check_result->FetchRow();
        if($check_fetch[0] > 0) {
            $notice = "Item này đã có người đấu. Không thể xóa.";
        } else {
            $dgn_del_query = "DELETE FROM DauGiaNguoc_Item WHERE bid_id=$dgn_id";
            $dgn_del_result = $db->Execute($dgn_del_query);
                check_queryerror($dgn_del_query, $dgn_del_result);
            $notice = "Xóa Item đấu giá thành công.";
        }
	break;

	default :
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title><?php echo $title; ?></title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.8.21.custom.css">

</head>
<body bgcolor="#F9E7CF">
<?php require ('linktop.php'); ?>
<?php 
if (isset($notice)) {
    echo "<blockquote style='text-align: center; color: red;'>" . $notice . "</blockquote>";
}
?>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
$(document).ready(function() {
    $('#date_begin').datepicker({dateFormat: 'yy-mm-dd'});
    $('#date_end').datepicker({dateFormat: 'yy-mm-dd'});
    
    $('.bid_view').fancybox({});
})
</script>

<form id="add_dgn" name="add_dgn" method="post" action="">
    <input type="hidden" name="action" value="add_dgn" />
  <strong>Thêm Item Đấu Giá Ngược</strong> :<br />
  Code Item : 
    <input name="itemcode" type="text" id="itemcode" size="32" maxlength="32" value="<?php echo $_POST['itemcode']; ?>" /> <i>(32 ký tự lấy từ MuMaker)</i>
    <br />
    Giá Đấu Nhỏ Nhất : 
    <input type="text" name="price_min" value="<?php if(isset($_POST['price_min'])) echo $_POST['price_min']; else echo "1000"; ?>" /> Vpoint
    <br />
  Giá đặt phải chia hết cho : 
  <input type="text" name="bid_mod" value="<?php if(isset($_POST['bid_mod'])) echo $_POST['bid_mod']; else echo "100"; ?>" />
  <br />
  Thời gian bắt đầu : 
  <select name="hour_begin" id="hour_begin">
    	<option value="12:00am" <?php if($_POST['hour_begin'] == '12:00am') echo "selected"; ?> >12:00am</option>
    	<option value="1:00am" <?php if($_POST['hour_begin'] == '1:00am') echo "selected"; ?> >1:00am</option>
    	<option value="2:00am" <?php if($_POST['hour_begin'] == '2:00am') echo "selected"; ?> >2:00am</option>
    	<option value="3:00am" <?php if($_POST['hour_begin'] == '3:00am') echo "selected"; ?> >3:00am</option>
    	<option value="4:00am" <?php if($_POST['hour_begin'] == '4:00am') echo "selected"; ?> >4:00am</option>
    	<option value="5:00am" <?php if($_POST['hour_begin'] == '5:00am') echo "selected"; ?> >5:00am</option>
    	<option value="6:00am" <?php if($_POST['hour_begin'] == '6:00am') echo "selected"; ?> >6:00am</option>
    	<option value="7:00am" <?php if($_POST['hour_begin'] == '7:00am') echo "selected"; ?> >7:00am</option>
    	<option value="8:00am" <?php if($_POST['hour_begin'] == '8:00am' || !isset($_POST['hour_begin'])) echo "selected"; ?> >8:00am</option>
    	<option value="9:00am" <?php if($_POST['hour_begin'] == '9:00am') echo "selected"; ?> >9:00am</option>
    	<option value="10:00am" <?php if($_POST['hour_begin'] == '10:00am') echo "selected"; ?> >10:00am</option>
    	<option value="11:00am" <?php if($_POST['hour_begin'] == '11:00am') echo "selected"; ?> >11:00am</option>
    	<option value="12:00pm" <?php if($_POST['hour_begin'] == '12:00pm') echo "selected"; ?> >12:00pm</option>
    	<option value="1:00pm" <?php if($_POST['hour_begin'] == '1:00pm') echo "selected"; ?> >1:00pm</option>
    	<option value="2:00pm" <?php if($_POST['hour_begin'] == '2:00pm') echo "selected"; ?> >2:00pm</option>
    	<option value="3:00pm" <?php if($_POST['hour_begin'] == '3:00pm') echo "selected"; ?> >3:00pm</option>
    	<option value="4:00pm" <?php if($_POST['hour_begin'] == '4:00pm') echo "selected"; ?> >4:00pm</option>
    	<option value="5:00pm" <?php if($_POST['hour_begin'] == '5:00pm') echo "selected"; ?> >5:00pm</option>
    	<option value="6:00pm" <?php if($_POST['hour_begin'] == '6:00pm') echo "selected"; ?> >6:00pm</option>
    	<option value="7:00pm" <?php if($_POST['hour_begin'] == '7:00pm') echo "selected"; ?> >7:00pm</option>
    	<option value="8:00pm" <?php if($_POST['hour_begin'] == '8:00pm') echo "selected"; ?> >8:00pm</option>
    	<option value="9:00pm" <?php if($_POST['hour_begin'] == '9:00pm') echo "selected"; ?> >9:00pm</option>
    	<option value="10:00pm" <?php if($_POST['hour_begin'] == '10:00pm') echo "selected"; ?> >10:00pm</option>
    	<option value="11:00pm" <?php if($_POST['hour_begin'] == '11:00pm') echo "selected"; ?> >11:00pm</option>
    </select>
  <input type="text" name="date_begin" id="date_begin" value="<?php echo $_POST['date_begin']; ?>" />
  Thời gian kết thúc : 
  <select name="hour_end" id="hour_end">
    	<option value="12:00am" <?php if($_POST['hour_end'] == '12:00am') echo "selected"; ?> >12:00am</option>
    	<option value="1:00am" <?php if($_POST['hour_end'] == '1:00am') echo "selected"; ?> >1:00am</option>
    	<option value="2:00am" <?php if($_POST['hour_end'] == '2:00am') echo "selected"; ?> >2:00am</option>
    	<option value="3:00am" <?php if($_POST['hour_end'] == '3:00am') echo "selected"; ?> >3:00am</option>
    	<option value="4:00am" <?php if($_POST['hour_end'] == '4:00am') echo "selected"; ?> >4:00am</option>
    	<option value="5:00am" <?php if($_POST['hour_end'] == '5:00am') echo "selected"; ?> >5:00am</option>
    	<option value="6:00am" <?php if($_POST['hour_end'] == '6:00am') echo "selected"; ?> >6:00am</option>
    	<option value="7:00am" <?php if($_POST['hour_end'] == '7:00am') echo "selected"; ?> >7:00am</option>
    	<option value="8:00am" <?php if($_POST['hour_end'] == '8:00am') echo "selected"; ?> >8:00am</option>
    	<option value="9:00am" <?php if($_POST['hour_end'] == '9:00am') echo "selected"; ?> >9:00am</option>
    	<option value="10:00am" <?php if($_POST['hour_end'] == '10:00am') echo "selected"; ?> >10:00am</option>
    	<option value="11:00am" <?php if($_POST['hour_end'] == '11:00am') echo "selected"; ?> >11:00am</option>
    	<option value="12:00pm" <?php if($_POST['hour_end'] == '12:00pm') echo "selected"; ?> >12:00pm</option>
    	<option value="1:00pm" <?php if($_POST['hour_end'] == '1:00pm') echo "selected"; ?> >1:00pm</option>
    	<option value="2:00pm" <?php if($_POST['hour_end'] == '2:00pm') echo "selected"; ?> >2:00pm</option>
    	<option value="3:00pm" <?php if($_POST['hour_end'] == '3:00pm') echo "selected"; ?> >3:00pm</option>
    	<option value="4:00pm" <?php if($_POST['hour_end'] == '4:00pm') echo "selected"; ?> >4:00pm</option>
    	<option value="5:00pm" <?php if($_POST['hour_end'] == '5:00pm') echo "selected"; ?> >5:00pm</option>
    	<option value="6:00pm" <?php if($_POST['hour_end'] == '6:00pm') echo "selected"; ?> >6:00pm</option>
    	<option value="7:00pm" <?php if($_POST['hour_end'] == '7:00pm') echo "selected"; ?> >7:00pm</option>
    	<option value="8:00pm" <?php if($_POST['hour_end'] == '8:00pm') echo "selected"; ?> >8:00pm</option>
    	<option value="9:00pm" <?php if($_POST['hour_end'] == '9:00pm') echo "selected"; ?> >9:00pm</option>
    	<option value="10:00pm" <?php if($_POST['hour_end'] == '10:00pm' || !isset($_POST['hour_end'])) echo "selected"; ?> >10:00pm</option>
    	<option value="11:00pm" <?php if($_POST['hour_end'] == '11:00pm') echo "selected"; ?> >11:00pm</option>
    </select> 
  <input type="text" name="date_end" id="date_end" value="<?php echo $_POST['date_end']; ?>" /> <br />
    Sử dụng cho Thế hệ : 
    <?php
        foreach($thehe_choise as $thehe_key => $thehe_val) {
            if(strlen($thehe_val) > 0) {
                echo '<b>'. $thehe_val. '</b> <input type="checkbox" name="thehe['. $thehe_key .']" value="1" checked />';
            }
        }
    ?>
  <input type="submit" name="Submit" value="Thêm" />
</form>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="9" align="center">
		Danh sách Đấu Giá
	</td>
</tr>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center">Hình Ảnh</td>
    <td align="center">Thông Tin Item</td>
	<td align="center">Thông Tin Đấu Giá</td>
	<td align="center">&nbsp;</td>
</tr>
<?php
    $dgn_list_query = "SELECT bid_id, item_info, item_image, price_min, bid_mod, time_begin, time_end FROM DauGiaNguoc_Item ORDER BY time_end DESC";
    $dgn_list_result = $db->Execute($dgn_list_query);
        check_queryerror($dgn_list_query, $dgn_list_result);
    $stt = 0;
    while($dgn_list_fetch = $dgn_list_result->FetchRow()) {
        $stt++;
?>
<tr bgcolor="#ffffcc" >
	<td align="center"><?php echo $stt; ?></td>
	<td align="center" bgcolor="#121212"><img src="../items/<?php echo $dgn_list_fetch[2]; ?>.gif" border=0/> </td>
    <td align="center" bgcolor="#121212"><?php echo $dgn_list_fetch[1]; ?></td>
	<td align="center">
        Giá đấu nhỏ nhất : <?php echo number_format($dgn_list_fetch[3], 0, ',', '.'); ?> Vpoint<br />
        Giá đấu phải chia hết cho : <?php echo number_format($dgn_list_fetch[4], 0, ',', '.'); ?><br />
        Thời gian bắt đầu : <?php echo date('H:i d/m/Y', $dgn_list_fetch[5]); ?><br />
        Thời gian kết thúc : <?php echo date('H:i d/m/Y', $dgn_list_fetch[6]); ?><br />
        Thế hệ : 
        <?php
            $dgn_thehe_query = "SELECT thehe FROM DauGiaNguoc_TheHe WHERE bid_id=". $dgn_list_fetch[0];
            $dgn_thehe_result = $db->Execute($dgn_thehe_query);
                check_queryerror($dgn_thehe_query, $dgn_thehe_result);
            while($dgn_thehe_fetch = $dgn_thehe_result->FetchRow()) {
                $dgn_thehe = $dgn_thehe_fetch[0];
                echo "<b>". $thehe_choise[$dgn_thehe] ."</b> | ";
            }
            echo "<br />";
            $bid_view_status = false;
            if($timestamp < $dgn_list_fetch[5]) {
                echo "<font color='red'><strong>Đấu giá chưa diễn ra</strong></font><br />";
            } else if($timestamp > $dgn_list_fetch[6]) {
                echo "<font color='brown'>Đấu giá đã kết thúc</font><br />";
                echo "<a href='admin_dgn_view.php?bidid=". $dgn_list_fetch[0] ."' class='bid_view' title='Thống kê Đấu Giá Item' >Xem thống kê đấu giá</a>";
            } else {
                echo "<font color='blue'><strong>Đấu giá đang diễn ra</strong></font><br />";
                echo "<a href='admin_dgn_view.php?bidid=". $dgn_list_fetch[0] ."' class='bid_view' title='Thống kê Đang Đấu Giá' >Xem thống kê đang đấu giá</a>";
            }
        ?>
    </td>
	<td align="center">
        <form id="del_dgn" name="del_dgn" method="post" action="">
          <input name="action" type="hidden" id="action" value="del_dgn" />
          <input name="dgn_id" type="hidden" id="dgn_id" value="<?php echo $dgn_list_fetch[0]; ?>" />
          <input type="submit" name="Submit" value="Xóa" />
        </form>
    </td>
</tr>
<?php
    }
$db->Close();
?>
</body>
</html>