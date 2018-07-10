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

function func_return(){
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
			<!--{if $key == 'recruitment_detail'}-->
                <!--{foreach item=c_item from=$item.value}-->
                    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
                <!--{/foreach}-->
            <!--{else}-->
                <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item.value|h}-->" />
            <!--{/if}-->
        <!--{/if}-->
    <!--{/foreach}-->

    <!-- 検索条件の保持 -->
    <!--{foreach from=$arrSearchData key="key" item="item"}-->
        <!--{if $key ne "customer_id" && $key ne "mode" && $key ne "edit_customer_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
            <!--{if is_array($item)}-->
                <!--{foreach item=c_item from=$item}-->
                    <input type="hidden" name="search_data[<!--{$key|h}-->][]" value="<!--{$c_item|h}-->" />
                <!--{/foreach}-->
            <!--{else}-->
                <input type="hidden" name="search_data[<!--{$key|h}-->]" value="<!--{$item|h}-->" />
            <!--{/if}-->
        <!--{/if}-->
    <!--{/foreach}-->

    <div id="customer" class="contents-main">
        <table class="form">
			<!--{assign var=key1 value="corporate_id"}-->
			<!--{if $arrForm[$key1].value}-->
            <tr>
                <th>会員ID<span class="attention"> *</span></th>
                <td><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <!--{/if}-->
	        <tr>
			    <th>企業名</th>
			    <td>
			        <!--{assign var=key1 value="corporate_name"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
			</tr>
			<tr>
			    <th>ご担当者部署名</th>
			    <td>
			        <!--{assign var=key1 value="person_unit"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
			    </td>
			</tr>
			<tr>
			    <th>ご担当者名</th>
			    <td>
			        <!--{assign var=key1 value="charge_firstname"}-->
			        <!--{assign var=key2 value="charge_lastname"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}--> <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->
			    </td>
			</tr>
			<tr>
			    <th>ご担当者名（カナ）</th>
			    <td>
			        <!--{assign var=key1 value="charge_firstname_kana"}-->
			        <!--{assign var=key2 value="charge_lastname_kana"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}--> <input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->
			    </td>
			</tr>
			<tr>
			    <th>郵便番号</th>
			    <td>
			        <!--{assign var=key1 value="zip_code1"}-->
			        <!--{assign var=key2 value="zip_code2"}-->
			        〒<input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->&nbsp;
			    </td>
			</tr>
			<tr>
			    <th>ご住所</th>
			    <td>
			        <!--{assign var=key3 value="pref"}-->
			        <!--{assign var=key4 value="addr1"}-->
			        <!--{assign var=key5 value="addr2"}-->
					<!--{assign var=key1 value="`$arrForm[$key3].value`"}-->
					<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrPref[$key1]}--><br />
			        <input type="hidden" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|h}-->" /><!--{$arrForm[$key4].value|h}--><br />
			        <input type="hidden" name="<!--{$key5}-->" value="<!--{$arrForm[$key5].value|h}-->" /><!--{$arrForm[$key5].value|h}--><br />
			    </td>
			</tr>
			<tr>
			    <th>ご連絡先電話番号</th>
			    <td>
			        <!--{assign var=key1 value="tel1"}-->
			        <!--{assign var=key2 value="tel2"}-->
			        <!--{assign var=key3 value="tel3"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->-<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrForm[$key3].value|h}-->
			    </td>
			</tr>
			<tr>
			    <th>ご連絡先FAX番号</th>
			    <td>
			        <!--{assign var=key1 value="fax1"}-->
			        <!--{assign var=key2 value="fax2"}-->
			        <!--{assign var=key3 value="fax3"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->-<input type="hidden" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" /><!--{$arrForm[$key2].value|h}-->-<input type="hidden" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" /><!--{$arrForm[$key3].value|h}-->
			    </td>
			</tr>
			<tr>
			        <th>メールアドレス</th>
			        <td>
			            <!--{assign var=key1 value="email_add"}-->
			            <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
			        </td>
			</tr>
			<tr>
			    <th>お探しの人材</th>
			    <td>
			        <!--{assign var=key1 value="recruitment_detail"}-->
			        <!--{foreach from=$arrForm[$key1].value item=status}-->
			        	<!--{$arrEMPSTATUS.$status}--> &nbsp; 
			        <!--{/foreach}-->
				</td>
			</tr>
			<tr>
			    <th>その他、ご質問など</th>
			    <td>
			        <!--{assign var=key1 value="other_q"}-->
			        <input type="hidden" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" /><!--{$arrForm[$key1].value|h}-->
				</td>
			</tr>
        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="func_return(); return false;"><span class="btn-prev">編集画面に戻る</span></a></li>
                <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'complete', '', ''); return false;"><span class="btn-next">この内容で登録する</span></a></li>
            </ul>
        </div>
    </div>
</form>
