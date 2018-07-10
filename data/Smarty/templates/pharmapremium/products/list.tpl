<!--{*
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
*}-->

<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/products.js"></script>
<script type="text/javascript">//<![CDATA[
    // 並び順を変更
    function fnChangeOrderby(orderby) {
        fnSetVal('orderby', orderby);
        fnSetVal('pageno', 1);
        fnSubmit();
    }
    // 表示件数を変更
    function fnChangeDispNumber(dispNumber) {
        fnSetVal('disp_number', dispNumber);
        fnSetVal('pageno', 1);
        fnSubmit();
    }
    // カゴに入れる
    function fnInCart(productForm) {
        var searchForm = $("#form1");
        var cartForm = $(productForm);
        // 検索条件を引き継ぐ
        var hiddenValues = ['mode', 'work_location_flg[]', 'employment_status[]', 'condition[]', 'category_id', 'name', 'orderby', 'disp_number', 'pageno', 'rnd'];
        $.each(hiddenValues, function() {
            // 商品別のフォームに検索条件の値があれば上書き
            if (this == 'work_location_flg[]' || this == 'employment_status[]' || this == 'condition[]') {
                $.each(searchForm.find('input[name=' + this + ']'), function() {
                    cartForm.append($("<input/>").attr("name", this.name).attr("type", "hidden").val(this.value));
                });
            }
            else
                cartForm.append($("<input/>").attr("name", this).attr("type", "hidden").val(searchForm.find('input[name=' + this + ']').val()));
        });
        // 商品別のフォームを送信
        cartForm.submit();
    }
//]]></script>

<section id="product_list">
    <form name="form1" id="form1" method="get" action="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="<!--{$mode|h}-->" />
        <!--{foreach from=$arrSearchData.work_location_flg item="status"}-->
        <input type="hidden" name="work_location_flg[]" value="<!--{$status}-->" />
        <!--{/foreach}-->
        <!--{foreach from=$arrSearchData.condition item="status"}-->
        <input type="hidden" name="condition[]" value="<!--{$status}-->" />
        <!--{/foreach}-->
        <!--{foreach from=$arrSearchData.employment_status item="status"}-->
        <input type="hidden" name="employment_status[]" value="<!--{$status}-->" />
        <!--{/foreach}-->
        <input type="hidden" name="category_id" value="<!--{$arrSearchData.category_id|h}-->" />
        <input type="hidden" name="name" value="<!--{$arrSearchData.name|h}-->" />
        <input type="hidden" name="date" value="<!--{$date|h}-->" />
        <input type="hidden" name="maker_id" value="<!--{$arrSearchData.maker_id|h}-->" />

        <input type="hidden" name="orderby" value="<!--{$orderby|h}-->" />
        <input type="hidden" name="disp_number" value="<!--{$disp_number|h}-->" />
        <input type="hidden" name="pageno" value="<!--{$tpl_pageno|h}-->" />

        <input type="hidden" name="product_id" value="" />
        <input type="hidden" name="classcategory_id1" value="" />
        <input type="hidden" name="classcategory_id2" value="" />
        <input type="hidden" name="product_class_id" value="" />
        <input type="hidden" name="quantity" value="" />
        <input type="hidden" name="rnd" value="<!--{$tpl_rnd|h}-->" />
    </form>

    <h2 class="title"><!--{$tpl_subtitle|h}--></h2>

    <!--▼ページナビ(本文)-->
    <!--{capture name=page_navi_body}-->
    <div class="search_list_navi_sort1">
        <p>並び替え : 
            <!--{if $orderby != "date"}--><a href="javascript:fnChangeOrderby('date');">新着順</a>
            <!--{else}--><strong>新着順</strong>
            <!--{/if}--></p>
    </div>
    <div class="search_list_navi">
        <ul class="search_list_navi"><!--{$tpl_strnavi}--></ul>
    </div>
    <div class="search_list_navi_sort2">
        <select name="disp_number" onchange="javascript:fnChangeDispNumber(this.value);">
            <!--{foreach from=$arrPRODUCTLISTMAX item="dispnum" key="num"}-->
            <!--{if $num == $disp_number}-->
            <option value="<!--{$num}-->" selected="selected" >表示件数 <!--{$dispnum}--></option>
            <!--{else}-->
            <option value="<!--{$num}-->" >表示件数 <!--{$dispnum}--></option>
            <!--{/if}-->
            <!--{/foreach}-->
        </select>
    </div>
    <div class="clearfix"></div>
    <!--{/capture}-->
    <!--▲ページナビ(本文)-->

    <div class="list_wrap_c clearfix">

        <!--{foreach from=$arrProducts item=arrProduct name=arrProducts}-->

        <!--{if $smarty.foreach.arrProducts.first}-->
        <!--▼ページナビ(上部)-->
        <form name="page_navi_top" id="page_navi_top" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <!--{if $tpl_linemax > 0}--><!--{$smarty.capture.page_navi_body|smarty:nodefaults}--><!--{/if}-->
        </form>
        <!--▲ページナビ(上部)-->

        <!--▼件数-->
        <div>
            <span class="number"><!--{$tpl_linemax}-->件</span>の条件に適合したお仕事がございます。
        </div>
        <!--▲件数-->
        <!--{/if}-->

        <!--{assign var=id value=$arrProduct.product_id}-->
        <!--{assign var=arrErr value=$arrProduct.arrErr}-->

        <!--▼商品-->
        <div class="list_wrap clearfix">
            <form name="product_form102" action="?" onsubmit="return false;">
                <input type="hidden" name="transactionid" value="6bd40b3b356206ff42bd045944e536807c010391" />
                <div class="list_area clearfix">
                    <a name="product102"></a>
                    <h3>
                        <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a>
                    </h3>
                    <div class="list_main">
                        <div class="listphoto">
                            <!--★画像★-->
                            <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                                <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$arrProduct.main_list_image|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" width="170" height="119" /></a>
                        </div>

                        <div class="listrightbloc">
                            <!--★商品名★-->
                            <!--★コメント★-->
                            <div class="listcomment">
                                <p class="company"><em><!--{$arrProduct.sub_comment1|nl2br_html}--><br/ ></em></p>
                                <p><!--{$arrProduct.sub_comment8|nl2br_html}--></p>
                            </div>
                        </div>

                        <div class="listdata1">
                            <dl>
                                <dt><span class="inlineblock"></span><span>地域</span></dt>
                                <dd><span class="inlineblock"></span><span><!--{$arrProduct.comment19}--></span></dd>
                                <dt><span class="inlineblock"></span><span>交通<br/>アクセス</span></dt>
                                <dd><span class="inlineblock"></span><span><!--{$arrProduct.sub_comment2|nl2br_html}--></span></dd>
                                <dt><span class="inlineblock"></span><span>給与</span></dt>
                                <dd><span class="inlineblock"></span><span><!--{$arrProduct.comment16}--><!--{strip}-->
                                        <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                                        <!--{$arrProduct.price02_min_inctax}-->
                                        <!--{else}-->
                                        <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                                        <!--{/if}--><!--{/strip}-->円</span></dd>
                                <dt><span class="inlineblock"></span><span>勤務時間等</span></dt>
                                <dd><span class="inlineblock"></span><span><!--{$arrProduct.sub_comment3|nl2br_html}--><br/ ><!--{$arrProduct.sub_comment4|nl2br_html}--></span></dd>
                            </dl>
                        </div>

                        <div class="listpoint">
                            <!--▼アピール各種-->
                            <ul>  
                                <!--▼商品ステータス-->
                                <!--{if count($productStatus[$id]) > 0}-->
                                <!--{foreach from=$productStatus[$id] item=status}-->
                                <li>
                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrSTATUS_IMAGE[$status]}-->s.gif" alt="<!--{$arrSTATUS[$status]}-->"/>
                                </li>
                                <!--{/foreach}-->
                                <!--{/if}-->
                                <!--▲商品ステータス-->

                                <!--▼雇用形態-->
                                <!--{if count($arrProduct.employment_status) > 0}-->
                                <!--{foreach from=$arrProduct.employment_status item=status}-->
                                <li>
                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrEMPSTATUS_IMAGE[$status]}-->s.gif" alt="<!--{$arrEMPSTATUS[$status]}-->"/>
                                </li>
                                <!--{/foreach}-->
                                <!--{/if}-->
                                <!--▲雇用形態-->

                                <!--▼アピールポイント-->
                                <!--{if count($arrProduct.appeal_point) > 0}-->
                                <!--{foreach from=$arrProduct.appeal_point item=status}-->
                                <li>
                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrAPPEALPOINT_IMAGE[$status]}-->s.gif" alt="<!--{$arrAPPEALPOINT[$status]}-->"/>
                                </li>
                                <!--{/foreach}-->
                                <!--{/if}-->
                                <!--▼アピールポイント-->
                            </ul>
                        </div>
                    </div>
                    <div class="list_bottom">
                        <ul class="list_button_tab">
                            <!--{if in_array($id, $smarty.session.keep_product_list)}-->
                            <li class="list_button_keep"><button class="list_button keep_off" type="button" onClick=""><span>キープ済のお仕事です</span></button></li>
                            <!--{else}-->
                            <li class="list_button_keep"><button class="list_button keep_on" type="button" onClick="javascript:fnModeSubmit('cart', 'product_id', '<!--{$id}-->');"><span>キープしておく</span></button></li>
                            <!--{/if}-->

                            <!--{if in_array($id, $arrOrderedProductId)}-->
                            <li class="list_button_entry"><button class="list_button ordered" type="button" value="応募画面へ"><span>応募済のお仕事です</span></button></li>
                            <!--{else}-->
                            <li class="list_button_entry"><button class="list_button" type="button" onClick="javascript:fnModeSubmit('cart_to_shopping', 'product_class_id', '<!--{$tpl_product_class_id[$id]}-->');" value="応募画面へ"><span>この仕事に応募する</span></button></li>
                            <!--{/if}-->

                            <li class="list_button_more"><button class="list_button" type="button" onclick="location.href = '<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->'"value="詳細へ"><span>詳細をもっと見る</span></button></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <!--▲商品-->

        <!--{if $smarty.foreach.arrProducts.last}-->
        <!--▼ページナビ(下部)-->
        <form name="page_navi_top" id="page_navi_top" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <!--{if $tpl_linemax > 0}--><!--{$smarty.capture.page_navi_body|smarty:nodefaults}--><!--{/if}-->
        </form>
        <!--▲ページナビ(下部)-->
        <!--{/if}-->

        <!--{foreachelse}-->
        <!--{include file="frontparts/search_zero.tpl"}-->
        <!--{/foreach}-->

    </div>
</section>

<script>//<![CDATA[
    $(document).ready(function() {
        var x = $(window).width() - 120;
        $('.list_button_more button.list_button').css('width', x);
    });
//]]></script>
