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
    function fnFormConfirm() {
        if (fnConfirm()) {
            document.form1.submit();
        }
    }

//-->
</script>
<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="complete" />
<!--{foreach key=key item=item from=$arrSearchHidden}-->
    <!--{if is_array($item)}-->
        <!--{foreach item=c_item from=$item}-->
        <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
    <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
<!--{/foreach}-->
<!--{foreach key=key item=item from=$arrForm}-->
    <!--{if is_array($item.value)}-->
        <!--{foreach item=c_item from=$item.value}-->
        <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
    <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item.value|h}-->" />
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
            <td><!--{$arrForm.job_id.value|h}--></td>
        </tr>
        <tr>
            <th>案件名</th>
            <td><!--{$arrForm.job_name.value|h}--></td>
        </tr>
        <tr>
            <th>受注コード</th>
            <td><!--{$arrForm.job_code.value|h}--></td>
        </tr>
        <tr>
            <th>業務・概要</th>
            <td><!--{$arrForm.job_description.value|h}--></td>
        </tr>
        <tr>
            <th>業務・詳細</th>
            <td><!--{$arrForm.job_detail.value|h}--></td>
        </tr>
        <tr>
            <th>営業所</th>
            <td><!--{$arrForm.job_office.value|h}--></td>
        </tr>
        <tr>
            <th>現場担当者</th>
            <td><!--{$arrForm.office_charge.value|h}--></td>
        </tr>
        <tr>
            <th>現場担当者電話</th>
            <td><!--{$arrForm.o_charge_tel1.value|h}--> - <!--{$arrForm.o_charge_tel2.value|h}--> - <!--{$arrForm.o_charge_tel3.value|h}--></td>
        </tr>
        <tr>
            <th>備考</th>
            <td><!--{$arrForm.remarks.value|h}--></td>
        </tr>
        <tr>
            <th>派遣日</th>
            <td><!--{$arrForm.job_date_year.value|h}-->年<!--{$arrForm.job_date_month.value|h}-->月<!--{$arrForm.job_date_day.value|h}-->日</td>
        </tr>
        <tr>
            <th>派遣期間</th>
            <td>
                <!--{$arrForm.job_sche_date_from_year.value|h}-->年<!--{$arrForm.job_sche_date_from_month.value|h}-->月<!--{$arrForm.job_sche_date_from_day.value|h}-->日 ～
                <!--{$arrForm.job_sche_date_to_year.value|h}-->年<!--{$arrForm.job_sche_date_to_month.value|h}-->月<!--{$arrForm.job_sche_date_to_day.value|h}-->日
            </td>
        </tr>
    </table>
            
    <h2>------</h2>
    <table class="form">
        <tr>
            <th>申込日</th>
            <td><!--{$arrForm.apply_date_year.value|h}-->年<!--{$arrForm.apply_date_month.value|h}-->月<!--{$arrForm.apply_date_day.value|h}-->日</td>
        </tr>
        <tr>
            <th>キャンセル日付</th>
            <td><!--{$arrForm.cancel_date_year.value|h}-->年<!--{$arrForm.cancel_date_month.value|h}-->月<!--{$arrForm.cancel_date_day.value|h}-->日</td>
        </tr>
        <tr>
            <th>現場名</th>
            <td><!--{$arrForm.office_name.value|h}--></td>
        </tr>
        <tr>
            <th>エリア代</th>
            <td><!--{$arrForm.area_cost.value|h}--></td>
        </tr>
        <tr>
            <th>住所</th>
            <td>
                〒<!--{$arrForm.post_zip1.value|h}--> - <!--{$arrForm.post_zip2.value|h}--><br />
                <!--{$arrPref[$arrForm.office_pref.value]|h}--><!--{$arrForm.office_addr1.value|h}--><br /><!--{$arrForm.office_addr2.value|h}-->
            </td>
        </tr>
        <tr>
            <th>必要人数</th>
            <td><!--{$arrForm.request_num.value|h}--></td>
        </tr>
        <tr>
            <th>派遣最大人数</th>
            <td><!--{$arrForm.request_num_max.value|h}--></td>
        </tr>
        <tr>
            <th>就業予定開始時間</th>
            <td><!--{$arrForm.job_start_time1.value|h}-->時<!--{$arrForm.job_start_time2.value|h}-->分</td>
        </tr>
        <tr>
            <th>就業予定終了時間</th>
            <td><!--{$arrForm.job_finish_time1.value|h}-->時<!--{$arrForm.job_finish_time2.value|h}-->分</td>
        </tr>
        <tr>
            <th>拘束時間</th>
            <td><!--{$arrForm.binding_hour1.value|h}-->時<!--{$arrForm.binding_hour2.value|h}-->分</td>
        </tr>
        <tr>
            <th>実働時間</th>
            <td><!--{$arrForm.working_total1.value|h}-->時<!--{$arrForm.working_total2.value|h}-->分</td>
        </tr>
        <tr>
            <th>休憩時間</th>
            <td><!--{$arrForm.break_time1.value|h}-->時<!--{$arrForm.break_time2.value|h}-->分</td>
        </tr>
        <tr>
            <th>残業の有無</th>
            <td><!--{$arrForm.over_time.value|h}--></td>
        </tr>
    </table>
        
    <h2>------</h2>
    <table class="form">
        <tr>
            <th>最寄駅</th>
            <td><!--{$arrForm.nearest_station.value|h}--></td>
        </tr>
        <tr>
            <th>最寄駅から移動方法</th>
            <td><!--{$arrForm.root_from_station.value|h}--></td>
        </tr>
        <tr>
            <th>最寄駅から移動時間（分）</th>
            <td><!--{$arrForm.time_from_station.value|h}--></td>
        </tr>
        <tr>
            <th>最寄駅から移動詳細</th>
            <td><!--{$arrForm.root_detail.value|h}--></td>
        </tr>
        <tr>
            <th>持ち物</th>
            <td><!--{$arrForm.belongings.value|h}--></td>
        </tr>
        <tr>
            <th>派遣先からの注意事項</th>
            <td><!--{$arrForm.dispatch_notes.value|h}--></td>
        </tr>
        <tr>
            <th>当社から注意事項</th>
            <td><!--{$arrForm.hyperion_notes.value|h}--></td>
        </tr>
        <tr>
            <th>集合場所</th>
            <td><!--{$arrForm.meeting_place.value|h}--></td>
        </tr>
        <tr>
            <th>集合時間</th>
            <td><!--{$arrForm.meeting_time1.value|h}-->時<!--{$arrForm.meeting_time2.value|h}-->分</td>
        </tr>
        <tr>
            <th>点呼場所</th>
            <td><!--{$arrForm.roll_call_place.value|h}--></td>
        </tr>
        <tr>
            <th>点呼時間</th>
            <td><!--{$arrForm.roll_call_time1.value|h}-->時<!--{$arrForm.roll_call_time2.value|h}-->分</td>
        </tr>
        <tr>
            <th>解散予定場所</th>
            <td><!--{$arrForm.dissolution_place.value|h}--></td>
        </tr>
    </table>

    <!--▼受注商品情報ここから-->
    <a name="job_customers"></a>
    <h2 id="job_customers">スタッフ情報</h2>

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
            <td><!--{$arrForm.customer_id.value[$customer_index]|h}--></td>
            <td><!--{$arrForm.name01.value[$customer_index]|h}--><!--{$arrForm.name02.value[$customer_index]|h}--></td>
            <td align="center"><!--{assign var=key1 value=`$arrForm.calendar_flag.value[$customer_index]`}--><!--{$arrCALENDARFLAG[$key1]}--></td>
            <td><!--{$arrForm.working_hour.value[$customer_index]}--></td>
            <td><!--{$arrForm.overtime.value[$customer_index]}--></td>
            <td><!--{$arrForm.subtotal.value[$customer_index]|number_format}--></td>
        </tr>
        <!--{/section}-->
        <tr>
            <th colspan="5" class="column right">合計</th>
            <td class="right"><!--{$arrForm.total.value|number_format}--></td>
        </tr>
    </table>
    <table class="form">
        <tr>
            <th>メモ</th>
            <td><!--{$arrForm.memo.value|h}--></td>
        </tr>
        <tr>
            <th>備考（個別契約書用）</th>
            <td><!--{$arrForm.contract_notice.value|h}--></td>
        </tr>
    </table>
    <!--▲受注商品情報ここまで-->

    <div class="btn-area">
        <ul>
            <li><a class="btn-action" href="javascript:;" onclick="fnModeSubmit('confirm_return','',''); return false;"><span class="btn-prev">前のページに戻る</span></a></li>
            <li><a class="btn-action" href="javascript:;" onclick="return fnFormConfirm(); return false;"><span class="btn-next">この内容で登録する</span></a></li>
        </ul>
    </div>
</div>
<div id="multiple"></div>
</form>
