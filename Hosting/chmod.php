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

//Kiểm tra quyền Ghi Folder
$folder[]   =   'data';
$folder[]   =   'firewall';

//Kiểm tra quyền Ghi File
$file[]	=	'data/top.txt';
$file[]	=	'data/top_DW.txt';
$file[]	=	'data/top_DK.txt';
$file[]	=	'data/top_ELF.txt';
$file[]	=	'data/top_MG.txt';
$file[]	=	'data/top_DL.txt';
$file[]	=	'data/top_SuM.txt';
$file[]	=	'data/top_RF.txt';
$file[]	=	'data/top_reset.txt';
$file[]	=	'data/top_resetscore.txt';
$file[]	=	'data/top_guild.txt';
$file[]	=	'data/topcard.txt';
$file[]	=	'data/toppoint.txt';
$file[]	=	'data/toprs.txt';
$file[]	=	'data/ipbonus_list.txt';
$file[]	=	'data/event_bongda.txt';
$file[]	=	'data/daugianguoc_bidding.txt';
$file[]	=	'data/daugianguoc_bidend.txt';
$file[]	=	'data/daugia_bidding.txt';

$count_file = count($file);
$cound_folder = count($folder);

$content_checkwrite = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$content_checkwrite .= "<ul>";
for ($i=0;$i<$cound_folder;$i++)
{
	$write_flag = false;
	if(!is_dir($folder[$i])) {
	   $notice = "<font color=red>Không tồn tại. Vui lòng kiểm tra lại.</b></font>";
       $write_flag = true; 
	} else {
	   if(!is_writable($folder[$i])) { 
	       if(!@chmod($file[$i], 0777)) {
	           $notice = "<font color=red>Không thể Ghi. Vui lòng chuyển <b>Folder permission</b> sang <b>777</b></font>"; 
                $write_flag = true;
	       }
        }
	}
	if($write_flag === true) {
		$content_checkwrite .= "<li>Folder <font color='blue'><b>". $folder[$i] ."</b></font> : $notice</li>";
	}
}
$content_checkwrite .= "</ul><ul>";
for ($i=0;$i<$count_file;$i++)
{
	$write_flag = false;
    $file_exists = file_exists($file[$i]);
	if(!$file_exists) {
	   $create_file = @fopen($file[$i], 'a+');
       if(!$create_file) {
            $notice = "<font color=red>Không tồn tại. Vui lòng kiểm tra lại.</font>";
            $write_flag = true;
       } else {
            $file_exists = true;
       }
	}
    if(isset($file_exists)) {
        if(!is_writable($file[$i])) { 
            if(!@chmod($file[$i], 0666)) {
        	   $notice = "<font color=red>Không thể Ghi. Vui lòng chuyển <b>File permission</b> sang <b>666</b></font>";
               $write_flag = true; 
            }
        }
    }
    
    if($write_flag === true) {
    	$content_checkwrite .= "<li>File <font color='blue'><b>". $file[$i] ."</b></font> : $notice</li>";
    }
}
$content_checkwrite .= "</ul>";

if($write_flag) {
?>
<center>
	Để <b>file</b> có thể ghi : Vui lòng sử dụng chương trình <a href='http://filezilla-project.org/download.php' target='_blank'><b>FileZilla</b></a> chuyển <b>File permission</b> sang <b>666</b><br>
	Để <b>thư mục</b> có thể ghi : Vui lòng sử dụng chương trình <a href='http://filezilla-project.org/download.php' target='_blank'><b>FileZilla</b></a> chuyển <b>File permission</b> sang <b>777</b><br>
	<img src="images/chmod.jpg">
</center>
<?php
    echo $content_checkwrite;
    exit();
}
?>