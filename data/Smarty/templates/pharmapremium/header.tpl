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

<header class="global_header clearfix" style="display: none">
    <h1><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->"><img src="<!--{$TPL_URLPATH}-->img/header/logo.png" width="150" height="25" alt="<!--{$arrSiteInfo.shop_name|h}-->" /></a></h1>
    <div class="header_utility">
        <!--{* ▼HeaderInternal COLUMN *}-->
        <!--{if $arrPageLayout.HeaderInternalNavi|@count > 0}-->
        <!--{* ▼上ナビ *}-->
        <!--{foreach key=HeaderInternalNaviKey item=HeaderInternalNaviItem from=$arrPageLayout.HeaderInternalNavi}-->
        <!-- ▼<!--{$HeaderInternalNaviItem.bloc_name}--> -->
        <!--{if $HeaderInternalNaviItem.php_path != ""}-->
        <!--{include_php file=$HeaderInternalNaviItem.php_path items=$HeaderInternalNaviItem}-->
        <!--{else}-->
        <!--{include file=$HeaderInternalNaviItem.tpl_path items=$HeaderInternalNaviItem}-->
        <!--{/if}-->
        <!-- ▲<!--{$HeaderInternalNaviItem.bloc_name}--> -->
        <!--{/foreach}-->
        <!--{* ▲上ナビ *}-->
        <!--{/if}-->
        <!--{* ▲HeaderInternal COLUMN *}-->
    </div>
</header>

<form name="header_login_form" id="header_login_form" method="post" action="<!--{$smarty.const.ROOT_URLPATH}-->frontparts/login_check.php" onsubmit="return fnCheckLogin('header_login_form')">
    <input type="hidden" name="mode" value="logout" />
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="url" value="/" />
    <nav class="header_navi">
        <ul>
            <li><a href="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/user_data/member_entry.php"><img src="<!--{$TPL_URLPATH}-->img/icon/icon_arrow_01.gif" alt="" /> &nbsp;新規会員登録</a></li>
            <li><a href="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/user_data/qanda.php"><img src="<!--{$TPL_URLPATH}-->img/icon/icon_arrow_01.gif" alt="" /> &nbsp;ヘルプ</a></li>
            <!--{if $tpl_login}-->
            <li style="display: none"><a href="#" onclick="fnFormModeSubmit('header_login_form', 'logout', '', ''); return false;"><img src="<!--{$TPL_URLPATH}-->img/icon/icon_arrow_01.gif" alt="" /> &nbsp;ログアウト</a></li>
            <li><a href="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/change.php"><img src="<!--{$TPL_URLPATH}-->img/icon/icon_arrow_01.gif" alt="" /> &nbsp;MYページ</a></li>
            <!--{else}-->
            <li><a href="<!--{$smarty.const.HTTP_URL|sfTrimURL}-->/mypage/login.php"><img src="<!--{$TPL_URLPATH}-->img/icon/icon_arrow_01.gif" alt="" /> &nbsp;ログイン</a></li>
            <!--{/if}-->
        </ul>
    </nav>
</form>

<h1 style="text-align: center;"><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->"><img src="<!--{$TPL_URLPATH}-->img/header/logo.png" alt="<!--{$arrSiteInfo.shop_name|h}-->" style="width: 80%;" /></a></h1>

<div id="gnav_contents">
    <ul class="clearfix">
        <li class="job"><a href="/user_data/search.php"><span>お仕事検索</span></a></li>
        <li class="mylist"><a href="/user_data/keep_list.php"  ><span>マイリスト</span></a></li>
        <li class="aboutus"><a href="/user_data/corp.php"  ><span>ハイペリオン</span></a></li>
        <li class="contact"><a href="/contact/index.php"  ><span>お問い合わせ</span></a></li>
    </ul>
</div>
