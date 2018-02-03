<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Đăng kí SERVER VIP</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

    <blockquote><p align="center">
            - Đăng kí để vào SERVER VIP.<br/>
        </p></blockquote>

    <form id="buy_server_vip" name="buy_server_vip" method="post" action="index.php?mod=acc_manager&act=buy_server_vip">
        <input type="hidden" name="action" value="buy_server_vip"/>
        <table width="100%" border="0" cellpadding="3" cellspacing="1">
            <tr>
                <td align="right">Chọn gói VIP</td>
                <td>
                    <select name="vip_choose" id="vip_choose">
                        <?php
							for($i=0; $i<$buy_server_vip_slg; $i++) {
								echo '<option value="'. $i .'">Mua '. $buy_server_vip_day[$i] .' ngày = '.
                        number_format($buy_server_vip_price[$i], 0, ',', '.') .' GCoin</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Thoát Game:</td>
                <td><?php echo $online; ?></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><b>Thông tin kiểm tra</b></td>
            </tr>
            <tr>
                <td align="right">Mật khẩu Cấp 2</td>
                <td><input type="password" name="pass2" size="20"/></td>
            </tr>
            <tr>
                <td align="right">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Mua VIP" <?php if($accept=='0') { ?>
                    disabled="disabled" <?php } ?> />
                </td>
            </tr>
        </table>
    </form>

    <div class="clear">
    </div>
</div>
<!-- End Content -->