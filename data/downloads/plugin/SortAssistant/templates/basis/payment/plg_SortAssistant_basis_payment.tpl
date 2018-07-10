<!--{*
 * SortAssistant
 * 
 * Copyright (c) 2014 doishun
 * http://www.salon.ne.jp
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 *}-->

<!--{* EC標準 *}-->
<!--{if $mode == "" || $mode != "sortable"}-->
<table class="list">
    <col width="5%" />
    <col width="35%" />
    <col width="25%" />
    <col width="25%" />
    <col width="5%" />
    <col width="5%" />
    <col width="15%" />
    <tr>
        <th class="center">ID</th>
        <th>支払方法</th>
        <th>手数料（円）</th>
        <th>利用条件</th>
        <th>編集</th>
        <th>削除</th>
    </tr>
    <!--{section name=cnt loop=$arrPaymentListFree}-->
    <tr>
        <td class="center"><!--{$arrPaymentListFree[cnt].payment_id|h}--></td>
        <td class="center"><!--{$arrPaymentListFree[cnt].payment_method|h}--></td>
        <!--{if $arrPaymentListFree[cnt].charge_flg == 2}-->
            <td class="center">-</td>
        <!--{else}-->
            <td class="right"><!--{$arrPaymentListFree[cnt].charge|number_format|h}--></td>
        <!--{/if}-->
        <td class="center">
            <!--{if $arrPaymentListFree[cnt].rule_max > 0}--><!--{$arrPaymentListFree[cnt].rule_max|number_format|h}--><!--{else}-->0<!--{/if}-->円
            <!--{if $arrPaymentListFree[cnt].upper_rule > 0}-->～<!--{$arrPaymentListFree[cnt].upper_rule|number_format|h}-->円<!--{elseif $arrPaymentListFree[cnt].upper_rule == "0"}--><!--{else}-->～無制限<!--{/if}--></td>
        <td class="center"><!--{if $arrPaymentListFree[cnt].fix != 1}--><a href="?" onclick="fnChangeAction('./payment_input.php'); fnModeSubmit('pre_edit', 'payment_id', <!--{$arrPaymentListFree[cnt].payment_id}-->); return false;">編集</a><!--{else}-->-<!--{/if}--></td>
        <td class="center"><!--{if $arrPaymentListFree[cnt].fix != 1}--><a href="?" onclick="fnModeSubmit('delete', 'payment_id', <!--{$arrPaymentListFree[cnt].payment_id}-->); return false;">削除</a><!--{else}-->-<!--{/if}--></td>
    </tr>
    <!--{/section}-->
</table>



<!--{* 並び替え中 *}-->
<!--{else}-->
<p>並び替え列をドラッグ＆ドラッグで並び替えを行ってください。</p>
<div id="contents-main">
    <div class="dummy"></div>

    <div class="sort_item header">
        <table class="">
        <tr>
            <td class="handler">並び替え</td>
            <td>支払方法</td>
            <td class="num">並び順</td>
        </tr>
        </table>
    </div>
    <div class="sortable">
        <!--{assign var=rankview value=0}-->
        <!--{section name=cnt loop=$arrPaymentListFree}-->
            <!--{assign var="_id" value=$arrPaymentListFree[cnt].payment_id}-->
            <!--{assign var=rank  value=$arrPaymentListFree[cnt].rank}-->
            <!--{assign var=rankview value=$rankview+1}-->
            <!--{if $smarty.section.cnt.first}-->
                <script language="JavaScript">
                    var index_start_row = <!--{$rankview}-->;
                    var hiddn_start_row = <!--{$rank}-->;
                    var mode = "DESC";
                </script>
            <!--{/if}-->
            <div class="sort_item" id="item_<!--{$_id}-->">
                <table class="">
                <tr>
                    <td class="handler"><img src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->SortAssistant/sortable.png"></td>
                    <td><!--{$arrPaymentListFree[cnt].payment_method|h}--></td>
                    <td class="num"><!--{$rankview}--></td>
                </tr>
                </table>
            </div>
            <input type="hidden" name="rank[<!--{$_id}-->]" id="item_<!--{$_id}-->_hidden" value="<!--{$rank}-->">
        <!--{/section}-->
    </div>

    <div class="dummy"></div>
</div>
<!--{/if}-->

<style>
.header {
    background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
}
</style>
