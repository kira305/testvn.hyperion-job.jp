		<div class="block_outer">
    		<div id="news_area">
        		<h2>新着・おすすめ求人情報　
            <span class="rss"><a href="<!--{$smarty.const.ROOT_URLPATH}-->rss/<!--{$smarty.const.DIR_INDEX_PATH}-->" target="_blank">RSS</a></span>
        </h2>
        <div class="block_body">
            <ul class="news_contents">
            <!--{section name=data loop=$arrNews1}-->
            <!--{assign var="date_array" value="-"|explode:$arrNews1[data].news_date_disp}-->
            <li class="newslist">
                    <!--{if count($arrNews1[data].status) > 0}-->
                        <ul class="status_icon clearfix">
                            <!--{foreach from=$arrNews1[data].status item=status}-->
                                <li><img src="<!--{$TPL_URLPATH}--><!--{$arrEMPSTATUS_IMAGE[$status]}-->"alt="<!--{$arrEMPSTATUS[$status]}-->"/></li>
                           <!--{/foreach}-->
                       </ul>
                    <!--{else}-->
                        &nbsp;
                    <!--{/if}-->
                <div class="date"><!--{$date_array[0]}-->/<!--{$date_array[1]}-->/<!--{$date_array[2]}--></div>
                <div class="area"><!--{$arrNews1[data].news_comment|h|nl2br}--></div>
                <div class="txt">
                    <a <!--{if $arrNews1[data].news_url}--> href="<!--{$arrNews1[data].news_url}-->" <!--{if $arrNews1[data].link_method eq "2"}--> target="_blank"<!--{/if}--><!--{/if}--> >
                <!--{$arrNews1[data].news_title|h|nl2br}--></a>        
                </div>
            </li>
            <!--{/section}-->
            </ul>
        </div>
    </div>
</div>