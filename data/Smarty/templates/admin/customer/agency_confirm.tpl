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

    function func_return() {
        document.form1.mode.value = "return";
        document.form1.submit();
    }

//-->
</script>


<form name="form1" id="form1" method="post" action="?">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="complete" />

    <!--{foreach from=$arrForm key=key item=item}-->
    <!--{if $key ne "mode" && $key ne "subm" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
    <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item.value|h}-->" />
    <!--{/if}-->
    <!--{/foreach}-->

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
                    <!--{assign var=key1 value="agency_name"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>取引先名（カナ）</th>
                <td>
                    <!--{assign var=key1 value="agency_name_kana"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>取引先コード</th>
                <td>
                    <!--{assign var=key1 value="agency_code"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>代表者名</th>
                <td>
                    <!--{assign var=key1 value="agency_di_name01"}-->
                    <!--{assign var=key2 value="agency_di_name02"}-->
                    <!--{$arrForm[$key1].value|h}--> <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>役職</th>
                <td>
                    <!--{assign var=key1 value="official_position"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>ファーマプレミアムの担当者</th>
                <td>
                    <!--{assign var=key1 value="pp_tantousya"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>
                    <!--{assign var=key1 value="zip01"}-->
                    <!--{assign var=key2 value="zip02"}-->
                    〒<!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->&nbsp;
                </td>
            </tr>
            <tr>
                <th>本社住所</th>
                <td>
                    <!--{assign var=key3 value="pref"}-->
                    <!--{assign var=key4 value="addr01"}-->
                    <!--{assign var=key5 value="addr02"}-->
                    <!--{assign var=key1 value="`$arrForm[$key3].value`"}-->
                    <!--{$arrPref[$key1]}--><br />
                    <!--{$arrForm[$key4].value|h}--><br />
                    <!--{$arrForm[$key5].value|h}--><br />
                </td>
            </tr>
            <tr>
                <th>TEL</th>
                <td>
                    <!--{assign var=key1 value="tel01"}-->
                    <!--{assign var=key2 value="tel02"}-->
                    <!--{assign var=key3 value="tel03"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>FAX</th>
                <td>
                    <!--{assign var=key1 value="fax01"}-->
                    <!--{assign var=key2 value="fax02"}-->
                    <!--{assign var=key3 value="fax03"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>支払条件等</th>
                <td>
                    <!--{assign var=key1 value="payment_terms"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
            <tr>
                <th>メモ</th>
                <td>
                    <!--{assign var=key1 value="memo"}--><!--{$arrForm[$key1].value|h}-->
                </td>
            </tr>
        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="func_return();return false;"><span class="btn-prev">編集画面に戻る</span></a></li>
                <li>
                    <a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'complete', '', '');return false;">
                        <span class="btn-next">この内容で登録する</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</form>
