<!-- ▼【サイド】商品検索 -->
<style>
    input[type='text'].search_free{
        display: block;
        width: 80%!important;
        border: solid 1px #CCC !important;
        padding: 30px 12px;
        background: #FFFFFF;
        color: #63c2cd !important;
        font-size: 1.2em;
        border-radius: 5px !important;
        padding-left: 20px;
        margin: 0px auto 0em auto !important;
        transition: all .3s;
        font-weight: 200;
    }
    input[type='text'].search_free:hover, input[type='text'].search_free:focus {
        border: 1px solid #63c2cd !important;
        outline: 0px !important;
        background: #F0F6FF !important;
        color: #63c2cd !important;
    }
    div.search_main_list, div.search_main_list h4, ul.search_main_list {
        width: 100%;
        border: none;
    }
    div.search_main_list {
        background-color: white;
    }
    h4#search_st1, h4#search_st2, h4#search_st3, h4#search_st4, h4#search_st5 {
        margin-left: 5px;
        font-size: 0.9em;
    }
    ul.search_main_list li, ul.search_main_j_list li {
        margin: 3px 0 2px;
        width: 100%;
    }
    section.search_st2, section.search_st3, section.search_st4, section.search_st5, section.search_st2_button, section.search_st3_button, section.search_st4_button, section.search_st5_button {
        height: auto;
        opacity: 1;
        overflow: visible;
    }
    button.icon-btn {
        top: auto;
    }
    button.icon-btn:active {
        top: 5px;
    }
    .side_column, .side_column .block_outer {
        margin: 0;
    }
    .mid_button{
        text-align: center;
    }
    .mid_button .icon-btn{
        height: 30px;
        margin: 0;
        font-size: 0.8em;
        padding: 0 15px 0 32px;
    }
    .mid_button .icon-btn.icon-btn-arup{
        padding: 0 0 0 32px;
    }
    .mid_button .icon-btn::before,
    .mid_button .icon-btn:hover::after{
        height: 30px;
        width: 30px;
        background-size: 30px;
    }
    .radio span, .checkbox span{
        width: 200px;
    }
</style>

<div class="block_outer">
    <div id="search_area">
        <!-- ▼メイン用 商品検索 -->
        <div id="search_main_area">
            <div class="search_main_detail">
                <!--  検索フォーム  -->
                <form name="search_form" id="search_form" method="get" action="/products/list.php">
                    <input type="hidden" name="transactionid" value="98038189d2b2a77be994d3d1d5a1d5689a60de32" />
                    <input type="hidden" name="mode" value="search" />
                    <div class="search_main_list">
                        <div class="clearfix"></div>
                        <section class="search_st1" id="search_st0">                         
                            <h4 id="search_st1">Step1 : お仕事先のエリアをチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="work_location_flg[]" value="" id="job_g_01" class="checkAll"/><label for="job_g_01" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrWorkLocationFlg key=id item=value}-->
                                    <li><input type="checkbox" name="work_location_flg[]" value="<!--{$id}-->" id="work_location_flg<!--{$id}-->" class="job_g_01" <!--{if in_array($id, $smarty.get.work_location_flg)}-->checked<!--{/if}--> /><label for="work_location_flg<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st2" id="search_st2">
                        <section class="search_st1_button mid_button">
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st2">
                            <h4 id="search_st2">Step2 : 希望する職種をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="category_id[]" value="" id="job_g_02" class="checkAll"/><label for="job_g_02" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrCatList key=id item=value}-->
                                <li><input type="checkbox" name="category_id[]" value="<!--{$id}-->" id="category_id<!--{$id}-->" class="job_g_02" <!--{if in_array($id, $smarty.get.category_id)}-->checked<!--{/if}--> /><label for="category_id<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st3" id="search_st3">
                        <section class="search_st2_button mid_button">
                            <div class="clearfix"></div>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st3">
                            <h4 id="search_st3">Step3 : 応募条件・雇用形態をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="employment_status[]" value="" id="job_g_03" class="checkAll"/><label for="job_g_03" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrEMPSTATUS key=id item=value}-->
                                    <li><input type="checkbox" name="employment_status[]" value="<!--{$id}-->" id="employment_status<!--{$id}-->" class="job_g_03" <!--{if in_array($id, $smarty.get.employment_status)}-->checked<!--{/if}--> /><label for="employment_status<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st4" id="search_st4">
                        <section class="search_st3_button mid_button">
                            <div class="clearfix"></div>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st4">
                            <h4 id="search_st4">Step4 : 特徴・待遇をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="appeal_point[]" value="" id="job_g_05" class="checkAll"/><label for="job_g_05" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrAPPEALPOINT key=id item=value}-->
                                    <li><input type="checkbox" name="appeal_point[]" value="<!--{$id}-->" id="appeal_point<!--{$id}-->" class="job_g_05" <!--{if in_array($id, $smarty.get.appeal_point)}-->checked<!--{/if}--> /><label for="appeal_point<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st5" id="search_st5">
                        <section class="search_st4_button mid_button">
                            <div class="clearfix"></div>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st5">
                            <h4 id="search_st5">フリーワードを＋</h4>
                            <div>
                                <input type="text" name="name" class="search_free" maxlength="50" value="<!--{$smarty.get.name}-->" placeholder="検索ワードを入力"/>
                            </div>
                        </section>
                        <section class="search_st5_button mid_button" style="text-align: center; margin-top: 10px;">
                            <div class="clearfix"></div>
                            <a href="#search_st0" class="icon-btn icon-btn-arup icon-link">
                                <span class="icon-btn-text hidden">▲</span>
                            </a>
                            <button class="icon-btn icon-btn-search" type="submit" style="top: -11px">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                            <div class="clearfix"></div>
                        </section>
                    </div>
                </form><!--  検索フォーム  -->
            </div><!-- ▲メイン -->
        </div>
    </div>
</div>
<!-- ▲【サイド】商品検索 -->