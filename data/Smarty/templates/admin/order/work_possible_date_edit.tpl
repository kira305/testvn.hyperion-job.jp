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

<script type="text/javascript">
<!--
    function fnReturn() {
        document.search_form.action = './<!--{$smarty.const.DIR_INDEX_PATH}-->';
        document.search_form.submit();
        return false;
    }
//-->
</script>

<form name="search_form" method="post" action="">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="search" />

    <!--{foreach from=$arrSearchData key="key" item="item"}-->
    <!--{if $key ne "id" && $key ne "mode" && $key ne "edit_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
    <!--{if is_array($item)}-->
    <!--{foreach item=c_item from=$item}-->
    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
    <!--{/foreach}-->
    <!--{else}-->
    <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
    <!--{/if}-->
    <!--{/foreach}-->
</form>

<form name="form1" id="form1" method="post" action="?" autocomplete="off">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="confirm" />
    <input type="hidden" name="id" value="<!--{$arrForm.id|h}-->" />
    <!--{foreach key=key item=item from=$arrForm.arrHidden}-->
    <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
    <!--{/foreach}-->

    <!-- 検索条件の保持 -->
    <!--{foreach from=$arrSearchData key="key" item="item"}-->
    <!--{if $key ne "id" && $key ne "mode" && $key ne "edit_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
    <!--{if is_array($item)}-->
    <!--{foreach item=c_item from=$item}-->
    <input type="hidden" name="search_data[<!--{$key|h}-->][]" value="<!--{$c_item|h}-->" />
    <!--{/foreach}-->
    <!--{else}-->
    <input type="hidden" name="search_data[<!--{$key|h}-->]" value="<!--{$item|h}-->" />
    <!--{/if}-->
    <!--{/if}-->
    <!--{/foreach}-->

    <div id="customer" class="contents-main">
        <table class="form">
            <tr>
                <th>スタッフ名 <span class="attention"> *</span></th>
                <td>
                    <span class="attention"><!--{$arrErr.customer_id}--></span>
                    <select onchange="fnSetFormSubmit('form1', 'mode', 'customer'); return false;" name="customer_id" <!--{if $arrErr.customer_id != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                        <option class="top" value="">----</option>
                        <!--{html_options options=$arrCustomerNameById selected=$arrForm.customer_id}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>登録No</th>
                <td><!--{$arrCustomerInfoById[$arrForm.customer_id].customer_id}--></td>
            </tr>
            <tr>
                <th>スタッフID</th>
                <td><!--{$arrCustomerInfoById[$arrForm.customer_id].staff_id}--></td>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><!--{$arrCustomerInfoById[$arrForm.customer_id].kana01}--> <!--{$arrCustomerInfoById[$arrForm.customer_id].kana02}--></td>
            </tr>
            <tr>
                <th>ステータス <span class="attention"> *</span></th>
                <td>
                    <span class="attention"><!--{$arrErr.status}--></span>
                    <select name="status" <!--{if $arrErr.status != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                            <option class="top" value="" selected="selected">----</option>
                        <!--{html_options options=$arrStatus selected=$arrForm.status}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>就業可能日 <span class="attention"> *</span></th>
                <td>
                    <span class="attention"><!--{$arrErr.year}--></span>
                    <select name="year" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                            <option value="" selected="selected">------</option>
                        <!--{html_options options=$arrYear selected=$arrForm.year}-->
                    </select>年
                    <select name="month" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.month}-->
                    </select>月
                    <select name="day" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrDay selected=$arrForm.day"}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>時間帯 <span class="attention"> *</span></th>
                <td>
                    <!--{assign var=errWorkingStart value="`$arrErr.working_start_hour``$arrErr.working_start_minute`"}-->
                    <!--{assign var=errWorkingOver value="`$arrErr.working_over_hour``$arrErr.working_over_minute`"}-->
                    <!--{if $errWorkingStart || $errWorkingOver}-->
                    <div class="attention"><!--{$errWorkingStart}--><!--{$errWorkingOver}--></div>
                    <!--{/if}-->
                    <select name="working_start_hour" style="<!--{$errWorkingStart|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm.working_start_hour|default:''}-->
                    </select>:
                    <select name="working_start_minute" style="<!--{$errWorkingStart|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm.working_start_minute|default:''}-->
                    </select>~
                    <select name="working_over_hour" style="<!--{$errWorkingOver|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm.working_over_hour|default:''}-->
                    </select>:
                    <select name="working_over_minute" style="<!--{$errWorkingOver|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm.working_over_minute|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>残業可</th>
                <td><input type="checkbox" name="overtime_allowed" value="1" <!--{if $arrForm.overtime_allowed == 1}-->checked<!--{/if}--> /> 可</td>
            </tr>
        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="return fnReturn();"><span class="btn-prev">検索画面に戻る</span></a></li>
                <li><a class="btn-action" href="javascript:;" onclick="fnSetFormSubmit('form1', 'mode', 'confirm'); return false;"><span class="btn-next">確認ページへ</span></a></li>
            </ul>
        </div>
    </div>
</form>
