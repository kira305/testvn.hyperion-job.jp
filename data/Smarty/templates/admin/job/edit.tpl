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
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/calendar.js"></script>
<script type="text/javascript">
<!--
    jQuery(document).ready(function() {
        $('.working_day').simpleDatepicker();
        $('#contract_period_s').simpleDatepicker();
        $('#contract_period_o').simpleDatepicker();
    });

    function fnFormConfirm() {
        document.form1.submit();
    }
//-->
</script>
<style>
    .datepicker { border-collapse: collapse; border: 2px solid #999; position: absolute; z-index: 10; width: 200px; }
    .datepicker tr.controls th { height: 22px; font-size: 11px; }
    .datepicker select { font-size: 11px; }
    .datepicker tr.days th { height: 18px; }
    .datepicker tfoot td { height: 18px; text-align: center; text-transform: capitalize; }
    .datepicker th, .datepicker tfoot td { background: #eee; font: 10px/18px Verdana, Arial, Helvetica, sans-serif; }
    .datepicker th span, .datepicker tfoot td span { font-weight: bold; }

    .datepicker tbody td { width: 24px; height: 18px; border: 1px solid #ccc; font: 11px/22px Arial, Helvetica, sans-serif; text-align: center; background: #fff; }
    .datepicker tbody td.date { cursor: pointer; }
    .datepicker tbody td.date.over { background-color: #99ffff; }
    .datepicker tbody td.date.chosen { font-weight: bold; background-color: #ccffcc; }
</style>
<form name="form1" id="form1" method="post" action="?">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="confirm" />
    <input type="hidden" name="sjob_id" value="<!--{$arrForm.sjob_id.value|h}-->" />
    <input type="hidden" name="anchor_key" value="" />
    <input type="hidden" id="add_customer_id" name="add_customer_id" value="" />
    <input type="hidden" id="edit_customer_id" name="edit_customer_id" value="" />
    <input type="hidden" id="no" name="no" value="" />
    <input type="hidden" id="delete_no" name="delete_no" value="" />
    
    <input type="hidden" name="working_day_all" value="<!--{$arrForm.working_day_all.value|h}-->" />
    <input type="hidden" name="working_start_all" value="<!--{$arrForm.working_start_all.value|h}-->" />
    <input type="hidden" name="working_over_all" value="<!--{$arrForm.working_over_all.value|h}-->" />
    <input type="hidden" name="breaktime_s_all" value="<!--{$arrForm.breaktime_s_all.value|h}-->" />
    <input type="hidden" name="breaktime_o_all" value="<!--{$arrForm.breaktime_o_all.value|h}-->" />

    <!--{foreach key=key item=item from=$arrSearchHidden}-->
    <!--{if is_array($item)}-->
    <!--{foreach item=c_item from=$item}-->
    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
    <!--{/foreach}-->
    <!--{else}-->
    <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
    <!--{/foreach}-->

    <div id="order" class="contents-main">

        <!--▼お客様情報ここから-->
        <table class="form">
            <tr>
                <th>予約番号</th>
                <td><!--{$arrForm.sjob_id.value|h}--></td>
            </tr>
            <tr>
                <th>受注ＩＤ</th>
                <td>
                    <!--{assign var=key1 value="job_id"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>案件名</th>
                <td>
                    <!--{assign var=key1 value="job_name"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>受注コード</th>
                <td>
                    <!--{assign var=key1 value="job_code"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>業務・概要</th>
                <td>
                    <!--{assign var=key1 value="job_description"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>業務・詳細</th>
                <td>
                    <!--{assign var=key1 value="job_detail"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>営業所</th>
                <td>
                    <!--{assign var=key1 value="job_office"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>現場担当者</th>
                <td>
                    <!--{assign var=key1 value="office_charge"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>現場担当者電話</th>
                <td>
                    <!--{assign var=key1 value="o_charge_tel1"}-->
                    <!--{assign var=key2 value="o_charge_tel2"}-->
                    <!--{assign var=key3 value="o_charge_tel3"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <span class="attention"><!--{$arrErr[$key2]}--></span>
                    <span class="attention"><!--{$arrErr[$key3]}--></span>
                    <input type="text" name="<!--{$arrForm[$key1].keyname}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="6" class="box6" /> -
                    <input type="text" name="<!--{$arrForm[$key2].keyname}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" size="6" class="box6" /> -
                    <input type="text" name="<!--{$arrForm[$key3].keyname}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$arrForm[$key3].length}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td>
                    <!--{assign var=key1 value="remarks"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>派遣日</th>
                <td>
                    <!--{assign var=key1 value="job_date_year"}-->
                    <!--{assign var=key2 value="job_date_month"}-->
                    <!--{assign var=key3 value="job_date_day"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <span class="attention"><!--{$arrErr[$key2]}--></span>
                    <span class="attention"><!--{$arrErr[$key3]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm[$key1].value|default:""}-->
                    </select>年
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm[$key2].value|default:""}-->
                    </select>月
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm[$key3].value|default:""}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>派遣期間</th>
                <td>
                    <!--{assign var=key1 value="job_sche_date_from_year"}-->
                    <!--{assign var=key2 value="job_sche_date_from_month"}-->
                    <!--{assign var=key3 value="job_sche_date_from_day"}-->
                    <!--{assign var=key4 value="job_sche_date_to_year"}-->
                    <!--{assign var=key5 value="job_sche_date_to_month"}-->
                    <!--{assign var=key6 value="job_sche_date_to_day"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--><!--{$arrErr[$key4]}--><!--{$arrErr[$key5]}--><!--{$arrErr[$key6]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm[$key1].value|default:""}-->
                    </select>年
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm[$key2].value|default:""}-->
                    </select>月
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm[$key3].value|default:""}-->
                    </select>日 ～
                    <select name="<!--{$key4}-->" style="<!--{$arrErr[$key4]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm[$key4].value|default:""}-->
                    </select>年
                    <select name="<!--{$key5}-->" style="<!--{$arrErr[$key5]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm[$key5].value|default:""}-->
                    </select>月
                    <select name="<!--{$key6}-->" style="<!--{$arrErr[$key6]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm[$key6].value|default:""}-->
                    </select>日
                </td>
            </tr>
        </table>
        <!--▲お客様情報ここまで-->
        
        <h2>------</h2>
        <table class="form">
            <tr>
                <th>申込日</th>
                <td>
                    <!--{assign var=key1 value="apply_date_year"}-->
                    <!--{assign var=key2 value="apply_date_month"}-->
                    <!--{assign var=key3 value="apply_date_day"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <span class="attention"><!--{$arrErr[$key2]}--></span>
                    <span class="attention"><!--{$arrErr[$key3]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm[$key1].value|default:""}-->
                    </select>年
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm[$key2].value|default:""}-->
                    </select>月
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm[$key3].value|default:""}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>キャンセル日付</th>
                <td>
                    <!--{assign var=key1 value="cancel_date_year"}-->
                    <!--{assign var=key2 value="cancel_date_month"}-->
                    <!--{assign var=key3 value="cancel_date_day"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <span class="attention"><!--{$arrErr[$key2]}--></span>
                    <span class="attention"><!--{$arrErr[$key3]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrYear selected=$arrForm[$key1].value|default:""}-->
                    </select>年
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrMonth selected=$arrForm[$key2].value|default:""}-->
                    </select>月
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <!--{html_options options=$arrDay selected=$arrForm[$key3].value|default:""}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>現場名</th>
                <td>
                    <!--{assign var=key1 value="office_name"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>エリア代</th>
                <td>
                    <!--{assign var=key1 value="area_cost"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    <!--{assign var=key1 value="post_zip1"}-->
                    <!--{assign var=key2 value="post_zip2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    〒
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="6" class="box6" />
                    -
                    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" size="6" class="box6" />
                    <a class="btn-normal" href="javascript:;" name="address_input" onclick="fnCallAddress('<!--{$smarty.const.INPUT_ZIP_URLPATH}-->', 'post_zip1', 'post_zip2', 'office_pref', 'office_addr1'); return false;">住所入力</a><br />
                    <!--{assign var=key value="office_pref"}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <select class="top" name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
                        <option value="" selected="">都道府県を選択</option>
                        <!--{html_options options=$arrPref selected=$arrForm[$key].value}-->
                    </select><br />
                    <!--{assign var=key value="office_addr1"}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60 top" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" /><br />
                    <!--{assign var=key value="office_addr2"}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                </td>
            </tr>
            <tr>
                <th>必要人数</th>
                <td>
                    <!--{assign var=key1 value="request_num"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="15" class="box15" />
                </td>
            </tr>
            <tr>
                <th>派遣最大人数</th>
                <td>
                    <!--{assign var=key1 value="request_num_max"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="15" class="box15" />
                </td>
            </tr>
            <tr>
                <th>就業予定開始時間</th>
                <td>
                    <!--{assign var=key1 value="job_start_time1"}-->
                    <!--{assign var=key2 value="job_start_time2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>就業予定終了時間</th>
                <td>
                    <!--{assign var=key1 value="job_finish_time1"}-->
                    <!--{assign var=key2 value="job_finish_time2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>拘束時間</th>
                <td>
                    <!--{assign var=key1 value="binding_hour1"}-->
                    <!--{assign var=key2 value="binding_hour2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>実働時間</th>
                <td>
                    <!--{assign var=key1 value="working_total1"}-->
                    <!--{assign var=key2 value="working_total2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>休憩時間</th>
                <td>
                    <!--{assign var=key1 value="break_time1"}-->
                    <!--{assign var=key2 value="break_time2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>残業の有無</th>
                <td>
                    <!--{assign var=key1 value="over_time"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="15" class="box15" />
                </td>
            </tr>
        </table>
                
        <h2>------</h2>
        <table class="form">
            <tr>
                <th>最寄駅</th>
                <td>
                    <!--{assign var=key1 value="nearest_station"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>最寄駅から移動方法</th>
                <td>
                    <!--{assign var=key1 value="root_from_station"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>最寄駅から移動時間（分）</th>
                <td>
                    <!--{assign var=key1 value="time_from_station"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>最寄駅から移動詳細</th>
                <td>
                    <!--{assign var=key1 value="root_detail"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>持ち物</th>
                <td>
                    <!--{assign var=key1 value="belongings"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>派遣先からの注意事項</th>
                <td>
                    <!--{assign var=key1 value="dispatch_notes"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>当社から注意事項</th>
                <td>
                    <!--{assign var=key1 value="hyperion_notes"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>集合場所</th>
                <td>
                    <!--{assign var=key1 value="meeting_place"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>集合時間</th>
                <td>
                    <!--{assign var=key1 value="meeting_time1"}-->
                    <!--{assign var=key2 value="meeting_time2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>点呼場所</th>
                <td>
                    <!--{assign var=key1 value="roll_call_place"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>点呼時間</th>
                <td>
                    <!--{assign var=key1 value="roll_call_time1"}-->
                    <!--{assign var=key2 value="roll_call_time2"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span>
                    <select name="<!--{$key1}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrHOUR selected=$arrForm[$key1].value|default:''}-->
                    </select>:
                    <select name="<!--{$key2}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" class="boxShort data-role-none">
                        <!--{html_options options=$arrMINUTE selected=$arrForm[$key2].value|default:''}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>解散予定場所</th>
                <td>
                    <!--{assign var=key1 value="dissolution_place"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="30" class="box30" />
                </td>
            </tr>
        </table>

        <!--▼受注商品情報ここから-->
        <a name="job_customers"></a>
        <h2 id="job_customers">
            スタッフ情報
            <a class="btn-normal" href="javascript:;" name="recalculate" onclick="fnModeSubmit('recalculate', 'anchor_key', 'job_customers');">計算結果の確認</a>
            <!--{if $arrForm.staff_count.value == '' || $arrForm.staff_count.value > 0 && count($arrForm.customer_id.value) < $arrForm.staff_count.value}--><a class="btn-normal" href="javascript:;" name="add_customer" onclick="win03('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/search_customer.php', 'search', '615', '500'); return false;">スタッフ追加</a><!--{/if}-->
        </h2>

        <!--{if $arrErr.customer_id}-->
        <span class="attention">※ スタッフが選択されていません。</span>
        <!--{/if}-->

        <table class="list" id="job-edit-customers">
            <tr>
                <th class="id">スタッフID</th>
                <th class="name">スタッフ名</th>
                <th>就業日</th>
                <th>就業時間</th>
                <th>残業時間</th>
                <th>小計</th>
            </tr>
            <!--{section name=cnt loop=$arrForm.customer_id.value}-->
            <!--{assign var=customer_index value="`$smarty.section.cnt.index`"}-->
            <tr>
                <td>
                    <!--{$arrForm.customer_id.value[$customer_index]|h}-->
                    <input type="hidden" name="customer_id[<!--{$customer_index}-->]" value="<!--{$arrForm.customer_id.value[$customer_index]|h}-->" id="customer_id_<!--{$customer_index}-->" />
                    <input type="hidden" name="email[<!--{$customer_index}-->]" value="<!--{$arrForm.email.value[$customer_index]|h}-->" id="email_<!--{$customer_index}-->" />
                </td>
                <td>
                    <!--{$arrForm.name01.value[$customer_index]|h}--><!--{$arrForm.name02.value[$customer_index]|h}-->
                    <input type="hidden" name="name01[<!--{$customer_index}-->]" value="<!--{$arrForm.name01.value[$customer_index]|h}-->" id="name01_<!--{$customer_index}-->" />
                    <input type="hidden" name="name02[<!--{$customer_index}-->]" value="<!--{$arrForm.name02.value[$customer_index]|h}-->" id="name02_<!--{$customer_index}-->" />
                    <br />
                    <a class="btn-normal" href="javascript:;" name="change" onclick="win03('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/search_customer.php?no=<!--{$customer_index}-->', 'search', '615', '500'); return false;">変更</a>
                    <!--{if count($arrForm.customer_id.value) > 1}-->
                    <a class="btn-normal" href="javascript:;" name="delete" onclick="fnSetFormVal('form1', 'delete_no', <!--{$customer_index}--> ); fnModeSubmit('delete_customer', 'anchor_key', 'job_customers'); return false;">削除</a>
                    <!--{/if}-->
                </td>
                <td align="center">
                    <!--{assign var=key value="calendar_flag"}--><!--{assign var=key1 value=`$arrForm[$key].value[$customer_index]`}--><!--{$arrCALENDARFLAG[$key1]}-->
                    <input type="hidden" name="<!--{$key}-->[<!--{$customer_index}-->]" value="<!--{$arrForm[$key].value[$customer_index]}-->" id="<!--{$key}-->_<!--{$customer_index}-->" /><br />
                    <a class="btn-normal" href="javascript:;" name="add_customer" onclick="win03('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/calendar.php?customer_id=<!--{$arrForm.customer_id.value[$customer_index]|h}-->', 'search', '615', '600'); return false;">カレンダー</a>
                </td>
                <td>
                    <!--{assign var=key value="working_hour"}--><!--{$arrForm[$key].value[$customer_index]}-->
                    <input type="hidden" name="<!--{$key}-->[<!--{$customer_index}-->]" value="<!--{$arrForm[$key].value[$customer_index]}-->" id="<!--{$key}-->_<!--{$customer_index}-->" />
                </td>
                <td>
                    <!--{assign var=key value="overtime"}--><!--{$arrForm[$key].value[$customer_index]}-->
                    <input type="hidden" name="<!--{$key}-->[<!--{$customer_index}-->]" value="<!--{$arrForm[$key].value[$customer_index]}-->" id="<!--{$key}-->_<!--{$customer_index}-->" />
                </td>
                <td>
                    <!--{assign var=key value="subtotal"}--><!--{$arrForm[$key].value[$customer_index]|number_format}-->
                    <input type="hidden" name="<!--{$key}-->[<!--{$customer_index}-->]" value="<!--{$arrForm[$key].value[$customer_index]|h}-->" id="<!--{$key}-->_<!--{$customer_index}-->" />
                </td>
            </tr>
            <!--{/section}-->
            <tr>
                <th colspan="5" class="column right">合計</th>
                <td class="right">
                    <!--{$arrForm.total.value|number_format}-->
                    <input type="hidden" name="total" value="<!--{$arrForm.total.value|h}-->" />
                </td>
            </tr>
        </table>
        <table class="form">
            <tr>
                <th>メモ</th>
                <td>
                    <!--{assign var=key value="memo"}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <textarea name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" cols="80" rows="6" class="area80" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" ><!--{$arrForm[$key].value|h}--></textarea>
                </td>
            </tr>
            <tr>
                <th>備考（個別契約書用）</th>
                <td><!--{assign var=key1 value="contract_notice"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="60" class="box60" />
                </td>
            </tr>
        </table>
        <!--▲受注商品情報ここまで-->

        <div class="btn-area">
            <ul>
                <!--{if count($arrSearchHidden) > 0}-->
                <li><a class="btn-action" href="javascript:;" onclick="fnChangeAction('./<!--{$smarty.const.DIR_INDEX_PATH}-->'); fnModeSubmit('search', '', ''); return false;"><span class="btn-prev">検索画面に戻る</span></a></li>
                <!--{/if}-->
                <li><a class="btn-action" href="javascript:;" onclick="return fnFormConfirm(); return false;"><span class="btn-next">この内容で登録する</span></a></li>
            </ul>
        </div>
    </div>
    <div id="multiple"></div>
</form>
