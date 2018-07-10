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

<table>
    <col width="30%" />
    <col width="70%" />
    <tr>
        <th>企業名</th>
        <td>
            <!--{assign var=key1 value="`$prefix`corporate_name"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
        </td>
    </tr>
    <tr>
        <th>ご担当者部署名</th>
        <td>
            <!--{assign var=key1 value="`$prefix`person_unit"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
        </td>
    </tr>
    <tr>
        <th>ご担当者名</th>
        <td>
            <!--{assign var=key1 value="`$prefix`charge_firstname"}-->
            <!--{assign var=key2 value="`$prefix`charge_lastname"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}--> <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->
        </td>
    </tr>
    <tr>
        <th>ご担当者名（カナ）</th>
        <td>
            <!--{assign var=key1 value="`$prefix`charge_firstname_kana"}-->
            <!--{assign var=key2 value="`$prefix`charge_lastname_kana"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}--> <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->
        </td>
    </tr>
    <tr>
        <th>郵便番号</th>
        <td>
            <!--{assign var=key1 value="`$prefix`zip_code1"}-->
            <!--{assign var=key2 value="`$prefix`zip_code2"}-->
            〒<input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->&nbsp;
        </td>
    </tr>
    <tr>
        <th>ご住所</th>
        <td>
            <!--{assign var=key3 value="`$prefix`pref"}-->
            <!--{assign var=key4 value="`$prefix`addr1"}-->
            <!--{assign var=key5 value="`$prefix`addr2"}-->
            <!--{assign var=key1 value="`$arrForm[$key3].value`"}-->
            <input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrPref[$key1]}--><br />
            <input type="hidden" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|h}-->" /><!--{$arrForm[$key4].value|h}--><br />
            <input type="hidden" name="<!--{$key5}-->" value="<!--{$arrForm[$key5].value|h}-->" /><!--{$arrForm[$key5].value|h}--><br />
        </td>
    </tr>
    <tr>
        <th>ご連絡先電話番号</th>
        <td>
            <!--{assign var=key1 value="`$prefix`tel1"}-->
            <!--{assign var=key2 value="`$prefix`tel2"}-->
            <!--{assign var=key3 value="`$prefix`tel3"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->-<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrForm[$key3].value|h}-->
        </td>
    </tr>
    <tr>
        <th>ご連絡先FAX番号</th>
        <td>
            <!--{assign var=key1 value="`$prefix`fax1"}-->
            <!--{assign var=key2 value="`$prefix`fax2"}-->
            <!--{assign var=key3 value="`$prefix`fax3"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->-<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrForm[$key3].value|h}-->
        </td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>
            <!--{assign var=key1 value="`$prefix`email_add"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
        </td>
    </tr>
    <!--{if $emailMobile}-->
    <tr>
        <th>携帯メールアドレス</th>
        <td>
            <!--{assign var=key1 value="`$prefix`email_mobile"}-->
            <!--{assign var=key2 value="`$prefix`email_mobile02"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}--><br />
            <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}--><br />
        </td>
    </tr>
    <!--{/if}-->
    <tr>
        <th>お探しの人材</th>
        <td>
            <!--{assign var=key1 value="`$prefix`recruitment_detail"}-->
            <!--{foreach from=$arrForm[$key1].value item=status}-->
            <input type="hidden" name="<!--{$key1}-->[]" value="<!--{$status|h}-->" />
            <!--{$arrEMPSTATUS.$status}--> &nbsp; 
            <!--{/foreach}-->
        </td>
    </tr>
    <tr>
        <th>人数、スキルなど求人の要件</th>
        <td>
            <!--{assign var=key1 value="`$prefix`skill"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
        </td>
    </tr>
    <tr>
        <th>その他、ご質問など</th>
        <td>
            <!--{assign var=key1 value="`$prefix`other_q"}-->
            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
        </td>
    </tr>

</table>

<div class="btn_area">
    <ul>
        <li>
            <a href="#" onclick="fnModeSubmit('return', '', ''); return false;" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg', 'back')" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg', 'back')"><img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="" border="0" name="back" id="back" /></a>
        </li>
        <li>
            <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete_on.gif', this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg', this)" src="<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg" alt="" name="complete" id="complete" />
        </li>
    </ul>
</div>