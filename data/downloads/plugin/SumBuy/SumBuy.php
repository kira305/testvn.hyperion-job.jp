<?php
/*
 * SumBuy
 * Copyright (C) 2012 S-Cubism CO.,LTD. All Rights Reserved.
 * http://ec-cube.ec-orange.jp/
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * プラグインのメインクラス
 *
 * @package SumBuy
 * @author S-Cubism CO.,LTD.
 * @version $Id: $
 */
class SumBuy extends SC_Plugin_Base {

    /**
     * コンストラクタ
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }
    
    /**
     * インストール
     * installはプラグインのインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin plugin_infoを元にDBに登録されたプラグイン情報(dtb_plugin)
     * @return void
     */
    function install($arrPlugin) {
        // ロゴファイルをhtmlディレクトリにコピーします.
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");
    }
    
    /**
     * アンインストール
     * uninstallはアンインストール時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     * 
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function uninstall($arrPlugin) {
        // nop
    }
    
    /**
     * 稼働
     * enableはプラグインを有効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function enable($arrPlugin) {
        // nop
    }

    /**
     * 停止
     * disableはプラグインを無効にした際に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     *
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function disable($arrPlugin) {
        // nop
    }

    /**
     * 処理の介入箇所とコールバック関数を設定
     * registerはプラグインインスタンス生成時に実行されます
     * 
     * @param SC_Helper_Plugin $objHelperPlugin 
     */
    function register(SC_Helper_Plugin $objHelperPlugin) {
        // nop
        // ローカルフックしない
    }

    /**
     * スーパーフックポイント
     *
     * @param LC_Page_EX $objPage
     */
    function process(LC_Page_EX $objPage) {
        // mode確認
        $mode = $objPage->getMode();
        if( $mode === 'sumbuy' ) {
            // GET確認
            if( !empty($_GET['pid']) && !empty($_GET['pnum']) ){
                $arrProduct  = explode(',', $_GET['pid']);
                $arrQuantity = explode(',', $_GET['pnum']);
                // カートへ投入処理
                if( $this->setCart($objPage, $arrProduct, $arrQuantity) ) {
                    // 一つでも商品をカートへ入れていればカートへ移動する
                    SC_Response_Ex::sendRedirect(CART_URLPATH);
                    SC_Response_Ex::actionExit();
                }
            }
        }
    }

    /**
     * 存在有無を確認してカートへ投入する処理
     *
     * @param  LC_Page_EX $objPage
     * @param  array $arrProduct 商品コード配列
     * @param  array $arrQuntity 数量配列
     * @return 
     */
    function setCart(LC_Page_EX &$objPage, $arrProduct, $arrQuantity) {
        $checkCnt = 0;
        // 指定商品が存在するか確認し存在しなければスルー
        foreach( $arrProduct as $key => $product_code ) {
            if( $this->checkProduct($product_code) ) {
                // product_idからproduct_class_idを取得
                $objProduct = new SC_Product_Ex();
                $objProduct->setProductsClassByProductIds(array($product_code));
                $product_class_id = $objProduct->classCategories[$product_code]['__unselected']['__unselected']['product_class_id'];
                // 存在すればカートに投入
                $objCartSess = new SC_CartSession_Ex();
                $objCartSess->addProduct($product_class_id, $arrQuantity[$key]);
                $checkCnt++;
            }
        }

        return $checkCnt;
    }

    /**
     * 商品存在チェック（LC_Page_Product_DetailのlfCheckProductIdの改変）
     *
     * @param $product_code 商品コード
     */
    function checkProduct($product_code) {
        $status = false;
        $where = 'del_flg = 0 AND status = 1';

        if ( !SC_Utils_Ex::sfIsInt($product_code)
             || SC_Utils_Ex::sfIsZeroFilling($product_code)
             || !SC_Helper_DB_Ex::sfIsRecord('dtb_products', 'product_id', (array)$product_code, $where)) {
            return false;
        }

        return true;
    }
}
?>
