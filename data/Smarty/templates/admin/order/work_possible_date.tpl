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

    function fnEdit(id) {
        document.form1.action = './work_possible_date_edit.php';
        document.form1.mode.value = "edit_search"
        document.form1['edit_id'].value = id;
        document.form1.search_pageno.value = 1;
        document.form1.submit();
        return false;
    }
    
    function fnListEdit(id){
        document.form1.mode.value = "edit"
        document.form1['edit_id'].value = id;
        document.form1.submit();
    }
//-->
</script>


<div id="customer" class="contents-main">
    <form name="search_form" id="search_form" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />

        <h2>検索条件設定</h2>

        <!--検索条件設定テーブルここから-->
        <table class="form">
            <tr>
                <th>スタッフ名</th>
                <td>
                    <!--{assign var=key value="search_name"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
                <th>スタッフID</th>
                <td>
                    <!--{assign var=key value="search_staff_id"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
            <tr>
                <th>就業日</th>
                <td colspan="3">
                    <!--{assign var=errkey1 value="search_start_year"}-->
                    <!--{assign var=errkey2 value="search_end_year"}-->
                    <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><span class="attention"><!--{$arrErr[$errkey1]}--><!--{$arrErr[$errkey2]}--></span><br /><!--{/if}-->
                    <!--{assign var=key value="search_start_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_start_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_start_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日～
                    <!--{assign var=key value="search_end_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_end_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_end_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日
                </td>
            </tr>
        </table>
        <div class="btn">
            <p class="page_rows">検索結果表示件数
                <select name="search_page_max">
                    <!--{html_options options=$arrPageMax selected=$arrForm.search_page_max}-->
                </select> 件</p>
            <div class="btn-area">
                <ul>
                    <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('search_form', 'search', '', ''); return false;"><span class="btn-next">この条件で検索する</span></a></li>
                </ul>
            </div>
        </div>
    </form>
    <!--{if count($arrErr) == 0 and ($smarty.post.mode == 'search' or $smarty.post.mode == 'delete' or $smarty.post.mode == 'edit')}-->

    <!--★★検索結果一覧★★-->
    <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
        <input type="hidden" name="edit_id" value="" />
        <!--{foreach key=key item=item from=$arrHidden}-->
        <!--{if is_array($item)}-->
        <!--{foreach item=c_item from=$item}-->
        <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
        <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
        <!--{/if}-->
        <!--{/foreach}-->

        <h2>検索結果一覧</h2>
        <div class="btn">
            <span class="attention"><!--検索結果数--><!--{$tpl_linemax}-->件</span>&nbsp;が該当しました。
            <!--検索結果-->
            <a class="btn-normal" href="javascript:;" onclick="fnModeSubmit('csv', '', ''); return false;">CSV ダウンロード</a>
            <a class="btn-normal" href="javascript:;" onclick="location.href = '../contents/csv.php?tpl_subno_csv=possibledate'">CSV 出力項目設定</a>
        </div>
        <!--{if count($arrData) > 0}-->

        <!--{include file=$tpl_pager}-->

        <!--検索結果表示テーブル-->
        <table class="list" id="customer-search-result">
            <tr>
                <th>スタッフID</th>
                <th>スタッフ名</th>
                <th>就業可能日</th>
                <th>時間帯</th>
                <th>残業区分</th>
                <th>対応ステータス</th>
                <th>保存</th>
                <th>編集</th>
            </tr>
            <!--{foreach from=$arrData item=row}-->
            <tr>
                <td><!--{$customerRowById[$row.customer_id].staff_id}--></td>
                <td><!--{$customerRowById[$row.customer_id].name01}--><!--{$customerRowById[$row.customer_id].name02}--></td>
                <td><!--{$row.working_date|h}--></td>
                <td><!--{$row.working_start|h}--> ～ <!--{$row.working_over|h}--></td>
                <td><!--{if $row.overtime_allowed == 1}-->可<!--{else}-->不可<!--{/if}--></td>
                <td>
                    <select name="status[<!--{$row.id|h}-->]">
                        <!--{html_options options=$arrStatus selected=$row.status}-->
                    </select>
                </td>
                <td class="center"><span class="icon_edit"><a href="#" onclick="fnListEdit('<!--{$row.id|h}-->');">保存</a></span></td>
                <td class="center"><span class="icon_delete"><a href="#" onclick="return fnEdit('<!--{$row.id|h}-->');">編集</a></span></td>
            </tr>
            <!--{/foreach}-->
        </table>
        <!--検索結果表示テーブル-->

        <!--{/if}-->
    </form>
    <!--★★検索結果一覧★★-->

    <!--{/if}-->
</div>
