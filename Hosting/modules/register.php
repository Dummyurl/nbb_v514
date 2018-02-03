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
 
if (!defined('NetNWEB')) die("Ban khong co quyen truy cap he thong");
include_once("vimage.php");
$vImage = new vImage();

if(isset($_GET['invite'])) $invite = $_GET['invite'];
else $invite = "";
if (!preg_match("/^[a-zA-Z0-9_]*$/i", $invite)) $invite = "";
if(strlen($invite) > 0) $_SESSION['mu_invite'] = $invite;

if (isset($_POST["register"]))
	{
		$vImage->loadCodes();
		
		if($vImage->checkCode()) {
			    $username = $_POST['username'];		$username = strtolower($username);
                $thehe = $_POST['thehe'];          $thehe = abs(intval($thehe));
                $passgame = $_POST['passgame'];
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                $email = $_POST['email'];
                $quest = $_POST['quest'];
                $ans = $_POST['ans'];
                $sno_numb = $_POST['sno_numb'];
                $tel = $_POST['tel'];
                $sdt_length = strlen($tel);
				$sdt_check = substr($tel, 0, 2);
                $ip_client = get_ip();
    
			if (($username == NULL) || ($passgame == NULL) || ($pass1 == NULL) || ($pass2 == NULL) || ($email == NULL) || ($quest == NULL) || ($ans == NULL) || ($sno_numb == NULL) || ($tel == NULL)) { $error = "<font color='red'>Hãy điền đầy đủ tất cả các dữ liệu.</font><br>"; }
			elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $username))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Tài khoản chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
				}
			elseif ( $username == 'demo' )
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Không được đăng kí tài khoản Demo.</font><br>";
				}
			elseif ( substr_count($username, 'dis') > 0 )
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Tên tài khoản không được phép đăng ký.</font><br>";
				}
			elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $passgame))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Mật khẩu Game chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
				}
            elseif ( $thehe == 0 )
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Thế hệ không hợp lệ.</font><br>";
				}
			elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass1))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Mật khẩu Web cấp 1 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
				}
			elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $pass2))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Mật khẩu Web cấp 2 chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
				}
			elseif (!preg_match("/^[1-9]*$/i", $quest))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Chưa chọn câu hỏi bí mật.</font>";
				}
			elseif (!preg_match("/^[a-zA-Z0-9_]*$/i", $ans))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - Câu trả lời bí mật chỉ được sử dụng kí tự a-z, A-Z, số (1-9) và dấu _.</font><br>";
				}
            elseif (!preg_match("/^[0-9]*$/i", $sno_numb))
				{
    				$error = "<font color='red'>Dữ liệu lỗi - 7 số bí mật chỉ được sử dụng số 0-9.</font><br>";
				}
            elseif (strlen($sno_numb) != 7)
				{
    				$error = "<font color='red'>Dữ liệu lỗi - 7 số bí mật không đủ 7 số.</font><br>";
				}
			elseif (!preg_match("/^[0-9]*$/i", $tel))
				{
					$error = "<font color='red'>Dữ liệu lỗi - Số điện thoại chỉ là số (0-9).</font><br>";
				}
			elseif (!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,6}$/i", $email)) {
				    $error = "<font color='red'>Dữ liệu lỗi : $email . Không đúng dạng địa chỉ Email. Xin vui lòng kiểm tra lại.</font><br>"; 
				}
			elseif ( $passgame == $pass1 ) {
				$error = "<font color='red'>Mật khẩu Game giống mật khẩu cấp 1</font><br>"; 
				}
			elseif ( $passgame == $pass2 ) {
				$error = "<font color='red'>Mật khẩu Game giống mật khẩu cấp 2</font><br>"; 
				}
			elseif ( $pass1 == $pass2 ) {
				$error = "<font color='red'>Mật khẩu cấp 1 giống mật khẩu cấp 2</font><br>"; 
				}
			elseif ( strlen($username) <4 || strlen($username) >10 ) {
				$error = "<font color='red'>Tên tài khoản chỉ từ 4-10 kí tự</font><br>"; 
				}
			elseif ( strlen($pass1) <4 || strlen($pass1) >32 ) {
				$error = "<font color='red'>Mật khẩu cấp 1 chỉ từ 4-32 kí tự</font><br>"; 
				}
			elseif ( strlen($pass2) <4 || strlen($pass2) >32 ) {
				$error = "<font color='red'>Mật khẩu cấp 2 chỉ từ 4-32 kí tự</font><br>"; 
				}
			elseif ( strlen($ans) <4 || strlen($ans) >50 ) {
				$error = "<font color='red'>Câu trả lời bí mật chỉ từ 4-50 kí tự</font><br>"; 
				}
			elseif ( ($sdt_check == '09' && $sdt_length == 10) || ($sdt_check == '01' && $sdt_length == 11) ) {
                
                
                $sno_numb = abs(intval($sno_numb));
                $sno_numb_len = strlen($sno_numb);
                if($sno_numb_len < 7) {
                    for($i=0; $i<(7-$sno_numb_len); ++$i) {
                        $sno_numb = '0'. $sno_numb;
                    }
                }
                
                $getcontent_url = $server_url . "/do_register.php";
		        $getcontent_data = array(
		            'action'    =>  'register',
		            'username'    =>  $username,
		            'thehe'    =>  $thehe,
		            'passgame'    =>  $passgame,
		            'pass1'    =>  $pass1,
		            'pass2'    =>  $pass2,
		            'email'    =>  $email,
		            'quest'    =>  $quest,
		            'ans'    =>  $ans,
                    'sno_numb'  =>  $sno_numb,
		            'tel'    =>  $tel,
		            'invite'    =>  $_SESSION['mu_invite'],
                    'ip'    =>  $ip_client,
		            'passtransfer'    =>  $passtransfer
		        ); 
		        
		        $show_reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);

				if ( empty($show_reponse) ) $notice = "<font color='red'>Server bảo trì.</font>";
				else {
					if ($show_reponse == 'OK') {
						switch ($quest)
						{
							case 1: $quest_choise = "Tên con vật yêu thích?";
								break;
							case 2: $quest_choise = "Trường cấp 1 của bạn tên gì?";
								break;
							case 3: $quest_choise = "Người bạn yêu quý nhất?";
								break;
							case 4: $quest_choise = "Trò chơi bạn thích nhất?";
								break;
							case 5: $quest_choise = "Nơi để lại kỉ niệm khó quên nhất?";
								break;
						}
                        
                        $thehe_title = $thehe_choise[$thehe];

						$notice = "<center><b>Đăng kí thành công</b> :<br>
								Tài khoản : <b>$username</b><br>
                                Thế hệ : <b>$thehe_title</b><br>
								Mật khẩu Game : <b>$passgame</b><br>
								Mật khẩu Web cấp 1 : <b>$pass1</b><br>
								Mật khẩu Web cấp 2 : <b>$pass2</b><br>
								Email đăng kí : <b>$email</b><br>
								Câu hỏi bí mật : <b>$quest_choise</b><br>
								Câu trả lời bí mật : <b>$ans</b><br>
                                7 số bí mật : <b>$sno_numb</b><br>
								Số điện thoại : <b>$tel</b></center><hr>
							";
					}
					else { 
						$error = "<font color='red'>$show_reponse</font>"; 
					}
				}
            }
            else { $error = "<font color='red'>Số Điện thoại bắt buộc phải là Số ĐT di động.</font>"; }
		} else $error = "<center><font color='red'>Dữ liệu lỗi - Mã kiểm tra không chính xác.</font></center>";
		
		if (isset($error)) {
          	$page_template = 'templates/register.tpl';
          	}
	}
else {
	$page_template = 'templates/register.tpl';
}
?>