<?php

/**
 * @author NetBanBe
 * @copyright 2014
 */
date_default_timezone_set('Asia/Ho_Chi_Minh');

function _get_lastfile($path = ".") {
    $datenow = date('Y-m-d', time());
    
    if ($folder_read = opendir($path)) {
    	while ( $item = readdir($folder_read)) {
    		if ($item != "." && $item != ".." && strpos($item, $datenow) !== false) {
        		//Is File
        		if ( file_exists($path."\\".$item) ) {
                    $filemtime = filemtime($path."\\".$item);
                    if(date('Y-m-d', $filemtime) == $datenow) {
                        $lastfile = $path."\\".$item;
                        break;
                    }
    			}
    		}
    	}
        closedir($folder_read);
        unset($item);
    }
    
    return $lastfile;
}

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

function writelog($file, $logcontent) {
    $Date = date("h:i:sA, d/m/Y");  
	$fp = fopen($file, "a+");  
	fputs ($fp, "Lúc: $Date. $logcontent \n----------------------------------------------------------------------\n\n");
	fclose($fp);
}

$folder_post[] = "D:\MuOnline\SCF11.70.24\SV2_Sub1\GameServer\POST_LOG";
$folder_post[] = "D:\MuOnline\SCF11.70.24\SV2_Sub2\GameServer\POST_LOG";
$folder_post[] = "D:\MuOnline\SCF11.70.24\SV2_Sub3\GameServer\POST_LOG";
$folder_post[] = "D:\MuOnline\SCF11.70.24\SV2_Sub4\GameServer\POST_LOG";
$folder_post[] = "D:\MuOnline\SCF11.70.24\SV2_CS\GameServerCS\POST_LOG";


$action = $_GET['action'];

switch ($action){ 
	case 'readmsg':
		$msg_post = array();
        $msg_guild = array();
        $msg_pm = array();
        
        foreach($folder_post as $folder) {
            $lastfile = _get_lastfile($folder);
            if( file_exists($lastfile) ) {
                $msg = array();
                
                $filesize = filesize($lastfile);
                $fseek_begin = $filesize - 10000;
                if($fseek_begin < 0) $fseek_begin = 0;
                echo "File seek : $fseek_begin <br />";
                $fopen = @fopen($lastfile, 'r');
                fseek($fopen, $fseek_begin);
                while(!feof($fopen)) {
                    $line = fgets($fopen);
                    if(strlen($line) > 0) {
                        $msg[] = $line;
                    }
                }
                fclose($fopen);
                
                $line_total = count($msg);
                
                
                
                for($i=$line_total-1; $i>=0; $i--) {
                    $color_begin = "";
                    $color_end = "";
                    if(strpos($msg[$i], '[Post]')) {        // Post
                        $color_begin = "<font color='cyan'>";
                        $color_end = "</font>";
                        $msgline = $msg[$i];
                        $msgline = htmlspecialchars($msgline);
                        
                        $msgline_explode1 = explode('[', $msgline);
                        $msg_time = $msgline_explode1[0];
                        $msgline_explode2 = explode(']', $msgline);
                        $msgline_explode3 = explode('&lt;', $msgline);
                        $msgline_explode4 = explode('&gt;', $msgline_explode3[1]);
                        $msg_content = "";
                        foreach($msgline_explode4 as $k => $v) {
                            if($k == 0) {
                                $Name = "<font color='#FF0000'>" . $v . "</font> : ";
                            } else {
                                if(strlen($msg_content) > 0) $msg_content .= "&gt;";
                                $msg_content .= $v;
                            }
                        }
                        
                        $key = str_replace(":", "", $msg_time);
                        $key = str_replace(" ", "", $key);
                        
                        $msg_post[$key][] = $msg_time . $Name . $color_begin . $msg_content . $color_end . "<br />";
                    } else if(strpos($msg[$i], '[MSG]')) {  // MSG Guild
                        $color_begin = "<font color='yellow'>";
                        $color_end = "</font>";
                        $msgline = $msg[$i];
                        $msgline = htmlspecialchars($msgline);
                        
                        $msgline_explode1 = explode('[', $msgline);
                        $msg_time = $msgline_explode1[0];
                        $msgline_explode2 = explode(']', $msgline_explode1[3]);
                        $Name = "<font color='#FF0000'>" . $msgline_explode2[0] . "</font> : ";
                        $msg_content = $msgline_explode2[1];
                        
                        $key = str_replace(":", "", $msg_time);
                        $key = str_replace(" ", "", $key);
                        
                        $msg_guild[$key][] = $msg_time . $Name . $color_begin . $msg_content . $color_end . "<br />";
                    } else if(strpos($msg[$i], '[PVT]')) {  // PVT PM
                        $color_begin = "<font color='silver'>";
                        $color_end = "</font>";
                        $msgline = $msg[$i];
                        $msgline = htmlspecialchars($msgline);
                        
                        $msgline_explode1 = explode('[', $msgline);
                        $msg_time = $msgline_explode1[0];
                        $msgline_explode2 = explode(']', $msgline_explode1[3]);
                        $Name1 = "<font color='#FF0000'>" . $msgline_explode2[0] . "</font>";
                        $msgline_explode3 = explode(']', $msgline_explode1[5]);
                        $Name2 = "<font color='#FF0000'>" . $msgline_explode3[0] . "</font>";
                        $msg_content = $msgline_explode3[1];
                        
                        $key = str_replace(":", "", $msg_time);
                        $key = str_replace(" ", "", $key);
                        
                        $msg_pm[$key][] = $msg_time . $Name1 ." nói ". $Name2 ." : ". $color_begin . $msg_content . $color_end . "<br />";
                    }
                }
            }
		}
        
        
        echo "<nbb>";
        krsort($msg_post);
        foreach($msg_post as $k1 => $val1) {
            foreach($val1 as $k2 => $val2) {
                echo $val2;
            }
        }
        
        echo "<nbb>";
        krsort($msg_guild);
        foreach($msg_guild as $k1 => $val1) {
            foreach($val1 as $k2 => $val2) {
                echo $val2;
            }
        }
        echo "<nbb>";
        krsort($msg_pm);
        foreach($msg_pm as $k1 => $val1) {
            foreach($val1 as $k2 => $val2) {
                echo $val2;
            }
        }
        echo "<nbb>". date('d/m/Y H:i:s', time()) ."<nbb>";
	break;

	case 'sendmsg':
        $send_post = $_GET['send_post'];
        if(file_exists('../config/config_sendmess.php')) {
            include('../config/config_sendmess.php');
            
            $mess_send = $send_post;
            
            include('../config_license.php');
            include('../func_getContent.php');
            $getcontent_url = $url_license . "/api_sendmess.php";
            $getcontent_data = array(
                'acclic'    =>  $acclic,
                'key'    =>  $key,
                
                'mess_send'    =>  $mess_send
            ); 
            
            $reponse = _getContent($getcontent_url, $getcontent_data, $getcontent_method, $getcontent_curl);
        
            $info = read_TagName($reponse, 'info');
            if ($info == "OK") {
                $mess_receive = read_TagName($reponse, 'mess_receive', 0);
                $mess_total = $mess_receive[0];
                
                for($i=1; $i<=$mess_total; $i++) {
                    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                    if ($x = socket_connect($socket, '127.0.0.1', $joinserver_port))
                    {
                        socket_write($socket, $mess_receive[$i]);
                    } else {
                        socket_close($socket);
                        break;
                    }
                    socket_close($socket);
                }
            }
        }
	break;
}




?>