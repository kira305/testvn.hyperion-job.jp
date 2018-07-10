<section id="undercolumn">
    <h2 class="keep">お仕事リスト <span>応募したお仕事</span></h2>

    <ul class="list_button">
        <li><a href="/user_data/keep_list.php">キープしたお仕事</a></li>
        <li><a href="/user_data/history_list.php">閲覧したお仕事</a></li>
        <li class="here"><span>応募したお仕事</span></li>
    </ul>

    <div class="list_wrap_list clearfix mylistbox mylistboxentryhis">

        <!--{if count($arrProduct) == 0}-->
        <p class="listpage_list_navi">応募したお仕事履歴はありません</p>
        <!--{else}-->
        <p class="listpage_list_navi">応募したお仕事 <em><!--{$tpl_linemax}-->件</em>を表示しています。</p>

        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="pageno" value="<!--{$pageno}-->" />

            <ul>      
                <!--{foreach from=$arrProduct key=index item=item name=foo}-->
                <!--{assign var=id value=$item.product_id}-->
                <li>    
                    <dl class="keep_list_dl">
                        <dt class="number"><span>#<!--{$disp_number*$pageno-$disp_number+$smarty.foreach.foo.iteration}--></span></dt>
                        <dd class="keep">
                            <!--▼商品-->
                            <div class="list_wrap clearfix">
                                <div class="list_area clearfix">
                                    <a name="product<!--{$item.product_id}-->"></a>
                                    <h3>
                                        <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$item.product_id}-->"><!--{$item.name}--></a>
                                    </h3>
                                    <div class="list_main">
                                        <div class="listphoto">
                                            <!--★画像★-->
                                            <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$item.product_id|u}-->">
                                                <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$item.main_list_image|h}-->" alt="<!--{$item.name|h}-->" class="picture" width="170" /></a>
                                        </div>

                                        <div class="listrightbloc">
                                            <!--★商品名★-->
                                            <!--★コメント★-->
                                            <div class="listcomment">
                                                <p class="company"><em><!--{$item.sub_comment1|nl2br_html}--><br /></em></p>
                                                <p><!--{$item.sub_comment8|nl2br_html}--></p>
                                            </div>
                                        </div>

                                        <div class="listdata1">
                                            <dl>
                                                <dt><span class="inlineblock"></span><span>地域</span></dt>
                                                <dd><span class="inlineblock"></span><span><!--{$item.comment19}--></span></dd>
                                                <dt><span class="inlineblock"></span><span>交通<br/>アクセス</span></dt>
                                                <dd><span class="inlineblock"></span><span><!--{$item.sub_comment2|nl2br_html}--></span></dd>
                                                <dt><span class="inlineblock"></span><span>給与</span></dt>
                                                <dd><span class="inlineblock"></span><span><!--{$item.comment16}--><!--{strip}-->
                                                        <!--{if $item.price02_min_inctax == $item.price02_max_inctax}-->
                                                        <!--{$item.price02_min_inctax}-->
                                                        <!--{else}-->
                                                        <!--{$item.price02_min_inctax}-->～<!--{$item.price02_max_inctax}-->
                                                        <!--{/if}--><!--{/strip}-->円</span></dd>
                                                <dt><span class="inlineblock"></span><span>勤務時間等</span></dt>
                                                <dd><span class="inlineblock"></span><span><!--{$item.sub_comment3|nl2br_html}--><br /><!--{$item.sub_comment4|nl2br_html}--></span></dd>
                                            </dl>
                                        </div>

                                        <div class="listpoint">
                                            <!--▼アピール各種-->
                                            <ul>  
                                                <!--▼商品ステータス-->
                                                <!--{if count($productStatus[$id]) > 0}-->
                                                <!--{foreach from=$productStatus[$id] item=status}-->
                                                <li>
                                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrSTATUS_IMAGE[$status]}-->s.gif" alt="<!--{$arrSTATUS[$status]}-->"/>
                                                </li>
                                                <!--{/foreach}-->
                                                <!--{/if}-->
                                                <!--▲商品ステータス-->

                                                <!--▼雇用形態-->
                                                <!--{if count($item.employment_status) > 0}-->
                                                <!--{foreach from=$item.employment_status item=status}-->
                                                <li>
                                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrEMPSTATUS_IMAGE[$status]}-->s.gif" alt="<!--{$arrEMPSTATUS[$status]}-->"/>
                                                </li>
                                                <!--{/foreach}-->
                                                <!--{/if}-->
                                                <!--▲雇用形態-->

                                                <!--▼アピールポイント-->
                                                <!--{if count($item.appeal_point) > 0}-->
                                                <!--{foreach from=$item.appeal_point item=status}-->
                                                <li>
                                                    <img src="<!--{$TPL_URLPATH}--><!--{$arrAPPEALPOINT_IMAGE[$status]}-->s.gif" alt="<!--{$arrAPPEALPOINT[$status]}-->"/>
                                                </li>
                                                <!--{/foreach}-->
                                                <!--{/if}-->
                                                <!--▼アピールポイント-->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="list_bottom">
                                        <ul class="list_button_tab">
                                            <li class="list_button_keep"><button class="list_button" type="button" onClick=""><span>応募済のお仕事です</span></button></li>
                                            <li class="list_button_entry"><button class="list_button" type="button" onClick="" value="応募画面へ"><span>応募済のお仕事です</span></button></li>
                                            <li class="list_button_more"><button class="list_button" type="button" onClick="location.href = '<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$item.product_id}-->'" value="詳細へ"><span>詳細をもっと見る</span></button></li>
                                        </ul>
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

        <div class="listpage_list_navi">
            <form name="page_navi_top" id="page_navi_top" action="?">
                <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                <p>
                    <!--{if $before != ''}--><a class="arrow-left" onclick="fnNaviPage('<!--{$before}-->');
                                                    return false;" href="?pageno=<!--{$before}-->" ><span>前へ</span></a><!--{/if}-->
                    <!--{if $next != ''}--><a class="arrow-right" onclick="fnNaviPage('<!--{$next}-->');
                                                    return false;" href="?pageno=<!--{$next}-->" ><span>次へ</span></a><!--{/if}-->
                </p>
            </form>
        </div>

        <p class="listpage_list_navi">応募したお仕事 <em><!--{$tpl_linemax}-->件</em>を表示しています。</p>
        <!--{/if}-->

    </div>
</div>
</section>
        
<script>//<![CDATA[
    $(document).ready(function() {
        var x = $(window).width()*8/10 - 103;
        $('.list_button_more button.list_button').css('width', x);
    });
//]]></script>