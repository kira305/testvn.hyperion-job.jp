<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->

<!--▼HEADER-->
<div id="header_wrap">
    <div id="header" class="clearfix">
        <div id="logo_area">
            <p id="site_description">薬剤師の求人・転職・派遣はファーマプレミアム</p>
            <h1>
                <a href="<!--{$smarty.const.TOP_URLPATH}-->"><img src="<!--{$TPL_URLPATH}-->img/common/logo.gif" alt="薬剤師の求人・転職・派遣はファーマプレミアム" /><span><!--{$arrSiteInfo.shop_name|h}-->/<!--{$tpl_title|h}--></span></a>
            </h1>
            

            <!--{if $smarty.server.PHP_SELF == "/shigoto.php"}--><img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_top_on.gif" alt="薬剤師の求人・転職・派遣はファーマプレミアム" /><!--{/if}-->
        </div>
        <div id="header_utility" class=" clearfix">
            <div id="header_navi">
                <ul>
                    <li class="start">
                        <a href="<!--{$smarty.const.HTTPS_URL}-->user_data/shigoto.php" />初めての方</a>
                    </li>
                    <li class="faq">
                        <a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/qanda.php"  />Ｑ＆Ａ</a>
                    </li>
                    <li class="about">
                        <a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/corp.php"  />会社概要</a>
                    </li>
                </ul>
            </div>
            <div id="headerInternalColumn">
            <!--{* ▼HeaderInternal COLUMN*}-->
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
            <!--{* ▲HeaderInternal COLUMN*}-->
            </div>
            <div class="cnt"><a href="<!--{$smarty.const.HTTPS_URL}-->contact/index.php" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_head_cont_on.gif','contact');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_head_cont.gif','contact');"><img src="<!--{$TPL_URLPATH}-->img/button/btn_head_cont.gif" alt="お問い合わせ" name="contact" id="contact" /></a></div>
        </div>
    </div>
  <div id="gnav">
    <ul  class="clearfix">
    
    <li class="top"><a href="<!--{$smarty.const.TOP_URLPATH}-->">
    <!--{assign var=top value="`$smarty.const.ROOT_URLPATH`index.php"}--><!--{if $smarty.server.PHP_SELF==$top}-->
    <img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_top_on.gif" alt="トップページ" /><!--{/if}--><span>TOP</span></a></li>
    
    <li class="job"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/shigoto.php">
    <!--{assign var=shigoto value="`$smarty.const.ROOT_URLPATH`user_data/shigoto.php"}--><!--{if $smarty.server.PHP_SELF==$shigoto}-->
    <img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_job_on.gif" alt="薬剤師派遣" /><!--{/if}--><span>薬剤師派遣</span></a></li>
    
    <li class="supp"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/service.php">
    <!--{assign var=service value="`$smarty.const.ROOT_URLPATH`user_data/service.php"}--><!--{if $smarty.server.PHP_SELF==$service}-->
    <img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_supp_on.gif" alt="派遣サービス" /><!--{/if}--><span>派遣サービス</span></a></li>
    
    <li class="info"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/useful.php">
    <!--{assign var=useful value="`$smarty.const.ROOT_URLPATH`user_data/useful.php"}--><!--{if $smarty.server.PHP_SELF==$useful}-->
    <img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_info_on.gif" alt="お役立ち情報" /><!--{/if}--><span>お役立ち情報</span></a></li>
    
    <li class="corp"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/houjin.php">
    <!--{assign var=houjin value="`$smarty.const.ROOT_URLPATH`user_data/houjin.php"}--><!--{if $smarty.server.PHP_SELF==$houjin}-->
    <img src="<!--{$TPL_URLPATH}-->img/common/gnavi/nav_corp_on.gif" alt="人材をお探しの法人の方" /><!--{/if}--><span>人材をお探しの法人の方</span></a></li>
    </ul>
  </div>
</div>
<!--▲HEADER-->