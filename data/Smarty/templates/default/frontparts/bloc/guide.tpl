<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->

<div class="block_outer">
    <div id="guide_area" class="block_body">
        <!--{strip}-->
            <ul class="button_like">
                <li>
                    <a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/glossary.php">用語集</a></li>
                <li>
                    <a href="<!--{$smarty.const.ROOT_URLPATH}-->abouts/<!--{$smarty.const.DIR_INDEX_PATH}-->" class="<!--{if $tpl_page_category == "abouts"}--> selected<!--{/if}-->"
                    >当サイトについて</a></li>
                <li>
                    <a href="<!--{$smarty.const.HTTPS_URL}-->contact/<!--{$smarty.const.DIR_INDEX_PATH}-->" class="<!--{if $tpl_page_category == "contact"}--> selected<!--{/if}-->"
                    >お問い合わせ</a></li>
                <li>
                    <a href="<!--{$smarty.const.ROOT_URLPATH}-->guide/privacy.php" class="<!--{if $tpl_page_category == "order"}--> selected<!--{/if}-->"
                    >プライバシーポリシー</a></li>
            </ul>
        <!--{/strip}-->
        <div style="height: 0px; overflow: hidden;"></div><!--{* IE6ハック(背景乱れ防止) *}-->
    </div>
</div>