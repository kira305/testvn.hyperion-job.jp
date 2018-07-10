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

<div class="btn addnew" id="btn_addnew">

<!--{* 並び替え前 *}-->
<!--{if $mode == "" || $mode != "sortable"}-->
    <a class="btn-normal" href="javascript:;" onclick="fnFormModeSubmit('form1','sortable','',''); return false;">
        <span>並び替え開始</span>
    </a>


<!--{* 並び替え中 *}-->
<!--{else}-->
    <script language="javascript">
    $(function(){
        // カテゴリ登録を無効
        $(".now_dir input").attr("disabled", true);
        $(".now_dir a").removeAttr("onclick")
        $(".now_dir a").click(function(){
            alert("並び替え中はカテゴリの登録をすることができません。");
        });
        $(".now_dir a").css("background", "#eee")
    });
    </script>

    <a class="btn-normal" href="javascript:;" onclick="fnFormModeSubmit('form1','sort_excu','',''); return false;">
        <span>並び替え完了</span>
    </a>

    <a class="btn-normal" id="sort_stop" href="javascript:;" onclick="">
        <span>並び替え中止</span>
    </a>

<!--{/if}-->
</div>


<!--{* 並び替え前 *}-->
<!--{if $mode == "" || $mode != "sortable"}-->
    <table class="list" id="categoryTable">
        <col width="5%" />
        <col width="65%" />
        <col width="15%" />
        <col width="15%" />
        <tr class="nodrop nodrag">
            <th>ID</th>
            <th>カテゴリ名</th>
            <th class="edit">編集</th>
            <th class="delete">削除</th>
        </tr>

        <!--{section name=cnt loop=$arrList}-->
        <tr id="<!--{$arrList[cnt].category_id}-->" style="background:<!--{if $arrForm.category_id != $arrList[cnt].category_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;" align="left">
            <td class="center"><!--{$arrList[cnt].category_id}--></td>
            <td>
            <!--{if $arrList[cnt].level != $smarty.const.LEVEL_MAX}-->
                <a href="?" onclick="fnModeSubmit('tree', 'parent_category_id', <!--{$arrList[cnt].category_id}-->); return false"><!--{$arrList[cnt].category_name|h}--></a>
            <!--{else}-->
                <!--{$arrList[cnt].category_name|h}-->
            <!--{/if}-->
            </td>
            <td class="center">
                <!--{if $arrForm.category_id != $arrList[cnt].category_id}-->
                <a href="?" onclick="fnModeSubmit('pre_edit', 'category_id', <!--{$arrList[cnt].category_id}-->); return false;">編集</a>
                <!--{else}-->
                編集中
                <!--{/if}-->
            </td>
            <td class="center">
                <a href="?" onclick="fnModeSubmit('delete', 'category_id', <!--{$arrList[cnt].category_id}-->); return false;">削除</a>
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
            <!--{section name=cnt loop=$arrList}-->
                <!--{assign var=_id value=$arrList[cnt].category_id}-->
                <!--{assign var=rank value=$arrList[cnt].rank}-->
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
                        <td><!--{$arrList[cnt].category_name|h}--></td>
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
    .header {
        background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
    }
    </style>
<!--{/if}-->
