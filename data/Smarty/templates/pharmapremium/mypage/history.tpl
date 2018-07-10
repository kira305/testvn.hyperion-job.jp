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

<section id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->

    <h3 class="title_mypage"><!--{$tpl_subtitle|h}--></h3>

    <div class="form_area">
        <div id="historyBox">
            <p>
                <em>応募番号</em>：&nbsp;<!--{$tpl_arrOrderData.order_id}--><br />
                <em>応募日時</em>：&nbsp;<!--{$tpl_arrOrderData.create_date|sfDispDBDate}--><br />
                <em>時給</em>：&nbsp;<!--{$tpl_arrOrderData.payment_total|number_format}-->円
            </p>
        </div>

        <div class="formBox">
            <!--▼カートの中の商品一覧 -->
            <div class="cartinarea clearfix">

                <!--▼商品 -->
                <!--{foreach from=$tpl_arrOrderDetail item=orderDetail}-->
                <div class="">
                    <em>求人コード</em>：&nbsp;<!--{$orderDetail.product_code|h}--><br />
                    <em>求人名</em>：&nbsp;<a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$orderDetail.product_id|u}-->"><!--{$orderDetail.product_name|h}--></a><br />
                    <em>ご応募状況</em>：調整中
                </div>
                <!--{/foreach}-->
                <!--▲商品 -->

            </div><!--{* /.cartinarea *}-->
            <!--▲ カートの中の商品一覧 -->
        </div><!-- /.formBox -->

    </div><!-- /.form_area -->

</section>