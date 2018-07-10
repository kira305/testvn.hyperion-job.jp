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
<style>
    .narrowPaddingTable tr th, .narrowPaddingTable tr td{
        padding: 4px;
    }
</style>
<section id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <!--{if $tpl_subtitle != ''}--><h3 class="title_mypage"><!--{$tpl_subtitle|h}--></h3><!--{/if}-->

    <form name="form1" id="form1" method="post" action="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/work_possible_date_history.php">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="changeMonth" />
        <div class="form_area">
            <div class="cartinarea clearfix">
                <p style="float: left; margin-right: 10px; margin-bottom: 10px;">報告履歴</p>
                <select class="data-role-none" name="yearmonth" onchange="fnModeSubmit('changeMonth', '', ''); return false;" style="float: left">
                    <option value="">----</option>
                    <!--{html_options options=$arrYearMonth selected=$selectedYearMonth}-->
                </select>
                <!--{if count($arrForm) > 0}-->
                <table class="narrowPaddingTable">
                    <tr>
                        <th>日付</th>
                        <th>時間帯</th>
                        <th>ステータス</th>
                    </tr>
                    <!--{foreach from=$arrForm item=result}-->
                    <!--{assign var=dayOfWeek value=$result.working_date|date_format:'%u'}-->
                    <tr>
                        <td><!--{$result.working_date|date_format:"%m"}-->月<!--{$result.working_date|date_format:"%d"}-->日（<!--{$jpWeek[$dayOfWeek]}-->）</td>
                        <td><!--{$result.working_start|h}-->～<!--{$result.working_over|h}--></td>
                        <td><!--{if $result.status == 5 || $result.status == 6}--><!--{$arrStatus[$result.status]|h}--><!--{else}-->申請中<!--{/if}--></td>
                    </tr>
                    <!--{/foreach}-->
                </table>
                <!--{/if}-->
            </div>
        </div>
    </form>
</section>