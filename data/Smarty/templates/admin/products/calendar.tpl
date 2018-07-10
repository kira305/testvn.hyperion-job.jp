<!--{*
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2012 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
*}-->

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->

<script type="text/javascript">
    self.moveTo(20,20);self.focus();
</script>
<style>
.off {
    color: #f00;
}
.today {
    background-color: #FFF99D;
    font-weight: bold;
}
</style>

<!--▼検索フォーム-->
<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input name="mode" type="hidden" value="save" />
<input name="product_id" type="hidden" value="<!--{$product_id|h}-->" />
<input type="hidden" name="year" value="<!--{$year}-->" />
<input type="hidden" name="month" value="<!--{$month}-->" />
<h2>求人カレンダー</h2>
	<div style="width: 100%; text-align: right; float: left;">
		<a href="javascript:;" onclick="fnModeSubmit('previous', '', ''); return false;"><<</a> &nbsp; <a href="javascript:;" onclick="fnModeSubmit('next', '', ''); return false;">>></a>
	</div>
	<!--{section name=num loop=$arrCalendar}-->
    	<!--{assign var=arrCal value=`$arrCalendar[num]`}-->
        <!--{section name=cnt loop=$arrCal}-->
        	<!--{if $smarty.section.cnt.first}-->
            	<table style="width: 48%; float:<!--{if $smarty.section.num.index == 0}-->left<!--{else}-->right<!--{/if}-->;">
                	<caption class="month"><!--{$arrCal[cnt].year}-->年<!--{$arrCal[cnt].month}-->月</caption>
                    <thead><tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr></thead>
            <!--{/if}-->
            <!--{if $arrCal[cnt].first}-->
            	<tr>
            <!--{/if}-->
            <!--{if !$arrCal[cnt].in_month}-->
            	<td></td>
            <!--{elseif $arrCal[cnt].holiday}-->
            	<td class="off<!--{if $arrCal[cnt].today}--> today<!--{/if}-->" id="<!--{$arrCal[cnt].year}-->-<!--{$arrCal[cnt].month}-->-<!--{$arrCal[cnt].day}-->"><!--{$arrCal[cnt].day}--><br><input type="checkbox" name="cal[]" value="<!--{$arrCal[cnt].year}-->-<!--{$arrCal[cnt].month}-->-<!--{$arrCal[cnt].day}-->" /></td>
            <!--{else}-->
            	<td<!--{if $arrCal[cnt].today}--> class="today"<!--{/if}--> id="<!--{$arrCal[cnt].year}-->-<!--{$arrCal[cnt].month}-->-<!--{$arrCal[cnt].day}-->"><!--{$arrCal[cnt].day}--><br><input type="checkbox" name="cal[]" value="<!--{$arrCal[cnt].year}-->-<!--{$arrCal[cnt].month}-->-<!--{$arrCal[cnt].day}-->" /></td>
            <!--{/if}-->
            <!--{if $arrCal[cnt].last}-->
            	</tr>
            <!--{/if}-->
        <!--{/section}-->
        <!--{if $smarty.section.cnt.last}-->
        	</table> &nbsp; 
        <!--{/if}-->
    <!--{/section}-->
	<br>
	<div style="width: 100%; text-align: center; float: left;"><input type="submit" value="登録" /></div>
</form>

<script type="text/javascript">
	var checks = document.getElementsByName('cal[]');
	<!--{foreach from=$dates item=date}-->
		for (i = 0; i < checks.length; i++){
			if (checks[i].value == '<!--{$date}-->'){
				checks[i].checked = 'checked';
				document.getElementById('<!--{$date}-->').style.backgroundColor = '#CFECEC';
			}
		}
	<!--{/foreach}-->
</script>

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
