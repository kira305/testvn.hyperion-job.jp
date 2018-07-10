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
<style>
    .narrowPaddingTable tr th, .narrowPaddingTable tr td{
        padding: 4px;
    }
</style>
<section id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <!--{if $tpl_subtitle != ''}--><h3 class="title_mypage"><!--{$tpl_subtitle|h}--></h3><!--{/if}-->

    <form name="form1" id="form1" method="post" action="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/work_possible_date.php" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />

        <!--{if $page == 'list'}-->
        <input type="hidden" name="mode" value="confirm" />
        <div class="form_area">
            <div class="intro">
                <p><span class="attention">勤務可能な日に勤務可能時間帯を選び、</span></p>
                <p><span class="attention">登録をしてください</span></p>
            </div>
            <div class="cartinarea clearfix">
                <table class="narrowPaddingTable">
                    <tr>
                        <th>日付</th>
                        <th>時間帯</th>
                        <th>残業可</th>
                    </tr>
                    <!--{section name=cnt loop=$arrForm.working_date.value}-->
                    <!--{assign var=index value="`$smarty.section.cnt.index`"}-->
                    <tr>
                        <td>
                            <!--{assign var=dayOfWeek value=$arrForm.working_date.value[$index]|date_format:'%u'}-->
                            <!--{$arrForm.working_date.value[$index]|date_format:"%m/%d"}-->（<!--{$jpWeek[$dayOfWeek]}-->）
                            <input type="hidden" name="working_date[<!--{$index}-->]" value="<!--{$arrForm.working_date.value[$index]|h}-->" />
                        </td>
                        <td>
                            <span class="attention"><!--{$arrErr[$index]}--></span>
                            <select name="working_start[<!--{$index}-->]" class="data-role-none">
                                <option value="">----</option>
                                <!--{html_options options=$arrTime selected=$arrForm.working_start.value[$index]}-->
                            </select>～<select name="working_over[<!--{$index}-->]" class="data-role-none">
                                <option value="">----</option>
                                <!--{html_options options=$arrTime selected=$arrForm.working_over.value[$index]}-->
                            </select>
                        </td>
                        <td><input type="checkbox" value="1" name="overtime_allowed[<!--{$index}-->]" class="data-role-none" style="display: inline-block" <!--{if $arrForm.overtime_allowed.value[$index] == 1}-->checked<!--{/if}--> /> 可</td>
                    </tr>
                    <!--{/section}-->
                </table>
                <a href="work_possible_date_history.php">申請履歴</a>
            </div>
        </div>
        <div class="btn_area">
            <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">確認する</span></button>
        </div>

        <!--{elseif $page == 'confirm'}-->
        <div class="intro">
            <p>以下の内容でよろしいでしょうか？</p>
        </div>
        <input type="hidden" name="mode" value="complete" />
        <!--{foreach key=key item=item from=$arrForm}-->
        <!--{if is_array($item)}-->
        <!--{foreach key=c_key item=c_item from=$item.value}-->
        <input type="hidden" name="<!--{$key|h}-->[<!--{$c_key|h}-->]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
        <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item.value|h}-->" />
        <!--{/if}-->
        <!--{/foreach}-->

        <div class="cartinarea clearfix">
            <table class="narrowPaddingTable">
                <tr>
                    <th>日付</th>
                    <th>時間帯</th>
                    <th>残業可</th>
                </tr>
                <!--{section name=cnt loop=$arrForm.working_date.value}-->
                <!--{assign var=index value="`$smarty.section.cnt.index`"}-->
                <!--{assign var=start value=$arrForm.working_start.value[$index]}-->
                <!--{assign var=over value=$arrForm.working_over.value[$index]}-->
                <!--{if $start != ''}-->
                <tr>
                    <td>
                        <!--{assign var=dayOfWeek value=$arrForm.working_date.value[$index]|date_format:'%u'}-->
                        <!--{$arrForm.working_date.value[$index]|date_format:"%m/%d"}-->（<!--{$jpWeek[$dayOfWeek]}-->）
                    </td>
                    <td><!--{$arrTime[$start]}-->～<!--{$arrTime[$over]}--></td>
                    <td><!--{if $arrForm.overtime_allowed.value[$index] == 1}-->可<!--{else}-->不可<!--{/if}--></td>
                </tr>
                <!--{/if}-->
                <!--{/section}-->
            </table>
        </div>            
        <ul class="btn_btm">
            <li><a class="btn_back" href="Javascript:fnModeSubmit('return', '', '');" rel="external">戻る</a></li>
            <li><input type="submit" value="登録する" class="btn data-role-none" alt="登録する" name="complete" id="complete" /></li>
        </ul>

        <!--{elseif $page == 'complete'}-->
        <div class="intro">
            <p>登録が完了しました。</p>
        </div>
        <div class="btn_area">
            <ul class="btn_btm">
                <li><a class="btn_back" href="/mypage" rel="external">登録した日付で求人を検索</a></li>
            </ul>
        </div>
        <!--{/if}-->
    </form>
</section>