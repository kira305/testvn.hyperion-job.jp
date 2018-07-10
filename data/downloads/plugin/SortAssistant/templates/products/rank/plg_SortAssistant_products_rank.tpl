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

<script language="JavaScript">
$(function(){
    $("#search_page_max").bind("change", function(){
        var page_row = $(this).val();
        try{
            page_row = parseInt(page_row);
            $("#form1").submit();
        }catch(e){
        }
    });
});
</script>

<p>並び替え列をドラッグ＆ドラッグで並び替えを行ってください。</p>

<p class="page_rows">
    表示件数
    <select name="search_page_max" id="search_page_max">
<!--{*        <option value="">選択してください</option>*}-->
        <!--{html_options options=$pageRows selected=$search_page_max}-->
    </select> 件
</p>

    <input type="hidden" name="is_lastpage" id="is_lastpage" value="<!--{$is_lastpage}-->" >

    <a class="btn-normal" href="javascript:;" onclick="fnFormModeSubmit('form1','sort_excu','',''); return false;">
        <span>並び替え完了</span>
    </a>


<div id="contents-main">
    <div class="dummy"></div>

    <div class="sort_item header">
        <table class="">
        <tr>
            <td class="handler">並替</td>
            <td>商品画像 / 商品名 / 商品コード / ステータス</td>
            <td class="num">並び順</td>
        </tr>
        </table>
    </div>
    <div class="sortable">
        <!--{assign var=rankview value=$tpl_start_row}-->
        <!--{section name=cnt loop=$arrProductsList}-->
            <!--{assign var=rank value=$arrProductsList[cnt].rank}-->
            <!--{assign var=rankview value=$rankview+1}-->
            <!--{if $smarty.section.cnt.first}-->
                <script language="JavaScript">
                    var index_start_row = <!--{$rankview}-->;
                    var hiddn_start_row = <!--{$rank}-->;
                    var mode = "DESC";
                </script>
            <!--{/if}-->
            <div class="sort_item" id="item_<!--{$arrProductsList[cnt].product_id}-->">
                <table class="">
                <tr>
                    <td class="handler"><img src="<!--{$smarty.const.PLUGIN_HTML_URLPATH}-->SortAssistant/sortable.png"></td>

                    <td>
                        <img class="main_list_image" src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrProductsList[cnt].main_list_image|sfNoImageMainList|h}-->&amp;width=65&amp;height=65" alt="<!--{$arrProducts[cnt].name|h}-->">

                        <!--{$arrProductsList[cnt].name|h}-->]
                        <br/>
                        <!--{from_to from=$arrProductsList[cnt].product_code_min to=$arrProductsList[cnt].product_code_max separator="～"}-->
                        <br/>
                        <!--{if $arrProductsList[cnt].status == "2"}-->
                            [非公開]
                        <!--{else}-->
                            [公開中]
                        <!--{/if}-->
                        <br/>
                    </td>
                    <td class="num"><!--{$rankview}--></td>
                </tr>
                </table>
            </div>
            <input type="hidden" name="rank[<!--{$arrProductsList[cnt].product_id}-->]" id="item_<!--{$arrProductsList[cnt].product_id}-->_hidden" value="<!--{$rank}-->">
        <!--{/section}-->
    </div>

    <div class="dummy"></div>
</div>

<p class="description_nextitem">
    <span class="nextitem">■</span>：次のページの上位3アイテム
</p>

<style>
.header {
    background: url('<!--{$smarty.const.USER_URL}--><!--{$smarty.const.USER_PACKAGE_DIR}--><!--{$smarty.const.ADMIN_DIR}-->img/contents/table_back.png') repeat-x #b4b4b4;
}
</style>
