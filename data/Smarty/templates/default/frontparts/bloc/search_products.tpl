<!-- ▼メイン用 商品検索 -->
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/products.js"></script>
<script type="text/javascript">//<![CDATA[
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
    // 並び順を変更
    function fnChangeOrderby(orderby) {
        fnSetVal('orderby', orderby);
        fnSetVal('pageno', 1);
        fnSubmit();
    }
    // 表示件数を変更
    function fnChangeDispNumber(dispNumber) {
        fnSetVal('disp_number', dispNumber);
        fnSetVal('pageno', 1);
        fnSubmit();
    }
    // カゴに入れる
    function fnInCart(productForm) {
        var searchForm = $("#form1");
        var cartForm = $(productForm);
        // 検索条件を引き継ぐ
        var hiddenValues = ['mode', 'work_location_flg[]', 'employment_status[]', 'condition[]', 'appeal_point[]', 'category_id', 'name', 'orderby', 'disp_number', 'pageno', 'rnd'];
        $.each(hiddenValues, function() {
            // 商品別のフォームに検索条件の値があれば上書き
            if (this == 'work_location_flg[]' || this == 'employment_status[]' || this == 'condition[]' || this == 'appeal_point[]') {
                $.each(searchForm.find('input[name=' + this + ']'), function() {
                    cartForm.append($("<input/>").attr("name", this.name).attr("type", "hidden").val(this.value));
                });
            }
            else
                cartForm.append($("<input/>").attr("name", this).attr("type", "hidden").val(searchForm.find('input[name=' + this + ']').val()));
        });
        // 商品別のフォームを送信
        cartForm.submit();
    }
//]]></script>

<script type="text/javascript">
    function back() {
        document.form1.mode.value = 'back';
        document.form1.submit();
    }
</script>

<style>
    input[type='text'].search_free{
        display: block;
        width: 625px !important;
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
</style>

<div class="block_outer">
    <div id="search_area">
        <h2 class="search">お仕事検索 <span>ハイペリオンで働きたいお仕事が今すぐ見つかる！</span></h2>
        <!-- ▼メイン用 商品検索 -->
        <div id="search_main_area">
            <h3 id="search_st0">ピッタリ条件de指定検索</h3>
            <div class="search_main_detail">
                <!--  検索フォーム  -->
                <form name="search_form" id="search_form" method="get" action="/products/list.php">
                    <input type="hidden" name="transactionid" value="98038189d2b2a77be994d3d1d5a1d5689a60de32" />
                    <input type="hidden" name="mode" value="search" />
                    <div class="search_main_list">
                        <div class="clearfix"></div>
                        <section class="search_st1">                         
                            <h4 id="search_st1">Step1 : お仕事先のエリアをチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="work_location_flg[]" value="" id="job_g_01" class="checkAll"/><label for="job_g_01" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrWorkLocationFlg key=id item=value}-->
                                    <li><input type="checkbox" name="work_location_flg[]" value="<!--{$id}-->" id="work_location_flg<!--{$id}-->" class="job_g_01"/><label for="work_location_flg<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <section class="search_st2">
                            <h4 id="search_st2">Step2 : 希望する職種をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="category_id[]" value="" id="job_g_02" class="checkAll"/><label for="job_g_02" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrCatList key=id item=value}-->
                                <li><input type="checkbox" name="category_id[]" value="<!--{$id}-->" id="category_id<!--{$id}-->" class="job_g_02"/><label for="category_id<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st3" id="search_st3">
                        <section class="search_st2_button" style="text-align: center">
                            <div class="clearfix"></div>
                            <a href="#search_st0" class="icon-btn icon-btn-arup icon-link">
                                <span class="icon-btn-text hidden">▲</span>
                            </a>
                            <label class="icon-btn icon-btn-ardown" for="search_st3">
                                <span class="icon-btn-text">もっと条件を設定</span>
                            </label>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st3">
                            <h4 id="search_st3">Step3 : 応募条件・雇用形態をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="employment_status[]" value="" id="job_g_03" class="checkAll"/><label for="job_g_03" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrEMPSTATUS key=id item=value}-->
                                    <li><input type="checkbox" name="employment_status[]" value="<!--{$id}-->" id="employment_status<!--{$id}-->" class="job_g_03"/><label for="employment_status<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st4" id="search_st4">
                        <section class="search_st3_button" style="text-align: center">
                            <div class="clearfix"></div>
                            <a href="#search_st0" class="icon-btn icon-btn-arup icon-link">
                                <span class="icon-btn-text hidden">▲</span>
                            </a>
                            <label class="icon-btn icon-btn-ardown" for="search_st4">
                                <span class="icon-btn-text">もっと条件を設定</span>
                            </label>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st4">
                            <h4 id="search_st4">Step4 : 特徴・待遇をチェック</h4>
                            <ul class="search_main_list">
                                <li><input type="checkbox" name="appeal_point[]" value="" id="job_g_05" class="checkAll"/><label for="job_g_05" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                                <!--{foreach from=$arrAPPEALPOINT key=id item=value}-->
                                    <li><input type="checkbox" name="appeal_point[]" value="<!--{$id}-->" id="appeal_point<!--{$id}-->" class="job_g_05"/><label for="appeal_point<!--{$id}-->" class="checkbox"><span><!--{$value}--></span></label>&nbsp;</li>
                                <!--{/foreach}-->
                            </ul>
                        </section>
                        <input type="radio" name="switch_st5" id="search_st5">
                        <section class="search_st4_button" style="text-align: center">
                            <div class="clearfix"></div>
                            <a href="#search_st0" class="icon-btn icon-btn-arup icon-link">
                                <span class="icon-btn-text hidden">▲</span>
                            </a>
                            <label class="icon-btn icon-btn-ardown" for="search_st5">
                                <span class="icon-btn-text">もっと条件を設定</span>
                            </label>
                            <button class="icon-btn icon-btn-search" type="submit">
                                <span class="icon-btn-text">この条件で検索する</span>
                            </button>
                        </section>
                        <section class="search_st5">
                            <h4 id="search_st5">フリーワードを＋</h4>
                            <div>
                                <input type="text" name="name" class="search_free" maxlength="50" value="" placeholder="検索ワードを入力"/>
                            </div>
                        </section>
                        <section class="search_st5_button" style="text-align: center">
                            <div class="clearfix"></div>
                            <a href="#search_st0" class="icon-btn icon-btn-arup icon-link">
                                <span class="icon-btn-text hidden">▲</span>
                            </a>
                            <button class="icon-btn icon-btn-search" type="submit">
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
<br />
<!-- ▲メイン用 商品検索 -->


