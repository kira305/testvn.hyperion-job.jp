<div id="one_maincolumn" class="main_column">
    <div id="undercolumn">
        <h2 class="keep">お仕事リスト 
            <span>キープしたお仕事</span>
        </h2>
        <ul class="list_button">
            <li class="here">
                <span>キープしたお仕事</span>
            </li>
            <li>
                <a href="/user_data/history_list.php">閲覧したお仕事</a>
            </li>
            <li>
                <a href="/mypage/index.php">応募したお仕事</a>
            </li>
        </ul>
        <div class="list_wrap_list clearfix">
            <p class="listpage_list_navi">キープしたお仕事 
                <em><!--{$cartItems|@count}-->件</em>を表示しています。
            </p>
            <!--{foreach from=$cartKeys item=key}-->
            <form name="form<!--{$key}-->" id="form<!--{$key}-->" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="confirm" />
            <input type="hidden" name="cart_no" value="" />
            <input type="hidden" name="cartKey" value="<!--{$key}-->" />
            <input type="hidden" name="category_id" value="<!--{$tpl_category_id|h}-->" />
            <ul>
                <!--{foreach from=$cartItems[$key] key=index item=item name=foo}-->
                <li>
                    <dl class="keep_list_dl">
                        <dt class="number">
                            <input type="checkbox" name="" value="" id="keep_<!--{$smarty.foreach.foo.iteration}-->" class=""/>
                            <label for="keep_<!--{$smarty.foreach.foo.iteration}-->" class="checkbox">
                                <span>#<!--{$smarty.foreach.foo.iteration}--></span>
                            </label>
                            <selection class="keep_list_del">
                                <a href="?" onclick="fnFormModeSubmit('form<!--{$key}-->', 'delete', 'cart_no', '<!--{$item.cart_no}-->'); return false;">解除ボタン</a>
                            </selection>
                        </dt>
                        <dd class="keep">
                            <!--▼商品-->
                            <div class="list_wrap clearfix">
                                    <div class="list_area clearfix">
                                        <a name="product<!--{$item.productsClass.id}-->"></a>
                                        <h3>
                                            <a href="/products/detail.php?product_id=<!--{$item.productsClass.id}-->"><!--{$item.productsClass.name}--></a>
                                        </h3>
                                        <div class="list_main">
                                            <div class="listphoto">
                                                <!--★画像★-->
                                                <a href="/products/detail.php?product_id=<!--{$item.productsClass.id}-->">
                                                    <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$item.productsClass.main_list_image|sfNoImageMainList|h}-->&amp;width=250&amp;height=175" alt="<!--{$item.productsClass.name|h}-->" class="picture" width="250" height="175" />
                                                </a>
                                            </div>
                                            <div class="listrightbloc">
                                                <!--★商品名★-->
                                                <!--★コメント★-->
                                                <div class="listcomment">
                                                    <p class="company">
                                                        <em>株式会社ハイペリオン 派遣事業部
                                                            <br />
                                                        </em>
                                                    </p>
                                                    <p>派遣求人の未来をハイペリオンで明るく！
                                                        <br />
                        印刷物の梱包・封入などカンタンな作業
                                                        <br />
                                                        <br />
                        基本は9時間勤務(1時間の休憩あり)の日中か夜間を中心に
                                                        <br />
08:00〜17:00の勤務で￥8,000
                                                        <br />
20:00〜05:00の勤務で￥9,000
                                                        <br />
状況にもよりますが雨天中止など際にも、手当支給があります
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="listdata1">
                                                <dl>
                                                    <dt>
                                                        <span class="inlineblock"></span>
                                                        <span>地域</span>
                                                    </dt>
                                                    <dd>
                                                        <span class="inlineblock"></span>
                                                        <span>埼玉県熊谷市 他エリア多数</span>
                                                    </dd>
                                                    <dt>
                                                        <span class="inlineblock"></span>
                                                        <span>交通
                                                            <br/>アクセス
                                                        </span>
                                                    </dt>
                                                    <dd>
                                                        <span class="inlineblock"></span>
                                                        <span>JR山手線 熊谷駅よりバス25分 徒歩5分（面接地によって異なる） アクセスアクセスアクセスアクセスアクセス</span>
                                                    </dd>
                                                    <dt>
                                                        <span class="inlineblock"></span>
                                                        <span>給与</span>
                                                    </dt>
                                                    <dd>
                                                        <span class="inlineblock"></span>
                                                        <span>時給1200円～ (研修期間 1100円から)</span>
                                                    </dd>
                                                    <dt>
                                                        <span class="inlineblock"></span>
                                                        <span>勤務時間等</span>
                                                    </dt>
                                                    <dd>
                                                        <span class="inlineblock"></span>
                                                        <span>週５日勤務
                                                            <br />長期短期問わず
                                                            <br />8:00-17:00 20:00-翌5:00
                                                            <br />深夜勤あり
                                                        </span>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <div class="listpoint">
                                                <ul>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_4.gif" width="80" height="17" alt="高収入"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_7.gif" width="80" height="17" alt="からだを動かすお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_8.gif" width="80" height="17" alt="人と接するお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_06.gif" width="80" height="17" alt="経験者優遇"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/" width="80" height="17" alt="ミドル+シニア歓迎"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_emp_4.gif" width="80" height="17" alt="正社員"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_4.gif" width="80" height="17" alt="高収入"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_7.gif" width="80" height="17" alt="からだを動かすお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_8.gif" width="80" height="17" alt="人と接するお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_06.gif" width="80" height="17" alt="経験者優遇"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/" width="80" height="17" alt="ミドル+シニア歓迎"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_emp_4.gif" width="80" height="17" alt="正社員"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_4.gif" width="80" height="17" alt="高収入"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_7.gif" width="80" height="17" alt="からだを動かすお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_point_8.gif" width="80" height="17" alt="人と接するお仕事"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_06.gif" width="80" height="17" alt="経験者優遇"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/" width="80" height="17" alt="ミドル+シニア歓迎"/>
                                                    </li>
                                                    <li>
                                                        <img src="/user_data/packages/default/img/icon/ico_emp_4.gif" width="80" height="17" alt="正社員"/>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="list_bottom">
                                            <div class="list_bottom_button">
                                                <a href="
                                                    <!--{$smarty.const.P_DETAIL_URLPATH}-->
                                                    <!--{$arrProduct.product_id|u}-->" class="list_bottom_button">
                                                    <span class="icon-btn-text">応募ボタン</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!--▲商品-->
                        </dd>
                    </dl>
                </li>
                <!--{/foreach}-->
            </ul>
            </form>
            <!--{/foreach}-->
            <div class="listpage_list_navi">
                <p>
                    <a href="#fakelink" class="arrow-left">
                        <span>前へ</span>
                    </a>
                    <a href="#fakelink" class="arrow-right">
                        <span>次へ</span>
                    </a>
                </p>
            </div>
            <p class="listpage_list_navi">キープしたお仕事 
                <em><!--{$cartItems|@count}-->件</em>を表示しています。
            </p>
        </div>
    </div>
</div>