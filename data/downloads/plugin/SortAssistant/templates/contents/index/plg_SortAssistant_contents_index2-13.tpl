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
    <col width="25%" />
    <col width="50%" />
    <col width="10%" />
    <col width="10%" />
    <tr>
        <th>順位</th>
        <th>日付</th>
        <th>タイトル</th>
        <th class="edit">編集</th>
        <th class="delete">削除</th>
    </tr>
    <!--{section name=data loop=$arrNews}-->
    <tr style="background:<!--{if $arrNews[data].news_id != $tpl_news_id}-->#ffffff<!--{else}--><!--{$smarty.const.SELECT_RGB}--><!--{/if}-->;" class="center">
        <!--{assign var=db_rank value="`$arrNews[data].rank`"}-->
        <td><!--{math equation="$line_max - $db_rank + 1"}--></td>
        <td><!--{$arrNews[data].cast_news_date|date_format:"%Y/%m/%d"}--></td>
        <td class="left">
            <!--{if $arrNews[data].link_method eq 1 && $arrNews[data].news_url != ""}--><a href="<!--{$arrNews[data].news_url|h}-->" ><!--{$arrNews[data].news_title|h|nl2br}--></a>
            <!--{elseif $arrNews[data].link_method eq 1 && $arrNews[data].news_url == ""}--><!--{$arrNews[data].news_title|h|nl2br}-->
            <!--{elseif $arrNews[data].link_method eq 2 && $arrNews[data].news_url != ""}--><a href="<!--{$arrNews[data].news_url|h}-->" target="_blank" ><!--{$arrNews[data].news_title|h|nl2br}--></a>
            <!--{else}--><!--{$arrNews[data].news_title|h|nl2br}-->
            <!--{/if}-->
        </td>
        <td>
            <!--{if $arrNews[data].news_id != $tpl_news_id}-->
            <a href="#" onclick="eccube.fnFormModeSubmit('move','pre_edit','news_id','<!--{$arrNews[data].news_id|h}-->'); return false;">編集</a>
            <!--{else}-->
            編集中
            <!--{/if}-->
        </td>
        <td><a href="#" onclick="eccube.fnFormModeSubmit('move','delete','news_id','<!--{$arrNews[data].news_id|h}-->'); return false;">削除</a></td>
    </tr>
    <!--{sectionelse}-->
    <tr class="center">
        <td colspan="6">現在データはありません。</td>
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
            <td>名称</td>
            <td class="num">並び順</td>
        </tr>
        </table>
    </div>
    <div class="sortable">
        <!--{assign var=rankview value=0}-->
        <!--{section name=data loop=$arrNews}-->
            <!--{assign var="_id" value=$arrNews[data].news_id}-->
            <!--{assign var=rank value=$arrNews[data].rank}-->
            <!--{assign var=rankview value=$rankview+1}-->
            <!--{if $smarty.section.data.first}-->
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
                    <td>
                        <!--{$arrNews[data].cast_news_date|date_format:"%Y/%m/%d"}-->
                        ：
                        <!--{if $arrNews[data].link_method eq 1 && $arrNews[data].news_url != ""}--><a href="<!--{$arrNews[data].news_url|h}-->" ><!--{$arrNews[data].news_title|h|nl2br}--></a>
                        <!--{elseif $arrNews[data].link_method eq 1 && $arrNews[data].news_url == ""}--><!--{$arrNews[data].news_title|h|nl2br}-->
                        <!--{elseif $arrNews[data].link_method eq 2 && $arrNews[data].news_url != ""}--><a href="<!--{$arrNews[data].news_url|h}-->" target="_blank" ><!--{$arrNews[data].news_title|h|nl2br}--></a>
                        <!--{else}--><!--{$arrNews[data].news_title|h|nl2br}-->
                        <!--{/if}-->
                    </td>
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
    form#form1 { display:none; }
</style>
<!--{/if}-->

<style>
.header {
    background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
}
</style>
