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

<div id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <div id="mycontents_area">
        <h3><!--{$tpl_subtitle|h}--></h3>
        <p>下記項目にご入力ください。「<span class="attention">※</span>」印は入力必須項目です。<br />
            入力後、一番下の「確認ページへ」ボタンをクリックしてください。</p>

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
        <input type="hidden" name="customer_id" value="<!--{$arrForm.customer_id|h}-->" />
        <table summary="会員登録内容変更 " class="delivname">
            <col width="30%" />
            <col width="70%" />
            <tr>
                <th>銀行名<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="bank"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
                </td>
            </tr>
            <tr>
                <th>銀行支店名<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="bank_branch"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
                </td>
            </tr>
            <tr>
                <th>金融機関コード<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="bank_code"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
                </td>
            </tr>
            <tr>
                <th>支店番号<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="branch_code"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
                </td>
            </tr>
            <tr>
                <th>口座名義<span class="attention">※</span><br>（通帳記載のカナ名義で正しくご記入ください。）</th>
                <td>
                <!--{assign var=key1 value="account_holder1"}-->
                <!--{assign var=key2 value="account_holder2"}-->
                <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" /> &nbsp; 
<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
                </td>
            </tr>
            <tr>
                <th>預金種目<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="event_deposit"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
                <!--{html_radios options=$arrFLAG name=$key1 sepeartor=" &nbsp; &nbsp; " selected=$arrForm[$key1]}-->
                </td>
            </tr>
            <tr>
                <th>口座番号<span class="attention">※</span></th>
                <td>
                <!--{assign var=key1 value="account_number"}-->
                <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                <!--{/if}-->
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
                </td>
            </tr>
        </table>
        <div class="btn_area">
            <ul>
                <li>
                    <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg" alt="確認ページへ" name="refusal" id="refusal" />
                </li>
            </ul>
        </div>
        </form>
    </div>
</div>
