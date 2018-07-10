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

<!-- ▼おすすめ商品 -->
<!--{if count($arrBestProducts) > 0}-->
<section id="recommend_wrap">
    <div id="recommend_area" class="mainImageInit">
        <h2>おすすめ求人情報</h2>
        <div class="block_body clearfix">
            <!--{foreach from=$arrBestProducts item=arrProduct name="recommend_products"}-->    
            <div class="view view-first">
                <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrProduct.main_list_image|sfNoImageMainList|h}-->&amp;height=300" style="width: 100%" alt="<!--{$arrProduct.name|h}-->"/></a>
                <div class="mask" style="display: none">
                    <h3><!--{$arrProduct.name|h}--></h3>
                    <p>勤務地:<!--{$arrProduct.comment19}--></p>
                    <p><!--{$arrProduct.comment16}-->:<!--{strip}-->
                        <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                        <!--{$arrProduct.price02_min_inctax}-->
                        <!--{else}-->
                        <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                        <!--{/if}--><!--{/strip}-->円</p>
                    <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->" class="info">求人情報の詳細を見る</a>
                </div>
            </div>
            <!--{if $smarty.foreach.recommend_products.iteration % 4 === 0}-->
            <div class="clear"></div>
            <!--{/if}-->
            <!--{/foreach}-->
        </div>
        <ul style="display: none">
            <!--{section name=cnt loop=$arrBestProducts}-->
            <li id="mainImage<!--{$smarty.section.cnt.index}-->">
                <div class="recommendblock clearfix">
                    <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrBestProducts[cnt].main_list_image|sfNoImageMainList|h}-->&amp;width=80&amp;height=80" alt="<!--{$arrBestProducts[cnt].name|h}-->" />
                    <div class="productContents">
                        <h3><a rel="external" href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrBestProducts[cnt].product_id|u}-->"><!--{$arrBestProducts[cnt].name|h}--></a></h3>
                        <p class="mini comment"><!--{$arrBestProducts[cnt].comment|h|nl2br}--></p>
                        <p class="sale_price">
                            <span class="mini">時給:</span><span class="price"><!--{$arrBestProducts[cnt].price02_min_inctax|number_format}--> 円</span>
                        </p>
                    </div>
                </div>
            </li>
            <!--{/section}-->
        </ul>
    </div>
</section>
<!--{/if}-->
<!-- ▲おすすめ商品 -->
