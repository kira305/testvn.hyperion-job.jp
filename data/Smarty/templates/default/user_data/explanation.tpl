<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

<div id="undercolumn">
    <div id="undercolumn_content">
        <!--{if $msg == 1}-->
        <h2 class="title">会員登録が完了しました</h2>
        <p class="btm20 attention">ハイペリオンへの会員登録が完了しました。ご登録ありがとうございます。<br>つづいて、以下のフォームより登録説明会にお申し込みください。</p>
        <!--{/if}-->
        <h2 class="title">登録説明会お申し込みフォーム</h2>
        <p class="btm20">お仕事の開始に先立ちまして、登録説明会にご参加いただきます。<br>
            会場はハイペリオンの川越オフィスもしくは朝霞オフィスになります。もしご希望がございましたら池袋オフィスでの開催も可能ですので、ご相談ください。
            <br><br>

            <strong>川越オフィス</strong><br>
            <img src="<!--{$arrOfficeUrl[1]}-->" alt="川越オフィス" width="450" height="300" /><br>
            <!--{$arrOfficeAddr[1]}--><br>
            TEL:049-249-1800<br>
            FAX:049-249-1801<br><br>

            <strong>朝霞オフィス</strong><br>
            <img src="<!--{$arrOfficeUrl[2]}-->" alt="朝霞オフィス" width="450" height="300" /><br>
            <!--{$arrOfficeAddr[2]}--><br>
            TEL:048-451-3877<br>
            FAX:048-451-3871<br><br>

            <strong>池袋オフィス</strong><br>
            <img src="<!--{$arrOfficeUrl[3]}-->" alt="池袋オフィス" width="450" height="300" /><br>
            <!--{$arrOfficeAddr[3]}--><br>
            TEL:03-5956-7550<br>
            FAX:03-5956-755<br><br><br>
            
            【説明会のプログラム】<br>
            ・ハイペリオンのご紹介（会社案内）<br>
            ・お仕事のご紹介<br>
            ・人材紹介・人材派遣の仕組みのご案内<br>
            ・ハイペリオンへの登録シートの記入<br>
            ・コーディネーターによるカウンセリング<br><br><br>
            ・入力項目は以下。会員登録を終えた人については、お名前以下を入力済みの状態にしたい。
        </p>
        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="confirm" />
            <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/customer_regist2.tpl" flgFields=3 emailMobile=false prefix=""}-->
            <div class="btn_area">
                <ul>
                    <li>
                        <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm_on.jpg', this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg', this)" src="<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg" alt="確認ページへ" name="confirm" id="confirm" />
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>