<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>
    <div class="title">Event >> <?php echo $event_bongda_name; ?></div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->
<!-- Content -->
<div class="pad10">

<script language="javascript">
	function btn_check_dudoan()
	{
		var s = document.dudoan_bongda;
		var check_error = 0;
		if ( (check_so(s.slgdudoan.value,'msg_slgdudoan') == 1) )
			{
				check_error++;
				if(check_error == 1) s.slgdudoan.focus();
			}
	
		if(check_error > 0) {
			alert("Có lỗi. Vui lòng kiểm tra lại thông tin !!!");
			return false;
		}
		else return true;
	}
</script>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th width="200" align="right" scope="row">Tham gia dự đoán trận : </th>
        <td><font color="#FF0000"><b><?php echo $doi1.' - '.$doi2?></b></font></td>
      </tr>
      <tr>
        <th align="right" scope="row">Giải thi đấu : </th>
        <td><?php echo $giai; ?></td>
      </tr>
      <tr>
        <th align="right" scope="row">Thời gian thi đấu : </th>
        <td><?php echo $time_dau; ?></td>
      </tr>
      <tr>
        <th align="right" scope="row">Thời gian kết thúc dự đoán : </th>
        <td><?php echo $time_end; ?></td>
      </tr>
    </table>
	<br>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><strong>Điều lệ tham gia dự đoán : </strong></td>
      </tr>
      <tr>
        <td width="20">&nbsp;</td>
        <td><ul>
            <li>Chi phí cho 1 lần dự đoán : <strong>1.000 Vpoint</strong>.</li>
            <li><strong>Tài khoản thắng cuộc</strong> : Dự đoán đúng kết quả trận đấu đồng thời dự đoán tổng số kết quả dự đoán đúng có sai số gần nhất so với kết quả chính xác.</li>
            <li>Không giới hạn số lần dự đoán của 1 tài khoản.</li>
            <li>Nếu kết quả dự đoán trùng nhau, người dự đoán trước sẽ thắng.</li>
            <li>Mỗi 1 trận dự đoán sẽ có 3 người thắng cuộc.</li>
        </ul></td>
      </tr>
    </table>
	<br>
	<table width="80%" border="1" style="border-collapse:collapse" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <th colspan="3" align="center" scope="col">Phần thưởng </th>
      </tr>
      <tr>
        <td align="right">Giải nhất : </td>
        <td>Dự đoán với sai số ít nhất </td>
        <td align="center"><strong><?php echo number_format($event_bongda_giai1, 0, ',', '.'); ?> Vpoint </strong></td>
      </tr>
      <tr>
        <td align="right">Giải nhì : </td>
        <td>Dự đoán với sai số ít thứ 2 </td>
        <td align="center"><strong><?php echo number_format($event_bongda_giai2, 0, ',', '.'); ?> Vpoint </strong></td>
      </tr>
      <tr>
        <td align="right">Giải ba : </td>
        <td>Dự đoán với sai số ít thứ 3 </td>
        <td align="center"><strong><?php echo number_format($event_bongda_giai3, 0, ',', '.'); ?> Vpoint </strong></td>
      </tr>
    </table>
	<br>
	<table width="80%" border="1" style="border-collapse:collapse" align="center" cellpadding="2" cellspacing="2">
      <tr>
        <th colspan="3" align="center" scope="col">Gợi ý số dự đoán hiện tại</th>
      </tr>
      <tr>
        <td align="center"><font color="#0000FF"><b><?php echo $doi1; ?></b> Thắng <b><?php echo $doi2; ?></b></font></td>
        <td align="center"><font color="#993300"><b><?php echo $doi1; ?></b> Hòa <b><?php echo $doi2; ?></b></font></td>
        <td align="center"><font color="#FF0000"><b><?php echo $doi1; ?></b> Thua <b><?php echo $doi2; ?></b></font></td>
      </tr>
      <tr>
        <td align="center"><?php echo $goiy_win; ?></td>
        <td align="center"><?php echo $goiy_draw; ?></td>
        <td align="center"><?php echo $goiy_lose; ?></td>
      </tr>
    </table>
	<br>
	<form name='dudoan_bongda' method="post" action="index.php?mod=event&act=event_bongda&page=event_bongda_dudoan&tranid=<?php echo $tranid; ?>">
	<input type="hidden" name="check_dudoan" value="ok">
	<input type="hidden" name="tran_id" value="<?php echo $tranid; ?>">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="300" align="right">Dự đoán : </td>
        <td><b><?php echo $doi1; ?></b> 
          <select name="ketqua">
            <option value="1">Thắng</option>
            <option value="2">Hòa</option>
            <option value="3">Thua</option>
          </select>
          <b><?php echo $doi2; ?></b> </td>
      </tr>
      <tr>
        <td align="right">Có bao nhiêu ý kiến dự đoán giống bạn : </td>
        <td><input name="slgdudoan" type="text" id="slgdudoan" value="0" size="10" onfocus="focus_so(this.value,'msg_'+this.name);" onkeyup="check_so(this.value,'msg_'+this.name)"/> <label id="msg_slgdudoan" class="msg"></label></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="Submit" value="Dự đoán" onclick="return btn_check_dudoan();"/></td>
      </tr>
    </table>
	</form>
    <br>
    <table width="80%" border="1" align="center" cellpadding="2" cellspacing="2" style="border-collapse:collapse">
      <tr>
        <th colspan="4" align="center" scope="col">Dự đoán của bạn </th>
      </tr>
      <tr>
        <td align="center"><strong>STT</strong></td>
        <td align="center"><strong>Dự Đoán Trận Đấu </strong></td>
        <td align="center"><strong>Dự đoán Số ý kiến giống bạn </strong></td>
        <td align="center"><strong>Dự đoán lúc</strong></td>
      </tr>
<?php for($i=0;$i<$count_dudoan-2;$i++) { ?>
      <tr>
        <td align="center"><?php echo $i+1; ?></td>
        <td align="center"><?php echo $mydudoan[$i][msg_dudoan]; ?></td>
        <td align="center"><?php echo $mydudoan[$i][dudoan_slg]; ?></td>
        <td align="center"><?php echo $mydudoan[$i][time_dudoan]; ?></td>
      </tr>
<?php } ?>
    </table>
	<div class="clear">
	</div>
</div>
<!-- End Content -->