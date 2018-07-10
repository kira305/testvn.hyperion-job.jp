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
    function fnDelete(corporate_id) {
        if (confirm('この会員情報を削除しても宜しいですか？')) {
            document.form1.mode.value = "delete"
            document.form1['edit_corporate_id'].value = corporate_id;
            document.form1.submit();
            return false;
        }
    }

    function fnEdit(corporate_id) {
        document.form1.action = './clientcorporate.php';
        document.form1.mode.value = "edit_search"
        document.form1['edit_corporate_id'].value = corporate_id;
        document.form1.submit();
        return false;
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
		    <th>企業ID</th>
		    <td>
			    <!--{assign var=key value="search_corporate_id"}-->
			    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
			    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
			</td>
			<th>郵便番号</th>
		    <td>
		        <!--{assign var=key value="search_zip"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
		    </td>
		</tr>
		<tr>
			<th>企業名</th>
			<td>
		        <!--{assign var=key value="search_corporate_name"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		    	<input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> /></td>
		    </td>
			<th>薬局名</th>
		    <td>
		        <!--{assign var=key value="search_pharmacy_name"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		    	<input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> /></td>
		    </td>
		</tr>
		<tr>
		    <th>薬局担当者名</th>
		    <td>
		    	<!--{assign var=key value="search_name"}-->
		    	<!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		    	<input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
		    </td>
		    <th>薬局担当者名（カナ）</th>
		    <td>
		        <!--{assign var=key value="search_kana"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
		    </td>
		</tr>
		<tr>
		    <th>登録日</th>
		    <td colspan="3">
		    	<!--{assign var=errkey1 value="search_b_start_year"}-->
		    	<!--{assign var=errkey2 value="search_b_end_year"}-->
		        <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><span class="attention"><!--{$arrErr[$errkey1]}--><!--{$arrErr[$errkey2]}--></span><br /><!--{/if}-->
		        <!--{assign var=key value="search_b_start_year"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">----</option>
		            <!--{html_options options=$arrBirthYear selected=$arrForm[$key].value}-->
		        </select>年
		        <!--{assign var=key value="search_b_start_month"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">--</option>
		            <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
		        </select>月
		        <!--{assign var=key value="search_b_start_day"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">--</option>
		            <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
		        </select>日～
		        <!--{assign var=key value="search_b_end_year"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">----</option>
		            <!--{html_options options=$arrBirthYear selected=$arrForm[$key].value}-->
		        </select>年
		        <!--{assign var=key value="search_b_end_month"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">--</option>
		            <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
		        </select>月
		        <!--{assign var=key value="search_b_end_day"}-->
		        <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
		            <option value="" selected="selected">--</option>
		            <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
		        </select>日
		    </td>
		</tr>
		<tr>
		    <th>住所</th>
		    <td colspan="3">
				<!--{assign var=key value="search_pref"}-->
				<select class="top" name="<!--{$key}-->">
                	<option class="top" value="">都道府県を選択</option>
                    <!--{html_options options=$arrPref selected=$arrForm[$key].value}-->
                </select>
		        <!--{assign var=key value="search_addr"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
		    </td>
		</tr>
		<tr>
		    <th>電話番号</th>
		    <td colspan="3">
		        <!--{assign var=key value="search_tel"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" /></td>
		</tr>
		<tr>
		    <th>FAX番号</th>
		    <td colspan="3">
		        <!--{assign var=key value="search_fax"}-->
		        <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
		        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" /></td>
		</tr>
		<tr>
		    <th>メールアドレス</th>
		    <td colspan="3">
		    <!--{assign var=key value="search_email"}-->
		    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><!--{/if}-->
		    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}-->/>
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
<!--{if count($arrErr) == 0 and ($smarty.post.mode == 'search' or $smarty.post.mode == 'delete')}-->

<!--★★検索結果一覧★★-->
<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="search" />
<input type="hidden" name="edit_corporate_id" value="" />
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
    </div>
    <!--{if count($arrData) > 0}-->

    <!--{include file=$tpl_pager}-->

    <!--検索結果表示テーブル-->
    <table class="list" id="customer-search-result">
        <col width="13%" />
        <col width="13%" />
        <col width="10%" />
        <col width="25%" />
        <col width="25%" />
        <col width="7%" />
        <col width="7%" />
        <tr>
            <th rowspan="2">企業名</th>
			<th rowspan="2">薬局名</th>
            <th>企業ID</th>
            <th rowspan="2">薬局担当者名/(フリガナ)</th>
            <th>TEL</th>
            <th rowspan="2">編集</th>
            <th rowspan="2">削除</th>
        </tr>
        <tr>
            <th>都道府県</th>
            <th>メールアドレス</th>
        </tr>
        <!--{foreach from=$arrData item=row}-->
            <tr>
                <td class="center" rowspan="2"><!--{$row.corporate_name|h}--></td>
				<td class="center" rowspan="2"><!--{$row.pharmacy_name|h}--></td>
                <td><!--{$row.corporate_id|h}--></td>
                <td rowspan="2"><!--{$row.charge_firstname|h}--> <!--{$row.charge_lastname|h}--><br>(<!--{$row.charge_firstname_kana|h}--> <!--{$row.charge_firstname_kana|h}-->)</td>
                <td><!--{$row.tel1|h}-->-<!--{$row.tel2|h}-->-<!--{$row.tel3|h}--></td>
                <td class="center" rowspan="2"><span class="icon_edit"><a href="#" onclick="return fnEdit('<!--{$row.corporate_id|h}-->');">編集</a></span></td>
                <td class="center" rowspan="2"><span class="icon_delete"><a href="#" onclick="return fnDelete('<!--{$row.corporate_id|h}-->');">削除</a></span></td>
            </tr>
            <tr>
                <td><!--{assign var=pref value=$row.pref}--><!--{$arrPref[$pref]}--></td>
                <td><!--{$row.email_add}--></td>
            </tr>
        <!--{/foreach}-->
    </table>
    <!--検索結果表示テーブル-->

    <!--{/if}-->
</form>
<!--★★検索結果一覧★★-->

<!--{/if}-->
</div>
