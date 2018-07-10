<nav class="test_menu clearfix">
    <!--{if $tpl_login}-->
        <ul>
            <li><a rel="external" href="javascript:void(document.login_form_bloc.submit())" data-transition="slideup" class="bl">ログアウト</a></li>
            <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup" class="bc">Myページ</a></li>
            <li><a rel="external" href="<!--{$smarty.const.CART_URLPATH|h}-->" class="br">気になる求人</a></li>
        </ul>
    <!--{else}-->
        <ul>
            <li><a href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup" class="bl">ログイン</a></li>
            <li><a href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/mypage/login.php" data-transition="slideup" class="bc">Myページ</a></li>
            <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL|sfTrimURL}-->/entry/kiyaku.php" class="br">新規会員登録</a></li>
        </ul>
    <!--{/if}-->
</nav>

<div class="ui-body">

<div data-role="collapsible-set" data-theme="g" data-content-theme="g">

	<div data-role="collapsible">
	<h3>おすすめコンテンツ</h3>
	<ul class="opmenu">
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/support.php" data-transition="slideup">充実のサポート体制</a></li>
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/spot.php" data-transition="slideup">スポット派遣について</a></li>
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/intro.php" data-transition="slideup">お友達紹介制度のご案内</a></li>
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/faq.php" data-transition="slideup">よくある質問Ｑ＆Ａ</a></li>
        <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL}-->contact/<!--{$smarty.const.DIR_INDEX_PATH|h}-->">お問い合わせ</a></li>
    </ul>
	</div>

	<div data-role="collapsible">
	<h3>人材をお探しの法人の方</h3>
	<ul class="opmenu">
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/houjin.php" data-transition="slideup">薬剤師派遣について</a><span class="arrow"></span></li>
        <li><a rel="external" href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/corp.php" data-transition="slideup">会社概要</a></li>
        <li><a rel="external" href="<!--{$smarty.const.HTTP_URL}-->abouts/<!--{$smarty.const.DIR_INDEX_PATH|h}-->">当サイトについて</a></li>
        <li><a rel="external" href="<!--{$smarty.const.HTTPS_URL}-->contact/<!--{$smarty.const.DIR_INDEX_PATH|h}-->">お問い合わせ</a></li>
    </ul>
	</div>

</div>
</div>