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
$folder[]   =   'config';

$write_flag = false;

$content_checkwrite = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$content_checkwrite .= "<ul>";
for ($i=0;$i<count($folder);$i++)
{
	$notice_write = null;
    
	if(!is_dir($folder[$i])) {
	   $notice_write .= "<font color=red>Thư mục <strong>'{$folder[$i]}'</strong> Không tồn tại. Vui lòng kiểm tra lại.</b></font>";
       $write_flag = true; 
	} else {
	   if(!is_writable($folder[$i])) { 
            $notice_write .= "<font color=red>Thư mục <strong>'{$folder[$i]}'</strong> Không thể Ghi. Vui lòng chuyển <b>Folder permission</b> sang <b>777</b></font>"; 
            $write_flag = true;
        }
        
        if ($folder_read = opendir($folder[$i])) {
            $notice_write .= "<ul>";
            while ($item = readdir($folder_read)) {
        		if ($item != "." && $item != "..") {
            		//Is File
            		if ( is_file($folder[$i]."/".$item) ) {
                        if(!is_writable($folder[$i]."/".$item)) {
                           $notice_write .= "<li><font color=red> <strong>'". $folder[$i]."/".$item ."'</strong> Không thể Ghi. Vui lòng chuyển <b>File permission</b> sang <b>666</b></font></li>";
                           $write_flag = true; 
                        }
        			}
        		}
        	}
            closedir($folder_read);
            unset($item);
            $notice_write .= "</ul>";
        }
	}
	if($write_flag === true) {
		$content_checkwrite .= "<li>Folder <font color='blue'><b>". $folder[$i] ."</b></font> : $notice_write</li>";
	}
}
$content_checkwrite .= "</ul>";

if($write_flag === true) {
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