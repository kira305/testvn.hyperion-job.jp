<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2012 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/LC_Page_Ex.php';

/**
 * 商品一覧 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Products_List.php 21957 2012-07-04 01:13:22Z pineray $
 */
class LC_Page_Products_List extends LC_Page_Ex {
    // {{{ properties

    /** テンプレートクラス名1 */
    var $tpl_class_name1 = array();

    /** テンプレートクラス名2 */
    var $tpl_class_name2 = array();

    /** JavaScript テンプレート */
    var $tpl_javascript;
    var $orderby;
    var $mode;

    /** 検索条件(内部データ) */
    var $arrSearchData = array();

    /** 検索条件(表示用) */
    var $arrSearch = array();
    var $tpl_subtitle = '';

    /** ランダム文字列 * */
    var $tpl_rnd = '';
    var $arrEMPSTATUS = array();
    var $arrWorkLocationFlg = array();

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrSTATUS = $masterData->getMasterData('mtb_status');
        $this->arrSTATUS_IMAGE = $masterData->getMasterData('mtb_status_image');
        $this->arrDELIVERYDATE = $masterData->getMasterData('mtb_delivery_date');
        $this->arrPRODUCTLISTMAX = $masterData->getMasterData('mtb_product_list_max');
        $this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
        $this->arrEMPSTATUS_IMAGE = $masterData->getMasterData('mtb_employment_status_image');
        $this->arrAPPEALPOINT = $masterData->getMasterData('mtb_appeal_point');
        $this->arrAPPEALPOINT_IMAGE = $masterData->getMasterData('mtb_appeal_point_image');
        $this->arrWorkLocationFlg = $masterData->getMasterData('mtb_work_location_flg');
        $this->arrCONDITION = $masterData->getMasterData('mtb_condition');
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のAction.
     *
     * @return void
     */
    function action() {

        $objProduct = new SC_Product_Ex();

        /* area block addition */
        if (isset($_REQUEST['a'])) {
            switch ($_REQUEST['a']) {
                case 'kawagoe':
                    $_REQUEST['work_location_flg'][] = 1;
                    break;
                case 'tokorozawa':
                    $_REQUEST['work_location_flg'][] = 2;
                    break;
                case 'asaka':
                    $_REQUEST['work_location_flg'][] = 3;
                    break;
                case 'saitama':
                    $_REQUEST['work_location_flg'][] = 4;
                    break;
                default:
                    $_REQUEST['work_location_flg'][] = 5;
                    break;
            }
        }

        /* condition block addition */
        if (isset($_REQUEST['s']))
            $_REQUEST['condition'][] = $_REQUEST['s'];

        if (isset($_REQUEST['work_location_flg']) && count($_REQUEST['work_location_flg']) == 1) {
            $this->tpl_subtitle = $this->arrWorkLocationFlg[$_REQUEST['work_location_flg'][0]];
            $this->arrPageLayout['keyword'] = 'そのエリア, 日払い, 単発, スポット, 短期';
        } else if (isset($_REQUEST['condition']) && count($_REQUEST['condition']) == 1) {
            $this->tpl_subtitle = $this->arrCONDITION[$_REQUEST['condition'][0]];
            $this->arrPageLayout['keyword'] = 'その条件, 所沢, 川越, 朝霞, スポット';
        }
        else
            $this->tpl_subtitle = '求人情報一覧';

        $this->arrForm = $_REQUEST; //時間が無いのでコレで勘弁してください。 tao_s
        //modeの取得
        $this->mode = $this->getMode();

        //表示条件の取得
        $this->arrSearchData = array(
            'work_location_flg' => $this->arrForm['work_location_flg'],
            'appeal_point' => $this->arrForm['appeal_point'],
            'employment_status' => $this->arrForm['employment_status'],
            'condition' => $this->arrForm['condition'],
            'category_id' => $this->lfGetCategoryId(intval($this->arrForm['category_id'])),
            'name' => $this->arrForm['name']
        );

        $this->orderby = $this->arrForm['orderby'];

        //ページング設定
        $this->tpl_pageno = $this->arrForm['pageno'];
        $this->disp_number = $this->lfGetDisplayNum($this->arrForm['disp_number']);

        // 画面に表示するサブタイトルの設定
//        $this->tpl_subtitle = $this->lfGetPageTitle($this->mode, $this->arrSearchData['category_id']);
        // 画面に表示する検索条件を設定
        $this->arrSearch = $this->lfGetSearchConditionDisp($this->arrSearchData);

        // 商品一覧データの取得
        $arrSearchCondition = $this->lfGetSearchCondition($this->arrSearchData);
        $this->tpl_linemax = $this->lfGetProductAllNum($arrSearchCondition);
        $urlParam = "category_id={$this->arrSearchData['category_id']}&pageno=#page#";
        // モバイルの場合に検索条件をURLの引数に追加
        if (SC_Display_Ex::detectDevice() === DEVICE_TYPE_MOBILE) {
            $searchNameUrl = urlencode(mb_convert_encoding($this->arrSearchData['name'], 'SJIS-win', 'UTF-8'));
            $urlParam .= "&mode={$this->mode}&name={$searchNameUrl}&orderby={$this->orderby}";
        }
        $this->objNavi = new SC_PageNavi_Ex($this->tpl_pageno, $this->tpl_linemax, $this->disp_number, 'fnNaviPage', NAVI_PMAX, $urlParam, SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE);
        $this->arrProducts = $this->lfGetProductsList($arrSearchCondition, $this->disp_number, $this->objNavi->start_row, $this->tpl_linemax, $objProduct);

        switch ($this->getMode()) {
            case 'cart_to_shopping':
                $objCartSess = new SC_CartSession_Ex();
                $objSiteSess = new SC_SiteSession_Ex();
                $product_class_id = $this->arrForm['product_class_id'];
                $objCartSess->addProduct($product_class_id, 1);

                $cartKeys = $objCartSess->getKeys();
                $this->lfSetCurrentCart($objSiteSess, $objCartSess, $cartKeys[0]);

                $objCustomer = new SC_Customer_Ex();
                if ($objCustomer->isLoginSuccess(true))
                    SC_Response_Ex::sendRedirect('/user_data/entry_form_confirm.php');
                else
                    SC_Response_Ex::sendRedirect('/user_data/entry_form.php');
                SC_Response_Ex::actionExit();
                break;
            case 'json':
                $this->arrProducts = $this->setStatusDataTo($this->arrProducts, $this->arrSTATUS, $this->arrSTATUS_IMAGE);
                $this->arrProducts = $objProduct->setPriceTaxTo($this->arrProducts);

                // 一覧メイン画像の指定が無い商品のための処理
                foreach ($this->arrProducts as $key => $val) {
                    $this->arrProducts[$key]['main_list_image'] = SC_Utils_Ex::sfNoImageMainList($val['main_list_image']);
                }

                echo SC_Utils_Ex::jsonEncode($this->arrProducts);
                SC_Response_Ex::actionExit();
                break;
            case 'cart':
                if (!in_array($this->arrForm['product_id'], $_SESSION['keep_product_list'])) {
                    if (!isset($_SESSION['keep_product_list']))
                        $_SESSION['keep_product_list'] = array();
                    array_unshift($_SESSION['keep_product_list'], $this->arrForm['product_id']);
                }
            default:

                //商品一覧の表示処理
                $strnavi = $this->objNavi->strnavi;
                // 表示文字列
                $this->tpl_strnavi = empty($strnavi) ? '&nbsp;' : $strnavi;

                // 規格1クラス名
                $this->tpl_class_name1 = $objProduct->className1;

                // 規格2クラス名
                $this->tpl_class_name2 = $objProduct->className2;

                // 規格1
                $this->arrClassCat1 = $objProduct->classCats1;

                // 規格1が設定されている
                $this->tpl_classcat_find1 = $objProduct->classCat1_find;
                // 規格2が設定されている
                $this->tpl_classcat_find2 = $objProduct->classCat2_find;

                $this->tpl_stock_find = $objProduct->stock_find;
                $this->tpl_product_class_id = $objProduct->product_class_id;
                $this->tpl_product_type = $objProduct->product_type;

                // 商品ステータスを取得
                $this->productStatus = $this->arrProducts['productStatus'];
                unset($this->arrProducts['productStatus']);
                $this->tpl_javascript .= 'var productsClassCategories = ' . SC_Utils_Ex::jsonEncode($objProduct->classCategories) . ';';
                //onloadスクリプトを設定. 在庫ありの商品のみ出力する
                foreach ($this->arrProducts as $product_id => $arrProduct) {
                    if ($arrProduct['stock_unlimited_max'] || $arrProduct['stock_max'] > 0) {
                        $js_fnOnLoad .= "fnSetClassCategories(document.product_form{$arrProduct['product_id']});";
                    }
                    if (strlen($this->arrProducts[$product_id]['employment_status']) > 0)
                        $this->arrProducts[$product_id]['employment_status'] = str_split($this->arrProducts[$product_id]['employment_status']);
                    if (strlen($this->arrProducts[$product_id]['conditions']) > 0)
                        $this->arrProducts[$product_id]['conditions'] = str_split($this->arrProducts[$product_id]['conditions']);
                    if (strlen($this->arrProducts[$product_id]['appeal_point']) > 0)
                        $this->arrProducts[$product_id]['appeal_point'] = str_split($this->arrProducts[$product_id]['appeal_point']);
                }

                //カート処理
                $target_product_id = intval($this->arrForm['product_id']);
                if ($target_product_id > 0) {
                    // 商品IDの正当性チェック
                    if (!SC_Utils_Ex::sfIsInt($this->arrForm['product_id']) || !SC_Helper_DB_Ex::sfIsRecord('dtb_products', 'product_id', $this->arrForm['product_id'], 'del_flg = 0 AND status = 1')) {
                        SC_Utils_Ex::sfDispSiteError(PRODUCT_NOT_FOUND);
                    }

                    // 入力内容のチェック
                    $arrErr = $this->lfCheckError($target_product_id, $this->arrForm, $this->tpl_classcat_find1, $this->tpl_classcat_find2);
                    if (empty($arrErr)) {
                        $this->lfAddCart($this->arrForm, $_SERVER['HTTP_REFERER']);
                    }
                    $js_fnOnLoad .= $this->lfSetSelectedData($this->arrProducts, $this->arrForm, $arrErr, $target_product_id);
                } else {
                    // カート「戻るボタン」用に保持
                    $netURL = new Net_URL();
                    //該当メソッドが無いため、$_SESSIONに直接セット
                    $_SESSION['cart_referer_url'] = $netURL->getURL();
                }

                $this->tpl_javascript .= 'function fnOnLoad(){' . $js_fnOnLoad . '}';
//                $this->tpl_onload .= 'fnOnLoad(); ';
                $this->tpl_onload = '';
                break;
        }

        $this->tpl_rnd = SC_Utils_Ex::sfGetRandomString(3);
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    function lfSetCurrentCart(&$objSiteSess, &$objCartSess, $cartKey) {
        // 正常に登録されたことを記録しておく
        $objSiteSess->setRegistFlag();
        $pre_uniqid = $objSiteSess->getUniqId();
        // 注文一時IDの発行
        $objSiteSess->setUniqId();
        $uniqid = $objSiteSess->getUniqId();
        // エラーリトライなどで既にuniqidが存在する場合は、設定を引き継ぐ
        if ($pre_uniqid != '') {
            $this->lfUpdateOrderTempid($pre_uniqid, $uniqid);
        }
        // カートを購入モードに設定
        $objCartSess->registerKey($cartKey);
        $objCartSess->saveCurrentCart($uniqid, $cartKey);
    }

    function lfUpdateOrderTempid($pre_uniqid, $uniqid) {
        $sqlval['order_temp_id'] = $uniqid;
        $where = 'order_temp_id = ?';
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $res = $objQuery->update('dtb_order_temp', $sqlval, $where, array($pre_uniqid));
        if ($res != 1) {
            return false;
        }
        return true;
    }

    /**
     * カテゴリIDの取得
     *
     * @return integer カテゴリID
     */
    function lfGetCategoryId($category_id) {

        // 指定なしの場合、0 を返す
        if (empty($category_id))
            return 0;

        // 正当性チェック
        if (!SC_Utils_Ex::sfIsInt($category_id) || SC_Utils_Ex::sfIsZeroFilling($category_id) || !SC_Helper_DB_Ex::sfIsRecord('dtb_category', 'category_id', (array) $category_id, 'del_flg = 0')
        ) {
            SC_Utils_Ex::sfDispSiteError(CATEGORY_NOT_FOUND);
        }

        // 指定されたカテゴリIDを元に正しいカテゴリIDを取得する。
        $arrCategory_id = SC_Helper_DB_Ex::sfGetCategoryId('', $category_id);

        if (empty($arrCategory_id)) {
            SC_Utils_Ex::sfDispSiteError(CATEGORY_NOT_FOUND);
        }

        return $arrCategory_id[0];
    }

    /* 商品一覧の表示 */

    function lfGetProductsList($searchCondition, $disp_number, $startno, $linemax, &$objProduct) {

        $arrOrderVal = array();

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        // 表示順序
        switch ($this->orderby) {
            // 販売価格が安い順
            case 'price':
                $objProduct->setProductsOrder('price02', 'dtb_products_class', 'ASC');
                break;

            // 新着順
            case 'date':
                $objProduct->setProductsOrder('create_date', 'dtb_products', 'DESC');
                break;

            default:
                if (strlen($searchCondition['where_category']) >= 1) {
                    $dtb_product_categories = '(SELECT * FROM dtb_product_categories WHERE ' . $searchCondition['where_category'] . ')';
                    $arrOrderVal = $searchCondition['arrvalCategory'];
                } else {
                    $dtb_product_categories = 'dtb_product_categories';
                }
                $order = <<< __EOS__
                    (
                        SELECT
                            T3.rank * 2147483648 + T2.rank
                        FROM
                            $dtb_product_categories T2
                            JOIN dtb_category T3
                              ON T2.category_id = T3.category_id
                        WHERE T2.product_id = alldtl.product_id
                        ORDER BY T3.rank DESC, T2.rank DESC
                        LIMIT 1
                    ) DESC
                    ,product_id DESC
__EOS__;
                $objQuery->setOrder($order);
                break;
        }
        // 取得範囲の指定(開始行番号、行数のセット)
        $objQuery->setLimitOffset($disp_number, $startno);
        $objQuery->setWhere($searchCondition['where']);

        // 表示すべきIDとそのIDの並び順を一気に取得
        $arrProductId = $objProduct->findProductIdsOrder($objQuery, array_merge($searchCondition['arrval'], $arrOrderVal));

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);

        // 規格を設定
        $objProduct->setProductsClassByProductIds($arrProductId);
        $arrProducts['productStatus'] = $objProduct->getProductStatus($arrProductId);
        return $arrProducts;
    }

    /* 入力内容のチェック */

    function lfCheckError($product_id, &$arrForm, $tpl_classcat_find1, $tpl_classcat_find2) {

        // 入力データを渡す。
        $objErr = new SC_CheckError_Ex($arrForm);

        // 複数項目チェック
        if ($tpl_classcat_find1[$product_id]) {
            $objErr->doFunc(array('規格1', 'classcategory_id1', INT_LEN), array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        }
        if ($tpl_classcat_find2[$product_id]) {
            $objErr->doFunc(array('規格2', 'classcategory_id2', INT_LEN), array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        }

        $objErr->doFunc(array('商品規格ID', 'product_class_id', INT_LEN), array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objErr->doFunc(array('数量', 'quantity', INT_LEN), array('EXIST_CHECK', 'ZERO_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));

        return $objErr->arrErr;
    }

    /**
     * パラメーターの読み込み
     *
     * @return void
     */
    function lfGetDisplayNum($display_number) {
        // 表示件数
        return (SC_Utils_Ex::sfIsInt($display_number)) ? $display_number : current(array_keys($this->arrPRODUCTLISTMAX));
    }

    /**
     * ページタイトルの設定
     *
     * @return str
     */
    function lfGetPageTitle($mode, $category_id = 0) {
        if ($mode == 'search') {
            return '検索結果';
        } elseif ($category_id == 0) {
            return '求人情報一覧';
        } else {
            $arrCat = SC_Helper_DB_Ex::sfGetCat($category_id);
            return $arrCat['name'];
        }
    }

    /**
     * 表示用検索条件の設定
     *
     * @return array
     */
    function lfGetSearchConditionDisp($arrSearchData) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrSearch = array('work_location_flg' => '指定なし', 'appeal_point' => '指定なし', 'employment_status' => '指定なし', 'condition' => '指定なし', 'category' => '指定なし', 'name' => '指定なし');

        if ($arrSearchData['work_location_flg'] > 0) {
            $arrSearch['work_location_flg'] = $this->arrWorkLocationFlg[$arrSearchData['work_location_flg']];
        }

        if ($arrSearchData['employment_status'] != '' && count($arrSearchData['employment_status']) > 0) {
            $arrSearch['employment_status'] = '';
            foreach ($arrSearchData['employment_status'] as $status)
                $arrSearch['employment_status'] .= $this->arrEMPSTATUS[$status] . ',';
        }

        if ($arrSearchData['condition'] != '' && count($arrSearchData['condition']) > 0) {
            $arrSearch['condition'] = '';
            foreach ($arrSearchData['condition'] as $c_status)
                $arrSearch['condition'] .= $this->arrCONDITION[$c_status] . ',';
        }

        if ($arrSearchData['appeal_point'] != '' && count($arrSearchData['appeal_point']) > 0) {
            $arrSearch['appeal_point'] = '';
            foreach ($arrSearchData['appeal_point'] as $c_status)
                $arrSearch['appeal_point'] .= $this->arrAPPEALPOINT[$c_status] . ',';
        }

        // カテゴリ検索条件
        if ($arrSearchData['category_id'] > 0) {
            $arrSearch['category'] = $objQuery->get('category_name', 'dtb_category', 'category_id = ?', array($arrSearchData['category_id']));
        }

        // 商品名検索条件
        if (strlen($arrSearchData['name']) > 0) {
            $arrSearch['name'] = $arrSearchData['name'];
        }
        return $arrSearch;
    }

    /**
     * 該当件数の取得
     *
     * @return int
     */
    function lfGetProductAllNum($searchCondition) {
        // 検索結果対象となる商品の数を取得
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->setWhere($searchCondition['where_for_count']);
        $objProduct = new SC_Product_Ex();
        return $objProduct->findProductCount($objQuery, $searchCondition['arrval']);
    }

    /**
     * 検索条件のwhere文とかを取得
     *
     * @return array
     */
    function lfGetSearchCondition($arrSearchData) {
        $searchCondition = array(
            'where' => '',
            'arrval' => array(),
            'where_category' => '',
            'arrvalCategory' => array()
        );

        // カテゴリからのWHERE文字列取得
        if ($arrSearchData['category_id'] != 0) {
            list($searchCondition['where_category'], $searchCondition['arrvalCategory']) = SC_Helper_DB_Ex::sfGetCatWhere($arrSearchData['category_id']);
        }
        // ▼対象商品IDの抽出
        // 商品検索条件の作成（未削除、表示）
        $searchCondition['where'] = 'alldtl.del_flg = 0 AND alldtl.status = 1 ';

        if (strlen($searchCondition['where_category']) >= 1) {
            $searchCondition['where'] .= ' AND EXISTS (SELECT * FROM dtb_product_categories WHERE ' . $searchCondition['where_category'] . ' AND product_id = alldtl.product_id)';
            $searchCondition['arrval'] = array_merge($searchCondition['arrval'], $searchCondition['arrvalCategory']);
        }

        // 商品名をwhere文に
        $name = $arrSearchData['name'];
        $name = str_replace(',', '', $name);
        // 全角スペースを半角スペースに変換
        $name = str_replace('　', ' ', $name);
        // スペースでキーワードを分割
        $names = preg_split('/ +/', $name);
        // 分割したキーワードを一つずつwhere文に追加
        foreach ($names as $val) {
            if (strlen($val) > 0) {
                $searchCondition['where'] .= ' AND ( alldtl.name ILIKE ? OR alldtl.comment3 ILIKE ?) ';
                $searchCondition['arrval'][] = "%$val%";
                $searchCondition['arrval'][] = "%$val%";
            }
        }

//        if ($arrSearchData['work_location_flg'] != '') {
//            if ($arrSearchData['work_location_flg'] == 5)
//                $searchCondition['where'] .= ' AND (alldtl.work_location_flg IS NULL OR alldtl.work_location_flg = 5) ';
//            else {
//                $searchCondition['where'] .= ' AND alldtl.work_location_flg = ? ';
//                $searchCondition['arrval'][] = $arrSearchData['work_location_flg'];
//            }
//        }

        if ($arrSearchData['work_location_flg'] != '' && count($arrSearchData['work_location_flg']) > 0) {
            if (count($arrSearchData['work_location_flg']) == 1) {
                foreach ($arrSearchData['work_location_flg'] as $status) {
                    $searchCondition['where'] .= ' AND alldtl.work_location_flg = ? ';
                    $searchCondition['arrval'][] = $status;
                }
            } else {
                $max = count($arrSearchData['work_location_flg']);
                $i = 0;
                foreach ($arrSearchData['work_location_flg'] as $status) {
                    $i++;

                    $where = 'alldtl.work_location_flg = ?';
                    if ($status == 6)
                        $where = '(alldtl.work_location_flg IS NULL OR alldtl.work_location_flg = 6)';

                    if ($i == 1)
                        $searchCondition['where'] .= ' AND ( ' . $where;
                    else if ($i == $max)
                        $searchCondition['where'] .= ' OR ' . $where . ' )';
                    else
                        $searchCondition['where'] .= ' OR ' . $where;
                    $searchCondition['arrval'][] = $status;
                }
            }
        }

        if ($arrSearchData['employment_status'] != '' && count($arrSearchData['employment_status']) > 0) {
            if (count($arrSearchData['employment_status']) == 1) {
                foreach ($arrSearchData['employment_status'] as $status) {
                    $searchCondition['where'] .= ' AND alldtl.employment_status ILIKE ? ';
                    $searchCondition['arrval'][] = "%$status%";
                }
            } else {
                $max = count($arrSearchData['employment_status']);
                $i = 0;
                foreach ($arrSearchData['employment_status'] as $status) {
                    $i++;
                    if ($i == 1)
                        $searchCondition['where'] .= ' AND ( alldtl.employment_status ILIKE ? ';
                    else if ($i == $max)
                        $searchCondition['where'] .= ' OR alldtl.employment_status ILIKE ? )';
                    else
                        $searchCondition['where'] .= ' OR alldtl.employment_status ILIKE ? ';
                    $searchCondition['arrval'][] = "%$status%";
                }
            }
        }

        if ($arrSearchData['condition'] != '' && count($arrSearchData['condition']) > 0) {
            if (count($arrSearchData['condition']) == 1) {
                foreach ($arrSearchData['condition'] as $c_status) {
                    $searchCondition['where'] .= ' AND alldtl.conditions ILIKE ? ';
                    $searchCondition['arrval'][] = "%$c_status%";
                }
            } else {
                $max = count($arrSearchData['condition']);
                $i = 0;
                foreach ($arrSearchData['condition'] as $c_status) {
                    $i++;
                    if ($i == 1)
                        $searchCondition['where'] .= ' AND ( alldtl.conditions ILIKE ? ';
                    else if ($i == $max)
                        $searchCondition['where'] .= ' OR alldtl.conditions ILIKE ? )';
                    else
                        $searchCondition['where'] .= ' OR alldtl.conditions ILIKE ? ';
                    $searchCondition['arrval'][] = "%$c_status%";
                }
            }
        }

        if ($arrSearchData['appeal_point'] != '' && count($arrSearchData['appeal_point']) > 0) {
            if (count($arrSearchData['appeal_point']) == 1) {
                foreach ($arrSearchData['appeal_point'] as $c_status) {
                    $searchCondition['where'] .= ' AND alldtl.appeal_point ILIKE ? ';
                    $searchCondition['arrval'][] = "%$c_status%";
                }
            } else {
                $max = count($arrSearchData['appeal_point']);
                $i = 0;
                foreach ($arrSearchData['appeal_point'] as $c_status) {
                    $i++;
                    if ($i == 1)
                        $searchCondition['where'] .= ' AND ( alldtl.appeal_point ILIKE ? ';
                    else if ($i == $max)
                        $searchCondition['where'] .= ' OR alldtl.appeal_point ILIKE ? )';
                    else
                        $searchCondition['where'] .= ' OR alldtl.appeal_point ILIKE ? ';
                    $searchCondition['arrval'][] = "%$c_status%";
                }
            }
        }

        if (isset($_GET['cal']) || $_POST['cal'] != '') {
            $searchCondition['where'] .= ' AND product_id IN (select product_id from dtb_calendar where del_flg = 0 and workday = ?)';
            if (isset($_GET['cal'])) {
                $searchCondition['arrval'][] = $_GET['cal'];
                $this->date = $_GET['cal'];
            }
            else
                $searchCondition['arrval'][] = $_POST['cal'];
        }

        $searchCondition['where_for_count'] = $searchCondition['where'];

        // 在庫無し商品の非表示
        if (NOSTOCK_HIDDEN) {
            $searchCondition['where'] .= ' AND (stock >= 1 OR stock_unlimited = 1)';
            $searchCondition['where_for_count'] .= ' AND EXISTS(SELECT * FROM dtb_products_class WHERE product_id = alldtl.product_id AND del_flg = 0 AND (stock >= 1 OR stock_unlimited = 1))';
        }

        return $searchCondition;
    }

    /**
     * カートに入れる商品情報にエラーがあったら戻す
     *
     * @return str
     */
    function lfSetSelectedData(&$arrProducts, $arrForm, $arrErr, $product_id) {
        $js_fnOnLoad = '';
        foreach ($arrProducts as $key => $value) {
            if ($arrProducts[$key]['product_id'] == $product_id) {

                $arrProducts[$key]['product_class_id'] = $arrForm['product_class_id'];
                $arrProducts[$key]['classcategory_id1'] = $arrForm['classcategory_id1'];
                $arrProducts[$key]['classcategory_id2'] = $arrForm['classcategory_id2'];
                $arrProducts[$key]['quantity'] = $arrForm['quantity'];
                $arrProducts[$key]['arrErr'] = $arrErr;
                $classcategory_id2 = SC_Utils_Ex::jsonEncode($arrForm['classcategory_id2']);
                $js_fnOnLoad .= "fnSetClassCategories(document.product_form{$arrProducts[$key]['product_id']}, {$classcategory_id2});";
            }
        }
        return $js_fnOnLoad;
    }

    /**
     * カートに商品を追加
     *
     * @return void
     */
    function lfAddCart($arrForm, $referer) {
        $product_class_id = $arrForm['product_class_id'];
        $objCartSess = new SC_CartSession_Ex();
        $objCartSess->addProduct($product_class_id, $arrForm['quantity']);
    }

    /**
     * 商品情報配列に商品ステータス情報を追加する
     *
     * @param Array $arrProducts 商品一覧情報
     * @param Array $arrStatus 商品ステータス配列
     * @param Array $arrStatusImage スタータス画像配列
     * @return Array $arrProducts 商品一覧情報
     */
    function setStatusDataTo($arrProducts, $arrStatus, $arrStatusImage) {

        foreach ($arrProducts['productStatus'] as $product_id => $arrValues) {
            for ($i = 0; $i < count($arrValues); $i++) {
                $product_status_id = $arrValues[$i];
                if (!empty($product_status_id)) {
                    $arrProductStatus = array(
                        'status_cd' => $product_status_id,
                        'status_name' => $arrStatus[$product_status_id],
                        'status_image' => $arrStatusImage[$product_status_id],
                    );
                    $arrProducts['productStatus'][$product_id][$i] = $arrProductStatus;
                }
            }
        }
        return $arrProducts;
    }

}
