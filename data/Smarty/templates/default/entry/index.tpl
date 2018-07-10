<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->
<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="touroku_title"><!--{$tpl_title|h}--></h2>
        <!--{*        
        *<img src="<!--{$TPL_URLPATH}-->img/background/title/bg_entry_title.jpg" alt="薬剤師エントリ" />
        *}-->
        <!--{if $smarty.const.CUSTOMER_CONFIRM_MAIL}-->
            <p>ご登録されますと、まずは仮会員となります。<br />
                入力されたメールアドレスに、ご連絡が届きますので、本会員になった上でお買い物をお楽しみください。</p>
        <!--{/if}-->
        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="confirm" />

            <table summary="会員登録フォーム">
            <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/form_personal_input.tpl" flgFields=3 emailMobile=false prefix=""}-->
            </table>

            <div class="btn_area">
                <ul>
                    <li>
                        <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg" alt="確認ページへ" name="confirm" id="confirm" />
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>


<!--会員登録フォーム閲覧計測用
/* SiteCatalyst code version: H.21.
Copyright 1996-2010 Adobe, Inc. All Rights Reserved
More info available at http://www.omniture.com */-->
<script language="JavaScript" type="text/javascript" src="https://pharmapremium.jp/s_code.js"></script>
<script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on
the next lines. */
s.events="event1"
s.products=";formview1;1;1000"
	/* clickPast */
s.SEMvar = s.getQueryParam('s_kwcid');
s.SEMvar = s.getValOnce(s.SEMvar,'SEM_var',0);
s.clickPast(s.SEMvar,'event26','event27');

/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
if(s.SEMvar||s.events){var s_code=s.t();if(s_code)document.write(s_code)}//--></script>
<!-- End SiteCatalyst code version: H.21. ここまで-->