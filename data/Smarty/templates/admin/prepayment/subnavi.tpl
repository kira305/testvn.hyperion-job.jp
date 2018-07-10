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
    <!--{if $smarty.session.authority == 0 || $smarty.session.authority == 1}-->
    <li<!--{if $tpl_subno == 'index'}--> class="on"<!--{/if}--> id="navi-prepayment-index"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->prepayment/<!--{$smarty.const.DIR_INDEX_PATH}-->"><span>勤怠管理マスタ</span></a></li>
    <li<!--{if $tpl_subno == 'edit'}--> class="on"<!--{/if}--> id="navi-prepayment-edit"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->prepayment/edit.php"><span>勤怠登録</span></a></li>
    <li<!--{if $tpl_subno == 'work_report'}--> class="on"<!--{/if}--> id="navi-prepayment-work_report"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->prepayment/work_report.php"><span>随時振込申請管理</span></a></li>
    <!--{/if}-->
</ul>
