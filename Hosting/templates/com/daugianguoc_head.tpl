<?php
    $style_choise_begin = "<b><font color='red'>";
    $style_choise_end = "</font></b>";
?>
<center>
	<a href="#daugianguoc" rel="ajax" ><?php if(!$page) echo $style_choise_begin; ?>Quy tắc Đấu Giá Ngược<?php if(!$page) echo $style_choise_end; ?></a> | 
	<a href="#daugianguoc&page=daugianguoc_listitem_biding" rel="ajax" ><?php if($page == 'daugianguoc_listitem_biding') echo $style_choise_begin; ?>Item đang Đấu<?php if($page == 'daugianguoc_listitem_biding') echo $style_choise_end; ?></a> | 
	<a href="#daugianguoc&page=daugianguoc_listitem_end" rel="ajax" ><?php if($page == 'daugianguoc_listitem_end') echo $style_choise_begin; ?>Item Kết thúc Đấu Giá<?php if($page == 'daugianguoc_listitem_end') echo $style_choise_end; ?></a> | 
	<a href="#daugianguoc&page=daugianguoc_listitem_win" rel="ajax" ><?php if($page == 'daugianguoc_listitem_win') echo $style_choise_begin; ?>Nhận Giải<?php if($page == 'daugianguoc_listitem_win') echo $style_choise_end; ?></a>
	<br>
	<hr><br>
 </center>
