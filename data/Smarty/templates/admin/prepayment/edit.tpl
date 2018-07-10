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
    $("document").ready(function(){
        $("#work_report_image").change(function() {
            fnModeSubmit('upload_image', 'image_key', 'work_report_image');
        });
    });
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

<form name="form1" id="form1" method="post" action="?" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="confirm" />
    <input type="hidden" name="id" value="<!--{$arrForm.id|h}-->" />
    <input type="hidden" name="image_key" value="" />
    <input type="hidden" name="down_key" value="">
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
                <th>就業先名 <span class="attention"> *</span></th>
                <td>
                    <span class="attention"><!--{$arrErr.company_name}--></span>
                    <input type="text" name="company_name" value="<!--{$arrForm.company_name|h}-->" size="60" class="box60" <!--{if $arrErr.company_name != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
            <tr>
                <th>就業日 <span class="attention"> *</span></th>
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
                <th>就業時間 <span class="attention"> *</span></th>
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
                <th>休憩時間 <span class="attention"> *</span></th>
                <td>
                    <!--{assign var=errBreaktime value="`$arrErr.breaktime_hour``$arrErr.breaktime_minute`"}-->
                    <!--{if $errBreaktime}--><div class="attention"><!--{$errBreaktime}--></div><!--{/if}-->
                    <select name="breaktime_hour" style="<!--{$errBreaktime|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrBREAKTIME selected=$arrForm.breaktime_hour|default:''}-->
                    </select>:
                    <select name="breaktime_minute" style="<!--{$errBreaktime|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm.breaktime_minute|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>作業日報 <span class="attention"> *</span></th>
                <td>
                    <!--{assign var=key value="work_report_image"}-->
                    <!--{if $arrErr[$key]}--><div class="attention"><!--{$arrErr[$key]}--></div><!--{/if}-->
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" style="max-width: 100%" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    <br /><span class="attention mini">作業日報または作業確認表をお持ちの方は写真を添付してください。</span>
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td>
                    <!--{assign var=key1 value="memo"}-->
                    <p><span class="attention"><!--{$arrErr[$key1]}--></span></p>
                    <textarea name="<!--{$key1}-->" cols="60" rows="8" class="area60" style="<!--{$arrErr[$key1]|h|sfGetErrorColor}-->; ime-mode: active;"　><!--{$arrForm[$key1]|h}--></textarea>
                </td>
            </tr>
            <tr>
                <th>メモ（ショップ専用）</th>
                <td>
                    <!--{assign var=key1 value="shop_memo"}-->
                    <p><span class="attention"><!--{$arrErr[$key1]}--></span></p>
                    <textarea name="<!--{$key1}-->" cols="60" rows="8" class="area60" style="<!--{$arrErr[$key1]|h|sfGetErrorColor}-->; ime-mode: active;"　><!--{$arrForm[$key1]|h}--></textarea>
                </td>
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
