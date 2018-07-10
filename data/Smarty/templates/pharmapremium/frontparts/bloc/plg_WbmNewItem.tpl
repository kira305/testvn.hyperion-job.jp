<!--{*
 * WbmNewItem
 *
 * Copyright (C) 2012 WEBMO Inc. All Rights Reserved.
 * http://webmo.co.jp/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *}-->


<!-- ▼新着商品 -->
<!--{if count($plg_WbmNewItem_arrProducts) > 0}-->
<h2 class="title_block">新着求人</h2>
<ul data-role="listview" data-divider-theme="c"  data-theme="d" data-inset="false"">
  <!--{foreach from=$plg_WbmNewItem_arrProducts item=arrProduct name="products"}-->
  <li>
  <a href="<!--{$smarty.const.MOBILE_P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
  <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrProduct.main_list_image|sfNoImageMainList|h}-->&width=80&height=80" alt="<!--{$arrProduct.name|h}-->" class="picture" />

    <!--▼商品ステータス-->
    <!--{assign var=id value=$arrProduct.product_id}-->
    <!--{if $plg_WbmNewItem_arrPluginData.display_status == 1 && count($plg_WbmNewItem_arrProductStatus[$id]) > 0}-->
    <p class="ui-li-aside">
        <!--{foreach from=$plg_WbmNewItem_arrProductStatus[$id] item=status name="status"}-->
        	<font size="1"><u><!--{$arrSTATUS[$status]}--></u></font>
        	<!--{if !$smarty.foreach.status.iteration.last}-->&nbsp;<!--{/if}-->
        <!--{/foreach}-->
    </p>
    <!--{/if}-->
    <!--▲商品ステータス-->

    <!--▼メーカー-->
    <!--{if $plg_WbmNewItem_arrPluginData.display_maker == 1 && count($plg_WbmNewItem_arrProductMaker[$id]) > 0}-->
    <p><b><!--{$plg_WbmNewItem_arrProductMaker[$id]|h}--></b></p>
    <!--{/if}-->
    <!--▲メーカー-->

    <!--▼商品名-->
    <h3><!--{$arrProduct.name|h}--></h3>
    <!--▲商品名-->

    <!--▼通常価格-->
    <!--{if $plg_WbmNewItem_arrPluginData.display_proper == 1 && $arrProduct.price01_min_inctax > 0}-->
        <p>
            <!--{$smarty.const.NORMAL_PRICE_TITLE}-->（税込）：
        <!--{if $arrProduct.price01_min_inctax == $arrProduct.price01_max_inctax}-->
            <!--{$arrProduct.price01_min_inctax|number_format}-->
        <!--{else}-->
            <!--{$arrProduct.price01_min_inctax|number_format}-->～<!--{$arrProduct.price01_max_inctax|number_format}-->
        <!--{/if}-->
        	円</p>
    <!--{/if}-->
    <!--▲通常価格-->

    <!--▼販売価格-->
      <!--{assign var=price01 value=`$arrProduct.price01_min`}-->
      <!--{assign var=price02 value=`$arrProduct.price02_min`}-->
      <p><!--{$smarty.const.SALE_PRICE_TITLE}-->（税込）：<strong><font size="2" color="#CC0000"><!--{$price02|sfCalcIncTax:$arrInfo.tax:$arrInfo.tax_rule|number_format}-->円</font></strong></p>
    <!--▲販売価格-->

    <!--▼ポイント-->
    <!--{if $smarty.const.USE_POINT !== false && $plg_WbmNewItem_arrPluginData.display_point == 1 && $plg_WbmNewItem_arrProductPointRate[$id]}-->
    <!--{assign var=point_rate value=$plg_WbmNewItem_arrProductPointRate[$id]}-->
    <p>ポイント：
    	<!--{if $arrProduct.price02_min == $arrProduct.price02_max}-->
            <!--{$arrProduct.price02_min|sfPrePoint:$point_rate|number_format}-->
        <!--{else}-->
            <!--{if $arrProduct.price02_min|sfPrePoint:$point_rate == $arrProduct.price02_max|sfPrePoint:$point_rate}-->
                <!--{$arrProduct.price02_min|sfPrePoint:$point_rate|number_format}-->
            <!--{else}-->
                <!--{$arrProduct.price02_min|sfPrePoint:$point_rate|number_format}-->～<!--{$arrProduct.price02_max|sfPrePoint:$point_rate|number_format}-->
            <!--{/if}-->
        <!--{/if}-->
        Pt</p>
    <!--{/if}-->
    <!--▲ポイント-->

    <!--▼コメント-->
    <!--{if $plg_WbmNewItem_arrPluginData.display_comment == 1}-->
    <p><!--{$arrProduct.main_list_comment|h|nl2br}--></p>
    <!--{/if}-->
    <!--▲コメント-->

    <!--▼発送目安-->
    <!--{if $plg_WbmNewItem_arrPluginData.display_deliv == 1}-->
    <p>発送目安：<!--{$arrDELIVERY_DATE[$arrProduct.deliv_date_id]}--></p>
    <!--{/if}-->
    <!--▲発送目安-->
  </a>
  </li>
  <!--{/foreach}-->
</ul>
<!--{/if}-->
<!--▲新着商品 -->