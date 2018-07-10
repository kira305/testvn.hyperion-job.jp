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
    function fnSelectCheckSubmit(action) {

        var fm = document.form1;

        if (!fm["pdf_job_id[]"]) {
            return false;
        }

        var checkflag = false;
        var max = fm["pdf_job_id[]"].length;

        if (max) {
            for (var i = 0; i < max; i++) {
                if (fm["pdf_job_id[]"][i].checked == true) {
                    checkflag = true;
                }
            }
        } else {
            if (fm["pdf_job_id[]"].checked == true) {
                checkflag = true;
            }
        }

        if (!checkflag) {
            alert('チェックボックスが選択されていません');
            return false;
        }

        fnOpenPdfSettingPage(action);
    }

    function fnOpenPdfSettingPage(action) {
        var fm = document.form1;
        win02("about:blank", "pdf_input", "620", "650");

        // 退避
        tmpTarget = fm.target;
        tmpMode = fm.mode.value;
        tmpAction = fm.action;

        fm.target = "pdf_input";
        fm.mode.value = 'pdf';
        fm.action = action;
        fm.submit();

        // 復元
        fm.target = tmpTarget;
        fm.mode.value = tmpMode;
        fm.action = tmpAction;
    }

//-->
</script>
<div id="job" class="contents-main">
    <form name="search_form" id="search_form" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
        <h2>検索条件設定</h2>
        <!--{* 検索条件設定テーブルここから *}-->
        <table>
            <tr>
                <th>受注ＩＤ</th>
                <td>
                    <!--{assign var=key1 value="search_job_id"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
                <th>案件名</th>
                <td>
                    <!--{assign var=key1 value="search_job_name"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>派遣日</th>
                <td colspan="3">
                    <span class="attention"><!--{$arrErr.search_sjob_date_year}--></span>
                    <span class="attention"><!--{$arrErr.search_ejob_date_year}--></span>
                    <select name="search_sjob_date_year" style="<!--{$arrErr.search_sjob_date_year|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_sjob_date_year.value}-->
                    </select>年
                    <select name="search_sjob_date_month" style="<!--{$arrErr.search_sjob_date_month|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_sjob_date_month.value}-->
                    </select>月
                    <select name="search_sjob_date_day" style="<!--{$arrErr.search_sjob_date_day|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_sjob_date_day.value}-->
                    </select>日～
                    <select name="search_ejob_date_year" style="<!--{$arrErr.search_ejob_date_year|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_ejob_date_year.value}-->
                    </select>年
                    <select name="search_ejob_date_month" style="<!--{$arrErr.search_ejob_date_month|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_ejob_date_month.value}-->
                    </select>月
                    <select name="search_ejob_date_day" style="<!--{$arrErr.search_ejob_date_day|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_ejob_date_day.value}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>派遣期間</th>
                <td colspan="3">
                    <span class="attention"><!--{$arrErr.search_sjob_sche_date_year}--></span>
                    <span class="attention"><!--{$arrErr.search_ejob_sche_date_year}--></span>
                    <select name="search_sjob_sche_date_year" style="<!--{$arrErr.search_sjob_sche_date_year|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_sjob_sche_date_year.value}-->
                    </select>年
                    <select name="search_sjob_sche_date_month" style="<!--{$arrErr.search_sjob_sche_date_month|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_sjob_sche_date_month.value}-->
                    </select>月
                    <select name="search_sjob_sche_date_day" style="<!--{$arrErr.search_sjob_sche_date_day|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_sjob_sche_date_day.value}-->
                    </select>日～
                    <select name="search_ejob_sche_date_year" style="<!--{$arrErr.search_ejob_sche_date_year|sfGetErrorColor}-->">
                        <option value="">----</option>
                        <!--{html_options options=$arrYear selected=$arrForm.search_ejob_sche_date_year.value}-->
                    </select>年
                    <select name="search_ejob_sche_date_month" style="<!--{$arrErr.search_ejob_sche_date_month|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm.search_ejob_sche_date_month.value}-->
                    </select>月
                    <select name="search_ejob_sche_date_day" style="<!--{$arrErr.search_ejob_sche_date_day|sfGetErrorColor}-->">
                        <option value="">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm.search_ejob_sche_date_day.value}-->
                    </select>日
                </td>
            </tr>
        </table>

        <div class="btn">
            <p class="page_rows">検索結果表示件数
                <!--{assign var=key value="search_page_max"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <select name="<!--{$arrForm[$key].keyname}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
                    <!--{html_options options=$arrPageMax selected=$arrForm[$key].value}-->
                </select> 件
            </p>
            <div class="btn-area">
                <ul>
                    <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('search_form', 'search', '', ''); return false;"><span class="btn-next">この条件で検索する</span></a></li>
                </ul>
            </div>
        </div>
        <!--検索条件設定テーブルここまで-->
    </form>

    <!--{if count($arrErr) == 0 and ($smarty.post.mode == 'search' or $smarty.post.mode == 'delete')}-->

    <!--★★検索結果一覧★★-->
    <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
        <input type="hidden" name="sjob_id" value="" />
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
            <!--{if $smarty.const.ADMIN_MODE == '1'}-->
            <a class="btn-normal" href="javascript:;" onclick="fnModeSubmit('delete_all', '', ''); return false;"><span>検索結果をすべて削除</span></a>
            <!--{/if}-->
            <a class="btn-normal" href="javascript:;" onclick="fnSelectCheckSubmit('pdf.php'); return false;"><span>PDF一括出力</span></a>
        </div>
        <!--{if count($arrResults) > 0}-->
        <!--{include file=$tpl_pager}-->

        <table class="list">
            <col width="10%" />
            <col width="8%" />
            <col width="20%" />
            <col width="20%" />
            <col width="12%" />
            <col width="10%" />
            <col width="10%" />
            <col width="5%" />
            <col width="5%" />
            <tr>
                <th>予約日</th>
                <th>予約番号</th>
                <th>派遣社員名</th>
                <th>就業先</th>
                <th>支払金額</th>
                <th>対応状況</th>
                <th><label for="pdf_check">帳票</label> <input type="checkbox" name="pdf_check" id="pdf_check" onclick="fnAllCheck(this, 'input[name=pdf_job_id[]]')" /></th>
                <th>編集</th>
                <th>削除</th>
            </tr>

            <!--{section name=cnt loop=$arrResults}-->
            <!--{assign var=status value="`$arrResults[cnt].status`"}-->
            <!--{assign var=sjobId value="`$arrResults[cnt].sjob_id`"}-->
            <tr>
                <td class="center"><!--{$arrResults[cnt].yoyaku_date|h}--></td>
                <td class="center"><!--{$arrResults[cnt].sjob_id}--></td>
                <td><!--{$arrNamesByJobId.$sjobId}--></td>
                <td><!--{$arrResults[cnt].ph_pharmacy_name|h}--></td>
                <td class="center"><!--{$arrResults[cnt].total|number_format}--></td>
                <td class="center"><!--{$arrJOBSTATUS[$status]}--></td>
                <td class="center">
                    <input type="checkbox" name="pdf_job_id[]" value="<!--{$arrResults[cnt].sjob_id}-->" id="pdf_job_id_<!--{$arrResults[cnt].sjob_id}-->"/><label for="pdf_job_id_<!--{$arrResults[cnt].sjob_id}-->">一括出力</label><br>
                    <a href="./" onClick="win02('pdf.php?job_id=<!--{$arrResults[cnt].sjob_id}-->', 'pdf_input', '620', '650'); return false;"><span class="icon_class">個別出力</span></a>
                </td>
                <td class="center"><a href="?" onclick="fnChangeAction('./edit.php'); fnModeSubmit('pre_edit', 'sjob_id', '<!--{$arrResults[cnt].sjob_id}-->'); return false;"><span class="icon_edit">編集</span></a></td>
                <td class="center"><a href="?" onclick="fnModeSubmit('delete', 'sjob_id', <!--{$arrResults[cnt].sjob_id}-->); return false;"><span class="icon_delete">削除</span></a></td>
            </tr>
            <!--{/section}-->
        </table>
        <!--{* 検索結果表示テーブル *}-->

        <!--{/if}-->

    </form>
    <!--{/if}-->
</div>
