        </div>
        <div class="tab_menu_contents_2">
            <h2 class="tab"><a href="/user_data/keep_list.php" class="none">キープしたお仕事 <!--{if count($arrKeepList) > 0}--><span>#<!--{$smarty.session.keep_product_list|@count}--></span><!--{/if}--></a></h2></a>
            <!--{if count($arrKeepList) == 0}-->
                <p class="keep0">[!] キープしたお仕事はありません</p>
         <p class="keep0">[!] 気になるお仕事は <a href="/user_data/keep_list.php" class="none">マイリスト</a> に保存出来ます</p>
         <p class="keep0">[!] <a href="/user_data/member_entry.php" class="none">会員登録</a> をしてより便利にHyperion@Job!をご利用下さい</p>
            <!--{else}--> 
            <ol>
                <!--{foreach from=$arrKeepList key=index item=item name=foo}-->
                <li><span>#<!--{$smarty.foreach.foo.iteration}--></span>
                    <dl>
                        <dd><!--{$item.sub_comment1|h|nl2br}--></dd>
                        <dt>
                            <a href="<!--{$smarty.const.ROOT_URLPATH}-->products/detail.php?product_id=<!--{$item.product_id}-->">
                                <!--{$item.name|h|nl2br}-->
                            </a>
                        </dt>
                    </dl>
                </li>
                <!--{/foreach}-->
            </ol>
            <!--{if $smarty.session.keep_product_list|@count > 3}-->
            <p class="readmore"><a class="readmore" href="/user_data/keep_list.php">Read More →</a></p>
            <!--{/if}-->
            <!--{/if}-->
        </div>
        <div class="tab_menu_contents_3">
            <h2 class="tab">おすすめのお仕事</h2>
            <ol>
                <!--{section name=data loop=$arrNews max=3}-->
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
        <div class="tab_menu_contents_4" style="display: none">
            <h2 class="tab">バナー広告</h2>
            <ul>
                <li><a href="">リンク2</a></li>
                <li><a href="">リンク</a></li>
                <li><a href="">リンク</a></li>
                <li><a href="">リンク</a></li>
                <li><a href="">リンク</a></li>
            </ul>
        </div>
    </div>
</div>