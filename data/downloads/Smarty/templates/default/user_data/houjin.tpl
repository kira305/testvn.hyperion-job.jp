<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="co_title"><!--{$tpl_title|h}--></h2>
<!--{if $page == 'complete'}-->
        <p>送信完了致しました。</p>
<!--{else}-->
    <!--{if $page == 'input'}-->
        <h2 class="common_title"><img src="<!--{$TPL_URLPATH}-->img/title/tit_houjin_merit.gif" alt="派遣活用のメリット" /></h2>
        <h3 class="co">フレキシブルな契約期間</h3>
        <p>必要な人材を、必要な時に、必要な期間だけ活用することができます。</p>
        <p class="btm10">契約期間をフレキシブルに設定することで、無駄のない組織編成が可能となります。</p>
        <h3 class="co">労力・コストを軽減</h3>
        <p>募集から採用にかかる労力やコストを軽減。</p>
        <p class="btm10">社会保険等の労務管理も、派遣会社が対応するため、その業務が不要になります。</p>
        <h3 class="co">高スキル・即戦力スタッフのご提供</h3>
        <p class="btm20">質の高い登録者を多数確保。最適な人材を安定的・継続的に派遣いたします。</p>
        <p class="btm20"><img src="<!--{$TPL_URLPATH}-->img/banner/bnr_chart.jpg" alt="派遣" /></p>
        <h3 class="co">お申し込み・お問い合わせはこちらからどうぞ</h3>
    <!--{else}-->
         <h3 class="co">ご登録内容をご確認ください。</h3>
    <!--{/if}-->
       
    <!--{if $smarty.const.CUSTOMER_CONFIRM_MAIL}-->
         <p>ご登録されますと、まずは仮会員となります。<br />
              入力されたメールアドレスに、ご連絡が届きますので、本会員になった上でお買い物をお楽しみください。</p>        
    <!--{/if}-->

        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="<!--{if $page == 'input'}-->confirm<!--{else}-->complete<!--{/if}-->" />
            <!--{if $page == 'input'}-->
                <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/form_corp_input.tpl" flgFields=3 emailMobile=false prefix=""}-->
            <!--{else}-->
                <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/form_corp_confirm.tpl" flgFields=3 emailMobile=false prefix=""}-->
            <!--{/if}-->
        </form>
<!--{/if}-->
    </div>
</div>