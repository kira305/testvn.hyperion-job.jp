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
    <li<!--{if $tpl_subno == 'index'}--> class="on"<!--{/if}--> id="navi-staff-index"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->staff/<!--{$smarty.const.DIR_INDEX_PATH}-->?search_is_haken=0"><span>HYP従業員マスタ</span></a></li>
    <li<!--{if $tpl_subno == 'haken'}--> class="on"<!--{/if}--> id="navi-staff-haken"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->staff/<!--{$smarty.const.DIR_INDEX_PATH}-->?search_is_haken=1"><span>派遣スタッフマスタ</span></a></li>
    <!--{if $smarty.session.authority == 4 && $smarty.session.member_id == 18}-->
    <li<!--{if $tpl_subno == 'log'}--> class="on"<!--{/if}--> id="navi-staff-log"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->staff/log.php"><span>ログ表示</span></a></li>
    <!--{/if}-->
</ul>
