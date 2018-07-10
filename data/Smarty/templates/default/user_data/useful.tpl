<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

<div id="undercolumn">
    <div id="undercolumn_content">
        <h2 class="title">ハイペリオンに登録してお得にお仕事してください!</h2>
        <p class="btm20">ハイペリオンにはお祝い金・奨励金制度、時給アップ制度などがあり、お得にお仕事をしていただくことができます。<br>（ハイペリオンでお仕事していただくメリットについて、詳しくは<a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/shigoto.php">こちら</a>）<br>ぜひハイペリオンにご登録し、ご希望のお仕事をお探しください。</p>
        <div style="font-size: 125%; font-weight: bold; line-height: 35px">
            <a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/explanation.php">まず説明会に参加してみて、直接お話を聞かれたい方はこちら</a>
        </div>
        <span style="font-size: 90%;">お電話でのお問い合わせはこちら</span><br>
        <span style="font-size: 170%; color: rgb(248,125,29); font-weight: bold;">048-451-3877</span>
        <br><br>
        <h2 class="title">会員登録フォーム</h2>
        <img src="<!--{$TPL_URLPATH}-->img/banner/bnr_useful.jpg" alt="" /><br><br>
        <p class="btm20">簡単な会員登録をしていただいた上で、説明会にご参加ください。</p>
        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="confirm" />
            <input type="hidden" name="redirect" value="<!--{$arrForm.redirect}-->" />
            <!--{include file="`$smarty.const.TEMPLATE_REALDIR`frontparts/customer_regist1.tpl" flgFields=3 emailMobile=false prefix=""}-->
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