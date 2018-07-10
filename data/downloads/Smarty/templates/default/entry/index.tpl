<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->
<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="touroku_title"><!--{$tpl_title|h}--></h2>
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