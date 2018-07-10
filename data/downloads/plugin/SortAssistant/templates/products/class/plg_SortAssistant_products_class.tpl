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

<!--{* 並び替え前 *}-->
<!--{if $mode == "" || $mode != "sortable"}-->
    <table class="list">
        <col />
        <col width="15%" />
        <col width="10%" />
        <col width="10%" />
        <col width="15%" />
        <tr>
            <th>規格名 (登録数)</th>
            <th>分類登録</th>
            <th class="edit">編集</th>
            <th class="delete">削除</th>
        </tr>
        <!--{section name=cnt loop=$arrClass}-->
            <tr style="background:<!--{if $tpl_class_id != $arrClass[cnt].class_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;">
                <!--{assign var=class_id value=$arrClass[cnt].class_id}-->
                <td><!--{* 規格名 *}--><!--{$arrClass[cnt].name|h}--> (<!--{$arrClassCatCount[$class_id]|default:0}-->)</td>
                <td align="center"><a href="<!--{$smarty.const.ROOT_URLPATH}-->" onclick="fnClassCatPage(<!--{$arrClass[cnt].class_id}-->); return false;">分類登録</a></td>
                <td align="center">
                    <!--{if $tpl_class_id != $arrClass[cnt].class_id}-->
                        <a href="?" onclick="fnModeSubmit('pre_edit', 'class_id', <!--{$arrClass[cnt].class_id}-->); return false;">編集</a>
                    <!--{else}-->
                        編集中
                    <!--{/if}-->
                </td>
                <td align="center">
                    <!--{if $arrClassCatCount[$class_id] > 0}-->
                        -
                    <!--{else}-->
                        <a href="?" onclick="fnModeSubmit('delete', 'class_id', <!--{$arrClass[cnt].class_id}-->); return false;">削除</a>
                    <!--{/if}-->
                </td>
            </tr>
        <!--{/section}-->
    </table>

<!--{* 並び替え中 *}-->
<!--{else}-->

    <div id="contents-main">
        <div class="dummy"></div>

        <div class="sort_item header">
            <table class="">
            <tr>
                <td class="handler">並替</td>
                <td>規格名 (登録数)</td>
                <td class="num">並び順</td>
            </tr>
            </table>
        </div>
        <div class="sortable">
            <!--{assign var=rankview value=0}-->
            <!--{section name=cnt loop=$arrClass}-->
                <!--{assign var=class_id value=$arrClass[cnt].class_id}-->
                <!--{assign var=rank value=$arrClass[cnt].rank}-->
                <!--{assign var=rankview value=$rankview+1}-->
                <!--{if $smarty.section.cnt.first}-->
                    <script language="JavaScript">
                        var index_start_row = <!--{$rankview}-->;
                        var hiddn_start_row = <!--{$rank}-->;
                        var mode = "DESC";
                    </script>
                <!--{/if}-->
                <div class="sort_item" id="item_<!--{$class_id}-->">
                    <table class="">
                    <tr>
                        <td class="handler"><img src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->SortAssistant/sortable.png"></td>
                        <td><!--{$arrClass[cnt].name|h}--> (<!--{$arrClassCatCount[$class_id]|default:0}-->)</td>
                        <td class="num"><!--{$rankview}--></td>
                    </tr>
                    </table>
                </div>
                <input type="hidden" name="rank[<!--{$class_id}-->]" id="item_<!--{$class_id}-->_hidden" value="<!--{$rank}-->">
            <!--{/section}-->
        </div>

        <div class="dummy"></div>
    </div>

    <style>
    .header {
        background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
    }
    </style>
<!--{/if}-->
