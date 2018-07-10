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

<div id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <div id="mycontents_area">
        <h3><!--{$tpl_subtitle|h}--></h3>
        <p>下記の内容で登録してもよろしいでしょうか？<br>
よろしければ、一番下の「完了ページへ」ボタンをクリックしてください。</p>

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="complete" />
        <input type="hidden" name="customer_id" value="<!--{$arrForm.customer_id|h}-->" />
        <!--{foreach from=$arrForm key=key item=item}-->
            <!--{if $key ne "mode" && $key ne "subm"}-->
            <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
            <!--{/if}-->
        <!--{/foreach}-->
        <table summary=" " class="delivname">
            <col width="30%" />
            <col width="70%" />
            <tr>
                <th>銀行名<span class="attention">※</span></th>
                <td><!--{$arrForm.bank|h}--></td>
            </tr>
            <tr>
                <th>銀行支店名<span class="attention">※</span></th>
                <td><!--{$arrForm.bank_branch|h}--></td>
            </tr>
            <tr>
                <th>金融機関コード<span class="attention">※</span></th>
                <td><!--{$arrForm.bank_code|h}--></td>
            </tr>
            <tr>
                <th>支店番号<span class="attention">※</span></th>
                <td><!--{$arrForm.branch_code|h}--></td>
            </tr>
            <tr>
                <th>口座名義<span class="attention">※</span></th>
                <td><!--{$arrForm.account_holder1|h}--> <!--{$arrForm.account_holder1|h}--></td>
            </tr>
            <tr>
                <th>預金種目<span class="attention">※</span></th>
                <td><!--{$arrFLAG[$arrForm.event_deposit]|h}--></td>
            </tr>
            <tr>
                <th>口座番号s<span class="attention">※</span></th>
                <td><!--{$arrForm.account_number|h}--></td>
            </tr>
        </table>

        <div class="btn_area">
            <ul>
                <li>
                    <a href="?" onclick="fnModeSubmit('return', '', ''); return false;" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg','back');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg','back');">
                        <img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" name="back" id="back" /></a>
                </li>
                <li>
                    <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete_on.gif',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_complete.jpg" alt="送信" name="complete" id="complete" />
                </li>
            </ul>
        </div>
        </form>
    </div>
</div>
