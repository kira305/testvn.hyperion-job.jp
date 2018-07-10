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
self.moveTo(20,20);self.focus();

function lfPopwinSubmit(formName) {
    win02('about:blank','pdf','1000','900');
    document[formName].target = "pdf";
    document[formName].submit();
    return false;
}

function changeNote(id){
    <!--{foreach from=$arrNote key=title item=value}-->
        if(id === '<!--{$title}-->'){
            document.form1.note.value = '<!--{$value}-->';
        }
    <!--{/foreach}-->
}

//-->
</script>

<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="confirm" />
<!--{foreach from=$arrForm.sjob_id item=sjob_id}-->
    <input type="hidden" name="sjob_id[]" value="<!--{$sjob_id|h}-->">
<!--{/foreach}-->

<h2><!--コンテンツタイトル-->帳票の作成</h2>

<table class="form">
    <col width="20%" />
    <col width="80%" />
    <tr>
        <th>予約番号</th>
        <td><!--{$arrForm.sjob_id|@join:', '}--></td>
    </tr>
    <tr>
        <th>発行日<span class="attention">※</span></th>
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
        <th>帳票の状態</th>
        <td><!--{if $arrErr.fill}--><span class="attention"><!--{$arrErr.fill}--></span><!--{/if}-->
            <select name="fill">
            <!--{html_options options=$arrFill selected=$arrForm.fill}-->
            </select>
        </td>
    </tr>
    <tr>
        <th>帳票の種類</th>
        <td><!--{if $arrErr.type}--><span class="attention"><!--{$arrErr.type}--></span><!--{/if}-->
            <!--{html_checkboxes name="type" options=$arrType selected=$arrForm.type separator="<br />"}-->
        </td>
    </tr>
    <tr>
        <th>書類送付の<br />ご案内</th>
        <td><!--{if $arrErr.title}--><span class="attention"><!--{$arrErr.title}--></span><!--{/if}-->
            <!--{html_radios name="title" options=$arrTitle selected=$arrForm.title onclick="changeNote(this.value);"}-->
        </td>
    </tr>
    <tr>
        <th>ダウンロード方法</th>
        <td><!--{if $arrErr.download}--><span class="attention"><!--{$arrErr.download}--></span><!--{/if}-->
            <select name="download">
            <!--{html_options options=$arrDownload selected=$arrForm.download}-->
            </select>
        </td>
    </tr>
    <tr>
        <th>記</th>
        <td><!--{if $arrErr.msg1}--><span class="attention"><!--{$arrErr.msg1}--></span><!--{/if}-->
            1行目：<input type="text" name="msg1" size="40" value="<!--{$arrForm.msg1|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <!--{if $arrErr.msg2}--><span class="attention"><!--{$arrErr.msg1}--></span><!--{/if}-->
            2行目：<input type="text" name="msg2" size="40" value="<!--{$arrForm.msg2|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <!--{if $arrErr.msg3}--><span class="attention"><!--{$arrErr.msg3}--></span><!--{/if}-->
            3行目：<input type="text" name="msg3" size="40" value="<!--{$arrForm.msg3|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <!--{if $arrErr.msg4}--><span class="attention"><!--{$arrErr.msg4}--></span><!--{/if}-->
            4行目：<input type="text" name="msg4" size="40" value="<!--{$arrForm.msg4|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <!--{if $arrErr.msg5}--><span class="attention"><!--{$arrErr.msg5}--></span><!--{/if}-->
            5行目：<input type="text" name="msg5" size="40" value="<!--{$arrForm.msg5|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <!--{if $arrErr.msg6}--><span class="attention"><!--{$arrErr.msg6}--></span><!--{/if}-->
            6行目：<input type="text" name="msg6" size="40" value="<!--{$arrForm.msg6|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN*3/5}-->"/><br />
            <span style="font-size: 80%;">※未入力時はデフォルトのメッセージが表示されます。</span><br />
        </td>
    </tr>
    <tr>
        <th>備考</th>
        <td><!--{if $arrErr.note}--><span class="attention"><!--{$arrErr.note}--></span><!--{/if}-->
            <textarea name="note" rows="8" maxlength="<!--{$smarty.const.STEXT_LEN*6}-->" style="width: 98%;"><!--{$arrForm.note|h}--></textarea><br />
            <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN*6}-->文字)</span>
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
