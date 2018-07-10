<script type="text/javascript">//<![CDATA[
    $(function(){
        $('.icon-btn-send').click(function(){
            if ($("#key").length){
                if($("#key:checked").length){
                    return true;
                }
                else{
                    alert('利用規約に同意してください');
                }
                return false;
            }
            return true;
        });
    });
//]]></script>
<div id="undercolumn">
    <h2 class="entry">お仕事応募 <span><!--{if !$isLogged}-->入力フォーム <!--{/if}-->ご確認</span></h2>

    <ul class="entry_step">
        <li class="here_done">Step1:入力</li>
        <li class="here_done">Step2:確認</li>
        <li><span>Step3:応募完了</span></li>
    </ul>
    <form name="form_check" id="form_check" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach from=$arrForm key=key item=item}-->
            <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
        <!--{/foreach}-->
        <!--  エントリーフォーム  -->
        <div id="entry_form">
            <!--{if !$isLogged}--><p class="entry_form_navi">以下の内容でよろしいでしょうか？</p><!--{/if}-->
            <div class="list_wrap_list clearfix">
                <div class="list_wrap list_wrap_entry clearfix">
                    <!--{foreach from=$cartKeys item=key}-->
                    <!--{foreach from=$cartItems[$key] item=item}-->
                    <div class="list_area list_area_entry clearfix">
                        <a name="product<!--{$item.productsClass.product_id}-->"></a>
                        <h3>
                            <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$item.productsClass.product_id}-->"><!--{$item.productsClass.name|h}--></a>
                        </h3>
                        <div class="list_main">
                            <div class="listphoto">
                                <!--★画像★-->
                                <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$item.productsClass.product_id}-->">
                                    <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" width="170" /></a>
                            </div>
                            <div class="listrightbloc">
                                <!--★商品名★-->
                                <!--★コメント★-->
                                <div class="listcomment">
                                    <p class="company"><em><!--{$item.productsClass.sub_comment1|nl2br_html}--><br /></em></p>
                                    <p><!--{$item.productsClass.sub_comment8|nl2br_html}--></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--{/foreach}-->
                    <!--{/foreach}-->
                </div>
            </div>
            
            <!--▲商品-->
            <dl>
                <dt>氏名 (漢字)</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.name01|h}--> <!--{$arrForm.name02|h}--></p></dd>
                <dt>氏名 (カナ)</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.kana01|h}--> <!--{$arrForm.kana02|h}--></p></dd>
                <dt>性別</dt>
                <dd><p class="entry_confirm"><!--{if $arrForm.sex == 1}-->男性<!--{else}-->女性<!--{/if}--></p></dd>
                <dt>生年月日</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.year|h}-->年 <!--{$arrForm.month|h}-->月 <!--{$arrForm.day|h}-->日</p></dd>
                <dt>電話番号</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.tel01|h}-->-<!--{$arrForm.tel02|h}-->-<!--{$arrForm.tel03|h}--></p></dd>               
                <dt>メールアドレス</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.email|h}--></p></dd>
                <dt class="sml">メールマガジン送付について</dt>
                <dd><p class="entry_confirm"><!--{if $arrForm.mailmaga_flg eq 1}-->
                    HTMLメール＋テキストメールを受け取る
                    <!--{elseif $arrForm.mailmaga_flg eq 2}-->
                    テキストメールを受け取る
                    <!--{else}-->
                    受け取らない
                    <!--{/if}--></p></dd>
                <!--{if !$isLogged}-->
                <dt class="sml">ご案内、お知らせの受け取り</dt>
                <dd><p class="entry_confirm"><!--{if $arrForm.mail_kibou == 1}-->メールを希望する<!--{/if}--></p></dd>
                <dt class="sml">利用規約</dt>
                <dd><p class="entry_confirm"><!--{if $arrForm.accept == 1}-->同意する<!--{/if}--></p></dd>
                <!--{/if}-->
            </dl>
            <div class="clearfix"></div>
        </div>
        <!--  エントリーフォーム  -->
        <div class="clearfix"></div>
        
        <p class="entry_form_navi">
            <!--{if !$isLogged}-->
            上記内容に誤りがない事を確認して
            <!--{else}-->
            <p class="entry_form_navi"><input type="checkbox" name="accept" value="1" id="key" class="c_checkbox"  /><label for="key" class="c_checkbox"><span class="entry">上記利用規約に同意する</span></label></p>
            <!--{/if}-->
        </p>
        <div class="centeredContent">
            <button class="icon-btn icon-btn-send" type="submit">
                <span class="icon-btn-text">お仕事に応募する</span>
            </button>
        </div>
    </form>
</div>
