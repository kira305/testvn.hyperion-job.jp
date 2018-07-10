<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->


<div class="block_calendar">
    <div id="calender_area">
        <h3><img src="<!--{$TPL_URLPATH}-->img/title/tit_bloc_calender01.gif" alt="スポットカレンダー" /> &nbsp;スポットカレンダー</h3>
        <div class="block_body">
            <!--{section name=num loop=$arrCalendar}-->
            <!--{assign var=arrCal value=`$arrCalendar[num]`}-->
            <!--{section name=cnt loop=$arrCal}-->
            <!--{assign var=date value=`$arrCal[cnt].year`-`$arrCal[cnt].month`-`$arrCal[cnt].day`}-->
            <!--{if $smarty.section.cnt.first}-->
            <table>
                <caption class="month"><!--{$arrCal[cnt].year}-->年<!--{$arrCal[cnt].month}-->月</caption>
                <thead><tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr></thead>
                <!--{/if}-->
                <!--{if $arrCal[cnt].first}-->
                <tr>
                    <!--{/if}-->
                    <!--{if !$arrCal[cnt].in_month}-->
                    <td></td>
                    <!--{elseif $arrCal[cnt].holiday}-->
                    <td class="<!--{if $arrCal[cnt].today}--> today<!--{/if}-->"><span class="days" style="background-color: #F66;"><!--{$arrCal[cnt].day}--></span>
                        <p><!--{if !($arrCal[cnt].year < $year || $arrCal[cnt].year == $year && $arrCal[cnt].month < $month || $arrCal[cnt].year == $year && $arrCal[cnt].month == $month && $arrCal[cnt].day < $day) && $dates[$date] > 0}--><a href="/products/list.php?cal=<!--{$date}-->">(<!--{$dates[$date]}-->)</a><!--{else}-->&nbsp;<!--{/if}--></p>
                    </td>
                    <!--{else}-->
                    <td<!--{if $arrCal[cnt].today}--> class="today"<!--{/if}-->><span class="days" <!--{if $arrCal[cnt].last}--> style="background-color: #6CF;"<!--{/if}-->><!--{$arrCal[cnt].day}--></span>
                        <p><!--{if !($arrCal[cnt].year < $year || $arrCal[cnt].year == $year && $arrCal[cnt].month < $month || $arrCal[cnt].year == $year && $arrCal[cnt].month == $month && $arrCal[cnt].day < $day) && $dates[$date] > 0}--><a href="/products/list.php?cal=<!--{$date}-->">(<!--{$dates[$date]}-->)</a><!--{else}-->&nbsp;<!--{/if}--></p>
                    </td>
                    <!--{/if}-->
                    <!--{if $arrCal[cnt].last}-->
                </tr>
                <!--{/if}-->
                <!--{/section}-->
                <!--{if $smarty.section.cnt.last}-->
            </table>
            <!--{/if}-->
            <!--{/section}-->
            <p class="information">※赤字は休業日です</p><p class="information">※「〔〕」に当日の求人数を表示しております。
        </div>
    </div>
</div>