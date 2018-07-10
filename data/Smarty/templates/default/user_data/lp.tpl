<script type="text/javascript">
function back()
{
  document.form1.mode.value = 'back';
  document.form1.submit();
}
</script>

<div id="landing_page">
<h1>あなたにピッタリの働き方が<br>ハイペリオンで見つかる！</h1><br>

<div class="block">
<p class="block_title">いろいろなお仕事</p>
<p class="block_list"> <span class="arrow">≫</span> 倉庫・物流系</p>
<p class="block_list"> <span class="arrow">≫</span> 工場系</p>
<p class="block_list"> <span class="arrow">≫</span> 事務系</p>
</div>
<div class="block">
<p class="block_title">うれしい待遇</p>
<p class="block_list"> <span class="arrow">≫</span> 全額日払い</p>
<p class="block_list"> <span class="arrow">≫</span> 交通費一部支給</p>
<p class="block_list"> <span class="arrow">≫</span> 皆勤手当</p>
</div>
<div class="block" id="last_block">
<p class="block_title">あれこれ選べる</p>
<p class="block_list"> <span class="arrow">≫</span> 仕事内容</p>
<p class="block_list"> <span class="arrow">≫</span> 勤務地</p>
<p class="block_list"> <span class="arrow">≫</span> 時間帯</p>
</div>

<div class="fulldiv"><img src="<!--{$TPL_URLPATH}-->img/background/arrows_down.png" width="512" height="50" alt=""/></div>

<h2>あなたのお仕事探しをハイペリオンがお手伝いします。<br>まずは、お気軽にご相談ください。</h2>

    <!--{foreach from=$arrProducts item=arrProduct name=arrProducts}-->
        <!--{assign var=id value=$arrProduct.product_id}-->
        <!--▼商品-->
        <table class="product_block">
            <tr><td colspan="2" class="name">
                <h3><a style="color: black;" href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a></h3></td></tr>
            <tr class="price_row"><td style="width: 50%"><span class="price" style="font-weight: bold;">
                        <span id="price02_default_<!--{$id}-->"><!--{strip}-->
                            <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                                <!--{$arrProduct.price02_min_inctax}-->
                            <!--{else}-->
                                <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                            <!--{/if}-->
                        </span><span id="price02_dynamic_<!--{$id}-->"></span><!--{/strip}-->
                        円</span></td>
                  <td style="text-align: right"><!--{$arrWorkLocationFlg[$arrProduct.work_location_flg]}--></td></tr>
            <tr><td colspan="2">勤務時間： <!--{$arrProduct.sub_comment4|h|nl2br}--></td></tr>
            <tr><td colspan="2">就業日： <!--{$arrProduct.sub_comment3|h|nl2br}--></td></tr>
            <tr><td colspan="2"><!--{$arrNEWSFLG[$arrProduct.news_flg]}--></td></tr>
            <tr><td colspan="2"><!--{$arrRECNEWSFLG[$arrProduct.rec_news_flg]}--></td></tr>
            <tr><td colspan="2">
                <!--{if count($arrProduct.employment_status) > 0}-->
                    <ul class="status_icon clearfix">
                        <!--{foreach from=$arrProduct.employment_status item=status}-->
                            <li><img src="<!--{$TPL_URLPATH}--><!--{$arrEMPSTATUS_IMAGE[$status]}-->" width="60" height="17" alt="<!--{$arrEMPSTATUS[$status]}-->"/></li>
                        <!--{/foreach}-->
                    </ul>
                <!--{/if}--></td></tr>
            <tr><td colspan="2">
                <!--{if count($arrProduct.appeal_point) > 0}-->
                    <ul class="status_icon clearfix">
                        <!--{foreach from=$arrProduct.appeal_point item=status}-->
                            <li><img src="<!--{$TPL_URLPATH}--><!--{$arrAPPEALPOINT_IMAGE[$status]}-->" width="75" height="40" alt="<!--{$arrAPPEALPOINT[$status]}-->"/></li>
                        <!--{/foreach}-->
                    </ul>
                <!--{/if}--></td></tr>
        </table>
        <!--▲商品-->
    <!--{foreachelse}-->
        <!--{include file="frontparts/search_zero.tpl"}-->
    <!--{/foreach}-->

    <div  class="fulldiv" id="button_row">
        <a class="lp_button" href="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php"><img src="<!--{$TPL_URLPATH}-->img/button/btn_lp_view.jpg" class="onmouse" alt="他の求人情報を見る" /></a> &nbsp; &nbsp; &nbsp; &nbsp;
        <a class="lp_button" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/address.php"><img src="<!--{$TPL_URLPATH}-->img/button/btn_lp_address.jpg" class="onmouse" alt="面接地情報を見る" /></a>
    </div>

    <span class="attention"><!--{$msg}--></span>

    <span class="mini">登録説明会日程を調整の上ご連絡いたしますので、まずはご応募ください。</span>
    <form method="post" name="form1" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="<!--{$mode}-->" />
        <table class="product_block" id="formTable">
            <tr>
                <th>メールアドレス<span class="attention">（必須）</span></th>
                <td>
                    <!--{if $mode == 'complete'}--><!--{$values.email}--><input type="hidden" name="email" value="<!--{$values.email}-->" />
                    <!--{else}--><!--{if $arrErr.email}--><div class="attention"><!--{$arrErr.email}--></div><!--{/if}-->
                    <input type="text" name="email" value="<!--{$values.email}-->" size="20" style="<!--{$arrErr.email|sfGetErrorColor}-->; ime-mode: active;" /><!--{/if}-->
                </td>
            </tr>
            <!--{if $mode == 'complete'}-->
            <input type="hidden" name="email_repeat" value="<!--{$values.email_repeat}-->" />
            <!--{else}-->
            <tr>
                <th>メールアドレス（確認）<span class="attention">（必須）</span></th>
                <td><!--{if $arrErr.email_repeat}--><div class="attention"><!--{$arrErr.email_repeat}--></div><!--{/if}-->
                    <input type="text" name="email_repeat" value="<!--{$values.email_repeat}-->" size="20" style="<!--{$arrErr.email_repeat|sfGetErrorColor}-->; ime-mode: active;" /></td>
            </tr>
            <!--{/if}-->
            <tr>
                <th>お名前<span class="attention">（必須）</span></th>
                <td>
                    <!--{if $mode == 'complete'}--><!--{$values.name01}--><!--{$values.name02}-->
                    <input type="hidden" name="name01" value="<!--{$values.name01}-->" /><input type="hidden" name="name02" value="<!--{$values.name02}-->" />
                    <!--{else}--><!--{if $arrErr.name01 || $arrErr.name02}--><div class="attention"><!--{$arrErr.name01}--><!--{$arrErr.name02}--></div><!--{/if}-->
                    姓 <input type="text" name="name01" value="<!--{$values.name01}-->" size="10" style="<!--{$arrErr.name01|sfGetErrorColor}-->; ime-mode: active;" /> &nbsp; 
                    名 <input type="text" name="name02" value="<!--{$values.name02}-->" size="10" style="<!--{$arrErr.name02|sfGetErrorColor}-->; ime-mode: active;" /><!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>お名前（フリガナ）</th>
                <td>
                    <!--{if $mode == 'complete'}--><!--{$values.kana01}--><!--{$values.kana02}-->
                    <input type="hidden" name="kana01" value="<!--{$values.kana01}-->" /><input type="hidden" name="kana02" value="<!--{$values.kana02}-->" />
                    <!--{else}--><!--{if $arrErr.kana01 || $arrErr.kana02}--><div class="attention"><!--{$arrErr.kana01}--><!--{$arrErr.kana02}--></div><!--{/if}-->
                    姓 <input type="text" name="kana01" value="<!--{$values.kana01}-->" size="10" style="<!--{$arrErr.kana01|sfGetErrorColor}-->; ime-mode: active;" /> &nbsp; 
                    名 <input type="text" name="kana02" value="<!--{$values.kana02}-->" size="10" style="<!--{$arrErr.kana02|sfGetErrorColor}-->; ime-mode: active;" /><!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>お電話番号</th>
                <td>
                    <!--{if $mode == 'complete'}--><!--{$values.tel01}-->-<!--{$values.tel02}-->-<!--{$values.tel03}--><input type="hidden" name="tel01" value="<!--{$values.tel01}-->" />
                    <input type="hidden" name="tel02" value="<!--{$values.tel02}-->" /><input type="hidden" name="tel03" value="<!--{$values.tel03}-->" />
                    <!--{else}--><!--{if $arrErr.tel01 || $arrErr.tel02 || $arrErr.tel03}--><div class="attention"><!--{$arrErr.tel01}--><!--{$arrErr.tel02}--><!--{$arrErr.tel03}--></div><!--{/if}-->
                    <input type="text" name="tel01" value="<!--{$values.tel01}-->" size="7" style="<!--{$arrErr.tel01|sfGetErrorColor}-->; ime-mode: active;" />-
                    <input type="text" name="tel02" value="<!--{$values.tel02}-->" size="7" style="<!--{$arrErr.tel02|sfGetErrorColor}-->; ime-mode: active;" />-
                    <input type="text" name="tel03" value="<!--{$values.tel03}-->" size="7" style="<!--{$arrErr.tel03|sfGetErrorColor}-->; ime-mode: active;" /><!--{/if}-->
                </td>
            </tr>
        </table>

        <!--{if $mode == 'complete'}-->
            <div class="btn_area"><input type="button" value="戻る" onclick="back();" /> &nbsp; &nbsp; &nbsp; <input type="submit" value="保存" /></div>
        <!--{else}-->
            <div class="btn_area"><input type="submit" value="ご確認" /></div><br><br>
            <!--{if $msg!= ''}-->
            <div id="box">
                ご応募頂きありがとうございました。追って担当者からご連絡いたします。<br><br>尚、当サイトへ会員登録して頂けますと、さらに便利にお仕事を探して頂けますので、ぜひご登録ください。<br><br>
                <p><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/useful.php"><input type="button" value="会員登録" /></a></p>
            </div>
            <!--{/if}-->
        <!--{/if}-->
    </form>
</div>