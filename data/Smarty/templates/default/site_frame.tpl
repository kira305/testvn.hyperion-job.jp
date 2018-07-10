<!--{printXMLDeclaration}--><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" class="<!--{$tpl_page_class_name|h}-->">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<!--{$smarty.const.CHAR_CODE}-->" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link rel="stylesheet" href="<!--{$TPL_URLPATH}-->css/import.css" type="text/css" media="all" />
<link rel="alternate" type="application/rss+xml" title="RSS" href="<!--{$smarty.const.HTTP_URL}-->rss/<!--{$smarty.const.DIR_INDEX_PATH}-->" />
<!--{if $tpl_page_category == "abouts"}-->
<!--{if ($smarty.server.HTTPS != "") && ($smarty.server.HTTPS != "off")}-->
<script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?sensor=false"></script>
<!--{else}-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--{/if}-->
<!--{/if}-->
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/css.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/navi.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/win_op.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/site.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<!--{$TPL_URLPATH}-->js/scrollsmoothly.js"></script>

<script type="text/javascript" src="<!--{$TPL_URLPATH}-->js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<!--{$TPL_URLPATH}-->js/hypscript.js"></script>

<!--{if $tpl_title == "TOPページ" || $tpl_title == "商品一覧ページ" || $tpl_title == "商品詳細ページ"}-->
<title>埼玉川越・所沢・朝霞の求人情報ハイペリオン　単発、日払い多数</title>
<!--{elseif $tpl_title == "ハイペリオンで働くメリット"}-->
<title>お祝い金、奨励金、時給アップ、お友達紹介でお得にお仕事</title>
<!--{else}-->
<title><!--{$tpl_title|escape}-->　埼玉川越・所沢・朝霞の求人情報ハイペリオン</title>
<!--{/if}-->
<meta name="description" content="<!--{$arrPageLayout.description|escape}-->" />
<meta name="keywords" content="<!--{$arrPageLayout.keyword|escape}-->" />


<link rel="shortcut icon" href="<!--{$TPL_URLPATH}-->img/common/favicon1.ico" />
<link rel="icon" type="image/vnd.microsoft.icon" href="<!--{$TPL_URLPATH}-->img/common/favicon1.ico" />

<script type="text/javascript">//<![CDATA[
    <!--{$tpl_javascript}-->
    $(function(){
        <!--{$tpl_onload}-->
    });
//]]></script>

<!--{* ▼Head COLUMN*}-->
<!--{if $arrPageLayout.HeadNavi|@count > 0}-->
    <!--{* ▼上ナビ *}-->
    <!--{foreach key=HeadNaviKey item=HeadNaviItem from=$arrPageLayout.HeadNavi}-->
        <!--{* ▼<!--{$HeadNaviItem.bloc_name}--> ここから*}-->
        <!--{if $HeadNaviItem.php_path != ""}-->
            <!--{include_php file=$HeadNaviItem.php_path}-->
        <!--{else}-->
            <!--{include file=$HeadNaviItem.tpl_path}-->
        <!--{/if}-->
        <!--{* ▲<!--{$HeadNaviItem.bloc_name}--> ここまで*}-->
    <!--{/foreach}-->
    <!--{* ▲上ナビ *}-->
<!--{/if}-->
<!--{* ▲Head COLUMN*}-->
</head>

<!-- ▼BODY部 スタート -->
<!--{include file='./site_main.tpl'}-->
<!-- ▲BODY部 エンド -->
</html>
