<!-- ▼新着求人情報 -->
<!--{if count($arrBestProducts) > 0}-->
			<div id="recommend_area">
            	<h2>おすすめ求人情報</h2>
            	<div class="block_body clearfix">
                    
                <!--{foreach from=$arrBestProducts item=arrProduct name="recommend_products"}-->    
                <div class="view view-first">
                    <img src="<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->/<!--{$arrProduct.main_list_image|h}-->"　width="400" height="160" alt="<!--{$arrProduct.name|h}-->"/>
                    <div class="mask">
                        <h3><!--{$arrProduct.name|h}--></h3>
                        <p>勤務地:<!--{$arrProduct.comment19}--></p>
                        <p><!--{$arrProduct.comment16}-->:<!--{strip}-->
                        <!--{if $arrProduct.price02_min_inctax == $arrProduct.price02_max_inctax}-->
                            <!--{$arrProduct.price02_min_inctax}-->
                        <!--{else}-->
                            <!--{$arrProduct.price02_min_inctax}-->～<!--{$arrProduct.price02_max_inctax}-->
                    <!--{/if}--><!--{/strip}-->円</p>
                        <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->" class="info">求人情報の詳細を見る</a>
                    </div>
                </div>
                    <!--{if $smarty.foreach.recommend_products.iteration % 4 === 0}-->
                        <div class="clear"></div>
                    <!--{/if}-->
                <!--{/foreach}-->
            </div>
        </div>
<!--{/if}-->