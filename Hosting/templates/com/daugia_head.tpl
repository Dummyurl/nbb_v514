<?php
    $style_choise_begin = "<b><font color='red'>";
    $style_choise_end = "</font></b>";
?>
<center>
	<a href="#chotroi" rel="ajax" ><?php if(!$page) echo $style_choise_begin; ?>Hướng dẫn<?php if(!$page) echo $style_choise_end; ?></a> | 
	<a href="#chotroi&page=daugia_biding" rel="ajax" ><?php if($page == 'daugia_biding') echo $style_choise_begin; ?>Item đang bán<?php if($page == 'daugia_biding') echo $style_choise_end; ?></a> | 
	<a href="#chotroi&page=daugia_bid" rel="ajax" ><?php if($page == 'daugia_bid') echo $style_choise_begin; ?>Đưa Item lên Chợ Trời để bán</a><?php if($page == 'daugia_bid') echo $style_choise_end; ?>
	<br />
	<a href="#chotroi&page=daugia_end" rel="ajax" ><?php if($page == 'daugia_end') echo $style_choise_begin; ?>Item bạn đã tham gia đặt giá<?php if($page == 'daugia_end') echo $style_choise_end; ?></a> | 
	<a href="#chotroi&page=daugia_own" rel="ajax" ><?php if($page == 'daugia_own') echo $style_choise_begin; ?>Item trên Chợ Trời của bạn</a><?php if($page == 'daugia_own') echo $style_choise_end; ?>
	<br>
	<hr><br>
 </center>
