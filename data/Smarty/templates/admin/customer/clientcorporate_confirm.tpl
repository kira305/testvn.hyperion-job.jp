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
    <!--{if $key == 'recruitment_detail' || $key == 'contract_type'}-->
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
                <th>薬局ID<span class="attention"> *</span></th>
                <td><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <!--{/if}-->
            <tr>
                <th>会社名</th>
                <td>
                    <!--{assign var=key1 value="agency_id"}-->
                    <!--{assign var=key2 value="`$arrForm[$key1].value`"}-->
                    <!--{$agencyList[$key2]}-->
                </td>
            </tr>
            <tr>
                <th>薬局名</th>
                <td><!--{assign var=key1 value="pharmacy_name"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>就業部署</th>
                <td><!--{assign var=key1 value="work_location"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>契約書</th>
                <td>
                    <!--{assign var=key1 value="contract_type"}-->
                    <!--{foreach from=$arrForm[$key1].value item=status}-->
                    <!--{$contractType.$status}--> &nbsp; 
                    <!--{/foreach}-->
                </td>
            </tr>
            <tr>
                <th>契約期間</th>
                <td>
                    <!--{assign var=key1 value="contract_period_s"}-->
                    <!--{assign var=key2 value="contract_period_o"}-->
                    <!--{$arrForm[$key1].value|h}--> ～ <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>抵触日</th>
                <td>
                    <!--{assign var=key1 value="conflict_year"}-->
                    <!--{assign var=key2 value="conflict_month"}-->
                    <!--{assign var=key3 value="conflict_day"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>薬局担当者名</th>
                <td>
                    <!--{assign var=key1 value="charge_firstname"}-->
                    <!--{assign var=key2 value="charge_lastname"}-->
                    <!--{$arrForm[$key1].value|h}--> <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>薬局担当者名（カナ）</th>
                <td>
                    <!--{assign var=key1 value="charge_firstname_kana"}-->
                    <!--{assign var=key2 value="charge_lastname_kana"}-->
                    <!--{$arrForm[$key1].value|h}--> <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>指揮命令者</th>
                <td>
                    <!--{assign var=key1 value="command_person_firstname"}-->
                    <!--{assign var=key2 value="command_person_lastname"}-->
                    <!--{$arrForm[$key1].value|h}--> <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td>
                    <!--{assign var=key1 value="per_tel1"}-->
                    <!--{assign var=key2 value="per_tel2"}-->
                    <!--{assign var=key3 value="per_tel3"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>苦情申出先</th>
                <td>
                    <!--{assign var=key1 value="claim_offer_firstname"}-->
                    <!--{assign var=key2 value="claim_offer_lastname"}-->
                    <!--{$arrForm[$key1].value|h}--> <!--{$arrForm[$key2].value|h}-->
                </td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td>
                    <!--{assign var=key1 value="offer_tel1"}-->
                    <!--{assign var=key2 value="offer_tel2"}-->
                    <!--{assign var=key3 value="offer_tel3"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>
                    <!--{assign var=key1 value="zip_code1"}-->
                    <!--{assign var=key2 value="zip_code2"}-->
                    〒<!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->&nbsp;
                </td>
            </tr>
            <tr>
                <th>ご住所</th>
                <td>
                    <!--{assign var=key3 value="pref"}-->
                    <!--{assign var=key4 value="addr1"}-->
                    <!--{assign var=key5 value="addr2"}-->
                    <!--{assign var=key1 value="`$arrForm[$key3].value`"}-->
                    <!--{$arrPref[$key1]}--><br />
                    <!--{$arrForm[$key4].value|h}--><br />
                    <!--{$arrForm[$key5].value|h}--><br />
                </td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td>
                    <!--{assign var=key1 value="tel1"}-->
                    <!--{assign var=key2 value="tel2"}-->
                    <!--{assign var=key3 value="tel3"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>連絡先FAX番号</th>
                <td>
                    <!--{assign var=key1 value="fax1"}-->
                    <!--{assign var=key2 value="fax2"}-->
                    <!--{assign var=key3 value="fax3"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->-<!--{$arrForm[$key3].value|h}-->
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><!--{assign var=key1 value="email_add"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>業務内容</th>
                <td><!--{assign var=key1 value="job_description"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>店舗数</th>
                <td><!--{assign var=key1 value="num_of_stores"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>薬歴</th>
                <td>
                    <!--{assign var=key1 value="medication_his"}-->
                    <!--{assign var=key2 value="`$arrForm[$key1].value`"}-->
                    <!--{$yakureki[$key2]|h}-->
                </td>
            </tr>
            <tr>
                <th>薬剤師数</th>
                <td><!--{assign var=key1 value="num_of_pharmacists"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>事務スタッフ</th>
                <td><!--{assign var=key1 value="o_staff"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>メイン処方箋発行機関</th>
                <td><!--{assign var=key1 value="main_authority"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>科目</th>
                <td><!--{assign var=key1 value="kamoku"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>処方箋枚数</th>
                <td><!--{assign var=key1 value="prescriptions"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>勤務時間</th>
                <td>
                    <!--{assign var=key1 value="work_hour_s"}-->
                    <!--{assign var=key2 value="work_hour_o"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->&nbsp;
                </td>
            </tr>
            <tr>
                <th>時間外業務</th>
                <td><!--{assign var=key1 value="overtime_work"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>支払条件等</th>
                <td><!--{assign var=key1 value="payment_terms"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>休憩室</th>
                <td>
                    <!--{assign var=key1 value="b_room"}-->
                    <!--{assign var=key2 value="`$arrForm[$key1].value`"}-->
                    <!--{$holiday[$key2]|h}-->
                </td>
            </tr>
            <tr>
                <th>休憩時間</th>
                <td>
                    <!--{assign var=key1 value="b_time_s"}-->
                    <!--{assign var=key2 value="b_time_o"}-->
                    <!--{$arrForm[$key1].value|h}-->-<!--{$arrForm[$key2].value|h}-->&nbsp;
                </td>
            </tr>　
            <tr>
                <th>最寄駅</th>
                <td><!--{assign var=key1 value="nearest"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>　
            <tr>
                <th>交通アクセス</th>
                <td><!--{assign var=key1 value="access"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>必需品</th>
                <td><!--{assign var=key1 value="necessities"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>周辺環境</th>
                <td><!--{assign var=key1 value="environ"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>福利厚生</th>
                <td><!--{assign var=key1 value="welfare"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>特記事項、社内ルール</th>
                <td><!--{assign var=key1 value="notices"}--><!--{$arrForm[$key1].value|h}--></td>
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
                <th>メモ</th>
                <td><!--{assign var=key1 value="memo"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>その他、ご質問など</th>
                <td><!--{assign var=key1 value="other_q"}--><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <tr>
                <th>店舗マップ</th>
                <td><!--{assign var=key1 value="gmap_src"}--><img alt="" src="<!--{$arrForm[$key1].value}-->" width="600" height="400"></td>
            </tr>
        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="func_return();
        return false;"><span class="btn-prev">編集画面に戻る</span></a></li>
                <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'complete', '', '');
        return false;"><span class="btn-next">この内容で登録する</span></a></li>
            </ul>
        </div>
    </div>
</form>
