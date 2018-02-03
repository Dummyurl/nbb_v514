<div id="mainmenu">
    <ul>
    	<li><a href="index.php" style="padding: 0pt; margin-left: -5px; background: none repeat scroll 0% 0% transparent; border: 0pt none;"><img src="images/home.png"></a></li>
		
<?php
if ( isset($_SESSION['mu_username']) ) {
?>
        <?php if(isset($Use_KichKet) && $Use_KichKet == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#kick_ket" <?php if( $module == 'kick_ket' ) echo "class='menuactive'"; ?> >KÍCH KẸT</a></li>
        <?php } ?>
        <li><a style="width: 118px;" rel="menuajax" href="#acc_manager" <?php if( $module == 'acc_manager' ) echo "class='menuactive'"; ?> >TÀI KHOẢN</a></li>
        <li><a style="width: 118px;" rel="menuajax" href="#char_manager" <?php if($module == 'char_manager' ) echo "class='menuactive'"; ?> >NHÂN VẬT</a></li>
        <?php if(isset($Use_QuestDaily) && $Use_QuestDaily == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#questdaily" <?php if($module == 'questdaily' ) echo "class='menuactive'"; ?> >NHIỆM VỤ <span id="qdl_un"><?php echo isset($_SESSION['quest_daily']) && $_SESSION['quest_daily']>0 ? "<font color='red'>" . $_SESSION['quest_daily'] . "</font>" : "0";  ?></span></a></li>
        <?php } ?>
        <li><a style="width: 118px;" rel="menuajax" href="#guild" <?php if($module == 'guild' ) echo "class='menuactive'"; ?> >BANG HỘI</a></li>
        <?php if(isset($Use_LuyenBao) && $Use_LuyenBao == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#luyenbao" <?php if($module == 'luyenbao' ) echo "class='menuactive'"; ?> >Luyện Bảo <img src="images/cutkyhot.gif" border="0" /></a></li>
        <?php } ?>
        <?php if(isset($Use_MayChao) && $Use_MayChao == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#maychao" <?php if($module == 'maychao' ) echo "class='menuactive'"; ?> >Máy Chao <img src="images/cutkyhot.gif" border="0" /></a></li>
        <?php } ?>
        <li><a style="width: 118px;" rel="menuajax" href="#event" <?php if($module == 'event' ) echo "class='menuactive'"; ?> >EVENT</a></li>
        <?php if(isset($Use_TienTe) && $Use_TienTe == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#tiente" <?php if($module == 'tiente' ) echo "class='menuactive'"; ?> >TIỀN TỆ</a></li>
        <?php } ?>
        <?php if(isset($Use_NapThe) && $Use_NapThe == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#napthe" <?php if($module == 'napthe' ) echo "class='menuactive'"; ?> >NẠP THẺ</a></li>
        <?php } ?>
        
        <?php 
            include('config/config_daugia.php');
            if(isset($Use_DauGia) && $Use_DauGia == 1) { 
        ?>
        <li><a style="width: 118px;" rel="menuajax" href="#chotroi" <?php if($module == 'chotroi') echo "class='menuactive'"; ?> >Chợ Trời</a></li>
        <?php } ?>
        
        <li><a style="width: 118px;" rel="menuajax" href="#chopl" <?php if($module == 'chopl' ) echo "class='menuactive'"; ?> >Chợ PL <img src="images/cutkyhot.gif" border="0" /></a></li>
        
        <?php 
            include('config/config_daugianguoc.php');
            if(isset($Use_DauGiaNguoc) && $Use_DauGiaNguoc == 1) {  
        ?>
        <li><a style="width: 118px;" rel="menuajax" href="#daugianguoc" <?php if($module == 'daugianguoc') echo "class='menuactive'"; ?> >Đấu Giá Ngược</a></li>
        <?php } ?>
        
        <?php if(isset($Use_ThueItem) && $Use_ThueItem == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#reward" <?php if($module == 'reward' ) echo "class='menuactive'"; ?> >Thuê Item <img src="images/cutkyhot.gif" border="0" /></a></li>
        <?php } ?>
        
        <?php if(isset($Use_WebShop) && $Use_WebShop == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#webshop" <?php if($module == 'webshop' ) echo "class='menuactive'"; ?> >WEBSHOP</a></li>
        <?php } ?>
        <li><a style="width: 118px;" rel="menuajax" href="#relax" <?php if($module == 'relax' ) echo "class='menuactive'"; ?> >Giải Trí</a></li>
        <?php if(isset($Use_XepHang) && $Use_XepHang == 1) { ?>
        <li><a style="width: 118px;" rel="menuajax" href="#rank" <?php if($module == 'rank' ) echo "class='menuactive'"; ?> >XẾP HẠNG</a></li>
        <?php } ?>
        
        <li style="background-color: green;">&nbsp;</li>
<?php } ?>

        <li><a style="width: 118px;" rel="menuajax" href="#reset_view" >ĐIỀU KIỆN RS</a></li>
    	<li><a style="width: 118px;" rel="menuajax" href="#gioihanrs_view" >GIỚI HẠN RS</a></li>
    	<li><a style="width: 118px;" rel="menuajax" href="#tanthu_view" >HỖ TRỢ TÂN THỦ</a></li>
    	<li><a style="width: 118px;" rel="menuajax" href="#command" >LỆNH MU</a></li>
        
        <div class="clear"></div>
    </ul>
</div> <!-- mainmenu -->
