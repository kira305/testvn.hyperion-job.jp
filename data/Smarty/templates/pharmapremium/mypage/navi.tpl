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

<nav id="mypage_nav">
    <!--{strip}-->
    <!--{if $tpl_login}-->
        <!--{* 会員状態 *}-->
        <ul>
            <li><a href="change.php" class="<!--{if $tpl_mypageno == 'change'}--> selected<!--{/if}-->" rel="external">会員内容変更</a></li>
            <li><a href="./<!--{$smarty.const.DIR_INDEX_PATH}-->" class="<!--{if $tpl_mypageno == 'index'}--> selected<!--{/if}-->" rel="external">応募履歴</span></a></li>
            <li><a href="refusal.php" class="<!--{if $tpl_mypageno == 'refusal'}--> selected<!--{/if}-->" rel="external">退会手続き</a></li>
        </ul>
        <ul>
            <li><a href="prepayment_apply.php" class="<!--{if $tpl_mypageno == 'prepayment_apply'}--> selected<!--{/if}-->" rel="external">就業実績報告</a></li>
            <!--{if $CustomerSalaryType != 1 && $CustomerSalaryType != 2}-->
            <li><a href="work_report.php" class="<!--{if $tpl_mypageno == 'work_report'}--> selected<!--{/if}-->" rel="external">随時振込申請</a></li>
            <!--{/if}-->
            <li><a href="work_possible_date.php" class="<!--{if $tpl_mypageno == 'work_possible_date'}--> selected<!--{/if}-->" rel="external">勤務可能日登録</a></li>
        </ul>
    <!--{else}-->
        <!--{* 退会状態 *}-->
        <ul>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'change'}--> selected<!--{/if}-->" rel="external">会員内容変更</a></li>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'index'}--> selected<!--{/if}-->" rel="external">応募履歴</a></li>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'refusal'}--> selected<!--{/if}-->" rel="external">退会手続き</a></li>
        </ul>
        <ul>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'prepayment_apply'}--> selected<!--{/if}-->" rel="external">就業実績報告</a></li>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'work_report'}--> selected<!--{/if}-->" rel="external">就業実績報告</a></li>
            <li><a href="<!--{$smarty.const.TOP_URLPATH}-->" class="<!--{if $tpl_mypageno == 'work_possible_date'}--> selected<!--{/if}-->" rel="external">勤務可能日登録</a></li>
        </ul>
    <!--{/if}-->
    <!--{/strip}-->
</nav>
<!--▲NAVI-->
