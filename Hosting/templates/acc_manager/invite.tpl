<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Hệ thống Giới thiệu thành viên</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
	<fieldset><legend>Hoạt động</legend>
    <p>- Khi game thủ đăng ký tài khoản , game thủ có thể <strong>lựa chọn tài khoản giới thiệu mình</strong> (Gọi là <strong>Tuyến trên</strong>) - Người Tuyến trên sẽ cho bạn biết liên kết giới thiệu của họ để bạn đăng ký tài khoản.</p>
    <p>      - Khi đăng ký qua liên kết này, bạn đã là thành viên thuộc <strong>Tuyến dưới</strong> của họ.</p>
    <p>      - Khi đã có tài khoản, bạn cũng có 1 liên kết giới thiệu. Bạn có thể công khai liên kết này và giới thiệu cho nhiều người khác để <strong>xây dựng một mạng lưới thành viên thuộc hệ thống của bạn</strong>.</p>
    <p>      - Mỗi khi phát sinh giao dịch nạp thẻ từ các thành viên này bạn sẽ được <strong>hệ thống tặng thưởng 5% giá trị thẻ vào tài khoản</strong>. </p>
	</fieldset>
	<p align="center">&nbsp;</p>
	<p align="center">Liên kết giới thiệu của bạn : <a href="<?php echo $link_invite; ?>"><font color="#FF0000"><b><br />
    <?php echo $link_invite; ?></b></font></a></p>
	<table width="100%" border="0" bgcolor="#9999FF">
      <caption align="top">
        Danh sách thành viên Tuyến dưới của bạn
      </caption>
	  <tr bgcolor="#FFFFFF">
        <th scope="col" align="center">STT</th>
	    <th scope="col" align="center">Nhân vật </th>
	    <th scope="col" align="center">Thời điểm giới thiệu </th>
	    <th scope="col" align="center">Vpoint được hưởng </th>
      </tr>
<?php for($i=1;$i<$_SESSION['slg_inv'];$i++) { ?>
      <tr bgcolor="#FFFFFF">
        <td align="center"><?php echo $i; ?></td>
        <td align="center"><?php echo $_SESSION[info_invite][$i][character]; ?></td>
        <td align="center"><?php echo $_SESSION[info_invite][$i][time_inv]; ?></td>
        <td align="center"><?php echo $_SESSION[info_invite][$i][vpoint]; ?></td>
      </tr>
<?php } ?>
    </table>
	<p align="center">&nbsp;</p>
	<p>&nbsp;</p>
	<div class="clear">
	</div>
</div>
<!-- End Content -->