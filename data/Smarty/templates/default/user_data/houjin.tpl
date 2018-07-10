<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

<div id="undercolumn">
    <div id="undercolumn_entry">
        <!--{if $page == 'complete'}-->
        <div id="complete_area">
            <p class="message">ご入力内容が登録されました。</p>
            <p>万一、ご回答メールが届かない場合は、トラブルの可能性もありますので<br>大変お手数ではございますがもう一度お問い合わせいただくか、お電話にてお問い合わせください。</p>

            <div class="shop_information">
                <p class="name"><!--{$arrSiteInfo.shop_name|h}--></p>
                <p>TEL：<!--{$arrSiteInfo.tel01}-->-<!--{$arrSiteInfo.tel02}-->-<!--{$arrSiteInfo.tel03}-->
                    <!--{if $arrSiteInfo.business_hour != ""}-->（受付時間/<!--{$arrSiteInfo.business_hour}-->）<!--{/if}--><br />
                    E-mail：<a href="mailto:<!--{$arrSiteInfo.email02|escape:'hex'}-->"><!--{$arrSiteInfo.email02|escape:'hexentity'}--></a>
                </p>
            </div>

            <div class="btn_area">
                <ul>
                    <li>
                        <a href="<!--{$smarty.const.TOP_URLPATH}-->" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage_on.jpg', 'b_toppage');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg', 'b_toppage');"><img src="<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg" alt="トップページへ" border="0" name="b_toppage" /></a>
                    </li>
                </ul>
            </div>
        </div>
        <!--{else}-->
        <!--{if $page == 'input'}-->
        <h2 class="title">人材をお探しの法人の皆様へ</h2>
        <p>即戦力のある人材、突発的に発生した人員補充、スペシャリストの確保など、お客様の幅広いニーズに応じて、即座にかつ柔軟に人材を確保・配置いたします。<br>
            また人材の提供だけに留まらず、業務の効率化を図り、効果的なコスト削減をサポートさせていただきます</p>
        <table class="co_table1">
            <tr>
                <th style="width: 45%">ハイペリオンご活用前</th><th style="width: 10%; background-color: white;" rowspan="2"></th><th style="width: 45%">ハイペリオンご活用後</th>
            </tr>
            <tr>
                <td style="text-align: center;">業務の繁閑に合わせた人員配置が出来ない</td><td style="text-align: center;">業務の繁閑に合わせた人員配置が可能</td>
            </tr>
            <tr>
                <td colspan="3"><img src="<!--{$TPL_URLPATH}-->img/banner/bnr_houjin.jpg" alt="" /></td>
            </tr>
        </table>
        <a href="#form_title" class="form_link">お申し込み・お問い合わせはこちらへ</a><br><br>
        <h2 class="title">ハイペリオン活用のメリット</h2>
        <table class="co_table2" style="border-collapse: separate; border-spacing: 5px;">
            <tr>
                <th>フレキシブルな契約期間</th><th>労力・コストを削減</th><th>高スキル・即戦力スタッフ提供</th>
            </tr>
            <tr>
                <td>必要な人材を、必要な時に、必要な期間だけ活用することができます。<br>契約期間をフレキシブルに設定することで、無駄のない組織編成が可能となります。</td>
                <td>募集から採用にかかる労力やコストを軽減。<br>社会保険等の労務管理も、派遣会社が対応するため、その業務が不要になります。</td>
                <td>質の高い登録者を多数確保。最適な人材を安定的・継続的に派遣いたします。</td>
            </tr>
        </table>
        <p class="btm20" style="text-align: center"><img src="<!--{$TPL_URLPATH}-->img/banner/bnr_chart.jpg" alt="派遣" /></p>
        <h3 class="co">お客様の業務内容に応じたスタッフを厳選し、優秀な人材を提供いたします。</h3>
        <h3 class="co">弊社では、お客様毎に業務分析をさせて頂き、派遣スタッフに対してマニュアルを作成し教育いたします。</h3>
        <h3 class="co">スタッフの就業後も定期的な面談、育成など、きめ細かなフォローを実施いたします。</h3>
        <!--{else}-->
        <h3 class="co">ご登録内容をご確認ください。</h3><br>
        <p>下記の内容で送信してもよろしいでしょうか？<br>よろしければ、一番下の「この内容で登録する」ボタンをクリックください。</p>
        <!--{/if}-->

        <!--{if $smarty.const.CUSTOMER_CONFIRM_MAIL}-->
        <p>ご登録されますと、まずは仮会員となります。<br />
            入力されたメールアドレスに、ご連絡が届きますので、本会員になった上でお買い物をお楽しみください。</p>        
        <!--{/if}-->

        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="<!--{if $page == 'input'}-->confirm<!--{else}-->complete<!--{/if}-->" />
            <!--{if $page == 'input'}-->
            <br>
            <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/form_corp_input.tpl" flgFields=3 emailMobile=false prefix=""}-->
            <!--{else}-->
            <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/form_corp_confirm.tpl" flgFields=3 emailMobile=false prefix=""}-->
            <!--{/if}-->
        </form>
        <!--{/if}-->
    </div>
</div>