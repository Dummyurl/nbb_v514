<!-- Title -->
<div class="title_bg">
    <div class="nl">
        <img src="images/box_tit_left.gif"></div>

    <div class="title">Quản lý Hỗ Trợ</div>
    <div class="nr">
        <img src="images/box_tit_right.gif"></div>
</div>
<!-- End Title -->            
<!-- Content -->
<div class="pad10">
    <table width="100%" border="0" bgcolor="#9999FF" cellpadding="3">
    <?php for($i=0; $i<count($support_read); $i++) { ?>
	  <tr bgcolor="#FFFFFF">
        <td align="justify" class="<?php echo $support_read[$i]['class_title']; ?>"><?php echo $support_read[$i]['title']; ?></td>
      </tr>
    
      <tr bgcolor="#FFFFFF">
        <td align="justify" class="<?php echo $support_read[$i]['class_content']; ?>"><?php echo $support_read[$i]['content']; ?></td>
      </tr>
     <?php } ?> 
    </table>
<div align="right">
<form id="check" name="check" method="post" action="index.php?mod=support&act=adm_readsupport&id=<?php echo $subid; ?>">
  <input name="check" type="hidden" id="check" value="1" />
  <input name="repplied" type="checkbox" id="repplied" value="checkbox" <?php if($repllied==1) { ?> checked="checked" <?php } ?>" /> 
  Đã trả lời
  <input name="theodoi" type="checkbox" id="theodoi" value="checkbox" <?php if($theodoi==1) { ?> checked="checked" accept="<?php } ?>" /> 
  Theo dõi
  <input type="submit" name="Submit" value="Thực hiện" />
</form>
</div>
<!-- Thong tin phan hoi -->
<div class="text_red">
    <?php if($_GET['type'] == 'full') { ?>
    <a href="#support&act=adm_readsupport&id=<?php echo $subid; ?>" rel="ajax" >Chuyển sang dạng đơn giản</a> : Không có tích hợp bộ soạn thảo (Thích hợp yêu cầu hỗ trợ đơn giản - <b>Truy Cập Nhanh</b>)
    <?php } else { ?>
    <a href="index.php?mod=support&act=adm_readsupport&type=full&id=<?php echo $subid; ?>">Chuyển sang dạng đầy đủ</a> : Có tích hợp bộ soạn thảo (Thích hợp chèn thêm liên kết, hình ảnh - <b>Truy Cập Chậm</b>)
    <?php } ?>
</div>
<form id="sendsupport" name="sendsupport" method="POST" action="index.php?mod=support&act=adm_readsupport&id=<?php echo $subid; ?>">
	<input type="hidden" name="action" value="sendsupport" />
    	<table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
			<td>
                Trả lời hỗ trợ : <br />
                <textarea name="supportcontent" cols="75" rows="7" id="supportcontent"><?php if($replied != 1) echo stripcslashes($_POST['supportcontent']); ?></textarea>
			  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
              <script type="text/javascript" src="ckeditor/config.js" ></script>
              <script type="text/javascript">
    			//<![CDATA[
    
    				CKEDITOR.replace( 'supportcontent',
    					{
    						skin : 'kama'
    					});
    
    			//]]>
    			</script>
            </td>
		</tr>
		<tr>
			<td align="right">
                <input name="theodoi" type="checkbox" id="theodoi" value="checkbox" <?php if($theodoi==1) { ?> checked="checked" accept="<?php } ?>" /> Theo dõi 
                <input type="submit" name="Submit" value="Trả lời Hỗ trợ" />
            </td>
		</tr>
	  </table>
</form>

	<div class="clear">
	</div>
</div>
<!-- End Content -->
<script src="js/mudim-0.8-r153.js"></script>