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

<h2 class="title_block"><span class="miniM">薬剤師の求人・転職・派遣はファーマプレミアム</span></h2>
<ul class="footer_navi">
    <li class="br"><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->">トップページへ</a></li>
    <!--{if $tpl_login}-->
        <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php">MYページ</a></li>
        <!--<li><a rel="external" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/favorite.php">お気に入り</a></li>-->
    <!--{else}-->
        <li><a data-transition="slideup" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php">MYページ</a></li>
        <!--<li><a data-transition="slideup" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php">お気に入り</a></li>-->
    <!--{/if}-->
    <li class="br"><a rel="external" href="<!--{$smarty.const.HTTP_URL}-->abouts/<!--{$smarty.const.DIR_INDEX_PATH|h}-->">当サイトについて</a></li>
    <li><a rel="external" href="<!--{$smarty.const.CART_URLPATH|h}-->">気になる求人を見る</a></li>
    <li class="br"><a rel="external" href="<!--{$smarty.const.HTTP_URL}-->guide/privacy.php">プライバシーポリシー</a></li>
    <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL}-->contact/<!--{$smarty.const.DIR_INDEX_PATH|h}-->">お問い合わせ</a></li>
</ul>
