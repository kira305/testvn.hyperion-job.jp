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
    <li<!--{if $tpl_subno == 'index'}--> class="on"<!--{/if}--> id="navi-customer-index"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/<!--{$smarty.const.DIR_INDEX_PATH}-->"><span>会員マスター</span></a></li>
    <li<!--{if $tpl_subno == 'customer'}--> class="on"<!--{/if}--> id="navi-customer-customer"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/edit.php"><span>会員登録</span></a></li>
    <li<!--{if $tpl_subno == 'upload_csv'}--> class="on"<!--{/if}--> id="navi-customer-uploadcsv"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/upload_csv.php"><span>会員登録CSV</span></a></li>
    <li<!--{if $tpl_subno == 'search'}--> class="on"<!--{/if}--> id="navi-customer-search"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/search.php"><span>見込法人マスター</span></a></li>
    <li<!--{if $tpl_subno == 'corporate'}--> class="on"<!--{/if}--> id="navi-customer-corporate"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/corporate.php"><span>見込法人登録</span></a></li>
    <li<!--{if $tpl_subno == 'clientsearch'}--> class="on"<!--{/if}--> id="navi-customer-clientsearch"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/clientsearch.php"><span>薬局マスター</span></a></li>
    <li<!--{if $tpl_subno == 'clientcorporate'}--> class="on"<!--{/if}--> id="navi-customer-clientcorporate"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/clientcorporate.php"><span>薬局登録</span></a></li>
    <li<!--{if $tpl_subno == 'agencysearch'}--> class="on"<!--{/if}--> id="navi-customer-agencysearch"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/agency_search.php"><span>本社マスター</span></a></li>
    <li<!--{if $tpl_subno == 'agency'}--> class="on"<!--{/if}--> id="navi-customer-agency"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/agency.php"><span>本社登録</span></a></li>
    <!--{elseif $smarty.session.authority == 2}-->
    <li<!--{if $tpl_subno == 'clientsearch'}--> class="on"<!--{/if}--> id="navi-customer-clientsearch"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/clientsearch.php"><span>薬局マスター</span></a></li>
    <li<!--{if $tpl_subno == 'clientcorporate'}--> class="on"<!--{/if}--> id="navi-customer-clientcorporate"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/clientcorporate.php"><span>薬局登録</span></a></li>
    <li<!--{if $tpl_subno == 'agency'}--> class="on"<!--{/if}--> id="navi-customer-agency"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/agency.php"><span>本社登録</span></a></li>
    <!--{elseif $smarty.session.authority == 3}-->
    <li<!--{if $tpl_subno == 'clientcorporate'}--> class="on"<!--{/if}--> id="navi-customer-clientcorporate"><a href="<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->customer/clientcorporate.php"><span>薬局登録</span></a></li>
    <!--{/if}-->
</ul>
