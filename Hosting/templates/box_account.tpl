<!-- Box Account -->
<div class="top">Tài khoản</div>
<div class="middle">
	<img style="margin-left: -20px;" src="images/logintop.png">
		<div class="loginpanel">
            <center>
            <strong class="clr02" style="color: yellow; font-size: 20px;"><?php echo isset($_SESSION['mu_username']) ? $_SESSION['mu_username'] : 'demo'; ?></strong><br /><br />
            </center>
		</div>
	<img style="margin-left: -20px;" src="images/loginbottom.png">

    <div class="text_blue3">
        <strong>Thế hệ</strong> : <?php if(!isset($_SESSION['acc_thehe'])) $_SESSION['acc_thehe'] = 1; $acc_thehe = $_SESSION['acc_thehe']; echo $thehe_choise[$acc_thehe]; ?>
    </div>
    <div class="text_blue3">
        <strong>Gcoin</strong> : <?php echo isset($_SESSION['acc_gcoin']) ? number_format($_SESSION['acc_gcoin'], 0, ',', '.') : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Gcoin Khuyến Mãi</strong> : <?php echo isset($_SESSION['acc_gcoin_km']) ? number_format($_SESSION['acc_gcoin_km'], 0, ',', '.') : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Vpoint</strong> : <?php echo isset($_SESSION['acc_vpoint']) ? number_format($_SESSION['acc_vpoint'], 0, ',', '.') : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Zen</strong> : <?php echo isset($_SESSION['acc_zen']) ? number_format($_SESSION['acc_zen'], 0, ',', '.') : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Trái Tim</strong> : <?php echo isset($_SESSION['acc_heart']) ? $_SESSION['acc_heart'] : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Chao</strong> : <?php echo isset($_SESSION['acc_chao']) ? $_SESSION['acc_chao'] : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Cre</strong> : <?php echo isset($_SESSION['acc_cre']) ? $_SESSION['acc_cre'] : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Blue</strong> : <?php echo isset($_SESSION['acc_blue']) ? $_SESSION['acc_blue'] : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>IP Bonus Point</strong> : <?php echo isset($_SESSION['IPBonusPoint']) ? number_format($_SESSION['IPBonusPoint'], 0, ',', '.') : 0; ?>
    </div>
    <div class="text_blue3">
        <strong>Phone</strong> : xxxxxxx<?php echo isset($_SESSION['acc_phone']) ? $_SESSION['acc_phone'] : 'demo'; ?>
    </div>
    <div align="left" style="margin-right:25px;">
        (*) Nếu dữ liệu tài khoản không đúng, vui lòng <strong class="clr02">Đăng nhập lại</strong><br />
        (*) Nếu dữ liệu nhân vật không đúng, vui lòng <strong class="clr02">Chọn lại nhân vật</strong>
    </div>
    <div align="right" style="margin-right:25px;">
        <form method='post' name='logout' action='index.php'>
			<input type='hidden' name='logout' value='logout' />
			<input type='submit' name='submit' value='Thoát' />
		</form>
    </div>
    
</div>
<div class="bottom">

</div>  		
<div class="padtop clear">
</div>
<!-- End Box Account -->