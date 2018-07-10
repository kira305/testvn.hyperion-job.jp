<!-- ▼メイン用 商品検索 -->
<div class="block_outer">
    <div id="search_area">
        <h2>お仕事検索 JobSearch</h2>
        <div class="block_body">
            <div class="areamap">
                <h3>エリアから検索</h3>
                <div class="arealistmap">
                    <img src="./user_data/packages/default/img/map_s.png" width="200" height="200" alt="マップ" title="マップ" class="areamap_saitama"/>
                    <img src="./user_data/packages/default/img/map_k.png" width="200" height="200" alt="マップ" title="マップ" class="areamap_kanto"/>
                    <img src="./user_data/packages/default/img/map_z.png" width="200" height="200" alt="マップ" title="マップ" class="areamap_zenkoku"/>
                </div>
                <div class="arealist">
                    <div class="area_saitama">
                        <h4 class="areaname">埼玉エリア</h4>
                        <ul class="area_saitama">
                            <li class="kawagoes"><a href="/products/list.php?a=kawagoe">川越</a></li>
                            <li class="tokorozawas"><a href="/products/list.php?a=tokorozawa">所沢</a></li>
                            <li class="asakas"><a href="/products/list.php?a=asaka">朝霞</a></li>
                        </ul>
                    </div>
                    <div class="area_kanto">
                        <h4 class="areaname">関東エリア</h4>
                        <ul class="area_kanto">
                            <li><a href="/products/list.php?a=saitama">東京 / 関東 全域</a></li>
                            <li><a href="/products/list.php?a=kanto">埼玉県 全域</a></li>
                        </ul>
                    </div>
                    <div class="area_zenkoku">
                        <h4 class="areaname">全国エリア</h4>
                        <ul class="area_zenkoku">
                            <li><a href="/products/list.php?a=saitama">全国 / 関東地域 以外</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


        <div class="block_body">
            <div class="search_detail">
                <h3>詳細検索</h3>

                <!--  検索フォーム  -->

                <form name="search_form" id="search_form" method="get" action="/products/list.php">
                    <input type="hidden" name="transactionid" value="98038189d2b2a77be994d3d1d5a1d5689a60de32" />
                    <input type="hidden" name="mode" value="search" />
                    <div class="search_list">

                        <h4>職種</h4>
                        <ul id="searchlist">
                            <li><input type="checkbox" name="category_id[]" value="" id="category"/><label for="category" class="checkbox">すべて</label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="1" id="category1"/><label for="category1" class="checkbox">物流・倉庫</label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="2" id="category2"/><label for="category2" class="checkbox">製造・工場</label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="6" id="category6"/><label for="category6" class="checkbox">カテゴリA</label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="7" id="category7"/><label for="category7" class="checkbox">オフィス・事務</label>&nbsp;</li>
                            <li><input type="checkbox" name="category_id[]" value="8" id="category8"/><label for="category8" class="checkbox">その他</label>&nbsp;</li>
                        </ul>

                        <div class="clearfix"></div>
                        <h4>エリア</h4>
                        <ul id="searchlist">
                            <li><input type="checkbox" name="work_location_flg[]" value="1" id="work_location1" /><label for="work_location1" class="checkbox">川越</label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="2" id="work_location2" /><label for="work_location2" class="checkbox">所沢</label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="3" id="work_location3" /><label for="work_location3" class="checkbox">朝霞</label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="4" id="work_location4" /><label for="work_location4" class="checkbox">埼玉県 全域</label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="5" id="work_location5" /><label for="work_location5" class="checkbox">東京 / 関東全域</label>&nbsp;</li>
                            <li><input type="checkbox" name="work_location_flg[]" value="6" id="work_location5" /><label for="work_location5" class="checkbox">全国</label>&nbsp;</li>
                        </ul>

                        <div class="clearfix"></div>
                        <h4>ワークスタイル</h4>
                        <ul id="searchlist">
                            <li><input type="checkbox" name="employment_status[]" value="1" id="employment1" /><label for="employment1" class="checkbox">正社員</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="2" id="employment2" /><label for="employment2" class="checkbox">パート</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="3" id="employment3" /><label for="employment3" class="checkbox">派遣</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="4" id="employment4" /><label for="employment4" class="checkbox">スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="5" id="employment5" /><label for="employment5" class="checkbox">紹介予定派遣</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="6" id="employment6" /><label for="employment6" class="checkbox">紹介案件</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="7" id="employment7" /><label for="employment7" class="checkbox">レギュラー</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="8" id="employment8" /><label for="employment8" class="checkbox">特になし</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="1" id="employment1" /><label for="employment1" class="checkbox">正社員</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="2" id="employment2" /><label for="employment2" class="checkbox">パート</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="3" id="employment3" /><label for="employment3" class="checkbox">派遣</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="4" id="employment4" /><label for="employment4" class="checkbox">スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="5" id="employment5" /><label for="employment5" class="checkbox">紹介予定派遣</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="6" id="employment6" /><label for="employment6" class="checkbox">紹介案件</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="7" id="employment7" /><label for="employment7" class="checkbox">レギュラー</label>&nbsp;</li>
                            <li><input type="checkbox" name="employment_status[]" value="8" id="employment8" /><label for="employment8" class="checkbox">特になし</label>&nbsp;</li>

                        </ul>
                        <div class="clearfix"></div>
                        <h4>お仕事の特徴でチェック</h4>
                        <ul id="searchlist">
                            <li><input type="checkbox" name="condition[]" value="1" id="condition1"/><label for="condition1" class="checkbox">単発・スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="2" id="condition2" /><label for="condition2" class="checkbox">日払い</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="3" id="condition3" /><label for="condition3" class="checkbox">夜勤</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="4" id="condition4" /><label for="condition4" class="checkbox">短時間OK</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="1" id="condition1"/><label for="condition1" class="checkbox">単発・スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="2" id="condition2" /><label for="condition2" class="checkbox">日払い</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="3" id="condition3" /><label for="condition3" class="checkbox">夜勤</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="4" id="condition4" /><label for="condition4" class="checkbox">短時間OK</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="1" id="condition1"/><label for="condition1" class="checkbox">単発・スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="2" id="condition2" /><label for="condition2" class="checkbox">日払い</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="3" id="condition3" /><label for="condition3" class="checkbox">夜勤</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="4" id="condition4" /><label for="condition4" class="checkbox">短時間OK</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="1" id="condition1"/><label for="condition1" class="checkbox">単発・スポット</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="2" id="condition2" /><label for="condition2" class="checkbox">日払い</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="3" id="condition3" /><label for="condition3" class="checkbox">夜勤</label>&nbsp;</li>
                            <li><input type="checkbox" name="condition[]" value="4" id="condition4" /><label for="condition4" class="checkbox">短時間OK</label>&nbsp;</li>
                        </ul>

                        <div class="clearfix"></div>
                        <h4>フリーワードで検索</h4>
                        <input type="text" name="name" class="box500" maxlength="50" value="" placeholder="検索ワードを入力"/>
                    </div>
                    <p class="btn clearfix"><input type="submit" alt="検索ICON" value="検索ICON" name="search" class="searchlist" /></p>
            </div>		
            </form>
            <!--  検索フォーム  -->
        </div>
    </div>
</div>
<!-- ▲メイン用 商品検索 -->


