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

<ul class="level1">
    <!--{if $smarty.session.authority == 0 || $smarty.session.authority == 1 || $smarty.session.authority == 4}-->
    <li id="navi-job-index" class="<!--{if $tpl_mainno == 'job' && $tpl_subno == 'index'}-->on<!--{/if}-->"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/<!--{$smarty.const.DIR_INDEX_PATH}-->"><span>依頼管理</span></a></li>
    <li id="navi-job-add" class="<!--{if $tpl_mainno == 'job' && $tpl_subno == 'add'}-->on<!--{/if}-->"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/edit.php?mode=add&<!--{$smarty.const.TRANSACTION_ID_NAME}-->=<!--{$transactionid}-->"><span>依頼登録</span></a></li>
    <!--{else}-->
    <li id="navi-job-schedule" class="<!--{if $tpl_mainno == 'job' && $tpl_subno == 'schedule'}-->on<!--{/if}-->"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/schedule.php"><span>スケジュール管理</span></a></li>
    <!--{/if}-->
</ul>
