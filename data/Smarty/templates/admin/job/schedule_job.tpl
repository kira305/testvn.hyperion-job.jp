<!--{*
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) LOCKON CO.,LTD. All Rights Reserved.
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

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->

<script type="text/javascript">
<!--

<!--{if $completed == 1}-->
    window.opener.location.reload(true);
    window.close();
<!--{/if}-->

self.moveTo(20,20);self.focus();

function lfPopwinSubmit(formName) {
    document[formName].submit();
    return false;
}
//-->
</script>

<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="confirm" />
<input type="hidden" name="agency_id" value="<!--{$arrForm.agency_id}-->" />
<input type="hidden" name="corporate_id" value="<!--{$arrForm.corporate_id}-->" />

<h2><!--コンテンツタイトル-->帳票の作成</h2>

<table class="form">
    <col width="20%" />
    <col width="80%" />
    <tr>
        <th>薬剤師依頼</th>
        <td>
            <!--{html_radios name="type" options=$arrTYPE separator=" " selected=$arrForm.type}-->
        </td>
    </tr>
    <tr>
        <th>依頼番号</th>
        <td><!--{$arrForm.sjob_id}--><input type="hidden" name="sjob_id" value="<!--{$arrForm.sjob_id}-->" /></td>
    </tr>
    <tr>
        <th>就業日</th>
        <td><!--{if $arrErr.year}--><span class="attention"><!--{$arrErr.year}--></span><!--{/if}-->
            <select name="year">
            <!--{html_options options=$arrYear selected=$arrForm.year}-->
            </select>年
            <select name="month">
            <!--{html_options options=$arrMonth selected=$arrForm.month}-->
            </select>月
            <select name="day">
            <!--{html_options options=$arrDay selected=$arrForm.day}-->
            </select>日
        </td>
    </tr>
    <tr>
        <th>就業時間</th>
        <td><!--{if $arrErr.working_start_all}--><span class="attention"><!--{$arrErr.working_start_all}--></span><!--{/if}-->
            <!--{if $arrErr.working_over_all}--><span class="attention"><!--{$arrErr.working_over_all}--></span><!--{/if}-->
            <input type="text" name="working_start_all" size="15" value="<!--{$arrForm.working_start_all}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/> ～ 
            <input type="text" name="working_over_all" size="15" value="<!--{$arrForm.working_over_all}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/>
        </td>
    </tr>
    <tr>
        <th>休憩時間</th>
        <td><!--{if $arrErr.breaktime_s_all}--><span class="attention"><!--{$arrErr.breaktime_s_all}--></span><!--{/if}-->
            <!--{if $arrErr.breaktime_o_all}--><span class="attention"><!--{$arrErr.breaktime_o_all}--></span><!--{/if}-->
            <input type="text" name="breaktime_s_all" size="15" value="<!--{$arrForm.breaktime_s_all}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/> ～ 
            <input type="text" name="breaktime_o_all" size="15" value="<!--{$arrForm.breaktime_o_all}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/>
        </td>
    </tr>
    <tr>
        <th>依頼人数</th>
        <td><!--{if $arrErr.staff_count}--><span class="attention"><!--{$arrErr.staff_count}--></span><!--{/if}-->
            <input type="text" name="staff_count" size="15" value="<!--{$arrForm.staff_count}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/>
        </td>
    </tr>
    <tr>
        <th>備考</th>
        <td><!--{if $arrErr.memo}--><span class="attention"><!--{$arrErr.memo}--></span><!--{/if}-->
            <input type="text" name="memo" size="60" value="<!--{$arrForm.memo}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->"/><br />
        </td>
    </tr>
</table>

<div class="btn-area">
    <ul>
        <li><a class="btn-action" href="javascript:;" onclick="return lfPopwinSubmit('form1');"><span class="btn-next">この内容で作成する</span></a></li>
    </ul>
</div>

</form>

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
