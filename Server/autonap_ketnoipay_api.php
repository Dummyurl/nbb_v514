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
 
/*
 * This script PHP is writed by FPAY developer 
 * File này thực hiện việc kết nối tới FPAY
*/
class gateWay
{
	# Hàm kết nối
	var $userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16';
	private function curl($url,$param)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		curl_setopt($ch, CURLOPT_REFERER, $ref);   
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
			
		$kq = curl_exec($ch); 
		curl_close($ch);
		return $kq;
	}
		
	# Hàm thực thi kết nối
	private function execute()
	{
		$link = $this->TxtUrl.'/?TxtPartnerID='.$this->partner .'&TxtType='.$this->type .'&TxtMaThe='.$this->mathe .'&TxtSeri='.$this->seri .'&TxtTransId='.$this->transid .'&TxtKey='.$this->cKey ;
		$param = '';
		$this->result = $this->curl($link,$param);
	}
	
	# Nhận dữ liệu từ phía quý đối tác truyền vào
	function __construct($TxtPartner,$TxtType,$TxtMaThe,$TxtSeri,$TxtTransId = NULL,$TxtKey,$TxtUrl)
	{
		# Chuẩn bị dữ liệu
		$this->partner = intval($TxtPartner);
		$this->type    = mysql_escape_string($TxtType);
		$this->mathe   = mysql_escape_string($TxtMaThe);
		$this->seri	   = mysql_escape_string($TxtSeri);
		$this->transid = mysql_escape_string($TxtTransId);
		$this->cKey	   = mysql_escape_string($TxtKey);
		$this->TxtUrl  = mysql_escape_string($TxtUrl);
		# Tiến hành kết nối
		$this->execute();
	}
	
	# Trả về kết quả
	public function ReturnResult()
	{
		return $this->result;
	}
	
	# Hiển thị kết quả ra ngoài màn hình
	public function echoResult()
	{
		echo $this->result;
	}
	
	# Trả về mệnh giá của thẻ khi thẻ đúng
	public function MenhGia()
	{
		if(strpos('RESULT:10',$this->result) !== false)
		{
			$TxtMenhGia = str_replace('RESULT:10@','',$this->result);
			
			return $TxtMenhGia;
		}else return;
	}
}
?>