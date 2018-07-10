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
        <th>希望会場<span class="attention">※</span></th>
        <td>
            <!--{if $arrErr.office}--><div class="attention"><!--{$arrErr.office}--></div><!--{/if}-->
            <!--{html_radios name="office" options=$arrOffice selected=$arrForm.office}-->
        </td>
    </tr>
    <tr>
        <th>希望日時<span class="attention">※</span></th>
        <td>
            <!--{if $arrErr.note}--><div class="attention"><!--{$arrErr.note}--></div><!--{/if}-->
            <textarea name="note" rows="3" style="<!--{$arrErr.note|sfGetErrorColor}-->; ime-mode: active; width: 100%"><!--{$arrForm.note}--></textarea>
            <p class="mini">例）○月○日○時を希望<br>
　月曜～金曜日　16時以降なら可<br>
　月、火は午前中のみ。それ以外は終日可　　など</p>
        </td>
    </tr>
    <tr>
        <th>お名前<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`name01"}-->
            <!--{assign var=key2 value="`$prefix`name02"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div><!--{/if}-->
            姓&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h|default:$arrData.name01|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />&nbsp;
            名&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h|default:$arrData.name02|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
        </td>
    </tr>
    <tr>
        <th>お名前(フリガナ)<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`kana01"}-->
            <!--{assign var=key2 value="`$prefix`kana02"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div><!--{/if}-->
            セイ&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h|default:$arrData.kana01|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />&nbsp;
            メイ&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h|default:$arrData.kana02|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" class="box120" />
        </td>
    </tr>
    <tr>
        <th>電話番号<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`tel01"}-->
            <!--{assign var=key2 value="`$prefix`tel02"}-->
            <!--{assign var=key3 value="`$prefix`tel03"}-->
            <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
            <div class="attention">※ お電話番号が入力されていません。</div>
            <!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h|default:$arrData.tel01|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;
            <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2]|h|default:$arrData.tel02|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />&nbsp;-&nbsp;
            <input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3]|h|default:$arrData.tel03|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" class="box60" />
        </td>
    </tr>
    <tr>
        <th>メールアドレス<span class="attention">※</span></th>
        <td>
            <!--{assign var=key1 value="`$prefix`email"}-->
            <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
            <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h|default:$arrData.email|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" class="box300 top" />
        </td>
    </tr>
</table>