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
        <col width="50%" />
        <col width="25%" />
        <col width="15%" />
        <col width="15%" />
        <tr>
            <th>タイトル</th>
            <th>日付</th>
            <th class="edit">編集</th>
            <th class="delete">削除</th>
        </tr>
        <!--{section name=cnt loop=$arrHoliday}-->
        <tr style="background:<!--{if $tpl_holiday_id != $arrHoliday[cnt].holiday_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;">
            <!--{assign var=holiday_id value=$arrHoliday[cnt].holiday_id}-->
            <td><!--{$arrHoliday[cnt].title|h}--></td>
            <td><!--{$arrHoliday[cnt].month|h}-->月<!--{$arrHoliday[cnt].day|h}-->日</td>
            <td class="center">
                <!--{if $tpl_holiday_id != $arrHoliday[cnt].holiday_id}-->
                <a href="?" onclick="eccube.setModeAndSubmit('pre_edit', 'holiday_id', <!--{$arrHoliday[cnt].holiday_id}-->); return false;">編集</a>
                <!--{else}-->
                編集中
                <!--{/if}-->
            </td>
            <td class="center">
                <!--{if $arrClassCatCount[$class_id] > 0}-->
                -
                <!--{else}-->
                <a href="?" onclick="eccube.setModeAndSubmit('delete', 'holiday_id', <!--{$arrHoliday[cnt].holiday_id}-->); return false;">削除</a>
                <!--{/if}-->
            </td>
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
            <td>規約タイトル</td>
            <td class="num">並び順</td>
        </tr>
        </table>
    </div>
    <div class="sortable">
        <!--{assign var=rankview value=0}-->
        <!--{section name=cnt loop=$arrHoliday}-->
            <!--{assign var="_id" value=$arrHoliday[cnt].holiday_id}-->
            <!--{assign var=rank  value=$arrHoliday[cnt].rank}-->
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
                    <td><!--{$arrHoliday[cnt].title|h}--></td>
                    <td class="num"><!--{$rankview}--></td>
                </tr>
                </table>
            </div>
            <input type="hidden" name="rank[<!--{$_id}-->]" id="item_<!--{$_id}-->_hidden" value="<!--{$rank}-->">
        <!--{/section}-->
    </div>

    <div class="dummy"></div>
</div>

<style>
table.form   { display:none; }
div.btn-area { display:none; }
</style>
<!--{/if}-->

<style>
.header {
    background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
}
</style>
