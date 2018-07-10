<!--{*
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
 *}-->

<nav class="top_menu clearfix">
    <!--{if $tpl_login}-->
        <ul>
            <li><a rel="external" href="javascript:void(document.login_form_bloc.submit())" data-transition="slideup">ログアウト</a></li>
            <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup">MYページ</a></li>
            <li class="psetA"><a rel="external" href="<!--{$smarty.const.CART_URLPATH|h}-->">気になる求人</a></li>
            <li class="psetB"><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/support.php" data-transition="slideup">充実サポート</a></li>
            <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/spot.php" data-transition="slideup">スポット派遣</a></li>
            <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/houjin.php" data-transition="slideup">法人の方</a></li>
        </ul>
    <!--{else}-->
        <ul>
            <li><a href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup">ログイン</a></li>
            <li><a href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup">MYページ</a></li>
            <li class="psetA"><a rel="external" href="<!--{$smarty.const.CART_URLPATH|h}-->">気になる求人</a></li>
            <li class="psetB"><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/support.php" data-transition="slideup">充実サポート</a></li>
            <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/spot.php" data-transition="slideup">スポット派遣</a></li>
            <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/houjin.php" data-transition="slideup">法人の方</a></li>
        </ul>
    <!--{/if}-->
</nav>

<form name="login_form_bloc" id="login_form_bloc" method="post" action="<!--{$smarty.const.HTTPS_URL}-->frontparts/login_check.php" onsubmit="return fnCheckLogin('login_form_bloc')">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="logout" />
    <input type="hidden" name="url" value="<!--{$smarty.server.SCRIPT_NAME|h}-->" />
</form>
