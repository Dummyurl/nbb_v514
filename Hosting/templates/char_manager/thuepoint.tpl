<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
  <TR>
    <TD vAlign=top width=491 align=center>
    	<blockquote><div align="center">
	    	- Point thuê chỉ duy trì trong vòng 24h hoặc đến khi Reset.<br>
	    	- Sau khi Reset Point thuê sẽ mất.<br>
	    	- Sau 24h nếu không Reset sẽ bị trừ 1 lần Reset và LV lên 400, tất cả các chỉ số Point về mức cơ bản.<br>
	    	- Sau khi thuê Point hãy vào <b><a href="#char_manager&act=rutpoint" onclick="$('index2.php?mod=char_manager&act=rutpoint','hienthi');">Rút Point</a></b> để lấy Point sử dụng.
	    </div></blockquote>
		<form id="thuepoint" name="thuepoint" method="post" action="index.php?mod=char_manager&act=thuepoint">
		  <input type="hidden" name="action" value="thuepoint" />
		  Chọn nhân vật cần Thuê Point: 
		  <select name="character">
		  	{foreach from=$showchar item=showchar}
		    <option value="{$showchar.Name}">{$showchar.Name} ( Tình trạng: {$showchar.Info} 
		    {if $showchar.Info == "Đã Thuê"}
		    - Thời gian: {$showchar.Time_free} 
		    {/if}
		    )</option>
		    {/foreach}
		  </select><br>
		  Số Point muốn thuê: 
		  <select name="point">
		  	<option value="{$thuepoint_point1}">{$thuepoint_point1|number_format:0:",":"."} Point = {$thuepoint_gcoin1|number_format:0:",":"."} Gcoin {if $thuepoint_relife1 > 0}(ReLife>{$thuepoint_relife1-1}){/if}</option>
		  	<option value="{$thuepoint_point2}">{$thuepoint_point2|number_format:0:",":"."} Point = {$thuepoint_gcoin2|number_format:0:",":"."} Gcoin {if $thuepoint_relife2 > 0}(ReLife>{$thuepoint_relife2-1}){/if}</option>
		  	<option value="{$thuepoint_point3}">{$thuepoint_point3|number_format:0:",":"."} Point = {$thuepoint_gcoin3|number_format:0:",":"."} Gcoin {if $thuepoint_relife3 > 0}(ReLife>{$thuepoint_relife3-1}){/if}</option>
		  	<option value="{$thuepoint_point4}">{$thuepoint_point4|number_format:0:",":"."} Point = {$thuepoint_gcoin4|number_format:0:",":"."} Gcoin {if $thuepoint_relife4 > 0}(ReLife>{$thuepoint_relife4-1}){/if}</option>
		  	<option value="{$thuepoint_point5}">{$thuepoint_point5|number_format:0:",":"."} Point = {$thuepoint_gcoin5|number_format:0:",":"."} Gcoin {if $thuepoint_relife5 > 0}(ReLife>{$thuepoint_relife5-1}){/if}</option>
		  	<option value="{$thuepoint_point6}">{$thuepoint_point6|number_format:0:",":"."} Point = {$thuepoint_gcoin6|number_format:0:",":"."} Gcoin {if $thuepoint_relife6 > 0}(ReLife>{$thuepoint_relife6-1}){/if}</option>
		  	<option value="{$thuepoint_point7}">{$thuepoint_point7|number_format:0:",":"."} Point = {$thuepoint_gcoin7|number_format:0:",":"."} Gcoin {if $thuepoint_relife7 > 0}(ReLife>{$thuepoint_relife7-1}){/if}</option>
		  	<option value="{$thuepoint_point8}">{$thuepoint_point8|number_format:0:",":"."} Point = {$thuepoint_gcoin8|number_format:0:",":"."} Gcoin {if $thuepoint_relife8 > 0}(ReLife>{$thuepoint_relife8-1}){/if}</option>
		  	<option value="{$thuepoint_point9}">{$thuepoint_point9|number_format:0:",":"."} Point = {$thuepoint_gcoin9|number_format:0:",":"."} Gcoin {if $thuepoint_relife9 > 0}(ReLife>{$thuepoint_relife9-1}){/if}</option>
		  	<option value="{$thuepoint_point10}">{$thuepoint_point10|number_format:0:",":"."} Point = {$thuepoint_gcoin10|number_format:0:",":"."} Gcoin {if $thuepoint_relife10 > 0}(ReLife>{$thuepoint_relife10-1}){/if}</option>
		  	
		  	<option value="{$thuepoint_point11}">{$thuepoint_point11|number_format:0:",":"."} Point = {$thuepoint_gcoin11|number_format:0:",":"."} Gcoin {if $thuepoint_relife11 > 0}(ReLife>{$thuepoint_relife11-1}){/if}</option>
		  	<option value="{$thuepoint_point12}">{$thuepoint_point12|number_format:0:",":"."} Point = {$thuepoint_gcoin12|number_format:0:",":"."} Gcoin {if $thuepoint_relife12 > 0}(ReLife>{$thuepoint_relife12-1}){/if}</option>
		  	<option value="{$thuepoint_point13}">{$thuepoint_point13|number_format:0:",":"."} Point = {$thuepoint_gcoin13|number_format:0:",":"."} Gcoin {if $thuepoint_relife13 > 0}(ReLife>{$thuepoint_relife13-1}){/if}</option>
		  	<option value="{$thuepoint_point14}">{$thuepoint_point14|number_format:0:",":"."} Point = {$thuepoint_gcoin14|number_format:0:",":"."} Gcoin {if $thuepoint_relife14 > 0}(ReLife>{$thuepoint_relife14-1}){/if}</option>
		  	<option value="{$thuepoint_point15}">{$thuepoint_point15|number_format:0:",":"."} Point = {$thuepoint_gcoin15|number_format:0:",":"."} Gcoin {if $thuepoint_relife15 > 0}(ReLife>{$thuepoint_relife15-1}){/if}</option>
		  	<option value="{$thuepoint_point16}">{$thuepoint_point16|number_format:0:",":"."} Point = {$thuepoint_gcoin16|number_format:0:",":"."} Gcoin {if $thuepoint_relife16 > 0}(ReLife>{$thuepoint_relife16-1}){/if}</option>
		  	<option value="{$thuepoint_point17}">{$thuepoint_point17|number_format:0:",":"."} Point = {$thuepoint_gcoin17|number_format:0:",":"."} Gcoin {if $thuepoint_relife17 > 0}(ReLife>{$thuepoint_relife17-1}){/if}</option>
		  	<option value="{$thuepoint_point18}">{$thuepoint_point18|number_format:0:",":"."} Point = {$thuepoint_gcoin18|number_format:0:",":"."} Gcoin {if $thuepoint_relife18 > 0}(ReLife>{$thuepoint_relife18-1}){/if}</option>
		  	<option value="{$thuepoint_point19}">{$thuepoint_point19|number_format:0:",":"."} Point = {$thuepoint_gcoin19|number_format:0:",":"."} Gcoin {if $thuepoint_relife19 > 0}(ReLife>{$thuepoint_relife19-1}){/if}</option>
		  	<option value="{$thuepoint_point20}">{$thuepoint_point20|number_format:0:",":"."} Point = {$thuepoint_gcoin20|number_format:0:",":"."} Gcoin {if $thuepoint_relife20 > 0}(ReLife>{$thuepoint_relife20-1}){/if}</option>
		  	
		  	<option value="{$thuepoint_point21}">{$thuepoint_point21|number_format:0:",":"."} Point = {$thuepoint_gcoin21|number_format:0:",":"."} Gcoin {if $thuepoint_relife21 > 0}(ReLife>{$thuepoint_relife21-1}){/if}</option>
		  	<option value="{$thuepoint_point22}">{$thuepoint_point22|number_format:0:",":"."} Point = {$thuepoint_gcoin22|number_format:0:",":"."} Gcoin {if $thuepoint_relife22 > 0}(ReLife>{$thuepoint_relife22-1}){/if}</option>
		  	<option value="{$thuepoint_point23}">{$thuepoint_point23|number_format:0:",":"."} Point = {$thuepoint_gcoin23|number_format:0:",":"."} Gcoin {if $thuepoint_relife23 > 0}(ReLife>{$thuepoint_relife23-1}){/if}</option>
		  	<option value="{$thuepoint_point24}">{$thuepoint_point24|number_format:0:",":"."} Point = {$thuepoint_gcoin24|number_format:0:",":"."} Gcoin {if $thuepoint_relife24 > 0}(ReLife>{$thuepoint_relife24-1}){/if}</option>
		  	<option value="{$thuepoint_point25}">{$thuepoint_point25|number_format:0:",":"."} Point = {$thuepoint_gcoin25|number_format:0:",":"."} Gcoin {if $thuepoint_relife25 > 0}(ReLife>{$thuepoint_relife25-1}){/if}</option>
		  	<option value="{$thuepoint_point26}">{$thuepoint_point26|number_format:0:",":"."} Point = {$thuepoint_gcoin26|number_format:0:",":"."} Gcoin {if $thuepoint_relife26 > 0}(ReLife>{$thuepoint_relife26-1}){/if}</option>
		  	<option value="{$thuepoint_point27}">{$thuepoint_point27|number_format:0:",":"."} Point = {$thuepoint_gcoin27|number_format:0:",":"."} Gcoin {if $thuepoint_relife27 > 0}(ReLife>{$thuepoint_relife27-1}){/if}</option>
		  	<option value="{$thuepoint_point28}">{$thuepoint_point28|number_format:0:",":"."} Point = {$thuepoint_gcoin28|number_format:0:",":"."} Gcoin {if $thuepoint_relife28 > 0}(ReLife>{$thuepoint_relife28-1}){/if}</option>
		  	<option value="{$thuepoint_point29}">{$thuepoint_point29|number_format:0:",":"."} Point = {$thuepoint_gcoin29|number_format:0:",":"."} Gcoin {if $thuepoint_relife29 > 0}(ReLife>{$thuepoint_relife29-1}){/if}</option>
		  	<option value="{$thuepoint_point30}">{$thuepoint_point30|number_format:0:",":"."} Point = {$thuepoint_gcoin30|number_format:0:",":"."} Gcoin {if $thuepoint_relife30 > 0}(ReLife>{$thuepoint_relife30-1}){/if}</option>
		  	
		  	<option value="{$thuepoint_point31}">{$thuepoint_point31|number_format:0:",":"."} Point = {$thuepoint_gcoin31|number_format:0:",":"."} Gcoin {if $thuepoint_relife31 > 0}(ReLife>{$thuepoint_relife31-1}){/if}</option>
		  	<option value="{$thuepoint_point32}">{$thuepoint_point32|number_format:0:",":"."} Point = {$thuepoint_gcoin32|number_format:0:",":"."} Gcoin {if $thuepoint_relife32 > 0}(ReLife>{$thuepoint_relife32-1}){/if}</option>
		  	<option value="{$thuepoint_point33}">{$thuepoint_point33|number_format:0:",":"."} Point = {$thuepoint_gcoin33|number_format:0:",":"."} Gcoin {if $thuepoint_relife33 > 0}(ReLife>{$thuepoint_relife33-1}){/if}</option>
		  	<option value="{$thuepoint_point34}">{$thuepoint_point34|number_format:0:",":"."} Point = {$thuepoint_gcoin34|number_format:0:",":"."} Gcoin {if $thuepoint_relife34 > 0}(ReLife>{$thuepoint_relife34-1}){/if}</option>
		  	<option value="{$thuepoint_point35}">{$thuepoint_point35|number_format:0:",":"."} Point = {$thuepoint_gcoin35|number_format:0:",":"."} Gcoin {if $thuepoint_relife35 > 0}(ReLife>{$thuepoint_relife35-1}){/if}</option>
		  	<option value="{$thuepoint_point36}">{$thuepoint_point36|number_format:0:",":"."} Point = {$thuepoint_gcoin36|number_format:0:",":"."} Gcoin {if $thuepoint_relife36 > 0}(ReLife>{$thuepoint_relife36-1}){/if}</option>
		  	<option value="{$thuepoint_point37}">{$thuepoint_point37|number_format:0:",":"."} Point = {$thuepoint_gcoin37|number_format:0:",":"."} Gcoin {if $thuepoint_relife37 > 0}(ReLife>{$thuepoint_relife37-1}){/if}</option>
		  	<option value="{$thuepoint_point38}">{$thuepoint_point38|number_format:0:",":"."} Point = {$thuepoint_gcoin38|number_format:0:",":"."} Gcoin {if $thuepoint_relife38 > 0}(ReLife>{$thuepoint_relife38-1}){/if}</option>
		  	<option value="{$thuepoint_point39}">{$thuepoint_point39|number_format:0:",":"."} Point = {$thuepoint_gcoin39|number_format:0:",":"."} Gcoin {if $thuepoint_relife39 > 0}(ReLife>{$thuepoint_relife39-1}){/if}</option>
		  	<option value="{$thuepoint_point40}">{$thuepoint_point40|number_format:0:",":"."} Point = {$thuepoint_gcoin40|number_format:0:",":"."} Gcoin {if $thuepoint_relife40 > 0}(ReLife>{$thuepoint_relife40-1}){/if}</option>
		  	
		  	<option value="{$thuepoint_point41}">{$thuepoint_point41|number_format:0:",":"."} Point = {$thuepoint_gcoin41|number_format:0:",":"."} Gcoin {if $thuepoint_relife41 > 0}(ReLife>{$thuepoint_relife41-1}){/if}</option>
		  	<option value="{$thuepoint_point42}">{$thuepoint_point42|number_format:0:",":"."} Point = {$thuepoint_gcoin42|number_format:0:",":"."} Gcoin {if $thuepoint_relife42 > 0}(ReLife>{$thuepoint_relife42-1}){/if}</option>
		  	<option value="{$thuepoint_point43}">{$thuepoint_point43|number_format:0:",":"."} Point = {$thuepoint_gcoin43|number_format:0:",":"."} Gcoin {if $thuepoint_relife43 > 0}(ReLife>{$thuepoint_relife43-1}){/if}</option>
		  	<option value="{$thuepoint_point44}">{$thuepoint_point44|number_format:0:",":"."} Point = {$thuepoint_gcoin44|number_format:0:",":"."} Gcoin {if $thuepoint_relife44 > 0}(ReLife>{$thuepoint_relife44-1}){/if}</option>
		  	<option value="{$thuepoint_point45}">{$thuepoint_point45|number_format:0:",":"."} Point = {$thuepoint_gcoin45|number_format:0:",":"."} Gcoin {if $thuepoint_relife45 > 0}(ReLife>{$thuepoint_relife45-1}){/if}</option>
		  	<option value="{$thuepoint_point46}">{$thuepoint_point46|number_format:0:",":"."} Point = {$thuepoint_gcoin46|number_format:0:",":"."} Gcoin {if $thuepoint_relife46 > 0}(ReLife>{$thuepoint_relife46-1}){/if}</option>
		  	<option value="{$thuepoint_point47}">{$thuepoint_point47|number_format:0:",":"."} Point = {$thuepoint_gcoin47|number_format:0:",":"."} Gcoin {if $thuepoint_relife47 > 0}(ReLife>{$thuepoint_relife47-1}){/if}</option>
		  	<option value="{$thuepoint_point48}">{$thuepoint_point48|number_format:0:",":"."} Point = {$thuepoint_gcoin48|number_format:0:",":"."} Gcoin {if $thuepoint_relife48 > 0}(ReLife>{$thuepoint_relife48-1}){/if}</option>
		  	<option value="{$thuepoint_point49}">{$thuepoint_point49|number_format:0:",":"."} Point = {$thuepoint_gcoin49|number_format:0:",":"."} Gcoin {if $thuepoint_relife49 > 0}(ReLife>{$thuepoint_relife49-1}){/if}</option>
		  	<option value="{$thuepoint_point50}">{$thuepoint_point50|number_format:0:",":"."} Point = {$thuepoint_gcoin50|number_format:0:",":"."} Gcoin {if $thuepoint_relife50 > 0}(ReLife>{$thuepoint_relife50-1}){/if}</option>
		  </select><br>
		  Chọn loại đơn vị tiền tệ sử dụng<br />
		  (Vpoint sẽ mất nhiều hơn Gcoin {$vpoint_extra}%)<br />
		      <input name="tiente" type="radio" value="gcoin" checked="checked" />
		      Gcoin
		      <input type="radio" name="tiente" value="vpoint" />
		      Vpoint
		    <br />
		  <input type="submit" name="Submit" value="Thuê Point" />
		</form>
	</TD>
  </TR>
</TABLE>