<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

<style>
    .col { display: inline !important; }
    .col2 { margin-right: 1% !important; width: 40% !important; }
    .col3 { margin-right: 1% !important; width: 25% !important; }
    .mini{ font-size: 70%; }
    img{ max-width: 100%; }
    dl dt, dl dd{ color: #666 !important; }
    div#entry_form dt{ font-size: 0.9em !important; }
    dl dt span{ color: red !important; }
    .c_radio span:before { left: 8.5px; }
</style>

<script>
    $("document").ready(function () {
	$("#mynumber_image").change(function () {
	    fnModeSubmit('upload_image', 'image_key', 'mynumber_image');
	});
	$("#mynumber_image_back").change(function () {
	    fnModeSubmit('upload_image', 'image_key', 'mynumber_image_back');
	});
    });
</script>

<section id="mypagecolumn">
    <h2 class="member_entry"><!--{$title|h}--> <span><!--{$tpl_title|h}--></span></h2>

    <!--{if $page == 'input'}-->

    <form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
	<input type="hidden" name="parent_staff_id" value="<!--{$arrForm.parent_staff_id}-->" />
	<input type="hidden" name="parent_name01" value="<!--{$arrForm.parent_name01}-->" />
	<input type="hidden" name="parent_name02" value="<!--{$arrForm.parent_name02}-->" />
        <input type="hidden" name="image_key" value="" />
        <input type="hidden" name="down_key" value="">

        <!--{foreach key=key item=item from=$arrForm.arrHidden}-->
        <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
        <!--{/foreach}-->

        <div id="entry_form">
            <dl>
		<!--{if $smarty.session.is_family_member != 0}-->
                <dt style="font-size: 0.75em !important"><span>必須</span> スタッフのマイナンバー</dt>
                <dd>
                    <!--{assign var=key1 value="parent_mynumber01"}-->
                    <!--{assign var=key2 value="parent_mynumber02"}-->
                    <!--{assign var=key3 value="parent_mynumber03"}-->
		    <!--{if $smarty.session.parent_staff_id == 0}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" class="col col3" placeholder="[例] 0001" />
                    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" class="col col3" placeholder="[例] 2345" />
                    <input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" class="col col3" placeholder="[例] 6789" />
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}--><p class="error"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></p><!--{/if}-->
		    <!--{else}-->
		    <p class="entry_confirm"><!--{$arrForm[$key1]|h}--><!--{$arrForm[$key2]|h}--><!--{$arrForm[$key3]|h}--></p>
		    <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" />
		    <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" />
		    <input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" />
		    <!--{/if}-->
                </dd>
		<!--{/if}-->
                <dt><span>必須</span> <!--{if $smarty.session.is_family_member != 0}-->扶養家族の<!--{/if}-->お名前</dt>
                <dd>
                    <input type="text" class="col col2" name="name01" value="<!--{$arrForm.name01|h}-->" placeholder="[例] 山田" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />&nbsp;
                    <input type="text" class="col col2" name="name02" value="<!--{$arrForm.name02|h}-->" placeholder="[例] 太郎" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />
                    <!--{if $arrErr.name01 || $arrErr.name02}-->
                    <p class="error"><!--{$arrErr.name01}--><!--{$arrErr.name02}--></p>
                    <!--{/if}-->
                </dd>
                <dt><span>必須</span> お名前(フリガナ)</dt>
                <dd>
                    <input type="text" class="col col2" name="kana01" value="<!--{$arrForm.kana01|h}-->" placeholder="[例] ヤマダ" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />&nbsp;
                    <input type="text" class="col col2" name="kana02" value="<!--{$arrForm.kana02|h}-->" placeholder="[例] タロウ" maxlength="<!--{$smarty.const.STEXT_LEN}-->" />
                    <!--{if $arrErr.kana01 || $arrErr.kana02}-->
                    <p class="error"><!--{$arrErr.kana01}--><!--{$arrErr.kana02}--></p>
                    <!--{/if}-->
                </dd>
		<dt><span>必須</span> マイナンバー</dt>
                <dd>
                    <!--{assign var=key1 value="mynumber01"}-->
                    <!--{assign var=key2 value="mynumber02"}-->
                    <!--{assign var=key3 value="mynumber03"}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" class="col col3" placeholder="[例] 0001" />
                    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" class="col col3" placeholder="[例] 2345" />
                    <input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" class="col col3" placeholder="[例] 6789" />
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}--><p class="error"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></p><!--{/if}-->
                </dd>
		<!--{if $smarty.session.is_family_member != 0}-->
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
                <dt><span>必須</span> あなたとの続柄</dt>
                <dd>
                    <select name="relation_id" style="<!--{$arrErr.relation_id|sfGetErrorColor}-->">
                        <option value="" selected="selected">選択してください</option>
                        <!--{html_options options=$arrRelation selected=$arrForm.relation_id}-->
                    </select>
		    <!--{if $arrErr.relation_id}--><p class="error"><!--{$arrErr.relation_id}--></p><!--{/if}-->
                </dd>
                <dt>同居区分</dt>
                <dd>
                    <input type="radio" name="is_live_together" value="1" id="yes" class="c_radio" <!--{if $arrForm.is_live_together eq 1}--> checked="checked" <!--{/if}--> /><label for="yes" class="c_radio"><span class="entry">同居</span></label> &nbsp; 
                    <input type="radio" name="is_live_together" value="0" id="no" class="c_radio" <!--{if $arrForm.is_live_together eq 0}--> checked="checked" <!--{/if}--> /><label for="no" class="c_radio"><span class="entry">別居</span></label>
		    <!--{if $arrErr.is_live_together}--><p class="error"><!--{$arrErr.is_live_together}--></p><!--{/if}-->
                </dd>
		<!--{/if}-->
                <dt><span>必須</span> 添付画像①<br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</dt>
                <dd>
                    <!--{assign var=key value="mynumber_image"}-->
                    <a name="_<!--{$key}-->"></a>
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->');
			    return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" />
		    <!--{if $arrErr[$key]}--><p class="error"><!--{$arrErr[$key]}--></p><!--{/if}-->
		    <div style="padding: 10px; margin-bottom: 5px; background-color: #EEE">
			<p><u>アップロード画像の例:</u></p>
			<!--{if $smarty.session.mynumber_card == 1}-->
			<p class="mini">●個人番号カードの<span class="attention">表面</span>の画像をアップロードしてください。</p>
			<img src="/upload/mynumber_image/nocard_image1.png" alt="sample" />
			<!--{else}-->
			    <!--{if $smarty.session.is_family_member == 1}-->
			    <p class="mini">●<span class="attention">通知カードの表面</span>の写真をアップロードしてください。</p>
			    <img src="/upload/mynumber_image/withcard_image1_family.png" alt="sample" />
			    <!--{else}-->
			    <p class="mini">●<span class="attention">通知カードと身分証明書</span>（免許証、パスポート等のいずれか）の<span class="attention">表面</span>の画像をアップロードしてください。</p>
			    <img src="/upload/mynumber_image/withcard_image1.png" alt="sample" />
			    <p class="mini">身分証明は下記の書類いずれかの写真を添付してください。<br /><span class="attention">※</span>パスポート<br /><span class="attention">※</span>運転免許証<br /><span class="attention">※</span>写真付きの住民基本台帳カード</p>
			    <!--{/if}-->
			<!--{/if}-->
		    </div>
                </dd>
		<!--{if $smarty.session.mynumber_card != 0 || $smarty.session.is_family_member != 1}-->
                <dt><span>必須</span> 添付画像②<br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</dt>
                <dd>
                    <!--{assign var=key value="mynumber_image_back"}-->
		    <a name="_<!--{$key}-->"></a>
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->');
			    return false;">[画像の取り消し]</a><br />
                    <!--{/if}-->
                    <input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" />
		    <!--{if $arrErr[$key]}--><p class="error"><!--{$arrErr[$key]}--></p><!--{/if}-->
		    <div style="padding: 10px; margin-bottom: 5px; background-color: #EEE">
			<p><u>アップロード画像の例:</u></p>
			<!--{if $smarty.session.mynumber_card == 1}-->
			<p class="mini">●個人番号カードの<span class="attention">裏面</span>の画像をアップロードしてください。</p>
			<img src="/upload/mynumber_image/nocard_image2.png" alt="sample" />
			<!--{else}-->
			<p class="mini">●<span class="attention">身分証明書</span>（免許証、パスポート等のいずれ）の<span class="attention">裏面</span>の画像をアップロードしてください。</p>
			<img src="/upload/mynumber_image/withcard_image2.png" alt="sample" />
			<p class="mini">（パスポートの場合は通知カードの裏面のみで結構です）</p>
			<!--{/if}-->
		    </div>
                </dd>
		<!--{/if}-->
            </dl>
        </div>
        <p class="entry_form_navi">
            <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">確認ページへ</span></button>
        </p>
    </form>

    <!--{elseif $page == 'confirm'}-->

    <form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach key=key item=item from=$arrForm}-->
        <!--{if $key ne "mode" && $key ne "subm" && $key ne "arrFile"}-->
        <!--{if is_array($item)}-->
        <!--{foreach item=c_item from=$item}-->
        <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
        <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
        <!--{/if}-->
        <!--{/if}-->
        <!--{/foreach}-->

        <div id="entry_form">
            <dl>
		<!--{if $smarty.session.is_family_member != 0}-->
		<dt>スタッフのマイナンバー</dt>
		<dd><p class="entry_confirm"><!--{$arrForm.parent_mynumber01|h}--><!--{$arrForm.parent_mynumber02|h}--><!--{$arrForm.parent_mynumber03|h}--></p></dd>
		<!--{/if}-->
                <dt><!--{if $smarty.session.is_family_member != 0}-->扶養家族の<!--{/if}-->お名前</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.name01|h}-->　<!--{$arrForm.name02|h}--></p></dd>
                <dt>お名前(フリガナ)</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.kana01|h}-->　<!--{$arrForm.kana02|h}--></p></dd>
		<dt>マイナンバー</dt>
                <dd><p class="entry_confirm"><!--{$arrForm.mynumber01|h}--><!--{$arrForm.mynumber02|h}--><!--{$arrForm.mynumber03|h}--></p></dd>
		<!--{if $smarty.session.is_family_member != 0}-->
		<dt>生年月日</dt>
		<dd><p class="entry_confirm"><!--{$arrForm.year|h}-->年 <!--{$arrForm.month|h}-->月 <!--{$arrForm.day|h}-->日</p></dd>
		<dt>あなたとの続柄</dt>
		<dd><p class="entry_confirm"><!--{$arrRelation[$arrForm.relation_id]}--></p></dd>
		<dt>同居区分</dt>
		<dd><p class="entry_confirm"><!--{$arrIsLiveTogether[$arrForm.is_live_together]}--></p></dd>
		<!--{/if}-->
                <dt>添付画像①</dt>
                <dd>
                    <!--{assign var=key value="mynumber_image"}-->
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.mynumber|h}-->" /><br /><br />
                    <!--{/if}-->
                </dd>
		<!--{if $smarty.session.mynumber_card != 0 || $smarty.session.is_family_member != 1}-->
                <dt>添付画像②</dt>
                <dd>
                    <!--{assign var=key value="mynumber_image_back"}-->
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.mynumber|h}-->" />
                    <!--{/if}-->
                </dd>
		<!--{/if}-->
            </dl>
        </div>
        <p class="entry_form_navi">
            <button class="icon-btn icon-btn-mail-back" type="submit" href="?" onclick="fnModeSubmit('return', '', ''); return false;"><span class="icon-btn-text">戻る</span></button>
            <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">送信</span></button>
        </p>
    </form>

    <!--{else}-->

    <div id="entry_form">
        <p class="entry_form_navi">マイナンバー登録が完了いたしました。<br />ご協力ありがとうございました。</p>
    </div>

    <h2 class="title">続けて<!--{if $isParent == 0}-->扶養家族のマイナンバー<!--{/if}-->登録<!--{if $isParent == 0}-->を行う<!--{/if}--></h2>
    <form name="form1" id="form1" method="post" action="regist.php">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="family_card_aru" />
	<input type="hidden" name="parent_staff_id" value="<!--{$parent_staff_id}-->" />
	<div class="login_area">
	    <ul class="navBox">
		<li class="hot"><a class="ui-link" href="#" onclick="fnModeSubmit('family_card_aru', '', ''); return false;">① 個人番号カードをお持ちの方はこちら</a></li>
		<li class="hot"><a class="ui-link" href="#" onclick="fnModeSubmit('family_card_nai', '', ''); return false;">② 個人番号カードお持ちではない<br />（通知カードをお持ち）の方はこちら</a></li>
	    </ul>
	</div>
    </form>

    <!--{/if}-->
</section>