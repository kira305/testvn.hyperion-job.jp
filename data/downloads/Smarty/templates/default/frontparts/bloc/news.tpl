<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->
<div class="block_news">
    <div id="news_area">
    <h2><img src="<!--{$TPL_URLPATH}-->img/title/tit_bloc_news.jpg" alt="新着情報" /><span class="rss"><a href="<!--{$smarty.const.ROOT_URLPATH}-->rss/<!--{$smarty.const.DIR_INDEX_PATH}-->" target="_blank"><img src="<!--{$TPL_URLPATH}-->img/button/btn_rss.gif" alt="RSS" /></a></span></h2>
        <div class="block_body">
            <div class="news_contents">
            <!--{section name=data loop=$arrNews}-->
            <!--{assign var="date_array" value="-"|explode:$arrNews[data].news_date_disp}-->
            <dl class="newslist">
                <dt class="title"><!--{$date_array[0]}-->/<!--{$date_array[1]}-->/<!--{$date_array[2]}--></dt>
                <dt class="title">
                    <a
                        <!--{if $arrNews[data].news_url}--> href="<!--{$arrNews[data].news_url}-->" <!--{if $arrNews[data].link_method eq "2"}--> target="_blank"
                            <!--{/if}-->
                        <!--{/if}-->
                    >
                        <!--{$arrNews[data].news_title|h|nl2br}--></a>
                </dt>
                <dd class="mini"><!--{$arrNews[data].news_comment|h|nl2br}--></dd>
            </dl>
            <!--{/section}-->
            </div>
        </div>
    </div>
</div>