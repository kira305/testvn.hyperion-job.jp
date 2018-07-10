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
    var send = true;

    function fnCheckSubmit() {
        if(send) {
            send = false;
            return true;
        } else {
            alert("只今、処理中です。しばらくお待ち下さい。");
            return false;
        }
    }

    $(document).ready(function() {
        $('a.expansion').facebox({
            loadingImage : '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/loading.gif',
            closeImage   : '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/closelabel.png'
        });
    });
//]]></script>

<!--CONTENTS-->
<div id="undercolumn">
    <div id="undercolumn_shopping">
        <h2 class="title"><!--{$tpl_title|h}--></h2>

        <p class="information">下記の応募内容で送信してもよろしいでしょうか？<br />
            よろしければ、「<!--{if $use_module}-->次へ<!--{else}-->応募する<!--{/if}-->」ボタンをクリックしてください。</p>

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
        <input type="hidden" name="uniqid" value="<!--{$tpl_uniqid}-->" />

        <table summary="ご登録内容確認">
            <col width="10%" />
            <col width="20%" />
            <col width="10%" />            
            <col width="15%" />
　　　　　　<col width="20%" />
            <col width="25%" />
            <tr>
                <th scope="col">写真</th>
                <th scope="col">求人名</th>
                <th scope="col">給与</th>　　　　　　　　
                <th scope="col">就業日</th>
　　　　　　　　<th scope="col">時間帯</th>
　　　　　　　　<th scope="col">場所</th>
            </tr>
            <!--{foreach from=$arrCartItems item=item}-->
                <tr>
                    <td class="alignC">
                        <a
                            <!--{if $item.productsClass.main_image|strlen >= 1}--> href="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$item.productsClass.main_image|sfNoImageMainList|h}-->" class="expansion" target="_blank"
                            <!--{/if}-->
                        >
                            <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->&amp;width=65&amp;height=65" alt="<!--{$item.productsClass.name|h}-->" /></a>
                    </td>
                    <td>
                        <ul>
                            <li><strong><!--{$item.productsClass.name|h}--></strong></li>
                            <!--{if $item.productsClass.classcategory_name1 != ""}-->
                            <li><!--{$item.productsClass.class_name1}-->：<!--{$item.productsClass.classcategory_name1}--></li>
                            <!--{/if}-->
                            <!--{if $item.productsClass.classcategory_name2 != ""}-->
                            <li><!--{$item.productsClass.class_name2}-->：<!--{$item.productsClass.classcategory_name2}--></li>
                            <!--{/if}-->
                        </ul>
                    </td>
                    <td class="alignR"><!--{$item.price}-->円</td>
                    <td class="alignC"><!--{$item.productsClass.sub_comment3}--></td>
                    <td class="alignR"><!--{$item.productsClass.sub_comment4}--></td>
                    <td class="alignR"><!--{$item.productsClass.sub_comment1}--></td>
                </tr>
            <!--{/foreach}-->
                        
        </table>

        
        <!--お届け先ここから-->
        <!--{* 販売方法判定（ダウンロード販売のみの場合はお届け先を表示しない） *}-->
        <!--{if $cartKey != $smarty.const.PRODUCT_TYPE_DOWNLOAD}-->
        <!--{foreach item=shippingItem from=$arrShipping name=shippingItem}-->
        <h3>ご住所<!--{if $is_multiple}--><!--{$smarty.foreach.shippingItem.iteration}--><!--{/if}--></h3>
        <!--{if $is_multiple}-->
            <table summary="ご注文内容確認">
                <col width="10%" />
                <col width="60%" />
                <col width="20%" />
                <col width="10%" />
                <tr>
                    <th scope="col">商品写真</th>
                    <th scope="col">商品名</th>
                    <th scope="col">単価</th>
                    <th scope="col">数量</th>
                    <!--{* XXX 購入小計と誤差が出るためコメントアウト
                    <th scope="col">小計</th>
                    *}-->
                </tr>
                <!--{foreach item=item from=$shippingItem.shipment_item}-->
                    <tr>
                        <td class="alignC">
                            <a
                                <!--{if $item.productsClass.main_image|strlen >= 1}--> href="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$item.productsClass.main_image|sfNoImageMainList|h}-->" class="expansion" target="_blank"
                                <!--{/if}-->
                            >
                                <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->&amp;width=65&amp;height=65" alt="<!--{$item.productsClass.name|h}-->" /></a>
                        </td>
                        <td><!--{* 商品名 *}--><strong><!--{$item.productsClass.name|h}--></strong><br />
                            <!--{if $item.productsClass.classcategory_name1 != ""}-->
                                <!--{$item.productsClass.class_name1}-->：<!--{$item.productsClass.classcategory_name1}--><br />
                            <!--{/if}-->
                            <!--{if $item.productsClass.classcategory_name2 != ""}-->
                                <!--{$item.productsClass.class_name2}-->：<!--{$item.productsClass.classcategory_name2}-->
                            <!--{/if}-->
                        </td>
                        <td class="alignR">
                            <!--{$item.price|sfCalcIncTax|number_format}-->円
                        </td>
                        <td class="alignC"><!--{$item.quantity}--></td>
                        <!--{* XXX 購入小計と誤差が出るためコメントアウト
                        <td class="alignR"><!--{$item.total_inctax|number_format}-->円</td>
                        *}-->
                    </tr>
                <!--{/foreach}-->
            </table>
        <!--{/if}-->

        <table summary="ご住所確認" class="delivname">
            <col width="30%" />
            <col width="70%" />
            <tbody>
                <tr>
                    <th scope="row">お名前</th>
                    <td><!--{$shippingItem.shipping_name01|h}--> <!--{$shippingItem.shipping_name02|h}--></td>
                </tr>
                <tr>
                    <th scope="row">お名前(フリガナ)</th>
                    <td><!--{$shippingItem.shipping_kana01|h}--> <!--{$shippingItem.shipping_kana02|h}--></td>
                </tr>
                <tr>
                    <th scope="row">郵便番号</th>
                    <td>〒<!--{$shippingItem.shipping_zip01|h}-->-<!--{$shippingItem.shipping_zip02|h}--></td>
                </tr>
                <tr>
                    <th scope="row">住所</th>
                    <td><!--{$arrPref[$shippingItem.shipping_pref]}--><!--{$shippingItem.shipping_addr01|h}--><!--{$shippingItem.shipping_addr02|h}--></td>
                </tr>
                <tr>
                    <th scope="row">電話番号</th>
                    <td><!--{$shippingItem.shipping_tel01}-->-<!--{$shippingItem.shipping_tel02}-->-<!--{$shippingItem.shipping_tel03}--></td>
                </tr>　
              <tr>
                <th scope="row">その他お問い合わせ</th>
                <td><!--{$arrForm.message|h|nl2br}--></td>
            　　</tr>     　                
             </tbody>
        </table>
        <!--{/foreach}-->
        <!--{/if}-->
        <!--ご住所ここまで-->

　　　　<div class="btn_area">
            <ul>
                <li>
                    <a href="./payment.php" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg','back<!--{$key}-->');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg','back<!--{$key}-->');"><img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" name="back<!--{$key}-->" /></a>
                </li>
                <!--{if $use_module}-->
                <li>
                    <input type="image" onclick="return fnCheckSubmit();" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_next_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_next.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_next.jpg" alt="次へ" name="next" id="next" />
                </li>
                <!--{else}-->
                <li>
                    <input type="image" onclick="return fnCheckSubmit();" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_order_complete_on_p.gif',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_order_complete_p.gif',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_order_complete_p.gif" alt="ご登録完了ページへ"  name="next" id="next" />
                </li>
                <!--{/if}-->
        </ul>

        </div>
        </form>
    </div>
</div>
