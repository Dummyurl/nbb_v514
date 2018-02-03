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

$title = "Admin - Trao Giải Thưởng";
$row_per_page = 20;

$fpage = intval($_GET['page']);
if(empty($fpage)){ $fpage = 1; }
$fstart = ($fpage-1)*$row_per_page;
    
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
	case 'award_add':
        $itemcode = $_POST['itemcode'];
        $name = $_POST['name'];
        $award_info = $_POST['award_info'];
        $item_slg = $_POST['item_slg'];     $item_slg = abs(intval($item_slg));
        $seri_block = $_POST['seri_block'];
        $date_end = $_POST['date_end'];
            if(strlen($date_end) > 0) {
                $date_end_time = strtotime($date_end) + 24*60*60;
            } else {
                $date_end_time = 0;
            }
        
        if($date_end_time > 0) {
            $item_slg = 1;
        }
        
        if($seri_block == 1) {
            $item_slg = 1;
        } else {
            $seri_block = 0;
        }
        
        $err = false;
        if($item_slg < 1 || $item_slg > 120) {
            $notice = "Số lượng Item phải ít nhất là 1 và nhỏ hơn 120";
            $err = true;
        }
        
        if($err === false) {
            if(strlen($itemcode) > 0 && strlen($itemcode)%32 != 0) {
                $notice = "Độ dài ItemCode phải là bội số của 32";
                $err = true;
            }
        }
        
        if($err === false) {
            if(!preg_match("/^[a-fA-F0-9]*$/i", $itemcode)) {
                $notice = "ItemCode không hợp lệ";
                $err = true;
            }
        }
        
        if($err === false) {
            if(strlen($award_info) == 0) {
                $notice = "Chưa nhập thông tin giải thưởng";
                $err = true;
            }
        }
        
        if($err === false) {
            if($date_end_time > 0 && $date_end_time < $timestamp) {
                $notice = "Thời gian hết hạn <strong>". date("H:i Y-m-d", $date_end_time) ."</strong> Item phải lớn hơn thời gian hiện tại";
                $err = true;
            }
        }
        
        $name_explode = explode(',', $name);
        foreach($name_explode as $key => $val) {
            $name_new = trim($val);
            if(strlen($name_new) >= 4 && strlen($name_new) <= 10) {
                $name_arr[] = $name_new;
            } else {
                $notice = "Nhân vật $name_new không tồn tại<br />";
                $err = true;
            }
        }
        if($err === false) {
            foreach($name_arr as $key => $name) {
                $acc_info_query = "SELECT AccountID FROM Character WHERE Name='$name'";
                $acc_info_result = $db->Execute($acc_info_query);
                    check_queryerror($acc_info_query, $acc_info_result);
                $acc_exists = $acc_info_result->NumRows();
                if($acc_exists == 0) {
                    $notice = "Nhân vật $name không tồn tại<br />";
                    $err = true;
                } else {
                    $acc_info_fetch = $acc_info_result->FetchRow();
                    $acc_arr[$key] = $acc_info_fetch[0];
                }
            }
        }
            
        if($err === false) {
            $item_slg_check = floor(strlen($itemcode)/32);
            
            $item_arr = array();
            for($i=0; $i<$item_slg_check; $i++) {
                $item_code = substr($itemcode, $i*32, 32);
                if($item_code != '' && $item_code != '') {
                    $item_arr[] = $item_code;
                }
            }
            
            if(count($item_arr) > 0) {
                $item = serialize($item_arr);
                
                include_once('../config_license.php');
                include_once('../func_getContent.php');
                $getcontent_url = $url_license . "/api_event_award.php";
                $getcontent_data = array(
                    'acclic'    =>  $acclic,
                    'key'    =>  $key,
                    'action'    =>  'award_add',
                    
                    'item'    =>  $item
                ); 
                
                $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
            
            	if ( empty($reponse) ) {
                    $notice = "Server bảo trì vui lòng liên hệ Admin để FIX";
                    $err = true;
                }
                else {
                    $info = read_TagName($reponse, 'info');
                    if($info == "Error") {
                        $notice = read_TagName($reponse, 'message');
                        $err = true;
                    } elseif ($info == "OK") {
                        $data = read_TagName($reponse, 'data');
                        $data_arr = unserialize_safe($data);
                        
                        if( count($data_arr) == 0 ) {
                            $notice = "Dữ liệu trả về lỗi. Vui lòng liên hệ Admin để FIX";
                            
                            $arr_view = "\nDataSend:\n";
                            foreach($getcontent_data as $k => $v) {
                                $arr_view .= "\t". $k ."\t=>\t". $v .",\n"; 
                            }
                            writelog("log_api.txt", $arr_view . $reponse);
                            $err = true;
                        } else {
                            $item_slg_receive = count($data_arr);
                            
                            for($i=0; $i<$item_slg_receive; $i++) {
                                $item_code = $data_arr[$i]['item_code'];
                                $item_name = $data_arr[$i]['item_name'];
                                $item_info = $data_arr[$i]['item_info'];
                                $item_img = $data_arr[$i]['item_img'];
                                
                                foreach($name_arr as $key => $name) {
                                    $acc = $acc_arr[$key];
                                    
                                    $award_insert_query = "INSERT INTO NBB_Award (award_info, item_slg, item_name, item_code, item_info, item_image, seri_block, acc, name, create_time, hsd_time) VALUES ('$award_info', $item_slg, '$item_name', '$item_code', '$item_info', '$item_img', $seri_block, '$acc', '$name', $timestamp, $date_end_time)";
                                    $award_insert_result = $db->Execute($award_insert_query);
                                        check_queryerror($award_insert_query, $award_insert_result);
                                }
                                	
                            }
                            
                            $notice = "Thêm Item trao giải thành công";
                        }
                    } else {
                        $notice = "Kết nối API gặp sự cố. Vui lòng liên hệ nhà cung cấp NWebMU để kiểm tra.";
                        writelog("log_api.txt", $reponse);
                        $err = true;
                    }
                }
            } else {
                $notice = "Không có Item phần thưởng.";
                $err = true;
            }
        }
        
        if($err === false) {
            $_POST['itemcode'] = '';
            $_POST['name'] = '';
            $item_slg = 1;
        }
        
        echo $notice;
	break;

	case 'award_del':
        $award_id = $_POST['award_id']; $award_id = abs(intval($award_id));
        
        $check_query = "SELECT status FROM NBB_Award WHERE award_id=$award_id";
        $check_result = $db->Execute($check_query);
            check_queryerror($check_query, $check_result);
        $check_fetch = $check_result->FetchRow();
        if($check_fetch[0] == 1) {
            $notice = "Item này đã nhận. Không thể xóa.";
        } else {
            $award_del_query = "DELETE FROM NBB_Award WHERE award_id=$award_id";
            $award_del_result = $db->Execute($award_del_query);
                check_queryerror($award_del_query, $award_del_result);
            $notice = "Xóa Item giải thưởng thành công.";
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
<script type="text/javascript">
$(document).ready(function() {
    $('#date_end').datepicker({dateFormat: 'yy-mm-dd'});
})
</script>

<form id="award_add" name="award_add" method="post" action="">
    <input type="hidden" name="action" value="award_add" />
  <strong>Trao giải thưởng</strong> :<br />
  Code Item : 
    <input name="itemcode" type="text" id="itemcode" size="96" value="<?php echo $_POST['itemcode']; ?>" /> 
    Giữ nguyên Seri <input type="checkbox" name="seri_block" value="1" /> <i>(Lựa chọn này chỉ có tác dụng khi Số lượng = 1)</i>
    <br /> <i>- 32 ký tự lấy từ MuMaker
    <br />- Nếu có nhiều item khác nhau thì 32 CodeItem này xếp sau 32 CodeItem kia)</i>
    <br />
  Số lượng : 
    <input name="item_slg" type="text" id="item_slg" size="5" maxlength="5" value="<?php if($_POST['item_slg']) echo $_POST['item_slg']; else echo '1'; ?>" />
    <br />
    Nhân vật nhận giải : 
    <input type="text" name="name" size="96" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" /> <i>(Các nhân vật cách nhau bằng dấu ",")</i>
    <br />
  Thông tin giải thưởng : 
  <input type="text" name="award_info" size="100" value="<?php if(isset($_POST['award_info'])) echo $_POST['award_info']; ?>" />
  <br />
  Thời gian hết hạn : 24h00 <input type="text" name="date_end" id="date_end" value="<?php echo $_POST['date_end']; ?>" /> <i>(Item vĩnh viễn : Để trống | Item có thời hạn : Số lượng phải là 1)</i>
  <br />
  <input type="submit" name="Submit" value="Thêm" />
</form>

<table width="100%" cellspacing="1" cellpadding="3" border="0" bgcolor="#0000ff">
<tr bgcolor="#ffffcc" >
	<td colspan="9" align="center">
		<strong>Danh sách Trao Giải Thưởng</strong>
	</td>
</tr>
<tr bgcolor="#ffffcc" >
	<td align="center">#</td>
	<td align="center"><strong>Hình Ảnh</strong></td>
    <td align="center"><strong>Thông Tin Item</strong></td>
	<td align="center"><strong>Thông Tin Giải Thưởng</strong></td>
	<td align="center">&nbsp;</td>
</tr>
<?php
    $award_list_query = "SELECT award_id, award_info, item_info, item_image, name, status, receive_time, item_slg, create_time, hsd_time FROM NBB_Award ORDER BY status, award_id DESC";
    $award_list_result = $db->SelectLimit($award_list_query, $row_per_page, $fstart);
        check_queryerror($award_list_query, $award_list_result);
    $stt = 0;
    while($award_list_fetch = $award_list_result->FetchRow()) {
        $stt++;
?>
<tr bgcolor="#ffffcc" >
	<td align="center"><?php echo $stt; ?></td>
	<td align="center" bgcolor="#121212"><img src="../items/<?php echo $award_list_fetch[3]; ?>.gif" border=0/> </td>
    <td align="center" bgcolor="#121212"><?php echo $award_list_fetch[2]; ?></td>
	<td align="center">
        Nhân vật nhận giải : <strong><?php echo $award_list_fetch[4]; ?></strong><br />
        Số lượng : <strong><?php echo $award_list_fetch[7]; ?></strong><br />
        
        <?php 
            $create_time = $award_list_fetch[8];
            if(strlen($create_time) > 0) {
                echo "Tạo lúc : <strong>". date('H:i d/m/Y', $create_time) ."</strong><br />";
            }
        ?>
        
        <?php
            if($award_list_fetch[5] == 1) {
                echo "<div>Trạng Thái Nhận Giải : <strong><font color='blue'>Đã nhận</font></strong> lúc : ". date('H:i:s d/m', $award_list_fetch[6]) ."</div>";
            } else {
                echo "<div align='right'>Trạng Thái Nhận Giải : <strong><font color='red'>Chưa nhận</font></strong></div>";
            }
        ?>
        
        Thông tin giải thưởng : <strong><?php echo $award_list_fetch[1]; ?></strong><br />
        
            <?php 
                $hsd = $award_list_fetch[9];
                if(strlen($hsd) > 0) {
                    if($hsd == 0) {
                        echo "<div>Thời hạn sử dụng : <strong>Vĩnh Viễn</strong></div>";
                    } else {
                        if($hsd < $timestamp) {
                            echo "<div align='right'>Thời hạn sử dụng : <strong><font color='red'>24:00 ". date('d/m/Y', $hsd - 24*60*60) ."</font></strong></div>";
                        } else {
                            echo "<div>Thời hạn sử dụng : <strong><font color='green'>24:00 ". date('d/m/Y', $hsd - 24*60*60) ."</font></strong></div>";
                        }
                    }
                }
            ?>
            
    </td>
	<td align="center">
        <?php
            if($award_list_fetch[5] == 0) {
        ?>
        <form id="award_del" name="award_del" method="post" action="">
          <input name="action" type="hidden" id="action" value="award_del" />
          <input name="award_id" type="hidden" id="award_id" value="<?php echo $award_list_fetch[0]; ?>" />
          <input type="submit" name="Submit" value="Xóa" />
        </form>
        <?php } ?>
    </td>
</tr>

<?php
    }
?>
</table>
<br>
<center>
<?php
$total_award_query = "SELECT count(*) FROM NBB_Award";
$total_award_result = $db->Execute($total_award_query);
    check_queryerror($total_award_query, $total_award_result);
$total_award_fetch = $total_award_result->FetchRow();

$totalpages = floor(($total_award_fetch[0]-1) / $row_per_page) + 1; 
	$c = 0;
	if ($totalpages > 0) {
		echo "Trang: [".$totalpages."] ";
	}
	while($c<$totalpages){
		$page = $c + 1;
		if($fpage == $page){
			echo " ($page) ";
		}else{//else 
			echo " [<a href=\"?page=$page\">$page</a>] ";
		} 
		$c = $c+1; 
	} 
?>
</center>
<?php
$db->Close();
?>
</body>
</html>