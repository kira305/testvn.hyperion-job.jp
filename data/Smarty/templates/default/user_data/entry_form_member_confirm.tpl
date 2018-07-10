<div id="undercolumn">
    <h2 class="member_entry">会員登録 <span>入力フォーム</span></h2>

    <ul class="entry_step">
        <li class="here_done">Step1:入力</li>
        <li class="here_done">Step2:確認</li>
        <li><span>Step3:登録完了</span></li>
    </ul>
    <form name="form_check" id="form_check" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach from=$arrForm key=key item=item}-->
            <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
        <!--{/foreach}-->

        <div id="entry_form">
            <p class="entry_form_navi">以下の内容でよろしいでしょうか？</p> 
            <dl>
                <dt>希望するパスワード</dt>
                <dd><p class="entry_confirm">********</p></dd>
                <dt>郵便番号</dt>
                <dd><p class="entry_confirm">〒<!--{$arrForm.zip01|h}-->-<!--{$arrForm.zip02|h}--></p></dd>
                <dt>都道府県</dt>
                <dd><p class="entry_confirm"><!--{$arrPref[$arrForm.pref]}--></p></dd>
                <dt>市町村</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.addr01|h}--></p></dd>
                <dt>番地</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.addr02|h}--></p></dd>

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
                <dt class="sml">利用規約</dt>
                <dd><p class="entry_confirm"><!--{if $arrForm.accept == 1}-->同意する<!--{/if}--></p></dd>

            </dl>
            <div class="clearfix"></div>  
        </div>	
        <div class="clearfix"></div>

        <p class="entry_form_navi">上記内容に誤りがない事を確認して</p>
        <button class="icon-btn icon-btn-send" type="submit">
            <span class="icon-btn-text">会員登録する</span>
        </button>
    </form>
</div>
<!--  エントリーフォーム  -->