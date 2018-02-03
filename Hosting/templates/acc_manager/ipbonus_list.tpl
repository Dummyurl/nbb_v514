<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">IP Bonus</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">

        <strong>Cách đăng ký IP Bonus cho quán NET</strong>, chủ quán NET vui lòng gửi thông tin cho ADMIN:<br />
        <fieldset>
            <strong>Tài khoản Game đại diện</strong> : ... (tài khoản để cập nhập IP cho quán NET)<br />
            <strong>Tên quán NET</strong> : ...<br />
            <strong>Địa chỉ quán NET</strong> : ... (Đẩy đủ số nhà, đường, quận/huyện, thành phố/tỉnh)
        </fieldset>
        <br />
        <strong>Lợi ích khi chơi ở quán NET đăng ký IP Bonus</strong>:
        <ul>
            <li>Trong quá trình Online nhận được IP Bonus Point (1 phút = 1 điểm)</li>
            <li>IP Bonus Point có thể đổi ra PC Point để mua đồ tại SHOP IP Bonus (bờ hồ Lorencia)</li>
            <li>IP Bonus Point có thể đổi ra GiftCode (thẻ quà tặng)</li>
        </ul>

	<table width="100%" border="0" bgcolor="#9999FF">
		  <tr bgcolor="#FFFFFF">
		    <th scope="col" align="center">Tên quán NET</th>
		    <th scope="col" align="center">Địa chỉ</th>
		  </tr>
          <?php
            for($i=0; $i<count($netname); $i++) {
          ?>
          <tr bgcolor="#FFFFFF">
		    <td align="center"><?php echo $netname[$i]; ?></td>
		    <td align="center"><?php echo $netaddr[$i]; ?></td>
		  </tr>
          <?php
            }
          ?>
    </table>
	<br class="clear" />

</div>