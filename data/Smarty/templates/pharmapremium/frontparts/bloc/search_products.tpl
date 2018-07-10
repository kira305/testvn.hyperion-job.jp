<!--{*
* 
* Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
*
*}-->

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
        var hiddenValues = ['mode', 'work_location_flg[]', 'employment_status[]', 'condition[]', 'category_id', 'name', 'orderby', 'disp_number', 'pageno', 'rnd'];
        $.each(hiddenValues, function() {
            // 商品別のフォームに検索条件の値があれば上書き
            if (this == 'work_location_flg[]' || this == 'employment_status[]' || this == 'condition[]') {
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
        width: 80% !important;
        border: solid 1px #CCC !important;
        padding: 8px;
        background: #FFFFFF;
        color: #63c2cd !important;
        font-size: 0.8em;
        border-radius: 5px !important;
        margin: 0px auto 5px auto !important;
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

<!-- ▼検索エリア -->
<section id="search_bloc">
    <h2 class="search">お仕事検索 <span>ハイペリオンで働きたいお仕事が今すぐ見つかる！</span></h2>

    <div id="search_main_area">
        <h3 id="search_st0">ピッタリ条件de指定検索</h3>
        <div class="search_main_detail">
            <!--  検索フォーム  -->
            <form name="search_form" id="search_form" method="get" action="<!--{$smarty.const.ROOT_URLPATH}-->products/list.php">
                <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                <input type="hidden" name="mode" value="search" />
                <div class="search_main_list">
                    <div class="clearfix"></div>
                    <section class="search_st1">                         
                        <h4 id="search_st1">Step1 : お仕事先のエリアをチェック</h4>
                        <ul class="search_main_list">
                            <li><input type="checkbox" name="work_location_flg[]" value="" id="job_g_01" class="checkAll"/><label for="job_g_01" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="1" id="work_location1" class="job_g_01"/><label for="work_location1" class="checkbox"><span>川越 周辺</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="2" id="work_location2" class="job_g_01"/><label for="work_location2" class="checkbox"><span>所沢 周辺</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="3" id="work_location3" class="job_g_01"/><label for="work_location3" class="checkbox"><span>朝霞 周辺</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="4" id="work_location4" class="job_g_01"/><label for="work_location4" class="checkbox"><span>埼玉 全域</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="5" id="work_location5" class="job_g_01"/><label for="work_location5" class="checkbox"><span>東京 関東</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="6" id="work_location6" class="job_g_01"/><label for="work_location6" class="checkbox"><span>名古屋 中部</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="7" id="work_location7" class="job_g_01"/><label for="work_location7" class="checkbox"><span>大阪 関西</span></label>&nbsp;</li>
                        </ul>
                    </section>
                    <input type="radio" name="switch_st2" id="search_st2">
                    <section class="search_st1_button" style="text-align: center">
                        <div class="clearfix"></div>
                        <label class="icon-btn icon-btn-ardown" for="search_st2">
                            <span class="icon-btn-text">もっと条件を設定</span>
                        </label>
                        <button class="icon-btn icon-btn-search" type="submit">
                            <span class="icon-btn-text">この条件で検索する</span>
                        </button>
                    </section>
                    <section class="search_st2">
                        <h4 id="search_st2">Step2 : 希望する職種をチェック</h4>
                        <ul class="search_main_list">
                            <li><input type="checkbox" name="category_id[]" value="" id="job_g_02" class="checkAll"/><label for="job_g_02" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="1" id="category1" class="job_g_02"/><label for="category1" class="checkbox"><span>飲食 / フード</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="2" id="category2" class="job_g_02"/><label for="category2" class="checkbox"><span>販売 / サービス</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category3" class="job_g_02"/><label for="category3" class="checkbox"><span>オフィス / 事務</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="6" id="category4" class="job_g_02"/><label for="category4" class="checkbox"><span>営業 / 企画</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="6" id="category5" class="job_g_02"/><label for="category5" class="checkbox"><span>レジャー / エンタメ</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category6" class="job_g_02"/><label for="category6" class="checkbox"><span>技術 / 専門職</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category7" class="job_g_02"/><label for="category7" class="checkbox"><span>医療 / 介護 / 福祉</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category8" class="job_g_02"/><label for="category8" class="checkbox"><span>製造 / 設備</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category9" class="job_g_02"/><label for="category9" class="checkbox"><span>教育 / 講師</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category10" class="job_g_02"/><label for="category10" class="checkbox"><span>建築 / 土木</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category11" class="job_g_02"/><label for="category11" class="checkbox"><span>軽作業 / 物流 / 配送</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="6" id="category12" class="job_g_02"/><label for="category12" class="checkbox"><span>デザイン / 広告</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category13" class="job_g_02"/><label for="category13" class="checkbox"><span>ファッション</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category14" class="job_g_02"/><label for="category14" class="checkbox"><span>マスコミ / 芸能</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category15" class="job_g_02"/><label for="category15" class="checkbox"><span>その他 / 専門職</span></label>&nbsp;</li>
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
                            <li><input type="checkbox" name="employment_status[]" value="" id="job_g_03" class="checkAll"/><label for="job_g_03" class="checkbox"><span>雇用 すべて</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="1" id="employment1" class="job_g_03"/><label for="employment1" class="checkbox"><span>アルバイト パート</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="2" id="employment2" class="job_g_03"/><label for="employment2" class="checkbox"><span>契約社員</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="3" id="employment3" class="job_g_03"/><label for="employment3" class="checkbox"><span>正社員</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="4" id="employment4" class="job_g_03"/><label for="employment4" class="checkbox"><span>職業紹介</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="5" id="employment5" class="job_g_03"/><label for="employment5" class="checkbox"><span>派遣</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="6" id="employment6" class="job_g_03"/><label for="employment6" class="checkbox"><span>業務委託</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="7" id="employment7" class="job_g_03"/><label for="employment7" class="checkbox"><span>在宅内職</span></label>&nbsp;</li>
                        </ul>
                        <ul class="search_main_list">
                            <li><input type="checkbox" name="employment_status[]" value="" id="job_g_04" class="checkAll"/><label for="job_g_04" class="checkbox"><span>条件 すべて</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="8" id="employment8" class="job_g_04"/><label for="employment8" class="checkbox"><span>学生歓迎</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="9" id="employment9" class="job_g_04"/><label for="employment9" class="checkbox"><span>ママ・パパ歓迎</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="10" id="employment10" class="job_g_04"/><label for="employment10" class="checkbox"><span>未経験者歓迎</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="11" id="employment11" class="job_g_04"/><label for="employment11" class="checkbox"><span>経験者優遇</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="12" id="employment12" class="job_g_04"/><label for="employment12" class="checkbox"><span>シニア歓迎</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="13" id="employment13" class="job_g_04"/><label for="employment13" class="checkbox"><span>WワークOK</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="14" id="employment14" class="job_g_04"/><label for="employment14" class="checkbox"><span>友達と応募可</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="15" id="employment15" class="job_g_04"/><label for="employment15" class="checkbox"><span>学歴不問</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="16" id="employment16" class="job_g_04"/><label for="employment16" class="checkbox"><span>履歴書不要</span></label>&nbsp;</li>
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
                            <li><input type="checkbox" name="condition[]" value="" id="job_g_05" class="checkAll"/><label for="job_g_05" class="checkbox"><span>すべて</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="1" id="condition1" class="job_g_05"/><label for="condition1" class="checkbox"><span>駅近・駅中</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="2" id="condition2" class="job_g_05"/><label for="condition2" class="checkbox"><span>交通費支給</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="3" id="condition3" class="job_g_05"/><label for="condition3" class="checkbox"><span>高収入</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="4" id="condition4" class="job_g_05"/><label for="condition4" class="checkbox"><span>日払い・週払い</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="5" id="condition5" class="job_g_05"/><label for="condition5" class="checkbox"><span>からだを動かす</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="6" id="condition6" class="job_g_05"/><label for="condition6" class="checkbox"><span>人と接する</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="7" id="condition7" class="job_g_05"/><label for="condition7" class="checkbox"><span>語学力を活かす</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="8" id="condition8" class="job_g_05"/><label for="condition8" class="checkbox"><span>外国人歓迎</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="9" id="condition9" class="job_g_05"/><label for="condition9" class="checkbox"><span>かんたん軽作業</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="10" id="condition10" class="job_g_05"/><label for="condition10" class="checkbox"><span>服装自由</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="11" id="condition11" class="job_g_05"/><label for="condition11" class="checkbox"><span>髪型・髪色自由</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="12" id="condition12" class="job_g_05"/><label for="condition12" class="checkbox"><span>スタッフ大量募集</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="13" id="condition13" class="job_g_05"/><label for="condition13" class="checkbox"><span>スタッフ急募</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="14" id="condition14" class="job_g_05"/><label for="condition14" class="checkbox"><span>短時間OK</span></label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="15" id="condition15" class="job_g_05"/><label for="condition15" class="checkbox"><span>深夜勤</span></label>&nbsp;</li>
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
</section>
<!-- ▲検索エリア -->