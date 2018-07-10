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
        <col width="10%" />
        <col width="10%" />
        <col width="15%" />
        <tr>
            <th>分類名</th>
            <th class="edit">編集</th>
            <th class="delete">削除</th>
        </tr>
        <!--{section name=cnt loop=$arrClassCat}-->
            <tr style="background:<!--{if $tpl_classcategory_id != $arrClassCat[cnt].classcategory_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;">
                <td><!--{* 規格名 *}--><!--{$arrClassCat[cnt].name|h}--></td>
                <td align="center" >
                    <!--{if $tpl_classcategory_id != $arrClassCat[cnt].classcategory_id}-->
                        <a href="?" onclick="fnModeSubmit('pre_edit','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); return false;">編集</a>
                    <!--{else}-->
                        編集中
                    <!--{/if}-->
                </td>
                <td align="center">
                    <a href="?" onclick="fnModeSubmit('delete','classcategory_id', <!--{$arrClassCat[cnt].classcategory_id}-->); return false;">削除</a>
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
                <td>分類名</td>
                <td class="num">並び順</td>
            </tr>
            </table>
        </div>
        <div class="sortable">
            <!--{assign var=rankview value=0}-->
            <!--{section name=cnt loop=$arrClassCat}-->
                <!--{assign var=rank value=$arrClassCat[cnt].rank}-->
                <!--{assign var=rankview value=$rankview+1}-->
                <!--{if $smarty.section.cnt.first}-->
                    <script language="JavaScript">
                        var index_start_row = <!--{$rankview}-->;
                        var hiddn_start_row = <!--{$rank}-->;
                        var mode = "DESC";
                    </script>
                <!--{/if}-->
                <div class="sort_item" id="item_<!--{$arrClassCat[cnt].classcategory_id}-->">
                    <table class="">
                    <tr>
                        <td class="handler"><img src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->SortAssistant/sortable.png"></td>

                        <td>
                            <!--{$arrClassCat[cnt].name|h}-->
                        </td>
                        <td class="num"><!--{$rankview}--></td>
                    </tr>
                    </table>
                </div>
                <input type="hidden" name="rank[<!--{$arrClassCat[cnt].classcategory_id}-->]" id="item_<!--{$arrClassCat[cnt].classcategory_id}-->_hidden" value="<!--{$rank}-->">
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
