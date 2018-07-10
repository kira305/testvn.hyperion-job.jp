<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

<style>
    #bottomcolumn{ display: none; }
    #container_wrap{ background: none; }
    div.attention{ font-size: 90%; }
    #undercolumn{ text-align: left; }
    .withAttn{ margin-bottom: 10px; }
    div#entry_form, div#entry_form dl{ width: 685px; }
    div#entry_form dt{ width: 220px; color: #666; }
    div#entry_form dt span{ color: red }
    div#entry_form dd{ width: 450px; color: #666; }
    div#entry_form input[type='text'], div#entry_form input[type='password']{ display: inline-block; }
    .entry_form_navi{ margin-top: 20px; text-align: center; }
    button.icon-btn{ top: 0; }
    img{ max-width: 100%; }
    .c_radio span:before { top: 22px; left: 7px; }
    .btn_area ul li{ float: left; width: 48%; text-align: right; }
    .linkBtn{
        border: 1px solid #DDDDDD;
        background-color: #EB720C;
        font-size: 1.2em;
        color: white;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
        border-radius: 6px;
	height: 70px;
	line-height: 70px;
	width: 350px;
	display: inline-block;
    }
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

<div id="undercolumn">
    <div id="undercolumn_entry">
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
                <p class="entry_form_navi">必要項目を入力してください</p>
		<!--{if $smarty.session.is_family_member != 0}-->
                <dl>
                    <dt style="font-size: 90% !important"><span>必須</span>従業員本人のマイナンバー</dt>
                    <dd>
                        <!--{assign var=key1 value="parent_mynumber01"}-->
			<!--{assign var=key2 value="parent_mynumber02"}-->
			<!--{assign var=key3 value="parent_mynumber03"}-->
			<!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
			<div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
			<!--{/if}-->
			<!--{if $smarty.session.parent_staff_id == 0}-->
			<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" /> 
			<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" /> 
			<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" />
			<!--{else}-->
			<p class="entry_confirm"><!--{$arrForm[$key1]|h}--><!--{$arrForm[$key2]|h}--><!--{$arrForm[$key3]|h}--></p>
			<input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" />
			<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" />
			<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" />
			<!--{/if}-->
                    </dd>
                </dl>
		<!--{/if}-->
                <dl>
                    <dt><span>必須</span><!--{if $smarty.session.is_family_member != 0}-->扶養家族の<!--{/if}-->お名前</dt>
                    <dd>
                        <!--{assign var=key1 value="name01"}-->
                        <!--{assign var=key2 value="name02"}-->
                        <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="half1" placeholder="姓" />&nbsp;
                        <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="half2" placeholder="名" />
                    </dd>
                </dl>
                <dl>
                    <dt><span>必須</span>お名前(フリガナ)</dt>
                    <dd>
                        <!--{assign var=key1 value="kana01"}-->
                        <!--{assign var=key2 value="kana02"}-->
                        <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                        <!--{/if}-->
                        <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="half1" placeholder="セイ" />&nbsp;
                        <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="half2" placeholder="メイ" />
                    </dd>
                </dl>
		<!--{if $smarty.session.is_family_member == 0}-->
                <dl>
                    <dt>部署</dt>
                    <dd>
                        <!--{if $arrErr.affiliation}--><div class="attention"><!--{$arrErr.affiliation}--></div><!--{/if}-->
                        <select name="affiliation" style="<!--{$arrErr.affiliation|sfGetErrorColor}-->">
                            <option value="" selected="selected">選択してください</option>
                            <!--{html_options options=$arrAffiliation selected=$arrForm.affiliation}-->
                        </select>
                    </dd>
                </dl>
		<!--{/if}-->
		<dl>
		    <dt><span>必須</span>マイナンバー</dt>
		    <dd>
			<!--{assign var=key1 value="mynumber01"}-->
			<!--{assign var=key2 value="mynumber02"}-->
			<!--{assign var=key3 value="mynumber03"}-->
			<!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
			<div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
			<!--{/if}-->
			<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" /> 
			<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" /> 
			<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="num4" />
		    </dd>
		</dl>
		<!--{if $smarty.session.is_family_member != 0}-->
		<dl>
		    <dt><span>必須</span>生年月日</dt>
		    <dd>
			<span class="attention"><!--{$arrErr.year}--></span>
			<select name="year" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
				<option value="" selected="selected">------</option>
			    <!--{html_options options=$arrYear selected=$arrForm.year}-->
			</select>年
			<select name="month" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
				<option value="" selected="selected">----</option>
			    <!--{html_options options=$arrMonth selected=$arrForm.month}-->
			</select>月
			<select name="day" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
				<option value="" selected="selected">----</option>
			    <!--{html_options options=$arrDay selected=$arrForm.day}-->
			</select>日
		    </dd>
		</dl>
		<dl>
                    <dt><span>必須</span>あなたとの続柄</dt>
                    <dd>
                        <!--{if $arrErr.relation_id}--><div class="attention"><!--{$arrErr.relation_id}--></div><!--{/if}-->
                        <select name="relation_id" style="<!--{$arrErr.relation_id|sfGetErrorColor}-->">
                            <option value="" selected="selected">選択してください</option>
                            <!--{html_options options=$arrRelation selected=$arrForm.relation_id}-->
                        </select>
                    </dd>
                </dl>
		<dl>
		    <dt>同居区分</dt>
		    <dd>
			<span class="attention"><!--{$arrErr.is_live_together}--></span>
			<input type="radio" name="is_live_together" value="1" id="yes" class="c_radio" <!--{if $arrForm.is_live_together eq 1}--> checked="checked" <!--{/if}--> /><label for="yes" class="c_radio"><span class="entry">同居</span></label> &nbsp; 
                        <input type="radio" name="is_live_together" value="0" id="no" class="c_radio" <!--{if $arrForm.is_live_together eq 0}--> checked="checked" <!--{/if}--> /><label for="no" class="c_radio"><span class="entry">別居</span></label>
		    </dd>
		</dl>
		<!--{/if}-->
		<dl>
		    <!--{assign var=key value="mynumber_image"}-->
		    <dt><span>必須</span>添付画像①<br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</dt>
		    <dd class="withAttn">
			<a name="_<!--{$key}-->"></a>
			<div class="attention"><!--{$arrErr[$key]}--></div>
			<!--{if $arrForm.arrFile[$key].filepath != ""}-->
			<img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->');
				return false;">[画像の取り消し]</a><br />
			<!--{/if}-->
			<input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
			<br /><br />
			<div style="padding: 10px; background-color: #EEE">
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
		</dl>
		<!--{if $smarty.session.mynumber_card != 0 || $smarty.session.is_family_member != 1}-->
		<dl>
		    <!--{assign var=key value="mynumber_image_back"}-->
		    <dt><span>必須</span>添付画像②<br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</dt>
		    <dd class="withAttn">
			<a name="_<!--{$key}-->"></a>
			<div class="attention"><!--{$arrErr[$key]}--></div>
			<!--{if $arrForm.arrFile[$key].filepath != ""}-->
			<img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->');
				return false;">[画像の取り消し]</a><br />
			<!--{/if}-->
			<input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
			<br /><br />
			<div style="padding: 10px; background-color: #EEE">
			    <p><u>アップロード画像の例:</u></p>
			    <!--{if $smarty.session.mynumber_card == 1}-->
			    <p class="mini">●個人番号カードの<span class="attention">裏面</span>の画像をアップロードしてください。</p>
			    <img src="/upload/mynumber_image/nocard_image2.png" alt="sample" />
			    <!--{else}-->
			    <p class="mini">●<span class="attention">身分証明書</span>（免許証、パスポート等のいずれか）の<span class="attention">裏面</span>の画像をアップロードしてください。</p>
			    <img src="/upload/mynumber_image/withcard_image2.png" alt="sample" />
			    <p class="mini">（パスポートの場合は通知カードの裏面のみで結構です）</p>
			    <!--{/if}-->
			</div>
		    </dd>
		</dl>
		<!--{/if}-->
		<p class="entry_form_navi">
		    <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">確認ページへ</span></button>
		</p>
	    </div>
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
		<p class="entry_form_navi">以下の内容でよろしいでしょうか？</p>
		<!--{if $smarty.session.is_family_member != 0}-->
		<dl>
		    <dt>従業員本人のマイナンバー</dt>
		    <dd><p class="entry_confirm"><!--{$arrForm.parent_mynumber01|h}--><!--{$arrForm.parent_mynumber02|h}--><!--{$arrForm.parent_mynumber03|h}--></p></dd>
		</dl>
		<!--{/if}-->
		<dl>
		    <dt><!--{if $smarty.session.is_family_member != 0}-->扶養家族の<!--{/if}-->お名前</dt>
		    <dd><p class="entry_confirm"><!--{$arrForm.name01|h}-->　<!--{$arrForm.name02|h}--></p></dd>
		</dl>
		<dl>
		    <dt>お名前(フリガナ)</dt>
		    <dd><p class="entry_confirm"><!--{$arrForm.kana01|h}-->　<!--{$arrForm.kana02|h}--></p></dd>
		</dl>
		<!--{if $smarty.session.is_family_member == 0}-->
		<dl>
		    <dt>部署</dt>
		    <dd><p class="entry_confirm"><!--{$arrAffiliation[$arrForm.affiliation]}--></p></dd>
		</dl>
		<!--{/if}-->
		<dl>
		    <dt>マイナンバー</dt>
		    <dd><p class="entry_confirm"><!--{$arrForm.mynumber01|h}--><!--{$arrForm.mynumber02|h}--><!--{$arrForm.mynumber03|h}--></p></dd>
		</dl>
		<!--{if $smarty.session.is_family_member != 0}-->
		<dl>
		    <dt>生年月日</dt>
		    <dd><p class="entry_confirm"><!--{$arrForm.year|h}-->年 <!--{$arrForm.month|h}-->月 <!--{$arrForm.day|h}-->日</p></dd>
		</dl>
		<dl>
		    <dt>あなたとの続柄</dt>
		    <dd><p class="entry_confirm"><!--{$arrRelation[$arrForm.relation_id]}--></p></dd>
		</dl>
		<dl>
		    <dt>同居区分</dt>
		    <dd><p class="entry_confirm"><!--{$arrIsLiveTogether[$arrForm.is_live_together]}--></p></dd>
		</dl>
		<!--{/if}-->
		<dl>
		    <dt>添付画像①</dt>
		    <dd>
			<!--{assign var=key value="mynumber_image"}-->
			<img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.mynumber|h}-->" />
		    </dd>
		</dl>
		<!--{if $smarty.session.mynumber_card != 0 || $smarty.session.is_family_member != 1}-->
		<dl>
		    <dt>添付画像②</dt>
		    <dd>
			<!--{assign var=key value="mynumber_image_back"}-->
			<img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.mynumber|h}-->" />
		    </dd>
		</dl>
		<!--{/if}-->
		<p class="entry_form_navi">
		    <button class="icon-btn icon-btn-mail-back" type="submit" href="?" onclick="fnModeSubmit('return', '', '');
			    return false;"><span class="icon-btn-text">戻る</span></button>
		    <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">送信</span></button>
		</p>    
	    </div>
	</form>

	<!--{else}-->
	<div class="caption_text">
	    <p>マイナンバー登録が完了いたしました。</p>
	    <p>ご協力ありがとうございました。</p>
	</div>
	<br />
	<h2><span>続けて<!--{if $isParent == 0}-->扶養家族のマイナンバー<!--{/if}-->登録<!--{if $isParent == 0}-->を行う<!--{/if}--></span></h2>
	<form name="form1" id="form1" method="post" action="regist.php">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="family_card_aru" />
	    <input type="hidden" name="parent_staff_id" value="<!--{$parent_staff_id}-->" />
	    <div class="btn_area">
		<ul>
		    <li><button class="linkBtn" onclick="fnModeSubmit('family_card_aru', '', ''); return false;">① 個人番号カードをお持ちの方はこちら</button></li>
		    <li style="text-align: left;"><button style="background-color: #2C72AF; line-height: normal;" class="linkBtn" onclick="fnModeSubmit('family_card_nai', '', ''); return false;">② 個人番号カードお持ちではない<br />（通知カードをお持ち）の方はこちら</button></li>
		</ul>
	    </div>
        </form>
	
	<!--{/if}-->
    </div>
</div>