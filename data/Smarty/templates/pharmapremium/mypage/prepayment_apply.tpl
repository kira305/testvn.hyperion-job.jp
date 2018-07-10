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
    dl#contact_form_text dd textarea:focus, 
    dl#contact_form_text dd textarea:hover {
        color: #44abb9;
        background-color: #F0F3F6;
        outline:0;
        border-color: #44abb9;
    }
    div#entry_form dt span{
        background: none;
        color: red;
        font-size: 0.8em;
        padding: 0;
    }
    div#entry_form dt{
        width: 25%;
    }
    div#entry_form dd{
        width: 70%;
    }
    dl#contact_form_text dt, dl#contact_form_text dd{
        width: auto;
    }
    dl#contact_form_text dd textarea, dl#contact_form_text dd textarea:focus, dl#contact_form_text dd textarea:hover{
        height: 60px;
    }
    select.boxShort.forth{
        width: 20%;
    }
</style>
<script>
    $("document").ready(function() {
        $("#work_report_image").change(function() {
            fnModeSubmit('upload_image', 'image_key', 'work_report_image');
        });
    });
</script>

<section id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <!--{if $tpl_subtitle != ''}--><h3 class="title_mypage"><!--{$tpl_subtitle|h}--></h3><!--{/if}-->

    <form name="form1" id="form1" method="post" action="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/prepayment_apply.php" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="page" value="<!--{$page|h}-->" />

        <!--{if $page == 'list'}-->
        <input type="hidden" name="mode" value="new" />
        <div class="form_area">
            <p style="text-align: center"><a class="btn_btm" style="text-align: center;" href="javascript:void(document.form1.submit())" rel="external">新規入力</a></p>
            
            <div class="cartinarea clearfix">
                <p style="float: left; margin-right: 10px; margin-bottom: 10px;">報告履歴</p>
                <select class="data-role-none" name="yearmonth" onchange="fnModeSubmit('changeMonth', '', ''); return false;" style="float: left">
                    <option value="">----</option>
                    <!--{html_options options=$arrYearMonth selected=$selectedYearMonth}-->
                </select>
                <!--{if count($arrForm) > 0}-->
                <table>
                    <tr>
                        <th>就業日</th>
                        <th>就業時間</th>
                        <th>就業先名</th>
                    </tr>
                    <!--{foreach from=$arrForm item=result}-->
                    <tr>
                        <td><!--{$result.working_date|date_format:"%m/%d"}--></td>
                        <td><!--{$result.working_start|h}-->～<!--{$result.working_over|h}--></td>
                        <td><!--{$result.company_name|h}--></td>
                    </tr>
                    <!--{/foreach}-->
                </table>
                <!--{/if}-->
            </div>
        </div>

        <!--{elseif $page == 'input'}-->
        <div class="intro">
            <p><span class="attention">※</span>は必須入力項目です。</p>
        </div>

        <input type="hidden" name="mode" value="confirm" />
        <input type="hidden" name="image_key" value="" />
        <input type="hidden" name="down_key" value="">
        <!--{foreach key=key item=item from=$arrForm.arrHidden}-->
        <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
        <!--{/foreach}-->
        <div id="entry_form">
            <div class="list_wrap_list clearfix" style="text-align: left">
                <dl>
                    <dt>就業先名&nbsp;<span class="attention">※</span></dt>
                    <dd>
                        <!--{assign var=key1 value="company_name"}-->
                        <!--{if $arrErr[$key1]}--><div class="attention"><!--{$arrErr[$key1]}--></div><!--{/if}-->
                        <input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1]|h}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" class="boxLong text data-role-none" />
                    </dd>
                    <dt>就業日&nbsp;<span class="attention">※</span></dt>
                    <dd>
                        <!--{assign var=errWorkingDate value="`$arrErr.year``$arrErr.month``$arrErr.day`"}-->
                        <!--{if $errWorkingDate}--><div class="attention"><!--{$errWorkingDate}--></div><!--{/if}-->
                        <select name="year" style="<!--{$errWorkingDate|sfGetErrorColor}-->" class="boxShort data-role-none">
                            <!--{html_options options=$arrYear selected=$arrForm.year|default:''}-->
                        </select><span class="selectdate">年</span>
                        <select name="month" style="<!--{$errWorkingDate|sfGetErrorColor}-->" class="boxShort data-role-none">
                            <!--{html_options options=$arrMonth selected=$arrForm.month|default:''}-->
                        </select><span class="selectdate">月</span>
                        <select name="day" style="<!--{$errWorkingDate|sfGetErrorColor}-->" class="boxShort data-role-none">
                            <!--{html_options options=$arrDay selected=$arrForm.day|default:''}-->
                        </select><span class="selectdate">日</span>
                    </dd>
                    <dt>就業時間&nbsp;<span class="attention">※</span></dt>
                    <dd>
                        <!--{assign var=errWorkingStart value="`$arrErr.working_start_hour``$arrErr.working_start_minute`"}-->
                        <!--{assign var=errWorkingOver value="`$arrErr.working_over_hour``$arrErr.working_over_minute`"}-->
                        <!--{if $errWorkingStart || $errWorkingOver}-->
                        <div class="attention"><!--{$errWorkingStart}--><!--{$errWorkingOver}--></div>
                        <!--{/if}-->
                        <select name="working_start_hour" style="<!--{$errWorkingStart|sfGetErrorColor}-->" class="boxShort forth data-role-none">
                            <!--{html_options options=$arrHOUR selected=$arrForm.working_start_hour|default:''}-->
                        </select>:
                        <select name="working_start_minute" style="<!--{$errWorkingStart|sfGetErrorColor}-->" class="boxShort forth data-role-none">
                            <!--{html_options options=$arrMINUTE selected=$arrForm.working_start_minute|default:''}-->
                        </select>~
                        <select name="working_over_hour" style="<!--{$errWorkingOver|sfGetErrorColor}-->" class="boxShort forth data-role-none">
                            <!--{html_options options=$arrHOUR selected=$arrForm.working_over_hour|default:''}-->
                        </select>:
                        <select name="working_over_minute" style="<!--{$errWorkingOver|sfGetErrorColor}-->" class="boxShort forth data-role-none">
                            <!--{html_options options=$arrMINUTE selected=$arrForm.working_over_minute|default:''}-->
                        </select>
                    </dd>
                    <dt>休憩時間&nbsp;<span class="attention">※</span></dt>
                    <dd>
                        <!--{assign var=errBreaktime value="`$arrErr.breaktime_hour``$arrErr.breaktime_minute`"}-->
                        <!--{if $errBreaktime}--><div class="attention"><!--{$errBreaktime}--></div><!--{/if}-->
                        <select name="breaktime_hour" style="<!--{$errBreaktime|sfGetErrorColor}-->" class="boxShort data-role-none">
                            <!--{html_options options=$arrBREAKTIME selected=$arrForm.breaktime_hour|default:''}-->
                        </select>時間
                        <select name="breaktime_minute" style="<!--{$errBreaktime|sfGetErrorColor}-->" class="boxShort data-role-none">
                            <!--{html_options options=$arrMINUTE selected=$arrForm.breaktime_minute|default:''}-->
                        </select>分
                    </dd>
                    <dt>作業日報&nbsp;<span class="attention">※</span></dt>
                    <dd>
                        <span class="attention mini">作業日報または作業確認表をお持ちの方は写真を添付してください。</span>
                        <!--{assign var=key value="work_report_image"}-->
                        <!--{if $arrErr[$key]}--><div class="attention"><!--{$arrErr[$key]}--></div><!--{/if}-->
                        <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                        <img src="<!--{$arrForm.arrFile[$key].filepath}-->" style="max-width: 100%" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                        <!--{/if}-->
                        <input type="file" name="<!--{$key}-->" id="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    </dd>
                </dl>
                <dl id="contact_form_text">
                    <dt>備考 <span class="mini">（全角<!--{$smarty.const.MTEXT_LEN}-->字以下）</span></dt>
                    <dd>
                        <!--{assign var=key1 value="memo"}-->
                        <textarea name="<!--{$key1}-->" class="box380" cols="60" rows="20" maxlength="<!--{$smarty.const.MTEXT_LEN}-->" style="<!--{$arrErr[$key1]|h|sfGetErrorColor}-->; ime-mode: active;"　><!--{$arrForm[$key1]|h}--></textarea>
                        <p><span class="attention"><!--{$arrErr[$key1]}--></span></p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="btn_area">
            <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">内容を確認する</span></button>
        </div>

        <!--{elseif $page == 'confirm'}-->
        <div class="intro">
            <p>以下の内容でお間違えないかご確認ください。</p>
        </div>

        <input type="hidden" name="mode" value="complete" />
        <!--{foreach key=key item=item from=$arrForm}-->
        <!--{if $key ne "mode" && $key ne "subm" && $key ne "arrFile"}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
        <!--{/if}-->
        <!--{/foreach}-->
        <dl class="form_entry">
            <dt>就業先名</dt>
            <dd><!--{$arrForm.company_name|h}--></dd>
            <dt>就業日</dt>
            <dd>
                <!--{if strlen($arrForm.year) > 0 && strlen($arrForm.month) > 0 && strlen($arrForm.day) > 0}-->
                <!--{$arrForm.year|h}-->年<!--{$arrForm.month|h}-->月<!--{$arrForm.day|h}-->日
                <!--{else}-->
                未登録
                <!--{/if}-->
            </dd>
            <dt>就業時間</dt>
            <dd><!--{$arrForm.working_start_hour|h}-->:<!--{$arrForm.working_start_minute|h}-->~<!--{$arrForm.working_over_hour|h}-->:<!--{$arrForm.working_over_minute|h}--></dd>
            <dt>休憩時間</dt>
            <dd><!--{$arrForm.breaktime_hour|h}-->:<!--{$arrForm.breaktime_minute|h}--></dd>
            <dt>作業日報</dt>
            <dd>
                <!--{assign var=key value="work_report_image"}-->
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.mynumber|h}-->" style="max-width: 100%" /><br />
                <!--{/if}-->
            </dd>
            <dt>備考</dt>
            <dd><!--{$arrForm.memo|h}--></dd>
        </dl>

        <div class="btn_area">
            <ul class="btn_btm">
                <li><input type="submit" value="送信" class="btn data-role-none" alt="送信" name="complete" id="complete" /></li>
                <li><a class="btn_back" href="Javascript:fnModeSubmit('return', '', '');" rel="external">修正する</a></li>
            </ul>
        </div>

        <!--{elseif $page == 'complete'}-->
        <input type="hidden" name="mode" value="new" />
        <div class="intro">
            <p>勤怠データを送信致しました。</p>
        </div>
        <div class="btn_area">
            <ul class="btn_btm">
                <li><input type="submit" value="続けて入力" class="btn data-role-none" alt="続けて入力" name="complete" id="complete" /></li>
                <li><a class="btn_back" href="/mypage" rel="external">終了</a></li>
            </ul>
        </div>
        <!--{/if}-->
    </form>
</section>