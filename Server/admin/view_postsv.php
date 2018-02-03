<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="NetBanBe" />
	<title>ML-Chat SV2</title>
    <style type="text/css">
    <!--
    body {
    	background-color: #000000;
        font-size: 14px;
    	color: #FFFFFF;
    }
    -->
    </style>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript">
        var flag_msg = true;
        var AjaxAutoLoad_msg = function(){
            if(flag_msg == true) {
                var data = "action=readmsg";
                $.ajax({
                    type: "GET",
                    url: "view_postsv_ajax.php",
                    data: data, 
                    beforeSend: function(){
                        flag_msg = false;
                    },
                    success: function(response){
                        var response_split = response.split("<nbb>");
                        $('#msg_post').html(response_split[1]);
                        $('#msg_guild').html(response_split[2]);
                        $('#msg_pm').html(response_split[3]);
                        $('#time').html(response_split[4]);
                        flag_msg = true;
                    }
                });
            }
        }
        AjaxAutoLoad_msg();
        setInterval( "AjaxAutoLoad_msg();", 20000 );
        
        $(document).ready(function() {
            $("#send_post_btn").live('click', function(){
                var send_post = $('#send_post').val();
                var dataString = "action=sendmsg&send_post="+ send_post;
        
                $.ajax({
                    type: "GET",
                    url: "view_postsv_ajax.php",
                    data: dataString,
                    cache: false,
                    beforeSend: function() {
                         $("#send_info").html("<img src='images/loading1.gif' border='0' />");
                    },
                    complete: function() {
                        
                    },
                    success: function(html) {
                         $("#send_info").html("Đã gửi");
                    }
                 });
                
                return false;
            });
        });
    </script>
</head>
<html>
<body>
<center>
    <span id='time'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Thông báo Game : <input type="text" id="send_post" value="" size="50" /> <input type="button" id="send_post_btn" value="Gửi thông báo" /> <span id="send_info"></span>
</center>
<table>
    <tr>
        <td align='center'><strong>Chat Post</strong></td>
        <td align='center'><strong>Chat Bang Hội</strong></td>
        <td align='center'><strong>Chat Mật</strong></td>
    </tr>
    <tr>
        <td valign='top' id="msg_post">&nbsp;</td>
        <td valign='top' id="msg_guild">&nbsp;</td>
        <td valign='top' id="msg_pm">&nbsp;</td>
    </tr>
</table>
</body>
</html>