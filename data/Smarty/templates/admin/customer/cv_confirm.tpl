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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
*}-->

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
<!--
self.moveTo(20,20);self.focus();
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

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach from=$arrForm key=key item=item}-->
            <!--{if $key ne "mode" && $key ne "subm"}-->
            <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
            <!--{/if}-->
        <!--{/foreach}-->

 
		平成<!--{$arrForm.c_year|h}-->年
		<!--{$arrForm.c_month|h}-->月
		<!--{$arrForm.c_day|h}-->日現在

		<table summary="会員登録内容変更 " class="delivname">
            <col width="20%" />
            <col width="60%" />
            <col width="20%" />
            <tr>
		        <th>ふりがな</th>
				<td><!--{$arrForm.kana01|h}--> <!--{$arrForm.kana02|h}--></td>
				<td rowspan="3"><img alt="" src="../../upload/cv_file/<!--{$arrForm.photo|h}-->" /></td>
	    	</tr>
	    	<tr>
		        <th>氏  名</th>
				<td><!--{$arrForm.name01|h}--> <!--{$arrForm.name02|h}--></td>
	        </tr>
            <tr>
                <th>昭和</th>
                <td><!--{if strlen($arrForm.year) > 0 && strlen($arrForm.month) > 0 && strlen($arrForm.day) > 0}--><!--{$arrForm.year|h}-->年<!--{$arrForm.month|h}-->月<!--{$arrForm.day|h}-->日<!--{else}-->未登録<!--{/if}--> / <!--{$arrAge[$arrForm.age]|h}-->歳 / <!--{$arrSex[$arrForm.sex]|h}--></td>
            </tr>
            <tr class="seperateRow">
	        	<th>ふりがな</th>
				<td colspan="2"><!--{$arrForm.kana_addr01|h}--></td>
	    	</tr>
            <tr>
                <th>郵便番号</th>
                <td colspan="2">〒&nbsp;<!--{$arrForm.zip01}-->-<!--{$arrForm.zip02}--></td>
            </tr>
            <tr>
                <th>現 住 所</th>
                <td colspan="2"><!--{$arrPref[$arrForm.pref]}--><!--{$arrForm.addr01|h}--><!--{$arrForm.addr02|h}--></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td colspan="2"><!--{$arrForm.email|escape:'hexentity'}--></td>
            </tr>
            <tr>
                <th>自宅電話</th>
                <td colspan="2"><!--{$arrForm.tel11|h}-->-<!--{$arrForm.tel12}-->-<!--{$arrForm.tel13}--></td>
            </tr>
            <tr>
                <th>携帯電話</th>
                <td colspan="2"><!--{$arrForm.tel01|h}-->-<!--{$arrForm.tel02}-->-<!--{$arrForm.tel03}--></td>
            </tr>
            <tr class="seperateRow">
		        <th>ふりがな</th>
				<td colspan="2"><!--{$arrForm.kana_addr02|h}--></td>
		    </tr>
            <tr>
                <th>連 絡 先 </th>
                <td colspan="2">（現住所以外に連絡を希望する場合のみ記入）<br><!--{$arrForm.addr03|h}--></td>
            </tr>
            <tr>
                <th>連絡先電話</th>
                <td colspan="2"><!--{$arrForm.tel21|h}-->-<!--{$arrForm.tel22}-->-<!--{$arrForm.tel23}--></td>
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
                <td><!--{assign var=key1 value="ec_y`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
                <td><!--{assign var=key1 value="ec_m`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
                <td><!--{assign var=key1 value="ec`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
            </tr>
            <!--{/section}-->
        </table>


        <table summary="会員登録内容変更 " class="delivname">
            <tr><th>自己PR</th></tr>
            <tr><td><!--{$arrForm.prself|h}--></td></tr>
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
                <td><!--{assign var=key1 value="license_y`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
                <td><!--{assign var=key1 value="license_m`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
                <td><!--{assign var=key1 value="license`$sub_no`"}--><!--{$arrForm[$key1]|h}--></td>
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
				<td>約	<!--{$arrHOUR[$arrForm.commuting_hour]}--> 時間 
					<!--{$arrMINUTE[$arrForm.commuting_minute]}--> 分
				</td>
	    	</tr>
            <tr>
                <td rowspan="3"><!--{$arrForm.mo_sk_fa|h}--></td>
				<th>扶養家族（配偶者を除く）</th>
				<td><!--{$arrPEOPLECOUNT[$arrForm.dependent]}--> 人</td>
	    	</tr>
            <tr>
				<th>配偶者</th>
				<td><!--{$arrFLAG[$arrForm.spouse]}--></td>
			</tr>
            <tr>
				<th>配偶者の扶養義務</th>
				<td><!--{$arrFLAG[$arrForm.support_spouse]}--></td>
	    	</tr>
        </table>


        <table summary="会員登録内容変更 " class="delivname">
            <tr><th>本人希望記入欄（特に給料・職種・勤務時間・勤務地・その他について希望などがあれば記入）</th></tr>
            <tr><td><!--{$arrForm.p_hope|h}--></td></tr>
        </table>


        <div class="btn-area" style="width: 95%;">
            <ul>
                <li>
                    <a href="?" onclick="fnModeSubmit('return', '', ''); return false;" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg','back');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg','back');">
                        <img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" name="back" id="back" /></a>
                </li>
                <li>
                    <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete_on.gif',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg" alt="送信" name="complete" id="complete" />
                </li>	
            </ul>
        </div>

        </form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
