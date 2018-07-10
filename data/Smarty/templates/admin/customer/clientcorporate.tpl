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
        $('.contract_period').simpleDatepicker();
    });

    function fnReturn() {
        document.search_form.action = './clientsearch.php';
        document.search_form.submit();
        return false;
    }

    function changeMapType(type) {
        var shop = document.form1.addr1.value + document.form1.addr2.value;
        var nearest = document.form1.nearest.value;
        if (type === 1)
            document.form1.gmap_src.value = "http://maps.googleapis.com/maps/api/staticmap?center=" + shop + "&zoom=19&scale=2&size=600x400&maptype=roadmap&markers=label:A|" + shop + "&sensor=false&format=jpg";
        else
            document.form1.gmap_src.value = "http://maps.googleapis.com/maps/api/staticmap?center=" + shop + "&zoom=17&scale=2&size=600x400&maptype=roadmap&markers=label:A|" + nearest + "&markers=label:B|" + shop + "&path=color:0x0000ff80|weight:3|" + nearest + "|" + shop + "&sensor=false&format=jpg";
        changeMapImage(document.form1.gmap_src.value);
    }

    function changeMapImage(val) {
        alert(val + '');
        document.form1.map.style.display = "block";
        if (val === '' || val === 'undefined')
            val = document.form1.gmap_src.value;
        document.form1.map.src = val;
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
<form name="search_form" method="post" action="">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="search" />

    <!--{foreach from=$arrSearchData key="key" item="item"}-->
    <!--{if $key ne "customer_id" && $key ne "mode" && $key ne "edit_customer_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
    <!--{if $key == 'recruitment_detail'}-->
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
    <!--{assign var=key1 value="corporate_id"}-->
    <input type="hidden" name="corporate_id" value="<!--{$arrForm[$key1].value|h}-->" />

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
            <col width="30%" />
            <col width="70%" />
            <!--{assign var=key1 value="corporate_id"}-->
            <!--{if $arrForm[$key1].value}-->
            <tr>
                <th>薬局ID<span class="attention"> *</span></th>
                <td><!--{$arrForm[$key1].value|h}--></td>
            </tr>
            <!--{/if}-->
            <!--{assign var=key1 value="agency_id"}-->
            <tr>
                <th>会社名<span class="attention">※</span></th>
                <td>
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <!--{if $smarty.session.authority == 2 || $smarty.session.authority == 3}-->
                    <!--{$agencyList[$smarty.session.agency_id]}--><input type="hidden" name="<!--{$key1}-->" value="<!--{$smarty.session.agency_id}-->" />
                    <!--{else}-->
                    <select id="<!--{$key1}-->" name="<!--{$key1}-->">
                        <option value="">指定無し</option>
                        <!--{html_options options=$agencyList selected=$arrForm[$key1].value}-->
                    </select>
                    <!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>薬局名<span class="attention">※</span></th>
                <td>
                    <!--{assign var=key1 value="pharmacy_name"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>就業部署</th>
                <td>
                    <!--{assign var=key1 value="work_location"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>契約書</th>
                <td>
                    <!--{assign var=key1 value="contract_type"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <!--{html_checkboxes name=$key1 options=$contractType selected=$arrForm[$key1].value separator='&nbsp;&nbsp;'}-->
                </td>
            </tr>
            <tr>
                <th>契約期間</th>
                <td>
                    <!--{assign var=key1 value="contract_period_s"}-->
                    <!--{assign var=key2 value="contract_period_o"}-->
                    <span class="attention"><!--{$arrErr[$key1]}--></span>
                    <span class="attention"><!--{$arrErr[$key2]}--></span>
                    <input type="text" class="contract_period" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="15" class="box15" />
                    ～ 
                    <input type="text" class="contract_period" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="15" class="box15" />
                </td>
            </tr>
            <tr>
                <th>抵触日</th>
                <td>
                    <!--{assign var=key1 value="conflict_year"}-->
                    <!--{assign var=key2 value="conflict_month"}-->
                    <!--{assign var=key3 value="conflict_day"}-->
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
                <th>派遣先責任者</th>
                <td>
                    <!--{assign var=key1 value="charge_firstname"}-->
                    <!--{assign var=key2 value="charge_lastname"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    姓&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
			     　 名&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>派遣先責任者（カナ）</th>
                <td>
                    <!--{assign var=key1 value="charge_firstname_kana"}-->
                    <!--{assign var=key2 value="charge_lastname_kana"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    セイ&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                    メイ&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>指揮命令者</th>
                <td>
                    <!--{assign var=key1 value="command_person_firstname"}-->
                    <!--{assign var=key2 value="command_person_lastname"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    姓&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
			     　 名&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td>
                    <!--{assign var=key1 value="per_tel1"}-->
                    <!--{assign var=key2 value="per_tel2"}-->
                    <!--{assign var=key3 value="per_tel3"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>苦情申出先</th>
                <td>
                    <!--{assign var=key1 value="claim_offer_firstname"}-->
                    <!--{assign var=key2 value="claim_offer_lastname"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    姓&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
			     　 名&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="30" class="box30" />
                </td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td>
                    <!--{assign var=key1 value="offer_tel1"}-->
                    <!--{assign var=key2 value="offer_tel2"}-->
                    <!--{assign var=key3 value="offer_tel3"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>郵便番号<span class="attention">※</span></th>
                <td>
                    <!--{assign var=key1 value="zip_code1"}-->
                    <!--{assign var=key2 value="zip_code2"}-->
                    <!--{assign var=key3 value="pref"}-->
                    <!--{assign var=key4 value="addr1"}-->
                    <!--{assign var=key5 value="addr2"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
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
                <th>ご住所<span class="attention">※</span></th>
                <td>
                    <!--{if $arrErr[$key3] || $arrErr[$key4] || $arrErr[$key5]}-->
                    <div class="attention"><!--{$arrErr[$key3]}--><!--{$arrErr[$key4]}--><!--{$arrErr[$key5]}--></div>
                    <!--{/if}-->
                    <select name="<!--{$key3}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->">
                        <option value="" selected="selected">都道府県を選択</option>
                        <!--{html_options options=$arrPref selected=$arrForm[$key3].value}-->
                    </select>
                    <p class="top"><input type="text" name="<!--{$key4}-->" id="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|h}-->" style="<!--{$arrErr[$key4]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" /><br />
                        <!--{$smarty.const.SAMPLE_ADDRESS1}--></p>
                    <p class="top"><input type="text" name="<!--{$key5}-->" id="<!--{$key5}-->" value="<!--{$arrForm[$key5].value|h}-->" style="<!--{$arrErr[$key5]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" /><br />
                        <!--{$smarty.const.SAMPLE_ADDRESS2}--></p>
                    <p class="mini"><span class="attention">住所は2つに分けてご記入ください。マンション名は必ず記入してください。</span></p>
                </td>
            </tr>
            <tr>
                <th>連絡先<span class="attention">※</span></th>
                <td>
                    <!--{assign var=key1 value="tel1"}-->
                    <!--{assign var=key2 value="tel2"}-->
                    <!--{assign var=key3 value="tel3"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>連絡先FAX番号</th>
                <td>
                    <!--{assign var=key1 value="fax1"}-->
                    <!--{assign var=key2 value="fax2"}-->
                    <!--{assign var=key3 value="fax3"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2] || $arrErr[$key3]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--><!--{$arrErr[$key3]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|h}-->" maxlength="<!--{$smarty.const.TEL_ITEM_LEN}-->" style="<!--{$arrErr[$key3]|sfGetErrorColor}-->; ime-mode: disabled;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    <!--{assign var=key1 value="email_add"}-->
                    <!--{assign var=key2 value="email_add_repeat"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: disabled;" size="60" class="box60" /><br />
                    <input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" style="<!--{$arrErr[$key1]|cat:$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: disabled;" size="60" class="box60" /><br />
                    <span class="attention mini">確認のため2度入力してください。</span>
                </td>
            </tr>
            <tr>
                <th>業務内容</th>
                <td>
                    <!--{assign var=key1 value="job_description"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>店舗数</th>
                <td>
                    <!--{assign var=key1 value="num_of_stores"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>薬歴</th>
                <td>
                    <!--{assign var=key1 value="medication_his"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <!--{html_radios name=$key1 options=$yakureki selected=$arrForm[$key1].value|h separator='&nbsp;&nbsp;'}-->
                </td>
            </tr>
            <tr>
                <th>薬剤師数</th>
                <td>
                    <!--{assign var=key1 value="num_of_pharmacists"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>事務スタッフ</th>
                <td>
                    <!--{assign var=key1 value="o_staff"}-->
                    <!--{if $arrErr[$key1]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>メイン処方箋発行機関</th>
                <td>
                    <!--{assign var=key1 value="main_authority"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>　
            <tr>
                <th>科目</th>
                <td>
                    <!--{assign var=key1 value="kamoku"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>　
            <tr>
                <th>処方箋枚数</th>
                <td>
                    <!--{assign var=key1 value="prescriptions"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>勤務時間</th>
                <td>
                    <!--{assign var=key1 value="work_hour_s"}-->
                    <!--{assign var=key2 value="work_hour_o"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>時間外業務</th>
                <td>
                    <!--{assign var=key1 value="overtime_work"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
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
                <th>休憩室</th>
                <td>
                    <!--{assign var=key1 value="b_room"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <!--{html_radios name=$key1 options=$holiday selected=$arrForm[$key1].value|h separator='&nbsp;&nbsp;'}-->
                </td>
            </tr>
            <tr>
                <th>休憩時間</th>
                <td>
                    <!--{assign var=key1 value="b_time_s"}-->
                    <!--{assign var=key2 value="b_time_o"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}-->
                    <div class="attention"><!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></div>
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="6" class="box6" />&nbsp;-&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->; ime-mode: active;" size="6" class="box6" />
                </td>
            </tr>
            <tr>
                <th>最寄駅</th>
                <td>
                    <!--{assign var=key1 value="nearest"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>交通アクセス</th>
                <td>
                    <!--{assign var=key1 value="access"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>必需品</th>
                <td>
                    <!--{assign var=key1 value="necessities"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>周辺環境</th>
                <td>
                    <!--{assign var=key1 value="environ"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>福利厚生</th>
                <td>
                    <!--{assign var=key1 value="welfare"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->; ime-mode: active;" size="60" class="box60" />
                </td>
            </tr>
            <tr>
                <th>特記事項、社内ルール</th>
                <td>
                    <!--{assign var=key1 value="notices"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <textarea name="<!--{$key1}-->" cols="60" rows="8" class="area60" maxlength="99999"><!--{$arrForm[$key1].value|h}--></textarea>
                </td>
            </tr>
            <tr>
                <th>お探しの人材</th>
                <td>
                    <!--{assign var=key1 value="recruitment_detail"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <!--{html_checkboxes name=$key1 options=$arrEMPSTATUS selected=$arrForm[$key1].value separator='&nbsp;&nbsp;'}-->
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
            <tr>
                <th>その他、ご質問など</th>
                <td>
                    <!--{assign var=key1 value="other_q"}-->
                    <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                    <textarea name="<!--{$key1}-->" cols="60" rows="8" class="area60" maxlength="99999"><!--{$arrForm[$key1].value|h}--></textarea>
                </td>
            </tr>
            <!-- Google Map Customize -->
            <tr>
                <th>店舗マップ</th>
                <td>
                    <!--{assign var=key value="gmap_src"}-->
                    <!--{if $arrErr[$key]}--><div class="attention"><!--{$arrErr[$key]}--></div><!--{/if}-->
                    <img name="map" alt="" src="<!--{$arrForm[$key].value}-->" width="600" height="400" <!--{if $arrForm[$key].value == ''}-->style="display:none;"<!--{/if}--> /><br>
                    <input type="radio" name="map_type" onchange="changeMapType(1);" />A &nbsp; <input type="radio" name="map_type" onchange="changeMapType(2);" /> A to B<br>
                    <textarea name="<!--{$key}-->" id="<!--{$key}-->" onchange="changeMapImage(this.value);" maxlength="99999" cols="60" rows="8" class="area60"><!--{$arrForm[$key].value|h}--></textarea>
                </td>
            </tr>
            <!-- /Google Map Customize -->
        </table>

        <div class="btn-area">
            <ul>
                <!--{if $smarty.session.authority != 3}-->
                <li><a class="btn-action" href="javascript:;" onclick="return fnReturn();"><span class="btn-prev">検索画面に戻る</span></a></li>
                <!--{/if}-->
                <li><a class="btn-action" href="javascript:;" onclick="fnSetFormSubmit('form1', 'mode', 'confirm');return false;"><span class="btn-next">確認ページへ</span></a></li>
            </ul>
        </div>
    </div>
</form>