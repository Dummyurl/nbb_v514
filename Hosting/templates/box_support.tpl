<div class="box_dangnhap">
    <div class="bg_home2">
        <div class="text_home2">
            Hệ thống Hỗ Trợ</div>
    </div>
    <div class="pad_left">
        <div class="text_blue3">
            <a href="#support&act=inbox" rel="ajax" >Hộp tin : <span id="unread"><?php echo $unread_richtext; ?></span> tin mới</a>
        </div>
    <?php if( in_array($_SESSION[mu_username], $quantri_arr )) { ?>
        <div class="text_blue3">
            <a href="#support&act=adm_inbox" rel="ajax" >Quản lý : <span id="support_notans"><?php echo $support_notans_richtext; ?></span> hỗ trợ</a>
        </div>
    <?php } ?>
    </div>
    <div>
        <img src="images/box1_bot.gif" /></div>
</div>
<div class="padtop clear">
</div>