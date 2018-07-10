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
    input[type="checkbox"]{
        display: inline;
    }
    .narrowPaddingTable tr th, .narrowPaddingTable tr td{
        padding: 4px;
    }
</style>

<section id="mypagecolumn">
    <h2 class="title"><!--{$tpl_title|h}--></h2>
    <!--{include file=$tpl_navi}-->
    <!--{if $tpl_subtitle != ''}--><h3 class="title_mypage"><!--{$tpl_subtitle|h}--></h3><!--{/if}-->

    <form name="form1" id="form1" method="post" action="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/work_report.php" enctype="multipart/form-data">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="page" value="<!--{$page|h}-->" />
        <input type="hidden" name="mode" value="save" />

        <!--{if $page == 'list'}-->
        <div class="form_area">
            <div class="intro">
            <!--{if $noresult}-->
                <p><span class="attention">「随時振込申請できる就業実績がございません。</span></p>
                <p><span class="attention">先に「勤怠入力」メニューから就業実績を登録してください。」</span></p>            
            <!--{else}-->
                <p><span class="attention">月払い　週払いを選択されている方は申請不要です。</span></p>
                <p><span class="attention">20時00分を過ぎると翌々日の手続きになります。</span></p>
            <!--{/if}-->
            </div>
            <div class="cartinarea clearfix">
                <p style="float: left; margin-right: 10px; margin-bottom: 10px;">随時振込申請履歴</p>
                <select class="data-role-none" name="yearmonth" onchange="fnModeSubmit('changeMonth', '', ''); return false;" style="float: left">
                    <option value="">----</option>
                    <!--{html_options options=$arrYearMonth selected=$selectedYearMonth}-->
                </select>
                <!--{if count($arrForm) > 0}-->
                <table class="narrowPaddingTable">
                    <tr>
                        <th></th>
                        <th>就業日</th>
                        <th>就業先名</th>
                        <th>申請日時</th>
                        <th>ステータス</th>
                    </tr>
                    <!--{foreach from=$arrForm item=result}-->
                    <tr>
                        <td><!--{if $result.apply_flg == 0}--><input type="checkbox" name="id[]" value="<!--{$result.id|h}-->" /><!--{/if}--></td>
                        <td><!--{$result.working_date|date_format:"%m/%d"}--></td>
                        <td><!--{$result.company_name|h}--></td>
                        <td><!--{$result.apply_date|date_format:"%m/%d %H:%M"}--></td>
                        <td><!--{$arrApplyStatus[$result.apply_flg]}--></td>
                    </tr>
                    <!--{/foreach}-->
                </table>
                <div class="btn_area">
                    <button class="icon-btn icon-btn-send" type="submit"><span class="icon-btn-text">申請する</span></button>
                </div>
                <!--{/if}-->
            </div>
        </div>

        <!--{elseif $page == 'complete'}-->
        <div class="intro">
            <p>申請完了しました！</p><br />
            <p style="color: orange; font-size: 200%; text-align: center">振込予定日は<br /><!--{$_month}-->月<!--{$_day}-->日です。</p>
        </div>
        <div class="btn_area">
            <ul class="btn_btm">
                <li><a style="display: inline; padding: 5px;" class="btn_back" href="/mypage" rel="external">ＭＹページへ</a></li>
            </ul>
        </div>
        <!--{/if}-->
    </form>
</section>