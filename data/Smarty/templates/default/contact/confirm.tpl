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

<div id="undercolumn">
        
    <h2 class="contact">お問い合わせ <span>確認</span></h2>

    <div id="undercolumn_contact">
        
        <div class="caption_text">
        <ul>
            <li>必要項目をご入力後、確認画面が表示されます。 内容に間違いがなければ、送信ボタンを押して下さい。</li>
            <li>内容によっては回答をさしあげるのにお時間をいただくこともございます。</li>
            <li>休業日は翌営業日以降の対応となりますのでご了承ください。</li>
        </ul>
        
        <p><em>※求人情報サイト「ハイペリオンあっとジョブ」運営会社へのお問い合わせ窓口となっております。<br>
            掲載されている求人の内容、面接等に関するお問い合わせについては、直接企業様へお問い合わせ下さい。</em></p>
        </div>

<!--  エントリーフォーム  -->
			<div id="entry_form">
                
<p class="entry_form_navi">以下の内容でよろしいでしょうか？</p> 

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach key=key item=item from=$arrForm}-->
            <!--{if $key ne 'mode'}-->
                <input type="hidden" name="<!--{$key}-->" value="<!--{$item.value|h}-->" />
            <!--{/if}-->
        <!--{/foreach}-->

<div class="list_wrap_list clearfix">

    <div class="list_wrap list_wrap_entry clearfix">
        
                <dl id="contact_form">
                <dt><span>必須</span> 氏名 (漢字)</dt>
                <dd><p class="contact_confirm"><!--{$arrForm.name01.value|h}-->　<!--{$arrForm.name02.value|h}--></p></dd>
                    
                <dt><span>必須</span> 氏名 (カナ)</dt>
                <dd><p class="contact_confirm"><!--{$arrForm.kana01.value|h}-->　<!--{$arrForm.kana02.value|h}--></p></dd>

                <dt><span>必須</span> メールアドレス</dt>
                <dd><p class="contact_confirm"><!--{$arrForm.email.value|escape:'hexentity'}--></p></dd>
                </dl>
        
    <dl id="contact_form_text">
        <dt>お問い合わせ内容 <span class="mini">（全角<!--{$smarty.const.MLTEXT_LEN}-->字以下）</span></dt>
        <dd><p class="contact_confirm_br"><!--{$arrForm.contents.value|h|nl2br}--></p>
        <p><span class="attention"><!--{$arrErr.contents}--></span></p>
        <p>※求人に関するお問い合わせには、必ず「求人番号」をご記入くださいますようお願いいたします。</p></dd>
    </dl>

                <div class="clearfix"></div>  
            </div>	
                <div class="clearfix"></div>
                <p class="entry_form_navi">上記内容に誤りがない事を確認して</p>
    
             <button class="icon-btn icon-btn-mail-back" type="submit" href="?" onclick="fnModeSubmit('return', '', ''); return false;" >
                <span class="icon-btn-text">入力画面へ戻る</span>
             </button>

             <button class="icon-btn icon-btn-mail" type="submit" name="send" id="send" />
                <span class="icon-btn-text">お問い合わせを送信</span>
             </button>
        </form>
        </div>
    </div>
</div>
</div>