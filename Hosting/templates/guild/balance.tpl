<?php if (isset($_SESSION['mu_nvchon'])) { ?>
<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Bang Hội >> Chính Sách cân bằng Thế Lực</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
<?php
    if(isset($error_module)) echo "<center><font color='red'><strong>$error_module</strong></font></center><br />";
    include('config/config_guild_balance.php');
?>
<center><b>Chính sách Cân Bằng Thế Lực:</b></center>
<ul>
    <li>Guild nhiều hơn <?php echo $guild_maxmem; ?> thành viên bị trừ <?php echo $guild_maxmem_redurepoint; ?>% Point khi Reset</li>
    <li>Guild TOP 1 Point liên minh với Guild TOP 2 Point : thành viên 2 Guild này bị trừ <?php echo $guild_top12lm_redurepoint; ?>% Point khi Reset<br /><br /></li>
    <!--
    <li>
        <strong>Phúc lợi hàng ngày Guild TOP 1 Point</strong> :
        <ul>
            <li>Điểm Phúc Lợi : <?php echo $guild_top1_pl; ?> điểm</li>
            <li>Ngọc Hỗn Nguyên trong ngân hàng : <?php echo $guild_top1_chao; ?> viên</li>
            <li>Điều kiện thành viên nhận thưởng : Ngày hôm trước thực hiện ít nhất <?php echo $guild_top1_rs; ?> lần Reset</li>
        </ul>
        <br />
    </li>
    -->
    <li>
        <strong>Hỗ trợ Guild Yếu:</strong><br />
        <ul>
            <li>Guild TOP 2 Point được thêm : <?php echo $guild_top2addpoint; ?>% Point khi Reset</li>
            <li>Guild TOP 3 Point được thêm : <?php echo $guild_top3addpoint; ?>% Point khi Reset</li>
            <li>Guild TOP 4 Point được thêm : <?php echo $guild_top4addpoint; ?>% Point khi Reset</li>
            <li>Guild TOP 5 Point được thêm : <?php echo $guild_top5addpoint; ?>% Point khi Reset</li>
            <li>Guild TOP 6-10 Point được thêm : <?php echo $guild_top6overaddpoint; ?>% Point khi Reset</li>
            <li>Guild không nằm trong TOP 10 Point được thêm : <?php echo $guild_top10overaddpoint; ?>% Point khi Reset</li>
            <li>
                <strong>Điều kiện Guild TOP 2 trở đi được nhận Point hỗ trợ khi Reset</strong>:
                <ul>
                    <li>Guild đã được thành lập trên <?php echo $guild_addpoint_require_day; ?> ngày</li>
                    <li>Số thành viên trong Guild phải từ <?php echo $guild_addpoint_require_mem; ?> trở lên</li>
                    <li>Tổng số lần thực hiện Reset của các thành viên trong ngày hôm trước phải trên <?php echo $guild_addpoint_require_rs; ?> lần</li>
                </ul>
            </li>
        </ul>
    </li>
            
    
</ul>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->
<?php } else include('templates/char_manager.tpl'); ?>