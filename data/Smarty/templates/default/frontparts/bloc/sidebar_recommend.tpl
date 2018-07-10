<style>
.sidebar_recommend{
    width: 220px;
    padding: 5px;
    background-color: white;
    margin-top: 1em;
}
.sidebar_recommend ol li{
    background-color: transparent;
    padding-left: 0;
    margin-bottom: 10px;
}
</style>
<div class="tab_menu_contents_3 sidebar_recommend">
    <h2 class="tab">おすすめのお仕事</h2>
    <ol>
        <!--{section name=data loop=$arrNews}-->
        <li><span>#<!--{$smarty.section.data.index+1}--></span>
            <dl>
                <dd><!--{$arrNews[data].news_comment|h|nl2br}--></dd>
                <dt>
                <a <!--{if $arrNews[data].news_url}--> href="<!--{$arrNews[data].news_url}-->" <!--{if $arrNews[data].link_method eq "2"}--> target="_blank"<!--{/if}--><!--{/if}--> >
                    <!--{$arrNews[data].news_title|h|nl2br}-->
            </a>
            </dt>
        </dl>
    </li>
    <!--{/section}-->
</ol>
</div>