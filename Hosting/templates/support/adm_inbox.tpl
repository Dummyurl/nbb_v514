<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif" /></div>

    <div class="title">Quản lý Hỗ Trợ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif" /></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
	<div class="text_red">
        <a href="#support&act=adm_writesupport" rel="ajax" >Gửi tin nhắn đến người chơi</a>
    </div>
<?php if(count($supporttheodoi)>0) { ?>    
    <table width="100%" border="0" bgcolor="#9999FF">
      <caption align="top">
        Danh sách <b>Theo dõi</b>
      </caption>
	  <tr bgcolor="#FFFFFF">
        <th scope="col" align="center">Tiêu đề hỗ trợ</th>
        <th scope="col" align="center" width="100">Tài khoản</th>
	    <th scope="col" align="center" width="150">Gửi lúc</th>
      </tr>
<?php for($i=0;$i<count($supporttheodoi);$i++) { ?>
      <tr bgcolor="#FFFFFF">
        <td align="justify"><a href="#support&act=adm_readsupport&id=<?php echo $supporttheodoi[$i]['supid']; ?>" rel="ajax" ><?php echo $supporttheodoi[$i]['sup_title']; ?></a></td>
        <td align="center"><?php echo $supporttheodoi[$i]['AccountID']; ?></td>
        <td align="center"><?php echo $supporttheodoi[$i]['sup_time']; ?></td>
      </tr>
<?php } ?>
    </table>
    <hr />
<?php } ?>
    <table width="100%" border="0" bgcolor="#9999FF">
      <caption align="top">
        Danh sách <b>Hỗ Trợ</b>
      </caption>
	  <tr bgcolor="#FFFFFF">
        <th scope="col" align="center">Tiêu đề hỗ trợ</th>
        <th scope="col" align="center" width="100">Tài khoản</th>
	    <th scope="col" align="center" width="150">Gửi lúc</th>
      </tr>
<?php for($i=0;$i<count($supportlist);$i++) { ?>
      <tr bgcolor="#FFFFFF">
        <td align="justify"><a href="#support&act=adm_readsupport&id=<?php echo $supportlist[$i]['supid']; ?>" rel="ajax" ><?php echo $supportlist[$i]['sup_title']; ?></a></td>
        <td align="center"><?php echo $supportlist[$i]['AccountID']; ?></td>
        <td align="center"><?php echo $supportlist[$i]['sup_time']; ?></td>
      </tr>
<?php } ?>
    </table>
    
	<div class="clear">
	</div>
</div>
<!-- End Content -->