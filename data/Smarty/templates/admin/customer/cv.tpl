<!--{*
/*
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA    02111-1307, USA.
 */
*}-->

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
<!--
self.moveTo(20,20);self.focus();

function func_del_photo() {
    document.form1.mode.value = "delete_photo";
    document.form1.submit();
}

//-->
</script>
<link rel="stylesheet" href="<!--{$TPL_URLPATH}-->css/table.css" type="text/css" media="all" />
<link rel="stylesheet" href="<!--{$TPL_URLPATH}-->css/common.css" type="text/css" media="all" />
<style>
#popup-container {
    padding: 0 20px;
    width: 100%;
}
table.delivname{
	width: 690px;
	margin: 0 0 20px 0;
}
</style>

<!--▼検索フォーム-->
<form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="confirm" />
<input type="hidden" name="customer_id" value="<!--{$arrForm.customer_id|h}-->" />

		<!--{assign var=errDateC value="`$arrErr.c_year``$arrErr.c_month``$arrErr.c_day`"}-->
		<!--{if $errDateC}-->
			<div class="attention"><!--{$errDateC}--></div>
		<!--{/if}-->
		平成<select name="c_year" style="<!--{$errDate|sfGetErrorColor}-->">
			<!--{html_options options=$arrYearC selected=$arrForm.c_year|default:$todayYear}-->
		</select>年
		<select name="c_month" style="<!--{$errDate|sfGetErrorColor}-->">
			<!--{html_options options=$arrMonthC selected=$arrForm.c_month|default:$todayMonth}-->
		</select>月
		<select name="c_day" style="<!--{$errDate|sfGetErrorColor}-->">
			<!--{html_options options=$arrDayC selected=$arrForm.c_day|default:$todayDay}-->
		</select>日現在<br>


        <table summary="会員登録内容変更 " class="delivname">
            <col width="20%" />
            <col width="45%" />
            <col width="35%" />
            <tr>
		        <th>ふりがな</th>
				<td>
				    <!--{assign var=key1 value="kana01"}-->
				    <!--{assign var=key2 value="kana02"}-->
				    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
				        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
				    <!--{/if}-->
				    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
				    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
				</td>
				<td rowspan="3" style="font-size: 90%; line-height: 12px;">
					<!--{if $arrForm.photo != ''}--><img alt="" src="../../upload/cv_file/<!--{$arrForm.photo|h}-->" /> <a href="#" onclick="return func_del_photo();">削除</a><br><!--{/if}-->
					写真サイズ: タテ４cm, ヨコ３cm<br>写真データ(JPEG)登録する事もできます。<input type="file" name="photo" id="photo">
				</td>
	    	</tr>
	    	<tr>
		        <th>氏  名</th>
				<td>
				    <!--{assign var=key1 value="name01"}-->
				    <!--{assign var=key2 value="name02"}-->
				    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
				        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
				    <!--{/if}-->
				    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
				    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
				</td>
	        </tr>
            <tr>
                <th>昭和</th>
                <td>
                    <!--{assign var=errBirth value="`$arrErr.year``$arrErr.month``$arrErr.day`"}-->
                    <!--{if $errBirth}-->
                        <div class="attention"><!--{$errBirth}--></div>
                    <!--{/if}-->
                    <select name="year" style="<!--{$errBirth|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm.year|default:''}-->
                    </select>年
                    <select name="month" style="<!--{$errBirth|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm.month|default:''}-->
                    </select>月
                    <select name="day" style="<!--{$errBirth|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm.day|default:''}-->
                    </select>日生<br>
                    （満 <select name="age">
						<option value=""></option>
                        <!--{html_options options=$arrAge selected=$arrForm.age|default:''}-->
                    </select> 歳） 
					<select name="sex">
						<option value=""></option>
                        <!--{html_options options=$arrSex selected=$arrForm.sex|default:''}-->
                    </select>
                </td>
            </tr>
            <tr class="seperateRow">
	        	<th>ふりがな</th>
				<td colspan="2">
				    <!--{assign var=key1 value="kana_addr01"}-->
				    <!--{if $arrErr[$key1]}-->
				        <div class="attention"><!--{$arrErr[$key1]}--></div>
				    <!--{/if}-->
				    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box380" />
				</td>
	    	</tr>
            <tr>
                <th>郵便番号</th>
                <td colspan="2">
                    <!--{assign var=key1 value="zip01"}-->
                    <!--{assign var=key2 value="zip02"}-->
                    <!--{assign var=key3 value="pref"}-->
                    <!--{assign var=key4 value="addr01"}-->
                    <!--{assign var=key5 value="addr02"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    <p class="top">〒&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.ZIP01_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.ZIP02_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;
                    </p>
                    <p class="zipimg">
                        <a href="<!--{$smarty.const.ROOT_URLPATH}-->input_zip.php" onclick="fnCallAddress('<!--{$smarty.const.INPUT_ZIP_URLPATH}-->', '<!--{$key1}-->', '<!--{$key2}-->', '<!--{$key3}-->', '<!--{$key4}-->'); return false;" target="_blank">
                            <img src="<!--{$TPL_URLPATH}-->img/button/btn_address_input.jpg" alt="住所自動入力" /></a>
                    </p>
                </td>
            </tr>
            <tr>
                <th>現 住 所</th>
                <td colspan="2">
                    <!--{if $arrErr[$key3] || $arrErr[$key4] || $arrErr[$key5]}-->
                        <div class="attention"><!--{$arrErr[$key3]}--><!--{$arrErr[$key4]}--><!--{$arrErr[$key5]}--></div>
                    <!--{/if}-->
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <option value="" selected="selected">都道府県を選択</option>
                        <!--{html_options options=$arrPref selected=$arrForm[$key3]}-->
                    </select>
                    <p class="top"><input type="text" name="<!--{$key4}-->" value="<!--{$arrForm[$key4]|h}-->" class="box300" style="<!--{$arrErr[$key4]|sfGetErrorColor}-->; ime-mode: active;" /></p>
                    <p class="top"><input type="text" name="<!--{$key5}-->" value="<!--{$arrForm[$key5]|h}-->" class="box300" style="<!--{$arrErr[$key5]|sfGetErrorColor}-->; ime-mode: active;" /></p>
                </td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td colspan="2">
                    <!--{assign var=key1 value="email"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box300 top" /><br />
                </td>
            </tr>
            <tr>
                <th>自宅電話</th>
                <td colspan="2">
                    <!--{assign var=key1 value="tel11"}-->
                    <!--{assign var=key2 value="tel12"}-->
                    <!--{assign var=key3 value="tel13"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
                </td>
            </tr>
            <tr>
                <th>携帯電話</th>
                <td colspan="2">
                    <!--{assign var=key1 value="tel01"}-->
                    <!--{assign var=key2 value="tel02"}-->
                    <!--{assign var=key3 value="tel03"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
                </td>
            </tr>
            <tr class="seperateRow">
		        <th>ふりがな</th>
				<td colspan="2">
				    <!--{assign var=key1 value="kana_addr02"}-->
				    <!--{if $arrErr[$key1]}-->
				        <div class="attention"><!--{$arrErr[$key1]}--></div>
				    <!--{/if}-->
				    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box380" />
				</td>
		    </tr>
            <tr>
                <th>連 絡 先 </th>
                <td colspan="2">（現住所以外に連絡を希望する場合のみ記入）<br>
                    <!--{assign var=key1 value="addr03"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <p class="top"><input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" class="box300" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" /></p>
                </td>
            </tr>
            <tr>
                <th>連絡先電話</th>
                <td colspan="2">
                    <!--{assign var=key1 value="tel21"}-->
                    <!--{assign var=key2 value="tel22"}-->
                    <!--{assign var=key3 value="tel23"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
                </td>
            </tr>
        </table>


		<table summary="会員登録内容変更 " class="delivname">
            <col width="20%" />
            <col width="10%" />
            <col width="70%" />
            <tr>
		        <th class="alignC">年</th>
		        <th class="alignC">月</th>
		        <th class="alignC">学歴・職歴（各別にまとめて書く）</th>
	    	</tr>
            <!--{section name=cnt loop=17}-->
	    	<!--{assign var=sub_no value="`$smarty.section.cnt.iteration`"}-->
            <tr>
                <td>
                    <!--{assign var=key1 value="ec_y`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box100 top" /><br />
                </td>
                <td>
                    <!--{assign var=key1 value="ec_m`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box40 top" /><br />
                </td>
                <td>
                    <!--{assign var=key1 value="ec`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box380 top" /><br />
                </td>
            </tr>
            <!--{/section}-->
        </table>


        <table summary="会員登録内容変更 " class="delivname">
            <tr>
	        	<th>自己PR</th>
	    	</tr>
            <tr>
                <td>
                    <!--{assign var=key1 value="prself"}-->
                    <textarea cols="100" rows="20" name="<!--{$key1}-->"><!--{$arrForm[$key1]|h}--></textarea>
                </td>
            </tr>
        </table>


        <table summary="会員登録内容変更 " class="delivname">
            <col width="20%" />
            <col width="10%" />
            <col width="70%" />
            <tr>
	        	<th class="alignC">年</th>
	        	<th class="alignC">月</th>
	        	<th class="alignC">免許・資格</th>
	    	</tr>
            <!--{section name=cnt loop=7}-->
	    	<!--{assign var=sub_no value="`$smarty.section.cnt.iteration`"}-->
            <tr>
                <td>
                    <!--{assign var=key1 value="license_y`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box100 top" /><br />
                </td>
                <td>
                    <!--{assign var=key1 value="license_m`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box40 top" /><br />
                </td>
                <td>
                    <!--{assign var=key1 value="license`$sub_no`"}-->
                    <!--{if $arrErr[$key1]}-->
                        <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box380 top" /><br />
                </td>
            </tr>
            <!--{/section}-->
        </table>


		<table summary="会員登録内容変更 " class="delivname">
            <col width="49%" />
            <col width="25%" />
            <col width="26%" />
            <tr>
	        	<th>志望動機、特技、好きな学科など</th>
				<th>通勤時間</th>
				<td>約
					<select name="commuting_hour">
						<option value=""></option>
						<!--{html_options options=$arrHOUR selected=$arrForm.commuting_hour|default:''}-->
					</select> 時間 
					<select name="commuting_minute">
						<option value=""></option>
						<!--{html_options options=$arrMINUTE selected=$arrForm.commuting_minute|default:''}-->
					</select> 分
				</td>
	    	</tr>
            <tr>
                <td rowspan="3">
                    <!--{assign var=key1 value="mo_sk_fa"}-->
                    <textarea cols="45" rows="6" name="<!--{$key1}-->"><!--{$arrForm[$key1]|h}--></textarea>
                </td>
				<th>扶養家族（配偶者を除く）</th>
				<td>
					<select name="dependent">
						<option value=""></option>
						<!--{html_options options=$arrPEOPLECOUNT selected=$arrForm.dependent|default:''}-->
					</select> 人
				</td>
	    	</tr>
            <tr>
				<th>配偶者</th>
				<td>
					<select name="spouse">
						<option value=""></option>
						<!--{html_options options=$arrFLAG selected=$arrForm.spouse|default:''}-->
					</select>
				</td>
			</tr>
            <tr>
				<th>配偶者の扶養義務</th>
				<td>
					<select name="support_spouse">
						<option value=""></option>
						<!--{html_options options=$arrFLAG selected=$arrForm.support_spouse|default:''}-->
					</select>
				</td>
	    	</tr>
        </table>


        <table summary="会員登録内容変更 " class="delivname">
            <tr>
	        	<th>本人希望記入欄（特に給料・職種・勤務時間・勤務地・その他について希望などがあれば記入）</th>
	    	</tr>
            <tr>
                <td>
                    <!--{assign var=key1 value="p_hope"}-->
                    <textarea cols="100" rows="10" name="<!--{$key1}-->"><!--{$arrForm[$key1]|h}--></textarea>
                </td>
            </tr>
        </table>


<div class="btn-area" style="width: 95%;">
    <ul>
        <li><input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg" alt="確認ページへ" name="refusal" id="refusal" /></li>
    </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
