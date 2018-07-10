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

<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/facebox.js"></script>
<link rel="stylesheet" type="text/css" href="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/facebox.css" media="screen" />
<script type="text/javascript">//<![CDATA[
    $(document).ready(function() {
        $('a.expansion').facebox({
            loadingImage : '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/loading.gif',
            closeImage   : '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/closelabel.png'
        });
    });
//]]></script>

<div id="undercolumn">
    <div id="undercolumn_cart">
        <h2 class="title"><!--{$tpl_title|h}--></h2>

     <p class="information">申し込みをしない案件を削除してから<br>
申し込み手続きへお進みください。</p>

    <!--{if count($cartItems) > 0}-->
    <!--{foreach from=$cartKeys item=key}-->
    <div class="form_area">
        <form name="form<!--{$key}-->" id="form<!--{$key}-->" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="confirm" />
            <input type="hidden" name="cart_no" value="" />
            <input type="hidden" name="cartKey" value="<!--{$key}-->" />
            <input type="hidden" name="category_id" value="<!--{$tpl_category_id|h}-->" />

            <table summary="商品情報">
                <col width="5%" />
                <col width="10%" />
                <col width="20%" />
                <col width="10%" />
                <col width="15%" />
                <col width="15%" />
　　　　　　　　<col width="25%" />
                <tr>
                    <th class="alignC">削除</th>
                    <th class="alignC">写真</th>
                    <th class="alignC">求人名</th>
                    <th class="alignC">給与</th>
                    <th class="alignC">就業日</th>
                    <th class="alignC">時間帯</th>
　　　　　　　　　　<th class="alignC">場所</th>
                </tr>
                <!--{foreach from=$cartItems[$key] item=item}-->
                    <tr style="<!--{if $item.error}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->">
                        <td class="alignC"><a href="?" onclick="fnFormModeSubmit('form<!--{$key}-->', 'delete', 'cart_no', '<!--{$item.cart_no}-->'); return false;">削除</a>
                        </td>
                        <td class="alignC">
                        <a class="expansion" target="_blank"
                                <!--{if $item.productsClass.main_image|strlen >= 1}--> href="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$item.productsClass.main_image|sfNoImageMainList|h}-->"
                                <!--{/if}-->
                                >
                                <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->&amp;width=65&amp;height=65" alt="<!--{$item.productsClass.name|h}-->" />
                            </a>
                        </td>
                        <td><!--{* 商品名 *}--><strong><!--{$item.productsClass.name|h}--></strong><br />
                            <!--{if $item.productsClass.classcategory_name1 != ""}-->
                                <!--{$item.productsClass.class_name1}-->：<!--{$item.productsClass.classcategory_name1}--><br />
                            <!--{/if}-->
                            <!--{if $item.productsClass.classcategory_name2 != ""}-->
                                <!--{$item.productsClass.class_name2}-->：<!--{$item.productsClass.classcategory_name2}-->
                            <!--{/if}-->
                        </td>
                        <td class="alignR"><!--{$item.price}-->円</td>
                        <td class="alignC"><!--{$item.productsClass.sub_comment3}--></td>
                        <td class="alignR"><!--{$item.productsClass.sub_comment4}--></td>
                        <td class="alignR"><!--{$item.productsClass.sub_comment1}--></td>
                    </tr>
                <!--{/foreach}-->
                
            </table>
                <!--{if strlen($tpl_error) == 0}-->
                    <p class="alignC">上記内容でよろしければ「応募手続きへ」ボタンをクリックしてください。</p>
                <!--{/if}-->
            <div class="btn_area">
                <ul>
                    <li>
                        <!--{if $tpl_prev_url != ""}-->
                            <a href="<!--{$tpl_prev_url|h}-->" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg','back<!--{$key}-->');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg','back<!--{$key}-->');">
                                <img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" name="back<!--{$key}-->" /></a>
                        <!--{/if}-->
                    </li>
                    <li>
                        <!--{if strlen($tpl_error) == 0}-->
                            <input type="hidden" name="cartKey" value="<!--{$key}-->" />
                            <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_buystep_on_p.gif',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_buystep_p.gif',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_buystep_p.gif" alt="応募手続きへ" name="confirm" />
                        <!--{/if}-->
                    </li>
                </ul>
            </div>
        </form>
        </div>
    <!--{/foreach}-->
    <!--{else}-->
        <p class="empty"><span class="attention">※ 現在気になる求人情報はございません。</span></p>
    <!--{/if}-->
    </div>
</div>
