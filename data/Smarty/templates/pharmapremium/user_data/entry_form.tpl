<style>
    .col{
        display: inline !important;
    }
    .col2{
        width: 40% !important;
        margin-right: 1% !important;
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
    <h2 class="entry">お仕事応募 <span>入力フォーム</span></h2>

    <ul class="entry_step">
        <li class="here_done">Step1:入力</li>
        <li><span>Step2:確認</span></li>
        <li><span>Step3:応募完了</span></li>
    </ul>
    <form name="form_check" id="form_check" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
        <!--  エントリーフォーム  -->
        <div id="entry_form">
            <p class="entry_form_navi">下記のお仕事に応募します。</p>
            <!--{if count($arrErr) > 0}--><p class="error_msg">入力項目に誤りがあります</p><!--{/if}-->
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
                <dt><span>必須</span> 氏名 (漢字)</dt>
                <dd>
                    <input type="text" class="col col2" name="name01" value="<!--{$arrForm.name01|h}-->" placeholder="[例] 山田" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />&nbsp;
                    <input type="text" class="col col2" name="name02" value="<!--{$arrForm.name02|h}-->" placeholder="[例] 太郎" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />
                    <!--{if $arrErr.name || $arrErr.name01 || $arrErr.name02}-->
                        <p class="error"><!--{$arrErr.name}--><!--{$arrErr.name01}--><!--{$arrErr.name02}--></p>
                    <!--{/if}-->
                </dd>
                <dt><span>必須</span> 氏名 (カナ)</dt>
                <dd>
                    <input type="text" class="col col2" name="kana01" value="<!--{$arrForm.kana01|h}-->" placeholder="[例] ヤマダ" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />&nbsp;
                    <input type="text" class="col col2" name="kana02" value="<!--{$arrForm.kana02|h}-->" placeholder="[例] タロウ" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />
                    <!--{if $arrErr.kana || $arrErr.kana01 || $arrErr.kana02}-->
                        <p class="error"><!--{$arrErr.kana}--><!--{$arrErr.kana01}--><!--{$arrErr.kana02}--></p>
                    <!--{/if}-->
                </dd>
                <dt><span>必須</span> 性別</dt>
                <dd>
                    <ul class="input_sex">
                        <li>
                            <label for="radiofield000" class="jsc-check-sex">
                                <input type="radio" name="sex" id="radiofield000" class="sex_radiobox" value="1" <!--{if $arrForm.sex != 2}-->checked="checked"<!--{/if}--> >
                                <span class="men">男性</span>
                            </label>
                        </li>
                        <li>
                            <label for="radiofield001" class="jsc-check-sex">
                                <input type="radio" name="sex" id="radiofield001" class="sex_radiobox" value="2" <!--{if $arrForm.sex == 2}-->checked="checked"<!--{/if}--> >
                                <span class="women">女性</span>
                            </label>
                        </li>
                    </ul>
                </dd>
                <dt><span>必須</span> 生年月日</dt>
                <dd>
                    <p>
                        <select name="year" id="jsi-date-birth-year">
                            <option value="" class="jsc-default-selected" >選択</option>
                            <!--{html_options options=$arrYear selected=$arrForm.year}-->
                        </select><span class="period-m">年</span>
                        <select name="month" id="selectfield001" class="date-birth-month">
                            <option value="" class="jsc-default-selected" >選択</option>
                            <!--{html_options options=$arrMonth selected=$arrForm.month}-->
                        </select><span class="period-m">月</span>
                        <select name="day" id="selectfield002" class="date-birth-day">
                            <option value="" class="jsc-default-selected" >選択</option>
                            <!--{html_options options=$arrDay selected=$arrForm.day}-->
                        </select><span class="period-m">日</span>
                        <!--{assign var=errBirth value="`$arrErr.birth``$arrErr.year``$arrErr.month``$arrErr.day`"}-->
                        <!--{if $errBirth}--><p class="error"><!--{$errBirth}--></p><!--{/if}-->
                    </p>
                </dd>
                <dt><span>必須</span> 電話番号</dt>
                <dd>
                    <input type="text" class="col col3" name="tel01" class="entry_free" value="<!--{$arrForm.tel01|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" placeholder="[例] 090" />&nbsp;-&nbsp;
                    <input type="text" class="col col3" name="tel02" class="entry_free" value="<!--{$arrForm.tel02|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" placeholder="[例] XXXX" />&nbsp;-&nbsp;
                    <input type="text" class="col col3" name="tel03" class="entry_free" value="<!--{$arrForm.tel03|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" placeholder="[例] 1234" />
                    <!--{if $arrErr.tel || $arrErr.tel01 || $arrErr.tel02 || $arrErr.tel03}-->
                        <p class="error"><!--{$arrErr.tel}--><!--{$arrErr.tel01}--><!--{$arrErr.tel02}--><!--{$arrErr.tel03}--></p>
                    <!--{/if}-->
                </dd>
                <dt><span>必須</span> メールアドレス</dt>
                <dd>
                    <input type="text" class="entry_free" name="email" value="<!--{$arrForm.email|h}-->" placeholder="[例] abc123@mail.com" style="ime-mode: disabled;" />
                    <!--{if $arrErr.email}--><p class="error"><!--{$arrErr.email}--></p><!--{/if}-->
                </dd>
                <dt class="sml">※確認の為2度入力してください</dt>
                <dd>
                    <input type="text" class="entry_free" name="email02" value="<!--{$arrForm.email02|h}-->" placeholder="[例] abc123@mail.com" style="ime-mode: disabled;" />
                    <!--{if $arrErr.email02}--><p class="error"><!--{$arrErr.email02}--></p><!--{/if}-->
                </dd>
                <dt class="sml"><span>必須</span> メールマガジン送付<br />について</dt>
                <dd style="text-align: left">
                    <input type="radio" name="mailmaga_flg" value="1" id="html" class="c_radio" <!--{if $arrForm.mailmaga_flg eq 1}--> checked="checked" <!--{/if}--> /><label for="html" class="c_radio"><span class="entry">HTMLメール＋テキストメールを受け取る</span></label><br />
                    <input type="radio" name="mailmaga_flg" value="2" id="text" class="c_radio" <!--{if $arrForm.mailmaga_flg eq 2}--> checked="checked" <!--{/if}--> /><label for="text" class="c_radio"><span class="entry">テキストメールを受け取る</span></label><br />
                    <input type="radio" name="mailmaga_flg" value="3" id="no" class="c_radio" <!--{if $arrForm.mailmaga_flg eq 3}--> checked="checked" <!--{/if}--> /><label for="no" class="c_radio"><span class="entry">受け取らない</span></label>
                    <!--{if $arrErr.mailmaga_flg}--><p class="error"><!--{$arrErr.mailmaga_flg}--></p><!--{/if}-->
                </dd>
                <dt class="sml">ご案内、お知らせの受け取り</dt>
                <dd>
                    <input type="checkbox" name="mail_kibou" value="1" id="kibou" class="c_checkbox" <!--{if $arrForm.mail_kibou == 1}-->checked="checked"<!--{/if}--> />
                    <label for="kibou" class="c_checkbox"><span class="entry">メールを希望する</span></label>
                </dd>
            </dl>
            <div class="clearfix"></div>
        </div>
        <!--  エントリーフォーム  -->
        <div class="clearfix"></div>
        <p class="entry_form_kiyaku"><em>送信する前に、下記ご利用規約をよくお読みください。</em></p>
        <p class="entry_form_kiyaku">
            規約には、本サービスを使用するに当たってのあなたの権利と義務が規定されております。<br/>
            「上記利用規約に同意する」をチェックして送信すると、あなたが本規約の全ての条件に同意したことになります。</p>

        <div class="kiyaku">
            <p class="head"><em>「ご利用規約 / プライバシーポリシー」</em></p>        
            <!--{foreach from=$kiyaku_text item=kiyaku}-->
            <p><em class="title"><!--{$kiyaku.kiyaku_title}--></em></p>
            <p><!--{$kiyaku.kiyaku_text}--></p>
            <!--{/foreach}-->
        </div>

        <p class="entry_form_navi"><input type="checkbox" name="accept" value="1" id="key" class="c_checkbox" <!--{if $arrForm.accept == 1}-->checked="checked"<!--{/if}--> /><label for="key" class="c_checkbox"><span class="entry">上記利用規約に同意する</span></label></p>
        <div class="centeredContent">
            <button class="icon-btn icon-btn-send" type="submit">
                <span class="icon-btn-text">同意して送信</span>
            </button>
        </div>
    </form>
</div>