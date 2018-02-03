		<div id="left-column">
<?php if( $mod=='editconfig' || !$mod ) { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editconfig&act=config_sync">Cấu Hình Đồng bộ Hosting</a></li>
                <li><a href="admin.php?mod=editconfig&act=config">Cấu Hình Web</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_antiddos">Hệ thống chống DDOS</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_dongbo">Cấu Hình Chung</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_domain">Tên miền chính WebSite</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_chucnang">Cấu hình Chức năng</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_autonap">Cấu hình Auto Nạp Thẻ</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_license">Cấu hình License</a></li>
				<li><a href="admin.php?mod=editconfig&act=config_sms">Cấu hình SMS</a></li>
                <li class="last"><a href="admin.php?mod=editconfig&act=config_sendmess">Cấu hình Thông Báo Game</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editchar') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editchar&act=quest_daily">Nhiệm vụ Phúc Lợi</a></li>
                <li><a href="admin.php?mod=editchar&act=tuluyen">Tu Luyện</a></li>
                <li><a href="admin.php?mod=editchar&act=songtu">Song Tu</a></li>
                <li><a href="admin.php?mod=editchar&act=lockitem">Bảo Vệ Item</a></li>
                <li><a href="admin.php?mod=editchar&act=reset">Reset</a></li>
				<li><a href="admin.php?mod=editchar&act=resetvip">ResetVIP</a></li>
				<li><a href="admin.php?mod=editchar&act=gioihanrs">Giới hạn Reset</a></li>
				<li><a href="admin.php?mod=editchar&act=hotrotanthu">Hỗ trợ Tân thủ</a></li>
                <li><a href="admin.php?mod=editchar&act=point_rsday">Point Reset Ngày</a></li>
				<li><a href="admin.php?mod=editchar&act=relife">ReLife</a></li>
				<li><a href="admin.php?mod=editchar&act=uythacoffline">Ủy thác Offline</a></li>
				<li><a href="admin.php?mod=editchar&act=uythac_reset">Ủy Thác - Reset</a></li>
				<li><a href="admin.php?mod=editchar&act=uythac_resetvip">Ủy Thác - ResetVIP</a></li>
				<li><a href="admin.php?mod=editchar&act=reset_over">Reset Over</a></li>
				<li><a href="admin.php?mod=editchar&act=resetvip_over">Reset VIP Over</a></li>
				<li><a href="admin.php?mod=editchar&act=ruatoi">Rửa tội</a></li>
				<li><a href="admin.php?mod=editchar&act=taytuy">Tẩy tủy</a></li>
				<li><a href="admin.php?mod=editchar&act=doigioitinh">Đổi Giới Tính</a></li>
                <li><a href="admin.php?mod=editchar&act=thehe">Thế Hệ</a></li>
                <li class="last"><a href="admin.php?mod=editchar&act=uplvitem">Ép cấp độ Item</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editevent') { ?>
<!--
			<h3>Event Char</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editevent&act=event_week">Event Tuần</a></li>
				<li class="last"><a href="admin.php?mod=editevent&act=event_month">Event Tháng</a></li>
			</ul>
-->            
            <h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editevent&act=event1">Event Đổi Item -> Point</a></li>
				<li class="last"><a href="admin.php?mod=editevent&act=event_santa">Vé làng Santa</a></li>
			</ul>
            
            <h3>GiftCode</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editevent&act=giftcode_tanthu">GiftCode tân thủ</a></li>
				<li><a href="admin.php?mod=editevent&act=giftcode_rs">GiftCode Reset</a></li>
                <li><a href="admin.php?mod=editevent&act=giftcode_week">GiftCode Tuần</a></li>
                <li class="last"><a href="admin.php?mod=editevent&act=giftcode_month">GiftCode Tháng</a></li>
                <li><a href="admin.php?mod=editevent&act=giftcode_acc">GiftCode Tài khoản</a></li>
                <li><a href="admin.php?mod=editevent&act=giftcode_phat">GiftCode Phát</a></li>
			</ul>
            
            <h3>GiftCode Ngẫu Nhiên</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editevent&act=giftcode_random_type1">Loại 1</a></li>
                <li><a href="admin.php?mod=editevent&act=giftcode_random_type2">Loại 2</a></li>
                <li class="last"><a href="admin.php?mod=editevent&act=giftcode_random_type3">Loại 3</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editluyenbao') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editluyenbao&act=cuonghoa">Cường Hóa</a></li>
                <li><a href="admin.php?mod=editluyenbao&act=hoanhaohoa">Hoàn Hảo Hóa</a></li>
			</ul>
            
<?php } ?>

<?php if( $mod=='editguild') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editguild&act=guild_balance">Cân bằng Thế Lực</a></li>
			</ul>
            
<?php } ?>

<?php if( $mod=='editcom') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editcom&act=daugia">Chợ Trời</a></li>
                <li><a href="admin.php?mod=editcom&act=daugianguoc">Đấu Giá Ngược</a></li>
			</ul>
            
<?php } ?>
<?php if( $mod=='editwebshop') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editwebshop&act=shop_taphoa">Shop Tạp Hóa</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_event">Shop vé Event</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_acient">Shop SET Thần Thánh</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_kiem">Shop Kiếm</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_gay">Shop Gậy</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_cung">Shop Cung</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_vukhikhac">Shop Vũ Khí khác</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_khien">Shop Khiên</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_mu">Shop Mũ</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_ao">Shop Áo</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_quan">Shop Quần</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_tay">Shop Tay</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_chan">Shop Chân</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_trangsuc">Shop Trang Sức</a></li>
				<li><a href="admin.php?mod=editwebshop&act=shop_canh">Shop Cánh</a></li>
				<li class="last"><a href="admin.php?mod=editwebshop&act=shop_zen">Shop tiền Zen</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editreward') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editreward">Hướng dẫn</a></li>
                <li><a href="admin.php?mod=editreward&act=reward_config">Thiết Lập Chung</a></li>
                <li><a href="admin.php?mod=editreward&act=reward_taphoa">Cho Thuê Tạp Hóa</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_kiem">Cho Thuê Kiếm</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_gay">Cho Thuê Gậy</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_cung">Cho Thuê Cung</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_vukhikhac">Cho Thuê Vũ Khí khác</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_khien">Cho Thuê Khiên</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_mu">Cho Thuê Mũ</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_ao">Cho Thuê Áo</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_quan">Cho Thuê Quần</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_tay">Cho Thuê Tay</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_chan">Cho Thuê Chân</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_trangsuc">Cho Thuê Trang Sức</a></li>
				<li><a href="admin.php?mod=editreward&act=reward_canh">Cho Thuê Cánh</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editnapthe') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editnapthe&act=gate">Thẻ GATE</a></li>
                <li><a href="admin.php?mod=editnapthe&act=vtc">Thẻ VTC</a></li>
				<li class="last"><a href="admin.php?mod=editnapthe&act=viettel">Thẻ Viettel</a></li>
			</ul>
<?php } ?>
<?php if( $mod=='editrelax') { ?>
			<h3>Chức năng</h3>
            <ul class="nav">
				<li><a href="admin.php?mod=editrelax&act=lo">Lô</a></li>
				<li class="last"><a href="admin.php?mod=editrelax&act=de">Đề</a></li>
			</ul>
<?php } ?>
		</div>