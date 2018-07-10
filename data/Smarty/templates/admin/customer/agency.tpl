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

<script type="text/javascript">
<!--
    function fnReturn() {
        document.search_form.action = './agency_search.php';
        document.search_form.submit();
        return false;
    }
//-->
</script>

<form name="search_form" method="post" action="">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="search" />

    <!--{foreach from=$arrSearchData key="key" item="item"}-->
        <!--{if $key ne "agency_id" && $key ne "mode" && $key ne "edit_agency_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
            <!--{if is_array($item)}-->
                <!--{foreach item=c_item from=$item}-->
                    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
                <!--{/foreach}-->
            <!--{else}-->
                <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
            <!--{/if}-->
        <!--{/if}-->
    <!--{/foreach}-->
</form>

<form name="form1" id="form1" method="post" action="?" autocomplete="off">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="<!--{if $page == 'input'}-->confirm<!--{else}-->complete<!--{/if}-->" />
    <!--{assign var=key1 value="agency_id"}-->
    <input type="hidden" name="agency_id" value="<!--{$arrForm[$key1].value|h}-->" />

    <!-- 検索条件の保持 -->
    <!--{foreach from=$arrSearchData key="key" item="item"}-->
        <!--{if $key ne "agency_id" && $key ne "mode" && $key ne "edit_agency_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
            <!--{if is_array($item)}-->
                <!--{foreach item=c_item from=$item}-->
                    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
                <!--{/foreach}-->
            <!--{else}-->
                <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
            <!--{/if}-->
        <!--{/if}-->
    <!--{/foreach}-->

    <div id="customer" class="contents-main">
        <table class="form">
            <col width="30%" />
            <col width="70%" />
            <!--{assign var=key1 value="agency_id"}-->
            <!--{if $arrForm[$key1].value}-->
            <tr>
                <th>取引先ID<span class="attention"> *</span></th>
                <td><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <!--{/if}-->
            <tr>
                <th>取引先名</th>
                <td>
                    <!--{assign var=key1 value="agency_name"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>取引先名（カナ）</th>
                <td>
                    <!--{assign var=key1 value="agency_name_kana"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>取引先コード</th>
                <td>
                    <!--{assign var=key1 value="agency_code"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>代表者名</th>
                <td>
                    <!--{assign var=key1 value="agency_di_name01"}-->
                    <!--{assign var=key2 value="agency_di_name02"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div><!--{/if}-->
                    性 <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                    名 <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>役職</th>
                <td>
                    <!--{assign var=key1 value="official_position"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>ファーマプレミアムの担当者</th>
                <td>
                    <!--{assign var=key1 value="pp_tantousya"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>
                    <!--{assign var=key1 value="zip01"}-->
                    <!--{assign var=key2 value="zip02"}-->
                    <!--{assign var=key3 value="pref"}-->
                    <!--{assign var=key4 value="addr01"}-->
                    <!--{assign var=key5 value="addr02"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div><!--{/if}-->
                    <p class="top">〒&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.ZIP01_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.ZIP02_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;
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
                <th>本社住所</th>
                <td>
                    <!--{if $arrErr[$key3] || $arrErr[$key4] || $arrErr[$key5]}-->
                    <div class="attention"><!--{$arrErr[$key3]}--><!--{$arrErr[$key4]}--><!--{$arrErr[$key5]}--></div>
                    <!--{/if}-->
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <option value="" selected="selected">都道府県を選択</option>
                        <!--{html_options options=$arrPref selected=$arrForm[$key3].value}-->
                    </select>
                    <p class="top"><input type="text" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|h}-->" style="<!--{$arrErr[$key4]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" /><br /><!--{$smarty.const.SAMPLE_ADDRESS1}--></p>
                    <p class="top"><input type="text" name="<!--{$key5}-->" value="<!--{$arrForm[$key5].value|h}-->" style="<!--{$arrErr[$key5]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" /><br /><!--{$smarty.const.SAMPLE_ADDRESS2}--></p>
                    <p class="mini"><span class="attention">住所は2つに分けてご記入ください。マンション名は必ず記入してください。</span></p>
                </td>
            </tr>
            <tr>
                <th>TEL</th>
                <td>
                    <!--{assign var=key1 value="tel01"}-->
                    <!--{assign var=key2 value="tel02"}-->
                    <!--{assign var=key3 value="tel03"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>FAX</th>
                <td>
                    <!--{assign var=key1 value="fax01"}-->
                    <!--{assign var=key2 value="fax02"}-->
                    <!--{assign var=key3 value="fax03"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}--><div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>支払条件等</th>
                <td>
                    <!--{assign var=key1 value="payment_terms"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>メモ</th>
                <td>
                    <!--{assign var=key1 value="memo"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <textarea name="<!--{$key1}-->" cols="60" rows="8" class="area60" maxlength="99999"><!--{$arrForm[$key1].value|h}--></textarea>
                </td>
            </tr>			
        </table>

        <div class="btn-area">
            <ul>
                <!--{if $smarty.session.authority != 2}--><li><a class="btn-action" href="javascript:;" onclick="return fnReturn();"><span class="btn-prev">検索画面に戻る</span></a></li><!--{/if}-->
                <li>
                    <a class="btn-action" href="javascript:;" onclick="fnSetFormSubmit('form1', 'mode', 'confirm');return false;">
                        <span class="btn-next">確認ページへ</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</form>