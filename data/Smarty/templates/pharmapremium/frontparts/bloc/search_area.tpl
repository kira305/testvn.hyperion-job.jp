<!-- ▼検索バー -->
<section id="search_area">
<h2 class="title_block">キーワード検索</h2>
    <form method="get" action="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="search" />
        <input type="search" name="name" id="search" value="" placeholder="キーワードを入力" class="searchbox" />
    </form>
</section>
<!-- ▲検索バー -->