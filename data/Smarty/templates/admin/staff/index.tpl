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
    function fnDelete(staff_id) {
        if (confirm('この社員情報を削除しても宜しいですか？')) {
            document.form1.mode.value = "delete"
            document.form1['edit_staff_id'].value = staff_id;
            document.form1.submit();
            return false;
        }
    }
    function fnDeleteAll() {
        if (confirm('選択したマイナンバー情報を一括削除します。よろしいでしょうか？')) {
            document.form1.mode.value = "deleteAll"
            document.form1.submit();
            return false;
        }
    }
//-->
</script>


<div id="staff" class="contents-main">
    <form name="search_form" id="search_form" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
	<input type="hidden" name="search_is_haken" value="<!--{$arrForm.search_is_haken.value|h}-->" />

        <h2>検索条件設定</h2>

        <!--検索条件設定テーブルここから-->
        <table class="form">
            <tr>
                <th>お名前</th>
                <td>
                    <!--{assign var=key value="search_name"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
                <th>お名前(フリガナ)</th>
                <td>
                    <!--{assign var=key value="search_kana"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
	    <!--{if $arrForm.search_is_haken.value == 0}-->
            <tr>
                <th>部門/所属</th>
                <td colspan="3">
                    <!--{assign var=key value="search_affiliation"}-->
                    <!--{html_checkboxes name=$key options=$arrAffiliation separator="&nbsp;" selected=$arrForm[$key].value}-->
                </td>
            </tr>
	    <!--{else}-->
	    <tr>
                <th>所属</th>
                <td colspan="3">
                    <!--{assign var=key value="search_haken_type"}-->
                    <!--{html_checkboxes name=$key options=$arrHakenStaffType separator="&nbsp;" selected=$arrForm[$key].value}-->
                </td>
            </tr>
	    <!--{/if}-->
	    <tr>
                <th>対象者区分</th>
                <td>
                    <!--{assign var=key value="search_is_family_member"}-->
                    <!--{html_checkboxes name=$key options=$arrIsFamilyMember separator="&nbsp;" selected=$arrForm[$key].value}-->
                </td>
                <th>扶養主名前</th>
                <td>
                    <!--{assign var=key value="search_parent_name"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
	    <tr>
                <th>登録日</th>
                <td colspan="3">
                    <span class="attention"><!--{$arrErr.search_screateyear}--></span>
                    <span class="attention"><!--{$arrErr.search_ecreateyear}--></span>
                    <select name="search_screateyear" style="<!--{$arrErr.search_screateyear|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_screateyear.value}-->
                    </select>年
                    <select name="search_screatemonth" style="<!--{$arrErr.search_screateyear|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_screatemonth.value}-->
                    </select>月
                    <select name="search_screateday" style="<!--{$arrErr.search_screateyear|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_screateday.value}-->
                    </select>日～
                    <select name="search_ecreateyear" style="<!--{$arrErr.search_ecreateyear|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_ecreateyear.value}-->
                    </select>年
                    <select name="search_ecreatemonth" style="<!--{$arrErr.search_ecreateyear|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_ecreatemonth.value}-->
                    </select>月
                    <select name="search_ecreateday" style="<!--{$arrErr.search_ecreateyear|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_ecreateday.value}-->
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
    <!--{if count($arrErr) == 0 and ($smarty.post.mode == 'search' or $smarty.post.mode == 'save_note' or $smarty.post.mode == 'delete' or $smarty.post.mode == 'deleteAll')}-->

    <!--★★検索結果一覧★★-->
    <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
        <input type="hidden" name="edit_staff_id" value="" />
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
            <!--{if $smarty.session.authority != 6}-->
            <a class="btn-normal" href="javascript:;" onclick="fnModeSubmit('csv', '', ''); return false;">CSV ダウンロード</a>
            <a class="btn-normal" href="javascript:;" onclick="location.href = '../contents/csv.php?tpl_subno_csv=staff'">CSV 出力項目設定</a>
	    <a class="btn-normal" href="javascript:;" onclick="return fnDeleteAll();"><span>一括削除</span></a>
            <!--{/if}-->
        </div>
        <!--{if count($arrData) > 0}-->

        <!--{include file=$tpl_pager}-->

        <!--検索結果表示テーブル-->
        <table class="list" id="staff-search-result">
            <tr>
                <th style="width: 8%">登録日</th>
		<!--{if $arrForm.search_is_haken.value != 0}-->
                <th style="width: 6%">所属</th>
		<!--{/if}-->
                <th style="width: 6%">対象者区分</th>
                <th>お名前/(フリガナ)</th>
		<!--{if $arrForm.search_is_haken.value == 0}-->
                <th style="width: 10%">部門/所属</th>
		<!--{/if}-->
                <th style="width: 10%">個人番号<br />（マイナンバー）</th>
                <th style="width: 6%">続柄</th>
                <th style="width: 8%">生年月日</th>
                <th>扶養主</th>
		<th style="width: 10%">扶養主<br />マイナンバー</th>
                <th style="width: 4%">詳細</th>
                <!--{if $smarty.session.authority != 6}-->
                <th style="width: 7%"><label for="pdf_check">削除</label> <input type="checkbox" name="delete_check" id="delete_check" onclick="fnAllCheck(this, 'input[name=delete_staff_id[]]')" /></th>
		<th style="width: 10%">備考<br><a class="btn-normal" href="javascript:;" onclick="fnModeSubmit('save_note', '', ''); return false;"><span>save note</span></a></th>
                <!--{/if}-->
            </tr>
            <!--{foreach from=$arrData item=row}-->
            <tr>
                <td class="center"><!--{$row.create_date|date_format:"%Y-%m-%d"}--></td>
		<!--{if $arrForm.search_is_haken.value != 0}-->
                <td class="center"><!--{$arrHakenStaffType[$row.is_haken]|h}--></td>
		<!--{/if}-->
		<td class="center"><!--{if $row.parent_staff_id == 0}--><!--{$arrIsFamilyMember[$row.parent_staff_id]|h}--><!--{else}-->扶養家族<!--{/if}--></td>
                <td><!--{$row.name01|h}--> <!--{$row.name02|h}--><br>(<!--{$row.kana01|h}--> <!--{$row.kana02|h}-->)</td>
		<!--{if $arrForm.search_is_haken.value == 0}-->
                <td><!--{$arrAffiliation[$row.affiliation]|h}--></td>
		<!--{/if}-->
                <td class="center"><!--{$row.mynumber|h}--></td>
                <td class="center"><!--{$arrRelation[$row.relation_id]|h}--></td>
                <td class="center"><!--{$row.birth|h}--></td>
		<td class="center"><!--{$row.parent_name01|h}--> <!--{$row.parent_name02|h}--></td>
		<td class="center"><!--{$row.parent_mynumber|h}--></td>
                <td class="center"><span class="icon_view"><a href="javascript:;" onclick="fnModeSubmit('view', 'edit_staff_id', '<!--{$row.staff_id|h}-->'); return false;">詳細</a></span></td>
                <!--{if $smarty.session.authority != 6}-->
                <td class="center">
		    <input type="checkbox" name="delete_staff_id[]" value="<!--{$row.staff_id}-->" id="delete_staff_id_<!--{$row.staff_id}-->"/><label for="delete_staff_id_<!--{$row.staff_id}-->">一括削除</label><br>
		    <span class="icon_delete"><a href="#" onclick="return fnDelete('<!--{$row.staff_id|h}-->');">削除</a></span>
		</td>
		<td><textarea name="list_memo[<!--{$row.staff_id}-->]" rows="3" cols="20" ><!--{$row.note|h}--></textarea></td>
                <!--{/if}-->
            </tr>
            <!--{/foreach}-->
        </table>
        <!--検索結果表示テーブル-->

        <!--{/if}-->
    </form>
    <!--★★検索結果一覧★★-->

    <!--{/if}-->
</div>
