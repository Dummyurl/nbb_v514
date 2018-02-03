<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Event >> GiftCode Reset</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#9999FF">
				<tr bgcolor="#FFFFFF" >
					<td align="center"><strong>STT</strong></td>
					<td align="center"><strong>Thông tin phần thưởng GiftCode Reset</strong></td>
				</tr>
				<?php for($i=0; $i<count($item_read); $i++) { ?>
                <tr bgcolor="#FFFFFF" >
                    <td align="center"><?php echo $i+1; ?></td>
					<td align="center"><strong><?php echo $item_read[$i]['des']; ?></strong></td>
				</tr>
                <?php } ?>
                <tr bgcolor="#FFFFFF" >
					<td align="justify" colspan="3">
					<center><b>Lưu Ý</b></center><br />
                    - <strong>Mốc Reset nhận được GiftCode</strong>:<br />
                    <ul>
                        <?php if(strlen($gift_rs_choise) > 0) { ?><li>Khi Reset đạt : <?php echo $gift_rs_choise; ?></li><?php } ?>
                        <?php if($gift_rs_mod>0) { ?><li>Khi số lần Reset chia hết cho <?php echo $gift_rs_mod; ?></li><?php } ?>
                    </ul>
					- Cơ hội may mắn nhận được mã GiftCode Reset là <strong><?php echo $giftcode_rs_percent; ?>%</strong> khi thỏa mãn mốc Reset trên.<br />
                    <?php if(strlen($gift_rs_choise) > 0 && $gift_rs_mod>0) { ?>- Nếu mốc Reset thỏa mãn cả 2 điều kiện trên thì cũng chỉ nhận được 1 mã GiftCode Reset<br /><?php } ?>
                    - Nếu nhân vật đến lần Reset của mốc nhận GiftCode Reset mà không may mắn nhận được GiftCode, nhân vật đó sử dụng các tính năng để làm giảm Reset. Sau đó nhân vật Reset đạt mốc Reset đã vượt qua trước đó thì sẽ không nhận được GiftCode Reset.<br />
                    - Phần thưởng nhận được là ngẫu nhiên trong danh sách bên trên.<br />
                    - Mỗi nhân vật có thể nhận và sử dụng GiftCode Reset không giới hạn.<br />
                    - Không thể sử dụng GiftCode Reset của tài khoản này cho tài khoản khác.<br />
                    - Phần thưởng GiftCode Reset <strong>
                    <?php 
                        if($trade == 1) echo "Có thể giao dịch, ";
                        else echo "Không thể giao dịch, ";
                     ?>
                     <?php 
                        if($sell == 1) echo "Có thể bán SHOP, ";
                        else echo "Không thể bán SHOP, ";
                     ?>
                     <?php 
                        if($repair == 1) echo "Có thể Sửa.";
                        else echo "Không thể Sửa.";
                     ?>
                     </strong>
                     
					</td>
				</tr>
			</table>
	<div class="clear">
	</div>
</div>
<!-- End Content -->