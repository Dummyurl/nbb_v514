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
 
    session_start();

    include_once ("security.php");
    include ('../config.php');
    include ('../config/config_thehe.php');
    
    $mod = $_POST['mod'];
    switch ($mod){ 
	case 'itemsearch':
        $title = "Tìm Item";
	break;
    
	default :
        $title = "Hệ thống Tìm Item by NetBanBe";
        $mod = "";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title; ?></title>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/tooltip.jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $('.itemdel').live("click",function() 
        {
            //dupeseri_$acc_$name_$seri_$item_vitri
            var acc = $(this).attr("acc");
            var name = $(this).attr("name");
            var seri = $(this).attr("seri");
            var vitri = $(this).attr("vitri");
            var dataString = 'acc='+ acc +'&name='+ name +'&seri='+ seri +'&vitri='+ vitri;
            
            $.ajax({
                type: "POST",
                url: "dupedel_online.php",
                data: dataString,
                cache: false,
                success: function(reponse){
                    $("#itemdel_"+ acc +"_"+ name +"_"+ seri +"_"+ vitri).html(reponse);
                }
            });
            
            return false;
        });
        
        $('.itemtooltip').live("mouseover", function() {
            $(this).tooltip();
        });
    });
</script>
<center>
    <strong>Hệ thống Tìm Item by NetBanBe</strong><br />
    <form name="ItemSearch" method="POST" action="">
    <input type="hidden" name="mod" value="itemsearch" />
    <select name="scanday">
        <option value="1" <?php if($_POST['scanday']==1) echo "selected"; ?> >Nhân vật Online trong 1 ngày trở lại đây</option>
        <option value="2" <?php if($_POST['scanday']==2) echo "selected"; ?>>Nhân vật Online trong 2 ngày trở lại đây</option>
        <option value="3" <?php if($_POST['scanday']==3) echo "selected"; ?>>Nhân vật Online trong 3 ngày trở lại đây</option>
        <option value="7" <?php if($_POST['scanday']==7) echo "selected"; ?>>Nhân vật Online trong 7 ngày trở lại đây</option>
        <option value="30" <?php if($_POST['scanday']==30) echo "selected"; ?>>Nhân vật Online trong 1 tháng trở lại đây</option>
        <option value="all" <?php if($_POST['scanday']==0) echo "selected"; ?>>Tất cả</option>
    </select> <br />
    
    <select name="item_exl">
        <option value="all" <?php if($_POST['item_exl']==0) echo "selected"; ?>>Tất cả</option>
        <option value="1" <?php if($_POST['item_exl']==1) echo "selected"; ?> >Có 1 dòng hoàn hảo trở lên</option>
        <option value="2" <?php if($_POST['item_exl']==2) echo "selected"; ?>>Có 2 dòng hoàn hảo trở lên</option>
        <option value="3" <?php if($_POST['item_exl']==3) echo "selected"; ?>>Có 3 dòng hoàn hảo trở lên</option>
        <option value="4" <?php if($_POST['item_exl']==4) echo "selected"; ?>>Có 4 dòng hoàn hảo trở lên</option>
        <option value="5" <?php if($_POST['item_exl']==5) echo "selected"; ?>>Có 5 dòng hoàn hảo trở lên</option>
        <option value="6" <?php if($_POST['item_exl']==6) echo "selected"; ?>>Có 6 dòng hoàn hảo trở lên</option>
    </select> 
    Item Seri : <input name="itemseri" value="<?php echo $_POST['itemseri']; ?>" maxlength="8" size="8" /> <i>( Để trống Seri nếu muốn tìm theo loại Item )</i><br /> 
    
    Item Code : <input name="itemcode" value="<?php echo $_POST['itemcode']; ?>" maxlength="2" size="2" />
    
    Item Type : <input name="itemtype" value="<?php echo $_POST['itemtype']; ?>" maxlength="1" size="1" />
    Item Level từ : <input name="itemlevel" value="<?php echo $_POST['itemlevel']; ?>" maxlength="2" size="2" />
    Số lượng Item nhiều hơn : <input name="itemslg" value="<?php if($_POST['itemslg']) echo $_POST['itemslg']; else echo "0"; ?>" maxlength="3" size="2"/>
    <br />
    <select name="thehe">
            <option value="0">Tất cả thế hệ</option>
    <?php
        for($i=count($thehe_choise)-1;$i>=1;$i--) {
            if(strlen($thehe_choise[$i]) > 0) {
    ?>
            <option value="<?php echo $i; ?>" <?php if($_POST['thehe'] == $i) echo "selected"; ?> ><?php echo $thehe_choise[$i]; ?></option>
    <?php
        } }
    ?>
    </select>
    <input type="submit" value="Tìm Item" />
    </form>
    
    <strong>Hướng dẫn</strong> : Lấy 32 Mã Item từ MuMaker <font color='red'><strong>AA</strong></font>XXXX<font color='blue'><strong>BBBBBBBB</strong></font>XXXX<font color='red'><strong>C</strong></font>XXXXXXXXXXXXX<br />
    Ví dụ: <strong>dây chuyền set</strong> 0C0041001234563F00D0000000000000<br />
    <font color='red'><strong>AA</strong></font> : <strong>Item Code</strong> gồm 2 ký tự<br />
    <font color='blue'><strong>BBBBBBBB</strong></font> : <strong>Item Seri</strong> gồm 8 ký tự<br />
    <font color='red'><strong>C</strong></font> : <strong>Item Type</strong> gồm 1 ký tự<br />
    - <strong>Nếu tìm theo Seri</strong> : Điền vào <strong>Item Seri</strong>, để trống dòng bên dưới.<br />
    - <strong>Nếu tìm theo Loại Item với Seri bất kỳ</strong> : Để trống <strong>Item Seri</strong>, điền vào <strong>Item Type</strong> và <strong>Item Code</strong>. Item Level và Số lượng Item có thể điền nếu muốn. 
    <br />
    <i>(Nên Quét tại máy chủ MU để tránh bị hệ thống coi là BotNet do Request liên tục)</i>
</center>
<hr />

<?php
if($mod == "itemsearch") {
    $scanday = $_POST['scanday'];       $scanday = abs(intval($scanday));
    
    $item_exl = $_POST['item_exl'];     $item_exl = abs(intval($item_exl));
    $itemseri = $_POST['itemseri'];     $itemseri = strtoupper($itemseri);
    
    $itemcode = $_POST['itemcode'];     $itemcode = strtoupper($itemcode);
    $itemtype = $_POST['itemtype'];     $itemtype = strtoupper($itemtype);
    $itemlevel = $_POST['itemlevel'];   $itemlevel = abs(intval($itemlevel));
    $itemslg = $_POST['itemslg'];       $itemslg = abs(intval($itemslg));
    $thehe = $_POST['thehe'];           $thehe = abs(intval($thehe));
    
    $flag_err = false;
    $error = "";
    
    // Kiem tra Item Code
    if(strlen($itemcode) > 0 && strlen($itemcode) != 2) {
        $error .= "Item Code phải đúng 2 ký tự<br />";
        $flag_err = true;
    }
    elseif (!preg_match("/^[a-fA-F0-9]*$/i", $itemcode))
	{
        $error .= "Item Code không đúng<br />";
        $flag_err = true;
	}
    
    // Kiem tra Item Type
    if(strlen($itemtype) > 0 && strlen($itemtype) != 1) {
        $error .= "Item Type phải đúng 1 ký tự<br />";
        $flag_err = true;
    }
    elseif (!preg_match("/^[a-fA-F0-9]*$/i", $itemtype))
	{
        $error .= "Item Type không đúng<br />";
        $flag_err = true;
	}
    
    // Kiem tra Seri
    if(strlen($itemseri) > 0 && strlen($itemseri) != 8) {
        $error .= "Item Seri phải đúng 8 ký tự. Nếu không đủ cho thêm số 0 vào đằng trước.<br />";
        $flag_err = true;
    } else if (!preg_match("/^[a-fA-F0-9]*$/i", $itemseri))
	{
        $error .= "Item Seri không đúng<br />";
        $flag_err = true;
	}

    if($item_exl == 0 && empty($itemseri) && empty($itemcode) && empty($itemtype) && $itemlevel==0) {
        $error .= "Phải có ít nhất 1 tiêu chí tìm kiếm.<br />";
        $flag_err = true;
    }        
    
    if($flag_err == true) {
        echo "<center><strong>Lỗi</strong> : <br />$error</center>";
    } else {
        $_SESSION['scanday'] = $scanday;
        $_SESSION['item_exl'] = $item_exl;
        $_SESSION['itemcode'] = $itemcode;
        $_SESSION['itemseri'] = $itemseri;
        $_SESSION['itemtype'] = $itemtype;
        $_SESSION['itemlevel'] = $itemlevel;
        $_SESSION['itemslg'] = $itemslg;
        $_SESSION['thehe'] = $thehe;
        
        $_SESSION['finish'] = "unfinish";  // finish, unfinish
        $_SESSION['warehouse_scan'] = 0;
        $_SESSION['inventory_scan'] = 0;
        $_SESSION['data_first'] = false;
        $_SESSION['timebegin'] = $timestamp;
?>

<script type="text/javascript">
    var flag = true;
    var AjaxAutoLoad = function(){
        if(flag == true) {
            var data = "";
            $.ajax({
                type: "GET",
                url: "itemsearch_scan.php",
                data: data, 
                beforeSend: function(){
                    flag = false;
                },
                success: function(response){
                    var response_split = response.split("|");
                    $('#show').html(response_split[1]);
                    if(response_split[2].length > 0) {
                    	if(response_split[2] == 'finish') {
                    		clearInterval(refresh_search);
                    	} else {
                    		$('#itemfinded').last().append(response_split[2]);
                    	}
                    }
                    
                    flag = true;
                }
            });
        }
    }
    var refresh_search = setInterval( "AjaxAutoLoad();", 100 );
</script>
<?php
    }
}
?>


<?php
$db->Close();
?>
<div id="show"></div>
<table id="itemfinded" border="1" style="border-collapse: collapse;" spacecell="3" >
    <tr>
        <td width="100" align="center"><strong>Tài khoản</strong></td>
        <td width="100" align="center"><strong>Nhân vật</strong></td>
        <td align="center"><strong>Số lượng</strong></td>
        <td align="center"><strong>Vị trí</strong></td>
    </tr>
</table>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />