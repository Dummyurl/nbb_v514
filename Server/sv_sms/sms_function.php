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
 
function check_queryerror($query,$result) {
    if ($result === false) die("Query Error : $query");
}

function check_phone($phone,$taikhoan)
{
	include('config.php');
	$phone = substr($phone, 2);
	$phone = '0'.$phone;
	$sql_phone_check = $db->Execute("SELECT * FROM MEMB_INFO WHERE tel__numb='$phone' AND memb___id='$taikhoan'"); 
	$phone_check = $sql_phone_check->numrows();
	return $phone_check;
}

function check_taikhoan($taikhoan) {
	include('config.php');
	$sql_acc_check_query = "SELECT * FROM MEMB_INFO WHERE memb___id='$taikhoan'";
	$sql_acc_check = $db->Execute($sql_acc_check_query);
	$acc_check = $sql_acc_check->numrows();
	return $acc_check;
}

function check_nv($name) {
	include('config.php');
	$sql_nv_check_query = "SELECT * FROM Character WHERE Name='$name'";
	$sql_nv_check = $db->Execute($sql_nv_check_query);
	$nv_check = $sql_nv_check->numrows();
	return $nv_check;
}

function check_online($taikhoan) {
	include('config.php');
	$sql_online_check = $db->Execute("SELECT * FROM MEMB_STAT WHERE memb___id='$taikhoan' AND ConnectStat='1'");
	$online_check = $sql_online_check->numrows();
	return $online_check;
}

function check_doinv($name) {
	include('config.php');
    
	$sql_doinv_check = $db->Execute("SELECT * FROM AccountCharacter WHERE GameIDC='$name'");
	$doinv_check = $sql_doinv_check->numrows();
	return $doinv_check;
}

if(!function_exists(_sno_numb)) {
    function _sno_numb($sno_numb) {
        $sno_year = rand(0, 95);
        if(strlen($sno_year) == 1) $sno_year = '0' . $sno_year;
        
        $sno_month = rand(1, 12);
        if(strlen($sno_month) == 1) $sno_month = '0'. $sno_month;
        
        $sno_day = rand(1, 31);
        if(strlen($sno_day) == 1) $sno_day = '0'. $sno_day;
        
        $sno_numb = abs(intval($sno_numb));
        $sno_numb_len = strlen($sno_numb);
        if($sno_numb_len < 7) {
            for($i=0; $i<(7-$sno_numb_len); ++$i) {
                $sno_numb = '0'. $sno_numb;
            }
        }
        
        $sno = $sno_year . $sno_month . $sno_day . $sno_numb;
        
        return $sno;
    }
}

function get_ip()
{
	# Enable X_FORWARDED_FOR IP matching?
	$do_check = 1;
	$addrs = array();

	if( $do_check )
	{
		foreach( array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_f )
		{
			$x_f = trim($x_f);
			if( preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $x_f) )
			{
				$addrs[] = $x_f;
			}
		}

		$addrs[] = $_SERVER['HTTP_CLIENT_IP'];
		$addrs[] = $_SERVER['HTTP_PROXY_USER'];
	}

	$addrs[] = $_SERVER['REMOTE_ADDR'];

	foreach( $addrs as $v )
	{
		if( $v )
		{
			preg_match("/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/", $v, $match);
			$ip = $match[1].'.'.$match[2].'.'.$match[3].'.'.$match[4];

			if( $ip && $ip != '...' )
			{
				break;
			}
		}
	}

	if( ! $ip || $ip == '...' )
	{
		print_error("Không thể xác định địa chỉ IP của bạn.");
	}

	return $ip;
}

if(!function_exists(read_TagName)) {
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
    function read_TagName($content, $tagname, $vitri = 1)
    {
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
        else return $output[$vitri];
    }
}
?>