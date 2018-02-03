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
 
session_start();

$server_nguon = 'http://url_server_chuyen_di/chuyensvss62';
$server_dich = 'http://url_server_chuyen_den/chuyensvss62';

$server_nguon_name = "MU Chuyển Đi";    // Tên Server chuyển đi
$server_dich_name = "MU Chuyển Đến";     // Tên Server chuyển tới

$time_begin = "0h 17/07/2013";   // Thời gian bắt đầu chuyển Server
$time_end = "24h 20/07/2013";     // Thời gian kết thúc chuyển Server

//info MU chuyển đến
$website = "http://mudich.net";  // Địa chỉ WebSite MU chuyển tới
$register = "http://taikhoan.mudich.net/#register"; // Địa chỉ trang đăng ký
$download = "http://mudich.net/download.html"; // Địa chỉ trang Download
$forum = "http://diendan.mudich.net/";    // Địa chỉ trang diễn đàn


$debug = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Chuyển Server <?php echo $server_nguon_name; ?> -> <?php echo $server_dich_name; ?></title>
</head>
<body>
<center>

<?php

/**
 * read_TagName()
 * 
 * @param mixed $content
 * @param mixed $tagname
 * @param integer $vitri
 * $vitri = 0 : output All
 * $vitri = x : output Element x, Element 0 : Count Total Element
 * @return
 */
function read_TagName($content, $tagname, $vitri = 0)
{
    $output = array();
    $tag_begin = '<'. $tagname . '>';
    $tag_end = '</'. $tagname . '>';
    $content1 = explode($tag_begin, $content);
    $slg_string = count($content1)-1;
    $output[] = $slg_string;    // Vị trí đầu tiên xuất ra số lượng phần tử
    for($i=1; $i<count($content1); $i++)    // Duyệt từ phần tử thứ 1 đến hết
    {
        $content2 = explode($tag_end, $content1[$i]);
        $output[] = $content2[0];
    }
    
    if($vitri == 0) return $output;
    else {
        if(isset($output[$vitri])) return $output[$vitri];
        else return "";
    }
}

function _getContent( $url, $data = null, $method = "POST", $use_curl = true ) {
    $content = '';

    if(!is_array($data)) $data = null;
    if( count($data) > 0 ) {
        $postdata = urldecode(http_build_query($data, '', '&'));
    }
    else $postdata = "";
    if($method != "POST") $method = "GET";
    
    if ( $use_curl === true ) {
        $ch = curl_init();
        if($method == "POST") {
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        } else {
            curl_setopt($ch, CURLOPT_URL,$url . "?" . $postdata);
        }
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    	$content = curl_exec($ch);
    	curl_close($ch);
    } else {
        $opts = array(
            'http' => array(
                'method'    =>  $method,
                'content'   =>  $postdata
            )
        );
        $context = stream_context_create($opts);
        
        if($method == "GET" && $postdata) $url = $url . "?" . $postdata;
        $content = @file_get_contents($url, false, $context);
    }
    
    //echo $content;
    
	return $content;
}

if(isset($_POST['step'])) $step = $_POST['step'];
else $step = 'begin';

if (!isset($_SESSION['chuyensv_step'])) {
	$_SESSION['chuyensv_step'] = '1';
}

if($step == 'begin') {
	$_SESSION['chuyensv_step'] = '1';
	session_destroy();
}

if($step == '1') {
	$_SESSION['chuyensv_step'] = '2';
}

//Xu ly buoc 2 : Kiem tra tai khoan nguon
if($step == '2') {
	$acc_nguon = $_POST['acc_nguon'];
	$passweb_nguon = $_POST['passweb_nguon'];
	$pass2_nguon = $_POST['pass2_nguon'];
	
	if ( empty($acc_nguon) || empty($passweb_nguon) || empty($pass2_nguon)) {
		$notice = "Chưa điền đầy đủ thông tin";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $acc_nguon))
	{
    	$notice = "Dữ liệu lỗi : Tài khoản chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $passweb_nguon))
	{
    	$notice = "Dữ liệu lỗi : Mật khẩu Web chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2_nguon))
	{
    	$notice = "Dữ liệu lỗi : Mật khẩu Cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	else {
	
	$passweb_nguon = md5($passweb_nguon);
	
        $getcontent_url = $server_nguon . "/svnguon_kt_acc.php";
        $getcontent_data = array(
            'acc_nguon'    =>  $acc_nguon,
            'passweb_nguon'    =>  $passweb_nguon,
            'pass2_nguon'    =>  $pass2_nguon
        ); 
        $show_reponse = _getContent($getcontent_url, $getcontent_data);
        
		if ( empty($show_reponse) ) { $notice = "<font size='3' color='red'>Server bảo trì.</font>"; }
		else {
			$info_nguon = read_TagName($show_reponse, 'info', 1);
			
			if ( $info_nguon == 'OK' ) {
				$slg_char_nguon = 0;
				
				$list_nvnguon = read_TagName($show_reponse, 'char');
				for ($i=1; $i< count($list_nvnguon); ++$i)
				{
					if ( !empty($list_nvnguon[$i]) )
					{
						$slg_char_nguon++;
						$char_nguon[] = $list_nvnguon[$i];
					}
				}
				
                $acc_nguon_info = array (
                    'acc_gcoin' =>  read_TagName($show_reponse, 'gcoin', 1),
                    'acc_gcoin_km'  =>  read_TagName($show_reponse, 'gcoinkm', 1),
                    'acc_vpoint'    =>  read_TagName($show_reponse, 'vpoint', 1),
                    'acc_zen'   =>  read_TagName($show_reponse, 'zenbank', 1),
                    'acc_chao'  =>  read_TagName($show_reponse, 'chao', 1),
                    'acc_cre'   =>  read_TagName($show_reponse, 'cre', 1),
                    'acc_blue'  =>  read_TagName($show_reponse, 'blue', 1),
                    'acc_thehe' =>  read_TagName($show_reponse, 'thehe', 1),
                    'acc_WCoin' =>  read_TagName($show_reponse, 'WCoin', 1),
                    'acc_WCoinP'    =>  read_TagName($show_reponse, 'WCoinP', 1),
                    'acc_GoblinCoin'    =>  read_TagName($show_reponse, 'GoblinCoin', 1),
                    'acc_MuItemShopList'    =>  read_TagName($show_reponse, 'MuItemShopList', 1)
                );
                
				$_SESSION['chuyensv_acc_nguon'] = $acc_nguon;
                $_SESSION['acc_nguon_info'] = $acc_nguon_info;
                $_SESSION['char_nguon'] = $char_nguon;
				$_SESSION['chuyensv_step'] = '3';
                if($debug === true) {
                    echo '<pre>';
                    print_r($_SESSION['acc_nguon_info']);
                    echo '</pre>';
                }
			}
			else $notice = $show_reponse;
		}
	}
}


//Xu ly buoc 3 : Chon nhan vat Nguon
if($step == '3') {
	$nv_nguon = $_POST['nv_nguon'];
	if ( !empty($nv_nguon)) {
		$_SESSION['chuyensv_nv_nguon'] = $nv_nguon;
		
        $getcontent_url = $server_nguon . "/svnguon_kt_nv.php";
        $getcontent_data = array(
            'acc_nguon'    =>  $_SESSION['chuyensv_acc_nguon'],
            'nv_nguon'    =>  $nv_nguon
        ); 
		$show_reponse = _getContent($getcontent_url, $getcontent_data);
		
		if ( empty($show_reponse) ) { $notice = "<font size='3' color='red'>Server bảo trì.</font>"; }
		else {
			$info = read_TagName($show_reponse, 'info', 1);
			if($info == 'OK') {
    			$nv_nguon_info = array(
                    'nv_Class' => read_TagName($show_reponse, 'class', 1),
        			'nv_Inventory' => read_TagName($show_reponse, 'inventory', 1),
        			'nv_Money' => read_TagName($show_reponse, 'money', 1),
        			'nv_Quest' => read_TagName($show_reponse, 'quest', 1),
        			'nv_Resets' => read_TagName($show_reponse, 'resets', 1),
        			'nv_NoResetInDay' => read_TagName($show_reponse, 'resetday', 1),
        			'nv_Relifes' => read_TagName($show_reponse, 'relife', 1),
        			'nv_SCFPCPoints' => read_TagName($show_reponse, 'scfpoint', 1),
        			'nv_point_event' => read_TagName($show_reponse, 'pointevent', 1),
        			'nv_PointUyThac' => read_TagName($show_reponse, 'pointuythac', 1),
        			'nv_SCFMasterLevel' => read_TagName($show_reponse, 'scfmasterlv', 1),
                    
                    'nv_SCFSealItem' => read_TagName($show_reponse, 'SCFSealItem', 1),
                    'nv_SCFSealTime' => read_TagName($show_reponse, 'SCFSealTime', 1),
                    'nv_SCFScrollItem' => read_TagName($show_reponse, 'SCFScrollItem', 1),
                    'nv_SCFScrollTime' => read_TagName($show_reponse, 'SCFScrollTime', 1)
        			
                );
                
                $_SESSION['nv_nguon_info'] = $nv_nguon_info;
    			$_SESSION['chuyensv_step'] = '4';
                
                if($debug === true) {
                    echo '<pre>';
                    print_r($_SESSION['nv_nguon_info']);
                    echo '</pre>';
                }
			}
			else $notice = $show_reponse;
		}
	} else $notice = "Chưa chọn nhân vật cần chuyển";

}

//Xu ly buoc 4 : Kiem tra Acc dich
if($step == '4') {
	$acc_dich = $_POST['acc_dich'];
	$passweb_dich = $_POST['passweb_dich'];
	$pass2_dich = $_POST['pass2_dich'];
	
	if ( empty($acc_dich) || empty($passweb_dich) || empty($pass2_dich)) {
		$notice = "Chưa điền đầy đủ thông tin";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $acc_dich))
	{
    	$notice = "Dữ liệu lỗi : Tài khoản chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $passweb_dich))
	{
    	$notice = "Dữ liệu lỗi : Mật khẩu Web chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	elseif (preg_match("/[^a-zA-Z0-9_$]/", $pass2_dich))
	{
    	$notice = "Dữ liệu lỗi : Mật khẩu Cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.";
	}
	else {
	
	$passweb_dich = md5($passweb_dich);
	
        $getcontent_url = $server_dich . "/svdich_kt_acc.php";
            $getcontent_data = array(
                'acc_dich'    =>  $acc_dich,
                'passweb_dich'    =>  $passweb_dich,
                'pass2_dich'  =>  $pass2_dich
            ); 
            
        $show_reponse = _getContent($getcontent_url, $getcontent_data);
		
		if ( empty($show_reponse) ) { $notice = "<font size='3' color='red'>Server bảo trì.</font>"; }
		else {
			$info = read_TagName($show_reponse, 'info', 1);
            
			if ( $info == 'OK' ) {
    			 $char = null;
                $char = read_TagName($show_reponse, 'char');
				$slg_char_dich = 0;
				for ($i=1; $i<count($char); ++$i)
				{
					if ( !empty($char[$i]) )
					{
						$slg_char_dich++;
						$char_dich[] = $char[$i];
					}
				}
				$_SESSION['chuyensv_acc_dich'] = $acc_dich;
                $_SESSION['char_dich'] = $char_dich;
				$_SESSION['chuyensv_step'] = '5';
			}
			else $notice = $show_reponse;
		}
	}
}

//Xu ly buoc 5 : Chon nhan vat dich
if($step == '5') {
	$nv_dich = $_POST['nv_dich'];
	if ( !empty($nv_dich)) {
		$_SESSION['chuyensv_nv_dich'] = $nv_dich;
		$step = 6;
	} else $notice = "Chưa chọn nhân vật chuyển tới";

}

//Xu ly buoc 6 : Chuyen du lieu
if($step == '6') {
		
    $getcontent_url = $server_nguon . "/svnguon_xulychuyen.php";
    $getcontent_data = array(
        'acc_nguon'    =>  $_SESSION['chuyensv_acc_nguon'],
        'nv_nguon'    =>  $_SESSION['chuyensv_nv_nguon'],
        'acc_dich'  =>  $_SESSION['chuyensv_acc_dich'],
        'nv_dich'  =>  $_SESSION['chuyensv_nv_dich']
    ); 
    
    $show_reponse_nguon = _getContent($getcontent_url, $getcontent_data);

	if ( read_TagName($show_reponse_nguon, 'info', 1) == 'OK' ) {
        
        $getcontent_data1 = array(
            'acc_nguon'    =>  $_SESSION['chuyensv_acc_nguon'],
            'nv_nguon'    =>  $_SESSION['chuyensv_nv_nguon'],
            'acc_dich'  =>  $_SESSION['chuyensv_acc_dich'],
            'nv_dich'   =>  $_SESSION['chuyensv_nv_dich']
        );
        
        $getcontent_url = $server_dich . "/svdich_xulychuyen.php";
        $getcontent_data = array_merge($getcontent_data1, $_SESSION['acc_nguon_info'], $_SESSION['nv_nguon_info']);
        if($debug === true) {
            echo '<pre>';
            print_r($getcontent_data);
            echo '</pre>';
        }
        
        $show_reponse_dich = _getContent($getcontent_url, $getcontent_data);
        
		if ( read_TagName($show_reponse_dich, 'info', 1) == 'OK' ) {
			$notice = "Chuyển dữ liệu từ $server_nguon_name ( Tài khoản : $_SESSION[chuyensv_acc_nguon] - Nhân vật : $_SESSION[chuyensv_nv_nguon] ) sang $server_dich_name (Tài khoản : $_SESSION[chuyensv_acc_dich] - Nhân vật : $_SESSION[chuyensv_nv_dich] ) thành công";
            $_SESSION['chuyensv_step'] = '1';
	       session_destroy();
		} else $notice = $show_reponse_dich;
	} else $notice = $show_reponse_nguon;
}

if(!isset($_SESSION['chuyensv_acc_nguon'])) $_SESSION['chuyensv_acc_nguon'] = "";
if(!isset($_SESSION['chuyensv_nv_nguon'])) $_SESSION['chuyensv_nv_nguon'] = "";
if(!isset($_SESSION['chuyensv_acc_dich'])) $_SESSION['chuyensv_acc_dich'] = "";
if(!isset($_SESSION['chuyensv_nv_dich'])) $_SESSION['chuyensv_nv_dich'] = "";

echo "Chuyển dữ liệu từ ". $server_nguon_name ." ( Tài khoản : <font color='red'><b>". $_SESSION['chuyensv_acc_nguon'] ."</b></font> - Nhân vật : <font color='red'><b>". $_SESSION['chuyensv_nv_nguon'] ."</b></font> ) sang ". $server_dich_name ." (Tài khoản : <font color='red'><b>". $_SESSION['chuyensv_acc_dich'] ."</b></font> - Nhân vật : <font color='red'><b>". $_SESSION['chuyensv_nv_dich'] ."</b></font> )<br><br>";

if (isset($notice)) { echo "<font color='red'><b>$notice</b></font><br>";}

//Giao dien
?>
<hr>
<?php
//Buoc 1 : Thong tin gioi thieu
if ( $_SESSION['chuyensv_step'] == '1' ) {
?>
<div align="justify">
              
<table border=0 cellpadding="5" cellspacing="5">
    <tr>
        <td valign='top'>
                <blockquote>
                <p>Sau một thời gian hoạt động và phát triển, đến nay <strong><?php echo $server_nguon_name; ?></strong> chính thức nói lời chia tay!<br />
                
                BQT đã liên hệ với BQT <strong><?php echo $server_dich_name; ?></strong> để thỏa thuận sát nhập <strong><?php echo $server_dich_name; ?></strong> sang <strong><?php echo $server_dich_name; ?></strong>. Các bạn muốn chơi tiếp có thể sang <strong><?php echo $server_dich_name; ?></strong> tiếp tục chiến đấu.<br /><br />
                
                Do <strong><?php echo $server_dich_name; ?></strong> có thời gian chơi lâu hơn, vì vậy các nhân vật <strong><?php echo $server_dich_name; ?></strong> sẽ bị <strong>giảm 2.2 lần Reset tổng</strong>.<br />
                  Các bạn chỉ việc làm theo các bước hướng dẫn tiếp theo sẽ chuyển được tài khoản, nhân vật từ <?php echo $server_nguon_name; ?> sang <?php echo $server_dich_name; ?>.</p>
                <p>
                    <b>Thời gian chuyển Server : <font color="red"> <?php echo $time_begin; ?> - <?php echo $time_end; ?> </font></b><br />
                    Các bạn hãy vào Game, sắp xếp đồ vào nhân vật cần chuyển và thực hiện chuyển Server.
                </p>
                <p><strong><?php echo $server_dich_name; ?> </strong>: <a href="<?php echo $website; ?>" target="_blank">WebSite</a> - <a href="<?php echo $download; ?>" target="_blank">Download</a> - <a href="<?php echo $register; ?>" target="_blank">Đăng kí</a> - <a href="<?php echo $forum; ?>" target="_blank">Diễn đàn</a> <br />
                Server tiếp nhận sát nhập : <strong>Huyền Thoại</strong>
                </p>
                <p><b>Lưu ý</b> : </p>
              </blockquote>
             <ul>
                <li>Mỗi tài khoản chỉ chuyển được 1 nhân vật .</li>
                <li>Tất cả thông tin về tài khoản, nhân vật đều được chuyển sang đầy đủ : gcoin, vpoint, reset, relife,...</li>
                <li>Bạn phải tạo tài khoản và nhân vật trước ở <?php echo $server_dich_name; ?> trước khi chuyển sang .</li>
                <li><font color="blue">Chỉ có thể chuyển đồ trên người, túi đồ chính của nhân vật chuyển đi. <strong><font color='red'>Rương chứa đồ, túi đồ mở rộng, cửa hàng cá nhân</strong> không được chuyển</font>. Vì vậy các bạn để hết đồ cần thiết chuyển lên nhân vật chuyển đi.</font></li>
                <li>Tài khoản và Nhân vật mới tạo ở <?php echo $server_dich_name; ?> không nhất thiết trùng với <?php echo $server_nguon_name; ?> . Khi tiến hành chuyển, mọi thông tin về tài khoản, nhân vật tại <?php echo $server_nguon_name; ?> sẽ được thay thế sang <?php echo $server_dich_name; ?> . </li>
            </ul>
        </td>
        <td valign='top'><img src="item.jpg" border=0 /></td>
    </tr>
</table>
          
</div>

<form method="POST" Name='Buoc1' action="">
	<input type="hidden" name="step" value="1">
	<input type="submit" name="Submit" value="Bắt đầu chuyển Server">
</form>

<?php
}

//Buoc 2 : Nhap tai khoan Server nguon
if ( $_SESSION['chuyensv_step'] == '2' ) {
?>
<FORM Method='POST' Name='svnguon' action=''>
<input type="hidden" name="step" value="2">
	<table align="center"  width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="50%"><div align="right">Tài khoản Server nguồn <?php echo $server_nguon_name; ?></div></td>
        <td ><div align="left">
            <input name="acc_nguon" type="text" id="acc_nguon" size="14" maxlength="10" value="<?php if(isset($_POST['acc_nguon'])) echo $_POST['acc_nguon']; ?>">
        </div></td>
      </tr>
      <tr>
        <td width="50%"><div align="right">Mật khẩu Web</div></td>
        <td ><div align="left">
            <input name="passweb_nguon" type="password" id="passweb_nguon" size="14" maxlength="10">
        </div></td>
      </tr>
      <tr>
        <td width="50%"><div align="right">Mật khẩu Cấp 2</div></td>
        <td ><div align="left">
            <input name="pass2_nguon" type="password" id="pass2_nguon" size="14" maxlength="10">
        </div></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="Submit" value="Sang bước 3"></td>
      </tr>
    </table>
</form>
<form method="POST" Name='XoaSS' action="">
	<input type="hidden" name="step" value="begin">
	<br /><br /><br /><input type="submit" name="Submit" value="Làm lại">
</form>
<?php
}

//Buoc 3 : Chon nhan vat Server nguon can chuyen
if ( $_SESSION['chuyensv_step'] == '3' ) {
?>
Chọn nhân vật cần chuyển đi ở <?php echo $server_nguon_name; ?> : 
<form id="nvnguon" name="nvnguon" method="post" action="">
  <input type="hidden" name="step" value="3" />
  <select name="nv_nguon">
  <?php
  	for ($i=0;$i<count($_SESSION['char_nguon']);$i++) {
  ?>
    	<option value="<?php echo $_SESSION['char_nguon'][$i]; ?>"><?php echo $_SESSION['char_nguon'][$i]; ?></option>
  <?php
  	}
  ?>
  </select><br>
  <input type="submit" name="Submit" value="Sang bước 4" />
</form>
<form method="POST" Name='XoaSS' action="">
	<input type="hidden" name="step" value="begin">
	<br /><br /><br /><input type="submit" name="Submit" value="Làm lại">
</form>
<?php
}

//Buoc 4 : Nhap tai khoan Server dich
if ( $_SESSION['chuyensv_step'] == '4' ) {
?>
<FORM Method='POST' Name='svdich' action=''>
<input type="hidden" name="step" value="4">
	<table align="center"  width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="50%"><div align="right">Tài khoản Server đích <?php echo $server_dich_name; ?></div></td>
        <td ><div align="left">
            <input name="acc_dich" type="text" id="acc_dich" size="14" maxlength="10" value="<?php if(isset($_POST['acc_dich'])) echo $_POST['acc_dich']; ?>">
        </div></td>
      </tr>
      <tr>
        <td width="50%"><div align="right">Mật khẩu Web</div></td>
        <td ><div align="left">
            <input name="passweb_dich" type="password" id="passweb_dich" size="14" maxlength="10">
        </div></td>
      </tr>
      <tr>
        <td width="50%"><div align="right">Mật khẩu Cấp 2</div></td>
        <td ><div align="left">
            <input name="pass2_dich" type="password" id="pass2_dich" size="14" maxlength="10">
        </div></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="Submit" value="Sang bước 5"></td>
      </tr>
    </table>
</form>
<form method="POST" Name='XoaSS' action="">
	<input type="hidden" name="step" value="begin">
	<br /><br /><br /><input type="submit" name="Submit" value="Làm lại">
</form>
<?php
}

//Buoc 5 : Chon nhan vat Server dich can chuyen
if ( $_SESSION['chuyensv_step'] == '5' ) {
?>
Chọn nhân vật thay thế ở <?php echo $server_dich_name; ?> : 
<form id="nvdich" name="nvdich" method="post" action="">
  <input type="hidden" name="step" value="5" />
  <select name="nv_dich">
  <?php
  	for ($i=0;$i<count($_SESSION['char_dich']);$i++) {
  ?>
    	<option value="<?php echo $_SESSION['char_dich'][$i]; ?>"><?php echo $_SESSION['char_dich'][$i]; ?></option>
  <?php
  	}
  ?>
  </select><br>
  <input type="submit" name="Submit" value="Sang bước 6" />
</form>
<form method="POST" Name='XoaSS' action="">
	<input type="hidden" name="step" value="begin">
	<br /><br /><br /><input type="submit" name="Submit" value="Làm lại">
</form>
<?php
}

?>
</center>
</body>
</html>