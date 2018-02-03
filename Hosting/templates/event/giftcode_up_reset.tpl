<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Gifcode Up Reset</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    <blockquote><p align="center">
            - Sau khi đăng kí nhận Giftcode. Vào mục lịch sử Giftcode để lấy mã.<br/>
            - Mỗi tài khoản chỉ được nhận duy nhất 1 lần cho 1 nhân vật.<br/>
            - Chi phí nhận Giftcode: <?php echo number_format($giftcode_up_reset_gcoin, 0, ',', '.'); ?> Gcoin
        </p></blockquote>

    <form id="giftcode_up_reset" name="giftcode_up_reset" method="post"
          action="index.php?mod=event&act=giftcode_up_reset">
        <input type="hidden" name="action" value="giftcode_up_reset"/>
        <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>"/>
        <table width="100%" border="0" cellpadding="3" cellspacing="1">
            <tr>
                <td align="right" width="40%">Nhân vật nhận code:</td>
                <td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><b>Điều kiện nhận</b></td>
            </tr>
            <tr>
                <td align="right">Gcoin:</td>
                <td><?php echo $notice_gcoin; ?></td>
            </tr>
            <tr>
                <td align="right">Thoát Game:</td>
                <td><?php echo $online; ?></td>
            </tr>
            <tr>
                <td align="right">Mật khẩu Cấp 2</td>
                <td><input type="password" name="pass2" size="20"/></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Nhận Code" <?php if($accept=='0') { ?>
                    disabled="disabled" <?php } ?> />
                </td>
            </tr>
        </table>
    </form>

    <div class="clear">
    </div>
</div>
<!-- End Content -->