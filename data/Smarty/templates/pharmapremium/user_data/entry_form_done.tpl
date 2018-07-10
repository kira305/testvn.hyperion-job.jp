<style>
    .col{
        display: inline !important;
    }
    .col3{
        width: 20% !important;
    }
</style>
<script type="text/javascript">//<![CDATA[
    $(function(){
        $('.icon-btn-send').click(function(){
            if($("#key:checked").length){
                return true;
            }
            else{
                alert('利用規約に同意してください');
            }
            return false;
        });
    });
//]]></script>
<div id="undercolumn">
    <h2 class="entry">お仕事応募 <span>応募完了</span></h2>

    <ul class="entry_step">
        <li class="here_done">Step1:入力</li>
        <li class="here_done">Step2:確認</li>
        <li class="here_done">Step3:応募完了</li>
    </ul>

    <form name="form_check" id="form_check" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
        <div id="entry_form">
            <p class="entry_form_navi">以下のお仕事にご応募が完了しました。</p>

            <!--{if !$registeredFully}-->
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
                                    <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->" alt="<!--{$arrProduct.name|h}-->" class="picture" width="250" height="175" /></a>
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
            <!--{/if}-->

            <p class="entry_form_navi"><a href="/">戻るリンク</a></p>

            <!--{if !$registeredFully}-->
            <p class="entry_form_navi">(以下 非会員向け 追加表示) 次回からのご応募は会員登録すると便利です！</p>
            <p class="entry_form_navi">超キャッチーな超簡単な空気のめちゃくちゃ会員登録したくなるフレーズ！</p>

            <!--{if count($arrErr) > 0}--><p class="error_msg">入力項目に誤りがあります</p><!--{/if}-->

            <dl>
                <dt><span>必須</span> 希望するパスワード</dt>
                <dd>
                    <input type="password" name="password" class="entry_free" value="<!--{$arrForm.password|h}-->" maxlength="<!--{$smarty.const.PASSWORD_MAX_LEN}-->" placeholder="[例] 半角英数4-12文字" />
                    <!--{if $arrErr.password}--><p class="error"><!--{$arrErr.password}--></p><!--{/if}-->
                </dd>
                <dt class="sml">※確認の為2度入力してください</dt>
                <dd>
                    <input type="password" name="password02" class="entry_free" value="<!--{$arrForm.password02|h}-->" maxlength="<!--{$smarty.const.PASSWORD_MAX_LEN}-->" placeholder="[例] 半角英数4-12文字" />
                    <!--{if $arrErr.password02}--><p class="error"><!--{$arrErr.password02}--></p><!--{/if}-->
                </dd>
                <dt><span>必須</span> 郵便番号</dt>
                <dd>
                    〒&nbsp;<input type="text" class="entry_free col col3" name="zip01" value="<!--{$arrForm.zip01|h}-->" maxlength="<!--{$smarty.const.ZIP01_LEN}-->" placeholder="[例] 333" />&nbsp;-&nbsp;
                    <input type="text" name="zip02" class="entry_free col col3" value="<!--{$arrForm.zip02|h}-->" maxlength="<!--{$smarty.const.ZIP02_LEN}-->" placeholder="[例] 5555" />
                    <!--{if $arrErr.zip || $arrErr.zip01 || $arrErr.zip02}-->
                    <p class="error"><!--{$arrErr.zip}--><!--{$arrErr.zip01}--><!--{$arrErr.zip02}--></p>
                    <!--{/if}-->
                </dd>
                <dt><span>必須</span> 都道府県</dt>
                <dd>
                    <select name="pref" id="jsi-date-birth-year">
                        <option value="" selected="selected">選択してください</option>
                        <!--{html_options options=$arrPref selected=$arrForm.pref}-->
                    </select>
                    <!--{if $arrErr.pref}--><p class="error"><!--{$arrErr.pref}--></p><!--{/if}-->
                </dd>
                <dt><span>必須</span> 市区町村</dt>
                <dd>
                    <input type="text" name="addr01" class="entry_free" value="<!--{$arrForm.addr01|h}-->" placeholder="[例] △△区 △△町" />
                    <!--{if $arrErr.addr01}--><p class="error"><!--{$arrErr.addr01}--></p><!--{/if}-->
                </dd>
                <dt><span>必須</span> 番地・建物名</dt>
                <dd>
                    <input type="text" name="addr02" class="entry_free" value="<!--{$arrForm.addr02|h}-->" placeholder="[例] ○☓ 3-5-2 ハイペリオンビル 6F" />
                    <!--{if $arrErr.addr02}--><p class="error"><!--{$arrErr.addr02}--></p><!--{/if}-->
                </dd>
                <dt>氏名 (漢字)</dt>
                <dd><p class="entry_confirm"><!--{$customerData.name01|h}--> <!--{$customerData.name02|h}--></p></dd>
                <dt>氏名 (カナ)</dt>
                <dd><p class="entry_confirm"><!--{$customerData.kana01|h}--> <!--{$customerData.kana02|h}--></p></dd>
                <dt>性別</dt>
                <dd><p class="entry_confirm"><!--{if $customerData.sex == 1}-->男性<!--{else}-->女性<!--{/if}--></p></dd>
                <dt>生年月日</dt>
                <dd><p class="entry_confirm"><!--{$customerData.year|h}-->年 <!--{$customerData.month|h}-->月 <!--{$customerData.day|h}-->日</p></dd>
                <dt>電話番号</dt>
                <dd><p class="entry_confirm"><!--{$customerData.tel01|h}-->-<!--{$customerData.tel02|h}-->-<!--{$customerData.tel03|h}--></p></dd>               
                <dt>メールアドレス</dt>
                <dd><p class="entry_confirm"><!--{$customerData.email|h}--></p></dd>
                <dt class="sml">メールマガジン送付について</dt>
                <dd><p class="entry_confirm"><!--{if $customerData.mailmaga_flg eq 1}-->
                    HTMLメール＋テキストメールを受け取る
                    <!--{elseif $customerData.mailmaga_flg eq 2}-->
                    テキストメールを受け取る
                    <!--{else}-->
                    受け取らない
                    <!--{/if}--></p></dd>
                <dt class="sml">ご案内、お知らせの受け取り</dt>
                <dd><p class="entry_confirm"><!--{if $customerData.mail_kibou == 1}-->メールを希望する<!--{/if}--></p></dd>
            </dl>
            <div class="clearfix"></div>
            <!--{/if}-->
        </div>

        <!--{if !$registeredFully}-->
        <div class="clearfix"></div>
        <p class="entry_form_kiyaku"><em>【重要】 会員登録をされる前に、下記ご利用規約をよくお読みください。</em></p>
        <p class="entry_form_kiyaku">
            規約には、本サービスを使用するに当たってのあなたの権利と義務が規定されております。<br/>
            「上記利用規約に同意する」をチェックして送信すると、あなたが本規約の全ての条件に同意したことになります。</p>

        <div class="kiyaku">
            <p class="head"><em>「ご利用規約 / 会員登録」</em></p>
            <!--{foreach from=$kiyaku_text item=kiyaku}-->
            <p><em class="title"><!--{$kiyaku.kiyaku_title}--></em></p>
            <p><!--{$kiyaku.kiyaku_text}--></p>
            <!--{/foreach}-->
        </div>

        <p class="entry_form_navi"><input type="checkbox" name="accept" value="1" id="key" class="c_checkbox"/><label for="key" class="c_checkbox"><span class="entry">上記利用規約に同意する</span></label></p>
        <div class="centeredContent">
            <button class="icon-btn icon-btn-send" type="submit">
                <span class="icon-btn-text">会員登録情報を送信</span>
            </button>
        </div>
        <!--{/if}-->
    </form>
</div>