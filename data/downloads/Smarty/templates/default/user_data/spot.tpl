<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->

<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/products.js"></script>
<script type="text/javascript">//<![CDATA[
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
    // カゴに入れる
    function fnInCart(productForm) {
        var searchForm = $("#form1");
        var cartForm = $(productForm);
        // 検索条件を引き継ぐ
        var hiddenValues = ['mode','category_id','maker_id','name','orderby','disp_number','pageno','rnd'];
        $.each(hiddenValues, function(){
            // 商品別のフォームに検索条件の値があれば上書き
            if (cartForm.has('input[name='+this+']')) {
                cartForm.find('input[name='+this+']').val(searchForm.find('input[name='+this+']').val());
            }
            // なければ追加
            else {
                cartForm.append($("<input/>").attr("name", this).val(searchForm.find('input[name='+this+']').val()));
            }
        });
        // 商品別のフォームを送信
        cartForm.submit();
    }
//]]></script>

<div id="undercolumn">
    <h2 class="spot_title"><!--{$tpl_title|h}--></h2>
    <p class="btm20"><img src="<!--{$TPL_URLPATH}-->img/banner/bnr_susume.jpg" alt="派遣で働こう" /></p>
   
    <form name="form1" id="form1" method="get" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="<!--{$mode|h}-->" />
        <!--{* ▼注文関連 *}-->
        <input type="hidden" name="product_id" value="" />
        <input type="hidden" name="classcategory_id1" value="" />
        <input type="hidden" name="classcategory_id2" value="" />
        <input type="hidden" name="product_class_id" value="" />
        <input type="hidden" name="quantity" value="" />
        <!--{* ▲注文関連 *}-->
        <input type="hidden" name="rnd" value="<!--{$tpl_rnd|h}-->" />
    </form>

    <!--{foreach from=$arrProducts item=arrProduct name=arrProducts}-->
        <!--{assign var=id value=$arrProduct.product_id}-->
        <!--{assign var=arrErr value=$arrProduct.arrErr}-->
        <!--▼商品-->
        <form name="product_form<!--{$id|h}-->" action="?" onsubmit="return false;">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <div class="list_area clearfix">
            <a name="product<!--{$id|h}-->"></a>
            <div class="listphoto">
                <!--★画像★-->
                <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                    <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}--><!--{$arrProduct.main_list_image|sfNoImageMainList|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" /></a>
            </div>

            <div class="listrightbloc">
                <!--▼商品ステータス-->
                <!--{if count($productStatus[$id]) > 0}-->
                    <ul class="status_icon clearfix">
                        <!--{foreach from=$productStatus[$id] item=status}-->
                            <li>
                                <img src="<!--{$TPL_URLPATH}--><!--{$arrSTATUS_IMAGE[$status]}-->" width="80" height="17" alt="<!--{$arrSTATUS[$status]}-->"/>
                            </li>
                        <!--{/foreach}-->
                    </ul>
                <!--{/if}-->
                <!--▲商品ステータス-->

                <!--★商品名★-->
                <h3>
                    <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a>
                </h3>
                <!--★価格★-->
                <div class="pricebox sale_price">
                    <!--{$smarty.const.SALE_PRICE_TITLE}-->：
                    <span class="price">
                        <span id="price02_default_<!--{$id}-->"><!--{strip}-->
                            <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                                <!--{$arrProduct.price02_min_inctax}-->
                            <!--{else}-->
                                <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                            <!--{/if}-->
                        </span><span id="price02_dynamic_<!--{$id}-->"></span><!--{/strip}-->
                        円</span>
                </div>

                <!--★コメント★-->
                <div class="listcomment"><!--{$arrProduct.main_list_comment|h|nl2br}--></div>

                <!--★商品詳細を見る★-->
                <div class="detail_btn">
                    <!--{assign var=name value="detail`$id`"}-->
                    <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_job_detail_on.jpg','<!--{$name}-->');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_job_detail.jpg','<!--{$name}-->');">
                    <img src="<!--{$TPL_URLPATH}-->img/button/btn_job_detail.jpg" alt="求人詳細を見る" name="<!--{$name}-->" id="<!--{$name}-->" /></a>
                </div>

                <!--▼買い物かご-->
                <input type="hidden" name="product_id" value="<!--{$id|h}-->" />
                <input type="hidden" name="product_class_id" id="product_class_id<!--{$id|h}-->" value="<!--{$tpl_product_class_id[$id]}-->" />

                <div class="cart_area clearfix">
                    <!--{if $tpl_stock_find[$id]}-->
                        <!--{if $tpl_classcat_find1[$id]}-->
                            <div class="classlist">
                                <dl class="size01 clearfix">
                                        <!--▼規格1-->
                                        <dt><!--{$tpl_class_name1[$id]|h}-->：</dt>
                                        <dd>
                                            <select name="classcategory_id1" style="<!--{$arrErr.classcategory_id1|sfGetErrorColor}-->">
                                                <!--{html_options options=$arrClassCat1[$id] selected=$arrProduct.classcategory_id1}-->
                                            </select>
                                            <!--{if $arrErr.classcategory_id1 != ""}-->
                                                <p class="attention">※ <!--{$tpl_class_name1[$id]}-->を入力して下さい。</p>
                                            <!--{/if}-->
                                        </dd>
                                        <!--▲規格1-->
                                </dl>
                                <!--{if $tpl_classcat_find2[$id]}-->
                                    <dl class="size02 clearfix">
                                        <!--▼規格2-->
                                        <dt><!--{$tpl_class_name2[$id]|h}-->：</dt>
                                        <dd>
                                            <select name="classcategory_id2" style="<!--{$arrErr.classcategory_id2|sfGetErrorColor}-->">
                                            </select>
                                            <!--{if $arrErr.classcategory_id2 != ""}-->
                                                <p class="attention">※ <!--{$tpl_class_name2[$id]}-->を入力して下さい。</p>
                                            <!--{/if}-->
                                        </dd>
                                        <!--▲規格2-->
                                    </dl>
                                <!--{/if}-->
                            </div>
                        <!--{/if}-->
                        <div class="cartin clearfix">
                            <div class="quantity">
                               <input type="hidden" name="quantity" class="box" value="<!--{$arrProduct.quantity|default:1|h}-->" maxlength="<!--{$smarty.const.INT_LEN}-->" style="<!--{$arrErr.quantity|sfGetErrorColor}-->" />
                            </div>
                            <div class="cartin_btn">
                                <!--★カゴに入れる★-->
                                <div id="cartbtn_default_<!--{$id}-->">
                                    <input type="image" id="cart<!--{$id}-->" src="<!--{$TPL_URLPATH}-->img/button/btn_job_cartin.jpg" alt="カゴに入れる" onclick="fnInCart(this.form); return false;" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_job_cartin_on.jpg', this);" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_job_cartin.jpg', this);" />
                                </div>
                                <div class="attention" id="cartbtn_dynamic_<!--{$id}-->"></div>
                            </div>
                        </div>
                    <!--{else}-->
                        <div class="cartbtn attention">申し訳ございませんが、応募終了しています。</div>
                    <!--{/if}-->
                </div>
                <!--▲買い物かご-->
            </div>
        </div>
        </form>
        <!--▲商品-->
    <!--{/foreach}-->
    <p>注１)2012年10月1日 派遣法が改正されました。スポット派遣は、生業収入が500万円以上、世帯収入が500万円以上の場合に限ります。</p>
</div>