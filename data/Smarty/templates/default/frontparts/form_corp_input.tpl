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

<h2 class="title" id="form_title">お申し込み・お問い合わせはこちらからどうぞ</h2>
<table>
    <col width="30%" />
    <col width="70%" />
    <tr>
        <th>企業名<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`corporate_name"}-->
            <!--{if $arrErr[$key1]}-->
            <div class="attention"><!--{$arrErr[$key1]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
        </td>
    </tr>
    <tr>
        <th>ご担当者部署名</th>
        <td>
            <!--{assign var=key1 value="`$prefix`person_unit"}-->
            <!--{if $arrErr[$key1]}-->
            <div class="attention"><!--{$arrErr[$key1]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box300" />
        </td>
    </tr>
    <tr>
        <th>ご担当者名<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`charge_firstname"}-->
            <!--{assign var=key2 value="`$prefix`charge_lastname"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
            <!--{/if}-->
            姓&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
     　 名&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
        </td>
    </tr>
    <tr>
        <th>ご担当者名（カナ）<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`charge_firstname_kana"}-->
            <!--{assign var=key2 value="`$prefix`charge_lastname_kana"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
            <!--{/if}-->
            セイ&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
     　 メイ&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
        </td>
    </tr>
    <tr>
        <th>郵便番号<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`zip_code1"}-->
            <!--{assign var=key2 value="`$prefix`zip_code2"}-->
            <!--{assign var=key3 value="`$prefix`pref"}-->
            <!--{assign var=key4 value="`$prefix`addr1"}-->
            <!--{assign var=key5 value="`$prefix`addr2"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
            <!--{/if}-->
            <p class="top">〒&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.ZIP01_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.ZIP02_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;
                <a href="http://search.post.japanpost.jp/zipcode/" target="_blank"><span class="mini">郵便番号検索</span></a>
            </p>
            <p class="zipimg">
                <a href="<!--{$smarty.const.ROOT_URLPATH}-->input_zip.php" onclick="fnCallAddress('<!--{$smarty.const.INPUT_ZIP_URLPATH}-->', '<!--{$key1}-->', '<!--{$key2}-->', '<!--{$key3}-->', '<!--{$key4}-->');
                        return false;" target="_blank">
                    <img src="<!--{$TPL_URLPATH}-->img/button/btn_address_input.jpg" alt="住所自動入力" /></a>
                &nbsp;<span class="mini">郵便番号を入力後、クリックしてください。</span>
            </p>
        </td>
    </tr>
    <tr>
        <th>ご住所<span class="attention">※</span></th>
        <td>
            <!--{if $arrErr[$key3] || $arrErr[$key4] || $arrErr[$key5]}-->
            <div class="attention"><!--{$arrErr[$key3]}--><!--{$arrErr[$key4]}--><!--{$arrErr[$key5]}--></div>
            <!--{/if}-->
            <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                <option value="" selected="selected">都道府県を選択</option>
                <!--{html_options options=$arrPref selected=$arrForm[$key3].value}-->
            </select>
            <p class="top"><input type="text" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|h}-->" class="box300" style="<!--{$arrErr[$key4]|sfGetErrorColor}-->; ime-mode: active;" /><br />
                <!--{$smarty.const.SAMPLE_ADDRESS1}--></p>
            <p class="top"><input type="text" name="<!--{$key5}-->" value="<!--{$arrForm[$key5].value|h}-->" class="box300" style="<!--{$arrErr[$key5]|sfGetErrorColor}-->; ime-mode: active;" /><br />
                <!--{$smarty.const.SAMPLE_ADDRESS2}--></p>
            <p class="mini"><span class="attention">住所は2つに分けてご記入ください。マンション名は必ず記入してください。</span></p>
        </td>
    </tr>
    <tr>
        <th>ご連絡先電話番号<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`tel1"}-->
            <!--{assign var=key2 value="`$prefix`tel2"}-->
            <!--{assign var=key3 value="`$prefix`tel3"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
        </td>
    </tr>
    <tr>
        <th>ご連絡先FAX番号</th>
        <td>
            <!--{assign var=key1 value="`$prefix`fax1"}-->
            <!--{assign var=key2 value="`$prefix`fax2"}-->
            <!--{assign var=key3 value="`$prefix`fax3"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
        </td>
    </tr>
    <tr>
        <th>メールアドレス<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`email_add"}-->
            <!--{assign var=key2 value="`$prefix`email_add_repeat"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box300 top" /><br />
            <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" style="<!--{$arrErr[$key1]|cat:$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box300" /><br />
            <span class="attention mini">確認のため2度入力してください。</span>
        </td>
    </tr>
    <!--{if $emailMobile}-->
    <tr>
        <th>携帯メールアドレス</th>
        <td>
            <!--{assign var=key1 value="`$prefix`email_mobile"}-->
            <!--{assign var=key2 value="`$prefix`email_mobile02"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
            <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" maxlength="<!--{$smarty.const.MTEXT_LEN}-->" class="box300 top" /><br />
            <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" style="<!--{$arrErr[$key1]|cat:$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" maxlength="<!--{$smarty.const.MTEXT_LEN}-->" class="box300" /><br />
            <span class="attention mini">確認のため2度入力してください。</span>
        </td>
    </tr>
    <!--{/if}-->
    <tr>
        <th>お探しの人材</th>
        <td>
            <!--{assign var=key1 value="`$prefix`recruitment_detail"}-->
            <!--{if $arrErr[$key1]}-->
            <div class="attention"><!--{$arrErr[$key1]}--></div>
            <!--{/if}-->
            <!--{html_checkboxes name="recruitment_detail" options=$arrEMPSTATUS separator='&nbsp;' selected=$arrForm[$key1].value}-->
        </td>
    </tr>
    <tr>
        <th>人数、スキルなど求人の要件</th>
        <td>
            <!--{assign var=key1 value="`$prefix`skill"}-->
            <!--{if $arrErr[$key1]}-->
            <div class="attention"><!--{$arrErr[$key1]}--></div>
            <!--{/if}-->
            <textarea name="<!--{$key1}-->" style="width: 100%" rows="8" class="area60" maxlength="99999"><!--{$arrForm[$key1].value|h}--></textarea>
            倉庫でのピッキング業務担当者を2名、経験者を希望<br>食品製造業務の夜勤担当者を10名、未経験可　など
        </td>
    </tr>
    <tr>
        <th>その他、ご質問など</th>
        <td>
            <!--{assign var=key1 value="`$prefix`other_q"}-->
            <!--{if $arrErr[$key1]}-->
            <div class="attention"><!--{$arrErr[$key1]}--></div>
            <!--{/if}-->
            <textarea name="<!--{$key1}-->" style="width: 100%" rows="8" class="area60" maxlength="99999"><!--{$arrForm[$key1].value|h}--></textarea>
        </td>
    </tr>
</table>

<div class="btn_area">
    <ul>
        <li>
            <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm_on.jpg', this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg', this)" src="<!--{$TPL_URLPATH}-->img/button/btn_confirm.jpg" alt="" name="confirm" id="confirm" />
        </li>
    </ul>
</div>