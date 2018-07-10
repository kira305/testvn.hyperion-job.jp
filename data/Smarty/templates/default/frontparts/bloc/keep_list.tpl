<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->
<div class="block_outer">
    <div id="keep_list_area">
        <h3><img src="<!--{$TPL_URLPATH}-->img/title/tit_bloc_keep-list.png" alt="キープしたお仕事" />キープしたお仕事</h3>
        <div class="block_body">
            <div class="information">
                <p class="item">求人数： <!--{$smarty.session.keep_product_list|@count|number_format|default:0}-->件</p>
            </div>
            <div class="btn">
                <div><a href="/user_data/keep_list.php">キープした求人を見る ▷</a></div>
            </div>
        </div>
    </div>
</div>