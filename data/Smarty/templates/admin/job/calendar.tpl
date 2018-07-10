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
    
    function func_submit(){
        var fm = window.opener.document.form1;
        fm.mode.value = 'working_calculate';
        fm.submit();
        window.close();
        return false;
    }
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
<input name="customer_id" type="hidden" value="<!--{$customer_id|h}-->" />
<input name="date" type="hidden" value="" />
<input type="hidden" name="year" value="<!--{$year}-->" />
<input type="hidden" name="month" value="<!--{$month}-->" />
    <h2>就業カレンダー</h2>
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
    
    <table class="form">
    <col width="16%" />
    <col width="32%" />
    <col width="32%" />
    <col width="20%" />
        <tr>
            <th style="text-align: center">日勤/夜勤</th>
            <th style="text-align: center">就業時間</th>
            <th style="text-align: center">休憩時間</th>
            <th style="text-align: center">派遣料金（時給）</th>
        </tr>
        <tr>
            <td>
                <!--{assign var=key value="time_flag"}-->
                <select name="<!--{$key}-->">
                    <!--{html_options options=$arrTIMEFLAG selected=$arrForm[$key].value}-->
                </select>
            </td>
            <td>
                <!--{assign var=key value="working_start"}-->
                <!--{assign var=key1 value="working_over"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <span class="attention"><!--{$arrErr[$key1]}--></span>
                <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" id="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" /> ～ 
                <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" id="<!--{$key1}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
            <td>
                <!--{assign var=key value="breaktime_s"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" id="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" /> ～ 
                <!--{assign var=key value="breaktime_o"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" id="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
            <td>
                <!--{assign var=key value="price"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" id="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center;"><input type="button" value="OK" onclick="fnModeSubmit('ok', '', ''); return false;" /></td>
        </tr>
    </table>
    
    <!--{if count($arrDate) > 0}-->
    <table class="form">
    <col width="10%" />
    <col width="15%" />
    <col width="18%" />
    <col width="18%" />
    <col width="18%" />
    <col width="13%" />
    <col width="8%" />
        <tr>
            <th style="text-align: center">就業日</th>
            <th style="text-align: center">日勤/夜勤</th>
            <th style="text-align: center">時間</th>
            <th style="text-align: center">休憩時間</th>
            <th style="text-align: center">就業時間 /<br />残業時間</th>
            <th style="text-align: center">派遣料金<br />（時給）</th>
            <th style="text-align: center">削除</th>
        </tr>
        <!--{foreach from=$arrDate key=date item=values}-->
        <tr>
            <td>
                <!--{assign var=key value=`$values.time_flag`}--><!--{$arrTIMEFLAG[$key]|h}-->
                <!--{assign var=key value="time_flag"}-->
                <input type="hidden" name="working[<!--{$date}-->][<!--{$key}-->]" value="<!--{$values[$key]|h}-->" />
            </td>
            <td>
                <!--{$date}-->
                <!--{assign var=key value="working_day"}-->
                <input type="hidden" name="working[<!--{$date}-->][<!--{$key}-->]" value="<!--{$values[$key]|h}-->" />
            </td>
            <td>
                <!--{assign var=key value="working_start"}--><!--{assign var=key1 value="working_over"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span><span class="attention"><!--{$arrErr[$key1]}--></span>
                <input type="text" name="working[<!--{$date}-->][<!--{$key}-->]" value="<!--{$values[$key]|h}-->" id="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" /> ～ 
                <input type="text" name="working[<!--{$date}-->][<!--{$key1}-->]" value="<!--{$values[$key1]|h}-->" id="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
            <td>
                <!--{assign var=key value="breaktime_s"}--><!--{assign var=key1 value="breaktime_o"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span><span class="attention"><!--{$arrErr[$key1]}--></span>
                <input type="text" name="working[<!--{$date}-->][<!--{$key}-->]" value="<!--{$values[$key]|h}-->" id="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" /> ～ 
                <input type="text" name="working[<!--{$date}-->][<!--{$key1}-->]" value="<!--{$values[$key1]|h}-->" id="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
            <td><!--{$values.working_hour|h}--> / <!--{$values.overtime|h}--></td>
            <td>
                <!--{assign var=key value="price"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <input type="text" name="working[<!--{$date}-->][<!--{$key}-->]" value="<!--{$values[$key]|h}-->" id="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" size="6" class="box6" />
            </td>
            <td><a href="javascript:;" onclick="fnModeSubmit('delete', 'date', '<!--{$date}-->');">削除</a></td>
        </tr>
        <!--{/foreach}-->
        <tr>
            <td colspan="7" style="text-align: right;">
                <input type="button" value="編集内容登録" onclick="fnModeSubmit('save', '', '');" />
            </td>
        </tr>
    </table>
    <!--{/if}-->
    <table class="form">
        <tr>
            <td style="text-align: center;">
                <input type="button" value="計算結果の確認" onclick="return func_submit();" />
            </td>
        </tr>
    </table>
            
</form>

<script type="text/javascript">
	var checks = document.getElementsByName('cal[]');
	<!--{foreach from=$dates item=date}-->
		for (i = 0; i < checks.length; i++){
			if (checks[i].value === '<!--{$date}-->'){
				checks[i].checked = 'checked';
				document.getElementById('<!--{$date}-->').style.backgroundColor = '#CFECEC';
			}
		}
	<!--{/foreach}-->
        
        
        var today = new Date();
        for (i = 0; i < checks.length; i++){
            var date = checks[i].value;
            var arrDate = date.split("-");
            var useDate = new Date(arrDate[0], arrDate[1]-1, arrDate[2]);
            if (useDate <= today){
                checks[i].disabled = 'disabled';
            }
        }
</script>

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
