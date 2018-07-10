                    <!-- h1コンテンツヘッダー -->
                    <div id="logo_area_contents" class="clearfix">
                        <h1>
                            <a href="<!--{$smarty.const.TOP_URLPATH}-->"><span><!--{$arrSiteInfo.shop_name|h}--><!--{$tpl_title|h}-->ハイペリオンあっとジョブ</span></a>
                        </h1>   
                    </div>
                    <div id="gnav_contents">
                        <ul class="clearfix">
                            <!-- <li class="job"><a href="/" class="on" ><span>TOP</span></a></li> -->
                            <li class="job"><a href="/user_data/search.php"><span>お仕事検索</span></a></li>
                            <li class="mylist"><a href="/user_data/keep_list.php"  ><span>マイリスト</span></a></li>
                            <li class="feature" style="display: none"><a href="/user_data/feature.php"  ><span>特集</span></a></li>
                            <!-- <li class="aboutus"><a href="/user_data/corp.php"  ><span>ハイペリオン</span></a></li> -->
                            <li class="contact"><a href="/contact/index.php"  ><span>お問い合わせ</span></a></li>
                            <li class="memberentry"><a href="/user_data/member_entry.php"  ><span>新規登録</span></a></li>
                        </ul>
                    </div>
                    <div id="contact_contents">
                        <div class="block_outer clearfix">
                            <div id="header_login_area">
                                <form name="header_login_form" id="header_login_form" method="post" action="<!--{$smarty.const.ROOT_URLPATH}-->frontparts/login_check.php" onsubmit="return fnCheckLogin('header_login_form')">
                                    <input type="hidden" name="mode" value="login" />
                                    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                                    <input type="hidden" name="url" value="/" />
                                    <div class="block_body">
                                        <ul class="login_form">
                                        <!--{if $tpl_login}-->
                                            <a href="<!--{$smarty.const.ROOT_URLPATH}-->mypage/"><li class="login_name"><span class="user_name"><!--{$tpl_name1|h}--> <!--{$tpl_name2|h}--> 様 <!--{if $smarty.const.USE_POINT !== false}-->/ 所持: <!--{$tpl_user_point|number_format|default:0}-->pt<!--{/if}--></span></li></a>
                                            <!--{if !$tpl_disable_logout}-->    
                                            <li class="logout_btn"><input type="button" onclick="fnFormModeSubmit('header_login_form', 'logout', '', ''); return false;" value="ログアウト" /></li>
                                            <!--{/if}-->
                                        <!--{else}-->
                                            <li class="login_email"><input type="text" name="login_email" value="" style="ime-mode: disabled;" title="メールアドレスを入力して下さい" /></li>
                                            <li class="login_memory"><input type="checkbox" name="login_memory" id="header_login_memory" value="1" class="c_checkbox" /><label for="header_login_memory" class="c_checkbox"><span>記憶</span></label></li>
                                            <li class="pass"><input type="password" name="login_pass" title="パスワードを入力して下さい" /></li>
                                            <li class="login_btn"><input type="submit" value="ログイン" /></li>
                                            <li class="login_forgot"><a href="<!--{$smarty.const.ROOT_URLPATH}-->forgot/" onclick="win01('<!--{$smarty.const.ROOT_URLPATH}-->forgot/','forget','600','400'); return false;" target="_blank">[?] パスワードをお忘れの方はこちら</a></li>
                                        <!--{/if}-->
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- h1コンテンツヘッダー -->