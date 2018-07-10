<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->


<div class="block_outer">
    <div id="search_area">
    <h2><span class="title"><img src="<!--{$TPL_URLPATH}-->img/title/tit_bloc_search.gif" alt="検索条件" /></span></h2>
        <div class="block_body_b">
            <!--検索フォーム-->
            <form name="search_form" id="search_form" method="get" action="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="search" />
            <dl id="searchlist">
                <dt>地域</dt>
               <dd><!--{html_radios name="work_location_flg" options=$arrWorkLocationFlg separator='&nbsp;&nbsp;'}--></dd>
                <dt>雇用形態</dt>
                <dd><!--{html_checkboxes name="employment_status" options=$arrEMPSTATUS separator='&nbsp;&nbsp;'}--></dd>
                <dt>仕事内容</dt>
                <dd><select name="category_id" class="box145">
                <option label="すべての求人" value="" />全ての求人</option>
                <!--{html_options options=$arrCatList selected=$category_id}-->
                </select></dd>
                <dt>フリーワード</dt>
                <dd><input type="text" name="name" class="box180" maxlength="50" value="<!--{$smarty.get.name|h}-->" /></dd>
            </dl>
            <p class="btn"><input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_bloc_search_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_bloc_search.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_bloc_search.jpg" alt="検索" name="search" /></p>
            </form>
        </div>
    </div>
</div>