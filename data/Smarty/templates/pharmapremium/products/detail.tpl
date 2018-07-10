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

<script src="<!--{$smarty.const.ROOT_URLPATH}-->js/products.js"></script>
<script src="<!--{$TPL_URLPATH}-->js/jquery.facebox/facebox.js"></script>
<script>//<![CDATA[
    // 規格2に選択肢を割り当てる。
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
    $(document).ready(function() {
        $('a.expansion').facebox({
            loadingImage: '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/loading.gif',
            closeImage: '<!--{$smarty.const.ROOT_URLPATH}-->js/jquery.facebox/closelabel.png'
        });

        $('.keep_on').click(function() {
            $.ajax({
                type: "POST",
                url: window.location,
                data: $('#form1').serialize(),
                success: function() {
                    $('.keep_count').html('<!--{$smarty.session.keep_product_list|@count}-->');
                    $('.keep_link').animate({
                        opacity: 1
                    }, 2000).delay(2000).hide('slow');
                }
            });
        });
    });
//]]></script>
<style>
    .keep_change .keep_off.kept {
        opacity: 0.8;
        margin-top: 0;
    }
    .keep_link, .keep_link:hover{
        background-color: #f03e58;
        border-radius: 50%;
        color: white !important;
        display: inline-block;
        height: 40px;
        left: 50%;
        line-height: 20px;
        padding: 10px 0;
        position: relative;
        text-align: center;
        text-decoration: none !important;
        top: -130px;
        width: 60px;
        z-index: 10;
        opacity: 0;
    }
    .keep_link strong{
        font-size: 120%;
    }
</style>

<section id="product_detail">

    <form name="form1" id="form1" method="post" action="/products/detail.php?product_id=<!--{$arrProduct.product_id}-->">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="cart" />
        <input type="hidden" name="product_id" value="<!--{$arrProduct.product_id}-->" />
        <input type="hidden" name="product_class_id" value="<!--{$tpl_product_class_id}-->" id="product_class_id" />
        <input type="hidden" name="favorite_product_id" value="" />
        <input type="hidden" name="quantity" value="1" maxlength="9" />
        <div id="detailarea" class="clearfix">
            <!--★商品名★-->
            <h3><!--{$arrProduct.name|h}--> [お仕事No:<!--{$arrProduct.product_id}-->]</h3>

            <div id="detailphotobloc"><!--★一覧-メインコメント★-->
                <h4 class="comment">メッセージ</h4><h5 class="comment"><!--{$arrProduct.comment7}--></h5>
                <p><!--{$arrProduct.comment8|nl2br}--></p>

                <div class="photo">
                    <!--{assign var=key value="main_image"}-->
                    <!--★画像★-->
                    <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$arrProduct.main_list_image|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" />
                </div>
            </div>

            <div class="detail_company" id="detail_company">
                <h4>仕事詳細 <span class="oshigoto_num">[お仕事No:<!--{$arrProduct.product_id}-->]</span></h4>

                <!--★詳細メインコメント★-->
                <dl>
                    <dt>応募職種</dt>
                    <dd><!--{$arrProduct.comment9}--></dd>
                    <dt>仕事内容</dt>
                    <dd><!--★サブテキスト★--><!--{$arrProduct.sub_comment8|nl2br_html}--></dd>
                    <dt>給与</dt>
                    <dd><!--{$arrProduct.comment16}--> <!--{strip}-->
                        <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                        <!--{$arrProduct.price02_min_inctax}-->
                        <!--{else}-->
                        <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                        <!--{/if}--><!--{/strip}-->円</dd>
                    <!--{if $arrProduct.sub_comment20|strlen >= 1}-->
                    <dt>給与備考</dt>
                    <dd><!--{$arrProduct.sub_comment20|nl2br_html}--></dd>
                    <!--{/if}-->
                    <dt>勤務地</dt>
                    <dd><!--{$arrProduct.sub_comment2|nl2br_html}--><br /><br />
                        <!--{$arrProduct.comment17}--> <a href="https://www.google.co.jp/maps/place/<!--{$arrProduct.comment17}-->" target=_blank>地図</a></dd>
                    <dt>勤務時間</dt>
                    <dd><!--★サブテキスト★--><!--{$arrProduct.sub_comment4|nl2br_html}--></dd>
                    <dt>勤務期間</dt>
                    <dd><!--★サブテキスト★--><!--{$arrProduct.sub_comment3|nl2br_html}--></dd>
                </dl>
            </div>

            <div class="detail_mid">
                <p class="keep_change">
                    <button class="<!--{if $tpl_kept}-->keep_off kept<!--{else}-->keep_on<!--{/if}-->" type="button"><span>気になるリストにキープしておく</span></button>
                    <a class="keep_link" href="/user_data/keep_list.php">KEEP<br /><strong class='keep_count'>3</strong></a>
                </p>
                <p class="bottom_btn"><a href="#detail_photo_point"><span>更に詳細を見る</span></a></p>
                <!--{if in_array($arrProduct.product_id, $arrOrderedProductId)}-->
                <p class="entry_btn_a"><button class="list_button" type="button" value="応募画面へ"><span>応募済のお仕事です</span></button></p>
                <!--{else}-->
                <p class="entry_btn"><a href="#" onclick="javascript:fnModeSubmit('cart_to_shopping', 'quantity', 1);"><span>簡単１分で完了！ウェブ応募する</span></a></p>
                <!--{/if}-->
            </div>

            <div class="detail_telephone">
                <h4>お電話でもご対応致します！</h4>
                <p>担当オペレーターに『ハイペリオンアットジョブを見た』とお伝え下さい。</br><a href="tel:0484701002"><span>048-470-1002</span></a></br>(電話受付時間 8:00 - 20:00)</p>
            </div>

            <div class="detail_ouboshousai detail_company">
                <h4>応募詳細</h4>
                <dl>
                    <dt>雇用形態</dt>
                    <dd><!--★サブテキスト★-->
                        <ul class="float">
                            <!--{if count($arrProduct.employment_status) > 0}-->
                            <!--{foreach from=$arrProduct.employment_status item=status}-->
                            <li><!--{$arrEMPSTATUS[$status]}--></li>
                            <!--{/foreach}-->
                            <!--{/if}-->
                        </ul>
                    </dd>

                    <dt>歓迎</dt>
                    <dd><!--★サブテキスト★--><ul class="float">
                            <!--{assign var=ps value=$productStatus[$tpl_product_id]}-->
                            <!--{if count($ps) > 0}-->
                            <!--{foreach from=$ps item=status}-->
                            <!--{if ($status) < 20}-->
                            <li><!--{$arrSTATUS[$status]}--></li>
                            <!--{/if}-->
                            <!--{/foreach}-->
                            <!--{/if}-->
                        </ul>
                    </dd>

                    <dt>時間</dt>
                    <dd><!--★サブテキスト★-->
                        <ul class="float">
                            <!--{assign var=ps value=$productStatus[$tpl_product_id]}-->
                            <!--{if count($ps) > 0}-->
                            <!--{foreach from=$ps item=status}-->
                            <!--{if ($status) < 40 and ($status) >= 20}-->
                            <li><!--{$arrSTATUS[$status]}--></li>
                            <!--{/if}-->
                            <!--{/foreach}-->
                            <!--{/if}-->
                        </ul>
                    </dd>

                    <dt>待遇</dt>
                    <dd><!--★サブテキスト★-->
                        <ul class="float">
                            <!--{assign var=ps value=$productStatus[$tpl_product_id]}-->
                            <!--{if count($ps) > 0}-->
                            <!--{foreach from=$ps item=status}-->
                            <!--{if ($status) >= 40}-->
                            <li><!--{$arrSTATUS[$status]}--></li>
                            <!--{/if}-->
                            <!--{/foreach}-->
                            <!--{/if}-->
                        </ul>
                        <p><!--{$arrProduct.sub_comment5|nl2br_html}--></p>
                    </dd>

                    <dt>特徴</dt>
                    <dd><ul class="float">
                            <!--{if count($arrProduct.appeal_point) > 0}-->
                            <!--{foreach from=$arrProduct.appeal_point item=status}-->
                            <li><!--{$arrAPPEALPOINT[$status]}--></li>
                            <!--{/foreach}-->
                            <!--{/if}-->
                        </ul>
                    </dd>

                    <dt>業種</dt>
                    <dd><ul class="float">
                            <!--{section name=r loop=$arrRelativeCat}-->
                            <li>
                                <!--{section name=s loop=$arrRelativeCat[r]}-->
                                <!--{$arrRelativeCat[r][s].category_name}-->
                                <!--{if !$smarty.section.s.last}--><!--{$smarty.const.SEPA_CATNAVI}--><!--{/if}-->
                                <!--{/section}-->
                            </li>
                            <!--{/section}-->
                        </ul>
                    </dd>
                </dl>

            </div>
            <!--▲アピールポイント-->

            <!--詳細ここまで-->

            <div class="detail_mid">
                <p class="keep_change">
                    <button class="<!--{if $tpl_kept}-->keep_off kept<!--{else}-->keep_on<!--{/if}-->" type="button"><span>気になるリストにキープしておく</span></button>
                    <a class="keep_link" href="/user_data/keep_list.php">KEEP<br /><strong class='keep_count'>3</strong></a>
                </p>
                <p class="bottom_btn"><a href="#detail_photo_point"><span>更に詳細を見る</span></a></p>
                <!--{if in_array($arrProduct.product_id, $arrOrderedProductId)}-->
                <p class="entry_btn_a"><button class="list_button" type="button" value="応募画面へ"><span>応募済のお仕事です</span></button></p>
                <!--{else}-->
                <p class="entry_btn"><a href="#" onclick="javascript:fnModeSubmit('cart_to_shopping', 'quantity', 1);"><span>簡単１分で完了！ウェブ応募する</span></a></p>
                <!--{/if}-->
            </div>

            <!--▼サブコメント-->
            <div class="detail_company" id="detail_company">
                <h4>採用情報</h4>
                <dl>
                    <dt>応募方法</dt>
                    <dd><!--{$arrProduct.sub_comment9|nl2br_html}--></dd>
                    <dt>選考プロセス</dt>
                    <dd><!--{$arrProduct.sub_comment10|nl2br_html}--></dd>
                    <dt>担当者</dt>
                    <dd><!--{$arrProduct.sub_comment11|nl2br_html}--></dd>
                    <dt>掲載</dt>
                    <dd><a href="<!--{$arrProduct.comment1}-->" target=_blank><!--{$arrProduct.sub_comment1|nl2br_html}--></a><br/><br/>
                        <!--{$arrProduct.comment17}--> <a href="https://www.google.co.jp/maps/place/<!--{$arrProduct.comment17}-->" target=_blank>地図</a></dd>
                </dl>
            </div>

            <div class="detail_mid">
                <p class="keep_change">
                    <button class="<!--{if $tpl_kept}-->keep_off kept<!--{else}-->keep_on<!--{/if}-->" type="button"><span>気になるリストにキープしておく</span></button>
                    <a class="keep_link" href="/user_data/keep_list.php">KEEP<br /><strong class='keep_count'>3</strong></a>
                </p>
                <p class="bottom_btn"><a href="#detail_photo_point"><span>更に詳細を見る</span></a></p>
                <!--{if in_array($arrProduct.product_id, $arrOrderedProductId)}-->
                <p class="entry_btn_a"><button class="list_button" type="button" value="応募画面へ"><span>応募済のお仕事です</span></button></p>
                <!--{else}-->
                <p class="entry_btn"><a href="#" onclick="javascript:fnModeSubmit('cart_to_shopping', 'quantity', 1);"><span>簡単１分で完了！ウェブ応募する</span></a></p>
                <!--{/if}-->
            </div>

            <div class="centeredContent" style="display: none">
                <button onclick="javascript:fnModeSubmit('cart_to_shopping', 'quantity', 1);" class="icon-btn icon-btn-mail" type="button" alt="ウェブ応募する" value="ウェブ応募する" name="confirm">
                    <span class="icon-btn-text" style="border-bottom: none">ウェブ応募する</span>
                </button>
            </div>
        </div>
    </form>
</section>

<script>//<![CDATA[
    $(document).ready(function() {
        var bttnsWidth = 2 * 388 / 63 + 1;
        var detailMidWidth = $(window).width() - 34;
        var height = detailMidWidth * 98 / 100 / bttnsWidth;
        var width = 388 * height / 63;
        var doubleHeight = 35;
        $('.bottom_btn a').css('background-size', height + 'px ' + doubleHeight + 'px');
        $('.keep_on, .keep_off, .entry_btn a, .entry_btn_a button').css('background-size', width + 'px ' + doubleHeight + 'px');
        $('.keep_change, .keep_on, .keep_off, .entry_btn a, .entry_btn_a button').css('width', width);
        $('.bottom_btn a').css('width', height);
        $('.detail_mid').css('width', detailMidWidth);
        $('.detail_mid, .keep_change, .keep_on, .keep_off, .bottom_btn a, .entry_btn a, .entry_btn_a button').css('height', doubleHeight);
        $('.bottom_btn a, .entry_btn a, .entry_btn_a button').css('margin-left', '1%');
    });
//]]></script>