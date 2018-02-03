<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Reset Quest - Làm lại nhiệm vụ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">
	
    	<blockquote><p align="center">- Sau khi Reset Quest, nhân vật sẽ phải làm lại nhiệm vụ từ đầu.<br>
    	- Lớp nhân vật sẽ trở về cấp 1.</p></blockquote>
		
		<form id="reset_quest" name="reset_quest" method="post" action="index.php?mod=char_manager&act=reset_quest">
		  <input type="hidden" name="action" value="reset_quest" />
		  <input type="hidden" name="character" value="<?php echo $_SESSION['mu_nvchon']; ?>" />
		    <table width="100%" border="0" cellpadding="3" cellspacing="1">
				<tr>
					<td align="right" width="40%">Nhân vật Reset Quest :</td>
					<td><strong class="clr02"><?php echo $_SESSION['mu_nvchon']; ?></strong></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><b>Điều kiện Reset Quest</b></td>
				</tr>
				<tr>
					<td align="right">Đổi nhân vật</td>
					<td><?php echo $doinv; ?></td>
				</tr>
                <tr>
					<td align="right"><strong>Tháo đồ</strong></td>
					<td>Tháo hết đồ mặc trên người</td>
				</tr>
				<tr>
					<td align="right">Mật khẩu Cấp 2</td>
					<td><input type="password" name="pass2" size="20" /></td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td><input type="submit" name="Submit" value="Reset Quest" <?php if($accept=='0') { ?> disabled="disabled" <?php } ?> onclick="return confirm('Bạn chắc chắn đã tháo hết đồ trên người chưa?\n- Nếu chưa hãy chọn Cancel để hủy.\n- Nếu đã cất chọn OK để tiếp tục.\nMọi vấn đề mất đồ không làm theo hướng dẫn, BQT không chịu trách nhiệm.');" /></td>
				</tr>
			</table>
		</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->